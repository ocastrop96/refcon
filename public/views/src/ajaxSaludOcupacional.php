<?php
require_once "../../../app/controller/SOcupControlador.php";
require_once "../../../app/model/SOcupModelo.php";

class AjaxSaludOcupacional
{
    public $idAis;
    public function ajaxListarData()
    {
        $item = "idAis";
        $valor = $this->idAis;
        $respuesta = SOcupControlador::ctrListarSaludOcup($item, $valor);
        echo json_encode($respuesta);
    }
}

if (isset($_POST["idAis"])) {
    $list2 = new AjaxSaludOcupacional();
    $list2->idAis = $_POST["idAis"];
    $list2->ajaxListarData();
}
