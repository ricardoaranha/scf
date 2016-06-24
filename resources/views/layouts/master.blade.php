<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SCF - {{ $title }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/sb-admin.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ URL::asset('css/plugins/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

   <div id="wrapper">
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         @include('layouts.header')
         @include('layouts.sidebar')
      </nav>

      <div id="page-wrapper">
         <div class="container-fluid">
            @yield('content')
         </div>
      </div>
   </div>


    <!-- jQuery -->
    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.maskedinput.min.js') }}"></script>

    <!-- AngularJS -->
    <script src="{{ URL::asset('js/angular/angular.min.js') }}"></script>
    <script src="{{ URL::asset('js/angular/angular-animate.min.js') }}"></script>
    <script src="{{ URL::asset('js/app.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="{{ URL::asset('js/plugins/morris/raphael.min.js') }}"></script> -->
    <!-- <script src="{{ URL::asset('js/plugins/morris/morris.min.js') }}"></script> -->
    <!-- <script src="{{ URL::asset('js/plugins/morris/morris-data.js') }}"></script> -->

</body>

<script>
   jQuery(function($){
       $("#telefone1, #telefone2").mask("(99) 9999-9999");
       $("#celular1, #celular2").mask("(99) 9-9999-9999");
       $("#cpf").mask("999.999.999-99");
       $("#cnpj").mask("99.999.999/9999-99");
       $("#cep").mask("99999-999");
       $("#dtaemissao, #dtavencimento").mask("99/99/9999");
       $("#inscricaomunicipal").mask("999999999");
   });
</script>

</html>
