<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function adverseevent(){
        return $this->hasOne('App\AdverseEvent');
    }
}
