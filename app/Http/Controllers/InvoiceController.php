<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller {

   public function index() {

      $title = 'Notas Fiscais';

      $invoice = Invoice::all();

      return view('notas.index', compact('title', 'invoice'));

   }

   public function create() {

      $title = 'Cadastrar Nota Fiscal';

      return view('notas.form', compact('title'));

   }

}
