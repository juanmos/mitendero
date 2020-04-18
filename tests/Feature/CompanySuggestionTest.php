<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use CompanyTypeSeeder;
use UserSeeder;

class CompanySuggestionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->seed(CompanyTypeSeeder::class);
    }
    
    public function testNewSuggestion()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('api/company/suggestion', [
            'company_type_id'=> 1,
            'company_name'=> "Alguna",
            'address'=> "asdsa asdosaoda",
            'email'=> "no@jspo.com",
            'phone'=> "8989as",
            'contact'=> "sadsadas"
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['company']);
    }
}
