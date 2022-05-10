<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            if ($request->has('photo')) {
                $data['photo'] = $request->file('photo')
                    ->store("public/users/$user->id");
            }
            $data['diploma'] = $request->file('diploma')
                ->store("public/users/$user->id");
            Application::create([
                'user_id' => $user->id,
                'data' => $data,
                'verified' => 0,
            ]);
        }
        return redirect('/dashboard');
    }
}
