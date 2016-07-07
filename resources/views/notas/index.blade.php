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
   <div class="col-md-4"><a href="{{ url('/invoice/register') }}" class="btn btn-success">Cadastrar</a></div>
   <div class="col-md-3 col-md-offset-5">
      <form class="form-inline" action="{{ url('/invoice/search') }}" method="post">
         {{ csrf_field() }}
         <div class="form-group">
            <label class="sr-only" for="numeronota">Buscar</label>
            <input type="text" class="form-control" id="numeronota" name="numeronota" placeholder="Buscar" required />
         </div>
         <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </form>
   </div>
</div>

<br />

<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalhes</h4>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled">
           <li><strong>Cadastrada em: </strong> <% data.dtacadastro | date: 'dd/MM/yyyy' %></li>
           <li><strong>Numero: </strong><% data.numeronota %></li>
           <li><strong>Data de Emissão: </strong><% data.dtaemissao %></li>
           <li><strong>Data de Vencimento: </strong><% data.dtavencimento %></li>
           <li><strong>Valor: </strong>R$ <% data.valor %></li>
           <li><strong>Fornecedor: </strong><% data.nomepf %><% data.nomepj %></li>
           <li><strong>Unidade: </strong><% data.nome %></li>
           <li><strong>Observações: </strong><% data.observacao %></li>
        </ul>
        <div class="modal-footer" ng-if="data.bolnotafiscal == 1">
           <a href="{{ url('/invoice/show') }}/<% data.idnotafiscal %>/<% data.numeronota %>" target="_blank" class="btn btn-success"><span class="glyphicon glyphicon-file"></span> Visualizar Nota</a>
        </div>
      </div>
    </div>
  </div>
</div>

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
               <form action="{{ url('/invoice/send') }}" enctype="multipart/form-data" method="post">
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
                  Status
               </th>
            </tr>
         </thead>

         <tbody>
            @foreach($invoice as $key => $value)
               <tr>
                  <td>{{ $value->numeronota }}</td>
                  <td>{{ date('d/m/Y', strtotime($value->dtaemissao)) }}</td>
                  <td>{{ date('d/m/Y', strtotime($value->dtavencimento)) }}</td>
                  <td>R$ {{ $value->valor }}</td>
                  @if($value->idtipo == 1)
                     <td>{{ $value->nomepf }}</td>
                  @else
                     <td>{{ $value->nomepj }}</td>
                  @endif
                  <td>
                     @if($value->bolnotafiscal == 0)
                     <a href="#send" data-toggle="modal" data-target="#send" ng-model="data" ng-click="data = {{ $value }}" class="btn btn-danger"><span class="glyphicon glyphicon-file"></span> Enviar Nota</a>
                     @else
                     <a href="{{ url('/invoice/show/'.$value->idnotafiscal.'/'.$value->numeronota) }}" target="_blank" class="btn btn-success"><span class="glyphicon glyphicon-file"></span> Visualizar Nota</a>
                     @endif
                  </td>
                  <td>
                     <a href="#details" data-toggle="modal" data-target="#details" ng-click="data = {{ $value }}"><span class="text-primary glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                  </td>
                  <td>
                     <a href="{{ url('invoice/edit/'.$value->idnotafiscal) }}"><span class="text-warning glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                  </td>
                  <td>
                     <a href="{{ url('/invoice/delete/'.$value->idnotafiscal) }}" onclick="return confirm('Você tem certeza disso?!')"><span class="text-danger glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection
