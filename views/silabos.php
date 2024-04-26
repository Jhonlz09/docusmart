<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>

<head>
    <title>PEA</title>
    <link href="assets/plugins/datatables-searchpanes/css/searchPanes.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables-select/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
</head>

<!-- Contenido Header -->
<section class="content-header stick-header">
    <div class="container-fluid">
        <div class="row ml-0" style="align-items:center">
            <div class="col-md-4">
                <div class="row">
                    <h1 class="mr-3 mb-2">PEA</h1>
                    <?php if ($_SESSION["permisoCrear"]) : ?>
                        <button id="btnNuevo" class="btn btn-success" data-toggle="modal" data-target="#modal">
                            <i class="fa fa-plus"></i> Nuevo</button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-md-2 pt-0 text-center">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-ck custom-control-input" type="checkbox" id="ckTodo" value="">
                            <label for="ckTodo" class="custom-control-label ck ">TODO</label>
                        </div>
                    </div>
                    <div class="col-md-2 pt-0 text-center">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-ck custom-control-input" type="checkbox" id="ckS1M1" value="1">
                            <label for="ckS1M1" class="custom-control-label ck ">S1 M1</label>
                        </div>
                    </div>
                    <div class="col-md-2 pt-0 text-center">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-ck custom-control-input" type="checkbox" id="ckS1M2" value="2">
                            <label for="ckS1M2" class="custom-control-label ck ">S1 M2</label>
                        </div>
                    </div>
                    <div class="col-md-2 pt-0 text-center">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-ck custom-control-input" type="checkbox" id="ckS2M1" value="3">
                            <label for="ckS2M1" class="custom-control-label ck ">S2 M1</label>
                        </div>
                    </div>
                    <div class="col-md-2 pt-0 text-center">
                        <div class="ccustom-control custom-checkbox">
                            <input class="custom-ck custom-control-input" type="checkbox" id="ckS2M2" value="4">
                            <label for="ckS2M2" class="custom-control-label ck ">S2 M2 </label>
                        </div>
                    </div>
                    <div class="col-md-2 pt-0 text-center">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-ck custom-control-input" type="checkbox" id="ckInvierno" value="5">
                            <label for="ckInvierno" class="custom-control-label ck ">INVIERNO</label>
                        </div>
                    </div>
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
                <!-- card -->
                <div class="card">
                    <div class="card-header" style="padding:0.2rem 1.25rem 0.75rem 1.25rem">
                        <div class="row" style="align-items: center;">
                            <div class="col-md-6">
                                <div class="row" style="align-items: center; margin:auto">
                                    <div class="col-sm-6 pt-0 col-top" style="flex:none;width:auto">
                                        <h3 style="text-wrap:nowrap;" class="card-title">
                                            Listado de peas
                                        </h3>
                                    </div>
                                    <div class="col-sm-6 pt-0 col-top" style="width:auto">
                                        <select name="temporada" id="cboTemp" class="form-control select2 select2-dark" data-dropdown-css-class="select2-dark">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="colres" class="col-md-6" style="display: flex; justify-content: center;">
                                <div class="row" style="margin:auto; justify-content:space-between">
                                    <div class="custom-control custom-switch mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label bg-t" for="customSwitch1">Todo</label>
                                    </div>
                                    <div class="custom-control custom-switch mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch4">
                                        <label class="custom-control-label bg-p" for="customSwitch4">Pendiente</label>
                                    </div>
                                    <div class="custom-control custom-switch mr-2">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                        <label class="custom-control-label bg-custom" for="customSwitch2">Aprobado</label>
                                    </div>
                                    <div class="custom-control custom-switch mr-2">
                                        <input type="checkbox" class="custom-control-input " id="customSwitch3">
                                        <label class="custom-control-label bg-c" for="customSwitch3">Corrección</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tblSilabosS1M1" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>CARRERA</th>
                                    <th>MATERIA</th>
                                    <th>PROFESOR</th>
                                    <th>MODALIDAD</th>
                                    <th>DOCUMENTO</th>
                                    <th class="text-center">ESTADO</th>
                                    <th>DIRECCION</th>
                                    <th></th>
                                    <?php if ($_SESSION["mostrarCA"]) : ?>
                                        <th class="text-center">ACCIONES</th>
                                    <?php endif; ?>
                                    <th> OBSERVACIONES: </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.Contenido -->

<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-nuevo ">
            <div class="modal-header header-color-nuevo">
                <h4 class="modal-title title-nuevo">Nuevo Silabo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body scroll-modal">
                <form id="formNuevo" autocomplete="off">
                    <input type="hidden" id="id_asignacion" name="asignacion" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="combo">Profesor</label>
                                <select name="cboProfesor" id="cboProfesor" class="modal2 form-control select2 select2-success" data-dropdown-css-class="select2-dark">
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <div class="row m-0 p-0">
                                    <div class="col-md-12 m-0 p-0">
                                        <div class="row m-0 p-0">
                                            <label class="combo" style="margin-right: 30%;">Materia</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="capel">
                                                <label id="lblcapel" class="custom-control-label bg-custom combo" for="capel">Capel</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <select name="cboMaterias" id="cboMaterias" class="modal2 form-control select2 select2-success col-12" data-dropdown-css-class="select2-dark">
                                    <!-- Opciones del select aquí -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="combo">Semestre</label>
                                <select name="cboPeriodo" id="cboPeriodo" class="modalB form-control select2 select2-success" data-dropdown-css-class="select2-dark">
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="combo">Modalidad</label>
                                <select name="cboHorario" id="cboHorario" class="modalB form-control select2 select2-success" data-dropdown-css-class="select2-dark">
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="combo">Documento</label>
                                <select name="cboDoc" id="cboDoc" class="modalB form-control select2 select2-success" data-dropdown-css-class="select2-dark" aria-placeholder="SELECCIONE UNA OPCION">
                                    <option value="2">PEA</option>
                                    <option value="1">MICRO</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="combo">Año</label>
                                <select name="cboAño" id="cboAño" class="modalB form-control select2 select2-success" data-dropdown-css-class="select2-dark" aria-placeholder="SELECCIONE UNA OPCION">
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-12 py-0 ">
                            <div class="form-group">
                                <label class="combo">Archivo</label>
                                <input id="file_doc" name="file_doc" style="background-color:transparent;color:aliceblue" type="file" class="form-control">
                            </div>
                            <div id="obs" class="form-group">
                                <label class="combo">Observaciones</label>
                                <textarea id="inputObs" class="form-control" rows="2" placeholder="OBSERVACIONES..."></textarea>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="justify-content-between">
                        <button id="btnCancelar" type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
                        <button id="btnAgregar" type="submit" class="btn btn-success"><i class="fa-solid fa-file-circle-plus"></i><span class="button-text"> Agregar</span></button>
                    </div>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal -->
<div id="overlay">
    <div class="loader">
        <img style="width:20%" src="assets/img/loading-29.gif" id="img_carga">
    </div>
</div>


<!-- Modal Date-->
<div class="modal fade" id="modal-date">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-nuevo">
            <div class="modal-header header-color-date">
                <h4 class="modal-title title-nuevo">Confirmar fecha</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group date modal-fecha" id="reservationdate1" data-target-input="nearest">
                    <div class="input-group-append modal-fecha" data-target="#reservationdate1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        <input id="fechaInicio" type="text" class="form-control datetimepicker-input modal-fecha" data-target="#reservationdate1" />
                    </div>
                </div>
                <br>
                <div class="justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
                    <button id="btnConfirmar" type="button" class="btn btn-success"><i class="fa-solid fa-circle-check"></i><span class="button-text"> Confirmar</span></button>
                </div>
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
<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<!-- Agregar la extensión Row Grouping de DataTables -->
<script src="assets/plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('#cboTemp').select2({
            minimumResultsForSearch: -1,
        });

        $('.modalB').select2({
            placeholder: 'SELECCIONA UNA OPCION',
            minimumResultsForSearch: -1,
        }).on('change', function() {
            $(this).trigger('blur');
        });

        $(".modal2").select2({
            placeholder: 'SELECCIONA UNA OPCION',
        }).on('change', function() {
            $(this).trigger('blur');
        })
    })

    // if (window.innerWidth > 768) {
    //     $("body").css("overflow", "hidden");

    //     OverlayScrollbars(document.querySelectorAll('.scroll'), {
    //         // Customize options as needed
    //     });
    // }
    OverlayScrollbars(document.querySelectorAll('.scroll-modal'), {
        autoUpdate: true,
        scrollbars: {
            autoHide: 'leave'
        }
    });
    moment.updateLocale('en', {
        week: {
            dow: 1 // Monday is the first day of the week
        }
    });

    $('.modal-fecha').datetimepicker({
        format: 'L',
        constrainInput: true,
        startDate: 2,
        defaultDate: new Date(),
    });

    var mostrarCV = '<?php echo $_SESSION["mostrarCA"] ?>';
    var permisoE = '<?php echo $_SESSION["permisoEditar"] ?>';
    var permisoA = '<?php echo $_SESSION["permisoAprobar"] ?>';
    var permisoEl = '<?php echo $_SESSION["permisoEliminar"] ?>';
    var accion, opcion, titulo_msj, id_con, id;
    var tbl;
    var id_año;
    var Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 4000,
    });


    var toggles = document.querySelectorAll('input[type="checkbox"]');
    var firstToggle = toggles[6];
    var secondToggle = toggles[7];
    var thirdToggle = toggles[8];
    var fourthToggle = toggles[9];

    var todo = toggles[0]
    var s1m1 = toggles[1]
    var s1m2 = toggles[2]
    var s2m1 = toggles[3]
    var s2m2 = toggles[4]
    var invierno = toggles[5]

    todo.checked = true
    secondToggle.checked = true;
    fourthToggle.checked = true;
    // Agregar evento "change" a cada toggle
    toggles.forEach((toggle, index) => {
        toggle.addEventListener('change', () => {
            if (toggle === firstToggle) {
                // Si el primer toggle se activa, desactivar los otros tres
                if (secondToggle.checked || thirdToggle.checked || fourthToggle.checked) {
                    secondToggle.checked = false;
                    thirdToggle.checked = false;
                    fourthToggle.checked = false;
                }
            } else {
                // Si cualquiera de los otros tres toggles se activa, desactivar el primer toggle
                firstToggle.checked = false;
            }

            // Si todos los otros tres toggles están desactivados, activar el primer toggle
            if (!secondToggle.checked && !thirdToggle.checked && !fourthToggle.checked) {
                firstToggle.checked = true;
            } else if (secondToggle.checked && thirdToggle.checked && fourthToggle.checked) {
                firstToggle.checked = true;
                secondToggle.checked = false;
                thirdToggle.checked = false;
                fourthToggle.checked = false;
            }

            if (toggle === todo) {
                // Si el primer toggle se activa, desactivar los otros tres
                if (s1m1.checked || s1m2.checked || s2m1.checked || s2m2.checked || invierno.checked) {
                    s1m1.checked = false;
                    s1m2.checked = false;
                    s2m1.checked = false;
                    s2m2.checked = false;
                    invierno.checked = false;
                }
            } else {
                // Si cualquiera de los otros tres toggles se activa, desactivar el primer toggle
                todo.checked = false;
            }

            // Si todos los otros tres toggles están desactivados, activar el primer toggle
            if (!s1m1.checked && !s1m2.checked && !s2m1.checked && !s2m2.checked && !invierno.checked) {
                todo.checked = true;
            } else if (s1m1.checked && s1m2.checked && s2m1.checked && s2m2.checked && invierno.checked) {
                todo.checked = true;
                s1m1.checked = false;
                s1m2.checked = false;
                s2m1.checked = false;
                s2m2.checked = false;
                invierno.checked = false;
            }
        });
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

            var añoactual = new Date().getFullYear();
            var options;

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
    var anio = new Date().getFullYear();
    /*===================================================================*/
    // CARGA DEL LISTADO CON EL PLUGIN DATATABLE S1M1 JS
    /*===================================================================*/
    tbl = inicializarDataTable("tblSilabosS1M1");
    // tablaS1M2 = inicializarDataTable("tblSilabosS1M2", 1, 2);
    // tablaS2M1 = inicializarDataTable("tblSilabosS2M1", 1, 3);
    // tablaS2M2 = inicializarDataTable("tblSilabosS2M2", 1, 4);
    // tablaInvierno = inicializarDataTable("tblSilabosInvierno", 1, 5);

    function inicializarDataTable(idTabla) {
        let inicial = "Corrección" + '|' + "Pendiente";
        let columA = 9
        let columO = 10
        if (mostrarCV == false) {
            columA = 10
            columO = 9
        }
        var dataTable = $("#" + idTabla).DataTable({
            ajax: {
                url: "ajax/silabos.ajax.php",
                dataSrc: "",
                type: "POST",
                data: function(d) {
                    d.accion = 1;
                    d.anio = anio;
                }
            },
            ordering: false,
            // select:true,
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            dom: "PBfrtp",
            searchPanes: {
                cascadePanes: true,
                columns: [7, 2, 3, 5],
                initCollapsed: true,
                //threshold: 0.6 // Ajusta este valor según tus necesidades
            },
            columnDefs: [{
                    targets: 0,
                    data: "acciones",
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            return meta.row + 1; // Devuelve el número de fila + 1
                        }
                        return meta.row; // Devuelve el índice de la fila
                    }
                },
                {
                    targets: 1,
                    minWidth: 1000
                },
                {
                    targets: 2,
                    minWidth: 500,
                    visible: true,
                    responsivePriority: 1, // Mayor prioridad para la segunda columna (Columna 2)
                },
                {
                    targets: 3,
                    visible: true,
                    responsivePriority: 1, // Mayor prioridad para la segunda columna (Columna 2)
                },
                {
                    targets: 5,
                    visible: false,
                },

                {
                    targets: 6,
                    render: function(data, type, full, meta) {
                        if (data == 1) {
                            return "<center><span class='badge badge-danger'>Pendiente</span></center>";
                        } else if (data == 2) {
                            return "<center><span class='badge badge-info'>Corrección</span></center>";
                        } else {
                            return "<center><span class='badge badge-success'>Aprobado</span></center>";
                        }
                    }
                },
                {
                    targets: 7,
                    visible: false,
                },
                {
                    targets: 8,
                    visible: false,
                },
                {
                    targets: columA,
                    data: "acciones",
                    // responsivePriority: 2, // Mayor prioridad para la segunda columna (Columna 2)
                    sortable: true,
                    visible: mostrarCV,
                    render: function(data, type, row, full, meta) {
                        if (row.id_micro == 1) {
                            return (
                                "<center style='white-space: nowrap;'>" +
                                (permisoE ?
                                    " <button type='button' class='btn btn-warning btnEditar' data-target='#modal' data-toggle='modal'  title='Editar'>" +
                                    " <i class='fa-solid fa-pencil'></i>" +
                                    "</button> " +
                                    "<button type='button' class='btn btn-info btnLink' title='Abrir documento'><i class='fa-solid fa-link'></i></button>" : "") +
                                (permisoA ?
                                    " <button type='button' class='btn btn-danger btnPendiente'  title='Pendiente'>" +
                                    " <i class='fa-regular fa-clock'></i>" +
                                    "</button>" : "") +
                                (permisoEl ?
                                    " <button type='button' class='btn btn-danger btnEliminar'  title='Eliminar'>" +
                                    " <i class='fa fa-trash'></i>" +
                                    "</button>" : "") +
                                " </center>"
                            );
                        } else if (row.id_micro == 2) {
                            return (
                                "<center style='white-space: nowrap;'>" +
                                (permisoE ?
                                    " <button type='button' class='btn btn-warning btnEditar' data-target='#modal' data-toggle='modal'  title='Editar'>" +
                                    " <i class='fa-solid fa-pencil'></i>" +
                                    "</button> " +
                                    "<button type='button' class='btn btn-info btnLink' title='Abrir documento'><i class='fa-solid fa-link'></i></button>" : "") +
                                (permisoA ?
                                    " <button type='button' class='btn btn-info btnCorregir' data-target='#modal-date' data-toggle='modal' title='Corregir'>" +
                                    " <i class='fa-solid fa-eye'></i>" +
                                    "</button>" : "") +
                                (permisoEl ?
                                    " <button type='button' class='btn btn-danger btnEliminar'  title='Eliminar'>" +
                                    " <i class='fa fa-trash'></i>" +
                                    "</button>" : "") +
                                " </center>"
                            );
                        } else {
                            return (
                                "<center style='white-space: nowrap;'>" +
                                (permisoE ?
                                    " <button type='button' class='btn btn-warning btnEditar' data-target='#modal' data-toggle='modal'  title='Editar'>" +
                                    " <i class='fa-solid fa-pencil'></i>" +
                                    "</button>" +
                                    "<button type='button' class='btn btn-info btnLink' title='Abrir documento'><i class='fa-solid fa-link'></i></button>" : "") +
                                (permisoA ?
                                    " <button type='button' class='btn btn-success btnAprobado'  title='Aprobado'>" +
                                    " <i class='fa-solid fa-check-to-slot'></i>" +
                                    "</button>" : "") +
                                (permisoEl ?
                                    " <button type='button' class='btn btn-danger btnEliminar'  title='Eliminar'>" +
                                    " <i class='fa fa-trash'></i>" +
                                    "</button>" : "") +
                                " </center>"
                            );
                        }
                    },
                },
                {
                    targets: columO,
                    visible: true,
                },
            ],
            rowGroup: {
                dataSrc: 7, // Aquí especificas el índice de la columna para agrupar (indexado desde 0).
            },
            buttons: [{
                extend: "colvis",
                // columns: [0, 1, 2, 3, 4, 5],
            }, ],
        });
        dataTable.column(6).search(inicial, true, false).draw();
        return dataTable;
    }
    var body = document.querySelector("body");
    var control = body.querySelector('#btnSide');

    control.addEventListener("click", () => {
        if ((body.classList.contains("sidebar-collapse"))) {
            setTimeout(() => {
                tbl.columns.adjust().responsive.recalc();
            }, 200);
        }
    });

    // //ADAPTA ESTADO RESPONSIVO A LA PESTAÑA ACTIVA 
    // $('a[data-toggle="pill"]').on("shown.bs.tab", function(e) {
    //     $($.fn.dataTable.tables(true))
    //         .DataTable()
    //         .columns.adjust()
    //         .responsive.recalc();
    // });

    // SOLICITUD AJAX PARA CARGAR COMBOS
    for (let combo = 1; combo <= 5; combo++) {
        $.ajax({
            url: "ajax/combos.ajax.php",
            cache: false,
            method: "POST",
            dataType: "json",
            data: {
                combo: combo
            },
            success: function(respuesta) {
                var options;
                if (combo == 5) {
                    var añoactual = new Date().getFullYear();
                    for (let index = 0; index < respuesta.length; index++) {
                        if (añoactual == respuesta[index][1]) {
                            options =
                                options +
                                "<option selected value=" +
                                respuesta[index][0] +
                                ">" +
                                respuesta[index][1] +
                                "</option>";
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
                    $("#cboAño").html(options);
                } else {
                    for (let index = 0; index < respuesta.length; index++) {
                        options = options + "<option value=" + respuesta[index][0] + ">" + respuesta[index][1] + "</option>";
                    }
                    if (combo == 1) {
                        $("#cboProfesor").html(options);
                    } else if (combo == 2) {
                        $("#cboMaterias").html(options);
                    } else if (combo == 3) {
                        $("#cboHorario").html(options);
                    } else if (combo == 4) {
                        $("#cboPeriodo").html(options);
                    } else if (combo == 5) {
                        $("#cboAño").html(options);
                    }
                }
            },
        });
    }

    $(".table tbody").on("click", ".btnPendiente", function() {
        Swal.fire({
            title: '¿Está seguro de que deseas cambiar el estado a corrección?',
            icon: 'warning',
            showCancelButton: true, // Muestra los botones "Sí, cambiar" y "Cancelar"
            confirmButtonText: "Sí, cambiar",
            confirmButtonColor: '#b7040f',
            cancelButtonText: "Cancelar",
            cancelButtonColor: '#454d5e',
            timer: 3000, // El SweetAlert2 se cerrará automáticamente después de 3 segundos (3000 milisegundos)
            timerProgressBar: true, // Muestra una barra de progreso durante el tiempo especificado por 'timer'
            // Impide que el SweetAlert2 se cierre haciendo clic fuera de él
            allowEscapeKey: false // Impide que el SweetAlert2 se cierre al presionar la tecla 'Esc'
        }).then((result) => {
            if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                // Si el usuario hace clic en "Sí, cambiar" o el tiempo se agota y se cierra automáticamente
                let {
                    row
                } = obtenerPestaña(this);
                id = row["id_asignacion"];
                estado = 2;
                fecha_actual = new Date();
                fecha_actual = `${fecha_actual.getFullYear()}-${('0' + (fecha_actual.getMonth() + 1)).slice(-2)}-${('0' + fecha_actual.getDate()).slice(-2)}`;

                $.ajax({
                    url: "ajax/silabos.ajax.php",
                    data: {
                        accion: 2,
                        id,
                        estado,
                        fecha_actual
                    },
                    method: "POST",
                    success: function(resp) {
                        // cambiarDatos(id_año);
                        tbl.ajax.reload(null, false);
                        estado = null;
                    },
                });
            }
        })
    });

    $(".table tbody").on("click", ".btnCorregir", function() {
        let {
            row
        } = obtenerPestaña(this);
        id = row["id_asignacion"];
    });

    $(".table tbody").on("click", ".btnLink", function() {
        let {
            row
        } = obtenerPestaña(this);
        console.log(row)
        let link = 'https://docs.google.com/document/d/' + row["id_drive"];

        window.open(link, '_blank');

    });

    $(".table tbody").on("click", ".btnAprobado", function() {
        Swal.fire({
            title: '¿Está seguro de que deseas cambiar el estado a pendiente?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Sí, cambiar",
            confirmButtonColor: '#b7040f',
            cancelButtonText: "Cancelar",
            cancelButtonColor: '#454d5e'
        }).then((r) => {
            if (r.value) {
                let {
                    row
                } = obtenerPestaña(this);
                id = row["id_asignacion"];
                estado = 1;
                fecha_actual = new Date();
                fecha_actual = `${fecha_actual.getFullYear()}-${('0' + (fecha_actual.getMonth() + 1)).slice(-2)}-${('0' + fecha_actual.getDate()).slice(-2)}`;
                $.ajax({
                    url: "ajax/silabos.ajax.php",
                    data: {
                        accion: 2,
                        id,
                        estado,
                        fecha_actual
                    },
                    method: "POST",
                    success: function(resp) {
                        // cambiarDatos(id_año)
                        tbl.ajax.reload(null, false);
                        estado = null;
                    },
                });
            }
        });
    });

    $("#modal-date").on("shown.bs.modal", function() {
        $("#btnConfirmar").focus();
    });

    document.getElementById("btnConfirmar").addEventListener("click", function() {

        estado = 3;
        fecha_actual = $('#fechaInicio').val();
        fecha_actual = fecha_actual.split('/');
        fecha_actual = fecha_actual.reverse().join('-');

        $.ajax({
            url: "ajax/silabos.ajax.php",
            data: {
                accion: 2,
                id,
                estado,
                fecha_actual
            },
            method: "POST",
            success: function(resp) {
                $("#modal-date").modal('hide');
                if (resp == '"ok"') {
                    Toast.fire({
                        icon: 'success',
                        title: ' Silabo aprobado con exito',
                    });
                    // cambiarDatos(id_año)
                    tbl.ajax.reload(null, false);
                    estado = null;
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: ' El silabo no se pudo aprobar'
                    });
                }

            },
        });
    });

    $("#btnNuevo").on("click", function() {
        accion = 3;
        if ($("#btnAgregar").hasClass("btn-warning")) {
            $(".header-color-nuevo").css("background-color", "");
            $(".modal-title").text("Nuevo Silabo");
            $("#btnAgregar .button-text").text(" Agregar");
            $("#btnAgregar").removeClass("btn-warning");
            $("#btnAgregar").addClass("btn-success");
            $("#btnAgregar").find("i").removeClass("fa-pen-to-square");
            $("#btnAgregar").find("i").addClass("fa-file-circle-plus");
            $(".comboE").addClass("combo");
            $(".comboE").removeClass("comboE");
            $("#lblcapel").addClass("bg-custom");
            $("#lblcapel").removeClass("bg-i");
            $(".select2-warning").addClass("select2-success");
            $(".select2-warning").removeClass("select2-warning");
        }
        $("#obs").css("display", "none");
        $("#cboProfesor").val(0).trigger("change");
        $("#cboMaterias").val(0).trigger("change");
        $("#cboHorario").val(0).trigger("change");
        $("#cboPeriodo").val(0).trigger("change");

    });

    $('#modal').on('hidden.bs.modal', function() {
        $('form').validate().resetForm();
    });

    $(".table tbody").on("click", ".btnEliminar", function() {
        id_año = $("#cboTemp").val();
        let {
            row,
        } = obtenerPestaña(this);
        let id_asignacion = row["id_asignacion"];
        accion = 4;
        var src = new FormData();
        src.append("accion", accion);
        src.append("id_asignacion", id_asignacion);
        swal.fire({
            title: "¿Esta seguro de eliminar este silabo?",
            text: "Una vez eliminado no podra recuperarlo!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, Eliminar",
            cancelButtonText: "Cancelar",
        }).then((r) => {
            if (r.value) {
                //LLAMADO AJAX
                $.ajax({
                    url: "ajax/silabos.ajax.php",
                    method: "POST",
                    data: src,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta) {
                        // cambiarDatos(id_año);
                        tbl.ajax.reload(null, false);
                        Toast.fire({
                            icon: "success",
                            title: respuesta,
                        });
                    },
                });
            } else {}
        });
    });

    $(".table tbody").on("click", ".btnEditar", function() {
        let {
            row
        } = obtenerPestaña(this);
        accion = 10;
        $(".header-color-nuevo").css("background-color", "rgb(255 193 7 / 56%)");
        $(".modal-title").text("Editar Silabo");
        $("#btnAgregar .button-text").text(" Editar");
        $("#btnAgregar").removeClass("btn-success");
        $("#btnAgregar").addClass("btn-warning");
        $("#btnAgregar").find("i").removeClass("fa-file-circle-plus");
        $("#btnAgregar").find("i").addClass("fa-pen-to-square");
        $(".combo").addClass("comboE");
        $(".combo").removeClass("combo");
        $("#lblcapel").addClass("bg-i");
        $("#lblcapel").removeClass("bg-custom");
        $("#obs").css("display", "block");
        $(".select2-success").addClass("select2-warning");
        $(".select2-success").removeClass("select2-success");
        $("#id_asignacion").val(row["id_asignacion"]);
        $("#cboProfesor").val(row["id_profesor"]).trigger("change");
        $("#cboMaterias").val(row["id_materia"]).trigger("change");
        $("#cboHorario").val(row["id_horario"]).trigger("change");
        $("#cboPeriodo").val(row["id_periodo"]).trigger("change");
        $("#cboDoc").val(row["id_doc"]).trigger("change");
        $("#inputObs").val(row["comentario"]);
        $("#capel").prop("checked", row["capel"]);
        $("#cboAño").val($("#cboTemp").val()).trigger("change");
    });

    $('#btnAgregar').on('click', function(event) {
        $('#formNuevo').submit(); // Manually trigger form submission
    });

    $('#formNuevo').validate({
        ignore: [],
        rules: {
            cboHorario: {
                required: true
            },
            cboProfesor: {
                required: true
            },
            cboMaterias: {
                required: true
            },
            cboPeriodo: {
                required: true
            },
            file_doc: {
                required: true
            }
        },
        messages: {
            cboHorario: {
                required: "*Este campo es requerido."
            },
            cboProfesor: {
                required: "*Este campo es requerido."
            },
            cboMaterias: {
                required: "*Este campo es requerido."
            },
            cboPeriodo: {
                required: "*Este campo es requerido."
            },
            file_doc: {
                required: "*Este campo es requerido."
            }
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function(_form) {
            if (accion == 10) {
                opcion = "editar";
                titulo_msj = "editó";
            } else {
                opcion = "agregar";
                titulo_msj = "agregó";
            }
            Swal.fire({
                title: '¿Está seguro de ' + opcion + ' el silabo?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Sí, " + opcion,
                confirmButtonColor: '#b7040f',
                cancelButtonText: "Cancelar",
                cancelButtonColor: '#454d5e'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    // event.preventDefault();
                    $("#modal").modal('hide');
                    $('#overlay').show();
                    var repositorio = new Repositorio();
                    const archivoSeleccionado = document.getElementById("file_doc").files[0];
                    if (archivoSeleccionado) {
                        var respuesta_drive = await repositorio.crearArchivo(archivoSeleccionado);
                        console.log(respuesta_drive["id"] + 'id del archivo sapo')

                    }
                    let id_periodo = $("#cboPeriodo").val();
                    let datos = new FormData();
                    datos.append("accion", accion);
                    datos.append("id_asignacion", $("#id_asignacion").val()); // ID
                    datos.append("id_profesor", $("#cboProfesor").val()); //Profesor
                    datos.append("id_materia", $("#cboMaterias").val()); //Materias
                    datos.append("id_horario", $("#cboHorario").val()); //Horario
                    datos.append("id_periodo", id_periodo); //Periodo Semestre/Modulo
                    datos.append("id_doc", $("#cboDoc").val()); //TIPO DE DOCUMENTO
                    datos.append("id_año", $("#cboAño").val()); //AÑO
                    datos.append("id_drive", respuesta_drive["id"]);
                    datos.append("capel", $("#capel").prop("checked"));
                    datos.append("capel", $("#capel").prop("checked"));
                    console.log($("#capel").prop("checked")) //Capel 

                    if (opcion == "editar") {
                        datos.append("comentario", $("#inputObs").val()); //Comentario
                    }
                    $.ajax({
                        url: "ajax/silabos.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {
                            if (respuesta == "ok") {
                                $('#overlay').hide();

                                Toast.fire({
                                    icon: 'success',
                                    title: 'El silabo se ' + titulo_msj + ' correctamente'
                                });
                                //TABLA S1M2 AJAX
                                // cambiarDatos(id_año);
                                tbl.ajax.reload(null, false);

                                $("#id_asignacion").val("");
                            } else if (respuesta == "V") {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'No se puede agregar el silabo debido a que ya existe uno con los mismos datos'
                                });
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'El silabo no se pudo ' + opcion
                                });
                            }
                        }
                    });
                }
            })
        }
    });

    $("#cboTemp").on("change", function() {
        id_año = $(this).val();
        anio = this.options[this.selectedIndex].text;
        tbl.ajax.reload(null, false);
    });

    $('#capel').on("change", function() {
        var checkbox = document.getElementById("capel");
        var estadoCheckbox = checkbox.checked;
        console.log(estadoCheckbox)
    });


    $('#ckTodo').change(function() {
        limpiar(this, 8)
    });

    $('#ckS1M1').change(function() {
        filtrarPeriodo(this, s1m2, s2m1, s2m2, invierno)
    });

    $('#ckS1M2').change(function() {
        filtrarPeriodo(this, s1m1, s2m1, s2m2, invierno)

    });

    $('#ckS2M1').change(function() {
        filtrarPeriodo(this, s1m1, s1m2, s2m2, invierno)
    });

    $('#ckS2M2').change(function() {
        filtrarPeriodo(this, s1m1, s1m2, s2m1, invierno)
    });

    $('#ckInvierno').change(function() {
        filtrarPeriodo(this, s1m1, s1m2, s2m1, s2m2)
    });




    $('#customSwitch1').on("change", function() {
        limpiar(this, 6)
    });

    $('#customSwitch2').on("change", function() {
        filtrar(this, secondToggle, fourthToggle, 'Aprobado', 'Pendiente', 'Corrección')

    });

    $('#customSwitch3').on("change", function() {
        filtrar(this, secondToggle, thirdToggle, 'Corrección', 'Pendiente', 'Aprobado')
    });

    $('#customSwitch4').on("change", function() {
        filtrar(this, thirdToggle, fourthToggle, 'Pendiente', 'Aprobado', 'Corrección')
    });


    function filtrar(s, t1, t2, filtro, filtro1, filtro2) {
        const filtroActual = [];

        if (s.checked) {
            filtroActual.push(filtro);
        }
        if (t1.checked) {
            filtroActual.push(filtro1);
        }
        if (t2.checked) {
            filtroActual.push(filtro2);
        }

        const filtroCombinado = filtroActual.join('|');
        tbl.column(6).search(filtroCombinado, true, false).draw();

    }

    function filtrarPeriodo(p, p1, p2, p3, p4) {
        const filtroActualP = [];

        if (p.checked) {
            filtroActualP.push(p.value);
        }
        if (p1.checked) {
            filtroActualP.push(p1.value);
        }
        if (p2.checked) {
            filtroActualP.push(p2.value);
        }
        if (p3.checked) {
            filtroActualP.push(p3.value);
        }
        if (p4.checked) {
            filtroActualP.push(p4.value);
        }

        const filtroCombinadoP = filtroActualP.join('|');
        tbl.column(8).search(filtroCombinadoP, true, false).draw();
        tbl.columns.adjust().responsive.recalc();


    }




    function limpiar(s, n) {
        if (s.checked) {
            tbl.column(n).search('').draw();
            tbl.columns.adjust().responsive.recalc();
        }
    }

    function cambiarDatos(id_año) {
        var paginaActual = tbl.page();
        console.log("pagina actual antes de la llamada ajax pendiente ", paginaActual)

        $.ajax({
            url: "ajax/silabos.ajax.php",
            data: {
                accion: 11,
                id_año
            },
            method: "POST",
            success: function(data) {
                // let datos = JSON.parse(data);
                // tbl.clear();
                // tbl.rows.add(datos);
                // tbl.draw();
                // tbl.page(paginaActual).draw(false);
                tbl.searchPanes.rebuildPane();
                tbl.ajax.reload(null, false);
            },
        })
    }

    function obtenerPestaña(fila) {

        let row = tbl.row($(fila).parents("tr")).data();
        if (tbl.row(fila).child.isShown()) {
            //cuando esta en tamaño responsivo
            row = tbl.row(fila).data();
        }
        return {
            row: row
        };
    }
</script>