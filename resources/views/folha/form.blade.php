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
	<div class="col-lg-9">
		<form action="{{ url($url) }}" method="post">
		{{ csrf_field() }}
			<div class="form-group">
				<label for="idmes">Mês de referência:</label>
		 		<select class="form-control" name="idmes" id="idmes">
		    		<option value="0">---Mês---</option>
		     			@foreach($mes as $key => $value)
		     	  			@if(isset($query) && $value->idmes == $query['idmes'])
		          				<option value="{{$value->idmes}}" selected>{{ $value->nome }}</option>
		          			@else
		          				<option value="{{$value->idmes}}">{{ $value->nome }}</option>
		          			@endif
		     			@endforeach
		 		</select>
			</div>
			<div class="form-group">
				<label for="ano">Ano de referência</label>
				<input type="text" class="form-control" maxlength="4" name="ano" id="ano" value="@if(isset($query)){{$query['ano']}}@endif">
			</div>
			<div class="form-group">
				<label for="idunidade">Unidade:</label>
		 		<select class="form-control" name="idunidade" id="idunidade">
		    		<option value="0">---UNIDADE---</option>
		     			@foreach($unidade as $key => $value)
		     	  			@if(isset($query) && $value->idunidade == $query['idunidade'])
		          				<option value="{{$value->idunidade}}" selected>{{ $value->nome }}</option>
		          			@else
		          				<option value="{{$value->idunidade}}">{{ $value->nome }}</option>
		          			@endif
		     			@endforeach
		 		</select>
			</div>
			<div class="form-group">
				<label for="valor">Valor</label>
				<input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" value="@if(isset($query)){{ number_format($query['valor'], 2, ',', '.') }}@endif" />
			</div>
			
			@if(isset($query))<input type="hidden" id="idfolha" name="idfolha" value="{{$query['idfolha']}}"> @endif
				<br />
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="Cadastrar" />
					<input type="reset" class="btn btn-danger" value="Limpar" />
				</div>
			
		</form>
	</div>
</div>

@endsection
