/** LISTADO DE EMPLEADOS */
$(".datatableReferencias").DataTable({
    ajax: "public/views/util/DatatableReferencias.php",
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
/** LISTADO DE EMPLEADOS */
// Filtrado de campos

$("#rgNdoc").attr("minlength", "8");
$("#rgNdoc").attr("maxlength", "15");

$("#edtNdoc").attr("minlength", "8");
$("#edtNdoc").attr("maxlength", "15");

$("#rgNroRef").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9\-]/g, "");
});

$("#rgNdoc").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});


$("#rgNombresPac").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#rgRefAP").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#rgRefAP").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});

$("#edtNroRef").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9\-]/g, "");
});

$("#edtNdoc").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});


$("#edtNombresPac").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#edtRefAP").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#edtRefAM").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});

$("#rgNombresPac").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgNombresPac").val(mu4);
});

$("#rgRefAP").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgRefAP").val(mu4);
});

$("#rgRefAM").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgRefAM").val(mu4);
});

$("#rgRefMotivo").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgRefMotivo").val(mu4);
});

$("#edtNombresPac").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtNombresPac").val(mu4);
});

$("#edtRefAP").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtRefAP").val(mu4);
});

$("#edtRefAM").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtRefAM").val(mu4);
});

$("#edtRefMotivo").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtRefMotivo").val(mu4);
});

$("#edtFechaRef").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#edtFechaRef').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});

$("#regRefEstable").select2(
    {
        maximumInputLength: "12",
        minimumInputLength: "2",
        language: {

            noResults: function () {

                return "No hay resultado";
            },
            searching: function () {

                return "Buscando Establecimiento ...";
            },
            inputTooShort: function () {
                return "Ingrese 2 o más caracteres";
            },
            inputTooLong: function () {
                return "Ingrese máximo 12 caracteres";
            }
        },
        scrollAfterSelect: true,
        placeholder: 'Ingrese Código RENIPRESS o Nombre Establecimiento',
        ajax: {
            url: "public/views/src/ajaxReferencias.php",
            type: "post",
            dataType: "json",
            delay: 200,
            data: function (params) {
                return {
                    searchTerm: params.term,
                };
            },
            processResults: function (response) {
                return {
                    results: response,
                };
            },
            cache: true,
        },
    }
);


$("#regRefServ").select2(
    {
        maximumInputLength: "12",
        minimumInputLength: "2",
        language: {

            noResults: function () {

                return "No hay resultado";
            },
            searching: function () {

                return "Buscando Servicio/Especialidad ...";
            },
            inputTooShort: function () {
                return "Ingrese 2 o más caracteres";
            },
            inputTooLong: function () {
                return "Ingrese máximo 12 caracteres";
            }
        },
        scrollAfterSelect: true,
        placeholder: 'Ingrese nombre Servicio/Especialidad destino',
        ajax: {
            url: "public/views/src/ajaxReferencias.php",
            type: "post",
            dataType: "json",
            delay: 200,
            data: function (params) {
                return {
                    searchTerm2: params.term,
                };
            },
            processResults: function (response) {
                return {
                    results: response,
                };
            },
            cache: true,
        },
    }
);

$("#rgTipoDoc").on("change", function () {
    let comboDocPaciente = $(this).val();
    if (comboDocPaciente > 0) {
        if (comboDocPaciente == 1) {
            $("#btnDniPac").removeClass("d-none");
            $("#rgNdoc").attr("maxlength", "8");

            $("#rgNdoc").val("");
            $("#rgNombresPac").val("");
            $("#rgRefAP").val("");
            $("#rgRefAM").val("");
        }
        else {
            $("#btnDniPac").addClass("d-none");
            $("#rgNdoc").attr("maxlength", "15");
            $("#rgNdoc").val("");
            $("#rgNombresPac").val("");
            $("#rgRefAP").val("");
            $("#rgRefAM").val("");
        }
    }
    else {
        $("#btnDniPac").addClass("d-none");
        $("#rgNdoc").attr("maxlength", "8");
        $("#rgNdoc").val("");
        $("#rgNombresPac").val("");
        $("#rgRefAP").val("");
        $("#rgRefAM").val("");
    }
});
$("#btnDNIPaci").on("click", function () {
    var tipDoc = $("#rgTipoDoc").val();
    var nDoc = $("#rgNdoc").val();
    if (tipDoc == 1 && nDoc.length == 8) {
        $.ajax({
            type: "GET",
            url:
                "https://dniruc.apisperu.com/api/v1/dni/" +
                nDoc +
                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                if (data["dni"] != null) {
                    toastr.success("Datos cargados con éxito", "RENIEC");

                    $("#rgNombresPac").val(data["nombres"]);
                    $("#rgRefAP").val(data["apellidoPaterno"]);
                    $("#rgRefAM").val(data["apellidoMaterno"]);
                    $("#rgSexo").focus();
                }
                else {
                    toastr.warning("Ingrese datos manualmente", "RENIEC");

                    $("#rgNombresPac").val("");
                    $("#rgRefAP").val("");
                    $("#rgRefAM").val("");
                    $("#rgNombresPac").focus();
                }
            },
            failure: function (data) {
                toastr.info("No se pudo conectar los datos", "RENIEC");
            },
            error: function (data) {
                $("#rgNombresPac").val("");
                $("#rgRefAP").val("");
                $("#rgRefAM").val("");
                $("#rgNombresPac").focus();
            },
        });
    }
});
$.validator.addMethod(
    "valueNotEquals",
    function (value, element, arg) {
        return arg !== value;
    },
    "Value must not equal arg."
);

$("#btnRegReferencia").on("click", function () {
    $("#formRegRef").validate({
        rules: {
            rgTipoDoc: {
                valueNotEquals: "0",
                required: true,
            },
            rgSexo: {
                valueNotEquals: "0",
                required: true,
            },
            rgRefEstado: {
                valueNotEquals: "0",
                required: true,
            },
            regRefEstable: {
                valueNotEquals: "0",
                required: true,
            },
            regRefServ: {
                valueNotEquals: "0",
                required: true,
            },

            rgNdoc: {
                required: true,
                maxlength: 15,
                minlength: 8,
            },

            rgNombresPac: {
                required: true,
            },
            rgRefAP: {
                required: true,
            },
            rgRefAM: {
                required: true,
            },
            rgNroRef: {
                required: true,
            },
            rgFechaRef: {
                required: true,
            },
        },
        messages: {
            rgTipoDoc: {
                valueNotEquals: "Seleccione Tipo Documento",
                required: "Seleccione Tipo Documento",
            },
            rgSexo: {
                valueNotEquals: "Seleccione Sexo",
                required: "Seleccione Sexo",
            },
            rgRefEstado: {
                valueNotEquals: "Seleccione Estado",
                required: "Seleccione Estado",
            },
            regRefEstable: {
                valueNotEquals: "Seleccione Establecimiento",
                required: "Seleccione Establecimiento",
            },
            regRefServ: {
                valueNotEquals: "Seleccione Servicio/Especialidad",
                required: "Seleccione Servicio/Especialidad",
            },

            rgNdoc: {
                required: "Ingrese N° Documento",
                maxlength: "Ingrese máximo 15 digitos",
                minlength: "Ingrese mínimo 8 digitos",
            },

            rgNombresPac: {
                required: "Ingrese Nombres",
            },
            rgRefAP: {
                required: "Ingrese Apellido Paterno",
            },
            rgRefAM: {
                required: "Ingrese Apellido Materno",
            },
            rgNroRef: {
                required: "Ingrese N° Referencia",
            },
            rgFechaRef: {
                required: "Ingrese Fecha Referencia",
            },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
    });
});



$(".datatableReferencias tbody").on("click", ".btnEditarReferencia", function () {
    var idReferencia = $(this).attr("idReferencia");

    var datos = new FormData();
    datos.append("idReferencia", idReferencia);

    $.ajax({
        url: "public/views/src/ajaxReferencias.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            $("#idReferencia").val(respuesta["idReferencia"]);
            $("#edtTipoDoc1").val(respuesta["idTipoDoc"]);
            $("#edtTipoDoc1").html(respuesta["nombreTipDoc"]);

            $("#edtNombresPac").val(respuesta["nombres"]);
            $("#edtNdoc").val(respuesta["nroDoc"]);
            $("#edtRefAP").val(respuesta["apePaterno"]);
            $("#edtRefAM").val(respuesta["apeMaterno"]);

            $("#edtSexo1").val(respuesta["idSexo"]);
            $("#edtSexo1").html(respuesta["descSexo"]);

            $("#edtNroRef").val(respuesta["nroHojaRef"]);
            $("#edtFechaRef").val(respuesta["fechaReferencia"]);

            $("#edtRefEstado1").val(respuesta["idEstado"]);
            $("#edtRefEstado1").html(respuesta["descEstado"]);

            // 05735 - C.S. PROGRESO - LIMA/LIMA/CARABAYLLO
            $("#seleccionEESS1").html(respuesta["codigoEstab"] + " - " + respuesta["nombreEstablecimiento"]+ " - " + respuesta["ubicacion"]);
            $("#edtRefEstable1").val(respuesta["idEstablecimiento"]);
            $("#edtRefEstable1").html(respuesta["nombreEstablecimiento"]);


            $("#seleccionServ1").html(respuesta["descripcion"]);

            $("#edtRefServ1").val(respuesta["idServicio"]);
            $("#edtRefServ1").html(respuesta["descripcion"]);

            $("#edtRefMotivo").val(respuesta["motivo"]);
        },
    });
});

$("#edtRefEstable").select2(
    {
        maximumInputLength: "12",
        minimumInputLength: "2",
        language: {

            noResults: function () {

                return "No hay resultado";
            },
            searching: function () {

                return "Buscando Establecimiento ...";
            },
            inputTooShort: function () {
                return "Ingrese 2 o más caracteres";
            },
            inputTooLong: function () {
                return "Ingrese máximo 12 caracteres";
            }
        },
        scrollAfterSelect: true,
        placeholder: 'Ingrese Código RENIPRESS o Nombre Establecimiento',
        ajax: {
            url: "public/views/src/ajaxReferencias.php",
            type: "post",
            dataType: "json",
            delay: 200,
            data: function (params) {
                return {
                    searchTerm3: params.term,
                };
            },
            processResults: function (response) {
                $("#seleccionEESS11").remove();
                $("#seleccionEESS1").remove();
                return {
                    results: response,
                };
            },
            cache: true,
        },
    }
);


$("#edtRefServ").select2(
    {
        maximumInputLength: "12",
        minimumInputLength: "2",
        language: {

            noResults: function () {

                return "No hay resultado";
            },
            searching: function () {

                return "Buscando Servicio/Especialidad ...";
            },
            inputTooShort: function () {
                return "Ingrese 2 o más caracteres";
            },
            inputTooLong: function () {
                return "Ingrese máximo 12 caracteres";
            }
        },
        scrollAfterSelect: true,
        placeholder: 'Ingrese nombre Servicio/Especialidad destino',
        ajax: {
            url: "public/views/src/ajaxReferencias.php",
            type: "post",
            dataType: "json",
            delay: 200,
            data: function (params) {
                return {
                    searchTerm4: params.term,
                };
            },
            processResults: function (response) {
                $("#seleccionServ1").remove();
                $("#seleccionServ11").remove();
                return {
                    results: response,
                };
            },
            cache: true,
        },
    }
);
$(".datatableEmpleadosMR tbody").on("click", ".btnEliminarEmpleado", function () {
    var idEmpleado = $(this).attr("idEmpleado");
    Swal.fire({
        title: '¿Está seguro(a) de eliminar al empleado(a)?',
        text: "¡Si no lo está, puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminar empleado!'
    }).then(function (result) {
        if (result.value) {
            window.location = "index.php?ruta=empleados&idEmpleado=" + idEmpleado;
        }
    })
});