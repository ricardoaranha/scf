<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
      <style>
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
                  @foreach($invoice as $row)
                  <ul class="list-unstyled">
                     <li><strong>Numero:</strong> {{ $row->numeronota }}</li>
                     <li><strong>Fornecedor:</strong> {{ $row->nome }}</li>
                     <li><strong>Data de emissão:</strong> {{ date('d/m/Y', strtotime($row->dtaemissao)) }}</li>
                     <li><strong>Valor:</strong> R$ {{ $row->valor }}</li>
                     <li><strong>Data de vencimento:</strong> {{ date('d/m/Y', strtotime('dtavencimento')) }}</li>
                  </ul>
                  <hr />
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
