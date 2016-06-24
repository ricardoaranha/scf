<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class BankController extends Controller {

   public function index() {

      $title = 'Bancos';

      $bank = Bank::orderBy('nomebanco','asc')->get();

      return view('banco.index', compact('title', 'bank'));

   }

   public function create() {

      $title = 'Cadastrar Banco';

      $url = '/bank/register';

      return view('banco.form', compact('title', 'url'));

   }
   public function save(Request $request) {

      $rules = [];

      $rules = [
         'numero'             => 'required',
         'nomebanco'       	=> 'required'
      ];

      $banco = $request['nome'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('BankController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar o banco, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $unit = Bank::create($request->all());

         return redirect()->action('BankController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro do Banco "'.$banco.'" realizado com sucesso!');

      }

   }

   public function delete($id) {

      $bank = Bank::find($id);

      $banco = $bank['nomebanco'];

      $bank->delete();

      return redirect()->action('BankController@index')
         ->with('class', 'success')
         ->with('msg', 'Banco "'.$banco.'" excluido com sucesso!');

   }

   public function edit($id) {

      $title = 'Editar Banco';

      $query = Bank::find($id);

      $url = '/bank/edit/';

      return view('banco.form', compact('title', 'query', 'url'));

   }

   public function update(Request $request) {

      
      $rules = [];

      $rules = [
         'numero'             => 'required',
         'nomebanco'          => 'required'
      ];

      $banco = $request['nomebanco'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('BankController@edit',['id'=>$request['idbanco']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar alterar o Banco, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $bank = Bank::find($request['idbanco']);
         $bank->update($request->all());

         return redirect()->action('BankController@index')
            ->with('class', 'success')
            ->with('msg', 'Banco "'.$banco.'" alterado com sucesso!');

      }

   }

}
