<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
         'name','description',
    ];

    public function people(){
        return $this->hasOne('App\People');
    }
    public function adverseevent(){
        return $this->hasOne('App\AdverseEvent');
    }
    public function archive(){
        return $this->hasMany(Archive::class);
    }

}
