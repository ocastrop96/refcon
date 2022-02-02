<?php
require_once "../../../app/controller/EmpleadosControlador.php";
require_once "../../../app/model/EmpleadosModelo.php";
require_once "../../../app/model/dbConnect.php";

class AjaxEmpleados
{
    public $dato;
    public function ajaxBuscarEmpleado()
    {
        $valorTermino = $this->dato;

        $stmt = Conexion::conectar()->prepare("CALL Buscar_Empleado('$valorTermino')");
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array("id" => $row['idEmpleado'], "text" =>  $row['dniEmp'].' - ' . $row['apellidosPEmp'].' ' . $row['apellidosMEmp'].' ' . $row['nombresEmp'].' || ' . $row['descCondicion'].' || ' . $row['descCargo']);
        }
        echo json_encode($data);
    }
    
    public $dniEmp;
    public function ajaxValidaDniEmp(){
        $item = "dniEmp";
        $valor = $this->dniEmp;
        $respuesta = EmpleadosControlador::ctrListarEmpleados($item, $valor);
        echo json_encode($respuesta);
    }

    public $idEmpleado;
    public function ajaxListarEmpleado()
    {
        $item = "idEmpleado";
        $valor = $this->idEmpleado;
        $respuesta = EmpleadosControlador::ctrListarEmpleados($item, $valor);
        echo json_encode($respuesta);
    }
}
// Búsqueda de Empleado
if (isset($_POST["searchTerm"])) {
    $list1 = new AjaxEmpleados();
    $list1->dato = $_POST["searchTerm"];
    $list1->ajaxBuscarEmpleado();
}
// Búsqueda de Empleado
// Validar DNI existente
if (isset($_POST["dniEmp"])) {
    $validar = new AjaxEmpleados();
    $validar->dniEmp = $_POST["dniEmp"];
    $validar->ajaxValidaDniEmp();
}
// Validar DNI existente
if (isset($_POST["idEmpleado"])) {
    $list2 = new AjaxEmpleados();
    $list2->idEmpleado = $_POST["idEmpleado"];
    $list2->ajaxListarEmpleado();
}