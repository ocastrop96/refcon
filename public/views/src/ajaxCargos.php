<?php
require_once "../../../app/controller/CargosControlador.php";
require_once "../../../app/model/CargosModelo.php";
require_once "../../../app/model/dbConnect.php";
class AjaxCargos
{
    public $dato;
    public function ajaxBuscarCargo()
    {
        $valorTermino = $this->dato;

        $stmt = Conexion::conectar()->prepare("CALL Buscar_Cargos('$valorTermino')");
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array("id" => $row['idCargo'], "text" =>  $row['cargodetalle']);
        }
        echo json_encode($data);
    }

    public $idCargo;
    public function ajaxListarCargo()
    {
        $item = "idCargo";
        $valor = $this->idCargo;
        $respuesta = CargosControlador::ctrListarCargos($item, $valor);
        echo json_encode($respuesta);
    }

    public $codigo;
    public function ajaxValidaCodigo()
    {
        $item = "codCargo";
        $valor = $this->codigo;
        $respuesta = CargosControlador::ctrListarCargos($item, $valor);
        echo json_encode($respuesta);
    }
}

// Búsqueda de Cargo
if (isset($_POST["searchTerm"])) {
    $list1 = new AjaxCargos();
    $list1->dato = $_POST["searchTerm"];
    $list1->ajaxBuscarCargo();
}
// Búsqueda de Cargo
if (isset($_POST["idCargo"])) {
    $list2 = new AjaxCargos();
    $list2->idCargo = $_POST["idCargo"];
    $list2->ajaxListarCargo();
}
if (isset($_POST["codigo"])) {
    $list3 = new AjaxCargos();
    $list3->codigo = $_POST["codigo"];
    $list3->ajaxValidaCodigo();
}
