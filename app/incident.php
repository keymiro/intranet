<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class incident extends Model
{
    protected $fillable = [
        'name', 'description', 'priority_id', 'location_id', 'client_id'

    ];

    //
}
