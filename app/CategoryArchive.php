<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryArchive extends Model
{
    protected $fillable = [
        'name','description',
    ];

    public function archive(){
        return $this->hasMany(Archive::class);
    }
}
