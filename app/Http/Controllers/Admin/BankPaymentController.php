<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Order;
use Log;

class BankPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $jar = \GuzzleHttp\Cookie\CookieJar::fromArray(
            [
                'ASP.NET_SessionId' => 'r0lxrflj3qiy4nctuke2hs2o',
                '__RequestVerificationToken_L0lCYW5raW5nMjAxNQ2' => 'nICBuJZ2Bd6ky6eovaBruiminYX7aGDPMuJNedKFCQzTn_jJoMZSHNeEw9o3KraNVMEHizIr3Mm3XVkcmo8TBY6xukfvdem0woV0C4YQPwI1',
                '_cultureValue' => 'vi-VN'
            ],
            'www.vietcombank.com.vn'
        );
        $client = new \GuzzleHttp\Client();
        $url = "https://www.vietcombank.com.vn/IBanking2015/0ddafdd54b026d658e795aea543dea4e/ThongTinTaiKhoan/TaiKhoan/ChiTietGiaoDich";
        $response = $client->request('POST', $url, [
            'cookies' => $jar,
            'form_params' => [
                'ToKenData' => '3B085033EE290227584915258E62A278EBA3EC79DC851DFF745E3BB6985A215F',
                '__RequestVerificationToken' => 'WYgfNLDfsI5eKG1RMalhi27B8Qg3bOH-FFNGQRGRUIzJGg0ZQ3abyZnwiMhJyOplmxbQEGZ670PaLVTsMtKSy_lFoRlRJUu1kNDNwtKJHxo1',
                'TaiKhoanTrichNo' => '79A1C36E85E83110F8DEA15136486F06|530E02069AA3BADC3F4AE382D60DC7D4',
                'MaLoaiTaiKhoanEncrypt' => '530E02069AA3BADC3F4AE382D60DC7D4',
                'NgayBatDauText' => $now->format('d/m/Y'),//09/12/2019
                'NgayKetThucText' => $now->addDay()->format('d/m/Y'),//10/12/2019
            ],
            // 'debug' => true
        ]);
        $t = json_decode($response->getBody()->getContents());
        $info = $t->ChiTietGiaoDich;
        $codeVcb = "";
        $getPrice = 0;
        foreach($info as $key => $item){
            $pos = strpos($item->MoTa,"B".$now->day.$now->month);
            $matches = array();
            $regex = "B".$now->format('d').$now->format('m');
            $des = preg_match("/(".$regex.")\w+/",$item->MoTa,$matches);

            // $pos = strpos($item->MoTa,"B1012");
            // $matches = array();
            // $des = preg_match("/(B1012)\w+/",$item->MoTa,$matches);
            if(isset($matches[0]) && strpos($item->MoTa,$matches[0]) > 0){
                $codeVcb = $matches[0];
                $getPrice = $item->SoTienGhiCo;
            }
        }
        //shorten currency value
        $getPrice = preg_replace('/,/','',$getPrice);
        $getPrice = number_format($getPrice/1000,0,',','.');

        $orders = Order::where(['status'=>1])->orWhere(['status'=>2])->get();
        foreach($orders as $order){
            $payment_code = Order::find($order->id)->payment_code[0]->code;
            preg_replace("/\s+/",'',$payment_code);
            if(strtolower(trim($payment_code)) == strtolower(trim($codeVcb))){
                $paid = $order->paid + $getPrice;
                if($paid < $order->amount){
                    Log::debug('Bank Paid in half!');
                    Order::where('id',$order->id)->update(['status'=>2,'paid'=>$paid]);
                }
                else if($paid >= $order->amount){
                    Log::debug("Bank Payment Successful!");
                    Order::where('id',$order->id)->update(['status'=>3,'payment_method_id'=>1,'paid_at'=>Carbon::now(),'paid'=>$paid]);
                }
            }
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
