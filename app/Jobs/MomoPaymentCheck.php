<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\Log;
// use Sunra\PhpSimple\HTMLDomParser;
use HTMLDomParser;
use Carbon\Carbon;

use App\Order;
use App\Setting;
use Illuminate\Support\Facades\Config;
use Auth;

class MomoPaymentCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $tries = 5;

    public function __construct()
    {
        $settings = Setting::where('name','momo_email')->get();
        $settings = json_decode($settings[0]->value);
        $email = $settings->email;
        $password = $settings->password;
        Config::set('imap.accounts.gmail.username',$email);
        Config::set('imap.accounts.gmail.password',$password);
    }

    public function handle()
    {
        $oClient = Client::account('gmail');
        $oClient->connect();
        $oFolder = $oClient->getFolder('INBOX');
        $aMessage = $oFolder->query()->from('no-reply@momo.vn')->unseen()->leaveUnread()->setFetchAttachment(false);
        $oMessage = $aMessage->get();

        Log::debug('Success connect!');

        foreach ($oMessage as $k1 => $v1) {
            if(strpos($v1->getSubject(),"Bạn vừa nhận được") === false){
                $v1->moveToFolder('MomoSend');
                continue;
            }
            $getPrice = 0;
            $getText = "";
            foreach ($v1->bodies as $k2 => $v2) {
                if($k2 == 'html'){
                    $data = HTMLDomParser::str_get_html($v2->content)->find('table > tbody > tr:nth-child(3) > td > span');
                    foreach ($data as $key => $value) {
                        if($key == 3){
                            $getPrice = round($value->plaintext,1);
                        }
                        else if($key == 15){
                            $getText = $value->plaintext;
                        }
                    }
                }
                break;
            }

            // echo $getPrice . " ------------------ " . $getText;

            //Check code and price for momo payment
            $orders = Order::where(['status'=>1])->orWhere(['status'=>2])->get();
            preg_replace("/\s+/",'',$getText);
            foreach($orders as $order){
                $payment_code = Order::find($order->id)->payment_code[1]->code;
                preg_replace("/\s+/",'',$payment_code);
                if(strtolower(trim($payment_code)) == strtolower(trim($getText))){
                    if($order->paid + $getPrice < $order->amount){
                        Log::debug('Momo Paid in half!');
                        Order::where('id',$order->id)->update(['status'=>2,'paid'=>$order->paid + $getPrice]);
                        $v1->moveToFolder('MomoReceive');
                    }
                    else if($order->paid + $getPrice >= $order->amount){
                        Log::debug("Momo Payment Successful!");
                        Order::where('id',$order->id)->update(['status'=>3,'payment_method_id'=>2,'paid_at'=>Carbon::now(),'paid'=>$order->paid + $getPrice]);
                        $v1->moveToFolder('MomoReceive');
                    }
                }
                else{
                    $v1->moveToFolder('MomoUnknown');
                }
            }
            // $v1->setFlag(['Seen']);
            // $v1->moveToFolder('MomoReceive');
        }

    }
}
