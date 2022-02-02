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
        <h3 class="card-title">Módulo de Carga de Referencias &nbsp;<i class="fas fa-file-invoice"></i></h3>
      </div>
      <div class="card-body">
        <button type="btn" class="btn btn-secondary" data-toggle="modal" data-target="#modal-cargar-referencia"><i class="fas fa-file-invoice"></i> Cargar Referencia
        </button>
      </div>
      <!-- <div class="card-body">
        <table id="datatableEmpleadosMR" class="table table-bordered table-hover dt-responsive datatableEmpleadosMR">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>N° DNI</th>
              <th>Apellido Paterno</th>
              <th>Apellido Materno</th>
              <th>Nombres</th>
              <th>Cargo</th>
              <th>Condición</th>
              <th>Opciones</th>
            </tr>
          </thead>
        </table>
      </div> -->
    </div>
  </section>
</div>
<!-- Registro de Diagnóstico -->
<div id="modal-cargar-referencia" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="" role="form" id="formRegEmp" method="post">
        <div class="modal-header text-center bg-olive" style="color: white">
          <h4 class="modal-title">Carga Referencias&nbsp; <i class="fas fa-file-invoice"></i></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label for="rgEDni">N° DNI &nbsp;</label>
                <i class="fas fa-id-card"></i> *
                <div class="input-group">
                  <input type="text" name="rgEDni" id="rgEDni" class="form-control" placeholder="Ingrese N° DNI" required autocomplete="off" autofocus="autofocus">
                  <input type="hidden" name="idUsRegEmp" id="idUsRegEmp" value="<?php echo $_SESSION["loginIdMR"]; ?>">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
                <label>Búsqueda:<span class="text-danger">&nbsp;*</span></label>
                <div class="input-group">
                  <button type="button" class="btn btn-block btn-info" id="btnDNIEmp"><i class="fas fa-search"></i>&nbsp;Consulta DNI</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-5">
              <div class="form-group">
                <label for="rgEFNac">Fecha de Nacimiento &nbsp;</label>
                <i class="fas fa-calendar-check"></i> *
                <div class="input-group">
                  <input type="text" name="rgEFNac" id="rgEFNac" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="Ingrese Fecha Nacimiento (Opcional)" autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-5">
              <div class="form-group">
                <label for="rgEFAlta">Fecha de Alta &nbsp;</label>
                <i class="fas fa-calendar-check"></i> *
                <div class="input-group">
                  <input type="text" name="rgEFAlta" id="rgEFAlta" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask autocomplete="off" placeholder="Ingrese Fecha Nacimiento (Opcional)" autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rgENombres">Nombres &nbsp;</label>
                <i class="fas fa-signature"></i> *
                <div class="input-group">
                  <input type="text" name="rgENombres" id="rgENombres" class="form-control" placeholder="Ingrese nombres de empleado" required autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rgEApPat">Apellido Paterno &nbsp;</label>
                <i class="fas fa-signature"></i> *
                <div class="input-group">
                  <input type="text" name="rgEApPat" id="rgEApPat" class="form-control" placeholder="Ingrese Apellido Paterno" required autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rgEApMat">Apellido Materno &nbsp;</label>
                <i class="fas fa-signature"></i> *
                <div class="input-group">
                  <input type="text" name="rgEApMat" id="rgEApMat" class="form-control" placeholder="Ingrese Apellido Materno" required autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rgECargo">Cargo &nbsp;</label>
                <i class="fas fa-graduation-cap"></i> *
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" name="rgECargo" id="rgECargo">
                    <option value="0">Seleccione cargo</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
              <div class="form-group">
                <label for="rgECondicion">Condición Laboral &nbsp;</label>
                <i class="fas fa-id-card-alt"></i> *
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" name="rgECondicion" id="rgECondicion">
                    <option value="0">Seleccione condición</option>
                    <?php
                    $tipCondEmp = EmpleadosControlador::ctrListarCondiciones();
                    foreach ($tipCondEmp as $key => $value) {
                      echo '<option value="' . $value["idCondicionLab"] . '">' . $value["descCondicion"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
              <div class="form-group">
                <label for="rgESueldo">Sueldo &nbsp;</label>
                <i class="fas fa-coins"></i> *
                <div class="input-group">
                  <input type="text" name="rgESueldo" id="rgESueldo" class="form-control" placeholder="0.00" autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnRegEmp"><i class="fas fa-save"></i> Guardar</button>
          <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $registrarEmpleado = new EmpleadosControlador();
        $registrarEmpleado->ctrRegistrarEmpleado();
        ?>
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
                <div class="input-group">
                  <select class="form-control" style="width: 100%;" name="edtECondicion" id="edtECondicion">
                    <option value="0" id="edtECondicion1"></option>
                    <?php
                    $tipCondEmp = EmpleadosControlador::ctrListarCondiciones();
                    foreach ($tipCondEmp as $key => $value) {
                      echo '<option value="' . $value["idCondicionLab"] . '">' . $value["descCondicion"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
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
        <?php
        $editarEmpleado = new EmpleadosControlador();
        $editarEmpleado->ctrEditarEmpleado();
        ?>
      </form>
    </div>
  </div>
</div>
<?php
$eliminarEmpleado = new EmpleadosControlador();
$eliminarEmpleado->ctrEliminarEmpleado();
?>