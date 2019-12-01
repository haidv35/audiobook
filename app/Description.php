<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $table = 'descriptions';
    public $timestamps = false;
    protected $fillable = ['product_id','content'];
}
