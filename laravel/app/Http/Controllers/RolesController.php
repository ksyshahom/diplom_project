<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view(
            'roles/index',
            compact('roles', 'users')
        );
    }

    public function update(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);
        $user = User::where('id', $request->user_id)->first();
        if ($user->isTeacher && $user->teacher) {
            $user->teacher->delete();
        }
        //
        $user->role_id = $request->role_id;
        $user->save();
        if ($request->role_id == User::TEACHER_ROLE_ID) {
            Teacher::create(['user_id' => $user->id]);
        }
        return $this->index($request);
    }
}
