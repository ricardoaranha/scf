<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notacombustivel extends Model
{
   protected $table = 'notacombustivel';
   protected $primaryKey = 'idnotacombustivel';
   public $timestamps = false;

    protected $fillable = [
     'numnota',
     'idposto',
     'idunidade',
     'carro',
     'idtipocombustivel',
     'litros',
     'valor',
     'data'
    ];
}
