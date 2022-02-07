/** LISTADO DE CARGOS */
$("#rgCodCar").attr("maxlength", "4");
$("#edtCodCar").attr("maxlength", "4");

$(".datatableCargosMR").DataTable({
    ajax: "public/views/util/DatatableCargos.php",
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
/** LISTADO DE CARGOS */
$("#rgCodCar").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-Z]/g, "");
});
$("#edtCodCar").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-Z]/g, "");
});
$("#rgDetaCar").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-().*]/g, "");
});
$("#edtDetaCar").keyup(function () {
    this.value = (this.value + "").replace(/[^a-z0-9A-ZñÑáéíóúüÁÉÍÓÚÜ \-().*]/g, "");
});
$("#rgCodCar").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgCodCar").val(mu4);
});
$("#edtCodCar").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtCodCar").val(mu4);
});
$("#rgDetaCar").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#rgDetaCar").val(mu4);
});
$("#edtDetaCar").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toUpperCase();
    $("#edtDetaCar").val(mu4);
});
$(".datatableCargosMR tbody").on("click", ".btnEditarCargo", function () {
    var idCargo = $(this).attr("idCargo");
    var datos = new FormData();
    datos.append("idCargo", idCargo);
    $.ajax({
        url: "public/views/src/ajaxCargos.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            $("#idCargo").val(respuesta["idCargo"]);
            $("#edtCodCar").val(respuesta["codCargo"]);
            $("#edtDetaCar").val(respuesta["descCargo"]);
        },
    });
});

$("#btnRegCargo").on("click", function () {
    $("#formRegCargo").validate({
        rules: {
            rgDetaCar: {
                required: true,
            },

        },
        messages: {
            rgDetaCar: {
                required: "Ingrese detalle de cargo",
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
$("#btnEdtCargo").on("click", function () {
    $("#formEdtCargo").validate({
        rules: {
            edtDetaCar: {
                required: true,
            },

        },
        messages: {
            edtDetaCar: {
                required: "Ingrese detalle de cargo",
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
$(".datatableCargosMR tbody").on("click", ".btnEliminarCargo", function () {
    var idCargo = $(this).attr("idCargo");
    Swal.fire({
        title: '¿Está seguro(a) de eliminar el cargo?',
        text: "¡Si no lo está, puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, eliminar cargo!'
    }).then(function (result) {
        if (result.value) {
            window.location = "index.php?ruta=cargos&idCargo=" + idCargo;
        }
    })
})
$("#rgCodCar").change(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var codigo = $(this).val();
    var datos = new FormData();
    datos.append("codigo", codigo);
    if (codigo != "SCD") {
        $.ajax({
            url: "public/views/src/ajaxCargos.php",
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
                        title: "El Código Ingresado ya se encuentra registrado",
                    });
                    $("#rgCodCar").val("");
                    $("#rgCodCar").focus();
                }
            },
        });
    }
})
$("#edtCodCar").change(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
    });
    var codigo = $(this).val();
    var datos = new FormData();
    datos.append("codigo", codigo);
    if (codigo != "SCD") {
        $.ajax({
            url: "public/views/src/ajaxCargos.php",
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
                        title: "El Código Ingresado ya se encuentra registrado",
                    });
                    $("#edtCodCar").val("");
                    $("#edtCodCar").focus();
                }
            },
        });
    }
})