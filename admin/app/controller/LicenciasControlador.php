<?php
class LicenciasControlador
{
    static public function ctrListarLicencias($item, $valor)
    {
        $rptListLic = LicenciasModelo::mdlListarLicencias($item, $valor);
        return $rptListLic;
    }
    static public function ctrListaTiposEntidad()
    {
        $rptLisTipEnt = LicenciasModelo::mdlListarTipoEntidad();
        return $rptLisTipEnt;
    }

    static public function ctrListaEstadoLice()
    {
        $rptEstLic = LicenciasModelo::mdlListarEstadoLice();
        return $rptEstLic;
    }
    static public function ctrListaTipDoc()
    {
        $rptTDocLic = LicenciasModelo::mdlListaTipDoc();
        return $rptTDocLic;
    }
    static public function ctrListaDatosEntidades($tipo)
    {
        $rptDatoEnt = LicenciasModelo::mdlListaDatosEntidad($tipo);
        return $rptDatoEnt;
    }
    static public function ctrTraerDatosDxs($dato)
    {
        $repuesta = LicenciasModelo::mdlTraerDxs($dato);
        return $repuesta;
    }
    static public function ctrListarDx($idDx)
    {
        $repuesta = LicenciasModelo::mdlListarDx($idDx);
        return $repuesta;
    }

    static public function ctrListarMeses()
    {
        $repuesta = LicenciasModelo::mdlListarMeses();
        return $repuesta;
    }
    static public function ctrRegistrarLicencia()
    {
        if (isset($_POST["rgEmp"]) && isset($_POST["rgfIngreso"]) && isset($_POST["rgfDesde"]) && isset($_POST["rgfDesde"]) && isset($_POST["rgfHasta"]) && isset($_POST["rgEstado"])) {
            if (preg_match('/^[0-9]+$/', $_POST["rgEmp"])) {
                date_default_timezone_set('America/Lima');
                $fechaRegistro = date("Y-m-d");
                // Conversion de fechas
                $fIngreso1 = $_POST["rgfIngreso"];
                $datefIngreso1 = str_replace('/', '-', $fIngreso1);
                $fechaIngreso = date('Y-m-d', strtotime($datefIngreso1));

                $fInicio1 = $_POST["rgfDesde"];
                $datefInicio1 = str_replace('/', '-', $fInicio1);
                $fechaInicio = date('Y-m-d', strtotime($datefInicio1));

                $fFin1 = $_POST["rgfHasta"];
                $datefFin1 = str_replace('/', '-', $fFin1);
                $fechaFin = date('Y-m-d', strtotime($datefFin1));

                if ($_POST["rgFDoc"] != "") {
                    $fDoc1 = $_POST["rgFDoc"];
                    $datefDoc1 = str_replace('/', '-', $fDoc1);
                    $fechaDoc = date('Y-m-d', strtotime($datefDoc1));
                } else {
                    $fechaDoc = null;
                }
                // Envío de datos
                $datos = array(
                    "anioMedico" => $_POST["rgAMedico"],
                    "mesMedico" => $_POST["rgMMedico"],
                    "fechaRegistro" => $fechaRegistro,
                    "estadoLic" => $_POST["rgEstado"],
                    "empleado" => $_POST["rgEmp"],
                    "fechaIngreso" => $fechaIngreso,
                    "fechaInicio" => $fechaInicio,
                    "fechaFin" => $fechaFin,
                    "NDias" => $_POST["rgNDias"],
                    "entidad" => $_POST["rgTipEnt"],
                    "rucEntidad" => $_POST["rgNRuc"],
                    "nombEntidad" => $_POST["rgNomEnt"],
                    "cipMed" => $_POST["rgCMP"],
                    "nombresMed" => $_POST["rgNomMed"],
                    "citt" => $_POST["rgCITT"],
                    "servicionAte" => $_POST["rgServ"],
                    "diagnostico" => $_POST["rgCieDX"],
                    "descDiagnostico" => $_POST["rgDesDX"],
                    "tipDoc" => $_POST["rgTipDoc"],
                    "fechaDoc" => $fechaDoc,
                    "nroDoc" => $_POST["rgNDoc"],
                    "descripDoc" => $_POST["rgDescip"],
                    "observaciones" => $_POST["rgObserva"],
                    "autogenerado" => $_POST["autoCode"],
                    "userReg" => $_POST["idUsuario"]
                );
                $rptRegistroLicencia = LicenciasModelo::mdlRegistrarLicencia($datos);
                if ($rptRegistroLicencia == "ok") {
                    // Envío de datos a procedimiento retorna
                    $repuestaRetorna = LicenciasModelo::mdlRetornaCorrelativo($_POST["rgEmp"], $_POST["autoCode"],$_POST["rgAMedico"]);
                    if ($repuestaRetorna != "error") {
                        if ($repuestaRetorna != null) {
                            echo '<script>
                                    Swal.fire({
                                    icon: "success",
                                    title: "' . $repuestaRetorna . '",
                                    showConfirmButton: true,
                                    confirmButtonText: "Aceptar",
                                    closeOnConfirm: false
                                    }).then((result)=>{
                                    if(result.value){
                                        window.location = "licencias";
                                    }});
                                </script>';
                        } else {
                      echo '<script>
                                    Swal.fire({
                                    icon: "success",
                                    title: "Se ha registrado con éxito.! NOTA: No seleccionó MES MEDICO. El empleado no tiene días acumulados. Dispone de 20 días disponibles de licencia.!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Aceptar",
                                    closeOnConfirm: false
                                    }).then((result)=>{
                                    if(result.value){
                                        window.location = "licencias";
                                    }});
                                </script>';
                        }
                    } else {
                        echo '<script>
                        Swal.fire({
                        icon: "error",
                        title: "Ha ocurrido un error con el registro, verifique con los datos del empleado solicitud alguna",
                        showConfirmButton: false,
                        timer: 1500
                        });
                        function redirect(){
                            window.location = "licencias";
                        }
                        setTimeout(redirect,1200);
                    </script>';
                    }
                    // Envío de datos a procedimiento retorna
                } else {
                    echo '<script>
                        Swal.fire({
                        icon: "error",
                        title: "Hubo un error al registrar. Intente nuevamente",
                        showConfirmButton: false,
                        timer: 1500
                        });
                        function redirect(){
                            window.location = "licencias";
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
                                window.location = "licencias";
                            }
                            setTimeout(redirect,1200);
                      </script>';
            }
        }
    }

    static public function ctrEditarLicencia()
    {
        if (isset($_POST["idEmpleado"]) && isset($_POST["edtfIngreso"]) && isset($_POST["edtfDesde"]) && isset($_POST["edtfHasta"]) && isset($_POST["edtEstado"])) {
            if (preg_match('/^[0-9]+$/', $_POST["idEmpleado"])) {
                // Conversion de fechas
                $fIngreso1 = $_POST["edtfIngreso"];
                $datefIngreso1 = str_replace('/', '-', $fIngreso1);
                $fechaIngreso = date('Y-m-d', strtotime($datefIngreso1));

                $fInicio1 = $_POST["edtfDesde"];
                $datefInicio1 = str_replace('/', '-', $fInicio1);
                $fechaInicio = date('Y-m-d', strtotime($datefInicio1));

                $fFin1 = $_POST["edtfHasta"];
                $datefFin1 = str_replace('/', '-', $fFin1);
                $fechaFin = date('Y-m-d', strtotime($datefFin1));

                if ($_POST["edtFDoc"] != "") {
                    $fDoc1 = $_POST["edtFDoc"];
                    $datefDoc1 = str_replace('/', '-', $fDoc1);
                    $fechaDoc = date('Y-m-d', strtotime($datefDoc1));
                } else {
                    $fechaDoc = null;
                }
                // Envío de datos
                $datos = array(
                    "idLicencia" => $_POST["idLicencia"],
                    "anioMedico" => $_POST["edtAMedicoR"],
                    "mesMedico" => $_POST["edtMMedico"],
                    "mesMedicoA" => $_POST["edtMMedicoA"],
                    "estadoLic" => $_POST["edtEstado"],
                    "empleado" => $_POST["idEmpleado"],
                    "fechaIngreso" => $fechaIngreso,
                    "fechaInicio" => $fechaInicio,
                    "fechaFin" => $fechaFin,
                    "NDias" => $_POST["edtNDias"],
                    "NDiasA" => $_POST["edtNDiasA"],
                    "entidad" => $_POST["edtTipEnt"],
                    "rucEntidad" => $_POST["edtNRuc"],
                    "nombEntidad" => $_POST["edtNomEnt"],
                    "cipMed" => $_POST["edtCMP"],
                    "nombresMed" => $_POST["edtNomMed"],
                    "citt" => $_POST["edtCITT"],
                    "servicionAte" => $_POST["edtServ"],
                    "diagnostico" => $_POST["edtCieDX"],
                    "descDiagnostico" => $_POST["edtDesDX"],
                    "tipDoc" => $_POST["edtTipDoc"],
                    "fechaDoc" => $fechaDoc,
                    "nroDoc" => $_POST["edtNDoc"],
                    "descripDoc" => $_POST["edtDescip"],
                    "observaciones" => $_POST["edtObserva"],
                    "userMod" => $_POST["idUsuarioM"]
                );
                $rptEditarLicencia = LicenciasModelo::mdlEditarLicencia($datos);
                if ($rptEditarLicencia == "ok") {
                    $repuestaRetornaMod = LicenciasModelo::mdlRetornaAcumuladoModificar($_POST["idEmpleado"], $_POST["edtAMedicoR"]);
                    if ($repuestaRetornaMod != "error") {
                        echo '<script>
                        Swal.fire({
                          icon: "success",
                          title: "Se han modificado los datos, con éxito!!. ' . $repuestaRetornaMod . '",
                          showConfirmButton: true,
                          confirmButtonText: "Aceptar",
                          closeOnConfirm: false
                        }).then((result)=>{
                          if(result.value){
                              window.location = "licencias";
                          }});
                    </script>';
                        //     echo '<script>
                        //     Swal.fire({
                        //     icon: "success",
                        //     title: "Se han modificado los datos, con éxito!!. ' . $repuestaRetornaMod . '",
                        //     showConfirmButton: false,
                        //     timer: 2300
                        //     });
                        //     function redirect(){
                        //         window.location = "licencias";
                        //     }
                        //     setTimeout(redirect,2300);
                        // </script>';
                    } else {

                        echo '<script>
                        Swal.fire({
                          icon: "success",
                          title: "Se han modificado los datos, con éxito!!. No se actualizó acumulado alguno, ya que el empleado no cuenta con días acumulados registrados",
                          showConfirmButton: true,
                          confirmButtonText: "Aceptar",
                          closeOnConfirm: false
                        }).then((result)=>{
                          if(result.value){
                              window.location = "licencias";
                          }});
                    </script>';

                    //     echo '<script>
                    //     Swal.fire({
                    //     icon: "success",
                    //     title: "Se han modificado los datos, con éxito!!. No se actualizó acumulado alguno, ya que el empleado no cuenta con días acumulados registrados",
                    //     showConfirmButton: false,
                    //     timer: 2300
                    //     });
                    //     function redirect(){
                    //         window.location = "licencias";
                    //     }
                    //     setTimeout(redirect,2300);
                    // </script>';
                    }
                } else {
                    echo '<script>
                        Swal.fire({
                        icon: "error",
                        title: "Hubo un error al registrar. Intente nuevamente",
                        showConfirmButton: false,
                        timer: 1500
                        });
                        function redirect(){
                            window.location = "licencias";
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
                                window.location = "licencias";
                            }
                            setTimeout(redirect,1200);
                      </script>';
            }
        }
    }

    static public function ctrAnularLicencia()
    {
        if (isset($_GET["idLicencia"])) {
            $idLicencia = $_GET["idLicencia"];
            $nDias = $_GET["nDias"];
            $idUsuario = $_GET["idUsuario"];
            $rptAnulaLicencia = LicenciasModelo::mdlAnularLicencia($idLicencia, $nDias, $idUsuario);

            if ($rptAnulaLicencia != "error") {

                echo '<script>
                Swal.fire({
                  icon: "success",
                  title: "Se ha anulado la licencia, con éxito!!. ' . $rptAnulaLicencia . '",
                  showConfirmButton: true,
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false
                }).then((result)=>{
                  if(result.value){
                      window.location = "licencias";
                  }});
            </script>';
            //     echo '<script>
            //     Swal.fire({
            //     icon: "success",
            //     title: "Se ha anulado la licencia, con éxito!!. ' . $rptAnulaLicencia . '",
            //     showConfirmButton: false,
            //     timer: 2300
            //     });
            //     function redirect(){
            //         window.location = "licencias";
            //     }
            //     setTimeout(redirect,2300);
            // </script>';
            } else {
                echo '<script>
                Swal.fire({
                  icon: "success",
                  title: "Se ha anulado la licencia, con éxito!!. No se actualizó acumulado alguno, ya que el empleado no cuenta con días acumulados registrados",
                  showConfirmButton: true,
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false
                }).then((result)=>{
                  if(result.value){
                      window.location = "licencias";
                  }});
            </script>';
            //     echo '<script>
            //     Swal.fire({
            //     icon: "success",
            //     title: "Se ha anulado la licencia, con éxito!!. No se actualizó acumulado alguno, ya que el empleado no cuenta con días acumulados registrados",
            //     showConfirmButton: false,
            //     timer: 2300
            //     });
            //     function redirect(){
            //         window.location = "licencias";
            //     }
            //     setTimeout(redirect,2300);
            // </script>';
            }
        }
    }
}
