<?php
class CargosControlador
{
    static public function ctrListarCargos($item, $valor)
    {
        $rptListC = CargosModelo::mdlListarCargos($item, $valor);
        return $rptListC;
    }

    static public function ctrRegistrarCargo()
    {
        if (isset($_POST["rgCodCar"]) && isset($_POST["rgDetaCar"])) {
            if ($_POST["rgCodCar"] != "") {
                $codCargo = $_POST["rgCodCar"];
            } else {
                $codCargo = "SCD";
            }

            $datos = array(
                "codCargo" => $codCargo,
                "descCargo" => $_POST["rgDetaCar"]
            );
            $rptRegCargo = CargosModelo::mdlRegistrarCargo($datos);
            if ($rptRegCargo == "ok") {
                echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "¡El cargo ha sido registrado con éxito!",
                                showConfirmButton: false,
                                timer: 1600
                            });
                            function redirect(){
                                window.location = "cargos";
                            }
                            setTimeout(redirect,1600);
                      </script>';
            } else {
                echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Hubo un error al registrar sus datos, reintente",
                                showConfirmButton: false,
                                timer: 1600
                            });
                            function redirect(){
                                window.location = "cargos";
                            }
                            setTimeout(redirect,1600);
                      </script>';
            }
        }
    }
    static public function ctrEditarCargo()
    {
        if (isset($_POST["edtCodCar"]) && isset($_POST["edtDetaCar"])) {
            if ($_POST["edtCodCar"] != "") {
                $codCargo = $_POST["edtCodCar"];
            } else {
                $codCargo = "SCD";
            }

            $datos = array(
                "codCargo" => $codCargo,
                "descCargo" => $_POST["edtDetaCar"],
                "idCargo" => $_POST["idCargo"]
            );
            $rptEdtCargo = CargosModelo::mdlEditarCargo($datos);
            if ($rptEdtCargo == "ok") {
                echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "¡El cargo ha sido modificado con éxito!",
                                showConfirmButton: false,
                                timer: 1600
                            });
                            function redirect(){
                                window.location = "cargos";
                            }
                            setTimeout(redirect,1600);
                      </script>';
            } else {
                echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Hubo un error al registrar sus datos, reintente",
                                showConfirmButton: false,
                                timer: 1600
                            });
                            function redirect(){
                                window.location = "cargos";
                            }
                            setTimeout(redirect,1600);
                      </script>';
            }
        }
    }
    static public function ctrEliminarCargo()
    {
        if (isset($_GET["idCargo"])) {
            $datos = $_GET["idCargo"];
            $rptEliminaCar = CargosModelo::mdlEliminarCargo($datos);
            if ($rptEliminaCar == "ok") {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El cargo ha sido eliminado con éxito!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        function redirect(){
                            window.location = "cargos";
                        }
                        setTimeout(redirect,1500);
                    </script>';
            } else {
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡El cargo no ha podido ser eliminado!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        function redirect(){
                            window.location = "cargos";
                        }
                        setTimeout(redirect,1500);
                    </script>';
            }
        }
    }
}
