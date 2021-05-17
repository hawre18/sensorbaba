<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $uploads='/storage/video/';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getPathAttribute($video){
        return $this->uploads . $video;
    }
    public function products()
    {
        return $this->hasOne(Product::class);
    }
}
