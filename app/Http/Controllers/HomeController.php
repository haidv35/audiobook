<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Order;
use App\OrderDetail;
use App\PaymentMethod;
use App\PaymentCode;
use App\Setting;
use Carbon\Carbon;

class HomeController extends Controller
{
    private $orderedProducts;
    private $orders;
    private $searchProduct;

    public function __construct()
    {
        parent::__construct();
        $this->searchProduct();
    }
    //Initial function
/****************************************************/
    public function getUserOrderedProducts(){
        $this->orderedProducts = collect();
        if(Auth::check()){
            $this->orders = Order::where(['user_id'=>Auth::id(),'status'=>'paid'])->orWhere('status','unpaid')->orWhere('status','processing')->get();
            foreach($this->orders as $orderValue){
                //add status to product
                $orderDetail = OrderDetail::where(['order_id'=>$orderValue->id])->get();
                $orderDetail = json_decode($orderDetail);
                foreach($orderDetail as $orderDetailValue){
                    $orderDetailValue->status = $orderValue->status;
                    $orderDetailValue->order_code = $orderValue->order_code;
                }
                $this->orderedProducts->add($orderDetail);
            };
        }
    }
    public function getProductsByType($type){
        return Product::where($type,1)->latest()->limit(8)->get();
    }
    public function searchProduct(){
        if(request()->has('s')){
            $this->searchProduct = Product::where('title','LIKE',"%".request()->get('s')."%")->get();
        }
        else{
            $this->searchProduct = NULL;
        }
    }
/*****************************************************/

    //Homepage
    public function index()
    {
        $this->getUserOrderedProducts();
        $demoLinks = Product::where('demo_link','!=','0')->orWhere('demo_link','!=',NULL)->limit(2)->inRandomOrder()->get();
        $newProduct = $this->getProductsByType('new_product');
        $hotProduct = $this->getProductsByType('hot_product');
        $recommendProduct = Product::limit(8)->inRandomOrder()->get();
        return view('home.home')->with(['demoLinks'=>$demoLinks,'searchProduct'=>$this->searchProduct,'newProduct'=>$newProduct,'hotProduct'=>$hotProduct,'recommendProduct'=>$recommendProduct,'orderedProducts'=>$this->orderedProducts]);
    }

    public function search(){
        $this->getUserOrderedProducts();
        return view('home.search')->with(['orderedProducts'=>$this->orderedProducts,'searchProduct'=>$this->searchProduct]);
    }

    //Page
    public function page($page_name){
        $page = Setting::where('name',$page_name)->get('value');
        return view('home.'.$page_name)->with(['page'=>(!empty(json_decode($page,true))) ? json_decode($page[0]->value) : null]);
    }
    public function about(){
        return $this->page('about');
    }
    public function tutorial(){
        return $this->page('tutorial');
    }
    public function contact(){
        return $this->page('contact');
    }

    //Product
    public function displayAllProduct(){
        $this->getUserOrderedProducts();
        if(request()->get('sort') != null && Schema::hasColumn('products',request()->get('sort'))) {
            $getAllProduct = Product::orderBy(request()->get('sort'),'desc')->paginate(5);
        }
        else{
            $getAllProduct = Product::paginate(5);
        }
        return view('home.product.all-product')->with(['getAllProduct'=>$getAllProduct,'orderedProducts'=>$this->orderedProducts,'check'=>0]);
    }

    public function productDetail($id = null){
        $this->getUserOrderedProducts();
        $getProductById = Product::with('category')->find($id);
        $recommendProduct = Product::limit(4)->inRandomOrder()->get();
        if($id == null || $getProductById == null) return redirect()->route('homepage');
        else{
            return view('home.product.product-details')->with(['product'=>$getProductById,'orderedProducts'=>$this->orderedProducts,'recommendProduct'=>$recommendProduct]);
        }
    }

    //Cart
    public function displayCart(){
        return view('home.cart.cart')->with([]);
    }

    public function getCheckout($userId = null,$user = null){
        if(Auth::user()->id === intval($userId) && Auth::user()->username === $user){
            return view('home.cart.checkout')->with([]);
        }
        return redirect()->route('homepage');
    }
    public function postCheckout(Request $request){
        $carts = json_decode($request->getContent());
        // $orderedList = collect();
        // //Get item purchased
        // $orders = Order::where(['user_id'=>Auth::id(),'status'=>'paid'])->get();
        // foreach($orders as $order){
        //     foreach($order->order_details as $orderDetail){
        //         $orderedList->add($orderDetail);
        //     }
        // }
        // //item purchased => display errors
        // foreach($orderedList as $item){
        //     foreach($carts as $cart){
        //         if($cart->id == $item->id){
        //             return $this->display_response("999","Don't exploit!!!");
        //         }
        //     }
        // }

        //save cart
        $amount = 0;
        foreach ($carts as $key => $cart) {
            $amount += $cart->price;
        }
        $orders = Order::create(['user_id'=>Auth::id(),'status'=>'unpaid','order_code'=>'0','amount'=>$amount,'paid'=>0,'ordered_at'=>Carbon::now()->setTimezone('Asia/Ho_Chi_Minh'),'paid_at'=>Carbon::minValue(),'canceled_at'=>Carbon::minValue()]);
        $order_code = 'D' .Carbon::now()->isoformat('DD') . Carbon::now()->isoformat('MM') . Carbon::now()->isoformat('YY') . substr(strtoupper(hash('md5',hash('sha256',$orders->id))),rand(0,28),4);
        Order::where('id',$orders->id)->update(['order_code'=>$order_code]);
        foreach ($carts as $key => $cart) {
            OrderDetail::create(['order_id'=>$orders->id,'product_id'=>$cart->id,'title'=>$cart->title,'category'=>$cart->category,'regular_price'=>$cart->regular_price,'discount_price'=>$cart->discount_price,'price'=>$cart->price,'promo_code_id'=>null]);
        }
        PaymentCode::create(['order_id'=>$orders->id,'user_id'=>Auth::id(),'payment_method_id'=>1,'code'=>'BANK'.$order_code]);
        PaymentCode::create(['order_id'=>$orders->id,'user_id'=>Auth::id(),'payment_method_id'=>1,'code'=>'MOMO'.$order_code]);
        return response()->json([
            'status' => 200,
            'message' => "Đặt hàng thành công",
            'redirect_url' => '/pay/'.$order_code
        ]);
    }

    //Pay
    public function getPay($orderCode = null){
        $orders = Order::where(['user_id'=>Auth::id()])->paginate(10);
        if($orderCode == null){
            return back();
        }
        else{
            $orders = Order::where(['user_id'=>Auth::id(),'order_code'=>$orderCode])->get();
            if(0 == count($orders)){
                return redirect()->route('homepage');
            }
            $orders = $orders[0];
            if($orders->amount == $orders->paid && $orders->status == 'paid'){
                return redirect()->route('user.orders');
            }
            else{
                $paymentMethods = PaymentMethod::all();
                $bank = json_decode($paymentMethods[0]->info);
                $momo = json_decode($paymentMethods[1]->info);

                $orderDetails = OrderDetail::where('order_id',$orders->id)->get();

                $amount = $orders->amount;
                $paymentCodes = PaymentCode::where(['user_id'=>Auth::id(),'order_id'=>$orders->id])->get();
                $orderDetailItems = Order::find($orders->id)->order_details;
                return view('home.cart.pay')->with(['orderDetailItems'=>$orderDetailItems,'bank'=>$bank,'momo'=>$momo,'paymentCodes'=>$paymentCodes,'amount'=>$amount]);
            }
        }
    }
}
