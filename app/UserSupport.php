<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSupport extends Model
{
   protected $fillable = ['names','email','phone',
                         'jobtitle', 'eps','type','message'];
}
