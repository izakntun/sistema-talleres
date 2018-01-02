    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> {{--Aquí deberá de ir dinamicamente la foto del usuario o logo de la empresa--}}
            </div>
            <div class="pull-left info">
                <p>Freddy Cantún</p> {{--Aquí deberá de ir dinamicamente el nombre del usuario--}}
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Administrador</a> {{--Aquí deberá de ir dinamicamente el rol del usuario--}}
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menú</li>
            <!-- Optionally, you can add icons to the links -->
            <li @if(Request::is('/')) class="active" @endif><a href="{{ Route('/') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li @if(Request::is('add')) class="active" @endif><a href="{{ Route('clients') }}"><i class="fa fa-user"></i> <span>Clientes</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Catálogo</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
