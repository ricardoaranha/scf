<?php

namespace App;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
   protected $table = 'user';
   protected $primaryKey = 'userid';
   public $timestamps = false;

    protected $fillable = [
        'userfirstname', 'userlastname', 'userlogin', 'userpasswd','idnivel'
    ];

    protected $hidden = [
        'userpasswd'
    ];

   protected function auth($userlogin, $userpasswd)
   {
      return DB::table($this->table)
         ->where('userlogin', $userlogin)
         ->where('userpasswd', $userpasswd)
         ->first();
   }
}
