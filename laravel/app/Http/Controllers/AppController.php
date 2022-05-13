<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $programs = Program::all();
        return view('app/index', compact('user', 'programs'));
    }

    public function send(Request $request)
    {
        $user = Auth::user();
        if (is_null($user->app)) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                // ...
                'nationality' => 'required',
                'program_01' => 'required',
                'program_02' => 'required',
                'program_03' => 'required',
                // ...
                'diploma' => 'required',
                // ...
            ]);
            $data = $request->all();
            //
            if ($request->has('photo')) {
                $data['photo'] = $request->file('photo')
                    ->store("public/users/$user->id");
            }
            $data['diploma'] = $request->file('diploma')
                ->store("public/users/$user->id");
            //
            $application = Application::create([
                'user_id' => $user->id,
                'data' => $data,
                'verified' => 0,
            ]);
            //
            DB::table('application_program')->insert([
                'application_id' => $application->id,
                'program_id' => $request->program_01,
                'priority' => 1,
            ]);
            DB::table('application_program')->insert([
                'application_id' => $application->id,
                'program_id' => $request->program_02,
                'priority' => 2,
            ]);
            DB::table('application_program')->insert([
                'application_id' => $application->id,
                'program_id' => $request->program_03,
                'priority' => 3,
            ]);
        }
        return redirect('/dashboard');
    }

    public function delete(Request $request)
    {
        //
    }

    public function item(Request $request, Application $application)
    {
        return view('app/item', compact('application'));
    }

    public function appList(Request $request)
    {
        $enrollees = User::where('role_id', 1)->get();
        return view('app/list', compact('enrollees'));
    }

    public function edit(Request $request)
    {
        $request->validate([
            'application_id' => 'required',
            'verified' => 'required',
        ]);
        Application::where('id', $request->application_id)->update([
            'verified' => $request->verified,
            'comment' => $request->has('comment') && $request->comment ? $request->comment : null,
        ]);
        return $this->appList($request);
    }
}
