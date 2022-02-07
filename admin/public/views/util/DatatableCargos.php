<?php
// LLamada a controlador
require_once "../../../app/controller/CargosControlador.php";
// LLamada a modelo
require_once "../../../app/model/CargosModelo.php";

class DatatableCargos
{
    public function mostrarTablaCargos()
    {
        $item = null;
        $valor = null;
        $cargos = CargosControlador::ctrListarCargos($item, $valor);

        $datos_json = '{
            "data": [';

        for ($i = 0; $i < count($cargos); $i++) {
            // Botones de Opciones
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarCargo' idCargo='" . $cargos[$i]["idCargo"] . "' data-toggle='modal' data-target='#modal-editar-cargo'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarCargo' data-toggle='tooltip' data-placement='left' title='Eliminar Cargo' idCargo='" . $cargos[$i]["idCargo"] . "'><i class='fas fa-trash-alt'></i></button></div>";

            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $cargos[$i]["codCargo"] . '",
                "' . $cargos[$i]["descCargo"] . '",
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
$tablaCargos = new DatatableCargos();
$tablaCargos->mostrarTablaCargos();
