<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{

    public function getIsArearhAttribute() {
        return $this->area_id==3;
    }

    protected $fillable = [
        'document', 'names','lastnames', 'datebirth',
        'phone', 'addres', 'jobtitle_id', 'area_id',
    ];
//para indicar a la tabla que pertenece
    protected $table = 'peoples';

    public function user(){
        return $this->hasOne('App\User');
    }
    public function area(){
        return $this->belongsTo('App\Area','area_id');
    }
    public function jobtitle(){
        return $this->belongsTo('App\Jobtitle','jobtitle_id');
    }

}
