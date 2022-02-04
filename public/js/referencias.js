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
$("#rgEDni").attr("minlength", "8");
$("#rgEDni").attr("maxlength", "12");
$("#rgEDni").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});
$("#rgENombres").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#rgEApPat").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#rgEApMat").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});

$("#rgENombres").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgENombres").val(mu4);
});
$("#rgEApPat").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgEApPat").val(mu4);
});
$("#rgEApMat").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgEApMat").val(mu4);
});
$("#rgEFNac").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#rgEFNac').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});
$("#rgEFAlta").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#rgEFAlta').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});
$("#rgEFAlta").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
/** LISTADO DE EMPLEADOS */
$("#rgESueldo").inputmask('decimal', {
    rightAlign: true
});

$("#rgECargo").select2(
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
        placeholder: 'Ingrese Código o Descripción del cargo',
        ajax: {
            url: "public/views/src/ajaxCargos.php",
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
$("#rgEDni").change(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var dniEmp = $(this).val();
    var datos = new FormData();
    datos.append("dniEmp", dniEmp);
    $.ajax({
        url: "public/views/src/ajaxEmpleados.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta) {
                Toast.fire({
                    icon: "warning",
                    title: "El DNI Ingresado ya se encuentra registrado",
                });
                $("#rgEDni").val("");
                $("#rgEDni").focus();
                $("#rgENombres").val("");
                $("#rgEApPat").val("");
                $("#rgEApMat").val("");
            } else {
                $("#rgENombres").val("");
                $("#rgEApPat").val("");
                $("#rgEApMat").val("");
                $("#btnDNIEmp").on("click", function () {
                    var dni = $("#rgEDni").val();
                    if (dni.length = 8) {
                        $.ajax({
                            type: "GET",
                            url:
                                "https://dniruc.apisperu.com/api/v1/dni/" +
                                dni +
                                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            success: function (data) {

                                if (data["apellidoPaterno"] == null) {
                                    toastr.error("No se encontraron datos. Ingrese manualmente.", "DNI");
                                    $("#rgENombres").focus();
                                    $("#rgENombres").prop("readonly", false);
                                    $("#rgEApPat").prop("readonly", false);
                                    $("#rgEApMat").prop("readonly", false);
                                } else {
                                    toastr.success("Datos cargados con éxito", "DNI");
                                    $("#rgENombres").val(data["nombres"]);
                                    $("#rgEApPat").val(data["apellidoPaterno"]);
                                    $("#rgEApMat").val(data["apellidoMaterno"]);
                                    $("#rgECargo").focus();
                                    $("#rgENombres").prop("readonly", true);
                                    $("#rgEApPat").prop("readonly", true);
                                    $("#rgEApMat").prop("readonly", true);
                                }
                            },
                            failure: function (data) {
                                toastr.info("No se pudo conectar los datos", "DNI");
                            },
                            error: function (data) {
                                $("#rgENombres").prop("readonly", false);
                                $("#rgEApPat").prop("readonly", false);
                                $("#rgEApMat").prop("readonly", false);
                                $("#rgEDni").focus();
                                $('#formRegEmp').trigger("reset");
                            },
                        });
                    }
                });
            }
        },
    });
})
$.validator.addMethod(
    "valueNotEquals",
    function (value, element, arg) {
        return arg !== value;
    },
    "Value must not equal arg."
);
$("#btnRegEmp").on("click", function () {
    $("#formRegEmp").validate({
        rules: {
            rgECargo: {
                valueNotEquals: "0",
                required: true,
            },
            rgECondicion: {
                valueNotEquals: "0",
                required: true,
            },
            rgEDni: {
                required: true,
                maxlength: 12,
                minlength: 8,
            },
            rgENombres: {
                required: true,
            },
            rgEApPat: {
                required: true,
            },
            rgEApMat: {
                required: true,
            },
        },
        messages: {
            rgECargo: {
                valueNotEquals: "Selecciona un cargo",
                required: "Selecciona un cargo",
            },
            rgECondicion: {
                valueNotEquals: "Seleccion condición",
                required: "Seleccion condición",
            },
            rgEDni: {
                required: "Ingrese DNI",
                maxlength: "Ingrese máximo 12 dígitos",
                minlength: "Ingrese máximo 8 dígitos",
            },
            rgENombres: {
                required: "Ingrese nombres",
            },
            rgEApPat: {
                required: "Ingrese Apellido Paterno",
            },
            rgEApMat: {
                required: "Ingrese Apellido Materno",
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

$("#edtEDni").attr("minlength", "8");
$("#edtEDni").attr("maxlength", "12");
$("#edtEDni").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});
$("#edtENombres").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#edtEApPat").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#edtEApMat").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});

$("#edtENombres").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtENombres").val(mu4);
});
$("#edtEApPat").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtEApPat").val(mu4);
});
$("#edtEApMat").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtEApMat").val(mu4);
});
$("#edtEFNac").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#edtEFNac').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});
$("#edtEFAlta").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#edtEFAlta').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});
$("#edtEFAlta").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
/** LISTADO DE EMPLEADOS */
$("#edtESueldo").inputmask('decimal', {
    rightAlign: true
});
$(".datatableEmpleadosMR tbody").on("click", ".btnEditarEmpleado", function () {
    var idEmpleado = $(this).attr("idEmpleado");
    var datos = new FormData();
    datos.append("idEmpleado", idEmpleado);
    $.ajax({
        url: "public/views/src/ajaxEmpleados.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#idEmpleado").val(respuesta["idEmpleado"]);
            $("#edtEDni").val(respuesta["dniEmp"]);
            $("#edtEFNac").val(respuesta["fnaciEmp"]);
            $("#edtEFAlta").val(respuesta["fechaAlta"]);
            $("#edtENombres").val(respuesta["nombresEmp"]);
            $("#edtEApPat").val(respuesta["apellidosPEmp"]);
            $("#edtEApMat").val(respuesta["apellidosMEmp"]);
            $("#edtESueldo").val(respuesta["sueldoEmp"]);
            $("#seleccionCargo1").html(respuesta["codCargo"] + " - " + respuesta["descCargo"]);
            $("#edtECargo1").val(respuesta["cargoEmp"]);
            $("#edtECargo1").html(respuesta["codCargo"] + " - " + respuesta["descCargo"]);
            $("#edtECondicion1").val(respuesta["condicionEmp"]);
            $("#edtECondicion1").html(respuesta["descCondicion"]);
        },
    });
});
$("#edtECargo").select2(
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
        placeholder: 'Ingrese Código o Descripción del cargo',
        ajax: {
            url: "public/views/src/ajaxCargos.php",
            type: "post",
            dataType: "json",
            delay: 200,
            data: function (params) {
                return {
                    searchTerm: params.term,
                };
            },
            processResults: function (response) {
                $("#seleccionCargo11").remove();
                $("#seleccionCargo1").remove();
                return {
                    results: response,
                };
            },
            cache: true,
        },
    }
);
$("#edtEDni").change(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var dniEmp = $(this).val();
    var datos = new FormData();
    datos.append("dniEmp", dniEmp);
    $.ajax({
        url: "public/views/src/ajaxEmpleados.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta) {
                Toast.fire({
                    icon: "warning",
                    title: "El DNI Ingresado ya se encuentra registrado",
                });
                $("#edtEDni").val("");
                $("#edtEDni").focus();
                $("#edtENombres").val("");
                $("#edtEApPat").val("");
                $("#edtEApMat").val("");
            } else {
                $("#edtENombres").val("");
                $("#edtEApPat").val("");
                $("#edtEApMat").val("");
                $("#btnDNIEmpEdt").on("click", function () {
                    var dni = $("#edtEDni").val();
                    if (dni.length = 8) {
                        $.ajax({
                            type: "GET",
                            url:
                                "https://dniruc.apisperu.com/api/v1/dni/" +
                                dni +
                                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            success: function (data) {
                                if (data["apellidoPaterno"] == null) {
                                    toastr.error("No se encontraron datos. Ingrese manualmente.", "DNI");
                                    $("#edtENombres").focus();
                                    $("#edtENombres").prop("readonly", false);
                                    $("#edtEApPat").prop("readonly", false);
                                    $("#edtEApMat").prop("readonly", false);
                                } else {
                                    toastr.success("Datos cargados con éxito", "DNI");
                                    $("#edtENombres").val(data["nombres"]);
                                    $("#edtEApPat").val(data["apellidoPaterno"]);
                                    $("#edtEApMat").val(data["apellidoMaterno"]);
                                    $("#edtECargo").focus();
                                    $("#edtENombres").prop("readonly", true);
                                    $("#edtEApPat").prop("readonly", true);
                                    $("#edtEApMat").prop("readonly", true);
                                }

                            },
                            failure: function (data) {
                                toastr.info("No se pudo conectar los datos", "DNI");
                            },
                            error: function (data) {
                                $("#edtENombres").prop("readonly", false);
                                $("#edtEApPat").prop("readonly", false);
                                $("#edtEApMat").prop("readonly", false);
                                $("#edtEDni").focus();
                                $('#formEdtEmp').trigger("reset");
                            },
                        });
                    }
                });
            }
        },
    });
})
$("#btnEdtEmp").on("click", function () {
    $("#formEdtEmp").validate({
        rules: {
            edtECargo: {
                valueNotEquals: "0",
                required: true,
            },
            edtECondicion: {
                valueNotEquals: "0",
                required: true,
            },
            edtEDni: {
                required: true,
                maxlength: 12,
                minlength: 8,
            },
            edtENombres: {
                required: true,
            },
            edtEApPat: {
                required: true,
            },
            edtEApMat: {
                required: true,
            },
        },
        messages: {
            edtECargo: {
                valueNotEquals: "Selecciona un cargo",
                required: "Selecciona un cargo",
            },
            edtECondicion: {
                valueNotEquals: "Seleccion condición",
                required: "Seleccion condición",
            },
            edtEDni: {
                required: "Ingrese DNI",
                maxlength: "Ingrese máximo 12 dígitos",
                minlength: "Ingrese máximo 8 dígitos",
            },
            edtENombres: {
                required: "Ingrese nombres",
            },
            edtEApPat: {
                required: "Ingrese Apellido Paterno",
            },
            edtEApMat: {
                required: "Ingrese Apellido Materno",
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