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
            CONCAT(especialidades.nombreEsp,' - ',servicios.nombServicio) AS descripcion
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

    static public function mdlListarTiposDocumentos()
    {
        $stmt = Conexion::conectar()->prepare("CALL Listar_Tipos_Documentos()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarTipoSexo()
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarTipoSexo()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarEstadoRef()
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarEstadosRef()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlValidarNroReferenciaxDni($anio,$nro)
    {
        $stmt = Conexion::conectar()->prepare("CALL ValidarNroReferenciaxDni(:anio,:nro)");
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->bindParam(":nro", $nro, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlRegistrarReferencia($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Registrar_Referencia(:fechaReferencia,:idEstado,:idServicio,:idEstablecimiento,:idTipoDoc,:idSexo,:nroDoc,:anioReferencia,:nroHojaRef,:apePaterno,:apeMaterno,:nombres,:anamnesis,:motivo,:usuarioCrea,:fechaCreacion)");

        $stmt->bindParam(":idEstado", $datos["idEstado"], PDO::PARAM_INT);
        $stmt->bindParam(":idServicio", $datos["idServicio"], PDO::PARAM_INT);
        $stmt->bindParam(":idEstablecimiento", $datos["idEstablecimiento"], PDO::PARAM_INT);
        $stmt->bindParam(":idTipoDoc", $datos["idTipoDoc"], PDO::PARAM_INT);
        $stmt->bindParam(":idSexo", $datos["idSexo"], PDO::PARAM_INT);
        $stmt->bindParam(":usuarioCrea", $datos["usuarioCrea"], PDO::PARAM_INT);
        $stmt->bindParam(":anioReferencia", $datos["anioReferencia"], PDO::PARAM_INT);

        $stmt->bindParam(":fechaReferencia", $datos["fechaReferencia"], PDO::PARAM_STR);
        $stmt->bindParam(":nroDoc", $datos["nroDoc"], PDO::PARAM_STR);
        $stmt->bindParam(":nroHojaRef", $datos["nroHojaRef"], PDO::PARAM_STR);
        $stmt->bindParam(":apePaterno", $datos["apePaterno"], PDO::PARAM_STR);
        $stmt->bindParam(":apeMaterno", $datos["apeMaterno"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":anamnesis", $datos["anamnesis"], PDO::PARAM_STR);
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaCreacion", $datos["fechaCreacion"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlEditarReferencia($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Editar_Referencia(:idReferencia,:fechaReferencia,:idEstado,:idServicio,:idEstablecimiento,:idTipoDoc,:idSexo,:nroDoc,:anioReferencia,:nroHojaRef,:apePaterno,:apeMaterno,:nombres,:anamnesis,:motivo,:usuarioModif,:fechaModificacion)");

        $stmt->bindParam(":idReferencia", $datos["idReferencia"], PDO::PARAM_INT);
        $stmt->bindParam(":idEstado", $datos["idEstado"], PDO::PARAM_INT);
        $stmt->bindParam(":idServicio", $datos["idServicio"], PDO::PARAM_INT);
        $stmt->bindParam(":idEstablecimiento", $datos["idEstablecimiento"], PDO::PARAM_INT);
        $stmt->bindParam(":idTipoDoc", $datos["idTipoDoc"], PDO::PARAM_INT);
        $stmt->bindParam(":idSexo", $datos["idSexo"], PDO::PARAM_INT);
        $stmt->bindParam(":usuarioModif", $datos["usuarioModif"], PDO::PARAM_INT);

        $stmt->bindParam(":anioReferencia", $datos["anioReferencia"], PDO::PARAM_INT);

        $stmt->bindParam(":fechaReferencia", $datos["fechaReferencia"], PDO::PARAM_STR);
        $stmt->bindParam(":nroDoc", $datos["nroDoc"], PDO::PARAM_STR);
        $stmt->bindParam(":nroHojaRef", $datos["nroHojaRef"], PDO::PARAM_STR);
        $stmt->bindParam(":apePaterno", $datos["apePaterno"], PDO::PARAM_STR);
        $stmt->bindParam(":apeMaterno", $datos["apeMaterno"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":anamnesis", $datos["anamnesis"], PDO::PARAM_STR);
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaModificacion", $datos["fechaModificacion"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlAnularReferencia($datos){
        $stmt = Conexion::conectar()->prepare("CALL Anular_Referencia(:idReferencia,:usuarioAnula,:fechaAnulacion, @val)");
        $stmt->bindParam(":idReferencia", $datos["idReferencia"], PDO::PARAM_INT);
        $stmt->bindParam(":usuarioAnula", $datos["usuarioAnula"], PDO::PARAM_INT);
        $stmt->bindParam(":fechaAnulacion", $datos["fechaAnulacion"], PDO::PARAM_STR);
        $stmt->execute();
        // Validación de mensaje
        $value = $stmt->fetch();
        $val2 = $value['mensaje'];
        if ($val2 == 1) {
            return "ok";
        } else {
            return "error";
        }
        // Validación de mensaje
        $stmt->close();
        $stmt = null;
    }
}
