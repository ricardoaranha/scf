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

<div class="row">
   <div class="col-md-4"><a href="{{ url('/supplier/register') }}" class="btn btn-success">Cadastrar</a></div>

   <div class="col-md-3 col-md-offset-5">
      <form class="form-inline" action="{{ url('/supplier/search')}}" method="post">
         {{ csrf_field() }}
         <div class="form-group">
            <label class="sr-only" for="params">Buscar</label>
            <input type="text" class="form-control" id="params" name="params" placeholder="Buscar" required />
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
           <li><strong>Cadastrado em: </strong> <% data.datacadastro | date: 'dd/MM/yyyy' %></li>
           <li><strong>Nome/Razão Social: </strong><% data.nomepf %><% data.nomepj %></li>
           <li><strong>Nome Fantasia: </strong><% data.nomefantasia %> </li>
           <li><strong>CPF/CNPJ: </strong><% data.cpf %><% data.cnpj %></li>
           <li><strong>Inscrição Municipal: </strong><% data.inscricaomunicipal %></li>
           <li><strong>Enereço: </strong><% data.rua %>, <% data.numero %>, <% data.bairro %></li>
           <li><strong>Complemento: </strong><% data.complemento %></li>
           <li><strong>Cidade/Estado: </strong><% data.cidade %> - <% data.uf %></li>
           <li><strong>CEP: </strong><% data.cep %></li>
           <li><strong>Telefone: </strong><% data.telefone1 %> / <% data.telefone2 %></li>
           <li><strong>Celuler: </strong><% data.celular1 %> / <% data.celular2 %></li>
           <li><strong>Nome Contato: </strong><% data.nomecontato %></li>
           <li><strong>Email: </strong><% data.email %></li>
           <li><strong>Banco: </strong><% data.nomebanco %></li>
           <li><strong>Agência: </strong><% data.agencia %></li>
           <li><strong>Conta: </strong><% data.conta %></li>
        </ul>
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
                  Nome/Razão Social
               </th>
               <th>
                  CPF/CNPJ
               </th>
               <th>
                  Telefone
               </th>
               <th>
                  Celular
               </th>
               <th>
                  Nome Contato
               </th>
               <th>
                  Email
               </th>
               <th colspan="3">
                  Opções
               </th>
            </tr>
         </thead>

         <tbody>

         @foreach($suppliers as $key => $value)
            <tr>
               <td>
                  @if($value->idtipo == 1)
                  {{ $value->nomepf }}
                  @elseif($value->idtipo == 2)
                  {{ $value->nomepj }}
                  @endif
               </td>
               <td>
                  @if($value->idtipo == 1)
                  {{ $value->cpf }}
                  @elseif($value->idtipo == 2)
                  {{ $value->cnpj }}
                  @endif
               </td>
               </td>
               <td>
                  {{ $value->telefone1 }} <br /> {{ $value->telefone2 }}
               </td>
               <td>
                  {{ $value->celular1 }} <br /> {{ $value->celular2 }}
               </td>
               <td>
                  {{ $value->nomecontato }}
               </td>
               <td>
                  {{ $value->email }}
               </td>
               <td>
                  <a href="#details" data-toggle="modal" data-target="#details" ng-model="data" ng-click="data = {{ $value }}"><span class="text-primary glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
               </td>
               <td>
                  <a href="{{ url('/supplier/edit/'.$value->idfornecedor) }}"><span class="text-warning glyphicon glyphicon-edit" aria-hidden="true"></span></a>
               </td>
               <td>
                  <a href="{{ url('/supplier/delete/'.$value->idfornecedor) }}" onclick="return confirm('Você tem certeza disso?!')"><span class="text-danger glyphicon glyphicon-remove" aria-hidden="true"></span></a>
               </td>
            </tr>
         @endforeach

         </tbody>
      </table>
   </div>
</div>

<script>
   $('#details').on('shown.bs.modal', function () {
      $('#details').focus()
   });
</script>
@endsection
