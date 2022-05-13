<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        User::where('id', $request->user_id)
            ->update(['role_id' => $request->role_id]);
        return $this->index($request);
    }
}
