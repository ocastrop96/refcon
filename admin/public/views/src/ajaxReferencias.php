<?php
require_once "../../../app/controller/EmpleadosControlador.php";
require_once "../../../app/model/EmpleadosModelo.php";
require_once "../../../app/model/dbConnect.php";

class AjaxReferencias
{
    public $dato;
    public function ajaxBuscarEstablecimiento()
    {
        $valorTermino = $this->dato;

        $stmt = Conexion::conectar()->prepare("CALL Buscar_Establecimientos('$valorTermino')");
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array("id" => $row['idEstablecimiento'], "text" =>  $row['codigoEstab'] . ' - ' . $row['nombreEstablecimiento'] . ' - ' . $row['ubicacion']);
        }
        echo json_encode($data);
    }

    public $dato2;
    public function ajaxBuscarServicio()
    {
        $valorTermino = $this->dato2;

        $stmt = Conexion::conectar()->prepare("CALL Buscar_Servicio('$valorTermino')");
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array("id" => $row['idServicio'], "text" =>  $row['descripcion']);
        }
        echo json_encode($data);
    }



    public $dniEmp;
    public function ajaxValidaDniEmp()
    {
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
    $list1 = new AjaxReferencias();
    $list1->dato = $_POST["searchTerm"];
    $list1->ajaxBuscarEstablecimiento();
}
// Búsqueda de Empleado
// Busqueda de Servicio
if (isset($_POST["searchTerm2"])) {
    $list2 = new AjaxReferencias();
    $list2->dato2 = $_POST["searchTerm2"];
    $list2->ajaxBuscarServicio();
}
// Busqueda de Servicio
// Validar DNI existente
// if (isset($_POST["dniEmp"])) {
//     $validar = new AjaxEmpleados();
//     $validar->dniEmp = $_POST["dniEmp"];
//     $validar->ajaxValidaDniEmp();
// }
// // Validar DNI existente
// if (isset($_POST["idEmpleado"])) {
//     $list2 = new AjaxEmpleados();
//     $list2->idEmpleado = $_POST["idEmpleado"];
//     $list2->ajaxListarEmpleado();
// }
