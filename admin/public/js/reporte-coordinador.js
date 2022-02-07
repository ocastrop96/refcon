cargarParametrosRptControl()
$("#deshacer-filtro-AnioMesBusq").on("click", function () {
    window.location = "reporte-coordinador";
});
$("#anioCoord").datepicker({
    'format': "yyyy",
    'viewMode': "years",
    'minViewMode': "years",
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
});
function cargarParametrosRptControl() {
    var anio = $("#anioCoord").val();
    var mes = $("#mesCoord").val();
    $(".rptControl").attr("href", "public/views/reports/rp-consolidadoControl.php?reporte=reporte&anio=" + anio + "&mes=" + mes);
    $(".rptControl2").attr("href", "public/views/reports/rp-ControlPersonal.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl2").attr("target", "_blank");
    $(".rptControl3").attr("href", "public/views/reports/rp-LicenciasMaternidad.php?anio=" + anio);
    $(".rptControl3").attr("target", "_blank");
    $(".rptControl4").attr("href", "public/views/reports/rp-ControlPersonalLMR.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl4").attr("target", "_blank");
    $(".rptControl5").attr("href", "public/views/reports/rp-RankingLicencias.php?anio=" + anio);
    $(".rptControl5").attr("target", "_blank");

    $(".rptControl6").attr("href", "public/views/reports/rp-LicenciasSuperaSub.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl6").attr("target", "_blank");
    $(".rptControl7").attr("href", "public/views/reports/rp-LicenciasPendientes.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl7").attr("target", "_blank");

}
$("#mesCoord").change(function () {
    var mes = $(this).val();
    var anio = $("#anioCoord").val();
    $(".rptControl").attr("href", "public/views/reports/rp-consolidadoControl.php?reporte=reporte&anio=" + anio + "&mes=" + mes);
    $(".rptControl2").attr("href", "public/views/reports/rp-ControlPersonal.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl2").attr("target", "_blank");
    $(".rptControl4").attr("href", "public/views/reports/rp-ControlPersonalLMR.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl4").attr("target", "_blank");
    $(".rptControl6").attr("href", "public/views/reports/rp-LicenciasSuperaSub.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl6").attr("target", "_blank");
    $(".rptControl7").attr("href", "public/views/reports/rp-LicenciasPendientes.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl7").attr("target", "_blank");
})

$("#anioCoord").change(function () {
    var mes = $("#mesCoord").val();
    var anio = $(this).val()
    $(".rptControl").attr("href", "public/views/reports/rp-consolidadoControl.php?reporte=reporte&anio=" + anio + "&mes=" + mes);
    $(".rptControl2").attr("href", "public/views/reports/rp-ControlPersonal.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl2").attr("target", "_blank");
    $(".rptControl3").attr("href", "public/views/reports/rp-LicenciasMaternidad.php?anio=" + anio);
    $(".rptControl3").attr("target", "_blank");
    $(".rptControl4").attr("href", "public/views/reports/rp-ControlPersonalLMR.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl4").attr("target", "_blank");
    $(".rptControl5").attr("href", "public/views/reports/rp-RankingLicencias.php?anio=" + anio);
    $(".rptControl5").attr("target", "_blank");
    $(".rptControl6").attr("href", "public/views/reports/rp-LicenciasSuperaSub.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl6").attr("target", "_blank");
    $(".rptControl7").attr("href", "public/views/reports/rp-LicenciasPendientes.php?anio=" + anio + "&mes=" + mes);
    $(".rptControl7").attr("target", "_blank");
})