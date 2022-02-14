<?php
require_once "../../../app/controller/ReferenciasControlador.php";
require_once "../../../app/model/ReferenciasModelo.php";
require_once "../../../app/model/dbConnect.php";

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
                    <th>N° Doc</th>
                    <th>Paciente</th>
                    <th>Est. Origen</th>
                    <th>Especialidad</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
    
            </thead>
                <tbody>";

            foreach ($datosRefs as $key => $value) {

                if ($value["idEstado"] == 1) {
                    $botonEstado="<button type='button' class='btn btn-block btn-secondary font-weight-bold' data-toggle='tooltip' data-placement='left' title='$value[descEstado]'><i class='fas fa-history'></i> &nbsp; $value[descEstado]</button>";
                    $botonMotivo="";
                }
                else if($value["idEstado"] == 2){
                    $botonEstado="<button type='button' class='btn btn-block btn-success font-weight-bold' data-toggle='tooltip' data-placement='left' title='$value[descEstado]'><i class='fas fa-check-circle'></i> &nbsp; $value[descEstado]</button>";
                    $botonMotivo="";

                }
                else if($value["idEstado"] == 4){
                    $botonEstado="<button type='button' class='btn btn-block btn-danger font-weight-bold' data-toggle='tooltip' data-placement='left' title='$value[descEstado]'><i class='fas fa-window-close'></i> &nbsp; $value[descEstado]</button>";
                    $botonMotivo="<button type='button' class='btn btn-block btn-info font-weight-bold btnVerMotivo' idReferencia='$value[idReferencia]' data-toggle='modal' data-target='#modal-ver-motivo'><i class='fas fa-eye'></i> &nbsp; VER MOTIVO</button>";
                }
                else if($value["idEstado"] == 5){
                    $botonEstado="<button type='button' class='btn btn-block btn-warning font-weight-bold' data-toggle='tooltip' data-placement='left' title='$value[descEstado]'><i class='fas fa-exclamation-triangle'></i> &nbsp; $value[descEstado]</button>";
                    $botonMotivo="<button type='button' class='btn btn-block btn-info font-weight-bold btnVerMotivo' idReferencia='$value[idReferencia]' data-toggle='modal' data-target='#modal-ver-motivo'><i class='fas fa-eye'></i> &nbsp; VER MOTIVO</button>";
                }

                $dataRefsHTML .="<tr>
                    <td>".($key+1)."</td>
                    <td>$value[anioReferencia]</td>
                    <td>$value[nroHojaRef]</td>
                    <td>$value[fechaReferencia]</td>
                    <td>$value[nombreTipDoc]-$value[nroDoc]</td>
                    <td>$value[apePaterno] $value[apeMaterno] $value[nombres]</td>
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
                <th>N° Doc</th>
                <th>Paciente</th>
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
}

if (isset($_POST["dni"])) {
    $listBREF = new AjaxReferenciasWeb();
    $listBREF->dni = $_POST["dni"];
    $listBREF->anio = $_POST["anio"];
    $listBREF->ajaxListarReferenciasWeb();
}
