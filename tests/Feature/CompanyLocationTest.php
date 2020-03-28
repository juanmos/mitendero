<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Company;
use App\Models\User;
use UserSeeder;
use CompanyTypeSeeder;

class CompanyLocationTest extends TestCase
{
    use RefreshDatabase;
    protected $headers;
    protected $user;

    public function setUp():void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->seed(CompanyTypeSeeder::class);

        $user =factory(User::class)->create([
            'email'    => 'test@email.com',
            'password' => bcrypt('123456'),
            'company_id'=>factory(Company::class)
        ]);
        $user->assignRole('Comercio');
        $token = auth()->guard('api')
            ->login($user);
        $this->user=$user;
        $this->headers['Authorization'] = 'Bearer ' . $token;
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNewCompanyLocation()
    {
        $this->withoutExceptionHandling();
        $response=$this->post("api/company/{$this->user->company->id}/location/", $this->companyLocationData(), $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['created','company']);
        $this->assertCount(1, $this->user->fresh()->company->locations()->get());
    }

    private function companyLocationData()
    {
        return [
            'address'=>'Calle del tejar',
            'phone'=>'09900999',
            'lat'=>-2.0990909900,
            'lng'=>-78.092302939
        ];
    }
}
