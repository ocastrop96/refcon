<?php
require_once "../../../app/controller/ReportesControlador.php";
require_once "../../../app/model/ReportesModelo.php";

class AjaxGraficos
{
    public $anio;
    public function ajaxCargaWid()
    {
        $year = $this->anio;
        $respuesta = ReportesControlador::ctrListarWidgets($year);
        echo json_encode($respuesta);
    }


    public $anio2;
    public function ajaxCargaRefsxMes()
    {
        $year = $this->anio2;
        $respuesta = ReportesControlador::ctrListarRefsxMes($year);
        echo json_encode($respuesta);
    }

    public $anio3;
    public function ajaxCargaRefsxOrigen()
    {
        $year = $this->anio3;
        $respuesta = ReportesControlador::ctrListarRefsxOrigen($year);
        echo json_encode($respuesta);
    }
}

if (isset($_POST["anio"])) {
    $list1 = new AjaxGraficos();
    $list1->anio = $_POST["anio"];
    $list1->ajaxCargaWid();
}


if (isset($_POST["anio2"])) {
    $list2 = new AjaxGraficos();
    $list2->anio2 = $_POST["anio2"];
    $list2->ajaxCargaRefsxMes();
}

if (isset($_POST["anio3"])) {
    $list3 = new AjaxGraficos();
    $list3->anio3 = $_POST["anio3"];
    $list3->ajaxCargaRefsxOrigen();
}