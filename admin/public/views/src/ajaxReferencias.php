<?php
require_once "../../../app/controller/ReferenciasControlador.php";
require_once "../../../app/model/ReferenciasModelo.php";
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

    public $dato3;
    public function ajaxBuscarEstablecimiento2()
    {
        $valorTermino = $this->dato3;

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

    public $dato4;
    public function ajaxBuscarServicio2()
    {
        $valorTermino = $this->dato4;

        $stmt = Conexion::conectar()->prepare("CALL Buscar_Servicio('$valorTermino')");
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array("id" => $row['idServicio'], "text" =>  $row['descripcion']);
        }
        echo json_encode($data);
    }

    public $idReferencia;
    public function ajaxListarReferencia()
    {
        $item = "idReferencia";
        $valor = $this->idReferencia;
        $respuesta = ReferenciasControlador::ctrListarReferencias($item, $valor);
        echo json_encode($respuesta);
    }
}
// Búsqueda de Empleado
if (isset($_POST["searchTerm"])) {
    $list1 = new AjaxReferencias();
    $list1->dato = $_POST["searchTerm"];
    $list1->ajaxBuscarEstablecimiento();
}


if (isset($_POST["searchTerm3"])) {
    $list4 = new AjaxReferencias();
    $list4->dato3 = $_POST["searchTerm3"];
    $list4->ajaxBuscarEstablecimiento2();
}
// Búsqueda de Empleado
// Busqueda de Servicio
if (isset($_POST["searchTerm2"])) {
    $list2 = new AjaxReferencias();
    $list2->dato2 = $_POST["searchTerm2"];
    $list2->ajaxBuscarServicio();
}


if (isset($_POST["searchTerm4"])) {
    $list5 = new AjaxReferencias();
    $list5->dato4 = $_POST["searchTerm4"];
    $list5->ajaxBuscarServicio2();
}
// Busqueda de Servicio

// Listar Referencia

if (isset($_POST["idReferencia"])) {
    $list3 = new AjaxReferencias();
    $list3->idReferencia = $_POST["idReferencia"];
    $list3->ajaxListarReferencia();
}
