<?php
require_once "../../../app/controller/LicenciasControlador.php";
require_once "../../../app/model/LicenciasModelo.php";

class ajaxUtilitarios
{
    public $activ1;
    public function listarAños()
    {
        $existeb = $this->activ1;
        $añosLista = [
            // ['idAnio' => 2020, 'descAnio' => '2020'],
            ['idAnio' => 2021, 'descAnio' => '2021']
        ];

        $html = "<option value='0'>Seleccione</option>";
        foreach ($añosLista as $key => $value) {
            $html .= "<option value='$value[idAnio]'>$value[descAnio]</option>";
        }
        echo $html;
    }
    public $activ2;
    public function listarMeses()
    {
        $existeb = $this->activ2;
        $mesesLista = [
            ['idMes' => 1, 'descMes' => 'ENERO'],
            ['idMes' => 2, 'descMes' => 'FEBRERO'],
            ['idMes' => 3, 'descMes' => 'MARZO'],
            ['idMes' => 4, 'descMes' => 'ABRIL'],
            ['idMes' => 5, 'descMes' => 'MAYO'],
            ['idMes' => 6, 'descMes' => 'JUNIO'],
            ['idMes' => 7, 'descMes' => 'JULIO'],
            ['idMes' => 8, 'descMes' => 'AGOSTO'],
            ['idMes' => 9, 'descMes' => 'SETIEMBRE'],
            ['idMes' => 10, 'descMes' => 'OCTUBRE'],
            ['idMes' => 11, 'descMes' => 'NOVIEMBRE'],
            ['idMes' => 12, 'descMes' => 'DICIEMBRE']
        ];

        $html = "<option value='0'>SIN MES</option>";
        foreach ($mesesLista as $key => $value) {
            $html .= "<option value='$value[idMes]'>$value[descMes]</option>";
        }
        echo $html;
    }
}

if (isset($_POST["activ1"])) {
    $listar1 = new ajaxUtilitarios();
    $listar1->activ1 = $_POST["activ1"];
    $listar1->listarAños();
}
if (isset($_POST["activ2"])) {
    $listar2 = new ajaxUtilitarios();
    $listar2->activ2 = $_POST["activ2"];
    $listar2->listarMeses();
}
