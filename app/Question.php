<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'image', 'statement', 'option_a',
        'option_b', 'option_c','option_d',
        'correctoption_id','questionnaire_id',

    ];
    protected $table ='questions';

    public function questionnaire(){
        return $this->belongsTo('App\Questionnaire','questionnaire_id');

    }
    public function correctoption(){
        return$this->belongsTo('App\CorrectOption', 'correctoption_id');
    }
    public function resultQuestionnaire()
    {
        return$this->hasMany('App\ResultQuestionnaire');
    }
}
