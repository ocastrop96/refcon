<?php
require_once "dbConnect.php";
class ReportesModelo
{
    static public function mdlReporteControlPersonal($anio, $mes)
    {
        $stmt = Conexion::conectar()->prepare("CALL Reporte_Control_Personal(:anio,:mes)");

        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlReporteAuditoriaSOAnu()
    {
        $stmt = Conexion::conectar()->prepare("CALL AuditoriaSOAnuladas()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlKardexDatosPersonal($idEmpleado)
    {
        $stmt = Conexion::conectar()->prepare("CALL Kardex_Empleado_Datos(:empleado)");
        $stmt->bindParam(":empleado", $idEmpleado, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlKardexDatosPersonalDiasAcum_Disp($idEmpleado,$anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarDiasAcumDispEmp(:empleado,:anio)");
        $stmt->bindParam(":empleado", $idEmpleado, PDO::PARAM_INT);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlKardexDatosLicencias($idEmpleado, $anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Kardex_Empleado_Licencias(:empleado,:anio)");
        $stmt->bindParam(":empleado", $idEmpleado, PDO::PARAM_INT);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlDatosMes($idMes)
    {
        $stmt = Conexion::conectar()->prepare("CALL Listar_Nomb_Mes(:mes)");
        $stmt->bindParam(":mes", $idMes, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlControlLicencias($mes, $anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Control_Personal_Licencias(:mes,:anio)");
        $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlControlLicenciasMinsa($mes, $anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Control_Personal_Licencias_LegaMinsaRes(:mes,:anio)");
        $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlLicenciasPendientes($mes, $anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Reporte_LicenciasPendientes(:mes,:anio)");
        $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }


    static public function mdlControlMaternidad($anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Control_Maternidad_Anual(:anio)");
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlControlRanking($anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Ranking_Detallado_Licencias(:anio)");
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlControlLicenciasSubMas20($mes, $anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Control_Personal_Licencias_Mas20(:mes,:anio)");
        $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlControlLicenciasSubMas20Anual($anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Control_Personal_Licencias_Mas20_Anual(:anio)");
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlSubsidioMas20AcumDif($mes, $anio, $empleado)
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarTotalDifEmpSub(:mes,:anio,:empleado)");
        $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->bindParam(":empleado", $empleado, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlListarWidgets($anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarWidgetsDash(:anio)");
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlListarLicxMes($anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL GRAFICO_LICENCIAS_MENSUAL(:anio)");
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarLicxProcedencia($anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Grafico_LicenciasxProcedencia(:anio)");
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarLicxPersonal($anio,$personal)
    {
        $stmt = Conexion::conectar()->prepare("CALL Grafico_LicenciasxPersonal(:anio,:personal)");
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->bindParam(":personal", $personal, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarLicxPersonalxPro($anio,$personal)
    {
        $stmt = Conexion::conectar()->prepare("CALL Grafico_LicenciasxPersonalxProcede(:anio,:personal)");
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->bindParam(":personal", $personal, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarNombreAnio($anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL ListarNombreAnio(:anio)");
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }
}
