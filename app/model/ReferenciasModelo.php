<?php
require_once "dbConnect.php";
require_once "MSdb.php";

class ReferenciasModelo
{
    static public function mdlBuscarReferencias($dni, $anio)
    {
        $stmt = Conexion::conectar()->prepare("CALL Consulta_ReferenciasPaciente(:dni,:anio)");
        $stmt->bindParam(":dni", $dni, PDO::PARAM_STR);
        $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }

    static public function mdlBuscarReferenciasSIGH($dni, $anio)
    {
        // $stmt = ConexionConsulta::conectar()->prepare("exec ConsultaRefconWeb @dniUsuario = :dni, @anio = :anio");
        $stmt = ConexionConsulta::conectar()->prepare("SELECT TOP 1 ReferenciasRefcon.nroReferencia,
        YEAR(DetalleReferencia.FechaReferencia) as anioReferencia,
        format ( DetalleReferencia.FechaSolicitud, 'dd/MM/yyyy' ) AS FechaSolicitud,
        format ( DetalleReferencia.FechaReferencia, 'dd/MM/yyyy' ) AS FechaReferencia,
        ReferenciasRefcon.tipDocumento,
        ReferenciasRefcon.dni,
        DetalleReferencia.IdAtencion,
        format ( Citas.Fecha, 'dd/MM/yyyy' ) AS FechaCita,
        Citas.HoraInicio,
        Citas.HoraFin,
        Citas.IdEstadoCita,
        Especialidades.IdDepartamento,
        DepartamentosHospital.Nombre AS NombDepartamento,
        Citas.IdEspecialidad,
        Especialidades.Nombre AS NombEspecialidad,
        Citas.IdServicio,
        Servicios.Nombre AS NombreServicio,
        Servicios.IdTipoServicio 
    FROM
        dbo.ReferenciasRefcon
        INNER JOIN dbo.DetalleReferencia ON ReferenciasRefcon.nroReferencia = DetalleReferencia.NroReferencia
        INNER JOIN dbo.Citas ON DetalleReferencia.IdAtencion = Citas.IdAtencion
        INNER JOIN dbo.Servicios ON Citas.IdServicio = Servicios.IdServicio
        INNER JOIN dbo.Especialidades ON Citas.IdEspecialidad = Especialidades.IdEspecialidad
        INNER JOIN dbo.DepartamentosHospital ON Especialidades.IdDepartamento = DepartamentosHospital.IdDepartamento
        WHERE
	Servicios.IdTipoServicio = 1 
	AND Citas.IdEstadoCita = 1 AND ReferenciasRefcon.dni = $dni
    ORDER BY
	DetalleReferencia.FechaReferencia DESC");

        // $stmt->bindParam(":dni", $dni, PDO::PARAM_STR);
        // $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
        // $stmt->bindParam(':dni', $dni, PDO::PARAM_STR, 15);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
}
