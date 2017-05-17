<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posto extends Model
{
   protected $table = 'postogasolina';
   protected $primaryKey = 'idposto';
   public $timestamps = false;

    protected $fillable = [
     'nome',
     'localizacao'
    ];
}
