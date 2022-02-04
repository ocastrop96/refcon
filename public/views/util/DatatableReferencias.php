<?php
// LLamada a controlador
require_once "../../../app/controller/ReferenciasControlador.php";
// LLamada a modelo
require_once "../../../app/model/ReferenciasModelo.php";

class DatatableReferencias
{
    public function mostrarTablaReferencias()
    {
        $item = null;
        $valor = null;
        $referencias = ReferenciasControlador::ctrListarReferencias($item, $valor);

        $datos_json = '{
            "data": [';

        for ($i = 0; $i < count($referencias); $i++) {


            // Botones de Opciones
            $botonVisible = "<div class='btn-group center-block'><button class='btn btn-success btnEditarReferencia' idReferencia='" . $referencias[$i]["idReferencia"] . "' data-toggle='modal' data-target='#modal-editar-referencia'><i class='fas fa-eye'></i></button></div>";
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarReferencia' idReferencia='" . $referencias[$i]["idReferencia"] . "' data-toggle='modal' data-target='#modal-editar-referencia'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminaReferencia' data-toggle='tooltip' data-placement='left' title='Eliminar Referencia' idReferencia='" . $referencias[$i]["idReferencia"] . "'><i class='fas fa-trash-alt'></i></button></div>";

            // Botones Estado Referencias
            if ($referencias[$i]["idEstado"] == 1) {
                $estadoRef = "<button type='button' class='btn btn-block btn-secondary font-weight-bold' data-toggle='tooltip' data-placement='left' title='" . $referencias[$i]["descEstado"] . "'><i class='fas fa-history'></i> &nbsp; " . $referencias[$i]["descEstado"] . "</button>";
            } else if ($referencias[$i]["idEstado"] == 2) {
                $estadoRef = "<button type='button' class='btn btn-block btn-success font-weight-bold' data-toggle='tooltip' data-placement='left' title='" . $referencias[$i]["descEstado"] . "'><i class='fas fa-check-circle'></i> &nbsp; " . $referencias[$i]["descEstado"] . "</button>";
            } else if ($referencias[$i]["idEstado"] == 3) {
                $estadoRef = "<button type='button' class='btn btn-block btn-success font-weight-bold' data-toggle='tooltip' data-placement='left' title='" . $referencias[$i]["descEstado"] . "'><i class='fas fa-check-circle'></i> &nbsp; " . $referencias[$i]["descEstado"] . "</button>";
            } else if ($referencias[$i]["idEstado"] == 4) {
                $estadoRef = "<button type='button' class='btn btn-block btn-danger font-weight-bold' data-toggle='tooltip' data-placement='left' title='" . $referencias[$i]["descEstado"] . "'><i class='fas fa-window-close'></i> &nbsp; " . $referencias[$i]["descEstado"] . "</button>";
            } else if ($referencias[$i]["idEstado"] == 5) {
                $estadoRef = "<button type='button' class='btn btn-block btn-warning font-weight-bold' data-toggle='tooltip' data-placement='left' title='" . $referencias[$i]["descEstado"] . "'><i class='fas fa-exclamation-triangle'></i> &nbsp; " . $referencias[$i]["descEstado"] . "</button>";
            }
            // Botones Estado Referencias

            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $referencias[$i]["nroHojaRef"] . '",
                "' . $referencias[$i]["fechaReferencia"] . '",
                "' . $referencias[$i]["nombreTipDoc"] . '-' . $referencias[$i]["nroDoc"] . '",
                "' . $referencias[$i]["apePaterno"] . ' ' . $referencias[$i]["apeMaterno"] . ' ' . $referencias[$i]["nombres"] . '",
                "' . $referencias[$i]["codigoEstab"] . ' - ' . $referencias[$i]["nombreEstablecimiento"] . '",
                "' . $referencias[$i]["nombreEsp"] . ' - ' . $referencias[$i]["nombServicio"] . '",
                "' . $estadoRef . '",
                "' . $botonVisible . '",
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}
// Llamamos a la tabla de Usuarios
$tablareferencias = new Datatablereferencias();
$tablareferencias->mostrarTablareferencias();
