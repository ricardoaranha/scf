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
   <div class="col-md-4 col-md-offset-8">
      <form class="form-inline" action="{{ url('/invoice/search') }}" method="post">
         {{ csrf_field() }}
          <div class="form-group">
            <label class="sr-only" for="numeronota">Buscar</label>
            <input type="text" class="form-control" id="numeronota" name="numeronota" placeholder="Buscar" required />
         
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
          </div>
      </form>
   </div>
</div>

<br />

<div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Envio de Nota Fiscal</h4>
      </div>
      <div class="modal-body">
         <h3>Nota Fiscal nº <% data.numeronota %></h3>
         <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
               <form action="{{ url('/pagamento/send') }}" enctype="multipart/form-data" method="post">
                  {{ csrf_field() }}
                  <div class="form-group">
                     <label for="notafiscal">Selecione o arquivo: </label>
                     <input type="file" class="form-control" id="notafiscal" name="notafiscal" aria-describedby="helpBlock" />
                     <span id="helpBlock" class="help-block">* Somente arquivos em .pdf</span>
                     <input type="hidden" id="idnotafiscal" name="idnotafiscal" value="<% data.idnotafiscal %>">
                  </div>
                  <input type="submit" class="btn btn-success" value="Enviar">
               </form>
            </div>
            <div class="col-xs-1"></div>
         </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
   <div class="col-md-12">
      <table class="table table-striped table-hover">
         <thead>
            <tr>
               <th>
                  Número
               </th>
               <th>
                 Mês Referência
               </th>
               <th>
                 Unidade
               </th>
               <th>
                  Data Emissão
               </th>
               <th>
                  Data Vencimento
               </th>
               <th>
                  Valor
               </th>
               <th>
                  Fornecedor
               </th>
               <th>
                  Arquivo
               </th>
            </tr>
         </thead>

         <tbody>
            @foreach($invoice as $key => $value)
               <tr>
                  <td>{{ $value->numeronota }}</td>
                  <td>{{ $value->nomemes }}</td>
                  <td>{{ $value->nomeunidade }}</td>
                  <td>{{ date('d/m/Y', strtotime($value->dtaemissao)) }}</td>
                  <td>{{ date('d/m/Y', strtotime($value->dtavencimento)) }}</td>
                  <td>R$ {{ number_format($value->valor, 2, ',', '.') }}</td>
                  @if($value->idtipo == 1)
                     <td>{{ $value->nomepf }}</td>
                  @else
                     <td>{{ $value->nomepj }}</td>
                  @endif
                  <td>
                     @if($value->bolnotafiscal == 0)
                     <a href="#send" data-toggle="modal" data-target="#send" ng-model="data" ng-click="data = {{ $value }}" class="btn btn-danger"><span class="glyphicon glyphicon-file"></span> Anexar</a>
                     @else
                     <a href="{{ url('/invoice/show/'.$value->idnotafiscal.'/'.$value->numeronota) }}" target="_blank" class="btn btn-success"><span class="glyphicon glyphicon-file"></span> Visualizar</a>
                     @endif
                  </td>
                  
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   <div class="col-md-12"><center>{{ $invoice->links() }}</center></div>
</div>
@endsection
