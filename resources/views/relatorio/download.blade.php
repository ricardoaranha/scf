<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title></title>
   <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
   <style>
      body{
         font-size: 10px;
      }
      .page-break {
          page-break-after: always;
      }

      .list-unstyled {
         list-style: none;
      }
   </style>
</head>
<body>
   <div class="row">
      <div class="col-lg-12">
         <h1 class="page-header">
            {{ $title }}
         </h1>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="panel panel-default">
            <div class="panel-heading">
               <strong>Período: {{ date('d/m/Y', strtotime($request['dtaInicio'])) }} - {{ date('d/m/Y', strtotime($request['dtaFim'])) }}</strong>
            </div>
            <div class="panel-body">
               @foreach ($unidade as $kei => $unit)
                  <strong>{{$unit->nome}}</strong>
                  @foreach($despesa as $kei => $valor)
                     <table class="table">
                        <thead>
                           <tr>
                              <th colspan="6"><strong><center>{{ $valor->nomedespesa}}</center></strong></th>
                           </tr>
                           <tr>
                              <th>Fornecedor</th>
                              <th>Nº NF</th>
                              <th>Emissão</th>
                              <th>CPF/CNPJ</th>
                              <th>Data Pagamento</th>
                              <th>Valor</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $total=0;?>
                           @foreach($invoice as $key => $value)
                              @if($valor->iddespesa == $value->iddespesa && $value->idunidade == $unit->idunidade)
                                 <tr>
                                    @if($value->idtipo == 1)
                                       <td>{{ $value->nomepf }}</td>
                                    @else
                                       <td>{{ $value->nomepj }}</td>
                                    @endif
                                    <td>{{ $value->numeronota }}</td>
                                    <td>{{ date('d/m/Y', strtotime($value->dtaemissao)) }}</td>
                                    @if($value->idtipo == 1)
                                       <td>{{ $value->cpf }}</td>
                                    @else
                                       <td>{{ $value->cnpj }}</td>
                                    @endif
                                    @if($value->datapagamento <> '')
                                       <td>{{ $value->datapagamento}}</td>
                                    @else
                                       <td>Falta pagar</td>
                                    @endif
                                    <td>R$ {{ number_format($value->valor, 2, ',', '.') }}</td>
                                 </tr>
                                 <?php $total=$total + $value->valor;?>
                              @endif
                           @endforeach
                           <tr>
                              <td colspan="5"></td>
                              <td><strong>TOTAL R$ {{ number_format($total, 2, ',', '.') }}</strong></td>
                           </tr>
                        </tbody>
                     </table>
                  @endforeach
               @endforeach 
            </div>
         </div>
         <p align="center">
            Gerado em: {{ date('d/m/Y') }}
         </p>
      </div>
   </div>
   <script src="{{ URL::asset('js/jquery.js') }}"></script>
</body>
</html>
