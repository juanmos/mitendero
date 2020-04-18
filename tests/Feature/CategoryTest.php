<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CategoryTest extends TestCase
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
    public function testCategoryList()
    {
        $response = $this->get('/api/categories', $this->headers);
        $response->assertStatus(200);
        $response->assertJsonStructure(['categories']);
    }

    /** @test */
    public function testGetCategoryShow()
    {
        $response = $this->get("api/category/1", $this->headers);
        $response->assertStatus(200);
        $response->assertJsonStructure(['category']);
    }
}
