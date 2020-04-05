<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProductInCompany(Product $product)
    {
        $product_company=$product->company()->where('company_id', auth()->user()->company_id)->get();
        return response()->json(compact('product_company'));
    }

    public function setProductInCompany(Request $request, Product $product)
    {
        $product_company=$product->company()->attach(auth()->user()->company_id);
        // dd($product->company()->get());
        return $this->getProductInCompany($product);
    }

    public function updateProductPrice(Request $request, Product  $product)
    {
        $product->company()->sync([auth()->user()->company_id=>['price'=>$request->price]]);
        return response()->json();
    }

    public function removeProductInCompany(Product $product)
    {
        $product->company()->detach(auth()->user()->company_id);
    }
}
