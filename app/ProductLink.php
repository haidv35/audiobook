<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLink extends Model
{
    protected $table = 'product_links';
    public $timestamps = false;
    protected $fillable = ['product_id','content'];

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
