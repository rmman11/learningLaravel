<?php

namespace App\Models;
use DB;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $fillable = ['title','parent_id'];
    function products(){
        return $this->belongsTo('App\Products');
    }

    function withCategories() {
        return $this->hasOne('App\Product', 'id', 'categorie_id');
     }
     public function getCategory(){

        $categories = DB:: select("select *from categories");
        return $categories;
     }
     public function children()
       {
         return $this->hasMany('App\Category', 'parent_id');
       }

}
