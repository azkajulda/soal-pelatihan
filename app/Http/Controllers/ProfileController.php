<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $page  = "profile";
        return view('user.profilePage', compact("page"));
    }
}
