<?php
class ReportesControlador
{
    static public function ctrReporteReferencias()
    {
        if (isset($_GET["reporte"])) {
            if (isset($_GET["anio"]) && isset($_GET["mes"])) {
                $controlPer = ReportesModelo::mdlReporteControlReferencias($_GET["anio"], $_GET["mes"], $_GET["dni"]);
                $Name = 'REPORTE_CONTROL-REFERENCIAS DE MES N°' . $_GET["mes"] . '_AÑO_N°_' . $_GET["anio"] . '.xls';
            }

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
                    <td style='font-weight:bold; background-color:#ddd;'>Fecha Referencia</td> 
					<td style='font-weight:bold; background-color:#ddd;'>Estado</td>
                    <td style='font-weight:bold; background-color:#ddd;'>N° Referencia</td> 
                    <td style='font-weight:bold; background-color:#ddd;'>Doc</td>  
                    <td style='font-weight:bold; background-color:#ddd;'>Paciente</td>
					<td style='font-weight:bold; background-color:#ddd;'>Establecimiento Origen</td>
					<td style='font-weight:bold; background-color:#ddd;'>Especialidad|Servicio</td>
                    <td style='font-weight:bold; background-color:#ddd;'>Anamnesis</td>
					<td style='font-weight:bold; background-color:#ddd;'>Motivo Rechazo u Obs.</td>
					<td style='font-weight:bold; background-color:#ddd;'>Usuario Creador</td>
					<td style='font-weight:bold; background-color:#ddd;'>F.Creacion</td>
                    <td style='font-weight:bold; background-color:#ddd;'>Usuario Modif</td>
					<td style='font-weight:bold; background-color:#ddd;'>F.Modif</td>			
                    </tr>");
            foreach ($controlPer as $row => $item) {
                echo utf8_decode("<tr>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . ($row + 1) . "</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["fechaReferencia"] . "</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["descEstado"] . "</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["nroHojaRef"] . "</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["nombreTipDoc"] . " - ".$item["nroDoc"]."</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["paciente"] . "</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["codigoEstab"] . " - ".$item["nombreEstablecimiento"]."</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["nombreEsp"] . " - ".$item["nombServicio"]."</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["anamnesis"] . "</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["motivo"] . "</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["loginCreador"] . "</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["fechaCreacion"] . "</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["loginMod"] . "</td>
                        <td style='padding:0.5em; border:1px solid #ccc;'>" . $item["fechaModificacion"] . "</td>
                        </tr>");
            }
            echo "</table>";
        }
    }
}
