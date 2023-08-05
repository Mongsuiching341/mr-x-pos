<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function images(): Attribute
    {

        return Attribute::make(
            get: function ($value, $attributes) {
                return   json_decode($attributes['images'], true);
            }
        );
    }
    public function image(): Attribute
    {

        return Attribute::make(
            get: function ($value, $attributes) {
                return   json_decode($attributes['images'], true);
            }
        );
    }
}
