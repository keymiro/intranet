<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = [
        'name','try', 'user_id','active','time',

    ];
    protected  $table ='questionnaires';

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function questions(){
        return $this->hasMany('App\Question');

    }
    public function resultquestionnaire()
    {
        return$this->hasMany('App\ResultQuestionnaire');
    }
    public function repetitions(){
        return $this->hasMany('App\Repetition');
    }
}
