<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Storage;

class ProductPhoto extends Model
{
    protected $fillable= ['product_id','default','photo'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getPhotoAttribute($value)
    {
        return asset(Storage::url($value));
    }

    public function scopeDefault($query)
    {
        return $query->where('default', 1);
    }
}
