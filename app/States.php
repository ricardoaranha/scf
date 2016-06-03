<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
   protected $table = 'estado';
   protected $primaryKey = 'idestado';
   public $timestamps = false;

    protected $fillable = [
     'idestado',
     'nome',
     'sigla'
    ];
}
