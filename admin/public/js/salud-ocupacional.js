$("#rgAisCel").attr("maxlength", "9");
$("#rgAisNI").attr("maxlength", "6");
$("#rgAisCM").attr("maxlength", "6");

$("#edtAisCel").attr("maxlength", "9");
$("#edtAisNI").attr("maxlength", "6");
$("#edtAisCM").attr("maxlength", "6");

$(".datatableAislamientoMR").DataTable({
    ajax: "public/views/util/DatatableAislamientos.php",
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
$("#rgEmpAis").select2(
    {
        maximumInputLength: "12",
        minimumInputLength: "2",
        language: {
            noResults: function () {

                return "No hay resultado";
            },
            searching: function () {

                return "Buscando empleado ...";
            },
            inputTooShort: function () {
                return "Ingrese 2 o más caracteres";
            },
            inputTooLong: function () {
                return "Ingrese máximo 12 caracteres";
            }
        },
        scrollAfterSelect: true,
        placeholder: 'Ingrese DNI o Apellido del Empleado',
        ajax: {
            url: "public/views/src/ajaxEmpleados.php",
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
$("#rgfIngAis").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#rgfIngAis').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});
// /**FILTRO DE FECHAS */
$("#rgfIngAis").change(function () {
    var fechaEva = $(this).val();
    var newFechaEva = fechaEva.split("/").reverse().join("-");
    $("#fingre").val(newFechaEva);
    $("#rgAisDesde").val("");
    $("#rgAisHasta").val("");
    $("#rgAisRein").val("");
    $("#rgDiasAis").val("");

});
$("#rgAisDesde").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#rgAisDesde').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
});

$("#rgAisHasta").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#rgAisHasta').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
});
$("#rgAisRein").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#rgAisRein').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
});
$("#rgAisDesde").change(function () {
    $("#rgAisHasta").val("");
    $("#rgAisRein").val("");
    $("#rgDiasAis").val("");
    var fechaEva2 = $(this).val();
    var newFechaEva2 = fechaEva2.split("/").reverse().join("-");
    var fingre = $("#fingre").val();
    $("#fdesde1").val(newFechaEva2);
});

$("#rgAisHasta").change(function () {
    $("#rgAisRein").val("");
    $("#rgDiasAis").val("");
    var fechaEva2 = $(this).val();
    var newFechaEva2 = fechaEva2.split("/").reverse().join("-");
    var fdesde1 = $("#fdesde1").val();
    $("#fhasta1").val(newFechaEva2);

    if (newFechaEva2 < fdesde1) {
        Swal.fire({
            icon: "error",
            title: "La fecha de Fin debe ser mayor o igual a la Fecha de Inicio",
            showConfirmButton: false,
            timer: 1300
        });
        $("#rgAisHasta").focus();
        $("#rgAisHasta").val("");
    }

    else {
        calculardiasRegAis("formRegAis", "rgAisDesde", "rgAisHasta", "rgDiasAis");
    }
});

$("#rgAisRein").change(function () {
    var fechaEva2 = $(this).val();
    var newFechaEva2 = fechaEva2.split("/").reverse().join("-");
    var fhasta1 = $("#fhasta1").val();

    if (newFechaEva2 <= fhasta1) {
        Swal.fire({
            icon: "error",
            title: "La fecha de Reincorporación debe ser mayor a la Fecha de Fin",
            showConfirmButton: false,
            timer: 1300
        });
        $("#rgAisRein").focus();
        $("#rgAisRein").val("");
    }
});
function calculardiasRegAis(form, field1, field2, resultado) {
    var start = $("#" + form + " input[name='" + field1 + "']").datepicker('getDate');
    var end = $("#" + form + " input[name='" + field2 + "']").datepicker('getDate');
    if (!start || !end)
        return;
    var days = 0;
    if (start && end) {
        days = Math.floor(((end.getTime() - start.getTime()) / 86400000) + 1); // ms per day
        $("#" + resultado + "").val(days);
    }
}

$("#rgAisCel").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});
$("#rgAisNI").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgAisNI").val(mu4);
})
$("#rgAisNI").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-Z]/g, "");
});
$("#rgAisCM").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgAisCM").val(mu4);
})
$("#rgAisCM").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-Z \/]/g, "");
});
$("#rgAisMotivo").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgAisMotivo").val(mu4);
})
$("#rgAisMotivo").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ \/]/g, "");
});
$("#rgAisRecomen").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgAisRecomen").val(mu4);
})
$("#rgAisRecomen").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ \/]/g, "");
});
// /**VALIDACIÓN DE CAMPOS */
$.validator.addMethod(
    "valueNotEquals",
    function (value, element, arg) {
        return arg !== value;
    },
    "Value must not equal arg."
);
$("#btnRegAis").on("click", function () {
    $("#formRegAis").validate({
        rules: {
            rgEmpAis: {
                valueNotEquals: "0",
                required: true,
            },
            rgLocAis: {
                valueNotEquals: "0",
                required: true,
            },
            rgfIngAis: {
                required: true,
            },
            rgAisDesde: {
                required: true,
            },
            rgAisHasta: {
                required: true,
            },
            rgDiasAis: {
                required: true,
            },
            rgAisRein: {
                required: true,
            },
            rgAisMotivo: {
                valueNotEquals: "0",
                required: true,
            },
            rgAisRecomen: {
                required: true,
            },
        },
        messages: {
            rgEmpAis: {
                valueNotEquals: "Seleccione Empleado",
                required: "Seleccione Empleado",
            },
            rgLocAis: {
                valueNotEquals: "Seleccione Dpto u Oficina",
                required: "Seleccione Dpto u Oficina",
            },
            rgfIngAis: {
                required: "Fecha de Ingreso requerida",
            },
            rgAisDesde: {
                required: "Fecha de Inicio requerida",
            },
            rgAisHasta: {
                required: "Fecha de Fin requerida",
            },
            rgDiasAis: {
                required: "N° de días requeridos",
            },
            rgAisRein: {
                required: "Fecha de Reincorporación requerida",
            },
            rgAisMotivo: {
                valueNotEquals: "Seleccione motivo",
                required: "Seleccione motivo",
            },
            rgAisRecomen: {
                required: "Recomendación requerida",
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
// /**VALIDACIÓN DE CAMPOS */
// Editar Licencia
$("#edtEmpAis").select2(
    {
        maximumInputLength: "12",
        minimumInputLength: "2",
        language: {
            noResults: function () {

                return "No hay resultado";
            },
            searching: function () {

                return "Buscando empleado ...";
            },
            inputTooShort: function () {
                return "Ingrese 2 o más caracteres";
            },
            inputTooLong: function () {
                return "Ingrese máximo 12 caracteres";
            }
        },
        scrollAfterSelect: true,
        placeholder: 'Ingrese DNI o Apellido del Empleado',
        ajax: {
            url: "public/views/src/ajaxEmpleados.php",
            type: "post",
            dataType: "json",
            delay: 200,
            data: function (params) {
                return {
                    searchTerm: params.term,
                };
            },
            processResults: function (response) {
                $("#seleccionEmp11").remove();
                $("#seleccionEmp1").remove();
                return {
                    results: response,
                };
            },
            cache: true,
        },
    }
);
$("#edtfIngAis").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#edtfIngAis').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});
// /**FILTRO DE FECHAS */
$("#edtfIngAis").change(function () {
    var fechaEva = $(this).val();
    var newFechaEva = fechaEva.split("/").reverse().join("-");
    $("#edtfingre").val(newFechaEva);
    $("#edtAisDesde").val("");
    $("#edtAisHasta").val("");
    $("#edtAisRein").val("");
    $("#edtDiasAis").val("");

});
$("#edtAisDesde").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#edtAisDesde').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
});

$("#edtAisHasta").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#edtAisHasta').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
});
$("#edtAisRein").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#edtAisRein').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
});
$("#edtAisDesde").change(function () {
    $("#edtAisHasta").val("");
    $("#edtAisRein").val("");
    $("#edtDiasAis").val("");
    var fechaEva2 = $(this).val();
    var newFechaEva2 = fechaEva2.split("/").reverse().join("-");
    var fingre = $("#edtfingre").val();
    $("#edtfdesde1").val(newFechaEva2);
});

$("#edtAisHasta").change(function () {
    $("#edtAisRein").val("");
    $("#edtDiasAis").val("");
    var fechaEva2 = $(this).val();
    var newFechaEva2 = fechaEva2.split("/").reverse().join("-");
    var fdesde1 = $("#edtfdesde1").val();
    $("#edtfhasta1").val(newFechaEva2);

    if (newFechaEva2 < fdesde1) {
        Swal.fire({
            icon: "error",
            title: "La fecha de Fin debe ser mayor o igual a la Fecha de Inicio",
            showConfirmButton: false,
            timer: 1300
        });
        $("#edtAisHasta").focus();
        $("#edtAisHasta").val("");
    }
    else {
        calculardiasRegAis("formEdtAis", "edtAisDesde", "edtAisHasta", "edtDiasAis");
    }
});

$("#edtAisRein").change(function () {
    var fechaEva2 = $(this).val();
    var newFechaEva2 = fechaEva2.split("/").reverse().join("-");
    var fhasta1 = $("#edtfhasta1").val();

    if (newFechaEva2 <= fhasta1) {
        Swal.fire({
            icon: "error",
            title: "La fecha de Reincorporación debe ser mayor a la Fecha de Fin",
            showConfirmButton: false,
            timer: 1300
        });
        $("#edtAisRein").focus();
        $("#edtAisRein").val("");
    }
});

$("#edtAisCel").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});
$("#edtAisNI").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtAisNI").val(mu4);
})
$("#edtAisNI").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-Z]/g, "");
});
$("#edtAisCM").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtAisCM").val(mu4);
})
$("#edtAisCM").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-Z \/]/g, "");
});
$("#edtAisMotivo").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtAisMotivo").val(mu4);
})
$("#edtAisMotivo").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ \/]/g, "");
});
$("#edtAisRecomen").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtAisRecomen").val(mu4);
})
$("#edtAisRecomen").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ \/]/g, "");
});


$(".datatableAislamientoMR tbody").on("click", ".btnEditarSOcup", function () {
    var idAis = $(this).attr("idAis");
    var datos = new FormData();
    datos.append("idAis", idAis);
    $.ajax({
        url: "public/views/src/ajaxSaludOcupacional.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#idAis").val(respuesta["idAis"]);
            $("#edtEmpAis1").val(respuesta["empleado"]);
            $("#seleccionEmp1").html(respuesta["dniEmp"] + " - " + respuesta["apellidosPEmp"] + " " + respuesta["apellidosMEmp"] + " " + respuesta["nombresEmp"] + " || " + respuesta["descCondicion"] + " || " + respuesta["descCargo"]);

            $("#edtLocAis1").val(respuesta["idLocacion"]);
            $("#edtLocAis1").html(respuesta["descLocacion"]);

            $("#edtfIngAis").val(respuesta["fechaRegAis"]);
            $("#edtfingre").val(respuesta["fechaRegI"]);

            $("#edtAisDesde").val(respuesta["fechaInicio"]);
            $("#edtfdesde1").val(respuesta["fechaIni"]);

            $("#edtAisHasta").val(respuesta["fechaFin"]);
            $("#edtfhasta1").val(respuesta["fechaFi"]);
            $("#edtDiasAis").val(respuesta["nDias"]);
            $("#edtAisRein").val(respuesta["fechaReinc"]);

            $("#edtAisCel").val(respuesta["celular"]);
            $("#edtAisNI").val(respuesta["ni"]);
            $("#edtAisCM").val(respuesta["cm"]);

            $("#edtAisMotivo1").val(respuesta["idMotivo"]);
            $("#edtAisMotivo1").html(respuesta["descMotivo"]);

            $("#edtAisRecomen").val(respuesta["recomLic"]);
        },
    });
})
$("#btnEdtAis").on("click", function () {
    $("#formEdtAis").validate({
        rules: {
            edtEmpAis: {
                valueNotEquals: "0",
                required: true,
            },
            edtLocAis: {
                valueNotEquals: "0",
                required: true,
            },
            edtfIngAis: {
                required: true,
            },
            edtAisDesde: {
                required: true,
            },
            edtAisHasta: {
                required: true,
            },
            edtDiasAis: {
                required: true,
            },
            edtAisRein: {
                required: true,
            },
            edtAisMotivo: {
                valueNotEquals: "0",
                required: true,
            },
            edtAisRecomen: {
                required: true,
            },
        },
        messages: {
            edtEmpAis: {
                valueNotEquals: "Seleccione Empleado",
                required: "Seleccione Empleado",
            },
            edtLocAis: {
                valueNotEquals: "Seleccione Dpto u Oficina",
                required: "Seleccione Dpto u Oficina",
            },
            edtfIngAis: {
                required: "Fecha de Ingreso requerida",
            },
            edtAisDesde: {
                required: "Fecha de Inicio requerida",
            },
            edtAisHasta: {
                required: "Fecha de Fin requerida",
            },
            edtDiasAis: {
                required: "N° de días requeridos",
            },
            edtAisRein: {
                required: "Fecha de Reincorporación requerida",
            },
            edtAisMotivo: {
                valueNotEquals: "Seleccione motivo",
                required: "Seleccione motivo",
            },
            edtAisRecomen: {
                required: "Recomendación requerida",
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
$(".datatableAislamientoMR tbody").on("click", ".btnAnularLicencia", function () {
    var idAis = $(this).attr("idAis");
    var idUsuario = $("#idUsAnuSO").val();

    Swal.fire({
        title: '¿Está seguro(a) de anular el registro seleccionado?',
        text: "¡Si no lo está, puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, anular registro!'
    }).then(function (result) {
        if (result.value) {
            window.location = "index.php?ruta=salud-ocupacional&idAis=" + idAis + "&idUsuario=" + idUsuario;
        }
    })
});
// // Anular Licencia