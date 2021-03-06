<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php
$idniveluser = session()->get('user')['idniveluser'];
?>
<div class="collapse navbar-collapse navbar-ex1-collapse">
   <ul class="nav navbar-nav side-nav">
        <li class="active">
            <a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> Início</a>
        </li>
        <li>
            <a href="{{ url('/supplier') }}"><i class="fa fa-fw fa-briefcase"></i> Fornecedores</a>
        </li>
        <li>
            <a href="{{ url('/invoice') }}"><i class="fa fa-fw fa-table"></i> Notas Fiscais</a>
        </li>
        <li>
            <a href="{{ url('/folha') }}"><i class="fa fa-fw fa-table"></i> Folha de Pagamento</a>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#controle"><i class="fa fa-fw fa-bar-chart-o"></i> Controle de Notas <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="controle" class="collapse">
                <li>
                    <a href="{{ url('/pagamento/notasescanear') }}">Notas Escanear</a>
                </li>
                <li>
                    <a href="{{ url('/pagamento') }}">Pagamento</a>
                </li>
                <li>
                    <a href="{{ url('/pagamento/notaspagas') }}">Notas Pagas</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ url('/home') }}"><i class="fa fa-fw fa-file"></i> Emissão de DARF</a>
        </li>
        <li>
            <a href="{{ url('/notacombustivel') }}"><i class="fa fa-fw fa-car"></i> Nota de Combustível</a>
        </li>
        <li>
            <a href="{{ url('/diaria') }}"><i class="fa fa-fw fa-money"></i> Diárias</a>
        </li>
        <li>
           <a href="javascript:;" data-toggle="collapse" data-target="#relatorios"><i class="fa fa-fw fa-list"></i> Relatórios <i class="fa fa-fw fa-caret-down"></i></a>
           <ul id="relatorios" class="collapse">
               <li>
                   <a href="{{ url('/relatorio') }}">Notas Fiscais</a>
               </li>
           </ul>
        </li>
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-wrench"></i> Configurações <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="{{ url('/unit') }}">Unidades</a>
                </li>
                <li>
                    <a href="{{ url('/bank') }}">Bancos</a>
                </li>
                <li>
                    <a href="{{ url('/despesa') }}">Tipos de Despesas</a>
                </li>
                <li>
                    <a href="{{ url('/posto') }}">Postos de Gasolina</a>
                </li>
            </ul>
        </li>
        @if($idniveluser == 1)
            <li>
                <a href="{{ url('/user') }}"><i class="fa fa-fw fa-user"></i> Usuários</a>
            </li>
        @endif
        
        <li>
            <a href="{{ url('/password/'.session()->get('user')['userid']) }}"><i class="fa fa-fw fa-refresh"></i> Trocar Senha</a>
        </li>
   </ul>
</div>
