<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'notification', 'v','role_id', 'workpermit_id','created_at','updated_at',
    ];
    public function role(){
        return $this->belongsTo('App\Role','rol_id');
    }
    public function workpermit(){
        return $this->belongsTo('App\WorkPermit','workpermit_id');
    }
}
