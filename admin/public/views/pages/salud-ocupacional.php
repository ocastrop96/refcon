<?php
if ($_SESSION["loginPerfilMR"] == 5) {
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
          <h4><strong>Gestión:. Salud Ocupacional</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Gestión</a></li>
            <li class="breadcrumb-item active">Salud Ocupacional</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Módulo Salud Ocupacional &nbsp;<i class="fas fa-user-md"></i></h3>
        <div class="card-tools">
          <a href="public/views/reports/rp-AuditoriaSO.php?reporte=reporte">
            <button type="btn" class="btn btn-success"><i class="fas fa-file-excel"></i> Auditoria Salud Ocupacional Anulaciones
            </button>
          </a>
        </div>
      </div>
      <div class="card-body">
        <button type="btn" class="btn btn-secondary" data-toggle="modal" data-target="#modal-registrar-aislamiento"><i class="fas fa-user-md"></i> Registrar Aislamiento
        </button>
        <input type="hidden" id="idUsAnuSO" value="<?php echo $_SESSION["loginIdMR"]; ?>">
      </div>
      <div class="card-body">
        <table id="datatableAislamientoMR" class="table table-bordered table-hover dt-responsive datatableAislamientoMR">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>N°</th>
              <th style="width: 10px">Fecha</th>
              <th>DNI</th>
              <th>Apellidos y Nombres</th>
              <th>Dpto. y/o Of.</th>
              <th>Motivo</th>
              <th>Recomendación</th>
              <th>Inicio</th>
              <th>Fin</th>
              <th>N° Dias</th>
              <th>Reincorp.</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>

<div id="modal-registrar-aislamiento" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="" role="form" id="formRegAis" method="post">
        <div class="modal-header text-center bg-olive" style="color: white">
          <h4 class="modal-title">Registrar Salud Ocupacional&nbsp; <i class="fas fa-user-md"></i></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h6 class="font-weight-bold">1. Búsqueda de Empleado. &nbsp;<i class="fas fa-hospital-user"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["loginIdMR"]; ?>">
                <label for="rgEmpAis">Solicitante: &nbsp;</label>
                <i class="fas fa-people-carry"></i> *
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" id="rgEmpAis" name="rgEmpAis">
                    <option value="0">Ingrese N° DNI o Apellido del Empleado</option>
                  </select>
                  <input type="hidden" name="autoCode" id="autoCode" value="<?php echo 'SOP' . sha1(time()); ?>">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rgLocAis">Locación: &nbsp;</label>
                <i class="fas fa-sitemap"></i> *
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" id="rgLocAis" name="rgLocAis">
                    <option value="0">Selecciona locación</option>
                    <?php
                    $locaciones = SOcupControlador::ctrListarLocaciones();
                    foreach ($locaciones as $key => $value) {
                      echo '<option value="' . $value["idLocacion"] . '">' . $value["descLocacion"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <h6 class="font-weight-bold">2. Datos de la solicitud. &nbsp;<i class="fas fa-hospital-user"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="rgfIngAis">Ingreso: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="rgfIngAis" id="rgfIngAis" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                  <input type="hidden" name="fingre" id="fingre">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="rgAisDesde">Inicio: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="rgAisDesde" id="rgAisDesde" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                  <input type="hidden" name="fdesde1" id="fdesde1">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="rgAisHasta">Fin: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="rgAisHasta" id="rgAisHasta" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                  <input type="hidden" name="fhasta1" id="fhasta1">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="rgDiasAis">N° Dias: &nbsp;</label>
                <div class="input-group">
                  <input type="text" name="rgDiasAis" id="rgDiasAis" class="form-control" required readonly>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="rgAisRein">Reincorporación: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="rgAisRein" id="rgAisRein" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="rgAisCel">Celular: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="rgAisCel" id="rgAisCel" class="form-control" autocomplete="off" placeholder="Celular (Opc)">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="rgAisNI">NI: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <input type="text" class="form-control" name="rgAisNI" id="rgAisNI" placeholder="Ingrese NI(Opc)" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="rgAisCM">Correlativo: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <input type="text" class="form-control" name="rgAisCM" id="rgAisCM" placeholder="Ingrese CM(Opc)" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="rgAisMotivo">Motivo: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" id="rgAisMotivo" name="rgAisMotivo">
                    <option value="0">Seleccione motivo</option>
                    <?php
                    $motivo = SOcupControlador::ctrListarMotivos();
                    foreach ($motivo as $key => $value) {
                      echo '<option value="' . $value["idMotivo"] . '">' . $value["descMotivo"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="rgAisRecomen">Recomendación: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <input type="text" class="form-control" name="rgAisRecomen" id="rgAisRecomen" placeholder="Ingrese recomendación" autocomplete="off" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnRegAis"><i class="fas fa-save"></i> Guardar</button>
          <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $registraSO = new SOcupControlador();
        $registraSO->ctrRegistrarSaludOcupacional();
        ?>
      </form>
    </div>
  </div>
</div>

<div id="modal-editar-aislamiento" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="" role="form" id="formEdtAis" method="post">
        <div class="modal-header text-center bg-olive" style="color: white">
          <h4 class="modal-title">Editar Salud Ocupacional&nbsp; <i class="fas fa-user-md"></i></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h6 class="font-weight-bold">1. Búsqueda de Empleado. &nbsp;<i class="fas fa-hospital-user"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <input type="hidden" name="idUsMod" id="idUsMod" value="<?php echo $_SESSION["loginIdMR"]; ?>">
                <label for="edtEmpAis">Solicitante: &nbsp;</label>
                <i class="fas fa-people-carry"></i> *
                <span class="font-weight-bolder text-danger" id="seleccionEmp11">ACTUAL : </span>
                <span class="font-weight-bolder" id="seleccionEmp1"></span>
                <div class="input-group">
                  <input type="hidden" name="idAis" id="idAis">
                  <select class="form-control" style="width: 100%;" id="edtEmpAis" name="edtEmpAis">
                    <option value="" id="edtEmpAis1"></option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="edtLocAis">Locación: &nbsp;</label>
                <i class="fas fa-sitemap"></i> *
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" id="edtLocAis" name="edtLocAis">
                    <option value="" id="edtLocAis1"></option>
                    <?php
                    $locaciones = SOcupControlador::ctrListarLocaciones();
                    foreach ($locaciones as $key => $value) {
                      echo '<option value="' . $value["idLocacion"] . '">' . $value["descLocacion"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <h6 class="font-weight-bold">2. Datos de la solicitud. &nbsp;<i class="fas fa-hospital-user"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="edtfIngAis">Ingreso: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="edtfIngAis" id="edtfIngAis" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                  <input type="hidden" name="edtfingre" id="edtfingre">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="edtAisDesde">Inicio: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="edtAisDesde" id="edtAisDesde" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                  <input type="hidden" name="edtfdesde1" id="edtfdesde1">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="edtAisHasta">Fin: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="edtAisHasta" id="edtAisHasta" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                  <input type="hidden" name="edtfhasta1" id="edtfhasta1">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="edtDiasAis">N° Dias: &nbsp;</label>
                <div class="input-group">
                  <input type="text" name="edtDiasAis" id="edtDiasAis" class="form-control" required readonly>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="edtAisRein">Reincorporación: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="edtAisRein" id="edtAisRein" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="edtAisCel">Celular: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="edtAisCel" id="edtAisCel" class="form-control" autocomplete="off" placeholder="Celular (Opc)">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="edtAisNI">NI: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <input type="text" class="form-control" name="edtAisNI" id="edtAisNI" placeholder="Ingrese NI(Opc)" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-2">
              <div class="form-group">
                <label for="edtAisCM">Correlativo: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <input type="text" class="form-control" name="edtAisCM" id="edtAisCM" placeholder="Ingrese CM(Opc)" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="edtAisMotivo">Motivo: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" id="edtAisMotivo" name="edtAisMotivo">
                    <option value="" id="edtAisMotivo1"></option>
                    <?php
                    $motivo1 = SOcupControlador::ctrListarMotivos();
                    foreach ($motivo1 as $key => $value) {
                      echo '<option value="' . $value["idMotivo"] . '">' . $value["descMotivo"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="edtAisRecomen">Recomendación: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <input type="text" class="form-control" name="edtAisRecomen" id="edtAisRecomen" placeholder="Ingrese recomendación" autocomplete="off" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnEdtAis"><i class="fas fa-save"></i> Guardar cambios</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $editaSO = new SOcupControlador();
        $editaSO->ctrEditarSaludOcupacional();
        ?>
      </form>
    </div>
  </div>
</div>

<?php
$anulaSO = new SOcupControlador();
$anulaSO->ctrAnularSaludOcupacional();
?>