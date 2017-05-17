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
   <div class="col-md-4"><a href="{{ url('/posto/register') }}" class="btn btn-success">Cadastrar</a></div>
   <div class="col-md-4 col-md-offset-4">
      <form class="form-inline" action="{{ url('/posto/search') }}" method="post">
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
                  Nome
               </th>
               <th>
                  Localização
               </th>
               <th></th>
               <th></th>
               <th></th>
            </tr>
         </thead>

         <tbody>
            @foreach($posto as $key => $value)
               <tr>
                  <td>{{ $value->nome }}</td>
                  <td>{{ $value->localizacao }}</td>
                  <td>
                     <a href="{{ url('/posto/edit/'.$value->idposto) }}"><span class="text-warning glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                  </td>
                  <td>
                     <a href="{{ url('/posto/delete/'.$value->idposto) }}" onclick="return confirm('Você tem certeza disso?!')"><span class="text-danger glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endsection
