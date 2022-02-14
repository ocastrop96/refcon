<div class="container-fluid">
    <div class="card card-success">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <label>N° de Doc. de Identidad:<span class="text-danger">&nbsp;*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Ingrese N° de documento" autocomplete="off" name="bsqDoc" id="bsqDoc">
                            <input type="hidden" id="anioActual" value="<?php date_default_timezone_set('America/Lima');
                                                                        $anioActual = date('Y');
                                                                        echo $anioActual; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-1 col-xl-1" id="btnDNIConsulta">
                    <div class="form-group">
                        <label>Consulta:<span class="text-danger">&nbsp;</span></label>
                        <div class="input-group">
                            <button type="button" class="btn btn-block btn-success" id="btnDNIUCons"><i class="fas fa-search"></i>&nbsp;Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-lightblue">
        <div class="card-header">
            <h5 class="card-title m-0 font-weight-bold">Solicitudes en proceso </h5>&nbsp;&nbsp;<i class="fas fa-spinner"></i>
        </div>
        <div class="card-body" id="bloque1">
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-success">
        <div class="card-header">
            <h5 class="card-title m-0 font-weight-bold">Solicitudes con Cita </h5>&nbsp;&nbsp;<i class="fas fa-calendar-check"></i>
        </div>
        <div class="card-body">
            <table id="datatableReferenciasCitados" class="table table-bordered table-hover dt-responsive datatableReferenciasCitados">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>N° Referencia</th>
                        <th>Fecha Solicitud</th>
                        <th>Fecha Cita</th>
                        <th>N° Doc</th>
                        <th>Paciente</th>
                        <th>Establecimiento Origen</th>
                        <th>Servicio Destino</th>
                        <!-- <th>Opciones</th> -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>