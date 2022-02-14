$("#bsqDoc").attr("minlength", "8");
$("#bsqDoc").attr("maxlength", "15");

$("#bsqDoc").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});

CargarTablaReferenciasProceso($("#bsqDoc").val(), $("#anioActual").val());
CargarTablaReferenciasCitadas($("#bsqDoc").val(), $("#anioActual").val());

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
        CargarTablaReferenciasCitadas(dni, anio);
    }
    else {
        CargarTablaReferenciasProceso(dni, anio);
        CargarTablaReferenciasCitadas(dni, anio);
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


function CargarTablaReferenciasCitadas(dni, anio) {
    $.ajax({
        url: "public/views/src/ajaxConsultas.php",
        method: "POST",
        dataType: "html",
        data: { dni2: dni, anio2: anio}
    }).done(function (respuesta) {
        $("#bloque2").html(respuesta);
        $(".datatableReferenciasCitadas").DataTable({
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