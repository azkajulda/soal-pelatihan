<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function showQuiz($id)
    {
        $page  = "training";
        $quiz = Quiz::where('training_id',$id)->get();

        return view('user.quizPage', compact("quiz","page"));
    }
}
