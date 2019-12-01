<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

use App\PaymentMethod;
use App\Setting;
class SettingController extends Controller
{
    public function getPayment(){
        $payment_method = PaymentMethod::all();
        if(isset($payment_method)){
            $bank = json_decode($payment_method[0]->info);
            $qrStr = json_decode($payment_method[1]->info)->qr_str;

            $emailAccount = Setting::where('name','momo_email')->get();
            $emailAccount = json_decode($emailAccount[0]->value);

            $email = $emailAccount->email;
            $password = $emailAccount->password;
            return view('admin.settings.payments')->with(['qrStr'=>$qrStr,'bank'=>$bank,'email'=>$email,'password'=>$password]);
        }
    }
    public function postPayment(Request $request,$type = null){
        if($type != null){
            switch ($type) {
                case 'momoString':
                    $validator = Validator::make($request->except('_token'),[
                        'phone' => 'required',
                        'fullname' => 'required',
                        'email' => 'required|email:rfc,dns,filter,spoof',
                    ],[
                        'required' => ':attribute còn thiếu',
                    ]);
                    if(!$validator->fails()){
                        $phone = $request->phone;
                        $fullname = $request->fullname;
                        $email = $request->email;

                        $paymentMethodCount = PaymentMethod::where('type','momo')->count();
                        $json = json_encode(['qr_str'=>'2|99|'.$phone.'|'.$fullname.'|'.$email.'|0|0']);

                        if($paymentMethodCount != 1){
                            PaymentMethod::create(['type'=>'momo','info'=>$json]);
                        }
                        else{
                            PaymentMethod::where('type','momo')->update(['info'=>$json]);
                        }
                        return back()->with('success-momoString','Cập nhật thành công!');
                    }
                    else{
                        return back()->with('error-momoString',"Cập nhật thất bại!");
                    }
                    break;
                case 'momoAuto':
                    $validator = Validator::make($request->except('_token'),[
                        'email' => 'required|email',
                        'password' => 'required',
                    ],[
                        'required' => ':attribute còn thiếu',
                    ]);
                    if(!$validator->fails()){
                        $email = $request->email;
                        $password = $request->password;

                        $momoEmailCount = Setting::where('name','momo_email')->count();
                        $json = json_encode(['email'=>$email,'password'=>$password]);
                        if($momoEmailCount != 1){
                            Setting::create(['name'=>'momo_email','value'=>$json]);
                        }
                        else{
                            Setting::where('name','momo_email')->update(['name'=>'momo_email','value'=>$json]);
                        }

                        return back()->with('success-momoAuto','Cập nhật thành công!');
                    }
                    else{
                        return back()->with('error-momoAuto',"Cập nhật thất bại!");
                    }
                    break;
                case 'bank':
                    $validator = Validator::make($request->except('_token'),[
                        'fullname' => 'required',
                        'acc_num' => 'required',
                        'branch' => 'required',
                    ],[
                        'required' => ':attribute còn thiếu',
                    ]);
                    if(!$validator->fails()){
                        $fullname = $request->fullname;
                        $accNum = $request->acc_num;
                        $branch = $request->branch;
                        $paymentMethod = PaymentMethod::where('type','bank')->count();
                        $json = json_encode(['fullname'=>$fullname,'acc_num'=>$accNum,'branch'=>$branch]);
                        if($paymentMethod != 1){
                            PaymentMethod::create(['type'=>'bank','info'=>$json]);
                        }
                        else{
                            PaymentMethod::where('type','bank')->update(['info'=>$json]);
                        }
                        return back()->with('success-bank','Cập nhật thành công!');
                    }
                    else{
                        return back()->with('error-bank',"Cập nhật thất bại!");
                    }
                    break;
            }
        }
        else{
            return redirect()->route('admin.dashboard');
        }
    }
    public function getLogo(){
        $logo = Setting::where('name','logo')->get();
        if(0 != count($logo)){
            return view('admin.settings.logo')->with('logo',json_decode($logo[0]->value));
        }
        return view('admin.settings.logo')->with('logo','');
    }
    public function setLogo(Request $request){
        $validator = Validator::make($request->except('_token'),[
            'logo' => 'required'
        ]);
        if(!$validator->fails()){
            $counter = Setting::where('name','logo')->count();
            if($counter != 1){
                Setting::create(['name'=>'logo','value'=>json_encode($request->logo)]);
            }
            else{
                Setting::where(['name'=>'logo'])->update(['value'=>json_encode($request->logo)]);
            }
            return back()->with('success',"Cập nhật thành công!");
        }
        return back()->with('error',"Cập nhật thất bại!");

    }
}
