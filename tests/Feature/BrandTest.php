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


    private function brandData()
    {
        return [
            'name'=>'Coca-Cola'
        ];
    }
}
