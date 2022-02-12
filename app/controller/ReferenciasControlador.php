<?php
class ReferenciasControlador
{
    static public function ctrListarReferencias($item, $valor)
    {
        $rptListRef = ReferenciasModelo::mdlListarReferencias($item, $valor);
        return $rptListRef;
    }

    static public function ctrListarTiposDocumentos()
    {
        $rptLisTipDoc = ReferenciasModelo::mdlListarTiposDocumentos();
        return $rptLisTipDoc;
    }

    static public function ctrListarTiposSexo()
    {
        $rptLisTipSex = ReferenciasModelo::mdlListarTipoSexo();
        return $rptLisTipSex;
    }

    static public function ctrListarEstadoRef()
    {
        $rptLisEstaRef = ReferenciasModelo::mdlListarEstadoRef();
        return $rptLisEstaRef;
    }

    static public function ctrListarReferenciasWeb($dni,$anio){
        
    }
}
