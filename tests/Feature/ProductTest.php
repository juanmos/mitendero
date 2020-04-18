<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductPhoto;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    protected $headers;

    public function setUp():void
    {
        parent::setUp();
        $this->seed();
        $token = auth()->guard('api')
            ->login(User::first());
        $this->headers['Authorization'] = 'Bearer ' . $token;
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProductsList()
    {
        factory(Product::class, 10)->create(['category_id'=>17]);
        $response = $this->get('/api/category/17/products');
        $response->assertStatus(200);
        $response->assertJsonStructure(['products']);
        $response->assertJsonCount(6, 'products.data');
    }

    /** @test */
    public function testProductsBrands()
    {
        $this->withoutExceptionHandling();
        $brand=factory(Brand::class)->create(['name'=>'Sunny']);
        factory(Product::class, 5)->create(['category_id'=>17]);
        factory(Product::class, 5)->create(['category_id'=>17, 'brand_id'=>$brand->id]);
        $response = $this->get('api/category/17/brands');
        $response->assertOk();
        $response->assertJsonStructure(['brands']);
        $response->dump();
    }
    

    /** @test */
    public function testCreateProductWithBrandId()
    {
        $brand = factory(Brand::class)->create();
        $response = $this->post("api/category/17/product", array_merge($this->productData(), ['brand_id'=>$brand->id,'brand_name'=>$brand->name]));
        $response->assertOk();
        $response->assertJsonStructure(['product']);
        $this->assertCount(1, Product::all());
    }

    public function testCreateProductWithBrandName()
    {
        $brand = factory(Brand::class)->create();
        $response = $this->post("api/category/17/product", array_merge($this->productData(), ['brand_id'=>0, 'brand_name'=>'Coca-cola']));
        $response->assertOk();
        $response->assertJsonStructure(['product']);
        $this->assertCount(1, Product::all());
        $this->assertCount(2, Brand::all());
    }

    /** @test */
    public function testUploadProductPhoto()
    {
        Storage::fake('photos');
        $response = $this->post(
            "api/category/17/product",
            array_merge(
                $this->productData(),
                [
                    'brand_id'=>0,
                    'brand_name'=>'Coca-cola',
                    'photo'=>UploadedFile::fake()->image('photo1.jpg')
                ]
            )
        );
        $response->assertOk();
        $response->assertJsonStructure(['product']);
        $this->assertCount(1, Product::all());
        $this->assertCount(1, Brand::all());
        $this->assertCount(1, ProductPhoto::all());
    }

    /** @test */
    public function testProductUpdate()
    {
        $product = factory(Product::class)->create(['category_id'=>17]);
        $response = $this->put("api/category/17/product/{$product->id}", $this->productData());
        $response->assertOk();
        $this->assertEquals('Sprite', $product->fresh()->name);
        $this->assertCount(1, Product::all());
    }
    
    public function testDeleteProductPhoto()
    {
    }

    /** @test */
    public function testDeleteProduct()
    {
        factory(Product::class, 10)->create(['category_id'=>17]);
        $product =factory(Product::class)->create(['category_id'=>17]);

        $response = $this->delete("/api/category/17/product/{$product->id}");
        $response->assertStatus(200);
        $response->assertJsonStructure(['deleted']);
        $this->assertCount(10, Product::all());
    }
    
    
    private function productData()
    {
        return [
            'category_id'=>17,
            'name'=>'Sprite',
            'brand_id'=>1,
            'brand_name'=>'Vivant',
            'presentation'=>'2 litros',
            'price'=>1.8,
            'description'=>'Sprite de 2 litros no retornable'
        ];
    }
}
