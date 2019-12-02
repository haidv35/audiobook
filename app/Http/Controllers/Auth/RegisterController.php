<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
        $rules = [
            'firstname' => ['required', 'string', 'max:30'],
            'lastname' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:10', 'unique:users'],
            'address' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $messages = [
            'username.*' => "Tài khoản đã tồn tại trong hệ thống vui lòng sử dụng tài khoản khác",
            'email.*' => "Email đã tồn tại trong hệ thống vui lòng sử dụng email khác",
            'phone.*' => "Số điện thoại đã tồn tại trong hệ thống vui lòng sử dụng sđt khác",
            'required' => 'Bạn chưa nhập :attribute.',
            'min' => 'Phải nhập tối thiểu :min kí tự.',
            'max' => 'Chỉ dược nhập tối đa :max kí tự.',
            'password.confirmed' => "2 mật khẩu không khớp"
        ];
        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['username'] == null){
            $email = explode('@', $data['email']);
            $data['username'] = $email[0];
        }
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' =>$data['phone'],
            'address' => $data['address'],
            'role' => 'user',
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
