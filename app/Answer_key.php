<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer_key extends Model
{
    protected $table = "answer_keys";
    protected  $fillable = ['quiz_question_id','no_answers_keys','answer_keys'];
}
