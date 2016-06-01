<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
   protected $table = 'fornecedor';
   protected $primaryKey = 'idfornecedor';
   public $timestamps = false;

    protected $fillable = [
     'idtipo',
     'nomepf',
     'nomefantasia',
     'nomepj',
     'cpf',
     'cnpj',
     'rua',
     'numero',
     'bairro',
     'cidade',
     'uf',
     'cep',
     'complemento',
     'telefone1',
     'telefone2',
     'celular1',
     'celular2',
     'nomecontato',
     'email',
     'datacadastro',
     'idbanco',
     'agencia',
     'conta'
    ];
}
