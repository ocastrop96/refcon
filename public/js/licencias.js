/** LISTADO DE LICENCIAS */
cargarMeses("rgMMedico")
$(".datatableLicenciasMR").DataTable({
    ajax: "public/views/util/DatatableLicencias.php",
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
$("#rgCITT").attr("maxlength", "17");
$("#rgObserva").attr("maxlength", "200");
$("#edtCITT").attr("maxlength", "17");
$("#edtObserva").attr("maxlength", "200");
$("#rgAMedico").datepicker({
    'format': "yyyy",
    'viewMode': "years",
    'minViewMode': "years",
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});
/** LISTADO DE LICENCIAS */
// Carga Lista de Años
function cargarMeses(combo2) {
    var activ2 = 1;
    $.ajax({
        url: "public/views/src/ajaxUtilitarios.php",
        method: "POST",
        dataType: "html",
        data: { activ2: activ2 }
    }).done(function (respuesta) {
        $("#" + combo2 + "").html(respuesta);
    }).fail(function () {
        console.log("error");
    });
}
// Carga Lista de Años
$("#rgEmp").select2(
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
$("#rgfIngreso").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#rgfIngreso').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});
$("#rgFDoc").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#rgFDoc').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});
$("#rgfDesde").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#rgfDesde').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    // 'endDate': new Date(),
});

$("#rgfHasta").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#rgfHasta').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    // 'endDate': new Date(),
});
/**FILTRO DE FECHAS */
$("#rgfDesde").change(function () {
    var fechaEva = $(this).val();
    var newFechaEva = fechaEva.split("/").reverse().join("-");
    $("#fdesde").val(newFechaEva);
    $("#rgNDias").val("");
});

$("#rgfHasta").change(function () {
    var fechaEva2 = $(this).val();
    var newFechaEva2 = fechaEva2.split("/").reverse().join("-");
    var fevOr2 = $("#fdesde").val();
    $("#fhasta").val(newFechaEva2);

    if (newFechaEva2 < fevOr2) {
        Swal.fire({
            icon: "error",
            title: "La fecha de Fin debe ser mayor o igual que la Fecha de Inicio",
            showConfirmButton: false,
            timer: 1300
        });
        $("#rgfHasta").focus();
        $("#rgfHasta").val("");
    }
    else {
        calculardiasRegLic("formRegLic", "rgfDesde", "rgfHasta", "rgNDias");
    }
});
function calculardiasRegLic(form, field1, field2, resultado) {
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
/**FILTRO DE FECHAS */
/**Filtrado tipo de entidades */
$("#rgTipEnt").on("change", function () {
    let comboTipEnt = $(this).val();
    $("#rgNRuc").prop('readonly', false);
    $("#rgNRuc").val("");
    $("#rgNomEnt").prop('readonly', false);
    $("#rgNomEnt").val("");
    $("#rgCMP").prop('readonly', false);
    $("#rgCMP").val("");
    $("#rgNomMed").prop('readonly', false);
    $("#rgNomMed").val("");
    if (comboTipEnt > 0) {
        var datos = new FormData();
        datos.append("tipoEnt", comboTipEnt);
        $.ajax({
            url: "public/views/src/ajaxLicencias.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta) {
                    if (comboTipEnt == 1) {
                        $("#rgNRuc").prop('readonly', true);
                        $("#rgNRuc").val(respuesta["rucEntidad"]);
                        $("#rgNomEnt").prop('readonly', true);
                        $("#rgNomEnt").val(respuesta["descEntidad"]);
                        $("#rgCMP").focus();
                        $("#rgServ").val("");
                        $("#rgServ").prop('readonly', false);
                    }
                    else if (comboTipEnt == 2) {
                        $("#rgNRuc").prop('readonly', true);
                        $("#rgNRuc").val(respuesta["rucEntidad"]);
                        $("#rgNomEnt").prop('readonly', false);
                        $("#rgNomEnt").focus();
                        $("#rgServ").val("");
                        $("#rgServ").prop('readonly', false);
                    }
                    else if (comboTipEnt == 3) {
                        $("#rgNRuc").prop('readonly', false);
                        $("#rgNRuc").val(respuesta["rucEntidad"]);
                        $("#rgNomEnt").prop('readonly', false);
                        $("#rgNomEnt").val(respuesta["descEntidad"]);
                        $("#rgNRuc").focus();
                        $("#rgServ").val("");
                        $("#rgServ").prop('readonly', false);
                    }
                    else if (comboTipEnt == 4) {
                        $("#rgNRuc").prop('readonly', true);
                        $("#rgNRuc").val(respuesta["rucEntidad"]);
                        $("#rgNomEnt").prop('readonly', true);
                        $("#rgNomEnt").val(respuesta["descEntidad"]);
                        $("#rgCMP").prop('readonly', true);
                        $("#rgCMP").val(respuesta["cipMed"]);
                        $("#rgNomMed").prop('readonly', true);
                        $("#rgNomMed").val(respuesta["nombresMed"]);
                        $("#rgServ").prop('readonly', true);
                        $("#rgServ").val("SALUD OCUPACIONAL");
                        $("#rgCieDX").focus();
                    }
                    else if (comboTipEnt == 5) {
                        $("#rgNRuc").prop('readonly', false);
                        $("#rgNRuc").val(respuesta["rucEntidad"]);
                        $("#rgNomEnt").prop('readonly', false);
                        $("#rgNomEnt").val(respuesta["descEntidad"]);
                        $("#rgNRuc").focus();
                        $("#rgServ").val("");
                        $("#rgServ").prop('readonly', false);
                    }
                }
            },
        });


    }
});
/**Filtrado tipo de entidades */
/** Búsque datos con RUC */
$("#btnRUCEnt").click(function () {
    var tipo = $("#rgTipEnt").val();
    var nruc = $("#rgNRuc").val();
    if (tipo == 3 && nruc.length == 11) {
        $.ajax({
            type: "GET",
            url:
                "https://dniruc.apisperu.com/api/v1/ruc/" +
                nruc +
                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                if (data["ruc"] != null) {
                    toastr.success("Datos cargados con éxito", "SUNAT");
                    $("#rgNRuc").val(data["ruc"]);
                    $("#rgNomEnt").val(data["razonSocial"]);
                    $("#rgNomEnt").prop("readonly", true);
                    $("#rgCMP").focus();
                }
                else {
                    toastr.warning("Ingrese datos manualmente", "SUNAT");
                    $("#rgNRuc").val("");
                    $("#rgNomEnt").val("");
                    $("#rgNRuc").focus();
                }
            },
            failure: function (data) {
                toastr.info("No se pudo conectar los datos", "SUNAT");
            },
            error: function (data) {
                $("#rgNRuc").val("");
                $("#rgNomEnt").val("");
                $("#rgNRuc").focus();
            },
        });
    }
    else if (tipo == 5 && nruc.length == 11) {
        $.ajax({
            type: "GET",
            url:
                "https://dniruc.apisperu.com/api/v1/ruc/" +
                nruc +
                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                if (data["ruc"] != null) {
                    toastr.success("Datos cargados con éxito", "SUNAT");
                    $("#rgNRuc").val(data["ruc"]);
                    $("#rgNomEnt").val(data["razonSocial"]);
                    $("#rgNomEnt").prop("readonly", true);
                    $("#rgCMP").focus();
                }
                else {
                    toastr.warning("Ingrese datos manualmente", "SUNAT");
                    $("#rgNRuc").val("");
                    $("#rgNomEnt").val("");
                    $("#rgNRuc").focus();
                }
            },
            failure: function (data) {
                toastr.info("No se pudo conectar los datos", "SUNAT");
            },
            error: function (data) {
                $("#rgNRuc").val("");
                $("#rgNomEnt").val("");
                $("#rgNRuc").focus();
            },
        });
    }
});
/** Búsque datos con RUC */
/**Búsqueda de Diagnosticos */
$("#btnDxCarga1").click(function () {
    var dato1 = $("#searchDx").val();
    if (dato1 != '') {
        mostrarDxs(dato1);
    }
});
function mostrarDxs(dato1) {
    $.ajax({
        url: "public/views/src/ajaxDiagnosticos.php",
        method: "POST",
        dataType: "html",
        data: { dato1: dato1 }
    }).done(function (respuesta) {
        $("#dataDx").html(respuesta);
    }).fail(function () {
        console.log("error");
    })
}
function cargaDatosDx(idDiagnostico) {
    var idDx = idDiagnostico;
    var datos = new FormData();
    datos.append("dato2", idDx);
    $.ajax({
        url: "public/views/src/ajaxDiagnosticos.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta) {
                console.log(respuesta);
                $("#rgCieDX").val(respuesta["CodigoCIE10"].trim());
                $("#rgDesDX").val((respuesta["Descripcion"]).toUpperCase());
                $("#modal-busqueda-dx").modal("hide");
                $("#searchDx").val("");
                $("#dataDx").html("");
            }
        },
    });
}
/**Búsqueda de Diagnosticos */
/**FORMATEO DE CAMPOS */
$("#rgNRuc").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});
$("#rgNomEnt").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgNomEnt").val(mu4);
})
$("#rgNomEnt").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-]/g, "");
});
$("#rgCMP").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});
$("#rgNomMed").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#rgNomMed").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgNomMed").val(mu4);
})
$("#rgServ").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#rgServ").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgServ").val(mu4);
})
$("#rgCITT").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-]/g, "");
});
$("#rgCITT").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgCITT").val(mu4);
})
$("#rgNDoc").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-°.]/g, "");
});
$("#rgNDoc").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgNDoc").val(mu4);
})
$("#rgDescip").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-°.]/g, "");
});
$("#rgDescip").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgDescip").val(mu4);
})
$("#rgDesDX").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-°.,+/]/g, "");
});
$("#rgDesDX").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgDesDX").val(mu4);
})
$("#rgObserva").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-°.]/g, "");
});
$("#rgObserva").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgObserva").val(mu4);
})
/**FORMATEO DE CAMPOS */
/**VALIDACIÓN DE CAMPOS */
$.validator.addMethod(
    "valueNotEquals",
    function (value, element, arg) {
        return arg !== value;
    },
    "Value must not equal arg."
);
$("#btnRegLic").on("click", function () {
    $("#formRegLic").validate({
        rules: {
            rgEmp: {
                valueNotEquals: "0",
                required: true,
            },
            rgfIngreso: {
                required: true,
            },
            rgfDesde: {
                required: true,
            },
            rgfHasta: {
                required: true,
            },
            rgNDias: {
                required: true,
            },
            rgAMedico: {
                valueNotEquals: "0",
                required: true,
            },
            rgTipEnt: {
                valueNotEquals: "0",
                required: true,
            },
            rgDesDX: {
                required: true,
            },
            rgEstado: {
                valueNotEquals: "0",
                required: true,
            },
        },
        messages: {
            rgEmp: {
                valueNotEquals: "Seleccione Empleado solicitante",
                required: "Seleccione Empleado solicitante",
            },
            rgfIngreso: {
                required: "Ingrese Fecha Ingreso",
            },
            rgfDesde: {
                required: "Ingrese Fecha Inicio",
            },
            rgfHasta: {
                required: "Ingrese Fecha Fin",
            },
            rgNDias: {
                required: "Ingrese N° de días",
            },
            rgAMedico: {
                valueNotEquals: "Seleccione Año",
                required: "Seleccione Año",
            },
            rgTipEnt: {
                valueNotEquals: "Seleccione Tipo Entidad",
                required: "Seleccione Tipo Entidad",
            },
            rgDesDX: {
                required: "Ingrese descripción de Diagnóstico",
            },
            rgEstado: {
                valueNotEquals: "Seleccione Estado de Solicitud",
                required: "Seleccione Estado de Solicitud",
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
/**VALIDACIÓN DE CAMPOS */
// Editar Licencia
$(".datatableLicenciasMR tbody").on("click", ".btnEditarLicencia", function () {
    var idLicencia = $(this).attr("idLicencia");
    var datos = new FormData();
    datos.append("idLicencia", idLicencia);
    $.ajax({
        url: "public/views/src/ajaxLicencias.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#idLicencia").val(respuesta["idLicencia"]);
            $("#correlativoEdt").html(respuesta["correlativoLic"]);
            $("#idEmpleado").val(respuesta["empleado"]);
            $("#edtEmp").val(respuesta["dniEmp"] + " - " + respuesta["apellidosPEmp"] + " " + respuesta["apellidosMEmp"] + " " + respuesta["nombresEmp"] + " || " + respuesta["descCondicion"] + " || " + respuesta["descCargo"]);
            $("#edtfIngreso").val(respuesta["fechaIngreso"]);
            $("#edfdesde").val(respuesta["finic"]);
            $("#edtfDesde").val(respuesta["fechaInicio"]);
            $("#edtfHasta").val(respuesta["fechaFin"]);
            $("#edtNDias").val(respuesta["NDias"]);
            $("#edtNDiasA").val(respuesta["NDias"]);
            $("#edtAMedico").val(respuesta["anioMedico"]);
            $("#edtAMedicoR").val(respuesta["anioMedico"]);
            $("#edtMMedicoA").val(respuesta["mesMedico"]);

            $("#edtMMedico1").val(respuesta["mesMedico"]);
            if (respuesta["mesMedico"] != 0) {
                $("#edtMMedico1").html(respuesta["descMes"]);
            } else {
                $("#edtMMedico1").html("SIN MES");
            }
            $("#edtTipEnt1").val(respuesta["entidad"]);
            $("#edtTipEnt1").html(respuesta["descTipoEnt"]);

            $("#edtNRuc").val(respuesta["rucEntidad"]);

            $("#edtNomEnt").val(respuesta["nombEntidad"]);
            $("#edtCMP").val(respuesta["cipMed"]);
            $("#edtNomMed").val(respuesta["nombresMed"]);
            $("#edtCieDX").val(respuesta["diagnostico"]);
            $("#edtDesDX").val(respuesta["descDiagnostico"]);
            $("#edtServ").val(respuesta["servicionAte"]);
            $("#edtCITT").val(respuesta["citt"]);

            $("#edtEstado1").val(respuesta["estadoLic"]);
            $("#edtEstado1").html(respuesta["descEstLic"]);


            $("#edtTipDoc1").val(respuesta["tipDoc"]);
            if (respuesta["descripDoc"] == null) {
                $("#edtTipDoc1").html("Seleccione Tipo Documento");
            }
            else {
                $("#edtTipDoc1").html(respuesta["descTipoDoc"]);
            }

            if (respuesta["estadoLic"] == 2) {
                $("#blcDoc1").removeClass("d-none");
                $("#blcDoc2").removeClass("d-none");
            }
            else {
                $("#blcDoc1").addClass("d-none");
                $("#blcDoc2").addClass("d-none");
            }
            $("#edtNDoc").val(respuesta["nroDoc"]);
            $("#edtFDoc").val(respuesta["fechaDoc"]);
            $("#edtDescip").val(respuesta["descripDoc"]);
            $("#edtObserva").val(respuesta["observaciones"]);

        },
    });
})

$("#edtNRuc").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});
$("#edtNomEnt").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtNomEnt").val(mu4);
})
$("#edtNomEnt").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-.]/g, "");
});
$("#edtCMP").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});
$("#edtNomMed").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#edtNomMed").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtNomMed").val(mu4);
})
$("#edtServ").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#edtServ").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtServ").val(mu4);
})
$("#edtCITT").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-]/g, "");
});
$("#edtCITT").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtCITT").val(mu4);
})
$("#edtNDoc").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-°.]/g, "");
});
$("#edtNDoc").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtNDoc").val(mu4);
})
$("#edtDescip").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-°.]/g, "");
});
$("#edtDescip").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtDescip").val(mu4);
})
$("#edtDesDX").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-°.,+/]/g, "");
});
$("#edtDesDX").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtDesDX").val(mu4);
})
$("#edtObserva").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-°.]/g, "");
});
$("#edtObserva").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtObserva").val(mu4);
});

$("#edtfIngreso").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#edtfIngreso').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});
$("#edtFDoc").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#edtFDoc').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date(),
});
$("#edtfDesde").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#edtfDesde').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
});

$("#edtfHasta").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#edtfHasta').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
});

/**FILTRO DE FECHAS */
$("#edtfDesde").change(function () {
    var fechaEva = $(this).val();
    var newFechaEva = fechaEva.split("/").reverse().join("-");
    $("#edfdesde").val(newFechaEva);
    $("#edtNDias").val("");
    $("#edtfHasta").val("");
});

$("#edtfHasta").change(function () {
    var fechaEva2 = $(this).val();
    var newFechaEva2 = fechaEva2.split("/").reverse().join("-");
    var fevOr2 = $("#edfdesde").val();
    $("#edfhasta").val(newFechaEva2);

    if (newFechaEva2 < fevOr2) {
        Swal.fire({
            icon: "error",
            title: "La fecha de Fin debe ser mayor o igual que la Fecha de Inicio",
            showConfirmButton: false,
            timer: 1300
        });
        $("#edtfHasta").focus();
        $("#edtfHasta").val("");
    }
    else {
        calculardiasRegLic2("formEdtLic", "edtfDesde", "edtfHasta", "edtNDias");
    }
});
function calculardiasRegLic2(form, field1, field2, resultado) {
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
$("#modal-editar-licencia").on('hidden.bs.modal', function (e) {
    window.location = "licencias";
});
$("#edtTipEnt").on("change", function () {
    let comboTipEnt = $(this).val();
    $("#edtNRuc").prop('readonly', false);
    $("#edtNRuc").val("");
    $("#edtNomEnt").prop('readonly', false);
    $("#edtCMP").prop('readonly', false);
    $("#edtNomMed").prop('readonly', false);
    if (comboTipEnt > 0) {
        var datos = new FormData();
        datos.append("tipoEnt", comboTipEnt);
        $.ajax({
            url: "public/views/src/ajaxLicencias.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta) {
                    if (comboTipEnt == 1) {
                        $("#edtNRuc").prop('readonly', true);
                        $("#edtNRuc").val(respuesta["rucEntidad"]);
                        $("#edtNomEnt").prop('readonly', true);
                        $("#edtNomEnt").val(respuesta["descEntidad"]);
                        $("#edtServ").val("");
                        $("#edtServ").prop('readonly', false);
                        $("#edtCMP").focus();
                    }
                    else if (comboTipEnt == 2) {
                        $("#edtNRuc").prop('readonly', true);
                        $("#edtNRuc").val(respuesta["rucEntidad"]);
                        $("#edtNomEnt").val("");
                        $("#edtNomEnt").prop('readonly', false);
                        $("#edtServ").val("");
                        $("#edtServ").prop('readonly', false);
                        $("#edtNomEnt").focus();
                    }
                    else if (comboTipEnt == 3) {
                        $("#edtNRuc").prop('readonly', false);
                        $("#edtNRuc").val(respuesta["rucEntidad"]);
                        $("#edtNomEnt").prop('readonly', false);
                        $("#edtNomEnt").val("");
                        $("#edtServ").prop('readonly', false);
                        $("#edtServ").val("");
                        $("#edtNomEnt").val(respuesta["descEntidad"]);
                        $("#edtNRuc").focus();
                    }
                    else if (comboTipEnt == 4) {
                        $("#edtNRuc").prop('readonly', true);
                        $("#edtNRuc").val(respuesta["rucEntidad"]);
                        $("#edtNomEnt").prop('readonly', true);
                        $("#edtNomEnt").val(respuesta["descEntidad"]);
                        $("#edtCMP").prop('readonly', true);
                        $("#edtCMP").val(respuesta["cipMed"]);
                        $("#edtNomMed").prop('readonly', true);
                        $("#edtNomMed").val(respuesta["nombresMed"]);
                        $("#edtServ").prop('readonly', true);
                        $("#edtServ").val("SALUD OCUPACIONAL");
                        $("#edtCieDX").focus();
                    }
                    else if (comboTipEnt == 5) {
                        $("#edtNRuc").prop('readonly', false);
                        $("#edtNRuc").val(respuesta["rucEntidad"]);
                        $("#edtNomEnt").prop('readonly', false);
                        $("#edtNomEnt").val("");
                        $("#edtServ").prop('readonly', false);
                        $("#edtServ").val("");
                        $("#edtNomEnt").val(respuesta["descEntidad"]);
                        $("#edtNRuc").focus();
                    }
                }
            },
        });


    }
});
$("#btnRUCEntEdt").click(function () {
    var tipo = $("#edtTipEnt").val();
    var nruc = $("#edtNRuc").val();
    if (tipo == 3 && nruc.length == 11) {
        $.ajax({
            type: "GET",
            url:
                "https://dniruc.apisperu.com/api/v1/ruc/" +
                nruc +
                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                if (data["ruc"] != null) {
                    toastr.success("Datos cargados con éxito", "SUNAT");
                    $("#edtNRuc").val(data["ruc"]);
                    $("#edtNomEnt").val(data["razonSocial"]);
                    $("#edtNomEnt").prop("readonly", true);
                    $("#edtCMP").focus();
                }
                else {
                    toastr.warning("Ingrese datos manualmente", "SUNAT");
                    $("#edtNRuc").val("");
                    $("#edtNomEnt").val("");
                    $("#edtNRuc").focus();
                }
            },
            failure: function (data) {
                toastr.info("No se pudo conectar los datos", "SUNAT");
            },
            error: function (data) {
                $("#edtNRuc").val("");
                $("#edtNomEnt").val("");
                $("#edtNRuc").focus();
            },
        });
    }
    else if (tipo == 5 && nruc.length == 11) {
        $.ajax({
            type: "GET",
            url:
                "https://dniruc.apisperu.com/api/v1/ruc/" +
                nruc +
                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                if (data["ruc"] != null) {
                    toastr.success("Datos cargados con éxito", "SUNAT");
                    $("#edtNRuc").val(data["ruc"]);
                    $("#edtNomEnt").val(data["razonSocial"]);
                    $("#edtNomEnt").prop("readonly", true);
                    $("#edtCMP").focus();
                }
                else {
                    toastr.warning("Ingrese datos manualmente", "SUNAT");
                    $("#edtNRuc").val("");
                    $("#edtNomEnt").val("");
                    $("#edtNRuc").focus();
                }
            },
            failure: function (data) {
                toastr.info("No se pudo conectar los datos", "SUNAT");
            },
            error: function (data) {
                $("#edtNRuc").val("");
                $("#edtNomEnt").val("");
                $("#edtNRuc").focus();
            },
        });
    }
});
$("#btnDxCarga2").click(function () {
    var dato1 = $("#searchDx2").val();
    if (dato1 != '') {
        mostrarDxs2(dato1);
    }
});
function mostrarDxs2(dato3) {
    $.ajax({
        url: "public/views/src/ajaxDiagnosticos.php",
        method: "POST",
        dataType: "html",
        data: { dato3: dato3 }
    }).done(function (respuesta) {
        $("#dataDx2").html(respuesta);
    }).fail(function () {
        console.log("error");
    })
}
function cargaDatosDx2(idDiagnostico) {
    var idDx = idDiagnostico;
    var datos = new FormData();
    datos.append("dato2", idDx);
    $.ajax({
        url: "public/views/src/ajaxDiagnosticos.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta) {
                console.log(respuesta);
                $("#edtCieDX").val(respuesta["CodigoCIE10"].trim());
                $("#edtDesDX").val(respuesta["Descripcion"]);
                $("#modal-busqueda-dx2").modal("hide");
                $("#searchDx2").val("");
                $("#dataDx2").html("");
            }
        },
    });
}
$("#btnEdtLic").on("click", function () {
    $("#formEdtLic").validate({
        rules: {
            rgEmp: {
                valueNotEquals: "0",
                required: true,
            },
            edtfIngreso: {
                required: true,
            },
            edtfDesde: {
                required: true,
            },
            edtfHasta: {
                required: true,
            },
            edtNDias: {
                required: true,
            },
            edtAMedico: {
                valueNotEquals: "0",
                required: true,
            },
            edtTipEnt: {
                valueNotEquals: "0",
                required: true,
            },
            edtDesDX: {
                required: true,
            },
            edtEstado: {
                valueNotEquals: "0",
                required: true,
            },
        },
        messages: {
            edtEmp: {
                valueNotEquals: "Seleccione Empleado solicitante",
                required: "Seleccione Empleado solicitante",
            },
            edtfIngreso: {
                required: "Ingrese Fecha Ingreso",
            },
            edtfDesde: {
                required: "Ingrese Fecha Inicio",
            },
            edtfHasta: {
                required: "Ingrese Fecha Fin",
            },
            edtNDias: {
                required: "Ingrese N° de días",
            },
            edtAMedico: {
                valueNotEquals: "Seleccione Año",
                required: "Seleccione Año",
            },
            edtTipEnt: {
                valueNotEquals: "Seleccione Tipo Entidad",
                required: "Seleccione Tipo Entidad",
            },
            edtDesDX: {
                required: "Ingrese descripción de Diagnóstico",
            },
            edtEstado: {
                valueNotEquals: "Seleccione Estado de Solicitud",
                required: "Seleccione Estado de Solicitud",
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

$("#edtEstado").click(function () {
    var estadoMod = $(this).val();
    if (estadoMod == 2) {
        $("#blcDoc1").removeClass("d-none");
        $("#blcDoc2").removeClass("d-none");
    }
    else {
        $("#blcDoc1").addClass("d-none");
        $("#blcDoc2").addClass("d-none");
    }
})
// Editar Licencia
// Anular Licencia
$(".datatableLicenciasMR tbody").on("click", ".btnAnularLicencia", function () {
    var idLicencia = $(this).attr("idLicencia");
    var nDias = $(this).attr("nDias");
    var idUsuario = $("#idUsuarioAnu").val();

    Swal.fire({
        title: '¿Está seguro(a) de anular la Licencia?',
        text: "¡Si no lo está, puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, anular licencia!'
    }).then(function (result) {
        if (result.value) {
            window.location = "index.php?ruta=licencias&idLicencia=" + idLicencia + "&nDias=" + nDias + "&idUsuario=" + idUsuario;
        }
    })
});
// Anular Licencia