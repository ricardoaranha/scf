<?php

namespace App\Http\Controllers;

use App\Folha;
use App\Unit;
use App\Mes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class FolhaController extends Controller {

   public function index() {

      $title = 'Folha de Pagamento';

      $folha = Folha::select('folha.idfolha','mes.idmes','mes.nome as nomemes','unidade.idunidade','unidade.nome as nomeunidade','folha.valor','folha.ano')
         ->leftJoin('unidade','unidade.idunidade','=','folha.idunidade')
         ->leftJoin('mes','mes.idmes','=','folha.idmes')
         ->orderBy('folha.ano','asc')
         ->orderBy('folha.idmes','asc')
         ->paginate(15);

      return view('folha.index', compact('title', 'folha'));

   }

   public function search(Request $request) {

      $title = 'Folha de Pagamento';

      $folha = Folha::select('folha.idfolha','mes.idmes','mes.nome as nomemes','unidade.idunidade','unidade.nome as nomeunidade','folha.valor','folha.ano')
         ->leftJoin('unidade','unidade.idunidade','=','folha.idunidade')
         ->leftJoin('mes','mes.idmes','=','folha.idmes')
         ->where('mes.nome', 'like', '%'.$request['search'].'%')
         ->orwhere('unidade.nome', 'like', '%'.$request['search'].'%')
         ->get();

      return view('folha.index', compact('title', 'folha'));

   }

   public function create() {

      $title = 'Cadastrar Folha de Pagamento';

      $unidade = Unit::all();

      $mes = Mes::all();

      $url = '/folha/register';

      return view('folha.form', compact('title','unidade', 'mes', 'url'));

   }

   public function save(Request $request) {

      $rules = [];

      $rules = [
         'idmes'       	=> 'required',
         'idunidade'    => 'required',
         'valor'        => 'required',
         'ano'          => 'required'
      ];

      $valor = str_replace('.', '', $request['valor']);
      $request['valor'] = str_replace(',', '.', $valor);

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('FolhaController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar a Folha de Pagamento, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $unit = Folha::create($request->all());

         return redirect()->action('FolhaController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro da Folha de Pagamento realizado com sucesso!');

      }

   }

   public function delete($id) {

      $folha = Folha::find($id);

      $folha->delete();

      return redirect()->action('FolhaController@index')
         ->with('class', 'success')
         ->with('msg', 'Folha de Pagament excluida com sucesso!');

   }

   public function edit($id) {

      $title = 'Folha de Pagamento';

      $unidade = Unit::orderBy('nome','asc')->get();

      $mes = Mes::all();

      $query = Folha::find($id);

      $url = '/folha/edit';

      return view('folha.form', compact('title', 'unidade', 'mes', 'query', 'url'));

   }

   public function update(Request $request) {

      
      $rules = [];

      $rules = [
         'idmes'        => 'required',
         'idunidade'    => 'required',
         'valor'        => 'required',
         'ano'          => 'required'
      ];

      $valor = str_replace('.', '', $request['valor']);
      $request['valor'] = str_replace(',', '.', $valor);

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('FolhaController@edit',['id'=>$request['idfolha']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar alterar a Folha de Pagamento, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $bank = Folha::find($request['idfolha']);
         $bank->update($request->all());

         return redirect()->action('FolhaController@index')
            ->with('class', 'success')
            ->with('msg', 'Folha de Pagamento alterada com sucesso!');

      }

   }

}
