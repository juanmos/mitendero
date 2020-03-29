<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category','category_id'];

    public function subcategory()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function scopeRoot($query)
    {
        return $query->where('category_id', 0)->orderBy('category');
    }
}
