<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\MobileNumber;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
       
    
        $validator =  Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address_line_1' => ['required', 'string'],
            'address_line_2' => ['string'],
            'region' => ['required', 'string'],
            'province' => ['required', 'string'],
            'city_municipality' => ['required', 'string'],
            'mobile_number' => ['required', 'numeric', 'digits:11'],
            'postal_code' => ['required', 'numeric'],
        ]);

        //dd($validator->errors());

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


        Address::create([
            'user_id' => $user->id,
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
            'region' => $data['region'],
            'province' => $data['province'],
            'city_municipality' => $data['city_municipality'],
            'postal_code' => $data['postal_code'],
        ]);

        MobileNumber::create([
            'user_id' => $user->id,
            'mobile_number' => $data['mobile_number']
        ]);


        return $user;
    }
}
