<!-- <?php
      if ($_SESSION["loginPerfil"] == 3) {
        echo '<script>
      window.location = "dashboard";
    </script>';
        return;
      }
      ?> -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4><strong>Reportes:. General</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Reportes</a></li>
            <li class="breadcrumb-item active">General</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Módulo Reporte General &nbsp;<i class="fas fa-chart-pie"></i></h3>
      </div>
      <div class="card-body">
      <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label>Seleccione Año:</label>
              <div class="input-group">
                <input class="form-control" type="text" name="anioRG" id="anioRG" value="<?php date_default_timezone_set('America/Lima');
                                                                                                $fechaActual = date('Y');
                                                                                                echo $fechaActual; ?>" readonly>
              </div>
            </div>
          </div>
          <div class=" col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label>Seleccione Mes:</label>
              <div class="input-group">
                <select class="form-control" style="width: 100%;" id="mesRG" name="mesRG">
                  <option value="0">Selecciona Mes</option>
                  <option value="1">ENERO</option>
                  <option value="2">FEBRERO</option>
                  <option value="3">MARZO</option>
                  <option value="4">ABRIL</option>
                  <option value="5">MAYO</option>
                  <option value="6">JUNIO</option>
                  <option value="7">JULIO</option>
                  <option value="8">AGOSTO</option>
                  <option value="9">SETIEMBRE</option>
                  <option value="10">OCTUBRE</option>
                  <option value="11">NOVIEMBRE</option>
                  <option value="12">DICIEMBRE</option>
                </select>
              </div>
            </div>
          </div>
          <div class=" col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label> N° Documento:</label>
              <div class="input-group">
                <input class="form-control" type="text" id="dniPaciente" name="dniPaciente">
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label class="text-light">.</label>
              <div class="input-group">
                <button type="btn" class="btn bg-secondary pull-right" id="deshacer-filtro-AnioMesBusq"><i class="fas fa-undo-alt"></i> Deshacer
                </button>
              </div>
            </div>
          </div>
        </div>

          <a href="public/views/reports/rp-referenciasxls.php?reporte=reporte" class="rg2">
            <button type="btn" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Control de  Referencias
            </button>
          </a>
          <a href="public/views/reports/rp-referenciaspdf.php?reporte=reporte" class="rg1">
            <button type="btn" class="btn btn-success"><i class="fas fa-file-excel"></i> Control de  Referencias
            </button>
          </a>
        </div>
    </div>
  </section>
</div>