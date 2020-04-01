<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;
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
        $products = Product::categoryFilter($category->id)
                ->with(['photos'=> function ($query) {
                    $query->default();
                }])
                ->paginate($paginate);
        return response()->json(compact('products'));
    }

    public function brands(Category $category)
    {
        $brands = Brand::whereHas('products', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })->get();
        return response()->json(compact('brands'));
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

        $data=$request->except(['photo','nutritionalFacts']);
        $brand = Brand::find($request->get('brand_id'));
        if ($brand==null) {
            $brand = Brand::create(['name'=>$request->get('brand_name')]);
        }
        $data['brand_id']=$brand->id;
        $product= $category->products()->create($data);

        if ($request->has('photo')) {
            $path = $request->file('photo')->store('public/products');
            $default = ($product->photos->count()>0)?0:1;
            $productPhoto= $product->photos()->create([
                'photo'=>$path,
                'default'=>$default
            ]);
        }
        if ($request->has('nutritionalFacts')) {
            $path = $request->file('nutritionalFacts')->store('public/nutrition');
            $product->nutritional_facts=$path;
            $product->save();
        }


        return response()->json(compact('product'));
    }

    public function uploadPhoto(Request $request)
    {
        if ($request->has('photo')) {
            $path = $request->file('photo')->store('public/products');
            $productPhoto= ProductPhoto::create([
                'photo'=>$path
            ]);
            return response()->json(compact('productPhoto'));
        }
        abort(404);
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
