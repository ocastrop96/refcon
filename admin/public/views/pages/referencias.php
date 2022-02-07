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
<!-- Registro de Diagnóstico -->
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
                <label for="rgNRuc">N° Doc: &nbsp;</label>
                <i class="fas fa-search"></i>
                <div class="input-group">
                  <input type="text" class="form-control" name="rgNdoc" id="rgNdoc" placeholder="Ingrese Nro Doc" maxlength="15">
                </div>
              </div>
            </div>

          </div>
          <h6 class="font-weight-bold">2. Datos de la Referencia. &nbsp;<i class="fas fa-file-invoice"></i></h6>
          <hr>

        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnRegEmp"><i class="fas fa-save"></i> Guardar</button>
          <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Registro de Diagnóstico -->
<!-- Editar de Diagnóstico -->
<div id="modal-editar-empleado" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="" role="form" id="formEdtEmp" method="post">
        <div class="modal-header text-center bg-olive" style="color: white">
          <h4 class="modal-title">Editar Empleado&nbsp; <i class="fas fa-file-invoice"></i></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="edtEDni">N° DNI &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <div class="input-group">
                  <input type="text" name="edtEDni" id="edtEDni" class="form-control" placeholder="Ingrese N° DNI" required autocomplete="off" autofocus="autofocus">
                  <input type="hidden" name="idEmpleado" id="idEmpleado">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label>Búsqueda:<span class="text-danger">&nbsp;*</span></label>
                <div class="input-group">
                  <button type="button" class="btn btn-block btn-info" id="btnDNIEmpEdt"><i class="fas fa-search"></i>&nbsp;Consulta DNI</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-5">
              <div class="form-group">
                <label for="edtEFNac">Fecha de Nacimiento &nbsp;</label>
                <i class="fas fa-calendar-check"></i> *
                <div class="input-group">
                  <input type="text" name="edtEFNac" id="edtEFNac" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="Ingrese Fecha Nacimiento (Opcional)" autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-5">
              <div class="form-group">
                <label for="edtEFAlta">Fecha de Alta &nbsp;</label>
                <i class="fas fa-calendar-check"></i> *
                <div class="input-group">
                  <input type="text" name="edtEFAlta" id="edtEFAlta" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="Ingrese Fecha Nacimiento (Opcional)" autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="edtENombres">Nombres &nbsp;</label>
                <i class="fas fa-signature"></i> *
                <div class="input-group">
                  <input type="text" name="edtENombres" id="edtENombres" class="form-control" required autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="edtEApPat">Apellido Paterno &nbsp;</label>
                <i class="fas fa-signature"></i> *
                <div class="input-group">
                  <input type="text" name="edtEApPat" id="edtEApPat" class="form-control" required autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="edtEApMat">Apellido Materno &nbsp;</label>
                <i class="fas fa-signature"></i> *
                <div class="input-group">
                  <input type="text" name="edtEApMat" id="edtEApMat" class="form-control" required autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="edtECargo">Cargo &nbsp;</label>
                <i class="fas fa-graduation-cap"></i>
                <span class="font-weight-bolder text-danger" id="seleccionCargo11">ACTUAL : </span>
                <span class="font-weight-bolder" id="seleccionCargo1"></span>
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" name="edtECargo" id="edtECargo">
                    <option value="" id="edtECargo1"></option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
              <div class="form-group">
                <label for="edtECondicion">Condición Laboral &nbsp;</label>
                <i class="fas fa-id-card-alt"></i> *
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
              <div class="form-group">
                <label for="edtESueldo">Sueldo &nbsp;</label>
                <i class="fas fa-coins"></i> *
                <div class="input-group">
                  <input type="text" name="edtESueldo" id="edtESueldo" class="form-control" placeholder="0.00" autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnEdtEmp"><i class="fas fa-save"></i> Guardar cambios</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
      </form>
    </div>
  </div>
</div>