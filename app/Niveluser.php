<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niveluser extends Model
{
   protected $table = 'niveluser';
   protected $primaryKey = 'idniveluser';
   public $timestamps = false;

    protected $fillable = [
     'idniveluser',
     'nomeniveluser'
    ];
}
