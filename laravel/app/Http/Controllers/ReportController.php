<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $enrollees = User::where('role_id', 1)->get();
//        $view = 'report/index';
        $view = '_bs/report/index';
        return view(
            $view,
            compact('user', 'enrollees')
        );
    }
}
