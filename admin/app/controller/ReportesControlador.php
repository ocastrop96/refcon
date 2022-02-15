<?php
class ReportesControlador{
    static public function ctrReporteReferencias(){
        if (isset($_GET["reporte"])) {
            if (isset($_GET["anio"]) && isset($_GET["mes"])) {
                $controlPer = ReportesModelo::mdlReporteControlReferencias($_GET["anio"], $_GET["mes"],$_GET["dni"]);
                $Name = 'REPORTE_CONTROL-REFERENCIAS DE MES N°' . $_GET["mes"] . '_AÑO_N°_' . $_GET["anio"] . '.xls';
            }
        }
    }
}