$("#bsqDoc").attr("minlength", "8");
$("#bsqDoc").attr("maxlength", "15");

$("#bsqDoc").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});

CargarTablaReferenciasProceso($("#bsqDoc").val(), $("#anioActual").val());
// CargarTablaReferenciasCitadas();

$("#btnDNIUCons").click(function () {
    var dni = $("#bsqDoc").val();
    var anio = $("#anioActual").val();
    if (dni == '') {
        Swal.fire({
            icon: "warning",
            title: "¡Ingrese N° de Documento de Identidad!",
            showConfirmButton: false,
            timer: 1600
        });
        $("#bsqDoc").val("");
        $("#bsqDoc").focus();
        CargarTablaReferenciasProceso(dni, anio);
    }
    else {
        CargarTablaReferenciasProceso(dni, anio);
    }

});
function CargarTablaReferenciasProceso(dni, anio) {
    $.ajax({
        url: "public/views/src/ajaxConsultas.php",
        method: "POST",
        dataType: "html",
        data: { dni: dni, anio: anio }
    }).done(function (respuesta) {
        $("#bloque1").html(respuesta);
        $(".datatableReferenciasProceso").DataTable({
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
        console.log(respuesta);
    }).fail(function () {
        console.log("error");
    })
}
// function CargarTablaReferenciasProceso(dni, anio) {
//     // $('.datatable-datatableReferenciasProceso').DataTable().ajax.reload();
//     $(".datatableReferenciasProceso").DataTable({
//         ajax: "public/views/util/DatatableConsultaReferencias.php?dni=" + dni + "&anio=" + anio,
//         deferRender: true,
//         retrieve: true,
//         processing: true,
//         paging: true,
//         lengthChange: true,
//         searching: true,
//         ordering: false,
//         info: true,
//         autoWidth: false,
//         language: {
//             url: "public/views/resources/js/dataTables.spanish.lang",
//         },
//     });
// }

// function CargarTablaReferenciasCitadas(dni, anio) {
//     $(".datatableReferenciasCitados").DataTable({
//         ajax: "public/views/util/DatatableConsultaReferenciasSIGH.php?dni=" + dni + "&anio=" + anio,
//         deferRender: true,
//         retrieve: true,
//         processing: true,
//         paging: true,
//         lengthChange: true,
//         searching: true,
//         ordering: false,
//         info: true,
//         autoWidth: false,
//         language: {
//             url: "public/views/resources/js/dataTables.spanish.lang",
//         },
//     });
// }