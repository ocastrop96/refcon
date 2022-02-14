<?php
require_once "../../../app/controller/ReferenciasControlador.php";
require_once "../../../app/model/ReferenciasModelo.php";
class DatatableConsultaReferencias
{
    public function mostrarTablaReferenciasWeb()
    {
        $dni = $_GET["dni"];
        $anio = $_GET["anio"];

        $consultRefs = ReferenciasControlador::ctrListarReferenciasWeb($dni, $anio);
        $total = count($consultRefs);

        $datos_json = '{
            "data": [';
        $datos_json .= '[
            "'.$total.'",
            "-",
            "-",
            "-",
            "-",
            "-",
            "-",
            "-",
            "-"
        ],';
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}

$tablareferenciasProce = new DatatableConsultaReferencias();
$tablareferenciasProce->mostrarTablaReferenciasWeb();
