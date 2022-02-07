<?php
require_once "dbConnect.php";
require_once "MSdb.php";

class LicenciasModelo
{
    static public function mdlListarLicencias($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            mrms_licencias.idLicencia, 
            mrms_licencias.correlativoLic,
            mrms_licencias.anioMedico, 
            mrms_licencias.mesMedico, 
            mrms_meses.descMes,
            date_format(mrms_licencias.fechaRegistro,'%d/%m/%Y') as fechaRegistro, 
            mrms_licencias.empleado, 
            mrms_empleados.dniEmp, 
            mrms_empleados.nombresEmp, 
            mrms_empleados.apellidosPEmp, 
            mrms_empleados.apellidosMEmp, 
            mrms_condicionlab.descCondicion, 
            mrms_cargos.codCargo, 
            mrms_cargos.descCargo,
            date_format(mrms_licencias.fechaIngreso,'%d/%m/%Y') as fechaIngreso,
            date_format(mrms_licencias.fechaInicio,'%d/%m/%Y') as fechaInicio,
            mrms_licencias.fechaInicio as finic,
            date_format(mrms_licencias.fechaFin,'%d/%m/%Y') as fechaFin, 
            mrms_licencias.NDias, 
            mrms_licencias.entidad, 
            mrms_tipoentidad.descTipoEnt, 
            mrms_licencias.rucEntidad, 
            mrms_licencias.nombEntidad, 
            mrms_licencias.cipMed, 
            mrms_licencias.nombresMed, 
            mrms_licencias.citt, 
            mrms_licencias.servicionAte, 
            mrms_licencias.diagnostico, 
            mrms_licencias.descDiagnostico,
            mrms_licencias.tipDoc, 
            mrms_tipodoc.descTipoDoc, 
            mrms_licencias.nroDoc,
            date_format(mrms_licencias.fechaDoc,'%d/%m/%Y') as fechaDoc,  
            mrms_licencias.descripDoc, 
            mrms_licencias.observaciones, 
            mrms_licencias.adjuntosLic,
            mrms_licencias.estadoLic, 
            mrms_estlicencia.descEstLic
        FROM
            mrms_licencias
            INNER JOIN
            mrms_empleados
            ON 
                mrms_licencias.empleado = mrms_empleados.idEmpleado
            INNER JOIN
            mrms_condicionlab
            ON 
                mrms_empleados.condicionEmp = mrms_condicionlab.idCondicionLab
            INNER JOIN
            mrms_cargos
            ON 
                mrms_empleados.cargoEmp = mrms_cargos.idCargo
            INNER JOIN
            mrms_tipoentidad
            ON 
                mrms_licencias.entidad = mrms_tipoentidad.idTipoEnt
            LEFT JOIN
            mrms_tipodoc
            ON 
                mrms_licencias.tipDoc = mrms_tipodoc.idTipoDoc
            INNER JOIN
            mrms_estlicencia
            ON 
                mrms_licencias.estadoLic = mrms_estlicencia.idEstLic
            LEFT JOIN
            mrms_meses
            ON 
                mrms_licencias.mesMedico = mrms_meses.idMes
        WHERE $item = :$item 
        ORDER BY fechaIngreso ASC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL Listar_Licencias()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }
    static public function mdlRegistrarLicencia($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Registrar_Licencia(:anioMedico,:mesMedico,:fechaRegistro,:estadoLic,:empleado,:fechaIngreso,:fechaInicio,:fechaFin,:NDias,:entidad,:rucEntidad,:nombEntidad,:cipMed,:nombresMed,:citt,:servicionAte,:diagnostico,:descDiagnostico,:tipDoc,:fechaDoc,:nroDoc,:descripDoc,:observaciones,:userReg,:autogenerado)");

        $stmt->bindParam(":anioMedico", $datos["anioMedico"], PDO::PARAM_INT);
        $stmt->bindParam(":mesMedico", $datos["mesMedico"], PDO::PARAM_INT);
        $stmt->bindParam(":estadoLic", $datos["estadoLic"], PDO::PARAM_INT);
        $stmt->bindParam(":empleado", $datos["empleado"], PDO::PARAM_INT);
        $stmt->bindParam(":NDias", $datos["NDias"], PDO::PARAM_INT);
        $stmt->bindParam(":entidad", $datos["entidad"], PDO::PARAM_INT);
        $stmt->bindParam(":tipDoc", $datos["tipDoc"], PDO::PARAM_INT);
        $stmt->bindParam(":userReg", $datos["userReg"], PDO::PARAM_INT);
        $stmt->bindParam(":fechaRegistro", $datos["fechaRegistro"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaIngreso", $datos["fechaIngreso"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaInicio", $datos["fechaInicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaFin", $datos["fechaFin"], PDO::PARAM_STR);
        $stmt->bindParam(":rucEntidad", $datos["rucEntidad"], PDO::PARAM_STR);
        $stmt->bindParam(":nombEntidad", $datos["nombEntidad"], PDO::PARAM_STR);
        $stmt->bindParam(":cipMed", $datos["cipMed"], PDO::PARAM_STR);
        $stmt->bindParam(":nombresMed", $datos["nombresMed"], PDO::PARAM_STR);
        $stmt->bindParam(":citt", $datos["citt"], PDO::PARAM_STR);
        $stmt->bindParam(":servicionAte", $datos["servicionAte"], PDO::PARAM_STR);
        $stmt->bindParam(":diagnostico", $datos["diagnostico"], PDO::PARAM_STR);
        $stmt->bindParam(":descDiagnostico", $datos["descDiagnostico"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaDoc", $datos["fechaDoc"], PDO::PARAM_STR);
        $stmt->bindParam(":nroDoc", $datos["nroDoc"], PDO::PARAM_STR);
        $stmt->bindParam(":descripDoc", $datos["descripDoc"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
        $stmt->bindParam(":autogenerado", $datos["autogenerado"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlEditarLicencia($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Editar_Licencia(:idLicencia,:userMod,:anioMedico,:mesMedico,:mesMedicoA,:estadoLic,:empleado,:fechaIngreso,:fechaInicio,:fechaFin,:NDias,:NDiasA,:entidad,:rucEntidad,:nombEntidad,:cipMed,:nombresMed,:citt,:servicionAte,:diagnostico,:descDiagnostico,:tipDoc,:fechaDoc,:nroDoc,:descripDoc,:observaciones)");

        $stmt->bindParam(":idLicencia", $datos["idLicencia"], PDO::PARAM_INT);
        $stmt->bindParam(":anioMedico", $datos["anioMedico"], PDO::PARAM_INT);
        $stmt->bindParam(":mesMedico", $datos["mesMedico"], PDO::PARAM_INT);
        $stmt->bindParam(":estadoLic", $datos["estadoLic"], PDO::PARAM_INT);
        $stmt->bindParam(":empleado", $datos["empleado"], PDO::PARAM_INT);

        $stmt->bindParam(":NDias", $datos["NDias"], PDO::PARAM_INT);
        $stmt->bindParam(":entidad", $datos["entidad"], PDO::PARAM_INT);
        $stmt->bindParam(":tipDoc", $datos["tipDoc"], PDO::PARAM_INT);
        $stmt->bindParam(":mesMedicoA", $datos["mesMedicoA"], PDO::PARAM_INT);
        $stmt->bindParam(":NDiasA", $datos["NDiasA"], PDO::PARAM_INT);

        $stmt->bindParam(":userMod", $datos["userMod"], PDO::PARAM_INT);
        $stmt->bindParam(":fechaIngreso", $datos["fechaIngreso"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaInicio", $datos["fechaInicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaFin", $datos["fechaFin"], PDO::PARAM_STR);
        $stmt->bindParam(":rucEntidad", $datos["rucEntidad"], PDO::PARAM_STR);

        $stmt->bindParam(":nombEntidad", $datos["nombEntidad"], PDO::PARAM_STR);
        $stmt->bindParam(":cipMed", $datos["cipMed"], PDO::PARAM_STR);
        $stmt->bindParam(":nombresMed", $datos["nombresMed"], PDO::PARAM_STR);
        $stmt->bindParam(":citt", $datos["citt"], PDO::PARAM_STR);
        $stmt->bindParam(":servicionAte", $datos["servicionAte"], PDO::PARAM_STR);

        $stmt->bindParam(":diagnostico", $datos["diagnostico"], PDO::PARAM_STR);
        $stmt->bindParam(":descDiagnostico", $datos["descDiagnostico"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaDoc", $datos["fechaDoc"], PDO::PARAM_STR);
        $stmt->bindParam(":nroDoc", $datos["nroDoc"], PDO::PARAM_STR);
        $stmt->bindParam(":descripDoc", $datos["descripDoc"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlRetornaCorrelativo($empleado, $autogenerado,$anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Retorna_Correlativo_Dias(:empleado,:autogenerado,:anio,@val)");
        $stmt->bindParam(":empleado", $empleado, PDO::PARAM_INT);
        $stmt->bindParam(":autogenerado", $autogenerado, PDO::PARAM_STR);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        
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

    static public function mdlRetornaAcumuladoModificar($empleado, $anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Retorna_Acumulado_Dias_Modificar(:empleado,:anio,@val)");
        $stmt->bindParam(":empleado", $empleado, PDO::PARAM_INT);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
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
    static public function mdlTraerDxs($dato)
    {
        $stmt = ConexionConsulta::conectar()->prepare("exec ListarDxPersonal @Termino = :Termino");
        $stmt->bindParam(":Termino", $dato, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarDx($idDx)
    {
        $stmt = ConexionConsulta::conectar()->prepare("SELECT
        Diagnosticos.IdDiagnostico, 
        Diagnosticos.CodigoCIE10, 
        Diagnosticos.Descripcion
        FROM
        dbo.Diagnosticos WHERE IdDiagnostico =:idDx");
        $stmt->bindParam(":idDx", $idDx, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarMeses()
    {
        $stmt = Conexion::conectar()->prepare("CALL Listar_Meses()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarTipoEntidad()
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarTiposEntidad()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlListarEstadoLice()
    {
        $stmt = Conexion::conectar()->prepare("CALL Listar_EstadoLicencias()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlListaTipDoc()
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarTipoDoc()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlListaDatosEntidad($tipo)
    {
        $stmt = Conexion::conectar()->prepare("CALL Listar_Datos_Entidades(:tipo)");
        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlAnularLicencia($idLicencia,$nDias,$idUsuario)
    {
        $stmt = Conexion::conectar()->prepare("CALL Anular_Licencia(:idLicencia,:nDias,:idUsuario,@val)");
        $stmt->bindParam(":idLicencia", $idLicencia, PDO::PARAM_INT);
        $stmt->bindParam(":nDias", $nDias, PDO::PARAM_INT);
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
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
}
