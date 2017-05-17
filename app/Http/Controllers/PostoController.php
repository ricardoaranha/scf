<?php

namespace App\Http\Controllers;

use App\Posto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class PostoController extends Controller {

   public function index() {

      $title = 'Postos';

      $posto = Posto::all();

      return view('posto.index', compact('title', 'posto'));

   }

   public function search(Request $request) {

      $title = 'Postos';

      $posto = Posto::where('nome', 'like', '%'.$request['search'].'%')
         ->get();

      return view('posto.index', compact('title', 'posto'));

   }

   public function create() {

      $title = 'Cadastrar Posto';

      $url = '/posto/register';

      return view('posto.form', compact('title', 'url'));

   }

   public function save(Request $request) {

      $rules = [];

      $rules = [
         'nome'       	=> 'required'
      ];

      $postogasolina = $request['nome'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('PostoController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar o posto, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $posto = Posto::create($request->all());

         return redirect()->action('PostoController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro do Posto "'.$postogasolina.'" realizado com sucesso!');

      }

   }

   public function delete($id) {

      $posto = Posto::find($id);

      $postogasolina = $posto['nome'];

      $posto->delete();

      return redirect()->action('PostoController@index')
         ->with('class', 'success')
         ->with('msg', 'Posto "'.$postogasolina.'" excluido com sucesso!');

   }

   public function edit($id) {

      $title = 'Editar Posto';

      $query = Posto::find($id);

      $url = '/posto/edit';

      return view('posto.form', compact('title', 'query', 'url'));

   }

   public function update(Request $request) {

      
      $rules = [];

      $rules = [
         'nome'             => 'required'
      ];

      $postogasolina = $request['nome'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('PostoController@edit',['id'=>$request['idposto']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar alterar o Posto, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $bank = Posto::find($request['idposto']);
         $bank->update($request->all());

         return redirect()->action('PostoController@index')
            ->with('class', 'success')
            ->with('msg', 'Posto "'.$postogasolina.'" alterado com sucesso!');

      }

   }

}
