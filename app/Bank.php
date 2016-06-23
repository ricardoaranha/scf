<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
   protected $table = 'banco';
   protected $primaryKey = 'idbanco';
   public $timestamps = false;

    protected $fillable = [
     'nomebanco',
     'numero'
    ];
}
