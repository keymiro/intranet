<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];
    //se usa el nombre de la tabla a relacionar en plural para indicar que es muchos a uno
    //un rol puede tener varios usuarios
    public function users (){

        return $this->hasOne('App\User');
    }
    public function notification(){
        return $this->hasMany('App\Notification');
    }

}
