<?php
if ($_SESSION["loginPerfilMR"] == 4) {
  echo '<script>
    window.location = "dashboard";
  </script>';
  return;
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4><strong>Reportes:. Coordinador</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Reportes</a></li>
            <li class="breadcrumb-item active">Coordinador</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Módulo Reportes Coordinador &nbsp;<i class="fas fa-chart-line"></i></h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label>Seleccione Año:</label>
              <div class="input-group">
                <input class="form-control" type="text" name="anioCoord" id="anioCoord" value="<?php date_default_timezone_set('America/Lima');
                                                                                                $fechaActual = date('Y');
                                                                                                echo $fechaActual; ?>" readonly>
              </div>
            </div>
          </div>
          <div class=" col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="form-group">
              <label>Seleccione Mes:</label>
              <div class="input-group">
                <select class="form-control" style="width: 100%;" id="mesCoord" name="mesCoord">
                  <option value="0">Selecciona Mes</option>
                  <?php
                  $meses = LicenciasControlador::ctrListarMeses();
                  foreach ($meses as $key => $value) {
                    echo '<option value="' . $value["idMes"] . '">' . $value["descMes"] . '</option>';
                  }
                  ?>
                </select>
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
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label class="text-light">.</label>
              <div class="input-group">
                <a href="public/views/reports/rp-consolidadoControl.php?reporte=reporte" class="rptControl">
                  <button type="btn" class="btn bg-success" id="btnRptControl"><i class="fas fa-file-excel"></i>&nbsp; Consolidado Control
                  </button>
                </a>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label class="text-light">.</label>
              <div class="input-group">
                <a href="public/views/reports/rp-ControlPersonal.php" class="rptControl2">
                  <button type="btn" class="btn bg-danger" id="btnRptControl2"><i class="fas fa-file-pdf"></i>&nbsp; Consolidado Control
                  </button>
                </a>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label class="text-light">.</label>
              <div class="input-group">
                <a href="public/views/reports/rp-ControlPersonal.php" class="rptControl4">
                  <button type="btn" class="btn bg-info" id="btnRptControl4"><i class="fas fa-file-pdf"></i>&nbsp; Consolidado Control Minsa
                  </button>
                </a>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label class="text-light">.</label>
              <div class="input-group">
                <a href="public/views/reports/rp-LicenciasMaternidad.php" class="rptControl3">
                  <button type="btn" class="btn bg-olive" id="btnRptControl3"><i class="fas fa-file-pdf"></i>&nbsp; Licencias x Maternidad Anual
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label class="text-light">.</label>
              <div class="input-group">
                <a href="public/views/reports/rp-RankingLicencias.php" class="rptControl5">
                  <button type="btn" class="btn bg-gray" id="btnRptControl5"><i class="fas fa-file-pdf"></i>&nbsp; Detalle Acumulado Anual
                  </button>
                </a>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label class="text-light">.</label>
              <div class="input-group">
                <a href="public/views/reports/rp-LicenciasPendientes.php" class="rptControl7">
                  <button type="btn" class="btn bg-warning" id="btnRptControl7"><i class="fas fa-file-pdf"></i>&nbsp; Licencias Pendientes</button>
                </a>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
            <div class="form-group">
              <label class="text-light">.</label>
              <div class="input-group">
                <a href="public/views/reports/rp-LicenciasSuperaSub.php" class="rptControl6">
                  <button type="btn" class="btn bg-primary" id="btnRptControl6"><i class="fas fa-file-pdf"></i>&nbsp; Subsidio > 20 dias
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>