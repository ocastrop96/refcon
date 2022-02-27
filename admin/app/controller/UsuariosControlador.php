<?php
class UsuariosControlador
{
    static public function ctrLoginUsuario()
    {
        if (isset($_POST["usuarioLogMR"]) && isset($_POST["usuarioPassMR"])) {
            if (
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/', $_POST["usuarioLogMR"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ].{7,15}+$/', $_POST["usuarioPassMR"])
            ) {
                $usuario = $_POST["usuarioLogMR"];
                $encriptaPass = crypt($_POST["usuarioPassMR"], '$2a$07$usesomesillystringforsalt$');

                $rptLogin = UsuariosModelo::mdlLoginUsuario($usuario);
                if ($rptLogin["login"] == $_POST["usuarioLogMR"] && $rptLogin["clave"] == $encriptaPass) {
                    // Validación de habilitaciónW
                    if ($rptLogin["estado"] == 1) {
                        // VALIDANDO INTENTOS REGISTRADOS
                        if ($rptLogin["intentos"] <= 3) {
                            $_SESSION["loginGRSystem"] = "ok";
                            $_SESSION["loginIdRef"] = $rptLogin["idUsuario"];
                            $_SESSION["loginCardRef"] = $rptLogin["dni"];
                            $_SESSION["loginPerfilRef"] = $rptLogin["idRol"];
                            $_SESSION["loginPerfilDescRef"] = $rptLogin["nombreRol"];
                            $_SESSION["loginNombresRef"] = $rptLogin["nombres"];

                            echo '<script>
                                Swal.fire({
                                    icon: "success",
                                    title: "Acceso concedido...¡Bienvenido(a)! <br>' . $_SESSION["loginNombresRef"] . '",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                function redirect(){
                                    window.location = "dashboard";
                                }
                                setTimeout(redirect,1200);
                                 </script>';
                        } else {
                            echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Número de intentos de acceso excedidos, comuníquese con el administrador para desbloquear su usuario",
                                showConfirmButton: false,
                                timer: 1200
                            });
                            function redirect(){
                                window.location = "signin";
                            }
                            setTimeout(redirect,1200);
                             </script>';
                        }
                        // VALIDANDO INTENTOS REGISTRADOS
                    } else {
                        echo '<script>
                                Swal.fire({
                                    icon: "warning",
                                    title: "Su cuenta está inhabilitada, comuníquese con el administrador de sistema!",
                                    showConfirmButton: false,
                                    timer: 1200
                                });
                                function redirect(){
                                    window.location = "signin";
                                }
                                setTimeout(redirect,1200);
                                 </script>';
                    }
                    // Validación de habilitación
                } elseif ($encriptaPass != $rptLogin["clave"]) {
                    $id = $rptLogin["idUsuario"];
                    $registroIntentos = UsuariosModelo::mdlRegistroIntentos($id);
                    $mensajeIntentos = "";
                    $limite = 3;
                    if ($rptLogin["intentos"] < 3) {
                        $mensajeIntentos = "Te quedan " . ($limite - $rptLogin["intentos"]) . " intento(s)";
                    } elseif ($rptLogin["intentos"] == 3) {
                        $mensajeIntentos = "No te quedan más intentos";
                    } else {
                        $mensajeIntentos = "Haz excedido el número de intentos. Tu cuenta ha sido bloqueada";
                    }
                    echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "El usuario y/o contraseña ingresados no son correctos.' . $mensajeIntentos . '",
                        showConfirmButton: false,
                        timer: 1200
                    });
                    function redirect(){
                        window.location = "signin";
                    }
                    setTimeout(redirect,1200);
                </script>';
                } else {
                    echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "El usuario y/o contraseña ingresados no son correctos",
                                showConfirmButton: false,
                                timer: 1200
                            });
                            function redirect(){
                                window.location = "signin";
                            }
                            setTimeout(redirect,1200);
                             </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Ingrese correctamente sus credenciales!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    function redirect(){
                        window.location = "signin";
                    }
                    setTimeout(redirect,1200);
                </script>';
            }
        }
    }
    static public function ctrListarUsuarios($item, $valor)
    {
        $rptListU = UsuariosModelo::mdlListarUsuarios($item, $valor);
        return $rptListU;
    }
    static public function ctrListarTipoRoles()
    {
        $rptPerf = UsuariosModelo::mdlListarTiposRoles();
        return $rptPerf;
    }
    // Registro de Usuarios
    static public function ctrRegistrarUsuario()
    {
        if (isset($_POST["rgDni"]) && isset($_POST["rgUsuario"]) && isset($_POST["rgClave"])) {
            if (
                preg_match('/^[0-9]+$/', $_POST["rgDni"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["rgUsuario"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ].{7,15}+$/', $_POST["rgClave"])
            ) {
                $encriptacionReg = crypt($_POST["rgClave"], '$2a$07$usesomesillystringforsalt$');
                $datos = array(
                    "dniUsuario" => $_POST["rgDni"],
                    "apellidosUsuario" => $_POST["rgApellidos"],
                    "nombresUsuario" => $_POST["rgNombres"],
                    "cuentaUsuario" => $_POST["rgUsuario"],
                    "correoUsuario" => $_POST["rgCorreo"],
                    "idPerfil" => $_POST["rgPerfil"],
                    "claveUsuario" => $encriptacionReg
                );
                $rptRegistroUsuario = UsuariosModelo::mdlRegistrarUsuario($datos);
                if ($rptRegistroUsuario == "ok") {
                    echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "¡El usuario ha sido registrado con éxito!",
                                showConfirmButton: false,
                                timer: 2000
                            });
                            function redirect(){
                                window.location = "usuarios";
                            }
                            setTimeout(redirect,2000);
                      </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                        icon: "error",
                        title: "Hubo un error al registrar. Intente nuevamente",
                        showConfirmButton: false,
                        timer: 2000
                        });
                        function redirect(){
                            window.location = "usuarios";
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
                        window.location = "usuarios";
                    }
                    setTimeout(redirect,2000);
                </script>';
            }
        }
    }
    // Registro de Usuarios
    // Modificación de Usuarios
    static public function ctrEditarUsuario()
    {
        if (isset($_POST["edtDni"]) && isset($_POST["edtUsuario"])) {
            if (
                preg_match('/^[0-9]+$/', $_POST["edtDni"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["edtUsuario"])
            ) {
                if ($_POST["edtClave"] != "") {
                    if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ].{7,15}+$/', $_POST["edtClave"])) {
                        $encriptacionEdt = crypt($_POST["edtClave"], '$2a$07$usesomesillystringforsalt$');
                    } else {
                        echo '<script>
                                Swal.fire({
                                    icon: "error",
                                    title: "La contraseña no debe contener letras especiales",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                function redirect(){
                                    window.location = "usuarios";
                                }
                                setTimeout(redirect,1500);
                            </script>';
                    }
                } else {
                    $encriptacionEdt = $_POST["passActual"];
                }

                $datos = array(
                    "idUsuario" => $_POST["idUsuario"],
                    "dniUsuario" => $_POST["edtDni"],
                    "apellidosUsuario" => $_POST["edtApellidos"],
                    "nombresUsuario" => $_POST["edtNombres"],
                    "cuentaUsuario" => $_POST["edtUsuario"],
                    "correoUsuario" => $_POST["edtCorreo"],
                    "idPerfil" => $_POST["edtPerfil"],
                    "claveUsuario" => $encriptacionEdt
                );

                $rptEditarU = UsuariosModelo::mdlEditarUsuario($datos);
                if ($rptEditarU == "ok") {
                    echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "El usuario ha sido modificado con éxito",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            function redirect(){
                                window.location = "usuarios";
                            }
                            setTimeout(redirect,1300);
                      </script>';
                } else {
                    echo '<script>
                      Swal.fire({
                        icon: "error",
                        title: "Ingrese correctamente sus datos",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    function redirect(){
                        window.location = "usuarios";
                    }
                    setTimeout(redirect,1200);
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
                        window.location = "usuarios";
                    }
                    setTimeout(redirect,1200);
                </script>';
            }
        }
    }
    // Modificación de Usuarios
    // Eliminación de Usuarios
    static public function ctrEliminarUsuario()
    {
        if (isset($_GET["idUsuario"])) {
            $datos = $_GET["idUsuario"];
            $rptEliminaUs = UsuariosModelo::mdlEliminarUsuario($datos);
            if ($rptEliminaUs == "ok") {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El usuario ha sido eliminado con éxito!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        function redirect(){
                            window.location = "usuarios";
                        }
                        setTimeout(redirect,1200);
                    </script>';
            } else {
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡El usuario no ha podido ser eliminado!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        function redirect(){
                            window.location = "usuarios";
                        }
                        setTimeout(redirect,1200);
                    </script>';
            }
        }
    }
    // Eliminación de Usuarios
}
