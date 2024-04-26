<?php session_start(); ?>

<head>
    <title>Roles</title>
</head>
<!-- Contenido Header -->
<section class="content-header stick-header">
    <div class="container-fluid">
        <div class="col-sm-6">
            <div class="row">
                <h1 class="mr-3 mb-2">Roles</h1>
                <?php if ($_SESSION["permisoCrear"]) : ?>
                    <button id="btnNuevo" class="btn btn-success" data-toggle="modal" data-target="#modal">
                        <i class="fa fa-plus"></i> Nuevo rol</button>
                <?php endif; ?>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<div class="content scroll ">
    <div class="container-fluid ">
        <ul class="nav nav-tabs " id="tabs-asignar-modulos-perfil" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="content-perfiles-tab" data-toggle="pill" href="#content-perfiles" role="tab" aria-controls="content-perfiles" aria-selected="false">Roles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="content-modulo-perfil-tab" data-toggle="pill" href="#content-modulo-perfil" role="tab" aria-controls="content-modulo-perfil" aria-selected="false">Permisos</a>
            </li>
        </ul>

        <div class="tab-content " id="tabsContent-asignar-modulos-perfil">

            <div class="tab-pane fade mt-4 px-4" id="content-perfiles" role="tabpanel" aria-labelledby="content-perfiles-tab">
                <table id="tblRoles" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>DESCRIPCION</th>
                            <?php if ($_SESSION["mostrarCV"]) : ?>
                                <th class="text-center">ACCIONES</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade active show mt-4 px-4" id="content-modulo-perfil" role="tabpanel" aria-labelledby="content-modulo-perfil-tab">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-info ">
                            <div class="card-header">
                                <h3 class="card-title"><i class=""></i> Selecciona un Rol</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table id="tbl_perfiles_asignar" class="table  table-hover text-nowrap">
                                    <thead>
                                    </thead>
                                    <tbody class="small text left">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-navy card-outline shadow" style="display:none" id="card-permisos">
                            <div class="card-header card-dark" style="border-bottom: 1px solid rgb(255 255 255 /25%);">
                                <h3 class="card-title card-dark"><i class="fa-solid fa-user-check"></i> Permisos</h3>
                            </div>
                            <div class="card-body card-dark" id="card-body-permisos">
                                <div class="row no-gutters mb-2">
                                    <div class="col">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="crearSwitch">Crear</label>
                                            <div class="switch-container">
                                                <input id="crearSwitch" type="checkbox" name="ckbCrear" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters mb-2">
                                    <div class="col">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="aprobarSwitch">Aprobar</label>
                                            <div class="switch-container ">
                                                <input id="aprobarSwitch" type="checkbox" name="ckbAprobar" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters mb-2">
                                    <div class="col">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="editarSwitch">Editar</label>
                                            <div class="switch-container">
                                                <input id="editarSwitch" type="checkbox" name="ckbEditar" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters mb-2">
                                    <div class="col">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="eliminarSwitch">Eliminar</label>
                                            <div class="switch-container">
                                                <input id="eliminarSwitch" type="checkbox" name="ckbEliminar" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-success btn-small w-100 text-center" id="asignar_permisos"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-navy card-outline shadow" style="display:none" id="card-modulos">
                            <div class="card-header card-dark" style="border-bottom: 1px solid rgb(255 255 255 /25%);">
                                <h3 class="card-title card-dark"><i class="fas fa-laptop"></i> Módulos</h3>
                            </div>
                            <div class="card-body card-dark" id="card-body-modulos">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-small  m-0 p-0 w-100" id="marcar_modulos">Marcar</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-light btn-small m-0 p-0 w-100" id="desmarcar_modulos">Desmarcar </button>
                                    </div>
                                </div>

                                <div id="modulos" class="demo"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Seleccione el modulo de inicio</label>
                                            <select class="select2 select2-navy custom-select" data-dropdown-css-class="select2-navy" id="select_modulos">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-success btn-small w-100 text-center" id="asignar_modulos"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-nuevo">
            <div class="modal-header header-color-nuevo">
                <h4 class="modal-title title-nuevo">Nuevo Rol</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formNuevo" autocomplete="off">
                    <input type="hidden" id="id_perfil" name="perfil" value="">
                    <div class="form-row-nuevo">
                        <div class="input-data">
                            <input autocomplete="off" id="descripcion" class="input-nuevo" type="text" required>
                            <div class="line underline"></div>
                            <label class="barra label">Descripcion</label>
                        </div>
                    </div>
                    <br>
                    <div class="justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</button>
                        <button id="btnAgregar" type="button" class="btn btn-success"><i class="fa-solid fa-address-card"></i><span class="button-text"> Agregar</span></button>
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
<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<!-- Bootstrap Switch -->
<script src="assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script>
    var titulo="";
    var mostrarCV = '<?php echo $_SESSION["mostrarCV"] ?>';
    var permisoE = '<?php echo $_SESSION["permisoEditar"] ?>';
    var permisoA = '<?php echo $_SESSION["permisoAprobar"] ?>';
    var permisoEl = '<?php echo $_SESSION["permisoEliminar"] ?>';
    $(document).ready(function() {
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
        /* =============================================================
        VARIABLES GLOBALES
        ============================================================= */
        var tbl_perfiles_asignar, modulos_usuario, modulos_sistema;
        var id_perfil_Act = <?php echo $_SESSION["s_usuario"]->id_perfil; ?>

        /* =============================================================
        FUNCIONES PARA LAS CARGAS INICIALES DE DATATABLES, ARBOL DE MODULOS Y REAJUSTE DE CABECERAS DE DATATABLES
        ============================================================= */

        cargarTable();
        var tabla = $('#tblRoles').DataTable({
            "ajax": {
                "url": "ajax/perfil.ajax.php",
                "type": "POST",
                "dataSrc": "",
                data: {
                    'accion': 1
                },
            },
            mark: {separateWordSearch: false},
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
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
                                " <button type='button' class='btn btn-warning btnEditar' data-target='#modal' data-toggle='modal'  title='Editar'>" +
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

        $(".input-nuevo").on("keypress", function(event) {
            if (event.which === 13) {
                $("#btnAgregar").click();
            }
        });

        var form2 = document.getElementById("formNuevo");
        form2.addEventListener("submit", function(event) {
        event.preventDefault();

    });

    $("#modal").on("shown.bs.modal", function() {
            $("#descripcion").focus();
        });

        $("#btnNuevo").on('click', function() {
            accion = 4;
            titulo = "agregar"
            if ($("#btnAgregar").hasClass("btn-warning")) {
                $(".header-color-nuevo").css("background-color", "");
                $(".modal-title").text("Nuevo Rol");
                $("#btnAgregar .button-text").text(" Agregar");
                $('#btnAgregar').removeClass('btn-warning');
                $("#btnAgregar").addClass('btn-success');
                $("#btnAgregar").find("i").removeClass("fa-pen-to-square");
                $("#btnAgregar").find("i").addClass("fa-address-card");
                $('.line').removeClass('underedit');
                $('.line').addClass('underline');
                $('.barra').removeClass('labele');
                $('.barra').addClass('label');
            }
            $("#formNuevo").trigger("reset");
        });

        $('#tblRoles tbody').on('click', '.btnEliminar', function() {
            var e = tabla.row($(this).parents('tr')).data();

            if (tabla.row(this).child.isShown()) { //Cuando esta en tamaño responsivo
                e = tabla.row(this).data();
            }
            var id_perfil = e["id_perfil"];

            var src = new FormData();
            src.append('accion', 6);
            src.append('id_perfil', id_perfil);
            swal.fire({
                title: "¿Esta seguro de eliminar este rol?",
                text: "Una vez eliminado no podra recuperarlo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Sí, Eliminar",
                cancelButtonText: "Cancelar"
            }).then(r => {
                if (r.value) {
                    //LLAMADO AJAX
                    $.ajax({
                        url: "ajax/perfil.ajax.php",
                        method: "POST",
                        data: src,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(respuesta) {
                            tabla.ajax.reload(null, false);
                            cargarTable();
                            Toast.fire({
                                icon: 'success',
                                title: respuesta
                            });
                        }
                    })
                }
            })
        });

        $('#tblRoles tbody').on('click', '.btnEditar', function() {

            let row = tabla.row($(this).parents('tr')).data();
            if (tabla.row(this).child.isShown()) { //cuando esta en tamaño responsivo
                row = tabla.row(this).data();
            }
            titulo= "editar"
            accion = 5;
            $(".header-color-nuevo").css("background-color", "rgb(255 193 7 / 56%)");
            $(".modal-title").text("Editar Rol");
            $("#btnAgregar .button-text").text(" Editar");
            $('#btnAgregar').removeClass('btn-success');
            $("#btnAgregar").addClass('btn-warning');
            $("#btnAgregar").find("i").removeClass("fa-address-card");
            $("#btnAgregar").find("i").addClass("fa-pen-to-square");
            $('.line').removeClass('underline');
            $('.line').addClass('underedit');
            $('.barra').removeClass('label');
            $('.barra').addClass('labele');
            $("#id_perfil").val(row["id_perfil"]);
            $("#descripcion").val(row["descripcion"]);
        });

        $("#btnAgregar").on('click', function(event) {
            event.preventDefault();
            var rowCount = tabla.rows().count();
            var descripcion = $("#descripcion").val().trim().toUpperCase();
            if (descripcion == "") {
                Swal.fire({
                    title: '¡Error!',
                    text: 'Completa el campo de descripcion',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#b7040f',
                });
            }
            else if(rowCount == 10){
                Swal.fire({
                    title: '¡Error!',
                    text: 'Se ha alcanzado el maximo de roles permitidos',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#b7040f',
                });
            } else {
                var id_perfil = $("#id_perfil").val();
                var datos = new FormData();
                datos.append('id_perfil', id_perfil);
                datos.append('descripcion', descripcion);
                datos.append('accion', accion);
                Swal.fire({
                    title: '¡Confirmar!',
                    text: '¿Estas seguro que deseas ' + titulo + ' el rol?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Sí, " + titulo,
                    confirmButtonColor: '#b7040f',
                    cancelButtonText: "Cancelar",
                    cancelButtonColor: '#454d5e'
                }).then(resultado => {
                    if (resultado.value) {
                        $.ajax({
                            url: "ajax/perfil.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(resp) {
                                $("#modal").modal('hide');
                                cargarTable();
                                tabla.ajax.reload(null, false);
                                $("#id_perfil").val("");
                                $("#descripcion").val("");
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

        $('#select_modulos').select2({
            minimumResultsForSearch: -1,
            width: '100%',
            dropdownAutoWidth: false
        });
        iniciarArbolModulos();
        /* =============================================================
        VARIABLES PARA REGISTRAR EL PERFIL Y LOS MODULOS SELECCIOMADOS
        ============================================================= */
        var idPerfil = 0;
        var selectedElmsIds = [];
        /* =============================================================
        EVENTO PARA SELECCIONAR UN PERFIL DEL DATATABLE Y MOSTRAR LOS MODULOS ASIGNADOS EN EL ARBOL DE MODULOS
        ============================================================= */
        $('#tbl_perfiles_asignar tbody').on('click', 'tr', function() {
            if ($(this).hasClass('table-active')) {
                $(this).removeClass('table-active');
                $('#modulos').jstree("deselect_all", false);
                $("#select_modulos option").remove();
                $("#card-modulos").css("display", "none");
                $("#card-permisos").css("display", "none");
                idPerfil = 0;
            } else {
                $('#tbl_perfiles_asignar tbody tr').removeClass('table-active');
                $(this).addClass('table-active');
                idPerfil = $(this).find('td:first').text();
                $("#card-modulos").css("display", "block");
                $("#card-permisos").css("display", "block"); //MOSTRAMOS EL ALRBOL DE MODULOS DEL SISTEMA

                $.ajax({
                    async: false,
                    url: "ajax/modulo.ajax.php",
                    method: 'POST',
                    data: {
                        accion: 2,
                        id_perfil: idPerfil
                    },
                    dataType: 'json',
                    success: function(respuesta) {
                        modulos_usuario = respuesta;
                        seleccionarModulosPerfil(idPerfil);
                    }
                });

                $.ajax({
                    async: false,
                    url: "ajax/perfil.ajax.php",
                    method: 'POST',
                    data: {
                        accion: 3,
                        id_perfil: idPerfil
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#crearSwitch').bootstrapSwitch('state', response[0].crear);
                        $('#editarSwitch').bootstrapSwitch('state', response[0].editar);
                        $('#aprobarSwitch').bootstrapSwitch('state', response[0].aprobar);
                        $('#eliminarSwitch').bootstrapSwitch('state', response[0].eliminar);
                    }
                });
            }
        });
        /* =============================================================
        EVENTO QUE SE DISPARA CADA VEZ QUE HAY UN CAMBIO EN EL ARBOL DE MODULOS
        ============================================================= */
        $("#modulos").on("changed.jstree", function(evt, data) {
            $("#select_modulos option").remove();
            var selectedElms = $('#modulos').jstree("get_selected", true);
            $.each(selectedElms, function() {
                for (let i = 0; i < modulos_sistema.length; i++) {
                    if (modulos_sistema[i]["id"] == this.id && modulos_sistema[i]["vista"]) {
                        $('#select_modulos').append($('<option>', {
                            value: this.id,
                            text: this.text
                        }));
                    }
                }

            })
            if ($("#select_modulos").has('option').length <= 0) {
                $('#select_modulos').append($('<option>', {
                    value: 0,
                    text: "No hay modulos seleccionados"
                }));
            }
        })
        /* =============================================================
        EVENTO PARA MARCAR TODOS LOS CHECKBOX DEL ARBOL DE MODULOS
        ============================================================= */
        $("#marcar_modulos").on('click', function() {
            $('#modulos').jstree('select_all');
        })
        /* =============================================================
        EVENTO PARA DESMARCAR TODOS LOS CHECKBOX DEL ARBOL DE MODULOS
        ============================================================= */
        $("#desmarcar_modulos").on('click', function() {
            $('#modulos').jstree("deselect_all", false);
            $("#select_modulos option").remove();
            $('#select_modulos').append($('<option>', {
                value: 0,
                text: "No hay modulos seleccionados"
            }));
        })

        /* =============================================================
        REGISTRO EN BASE DE DATOS DE LOS MODULOS ASOCIADOS AL PERFIL
        ============================================================= */
        $("#asignar_modulos").on('click', function() {
            selectedElmsIds = []
            var selectedElms = $('#modulos').jstree("get_selected", true);
            $.each(selectedElms, function() {
                selectedElmsIds.push(this.id);
                if (this.parent != "#") {
                    selectedElmsIds.push(this.parent);
                }
            });
            //quitamos valores duplicados
            let modulosSeleccionados = [...new Set(selectedElmsIds)];
            let modulo_inicio = $("#select_modulos").val();
            if (idPerfil != 0 && modulosSeleccionados.length > 0) {
                registrarPerfilModulos(modulosSeleccionados, idPerfil, modulo_inicio, id_perfil_Act);
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Debe seleccionar el rol y módulos',
                    showConfirmButton: false,
                    timer: 2000
                })
            }

        })
        /* =============================================================
        REGISTRO EN BASE DE DATOS DE LOS PERMISOS ASOCIADOS AL PERFIL
        ============================================================= */
        $("#asignar_permisos").on('click', function() {
            let switchEl = $('[name="ckbEliminar"]').bootstrapSwitch('state');
            let switchE = $('[name="ckbEditar"]').bootstrapSwitch('state');
            let switchA = $('[name="ckbAprobar"]').bootstrapSwitch('state');
            let switchC = $('[name="ckbCrear"]').bootstrapSwitch('state');
            actualizarPerfilPermisos(switchC, switchE, switchEl, switchA)
        })

        function cargarTable() {
            $.ajax({
                url: "ajax/perfil.ajax.php",
                async: false,
                dataSrc: "",
                type: "POST",
                data: {
                    'accion': 1
                }, // 2:GRAFICO POR DOCUMENTOS
                dataType: 'json',
                success: function(respuesta) {
                // Limpiar la tabla antes de cargar los nuevos datos
                $("#tbl_perfiles_asignar tbody").empty();
                    for (let i = 0; i < respuesta.length; i++) {
                        filas = '<tr>' +
                            '<td class="d-none">' + respuesta[i]["id_perfil"] + '</td>' +
                            '<td class="text-center">' + respuesta[i]["descripcion"] + '</td>' +
                            '</tr>';
                        $("#tbl_perfiles_asignar tbody").append(filas);
                    }
                }
            });
        }

        function iniciarArbolModulos() {
            $.ajax({
                async: false,
                url: "ajax/modulo.ajax.php",
                method: 'POST',
                data: {
                    accion: 1
                },
                dataType: 'json',
                success: function(respuesta) {
                    modulos_sistema = respuesta;
                    $('#modulos').jstree({
                        "core": {
                            "check_callback": true,
                            "data": respuesta
                        },
                        "checkbox": {
                            "keep_selected_style": true
                        },
                        "types": {
                            "default": {
                                "icon": "fas fa-laptop text-light"
                            }
                        },
                        "plugins": ["checkbox", "wholerow", "types", "changed"]
                    })

                }
            })
        }

        function seleccionarModulosPerfil(pin_idPerfil) {

            $('#modulos').jstree('deselect_all');
            for (let i = 0; i < modulos_sistema.length; i++) {
                if (modulos_sistema[i]["id"] == modulos_usuario[i]["id"] && modulos_usuario[i]["sel"] == 1) {
                    $("#modulos").jstree("select_node", modulos_sistema[i]["id"]);
                }

            }

            /*OCULTAMOS LA OPCION DE MODULOS Y PERFILES PARA EL PERFIL DE ADMINISTRADOR*/
            if (pin_idPerfil > 2) { //SOLO PERFIL ADMINISTRADOR
                $("#modulos").jstree(true).hide_node(9);
                $("#modulos").jstree(true).hide_node(10);
            } else {
                $('#modulos').jstree(true).show_all();
            }

        }

        function registrarPerfilModulos(modulosSeleccionados, idPerfil, idModulo_inicio, id_perfil_Act) {
            $.ajax({
                async: false,
                url: "ajax/perfil_modulo.ajax.php",
                method: 'POST',
                data: {
                    accion: 1,
                    id_modulosSeleccionados: modulosSeleccionados,
                    id_Perfil: idPerfil,
                    id_modulo_inicio: idModulo_inicio
                },
                dataType: 'json',
                success: function(respuesta) {
                    if (respuesta > 0) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Se ha guardado correctamente',
                            showConfirmButton: false,
                            timer: 1700
                        }).then((r) => {
                            $("#card-modulos").css("display", "none");
                            $("#card-permisos").css("display", "none");
                            $('#tbl_perfiles_asignar tbody tr').removeClass('table-active');
                            if (idPerfil == id_perfil_Act) {
                                location.reload()
                            } else {
                                $("#select_modulos option").remove();
                                $('#modulos').jstree("deselect_all", false);

                            }
                        })
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Error al guardar los modulos',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                }
            });
        }

        function actualizarPerfilPermisos(crear, editar, eliminar, aprobar) {
            $.ajax({
                async: false,
                url: "ajax/perfil.ajax.php",
                method: 'POST',
                data: {
                    accion: 2,
                    idPerfil: idPerfil,
                    crear: crear,
                    editar: editar,
                    eliminar: eliminar,
                    aprobar: aprobar
                },
                dataType: 'json',
                success: function(respuesta) {
                    if (respuesta) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Se ha guardado correctamente',
                            showConfirmButton: false,
                            timer: 1700
                        }).then((r) => {
                            if (idPerfil == id_perfil_Act) {
                                window.location.href = "http://localhost/Silabosoft";
                            } else {
                                tbl_perfiles_asignar.ajax.reload();
                            }
                            $("#card-permisos").css("display", "none");
                            $("#card-modulos").css("display", "none");
                        });
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Error al guardar los permisos',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                }
            });
        }
    })
</script>