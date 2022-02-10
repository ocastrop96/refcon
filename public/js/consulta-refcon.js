CargarTablaReferenciasProceso();
CargarTablaReferenciasCitadas();


function CargarTablaReferenciasProceso() {
    $(".datatableReferenciasProceso").DataTable({
        // ajax: "public/views/util/DatatableReferencias.php",
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

function CargarTablaReferenciasCitadas() {
    $(".datatableReferenciasCitados").DataTable({
        // ajax: "public/views/util/DatatableReferencias.php",
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