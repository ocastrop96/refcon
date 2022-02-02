Chart.register(ChartDataLabels);
Chart.defaults.set('plugins.datalabels', {
    color: '#000000'
});
$("#anioDash").datepicker({
    'format': "yyyy",
    'viewMode': "years",
    'minViewMode': "years",
    'autoclose': true,
    'orientation': 'auto bottom',
    'language': 'es',
    'endDate': new Date()
});
$("#deshacer-filtro-DashPrinci").on("click", function () {
    window.location = "dashboard";
});
const datedate = new Date();
var yearCatch = datedate.getFullYear();
CargarWidgets(yearCatch);
CargarLicenciasxMes(yearCatch);
CargarLicenciasxProcedencia(yearCatch);

// Carga de Widgets
function CargarWidgets(year) {
    var datos = new FormData();
    datos.append("anio", year);
    $.ajax({
        url: "public/views/src/ajaxGraficos.php",
        method: "POST",
        cache: false,
        data: datos,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $(".one1").html(respuesta["nlicencias"]);
            $(".one2").html(respuesta["nsaludOcupacional"]);
            $(".one3").html(respuesta["nEmpleados"]);
            $(".one4").html(respuesta["nCargos"]);
        },
    });
}

$("#anioDash").change(function () {
    var anio = $(this).val();
    CargarWidgets(anio);
    CargarLicenciasxMes(anio);
    CargarLicenciasxProcedencia(anio);

})

function CargarLicenciasxMes(yearCatch) {
    var datos = new FormData();
    datos.append("anio2", yearCatch);
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
                    contador.push(respuesta[i][0]);
                    mes.push(respuesta[i][1]);
                    colores.push(colorRGB());
                }

                $("canvas#graphDash1").remove();
                $("div.rj1").append('<canvas id="graphDash1" width="400" height="400"></canvas>');
                var ctx2 = document.getElementById("graphDash1").getContext("2d");
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
                $("canvas#graphDash1").remove();
                $("div.rj1").append('<canvas id="graphDash1" width="400" height="400"></canvas>');
                var ctx2 = document.getElementById("graphDash1").getContext("2d");
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
function CargarLicenciasxProcedencia(yearCatch) {
    var datos = new FormData();
    datos.append("anio3", yearCatch);
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

                $("canvas#graphDash2").remove();
                $("div.rj2").append('<canvas id="graphDash2" width="400" height="400"></canvas>');
                var ctx = document.getElementById("graphDash2").getContext("2d");
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
                    // title: {
                    //     display: true,
                    //     text: 'Licencias x Procedencia'
                    // },
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
                $("canvas#graphDash2").remove();
                $("div.rj2").append('<canvas id="graphDash2" width="400" height="400"></canvas>');
                var ctx = document.getElementById("graphDash2").getContext("2d");
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