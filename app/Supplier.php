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
     'inscricaomunicipal',
     'rua',
     'numero',
     'bairro',
     'cidade',
     'idestado',
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
     'conta',
     'inscricaoestadual'
    ];
}
