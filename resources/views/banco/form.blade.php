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
				<label for="nmero">Número:</label>
				<input type="text" class="form-control" name="numero" id="numero" placeholder="Número" value="@if(isset($query)) {{$query['numero']}} @endif">
				@if(isset($query))<input type="hidden" id="idbanco" name="idbanco" value="{{$query['idbanco']}}"> @endif
			</div>
			<div class="form-group">
				<label for="nome">Nome do Banco:</label>
				<input type="text" class="form-control" name="nomebanco" id="nomebanco" placeholder="Nome do Banco" value="@if(isset($query)) {{$query['nomebanco']}} @endif">
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
