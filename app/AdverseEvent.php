<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdverseEvent extends Model
{
    protected $fillable =
        ['canoni', 'area_id', 'location_id',
            'namepatient', 'documentpatient',
            'description', 'consecutive',
            'user_id', 'unitanalysis',
            'nameevent', 'coordinator',
        ];

    public function area()
    {
        return $this->belongsTo('App\Area', 'area_id');
    }

    public function location()
    {
        return $this->belongsTo('App\Location', 'location_id');
    }

      public function user()
    {
        return $this->belongsTo('App\User', 'user_id');

    }
}

