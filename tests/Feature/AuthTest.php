<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;
use App\Models\User;
use UserSeeder;
use Config;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    protected $headers;

    public function setUp():void
    {
        parent::setUp();
        factory(User::class)->create([
            'email'    => 'test@email.com',
            'password' => bcrypt('123456')
        ]);
        $token = auth()->guard('api')
            ->login(User::first());
        $this->headers['Authorization'] = 'Bearer ' . $token;
        $this->headers['Accept']="application/json";
        $this->seed(UserSeeder::class);
        Event::fake();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginUser()
    {
        $response = $this->post('api/auth/login', [
            'email'    => 'test@email.com',
            'password' => '123456'
        ]);

        $response->assertJsonStructure([
            'token',
            'token_type',
            'expires_in'
        ]);
        $this->assertAuthenticated('api');
    }

    /** @test */
    public function testUserNotFound()
    {
        $response = $this->post('api/auth/login', [
            'email'    => 'tet@email.com',
            'password' => '123456'
        ]);
        $response->assertJsonStructure([
            'error'
        ]);
        
        $response->assertJsonFragment(['error'=>'Unauthorized']);
    }

    /** @test */
    public function testRegisterNewUser()
    {
        $response = $this->post('/api/auth/signup/comercio', [
            'last_name'  =>  'Moscoso',
            'email'     =>  'test31@email.com',
            'password'  =>  '123456',
            'password_confirmation' => '123456',
            'first_name'    =>  "Juan",
        ]);
        $response->assertJsonStructure([
            'token',
            'token_type',
            'expires_in'
        ]);
        $this->assertAuthenticated('api');
        Event::assertDispatched(Registered::class);
    }

    /** @test */
    public function testGetLogginUserData()
    {
        $this->actingAs(User::first(), 'api');
        $response = $this->get('/api/auth/me', $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['user']);
    }

    /** @test */
    public function testVerifyUser()
    {
        // $this->withoutExceptionHandling();

        $this->actingAs(User::first(), 'api');
        $user = factory(User::class)->create([
            'email'    => 'testing@email.com',
            'password' => bcrypt('123456'),
            'email_verified_at'=>null
        ]);
        $token = auth()->guard('api')
            ->login($user);
        $this->headers['Authorization'] = 'Bearer ' . $token;
        $this->headers['Accept']="application/json";
        
        $url =URL::temporarySignedRoute(
            'verify',
            now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );
        $response = $this->get($url, $this->headers);
        $this->assertNotNull($user->fresh()->email_verified_at);
        $response->assertJsonFragment(['status'=>1]);
        Event::assertDispatched(Verified::class);
    }

    public function testAlreadyVerifyUser()
    {
        $this->actingAs(User::first(), 'api');
        $user = factory(User::class)->create([
            'email'    => 'testing@email.com',
            'password' => bcrypt('123456')
        ]);
        $token = auth()->guard('api')
            ->login($user);
        $this->headers['Authorization'] = 'Bearer ' . $token;
        $this->headers['Accept']="application/json";
        
        $url =URL::temporarySignedRoute(
            'verify',
            now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );
        $response = $this->get($url, $this->headers);
        $response->assertJsonFragment(['status'=>2]);
        Event::assertNotDispatched(Verified::class);
    }

    /** @test */
    public function testResendVerificationEmail()
    {
        Notification::fake();
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create([
            'email'    => 'testing@email.com',
            'password' => bcrypt('123456'),
            'email_verified_at'=>null
        ]);
        $token = auth()->guard('api')
            ->login($user);
        $this->headers['Authorization'] = 'Bearer ' . $token;
        $this->headers['Accept']="application/json";
        $response = $this->get('/api/auth/verify/resend', $this->headers);
        $response->assertStatus(202);
        Notification::assertSentTo(
            $user,
            VerifyEmail::class
        );
    }
}
