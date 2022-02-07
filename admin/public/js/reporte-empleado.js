var yearCatch = datedate.getFullYear();
CargarLicenciasxMesEmpleado(yearCatch, 0)
CargarLicenciasxProcedenciaxEmpleado(yearCatch, 0)

cargarParametrosKardexEmp()
$("#empleadoBusq").select2(
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
$("#deshacer-filtro-EmpleBusqueda").on("click", function () {
    window.location = "reporte-empleado";
});
$("#anioPersonal").datepicker({
    'format': "yyyy",
    'viewMode': "years",
    'minViewMode': "years",
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date()
});
function cargarParametrosKardexEmp() {
    var idEmpleado = $("#empleadoBusq").val();
    var anio = $("#anioPersonal").val();
    $(".rgKardex").attr("href", "public/views/reports/rp-KardexEmpleado.php?idEmpleado=" + idEmpleado + "&anio=" + anio);
    $(".rgKardex").attr("target", "_blank");
}
$("#anioPersonal").change(function () {
    var anio = $(this).val();
    var idEmpleado = $("#empleadoBusq").val();

    $(".rgKardex").attr("href", "public/views/reports/rp-KardexEmpleado.php?idEmpleado=" + idEmpleado + "&anio=" + anio);
    $(".rgKardex").attr("target", "_blank");
    CargarLicenciasxMesEmpleado(anio, idEmpleado);
    CargarLicenciasxProcedenciaxEmpleado(anio, idEmpleado);


})

$("#empleadoBusq").change(function () {
    var idEmpleado = $(this).val();
    var anio = $("#anioPersonal").val();
    $(".rgKardex").attr("href", "public/views/reports/rp-KardexEmpleado.php?idEmpleado=" + idEmpleado + "&anio=" + anio);
    $(".rgKardex").attr("target", "_blank");
    CargarLicenciasxMesEmpleado(anio, idEmpleado);
    CargarLicenciasxProcedenciaxEmpleado(anio, idEmpleado);
})

function CargarLicenciasxMesEmpleado(anio, empleado) {
    var datos = new FormData();
    datos.append("anio4", anio);
    datos.append("empleado", empleado);

    $.ajax({
        url: "public/views/src/ajaxGraficos.php",
        method: "POST",
        cache: false,
        data: datos,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta.length > 0) {
                var mes = [];
                var contador = [];
                var colores = [];
                for (var i = 0; i < respuesta.length; i++) {
                    contador.push(respuesta[i][1]);
                    mes.push(respuesta[i][0]);
                    colores.push(colorRGB());
                }

                $("canvas#graphDash3").remove();
                $("div.rj3").append('<canvas id="graphDash3" width="400" height="400"></canvas>');
                var ctx2 = document.getElementById("graphDash3").getContext("2d");
                var salesGraphChartData = {
                    labels: mes,
                    datasets: [
                        {
                            label: '# de Licencias',
                            backgroundColor: colores,
                            borderColor: colores,
                            borderWidth: 1,
                            data: contador
                        }
                    ]
                }

                var salesGraphChartOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontColor: colores
                            },
                            gridLines: {
                                display: false,
                                color: '#000',
                                drawBorder: false
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 50,
                                fontColor: '#000'
                            },
                            gridLines: {
                                display: true,
                                color: '#AFAFAF',
                                drawBorder: false
                            }
                        }]
                    },
                    plugins: {
                        datalabels: {
                            color: '#2A2A2A',
                            labels: {
                                title: {
                                    font: {
                                        weight: 'bolder'
                                    }
                                },
                                value: {
                                    color: 'green'
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Licencias por Mes',
                            padding: {
                                top: 0,
                                bottom: 0
                            }
                        }

                    }
                }
                var salesGraphChart = new Chart(ctx2, {
                    type: 'bar',
                    data: salesGraphChartData,
                    options: salesGraphChartOptions
                });
            }
            else {
                $("canvas#graphDash3").remove();
                $("div.rj3").append('<canvas id="graphDash3" width="400" height="400"></canvas>');
                var ctx2 = document.getElementById("graphDash3").getContext("2d");
                var salesGraphChartData = {
                    labels: ['SIN DATOS'],
                    datasets: [
                        {
                            label: '# de Licencias',
                            backgroundColor: colores,
                            borderColor: colores,
                            borderWidth: 1,
                            data: [0]
                        }
                    ]
                }

                var salesGraphChartOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontColor: colores
                            },
                            gridLines: {
                                display: false,
                                color: '#000',
                                drawBorder: false
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 100,
                                fontColor: '#000'
                            },
                            gridLines: {
                                display: true,
                                color: '#AFAFAF',
                                drawBorder: false
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: 'Licencias x Mes'
                    }
                }
                var salesGraphChart = new Chart(ctx2, {
                    type: 'bar',
                    data: salesGraphChartData,
                    options: salesGraphChartOptions
                });
            }
        },
    });
}


function CargarLicenciasxProcedenciaxEmpleado(anio, empleado) {
    var datos = new FormData();
    datos.append("anio5", anio);
    datos.append("empleado5", empleado);

    $.ajax({
        url: "public/views/src/ajaxGraficos.php",
        method: "POST",
        cache: false,
        data: datos,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta.length > 0) {
                var procedencia = [];
                var contador = [];
                var colores = [];
                for (var i = 0; i < respuesta.length; i++) {
                    contador.push(respuesta[i][0]);
                    procedencia.push(respuesta[i][1]);
                    colores.push(colorRGB());
                }

                $("canvas#graphDash4").remove();
                $("div.rj4").append('<canvas id="graphDash4" width="400" height="400"></canvas>');
                var ctx = document.getElementById("graphDash4").getContext("2d");
                var donutData = {
                    labels: procedencia,
                    datasets: [
                        {
                            label: '# de Licencias',
                            data: contador,
                            backgroundColor: colores,
                            borderColor: colores
                        }
                    ]
                }
                var donutOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        position: 'left',
                    },
                    plugins: {
                        datalabels: {
                            color: '#2A2A2A',
                            labels: {
                                title: {
                                    font: {
                                        weight: 'bolder'
                                    }
                                },
                                value: {
                                    color: 'green'
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Licencias por Procedencia',
                            padding: {
                                top: 0,
                                bottom: 0
                            }
                        }
                    }
                }
                new Chart(ctx, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                });
            }
            else {
                $("canvas#graphDash4").remove();
                $("div.rj4").append('<canvas id="graphDash4" width="400" height="400"></canvas>');
                var ctx = document.getElementById("graphDash4").getContext("2d");
                var donutData = {
                    labels: ['SIN DATOS'],
                    datasets: [
                        {
                            label: '# de Licencias',
                            data: [0],
                            backgroundColor: colores,
                            borderColor: colores
                        }
                    ]
                }
                var donutOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        position: 'left',
                    },
                    title: {
                        display: true,
                        text: 'Licencias x Procedencia'
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontColor: colores
                            },
                            gridLines: {
                                display: false,
                                color: '#000',
                                drawBorder: false
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 100,
                                fontColor: '#000'
                            },
                            gridLines: {
                                display: true,
                                color: '#AFAFAF',
                                drawBorder: false
                            }
                        }]
                    },
                }
                new Chart(ctx, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                });

            }
        },
    });

}
function generarNumero(numero) {
    return (Math.random() * numero).toFixed(0);
}

function colorRGB() {
    var coolor = "(" + generarNumero(255) + "," + generarNumero(255) + "," + generarNumero(255) + ")";
    return "rgb" + coolor;
}