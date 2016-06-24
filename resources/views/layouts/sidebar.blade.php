<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
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
            <a href="{{ url('/home') }}"><i class="fa fa-fw fa-bar-chart-o"></i> Controle de Notas</a>
        </li>
        <li>
            <a href="{{ url('/home') }}"><i class="fa fa-fw fa-file"></i> Emissão de DARF</a>
        </li>
        <li>
            <a href="{{ url('/home') }}"><i class="fa fa-fw fa-car"></i> Nota de Combustível</a>
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
            </ul>
        </li>
        <li>
            <a href="{{ url('/user') }}"><i class="fa fa-fw fa-user"></i> Usuários</a>
        </li>
   </ul>
</div>
