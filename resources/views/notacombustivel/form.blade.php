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
				<label for="numnota">Número Nota:</label>
				<input type="text" class="form-control" name="numnota" id="numnota" placeholder="Número da Nota" value="@if(isset($query)){{$query['numnota']}}@endif">
			</div>
			@if(isset($query))<input type="hidden" id="idnotacombustivel" name="idnotacombustivel" value="{{$query['idnotacombustivel']}}"> @endif
			<div class="form-group">
		       <label for="data">Data:</label>
		       <input type="text" class="form-control" name="data" id="data" placeholder="Data..." value="@if(isset($query)){{$query['data']}}@endif"/>
		    </div>

		    <div class="form-group">
		       <label for="carro">Carro:</label>
		       <input type="text" class="form-control" name="carro" id="carro" placeholder="Carro..." value="@if(isset($query)){{$query['carro']}}@endif"/>
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
				<label for="idposto">UF:</label>
		 		<select class="form-control" name="idposto" id="idposto">
		    		<option value="0">---POSTO---</option>
		     			@foreach($posto as $key => $value)
		     	  			@if(isset($query) && $value->idposto == $query['idposto'])
		          				<option value="{{$value->idposto}}" selected>{{ $value->nome }}</option>
		          			@else
		          				<option value="{{$value->idposto}}">{{ $value->nome }}</option>
		          			@endif
		     			@endforeach
		 		</select>
			</div>

			<div class="row">
				<div class="col-lg-5">
					<div class="form-group">
						<label for="litros">Litros</label>
						<input type="number" class="form-control" name="litros" id="litros" placeholder="Litros..." value="@if(isset($query)){{$query['litros']}}@endif"/>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="form-group">
						<label for="idtipocombustivel">Tipo Combustível:</label>
				 		<select class="form-control" name="idtipocombustivel" id="idtipocombustivel">
				    		<option value="0">---TIPO COMBUSTIVEL---</option>
				     			@foreach($tipocombustivel as $key => $value)
				     	  			@if(isset($query) && $value->idtipocombustivel == $query['idtipocombustivel'])
				          				<option value="{{$value->idtipocombustivel}}" selected>{{ $value->nome }}</option>
				          			@else
				          				<option value="{{$value->idtipocombustivel}}">{{ $value->nome }}</option>
				          			@endif
				     			@endforeach
				 		</select>
					</div>
				</div>
			</div>

			<div class="form-group">
		       <label for="valor">Valor:</label>
		       <input type="text" class="form-control" name="valor" id="valor" placeholder="Valor..." value="@if(isset($query)){{ number_format($query['valor'], 2, ',', '.') }}@endif" />
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
