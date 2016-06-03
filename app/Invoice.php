<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
   protected $table = 'notafiscal';
   protected $primaryKey = 'idnotafiscal';
   public $timestamps = false;

    protected $fillable = [
     'idnotafiscal',
     'numeronota',
     'dtaemissoa',
     'dtavencimento',
     'valor',
     'idstatus',
     'idunidade',
     'dtacadastro',
     'idfornecedor',
     'observacao',
     'idusuario'
    ];
}
