<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankController extends Controller {

   public function index() {

      $title = 'Bancos';

      $bank = Bank::all();

      return view('banco.index', compact('title', 'bank'));

   }

   public function create() {

      $title = 'Cadastrar Banco';

      return view('banco.form', compact('title'));

   }

}
