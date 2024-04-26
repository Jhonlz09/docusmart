<?php session_start(); ?>

<head>
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <title>Materias</title>
</head>
<!-- Contenido Header -->
<section class="content-header stick-header">
    <div class="container-fluid">
        <div class="col-md-8">
            <div class="row">
                <h1 class="mr-3 mb-2">Materias</h1>
                <?php if ($_SESSION["permisoCrear"]): ?>
                    <button id="btnNuevo" class="btn btn-success" data-toggle="modal" data-target="#modal">
                        <i class="fa fa-plus"></i> Nueva materia</button>
                <?php endif; ?>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<!-- Main content -->
<section class="content scroll">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listado de materias</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tblMaterias" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>CODIGO</th>
                                    <th>MATERIA</th>
                                    <?php if ($_SESSION["mostrarCV"]): ?>
                                        <th class="text-center">ACCIONES</th>
                                    <?php endif; ?>
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
<!-- /.Contenido -->

<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-nuevo">
            <div class="modal-header header-color-nuevo">
                <h4 class="modal-title title-nuevo">Nueva Materia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body scroll-modal">
                <form id="formNuevo" autocomplete="off">
                    <input type="hidden" id="id_materia" name="materia" value="">
                    <div class="form-row-nuevo">
                        <div class="input-data">
                            <input id="codigo_materia" class="input-nuevo" type="text" required>
                            <div class="line underline"></div>
                            <label class="barra label">Codigo</label>
                        </div>
                        <div class="input-data">
                            <input id="nombre" class="input-nuevo" type="text" required autocomplete="off">
                            <div class="line underline"></div>
                            <label class="barra label">Nombre de la materia</label>
                        </div>
                        <div class="form-group">
                            <label style="font-size: 18px;" class="combo">Dirección de carrera</label>
                            <select name="cboDireccion" id="cboDireccion" class="form-control select2 select2-success"
                                data-dropdown-css-class="select2-dark">
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="font-size: 18px;" class="combo">Carreras</label>
                            <div class="select2-green">
                                <select id="multiple" class="select2 multiple2" multiple="multiple"
                                    data-placeholder="SELECCIONA UNA CARRERA" data-dropdown-css-class="select2-dark"
                                    style="width: 100%;">
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i
                                class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
                        <button id="btnAgregar" type="button" class="btn btn-success"><i
                                class="fa-solid fa-book"></i><span class="button-text"> Agregar</span></button>
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
    $(document).ready(function () {
        $('#cboDireccion').select2({
            placeholder: 'SELECCIONA UNA DIRECCIÓN'
        })
        $('.multiple2').select2({
            closeOnSelect: true,
            sorter: function (data) {
                return data;
            }
        });

        $('.multiple2').on('select2:select', function (e) {
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

    $("#modal").on("shown.bs.modal", function () {
        $("#codigo").focus();
    });

    $('#modal').on('hidden.bs.modal', function () {
        $("#multiple").val([]);
        $("#multiple").select2();
    });

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
            combo: 7
        },
        success: function (respuesta) {
            var options;
            for (let index = 0; index < respuesta.length; index++) {
                options = options + "<option value=" + respuesta[index][0] + ">" + respuesta[index][1] + "</option>";
            }
            $("#multiple").html(options);
        },
    });

    // OverlayScrollbars(document.querySelectorAll('.scroll'), {});
    OverlayScrollbars(document.querySelectorAll('.scroll-modal'), {
        autoUpdate: true,
        scrollbars: {
            autoHide: 'leave'
        }
    });

    $(document).ready(function () {
        var mostrarCV = '<?php echo $_SESSION["mostrarCV"] ?>';
        var permisoE = '<?php echo $_SESSION["permisoEditar"] ?>';
        var permisoA = '<?php echo $_SESSION["permisoAprobar"] ?>';
        var permisoEl = '<?php echo $_SESSION["permisoEliminar"] ?>';
        var opcion = "";
        var accion;
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        var tabla = $("#tblMaterias").DataTable({
            "ajax": {
                "url": "ajax/materias.ajax.php",
                "type": "POST",
                "dataSrc": "",
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
            "searchHighlight": true,
            "info":false,
            columnDefs: [{
                targets: 0,
                data: "acciones",
                render: function (data, type, row, meta) {
                    if (type === 'display') {
                        return meta.row + 1; // Devuelve el número de fila + 1
                    }
                    return meta.row; // Devuelve el índice de la fila
                }
            },
            {
                targets: 1,
                data: "codigo_materia"

            },
            {
                targets: 2,
                data: "nombre_materia"
            },
            {
                targets: 3,
                visible: mostrarCV,
                render: function (data, type, row, full, meta) {
                    return (
                        "<center style='white-space: nowrap;'>" +
                        (permisoE ?
                            " <button type='button' class='btn btn-warning btnEditar' data-target='#modal' data-toggle='modal'  title='Editar'>" +
                            " <i class='fa-solid fa-pencil'></i>" +
                            "</button>" : "") +
                        (permisoEl ?
                            " <button type='button' class='btn btn-danger btnEliminar'  title='Eliminar'>" +
                            " <i class='fa fa-trash'></i>" +
                            "</button>" : "") +
                        " </center>"
                    );
                },
            },
            ],
        });

        // SOLICITUD AJAX PARA CARGAR COMBO DIRECCION
        $.ajax({
            url: "ajax/combos.ajax.php",
            cache: false,
            method: 'POST',
            dataType: 'json',
            data: {
                'combo': 6
            },

            success: function (respuesta) {

                var options;

                for (let index = 0; index < respuesta.length; index++) {
                    options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][1] + '</option>';
                }
                $("#cboDireccion").html(options);
            }
        });

        $("#btnNuevo").on('click', function () {
            opcion = "agregar";
            accion = 3;
            if ($("#btnAgregar").hasClass("btn-warning")) {
                $(".header-color-nuevo").css("background-color", "");
                $(".modal-title").text("Nueva Materia");
                $("#btnAgregar .button-text").text(" Agregar");
                $('#btnAgregar').removeClass('btn-warning');
                $("#btnAgregar").addClass('btn-success');
                $("#btnAgregar").find("i").removeClass("fa-pen-to-square");
                $("#btnAgregar").find("i").addClass("fa-book");
                $('.line').removeClass('underedit');
                $('.line').addClass('underline');
                $('.barra').removeClass('labele');
                $('.barra').addClass('label');
                $('.comboE').addClass('combo');
                $('.comboE').removeClass('comboE');
                $('.select2-yellow').addClass('select2-green');
                $('.select2-yellow').removeClass('select2-yellow');
                $('.select2-warning').addClass('select2-success');
                $('.select2-warning').removeClass('select2-warning');
            }
            $("#formNuevo").trigger("reset");
            $('#cboDireccion').val(0).trigger('change');
        });

        $('#tblMaterias tbody').on('click', '.btnEliminar', function () {
            var e = tabla.row($(this).parents('tr')).data();
            if (tabla.row(this).child.isShown()) { //Cuando esta en tamaño responsivo
                e = tabla.row(this).data();
            }
            var id_materia = e["id_materia"];

            var src = new FormData();
            src.append('accion', 4);
            src.append('id_materia', id_materia);

            swal.fire({

                title: "¿Esta seguro de eliminar esta materia?",
                text: "Una vez eliminado no podra recuperarlo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Sí, Eliminar",
                cancelButtonText: "Cancelar"
            }).then(r => {
                if (r.value) {

                    //LLAMADO AJAX
                    $.ajax({
                        url: "ajax/materias.ajax.php",
                        method: "POST",
                        data: src,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (respuesta) {
                            tabla.ajax.reload(null, false);
                            Toast.fire({
                                icon: 'success',
                                title: '' + respuesta
                            });
                        }
                    })
                }
            })
        });

        $('#tblMaterias tbody').on('click', '.btnEditar', function () {
            let row = tabla.row($(this).parents('tr')).data();
            if (tabla.row(this).child.isShown()) { //cuando esta en tamaño responsivo
                row = tabla.row(this).data();
            }
            opcion = "editar";
            accion = 5;
            $(".header-color-nuevo").css("background-color", "rgb(255 193 7 / 56%)");
            $(".modal-title").text("Editar Materia");
            $("#btnAgregar .button-text").text(" Editar");
            $('#btnAgregar').removeClass('btn-success');
            $("#btnAgregar").addClass('btn-warning');
            $("#btnAgregar").find("i").removeClass("fa-book");
            $("#btnAgregar").find("i").addClass("fa-pen-to-square");
            $('.line').removeClass('underline');
            $('.line').addClass('underedit');
            $('.barra').removeClass('label');
            $('.barra').addClass('labele');
            $('.line').removeClass('underline');
            $('.line').addClass('underedit');
            $('.combo').addClass('comboE');
            $('.combo').removeClass('combo');
            $('.select2-green').addClass('select2-yellow');
            $('.select2-green').removeClass('select2-green');
            $('.select2-success').addClass('select2-warning');
            $('.select2-success').removeClass('select2-success');
            $("#id_materia").val(row["id_materia"]);
            $("#codigo_materia").val(row["codigo_materia"]);
            $('#cboDireccion').val(row["id_direccion"]).trigger('change');
            $("#nombre").val(row["nombre_materia"]);
            let c = convertirArray(row["carreras_relacionadas"]);
            c = JSON.parse(c);
            $("#multiple").val(c);
            $("#multiple").select2();
        });

        $(".input-nuevo").on("keypress", function (event) {
            if (event.which === 13) {
                $("#btnAgregar").click();
            }
        });

        $("#btnAgregar").on('click', function (event) {
            event.preventDefault();
            let multi = $("#multiple").val();
            var codigo_materia = $("#codigo_materia").val().trim().toUpperCase();
            var nombre_materia = $("#nombre").val().trim().toUpperCase();
            var id_direccion = $("#cboDireccion").val();

            if (codigo_materia == "" || nombre_materia == "" || id_direccion == null || multi.length === 0) {
                Swal.fire({
                    title: '¡Error!',
                    text: 'Completa todos los campos requeridos',
                    icon: 'error',
                    confirmButtonText: "OK",
                    confirmButtonColor: '#b7040f',
                })
            } else {
                var id_materia = $("#id_materia").val();
                var datos = new FormData();
                datos.append('id_materia', id_materia);
                datos.append('codigo_materia', codigo_materia);
                datos.append('nombre_materia', nombre_materia);
                datos.append('id_direccion', id_direccion);
                datos.append('accion', accion);
                Swal.fire({
                    title: '¡Confirmar!',
                    text: '¿Estas seguro que deseas ' + opcion + ' la materia?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Sí, " + opcion,
                    confirmButtonColor: '#b7040f',
                    cancelButtonText: "Cancelar",
                    cancelButtonColor: '#454d5e'
                }).then(resultado => {
                    if (resultado.value) {
                        $.ajax({
                            url: "ajax/materias.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (resp) {
                                if (accion == 3) {
                                    const Promises = [];
                                    for (let i = 0; i < multi.length; i++) {
                                        Promises.push(
                                            $.ajax({
                                                url: "ajax/materias.ajax.php",
                                                method: "POST",
                                                data: {
                                                    relacion: 1,
                                                    id_carrera: multi[i]
                                                },
                                                success: function (respuesta) { }
                                            })
                                        );
                                    }

                                    Promise.all(Promises).then(function () {
                                        $("#modal").modal('hide');
                                        tabla.ajax.reload(null, false);
                                        $("#id_carrera").val("");
                                        $("#codigo_materia").val("");
                                        $("#nombre").val("");
                                        $('#cboDireccion').val(0).trigger('change');
                                        $("#multiple").val([]);
                                        $("#multiple").select2();
                                        Toast.fire({
                                            icon: 'success',
                                            title: resp
                                        });
                                    });
                                } else if (accion == 5) {
                                    $.ajax({
                                        url: "ajax/materias.ajax.php",
                                        method: "POST",
                                        data: {
                                            relacion: 2,
                                            id_materia
                                        },
                                        success: function (respuesta) {
                                            const Promises = [];
                                            for (let i = 0; i < multi.length; i++) {
                                                Promises.push(
                                                    $.ajax({
                                                        url: "ajax/materias.ajax.php",
                                                        method: "POST",
                                                        data: {
                                                            relacion: 3,
                                                            id_materia,
                                                            id_carrera: multi[i]
                                                        },
                                                        success: function (respuesta) { }
                                                    })
                                                );
                                            }
                                            Promise.all(Promises).then(function () {
                                                $("#modal").modal('hide');
                                                tabla.ajax.reload(null, false);
                                                $("#id_carrera").val("");
                                                $("#codigo_materia").val("");
                                                $("#nombre").val("");
                                                $('#cboDireccion').val(0).trigger('change');
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