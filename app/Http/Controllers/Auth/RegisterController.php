<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:30'],
            'user_name' => ['required', 'string', 'max:30', 'unique:users,user_name'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'unique:users,phone'],
            'city' => ['nullable', 'string', 'max:30'],
            'country' => ['nullable', 'string', 'max:30'],
            'street' => ['nullable', 'string', 'max:30'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_name' => $data['user_name'],
            'phone' => $data['phone'],
            'city' => $data['city'],
            'country' => $data['country'],
            'street' => $data['street'],
        ]);
        if(!empty($data['image'])){
            $file = $data['image'];
            $newImageName = $user->id . time() .'.' .$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/users',$newImageName,['disk' => 'store']);
            $user->update(
                ['image' => $path]
            );
        }
        return $user;
    }

    public function registered(Request $request)
    {
        Session::flash('success', 'You have registered successfully');
    }

}
