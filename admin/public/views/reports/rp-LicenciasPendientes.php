<?php
require_once "../../../app/controller/ReportesControlador.php";
require_once "../../../app/model/ReportesModelo.php";

error_reporting(0);

class ImprimirConsolidadoControlMaternidad
{
    public $anio;
    public $mes;
    public function imprimirFichaConsolidadoMat()
    {
        require_once "../util/tcpdf/headControl.php";
        $mes = $this->mes;
        $anio = $this->anio;
        // create new PDF document
        $detalleLicenciasMat = ReportesControlador::ctrLicenciasPendientes($mes, $anio);
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('OCP-HNSEB');
        $pdf->SetTitle('Consolidado Licencias Pendientes ' . '- ' . $anio);
        $pdf->SetSubject('Listado de licencias Pendientes');
        $pdf->SetKeywords('mrms,licencia, descanso, formato, hnseb');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------
        $pdf->SetFont('helvetica', '', 7);
        $pdf->AddPage('L', 'A4');
        // -----------------------------------------------------------------------------
        $htmlhead = '<h1 style="text-align:center;">RELACION DE LICENCIAS PENDIENTES DEL AÑO - ' . $anio . ' <br>DE LA COORDINACION DEL EQUIPO DE GESTION DEL DESARROLLO Y RH</h1>';
        $pdf->writeHTMLCell(0, 0, 10, 25, $htmlhead, 0, 1, 0, true, 'L', true);

        $pdf->SetFont('helvetica', '', 7);

        $fechaActu = date('d/m/Y');
        $tbl = <<<EOD
        <table cellpadding="0" cellspacing="1"  style="text-align:center;">
                <tr>
                    <td style="text-align:center; width:810px;background-color:white;"></td>
                    <td style="text-align:left; width:50px;background-color:white;"><p style="text-align: left;"><b>Fecha :</b></p></td>
                    <td style="width:70px;background-color:white;"><p style="text-align: center;"><i>$fechaActu</i></p></td>
                </tr>
                </table>
        EOD;

        $pdf->writeHTML($tbl, false, false, false, false, '');
        $tbl = <<<EOD
                <table cellpadding="2" cellspacing="1.2" style="text-align:left;" border="">
                <tr>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>#</b></td>
                    <td style="text-align:center; width:45px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>N°</b></td>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Exp.Ant</b></td>
                    <td style="text-align: center; vertical-align: middle; width:80px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>DNI</b></td>
                    <td style="text-align:left; width:250px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Apellidos y Nombres</b></td>
                    <td style="text-align:center; width:100px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Condición</b></td>
                    <td style="text-align:center; width:65px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Desde</b></td>   
                    <td style="text-align:center; width:65px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Hasta</b></td>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Dias</b></td>
                    <td style="text-align:center;vertical-align: middle; width:225px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Observaciones</b></td>                   
                </tr>
                </table>
        EOD;

        $pdf->writeHTML($tbl, false, false, false, false, '');

        // Inicia detalle de licencias
        foreach ($detalleLicenciasMat as $key => $item) {
            $idem = $key + 1;
            $corre = substr($item["correlativoLic"], 9, 6);
            $empleadoN = substr($item["empleadoNA"], 0, 40);
            // $cargoEmp = substr($item["empleadoCar"], 0, 19);
            $tbl = <<<EOD
                <table cellpadding="2" cellspacing="1.2" style="text-align:left;" border="">
                <tr>
                    <td style="text-align:center; width:30px;background-color:white;border-bottom: 1px solid #505050;">$idem</td>
                    <td style="text-align:center; width:45px;background-color:white;border-bottom: 1px solid #505050;">$corre</td>
                    <td style="text-align:center; width:30px;background-color:white;border-bottom: 1px solid #505050;">$item[expAnterior]</td>
                    <td style="text-align: center; vertical-align: middle; width:80px;background-color:white;border-bottom: 1px solid #505050;">$item[dniEmp]</td>
                    <td style="text-align:left; width:250px;background-color:white;border-bottom: 1px solid #505050;"> $empleadoN</td>
                    <td style="text-align:center; width:100px;background-color:white;border-bottom: 1px solid #505050;">$item[descCondicion]</td>
                    <td style="text-align:center; width:65px;background-color:white;border-bottom: 1px solid #505050;">$item[fechaInicio]</td>   
                    <td style="text-align:center; width:65px;background-color:white;border-bottom: 1px solid #505050;">$item[fechaFin]</td>
                    <td style="text-align:center; width:30px;background-color:white;border-bottom: 1px solid #505050;">$item[NDias]</td>
                    <td style="text-align:left;vertical-align: middle; width:225px;background-color:white;border-bottom: 1px solid #505050;">$item[observaciones]</td>                   
                </tr>
            </table>
        EOD;

            $pdf->writeHTML($tbl, false, false, false, false, '');
        }
        $pdf->Output('Consolidado Licencias Pendientes_' . $anio . '.pdf', 'I');
    }
}
$fichaImprimir = new ImprimirConsolidadoControlMaternidad();
$fichaImprimir->anio = $_GET["anio"];
$fichaImprimir->mes = $_GET["mes"];
$fichaImprimir->imprimirFichaConsolidadoMat();
