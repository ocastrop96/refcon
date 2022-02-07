<?php
require_once "../../../app/controller/LicenciasControlador.php";
require_once "../../../app/model/LicenciasModelo.php";

class ajaxLicencias
{
    public $tipoEntidad;
    public function ajaxDatosEntidad()
    {
        $valor = $this->tipoEntidad;
        $respuesta = LicenciasControlador::ctrListaDatosEntidades($valor);
        echo json_encode($respuesta);
    }

    public $idLicencia;
    public function ajaxListarLicencia()
    {
        $item = "idLicencia";
        $valor = $this->idLicencia;
        $respuesta = LicenciasControlador::ctrListarLicencias($item, $valor);
        echo json_encode($respuesta);
    }
}

// Listar Datos de Entidad
if (isset($_POST["tipoEnt"])) {
    $listaData = new ajaxLicencias();
    $listaData->tipoEntidad = $_POST["tipoEnt"];
    $listaData->ajaxDatosEntidad();
}
// Listar Datos de Entidad
// Listar datos de Licencia
if (isset($_POST["idLicencia"])) {
    $listaLic = new ajaxLicencias();
    $listaLic->idLicencia = $_POST["idLicencia"];
    $listaLic->ajaxListarLicencia();
}
// Listar datos de Licencia