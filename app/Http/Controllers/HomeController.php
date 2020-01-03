<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ProductConfigurable;
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

    function getUserOrderedProducts($user_id)
    {
        $this->orderedProducts = collect();
        $this->orders = Order::where([['user_id',$user_id],['status','!=', 'canceled']])->get();

        foreach ($this->orders as $orderValue) {
            //add status to product
            $orderDetail = OrderDetail::where('order_id' , $orderValue->id)->get();
            foreach($orderDetail as $orderDetailValue){
                $orderDetailValue->status = $orderValue->status;
                $orderDetailValue->order_code = $orderValue->order_code;
                $this->orderedProducts->add($orderDetailValue);
            }
        };
        $this->orderedProducts = $this->orderedProducts->unique('product_id');
    }
    public function getProductsByType($type)
    {
        return Product::where([['type','simple'],[$type, 1]])->latest()->limit(8)->get();
    }
    public function searchProduct()
    {
        if (request()->has('s')) {
            $this->searchProduct = Product::where('title', 'LIKE', "%" . request()->get('s') . "%")->get();
        } else {
            $this->searchProduct = NULL;
        }
    }


/*****************************************************/

    //Homepage
    public function index()
    {
        $this->getUserOrderedProducts(Auth::id());
        $product_count = Product::where('type','simple')->count();
        $demoLinks_count = Product::where([['type','simple'],['demo_link', '!=', '0']])->count();
        if($product_count > 8) $product_count = 8;
        if($demoLinks_count > 2) $demoLinks_count = 2;
        $demoLinks = Product::where([['type','simple'],['demo_link', '!=', '0']])->take(300)->get()->random(2);
        $newProduct = $this->getProductsByType('new_product');
        $hotProduct = $this->getProductsByType('hot_product');
        $recommendProduct = Product::where('type','simple')->take(300)->get()->random($product_count);

        $configurableProduct = Product::where('type','configurable')->get();

        $this->convertToVnString($demoLinks);
        $this->convertToVnString($newProduct);
        $this->convertToVnString($hotProduct);
        $this->convertToVnString($recommendProduct);
        $this->convertToVnString($configurableProduct);
        return view('home.home')->with(['demoLinks' => $demoLinks, 'newProduct' => $newProduct, 'hotProduct' => $hotProduct, 'recommendProduct' => $recommendProduct, 'orderedProducts' => $this->orderedProducts,'configurableProduct'=>$configurableProduct]);
    }

    public function search()
    {
        $this->getUserOrderedProducts(Auth::id());
        foreach ($this->searchProduct as $value) {
            $value->path = $this->vnToString($value->title);
        }
        return view('home.search')->with(['orderedProducts' => $this->orderedProducts, 'searchProduct' => $this->searchProduct]);
    }

    //Page
    public function page($page_name)
    {
        $page = Setting::where('name', $page_name)->first();
        return view('home.' . $page_name)->with(['page' => (!empty(json_decode($page, true))) ? json_decode($page->value) : null]);
    }
    public function about()
    {
        return $this->page('about');
    }
    public function tutorial()
    {
        return $this->page('tutorial');
    }
    public function contact()
    {
        return $this->page('contact');
    }

    //Product
    public function displayAllProduct()
    {
        $this->getUserOrderedProducts(Auth::id());
        if (request()->get('sort') != null && Schema::hasColumn('products', request()->get('sort'))) {
            $getAllProduct = Product::where('type','simple')->orderBy(request()->get('sort'), 'desc')->paginate(5);
        } else {
            $getAllProduct = Product::where('type','simple')->paginate(5);
        }
        foreach ($getAllProduct as $value) {
            $value->path = $this->vnToString($value->title);
        }
        // dd($getAllProduct);
        return view('home.product.all-product')->with(['getAllProduct' => $getAllProduct, 'orderedProducts' => $this->orderedProducts, 'check' => 0]);
    }

    public function productDetail($id = null,$path = null)
    {
        $configurableProduct = Product::where([['id',$id],['type','configurable']])->first();
        if(isset($configurableProduct)){
            $configurableProductItem = ProductConfigurable::where('product_configurable_id',$configurableProduct->id)->get();
            foreach($configurableProductItem as $item){
                $this->convertToVnString(array($item->simple_products));
            }
        }
        else{
            $configurableProductItem = null;
        }
        $this->getUserOrderedProducts(Auth::id());
        if($id == null || $path == null){
            return back();
        }
        $getProductById = Product::with('category')->find($id);
        $this->convertToVnString(array($getProductById));
        $recommendProduct = Product::limit(4)->inRandomOrder()->get();
        $this->convertToVnString($recommendProduct);
        if ($id == null || $getProductById == null) return redirect()->route('homepage');
        else {
            return view('home.product.product-details')->with([
                'product' => $getProductById,
                'orderedProducts' => $this->orderedProducts,
                'recommendProduct' => $recommendProduct,
                'configurableProduct' => $configurableProduct,
                'configurableProductItem' => $configurableProductItem
            ]);
        }
    }

    //Cart
    public function displayCart()
    {
        return view('home.cart.cart');
    }
    //Pay
    public function getPay($orderCode = null)
    {
        $orders = Order::where(['user_id' => Auth::id()])->paginate(10);
        if ($orderCode == null) {
            return back();
        } else {
            $orders = Order::where(['user_id' => Auth::id(), 'order_code' => $orderCode])->get();
            if (0 == count($orders)) {
                return redirect()->route('homepage');
            }
            $orders = $orders[0];
            if ($orders->amount == $orders->paid && $orders->status == 'paid') {
                return redirect()->route('user.orders');
            }
            else {
                $paymentMethods = PaymentMethod::all();
                $bank = json_decode($paymentMethods[0]->info);
                $momo = json_decode($paymentMethods[1]->info);

                $orderDetails = OrderDetail::where('order_id', $orders->id)->get();

                $amount = $orders->amount;
                $paymentCodes = PaymentCode::where(['user_id' => Auth::id(), 'order_id' => $orders->id])->get();
                $orderDetailItems = Order::find($orders->id)->order_details;

                foreach($orderDetailItems as $key => $orderDetailItem){
                    $simpleProduct = Product::where([['id',$orderDetailItem->product_id],['type','simple']])->first();
                    if(isset($simpleProduct)){
                        unset($orderDetailItems[$key]);
                    }
                }
                return view('home.cart.pay')->with(['orderDetailItems' => $orderDetailItems, 'bank' => $bank, 'momo' => $momo, 'paymentCodes' => $paymentCodes, 'amount' => $amount]);
            }
        }
    }

    public function getCheckout($userId = null, $user = null)
    {
        if (Auth::user()->id === intval($userId) && Auth::user()->username === $user) {
            return view('home.cart.checkout');
        }
        return redirect()->route('homepage');
    }
    public function postCheckout(Request $request)
    {
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
        $orders = Order::create(['user_id' => Auth::id(), 'status' => 'unpaid', 'order_code' => '0', 'amount' => $amount, 'paid' => 0, 'ordered_at' => Carbon::now()->setTimezone('Asia/Ho_Chi_Minh'), 'paid_at' => Carbon::minValue(), 'canceled_at' => Carbon::minValue()]);
        $orderCode = Carbon::now()->isoformat('DD') . Carbon::now()->isoformat('MM') . Carbon::now()->isoformat('YY') . substr(strtoupper(hash('md5', hash('sha256', $orders->id))), rand(0, 28), 4);
        Order::where('id', $orders->id)->update(['order_code' => $orderCode]);

        foreach ($carts as $key => $cart) {
            $productConfigurable = ProductConfigurable::where('product_configurable_id',$cart->id)->get();
            if(0 != count($productConfigurable)){
                foreach($productConfigurable as $key => $value){
                    $getSimpleProduct = Product::where('id',$value->product_simple_id)->first();
                    $price = ($getSimpleProduct->discount_price != 0) ? $getSimpleProduct->discount_price : $getSimpleProduct->regular_price;
                    OrderDetail::updateOrCreate(['order_id' => $orders->id, 'product_id' => $getSimpleProduct->id, 'title' => $getSimpleProduct->title, 'category' => $getSimpleProduct->category->name, 'regular_price' => $getSimpleProduct->regular_price, 'discount_price' => $getSimpleProduct->discount_price, 'price' => $price, 'promo_code_id' => null]);
                }
            }
            OrderDetail::updateOrCreate(['order_id' => $orders->id, 'product_id' => $cart->id, 'title' => $cart->title, 'category' => $cart->category, 'regular_price' => $cart->regular_price, 'discount_price' => $cart->discount_price, 'price' => $cart->price, 'promo_code_id' => null]);
        }

        PaymentCode::create(['order_id' => $orders->id, 'user_id' => Auth::id(), 'payment_method_id' => 1, 'code' => 'B' . $orderCode]);
        PaymentCode::create(['order_id' => $orders->id, 'user_id' => Auth::id(), 'payment_method_id' => 1, 'code' => 'M' . $orderCode]);
        return response()->json([
            'status' => 200,
            'message' => "Đặt hàng thành công",
            'redirect_url' => '/pay/' . $orderCode
        ]);
    }

    public function getFree($id = null){
        $product = Product::where([['id',$id],['regular_price',0],['discount_price',0]])->first();
        $order = OrderDetail::where('product_id',$product->id)->first();
        if(empty($order)){
            $order = Order::updateOrCreate(['user_id' => Auth::id(), 'status' => 'paid', 'order_code' => '0', 'amount' => 0, 'paid' => 0, 'ordered_at' => Carbon::now()->setTimezone('Asia/Ho_Chi_Minh'), 'paid_at' => Carbon::now()->setTimezone('Asia/Ho_Chi_Minh'), 'canceled_at' => Carbon::minValue()]);
            OrderDetail::updateOrCreate(['order_id' => $order->id, 'product_id' => $product->id, 'title' => $product->title, 'category' => $product->category->name, 'regular_price' => $product->regular_price, 'discount_price' => $product->discount_price, 'price' => 0, 'promo_code_id' => null]);
        }
        return redirect()->route('user.purchased',['id'=>$id]);
    }
}
