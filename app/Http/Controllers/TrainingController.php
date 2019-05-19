<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showTraining()
    {
        $page  = "training";
        return view('user.trainingPage', compact("page"));
    }
}
