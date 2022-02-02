<?php
require_once "dbConnect.php";
class SOcupModelo
{
    static public function mdlListarAislamiento($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            mrms_aislamientos.idAis, 
            date_format( mrms_aislamientos.fechaRegAis, '%d/%m/%Y' ) AS fechaRegAis, 
            mrms_aislamientos.empleado, 
            mrms_empleados.dniEmp, 
            mrms_empleados.apellidosPEmp, 
            mrms_empleados.apellidosMEmp, 
            mrms_empleados.nombresEmp, 
            mrms_cargos.codCargo, 
            mrms_cargos.descCargo, 
            mrms_locaciones.idLocacion, 
            mrms_locaciones.descLocacion, 
            mrms_condicionlab.descCondicion, 
            mrms_aislamientos.celular, 
            mrms_motivo_so.idMotivo,
            mrms_motivo_so.descMotivo, 
            mrms_aislamientos.recomLic, 
            date_format( mrms_aislamientos.fechaReinc, '%d/%m/%Y' ) AS fechaReinc, 
            date_format( mrms_aislamientos.fechaInicio, '%d/%m/%Y' ) AS fechaInicio, 
            date_format( mrms_aislamientos.fechaFin, '%d/%m/%Y' ) AS fechaFin, 
            mrms_aislamientos.nDias, 
            mrms_aislamientos.ni, 
            mrms_aislamientos.cm, 
            mrms_aislamientos.correAis
        FROM
            mrms_aislamientos
            INNER JOIN
            mrms_empleados
            ON 
                mrms_aislamientos.empleado = mrms_empleados.idEmpleado
            INNER JOIN
            mrms_locaciones
            ON 
                mrms_aislamientos.locacionAis = mrms_locaciones.idLocacion
            INNER JOIN
            mrms_cargos
            ON 
                mrms_empleados.cargoEmp = mrms_cargos.idCargo
            INNER JOIN
            mrms_condicionlab
            ON 
                mrms_empleados.condicionEmp = mrms_condicionlab.idCondicionLab
            INNER JOIN
            mrms_motivo_so
            ON 
                mrms_aislamientos.motivo = mrms_motivo_so.idMotivo
        WHERE $item = :$item 
        ORDER BY correAis desc");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL Listar_Aislamientos()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }
    static public function mdlListarLocaciones()
    {
        $stmt = Conexion::conectar()->prepare("CALL Listar_Locaciones()");
        $stmt->execute();
        return $stmt->fetchAll();
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarMotivos()
    {
        $stmt = Conexion::conectar()->prepare("CALL Listar_Motivos_SO()");
        $stmt->execute();
        return $stmt->fetchAll();
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }

    static public function mdlRegistrarSaludOcupacional($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Registrar_SaludOcupacional(:empleado,:locacionAis,:fechaRegAis,:fechaInicio,:fechaFin,:nDias,:fechaReinc,:celular,:ni,:cm,:motivo,:recomLic,:autogenerado,:usuReg)");

        $stmt->bindParam(":empleado", $datos["empleado"], PDO::PARAM_INT);
        $stmt->bindParam(":locacionAis", $datos["locacionAis"], PDO::PARAM_INT);
        $stmt->bindParam(":nDias", $datos["nDias"], PDO::PARAM_INT);
        $stmt->bindParam(":usuReg", $datos["usuReg"], PDO::PARAM_INT);
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_INT);
        $stmt->bindParam(":fechaRegAis", $datos["fechaRegAis"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaInicio", $datos["fechaInicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaFin", $datos["fechaFin"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaReinc", $datos["fechaReinc"], PDO::PARAM_STR);
        $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
        $stmt->bindParam(":ni", $datos["ni"], PDO::PARAM_STR);
        $stmt->bindParam(":cm", $datos["cm"], PDO::PARAM_STR);
        $stmt->bindParam(":recomLic", $datos["recomLic"], PDO::PARAM_STR);
        $stmt->bindParam(":autogenerado", $datos["autogenerado"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlRetornaCorrelativoSO($empleado, $autogenerado)
    {
        $stmt = Conexion::conectar()->prepare("CALL Retorna_Correlativo_SaludOcupa(:empleado,:autogenerado,@val)");
        $stmt->bindParam(":empleado", $empleado, PDO::PARAM_INT);
        $stmt->bindParam(":autogenerado", $autogenerado, PDO::PARAM_STR);
        $stmt->execute();
        // Validación de mensaje
        $value = $stmt->fetch();
        $val2 = $value['mensaje'];
        if ($val2 != '0') {
            return $val2;
        } else {
            return "error";
        }
        // Validación de mensaje
        $stmt->close();
        $stmt = null;
    }

    static public function mdlEditarSaludOcupacional($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Editar_SaludOcupacional(:idAis,:empleado,:locacionAis,:fechaRegAis,:fechaInicio,:fechaFin,:nDias,:fechaReinc,:celular,:ni,:cm,:motivo,:recomLic,:usuMod)");

        $stmt->bindParam(":idAis", $datos["idAis"], PDO::PARAM_INT);
        $stmt->bindParam(":empleado", $datos["empleado"], PDO::PARAM_INT);
        $stmt->bindParam(":locacionAis", $datos["locacionAis"], PDO::PARAM_INT);
        $stmt->bindParam(":nDias", $datos["nDias"], PDO::PARAM_INT);
        $stmt->bindParam(":usuMod", $datos["usuMod"], PDO::PARAM_INT);
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_INT);
        $stmt->bindParam(":fechaRegAis", $datos["fechaRegAis"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaInicio", $datos["fechaInicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaFin", $datos["fechaFin"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaReinc", $datos["fechaReinc"], PDO::PARAM_STR);
        $stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
        $stmt->bindParam(":ni", $datos["ni"], PDO::PARAM_STR);
        $stmt->bindParam(":cm", $datos["cm"], PDO::PARAM_STR);
        $stmt->bindParam(":recomLic", $datos["recomLic"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlAnularSaludOcup($idAis, $idUsuario)
    {
        $stmt = Conexion::conectar()->prepare("CALL Anular_SaludOcupacional(:idAis,:usuAnu)");
        $stmt->bindParam(":idAis", $idAis, PDO::PARAM_INT);
        $stmt->bindParam(":usuAnu", $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        // Validación de mensaje
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
}
