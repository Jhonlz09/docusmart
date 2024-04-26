<head>
    <title>Inicio</title>
    <!-- ChartJS -->
    <script src="assets/plugins/chart.js/Chart.min.js"></script>
</head>
<script>
window.scrollTo(0, 0);
</script> 
<!-- Contenido Header -->
<section class="content-header stick-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="row" style="align-items: center; margin:auto">
                    <h1 class="mr-2">Inicio</h1>
                    <select name="temporada" id="cboTemp" class="form-control select2 select2-dark" data-dropdown-css-class="select2-dark">
                    </select>
                </div>
            </div><!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content scroll">
    <div class="container-fluid">
        <!-- row Tarjetas Informativas -->
        <div class="row">
            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-1">
                    <div class="inner">
                        <p>Documentos</p>
                        <h3 id="silabos">0</h3>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <a onclick="masInfo()" style="cursor:pointer;" class="small-box-footer">Más Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- TARJETA TOTAL PENDIENTES -->
            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-2">
                    <div class="inner">
                        <p>Pendientes</p>
                        <h3 id="pendiente">0</h3>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <a onclick="masInfo()" style="cursor:pointer;" class="small-box-footer">Más Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- TARJETA TOTAL APROBADOS-->
            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-3">
                    <div class="inner">
                        <p>Aprobados</p>
                        <h3 id="aprobado">0</h3>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <a onclick="masInfo()" style="cursor:pointer;" class="small-box-footer">Más Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3">
                <!-- small box -->
                <div class="small-box bg-5">
                    <div class="inner">
                        <p>En corrección</p>
                        <h3 id="correcion">0</h3>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-file-pen"></i>
                    </div>
                    <a onclick="masInfo()" style="cursor:pointer;" class="small-box-footer">Más Info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div> <!-- ./row Tarjetas Informativas -->

        <!-- row Grafico de barras -->
        <div class="card card-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-8" style="margin-bottom: 10px;">
                        <h3 class="card-title">Documentos aprobados por dirección de <span id="tituloDoc"></span> </h3>
                    </div>
                    <script>
                        // Obtener el elemento con el ID 'tituloDocumento'
                        var tit = document.getElementById('tituloDoc');
                        // Obtener el año actual
                        var añoAct = new Date().getFullYear();
                        // Actualizar el contenido del elemento con el año actual
                        tit.innerHTML = añoAct;
                    </script>
                    <div class="col-lg-4" style="margin-top: -8px; margin-bottom: 2px;">
                        <select name="cboMeses" id="cboMeses" class="form-control select2 select2-dark" data-dropdown-css-class="select2-dark">
                            <option value="" disabled selected data-placeholder="true">SELECCIONE UN RANGO DE MESES
                            </option>
                            <option value="7">POR DEFECTO</option>
                            <option value="1">ENERO - FEBRERO</option>
                            <option value="2">MARZO - ABRIL</option>
                            <option value="3">MAYO - JUNIO</option>
                            <option value="4">JULIO - AGOSTO</option>
                            <option value="5">SEPTIEMBRE - OCTUBRE</option>
                            <option value="6">NOVIEMBRE - DICIEMBRE </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <!-- ./row Grafico de barras -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Estado de los documentos de <span id="mes-aprobado"></span></h3>
                        <script>
                            var mesAprobadoElemento = document.getElementById('mes-aprobado');
                            // Actualizar el contenido del elemento con el año actual
                            mesAprobadoElemento.innerHTML = añoAct;
                        </script>
                    </div> <!-- ./ end card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table" id="tblTotalSilabos">
                                <thead>
                                    <tr>
                                        <th class="sticky-col" rowspan="2" style="vertical-align: middle; position: sticky; left: 0; z-index: 1; background-color: #fff;">Dirección de carrera</th>
                                        <th colspan="2" style="color:#009836!important" class="text-center">Aprobado</th>
                                        <th colspan="2" style="color:#0b4395!important" class="text-center">Correccion</th>
                                        <th colspan="2" style="color:#e62b27!important" class="text-center">Pendiente</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Silabo</th>
                                        <th class="text-center">Micro</th>
                                        <th class="text-center">Silabo</th>
                                        <th class="text-center">Micro</th>
                                        <th class="text-center">Silabo</th>
                                        <th class="text-center">Micro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- ./ end card-body -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Ultimas modificaciones</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div> <!-- ./ end card-tools -->
                    </div> <!-- ./ end card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table" id="tblUltMod">
                                <thead style="background:#eef1f3!important">
                                    <tr>
                                        <th>Materia</th>
                                        <th>Profesor</th>
                                        <th class="text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div> <!-- ./ end card-body -->
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<script>
    var barChartData1; // Inicializa esto fuera de la función
    var barChartCanvas1;
    var barChartOptions1;
    var chart;
    $(document).ready(function() {

        $('#cboTemp').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('body')
        });
        $('#cboMeses').select2({
            minimumResultsForSearch: -1,
            width: '100%',
            dropdownAutoWidth: false,
            placeholder: 'SELECCIONE UN RANGO DE MESES',
            dropdownParent: $('body')
        });

        // SOLICITUD AJAX PARA CARGAR COMBO AÑO
        $.ajax({
            url: "ajax/combos.ajax.php",
            cache: false,
            method: "POST",
            dataType: "json",
            data: {
                combo: 5
            },
            success: function(respuesta) {

                let añoactual = new Date().getFullYear();
                let options;

                for (let index = 0; index < respuesta.length; index++) {
                    if (añoactual == respuesta[index][1]) {
                        options =
                            options +
                            "<option selected value=" +
                            respuesta[index][0] +
                            ">" +
                            respuesta[index][1] +
                            "</option>";
                        break;
                    } else {
                        options =
                            options +
                            "<option value=" +
                            respuesta[index][0] +
                            ">" +
                            respuesta[index][1] +
                            "</option>";
                    }
                }
                $("#cboTemp").html(options);
                id_año = $("#cboTemp").val();
            },
        });
        /* =======================================================
        SOLICITUD AJAX TARJETAS INFORMATIVAS
        =======================================================*/
        $.ajax({
            url: "ajax/inicio.ajax.php",
            method: 'POST',
            dataType: 'json',
            success: function(respuesta) {
                $("#silabos").html(respuesta[0]['silabos']);
                $("#pendiente").html(respuesta[0]['pendiente']);
                $("#aprobado").html(respuesta[0]['aprobado']);
                $("#correcion").html(respuesta[0]['correcion']);
            }
        });
        /* ================================
        SOLICITUD AJAX GRAFICO DE BARRAS MESES
        ===================================*/
        $.ajax({
            url: "ajax/inicio.ajax.php",
            method: 'POST',
            data: {
                'accion': 1,
                'id_anio': añoAct
            },
            dataType: 'json',
            success: function(respuesta) {
                var año = new Date().getFullYear();
                var mes = new Date().getMonth();
                const meses = {
                    0: "Enero",
                    1: "Febrero",
                    2: "Marzo",
                    3: "Abril",
                    4: "Mayo",
                    5: "Junio",
                    6: "Julio",
                    7: "Agosto",
                    8: "Septiembre",
                    9: "Octubre",
                    10: "Noviembre",
                    11: "Diciembre"
                };
                var direccion = [];
                var silabos = [];
                var silabos_ant = [];
                var tot = [];
                var mesactual = meses[mes] + ' ' + año;
                var mesanterior = meses[mes - 1] + ' ' + año;
                if (mes == 0) {
                    mesanterior = meses[11] + ' ' + (año - 1);
                }
                for (let i = 0; i < respuesta.length; i++) {

                    direccion.push(respuesta[i]['direccion']);
                    silabos_ant.push(respuesta[i]['mesanterior']);
                    silabos.push(respuesta[i]['mesactual']);
                    tot.push(respuesta[i]['mesanterior']);
                    tot.push(respuesta[i]['mesactual']);
                }

                silabos.push(0);
                // console.log(silabos)
                // total_venta.push(600);

                // $("#title-header").html('Documentos aprobados por mes');
                // $("#mes-aprobado").text(`Documentos aprobados en ${mesactual}`);

                barChartCanvas1 = $("#barChart").get(0).getContext('2d');

                var areaChartData1 = {
                    labels: direccion,
                    datasets: [{
                            label: mesanterior,
                            backgroundColor: '#0b4395',
                            data: silabos_ant
                        },
                        {
                            label: mesactual,
                            backgroundColor: 'rgb(255, 140, 0,0.9)',
                            data: silabos
                        }
                    ]
                }

                barChartData1 = $.extend(true, {}, areaChartData1);

                var temp0 = areaChartData1.datasets[0];

                barChartData1.datasets[0] = temp0;

                barChartOptions1 = {
                    maintainAspectRatio: false,
                    responsive: true,
                    events: false,
                    indexAxis: 'y',
                    layout: {
                        margin: {
                            top: 30
                        }
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontSize: 14 // Tamaño de fuente del eje X
                            }
                        }],
                        yAxes: [{
                            type: 'linear',
                            ticks: {
                                beginAtZero: true,
                                precision: 0,
                                fontSize: 14,
                                suggestedMax: Math.max.apply(null, tot) + 1
                            }
                        }]
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    defaultFontFamily: Chart.defaults.global.defaultFontFamily = "Poppins-Regular",
                    defaultFontSize: 14,
                    animation: {
                        duration: 500,
                        easing: "easeOutQuart",
                        onComplete: function() {
                            var ctx = this.chart.ctx;
                            ctx.font = Chart.helpers.fontString(Chart.defaults.global
                                .defaultFontFamily, 'normal',
                                Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'bottom';
                            this.data.datasets.forEach(function(dataset) {
                                for (var i = 0; i < dataset.data.length; i++) {
                                    var model = dataset._meta[Object.keys(dataset
                                            ._meta)[0]].data[i]._model,
                                        scale_max = dataset._meta[Object.keys(dataset
                                            ._meta)[0]].data[i]._yScale.maxHeight;
                                    ctx.fillStyle = '#444';
                                    var y_pos = model.y - 5;
                                    // Make sure data value does not get overflown and hidden
                                    // when the bar's value is too close to max value of scale
                                    // Note: The y value is reverse, it counts from top down
                                    if ((scale_max - model.y) / scale_max >= 0.93)
                                        y_pos = model.y + 20;
                                    ctx.fillText(dataset.data[i], model.x, y_pos);
                                }
                            });
                        }
                    }
                }
                chart = new Chart(barChartCanvas1, {
                    type: 'bar',
                    data: barChartData1,
                    options: barChartOptions1,
                })
            }
        });
        /* ================================
        SOLICITUD AJAX TABLA APROBADOS
        ===================================*/
        solicitarDatosTabla(añoAct);
        /* ================================
        SOLICITUD AJAX TABLA PENDIENTE
        ===================================*/
        // solicitarDatosTabla(1, "tblPendiente", "total-p");
        /* ================================
        SOLICITUD AJAX TABLA ULTIMAS ACTUALIZACIONES
        ===================================*/
        $.ajax({
            url: "ajax/inicio.ajax.php",
            type: "POST",
            data: {
                'accion': 3 // 3:ACTUALIZACIONES
            },
            dataType: 'json',
            success: function(respuesta) {
                // console.log("respuesta",respuesta);
                // let totalS=0;
                // let totalM=0;
                for (let i = 0; i < respuesta.length; i++) {
                    // totalS = (totalS + parseInt(respuesta[i]['silabos']));
                    // totalM = (totalM + parseInt(respuesta[i]['micros']));
                    let span;
                    if (respuesta[i]["estado_micro"] == "Aprobado") {
                        span = '<span class="badge badge-success">APROBADO</span>'
                    } else {
                        span = '<span class="badge badge-info">CORRECCIÓN</span>'
                    }

                    filas = '<tr>' +
                        '<td>' + respuesta[i]["nombre_materia"] + '</td>' +
                        '<td >' + respuesta[i]["profesor"] + '</td>' +
                        // '<td class="text-center">' + respuesta[i]["documento"] + '</td>' +
                        '<td class="text-center">' + span + '</td>' +
                        '</tr>'
                    $("#tblUltMod tbody").append(filas);
                }
            }
        });
    });

    $("#cboTemp").on("change", function() {
        id_año = $(this).val();
        var textoAño = this.options[this.selectedIndex].text;
        mesAprobadoElemento.innerHTML = textoAño;
        tit.innerHTML = textoAño
        actualizarTarjetasInformativas(id_año);
        solicitarDatosTabla(textoAño);
        porDefectoGrafico(textoAño);
        $("#cboMeses").val("").trigger("change");
    });

    $("#cboMeses").on("change", function() {
        id_mes = $(this).val();
        let selectElement = document.getElementById("cboTemp");
        let anio = selectElement.options[selectElement.selectedIndex].text;
        console.log(id_mes)
        if (id_mes == null) {
            return;
        } else if (id_mes != 7) {
            const rangoFecha = {
                1: {
                    mes_ini: "Enero",
                    mes_fin: "Febrero",
                    fecha_ini: "-01-01",
                    fecha_en: "-02-01",
                    fecha_fin: "-03-01",
                },
                2: {
                    mes_ini: "Marzo",
                    mes_fin: "Abril",
                    fecha_ini: "-03-01",
                    fecha_en: "-04-01",
                    fecha_fin: "-05-01",
                },
                3: {
                    mes_ini: "Mayo",
                    mes_fin: "Junio",
                    fecha_ini: "-05-01",
                    fecha_en: "-06-01",
                    fecha_fin: "-07-01",
                },
                4: {
                    mes_ini: "Julio",
                    mes_fin: "Agosto",
                    fecha_ini: "-07-01",
                    fecha_en: "-08-01",
                    fecha_fin: "-09-01",
                },
                5: {
                    mes_ini: "Septiembre",
                    mes_fin: "Octubre",
                    fecha_ini: "-09-01",
                    fecha_en: "-10-01",
                    fecha_fin: "-11-01",
                },
                6: {
                    mes_ini: "Noviembre",
                    mes_fin: "Diciembre",
                    fecha_ini: "-11-01",
                    fecha_en: "-12-01",
                    fecha_fin: "-12-31",
                },
            };
            let rango = rangoFecha[id_mes];
            let fecha_ini = anio + rango.fecha_ini;
            let fecha_en = anio + rango.fecha_en;
            let fecha_fin = anio + rango.fecha_fin;

            generarGrafico(anio, rango.mes_ini, rango.mes_fin, fecha_ini, fecha_en, fecha_fin);
        } else {
            porDefectoGrafico(anio)
        }

    });

    function generarGrafico(anio, mes_ini, mes_fin, fecha_ini, fecha_en, fecha_fin) {
        $.ajax({
            url: "ajax/inicio.ajax.php",
            method: 'POST',
            data: {
                'accion': 5,
                'fecha_ini': fecha_ini,
                'fecha_en': fecha_en,
                'fecha_fin': fecha_fin
            },
            dataType: 'json',
            success: function(respuesta) {

                let direccion = [];
                let silabos = [];
                let silabos_ant = [];
                let mesactual = mes_fin + ' ' + anio;
                let mesanterior = mes_ini + ' ' + anio;

                for (let i = 0; i < respuesta.length; i++) {

                    direccion.push(respuesta[i]['direccion']);
                    silabos_ant.push(respuesta[i]['mesanterior']);
                    silabos.push(respuesta[i]['mesactual']);
                }

                //Actualiza las etiquetas
                barChartData1.labels = direccion;

                // Actualiza los datos de los conjuntos de datos
                barChartData1.datasets[0].data = silabos_ant;
                barChartData1.datasets[1].data = silabos;
                // Actualiza los label de datasets
                barChartData1.datasets[0].label = mesanterior;
                barChartData1.datasets[1].label = mesactual;
                // Refresca el gráfico
                chart.update();
            }
        });

    }

    function porDefectoGrafico(anio) {
        $.ajax({
            url: "ajax/inicio.ajax.php",
            method: 'POST',
            data: {
                'accion': 1,
                'id_anio': anio
            },
            dataType: 'json',
            success: function(respuesta) {
                var mes = new Date().getMonth();
                const meses = {
                    0: "Enero",
                    1: "Febrero",
                    2: "Marzo",
                    3: "Abril",
                    4: "Mayo",
                    5: "Junio",
                    6: "Julio",
                    7: "Agosto",
                    8: "Septiembre",
                    9: "Octubre",
                    10: "Noviembre",
                    11: "Diciembre"
                };
                var direccion = [];
                var silabos = [];
                var silabos_ant = [];
                var tot = [];
                var mesactual = meses[mes] + ' ' + anio;
                var mesanterior = meses[mes - 1] + ' ' + anio;
                if (mes == 0) {
                    mesanterior = meses[11] + ' ' + (anio - 1);
                }
                for (let i = 0; i < respuesta.length; i++) {

                    direccion.push(respuesta[i]['direccion']);
                    silabos_ant.push(respuesta[i]['mesanterior']);
                    silabos.push(respuesta[i]['mesactual']);
                    tot.push(respuesta[i]['mesanterior']);
                    tot.push(respuesta[i]['mesactual']);
                }
                //Actualiza las etiquetas
                barChartData1.labels = direccion;
                // Actualiza los datos de los conjuntos de datos
                barChartData1.datasets[0].data = silabos_ant;
                barChartData1.datasets[1].data = silabos;
                // Actualiza los label de datasets
                barChartData1.datasets[0].label = mesanterior;
                barChartData1.datasets[1].label = mesactual;
                // Refresca el gráfico
                chart.update();

                silabos.push(0);
            }
        })
    }

    function actualizarTarjetasInformativas(id_año) {
        $.ajax({
            url: "ajax/inicio.ajax.php",
            method: 'POST',
            data: {
                'accion': 4,
                'id_año': id_año
            },
            dataType: 'json',
            success: function(respuesta) {
                $("#silabos").html(respuesta[0]['silabos']);
                $("#pendiente").html(respuesta[0]['pendiente']);
                $("#aprobado").html(respuesta[0]['aprobado']);
                $("#correcion").html(respuesta[0]['correcion']);
            }
        });
    }

    function solicitarDatosTabla(anio) {
        $("#tblTotalSilabos tbody").empty();
        $.ajax({
            url: "ajax/inicio.ajax.php",
            type: "POST",
            data: {
                'accion': 2,
                'id_anio': anio
            },
            dataType: 'json',
            success: function(respuesta) {
                let totalS = 0;
                let totalM = 0;
                let totalSC = 0;
                let totalMC = 0;
                let totalSP = 0;
                let totalMP = 0;
                // let totalM = 0; // Si necesitas el total de 'micros'

                for (let i = 0; i < respuesta.length; i++) {
                    totalS = (totalS + parseInt(respuesta[i]['silabos']));
                    totalM = (totalM + parseInt(respuesta[i]['micros']));
                    totalSC = (totalSC + parseInt(respuesta[i]['silabosc']));
                    totalMC = (totalMC + parseInt(respuesta[i]['microsc']));
                    totalSP = (totalSP + parseInt(respuesta[i]['silabosp']));
                    totalMP = (totalMP + parseInt(respuesta[i]['microsp']));
                    filas = '<tr>' +
                        '<td class="sticky-col">' + respuesta[i]["direccion"] + '</td>' +
                        '<td class="text-center">' + respuesta[i]["silabos"] + '</td>' +
                        '<td class="text-center">' + respuesta[i]["micros"] + '</td>' +
                        '<td class="text-center">' + respuesta[i]["silabosc"] + '</td>' +
                        '<td class="text-center">' + respuesta[i]["microsc"] + '</td>' +
                        '<td class="text-center">' + respuesta[i]["silabosp"] + '</td>' +
                        '<td class="text-center">' + respuesta[i]["microsp"] + '</td>' +
                        '</tr>'
                    $("#tblTotalSilabos tbody").append(filas);
                }
                filaTotal = '<tr>' +
                    '<td class="total sticky-col">TOTAL</td>' +
                    '<td class="text-center total ">' + totalS + '</td>' +
                    '<td class="text-center total">' + totalM + '</td>' +
                    '<td class="text-center total">' + totalSC + '</td>' +
                    '<td class="text-center total">' + totalMC + '</td>' +
                    '<td class="text-center total">' + totalSP + '</td>' +
                    '<td class="text-center total">' + totalMP + '</td>' +
                    '</tr>'
                $("#tblTotalSilabos tbody").append(filaTotal);
            }
        });
    }

    function masInfo() {
        let button = document.getElementById("Silabos");
        button.click();
    }

    function actualizarGraficoAño() {

    }

    // if (window.innerWidth > 768) {
    //     $("body").css("overflow", "hidden");

    //     OverlayScrollbars(document.querySelectorAll('.scroll'), {
    //         // Customize options as needed
    //     });
    // } else {
    //     $("body").css("overflow", "auto");
    // }

    
</script>