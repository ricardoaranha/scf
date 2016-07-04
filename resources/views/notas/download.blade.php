<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
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

            <h4><strong>Período: {{ date('d/m/Y', strtotime($request['dtaInicio'])) }} - {{ date('d/m/Y', strtotime($request['dtaFim'])) }}</strong></h4>

            <br />

            @foreach($invoice as $row)
            <ul class="list-unstyled">
               <li><strong>Numero:</strong> {{ $row->numeronota }}</li>
               <li><strong>Fornecedor:</strong> {{ $row->nome }}</li>
               <li><strong>Data de emissão:</strong> {{ date('d/m/y', strtotime($row->dtaemissao)) }}</li>
               <li><strong>Valor:</strong> R$ {{ $row->valor }}</li>
               <li><strong>Data de vencimento:</strong> {{ date('d/m/Y', strtotime('dtavencimento')) }}</li>
            </ul>
            @endforeach

            <p align="center">
               Gerado em: {{ date('d/m/y') }}
            </p>
         </div>
      </div>

   </body>
</html>
