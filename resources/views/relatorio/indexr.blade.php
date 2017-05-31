@extends('layouts.master')
@section('content')
<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">
      {{ $title }}
      </h1>
   </div>
</div>

@include('layouts.msg')
@include('layouts.erros')

@if($invoice === null)
<div class="row">
	<div class="col-lg-9">
		<form action="{{ url($url) }}" method="post">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="datainicial">Data Inicial</label>
						<input type="text" class="form-control" id="datainicial" name="datainicial" placeholder="00/00/0000" value="" />
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="datafinal">Data Final</label>
						<input type="text" class="form-control" id="datafinal" name="datafinal" placeholder="00/00/0000" value="" />
					</div>
				</div>
			</div>
			<!--
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
		            	<label for="idmes">Mês de referência</label>
		            	<select class="form-control" id="idmes" name="idmes">
		               		<option value="0">--- Mês de Referência ---</option>
		               		<option value="todos">TODOS</option>
		               		@foreach($mes as $key => $value)		                  		
		                  		<option value="{{$value->idmes}}">{{ $value->nome }}</option>
		                	@endforeach
		            	</select>
		         	</div>
				</div>
				
				<div class="col-lg-6">
					<div class="form-group">
						<label for="anoreferencia">Ano de referência</label>
						<select class="form-control" id="anoreferencia" name="anoreferencia">
							<option value="0">---Ano de Referência ---</option>
							<option value="todos">TODOS</option>
							<option value="2017">2017</option>
						</select>
					</div>
				</div>
			</div>
			-->
			<div class="form-group">
				<label for="idunidade">Unidade</label>
				<select class="form-control" id="idunidade" name="idunidade">
					<option value="0">--- Unidade ---</option>
					<option value="todos">TODAS</option>
					@foreach($unidade as $key => $value)
						<option value="{{$value->idunidade}}">{{ $value->nome }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<div class="col-lg-2 col-md-offset-2">
					<label for="todas">
						<input type="radio" name="pago" value="*" checked>Todas
	    			</label>
    			</div>
    			<div class="col-lg-2">
	    			<label for="falta">
	      				<input type="radio" name="pago" value="2">Falta Pagar
	    			</label>
	    		</div>
	    		<div class="col-lg-6">
	    			<label for="pagas">
	      				<input type="radio" name="pago" value="1">Pagas
	    			</label>
	    		</div>
			</div>
			<!--
			<div class="form-group">
				<label for="iddespesa">Tipo de Despesa</label>
				<select class="form-control" id="iddespesa" name="iddespesa">
					<option value="0">--- Despesa ---</option>
					<option value="todos">TODAS</option>
					@foreach($despesa as $key => $value)
						<option value="{{$value->iddespesa}}">{{ $value->nomedespesa}}</option>
					@endforeach
				</select>
			</div>
			-->
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Pesquisar" />
				<input type="reset" class="btn btn-danger" value="Limpar" />
			</div>
			
		</form>
	</div>
</div>
@else

@foreach ($unidade as $kei => $unit)
	<a href="{{ url('/relatorio/download') }}" class="btn btn-danger"><span class="glyphicon glyphicon-save-file"></span> Baixar PDF</a>
	<h2>{{$unit->nome}}</h2>
		@foreach($despesa as $kei => $valor)
			<div class="row">
				<div class="col-md-12">
			    	<table class="table table-striped table-hover">
			    		<thead>
			    			<tr>
			    				<th colspan="5"><strong><center>{{ $valor->nomedespesa}}</center></strong></th>
			    			</tr>
			    			<tr>
			    				<th>Fornecedor</th>
			    				<th>Nº NF</th>
			    				<th>Emissão</th>
			    				<th>CPF/CNPJ</th>
			    				<th>Data Pagamento</th>
			    				<th>Valor</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			<?php $total=0;?>
			    			@foreach($invoice as $key => $value)
			    				@if($valor->iddespesa == $value->iddespesa && $value->idunidade == $unit->idunidade)
					    			<tr>
					    				@if($value->idtipo == 1)
						                	<td>{{ $value->nomepf }}</td>
						                @else
											<td>{{ $value->nomepj }}</td>
						                @endif
					    				<td>{{ $value->numeronota }}</td>
					    				<td>{{ date('d/m/Y', strtotime($value->dtaemissao)) }}</td>
					    				@if($value->idtipo == 1)
					    					<td>{{ $value->cpf }}</td>
					    				@else
					    					<td>{{ $value->cnpj }}</td>
					    				@endif
					    				@if($value->datapagamento <> '')
					    					<td>{{ $value->datapagamento}}</td>
					    				@else
					    					<td>Falta pagar</td>
					    				@endif
					    				<td>R$ {{ number_format($value->valor, 2, ',', '.') }}</td>
					    			</tr>
					    			<?php $total=$total + $value->valor;?>
					    		@endif
			    			@endforeach
			    			<tr>
			    				<td colspan="4"></td>
			    				<td><strong>TOTAL</strong></td>
			    				<td><strong>R$ {{ number_format($total, 2, ',', '.') }}</strong></td>
			    			</tr>
			    		</tbody>
			      	</table>
				</div>
			</div>
		@endforeach
@endforeach		
@endif

@endsection