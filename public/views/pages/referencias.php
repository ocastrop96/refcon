<?php
if ($_SESSION["loginPerfilRef"] == 4) {
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
          <h4><strong>Gestión:. Referencias</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Gestión</a></li>
            <li class="breadcrumb-item active">Referencias</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Módulo de Registro de Referencias &nbsp;<i class="fas fa-file-invoice"></i></h3>
      </div>
      <div class="card-body">
        <button type="btn" class="btn btn-secondary" data-toggle="modal" data-target="#modal-cargar-referencia"><i class="fas fa-file-invoice"></i> Registrar Referencia
        </button>
      </div>
      <div class="card-body">
        <table id="datatableReferencias" class="table table-bordered table-hover dt-responsive datatableReferencias">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>N° Referencia</th>
              <th>Fecha</th>
              <th>N° Doc</th>
              <th>Paciente</th>
              <th>Est. Origen</th>
              <th>Servicio Dest.</th>
              <th>Estado</th>
              <th>Opciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>

<div id="modal-cargar-referencia" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="" role="form" id="formRegRef" method="post">
        <div class="modal-header text-center bg-olive" style="color: white">
          <h4 class="modal-title">Registrar Referencia&nbsp; <i class="fas fa-file-invoice"></i></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h6 class="font-weight-bold">1. Datos del Paciente. &nbsp;<i class="fas fa-user-injured"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <input type="hidden" id="userRegistra" value="<?php echo $_SESSION["loginIdRef"]; ?>">
              <div class="form-group">
                <label for="rgTipEnt">Tipo Documento: &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <div class="input-group">
                  <select class="form-control" id="rgTipoDoc" name="rgTipoDoc">
                    <option value="0">Seleccione Tipo</option>
                    <?php
                    $tipoDocumento = ReferenciasControlador::ctrListarTiposDocumentos();
                    foreach ($tipoDocumento as $key => $value) {
                      echo '<option value="' . $value["idTipoDoc"] . '">' . $value["nombreTipDoc"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="rgNdoc">N° Doc: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgNdoc" id="rgNdoc" placeholder="Ingrese Nro Doc" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 d-none" id="btnDniPac">
              <div class="form-group">
                <label>Búsqueda:<span class="text-danger">&nbsp;*</span></label>
                <div class="input-group">
                  <button type="button" class="btn btn-block btn-success" id="btnDNIPaci"><i class="fas fa-search"></i>&nbsp;Consulta DNI</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="rgNombresPac">Nombres: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgNombresPac" id="rgNombresPac" placeholder="Ingrese Nombres del paciente" maxlength="50" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="rgRefAP">Apellido Paterno: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgRefAP" id="rgRefAP" placeholder="Ingrese Apellido Paterno" maxlength="50" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="rgRefAP">Apellido Materno: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgRefAM" id="rgRefAM" placeholder="Ingrese Apellido Materno" maxlength="50" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <input type="hidden" id="userRegistra" name="userRegistra" value="<?php echo $_SESSION["loginIdRef"]; ?>">
              <div class="form-group">
                <label for="rgSexo">Sexo: &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <div class="input-group">
                  <select class="form-control" id="rgSexo" name="rgSexo">
                    <option value="0">Seleccione sexo</option>
                    <?php
                    $sexo = ReferenciasControlador::ctrListarTiposSexo();
                    foreach ($sexo as $key => $value) {
                      echo '<option value="' . $value["idSexo"] . '">' . $value["descSexo"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <h6 class="font-weight-bold">2. Datos de la Referencia. &nbsp;<i class="fas fa-file-invoice"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="rgNroRef">N° Referencia: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgNroRef" id="rgNroRef" placeholder="Ingrese Nro Referencia" maxlength="15" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="rgFechaRef">Fecha de Referencia: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" name="rgFechaRef" id="rgFechaRef" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">


              <div class="form-group">
                <label for="rgRefEstado">Estado Referencia: &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <div class="input-group">
                  <select class="form-control" id="rgRefEstado" name="rgRefEstado">
                    <option value="0">Seleccione estado</option>
                    <?php
                    $estadoReferencia = ReferenciasControlador::ctrListarEstadoRef();
                    foreach ($estadoReferencia as $key => $value) {
                      echo '<option value="' . $value["idEstado"] . '">' . $value["descEstado"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="regRefEstable">Establecimiento Origen: &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <div class="input-group">
                  <select class="form-control" id="regRefEstable" name="regRefEstable" style="width: 100%;">
                    <option value="0">Seleccione EE.SS Origen</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="regRefServ">Servicio Destino: &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" id="regRefServ" name="regRefServ">
                    <option value="0">Seleccione Servicio Destino</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rgRefAnamnesis">Anamnesis o Motivo de la Referencia: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <textarea cols="30" rows="2" class="form-control" name="rgRefAnamnesis" id="rgRefAnamnesis" placeholder="Ingrese motivo de la Referencia" maxlength="200" autocomplete="off" required></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rgRefMotivo">Motivo de Rechazo u Observación de la Referencia: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <textarea cols="30" rows="2" class="form-control" name="rgRefMotivo" id="rgRefMotivo" placeholder="Ingrese motivo (En caso lo requiera)" maxlength="200" autocomplete="off"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnRegReferencia"><i class="fas fa-save"></i> Grabar</button>
          <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $registrarLicencia = new ReferenciasControlador();
        $registrarLicencia->ctrRegistrarReferencia();
        ?>
      </form>
    </div>
  </div>
</div>


<div id="modal-editar-referencia" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="" role="form" id="formEdtRef" method="post">
        <div class="modal-header text-center bg-olive" style="color: white">
          <h4 class="modal-title">Editar Referencia&nbsp; <i class="fas fa-file-invoice"></i></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h6 class="font-weight-bold">1. Datos del Paciente. &nbsp;<i class="fas fa-user-injured"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <input type="hidden" id="userEdita" name="userEdita" value="<?php echo $_SESSION["loginIdRef"]; ?>">
              <input type="hidden" id="idReferencia" name="idReferencia">

              <div class="form-group">
                <label for="edtTipoDoc">Tipo Documento: &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <div class="input-group">
                  <select class="form-control" id="edtTipoDoc" name="edtTipoDoc">
                    <option value="0" id="edtTipoDoc1"></option>
                    <?php
                    $tipoDocumento = ReferenciasControlador::ctrListarTiposDocumentos();
                    foreach ($tipoDocumento as $key => $value) {
                      echo '<option value="' . $value["idTipoDoc"] . '">' . $value["nombreTipDoc"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="edtNdoc">N° Doc: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtNdoc" id="edtNdoc" placeholder="Ingrese Nro Doc" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 d-none" id="btnDniPac">
              <div class="form-group">
                <label>Búsqueda:<span class="text-danger">&nbsp;*</span></label>
                <div class="input-group">
                  <button type="button" class="btn btn-block btn-success" id="btnDNIPaci"><i class="fas fa-search"></i>&nbsp;Consulta DNI</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="edtNombresPac">Nombres: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtNombresPac" id="edtNombresPac" placeholder="Ingrese Nombres del paciente" maxlength="50" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="edtRefAP">Apellido Paterno: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtRefAP" id="edtRefAP" placeholder="Ingrese Apellido Paterno" maxlength="50" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="edtRefAM">Apellido Materno: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtRefAM" id="edtRefAM" placeholder="Ingrese Apellido Materno" maxlength="50" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-2 col-lg-2">
              <div class="form-group">
                <label for="edtSexo">Sexo: &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <div class="input-group">
                  <select class="form-control" id="edtSexo" name="edtSexo">
                    <option value="0" id="edtSexo1"></option>
                    <?php
                    $sexo = ReferenciasControlador::ctrListarTiposSexo();
                    foreach ($sexo as $key => $value) {
                      echo '<option value="' . $value["idSexo"] . '">' . $value["descSexo"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <h6 class="font-weight-bold">2. Datos de la Referencia. &nbsp;<i class="fas fa-file-invoice"></i></h6>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="edtNroRef">N° Referencia: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="edtNroRef" id="edtNroRef" placeholder="Ingrese Nro Referencia" maxlength="15" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="edtFechaRef">Fecha de Referencia: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" name="edtFechaRef" id="edtFechaRef" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="dd/mm/yyyy" required>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3">


              <div class="form-group">
                <label for="edtRefEstado">Estado Referencia: &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <div class="input-group">
                  <select class="form-control" id="edtRefEstado" name="edtRefEstado">
                    <option value="0" id="edtRefEstado1"></option>
                    <?php
                    $estadoReferencia = ReferenciasControlador::ctrListarEstadoRef();
                    foreach ($estadoReferencia as $key => $value) {
                      echo '<option value="' . $value["idEstado"] . '">' . $value["descEstado"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="edtRefEstable">Establecimiento Origen: &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <span class="font-weight-bolder text-danger" id="seleccionEESS11">ACTUAL : </span>
                <span class="font-weight-bolder" id="seleccionEESS1"></span>
                <div class="input-group">
                  <select class="form-control" id="edtRefEstable" name="edtRefEstable" style="width: 100%;">
                    <option value="0" id="edtRefEstable1">Seleccione EE.SS</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="regRefServ">Servicio Destino: &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <span class="font-weight-bolder text-danger" id="seleccionServ11">ACTUAL : </span>
                <span class="font-weight-bolder" id="seleccionServ1"></span>
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" id="edtRefServ" name="edtRefServ">
                    <option value="0" id="edtRefServ1">Seleccione Especialidad/Servicio</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="edtRefAnamnesis">Anamnesis o Motivo de la Referencia: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <textarea cols="30" rows="2" class="form-control" name="edtRefAnamnesis" id="edtRefAnamnesis" placeholder="Ingrese motivo de la Referencia" maxlength="200" autocomplete="off" required></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="edtRefMotivo">Motivo de Rechazo u Observación de la Referencia: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <textarea cols="30" rows="2" class="form-control" name="edtRefMotivo" id="edtRefMotivo" placeholder="Ingrese motivo (En caso lo requiera)" maxlength="200" autocomplete="off"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnEdtReferencia"><i class="fas fa-save"></i> Guardar Cambios</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $editarReferencia = new ReferenciasControlador();
        $editarReferencia->ctrEditarReferencia();
        ?>
      </form>
    </div>
  </div>
</div>