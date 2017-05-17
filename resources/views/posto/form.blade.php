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
				<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Posto" value="@if(isset($query)){{$query['nome']}}@endif">
			</div>
			@if(isset($query))<input type="hidden" id="idposto" name="idposto" value="{{$query['idposto']}}"> @endif
			<div class="form-group">
		       <label for="localizacao">Localização:</label>
		       <input type="text" class="form-control" name="localizacao" id="localizacao" placeholder="Localização..." value="@if(isset($query)){{$query['localizacao']}}@endif"/>
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
