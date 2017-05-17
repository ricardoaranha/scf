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
   <div class="col-md-4"><a href="{{ url('/notacombustivel/register') }}" class="btn btn-success">Cadastrar</a></div>
   <div class="col-md-4 col-md-offset-4">
      <form class="form-inline" action="{{ url('/notacombustivel/search') }}" method="post">
         {{ csrf_field() }}
         <div class="form-group">
            <label class="sr-only" for="search">Buscar</label>
            <input type="text" class="form-control" name="search" id="search" name="search" placeholder="Buscar" required />
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
                  Data
               </th>
               <th>
                  Número Nota
               </th>
               <th>
                  Unidade
               </th>
               <th>
                  Posto
               </th>
               <th>
                  Litros
               </th>
               <th>
                  Valor
               </th>
               <th></th>
               <th></th>
            </tr>
         </thead>

         <tbody>
            @foreach($notacombustivel as $key => $value)
               <tr>
                  <td>{{ $value->data }}</td>
                  <td>{{ $value->numnota }}</td>
                  <td>{{ $value->nomeunidade }}</td>
                  <td>{{ $value->nomeposto }}</td>
                  <td>{{ $value->litros }}</td>
                  <td>R$ {{ number_format($value->valor, 2, ',', '.') }}</td>
                  <td>
                     <a href="{{ url('/notacombustivel/edit/'.$value->idnotacombustivel) }}"><span class="text-warning glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                  </td>
                  <td>
                     <a href="{{ url('/notacombustivel/delete/'.$value->idnotacombustivel) }}" onclick="return confirm('Você tem certeza disso?!')"><span class="text-danger glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection
