<div class="login-page">
    <div class="login-box">
        <div class="card card-outline card-success">
            <div class="login-logo">
                <img src="public/views/resources/img/refcon-logo.png" class="img-responsive" style="padding:10px 50px 0px 50px">
            </div>
            <div class="card-body">
                <p class="login-box-msg font-weight-bold h5 text-secondary">Sistema de Gestión de Referencias - HNSEB <br><span class="font-italic h6">v.2022.0201</span></p>
                <form action="" method="post" id="frmLoginQS">
                    <div id="mensajeLogMR" class="d-none">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> ¡ATENCIÓN!</h5>
                            El usuario ingresado no existe.
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-user-lock"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Ingrese usuario" id="usuarioLogMR" name="usuarioLogMR" autocomplete="off" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="Ingrese contraseña" id="usuarioPassMR" name="usuarioPassMR" autocomplete="off" required>
                    </div>
                    <div class="row">
                        <div class="col-8 ml-5">
                            <button type="submit" class="btn btn-success btn-block btn-flat rounded" id="btnLoginMR"><i class="fas fa-sign-in-alt"></i> Ingresar</button>
                        </div>
                    </div>
                    <?php
                    $login = new UsuariosControlador();
                    $login->ctrLoginUsuario();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>