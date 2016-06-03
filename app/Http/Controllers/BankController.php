<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

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
   public function save(Request $request) {

      $rules = [];

      $rules = [
         'nome'       	=> 'required'
      ];

      $banco = $request['nome'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('UnitController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar o banco, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $unit = Bank::create($request->all());

         return redirect()->action('BankController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro ddo Banco "'.$banco.'" realizado com sucesso!');

      }

   }

   public function delete($id) {

      $bank = Bank::find($id);

      $banco = $bank['nome'];

      $bank->delete();

      return redirect()->action('BankController@index')
         ->with('class', 'success')
         ->with('msg', 'Banco "'.$banco.'" excluido com sucesso!');

   }

}
