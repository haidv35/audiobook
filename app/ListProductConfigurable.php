<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListProductConfigurable extends Model
{
    protected $table = 'list_products_configurable';
    protected $fillable = ['product_configurable_id','product_id'];
    public $timestamps = false;
}
