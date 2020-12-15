<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobtitle extends Model
{
    protected $fillable = [
        'title','description',
    ];
    public function people(){
        return $this->hasOne('App\People','id_people', 'id');
    }
}
