<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $uploads='/storage/photos/';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getPathAttribute($photo){
        return $this->uploads . $photo;
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'photo_product','photo_id','product_id');
    }
}
