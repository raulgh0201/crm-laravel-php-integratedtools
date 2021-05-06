  <style>

    .sidebar-dark-primary{
      background-color: #12324D !important;
    }
    .iconav{
      padding-top: 17.5px;
      padding-bottom: 17.5px;
      padding-left: 3px;
      font-size: 20px;
    }
    .pnav{
      padding-left: 10px;
      font-size: 20px;
    }

  </style>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')  }}" class="brand-link">
      <img src= "{{ asset('assets/image/logo-D.png') }}" 
        alt="Logo" width="10" height="30"
        class="brand-image img-circle elevation-9">
      <span class="brand-text font-weight-light">IntegratedTools</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">          
          @if($user->avatar)
            <img src="{{$user->avatar}}" class="img-circle elevation-2" alt="User Image">
            @else
              <img src="/adminlte/dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">            
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{$user->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="iconav fas fa-th"></i>
              
              <p class="pnav">Dashboard
                
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                 <i class="iconav fas fa-user-plus"></i>
              <p class="pnav">
                Contactos
                <i class=" iconav right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">            
              <li class="nav-item">
                <a href="{{ route('user.prospects') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="pnav">Prospectos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.clients') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="pnav">Clientes</p>
                </a>
              </li>

            </ul>
          </li>
          
          <li class="nav-item has-treeview">
            <a onclick="cargar_contenido('contenido_principal','usuarios/vista_usuario_listar.blade.php')" class="nav-link">
                <i class="iconav fas fa-shopping-cart"></i> 
              <p class="pnav">
              Vendas
              </p>
            </a>
          </li>
          <!--<li class="nav-item has-treeview">
          <a onclick="cargar_contenido('contenido_principal','usuario/vista_usuario_listar.blade.php')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul> -->
          
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="iconav fas fa-project-diagram"></i>
              <p class="pnav">
                Proyectos
                
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>