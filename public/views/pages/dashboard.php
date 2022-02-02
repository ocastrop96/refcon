<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="public/views/resources/img/mrms-logo.png" alt="MRMS-LOGO" height="80" width="80">
</div>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4><strong>Inicio:. Panel</strong></h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Panel de Control</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <!-- <di v class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            <label>Seleccione Año:</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="anioDash" id="anioDash" value="<?php date_default_timezone_set('America/Lima');
                                                                                                                $fechaActual = date('Y');
                                                                                                                echo $fechaActual; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            <label class="text-light">.</label>
                            <div class="input-group">
                                <button type="btn" class="btn bg-success pull-right" id="deshacer-filtro-DashPrinci"><i class="fas fa-undo-alt"></i> Deshacer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- </section> -->
        <!-- <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 class="one1"></h3>

                                <p class="font-weight-bold">Licencias Registradas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <a href="licencias" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 class="one2"></h3>
                                <p class="font-weight-bold">Salud Ocupacional</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-medical-alt"></i>
                            </div>
                            <a href="salud-ocupacional" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3 class="one3"></h3>
                                <p class="font-weight-bold">Empleados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <a href="empleados" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3 class="one4"></h3>
                                <p class="font-weight-bold">Cargos</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="cargos" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-gray">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold"> Licencias Registradas por Mes</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart rj1">
                                    <canvas id="graphDash1" width="400" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">Licencias por Procedencia</h3>
                            </div>
                            <div class="card-body rj2">
                                <canvas id="graphDash2" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
</div>