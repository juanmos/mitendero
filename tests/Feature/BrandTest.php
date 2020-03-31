<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Brand;
use App\Models\User;

class BrandTest extends TestCase
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
    public function testBrandList()
    {
        factory(Brand::class, 15)->create();
        $response = $this->get('/api/brands');
        $response->assertStatus(200);
        $response->assertJsonStructure(['brands']);
        $response->assertJsonCount(15, 'brands');
    }

    /** @test */
    public function testCreateBrand()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/brand', $this->brandData());
        $response->assertOk();
        $response->assertJsonFragment(['created'=>true]);
        $this->assertCount(1, Brand::all());
    }

    /** @test */
    public function testUpdateBrand()
    {
        $brand=factory(Brand::class)->create();
        $response = $this->put("/api/brand/{$brand->id}", $this->brandData());
        $response->assertOk();
        $response->assertJsonStructure(['brand']);
        $this->assertCount(1, Brand::all());
        $this->assertEquals('Coca-Cola', $brand->fresh()->name);
    }
    


    private function brandData()
    {
        return [
            'name'=>'Coca-Cola'
        ];
    }
}
