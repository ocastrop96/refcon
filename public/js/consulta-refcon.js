CargarTablaReferenciasProceso($("#bsqDoc").val(), $("#anioActual").val());
CargarTablaReferenciasCitadas();


function CargarTablaReferenciasProceso(dni,anio) {
    $(".datatableReferenciasProceso").DataTable({
        ajax: "public/views/util/DatatableConsultaReferencias.php?dni="+dni+"&anio="+anio,
        deferRender: true,
        retrieve: true,
        processing: true,
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        language: {
            url: "public/views/resources/js/dataTables.spanish.lang",
        },
    });
}

function CargarTablaReferenciasCitadas(dni,anio) {
    $(".datatableReferenciasCitados").DataTable({
        ajax: "public/views/util/DatatableConsultaReferenciasSIGH.php?dni="+dni+"&anio="+anio,
        deferRender: true,
        retrieve: true,
        processing: true,
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        language: {
            url: "public/views/resources/js/dataTables.spanish.lang",
        },
    });
}