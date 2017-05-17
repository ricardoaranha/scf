<?php

namespace App\Http\Controllers;

use App\Diaria;
use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class DiariaController extends Controller {

   public function index() {

      $title = 'Diárias';

      $diaria = Diaria::select('iddiaria','numoficio','data','favorecido','cpf','cpf','nomebanco','agencia','conta','valor','descricao')
         ->leftJoin('banco','banco.idbanco','=','diaria.idbanco')
         ->get();

      return view('diaria.index', compact('title', 'diaria'));

   }

   public function search(Request $request) {

      $title = 'Diárias';

      $diaria = Diaria::select('iddiaria','numoficio','data','favorecido','cpf','cpf','nomebanco','agencia','conta','valor','descricao')
         ->where('numoficio', 'like', '%'.$request['search'].'%')
         ->orWhere('favorecido', 'like', '%'.$request['search'].'%')
         ->get();

      return view('diaria.index', compact('title', 'diaria'));

   }

   public function create() {

      $title = 'Cadastrar de Diária';

      $url = '/diaria/register';

      $banco = Bank::all();

      return view('diaria.form', compact('title', 'url', 'banco'));

   }

   public function save(Request $request) {

      $rules = [];

      $rules = [
         'favorecido'       	=> 'required',
         'cpf'                => 'required',
         'valor'              => 'required'
      ];

      $numoficio = $request['numoficio'];

      $valor = str_replace('.', '', $request['valor']);
      $request['valor'] = str_replace(',', '.', $valor);

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('DiariaController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar a diária, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $posto = Diaria::create($request->all());

         return redirect()->action('DiariaController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro da diária "'.$numoficio.'" realizado com sucesso!');

      }

   }

   public function delete($id) {

      $diaria = Diaria::find($id);

      $numoficio = $diaria['numoficio'];

      $diaria->delete();

      return redirect()->action('DiariaController@index')
         ->with('class', 'success')
         ->with('msg', 'Diária "'.$numoficio.'" excluido com sucesso!');

   }

   public function edit($id) {

      $title = 'Editar Diária';

      $query = Diaria::find($id);

      $url = '/diaria/edit';

      $banco = Bank::all();

      return view('diaria.form', compact('title', 'query', 'url', 'banco'));

   }

   public function update(Request $request) {

      
      $rules = [];

      $rules = [
         'favorecido'         => 'required',
         'cpf'                => 'required',
         'valor'              => 'required'
      ];

      $numoficio = $request['numoficio'];

      $valor = str_replace('.', '', $request['valor']);
      $request['valor'] = str_replace(',', '.', $valor);

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('DiariaController@edit',['id'=>$request['iddiaria']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar alterar a diária, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $bank = Diaria::find($request['iddiaria']);
         $bank->update($request->all());

         return redirect()->action('DiariaController@index')
            ->with('class', 'success')
            ->with('msg', 'Diária "'.$numoficio.'" alterado com sucesso!');

      }

   }

}
