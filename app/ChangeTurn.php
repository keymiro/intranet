<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**

 */
class ChangeTurn extends Model
{
    protected $fillable = ['numberchangeturn','datechangeturn',
                           'tchangeturn','namechange','celchange',
                           'returnchangeturn','t1changeturn','observations',
                           'user_id','igree','coordigree_id','coordigree',
                           'rdaterrhh','changeigree_id',
                           'changeigree','v','created_at','updated_at',];

    public function user(){
        return $this->belongsTo('App\user','user_id');
    }
}






