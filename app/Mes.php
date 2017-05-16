<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
   protected $table = 'mes';
   protected $primaryKey = 'idmes';
   public $timestamps = false;

    protected $fillable = [
     'nome'
    ];
}
