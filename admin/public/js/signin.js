$("#usuarioLogMR").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toLowerCase();
    $("#usuarioLogMR").val(mu4);
});
$("#usuarioLogMR").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ]/g, "");
});

function ValidarLoginMR() {
    var usuarioLog = $("#usuarioLogMR").val();
    var passwordLog = $("#usuarioPassMR").val();

    if (usuarioLog.length == 0 || passwordLog.length == 0) {
        Swal.fire({
            icon: "warning",
            title: "Ingrese usuario y contraseña por favor",
            showConfirmButton: false,
            timer: 1500
        });
        return false
    }
}
$("#btnLoginMR").on("click", function () {
    ValidarLoginMR()
});
$("#usuarioLogMR").change(function () {
    var cuenta = $(this).val();
    var datos = new FormData();

    datos.append("validarCuentaLog", cuenta);

    $.ajax({
        url: "public/views/src/ajaxUsuarios.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta) {
                $("#usuarioPassMR").focus();
                $("#mensajeLogMR").addClass("d-none");
            } else {
                $("#usuarioLogMR").val("");
                $("#usuarioLogMR").focus();
                $("#mensajeLogMR").removeClass("d-none");
            }
        },
    });
});