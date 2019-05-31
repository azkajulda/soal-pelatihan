<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function showHome()
    {
        $page  = "home";
        return view('user.initialPage',compact("page"));
    }

    public function showManageUser(){
        $page = "manage";
        $user = Auth::user()->paginate(10);

        return view('user.manageUserPage',compact("page","user"));
    }

    public function editAccess(Request $request, $id){
        $validate = $request->validate([
            'level' => 'required',
        ]);

        $user = User::findOrFail($id);

        try{
            $user->level = $request->level;
            $user->save();
        }catch (\Exception $exception){
            return redirect()->route('manageUser')->with('alert', "Sorry there was an error on the server, please try again soon.");
        }
        return redirect()->route('manageUser')->with('success', "Access Code ".$user->email." Edited");
    }
}
