<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';
    protected $fillable = ['training_id','quiz_name','quiz_description','difficulty','created_at'];

    public function quizQuestions(){
        return $this->hasMany('App\Quiz_question','quiz_id','id');
    }

    public function trainings(){
        return $this->belongsTo('App\Training','training_id','id');
    }
}
