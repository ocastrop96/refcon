<?php
if ($_SESSION["loginPerfilMR"] == 2 || $_SESSION["loginPerfilMR"] == 3 || $_SESSION["loginPerfilMR"] == 4) {
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
          <h4><strong>Personal:. Cargos</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Personal</a></li>
            <li class="breadcrumb-item active">Cargos</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <input type="hidden" name="estatusLog" id="estatusLog" value="<?php echo $_SESSION["loginId"]; ?>">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Módulo Cargos &nbsp;<i class="fas fa-business-time"></i></h3>
      </div>
      <div class="card-body">
        <button type="btn" class="btn btn-secondary" data-toggle="modal" data-target="#modal-registrar-cargo"><i class="fas fa-business-time"></i> Registrar Cargo
        </button>
      </div>
      <div class="card-body">
        <table id="datatableCargosMR" class="table table-bordered table-hover dt-responsive datatableCargosMR">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Código</th>
              <th>Descripción de Cargo</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>

<div id="modal-registrar-cargo" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="" role="form" id="formRegCargo" method="post">
        <div class="modal-header text-center bg-olive" style="color: white">
          <h4 class="modal-title">Registrar Cargo&nbsp; <i class="fas fa-business-time"></i></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
              <div class="form-group">
                <label for="rgCodCar">Código &nbsp;</label>
                <i class="fas fa-hashtag"></i> *
                <div class="input-group">
                  <input type="text" name="rgCodCar" id="rgCodCar" class="form-control" placeholder="Ingrese Código" autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9">
              <div class="form-group">
                <label for="rgDetaCar">Detalle de Cargo &nbsp;</label>
                <i class="fas fa-business-time"></i> *
                <div class="input-group">
                  <input type="text" name="rgDetaCar" id="rgDetaCar" class="form-control" placeholder="Ingrese detalle de cargo" required autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnRegCargo"><i class="fas fa-save"></i> Guardar</button>
          <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $registraCargo = new CargosControlador();
        $registraCargo->ctrRegistrarCargo();
        ?>
      </form>
    </div>
  </div>
</div>

<div id="modal-editar-cargo" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="" role="form" id="formEdtCargo" method="post">
        <div class="modal-header text-center bg-olive" style="color: white">
          <h4 class="modal-title">Editar Cargo&nbsp; <i class="fas fa-business-time"></i></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
              <div class="form-group">
                <label for="edtCodCar">Código &nbsp;</label>
                <i class="fas fa-hashtag"></i> *
                <div class="input-group">
                  <input type="text" name="edtCodCar" id="edtCodCar" class="form-control" placeholder="Ingrese Código (Opcional)" autocomplete="off">
                  <input type="hidden" name="idCargo" id="idCargo">
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9">
              <div class="form-group">
                <label for="edtDetaCar">Detalle de Cargo &nbsp;</label>
                <i class="fas fa-business-time"></i> *
                <div class="input-group">
                  <input type="text" name="edtDetaCar" id="edtDetaCar" class="form-control" required autocomplete="off" autofocus="autofocus">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnEdtCargo"><i class="fas fa-save"></i> Guardar cambios</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $editaCargo = new CargosControlador();
        $editaCargo->ctrEditarCargo();
        ?>
      </form>
    </div>
  </div>
</div>
<?php
$eliminaCargo = new CargosControlador();
$eliminaCargo->ctrEliminarCargo();
?>