<?php
class ReportesControlador
{
    static public function ctrReporteControlPersonal()
    {
        if (isset($_GET["reporte"])) {
            if (isset($_GET["anio"]) && isset($_GET["mes"])) {
                $controlPer = ReportesModelo::mdlReporteControlPersonal($_GET["anio"], $_GET["mes"]);
                $Name = 'REPORTE_CONTROL-PERSONAL_DE_MES_N°' . $_GET["mes"] . '_AÑO_N°_' . $_GET["anio"] . '.xls';
            }
            // Creación de archivo excel
            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $Name . '"');
            header("Content-Transfer-Encoding: binary");
            echo utf8_decode("<table border='0'> 
					<tr> 
					<td style='font-weight:bold; background-color:#ddd;'>N°</td>
                    <td style='font-weight:bold; background-color:#ddd;'>Correlativo</td> 
                    <td style='font-weight:bold; background-color:#ddd;'>Exp. Anterior</td>  
                    <td style='font-weight:bold; background-color:#ddd;'>DNI</td>
					<td style='font-weight:bold; background-color:#ddd;'>Empleado</td>
					<td style='font-weight:bold; background-color:#ddd;'>Condición</td>
					<td style='font-weight:bold; background-color:#ddd;'>Cargo</td>
                    <td style='font-weight:bold; background-color:#ddd;'>Procedencia</td>
					<td style='font-weight:bold; background-color:#ddd;'>Desde</td>
					<td style='font-weight:bold; background-color:#ddd;'>Hasta</td>
					<td style='font-weight:bold; background-color:#ddd;'>N° Dias</td>		
                    </tr>");
            foreach ($controlPer as $row => $item) {
                echo utf8_decode("<tr>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . ($row + 1) . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["correlativoLic"] . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["expAnterior"] . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'> N° " . $item["dniEmp"] . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["nombresEmpleado"] . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["descCondicion"] . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["descCargo"] . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["descTipoEnt"] . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["fechaInicio"] . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["fechaFin"] . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["NDias"] . "</td>
                </tr>");
            }
            echo "</table>";
        }
    }

    static public function ctrReporteAuditoriaSO()
    {
        if (isset($_GET["reporte"])) {

            $controlPer = ReportesModelo::mdlReporteAuditoriaSOAnu();
            $Name = 'REPORTE_AUDITORIA-SALUD-OCUPACIONAL.xls';

            // Creación de archivo excel
            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $Name . '"');
            header("Content-Transfer-Encoding: binary");
            echo utf8_decode("<table border='0'> 
					<tr> 
					<td style='font-weight:bold; background-color:#ddd;'>N°</td>
                    <td style='font-weight:bold; background-color:#ddd;'>Correlativo SO</td> 
                    <td style='font-weight:bold; background-color:#ddd;'>DNI</td>
					<td style='font-weight:bold; background-color:#ddd;'>Empleado</td>
					<td style='font-weight:bold; background-color:#ddd;'>Usuario</td>	
                    </tr>");
            foreach ($controlPer as $row => $item) {
                echo utf8_decode("<tr>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . ($row + 1) . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["correAis"] . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["dni"] . "</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["empleado"] ."</td>
                <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["cuenta"] . "</td>
                </tr>");
            }
            echo "</table>";
        }
    }
    static public function ctrDatosPersonalKardex($idEmpleado)
    {
        $rptListDatos = ReportesModelo::mdlKardexDatosPersonal($idEmpleado);
        return $rptListDatos;
    }
    static public function ctrDatosPersonalKardexDiasDisp($idEmpleado, $anio)
    {
        $rptListDatosSol = ReportesModelo::mdlKardexDatosPersonalDiasAcum_Disp($idEmpleado, $anio);
        return $rptListDatosSol;
    }
    static public function ctrDatosPersonalKardexSolicitudes($idEmpleado, $anio)
    {
        $rptListDatosSol = ReportesModelo::mdlKardexDatosLicencias($idEmpleado, $anio);
        return $rptListDatosSol;
    }
    static public function ctrDatosMes($idMes)
    {
        $rptListDatosmes = ReportesModelo::mdlDatosMes($idMes);
        return $rptListDatosmes;
    }

    static public function ctrControlPersonal($mes, $anio)
    {
        $rptListDatosSol = ReportesModelo::mdlControlLicencias($mes, $anio);
        return $rptListDatosSol;
    }

    static public function ctrControlPersonalMinsa($mes, $anio)
    {
        $rptListDatosSol = ReportesModelo::mdlControlLicenciasMinsa($mes, $anio);
        return $rptListDatosSol;
    }


    static public function ctrLicenciasPendientes($mes, $anio)
    {
        $rptListDatosSol = ReportesModelo::mdlLicenciasPendientes($mes, $anio);
        return $rptListDatosSol;
    }

    static public function ctrControlMaternidad($anio)
    {
        $rptListDatosMat = ReportesModelo::mdlControlMaternidad($anio);
        return $rptListDatosMat;
    }

    static public function ctrControlRanking($anio)
    {
        $rptListDatosMat = ReportesModelo::mdlControlRanking($anio);
        return $rptListDatosMat;
    }

    static public function ctrControlPersonalSubsidioMas20($mes, $anio)
    {
        $rptListDatosSol = ReportesModelo::mdlControlLicenciasSubMas20($mes, $anio);
        return $rptListDatosSol;
    }

    static public function ctrControlPersonalSubsidioMas20Anual($anio)
    {
        $rptListDatosSol = ReportesModelo::mdlControlLicenciasSubMas20Anual($anio);
        return $rptListDatosSol;
    }
    static public function ctrSubsidioMas20AcumDif($mes, $anio, $empleado)
    {
        $rptListDatosSol = ReportesModelo::mdlSubsidioMas20AcumDif($mes, $anio, $empleado);
        return $rptListDatosSol;
    }
    static public function ctrListarWidgets($anio)
    {
        $repuesta = ReportesModelo::mdlListarWidgets($anio);
        return $repuesta;
    }
    static public function ctrListarLicenciasMensual($anio)
    {
        $repuesta = ReportesModelo::mdlListarLicxMes($anio);
        return $repuesta;
    }

    static public function ctrListarProcedenciaLicencias($anio)
    {
        $repuesta = ReportesModelo::mdlListarLicxProcedencia($anio);
        return $repuesta;
    }

    static public function ctrListarLicenciasxPersonal($anio, $empleado)
    {
        $repuesta = ReportesModelo::mdlListarLicxPersonal($anio, $empleado);
        return $repuesta;
    }

    static public function ctrListarLicenciasxPersonalxProc($anio, $empleado)
    {
        $repuesta = ReportesModelo::mdlListarLicxPersonalxPro($anio, $empleado);
        return $repuesta;
    }

    static public function ctrListarNombreAnio($anio)
    {
        $repuesta = ReportesModelo::mdlListarNombreAnio($anio);
        return $repuesta;
    }
}
