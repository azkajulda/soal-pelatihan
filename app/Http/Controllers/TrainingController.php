<?php

namespace App\Http\Controllers;

use App\Training;
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
        $training = Training::withCount('quizzes')->get();

        return view('user.trainingPage', compact("training","page"));
    }

    public function addTraining(Request $request)
    {
        $validate = $request->validate([
            'training_name' => 'required',
            'training_description' => 'required',
        ]);

        try{
            $traning = new Training();

            $traning->training_name = $request->training_name;
            $traning->training_description = $request->training_description;
            $traning->save();

        }catch (\Exception $exception){
//            $exception;
            return redirect()->route('training')->with('alert', "Sorry there was an error on the server, please try again soon.");
        }
        return redirect()->route('training')->with('success', "data updated");
    }

    public function deleteTraining($id)
    {
        $training = Training::findOrFail($id);
        $training->delete();

        return redirect()->route('training')->with('delete','Data Training '.$training->training_name.' Telah Terhapus');
    }

    public function updateTraining(Request $request, $id)
    {
        $validate = $request->validate([
            'training_name' => 'required',
            'training_description' => 'required',
        ]);

        $traning = Training::findOrFail($id);
        try{

            $traning->training_name = $request->training_name;
            $traning->training_description = $request->training_description;
            $traning->save();

        }catch (\Exception $exception){
            $exception;
//            return redirect()->route('training')->with('alert', "Please Sign In Or Sign Up First!, For Access the Fiture");
        }
        return redirect()->route('training')->with('success', "data updated");
    }

}
