<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = "trainings";
    protected $fillable = ['training_name','training_description','created_at'];

    public function quizzes(){
        return $this->hasMany('App\Quiz', 'training_id', 'id');
    }
}
