<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipocombustivel extends Model
{
   protected $table = 'tipocombustivel';
   protected $primaryKey = 'idtipocombustivel';
   public $timestamps = false;

    protected $fillable = [
     'nome'
    ];
}
