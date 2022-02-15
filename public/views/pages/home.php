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
    <div class="row">
        <div class="col-12">
            <div class="card card-lightblue">
                <div class="card-header">
                    <h5 class="card-title m-0 font-weight-bold">Solicitudes en proceso </h5>&nbsp;&nbsp;<i class="fas fa-spinner"></i>
                </div>
                <div class="card-body" id="bloque1">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title m-0 font-weight-bold">Solicitudes con Cita </h5>&nbsp;&nbsp;<i class="fas fa-calendar-check"></i>
                </div>
                <div class="card-body" id="bloque2">
                    <!-- <table id="datatableReferenciasCitados" class="table table-bordered table-hover dt-responsive datatableReferenciasCitados">
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
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table> -->
                </div>
            </div>
        </div>

    </div>
</div>

<div id="modal-ver-motivo" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" role="form" id="formEdtRef" method="post">
                <div class="modal-header text-center bg-olive" style="color: white">
                    <h4 class="modal-title">Detalles Referencia N° &nbsp; <span id="correlativoEdt"></span> <i class="fas fa-file-invoice"></i> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="edtRefEstado">Estado Referencia: &nbsp;</label>
                                <i class="fas fa-id-card"></i> *
                                <div class="input-group">
                                    <input type="text" name="data1" id="data1" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="edtRefEstable">Especialidad Destino: &nbsp;</label>
                                <i class="fas fa-id-card"></i> *
                                <div class="input-group">
                                    <input type="text" name="data2" id="data2" class="form-control" readonly>
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
                                    <textarea cols="30" rows="2" class="form-control" name="data3" id="data3" maxlength="200" autocomplete="off" readonly></textarea>
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
                                    <textarea cols="30" rows="2" class="form-control" name="data4" id="data4" maxlength="200" autocomplete="off" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
                </div>
            </form>
        </div>
    </div>
</div>