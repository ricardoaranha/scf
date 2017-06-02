<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folha extends Model
{
   protected $table = 'folha';
   protected $primaryKey = 'idfolha';
   public $timestamps = false;

    protected $fillable = [
     'idmes',
     'idunidade',
     'valor',
     'ano'
    ];
}
