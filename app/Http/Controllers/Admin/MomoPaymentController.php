<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Webklex\IMAP\Facades\Client;
use Sunra\PhpSimple\HtmlDomParser;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Order;
use App\Setting;
use Illuminate\Support\Facades\Config;
use App\Jobs\MomoPaymentCheck;
use Auth;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;

class MomoPaymentController extends Controller
{
    public function __construct()
    {
        $settings = Setting::where('name','momo_email')->get();
        $settings = json_decode($settings[0]->value);
        $email = $settings->email;
        $password = $settings->password;
        Config::set('imap.accounts.gmail.username',$email);
        Config::set('imap.accounts.gmail.password',$password);
    }

    public function index()
    {
        MomoPaymentCheck::dispatchNow();
    }

    public function momo(){
    }

    public function spamToInbox(){
        try{
            $oClient = Client::account('gmail');
            $oClient->connect();
            $oFolder = $oClient->getFolder("[Gmail]/Spam");
            $oMessage = $oFolder->query()->from('no-reply@momo.vn')->unseen()->leaveUnread()->setFetchAttachment(false)->get();
            foreach($oMessage as $key => $value){
                if(strpos($value->getSubject(),"Bạn vừa nhận được") === false){
                    $value->moveToFolder('MomoSend');
                    continue;
                }
                $value->moveToFolder('INBOX');
            }
        }
        catch (Webklex\IMAP\Exceptions\GetMessagesFailedException $ex) {

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
