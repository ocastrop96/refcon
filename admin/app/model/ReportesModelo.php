<?php
require_once "dbConnect.php";
class ReportesModelo
{
    static public function mdlReporteControlReferencias($anio, $mes,$dni)
    {
        $stmt = Conexion::conectar()->prepare("CALL Reporte_Control_Referencias(:anio,:mes,:dni)");

        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
        $stmt->bindParam(":dni", $dni, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
}
