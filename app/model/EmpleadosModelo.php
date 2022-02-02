<?php
require_once "dbConnect.php";
class EmpleadosModelo
{
    static public function mdlListarEmpleados($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            mrms_empleados.idEmpleado, 
            mrms_empleados.dniEmp,
            date_format(mrms_empleados.fnaciEmp,'%d/%m/%Y') as fnaciEmp,
            date_format(mrms_empleados.fechaAlta,'%d/%m/%Y') as fechaAlta, 
            mrms_empleados.apellidosPEmp,
            mrms_empleados.apellidosMEmp,
            mrms_empleados.nombresEmp, 
            mrms_empleados.condicionEmp, 
            mrms_condicionlab.descCondicion, 
            mrms_empleados.cargoEmp,
            mrms_cargos.codCargo, 
            mrms_cargos.descCargo, 
            mrms_empleados.sueldoEmp
        FROM
            mrms_empleados
            INNER JOIN
            mrms_condicionlab
            ON 
                mrms_empleados.condicionEmp = mrms_condicionlab.idCondicionLab
            INNER JOIN
            mrms_cargos
            ON 
                mrms_empleados.cargoEmp = mrms_cargos.idCargo
            WHERE $item = :$item ORDER BY mrms_empleados.apellidosPEmp ASC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL Listar_Empleados()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarCondicion()
    {
        $stmt = Conexion::conectar()->prepare("CALL Listar_Condiciones_Empleados()");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlRegistrarEmpleado($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Registrar_Empleado(:dniEmp,:fnaciEmp,:fechaAlta,:nombresEmp,:apellidosPEmp,:apellidosMEmp,:condicionEmp,:cargoEmp,:sueldoEmp,:userRegEmp)");
        $stmt->bindParam(":condicionEmp", $datos["condicionEmp"], PDO::PARAM_INT);
        $stmt->bindParam(":cargoEmp", $datos["cargoEmp"], PDO::PARAM_INT);
        $stmt->bindParam(":userRegEmp", $datos["userRegEmp"], PDO::PARAM_INT);

        $stmt->bindParam(":sueldoEmp", $datos["sueldoEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":dniEmp", $datos["dniEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":fnaciEmp", $datos["fnaciEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaAlta", $datos["fechaAlta"], PDO::PARAM_STR);
        $stmt->bindParam(":nombresEmp", $datos["nombresEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidosPEmp", $datos["apellidosPEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidosMEmp", $datos["apellidosMEmp"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlEditarEmpleado($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL Editar_Empleado(:dniEmp,:fnaciEmp,:fechaAlta,:nombresEmp,:apellidosPEmp,:apellidosMEmp,:condicionEmp,:cargoEmp,:sueldoEmp,:idEmpleado)");
        $stmt->bindParam(":condicionEmp", $datos["condicionEmp"], PDO::PARAM_INT);
        $stmt->bindParam(":cargoEmp", $datos["cargoEmp"], PDO::PARAM_INT);
        $stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_INT);
        $stmt->bindParam(":sueldoEmp", $datos["sueldoEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":dniEmp", $datos["dniEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":fnaciEmp", $datos["fnaciEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaAlta", $datos["fechaAlta"], PDO::PARAM_STR);
        $stmt->bindParam(":nombresEmp", $datos["nombresEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidosPEmp", $datos["apellidosPEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidosMEmp", $datos["apellidosMEmp"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlEliminarEmpleado($dato)
    {
        $stmt = Conexion::conectar()->prepare("CALL Eliminar_Empleado(:idEmpleado)");
        $stmt->bindParam(":idEmpleado", $dato, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
}
