<?php

namespace App\Models;

use App\Models\AttributeGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table='attribute_values';
    public function attributeGroup(){
        return $this->belongsTo(AttributeGroup::class,'attributeGroup_id');
    }
}
