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

// $(".datatableReferenciasProceso tbody").on("click", ".btnVerMotivo", function () {
//     var idReferencia = $(this).attr("idReferencia");

//     var datos = new FormData();
//     datos.append("idReferencia", idReferencia);
//     alert("xd");
//     // $.ajax({
//     //     url: "public/views/src/ajaxConsultas.php",
//     //     method: "POST",
//     //     data: datos,
//     //     cache: false,
//     //     contentType: false,
//     //     processData: false,
//     //     dataType: "json",
//     //     success: function (respuesta) {
//     //         console.log(respuesta);
//     //         // $("#idReferencia").val(respuesta["idReferencia"]);

//     //         // if (respuesta["idTipoDoc"] == 1) {
//     //         //     $("#btnDniPacEdt").removeClass("d-none");

//     //         // }
//     //         // else {
//     //         //     $("#btnDniPacEdt").addClass("d-none");

//     //         // }
//     //         // $("#edtTipoDoc1").val(respuesta["idTipoDoc"]);
//     //         // $("#edtTipoDoc1").html(respuesta["nombreTipDoc"]);

//     //         // $("#edtNombresPac").val(respuesta["nombres"]);
//     //         // $("#edtNdoc").val(respuesta["nroDoc"]);
//     //         // $("#edtRefAP").val(respuesta["apePaterno"]);
//     //         // $("#edtRefAM").val(respuesta["apeMaterno"]);

//     //         // $("#edtSexo1").val(respuesta["idSexo"]);
//     //         // $("#edtSexo1").html(respuesta["descSexo"]);

//     //         // $("#edtNroRefAnt").val(respuesta["nroHojaRef"]);

//     //         // $("#edtNroRef").val(respuesta["nroHojaRef"]);

//     //         // $("#edtFechaRef").val(respuesta["fechaReferencia"]);

//     //         // $("#edtRefEstado1").val(respuesta["idEstado"]);
//     //         // $("#edtRefEstado1").html(respuesta["descEstado"]);

//     //         // // 05735 - C.S. PROGRESO - LIMA/LIMA/CARABAYLLO
//     //         // $("#seleccionEESS1").html(respuesta["codigoEstab"] + " - " + respuesta["nombreEstablecimiento"] + " - " + respuesta["ubicacion"]);
//     //         // $("#edtRefEstable1").val(respuesta["idEstablecimiento"]);
//     //         // $("#edtRefEstable1").html(respuesta["nombreEstablecimiento"]);

//     //         // $("#seleccionServ1").html(respuesta["nombreEsp"]);

//     //         // $("#edtRefServ1").val(respuesta["idEspecialidad"]);
//     //         // $("#edtRefServ1").html(respuesta["nombreEsp"]);

//     //         // $("#edtRefMotivo").val(respuesta["motivo"]);
//     //         // $("#edtRefAnamnesis").val(respuesta["anamnesis"]);

//     //     },
//     // });
// });


function VerMotivo(idReferencia) {
    // alert(idReferencia);
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
        data: { dni2: dni, anio2: anio }
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