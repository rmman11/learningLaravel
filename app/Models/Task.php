<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['id','name', 'display_name','description'];

      /**
       * The attributes that should be cast to native types.
       *
       * @var array
       */
      protected $casts = [
          'user_id' => 'int',
      ];


      public function user()
      {
          return $this->belongsTo(User::class);
      }


      public function activityExtraData()
      {
          return array('name'=>$this->name, 'display_name' => $this->display_name);
      }

      public function activityVerb()
      {
          return 'created';
      }
}
