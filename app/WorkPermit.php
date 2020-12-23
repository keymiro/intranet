<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkPermit extends Model
{
    protected $fillable = [
        'especify', 'typepaid','jentry', 'jexit','datepermit', 'timepermit','pexit',
        'preturn','description','observations','rdate', 'igree','typepermit_id',
        'user_id','igree','coordigree_id','coordigree', 'directigree_id',
        'directigree','managigree_id','managigree',
    ];

    public function user(){
        return $this->belongsTo('App\user','user_id');
    }
    public function typepermit(){
        return $this->belongsTo('App\TypePermit','typepermit_id');
    }
   
}
