@extends('layouts.login')
@section('content')
<div class="row">
   <div class="col-md-6 col-md-offset-3">
      <h1 class="page-header">
      {{ $title }}
      </h1>
   </div>
</div>
<div class="row">
   <div class="col-md-6 col-md-offset-3">
      @if(Session::has('msg'))
      <div class="alert alert-{{ session()->get('class') }} alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <strong>{{ session()->get('msg') }}</strong>
      </div>
      @endif
      <div class="col-md-8 col-md-offset-2">
         <form action="{{ URL::to('/login') }}" method="post">
            <fieldset>
               <div class="form-group">
                  <label for="userlogin">
                     Nome:
                  </label>
                  <input type="text" class="form-control" id="userlogin" name="userlogin" required />
               </div>
               <div class="form-group">
                  <label for="userpasswd">
                     Senha:
                  </label>
                  <input type="password" class="form-control" id="userpasswd" name="userpasswd" required />
               </div>
               <input name="_token" hidden value="{!! csrf_token() !!}" />
               <input type="submit" class="btn btn-success btn-md btn-block" value="Entrar">
               <!-- <a href="{{ URL::to('/login/cadastrar') }}" class="btn btn-primary btn-md btn-block">Cadastrar</a> -->
            </fieldset>
         </form>
      </div>
   </div>
</div>
@endsection
