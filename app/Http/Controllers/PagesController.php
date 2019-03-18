<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title = "Welcome to the user response dashboard!";
        return view('pages.index')->with('title', $title);
    }
}
