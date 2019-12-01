<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentCode extends Model
{
    protected $table = 'payment_codes';
    protected $fillable = ['order_id','user_id','payment_method_id','code'];
}
