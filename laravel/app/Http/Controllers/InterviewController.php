<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Interview;
use App\Models\Program;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Services\Timezones;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    public function index(Request $request)
    {
        $timezones = Timezones::getList();
        //
        $user = Auth::user();
        $applicationProgramRows = DB::table('application_program')
            ->where('application_id', $user->app->id)
            ->orderBy('priority')
            ->get();
        //
        $programIds = $applicationProgramRows->pluck('program_id')->toArray();
        $programs = Program::whereIn('id', $programIds)
            ->get()
            ->keyBy('id')
            ->toArray();
        //
        $applicationProgramIds = $applicationProgramRows->pluck('id')->toArray();
        $interviews = Interview::whereIn('application_program_id', $applicationProgramIds)
            ->get()
            ->keyBy('application_program_id');
        //
        return view(
            'interview/index',
            compact('timezones', 'applicationProgramRows', 'programs', 'interviews')
        );
    }

    public function item(Request $request, Program $program)
    {
        $timezones = Timezones::getList();
        //
        $programTeacher = DB::table('program_teacher')
            ->where('program_id', $program->id)
            ->get()
            ->pluck('teacher_id')
            ->toArray();
        $schedule = Schedule::distinct()
            ->select('date', 'interval_id', 'start_timestamp')
            ->leftJoin('interviews', 'interviews.schedule_id', 'schedule.id')
            ->whereNull('interviews.id')
            ->whereIn('teacher_id', $programTeacher)
            ->get()
            ->groupBy('date')
            ->toArray();
        if ($request->filled('timezone')) {
            $timezoneSchedule = [];
            foreach ($schedule as $date => $scheduleItems) {
                foreach ($scheduleItems as $scheduleItem) {
                    $data = $scheduleItem;
                    $data['originalDate'] = $data['date'];
                    $data['timestamp'] = $scheduleItem['start_timestamp'] + $timezones[request('timezone')]['offset'] - 10800;
                    $data['timezoneDate'] = date('Y-m-d', $data['timestamp']);
                    $data['timezoneTime'] = date('H:i', $data['timestamp']);
                    $timezoneSchedule[$data['timezoneDate']][] = $data;
                }
            }
        }
        //
        return view(
            'interview/item',
            compact('timezones', 'timezoneSchedule')
        );
    }

    public function signUp(Request $request, Program $program)
    {
        $request->validate([
            'interval_id' => 'required',
        ]);
        $user = Auth::user();
        //
        list($date, $intervalId) = explode('_', $request->interval_id);
        //
        $applicationProgram = DB::table('application_program')
            ->where('application_id', $user->app->id)
            ->where('program_id', $program->id)
            ->first();
        //
        $programTeacher = DB::table('program_teacher')
            ->where('program_id', $program->id)
            ->get()
            ->pluck('teacher_id')
            ->toArray();
        $schedule = Schedule::distinct()
            ->select('schedule.id')
            ->leftJoin('interviews', 'interviews.schedule_id', 'schedule.id')
            ->whereNull('interviews.id')
            ->whereIn('teacher_id', $programTeacher)
            ->where('date', $date)
            ->where('interval_id', $intervalId)
            ->first();
        //
        Interview::create([
            'application_program_id' => $applicationProgram->id,
            'schedule_id' => $schedule->id,
        ]);
        return redirect('/interview?timezone=' . rawurlencode($request->timezone));
    }

    public function cancel(Request $request, Program $program)
    {
        $user = Auth::user();
        $applicationProgram = DB::table('application_program')
            ->where('application_id', $user->app->id)
            ->where('program_id', $program->id)
            ->first();
        $interview = Interview::where('application_program_id', $applicationProgram->id)->first();
        if ($interview) {
            if ($interview->schedule->start_timestamp > time()) {
                $interview->delete();
            }
        }
        return back();
    }
}
