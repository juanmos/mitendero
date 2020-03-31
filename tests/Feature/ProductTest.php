<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

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
        $this->withoutExceptionHandling();
        factory(Product::class, 10)->create(['category_id'=>17]);
        $response = $this->get('/api/category/17/products');
        $response->assertStatus(200);
        $response->assertJsonStructure(['products']);
        $response->assertJsonCount(6, 'products.data');
    }
}
