<?php
require_once "../../../app/controller/ReferenciasControlador.php";
require_once "../../../app/model/ReferenciasModelo.php";
require_once "../../../app/model/dbConnect.php";
require_once "../../../app/model/MSdb.php";


class AjaxReferenciasWeb
{

    public $idReferencia;
    public function ajaxListarReferenciaDatos()
    {
        $item = "idReferencia";
        $valor = $this->idReferencia;
        $respuesta = ReferenciasControlador::ctrListarReferenciasW($item, $valor);
        echo json_encode($respuesta);
    }

    public $nrodoc;
    public $anio;
    public function ajaxListarTodasReferencias()
    {
        $datoa = $this->nrodoc;
        $datob = $this->anio;
        $datosRefWeb = ReferenciasControlador::ctrListarReferenciasWeb($datoa, $datob);
        $datosRefGalen = ReferenciasControlador::ctrListarReferenciasWebSIGH($datoa, $datob);

        // Contamos los registros que devuelve cada Fuente
        $totalDataLoc = count($datosRefWeb);
        $totalDataGalen = count($datosRefGalen);

        $arrayRespuesta = array("local" => $totalDataLoc, "galen" => $totalDataGalen);
        echo json_encode($arrayRespuesta);
    }

    // Busqueda x Tablas Proceso
    public $nrodoc2;
    public $anio2;
    public $sizeWind;

    public function ajaxListarReferenciasProceso()
    {
        $datoa = $this->nrodoc2;
        $datob = $this->anio2;
        $size = $this->sizeWind;

        $datosRefs = ReferenciasControlador::ctrListarReferenciasWeb($datoa, $datob);

        $totalDataRefs = count($datosRefs);

        if ($totalDataRefs > 0) {
            $dataRefsHTML = "<div class='col-" . $size . "'>
            <div class='card card-lightblue shadow'>
                <div class='card-header'>
                    <h5 class='card-title m-0 font-weight-bold'>&nbsp; (" . $totalDataRefs . ") Solicitudes en proceso </h5>&nbsp;&nbsp;<i class='fas fa-spinner'></i>
                </div>
                <div class='card-body'>
                <table id='datatableReferenciasProceso' class='table table-bordered table-hover dt-responsive datatableReferenciasProceso'>
                    <thead>
                        <tr>
                            <th style='width: 10px'>#</th>
                            <th>Año</th>
                            <th>N° Referencia</th>
                            <th>Fecha</th>
                            <th>Est. Origen</th>
                            <th>Especialidad</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>";
            foreach ($datosRefs as $key => $value) {

                if ($value["idEstado"] == 1) {
                    $botonEstado = "<button type='button' class='btn btn-block btn-secondary font-weight-bold' data-toggle='tooltip' data-placement='left' title='$value[descEstado]'><i class='fas fa-history'></i> &nbsp; $value[descEstado]</button>";
                    $botonMotivo = "";
                } else if ($value["idEstado"] == 2) {
                    $botonEstado = "<button type='button' class='btn btn-block btn-success font-weight-bold' data-toggle='tooltip' data-placement='left' title='$value[descEstado]'><i class='fas fa-check-circle'></i> &nbsp; $value[descEstado]</button>";
                    $botonMotivo = "";
                } else if ($value["idEstado"] == 4) {
                    $botonEstado = "<button type='button' class='btn btn-block btn-danger font-weight-bold' data-toggle='tooltip' data-placement='left' title='$value[descEstado]'><i class='fas fa-window-close'></i> &nbsp; $value[descEstado]</button>";
                    $botonMotivo = "<button type='button' class='btn btn-block btn-info font-weight-bold btnVerMotivo' idReferencia='$value[idReferencia]' data-toggle='modal' data-target='#modal-ver-motivo' onclick='VerMotivo($value[idReferencia])'><i class='fas fa-eye'></i> &nbsp; VER MOTIVO</button>";
                } else if ($value["idEstado"] == 5) {
                    $botonEstado = "<button type='button' class='btn btn-block btn-warning font-weight-bold' data-toggle='tooltip' data-placement='left' title='$value[descEstado]'><i class='fas fa-exclamation-triangle'></i> &nbsp; $value[descEstado]</button>";
                    $botonMotivo = "<button type='button' class='btn btn-block btn-info font-weight-bold btnVerMotivo' idReferencia='$value[idReferencia]' data-toggle='modal' data-target='#modal-ver-motivo' onclick='VerMotivo($value[idReferencia])'><i class='fas fa-eye'></i> &nbsp; VER MOTIVO</button>";
                }
                $dataRefsHTML .= "<tr>
                            <td>" . ($key + 1) . "</td>
                            <td>$value[anioReferencia]</td>
                            <td class='font-weight-bold'>$value[nroHojaRef]</td>
                            <td>$value[fechaReferencia]</td>
                            <td>$value[codigoEstab] - $value[nombreEstablecimiento]</td>
                            <td>$value[nombreEsp]</td>
                            <td>$botonEstado</td>
                            <td>$botonMotivo</td>
                        </tr>";
            }

            $dataRefsHTML .= "</tbody>
                </table>
                </div>
            </div>
        </div>";
        }

        echo $dataRefsHTML;
    }
    // Busqueda x Tablas Proceso


    // Busqueda x Tablas Citas Registradas
    public $nrodoc3;
    public $anio3;
    public $sizeWind2;
    public function ajaxListarReferenciasCita()
    {
        $datoa = $this->nrodoc3;
        $datob = $this->anio3;
        $size = $this->sizeWind2;

        $datosRefs = ReferenciasControlador::ctrListarReferenciasWebSIGH($datoa, $datob);

        $totalDataRefs = count($datosRefs);

        if ($totalDataRefs > 0) {
            $dataRefsHTML = "<div class='col-" . $size . "'>
            <div class='card card-success shadow'>
                <div class='card-header'>
                    <h5 class='card-title m-0 font-weight-bold'> &nbsp; (" . $totalDataRefs . ") Solicitudes con Cita </h5>&nbsp;&nbsp;<i class='fas fa-calendar-check'></i>
                </div>
                <div class='card-body'>
                <table id='datatableReferenciasCitadas' class='table table-bordered table-hover dt-responsive datatableReferenciasCitadas'>
                <thead>
                    <tr>
                        <th style='width: 10px'>#</th>
                        <th>Año</th>
                        <th>N° Referencia</th>
                        <th>Fecha Solicitud</th>
                        <th class='font-weight-bold'>Fecha Cita</th>
                        <th class='font-weight-bold'>Hora Cita</th>
                        <th>Especialidad | Servicio</th>
                        <th>Médico</th>
                    </tr>
                </thead>
            <tbody>";
            foreach ($datosRefs as $key => $value) {
                $dataRefsHTML .= "<tr>
                    <td>" . ($key + 1) . "</td>
                    <td>$value[anioReferencia]</td>
                    <td class='font-weight-bold'>$value[nroReferencia]</td>
                    <td >$value[FechaSolicitud]</td>
                    <td class='font-weight-bold'>$value[FechaCita]</td>
                    <td class='font-weight-bold'>$value[HoraInicio] - $value[HoraFin]</td>
                    <td style='background-color: green;font-weight:bold; color: #fff'>$value[NombEspecialidad] - $value[NombreServicio]</td>
                    <td style='background-color: #3c8dbc;font-weight:bold; color: #fff'>".strtoupper($value['medicoCita'])."</td>
                </tr>";
            }
            $dataRefsHTML .= "</tbody>
            </table>
            </div>
        </div>
    </div>";
        }
        echo $dataRefsHTML;
    }

    // Busqueda x Tablas Citas Registradas
}

if (isset($_POST["dni"])) {
    $listBREF = new AjaxReferenciasWeb();
    $listBREF->nrodoc = $_POST["dni"];
    $listBREF->anio = $_POST["anio"];
    $listBREF->ajaxListarTodasReferencias();
}


if (isset($_POST["idReferencia"])) {
    $list3 = new AjaxReferenciasWeb();
    $list3->idReferencia = $_POST["idReferencia"];
    $list3->ajaxListarReferenciaDatos();
}


if (isset($_POST["dni2"])) {
    $listBREF2 = new AjaxReferenciasWeb();
    $listBREF2->nrodoc2 = $_POST["dni2"];
    $listBREF2->anio2 = $_POST["anio2"];
    $listBREF2->sizeWind = $_POST["sizeWind"];
    $listBREF2->ajaxListarReferenciasProceso();
}

if (isset($_POST["dni3"])) {
    $listBREF3 = new AjaxReferenciasWeb();
    $listBREF3->nrodoc3 = $_POST["dni3"];
    $listBREF3->anio3 = $_POST["anio3"];
    $listBREF3->sizeWind2 = $_POST["sizeWind2"];
    $listBREF3->ajaxListarReferenciasCita();
}
