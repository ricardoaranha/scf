<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller {

   public function index() {

      $title = 'Fornecedores';

      $suppliers = Supplier::all();

      return view('fornecedor.index', compact('title', 'suppliers'));

   }

   public function create() {

      $title = 'Cadastrar Fornecedor';

      return view('fornecedor.form', compact('title'));

   }

}
