<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Unit;
use App\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class InvoiceController extends Controller {

   public function index() {

      $title = 'Notas Fiscais';

      $invoice = Invoice::leftjoin('fornecedor', 'fornecedor.idfornecedor', '=', 'notafiscal.idfornecedor')
                        ->leftjoin('statusnota','statusnota.idstatusnota','=','notafiscal.idstatus')->get();;

      return view('notas.index', compact('title', 'invoice'));

   }

   public function create() {

      $title = 'Cadastrar Nota Fiscal';

      $unidade = Unit::orderBy('nome', 'asc')->get();

      $fornecedor = Supplier::all();

      return view('notas.form', compact('title', 'unidade', 'fornecedor'));

   }

   public function save(Request $request) {
      echo $request['dtaemissao'];
      //var_dump($request);
      //echo "</pre>";
      //exit;

      $rules = [
         'numeronota'          => 'required',
         'dtaemissao'          => 'required',
         'dtavencimento'       => 'required',
         'valor'               => 'required',
         'idunidade'           => 'required',
         'idfornecedor'        => 'required'
      ];



      $nota = $request['numeronota'];

      $request['datacadastro'] = date('Y-m-d');
      $request['idstatus'] = 1;
      $request['idusuario'] = 1;

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('InvoiceController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar a nota, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $invoice = Invoice::create($request->all());

         return redirect()->action('InvoiceController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro da Nota "'.$nota.'" realizado com sucesso!');

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
