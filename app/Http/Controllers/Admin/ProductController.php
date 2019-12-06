<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Validator;
use App\Product;
use App\Category;
use App\Description;
use App\ProductLink;
use App\Order;
use App\OrderDetail;
use App\Http\Requests\ProductIERequest;
use App\Http\Requests\CategoryIERequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Imports\FileImport;
use App\Exports\FileExport;
use App\Http\Requests\ProductConfigurableRequest;
use App\ProductConfigurable;
use App\ListProductConfigurable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search_query = request()->get('search');
        $filter_query = request()->get('filter');
        if(isset($search_query)){
            $products = Product::where('type','simple')->whereHas('category' , function (Builder $query) use ($search_query){
                $query->where('title','LIKE',"$search_query%")->orWhere('name', 'LIKE', "$search_query%");
            })->with('category','order_details')->paginate(10);
            $products->appends(['search' => $search_query]);
        }
        else if(isset($filter_query)){
            if($filter_query === 'discount_price'){
                $products = Product::where('type','simple')->with('category','order_details')->orderBy($filter_query,'asc')->paginate(10);
                $products->appends(['search' => $search_query]);
            }
            else if($filter_query === 'qty_sold'){
                $products = Product::where('type','simple')->with('category','order_details')->withCount('order_details')->orderBy('order_details_count','desc')->paginate(10);
                $products->appends(['search' => $search_query]);
            }
            else{
                $products = Product::where('type','simple')->with('category','order_details')->orderBy($filter_query,'desc')->paginate(10);
                $products->appends(['search' => $search_query]);
            }
        }
        else{
            $products = Product::where('type','simple')->with('category','order_details')->orderBy('created_at','desc')->paginate(10);
        }
        //Count paid product
        $arr = array();
        $orders = Order::where(['status'=>'paid'])->get();
        foreach ($orders as $key => $value) {
            foreach($value->order_details as $item){
                array_push($arr,$item->product_id);
            }
        }
        $paid_product_count = array_count_values($arr);
        return view('admin.product.product')->with(['products'=>$products,'paid_product_count'=>$paid_product_count]);
    }
    public function indexConfigurable(){
        $search_query = request()->get('search');
        $filter_query = request()->get('filter');
        if(isset($search_query)){
            $products = Product::where([['type','configurable'],['title','LIKE',"$search_query%"]])->with('order_details')->paginate(10);
            $products->appends(['search' => $search_query]);
        }
        else if(isset($filter_query)){
            if($filter_query === 'discount_price'){
                $products = Product::where('type','configurable')->with('order_details')->orderBy($filter_query,'asc')->paginate(10);
                $products->appends(['search' => $search_query]);
            }
            else if($filter_query === 'qty_sold'){
                $products = Product::where('type','configurable')->with('order_details')->withCount('order_details')->orderBy('order_details_count','desc')->paginate(10);
                $products->appends(['search' => $search_query]);
            }
            else{
                $products = Product::where('type','configurable')->with('order_details')->orderBy($filter_query,'desc')->paginate(10);
                $products->appends(['search' => $search_query]);
            }
        }
        else{
            $products = Product::where('type','configurable')->with('order_details')->orderBy('created_at','desc')->paginate(10);
        }
        //Count paid product
        $arr = array();
        $orders = Order::where(['status'=>'paid'])->get();
        foreach ($orders as $key => $value) {
            foreach($value->order_details as $item){
                array_push($arr,$item->product_id);
            }
        }
        $paidProductCount = array_count_values($arr);

        foreach($products as $key => $value){
            $value->count_simple_product = ProductConfigurable::where('product_configurable_id',$value->id)->count();
        }
        return view('admin.product.product_configurable')->with(['products'=>$products,'paidProductCount'=>$paidProductCount]);
    }

    public function setStatus(Request $request){
        if(!empty($request->except('_token'))){
            $getRequest = json_decode($request->getContent());
            if($getRequest->type == 'new_product' || $getRequest->type == 'hot_product'){
                $product = Product::where('type','simple')->find($getRequest->product_id)->update([$getRequest->type=>$getRequest->status]);
            }
            return $this->display_response(200,'Cập nhật thành công');
        }
        return $this->display_response(404,'Có lỗi đã xảy ra');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id');
        return view('admin.product.create')->with('categories',$categories);
    }

    public function createConfigurable(){
        $products = Product::where('type','=','simple')->get();
        return view('admin.product.create_configurable_product')->with(['products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if($request->validated())
        {
            // $get_image = $request->file('image_upload');
            // $image_link = $this->product_service->handleUploadedImage($get_image);
            $get_description = $request->description;
            $product_links = $request->product_links;
            $image_link =$request->image_link;

            $request->merge(['image'=>$image_link,'user_id'=>Auth::id(),'type'=>'simple']);
            $product = Product::create($request->except(['product_links','_token','description']));
            Description::create(['product_id'=>$product->id,'content'=>$get_description]);
            foreach($product_links as $key => $product_link){
                ProductLink::create(['product_id'=>$product->id,'content'=>$product_link]);
            }
            return response()->json([
                'message'   => 'Thêm mới thành công',
                'status'    => 200
            ]);
        }
        else
        {
            return response()->json([
                'message'   => "Đã xảy ra lỗi. Vui lòng thử lại.",
                'status'    => 404
            ]);
        }

    }
    public function storeConfigurable(ProductConfigurableRequest $request){
        if($request->validated())
        {
            $request->merge(['user_id'=>Auth::id(),'type'=>'configurable','image'=>$request->image_link]);
            $product = Product::create($request->except(['image_link','product_list','_token']));
            foreach(json_decode($request->product_list) as $value){
                ProductConfigurable::create(['product_configurable_id'=>$product->id,'product_simple_id'=>$value]);
            }
            return response()->json([
                'message'   => 'Thêm mới thành công',
                'status'    => 200
            ]);
        }
        else
        {
            return response()->json([
                'message'   => "Đã xảy ra lỗi. Vui lòng thử lại.",
                'status'    => 404
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('type','simple')->with('category','description')->findOrFail($id);
        $categories = Category::pluck('name','id');
        $product_links = $product->product_links;
        return view('admin.product.edit')->with(['product'=>$product,'categories'=>$categories,'product_links'=>$product_links]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        if($request->validated())
        {
            $get_description = $request->description;
            $product_links = $request->product_links;
            $product_links_id = $request->product_links_id;
            // if($request->has('image_upload')){
            //     $get_image = $request->file('image_upload');
            //     $image_link = $this->product_service->handleUploadedImage($get_image);
            // }
            // else{
                $image_link = $request->image_link;
            // }
            $request->merge(['image'=>$image_link,'user_id'=>Auth::id()]);
            $product = Product::where([['id',$id],['type','simple']])->update($request->except(['product_links_id','product_links','image_link','_token','description']));
            Description::where('product_id',$id)->update(['content'=>$get_description]);
            for($i=0;$i<count($product_links_id);$i++){
                ProductLink::where(['id'=>$product_links_id[$i],'product_id'=>$id])->update(['content'=>$product_links[$i]]);
            }
            for($i=count($product_links_id);$i<count($product_links);$i++){
                ProductLink::create(['product_id'=>$id,'content'=>$product_links[$i]]);
            }
            return response()->json([
                'message'   => 'Chỉnh sửa thành công',
                'status'    => 200
            ]);
        }
        else
        {
            return response()->json([
                'message'   => "Đã xảy ra lỗi. Vui lòng thử lại.",
                'status'    => 404
            ]);
        }
    }

    public function editConfigurable($id)
    {
        $product = Product::where('type','configurable')->findOrFail($id);
        $product->product_configurable_id = ProductConfigurable::where('product_configurable_id',$id)->get();
        $all_simple_product = Product::where('type','simple')->get();
        return view('admin.product.edit_configurable_product')->with(['product'=>$product,'all_simple_product'=>$all_simple_product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateConfigurable(ProductConfigurableRequest $request, $id)
    {
        if($request->validated())
        {
            $image_link = $request->image_link;
            $request->merge(['image'=>$image_link,'user_id'=>Auth::id(),'type'=>'configurable']);
            $product = Product::where([['id',$id],['type','configurable']])->update($request->except(['product_list','image_link','_token']));
            foreach(json_decode($request->product_list) as $value){
                ProductConfigurable::where(['product_configurable_id'=>$id])->delete();
            }
            foreach(json_decode($request->product_list) as $value){
                ProductConfigurable::create(['product_configurable_id'=>$id,'product_simple_id'=>$value]);
            }
            return response()->json([
                'message'   => 'Chỉnh sửa thành công',
                'status'    => 200
            ]);
        }
        else
        {
            return response()->json([
                'message'   => "Đã xảy ra lỗi. Vui lòng thử lại.",
                'status'    => 404
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedProduct = Product::where('type','simple')->find($id)->delete();
        $order_details = OrderDetail::where('product_id',$id)->count();
        if($deletedProduct == true && $order_details == 0){
            return response()->json([
                'message'   => 'Xoá thành công',
                'status'    => 200
            ]);
        }
        else{
            return response()->json([
                'message'   => "Đã xảy ra lỗi. Vui lòng thử lại.",
                'status'    => 404
            ]);
        }
    }
    public function destroyConfigurable($id)
    {
        $deletedProduct = Product::where('type','configurable')->find($id)->delete();
        $order_details = OrderDetail::where('product_id',$id)->count();
        if($deletedProduct == true && $order_details == 0){
            return response()->json([
                'message'   => 'Xoá thành công',
                'status'    => 200
            ]);
        }
        else{
            return response()->json([
                'message'   => "Đã xảy ra lỗi. Vui lòng thử lại.",
                'status'    => 404
            ]);
        }
    }

    public function importExportView(){
        return view('admin.product.import_export');
    }

    public function import(ProductIERequest $request){
        if($request->validated()){
            $excel_file = $request->file('import_file');

            $import_cate = new FileImport();
            $import_cate->onlySheets('Category');
            try {
                $categories = Excel::import($import_cate,$excel_file);
            } catch (\Maatwebsite\Excel\Exceptions\SheetNotFoundException $e) {
                // throw new Exception('Khong tim thay sheet');
                return response()->json([
                    'status' => 404,
                    'message' => "Không tìm thấy sheet cần nhập",
                ]);
            }

            $import = new FileImport();
            $import->onlySheets('Product');
            try {
                Excel::import($import,$excel_file);
            } catch (\Maatwebsite\Excel\Exceptions\SheetNotFoundException $e) {
                return response()->json([
                    'status' => 404,
                    'message' => "Không tìm thấy sheet cần nhập",
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => "Nhập dữ liệu thành công",
            ]);
        }
        else
        {
            return response()->json([
                'message'   => "Đã xảy ra lỗi. Vui lòng thử lại.",
                'status'    => 404
            ]);
        }

    }
    public function export(){
        return Excel::download(new FileExport, 'audiobook.xlsx');
    }
    // public function export_product_view(){
    //     $products = Product::all();
    //     return view('admin.product.export')->with('products',$products);
    // }
}

