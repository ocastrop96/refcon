<?php
class ReferenciasControlador
{
    static public function ctrListarReferencias($item, $valor)
    {
        $rptListRef = ReferenciasModelo::mdlListarReferencias($item, $valor);
        return $rptListRef;
    }
}