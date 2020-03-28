<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use App\Events\CompanyVerificationPendingEvent;
use App\Events\NewCompanyEvent;
use Tests\TestCase;
use App\Models\Company;
use App\Models\User;
use UserSeeder;
use CompanyTypeSeeder;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    protected $headers;

    public function setUp():void
    {
        parent::setUp();
        $this->seed();

        factory(User::class)->create([
            'email'    => 'test@email.com',
            'password' => bcrypt('123456'),
            'company_id'=>factory(Company::class)
        ]);
        $token = auth()->guard('api')
            ->login(User::first());
        $this->headers['Authorization'] = 'Bearer ' . $token;
        Event::fake();
    }

    /** @test */
    public function testCompanyTypes()
    {
        $response= $this->get('api/companies/types', $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['companyTypes']);
    }
    
    
    /** @test */
    public function testCompanyList()
    {
        $user = User::first();
        $response=$this->get('/api/companies', $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['companies']);

        $token = auth()->guard('api')
            ->login(User::find(2));
        $this->headers['Authorization'] = 'Bearer ' . $token;

        $response=$this->get('/api/companies', $this->headers);
        $response->assertForbidden();
    }
    
    /** @test */
    public function testCreateCompany()
    {
        $this->withoutExceptionHandling();
        $response=$this->post('/api/company', $this->companyData(), $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['company']);
        Event::assertNotDispatched(NewCompanyEvent::class);

        $user=User::find(2);
        $user->company_id=1;
        $user->save();
        $token = auth()->guard('api')
            ->login($user);
        $this->headers['Authorization'] = 'Bearer ' . $token;

        $response=$this->post('/api/company', $this->companyData(), $this->headers);
        
        $response->assertForbidden();
        Event::assertNotDispatched(NewCompanyEvent::class);
    }

    public function testCreateNewUserCompany()
    {
        $this->withoutExceptionHandling([]);
        $user=factory(User::class)->create([
            'email'    => 'testing@email.com',
            'password' => bcrypt('123456'),
            'company_id'=>0
        ]);
        $user->assignRole('Comercio');

        $token = auth()->guard('api')
            ->login($user);
        $this->headers['Authorization'] = 'Bearer ' . $token;
        $response=$this->post('/api/company', $this->companyData(), $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['company']);
        $this->assertNotEquals(0, $user->fresh()->company_id);
        Event::assertDispatched(NewCompanyEvent::class);
    }

    /** @test */
    public function testUpdateCompanyAdmin()
    {
        $company = Company::first();
        $response=$this->put('api/company/'.$company->id, $this->companyData(), $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['updated','company']);
        $this->assertEquals('Company name', $company->fresh()->company_name);
    }
    
    /** @test */
    public function testUpdateMyCompany()
    {
        $user=factory(User::class)->create([
            'email'    => 'testing@email.com',
            'password' => bcrypt('123456'),
            'company_id'=>factory(Company::class)
        ]);
        $user->assignRole('Comercio');

        $token = auth()->guard('api')
            ->login($user);
        $this->headers['Authorization'] = 'Bearer ' . $token;
        $response=$this->put('api/company/'.$user->company->id, $this->companyData(), $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['updated','company']);

        $this->assertEquals('Company name', $user->fresh()->company->company_name);
    }

    public function testUpdateOtherCompany()
    {
        $user=factory(User::class)->create([
            'email'    => 'testing@email.com',
            'password' => bcrypt('123456'),
            'company_id'=>factory(Company::class)
        ]);
        $user->assignRole('Comercio');

        $token = auth()->guard('api')
            ->login($user);
        $this->headers['Authorization'] = 'Bearer ' . $token;
        $response=$this->put('api/company/1', $this->companyData(), $this->headers);
        $response->assertForbidden();
    }
    

    public function testUpdateProfile()
    {
        $user = User::first();
        $this->actingAs($user, 'api');
        $response = $this->put('/api/profile/user', [
            'first_name'=>'Juanes',
            'last_name'=>'Perez'
        ], $this->headers);
        $response->assertOk();
        $response->assertJson(['updated'=>true]);
        $this->assertEquals('Juanes', $user->fresh()->first_name);
    }

    /** @test */
    public function testGetCompanyUsers()
    {
        $company = factory(Company::class)->create();
        factory(User::class, 10)->create([
            'company_id'=>$company->id
        ]);
        $response = $this->get('api/company/'.$company->id.'/users');
        $response->assertOk();
        $response->assertJsonStructure(['users']);
        $response->assertJsonCount(10, 'users');
    }
    
    /** @test */
    public function testChangeCompanyStatus()
    {
        $this->withoutExceptionHandling();
        $user=factory(User::class)->create([
            'email'    => 'testing@email.com',
            'password' => bcrypt('123456'),
            'company_id'=>factory(Company::class)
        ]);
        $user->assignRole('Comercio');

        $token = auth()->guard('api')
            ->login($user);
        $this->headers['Authorization'] = 'Bearer ' . $token;
        $response=$this->put("api/company/{$user->company->id}/status/2", [], $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['company']);

        $this->assertEquals(2, $user->fresh()->company->status_id);
        Event::assertDispatched(CompanyVerificationPendingEvent::class);
    }


    private function companyData()
    {
        return [
            'company_name'=>'Company name',
            'company_alias'=>'Company alias',
            'ruc'=>'0990909900',
        ];
    }
}
