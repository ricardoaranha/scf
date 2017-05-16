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


<div class="row">
   <div class="col-lg-2"></div>
	<div class="col-lg-8">
		<form action="{{ url($url) }}" enctype="multipart/form-data" method="post">
		{{ csrf_field() }}
         <div class="form-group">
            <label for="fornecedor">Fornecedor</label>
            <select class="form-control" id="fornecedor" name="idfornecedor">
               <option value="0">--- Fornecedores ---</option>
               @foreach($fornecedor as $key => $value)
                  @if($value->idtipo == 1)
                     @if(isset($query) && $query['idfornecedor'] == $value->idfornecedor)
                        <option value="{{$value->idfornecedor}}" selected>{{ $value->nomepf }} - {{ $value->cpf }}</option>
                     @else
                        <option value="{{$value->idfornecedor}}">{{ $value->nomepf }} - {{ $value->cpf }}</option>
                     @endif
                  @else
                     @if(isset($query) && $query['idfornecedor'] == $value->idfornecedor)
                        <option value="{{$value->idfornecedor}}" selected>{{ $value->nomepj }} - {{ $value->cnpj }}</option>
                     @else
                        <option value="{{$value->idfornecedor}}">{{ $value->nomepj }} - {{ $value->cnpj }}</option>
                     @endif
                  @endif
                @endforeach
            </select>
         </div>
         <div class="form-group">
            <label for="mes">Mês referência</label>
            <select class="form-control" id="idmes" name="idmes">
               <option value="0">--- Mês de Referência ---</option>
               @foreach($mes as $key => $value)
                  @if(isset($query) && $query['idmes'] == $value->idmes)
                  <option value="{{$value->idmes}}" selected>{{ $value->nome }}</option>
                  @else
                  <option value="{{$value->idmes}}">{{ $value->nome }}</option>
                  @endif
                @endforeach
            </select>
         </div>
			<div class="form-group">
				<label for="numeronota">Número da Nota</label>
				<input type="text" class="form-control" id="numeronota" name="numeronota" placeholder="Número da Nota" value="@if(isset($query)){{ $query['numeronota'] }}@endif" />
			</div>
         @if(isset($query))
         <input type="hidden" name="idnotafiscal" id="idnotafiscal" value="{{$query['idnotafiscal']}}" />
         @endif
         <div class="form-group">
            <label for="unidade">Unidade</label>
            <select class="form-control" id="unidade" name="idunidade">
               <option value="0">--- Unidades ---</option>
               @foreach($unidade as $key => $value)
                  @if(isset($query) && $query['idunidade'] == $value->idunidade)
                  <option value="{{$value->idunidade}}" selected>{{ $value->nome }}</option>
                  @else
                  <option value="{{$value->idunidade}}">{{ $value->nome }}</option>
                  @endif
                @endforeach
            </select>
         </div>

         <div class="form-group">
            <label for="despesa">Tipo de despesa</label>
            <select class="form-control" id="iddespesa" name="iddespesa">
               <option value="0">--- Despesa ---</option>
               @foreach($despesa as $key => $value)
                  @if(isset($query) && $query['iddespesa'] == $value->iddespesa)
                  <option value="{{$value->iddespesa}}" selected>{{ $value->nomedespesa }}</option>
                  @else
                  <option value="{{$value->iddespesa}}">{{ $value->nomedespesa }}</option>
                  @endif
                @endforeach
            </select>
         </div>

			<div class="row">
				<div class="col-lg-6">
               <div class="form-group">
   					<label for="dtaemissao">Data de Emissão</label>
   					<input type="text" class="form-control" id="dtaemissao" name="dtaemissao" placeholder="00/00/0000" value="@if(isset($query)){{ date('d/m/Y', strtotime($query['dtaemissao'])) }}@endif" />
   				</div>
				</div>
				<div class="col-lg-6">
               <div class="form-group">
   					<label for="dtavencimento">Data de Vencimento</label>
   					<input type="text" class="form-control" id="dtavencimento" name="dtavencimento" placeholder="00/00/0000" value="@if(isset($query)){{ date('d/m/Y', strtotime($query['dtavencimento'])) }}@endif" />
   				</div>
				</div>
			</div>
			<div class="form-group">
				<label for="valor">Valor</label>
				<input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" value="@if(isset($query)){{ $query['valor'] }}@endif" />
			</div>
			
			
			<div class="form-group">
				<label for="observacao">Observação</label>
				<textarea class="form-control" rows="3" id="observacao" name="observacao">@if(isset($query)){{ $query['observacao'] }}@endif</textarea>
			</div>

         @if(isset($query) && $query['bolnotafiscal'] == 1)
            <div class="form-group">
               <label for="notafiscal">Alterar Nota Fiscal:</label>
               <input type="file" class="form-control" id="notafiscal" name="notafiscal" aria-describedby="helpBlock" />
               <span id="helpBlock" class="help-block">* Somente arquivos em .pdf</span>
            </div>
         @endif

			<br />
			<div class="form-group">
            <input type="submit" class="btn btn-success" value="@if(isset($query)) Salvar @else Cadastrar @endif" />
            @if(isset($query))
            <a href="{{ url('/invoice') }}" class="btn btn-danger">Cancelar</a>
            @else
            <input type="reset" class="btn btn-danger" value="Limpar" />
            @endif
			</div>
		</form>
	</div>
   <div class="col-lg-2"></div>
</div>
@endsection
