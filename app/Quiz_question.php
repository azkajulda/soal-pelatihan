<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz_question extends Model
{
    protected $table = "quiz_questions";
    protected $fillable = ['quiz_id','user_id','question','answer','created_at'];

    public function quiz(){
        return $this->belongsTo('App\Quiz','quiz_id','id');
    }
}
