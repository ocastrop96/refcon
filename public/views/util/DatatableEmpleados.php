<?php
// LLamada a controlador
require_once "../../../app/controller/EmpleadosControlador.php";
// LLamada a modelo
require_once "../../../app/model/EmpleadosModelo.php";

class DatatableEmpleados
{
    public function mostrarTablaEmpleados()
    {
        $item = null;
        $valor = null;
        $empleados = EmpleadosControlador::ctrListarEmpleados($item, $valor);

        $datos_json = '{
            "data": [';

        for ($i = 0; $i < count($empleados); $i++) {
            // Botones de Opciones
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarEmpleado' idEmpleado='" . $empleados[$i]["idEmpleado"] . "' data-toggle='modal' data-target='#modal-editar-empleado'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarEmpleado' data-toggle='tooltip' data-placement='left' title='Eliminar Empleado' idEmpleado='" . $empleados[$i]["idEmpleado"] . "'><i class='fas fa-trash-alt'></i></button></div>";

            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $empleados[$i]["dniEmp"] . '",
                "' . $empleados[$i]["apellidosPEmp"] . '",
                "' . $empleados[$i]["apellidosMEmp"] . '",
                "' . $empleados[$i]["nombresEmp"] . '",
                "' . $empleados[$i]["descCargo"] . '",
                "' . $empleados[$i]["descCondicion"] . '",
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}
// Llamamos a la tabla de Usuarios
$tablaEmpleados = new DatatableEmpleados();
$tablaEmpleados->mostrarTablaEmpleados();
