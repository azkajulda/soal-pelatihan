<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = "profiles";
    protected $fillable = ['user_id','name','address','phone_number', 'status','gender','photo'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
