<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use App\Setting;

class PageController extends Controller
{
    //Begin Slider
    public function sliderIndex(){
        $slider = Setting::where('name','slider')->first();
        $page = (!empty(json_decode($slider,true))) ? json_decode($slider->value,true) : null;
        return view('admin.settings.pages.slider')->with('slider',$page);
    }
    public function sliderStore(Request $request){
        $validator = Validator::make($request->except('_token'),[
            'image_link' => 'required'
        ],[
            'image_link.required' => 'Bạn chưa nhập đường dẫn hình ảnh',
            // 'image_link.url' => 'Link không hợp lệ! Vui lòng nhập lại',
        ]);

        if(!$validator->fails()){
            $slider = Setting::where('name','slider')->first();
            if(!empty(json_decode($slider,true))){
                $slider = json_decode($slider->value);
                array_push($slider,$request->image_link);
                Setting::where(['name'=>'slider'])->update(['name'=>'slider','value'=>json_encode($slider)]);
                return back();
            }
            else{
                $slide_array = array();
                array_push($slide_array,$request->image_link);
                Setting::create(['name'=>'slider','value'=>json_encode($slide_array)]);
                return back();
            }
        }
        else{
            return back()->withErrors($validator->errors());
        }
    }
    public function sliderDestroy($id = null){
        if($id != null){
            $slider = Setting::where('name','slider')->first()->value;
            $slider = json_decode($slider,true);
            array_splice($slider,$id-1,1);
            $slider = json_encode($slider);
            Setting::where('name','slider')->update(['name'=>'slider','value'=>$slider]);
        }
        return back();
    }
    //End Slider

    public function pageIndex($page_name){
        $page = Setting::where('name',$page_name)->first();
        $page = (!empty(json_decode($page,true))) ? json_decode($page->value,true) : null;
        return view('admin.settings.pages.'.$page_name)->with(['page'=>$page,'page_name'=>$page_name]);
    }
    public function pageStore(Request $request,$page_name = null){
        $validator = Validator::make($request->except('_token'),[
            'value' => 'required'
        ],[
            'value.required' => 'Bạn chưa nhập nội dung!',
        ]);
        if(!$validator->fails()){
            $pageCounter = Setting::where('name',$page_name)->count();
            $value = json_encode($request->value);
            $request->merge(['name'=>$page_name,'value'=>$value]);
            if(0 != $pageCounter){
                Setting::where('name',$page_name)->update($request->except('_token'));
                return redirect()->back()->with('success','Cập nhật thành công');
            }
            else{
                Setting::create($request->except('_token'));
                return redirect()->back()->with('success','Thêm mới thành công');
            }
        }
        return back()->withErrors($validator->errors());
    }

    public function aboutIndex(){
        return $this->pageIndex('about');
    }
    public function aboutStore(Request $request){
        return $this->pageStore($request,'about');
    }
    public function tutorialIndex(){
        return $this->pageIndex('tutorial');
    }
    public function tutorialStore(Request $request){
        return $this->pageStore($request,'tutorial');
    }
    public function contactIndex(){
        return $this->pageIndex('contact');
    }
    public function contactStore(Request $request){
        return $this->pageStore($request,'contact');
    }
    public function footerIndex(){
        return $this->pageIndex('footer');
    }
    public function footerStore(Request $request){
        return $this->pageStore($request,'footer');
    }
}
