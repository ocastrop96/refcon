<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="public/views/resources/img/refcon-logo.png" alt="REFCON-LOGO" height="100" width="100">
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
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            <label>Seleccione Año:</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="anioDashRef" id="anioDashRef" value="<?php date_default_timezone_set('America/Lima');
                                                                                                                    $fechaActual = date('Y');
                                                                                                                    echo $fechaActual; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                        <div class="form-group">
                            <label class="text-light">.</label>
                            <div class="input-group">
                                <button type="btn" class="btn bg-success pull-right" id="deshacer-filtro-DashPrinciRef"><i class="fa-solid fa-broom"></i> Limpiar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?php
            include "widgets/contadores.php";
            ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold"> Referencias Registradas por Mes</h3>
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
                            <h3 class="card-title font-weight-bold">Referencias por Establecimiento de Origen (20)</h3>
                        </div>
                        <div class="card-body rj2">
                            <canvas id="graphDash2" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>