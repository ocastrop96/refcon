<?php
class EmpleadosControlador
{
    static public function ctrListarEmpleados($item, $valor)
    {
        $rptListE = EmpleadosModelo::mdlListarEmpleados($item, $valor);
        return $rptListE;
    }

    static public function ctrListarCondiciones()
    {
        $rptLisTipCond = EmpleadosModelo::mdlListarCondicion();
        return $rptLisTipCond;
    }

    static public function ctrRegistrarEmpleado()
    {
        if (isset($_POST["rgEDni"]) && isset($_POST["idUsRegEmp"]) && isset($_POST["rgENombres"]) && isset($_POST["rgEApPat"]) && isset($_POST["rgEApMat"])) {
            if (
                preg_match('/^[0-9]+$/', $_POST["rgECargo"]) &&
                preg_match('/^[0-9]+$/', $_POST["rgECondicion"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ ]+$/', $_POST["rgENombres"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ ]+$/', $_POST["rgEApPat"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ ]+$/', $_POST["rgEApMat"])
            ) {

                if ($_POST["rgEFNac"] != "") {
                    $fDoc1 = $_POST["rgEFNac"];
                    $datefDoc1 = str_replace('/', '-', $fDoc1);
                    $fnaciEmp = date('Y-m-d', strtotime($datefDoc1));
                } else {
                    $fnaciEmp = null;
                }
                if ($_POST["rgEFAlta"] != "") {
                    $fDoc2 = $_POST["rgEFAlta"];
                    $datefDoc2 = str_replace('/', '-', $fDoc2);
                    $fechaAlta = date('Y-m-d', strtotime($datefDoc2));
                } else {
                    $fechaAlta = null;
                }
                if ($_POST["rgESueldo"] != "") {
                    $sueldoEmp = $_POST["rgESueldo"];
                } else {
                    $sueldoEmp = "0.00";
                }
                $datos = array(
                    "dniEmp" => $_POST["rgEDni"],
                    "fnaciEmp" => $fnaciEmp,
                    "fechaAlta" => $fechaAlta,
                    "nombresEmp" => $_POST["rgENombres"],
                    "apellidosPEmp" => $_POST["rgEApPat"],
                    "apellidosMEmp" => $_POST["rgEApMat"],
                    "condicionEmp" => $_POST["rgECondicion"],
                    "cargoEmp" => $_POST["rgECargo"],
                    "sueldoEmp" => $sueldoEmp,
                    "userRegEmp" => $_POST["idUsRegEmp"]
                );
                $rptRegistroEmpleado = EmpleadosModelo::mdlRegistrarEmpleado($datos);
                if ($rptRegistroEmpleado == "ok") {
                    echo '<script>
                    Swal.fire({
                    icon: "success",
                    title: "Se ha registrado con éxito al Empleado",
                    showConfirmButton: false,
                    timer: 2000
                    });
                    function redirect(){
                        window.location = "empleados";
                    }
                    setTimeout(redirect,2000);
                    </script>';
                } else {
                    echo '<script>
                    Swal.fire({
                    icon: "error",
                    title: "Hubo un error al ingresar sus datos, reintente",
                    showConfirmButton: false,
                    timer: 2000
                    });
                    function redirect(){
                        window.location = "empleados";
                    }
                    setTimeout(redirect,2000);
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                    icon: "error",
                    title: "Ingrese correctamente sus datos",
                    showConfirmButton: false,
                    timer: 2000
                    });
                    function redirect(){
                        window.location = "empleados";
                    }
                    setTimeout(redirect,2000);
                </script>';
            }
        }
    }

    static public function ctrEditarEmpleado()
    {
        if (isset($_POST["edtEDni"]) && isset($_POST["idEmpleado"]) && isset($_POST["edtENombres"]) && isset($_POST["edtEApPat"]) && isset($_POST["edtEApMat"])) {
            if (
                preg_match('/^[0-9]+$/', $_POST["edtECargo"]) &&
                preg_match('/^[0-9]+$/', $_POST["edtECondicion"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ ]+$/', $_POST["edtENombres"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ ]+$/', $_POST["edtEApPat"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ ]+$/', $_POST["edtEApMat"])
            ) {

                if ($_POST["edtEFNac"] != "") {
                    $fDoc1 = $_POST["edtEFNac"];
                    $datefDoc1 = str_replace('/', '-', $fDoc1);
                    $fnaciEmp = date('Y-m-d', strtotime($datefDoc1));
                } else {
                    $fnaciEmp = null;
                }
                if ($_POST["edtEFAlta"] != "") {
                    $fDoc2 = $_POST["edtEFAlta"];
                    $datefDoc2 = str_replace('/', '-', $fDoc2);
                    $fechaAlta = date('Y-m-d', strtotime($datefDoc2));
                } else {
                    $fechaAlta = null;
                }
                if ($_POST["edtESueldo"] != "") {
                    $sueldoEmp = $_POST["edtESueldo"];
                } else {
                    $sueldoEmp = "0.00";
                }
                $datos = array(
                    "dniEmp" => $_POST["edtEDni"],
                    "fnaciEmp" => $fnaciEmp,
                    "fechaAlta" => $fechaAlta,
                    "nombresEmp" => $_POST["edtENombres"],
                    "apellidosPEmp" => $_POST["edtEApPat"],
                    "apellidosMEmp" => $_POST["edtEApMat"],
                    "condicionEmp" => $_POST["edtECondicion"],
                    "cargoEmp" => $_POST["edtECargo"],
                    "sueldoEmp" => $sueldoEmp,
                    "idEmpleado" => $_POST["idEmpleado"]
                );
                $rptEditarEmpleado = EmpleadosModelo::mdlEditarEmpleado($datos);
                if ($rptEditarEmpleado == "ok") {
                    echo '<script>
                    Swal.fire({
                    icon: "success",
                    title: "Se modificaron los datos del Empleado con éxito",
                    showConfirmButton: false,
                    timer: 1500
                    });
                    function redirect(){
                        window.location = "empleados";
                    }
                    setTimeout(redirect,1500);
                    </script>';
                } else {
                    echo '<script>
                    Swal.fire({
                    icon: "error",
                    title: "Hubo un error al ingresar sus datos, reintente",
                    showConfirmButton: false,
                    timer: 1500
                    });
                    function redirect(){
                        window.location = "empleados";
                    }
                    setTimeout(redirect,1500);
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                    icon: "error",
                    title: "Ingrese correctamente sus datos",
                    showConfirmButton: false,
                    timer: 1500
                    });
                    function redirect(){
                        window.location = "empleados";
                    }
                    setTimeout(redirect,1500);
                </script>';
            }
        }
    }
    static public function ctrEliminarEmpleado(){
        if (isset($_GET["idEmpleado"])) {
            $datos = $_GET["idEmpleado"];
            $rptEliminaUs = EmpleadosModelo::mdlEliminarEmpleado($datos);
            if ($rptEliminaUs == "ok") {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El empleado ha sido eliminado con éxito!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        function redirect(){
                            window.location = "empleados";
                        }
                        setTimeout(redirect,1500);
                    </script>';
            } else {
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡El empleado no ha podido ser eliminado!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        function redirect(){
                            window.location = "empleados";
                        }
                        setTimeout(redirect,1500);
                    </script>';
            }
        }
    }
}
