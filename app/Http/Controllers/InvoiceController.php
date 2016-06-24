<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Unit;
use App\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;

class InvoiceController extends Controller {

   public function index() {

      $title = 'Notas Fiscais';

      $invoice = Invoice::select('idnotafiscal', 'numeronota', 'dtaemissao', 'dtavencimento', 'valor', 'idstatus', 'dtacadastro', 'observacao', 'bolnotafiscal', 'idtipo', 'nomepf', 'nomepj', 'nome')
         ->leftjoin('fornecedor', 'fornecedor.idfornecedor', '=', 'notafiscal.idfornecedor')
         ->leftjoin('statusnota','statusnota.idstatusnota','=','notafiscal.idstatus')
         ->leftjoin('unidade', 'unidade.idunidade', '=', 'notafiscal.idunidade')
         ->get();

      return view('notas.index', compact('title', 'invoice'));

   }

   public function create() {

      $title = 'Cadastrar Nota Fiscal';

      $unidade = Unit::orderBy('nome', 'asc')->get();

      $fornecedor = Supplier::all();

      $url = '/invoice/register';

      return view('notas.form', compact('title', 'unidade', 'fornecedor', 'url'));

   }

   public function save(Request $request) {

      $rules = [
         'numeronota'          => 'required',
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

      $query = Invoice::select('idnotafiscal', 'numeronota', 'dtaemissao', 'dtavencimento', 'valor', 'idstatus', 'dtacadastro', 'observacao', 'bolnotafiscal', 'idfornecedor', 'idunidade')
         ->where('idnotafiscal', $id)
         ->first();

      $unidade = Unit::orderBy('nome', 'asc')->get();

      $fornecedor = Supplier::all();

      $url = '/invoice/edit';

      return view('notas.form', compact('title', 'query', 'unidade', 'fornecedor', 'url'));

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

}
