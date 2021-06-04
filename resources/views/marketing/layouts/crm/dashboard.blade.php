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
</style>
<div class="row" id="contenido_principal">
        <!--<div class="col-sm-3">
            <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{--{{$n_Users}}--}}</h3>

                      <p>Empleados</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-user-plus"></i>
                    </div>
            </div>
        </div>-->       
        <div class="col-sm-3">
            <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{$n_Prospects}}</h3>

                    <p>Mis Prospectos</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                  </div>
                  <a href="{{route('marketing.prospects')}}" class="small-box-footer">
                    Más Información <i class="fas fa-arrow-circle-right"></i>
                  </a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-info">
                      <div class="inner">
                        <h3>{{$n_Clients}}</h3>

                        <p>Mis Clientes</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                      <a href="{{route('marketing.clients')}}" class="small-box-footer">
                        Más Información <i class="fas fa-arrow-circle-right"></i>
                      </a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-info">
                      <div class="inner">
                        <h3>{{$n_ClientsWithSocial}}</h3>

                        <p>Clientes con Instagram/Facebook</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                      <a href="{{route('marketing.clients')}}" class="small-box-footer">
                        Más Información <i class="fas fa-arrow-circle-right"></i>
                      </a>
            </div>
            <div class="small-box bg-info">
                      <div class="inner">
                        <h3>{{$n_ProspectsWithSocial}}</h3>
                        <p>Prospectos con Instagram/Facebook</p>
                      </div>
                      <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                      <a href="{{route('marketing.clients')}}" class="small-box-footer">
                        Más Información <i class="fas fa-arrow-circle-right"></i>
                      </a>
            </div>
        </div>
        <div class="col-sm-3">
          <div class="small-box bg-info">
                <div class="inner">
                  <h3>67</h3>

                  <p>Mis Proyectos</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Más Información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
          </div>           
      </div>
        <div class="col-sm-3">
          <div class="small-box bg-info">
              <div class="inner">
                <h3>Bruno Sanders</h3>

                <p>Líder de Compras</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="#" class="small-box-footer">
                Más Información <i class="fas fa-arrow-circle-right"></i>
              </a>
          </div>
        </div>
          
      
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
      -->
      </div>

      