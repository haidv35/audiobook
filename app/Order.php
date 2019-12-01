<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = false;
    protected $fillable = ['user_id','status','order_code','amount','paid','balance','ordered_at','paid_at','canceled_at'];

    public function order_details(){
        return $this->hasMany('App\OrderDetail');
    }
    public function payment_method(){
        return $this->belongsTo('App\PaymentMethod','payment_method_id');
    }
    public function payment_code(){
        return $this->hasMany('App\PaymentCode');
    }

}
