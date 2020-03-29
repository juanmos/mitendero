<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Gravatar;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user= User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'first_login'=>1
        ]);
        // $user->sendApiEmailVerificationNotification();
        return $user;
    }

    public function register(Request $request, $type = 'Usuario')
    {
        try {
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed']
            ]);
        } catch (\Illuminate\Validate\ValidationException $e) {
            $arrError = $e->errors(); // Useful method - thank you Laravel
            foreach ($arrValid as $key=>$value) {
                $arrImplode[] = implode(', ', $arrError[$key]);
            }
            $message = implode(', ', $arrImplode);
            $arrResponse = array(
                'result' => 0,
                'reason' => $message,
                'data' => array(),
                'statusCode' => $e->status,
            );
            return response()->json($arrResponse);
        } catch (\Exception $ex) {
            $arrResponse = array(
                'result' => 0,
                'reason' => $ex->getMessage(),
                'data' => array(),
                'statusCode' => 404
            );
            return response()->json($arrResponse);
        }
        event(new Registered($user = $this->create($request->all())));
        $user->assignRole(($type=='comercio')?'Comercio':'Usuario');
        $user->photo= Gravatar::get($user->email);
        $user->save();

        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
