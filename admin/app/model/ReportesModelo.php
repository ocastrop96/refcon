<?php
require_once "dbConnect.php";
class ReportesModelo
{
    static public function mdlReporteControlReferencias($anio, $mes,$dni)
    {
        $stmt = Conexion::conectar()->prepare("CALL Reporte_Control_Refcon(:anio,:mes,:dni)");

        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
        $stmt->bindParam(":dni", $dni, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarWidgets($anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL CargarContadores(:anio)");

        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }


    static public function mdlListarRefsxMes($anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Graph_RefsXMes(:anio)");

        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarRefsxOrigen($anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Graph_RefsXOrigen(:anio)");

        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
}
