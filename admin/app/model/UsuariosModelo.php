<?php
require_once "dbConnect.php";
class UsuariosModelo
{
    static public function mdlLoginUsuario($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL LoginUsuario(:cuenta)");
        $stmt->bindParam(":cuenta", $datos, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlRegistroIntentos($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL RegistrarIntentos(:idUsuario)");
        $stmt->bindParam(":idUsuario", $datos, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlListarUsuarios($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            usuarios.idUsuario, 
            usuarios.idRol, 
            roles.nombreRol, 
            usuarios.dni, 
            usuarios.nombres, 
            usuarios.apellidos, 
            usuarios.correo, 
            usuarios.login, 
            usuarios.clave, 
            usuarios.estado
        FROM
            usuarios
            INNER JOIN
            roles
            ON 
                usuarios.idRol = roles.idRol
        WHERE $item = :$item 
            ORDER BY usuarios.idRol ASC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL Listar_Usuarios()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarTiposRoles()
    {
        $stmt = Conexion::conectar()->prepare("CALL Listar_Perfiles_Users()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlRegistrarUsuario($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Registrar_Usuario(:perfil,:dni,:apellidos,:nombres,:cuenta,:correo,:clave)");
        $stmt->bindParam(":perfil", $datos["idPerfil"], PDO::PARAM_INT);
        $stmt->bindParam(":dni", $datos["dniUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidosUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombresUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":cuenta", $datos["cuentaUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correoUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":clave", $datos["claveUsuario"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlEditarUsuario($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Editar_Usuario(:idUsuario,:perfil,:dni,:apellidos,:nombres,:cuenta,:correo,:clave)");
        $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
        $stmt->bindParam(":perfil", $datos["idPerfil"], PDO::PARAM_INT);
        $stmt->bindParam(":dni", $datos["dniUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidosUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombresUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":cuenta", $datos["cuentaUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correoUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":clave", $datos["claveUsuario"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlActualizarUsuario($idUsuario, $idEstado)
    {
        $stmt = Conexion::conectar()->prepare("CALL Habilitar_Usuario(:idUsuario,:idEstado)");
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(":idEstado", $idEstado, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlDesbloquearUsuario($idUsuario)
    {
        $stmt = Conexion::conectar()->prepare("CALL Desbloquear_Usuario(:idUsuario)");
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlValidarEstado($idUsuario)
    {
        $stmt = Conexion::conectar()->prepare("CALL Verifica_EstadoLog(:idUsuario)");
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlEliminarUsuario($dato)
    {
        $stmt = Conexion::conectar()->prepare("CALL Eliminar_Usuario(:idUsuario)");
        $stmt->bindParam(":idUsuario", $dato, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
}
