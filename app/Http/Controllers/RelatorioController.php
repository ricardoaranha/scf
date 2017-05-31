<?php

namespace App\Http\Controllers;

use App\Mes;
use App\Unit;
use App\Despesa;
use App\Invoice;
use App\Bank;
use App\Pagamento;
use App\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Response;
use Input;
use PDF;

class RelatorioController extends Controller {

	public function index(){

		$title = 'Relatórios de Notas Ficais';

		$url = '/relatorio/notas';

		$invoice = null;

		$mes = Mes::all();

		$unidade = Unit::all();

		$despesa = Despesa::all();

		return view('relatorio.indexr', compact('title', 'url', 'mes', 'unidade', 'despesa', 'invoice'));
	}

	public function notas(Request $request){
		$title = 'Relatório de Notas Fiscais';

		$rules = [
			'datainicial'          => 'required',
			'datafinal'          => 'required'
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {

         return redirect()->action('RelatorioController@index')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao gerar o relatório, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      	} else {  

			$datainicial = explode('/', $request['datainicial']);
	      	$datainicial = $datainicial[2].'-'.$datainicial[1].'-'.$datainicial[0];

	      	$datafinal = explode('/', $request['datafinal']);
	      	$datafinal = $datafinal[2].'-'.$datafinal[1].'-'.$datafinal[0];

	      	if($request['idunidade'] == 'todos'){
	      		$request['idunidade'] = '*';
	      	}

	      	if($request['iddespesa'] == 'todos'){
	      		$request['iddespesa'] = '*';
	      	}

			$invoice = Invoice::select('notafiscal.iddespesa','despesa.nomedespesa','fornecedor.nomepf','fornecedor.nomepj','fornecedor.idtipo','notafiscal.numeronota','notafiscal.dtaemissao','fornecedor.cpf','fornecedor.cnpj','notafiscal.valor','notafiscal.idunidade','unidade.nome as nomeunidade','pagamento.datapagamento')
				->leftJoin('despesa','despesa.iddespesa','=','notafiscal.iddespesa')
				->leftJoin('fornecedor','fornecedor.idfornecedor','=','notafiscal.idfornecedor')
				->leftJoin('unidade','unidade.idunidade','=','notafiscal.idunidade')
				->leftJoin('pagamento','pagamento.idnotafiscal','=', 'notafiscal.idnotafiscal')
				->whereBetween('notafiscal.dtaemissao', [$datainicial, $datafinal])
				->Where('notafiscal.idunidade','=',$request['idunidade'])
				->Where('notafiscal.idstatus','<>',$request['pago'])
				//->orWhere('notafiscal.iddespesa','=',$request['iddespesa'])
				->get();

			$unidade = Invoice::select('unidade.idunidade','unidade.nome')
				->distinct('unidade.idunidade')
				->leftJoin('despesa','despesa.iddespesa','=','notafiscal.iddespesa')
				->leftJoin('fornecedor','fornecedor.idfornecedor','=','notafiscal.idfornecedor')
				->leftJoin('unidade','unidade.idunidade','=','notafiscal.idunidade')
				->leftJoin('pagamento','pagamento.idnotafiscal','=', 'notafiscal.idnotafiscal')
				->whereBetween('notafiscal.dtaemissao', [$datainicial, $datafinal])
				->Where('notafiscal.idunidade','=',$request['idunidade'])
				->Where('notafiscal.idstatus','<>',$request['pago'])
				//->orWhere('notafiscal.iddespesa','=',$request['iddespesa'])
				->get();

			$despesa = Despesa::all();

			session()->put('relatorio', $invoice);
			session()->put('request', ['dtaInicio' => $request['datainicial'], 'dtaFim' => $request['datafinal']]);

			return view('relatorio.indexr', compact('title','invoice','despesa','unidade'));
		}

	}

	public function download() {

		$title = 'Relatório de Notas Fiscais';

      	$invoice = session()->get('relatorio');

      	$request = session()->get('request');

		$pdf = PDF::loadView('notas.download', compact('title', 'invoice','request'));

		return $pdf->download('relatorio_notas_fiscais'.date('Y-m-d_H-i').'.pdf');

   }
}