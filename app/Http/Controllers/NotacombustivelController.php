<?php

namespace App\Http\Controllers;

use App\Notacombustivel;
use App\Posto;
use App\Unit;
use App\Tipocombustivel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class NotacombustivelController extends Controller {

   public function index() {

      $title = 'Notas de Combustível';

      $notacombustivel = Notacombustivel::select('idnotacombustivel','numnota','postogasolina.nome as nomeposto','unidade.nome as nomeunidade','carro','tipocombustivel.nome as nometipocombustivel','litros','valor','data')
         ->leftJoin('postogasolina','postogasolina.idposto','=','notacombustivel.idposto')
         ->leftJoin('unidade','unidade.idunidade','=','notacombustivel.idunidade')
         ->leftJoin('tipocombustivel','tipocombustivel.idtipocombustivel','=','notacombustivel.idtipocombustivel')
         ->get();

      return view('notacombustivel.index', compact('title', 'notacombustivel'));

   }

   public function search(Request $request) {

      $title = 'Notas de Combustível';

      $notacombustivel = Notacombustivel::select('idnotacombustivel','numnota','postogasolina.nome as nomeposto','unidade.nome as nomeunidade','carro','tipocombustivel.nome as nometipocombustivel','litros','valor','date_format(data, ‘%d/%m/%Y’) as datanota')
         ->leftJoin('postogasolina','postogasolina.idposto','=','notacombustivel.idposto')
         ->leftJoin('unidade','unidade.idunidade','=','notacombustivel.idunidade')
         ->leftJoin('tipocombustivel','tipocombustivel.idtipocombustivel','=','notacombustivel.idtipocombustivel')
         ->where('numnota', 'like', '%'.$request['search'].'%')
         ->orWhere('unidade.nome', 'like', '%'.$request['search'].'%')
         ->orWhere('posto.nome', 'like', '%'.$request['search'].'%')
         ->get();

      return view('notacombustivel.index', compact('title', 'notacombustivel'));

   }

   public function create() {

      $title = 'Cadastrar Nota de Combustível';

      $url = '/notacombustivel/register';

      $unidade = Unit::all();

      $posto = Posto::all();

      $tipocombustivel = Tipocombustivel::all();

      return view('notacombustivel.form', compact('title', 'url', 'unidade', 'posto', 'tipocombustivel'));

   }

   public function save(Request $request) {

      $rules = [];

      $rules = [
         'numnota'       	=> 'required',
         'idposto'         => 'required',
         'idunidade'       => 'required',
         'valor'           => 'required'
      ];

      $numnota = $request['numnota'];

      $valor = str_replace('.', '', $request['valor']);
      $request['valor'] = str_replace(',', '.', $valor);

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('NotacombustivelController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar a nota de combustível, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $notacombustivel = Notacombustivel::create($request->all());

         return redirect()->action('NotacombustivelController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro da nota "'.$numnota.'" realizado com sucesso!');

      }

   }

   public function delete($id) {

      $notacombustivel = Notacombustivel::find($id);

      $numnota = $notacombustivel['numnota'];

      $notacombustivel->delete();

      return redirect()->action('NotacombustivelController@index')
         ->with('class', 'success')
         ->with('msg', 'Nota de Combustivel "'.$numnota.'" excluido com sucesso!');

   }

   public function edit($id) {

      $title = 'Editar Nota de Combustível';

      $query = Notacombustivel::find($id);

      $url = '/notacombustivel/edit';

      $unidade = Unit::all();

      $posto = Posto::all();

      $tipocombustivel = Tipocombustivel::all();

      return view('notacombustivel.form', compact('title', 'query', 'url', 'unidade', 'posto', 'tipocombustivel'));

   }

   public function update(Request $request) {

      
      $rules = [];

      $rules = [
         'numnota'         => 'required',
         'idposto'         => 'required',
         'idunidade'       => 'required',
         'valor'           => 'required'
      ];

      $numnota = $request['numnota'];

      $valor = str_replace('.', '', $request['valor']);
      $request['valor'] = str_replace(',', '.', $valor);

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('NotacombustivelController@edit',['id'=>$request['idnotacombustivel']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar alterar a Nota de Combustível, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $bank = Notacombustivel::find($request['idnotacombustivel']);
         $bank->update($request->all());

         return redirect()->action('NotacombustivelController@index')
            ->with('class', 'success')
            ->with('msg', 'Nota de Combustível "'.$numnota.'" alterado com sucesso!');

      }

   }

}
