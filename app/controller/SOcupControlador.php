<?php
class SOcupControlador
{
    static public function ctrListarSaludOcup($item, $valor)
    {
        $rptListLic = SOcupModelo::mdlListarAislamiento($item, $valor);
        return $rptListLic;
    }

    static public function ctrListarLocaciones()
    {
        $rptListLic = SOcupModelo::mdlListarLocaciones();
        return $rptListLic;
    }

    static public function ctrListarMotivos()
    {
        $rptListLic = SOcupModelo::mdlListarMotivos();
        return $rptListLic;
    }

    static public function ctrRegistrarSaludOcupacional()
    {
        if (isset($_POST["rgEmpAis"]) && isset($_POST["rgLocAis"]) && isset($_POST["rgfIngAis"]) && isset($_POST["rgAisDesde"]) && isset($_POST["rgAisHasta"]) && isset($_POST["rgDiasAis"]) && isset($_POST["rgAisRein"]) && isset($_POST["rgAisMotivo"]) && isset($_POST["rgAisRecomen"])) {
            if (preg_match('/^[0-9]+$/', $_POST["rgEmpAis"])) {
                date_default_timezone_set('America/Lima');
                // Conversion de fechas

                $fRegistro1 = $_POST["rgfIngAis"];
                $datefRegistro1 = str_replace('/', '-', $fRegistro1);
                $fechaRegistro = date('Y-m-d', strtotime($datefRegistro1));

                $fInicio1 = $_POST["rgAisDesde"];
                $datefInicio1 = str_replace('/', '-', $fInicio1);
                $fechaInicio = date('Y-m-d', strtotime($datefInicio1));

                $fFin1 = $_POST["rgAisHasta"];
                $datefFin1 = str_replace('/', '-', $fFin1);
                $fechaFin = date('Y-m-d', strtotime($datefFin1));

                $fReinc1 = $_POST["rgAisRein"];
                $datefReinc1 = str_replace('/', '-', $fReinc1);
                $fechaReinc = date('Y-m-d', strtotime($datefReinc1));

                // Envío de datos
                $datos = array(
                    "empleado" => $_POST["rgEmpAis"],
                    "locacionAis" => $_POST["rgLocAis"],
                    "fechaRegAis" => $fechaRegistro,
                    "fechaInicio" => $fechaInicio,
                    "fechaFin" => $fechaFin,
                    "nDias" => $_POST["rgDiasAis"],
                    "fechaReinc" => $fechaReinc,
                    "celular" => $_POST["rgAisCel"],
                    "ni" => $_POST["rgAisNI"],
                    "cm" => $_POST["rgAisCM"],
                    "motivo" => $_POST["rgAisMotivo"],
                    "recomLic" => $_POST["rgAisRecomen"],
                    "autogenerado" => $_POST["autoCode"],
                    "usuReg" => $_POST["idUsuario"]
                );
                $rptRegistroSO = SOcupModelo::mdlRegistrarSaludOcupacional($datos);
                if ($rptRegistroSO == "ok") {
                    $repuestaRetorna = SOcupModelo::mdlRetornaCorrelativoSO($_POST["rgEmpAis"], $_POST["autoCode"]);

                    if ($repuestaRetorna != "error") {
                        if ($repuestaRetorna != null) {
                            echo '<script>
                                    Swal.fire({
                                    icon: "success",
                                    title: "' . $repuestaRetorna . ' Registro exitoso.!!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Aceptar",
                                    closeOnConfirm: false
                                    }).then((result)=>{
                                    if(result.value){
                                        window.location = "salud-ocupacional";
                                    }});
                                </script>';
                        }
                    } else {
                        echo '<script>
                        Swal.fire({
                        icon: "error",
                        title: "Ha ocurrido un error con el registro, verifique con los datos del empleado",
                        showConfirmButton: false,
                        timer: 1500
                        });
                        function redirect(){
                            window.location = "salud-ocupacional";
                        }
                        setTimeout(redirect,1200);
                    </script>';
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
                            window.location = "salud-ocupacional";
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
                                window.location = "salud-ocupacional";
                            }
                            setTimeout(redirect,1200);
                      </script>';
            }
        }
    }

    static public function ctrEditarSaludOcupacional()
    {
        if (isset($_POST["edtEmpAis"]) && isset($_POST["edtLocAis"]) && isset($_POST["edtfIngAis"]) && isset($_POST["edtAisDesde"]) && isset($_POST["edtAisHasta"]) && isset($_POST["edtDiasAis"]) && isset($_POST["edtAisRein"]) && isset($_POST["edtAisMotivo"]) && isset($_POST["edtAisRecomen"])) {
            if (preg_match('/^[0-9]+$/', $_POST["edtEmpAis"])) {
                date_default_timezone_set('America/Lima');
                // Conversion de fechas

                $fRegistro1 = $_POST["edtfIngAis"];
                $datefRegistro1 = str_replace('/', '-', $fRegistro1);
                $fechaRegistro = date('Y-m-d', strtotime($datefRegistro1));

                $fInicio1 = $_POST["edtAisDesde"];
                $datefInicio1 = str_replace('/', '-', $fInicio1);
                $fechaInicio = date('Y-m-d', strtotime($datefInicio1));

                $fFin1 = $_POST["edtAisHasta"];
                $datefFin1 = str_replace('/', '-', $fFin1);
                $fechaFin = date('Y-m-d', strtotime($datefFin1));

                $fReinc1 = $_POST["edtAisRein"];
                $datefReinc1 = str_replace('/', '-', $fReinc1);
                $fechaReinc = date('Y-m-d', strtotime($datefReinc1));

                // Envío de datos
                $datos = array(
                    "idAis" => $_POST["idAis"],
                    "empleado" => $_POST["edtEmpAis"],
                    "locacionAis" => $_POST["edtLocAis"],
                    "fechaRegAis" => $fechaRegistro,
                    "fechaInicio" => $fechaInicio,
                    "fechaFin" => $fechaFin,
                    "nDias" => $_POST["edtDiasAis"],
                    "fechaReinc" => $fechaReinc,
                    "celular" => $_POST["edtAisCel"],
                    "ni" => $_POST["edtAisNI"],
                    "cm" => $_POST["edtAisCM"],
                    "motivo" => $_POST["edtAisMotivo"],
                    "recomLic" => $_POST["edtAisRecomen"],
                    "usuMod" => $_POST["idUsMod"]
                );
                $rptModificaSO = SOcupModelo::mdlEditarSaludOcupacional($datos);
                if ($rptModificaSO == "ok") {
                    echo '<script>
                                    Swal.fire({
                                    icon: "success",
                                    title: "Se ha modificado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Aceptar",
                                    closeOnConfirm: false
                                    }).then((result)=>{
                                    if(result.value){
                                        window.location = "salud-ocupacional";
                                    }});
                                </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                        icon: "error",
                        title: "Hubo un error al registrar. Intente nuevamente",
                        showConfirmButton: false,
                        timer: 1500
                        });
                        function redirect(){
                            window.location = "salud-ocupacional";
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
                                window.location = "salud-ocupacional";
                            }
                            setTimeout(redirect,1200);
                      </script>';
            }
        }
    }

    static public function ctrAnularSaludOcupacional()
    {
        if (isset($_GET["idAis"])) {
            $idAis = $_GET["idAis"];
            $idUsuario = $_GET["idUsuario"];
            $rptAnulaSOcup = SOcupModelo::mdlAnularSaludOcup($idAis, $idUsuario);

            if ($rptAnulaSOcup == "ok") {
                echo '<script>
                Swal.fire({
                  icon: "success",
                  title: "Se ha anulado el registro, con éxito!!",
                  showConfirmButton: true,
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false
                }).then((result)=>{
                  if(result.value){
                      window.location = "salud-ocupacional";
                  }});
            </script>';
            } else {
                echo '<script>
                Swal.fire({
                  icon: "error",
                  title: "Ha ocurrido un error al anular",
                  showConfirmButton: true,
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false
                }).then((result)=>{
                  if(result.value){
                      window.location = "salud-ocupacional";
                  }});
            </script>';
            }
        }
    }
}
