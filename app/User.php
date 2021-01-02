<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password','role_id', 'people_id',
        'state','type_func',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getIsAdminAttribute() {
        return $this->role_id ==1;

    }
    public function getIsGerenteAttribute() {
        return $this->role_id ==2;
    }
    public function getIsDirectorAttribute() {
        return $this->role_id ==3;
    }
    public function getIsCoordAttribute() {
        return $this->role_id ==4;
    }

    //se usa el nombre de la tabla relacionada en singular para
    //indicar que un usuario pertenece a un rol
    //un usuario solo puede tener un rol
    public function people(){
        return $this->belongsTo('App\People');
    }
    public function role(){
        return $this->belongsTo('App\Role');
    }
    public function questionnaires(){
        return $this->hasMany('App\Questionnaire');
    }
    public function resultquestionnaire()
    {
        return$this->hasMany('App\ResultQuestionnaire');
    }
    public function repetitions(){
        return $this->hasMany('App\Repetition');
    }
    public function adverseevent(){
        return $this->hasOne('App\AdverseEvent');
    }

    public function workpermit(){
        return $this->hasMany('App\WorkPermit');
    }
    public function changeturn(){
        return $this->hasMany(ChangeTurn::class,'user_id');
    }
    public function changeturn_user(){
        return $this->hasMany(ChangeTurn::class,'user_change_id');
    }
    public function workvacation(){
        return $this->hasMany(WorkPermit::class);
    }
    public function archive(){
        return $this->hasMany(Archive::class);
    }



}
