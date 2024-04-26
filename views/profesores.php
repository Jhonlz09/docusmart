<?php session_start(); ?>

<head>
    <title>Profesores</title>
</head>
<!-- Contenido Header -->
<section class="content-header stick-header">
    <div class="container-fluid">
        <div class="col-md-8">
            <div class="row">
                <h1 class="mr-3 mb-2">Profesores</h1>
                <?php if ($_SESSION["permisoCrear"]) : ?>
                    <button id="btnNuevo" class="btn btn-success" data-toggle="modal" data-target="#modal">
                        <i class="fa fa-plus"></i> Nuevo profesor</button>
                <?php endif; ?>
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
                        <h3 class="card-title">Listado de profesores</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tblProfesores" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>CÉDULA</th>
                                    <th>NOMBRES</th>
                                    <th>APELLIDOS</th>
                                    <?php if ($_SESSION["mostrarCV"]) : ?>
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
                <h4 class="modal-title title-nuevo">Nuevo Profesor</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formNuevo" autocomplete="off">
                    <input type="hidden" id="id_profesor" name="profesor" value="">
                    <div class="form-row-nuevo">
                        <div class="input-data">
                            <input autocomplete="off" id="cedula" class="input-nuevo" type="text" required>
                            <div class="line underline"></div>
                            <label class="barra label">Cédula</label>
                        </div>

                        <div class="input-data">
                            <input autocomplete="off" id="nombre" class="input-nuevo" type="text" required>
                            <div class="line underline"></div>
                            <label class="barra label">Nombres</label>
                        </div>

                        <div class="input-data">
                            <input autocomplete="off" id="apellido" class="input-nuevo" type="text" required>
                            <div class="line underline"></div>
                            <label class="barra label">Apellidos</label>
                        </div>
                    </div>
                    <br>
                    <div class="justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
                        <button id="btnAgregar" type="button" class="btn btn-success"><i class="fa-solid fa-user-plus"></i><span class="button-text"> Agregar</span></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal -->

<!-- <script src="assets/js/profesore.js?=1"></script> -->

<script>
// if (window.innerWidth > 768) {
//     $("body").css("overflow", "hidden");

//             OverlayScrollbars(document.querySelectorAll('.scroll'), {
//                 // Customize options as needed
//             });
//         }
    $(document).ready(function() {
        var mostrarCV = '<?php echo $_SESSION["mostrarCV"] ?>';
        var permisoE = '<?php echo $_SESSION["permisoEditar"] ?>';
        var permisoEl = '<?php echo $_SESSION["permisoEliminar"] ?>';
        var accion = "";
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        var tabla = $("#tblProfesores").DataTable({
            "ajax": {
                "url": "ajax/profesores.ajax.php",
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
            "dom": 'frtp',
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
                    data: "cedula"

                },
                {
                    targets: 2,
                    data: "nombres_profesor",
                },
                {
                    targets: 3,
                    data: "apellidos_profesor",
                },
                {
                    targets: 4,
                    data: "acciones",
                    visible: mostrarCV,
                    render: function(data, type, row, full, meta) {
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

        // let inputBusqueda = $('#tblProfesores_filter input');
        // inputBusqueda.attr('placeholder', 'Buscar');

        $("#modal").on("shown.bs.modal", function() {
            $("#cedula").focus();
        });

        $("#btnNuevo").on('click', function() {
            accion = "agregar";
            if ($("#btnAgregar").hasClass("btn-warning")) {
                $(".header-color-nuevo").css("background-color", "");
                $(".modal-title").text("Nuevo Profesor");
                $("#btnAgregar .button-text").text(" Agregar");
                $('#btnAgregar').removeClass('btn-warning');
                $("#btnAgregar").addClass('btn-success');
                $("#btnAgregar").find("i").removeClass("fa-pen-to-square");
                $("#btnAgregar").find("i").addClass("fa-user-plus");
                $('.line').removeClass('underedit');
                $('.line').addClass('underline');
                $('.barra').removeClass('labele');
                $('.barra').addClass('label');
            }
            $("#formNuevo").trigger("reset");
        });

        $('#tblProfesores tbody').on('click', '.btnEliminar', function() {
            var e = tabla.row($(this).parents('tr')).data();

            if (tabla.row(this).child.isShown()) { //Cuando esta en tamaño responsivo
                e = tabla.row(this).data();
            }
            var id_profesor = e["id_profesor"];

            var src = new FormData();
            src.append('accion', 'delete');
            src.append('id_profesor', id_profesor);

            swal.fire({

                title: "¿Esta seguro de eliminar este profesor?",
                text: "Una vez eliminado no podra recuperarlo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Sí, Eliminar",
                cancelButtonText: "Cancelar"

            }).then(r => {

                if (r.value) {

                    //LLAMADO AJAX
                    $.ajax({
                        url: "ajax/profesores.ajax.php",
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
                } else {}

            })
        });

        $('#tblProfesores tbody').on('click', '.btnEditar', function() {
            let row = tabla.row($(this).parents('tr')).data();
            if (tabla.row(this).child.isShown()) { //cuando esta en tamaño responsivo
                row = tabla.row(this).data();
            }
            accion = "editar";
            $(".header-color-nuevo").css("background-color", "rgb(255 193 7 / 56%)");
            $(".modal-title").text("Editar Profesor");
            $("#btnAgregar .button-text").text(" Editar");
            $('#btnAgregar').removeClass('btn-success');
            $("#btnAgregar").addClass('btn-warning');
            $("#btnAgregar").find("i").removeClass("fa-user-plus");
            $("#btnAgregar").find("i").addClass("fa-pen-to-square");
            $('.line').removeClass('underline');
            $('.line').addClass('underedit');
            $('.barra').removeClass('label');
            $('.barra').addClass('labele');
            $("#id_profesor").val(row["id_profesor"]);
            $("#cedula").val(row["cedula"]);
            $("#nombre").val(row["nombres_profesor"]);
            $("#apellido").val(row["apellidos_profesor"]);
        });

        $(".input-nuevo").on("keypress", function(event) {
            if (event.which === 13) {
                $("#btnAgregar").click();
            }
        });

        $("#btnAgregar").on('click', function(event) {
            event.preventDefault();
            var regex = /^[0-9]+$/;
            var input = $("#cedula").val().trim();
            var input2 = $("#nombre").val().trim().toUpperCase();
            var input3 = $("#apellido").val().trim().toUpperCase();

            if (input == "" || input2 == "" || input3 == "") {
                mostrarError("Completa todos los campos requeridos")
            } else if (!(regex.test(input))) {
                mostrarError("La Cédula tiene caracteres inválidos")
            }else if (!(input.length === 10)) {
                mostrarError("La Cédula debe tener 10 caracteres")

            } else {
                var id_profesor = $("#id_profesor").val(),
                    cedula = $("#cedula").val().trim();
                    nombres_profesor = $("#nombre").val().trim().toUpperCase();
                    apellidos_profesor = $("#apellido").val().trim().toUpperCase();

                var datos = new FormData();
                datos.append('id_profesor', id_profesor);
                datos.append('cedula', cedula);
                datos.append('nombres_profesor', nombres_profesor);
                datos.append('apellidos_profesor', apellidos_profesor);
                datos.append('accion', accion);
                Swal.fire({
                    title: '¡Confirmar!',
                    text: '¿Estas seguro que deseas ' + accion + ' el profesor?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Sí, " + accion,
                    confirmButtonColor: '#b7040f',
                    cancelButtonText: "Cancelar",
                    cancelButtonColor: '#454d5e'
                }).then(resultado => {
                    if (resultado.value) {
                        $.ajax({
                            url: "ajax/profesores.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(resp) {
                                console.log(resp)
                            if (resp == '"ok"') {
                                $("#modal").modal('hide');
                                tabla.ajax.reload(null, false);
                                $("#id_profesor").val("");
                                $("#cedula").val("");
                                $("#nombre").val("");
                                $("#apellido").val("");
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Se '+accion+' el profesor correctamente'
                                })
                            }else if(resp == '"V"'){
                                Toast.fire({
                                        icon: 'error',
                                        title: 'No se puede agregar el profesor debido a que ya existe uno con la misma cedula'
                                    });
                            }else{
                                Toast.fire({
                                        icon: 'error',
                                        title: 'El profesor no se pudo ' + accion
                                    });
                            }
                        }
                        });
                    } else {}
                });
            }
        });
    })

    function mostrarError(mensaje) {
        Swal.fire({
            title: '¡Error!',
            text: mensaje,
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#b7040f',
        });
}
</script>