<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
   protected $table = 'pagamento';
   protected $primaryKey = 'idpagamento';
   public $timestamps = false;

    protected $fillable = [
     'idformapagamento',
     'valor',
     'multa',
     'datapagamento',
     'statuspagamento',
     'total',
     'idnotafiscal',
     'datacadastro',
     'idusuario'
    ];
}
