<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Session;
use Illuminate\Support\Facades\Validator;

class SocialController extends Controller
{
    private $getInfo;
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function getInfo($provider){
        $this->getInfo = Socialite::driver($provider)->user();
        if($this->getInfo != null){
            $fullname = explode(' ',$this->getInfo->name);
            $this->getInfo->firstname = $fullname[0];
            $this->getInfo->lastname = $fullname[1];
        }
    }
    public function callback($provider)
    {
        $this->getInfo($provider);
        $user = User::where('fb_id', $this->getInfo->id)->first();
        Session::put('getInfo',$this->getInfo);
        if(!$user){
            return view('auth.facebook')->with('getInfo',$this->getInfo);
        }
        else{
            auth()->login($user);
            return redirect()->to('/');
        }
    }
    public function facebookLogin(Request $request){
        // $provider = 'facebook';
        $sessionInfo = Session::get('getInfo');
        $validator = Validator::make($request->except('_token'),[
            'phone' => ['required', 'string', 'min:10', 'unique:users'],
            'address' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'username.*' => "Tài khoản đã tồn tại trong hệ thống vui lòng sử dụng tài khoản khác",
            'phone.*' => "Số điện thoại đã tồn tại trong hệ thống vui lòng sử dụng sđt khác",
            'required' => 'Bạn chưa nhập :attribute.',
            'min' => 'Phải nhập tối thiểu :min kí tự.',
            'max' => 'Chỉ dược nhập tối đa :max kí tự.',
            'password.confirmed' => "2 mật khẩu không khớp"
        ]);
        if(!$validator->fails()){
            if($request->password_confirmation == $request->password){
                $request->merge([
                    'firstname'=>$sessionInfo->firstname,
                    'lastname'=>$sessionInfo->lastname,
                    'email'=>$sessionInfo->email,
                    'fb_id'=>$sessionInfo->id,
                    'password'=>bcrypt($request->password),
                    'role'=>'user'
                ]);
                $user = User::create($request->except('_token','password_confirmation'));
                auth()->login($user);
                return $this->display_response(200,"Đăng nhập thành công!");
            }
        }
        else{
            return $this->display_response(404,$validator->errors());
        }
    }
    // function createUser($getInfo, $provider)
    // {
    //     $user = User::where('fb_id', $getInfo->id)->first();
    //     if($getInfo != null){
    //         $fullname = explode(' ',$getInfo->name);
    //     }
    //     if (!$user) {
    //         $user = User::create([
    //             'firstname' => $fullname[0],
    //             'lastname'  => $fullname[1],
    //             'email'    => $getInfo->email,
    //             'provider' => $provider,
    //             'provider_id' => $getInfo->id
    //         ]);
    //     }
    //     return $user;
    // }
}
