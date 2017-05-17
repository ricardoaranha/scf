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
   <div class="col-md-4"><a href="{{ url('/diaria/register') }}" class="btn btn-success">Cadastrar</a></div>
   <div class="col-md-4 col-md-offset-4">
      <form class="form-inline" action="{{ url('/diaria/search') }}" method="post">
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
                  Número Ofício
               </th>
               <th>
                  Favorecido
               </th>
               <th>
                  Data
               </th>
               <th>
                  Valor
               </th>
               <th></th>
               <th></th>
            </tr>
         </thead>

         <tbody>
            @foreach($diaria as $key => $value)
               <tr>
                  <td>{{ $value->numoficio }}</td>
                  <td>{{ $value->favorecido }}</td>
                  <td>{{ $value->data }}</td>
                  <td>R$ {{ number_format($value->valor, 2, ',', '.') }}</td>
                  <td>
                     <a href="{{ url('/diaria/edit/'.$value->iddiaria) }}"><span class="text-warning glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                  </td>
                  <td>
                     <a href="{{ url('/diaria/delete/'.$value->iddiaria) }}" onclick="return confirm('Você tem certeza disso?!')"><span class="text-danger glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection
