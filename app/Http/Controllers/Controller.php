<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Setting;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $page = Setting::all();
        foreach($page as $k => $v){
            if($v->name == 'slider'){
                $slider = $v->value;
            }
            else if($v->name == 'footer'){
                $footer = $v->value;
            }
            else if($v->name == 'logo'){
                $logo = $v->value;
            }
        }

        $slider = isset($slider) ? json_decode($slider) : null;
        $footer = isset($footer) ? json_decode($footer) : null;
        $logo = isset($logo) ? json_decode($logo) : null;
        View::share(['slider'=>$slider,'logo'=>$logo,'footer'=>$footer,]);
    }
    public function display_response($code,$message){
        return response()->json([
            'status' => $code,
            'message' => $message
        ]);
    }
}
