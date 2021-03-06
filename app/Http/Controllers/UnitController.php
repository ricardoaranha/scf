<?php

namespace App\Http\Controllers;

use App\Unit;
use App\States;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class UnitController extends Controller {

   public function index() {

      $title = 'Unidades';

      $unidade = Unit::all();

      return view('unidade.index', compact('title', 'unidade'));

   }

   public function search(Request $request) {

      $title = 'Unidades';

      $unidade = Unit::where('nome', 'like', '%'.$request['search'].'%')
         ->get();

      return view('unidade.index', compact('title', 'unidade'));

   }

   public function create() {

      $title = 'Cadastrar Unidade';

      $estados = States::all();

      $url = '/unit/register';

      return view('unidade.form', compact('title','estados', 'url'));

   }

   public function save(Request $request) {

      $rules = [];

      $rules = [
         'nome'       	=> 'required',
         'rua'          => 'required',
         'numero'       => 'required',
         'bairro'       => 'required',
         'cidade'       => 'required',
         'idestado'     => '',
         'cep'          => 'required'
      ];

      $unidade = $request['nome'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('UnitController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar a unidade, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $unit = Unit::create($request->all());

         return redirect()->action('UnitController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro da Unidade "'.$unidade.'" realizado com sucesso!');

      }

   }

   public function delete($id) {

      $unit = Unit::find($id);

      $unidade = $unit['nome'];

      $unit->delete();

      return redirect()->action('UnitController@index')
         ->with('class', 'success')
         ->with('msg', 'Unidade "'.$unidade.'" excluida com sucesso!');

   }

   public function edit($id) {

      $title = 'Editar Unidade';

      $estados = States::orderBy('nomeestado','asc')->get();

      $query = Unit::find($id);

      $url = '/unit/edit';

      return view('unidade.form', compact('title', 'estados', 'query', 'url'));

   }

   public function update(Request $request) {

      
      $rules = [];

      $rules = [
         'nome'             => 'required',
         'rua'              => 'required',
         'bairro'           => 'required',
         'numero'           => 'required',
         'cep'              => 'required',
         'cidade'           => 'required'
      ];

      $unidade = $request['nome'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('UnitController@edit',['id'=>$request['idunidade']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar alterar a Unidade, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $bank = Unit::find($request['idunidade']);
         $bank->update($request->all());

         return redirect()->action('UnitController@index')
            ->with('class', 'success')
            ->with('msg', 'Unidade "'.$unidade.'" alterado com sucesso!');

      }

   }

}
