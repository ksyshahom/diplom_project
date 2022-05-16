<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
//        $view = 'auth/index';
        $view = '_bs/auth/index';
        return view($view);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        } else {
            return back()
                ->withErrors(['email' => 'Incorrect authorization info.'])
                ->withInput();
        }
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|confirmed',
            'password' => 'required|confirmed',
        ]);
        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'middle_name' => $request->filled('middle_name') ? $request->middle_name : null,
                'last_name' => $request->last_name,
                'role_id' => 1,
            ]);
            Auth::login($user, true);
            return redirect('/dashboard?success=true');
        } else {
            return back()
                ->withErrors(['email' => 'A user with this Email already exists.'])
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
