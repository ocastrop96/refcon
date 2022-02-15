cargarParametrosRptControl();


function cargarParametrosRptControl() {
    var anio = $("#anioRG").val();
    var mes = $("#mesRG").val();
    var dni = $("#dniPaciente").val();

    $(".rg2").attr("href", "public/views/reports/rp-referenciaspdf.php?reporte=reporte&anio=" + anio + "&mes=" + mes + "&dni=" + dni);

    $(".rg1").attr("href", "public/views/reports/rp-referenciasxls.php?reporte=reporte&anio=" + anio + "&mes=" + mes + "&dni=" + dni);

}

$("#anioRG").datepicker({
    'format': "yyyy",
    'viewMode': "years",
    'minViewMode': "years",
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'startDate': '-2y',
    'endDate': '+0y'
});

$("#mesRG").change(function () {
    var anio = $("#anioRG").val();
    var mes = $(this).val();
    var dni = $("#dniPaciente").val();
    
    $(".rg1").attr("href", "public/views/reports/rp-referenciasxls.php?reporte=reporte&anio=" + anio + "&mes=" + mes + "&dni=" + dni);
    $(".rg2").attr("href", "public/views/reports/rp-referenciaspdf.php?reporte=reporte&anio=" + anio + "&mes=" + mes + "&dni=" + dni);

});


$("#anioRG").change(function () {
    var anio = $(this).val();
    var mes = $("#mesRG").val();
    var dni = $("#dniPaciente").val();
    
    $(".rg1").attr("href", "public/views/reports/rp-referenciasxls.php?reporte=reporte&anio=" + anio + "&mes=" + mes + "&dni=" + dni);
    $(".rg2").attr("href", "public/views/reports/rp-referenciaspdf.php?reporte=reporte&anio=" + anio + "&mes=" + mes + "&dni=" + dni);

});

$("#dniPaciente").change(function () {
    var anio =  $("#anioRG").val();
    var mes = $("#mesRG").val();
    var dni = $(this).val();
    
    $(".rg1").attr("href", "public/views/reports/rp-referenciasxls.php?reporte=reporte&anio=" + anio + "&mes=" + mes + "&dni=" + dni);
    $(".rg2").attr("href", "public/views/reports/rp-referenciaspdf.php?reporte=reporte&anio=" + anio + "&mes=" + mes + "&dni=" + dni);

});