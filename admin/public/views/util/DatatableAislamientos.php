<?php
// LLamada a controlador
require_once "../../../app/controller/SOcupControlador.php";
// LLamada a modelo
require_once "../../../app/model/SOcupModelo.php";

class DatatableSaludOcup
{
    public function mostrarTablaSalOcup()
    {
        $item = null;
        $valor = null;
        $aislamientos = SOcupControlador::ctrListarSaludOcup($item, $valor);

        $datos_json = '{
            "data": [';

        for ($i = 0; $i < count($aislamientos); $i++) {
            // Botones de Estado
            if (($aislamientos[$i]["estadoAis"] != 0)) {
                $estado = "<button type='button' class='btn btn-block btn-success'><i class='fas fa-check'></i>REGISTRADO</button>";
                $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarSOcup' idAis='" . $aislamientos[$i]["idAis"] . "' data-toggle='modal' data-target='#modal-editar-aislamiento'><i class='fas fa-edit'></i></button><button class='btn btn-secondary btnAnularLicencia' data-toggle='tooltip' data-placement='left' title='Anular SOcup' idAis='" . $aislamientos[$i]["idAis"] . "'><i class='fas fa-ban'></i></button></div>";
            } else {
                $estado = "<button type='button' class='btn btn-block btn-danger'><i class='fas fa-times-circle'></i>ANULADO</button>";
                $botones = "REGISTRO ANULADO";
            }
            // Botones de Opciones
        
            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $aislamientos[$i]["correAis"] . '",
                "' . $aislamientos[$i]["fechaRegAis"] . '",
                "' . $aislamientos[$i]["dniEmp"] . '",
                "' . $aislamientos[$i]["apellidosPEmp"] . ' ' . $aislamientos[$i]["apellidosMEmp"] . ' ' . $aislamientos[$i]["nombresEmp"] . '",
                "' . $aislamientos[$i]["descLocacion"] . '",
                "' . $aislamientos[$i]["descMotivo"] . '",
                "' . $aislamientos[$i]["recomLic"] . '",
                "' . $aislamientos[$i]["fechaInicio"] . '",
                "' . $aislamientos[$i]["fechaFin"] . '",
                "' . $aislamientos[$i]["nDias"] . '",
                "' . $aislamientos[$i]["fechaReinc"] . '", 
                "' .  $estado . '", 
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}
$tablaLicencias = new DatatableSaludOcup();
$tablaLicencias->mostrarTablaSalOcup();
