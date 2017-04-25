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
				<label for="nomedespesa">Tipo de Despesa:</label>
				<input type="text" class="form-control" name="nomedespesa" id="nomedespesa" placeholder="Tipo de Despesa" value="@if(isset($query)){{$query['nomedespesa']}}@endif">
				@if(isset($query))<input type="hidden" id="iddespesa" name="iddespesa" value="{{$query['iddespesa']}}"> @endif
			</div>
			<div class="form-group">
				<label for="decricao">Descrição:</label>
				<textarea class="form-control" name="descricao" id="descricao" placeholder="Descrição">@if(isset($query)){{$query['descricao']}}@endif</textarea>
				
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
