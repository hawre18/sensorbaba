<?php

namespace App\Models;

use App\Models\Category;
use App\Models\AttributeValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $table='attribute_groups';
    public function attributeValue(){
        return $this->hasMany(AttributeValue::class,'attributeGroup_id');
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'attributegroup_category','attributeGroup_id','category_id');
    }
}
