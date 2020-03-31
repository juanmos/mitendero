<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'brand_id',
        'presentation',
        'price',
        'description',
        'ingredients',
        'nutritional_facts'
    ];

    protected $with = ['brand'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function scopeCategoryFilter($query, $id)
    {
        return $query->where('category_id', $id);
    }
}