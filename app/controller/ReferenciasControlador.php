<?php
class ReferenciasControlador
{
    static public function ctrListarReferenciasW($item, $valor)
    {
        $rptListRef = ReferenciasModelo::mdlListarReferenciasW($item, $valor);
        return $rptListRef;
    }
    static public function ctrListarReferenciasWeb($dni,$anio){
        $rptBusquedaRef = ReferenciasModelo::mdlBuscarReferencias($dni,$anio);
        return $rptBusquedaRef;
    }

    static public function ctrListarReferenciasWebSIGH($dni,$anio){
        $rptBusquedaRef = ReferenciasModelo::mdlBuscarReferenciasSIGH($dni,$anio);
        return $rptBusquedaRef;
    }
}
