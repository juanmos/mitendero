<?php

namespace Tests\Feature\Shop;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    protected $headers;

    public function setUp():void
    {
        parent::setUp();
        $this->seed();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryList()
    {
        $response = $this->get('api/shop/v1/categories');
        $response->assertStatus(200);
        $response->dump();
        $response->assertJsonStructure(['categories']);
    }

    public function testGetCategoryShow()
    {
        $response = $this->get("api/shop/v1/category/1");
        $response->assertStatus(200);
        $response->assertJsonStructure(['category']);
    }

    public function testProductsList()
    {
        $this->withoutExceptionHandling();
        factory(Product::class, 10)->create(['category_id'=>17]);
        $response = $this->get('/api/shop/v1/category/17/products');
        $response->assertStatus(200);
        $response->assertJsonStructure(['products']);
        $response->assertJsonCount(6, 'products.data');
    }

    /** @test */
    public function testProductsBrands()
    {
        $brand=factory(Brand::class)->create(['name'=>'Sunny']);
        factory(Product::class, 5)->create(['category_id'=>25]);
        factory(Product::class, 5)->create(['category_id'=>25, 'brand_id'=>$brand->id]);
        $response = $this->get('api/shop/v1/category/25/brands');
        $response->assertOk();
        $response->assertJsonStructure(['brands']);
    }
}
