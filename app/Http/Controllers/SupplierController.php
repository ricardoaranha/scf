<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class SupplierController extends Controller {

   public function index() {

      $title = 'Fornecedores';

      $suppliers = Supplier::leftjoin('banco', 'banco.idbanco', '=', 'fornecedor.idbanco')->get();

      return view('fornecedor.index', compact('title', 'suppliers'));

   }

   public function create() {

      $title = 'Cadastrar Fornecedor';

      return view('fornecedor.form', compact('title'));

   }

   public function save(Request $request) {

      $request['datacadastro'] = date('Y-m-d');

      $rules = [];

      $rules = [
         'idtipo'       => 'required',
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
         'datacadastro' => 'required',
         'idbanco'      => 'required',
         'agencia'      => 'required',
         'conta'        => 'required'
      ];

      if ($request['idtipo'] == 1) {

         $rules['nomepf']     = 'required';
         $rules['cpf']        = 'required';
         $rules['celular1']   = 'required';

         $fornecedor = $request['nomepf'];

      }

      if ($request['idtipo'] == 2) {

         $rules['nomefantasia'] = 'required';
         $rules['nomepj']       = 'required';
         $rules['cnpj' ]        = 'required';
         $rules['nomecontato']  = 'required';
         $rules['telefone1']    = 'required';

         $fornecedor = $request['nomefantasia'];

      }

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('SupplierController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar o fornecedor, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $supplier = Supplier::create($request->all());

         return redirect()->action('SupplierController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro do Fornecedor '.$fornecedor.' realizado com sucesso!');

      }

   }

}
