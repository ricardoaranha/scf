<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
   protected $table = 'unidade';
   protected $primaryKey = 'idunidade';
   public $timestamps = false;

    protected $fillable = [
     'idunidade',
     'nome',
     'rua',
     'numero',
     'bairro',
     'cidade',
     'cep',
     'idestado'
    ];
}
