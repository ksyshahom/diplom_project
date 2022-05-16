<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Interval;
use App\Models\Interview;
use App\Models\Program;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $intervals = Interval::all();
        $teacherId = Auth::user()->teacher->id;
        $schedule = Schedule::where('teacher_id', $teacherId)->get()->groupBy('date');
//        dd($schedule);
        return view(
            'schedule/index',
            compact('intervals', 'schedule')
        );
    }

    public function add(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after:yesterday',
            'intervals' => 'required|array|min:1',
        ]);
        $teacherId = Auth::user()->teacher->id;
        foreach ($request->intervals as $intervalId) {
            $interval = Interval::where('id', $intervalId)->first();
            $startTimestamp = strtotime($request->date . ' ' . $interval->from);
            Schedule::firstOrCreate(
                [
                    'teacher_id' => $teacherId,
                    'date' => $request->date,
                    'interval_id' => $intervalId,
                ],
                ['start_timestamp' => $startTimestamp]
            );
        }
        return back();
    }

    public function item(Request $request, Schedule $schedule)
    {
        $interview = Interview::where('schedule_id', $schedule->id)->first();
        $applicationProgram = DB::table('application_program')
            ->where('id', $interview->application_program_id)
            ->first();
        $application = Application::where('id', $applicationProgram->application_id)->first();
        $program = Program::where('id', $applicationProgram->program_id)->first();
        $enrollee = User::where('id', $application->user_id)->first();
        return view(
            'schedule/item',
            compact('interview', 'enrollee', 'schedule', 'program', 'application')
        );
    }

    public function editItem(Request $request, Schedule $schedule)
    {
        $request->validate([
            'conference_link' => 'required',
            'mark_value' => 'nullable|integer|min:0|max:100',
        ]);
        $interview = Interview::where('schedule_id', $schedule->id)->first();
        $interview->conference_link = $request->conference_link;

        if ($request->filled('mark_value')) {
            $interview->mark_value = $request->mark_value;
        }
        if ($request->filled('mark_comment')) {
            $interview->mark_comment = $request->mark_comment;
        }

        $interview->save();
        return back();
    }
}
