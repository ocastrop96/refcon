<?php
require_once "dbConnect.php";
require_once "MSdb.php";


class ReferenciasModelo
{
    static public function mdlBuscarReferencias($dni, $anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Consulta_ReferenciasPaciente(:dni,:anio)");
        $stmt->bindParam(":dni", $dni, PDO::PARAM_STR);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlBuscarReferenciasSIGH($dni, $anio)
    {
        $stmt = ConexionConsulta::conectar()->prepare("CALL Consulta_ReferenciasPaciente(:dni,:anio)");
        $stmt->bindParam(":dni", $dni, PDO::PARAM_STR);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
}
