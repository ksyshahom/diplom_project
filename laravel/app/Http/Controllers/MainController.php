<?php

namespace App\Http\Controllers;

use App\Models\Page;

class MainController extends Controller
{
    public function index() {
        $page = Page::where('url', '/')->first();
        return view('index', compact('page'));
    }
}
