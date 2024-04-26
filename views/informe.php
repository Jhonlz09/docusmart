<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>

<head>
    <title>Informe</title>
    <link href="assets/plugins/datatables-searchpanes/css/searchPanes.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables-select/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
</head>
<!-- Contenido Header -->
<section class="content-header stick-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="row ml-0">
            <h1 class="mr-3 mb-2">Informe</h1>
                <button id="btnNuevo" class="btn btn-success text-nowrap" data-toggle="modal" data-target="#modal-date">
                    <i class="fa fa-file-lines mr-1"> </i> Generar informe</button>
            </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content scroll">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="display: inline-flex; align-items: center;">
                        <h3 class="card-title mr-3">Listado de silabos</h3>
                        <select name="temporada" id="cboTemp" class="form-control select2 select2-dark" data-dropdown-css-class="select2-dark">
                        </select>
                        <select name="Mes" id="cboMes" class="form-control select2 select2-dark" data-dropdown-css-class="select2-dark">
                        </select>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tblInforme" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>DIRECCION</th>
                                    <th>CARRERA</th>
                                    <th>MATERIA</th>
                                    <th>PROFESOR</th>
                                    <th>PERIODO</th>
                                    <th>MODALIDAD</th>
                                    <th>DOCUMENTO</th>
                                    <th>ESTADO</th>
                                    <th>FECHA</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Modal Date-->
<div class="modal fade" id="modal-date">
    <div class="modal-dialog modal-md">
        <div class="modal-content modal-nuevo">
            <div class="modal-header header-color-nuevo">
                <h4 class="modal-title title-nuevo">Generar Informe</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInforme" method="POST" action="controllers/pdf.php" autocomplete="off" target="_blank">
                    <input type="hidden" name="variable" id="variable" value="">
                    <input type="hidden" name="id_usuario" id="id_usuario" value="">
                    <div class="form-row-nuevo">
                        <div class="form-group">
                            <label style="font-size: 18px;" class="combo">Desde</label>
                            <div class="input-group date fecha-desde" id="reservationdate1" data-target-input="nearest">
                                <div class="input-group-append fecha-desde" data-target="#reservationdate1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    <input id="desde" value="<?php echo date('Y-m-d'); ?>" name="desde" type="text" class="form-control datetimepicker-input fecha-desde" data-target="#reservationdate1" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label style="font-size: 18px;" class="combo">Hasta</label>
                            <div class="input-group date fecha-hasta" id="reservationdate" data-target-input="nearest">
                                <div class="input-group-append fecha-hasta" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    <input id="hasta" value="<?php echo date('Y-m-d'); ?>" name="hasta" type="text" class="form-control datetimepicker-input fecha-hasta" data-target="#reservationdate" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
                        <button id="btnGenerar" type="button" class="btn btn-success"><i class="fa-regular fa-file-lines"></i> Generar informe</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal Date-->
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script src="assets/plugins/datatables-searchpanes/js/dataTables.searchPanes.min.js" type="text/javascript"></script>
<script src="assets/plugins/datatables-searchpanes/js/searchPanes.bootstrap4.min.js" type="text/javascript"></script>
<script src="assets/plugins/datatables-select/js/dataTables.select.min.js" type="text/javascript"></script>
<script src="assets/plugins/datatables-select/js/select.bootstrap4.min.js" type="text/javascript"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<script src="assets/plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js"></script>

<script src="assets/js/informe.js?=1"></script>

<script>

var id_usuario = '<?php echo $_SESSION["s_usuario"]->id_usuario; ?>';

    document.getElementById("btnGenerar").addEventListener("click", function() {
        var barChartOptions,
            barChartCanvas,
            barChartData,
            myChart,
            base64Image,
            areaChartData;

        var desde = $("#desde").val();
        var hasta = $("#hasta").val();
        var desde_format = desde.split('/').reverse().join('-');
        var hasta_format = hasta.split('/').reverse().join('-');
        /* ================================
            SOLICITUD AJAX GRAFICO DE BARRAS
            ===================================*/
        $.ajax({
            url: "ajax/informe.ajax.php",
            method: 'POST',
            data: {
                'accion':1,
                'desde': desde_format,
                'hasta': hasta_format,
                
            },
            dataType: 'json',
            success: function(respuesta) {
                var canvas = document.createElement('canvas');
                canvas.width = 800; // Ancho del canvas
                canvas.height = 400; // Alto del canvas
                var dir = [];
                var sil = [];
                var mic = [];
                // var tot=[];
                
                for (let i = 0; i < respuesta.length; i++) {
                    dir.push(respuesta[i]['direccion']);
                    sil.push(respuesta[i]['silabos']);
                    mic.push(respuesta[i]['micros']);
                    // tot.push(respuesta[i]['silabos']);
                    // tot.push(respuesta[i]['micros']);
                }

                sil.push(0);
                barChartCanvas = canvas.getContext('2d');

                areaChartData = {
                    labels: dir,
                    datasets: [ 
                    {
                    label: 'Silabos',
                    backgroundColor: '#0b4395',
                    data: sil
                    },
                    {
                    label: 'Micros',
                    backgroundColor: 'rgb(255, 140, 0,0.9)',
                    data: mic
                    }
                ]
                }

                barChartData = $.extend(true, {}, areaChartData);
                var temp0 = areaChartData.datasets[0];
                barChartData.datasets[0] = temp0;
                barChartOptions = {
                    maintainAspectRatio: false,
                    responsive: false,
                    events: false,
                    indexAxis: 'y',
                    layout: {
                        margin: {
                            top: 30
                        }
                    },
                    scales: {
                        yAxes: [{
                            type: 'linear',
                            ticks: {
                                beginAtZero: true,
                                precision: 0,
                                suggestedMax: Math.max.apply(null, sil) + 2
                            },
                        }],
                        xAxes: [{
                            ticks: {
                                display: true,

                                padding: 30
                            }
                        }]
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    defaultFontFamily: Chart.defaults.global.defaultFontFamily = "Poppins-Regular",
                    animation: {
                        duration: 0,
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
                                    if ((scale_max - model.y) / scale_max >= 0.98)
                                        y_pos = model.y + 20;
                                    ctx.fillText(dataset.data[i], model.x, y_pos);
                                }
                            });
                            base64Image = canvas.toDataURL();
                            // console.log(base64Image);
                            canvas = null;
                        }
                    }
                }

                myChart = new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions,
                })
            },
            complete: function() {
                document.getElementById('variable').value = base64Image;
                document.getElementById('id_usuario').value =id_usuario;
                var form = document.getElementById("formInforme");
                form.action = "controllers/pdf.php";
                form.submit();
            }
        });
    });

    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            minimumResultsForSearch: -1,
        });
    });

    $(document).scroll(function() {
        // Cierra el menú desplegable de Select2 al hacer scroll
        $('#cboTemp').select2('close');
        $('#cboMes').select2('close');

        
      });

    // OverlayScrollbars(document.querySelectorAll('.scroll'), {});
    // OverlayScrollbars(document.querySelectorAll('select'), {});
</script>