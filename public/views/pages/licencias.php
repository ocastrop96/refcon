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
          <h4><strong>Gestión:. Licencias</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Gestión</a></li>
            <li class="breadcrumb-item active">Licencias</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Módulo Licencias &nbsp;<i class="fas fa-file-invoice"></i></h3>
      </div>
      <div class="card-body">
        <button type="btn" class="btn btn-secondary" data-toggle="modal" data-target="#modal-registrar-licencias"><i class="fas fa-file-invoice"></i> Registrar Licencia
        </button>
        <input type="hidden" id="idUsuarioAnu" value="<?php echo $_SESSION["loginIdMR"]; ?>">
      </div>
      <div class="card-body">
        <table id="datatableLicenciasMR" class="table table-bordered table-hover dt-responsive datatableLicenciasMR">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>N° Solicitud</th>
              <th>N° Exp. Ant</th>
              <th style="width: 10px">Fecha Ingreso</th>
              <th>DNI N°</th>
              <th>Empleado</th>
              <th>Condición</th>
              <th>Desde</th>
              <th>Hasta</th>
              <th>N° Dias</th>
              <th>Entidad</th>
              <th>Año-Mes Médico</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>
<!-- Registrar de Licencia -->
<div id="modal-registrar-licencias" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="" role="form" id="formRegLic" method="post">
        <div class="modal-header text-center bg-olive" style="color: white">
          <h4 class="modal-title">Registrar Licencia&nbsp; <i class="fas fa-file-invoice"></i></h4>
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
                <label for="rgEmp">Solicitante: &nbsp;</label>
                <i class="fas fa-people-carry"></i> *
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" id="rgEmp" name="rgEmp">
                    <option value="0">Ingrese N° DNI o Apellido del Empleado</option>
                  </select>
                </div>
                <input type="hidden" name="autoCode" id="autoCode" value="<?php echo 'CLC' . sha1(time()); ?>">
              </div>
            </div>
          </div>
          <h6 class="font-weight-bold">2. Datos de la solicitud. &nbsp;<i class="fas fa-hospital-user"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="rgfIngreso">Ingreso: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="rgfIngreso" id="rgfIngreso" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="rgfDesde">Desde: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="rgfDesde" id="rgfDesde" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                  <input type="hidden" name="fdesde" id="fdesde">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="rgfHasta">Hasta: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="rgfHasta" id="rgfHasta" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                  <input type="hidden" name="fhasta" id="fhasta">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="rgNDias">N° Dias: &nbsp;</label>
                <div class="input-group">
                  <input type="text" name="rgNDias" id="rgNDias" class="form-control" required readonly>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="rgAMedico">Año Médico: &nbsp;</label>
                <i class="fas fa-indent"></i> *
                <div class="input-group">
                  <input type="text" name="rgAMedico" id="rgAMedico" class="form-control" required value="<?php date_default_timezone_set('America/Lima');
                                                                                                          $fechaActual = date('Y');
                                                                                                          echo $fechaActual; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="rgMMedico">Mes Médico: &nbsp;</label>
                <i class="fas fa-indent"></i> *
                <div class="input-group">
                  <select class="form-control" id="rgMMedico" name="rgMMedico">
                    <option value="0">Seleccione Mes</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <h6 class="font-weight-bold">3. Entidad de Atención, Médico y Diagnóstico. &nbsp;<i class="fas fa-user-injured"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="rgTipEnt">Tipo Entidad: &nbsp;</label>
                <i class="fas fa-indent"></i> *
                <div class="input-group">
                  <select class="form-control" id="rgTipEnt" name="rgTipEnt">
                    <option value="0">Seleccione Tipo Entidad</option>
                    <?php
                    $tipoEntidad = LicenciasControlador::ctrListaTiposEntidad();
                    foreach ($tipoEntidad as $key => $value) {
                      echo '<option value="' . $value["idTipoEnt"] . '">' . $value["descTipoEnt"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="rgNRuc">RUC N°: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgNRuc" id="rgNRuc" placeholder="Ingrese RUC (Opcional)" maxlength="11">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4" id="btnRucEnti">
              <div class="form-group">
                <label>Búsqueda:<span class="text-danger">&nbsp;*</span></label>
                <div class="input-group">
                  <button type="button" class="btn btn-block btn-success" id="btnRUCEnt"><i class="fas fa-search"></i>&nbsp;Consulta RUC</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-5 col-md-5 col-lg-5">
              <div class="form-group">
                <label for="rgNomEnt">Nombre de Entidad: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgNomEnt" id="rgNomEnt" placeholder="Ingrese razón social (Opcional)">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="rgCMP">CMP N°: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgCMP" id="rgCMP" placeholder="Ingrese CMP">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-5 col-md-5 col-lg-5">
              <div class="form-group">
                <label for="rgNomMed">Nombres del Médico: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgNomMed" id="rgNomMed" placeholder="Ingrese nombre médico">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-2" id="btnBusDx">
              <div class="form-group">
                <label>Búsqueda:<span class="text-danger">&nbsp;*</span></label>
                <div class="input-group">
                  <button type="button" class="btn btn-block btn-info" id="btnDx" data-toggle="modal" data-target="#modal-busqueda-dx"><i class="fas fa-search"></i>&nbsp;Consulta Dx</button>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="rgCieDX">Diagnóstico: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <input type="text" class="form-control" name="rgCieDX" id="rgCieDX" placeholder="Ingrese CIE10" readonly value="SCI">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-8 col-md-8 col-lg-8">
              <div class="form-group">
                <label for="rgDesDX">Detalle Diagnóstico: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <input type="text" class="form-control" name="rgDesDX" id="rgDesDX" placeholder="Ingrese detalle Dx">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="rgServ">Servicio Atención : &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgServ" id="rgServ" placeholder="Ingrese servicio de atención">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="rgCITT">CITT ESSALUD: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgCITT" id="rgCITT" placeholder="IIngrese CITT ESSALUD">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="rgEstado">Estado: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <select class="form-control" id="rgEstado" name="rgEstado">
                    <option value="0">Seleccione Estado</option>
                    <?php
                    $estadoLice = LicenciasControlador::ctrListaEstadoLice();
                    foreach ($estadoLice as $key => $value) {
                      echo '<option value="' . $value["idEstLic"] . '">' . $value["descEstLic"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <h6 class="font-weight-bold">4. Presentación de Documentos. &nbsp;<i class="fas fa-hospital-user"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="rgTipDoc">Tipo Documento: &nbsp;</label>
                <i class="fas fa-indent"></i> *
                <div class="input-group">
                  <select class="form-control" id="rgTipDoc" name="rgTipDoc">
                    <option value="0">Seleccione Tipo Documento</option>
                    <?php
                    $tipoDoc = LicenciasControlador::ctrListaTipDoc();
                    foreach ($tipoDoc as $key => $value) {
                      echo '<option value="' . $value["idTipoDoc"] . '">' . $value["descTipoDoc"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="rgNDoc">N° Documento: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgNDoc" id="rgNDoc" placeholder="Ingrese N° Documento">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="rgFDoc">Fecha Documento: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="rgFDoc" id="rgFDoc" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rgDescip">Descripción: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgDescip" id="rgDescip" placeholder="Ingrese descripción de documento">
                </div>
              </div>
            </div>
            <!-- <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="">Adjunto (ZIP o RAR < 2MB): &nbsp;</label>
                    <i class="fas fa-search"></i>
                    <div class="custom-file">
                      <input type="file" class="" name="" id="">
                    </div>
              </div>
            </div> -->
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rgObserva">Observaciones: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <textarea name="rgObserva" id="rgObserva" class="form-control" placeholder="Ingrese observaciones (Opcional)" rows="4"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnRegLic"><i class="fas fa-save"></i> Guardar</button>
          <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $registrarLicencia = new LicenciasControlador();
        $registrarLicencia->ctrRegistrarLicencia();
        ?>
      </form>
    </div>
  </div>
</div>
<!-- Registrar de Licencia -->
<!-- Busqueda de Dx -->
<div id="modal-busqueda-dx" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center" style="background: #7EB2C2; color: white">
        <h4 class="modal-title">Búsqueda de Diagnóstico&nbsp; <i class="fas fa-diagnoses"></i></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
              <label for="">Diagnóstico &nbsp;</label>
              <i class="fas fa-stethoscope"></i> *
              <div class="input-group">
                <input type="text" name="searchDx" id="searchDx" class="form-control" placeholder="Ingrese CIE10 o Descripción" required autocomplete="off" autofocus="autofocus">
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-2">
            <div class="form-group">
              <label>Buscar Dx</label>
              <div class="input-group">
                <button type="button" class="btn btn-block btn-info" id="btnDxCarga1"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div id="dataDx"></div>
      </div>
    </div>
  </div>
</div>
<!-- Busqueda de Dx -->
<!-- Editar Licencias -->
<div id="modal-editar-licencia" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="" role="form" id="formEdtLic" method="post">
        <div class="modal-header text-center bg-olive" style="color: white">
          <h4 class="modal-title">Editar Licencia&nbsp; N° <span id="correlativoEdt"></span> <i class="fas fa-file-invoice"></i></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h6 class="font-weight-bold">1. Datos de Empleado. &nbsp;<i class="fas fa-hospital-user"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <input type="hidden" name="idUsuarioM" id="idUsuarioM" value="<?php echo $_SESSION["loginIdMR"]; ?>">
                <label for="edtEmp">Solicitante: &nbsp;</label>
                <i class="fas fa-people-carry"></i> *
                <div class="input-group">
                  <input type="text" class="form-control" name="edtEmp" id="edtEmp" readonly>
                  <input type="hidden" name="idEmpleado" id="idEmpleado">
                  <input type="hidden" name="idLicencia" id="idLicencia">

                </div>
              </div>
            </div>
          </div>
          <h6 class="font-weight-bold">2. Datos de la solicitud. &nbsp;<i class="fas fa-hospital-user"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="edtfIngreso">Ingreso: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="edtfIngreso" id="edtfIngreso" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="edtfDesde">Desde: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="edtfDesde" id="edtfDesde" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                  <input type="hidden" name="edfdesde" id="edfdesde">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="edtfHasta">Hasta: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="edtfHasta" id="edtfHasta" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                  <input type="hidden" name="edfhasta" id="edfhasta">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="edtNDias">N° Dias: &nbsp;</label>
                <div class="input-group">
                  <input type="text" name="edtNDias" id="edtNDias" class="form-control" required readonly>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="edtAMedico">Año Médico: &nbsp;</label>
                <i class="fas fa-indent"></i> *
                <div class="input-group">
                  <input type="text" name="edtAMedico" id="edtAMedico" class="form-control" required readonly>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="rgMMedico">Mes Médico: &nbsp;</label>
                <i class="fas fa-indent"></i> *
                <div class="input-group">
                  <select class="form-control" id="edtMMedico" name="edtMMedico">
                    <option id="edtMMedico1"></option>
                    <option value="0">SIN MES</option>
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
          </div>
          <h6 class="font-weight-bold">3. Entidad de Atención, Médico y Diagnóstico. &nbsp;<i class="fas fa-user-injured"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="edtTipEnt">Tipo Entidad: &nbsp;</label>
                <i class="fas fa-indent"></i> *
                <div class="input-group">
                  <input type="hidden" name="edtAMedicoR" id="edtAMedicoR">
                  <input type="hidden" name="edtNDiasA" id="edtNDiasA">
                  <input type="hidden" name="edtMMedicoA" id="edtMMedicoA">
                  <select class="form-control" id="edtTipEnt" name="edtTipEnt">
                    <option value="" id="edtTipEnt1"></option>
                    <?php
                    $tipoEntidad = LicenciasControlador::ctrListaTiposEntidad();
                    foreach ($tipoEntidad as $key => $value) {
                      echo '<option value="' . $value["idTipoEnt"] . '">' . $value["descTipoEnt"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="edtNRuc">RUC N°: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtNRuc" id="edtNRuc" placeholder="Ingrese RUC (Opcional)" maxlength="11">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4" id="btnRucEnti">
              <div class="form-group">
                <label>Búsqueda:<span class="text-danger">&nbsp;*</span></label>
                <div class="input-group">
                  <button type="button" class="btn btn-block btn-success" id="btnRUCEntEdt"><i class="fas fa-search"></i>&nbsp;Consulta RUC</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-5 col-md-5 col-lg-5">
              <div class="form-group">
                <label for="edtNomEnt">Nombre de Entidad: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtNomEnt" id="edtNomEnt" placeholder="Ingrese razón social (Opcional)">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="edtCMP">CMP N°: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtCMP" id="edtCMP" placeholder="Ingrese CMP">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-5 col-md-5 col-lg-5">
              <div class="form-group">
                <label for="edtNomMed">Nombres del Médico: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtNomMed" id="edtNomMed" placeholder="Ingrese nombre médico">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-2" id="btnBusDx2">
              <div class="form-group">
                <label>Búsqueda:<span class="text-danger">&nbsp;*</span></label>
                <div class="input-group">
                  <button type="button" class="btn btn-block btn-info" id="btnDx2" data-toggle="modal" data-target="#modal-busqueda-dx2"><i class="fas fa-search"></i>&nbsp;Consulta Dx</button>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="edtCieDX">Diagnóstico: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <input type="text" class="form-control" name="edtCieDX" id="edtCieDX" placeholder="Ingrese CIE10">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-8 col-md-8 col-lg-8">
              <div class="form-group">
                <label for="edtDesDX">Detalle Diagnóstico: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <input type="text" class="form-control" name="edtDesDX" id="edtDesDX" placeholder="Ingrese detalle Dx">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="edtServ">Servicio Atención : &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtServ" id="edtServ" placeholder="Ingrese servicio de atención">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="edtCITT">CITT ESSALUD: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtCITT" id="edtCITT" placeholder="IIngrese CITT ESSALUD">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="edtEstado">Estado: &nbsp;</label>
                <i class="fas fa-book-medical"></i> *
                <div class="input-group">
                  <select class="form-control" id="edtEstado" name="edtEstado">
                    <option value="" id="edtEstado1"></option>
                    <?php
                    $estadoLice = LicenciasControlador::ctrListaEstadoLice();
                    foreach ($estadoLice as $key => $value) {
                      echo '<option value="' . $value["idEstLic"] . '">' . $value["descEstLic"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <h6 class="font-weight-bold">4. Presentación de Documentos. &nbsp;<i class="fas fa-hospital-user"></i></h6>
          <hr>
          <div class="row" id="blcDoc1">
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="edtTipDoc">Tipo Documento: &nbsp;</label>
                <i class="fas fa-indent"></i> *
                <div class="input-group">
                  <select class="form-control" id="edtTipDoc" name="edtTipDoc">
                    <option value="" id="edtTipDoc1"></option>
                    <?php
                    $tipoDoc = LicenciasControlador::ctrListaTipDoc();
                    foreach ($tipoDoc as $key => $value) {
                      echo '<option value="' . $value["idTipoDoc"] . '">' . $value["descTipoDoc"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="edtNDoc">N° Documento: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtNDoc" id="edtNDoc" placeholder="Ingrese N° Documento">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="edtFDoc">Fecha Documento: &nbsp;</label>
                <i class="fas fa-calendar-check"></i>
                <div class="input-group">
                  <input type="text" name="edtFDoc" id="edtFDoc" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy">
                </div>
              </div>
            </div>
          </div>
          <div class="row" id="blcDoc2">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="edtDescip">Descripción: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtDescip" id="edtDescip" placeholder="Ingrese descripción de documento">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="edtObserva">Observaciones: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <textarea name="edtObserva" id="edtObserva" class="form-control" placeholder="Ingrese observaciones (Opcional)" rows="4"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnEdtLic"><i class="fas fa-save"></i> Guardar</button>
          <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $editarLicencia = new LicenciasControlador();
        $editarLicencia->ctrEditarLicencia();
        ?>
      </form>
    </div>
  </div>
</div>
<!-- Editar Licencias -->
<div id="modal-busqueda-dx2" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center" style="background: #7EB2C2; color: white">
        <h4 class="modal-title">Búsqueda de Diagnóstico&nbsp; <i class="fas fa-diagnoses"></i></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
              <label for="">Diagnóstico &nbsp;</label>
              <i class="fas fa-stethoscope"></i> *
              <div class="input-group">
                <input type="text" name="searchDx2" id="searchDx2" class="form-control" placeholder="Ingrese CIE10 o Descripción" required autocomplete="off" autofocus="autofocus">
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-2">
            <div class="form-group">
              <label>Buscar Dx</label>
              <div class="input-group">
                <button type="button" class="btn btn-block btn-info" id="btnDxCarga2"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div id="dataDx2"></div>
      </div>
    </div>
  </div>
</div>
<?php
$anularLicencia = new LicenciasControlador();
$anularLicencia->ctrAnularLicencia();
?>