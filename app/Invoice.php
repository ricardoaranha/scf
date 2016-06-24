<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
   protected $table = 'notafiscal';
   protected $primaryKey = 'idnotafiscal';
   public $timestamps = false;

    protected $fillable = [
     'numeronota',
     'dtaemissao',
     'dtavencimento',
     'valor',
     'idstatus',
     'idunidade',
     'dtacadastro',
     'idfornecedor',
     'observacao',
     'idusuario',
     'notafiscal',
     'bolnotafiscal'
    ];
}
