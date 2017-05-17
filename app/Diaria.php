<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diaria extends Model
{
   protected $table = 'diaria';
   protected $primaryKey = 'iddiaria';
   public $timestamps = false;

    protected $fillable = [
     'numoficio',
     'data',
     'favorecido',
     'cpf',
     'idbanco',
     'agencia',
     'conta',
     'valor',
     'descricao'
    ];
}
