<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['category','category_id'];
    protected $with =['subcategory'];

    public function subcategory()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function scopeRoot($query)
    {
        return $query->where('category_id', 0)->orderBy('category');
    }
}
