<?php
// LLamada a controlador
require_once "../../../app/controller/LicenciasControlador.php";
// LLamada a modelo
require_once "../../../app/model/LicenciasModelo.php";

class DatatableLicencias
{
    public function mostrarTablaLicencias()
    {
        $item = null;
        $valor = null;
        $licencias = LicenciasControlador::ctrListarLicencias($item, $valor);

        $datos_json = '{
            "data": [';

        for ($i = 0; $i < count($licencias); $i++) {
            // Botones de Opciones
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarLicencia' idLicencia='" . $licencias[$i]["idLicencia"] . "' data-toggle='modal' data-target='#modal-editar-licencia'><i class='fas fa-edit'></i></button><button class='btn btn-secondary btnAnularLicencia' data-toggle='tooltip' data-placement='left' title='Anular Licencia' idLicencia='" . $licencias[$i]["idLicencia"] . "' nDias = '".$licencias[$i]["NDias"]."'><i class='fas fa-ban'></i></button></div>";
            // Estado de Paciente
            if ($licencias[$i]["estadoLic"] == 1) {
                $estadoLic = "<button type='button' class='btn btn-block btn-success font-weight-bold' data-toggle='tooltip' data-placement='left' title='" . $licencias[$i]["descEstLic"] . "'><i class='fas fa-check-circle'></i></button>";
            }  else {
                $estadoLic = "<button type='button' class='btn btn-block btn-danger font-weight-bold' data-toggle='tooltip' data-placement='left' title='" . $licencias[$i]["descEstLic"] . "'><i class='fas fa-exclamation-circle'></i></button>";
            }
            // Estado de Paciente

            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $licencias[$i]["correlativoLic"] . '",
                "' . $licencias[$i]["expAnterior"] . '",
                "' . $licencias[$i]["fechaIngreso"] . '",
                "' . $licencias[$i]["dniEmp"] . '",
                "' . $licencias[$i]["apellidosPEmp"] . ' ' . $licencias[$i]["apellidosMEmp"] . ' ' . $licencias[$i]["nombresEmp"] . '",
                "' . $licencias[$i]["descCondicion"] . '",
                "' . $licencias[$i]["fechaInicio"] . '",
                "' . $licencias[$i]["fechaFin"] . '",
                "' . $licencias[$i]["NDias"] . '",
                "' . $licencias[$i]["descTipoEnt"] . '",
                "' . $licencias[$i]["anioMedico"] . '-'.$licencias[$i]["descMes"].'",
                "' . $estadoLic . '",
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}
$tablaLicencias = new DatatableLicencias();
$tablaLicencias->mostrarTablaLicencias();
