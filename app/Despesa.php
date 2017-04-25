<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
   protected $table = 'despesa';
   protected $primaryKey = 'iddespesa';
   public $timestamps = false;

    protected $fillable = [
     'nomedespesa',
     'descricao'
    ];
}
