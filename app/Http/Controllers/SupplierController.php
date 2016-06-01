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

   public function save(Request $request) {

      $request = $request->all();
      $request['datacadastro'] = date('Y-m-d');

      $rules = [];

      $rules = [
         'idtipo'       =>'required',
         'rua'          => 'required',
         'numero'       => 'required',
         'bairro'       => 'required',
         'cidade'       => 'required',
         'uf'           => 'required',
         'cep'          => 'required',
         'complemento'  => '',
         'telefone1'    => '',
         'telefone2'    => '',
         'celular1'     => '',
         'celular2'     => '',
         'email'        => 'required',
         'datacadastro' =>'required',
         'idbanco'      => 'required',
         'agencia'      => 'required',
         'conta'        => 'required'
      ];

      if ($request['idtipo'] == 1) {

         $rules['nomepf']     = 'required';
         $rules['cpf']        = 'required';
         $rules['celular1']   = 'required';

      }

      if ($request['idtipo'] == 2) {

         $rules['nomefantasia'] = 'required';
         $rules['nomepj']       = 'required';
         $rules['cnpj' ]        = 'required';
         $rules['nomecontato']  = 'required';
         $rules['telefone1']    = 'required';

      }

      $validation = $this->validate($request,$rules);

      return redirect()->action('SupplierController@index');

   }

}
