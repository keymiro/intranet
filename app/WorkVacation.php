<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkVacation extends Model
{
    protected $fillable = [
        'startdate', 'returndate','fromdate', 'untildate',
        'businessdays', 'requesteddays','pendingdays',
        'enjoydays','observations','user_id', 'igree',
        'coordigree_id','coordigree', 'directigree_id',
        'directigree','v','created_at','update_at',
    ];
    public function user(){
        return $this->belongsTo('App\user','user_id');
    }
}
