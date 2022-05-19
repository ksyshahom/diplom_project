<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Program;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        //
        $programs = Program::all();
        //
//        $view = 'profile/index';
        $view = '_bs/profile/index';
        return view(
            $view,
            compact('user', 'programs')
        );
    }

    public function edit(Request $request)
    {
        $request->validate([
            'programs' => 'required|array|min:1',
        ]);
        $teacher = Auth::user()->teacher;
        if ($request->filled('contacts')) {
            Teacher::where('id', $teacher->id)
                ->update(['contacts' => $request->contacts]);
        }
        $teacher->programs()->sync($request->programs);
        return back();
    }
}
