<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductConfigurable extends Model
{
    protected $table = 'products_configurable';
    protected $fillable = ['product_configurable_id','product_simple_id'];
    public $timestamps = false;

    public function simple_products(){
        return $this->belongsTo('App\Product','product_simple_id');
    }
}
