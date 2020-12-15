<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrectOption extends Model
{
    //
    protected $table = 'correctoptions';
    public function question()
    {
        return $this->hasOne('App\Question');
    }
    public function resultQuestionnaire()
    {
        return$this->hasMany('App\ResultQuestionnaire');
    }
}
