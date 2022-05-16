<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Interview;
use App\Models\Program;
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
            ->keyBy('application_program_id')
            ->toArray();
        //
        return view(
            'interview/index',
            compact('timezones', 'applicationProgramRows', 'programs', 'interviews')
        );
    }

    public function item(Request $request, Program $program)
    {
        $timezones = Timezones::getList();
        return view(
            'interview/item',
            compact('timezones')
        );
    }

    public function signUp(Request $request)
    {
        //
    }
}
