<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductPhoto;
use App\Models\Company;
use App\Models\CompanyProduct;

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
    protected $with = [
        'brand'
    ];
    

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id');
    }

    public function company()
    {
        return $this->belongsToMany(Company::class)
                ->using(CompanyProduct::class)
                ->withPivot('price', 'quantity');
    }

    public function scopeCategoryFilter($query, $id)
    {
        return $query->where('category_id', $id);
    }


    public function scopeMixins($query)
    {
        if (in_array('Comercio', auth('api')->user()->getRoleNames()->toArray())) {
            $query->with([
                'photos'=> function ($query) {
                    $query->default();
                }
                
            ]);
            $query->withCount(['company'=>function ($query) {
                $query->where('company_id', auth()->user()->company_id);
            }]);
        } else {
            $query->with(['photos'=> function ($query) {
                $query->default();
            }]);
        }
    }
}
