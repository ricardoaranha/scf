<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Unit;
use App\Supplier;
use App\Despesa;
use App\Mes;
use App\Pagamento;
use App\Formapagamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;


class PagamentoController extends Controller {

   public function index() {

      $title = 'Pagamento';

      $invoice = Invoice::select('idnotafiscal', 'numeronota', 'dtaemissao', 'dtavencimento', 'valor', 'idstatus', 'dtacadastro', 'observacao', 'bolnotafiscal', 'idtipo', 'nomepf', 'nomepj', 'unidade.nome as nomeunidade','mes.nome as nomemes')
         ->leftJoin('fornecedor', 'fornecedor.idfornecedor', '=', 'notafiscal.idfornecedor')
         ->leftJoin('statusnota','statusnota.idstatusnota','=','notafiscal.idstatus')
         ->leftJoin('unidade', 'unidade.idunidade', '=', 'notafiscal.idunidade')
         ->leftJoin('mes','mes.idmes','=','notafiscal.idmes')
         ->Where('notafiscal.idstatus', '=', 1)
         ->orderBy('unidade.idunidade','asc')
         ->orderBy('mes.idmes','asc')
         ->paginate(15);

      $formapagamento = Formapagamento::all();

      return view('pagamento.index', compact('title', 'invoice','formapagamento'));

   }

   public function pagar(Request $request){

      $rules = [
         'idformapagamento'      => 'required',
         'valor'                 => 'required',
         'datapagamento'         => 'required'
      ];

      $request['idusuario'] = session()->get('user')['userid'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('PagamentoController@index')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar Pagar a nota , por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $pagamento = Pagamento::create($request->all());

         $invoice = Invoice::find($request['idnotafiscal']);
         //$invoice->notafiscal = $notafiscal;
         $invoice->idstatus = 2;
         $invoice->save();

         return redirect()->action('PagamentoController@index')
            ->with('class', 'success')
            ->with('msg', 'Pagamentoda Nota Fiscal realizado com sucesso!');

      }
   }
}