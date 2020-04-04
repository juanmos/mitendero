<?php

namespace Tests\Feature\Company;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Brand;
use App\Models\Company;
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
        $company = factory(Company::class)->create();
        $user = factory(User::class)->create([
            'company_id'=>$company->id
        ]);
        $token = auth()->guard('api')
            ->login($user);
        $this->headers['Authorization'] = 'Bearer ' . $token;
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProductInCompanyEmpty()
    {
        factory(Product::class, 10)->create(['category_id'=>17]);
        $response = $this->get('api/my/product/1');
        $response->assertStatus(200);
        $response->assertJsonStructure(['product_company']);
    }

    /** @test */
    public function testSetProductInCompnay()
    {
        $product = factory(Product::class)->create(['category_id'=>17]);
        $response = $this->post("api/my/product/{$product->id}");
        $response->assertOk();
        $response->assertJsonStructure(['product_company']);
        $this->assertCount(1, $product->fresh()->company()->get());
    }

    /** @test */
    public function testRemoveProductInCompany()
    {
        $product = factory(Product::class)->create(['category_id'=>17]);
        $response = $this->post("api/my/product/{$product->id}");
        $this->assertCount(1, $product->fresh()->company()->get());
        $response = $this->delete("api/my/product/{$product->id}");
        $response->assertOk();
        $this->assertCount(0, $product->fresh()->company()->get());
    }
}
