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
				<label for="userfirstname">Primeiro Nome:</label>
				<input type="text" class="form-control" name="userfirstname" id="userfirstname" placeholder="Primeiro Nome" value="@if(isset($query)){{$query['userfirstname']}}@endif">
				@if(isset($query))<input type="hidden" id="userid" name="userid" value="{{$query['userid']}}"> @endif
			</div>
			<div class="form-group">
				<label for="userlastname">Segundo Nome:</label>
				<input type="text" class="form-control" name="userlastname" id="userlastname" placeholder="Segundo Nome" value="@if(isset($query)){{$query['userlastname']}}@endif">
			</div>
			<div class="form-group">
				<label for="userlogin">Login:</label>
				<input type="text" class="form-control" name="userlogin" id="userlogin" placeholder="Login" value="@if(isset($query)){{$query['userlogin']}}@endif">
			</div>
			<div class="form-group">
				<label for="uf">Nivel de Usuário:</label>
				<select class="form-control" name="idniveluser" id="idniveluser">
				<option value="0">---Nivel de Usuário---</option>
				 @foreach($niveluser as $key => $value)
				 	  @if(isset($query) && $value->idniveluser == $query['idniveluser'])
				      	<option value="{{$value->idniveluser}}" selected>{{ $value->nomeniveluser }}</option>
				      @else
				      	<option value="{{$value->idniveluser}}">{{ $value->nomeniveluser }}</option>
				      @endif
				 @endforeach
				</select>
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
