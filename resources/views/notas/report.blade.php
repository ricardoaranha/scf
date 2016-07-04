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

@if($invoice === null)

<div class="row">
   <div class="col-md-6 col-md-offset-3">
      <form action="{{ url('/invoice/report') }}" method="post">
         <fieldset>
            <h3>Buscar notas cadastradas no período de:</h3>
            {{ csrf_field() }}
            <div class="form-group">
               <label for="dtaInicio">Data Inicial</label>
               <input type="date" id="dtaInicio" name="dtaInicio" class="form-control" required />
            </div>
            <div class="form-group">
               <label for="dtaFim">Data Final</label>
               <input type="date" id="dtaFim" name="dtaFim" class="form-control" required />
            </div>
            <div class="form-group">
               <input type="submit" class="btn btn-success" value="Gerar Relatório" />
               <input type="reset" class="btn btn-danger" value="Limpar" />
            </div>
         </fieldset>
      </form>
   </div>
</div>

@else

<div class="row">
   <div class="col-lg-12">
      <a href="{{ url('/invoice/download') }}" class="btn btn-danger"><span class="glyphicon glyphicon-save-file"></span> Baixar PDF</a>

      <h4><strong>Período: {{ date('d/m/Y', strtotime($request['dtaInicio'])) }} - {{ date('d/m/Y', strtotime($request['dtaFim'])) }}</strong></h4>

      <br />
      
      <ul class="list-unstyled">
         @foreach($invoice as $row)
         <li><strong>Numero:</strong> {{ $row->numeronota }}</li>
         <li><strong>Fornecedor:</strong> {{ $row->nome }}</li>
         <li><strong>Data de emissão:</strong> {{ date('d/m/y', strtotime($row->dtaemissao)) }}</li>
         <li><strong>Valor:</strong> R$ {{ $row->valor }}</li>
         <li><strong>Data de vencimento:</strong> {{ date('d/m/Y', strtotime('dtavencimento')) }}</li>
         <br />
         @endforeach
      </ul>

      <p align="center">
         Gerado em: {{ date('d/m/y') }}
      </p>
   </div>
</div>

@endif

@endsection
