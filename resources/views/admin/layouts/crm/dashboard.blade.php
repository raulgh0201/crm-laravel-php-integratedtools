<style>
        .card-header{
            background-color: #12324d !important;   
        }
        .btn-primary{
            background-color: #12324d !important; 
        }
        .small-box.bg-info{
            background-color: #12324d !important;
        }
        .icon{
            color: #b8b9b938 !important;
        }
        .small-box-footer{
          background-color: #b8b9b938 !important;
        }
        .titulo-seccion{
          padding-top:20px;
        }
        
</style>
<!--Estilos de mi aplicacion de tascas JS+CSS+HTML(ARNAU )-->
<!--<style>
    .wrap {
      margin: auto;
      max-width: 800px;
      width: 90%;
    }
    .card-header.notas{
      background: #00123aa8 !important;
      color: #fff !important;
      font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,
      "Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
    }
    .card-body.notas {
      background: #12324d;
      color: #fff;
      padding: 50px 0;
      width: 100%;
    }

    .card-body .formulario {
      color: #12324d;
      text-align: center;
    }

    .card-body .formulario input[type=text] {
      margin-bottom: 20px;
      padding: 10px;
      width: 100%;
    }

    .card-body .formulario input[type=text].error {
      border: 5px solid #12324d;
      color: red;
    }

    .card-body .formulario .boton {
      background: none;
      border: 1px solid #b8b9b938;
      color: #fff;
      display: inline-block;
      font-size: 16px;
      padding: 15px;
    }

    .card-body .formulario .boton:hover {
      border: 1px solid #fff;
    }

    /* - footer  - */
    .card-footer .lista {
      list-style: none;
    }

    .card-footer .lista li {
      border-bottom: 1px solid #B6B6B6;
    }

    .card-footer .lista li a {
      color: #212121;
      display: block;
      padding: 20px 0;
      text-decoration: none;
    }

    .card-footer .lista li a:hover {
      text-decoration: line-through;
    }
    .col-sm-6.tareas{
      margin-top: -160px;
      margin-left:50%;
    }
  </style>-->
<!--FIN-->
<h1 class="titulo-seccion">DASHBOARD</h1>
<div class="row dashboard" id="contenido_principal">
        <div class="col-sm-3">
            <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{$n_Users}}</h3>

                      <p>Empleados</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-user-tie"></i>
                    </div>
                    <a href="{{ route('admin.users') }}" class="small-box-footer">
                      Más Información <i class="fas fa-arrow-circle-right"></i>
                    </a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$n_Contacts}}</h3>

                  <p>Contactos</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('admin.contacts') }}" class="small-box-footer">
                  Más Información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{$n_Prospects}}</h3>

                    <p>Prospectos</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-check"></i>
                  </div>
                  <a href="{{ route('admin.prospects') }}" class="small-box-footer">
                    Más Información <i class="fas fa-arrow-circle-right"></i>
                  </a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-info">
                      <div class="inner">
                        <h3>{{$n_Clients}}</h3>

                        <p>Clientes</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-user-tag"></i>
                      </div>
                      <a href="{{ route('admin.clients') }}" class="small-box-footer">
                        Más Información <i class="fas fa-arrow-circle-right"></i>
                      </a>
            </div>
        </div>
        <div class="col-sm-3">
          <div class="small-box bg-info">
              <div class="inner">
                <h3>@if(isset($bestBuyer[0]->name)){{$bestBuyer[0]->name}} @else No Disponible @endif</h3>
                

                <p>Líder en Compras</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="#" class="small-box-footer">
                Más Información <i class="fas fa-arrow-circle-right"></i>
              </a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="small-box bg-info">
              <div class="inner">
                <h3>@if(isset($bestSeller[0]->name)){{$bestSeller[0]->name}} @else No Disponible @endif</h3>
                

                <p>Líder en Ventas</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="#" class="small-box-footer">
                Más Información <i class="fas fa-arrow-circle-right"></i>
              </a>
          </div>
        </div>  
        <div class="col-sm-3">
          <div class="small-box bg-info">
                <div class="inner">
                  <h3>67</h3>

                  <p>Proyectos Totales</p>
                </div>
                <div class="icon">
                  <i class="fas fa-project-diagram"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Más Información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
          </div>           
      </div>
        <!--APP DE JS PARA AÑADIR TAREAS
        <div class="col-sm-6 tareas">
          <div class="card">
            <div class="card-header notas">
              <h3 class="card-title">Escribe tus tareas pendientes</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body notas">
              <div class="wrap">
                <form class="formulario" action="">
                  <input type="text" id="tareaInput" placeholder="Agrega tu tarea">
                  <input type="button" class="boton" id="btn-agregar" value="Agregar Tarea">
                </form>
              </div>      
            </div>
          
            <div class="card-footer notas">
              <div class="wrap">
                <ul class="lista" id="lista">
                  <li><a href="#">1 Escribe aqui tus tareas pendientes.</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>-->
        <!--FIN-->
      <!--
      <div class="col-sm-3">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ventas por Mes</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class=text-center>2000€</div>
              </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Total de Ventas</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class=text-center>500000€</div>
              </div>
            </div>
        </div>
     

      <div class="row mt-4">

        <div class="col-sm-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Proyectos no asignados</h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
               </div>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                @for($i = 0; $i < 6;$i++)
                <li class="list-group-item">
                    MR.Prospect <span class="float-right btn btn-sm btn-success">Assignar</span>
                </li>
                @endfor
                <li class="list-group-item">
                    <a href="#" class="btn btn-block btn-md btn-primary">Ver todo lo que no está asignado</a>
                </li>
              </ul>
            </div>
          </div>       
        </div>
        
        <div class="col-sm-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Estimación Reciente</h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
               </div>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                @for($i = 0; $i < 6;$i++)
                <li class="list-group-item">
                    MR.Prospect ⇸ June 5th, 2020 ⇸ Valor: 100000€  <span class="float-right btn btn-sm btn-success">Detalles</span>
                </li>
                @endfor
                <li class="list-group-item">
                    <a href="#" class="btn btn-block btn-md btn-primary">Ver toda la estimación reciente</a>
                </li>
              </ul>
            </div>
          </div>       
        </div> 
</div>-->
<script src="{{ asset('js/admin/contact/notas/notas.js') }}"></script>