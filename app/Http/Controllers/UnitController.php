<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitController extends Controller {

   public function index() {

      $title = 'Unidades';

      $unidade = Unit::all();

      return view('unidade.index', compact('title', 'unidade'));

   }

   public function create() {

      $title = 'Cadastrar Unidade';

      return view('unidade.form', compact('title'));

   }

}
