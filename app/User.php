<?php

namespace App;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
   protected $table = 'user';
   protected $primaryKey = 'userid';

    protected $fillable = [
        'userfirstname', 'userlastname', 'userlogin', 'userpasswd'
    ];

    protected $hidden = [
        'userpasswd'
    ];

    public $timestamps = false;

   protected function auth($userlogin, $userpasswd)
   {
      return DB::table($this->table)
         ->where('userlogin', $userlogin)
         ->where('userpasswd', $userpasswd)
         ->first();
   }
}
