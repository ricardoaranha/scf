@extends('layouts.master')
@section('content')
<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">
      {{ $title }}
      </h1>
   </div>
</div>
<div class="row">
	<div class="col-lg-9">
		<form>
			<div class="form-group">
				<label for="numeronota">Número da Nota</label>
				<input type="text" class="form-control" id="numeronota" placeholder="Número da Nota">
			</div>
			<div class="form-inline">
				<div class="form-group">
					<label for="dtaemissao">Data de Emissão</label>
					<input type="date" class="form-control" id="dtaemissao" placeholder="00/00/0000">
				</div>
				<div class="form-group">
					<label for="dtavencimento">Data de Vencimento</label>
					<input type="date" class="form-control" id="dtavencimento" placeholder="00/00/0000">
				</div>
			</div>
			<div class="form-group">
				<label for="valor">Valor</label>
				<input type="text" class="form-control" id="valor" placeholder="Valor">
			</div>
			<div class="form-group">
				<label for="unidade">Unidade</label>
				<select class="form-control" id="unidade">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
			<div class="form-group">
				<label for="fornecedor">Fornecedor</label>
				<select class="form-control" id="fornecedor">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
			</div>
			<div class="form-group">
				<label for="observacao">Observação</label>
				<textarea class="form-control" rows="3"></textarea>
			</div>
			<button type="submit" class="btn btn-success">Salvar</button>
		</form>
	</div>
</div>
@endsection
