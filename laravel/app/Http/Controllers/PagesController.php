<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function item(Request $request, Page $page)
    {
        return view('pages/item', compact('page'));
    }

    public function edit(Request $request)
    {
        $request->validate([
            'page_id' => 'required',
            'page_content' => 'required',
        ]);
        Page::where('id', $request->page_id)
            ->update(['content' => $request->page_content]);
        return redirect('/pages/' . $request->page_id);
    }
}
