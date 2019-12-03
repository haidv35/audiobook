<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductConfigurable extends Model
{
    protected $table = 'products_configurable';
    protected $fillable = ['user_id','title','short_description','image_link','regular_price','discount_price','qty_purchased'];
}
