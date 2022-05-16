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
        $programs = Program::all();
        $user = Auth::user();
//        dd($user->teacher->programs->contains('id', 3));
        return view(
            'profile/index',
            compact('programs', 'user')
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
