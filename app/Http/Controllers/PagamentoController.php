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

   public function upload(Request $request) {

      $notafiscal = $request->file('notafiscal')->getRealPath();

      $rules = [
         'notafiscal' => 'mimes:pdf|required'
      ];

      $notafiscal = file_get_contents($notafiscal);

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('PagamentoController@notasescanear')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar anexar Nota, por favor tente novemente.')
            ->withErrors($validator)
            ->withInput();

      } else {

         $invoice = Invoice::find($request['idnotafiscal']);
         $invoice->notafiscal = $notafiscal;
         $invoice->bolnotafiscal = 1;
         $invoice->save();

         return redirect()->action('PagamentoController@notasescanear')
            ->with('class', 'success')
            ->with('msg', 'Envio da Nota nº "'.$invoice['numeronota'].'" realizado com sucesso!');

      }

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

         $valor = str_replace('.', '', $request['valor']);
         $request['valor'] = str_replace(',', '.', $valor);

         $multa = str_replace('.', '', $request['multa']);
         $request['multa'] = str_replace(',', '.', $multa);

         $pagamento = Pagamento::create($request->all());

         $invoice = Invoice::find($request['idnotafiscal']);
         //$invoice->notafiscal = $notafiscal;
         $invoice->idstatus = 2;
         $invoice->save();

         return redirect()->action('PagamentoController@index')
            ->with('class', 'success')
            ->with('msg', 'Pagamento da Nota Fiscal realizado com sucesso!');

      }
   }

   public function notaspagas() {

      $title = 'Notas Pagas';

      $invoice = Invoice::select('notafiscal.idnotafiscal', 'pagamento.idpagamento', 'numeronota', 'dtaemissao', 'dtavencimento', 'notafiscal.valor', 'idstatus', 'dtacadastro', 'observacao', 'bolnotafiscal', 'idtipo', 'nomepf', 'nomepj', 'unidade.nome as nomeunidade','mes.nome as nomemes', 'pagamento.datapagamento')
         ->leftJoin('fornecedor', 'fornecedor.idfornecedor', '=', 'notafiscal.idfornecedor')
         ->leftJoin('statusnota','statusnota.idstatusnota','=','notafiscal.idstatus')
         ->leftJoin('unidade', 'unidade.idunidade', '=', 'notafiscal.idunidade')
         ->leftJoin('mes','mes.idmes','=','notafiscal.idmes')
         ->leftJoin('pagamento','pagamento.idnotafiscal','=','notafiscal.idnotafiscal')
         ->Where('notafiscal.idstatus', '=', 2)
         ->orderBy('unidade.idunidade','asc')
         ->orderBy('mes.idmes','asc')
         ->paginate(15);

      $formapagamento = Formapagamento::all();

      return view('pagamento.notaspagas', compact('title', 'invoice','formapagamento'));

   }

   public function notasescanear() {
      $title = 'Notas para Escanear';

      $invoice = Invoice::select('notafiscal.idnotafiscal', 'pagamento.idpagamento', 'numeronota', 'dtaemissao', 'dtavencimento', 'notafiscal.valor', 'idstatus', 'dtacadastro', 'observacao', 'bolnotafiscal', 'idtipo', 'nomepf', 'nomepj', 'unidade.nome as nomeunidade','mes.nome as nomemes', 'pagamento.datapagamento')
         ->leftJoin('fornecedor', 'fornecedor.idfornecedor', '=', 'notafiscal.idfornecedor')
         ->leftJoin('statusnota','statusnota.idstatusnota','=','notafiscal.idstatus')
         ->leftJoin('unidade', 'unidade.idunidade', '=', 'notafiscal.idunidade')
         ->leftJoin('mes','mes.idmes','=','notafiscal.idmes')
         ->leftJoin('pagamento','pagamento.idnotafiscal','=','notafiscal.idnotafiscal')
         ->Where('notafiscal.bolnotafiscal', '=', 0)
         ->orderBy('unidade.idunidade','asc')
         ->orderBy('mes.idmes','asc')
         ->paginate(15);

      $formapagamento = Formapagamento::all();

      return view('pagamento.notasescanear', compact('title', 'invoice','formapagamento'));
   }

   public function edit($id) {
      $title = 'Editar Nota Fiscal';

      $query = Pagamento::find($id);

      $formapagamento = Formapagamento::all();

      $url = 'pagamento/edit';

      return view('pagamento.form', compact('title', 'query', 'formapagamento', 'url'));
   }

   public function update(Request $request) {

      
      $rules = [];

      $rules = [
         'idformapagamento'      => 'required',
         'valor'                 => 'required',
         'datapagamento'         => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('PagamentoController@edit',['id'=>$request['idpagamento']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar alterar o pagamento, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $valor = str_replace('.', '', $request['valor']);
         $request['valor'] = str_replace(',', '.', $valor);

         $multa = str_replace('.', '', $request['multa']);
         $request['multa'] = str_replace(',', '.', $multa);

         $bank = Pagamento::find($request['idpagamento']);
         $bank->update($request->all());

         return redirect()->action('PagamentoController@notaspagas')
            ->with('class', 'success')
            ->with('msg', 'Pagamento da Nota Fiscal realizado com sucesso!');

      }

   }
}