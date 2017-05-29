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

<div class="modal fade" id="pagar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pagamento de NOTA FISCAL</h4>
      </div>
      <div class="modal-body">
         <h3>Nº <% data.numeronota %></h3>
         <h5><% data.nomepf %><% data.nomepj %></h5>
         <h5>R$ <% data.valor %></h5>
         <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-10">
               <form action="{{ url('/pagamento/pagar') }}" enctype="multipart/form-data" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" id="idnotafiscal" name="idnotafiscal" value="<% data.idnotafiscal %>">
                  <div class="form-group">
                    <label for="formapagamento">Forma de Pagamento</label>
                    <select class="form-control" id="idformapagamento" name="idformapagamento">
                       <option value="0">--- Forma de Pagamento ---</option>
                       @foreach($formapagamento as $key => $value)
                          @if(isset($query) && $query['idformapagamento'] == $value->idformapagamento)
                          <option value="{{$value->idformapagamento}}" selected>{{ $value->nome }}</option>
                          @else
                          <option value="{{$value->idformapagamento}}">{{ $value->nome }}</option>
                          @endif
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" value="<% data.valor %>" />
                  </div>
                  <div class="form-group">
                    <label for="multa">Multa por Atraso</label>
                    <input type="text" class="form-control" id="multa" name="multa" placeholder="Multa por atraso" value="" />
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="datapagamento">Data Pagamento</label>
                        <input type="text" class="form-control" id="datapagamento" name="datapagamento" placeholder="00/00/0000" value="" />
                      </div>
                    </div>
                    <input type="hidden" class="form-control" id="datacadastro" name="datacadastro"  value="{{date('d/m/Y')}}" />
                  </div>
                  <div class="form-group">
                    <label for="total">Total por Atraso</label>
                    <input type="text" class="form-control" id="total" name="total" placeholder="Total" value="" />
                  </div>
                  <div class="form-group">
                        <input type="submit" class="btn btn-success" value="@if(isset($query)) Salvar @else Cadastrar @endif" />
                        @if(isset($query))
                        <a href="{{ url('/invoice') }}" class="btn btn-danger">Cancelar</a>
                        @else
                        <input type="reset" class="btn btn-danger" value="Limpar" />
                        @endif
                  </div>

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
                 Data Pagamento
               </th>
               <th>
                  Valor
               </th>
               <th>
                  Fornecedor
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
                  <td>{{ $value->datapagamento }}</td>
                  <td>R$ {{ number_format($value->valor, 2, ',', '.') }}</td>
                  @if($value->idtipo == 1)
                     <td>{{ $value->nomepf }}</td>
                  @else
                     <td>{{ $value->nomepj }}</td>
                  @endif
                  <td>
                     <a href="{{ url('pagamento/edit/'.$value->idpagamento) }}" class="btn btn-success"><span class="text-warning glyphicon glyphicon-edit"></span> Alterar Pagamento</a>
                  </td>
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
