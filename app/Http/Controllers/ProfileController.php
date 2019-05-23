<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProfile()
    {
        $page  = "profile";
        $user = Auth::user();
        $profile = Profile::where('user_id',$user->id)->get();

        return view('user.myProfilePage', compact("page","profile"));
    }

    public function addProfile(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'status' => 'required',
            'gender' => 'required',
            'photo' => 'required',
        ]);

        try{
            $profile = new Profile();
            $user = Auth::user();

            $profile->user_id = $user->id;
            $profile->name = $request->name;
            $profile->address = $request->address;
            $profile->phone_number = $request->phone_number;
            $profile->status = $request->status;
            $profile->gender = $request->gender;

            $file = $request->file('photo');
            if(!$file){
                return redirect()->route('showProfile',$profile->id)->with('alert','Data must be filled');
            }
            $file_name = $file->getClientOriginalName();
            $path = public_path("/img/faces");
            $file->move($path, $file_name);
            $profile->photo = $file_name;

            $profile->save();

        }catch (\Exception $exception){
            return redirect()->route("profile")->with('alert', "Sorry there was an error on the server, please try again soon.");
        }
        return redirect()->route("showProfile")->with('success', "Data Saved.");
    }

    public function showMyProfile(){
        $page  = "profile";
        $user = Auth::user();
        $profile = Profile::where('user_id',$user->id)->get();

        if ($profile->count()==0){
            return view('user.profilePage',compact('page'))->with('alert', 'Sorry Please fill the form first');
        }
        return redirect()->route("showProfile");

    }

}
