<?php
require_once "dbConnect.php";
require_once "MSdb.php";

class ReferenciasModelo
{
    static public function mdlListarReferenciasW($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            referencias.idReferencia, 
            referencias.nroHojaRef, 
            date_format( referencias.fechaReferencia, '%d/%m/%Y' ) AS fechaReferencia, 
            referencias.idDepartamento, 
            referencias.idEspecialidad, 
            referencias.idServicio,
            establecimientos.codigoEstab,
            referencias.idEstablecimiento, 
            establecimientos.codigoEstab, 
            establecimientos.nombreEstablecimiento, 
            referencias.idTipoDoc, 
            tiposdoc.nombreTipDoc, 
            referencias.nroDoc, 
            referencias.anioReferencia, 
            referencias.idSexo, 
            sexousuario.descSexo, 
            referencias.apePaterno, 
            referencias.apeMaterno, 
            referencias.nombres, 
            referencias.motivo, 
            referencias.anamnesis,
            referencias.estadoAnula, 
            referencias.idEstado, 
            estadoref.descEstado, 
            CONCAT(
                UPPER( departamentos.nombreDep ),
                '/',
                UPPER( provincias.nombreProvincia ),
                '/',
            UPPER( distritos.nombreDistrito )) AS ubicacion, 
            CONCAT(especialidades.nombreEsp) AS nombreEsp
        FROM
            referencias
            left JOIN
            departamentosh
            ON 
                referencias.idDepartamento = departamentosh.idDepartamentoH
            LEFT JOIN
            especialidades
            ON 
                referencias.idEspecialidad = especialidades.idEspecialidad
            LEFT JOIN
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
            INNER JOIN
            distritos
            ON 
                establecimientos.idDistrito = distritos.idDistrito
            INNER JOIN
            provincias
            ON 
                distritos.idProvincia = provincias.idProvincia
            INNER JOIN
            departamentos
            ON 
                provincias.idDepartamentos = departamentos.idDepartamento
                WHERE estadoAnula = 1 AND $item = :$item
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
        $stmt = ConexionConsulta::conectar()->prepare("exec Usp_Select_ConsultaRefconWeb @dniUsuario = :dni, @anio = :anio");
        $stmt->bindParam(":dni", $dni, PDO::PARAM_STR);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlBuscarReferenciasxNro($anio,$dni,$referencia)
    {
        $stmt = ConexionConsulta::conectar()->prepare("exec Usp_Select_BuscarReferenciasxNroWeb @anio = :anio, @dni = :dni, @referencia = :referencia");
        $stmt->bindParam(":dni", $dni, PDO::PARAM_STR);
        $stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
}
