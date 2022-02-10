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

    static public function ctrValidarNroReferenciaxDni($dni, $nro)
    {
        $rptListValidaRef = ReferenciasModelo::mdlValidarNroReferenciaxDni($dni, $nro);
        return $rptListValidaRef;
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

                $anioReferencia = date('Y', strtotime($datefRef1));


                $datos = array(
                    "idEstado" => $_POST["rgRefEstado"],
                    "idServicio" => $_POST["regRefServ"],
                    "idEstablecimiento" => $_POST["regRefEstable"],
                    "idTipoDoc" => $_POST["rgTipoDoc"],
                    "idSexo" => $_POST["rgSexo"],
                    "usuarioCrea" => $_POST["userRegistra"],
                    "fechaReferencia" => $fechaReferencia,
                    "fechaCreacion" => $FechaRegistro,
                    "anioReferencia" => $anioReferencia,
                    "nroDoc" => $_POST["rgNdoc"],
                    "nroHojaRef" => $_POST["rgNroRef"],
                    "apePaterno" => $_POST["rgRefAP"],
                    "apeMaterno" => $_POST["rgRefAM"],
                    "nombres" => $_POST["rgNombresPac"],
                    "anamnesis" => $_POST["rgRefAnamnesis"],
                    "motivo" => $_POST["rgRefMotivo"]
                );

                $rptRegistroReferencia = ReferenciasModelo::mdlRegistrarReferencia($datos);
                if ($rptRegistroReferencia == "ok") {
                    echo '<script>
                    Swal.fire({
                    icon: "success",
                    title: "Se ha registrado la referencia con éxito",
                    showConfirmButton: false,
                    timer: 1500
                    });
                    function redirect(){
                        window.location = "referencias";
                    }
                    setTimeout(redirect,1500);
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
        if (isset($_POST["edtTipoDoc"])) {

            if (preg_match('/^[0-9]+$/', $_POST["edtTipoDoc"])) {
                date_default_timezone_set('America/Lima');
                $FechaModificacion = date("Y-m-d H:i:s");

                $fRef1 = $_POST["edtFechaRef"];
                $datefRef1 = str_replace('/', '-', $fRef1);
                $fechaReferencia = date('Y-m-d', strtotime($datefRef1));

                $anioReferencia = date('Y', strtotime($datefRef1));

                $datos = array(
                    "idReferencia" => $_POST["idReferencia"],
                    "idEstado" => $_POST["edtRefEstado"],
                    "idServicio" => $_POST["edtRefServ"],
                    "idEstablecimiento" => $_POST["edtRefEstable"],
                    "idTipoDoc" => $_POST["edtTipoDoc"],
                    "idSexo" => $_POST["edtSexo"],
                    "usuarioModif" => $_POST["userEdita"],
                    "fechaReferencia" => $fechaReferencia,
                    "fechaModificacion" => $FechaModificacion,
                    "anioReferencia" => $anioReferencia,
                    "nroDoc" => $_POST["edtNdoc"],
                    "nroHojaRef" => $_POST["edtNroRef"],
                    "apePaterno" => $_POST["edtRefAP"],
                    "apeMaterno" => $_POST["edtRefAM"],
                    "nombres" => $_POST["edtNombresPac"],
                    "anamnesis" => $_POST["edtRefAnamnesis"],
                    "motivo" => $_POST["edtRefMotivo"]
                );

                $rptEditarReferencia = ReferenciasModelo::mdlEditarReferencia($datos);
                if ($rptEditarReferencia == "ok") {
                    echo '<script>
                    Swal.fire({
                    icon: "success",
                    title: "Se ha modificado la referencia con éxito",
                    showConfirmButton: false,
                    timer: 1500
                    });
                    function redirect(){
                        window.location = "referencias";
                    }
                    setTimeout(redirect,1500);
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

    static public function ctrAnularReferencia()
    {
        if (isset($_GET["idReferencia"])) {
            date_default_timezone_set('America/Lima');
            $FechaAnulacion = date("Y-m-d H:i:s");
            $datos = array(
                "idReferencia" => $_GET["idReferencia"],
                "usuarioAnula" => $_GET["idUsuario"],
                "fechaAnulacion" => $FechaAnulacion
            );
            $rptAnulaReferencia = ReferenciasModelo::mdlAnularReferencia($datos);
            if ($rptAnulaReferencia != "error") {
                echo '<script>
                Swal.fire({
                  icon: "error",
                  title: "¡La referencia seleccionada no está Pendiente. No se anuló!",
                  showConfirmButton: true,
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false
                }).then((result)=>{
                  if(result.value){
                      window.location = "referencias";
                  }});
            </script>';
            }
            else{
                echo '<script>
                Swal.fire({
                  icon: "success",
                  title: "Se anuló con éxito la referencia seleccionada",
                  showConfirmButton: true,
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false
                }).then((result)=>{
                  if(result.value){
                      window.location = "referencias";
                  }});
            </script>';

            }

        }
    }
}
