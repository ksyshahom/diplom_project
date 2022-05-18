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
//        $view = 'app/index';
        $view = '_bs/app/index';
        return view($view, compact('user', 'programs'));
    }

    public function send(Request $request)
    {
        $user = Auth::user();
        if (is_null($user->app) || $user->app->verified == 2) {
//        if (true) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'birth_date' => 'required|date',
                'birth_place' => 'required',
                'nationality' => 'required',
                'program_01' => 'required',
                'program_02' => 'required',
                'program_03' => 'required',
                // ...
                'diploma' => 'required_without:diploma_old',
                'diploma_old' => 'required_without:diploma',
                // ...
            ]);
            $data = $request->all();
            //
            if ($request->has('photo')) {
                $data['photo'] = $request->file('photo')
                    ->store("public/users/$user->id");
            } elseif ($request->has('photo_old')) {
                $data['photo'] = $request->photo_old;
            }
            //
            if ($request->has('diploma')) {
                $data['diploma'] = $request->file('diploma')
                    ->store("public/users/$user->id");
            } elseif ($request->has('diploma_old')) {
                $data['diploma'] = $request->diploma_old;
            }
            //
            $application = Application::updateOrCreate(
                ['user_id' => $user->id],
                ['data' => $data, 'verified' => 0]
            );
            //
            DB::table('application_program')->where('application_id', $application->id)->delete();
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
        $user = Auth::user();
        if ($user->app) {
            $applicationProgramRows = DB::table('application_program')
                ->where('application_id', $user->app->id)
                ->get();
            $applicationProgramIds = $applicationProgramRows->pluck('id')->toArray();
            DB::table('interviews')->whereIn('application_program_id', $applicationProgramIds)->delete();
            DB::table('application_program')->where('application_id', $user->app->id)->delete();
            Application::where('id', $user->app->id)->delete();
        }
        return back();
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
            'comment' => $request->filled('comment') ? $request->comment : null,
        ]);
        return $this->appList($request);
    }
}
