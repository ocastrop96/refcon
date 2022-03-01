$("#bsqDoc").attr("minlength", "8");
$("#bsqDoc").attr("maxlength", "15");

$("#bsqDoc").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-Z0-9\-]/g, "");
});

$("#btnDNIUCons").click(function () {
    var dni = $("#bsqDoc").val();
    var anio = $("#anioActual").val();
    if (dni == '') {
        Swal.fire({
            icon: "warning",
            title: "¡Estimado usuario, ingrese N° de Documento de Identidad!",
            showConfirmButton: false,
            timer: 1800
        });
        $("#bsqDoc").val("");
        $("#bsqDoc").focus();
        $("#bloqueRespuesta").html("");
    }
    else {
        CargarData(dni, anio)
    }

});

function VerMotivo(idReferencia) {
    var datos = new FormData();
    datos.append("idReferencia", idReferencia);

    $.ajax({
        url: "public/views/src/ajaxConsultas.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#correlativoEdt").html(respuesta["nroHojaRef"]);

            $("#data1").val(respuesta["descEstado"]);
            $("#data2").val(respuesta["nombreEsp"]);
            $("#data3").val(respuesta["anamnesis"]);
            $("#data4").val(respuesta["motivo"]);
        },
    });

}

function CargarData(dni, anio) {
    $.ajax({
        url: "public/views/src/ajaxConsultas.php",
        method: "POST",
        dataType: "json",
        data: { dni: dni, anio: anio }
    }).done(function (respuesta) {
        console.log(respuesta);
        if (respuesta["galen"] >= 1 && respuesta["local"] == 0) {
            let stringRpta = "Solicitud(es) con Cita Registrada :    " + respuesta["galen"]
            Swal.fire({
                icon: "success",
                title: "Se encontraron coindicencias para \n" + dni + " :",
                html: '<pre>' + stringRpta + '</pre>',
                customClass: {
                    popup: 'format-pre'
                },
                showConfirmButton: false,
                timer: 2200
            });
            $("#bloqueRespuesta").html("");
            $("#bloqueRespuesta2").html("");
            CargarTablaReferenciasCitadas(dni, anio, 12);

        }

        else if (respuesta["local"] >= 1 && respuesta["galen"] == 0) {
            let stringRpta = "Solicitud(es) en Proceso :    " + respuesta["local"]
            Swal.fire({
                icon: "success",
                title: "Se encontraron coindicencias para \n"+dni+" :",
                html: '<pre>' + stringRpta + '</pre>',
                customClass: {
                    popup: 'format-pre'
                },
                showConfirmButton: false,
                timer: 2200
            });
            $("#bloqueRespuesta").html("");
            $("#bloqueRespuesta2").html("");

            CargarTablaReferenciasProceso(dni, anio, 12);
        }

        else if (respuesta["local"] >= 1 && respuesta["galen"] >= 1) {
            let stringRpta = "Solicitud(es) en Proceso              :  " + respuesta["local"] + "\n" +
                "Solicitud(es) con Cita Registrada     :  " + respuesta["galen"] + "\n";

            Swal.fire({
                icon: "success",
                title: "Se encontraron coindicencias para \n"+dni+" :",
                html: '<pre>' + stringRpta + '</pre>',
                customClass: {
                    popup: 'format-pre'
                },
                showConfirmButton: false,
                timer: 2200
            });
            $("#bloqueRespuesta").html("");
            $("#bloqueRespuesta2").html("");

            CargarTablaReferenciasProceso(dni, anio, 12);
            CargarTablaReferenciasCitadas(dni, anio, 12);

        }

        else if (respuesta["local"] >= 0 && respuesta["galen"] == 0) {
            Swal.fire({
                icon: "error",
                title: "¡No se encontró ninguna coincidencia para su búsqueda!",
                showConfirmButton: false,
                timer: 2000
            });
            $("#bsqDoc").val("");
            $("#bsqDoc").focus();
            $("#bloqueRespuesta").html("");
            $("#bloqueRespuesta2").html("");
        }
    }).fail(function () {
        console.log("error");
    })
}
function CargarTablaReferenciasProceso(dni, anio, sizeWind) {
    $.ajax({
        url: "public/views/src/ajaxConsultas.php",
        method: "POST",
        dataType: "html",
        data: { dni2: dni, anio2: anio, sizeWind: sizeWind }
    }).done(function (respuesta) {
        $("#bloqueRespuesta").html(respuesta);
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
    }).fail(function () {
        console.log("error");
    })
}


function CargarTablaReferenciasCitadas(dni, anio, sizeWind) {
    $.ajax({
        url: "public/views/src/ajaxConsultas.php",
        method: "POST",
        dataType: "html",
        data: { dni3: dni, anio3: anio, sizeWind2: sizeWind }
    }).done(function (respuesta) {
        $("#bloqueRespuesta2").html(respuesta);
        console.log(respuesta);
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
    }).fail(function () {
        console.log("error");
    })
}