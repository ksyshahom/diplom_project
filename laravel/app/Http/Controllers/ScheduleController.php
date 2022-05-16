<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Interval;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function item(Request $request)
    {
        //
    }

    public function editItem(Request $request)
    {
        //
    }
}
