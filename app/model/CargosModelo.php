<?php
require_once "dbConnect.php";
class CargosModelo
{
    static public function mdlListarCargos($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            mrms_cargos.idCargo, 
            mrms_cargos.codCargo,
            mrms_cargos.descCargo
        FROM
            mrms_cargos
        WHERE $item = :$item 
        ORDER BY mrms_cargos.descCargo ASC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL Listar_Cargos()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }

    static public function mdlRegistrarCargo($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Registrar_Cargo(:codCargo,:descCargo)");

        $stmt->bindParam(":codCargo", $datos["codCargo"], PDO::PARAM_STR);
        $stmt->bindParam(":descCargo", $datos["descCargo"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlEditarCargo($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Editar_Cargo(:codCargo,:descCargo,:idCargo)");

        $stmt->bindParam(":idCargo", $datos["idCargo"], PDO::PARAM_INT);
        $stmt->bindParam(":codCargo", $datos["codCargo"], PDO::PARAM_STR);
        $stmt->bindParam(":descCargo", $datos["descCargo"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlEliminarCargo($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Eliminar_Cargo(:idCargo)");
        $stmt->bindParam(":idCargo", $datos, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
}
