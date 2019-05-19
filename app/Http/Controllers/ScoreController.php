<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showScore()
    {
        $page  = "score";
        return view('user.scorePage', compact("page"));
    }
}
