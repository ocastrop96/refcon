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

        $stmt = Conexion::conectar()->prepare("CALL Buscar_Especialidad('$valorTermino')");
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array("id" => $row['idEspecialidad'], "text" =>  $row['nombreEsp']);
        }
        echo json_encode($data);
    }

    public $dato4;

    public function ajaxBuscarServicio2()
    {
        $valorTermino = $this->dato4;

        $stmt = Conexion::conectar()->prepare("CALL Buscar_Especialidad('$valorTermino')");
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = array("id" => $row['idEspecialidad'], "text" =>  $row['nombreEsp']);
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

    // Validacion de N?? de Referencia con DNI
    public $anioReferencia;
    public $nroReferencia;
    public function ajaxValidarDNINroReferencia()
    {
        $valorAnio = $this->anioReferencia;
        $valorNroRef = $this->nroReferencia;
        $respuesta = ReferenciasControlador::ctrValidarNroReferenciaxDni($valorAnio, $valorNroRef);

        echo json_encode($respuesta);
    }
    // Validacion de N?? de Referencia con DNI

        // Validacion de N?? de Referencia con DNI Galenhos
        public $anioReferencia2;
        public $nroReferencia2;

        public function ajaxValidarDNINroReferenciaxGalen()
        {
            $valorAnio = $this->anioReferencia2;
            $valorNroRef = $this->nroReferencia2;

            $respuesta = ReferenciasControlador::ctrValidarNroReferenciaxGalen($valorAnio, $valorNroRef);
    
            echo json_encode($respuesta);
        }
        // Validacion de N?? de Referencia con DNI Galenhos

}
// B??squeda de Empleado
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
// B??squeda de Empleado
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


// Validar Referencia
if (isset($_POST["nroReferencia"])) {
    $list6 = new AjaxReferencias();
    $list6->anioReferencia = $_POST["anioReferencia"];
    $list6->nroReferencia = $_POST["nroReferencia"];
    $list6->ajaxValidarDNINroReferencia();
}


// Validar Referencia X Galenhos
if (isset($_POST["confirmacion22"])) {
    $list10 = new AjaxReferencias();
    $list10->anioReferencia2 = $_POST["anioReferencia2"];
    $list10->nroReferencia2 = $_POST["nroReferencia2"];
    $list10->ajaxValidarDNINroReferenciaxGalen();
}
// Validar Referencia X Galenhos


