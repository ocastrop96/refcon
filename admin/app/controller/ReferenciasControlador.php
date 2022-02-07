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

    static public function ctrRegistrarReferencia()
    {
        if (isset($_POST["rgTipoDoc"])) {

            if (preg_match('/^[0-9]+$/', $_POST["rgTipoDoc"])) {
                date_default_timezone_set('America/Lima');
                $FechaRegistro = date("Y-m-d H:i:s");

                $fRef1 = $_POST["rgFechaRef"];
                $datefRef1 = str_replace('/', '-', $fRef1);
                $fechaReferencia = date('Y-m-d', strtotime($datefRef1));

                $datos = array(
                    "idEstado" => $_POST["rgRefEstado"],
                    "idServicio" => $_POST["regRefServ"],
                    "idEstablecimiento" => $_POST["regRefEstable"],
                    "idTipoDoc" => $_POST["rgTipoDoc"],
                    "idSexo" => $_POST["rgSexo"],
                    "usuarioCrea" => $_POST["userRegistra"],
                    "fechaReferencia" => $fechaReferencia,
                    "fechaCreacion" => $FechaRegistro,
                    "nroDoc" => $_POST["rgNdoc"],
                    "nroHojaRef" => $_POST["rgNroRef"],
                    "apePaterno" => $_POST["rgRefAP"],
                    "apeMaterno" => $_POST["rgRefAM"],
                    "nombres" => $_POST["rgNombresPac"],
                    "motivo" => $_POST["rgRefMotivo"]
                );

                $rptRegistroReferencia = ReferenciasModelo::mdlRegistrarReferencia($datos);
                if ($rptRegistroReferencia == "ok") {
                    echo '<script>
                    Swal.fire({
                    icon: "success",
                    title: "Se ha registrado la referencia con éxito",
                    showConfirmButton: false,
                    timer: 1800
                    });
                    function redirect(){
                        window.location = "referencias";
                    }
                    setTimeout(redirect,1800);
                </script>';
                } else {
                    echo '<script>
                    Swal.fire({
                    icon: "error",
                    title: "Ha ocurrido un error con el registro, verifique con los datos ingresados",
                    showConfirmButton: false,
                    timer: 1500
                    });
                    function redirect(){
                        window.location = "referencias";
                    }
                    setTimeout(redirect,1200);
                </script>';
                }
            } else {
                echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "¡Ingrese los datos correctamente!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            function redirect(){
                                window.location = "referencias";
                            }
                            setTimeout(redirect,1200);
                      </script>';
            }
        }
    }

    static public function ctrEditarReferencia()
    {
    }

    static public function ctrAnularReferencia()
    {
    }
}
