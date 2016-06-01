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
   <div class="col-md-4"><a href="{{ url('/unit/register') }}" class="btn btn-success">Cadastrar</a></div>
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
                  Cidade
               </th>
               <th>
                  Estado
               </th>
            </tr>
         </thead>

         <tbody>
            <tr>
               @foreach($unidade as $key => $value)

               @endforeach
            </tr>
         </tbody>
      </table>
   </div>
</div>
@endsection
