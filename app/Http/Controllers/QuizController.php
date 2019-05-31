<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Quiz_question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function showQuiz($id)
    {
        $page  = "training";
        $quiz = Quiz::where('training_id',$id)->get();

        return view('user.quizPage', compact("quiz","page"));
    }

    public function addQuizzes(Request $request, $id)
    {
        $validate = $request->validate([
            'quiz_name' => 'required',
            'quiz_description' => 'required',
            'difficulty' => 'required',
            'question' => 'required',
            'time' => 'required',
        ]);

        $quiz = new Quiz();
        $question = new Quiz_question();

        try
        {
            $quiz->training_id = $id;
            $quiz->quiz_name = $request->quiz_name;
            $quiz->quiz_description = $request->quiz_description;
            $quiz->difficulty = $request->difficulty;


            $question->quiz_id = $quiz->id;

            $file = $request->file('question');
            dd($file);
            if(!$file){
                return redirect()->route("quiz",$id)->with('alert','Data must be filled');
            }
            $file_name = $file->getClientOriginalName();
            $path = public_path("/questions");
            $file->move($path, $file_name);
            $question->question = $file_name;

            $question->time = $request->time;

            $question->save();
            $quiz->save();

        }catch (\Exception $exception)
        {
            return dd($exception);
//            return redirect()->route("quiz",$id)->with('alert', "Sorry there was an error on the server, please try again soon.");
        }
        return redirect()->route("quiz",$id)->with('success', "Data Saved.");
    }
}
