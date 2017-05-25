<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formapagamento extends Model
{
   protected $table = 'formapagamento';
   protected $primaryKey = 'idformapagamento';
   public $timestamps = false;

    protected $fillable = [
     'nome'
    ];
}
