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
				<label for="numoficio">Número Ofício:</label>
				<input type="text" class="form-control" name="numoficio" id="numoficio" placeholder="Número Ofício" value="@if(isset($query)){{$query['numoficio']}}@endif">
			</div>
			@if(isset($query))<input type="hidden" id="iddiaria" name="iddiaria" value="{{$query['iddiaria']}}"> @endif
			<div class="form-group">
				<label for="data">Data:</label>
				<input type="text" class="form-control" name="data" id="data" placeholder="Data" value="@if(isset($query)){{$query['data']}}@endif">
			</div>
			<div class="form-group">
				<label for="favorecido">Favorecido:</label>
				<input type="text" class="form-control" name="favorecido" id="favorecido" placeholder="Favorecido" value="@if(isset($query)){{$query['favorecido']}}@endif">
			</div>
			<div class="form-group">
				<label for="cpf">CPF:</label>
				<input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF" value="@if(isset($query)){{$query['cpf']}}@endif">
			</div>
			<div class="form-group">
				<label for="idbanco">Banco:</label>
		 		<select class="form-control" name="idbanco" id="idbanco">
		    		<option value="0">---BANCO---</option>
		     			@foreach($banco as $key => $value)
		     	  			@if(isset($query) && $value->idbanco == $query['idbanco'])
		          				<option value="{{$value->idbanco}}" selected>{{ $value->nomebanco }}</option>
		          			@else
		          				<option value="{{$value->idbanco}}">{{ $value->nomebanco }}</option>
		          			@endif
		     			@endforeach
		 		</select>
			</div>
			<div class="form-group">
		       <label for="agencia">Agência:</label>
		       <input type="text" class="form-control" name="agencia" id="agencia" placeholder="Agência..." value="@if(isset($query)){{$query['agencia']}}@endif"/>
		    </div>
		    <div class="form-group">
		       <label for="conta">Conta:</label>
		       <input type="text" class="form-control" name="conta" id="conta" placeholder="Conta..." value="@if(isset($query)){{$query['conta']}}@endif"/>
		    </div>
		    <div class="form-group">
		       <label for="valor">Valor:</label>
		       <input type="text" class="form-control" name="valor" id="valor" placeholder="Valor..." value="@if(isset($query)){{ number_format($query['valor'], 2, ',', '.') }}@endif" />
		    </div>
		    <div class="form-group">
				<label for="descricao">Descrição:</label>
				<textarea class="form-control" rows="3" id="descricao" name="descricao">@if(isset($query)){{$query['descricao']}}@endif</textarea>
			</div>
				<br />
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="Cadastrar" />
					<input type="reset" class="btn btn-danger" value="Limpar" />
				</div>
			
		</form>
	</div>
</div>

@endsection
