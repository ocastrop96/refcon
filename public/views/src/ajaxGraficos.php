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
    public function ajaxCargaMensualLicencias()
    {
        $year = $this->anio2;
        $respuesta = ReportesControlador::ctrListarLicenciasMensual($year);
        echo json_encode($respuesta);
    }

    public $anio3;
    public function ajaxCargaProcedenciaLicencias()
    {
        $year = $this->anio3;
        $respuesta = ReportesControlador::ctrListarProcedenciaLicencias($year);
        echo json_encode($respuesta);
    }

    public $anio4;
    public $empleado;
    public function ajaxCargaLicenciasxPersonal()
    {
        $year = $this->anio4;
        $employee = $this->empleado;

        $respuesta = ReportesControlador::ctrListarLicenciasxPersonal($year, $employee);
        echo json_encode($respuesta);
    }

    public $anio5;
    public $empleado5;
    public function ajaxCargaLicenciasxPersonalProcedencia()
    {
        $year = $this->anio5;
        $employee = $this->empleado5;

        $respuesta = ReportesControlador::ctrListarLicenciasxPersonalxProc($year, $employee);
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
    $list2->ajaxCargaMensualLicencias();
}

if (isset($_POST["anio3"])) {
    $list3 = new AjaxGraficos();
    $list3->anio3 = $_POST["anio3"];
    $list3->ajaxCargaProcedenciaLicencias();
}

if (isset($_POST["anio4"])) {
    $list4 = new AjaxGraficos();
    $list4->anio4 = $_POST["anio4"];
    $list4->empleado = $_POST["empleado"];
    $list4->ajaxCargaLicenciasxPersonal();
}

if (isset($_POST["anio5"])) {
    $list5 = new AjaxGraficos();
    $list5->anio5 = $_POST["anio5"];
    $list5->empleado5 = $_POST["empleado5"];
    $list5->ajaxCargaLicenciasxPersonalProcedencia();
}
