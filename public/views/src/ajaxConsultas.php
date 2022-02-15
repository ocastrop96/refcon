<?php
require_once "../../../app/controller/ReferenciasControlador.php";
require_once "../../../app/model/ReferenciasModelo.php";
require_once "../../../app/model/dbConnect.php";
require_once "../../../app/model/MSdb.php";


class AjaxReferenciasWeb
{
    public $dni;
    public $anio;
    public function ajaxListarReferenciasWeb()
    {
        $datoa = $this->dni;
        $datob = $this->anio;
        $datosRefs = ReferenciasControlador::ctrListarReferenciasWeb($datoa, $datob);

        $totalDataRefs = count($datosRefs);
        // $totalDataDx = count($datosDx);
        if ($totalDataRefs > 0) {
            $dataRefsHTML = "<table id='datatableReferenciasProceso' class='table table-bordered table-hover dt-responsive datatableReferenciasProceso'>
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
                    <td>$value[nroHojaRef]</td>
                    <td>$value[fechaReferencia]</td>
                    <td>$value[codigoEstab] - $value[nombreEstablecimiento]</td>
                    <td>$value[nombreEsp]</td>
                    <td>$botonEstado</td>
                    <td>$botonMotivo</td>
                </tr>";
            }

            $dataRefsHTML .= "</tbody>
                </thead>
            </table>";
        } else {
            $dataRefsHTML = "<table id='datatableReferenciasProceso' class='table table-bordered table-hover dt-responsive datatableReferenciasProceso'>
        <thead>
            <tr>
                <th style='width: 10px'>#</th>
                <th>Año</th>
                <th>N° Referencia</th>
                <th>Fecha</th>
                <th>Est. Origen</th>
                <th>Especialidad.</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
    </table>";
        }
        echo $dataRefsHTML;
    }

    public $dni2;
    public $anio2;
    public function ajaxListarReferenciasWebSIGH()
    {
        $datoa = $this->dni2;
        $datob = $this->anio2;

        $datosRefs = ReferenciasControlador::ctrListarReferenciasWebSIGH($datoa, $datob);
        
        $totalDataRefs = count($datosRefs);

        if ($totalDataRefs > 0) {
            $dataRefsHTML = "<table id='datatableReferenciasCitadas' class='table table-bordered table-hover dt-responsive datatableReferenciasCitadas'>
                <thead>
                    <tr>
                        <th style='width: 10px'>#</th>
                        <th>Año</th>
                        <th>N° Referencia</th>
                        <th>Fecha Solicitud</th>
                        <th>Hora Cita</th>
                        <th>Fecha Cita</th>
                        <th>Especialidad | Servicio</th>
                    </tr>
                </thead>
            <tbody>";

            foreach ($datosRefs as $key => $value) {
                $dataRefsHTML .= "<tr>
                    <td>" . ($key + 1) . "</td>
                    <td>$totalDataRefs</td>
                    <td>$value[nroReferencia]</td>
                    <td>$value[FechaSolicitud]</td>
                    <td>$value[FechaCita]</td>
                    <td>$value[NombEspecialidad] | $value[NombreServicio]</td>
                </tr>";
            }

            $dataRefsHTML .= "</tbody>
                </thead>
            </table>";
        } else {
            $dataRefsHTML = "<table id='datatableReferenciasCitadas' class='table table-bordered table-hover dt-responsive datatableReferenciasCitadas'>
        <thead>
            <tr>
                <th style='width: 10px'>#</th>
                <th>$totalDataRefs</th>
                <th>N° Referencia</th>
                <th>Fecha Solicitud</th>
                <th>Fecha Cita</th>
                <th>Hora Cita</th>
                <th>Especialidad | Servicio</th>
            </tr>
        </thead>
    </table>";
        }
        echo $dataRefsHTML;
    }

    public $idReferencia;
    public function ajaxListarReferenciaDatos()
    {
        $item = "idReferencia";
        $valor = $this->idReferencia;
        $respuesta = ReferenciasControlador::ctrListarReferenciasW($item, $valor);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["dni"])) {
    $listBREF = new AjaxReferenciasWeb();
    $listBREF->dni = $_POST["dni"];
    $listBREF->anio = $_POST["anio"];
    $listBREF->ajaxListarReferenciasWeb();
}


if (isset($_POST["dni2"])) {
    $listBREF2 = new AjaxReferenciasWeb();
    $listBREF2->dni2 = $_POST["dni2"];
    $listBREF2->anio2 = $_POST["anio2"];
    $listBREF2->ajaxListarReferenciasWebSIGH();
}

if (isset($_POST["idReferencia"])) {
    $list3 = new AjaxReferenciasWeb();
    $list3->idReferencia = $_POST["idReferencia"];
    $list3->ajaxListarReferenciaDatos();
}