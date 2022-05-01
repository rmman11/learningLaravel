<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{


    use \Conner\Tagging\Taggable;

    

    protected $fillable = ['title','tags','description'];

}
