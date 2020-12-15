<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultQuestionnaire extends Model
{
    protected $table = 'resultquestionnaires';
    protected $fillable =
        [  'score','questionnaire_id','user_id',
        'question_id','correctoption_id','repetition_id','pass'];

    public function questionnaire(){
        return $this->belongsTo('App\Questionnaire','questionnaire_id');
    }
    public function question(){
        return $this->belongsTo('App\Question','question_id');
    }
    public function correctoption(){
        return $this->belongsTo('App\Correctoption','correctoption_id');
    }
    public function user(){
        return $this->belongsTo('App\user','user_id');
    }
    public function repetition(){
        return $this->belongsTo('App\Repetition','repetition_id');
    }

}
