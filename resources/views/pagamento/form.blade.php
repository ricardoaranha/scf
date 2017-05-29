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
  <div class="col-lg-2"></div>
  <div class="col-lg-8">
    <form action="{{ url($url) }}" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
     <div class="form-group">
        <label for="idformapagamento">Forma de Pagamento</label>
        <select class="form-control" id="idformapagamento" name="idformapagamento">
           <option value="0">--- Forma Pagamento ---</option>
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
        <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" value="@if(isset($query)){{ number_format($query['valor'], 2, ',', '.') }}@endif" onblur="calcular()"/>
      </div>
      <div class="form-group">
        <label for="multa">Multa por atraso</label>
        <input type="text" class="form-control" id="multa" name="multa" placeholder="Multa por atraso" value="@if(isset($query)){{ number_format($query['multa'], 2, ',', '.') }}@endif" onblur="calcular()"/>
      </div>
      <div class="form-group">
        <label for="datapagamento">Data Pagamento</label>
        <input type="text" class="form-control" id="datapagamento" name="datapagamento" placeholder="Data Pagamento" value="@if(isset($query)){{ $query['datapagamento'] }}@endif" />
      </div>
     @if(isset($query))
     <input type="hidden" name="idpagamento" id="idpagamento" value="{{$query['idpagamento']}}" />
     @endif
     <div class="form-group">
        <label for="total">Total</label>
        <div id=resultado>@if(isset($query)) R$ {{ number_format($query['total'], 2, ',', '.') }}@endif</div>
        <input type="hidden" class="form-control" id="total" name="total" value="@if(isset($query)){{ number_format($query['total'], 2, ',', '.') }}@endif" />
      </div>

         
      <br />
      <div class="form-group">
            <input type="submit" class="btn btn-success" value="@if(isset($query)) Salvar @else Cadastrar @endif" />
            @if(isset($query))
            <a href="{{ url('/pagamento') }}" class="btn btn-danger">Cancelar</a>
            @else
            <input type="reset" class="btn btn-danger" value="Limpar" />
            @endif
      </div>
    </form>
  </div>
   <div class="col-lg-2"></div>
</div>
<script type="text/javascript">

function check_num(Num){
    var novoNum = Num.replace(".", "");
    novoNum = novoNum.replace(",", ".");
    novoNum=parseFloat(novoNum);
    //alert(novoNum);
    return novoNum;

    
}
function calcular(){
    var valor = document.getElementById('valor').value;
    valor=check_num(valor);
    //alert(valor);
    var multa = document.getElementById('multa').value;
    multa=check_num(multa);

    document.getElementById('total').value = valor + multa;
    document.getElementById('resultado').innerHTML = valor + multa;
}

</script>
@endsection
