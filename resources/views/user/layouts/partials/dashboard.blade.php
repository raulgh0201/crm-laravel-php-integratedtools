<div class="row" id="contenido_principal">
        <div class="col-sm-3">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">fasdfasdf</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class=text-center>5</div>
              </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">asdfasdf</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class=text-center>fasdfasdf</div>
              </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">fasdfasdf</h3>
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
                <h3 class="card-title">asdfasdfasdf</h3>
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
      </div>

      <div class="row mt-4">

        <div class="col-sm-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">fasdfasdfasdf</h3>
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
</div>