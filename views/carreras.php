<?php session_start(); ?>

<head>
    <title>Carrera</title>
</head>
<!-- Contenido Header -->
<section class="content-header stick-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row ml-0">
                    <h1 class="mr-3 mb-2">Carrera</h1>
                    <div class="row ml-0">
                        <?php if ($_SESSION["permisoCrear"]) : ?>
                            <button id="btnNuevo" class="btn btn-success mr-2" data-toggle="modal" data-target="#modal-danger">
                                <i class="fa fa-plus"></i> Nueva carrera</button>
                            <button id="btnDireccion" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-danger1">
                                <i class="fa fa-plus"></i> Nueva dirección</button>
                        <?php endif; ?>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listado de carreras</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">CARRERAS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">DIRECCIÓN</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                <table id="tblCarreras" class="table table-bordered table-striped nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>CARRERA</th>
                                            <th>MODALIDAD</th>
                                            <?php if ($_SESSION["mostrarCV"]) : ?>
                                                <th class="text-center">ACCIONES</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                <table id="tblDireccion" class="table table-bordered table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>DIRECCIÓN DE CARRERA</th>
                                            <?php if ($_SESSION["mostrarCV"]) : ?>
                                                <th class="text-center">ACCIONES</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
<!-- /.Contenido -->

<!-- Modal -->
<div class="modal fade" id="modal-danger">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-nuevo">
            <div class="modal-header header-color-nuevo">
                <h4 class="modal-title title-nuevo">Nueva Carrera</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body scroll scroll-modal">
                <form id="formNuevo" autocomplete="off">
                    <input type="hidden" id="id_carrera" name="carrera" value="">
                    <div class="form-row-nuevo">
                        <div class="input-data" style="margin-top:42px;">
                            <input id="nombre" class="input-nuevo" type="text" required>
                            <div id="line" class="underline"></div>
                            <label id="label" class="label">Nombre de la carrera</label>
                        </div>
                        <!-- <div class="form-group">
                            <label style="font-size: 18px;" class="combo">Dirección de carrera</label>
                            <select name="cboDireccion" id="cboDireccion" class="form-control select2 select2-success" data-dropdown-css-class="select2-dark">
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label style="font-size: 18px;" class="combo">Nivel</label>
                            <select name="cboNivel" id="cboNivel" class="form-control select2 select2-success" data-dropdown-css-class="select2-dark">
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="font-size: 18px;" class="combo">Materias</label>
                            <div class="select2-green">
                                <select id="multiple" class="select2 multiple2" multiple="multiple" data-placeholder="SELECCIONA UNA MATERIA" data-dropdown-css-class="select2-dark" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
                        <button id="btnAgregar" type="button" class="btn btn-success"><i class="fa-solid fa-graduation-cap"></i><span class="button-text"> Agregar</span></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal -->

<!-- Modal -->
<div class="modal fade" id="modal-danger1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-nuevo">
            <div class="modal-header header-color-nuevo">
                <h4 class="modal-title title-nuevo">Nueva Dirección de Carrera</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formNuevoD" autocomplete="off">
                    <input type="hidden" id="id_direccion" name="direccion" value="">
                    <div class="form-row-nuevo">
                        <div class="input-data">
                            <input id="nombreD" class="input-nuevo" type="text" required>
                            <div id="lineD" class="underline"></div>
                            <label id="labelD" class="label">Dirección de carrera</label>
                        </div>
                    </div>
                    <br>
                    <div class="justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
                        <button id="btnAgregarD" type="button" class="btn btn-success"><i class="fa-solid fa-school mr-1"></i><span class="button-text"> Agregar</span></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal -->

<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>


<script>
    $(document).ready(function() {
        $('.multiple2').select2({
            closeOnSelect: true,
            sorter: function(data) {
                return data;
            }
        });

        $('.multiple2').on('select2:select', function(e) {
            //Append selected element to the end of the list, otherwise it follows the same order as the dropdown
            var element = e.params.data.element;
            var $element = $(element);
            $(this).append($element);
            $(this).trigger("change");
        })
    });

    $('#multiple').select2({
        sorter: sorter
    })

    function sorter(data) {
        return data.sort(customSort);
    }

    function customSort(a, b) {
        if (a.text < b.text) {
            return -1;
        }
        if (a.text > b.text) {
            return 1;
        }
        return 0;
    }

    $.ajax({
        url: "ajax/combos.ajax.php",
        cache: false,
        method: "POST",
        dataType: "json",
        data: {
            combo: 2
        },
        success: function(respuesta) {
            var options;
            for (let index = 0; index < respuesta.length; index++) {
                options = options + "<option value=" + respuesta[index][0] + ">" + respuesta[index][1] + "</option>";
            }
            $("#multiple").html(options);
        },
    });

    $("#modal-danger").on("shown.bs.modal", function() {
        $("#nombre").focus();
    });

    $("#modal-danger1").on("shown.bs.modal", function() {
        $("#nombreD").focus();
    });

    $('#modal-danger').on('hidden.bs.modal', function() {
        $("#multiple").val([]);
        $("#multiple").select2();
    });
    // OverlayScrollbars(document.querySelectorAll('.scroll'), {});
    OverlayScrollbars(document.querySelectorAll('.scroll-modal'), {
        autoUpdate: true,
        scrollbars: {
            autoHide: 'leave'
        }
    });
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('#cboNivel').select2({
            minimumResultsForSearch: -1,
            placeholder: 'SELECCIONA UN NIVEL'
        })
        // $('#cboDireccion').select2({
        //     placeholder: 'SELECCIONA UNA DIRECCIÓN'
        // })
        var mostrarCV = '<?php echo $_SESSION["mostrarCV"] ?>';
        var permisoE = '<?php echo $_SESSION["permisoEditar"] ?>';
        var permisoEl = '<?php echo $_SESSION["permisoEliminar"] ?>';
        var accion = "";
        var opcion = 0;
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        //AGREGAR INFORMACION CARRERA
        var tabla = $('#tblCarreras').DataTable({
            "ajax": {
                "url": "ajax/carreras.ajax.php",
                "type": "POST",
                "dataSrc": "",
                "cache": false,
                "data": {
                    accion: 1
                }
            },
            mark: {
                separateWordSearch: false
            },
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "info":false,
            "columnDefs": [{
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
                    "targets": 2,
                    visible: mostrarCV,
                    "render": function(data, type, row, full, meta) {
                        return (
                            "<center style='white-space: nowrap;'>" +
                            (permisoE ?
                                " <button type='button' class='btn btn-warning btnEditar' data-target='#modal-danger' data-toggle='modal'  title='Editar'>" +
                                " <i class='fa-solid fa-pencil'></i>" +
                                "</button>" : "") +
                            (permisoEl ?
                                " <button type='button' class='btn btn-danger btnEliminar'  title='Eliminar'>" +
                                " <i class='fa fa-trash'></i>" +
                                "</button>" : "") +
                            " </center>"
                        );
                    }
                }
            ],
        });

        var tblDireccion = $('#tblDireccion').DataTable({
            "ajax": {
                "url": "ajax/direccion.ajax.php",
                "type": "POST",
                "dataSrc": ""
            },
            mark: {
                separateWordSearch: false
            },
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "info":false,
            "columnDefs": [{
                    "targets": 0,
                    "visible": false
                },
                {
                    "targets": 2,
                    visible: mostrarCV,
                    "render": function(data, type, full, meta) {
                        return (
                            "<center style='white-space: nowrap;'>" +
                            (permisoE ?
                                " <button type='button' class='btn btn-warning btnEditar' data-target='#modal-danger1' data-toggle='modal'  title='Editar'>" +
                                " <i class='fa-solid fa-pencil'></i>" +
                                "</button>" : "") +
                            (permisoEl ?
                                " <button type='button' class='btn btn-danger btnEliminar'  title='Eliminar'>" +
                                " <i class='fa fa-trash'></i>" +
                                "</button>" : "") +
                            " </center>"
                        );
                    }
                }
            ],

        });

        $('a[data-toggle="pill"]').on("shown.bs.tab", function(e) {
            $($.fn.dataTable.tables(true))
                .DataTable()
                .columns.adjust()
                .responsive.recalc();
        });

        // SOLICITUD AJAX PARA CARGAR COMBO NIVEL
        $.ajax({
            url: "ajax/combos.ajax.php",
            cache: false,
            method: 'POST',
            dataType: 'json',
            data: {
                'combo': 8
            },

            success: function(respuesta) {

                var options; //= '<option selected value="0">SELECCIONA UN NIVEL</option>';

                for (let index = 0; index < respuesta.length; index++) {
                    options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][1] + '</option>';
                }
                $("#cboNivel").html(options);
            }
        });

        $("#btnNuevo").on('click', function() {
            accion = "agregar";
            opcion = 3
            $(".modal-title").text("Nueva Carrera");
            
                $(".header-color-nuevo").css("background-color", "");
                $('#btnAgregar').removeClass('btn-warning');
                $("#btnAgregar").addClass('btn-success');
                $("#btnAgregar .button-text").text(" Agregar");
                $("#btnAgregar").find("i").removeClass("fa-pen-to-square");
                $("#btnAgregar").find("i").addClass("fa-graduation-cap");
                $('.comboE').addClass('combo');
                $('.comboE').removeClass('comboE');
                $('.select2-warning').addClass('select2-success');
                $('.select2-warning').removeClass('select2-warning');
                $('.select2-yellow').addClass('select2-green');
                $('.select2-yellow').removeClass('select2-yellow');
                $('#line').removeClass('underedit');
                $('#line').addClass('underline');
                $('#label').removeClass('labele');
                $('#label').addClass('label');
            
            $("#formNuevo").trigger("reset");
            $('#cboNivel').val(0).trigger('change');
            $("#multiple").val([]);
            $("#multiple").select2();
        });

        $("#btnDireccion").on('click', function() {
            accion = "agregar";
            $(".modal-title").text("Nueva Dirección de Carrera");
            $(".header-color-nuevo").css("background-color", "");
            $('#btnAgregarD').removeClass('btn-warning');
            $("#btnAgregarD").addClass('btn-success');
            $("#btnAgregarD .button-text").text(" Agregar");
            $("#btnAgregarD").find("i").removeClass("fa-pen-to-square");
            $("#btnAgregarD").find("i").addClass("fa-school");
            $('.comboE').addClass('combo');
            $('.comboE').removeClass('comboE');
            $('.select2-warning').addClass('select2-success');
            $('.select2-warning').removeClass('select2-warning');
            $('#lineD').removeClass('underedit');
            $('#lineD').addClass('underline');
            $('#labelD').removeClass('labele');
            $('#labelD').addClass('label');
            $("#formNuevoD").trigger("reset");
        });

        $('#tblDireccion tbody').on('click', '.btnEliminar', function() {
            var e = tblDireccion.row($(this).parents('tr')).data();

            if (tblDireccion.row(this).child.isShown()) { //Cuando esta en tamaño responsivo
                e = tblDireccion.row(this).data();
            }
            var id_direccion = e["id_direccion"];

            var src = new FormData();
            src.append('accion', 'delete');
            src.append('id_direccion', id_direccion);

            swal.fire({
                title: "¿Esta seguro de eliminar esta dirección?",
                text: "Una vez eliminado no podra recuperarlo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Sí, Eliminar",
                cancelButtonText: "Cancelar"
            }).then(r => {
                if (r.value) {
                    //LLAMADO AJAX
                    $.ajax({
                        url: "ajax/direccion.ajax.php",
                        method: "POST",
                        data: src,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(respuesta) {
                            tblDireccion.ajax.reload(null, false);
                            Toast.fire({
                                icon: 'success',
                                title: respuesta
                            });
                        }
                    })
                }
            })
        });

        $('#tblCarreras tbody').on('click', '.btnEliminar', function() {
            var e = tabla.row($(this).parents('tr')).data();

            if (tabla.row(this).child.isShown()) { //Cuando esta en tamaño responsivo
                e = tabla.row(this).data();
            }
            var id_carrera = e["id_carrera"];

            var src = new FormData();
            src.append('accion', 'delete');
            src.append('id_carrera', id_carrera);
            swal.fire({

                title: "¿Esta seguro de eliminar esta carrera?",
                text: "Una vez eliminado no podra recuperarlo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Sí, Eliminar",
                cancelButtonText: "Cancelar"
            }).then(r => {
                if (r.value) {
                    $.ajax({
                        url: "ajax/carreras.ajax.php",
                        method: "POST",
                        data: src,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(respuesta) {
                            tabla.ajax.reload(null, false);
                            Toast.fire({
                                icon: 'success',
                                title: respuesta
                            });
                        }
                    })
                }
            })
        });

        $('#tblDireccion tbody').on('click', '.btnEditar', function() {
            let row = tblDireccion.row($(this).parents('tr')).data();

            if (tblDireccion.row(this).child.isShown()) { //cuando esta en tamaño responsivo
                row = tblDireccion.row(this).data();
            }
            accion = "editar";
            $(".header-color-nuevo").css("background-color", "rgb(255 193 7 / 56%)");
            $(".modal-title").text("Editar Dirección de Carrera");
            $('.combo').addClass('comboE');
            $('.combo').removeClass('combo');
            $('.select2-success').addClass('select2-warning');
            $('.select2-success').removeClass('select2-success');
            $("#btnAgregarD .button-text").text(" Editar");
            $('#btnAgregarD').removeClass('btn-success');
            $("#btnAgregarD").addClass('btn-warning');
            $("#btnAgregarD").find("i").removeClass("fa-school");
            $("#btnAgregarD").find("i").addClass("fa-pen-to-square");
            $('#lineD').removeClass('underline');
            $('#lineD').addClass('underedit');
            $('#labelD').removeClass('label');
            $('#labelD').addClass('labele');
            $("#id_direccion").val(row["id_direccion"]);

            $("#nombreD").val(row["direccion"]);
        });

        $('#tblCarreras tbody').on('click', '.btnEditar', function() {
            let row = tabla.row($(this).parents('tr')).data();

            if (tabla.row(this).child.isShown()) { //cuando esta en tamaño responsivo
                row = tabla.row(this).data();
            }
            accion = "editar";
            opcion = 5
            $(".header-color-nuevo").css("background-color", "rgb(255 193 7 / 56%)");
            $(".modal-title").text("Editar Carrera");
            $('.combo').addClass('comboE');
            $('.combo').removeClass('combo');
            $('.select2-success').addClass('select2-warning');
            $('.select2-success').removeClass('select2-success');
            $("#btnAgregar .button-text").text(" Editar");
            $('#btnAgregar').removeClass('btn-success');
            $("#btnAgregar").addClass('btn-warning');
            $("#btnAgregar").find("i").removeClass("fa-graduation-cap");
            $("#btnAgregar").find("i").addClass("fa-pen-to-square");
            $('#line').removeClass('underline');
            $('#line').addClass('underedit');
            $('#label').removeClass('label');
            $('#label').addClass('labele');
            $('.select2-green').addClass('select2-yellow');
            $('.select2-green').removeClass('select2-green');
            $("#id_carrera").val(row["id_carrera"]);
            // $('#cboDireccion').val(row["id_direccion"]).trigger('change');
            $('#cboNivel').val(row["id_nivel"]).trigger('change');
            $("#nombre").val(row["nombre_carrera"]);
            let m = convertirArray(row["materias_relacionadas"]);
            console.log(row["materias_relacionadas"])
            m = JSON.parse(m);
            $("#multiple").val(m);
            $("#multiple").select2();
        });

        $(".input-nuevo").on("keypress", function(event) {
            if (event.which === 13) {
                $("#btnAgregar").click();
            }
        });

        $("#formNuevo").submit(function(e) {
            e.preventDefault();
            document.getElementById("btnAgregar").click();
        })

        $("#formNuevoD").submit(function(e) {
            e.preventDefault();
            document.getElementById("btnAgregarD").click();
        })

        $("#btnAgregar").on('click', function(event) {
            event.preventDefault();
            let multi = $("#multiple").val();
            var input = $("#nombre").val().trim().toUpperCase();
            // var selectD = $("#cboDireccion").val();
            var selectN = $("#cboNivel").val();

            if (input == "" || selectN == null || multi.length === 0) {
                Swal.fire({
                    title: '¡Error!',
                    text: 'Completa todos los campos requeridos',
                    icon: 'error',
                    confirmButtonText: "OK",
                    confirmButtonColor: '#b7040f',
                })
            } else {
                var id_carrera = $("#id_carrera").val()
                var datos = new FormData();
                datos.append('id_carrera', id_carrera);
                // datos.append('id_direccion', selectD);
                // datos.append('id_materia', id_materia);
                datos.append('id_nivel', selectN);
                datos.append('nombre_carrera', input);
                datos.append('accion', accion);
                swal.fire({
                    title: '¡Confirmar!',
                    text: '¿Estas seguro que deseas ' + accion + ' la carrera?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Si, " + accion,
                    confirmButtonColor: '#b7040f',
                    cancelButtonText: "Cancelar",
                    cancelButtonColor: '#454d5e'
                }).then(resultado => {
                    if (resultado.value) {
                        $.ajax({
                            url: "ajax/carreras.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(resp) {
                                if (opcion == 3) {
                                    const ajaxPromises = [];
                                    for (let i = 0; i < multi.length; i++) {
                                        ajaxPromises.push(
                                            $.ajax({
                                                url: "ajax/carreras.ajax.php",
                                                method: "POST",
                                                data: {
                                                    relacion: 1,
                                                    id_materia: multi[i]
                                                },
                                                success: function(respuesta) {
                                                    
                                                }
                                            })
                                        );
                                    }

                                    Promise.all(ajaxPromises).then(function() {
                                        // Todas las llamadas AJAX dentro del bucle han terminado.
                                        // Ahora puedes realizar otras acciones, como recargar la tabla.
                                        $("#modal-danger").modal('hide');
                                        tabla.ajax.reload(null, false);
                                        $("#id_carrera").val("");
                                        $("#nombre").val("");
                                        $("#multiple").val([]);
                                        $("#multiple").select2();
                                        Toast.fire({
                                            icon: 'success',
                                            title: resp
                                        });
                                    });
                                } else if (opcion == 5) {
                                    $.ajax({
                                        url: "ajax/carreras.ajax.php",
                                        method: "POST",
                                        data: {
                                            relacion: 2,
                                            id_carrera
                                        },
                                        success: function(respuesta) {
                                            const ajaxPromises = [];
                                            for (let i = 0; i < multi.length; i++) {
                                                ajaxPromises.push(
                                                    $.ajax({
                                                        url: "ajax/carreras.ajax.php",
                                                        method: "POST",
                                                        data: {
                                                            relacion: 3,
                                                            id_materia: multi[i],
                                                            id_carrera
                                                        },
                                                        success: function(respuesta) {
                                                            // Aquí puedes agregar código relacionado con la respuesta si es necesario.
                                                        }
                                                    })
                                                );
                                            }
                                            Promise.all(ajaxPromises).then(function() {
                                                // Todas las llamadas AJAX dentro del bucle han terminado.
                                                // Ahora puedes realizar otras acciones, como recargar la tabla.
                                                $("#modal-danger").modal('hide');
                                                tabla.ajax.reload(null, false);
                                                $("#id_carrera").val("");
                                                $("#nombre").val("");
                                                $("#multiple").val([]);
                                                $("#multiple").select2();
                                                Toast.fire({
                                                    icon: 'success',
                                                    title: resp
                                                });
                                            });
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            }
        });

        $("#btnAgregarD").on('click', function() {
            var input = $("#nombreD").val().trim().toUpperCase();
            if (input == "") {
                Swal.fire({
                    title: '¡Error!',
                    text: 'Completa todos los campos requeridos',
                    icon: 'error',
                    confirmButtonText: "OK",
                    confirmButtonColor: '#b7040f',
                })
            } else {
                swal.fire({
                    title: '¡Confirmar!',
                    text: '¿Estas seguro que deseas ' + accion + ' la dirección?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Si, " + accion,
                    confirmButtonColor: '#b7040f',
                    cancelButtonText: "Cancelar",
                    cancelButtonColor: '#454d5e'
                }).then(resultado => {
                    if (resultado.value) {
                        var id_direccion = $("#id_direccion").val()
                        var datos = new FormData();
                        datos.append('id_direccion', id_direccion);
                        datos.append('direccion', input);
                        datos.append('accion', accion);
                        $.ajax({
                            url: "ajax/direccion.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(resp) {

                                $("#modal-danger1").modal('hide');
                                tblDireccion.ajax.reload(null, false);
                                $("#id_direccion").val("");
                                $("#nombreD").val("");
                                Toast.fire({
                                    icon: 'success',
                                    title: resp
                                })
                            }
                        });
                    }
                });
            }
        });
    })

    function convertirArray(arr) {
        if (arr === null) {
            // Devolver un arreglo vacío como cadena JSON válida
            return '[]';
        }

        if (typeof arr === 'string' && arr.includes('{')) {
            // El arreglo tiene llaves, lo convertimos a corchetes
            return arr.replace('{', '[').replace('}', ']');
        } else {
            // El arreglo no tiene notación de arreglo válida
            return '[]'; // Devolver un arreglo vacío como cadena JSON válida
        }
    }
</script>