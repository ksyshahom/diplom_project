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
        $enrollees = User::where('role_id', 1)->get();
        return view('report/index', compact('enrollees'));
    }
}
