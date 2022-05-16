<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
//        $view = 'dashboard/index';
        $view = '_bs/dashboard/index';
        return view($view, compact('user'));
    }
}
