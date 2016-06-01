<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
   protected $table = 'notafiscal';
   protected $primaryKey = 'idnota';
   public $timestamps = false;

    protected $fillable = [
     'idnota',
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
