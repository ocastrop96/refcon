<?php
require_once "dbConnect.php";

class ReferenciasModelo
{
    static public function mdlListarReferencias($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            referencias.idReferencia, 
            referencias.nroHojaRef, 
            date_format(referencias.fechaReferencia,'%d/%m/%Y') AS fechaReferencia, 
            referencias.idDepartamento, 
            departamentosh.nombreDept, 
            referencias.idEspecialidad, 
            especialidades.nombreEsp, 
            referencias.idServicio, 
            servicios.nombServicio, 
            referencias.idEstablecimiento, 
            establecimientos.codigoEstab, 
            establecimientos.nombreEstablecimiento, 
            referencias.idTipoDoc, 
            tiposdoc.nombreTipDoc, 
            referencias.nroDoc, 
            referencias.idSexo, 
            sexousuario.descSexo, 
            referencias.apePaterno, 
            referencias.apeMaterno, 
            referencias.nombres, 
            referencias.motivo, 
            referencias.activo, 
            referencias.idEstado, 
            estadoref.descEstado
        FROM
            referencias
            INNER JOIN
            departamentosh
            ON 
                referencias.idDepartamento = departamentosh.idDepartamentoH
            INNER JOIN
            especialidades
            ON 
                referencias.idEspecialidad = especialidades.idEspecialidad
            INNER JOIN
            servicios
            ON 
                referencias.idServicio = servicios.idServicio
            INNER JOIN
            establecimientos
            ON 
                referencias.idEstablecimiento = establecimientos.idEstablecimiento
            INNER JOIN
            tiposdoc
            ON 
                referencias.idTipoDoc = tiposdoc.idTipoDoc
            INNER JOIN
            sexousuario
            ON 
                referencias.idSexo = sexousuario.idSexo
            INNER JOIN
            estadoref
            ON 
                referencias.idEstado = estadoref.idEstado
                WHERE activo = 1 AND $item = :$item
                ORDER BY fechaReferencia DESC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL Listar_Referencias()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }

}