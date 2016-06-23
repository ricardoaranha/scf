<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Bank;
use App\States;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class SupplierController extends Controller {

   public function index() {

      $title = 'Fornecedores';

      $suppliers = Supplier::leftjoin('banco', 'banco.idbanco', '=', 'fornecedor.idbanco')
         ->leftjoin('estado', 'estado.idestado', '=', 'fornecedor.idestado')
         ->get();

      return view('fornecedor.index', compact('title', 'suppliers'));

   }

   public function search(Request $request) {

      $title = 'Fornecedores';

      $suppliers = Supplier::leftjoin('banco', 'banco.idbanco', '=', 'fornecedor.idbanco')
         ->leftjoin('estado', 'estado.idestado', '=', 'fornecedor.idestado')
         ->where('nomepf', 'like', '%'.$request['params'].'%')
         ->orWhere('nomepj', 'like', '%'.$request['params'].'%')
         ->orWhere('nomefantasia', 'like', '%'.$request['params'].'%')
         ->get();

      return view('fornecedor.index', compact('title', 'suppliers'));

   }

   public function create() {

      $title = 'Cadastrar Fornecedor';

      $bank = Bank::orderBy('nomebanco','asc')->get();

      $states = States::all();

      $url = '/supplier/register';

      return view('fornecedor.form', compact('title','bank', 'states', 'url'));

   }

   public function save(Request $request) {

      $request['datacadastro'] = date('d/m/Y');

      $rules = [];

      $rules = [
         'idtipo'       => 'required'
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

         $fornecedor = $request['nomepj'];

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
            ->with('msg', 'Fornecedor "'.$fornecedor.'" cadastrado com sucesso!');

      }

   }

   public function edit($id) {

      $title = 'Editar Fornecedor';

      $bank = Bank::orderBy('nomebanco','asc')->get();

      $states = States::all();

      $query = Supplier::find($id);

      $url = '/supplier/edit';

      return view('fornecedor.form', compact('title','bank', 'states', 'query', 'url'));

   }

   public function update(Request $request) {

      $rules = [];

      $rules = [
         'idtipo'       => 'required'
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

         $fornecedor = $request['nomepj'];

      }

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('SupplierController@edit',['id'=>$request['idfornecedor']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar alterar o fornecedor, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $supplier = Supplier::find($request['idfornecedor']);
         $supplier->update($request->all());

         return redirect()->action('SupplierController@index')
            ->with('class', 'success')
            ->with('msg', 'Fornecedor "'.$fornecedor.'" alterado com sucesso!');

      }

   }

   public function delete($id) {

      $supplier = Supplier::find($id);

      if ($supplier['idtipo'] == 1) {
         $fornecedor = $supplier['nomepf'];
      }

      if ($supplier['idtipo'] == 2) {
         $fornecedor = $supplier['nomefantasia'];
      }

      $supplier->delete();

      return redirect()->action('SupplierController@index')
         ->with('class', 'success')
         ->with('msg', 'Fornecedor "'.$fornecedor.'" excluido com sucesso!');

   }

}
