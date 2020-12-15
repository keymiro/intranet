<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
   protected $fillable = ['name','category','area_id','url','ext',
                        'user_id','category_archive_id','created_at','update_at'];

    public function user(){
        return $this->belongsTo('App\user','user_id');
    }
    public function area(){
        return $this->belongsTo('App\Area','area_id');
    }
    public function categoryarchive(){
        return $this->belongsTo('App\CategoryArchive','category_archive_id');
    }

    //scope
    public function scopeName($query, $name)
    {
        if ($name)
        {
            return $query->where('archives.name','LIKE',"%$name%");
        }
    }
    public function scopeCategory($query, $category)
    {
        if ($category)
        {
            return $query->where('c.name','LIKE',"%$category%");
        }
    }
    public function scopeArea($query, $area)
    {
        if ($area)
        {
            return $query->where('a.name','LIKE',"%$area%");
        }
    }





}
