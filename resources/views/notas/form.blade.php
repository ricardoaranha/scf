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

@if (count($errors) > 0)
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
	<div class="col-lg-9">
		<form action="{{ url('/invoice/register') }}" method="post">
		{{ csrf_field() }}
			<div class="form-group">
				<label for="numeronota">Número da Nota</label>
				<input type="text" class="form-control" id="numeronota" name="numeronota" placeholder="Número da Nota">
			</div>
			<div class="form-inline">
				<div class="form-group">
					<label for="dtaemissao">Data de Emissão</label>
					<input type="date" class="form-control" id="dtaemissao" name="dtaemissao" placeholder="00/00/0000">
				</div>
				<div class="form-group">
					<label for="dtavencimento">Data de Vencimento</label>
					<input type="date" class="form-control" id="dtavencimento" name="dtavencimento" placeholder="00/00/0000">
				</div>
			</div>
			<div class="form-group">
				<label for="valor">Valor</label>
				<input type="text" class="form-control" id="valor" name="valor" placeholder="Valor">
			</div>
			<div class="form-group">
				<label for="unidade">Unidade</label>
				<select class="form-control" id="unidade" name="idunidade">
					<option value="0">--- Unidades ---</option>
					@foreach($unidade as $key => $value)
	                	<option value="{{$value->idunidade}}">{{ $value->nome }}</option>
	                @endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="fornecedor">Fornecedor</label>
				<select class="form-control" id="fornecedor" name="idfornecedor">
					<option value="0">--- Fornecedores ---</option>
					@foreach($fornecedor as $key => $value)
						@if($value->idtipo == 1)
							<option value="{{$value->idfornecedor}}">{{ $value->nomepf }}</option>
						@else
							<option value="{{$value->idfornecedor}}">{{ $value->nomefantasia }}</option>	
						@endif
	                	
	                @endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="observacao">Observação</label>
				<textarea class="form-control" rows="3" name="observacao"></textarea>
			</div>
			<br>
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Cadastrar" />
				<input type="reset" class="btn btn-danger" value="Limpar" />
			</div>
		</form>
	</div>
</div>
@endsection
