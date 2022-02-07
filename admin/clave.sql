SELECT
	DetalleReferencia.FechaReferencia, 
	ReferenciasRefcon.nroReferencia, 
	ReferenciasRefcon.tipDocumento, 
	ReferenciasRefcon.dni, 
	ReferenciasRefcon.nombres, 
	ReferenciasRefcon.apeMaterno, 
	ReferenciasRefcon.apePaterno, 
	ReferenciasRefcon.sexo, 
	DetalleReferencia.FechaSolicitud, 
	DetalleReferencia.Horasolicitud, 
	ReferenciasRefcon.fecCita, 
	DetalleReferencia.Estado, 
	ReferenciasRefcon.codServicio, 
	ReferenciasRefcon.especialidad, 
	DetalleReferencia.IdAtencion
FROM
	dbo.ReferenciasRefcon
	INNER JOIN
	dbo.DetalleReferencia
	ON 
		ReferenciasRefcon.nroReferencia = DetalleReferencia.NroReferencia