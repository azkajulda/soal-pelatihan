<?php

namespace App\Http\Controllers;

use App\Answer_key;
use App\Quiz;
use App\Quiz_question;
use App\Training;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function showQuiz($id)
    {
        $page  = "training";
        $quiz = Quiz::where('training_id',$id)->get();
        $trainings = Training::where('id',$id)->get();

        return view('user.quizPage', compact("quiz","page", "trainings"));
    }

    public function addQuizzes(Request $request, $id)
    {
        $validate = $request->validate([
            'quiz_name' => 'required',
            'quiz_description' => 'required',
            'number_of_question' => 'required',
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
            $quiz->save();

            $question->quiz_id = $quiz->id;

            $file = $request->file('question');

            if(!$file){
                return redirect()->route("quiz",$id)->with('alert','Data must be filled');
            }
            $file_name = $file->getClientOriginalName();
            $path = public_path("/questions");
            $file->move($path, $file_name);
            $question->question = $file_name;

            $question->number_of_question = $request->number_of_question;
            $question->time = $request->time;

            $question->save();

        }catch (\Exception $exception)
        {
            return dd($exception);
//            return redirect()->route("quiz",$id)->with('alert', "Sorry there was an error on the server, please try again soon.");
        }
        return redirect()->route("quiz",$id)->with('success', "Data Saved.");
    }

    //quiz question

    public function showQuizQuestion($id){
        $page  = "training";
        $question = Quiz_question::where('id',$id)->get();
        $quiz = Quiz::where('id', $question[0]->quiz_id)->get();

        return view('user.quizQuestionPage', compact('page','question','quiz'));
    }

    public function addAnswersKeys(Request $request, $id){
        $question = Quiz_question::where('id',$id)->get();
        try{
            for ($i=1;$i<=$question[0]->number_of_question;$i++){
                $answersKey[] = [
                    'quiz_question_id' => $question[0]->id,
                    'no_answers_keys' => $i,
                    'answer_keys' => $request->answer[$i],
                ];
            }
        Answer_key::insert($answersKey);
        }catch (\Exception $exception){
            return dd($exception);
        }
        return redirect()->route('home')->with('success', "Data Saved.");
    }


}
