<?php
class ImprimirKardexEmpleado
{
    public function imprimirFichaEC()
    {
        require_once "../util/tcpdf/headKardex.php";
        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 003');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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

        $pdf->SetFont('helvetica', '', 10);

        $ESNombre = substr('0524-ESPECIALISTA EN SISTEMAS DE INFORMACION', 0, 30);
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
                    background-color: white;"><p style="text-align: left;">77478995</p></td>
                    <td style="width:400px;background-color:white;
                    background-color: white;"><p style="text-align: left;">AGUILAR ACOSTA VDA DE RETAMOSO JUANA LIDIA</p></td>
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
                    background-color: white;"><p style="text-align: left;">$ESNombre</p></td>
                    <td style="width:290px;background-color:white;
                    background-color: white;"><p style="text-align: left;">MINSA-LEGADO</p></td>
                    <td style="width:265;background-color:white;
                    background-color: white;"><p style="text-align: left;"></p></td>
                    <td style="width:120;background-color:white;
                    background-color: white;"><p style="text-align: right;">12900.00</p></td>
                </tr>
                <tr>
                    <td style="text-align:center; width:30px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><b>#</b></td>
                    <td style="text-align:center; width:45px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><b>N°</b></td>

                    <td style="text-align:center; width:55px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><b>Exp.Ant</b></td>
                    <td style="text-align: center; vertical-align: middle; width:80px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><b>F. Ingreso</b></td>
                    <td style="text-align:center; width:70px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><b>Del</b></td>
                    <td style="text-align:center;vertical-align: middle; width:70px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><b>Al</b></td>
                    <td style="text-align:center; width:80px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    background-color: #E6E6E6;"><b>Mes</b></td>
                    <td style="text-align:center; width:80px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    background-color: #E6E6E6;"><b>Procedencia</b></td>   
                    <td style="text-align:center; width:130px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    background-color: #E6E6E6;"><b>Nombre del médico</b></td>
                    <td style="text-align:center; width:180px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    background-color: #E6E6E6;"><b>Diagnóstico</b></td>
                    <td style="text-align:center; width:100px;background-color:white;
                    border-top: 1px solid #000000;
                    border-bottom: 1px solid #000000;
                    border-left:   1px solid  #000000;
                    border-right:   1px solid  #000000;
                    background-color: #E6E6E6;"><b>Salud ocup. Covid-19</b></td>                     
                </tr>
                <tr>
                    <td style="text-align:center; width:30px;background-color:white;">#</td>
                    <td style="text-align:center; width:45px;background-color:white;">N°</td>

                    <td style="text-align:center; width:55px;background-color:white;">Exp.Ant</td>
                    <td style="text-align: center; vertical-align: middle; width:80px;background-color:white;">F. Ingreso</td>
                    <td style="text-align:center; width:70px;background-color:white;">Del</td>
                    <td style="text-align:center;vertical-align: middle; width:70px;background-color:white;">Al</td>
                    <td style="text-align:center; width:80px;background-color:white;">Mes</td>
                    <td style="text-align:center; width:80px;background-color:white;">Procedencia</td>   
                    <td style="text-align:center; width:130px;background-color:white;">Nombre del médico</td>
                    <td style="text-align:center; width:180px;background-color:white;">Diagnóstico</td>
                    <td style="text-align:center; width:100px;background-color:white;">DOC. OSORIO</td>                     
                </tr>
                </table>
        EOD;

        $pdf->writeHTML($tbl, false, false, false, false, '');
        // -----------------------------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('example_003.pdf', 'I');
    }
}
$fichaImprimir = new ImprimirKardexEmpleado();
$fichaImprimir->imprimirFichaEC();
