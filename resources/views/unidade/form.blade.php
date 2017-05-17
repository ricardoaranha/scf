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
				<label for="nome">Nome:</label>
				<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da Unidade" value="@if(isset($query)){{$query['nome']}}@endif">
			</div>
			@if(isset($query))<input type="hidden" id="idunidade" name="idunidade" value="{{$query['idunidade']}}"> @endif
			<div class="form-group">
		       <label for="rua">Rua:</label>
		       <input type="text" class="form-control" name="rua" id="rua" placeholder="Rua..." value="@if(isset($query)){{$query['rua']}}@endif"/>
		    </div>

		    <div class="form-group">
		       <label for="bairro">Bairro:</label>
		       <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro..." value="@if(isset($query)){{$query['bairro']}}@endif"/>
		    </div>

		    <div class="row">
		       <div class="col-lg-6">
		          <div class="form-group">
		             <label for="numero">Número:</label>
		             <input type="text" class="form-control" name="numero" id="numero" placeholder="Número..." value="@if(isset($query)){{$query['numero']}}@endif"/>
		          </div>
		       </div>

		       <div class="col-lg-6">
		          <div class="form-group">
		             <label for="cep">CEP:</label>
		             <input type="text" class="form-control" name="cep" id="cep" placeholder="99999-999" value="@if(isset($query)){{$query['cep']}}@endif"/>
		          </div>
		       </div>
		    </div>

		    <div class="row">
		       <div class="col-lg-6">
		          <div class="form-group">
		             <label for="cidade">Cidade:</label>
		             <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade..." value="@if(isset($query)){{$query['cidade']}}@endif"/>
		          </div>
		       </div>

		       <div class="col-lg-6">
		          <div class="form-group">
		             <label for="uf">UF:</label>
		             <select class="form-control" name="idestado" id="idestado">
		                <option value="0">---UF---</option>
		                 @foreach($estados as $key => $value)
		                 	  @if(isset($query) && $value->idestado == $query['idestado'])
	                          	<option value="{{$value->idestado}}" selected>{{ $value->nomeestado }}</option>
	                          @else
	                          	<option value="{{$value->idestado}}">{{ $value->nomeestado }}</option>
	                          @endif
		                 @endforeach
		             </select>
		          </div>
		       </div>
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
