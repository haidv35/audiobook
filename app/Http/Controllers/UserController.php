<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

use App\User;
use App\Order;
use App\OrderDetail;
use App\PaymentMethod;
use App\PaymentCode;
use App\Product;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paid_orders = Order::with('order_details')->where(['user_id'=>Auth::id(),'status'=>'paid'])->get();
        $orders = Order::where(['user_id'=>Auth::id()])->get();
        $paid_order_count = Order::where('user_id',Auth::id())->count();
        $paid_product_count = 0; $paid = 0; $total = 0; $balance = 0;
        foreach($paid_orders as $key => $value){
            $paid_product_count += $value->order_details->count();
            $paid += $value->paid;
        }
        foreach($orders as $key => $value){
            $total += $value->amount;
        }
        $balance = $total - $paid;
        return view('user.dashboard')->with(['paid_order_count'=>$paid_order_count,'paid_product_count'=>$paid_product_count,'paid'=>$paid,'balance'=>$balance]);
    }

    public function getProfile(){
        $user = User::find(Auth::id());
        return view('user.profile')->with('user',$user);
    }
    public function postProfile(Request $request){
        $validator = Validator::make($request->except('_token'),[
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
            'username' => 'unique:users',
            'old_password' => 'required',
        ],[
            'firstname.required' => 'Bạn chưa nhập họ!',
            'lastname.required' => 'Bạn chưa nhập tên!',
            'phone.required' => 'Bạn chưa nhập số điện thoại!',
            'address.required' => 'Bạn chưa nhập địa chỉ!',
            'email.required' => 'Bạn chưa nhập email!',
            'old_password.required' => 'Bạn chưa nhập mật khẩu!',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $user = User::find(Auth::id());
        if(Hash::check($request->old_password, $user->password)){
            if($request->password == ''){
                if($request->fb_id == null){
                    $request->merge(['fb_id' => 0]);
                }
                User::where('id',Auth::id())->update($request->except(['_token','username','password','old_password']));
            }
            else{
                $request->merge(['password'=>bcrypt($request->password)]);
                // dd($request->all());
                User::where('id',Auth::id())->update($request->except(['_token','username','old_password']));
            }
            return back()->with('success','Cập nhật thành công!');
        }
        else{
            return back()->with('not_match',"Mật khẩu bạn nhập vào không đúng!");
        }
    }

    public function getOrder($order_code = null){
        if($order_code === null){
            $orders = Order::where(['user_id'=>Auth::id()])->paginate(10);
            return view('user.orders')->with(['orders'=>$orders]);
        }
        else{
            $payment_methods = PaymentMethod::all();
            $bank = json_decode($payment_methods[0]->info);
            $momo = json_decode($payment_methods[1]->info);
            $orders = Order::where(['user_id'=>Auth::id(),'order_code'=>$order_code])->get();
            if(0 === count($orders)){
                return redirect()->route('user.homepage');
            }
            $orders = $orders[0];
            $order_details = OrderDetail::where('order_id',$orders->id)->get();
            $amount = $orders->amount - $orders->paid;
            $payment_codes = PaymentCode::where(['user_id'=>Auth::id(),'order_id'=>$orders->id])->get();
            $order_detail_items = Order::find($orders->id)->order_details;
            return view('user.order-details')->with(['status'=>$orders->status,'order_detail_items'=>$order_detail_items,'bank'=>$bank,'momo'=>$momo,'payment_codes'=>$payment_codes,'amount'=>$amount]);
        }
    }

    public function getItemPurchasedJson(){
        $list_items_purchased = collect();
        $orders = Order::where(['user_id'=>Auth::id(),'status'=>'paid'])->get();
        foreach($orders as $order){
            foreach($order->order_details as $order_detail){
                $list_items_purchased->add($order_detail->product);
            }
        }
        $data['data'] = $list_items_purchased;
        return json_encode($data);
    }

    public function getListItemPurchased($product_id = null){
        $list_items_purchased = collect();
        $orders = Order::where(['user_id'=>Auth::id(),'status'=>'paid'])->get();
        foreach($orders as $order){
            foreach($order->order_details as $order_detail){
                $list_items_purchased->add($order_detail->product);
            }
        }
        if($product_id === null){
            return view('user.purchased')->with(['list_items_purchased'=>$list_items_purchased]);
        }
        else{
            foreach($list_items_purchased as $item){
                if(strval($item->id) === $product_id){
                    $product_links = $item->product_links;
                    return view('user.items-purchased')->with(['product_info'=>$item,'product_links'=>$product_links]);
                }
            }
            return redirect()->route('user.homepage');
        }
    }

}