<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['user_id','type','category_id','title','short_description','image','demo_link','regular_price','discount_price','product_link','new_product','hot_product','qty_purchased'];

    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function description(){
        return $this->hasOne('App\Description');
    }
    public function product_links(){
        return $this->hasMany('App\ProductLink');
    }
    public function order_details(){
        return $this->hasMany('App\OrderDetail');
    }
}
