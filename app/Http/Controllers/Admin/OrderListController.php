<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\OrderDetail;
use App\PaymentMethod;
use App\ProductConfigurable;
use App\User;

use Carbon\Carbon;

class OrderListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $ordered_at;
    protected $paid_at;
    protected $canceled_at;

    public function parseDateTime($ordered_at,$paid_at,$canceled_at){
        $this->ordered_at = Carbon::parse($ordered_at)->format("d/m/Y H:i:s");
        $this->paid_at = Carbon::parse($paid_at)->format("d/m/Y H:i:s");
        $this->canceled_at = Carbon::parse($canceled_at)->format("d/m/Y H:i:s");
    }

    public function orderListJson(){
        $data = array();
        $orders = json_decode(Order::all());
        foreach($orders as $order){
            $order->username = User::find($order->user_id)->username;
            $order->fullname = User::find($order->user_id)->firstname . " " . User::find($order->user_id)->lastname;
            $order->email = User::find($order->user_id)->email;
            $this->parseDateTime($order->ordered_at,$order->paid_at,$order->canceled_at);
            $order->ordered_at = $this->ordered_at;
            $order->paid_at = $this->paid_at;
            $order->canceled_at = $this->canceled_at;
            if($order->payment_method_id != null){
                $payment_method = Order::find($order->id)->payment_method;
                $order->payment_method = strtoupper($payment_method->type);
            }
            else{
                $payment_method = Order::find($order->id)->payment_method;
                $order->payment_method = '';
            }
        }
        $data['data'] = $orders;
        return $data;
    }

    public function index($order_id = null)
    {
        if($order_id == null){
            return view('admin.orders.order-list');
        }
        else{
            $order_detail = OrderDetail::with('product')->where('order_id',$order_id)->get();
            foreach($order_detail as $key => $item){
                // $configurableProduct = Product::where([['id',$item->product_id],['type','simple']])->first();
                // if(isset($configurableProduct)){
                //     unset($order_detail[$key]);
                // }
                $configurableProduct = ProductConfigurable::where('product_simple_id',$item->product_id)->get();
                foreach($configurableProduct as $simpleProduct){
                    if($item->product_id == $simpleProduct->product_simple_id){
                        unset($order_detail[$key]);
                    }
                }
            }
            $this->convertToVnString($order_detail);


            $order = Order::find($order_id);
            $payment_method = PaymentMethod::all();
            $this->parseDateTime($order->ordered_at,$order->paid_at,$order->canceled_at);
            $order->username = User::find($order->user_id)->username;
            $order->fullname = User::find($order->user_id)->firstname . " " . User::find($order->user_id)->lastname;
            $order->email = User::find($order->user_id)->email;
            $order->ordered_at = $this->ordered_at;
            $order->paid_at = $this->paid_at;
            $order->canceled_at = $this->canceled_at;

            return view('admin.orders.order-details')->with(['order'=>$order,'order_detail'=>$order_detail,'payment_method'=>$payment_method]);
        }
    }

    public function edit(Request $request)
    {
        if($request->status == 'paid'){
            if($request->paid == 0){
                return $this->display_response(404,"Chưa nhập số tiền cần thanh toán!");
            }
            if($request->payment_method_id == 0){
                return $this->display_response(404,"Chưa nhập phương thức thanh toán!");
            }
            $request->merge(['paid_at'=>Carbon::now()->setTimezone('Asia/Ho_Chi_Minh'),'canceled_at'=>Carbon::minValue()]);
            $order = Order::where('id',$request->id)->update($request->only(['payment_method_id','status','paid','paid_at','canceled_at']));
        }
        else if($request->status == 'canceled'){
            $request->merge(['canceled_at'=>Carbon::now()->setTimezone('Asia/Ho_Chi_Minh'),'payment_method_id'=>NULL,'paid_at'=>Carbon::minValue()]);
            $order = Order::where('id',$request->id)->update($request->only(['status','canceled_at','payment_method_id','paid_at']));
        }
        else if($request->status == 'unpaid'){
            $request->merge(['canceled_at'=>Carbon::minValue(),'payment_method_id'=>NULL,'paid_at'=>Carbon::minValue(),'paid'=>0]);
            $order = Order::where('id',$request->id)->update($request->only(['paid','status','canceled_at','payment_method_id','paid_at']));
        }
        else{
            $request->merge(['paid_at'=>Carbon::minValue(),'payment_method_id'=>NULL]);
            $order = Order::where('id',$request->id)->update($request->only(['status','paid','paid_at','payment_method_id']));
        }

        if($order == true){
            return $this->display_response(200,"Cập nhật đơn hàng thành công!");
        }
        else{
            return $this->display_response(404,"Có lỗi xảy ra!");
        }
    }
}
