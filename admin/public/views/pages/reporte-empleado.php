<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4><strong>Reportes:. Empleado</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Reportes</a></li>
            <li class="breadcrumb-item active">Empleado</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Módulo Reportes x Empleado &nbsp;<i class="fas fa-chart-pie"></i></h3>
        <div class="card-tools">
          <a href="public/views/docs/rp-KardexEmpleado.php?reporte=reporte" class="rgKardex">
            <button type="btn" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Kardex Empleado
            </button>
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label>Seleccione Año:</label>
              <div class="input-group">
                <input class="form-control" type="text" name="anioPersonal" id="anioPersonal" value="<?php date_default_timezone_set('America/Lima');
                                                                                                $fechaActual = date('Y');
                                                                                                echo $fechaActual; ?>" readonly>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="form-group">
              <label>Seleccione Empleado:</label>
              <div class="input-group">
                <select class="form-control" style="width: 100%;" id="empleadoBusq" name="empleadoBusq">
                  <option value="0">Ingrese N° de DNI o Apellido Paterno del Empleado</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label class="text-light">.</label>
              <div class="input-group">
                <button type="btn" class="btn bg-secondary pull-right" id="deshacer-filtro-EmpleBusqueda"><i class="fas fa-undo-alt"></i> Deshacer
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold"> Dias de Licencia solicitados por Mes</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart rj3">
                                <canvas id="graphDash3" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-gray">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Licencia solicitados por Procedencia</h3>
                        </div>
                        <div class="card-body rj4">
                            <canvas id="graphDash4" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>