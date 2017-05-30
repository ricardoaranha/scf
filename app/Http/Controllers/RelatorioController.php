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

		return view('relatorio.index', compact('title', 'url', 'mes', 'unidade', 'despesa', 'invoice'));
	}

	public function notas(){
		$title = 'Relatório de Notas Fiscais';

		$invoice = Invoice::select('notafiscal.iddespesa','despesa.nomedespesa','fornecedor.nomepf','fornecedor.nomepj','fornecedor.idtipo','notafiscal.numeronota','notafiscal.dtaemissao','fornecedor.cpf','fornecedor.cnpj','notafiscal.valor','notafiscal.idunidade','unidade.nome as nomeunidade')
			->leftJoin('despesa','despesa.iddespesa','=','notafiscal.iddespesa')
			->leftJoin('fornecedor','fornecedor.idfornecedor','=','notafiscal.idfornecedor')
			->leftJoin('unidade','unidade.idunidade','=','notafiscal.idunidade')
			->get();

		$despesa = Despesa::all();

		$unidade = Unit::all();

		return view('relatorio.index', compact('title','invoice','despesa','unidade'));
	}
}