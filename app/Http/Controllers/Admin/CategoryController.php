<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\CategoryIERequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use PHPUnit\Framework\Exception;

use App\Imports\FileImport;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getJson(){
        $categories = Category::get()->toTree();
        return $categories;
    }
    public function index()
    {
        $categories_tree = Category::get()->toTree();
        $categories = Category::all();
        return view('admin.category.category')->with(['categories_tree'=>$categories_tree,'categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $category_create = Category::create(['parent_id'=>$request->parent_category,'name'=>$request->category_name]);
            return back();
        } catch (QueryException $e) {
            // session('error','Danh mục đã tồn tại !');
            $request->session()->put('error', "Bạn chưa nhập danh mục hoặc danh mục đã tồn tại!");
            return back();
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id',$id)->get();
        $categories = Category::all();
        if(0 != count($category)){
            return view('admin.category.edit')->with(['category'=>$category,'categories'=>$categories]);
        }
        else{
            return redirect()->route('admin.category');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Category::where('id',$id)->update(['parent_id'=>$request->parent_category,'name'=>$request->category_name]);
            Category::fixTree();
            return back();
        } catch (QueryException $e) {
            return back();
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
        Category::where('id',$id)->delete();
        return back();
    }

    public function importExportView(){
        return view('admin.category.import_export');
    }

    public function import(CategoryIERequest $request){
        if($request->validated()){
            $excel_file = $request->file('import_file');
            $import = new FileImport();
            $import->onlySheets('Category');
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
        else{
            return response()->json([
                'message'   => "Đã xảy ra lỗi. Vui lòng thử lại.",
                'status'    => 404
            ]);
        }
    }
}
