<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, $paginate = 6)
    {
        $products = Product::categoryFilter($category->id)->paginate($paginate);
        return response()->json(compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        if ($category==null) {
            abort(404);
        }
        $request->validate([
            'name'=>'required',
            'brand_id'=>'required',
            'presentation'=>'required',
            'price'=>'required',
        ]);

        $data=$request->all();
        $brand = Brand::find($request->get('brand_id'));
        if ($brand==null) {
            $brand = Brand::create(['name'=>$request->get('brand_name')]);
        }
        $data['brand_id']=$brand->id;
        $product= $category->products()->create($data);
        return response()->json(compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
