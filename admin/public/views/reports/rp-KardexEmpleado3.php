<?php
require_once "../../../app/controller/ReportesControlador.php";
require_once "../../../app/model/ReportesModelo.php";

error_reporting(0);

class ImprimirKardexEmpleado
{
    public $idEmpleado;
    public $anio;
    public function imprimirFichaEC()
    {
        require_once "../util/tcpdf/headKardex.php";
        $idEmpleado = $this->idEmpleado;
        $anio = $this->anio;
        // create new PDF document

        $fichIntEC = ReportesControlador::ctrDatosPersonalKardex($idEmpleado);
        $fichIntEC2 = ReportesControlador::ctrDatosPersonalKardexSolicitudes($idEmpleado, $anio);
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('OCP-HNSEB');
        $pdf->SetTitle('Kardex Empleado');
        $pdf->SetSubject('Listado de licencias');
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

        // set font
        $pdf->SetFont('helvetica', '', 9);

        // add a page
        $pdf->AddPage('L', 'A4');

        // -----------------------------------------------------------------------------
        $htmlhead = '<h1 style="text-align:center;">REPORTE DE LICENCIA POR ENFERMEDAD</h1>';
        $pdf->writeHTMLCell(0, 0, 10, 25, $htmlhead, 0, 1, 0, true, 'L', true);

        $pdf->SetFont('helvetica', '', 9);

        $cargoEmp = substr($fichIntEC["empleadoCar"], 0, 30);
        $tbl = <<<EOD
        <table cellpadding="0" cellspacing="1"  style="text-align:center;">
                <tr>
                    <td style="text-align:center; width:810px;background-color:white;"></td>
                    <td style="text-align:left; width:50px;background-color:white;"><p style="text-align: left;"><b>Fecha :</b></p></td>
                    <td style="width:70px;background-color:white;"><p style="text-align: center;"><i>28/09/2021</i></p></td>
                </tr>
                </table>

                <table cellpadding="2" cellspacing="1.2" style="text-align:left;" border="">
                <tr>
                    <td style="width:85px;background-color:white;
                    background-color: white;"><p style="text-align: left;"><b>DNI</b></p></td>
                    <td style="width:300px;background-color:white;
                    background-color: white;"><p style="text-align: left;"><b>Apellidos y Nombres</b></p></td>
                </tr>
                <tr>
                    <td style="width:85px;background-color:white;
                    background-color: white;"><p style="text-align: left;">$fichIntEC[dniEmp]</p></td>
                    <td style="width:700px;background-color:white;
                    background-color: white;"><p style="text-align: left;">$fichIntEC[empleadoNA]</p></td>
                </tr>
                <tr>
                    <td style="width:250px;background-color:white;
                    background-color: white;"><p style="text-align: left;"><b>Cargo</b></p></td>
                    <td style="width:290px;background-color:white;
                    background-color: white;"><p style="text-align: left;"><b>Condición</b></p></td>
                    <td style="width:265;background-color:white;
                    background-color: white;"><p style="text-align: left;"><b>Intereses</b></p></td>
                    <td style="width:120;background-color:white;
                    background-color: white;"><p style="text-align: left;"><b>Total remuneración</b></p></td>
                </tr>
                <tr>
                    <td style="width:250px;background-color:white;
                    background-color: white;"><p style="text-align: left;">$cargoEmp</p></td>
                    <td style="width:290px;background-color:white;
                    background-color: white;"><p style="text-align: left;">$fichIntEC[descCondicion]</p></td>
                    <td style="width:265;background-color:white;
                    background-color: white;"><p style="text-align: left;"></p></td>
                    <td style="width:120;background-color:white;
                    background-color: white;"><p style="text-align: center;">$fichIntEC[sueldoEmp]</p></td>
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
                    <td style="text-align:center; width:50px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>N°</b></td>

                    <td style="text-align:center; width:55px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Exp.Ant</b></td>
                    <td style="text-align: center; vertical-align: middle; width:80px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>F. Ingreso</b></td>
                    <td style="text-align:center; width:70px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Desde</b></td>
                    <td style="text-align:center;vertical-align: middle; width:70px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Al</b></td>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>N° Dias</b></td>
                    <td style="text-align:center; width:80px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Mes</b></td>
                    <td style="text-align:center; width:80px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Procedencia</b></td>   
                    <td style="text-align:center; width:130px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Nombre del médico</b></td>
                    <td style="text-align:center; width:180px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Diagnóstico</b></td>
                    <td style="text-align:center; width:100px;background-color:white;
                    border-bottom: 1px solid #000000;
                    border-top: 1px solid #000000;"><b>Salud ocup. Covid-19</b></td>                     
                </tr>
                </table>
        EOD;

        $pdf->writeHTML($tbl, false, false, false, false, '');
        /**  Lontitudes de textos 
         * N° => a partir del 4 en adelante 6
         * exp => 6
         * Procedencia => 9
         * Medico => 15
         * Diagnóstico => 22
         * salud ocu => 11
         */
        // Inicia detalle de licencias
        foreach ($fichIntEC2 as $key => $item) {
            $idem = $key + 1;
            $corre = substr($item["correlativoLic"], 9, 6);
            $procede = substr($item["descTipoEnt"], 0, 9);
            $medico = substr($item["nombresMed"], 0, 15);
            $dx = substr($item["descDiagnostico"], 0, 22);
            if ($item["nroDoc"] != "NULL") {
                $so = substr($item["nroDoc"], 0, 11);
            } else {
                $so = "";
            }


            $tbl = <<<EOD
            <table cellpadding="2" cellspacing="1.2" style="text-align:left;" border="">
            <tr>
                <td style="text-align:center; width:30px;background-color:white;
                border-bottom: 1px solid #505050;">$idem</td>
                <td style="text-align:center; width:50px;background-color:white;
                border-bottom: 1px solid #505050;">$corre</td>

                <td style="text-align:center; width:55px;background-color:white;
                border-bottom: 1px solid #505050;">$item[expAnterior]</td>
                <td style="text-align: center; vertical-align: middle; width:80px;background-color:white;
                border-bottom: 1px solid #505050;">$item[fechaIngreso]</td>
                <td style="text-align:center; width:70px;background-color:white;
                border-bottom: 1px solid #505050;">$item[fechaInicio]</td>
                <td style="text-align:center;vertical-align: middle; width:70px;background-color:white;
                border-bottom: 1px solid #505050;">$item[fechaFin]</td>
                <td style="text-align:center; width:30px;background-color:white;
                border-bottom: 1px solid #505050;">$item[NDias]</td>
                <td style="text-align:center; width:80px;background-color:white;
                border-bottom: 1px solid #505050;">$item[descMes]</td>
                <td style="text-align:center; width:80px;background-color:white;
                border-bottom: 1px solid #505050;">$procede</td>   
                <td style="text-align:left; width:130px;background-color:white;
                border-bottom: 1px solid #505050;">$medico</td>
                <td style="text-align:left; width:180px;background-color:white;
                border-bottom: 1px solid #505050;">$dx</td>
                <td style="text-align:left; width:100px;background-color:white;
                border-bottom: 1px solid #505050;">$so</td>                     
            </tr>
            </table>
    EOD;

            $pdf->writeHTML($tbl, false, false, false, false, '');
        }
        $html =
            <<<EOF
                <table cellpadding="2" cellspacing="1.2" class="block-1" style="text-align:center;">
                <tr>
                    <td style="text-align:center; width:698px;background-color:white;"></td>
                    <td style="width:90px;background-color:white;"><p style="text-align: left;"><b>TOTAL DÍAS: </b></p></td>
                    <td style="width:40px;background-color:white;"><p style="text-align: right;">$fichIntEC[diasAcumulados]</p></td>
                    <td style="width:95px;background-color:white;"><p style="text-align: left;"><b>DISPONIBLES: </b></p></td>
                    <td style="width:40px;background-color:white;"><p style="text-align: right;">$fichIntEC[disponibles]</p></td>
                </tr>
                </table>
            EOF;
        $pdf->writeHTML($html, false, false, false, false, '');
        // -----------------------------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('KardexEmpleado.pdf', 'I');
    }
}
$fichaImprimir = new ImprimirKardexEmpleado();
$fichaImprimir->idEmpleado = $_GET["idEmpleado"];
$fichaImprimir->anio = $_GET["anio"];
$fichaImprimir->imprimirFichaEC();
