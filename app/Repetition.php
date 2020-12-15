<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repetition extends Model
{
    protected $fillable = [
        'quantity','questionnaire_id','user_id',
    ];
    public function questionnaire(){
        return $this->belongsTo('App\Questionnaire','questionnaire_id');
    }
    public function user(){
        return $this->belongsTo('App\user','user_id');
    }
    public function resultquestionnaire(){
        return $this->hasMany('App\ResultQuestionnaire');
    }

}
