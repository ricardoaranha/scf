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
		<form action="{{ url('/unit/register') }}" method="post">
		{{ csrf_field() }}
			<div class="form-group">
				<label for="nome">Nome:</label>
				<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da Unidade">
			</div>
			<div class="form-group">
		       <label for="rua">Rua:</label>
		       <input type="text" class="form-control" name="rua" id="rua" placeholder="Rua..." />
		    </div>

		    <div class="form-group">
		       <label for="bairro">Bairro:</label>
		       <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro..." />
		    </div>

		    <div class="row">
		       <div class="col-lg-6">
		          <div class="form-group">
		             <label for="numero">Número:</label>
		             <input type="text" class="form-control" name="numero" id="numero" placeholder="Número..." />
		          </div>
		       </div>

		       <div class="col-lg-6">
		          <div class="form-group">
		             <label for="cep">CEP:</label>
		             <input type="text" class="form-control" name="cep" id="cep" placeholder="99999-999" />
		          </div>
		       </div>
		    </div>

		    <div class="row">
		       <div class="col-lg-6">
		          <div class="form-group">
		             <label for="cidade">Cidade:</label>
		             <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade..." />
		          </div>
		       </div>

		       <div class="col-lg-6">
		          <div class="form-group">
		             <label for="uf">UF:</label>
		             <select class="form-control" name="uf" id="uf">
		                <option value="0">---UF---</option>
		                 @foreach($estados as $key => $value)
		                 <option value="{{$value->sigla}}">{{ $value->nome }}</option>
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
