<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
class Category extends Model
{
    use NodeTrait;
    protected $table = 'categories';
    protected $fillable = ['name','parent_id','lft','rgt'];
    public $timestamps = false;
    // public function parent(){
    //     return $this->hasMany('App\Category');
    // }
    // public function child(){
    //     return $this->belongsTo('App\Category');
    // }

    // public function getLftName()
    // {
    //     return 'left';
    // }

    // public function getRgtName()
    // {
    //     return 'right';
    // }

    public function getParentIdName()
    {
        return 'parent_id';
    }

    // Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

}
