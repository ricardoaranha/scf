<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Unit;
use App\Supplier;
use App\Despesa;
use App\Mes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;
use Input;
use PDF;

class InvoiceController extends Controller {

   public function index() {

      $title = 'Notas Fiscais';

      $invoice = Invoice::select('idnotafiscal', 'numeronota', 'dtaemissao', 'dtavencimento', 'valor', 'idstatus', 'dtacadastro', 'observacao', 'bolnotafiscal', 'idtipo', 'nomepf', 'nomepj', 'unidade.nome','mes.nome as nomemes')
         ->leftJoin('fornecedor', 'fornecedor.idfornecedor', '=', 'notafiscal.idfornecedor')
         ->leftJoin('statusnota','statusnota.idstatusnota','=','notafiscal.idstatus')
         ->leftJoin('unidade', 'unidade.idunidade', '=', 'notafiscal.idunidade')
         ->leftJoin('mes','mes.idmes','=','notafiscal.idmes')
         ->get();

      return view('notas.index', compact('title', 'invoice'));

   }

   public function search(Request $request) {

      $title = 'Notas Fiscais';

      $invoice = Invoice::select('idnotafiscal', 'numeronota', 'dtaemissao', 'dtavencimento', 'valor', 'idstatus', 'dtacadastro', 'observacao', 'bolnotafiscal', 'idtipo', 'nomepf', 'nomepj', 'nome')
         ->join('fornecedor', 'fornecedor.idfornecedor', '=', 'notafiscal.idfornecedor')
         ->join('statusnota','statusnota.idstatusnota','=','notafiscal.idstatus')
         ->join('unidade', 'unidade.idunidade', '=', 'notafiscal.idunidade')
         ->where('numeronota', 'like', '%'.$request['numeronota'].'%')
         ->orWhere('cnpj', 'like', '%'.$request['numeronota'].'%')
         ->orWhere('nomepf', 'like', '%'.$request['numeronota'].'%')
         ->orWhere('nomepJ', 'like', '%'.$request['numeronota'].'%')
         ->orWhere('nomefantasia', 'like', '%'.$request['numeronota'].'%')
         ->get();

      return view('notas.index', compact('title', 'invoice'));

   }

   public function create() {

      $title = 'Cadastrar Nota Fiscal';

      $unidade = Unit::orderBy('nome', 'asc')->get();

      $fornecedor = Supplier::all();

      $despesa = Despesa::all();

      $mes = Mes::all();

      $url = '/invoice/register';

      return view('notas.form', compact('title', 'unidade', 'fornecedor', 'despesa', 'mes', 'url'));

   }

   public function save(Request $request) {

      $rules = [
         'numeronota'          => 'required|unique:notafiscal',
         'dtaemissao'          => 'required',
         'dtavencimento'       => 'required',
         'valor'               => 'required',
         'idunidade'           => 'required',
         'idfornecedor'        => 'required'
      ];

      $nota = $request['numeronota'];

      $request['dtacadastro'] = date('Y-m-d');

      $dtavencimento = explode('/', $request['dtavencimento']);
      $request['dtavencimento'] = $dtavencimento[2].'-'.$dtavencimento[1].'-'.$dtavencimento[0];

      $dtaemissao = explode('/', $request['dtaemissao']);
      $request['dtaemissao'] = $dtaemissao[2].'-'.$dtaemissao[1].'-'.$dtaemissao[0];

      $request['idstatus'] = 1;
      $request['idusuario'] = 1;

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('InvoiceController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar a nota Nº "'.$nota.'", por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $invoice = Invoice::create($request->all());

         return redirect()->action('InvoiceController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro da Nota Nº "'.$nota.'" realizado com sucesso!');

      }

   }

   public function upload(Request $request) {

      $notafiscal = $request->file('notafiscal')->getRealPath();

      $rules = [
         'notafiscal' => 'mimes:pdf|required'
      ];

      $notafiscal = file_get_contents($notafiscal);

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('SupplierController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar enviar Nota nº "'.$invoice['numeronota'].'", por favor tente novemente.')
            ->withErrors($validator)
            ->withInput();

      } else {

         $invoice = Invoice::find($request['idnotafiscal']);
         $invoice->notafiscal = $notafiscal;
         $invoice->bolnotafiscal = 1;
         $invoice->save();

         return redirect()->action('InvoiceController@index')
            ->with('class', 'success')
            ->with('msg', 'Envio da Nota nº "'.$invoice['numeronota'].'" realizado com sucesso!');

      }

   }

   public function show($id) {

      $invoice = Invoice::find($id);

      return Response::make($invoice['notafiscal'], 200, array('content-type'=>'application/pdf'));

   }

   public function edit($id) {

      $title = 'Editar Nota Fiscal';

      $query = Invoice::select('idnotafiscal', 'numeronota', 'dtaemissao', 'dtavencimento', 'valor', 'idstatus', 'dtacadastro', 'observacao', 'bolnotafiscal', 'idfornecedor', 'idunidade','iddespesa','idmes')
         ->where('idnotafiscal', $id)
         ->first();

      $unidade = Unit::orderBy('nome', 'asc')->get();

      $despesa = Despesa::all();

      $fornecedor = Supplier::all();

      $mes = Mes::all();

      $url = '/invoice/edit';

      return view('notas.form', compact('title', 'query', 'unidade', 'fornecedor','despesa', 'mes', 'url'));

   }

   public function update(Request $request) {

      $rules = [
         'numeronota'          => 'required',
         'dtaemissao'          => 'required',
         'dtavencimento'       => 'required',
         'valor'               => 'required',
         'idunidade'           => 'required',
         'idfornecedor'        => 'required',
         'notafiscal'          => 'mimes:pdf'
      ];

      $valor = str_replace('.', '', $request['valor']);
      $request['valor'] = str_replace(',', '.', $valor);

      $nota = $request['numeronota'];

      $request['datacadastro'] = date('Y-m-d');

      $dtavencimento = explode('/', $request['dtavencimento']);
      $request['dtavencimento'] = $dtavencimento[2].'-'.$dtavencimento[1].'-'.$dtavencimento[0];

      $dtaemissao = explode('/', $request['dtaemissao']);
      $request['dtaemissao'] = $dtaemissao[2].'-'.$dtaemissao[1].'-'.$dtaemissao[0];

      if ($request['notafiscal'] != null) {
         $notafiscal = $request->file('notafiscal')->getRealPath();
         $notafiscal = file_get_contents($notafiscal);
      }

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('InvoiceController@edit', ['id'=>$request['idnotafiscal']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar atualizar a nota Nº "'.$request['numeronota'].'", por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $invoice = Invoice::find($request['idnotafiscal']);
         $invoice->update($request->all());

         if(isset($notafiscal)) {
            $invoice = Invoice::find($request['idnotafiscal']);
            $invoice->notafiscal = $notafiscal;
            $invoice->save();
         }

         return redirect()->action('InvoiceController@index')
            ->with('class', 'success')
            ->with('msg', 'Alteração da Nota Nº "'.$invoice['numeronota'].'" realizada com sucesso!');

      }

   }

   public function delete($id) {

      $invoice = Invoice::find($id);

      $nota = $invoice['numeronota'];

      $invoice->delete();

      return redirect()->action('InvoiceController@index')
         ->with('class', 'success')
         ->with('msg', 'Unidade "'.$nota.'" excluida com sucesso!');

   }

   public function report(Request $request) {

      $title = 'Relatório de Notas Fiscais';

      $invoice = null;

      if(isset($request['dtaInicio'])) {

         if ($request['search'] <> null) {
            $invoice = Invoice::select('idnotafiscal', 'numeronota', 'dtaemissao', 'dtavencimento', 'valor', 'idstatus', 'dtacadastro', 'observacao', 'bolnotafiscal', 'idtipo', 'nomepf', 'nomepj', 'nome')
            ->leftJoin('fornecedor', 'fornecedor.idfornecedor', '=', 'notafiscal.idfornecedor')
            ->leftJoin('statusnota','statusnota.idstatusnota','=','notafiscal.idstatus')
            ->leftJoin('unidade', 'unidade.idunidade', '=', 'notafiscal.idunidade')
            
            ->orWhere('cnpj', '=', $request['search'])
            ->orWhere('nomepf', 'like', '%'.$request['search'].'%')
            ->orWhere('nomepJ', 'like', '%'.$request['search'].'%')
            ->orWhere('nomefantasia', 'like', '%'.$request['search'].'%')
            ->whereBetween('dtacadastro', [$request['dtaInicio'], $request['dtaFim']])
            ->get();
            
         }else{
            $invoice = Invoice::select('idnotafiscal', 'numeronota', 'dtaemissao', 'dtavencimento', 'valor', 'idstatus', 'dtacadastro', 'observacao', 'bolnotafiscal', 'idtipo', 'nomepf', 'nomepj', 'nome')
            ->leftJoin('fornecedor', 'fornecedor.idfornecedor', '=', 'notafiscal.idfornecedor')
            ->leftJoin('statusnota','statusnota.idstatusnota','=','notafiscal.idstatus')
            ->leftJoin('unidade', 'unidade.idunidade', '=', 'notafiscal.idunidade')
            ->whereBetween('dtacadastro', [$request['dtaInicio'], $request['dtaFim']])
            ->get();

         }

         

         session()->put('invoice', $invoice);
         session()->put('request', ['dtaInicio' => $request['dtaInicio'], 'dtaFim' => $request['dtaFim']]);

      }

      return view('notas.report', compact('title', 'invoice', 'request'));

   }

   public function download() {

      $title = 'Relatório de Notas Fiscais';

      $invoice = session()->get('invoice');

      $request = session()->get('request');

		$pdf = PDF::loadView('notas.download', compact('title', 'invoice', 'request'));

		return $pdf->download('relatorio_notas_fiscais'.date('Y-m-d_H-i').'.pdf');

   }

}
