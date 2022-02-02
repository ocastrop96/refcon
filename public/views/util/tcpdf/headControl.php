<?php
require "tcpdf.php";
class MYPDF extends TCPDF
{
    //Page header
    public function Header()
    {
        $anio = date("Y");
        // // Logo HNSEB
        $image_file = K_PATH_IMAGES . 'logo-personal.png';
        $this->Image($image_file, 10, 8, 100, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Logo HNSEB
        $this->SetFont('helvetica', '', 6.5);
        $htmlhead = '<p style="text-align: center;">DECENIO DE LA IGUALDAD DE OPORTUNIDADES PARA MUJERES Y HOMBRES<br>"Año del Fortalecimiento de la Soberanía Nacional"<p>';
        $this->writeHTMLCell(0, 0, 200, 8, $htmlhead, 0, 1, 0, true, 'R', true);
    }
    // Page footer
    public function Footer()
    {
        date_default_timezone_set('America/Lima');
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 6.5);
        // Page number
        $this->Cell(0, 10, 'Generado: ' . date('d-m-Y h:i:s a', time()), 0, false, 'L', 0, '', 0, false, 'T', 'M');

        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 6.5);
        // Page number
        $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
