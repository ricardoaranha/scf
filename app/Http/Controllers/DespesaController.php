<?php

namespace App\Http\Controllers;

use App\Despesa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class DespesaController extends Controller {

   public function index() {

      $title = 'Tipos de Despesas';

      $despesa = Despesa::orderBy('nomedespesa','asc')->get();

      return view('despesa.index', compact('title', 'despesa'));

   }

   public function create() {

      $title = 'Cadastrar tipo de despesa';

      $url = '/despesa/register';

      return view('despesa.form', compact('title', 'url'));

   }
   public function save(Request $request) {

      $rules = [];

      $rules = [
         'nomedespesa'             => 'required'
      ];

      $despesa = $request['nomedespesa'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('DespesaController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar o tipo de despesa, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $unit = Despesa::create($request->all());

         return redirect()->action('DespesaController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro do tipo de despesa "'.$despesa.'" realizado com sucesso!');

      }

   }

   public function delete($id) {

      $despesa = Despesa::find($id);

      $nomedespesa = $despesa['nomedespesa'];

      $despesa->delete();

      return redirect()->action('DespesaController@index')
         ->with('class', 'success')
         ->with('msg', 'Tipo de Despesa "'.$nomedespesa.'" excluido com sucesso!');

   }

   public function edit($id) {

      $title = 'Editar Tipo de Despesa';

      $query = Despesa::find($id);

      $url = '/despesa/edit/';

      return view('despesa.form', compact('title', 'query', 'url'));

   }

   public function update(Request $request) {

      
      $rules = [];

      $rules = [
         'nomedespesa'             => 'required',
         'descricao'          => ''
      ];

      $despesa = $request['nomedespesa'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('DespesaController@edit',['id'=>$request['iddespesa']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar alterar o Tipo de Despesa, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $despesa = Despesa::find($request['iddespesa']);
         $despesa->update($request->all());

         return redirect()->action('DespesaController@index')
            ->with('class', 'success')
            ->with('msg', 'Tipo de despesa "'.$despesa.'" alterado com sucesso!');

      }

   }

}
