<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypePermit extends Model
{
    protected $fillable = [
        'name', 'description','create_at', 'updated_at',
            ];

    public function workpermit(){
        return $this->hasMany('App\WorkPermit');
    }
}
