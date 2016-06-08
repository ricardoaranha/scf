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

<form action="{{ url($url) }}" method="post">
   {{ csrf_field() }}
   <div class="row">
      <div class="col-lg-12">
         <div class="form-group" "@if(isset($query) && $query['idtipo'] == 1)" ng-init="pf = true; pj = false" "@else" ng-init="pf = false; pj = true" "@endif">
            <label>Escolha o tipo de fornecedor:</label>
            <br />
            <label class="radio-inline">
               <input type="radio" name="idtipo" id="idtipo" value="1" ng-click="pf = true; pj = false" "@if(isset($query) && $query['idtipo'] == 1)" checked "@endif" /> Pessoa Física
            </label>
            <label class="radio-inline">
               <input type="radio" name="idtipo" id="idtipo" value="2" ng-click="pf = false; pj = true" "@if(isset($query) && $query['idtipo'] == 2)" checked "@elseif(!isset($query))" checked "@endif" /> Pessoa Jurídica
            </label>
            @if(isset($query))
            <input type="hidden" name="idfornecedor" id="idfornecedor" value="{{ $query['idfornecedor'] }}" />
            @endif
         </div>
         <hr />
      </div>
   </div>
   <div class="row">
      <div class="col-lg-1"></div>
      <div class="col-lg-5">
         <fieldset ng-show="pf">
            <legend>Pessoas Física</legend>

            <div class="form-group">
               <label for="nomepf">Nome:</label>
               <input type="text" class="form-control" name="nomepf" id="nomepf"  placeholder="Nome" ng-required="pf" value="@if(isset($query)) {{ $query['nomepf'] }} @endif" />
            </div>

            <div class="form-group">
               <label for="cpf">CPF:</label>
               <input type="text" class="form-control" name="cpf" id="cpf" placeholder="999.999.999-99" ng-required="pf" value="@if(isset($query)) {{ $query['cpf'] }} @endif" />
            </div>
         </fieldset>

         <fieldset ng-show="pj">
            <legend>Pessoa Jurídica</legend>

            <div class="form-group">
               <label for="nomepf">Razão Social:</label>
               <input type="text" class="form-control" name="nomepj" id="nomepj"  placeholder="Nome" ng-required="pj" value="@if(isset($query)) {{ $query['nomepj'] }} @endif"/>
            </div>

            <div class="form-group">
               <label for="nomepf">Nome Fantasia:</label>
               <input type="text" class="form-control" name="nomefantasia" id="nomnomefantasiaepj"  placeholder="Nome Fantasia" ng-required="pj" value="@if(isset($query)) {{ $query['nomefantasia'] }} @endif" />
            </div>

            <div class="form-group">
               <label for="cnpj">CNPJ:</label>
               <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="99.999.999/9999-99" ng-required="pj" value="@if(isset($query)) {{ $query['cnpj'] }} @endif" />
            </div>
         </fieldset>

         <fieldset>
            <legend>Contato</legend>

            <div class="form-group" ng-show="pj">
               <label for="nomecontato">Nome do Contato:</label>
               <input type="text" class="form-control" name="nomecontato" id="nomecontato" placeholder="Nome do contato..." ng-required="pj" value="@if(isset($query)) {{ $query['nomecontato'] }} @endif" />
            </div>

            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="telefone1">Telefone 1:</label>
                     <input type="text" class="form-control" name="telefone1" id="telefone1" placeholder="(99) 9999-9999" ng-required="pj" value="@if(isset($query)) {{ $query['telefone1'] }} @endif" />
                  </div>
               </div>

               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="telefone2">Telefone 2:</label>
                     <input type="text" class="form-control" name="telefone2" id="telefone2" placeholder="(99) 9999-9999" value="@if(isset($query)) {{ $query['telefone2'] }} @endif" />
                  </div>
               </div>
            </div>

            <div class="form-group">
               <label for="email">Email:</label>
               <input type="email" class="form-control" name="email" id="email" placeholder="email@email.com" value="@if(isset($query)) {{ $query['email'] }} @endif" />
            </div>

            <div class="row">
               <div class="col-lg-6">
                  <div class="form-grouṕ">
                     <label for="celular1">Celular 1:</label>
                     <input type="text" class="form-control" name="celular1" id="celular1" placeholder="(99) 9-9999-9999" ng-required="pf" value="@if(isset($query)) {{ $query['celular1'] }} @endif" />
                  </div>
               </div>

               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="celular2">Celular 2:</label>
                     <input type="text" class="form-control" name="celular2" id="celular2" placeholder="(99) 9-9999-9999" value="@if(isset($query)) {{ $query['celular2'] }} @endif" />
                  </div>
               </div>
            </div>
         </fieldset>
      </div>
      <div class="col-lg-5">
         <fieldset>
            <legend>Endereço</legend>

            <div class="form-group">
               <label for="rua">Rua:</label>
               <input type="text" class="form-control" name="rua" id="rua" placeholder="Rua..." value="@if(isset($query)) {{ $query['rua'] }} @endif" />
            </div>

            <div class="form-group">
               <label for="bairro">Bairro:</label>
               <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro..." value="@if(isset($query)) {{ $query['bairro'] }} @endif" />
            </div>

            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="numero">Número:</label>
                     <input type="text" class="form-control" name="numero" id="numero" placeholder="Número..." value="@if(isset($query)) {{ $query['numero'] }} @endif" />
                  </div>
               </div>

               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="cep">CEP:</label>
                     <input type="text" class="form-control" name="cep" id="cep" placeholder="99999-999" value="@if(isset($query)) {{ $query['cep'] }} @endif" />
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="cidade">Cidade:</label>
                     <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade..." value="@if(isset($query)) {{ $query['cidade'] }} @endif" />
                  </div>
               </div>

               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="idestado">UF:</label>
                     <select class="form-control" name="idestado" id="idestad">
                        <option value="0">---UF---</option>
                           @foreach($states as $key => $value)
                              @if(isset($query) && $value->idestado == $query['uf'])
                              <option value="{{$value->idestado}}" selected>{{ $value->sigla }}</option>
                              @else
                              <option value="{{$value->idestado}}">{{ $value->sigla }}</option>
                              @endif
                           @endforeach
                     </select>
                  </div>
               </div>
            </div>

            <div class="form-group">
               <label for="complemento">Complemento:</label>
               <textarea name="complemento" class="form-control" id="complemento" rows="2" cols="40" placeholder="Complemento...">@if(isset($query)) {{ $query['complemento'] }} @endif</textarea>
            </div>
         </fieldset>

         <fieldset>
            <legend>Dados Bancários</legend>

            <div class="form-group">
               <label for="idbanco">Banco:</label>
               <select class="form-control" name="idbanco" id="idbanco">
                  <option value="0">---SELECIONE UM BANCO---</option>
                     @foreach($bank as $key => $value)
                        @if(isset($query) && $value->idbanco == $query['idbanco'])
                        <option value="{{$value->idbanco}}" selected>{{ $value->nomebanco }}</option>
                        @else
                        <option value="{{$value->idbanco}}">{{ $value->nomebanco }}</option>
                        @endif
                     @endforeach
               </select>
            </div>

            <div class="row">
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="agencia">Agência:</label>
                     <input type="text" class="form-control" name="agencia" id="agencia" placeholder="9999-9" value="@if(isset($query)) {{ $query['agencia'] }} @endif" />
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label for="conta">Conta:</label>
                     <input type="text" class="form-control" name="conta" id="conta" placeholder="9.999-9" value="@if(isset($query)) {{ $query['conta'] }} @endif" />
                  </div>
               </div>
            </div>
         </fieldset>
      </div>
   </div>
   <div class="col-lg-1"></div>

   <div class="row">
      <div class="col-md-6 col-md-offset-3">
         <br />
         <div class="form-group">
            <input type="submit" class="btn btn-success" value="@if(isset($query)) Salvar @else Cadastrar @endif" />
            @if(isset($query))
            <a href="{{ url('/supplier') }}" class="btn btn-danger">Cancelar</a>
            @else
            <input type="reset" class="btn btn-danger" value="Limpar" />
            @endif
         </div>
      </div>
   </div>
</form>
<br /><br /><br />
@endsection
