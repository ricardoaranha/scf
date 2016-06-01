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
      <form class="form-inline">
         <div class="form-group">
            <label class="sr-only" for="search">Buscar</label>
            <input type="text" class="form-control" id="search" name="search" placeholder="Buscar" required />
         </div>
         <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </form>
   </div>
</div>

<br />

<div class="row">
   <div class="col-md-12">
      <table class="table table-striped table-hover">
         <thead>
            <tr>
               <th>
                  Nome
               </th>
               <th>
                  CPF/CNPJ
               </th>
               <th>
                  Endereço
               </th>
               <th>
                  CEP
               </th>
               <th>
                  Complemento
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
               <th>
                  Data de Cadastro
               </th>
               <th>
                  Conta
               </th>
               <th>
                  Opções
               </th>
            </tr>
         </thead>

         <tbody>
            <tr>
               @foreach($suppliers as $key => $value)
               <td>
                  @if($value->idtipo == 1)
                  {{ $value->nomepf }}
                  @elseif($value->idtipo == 2)
                  {{ $value->nomefantasia }}
                  @endif
               </td>
               <td>
                  @if($value->idtipo == 1)
                  {{ $value->cpf }}
                  @elseif($value->idtipo == 2)
                  {{ $value->cnpj }}
                  @endif
               </td>
               <td>
                  Rua {{ $value->rua }}, nº {{ $value->numero }}, Bairro {{ $value->bairro }}
               </td>
               <td>
                  {{ $value->cep }}
               </td>
               <td>
                  {{ $value->complemento }}
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
                  {{ date('d/m/Y', strtotime($value->datacadastro)) }}
               </td>
               <td>
                  {{ $value->nome }} <br /> {{ $value->agencia }} <br /> {{ $value->conta }}
               </td>
               @endforeach
            </tr>
         </tbody>
      </table>
   </div>
</div>
@endsection
