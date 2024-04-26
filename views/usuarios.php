<?php session_start(); ?>

<head>
    <title>Usuarios</title>
</head>

<!-- Contenido Header -->
<section class="content-header stick-header">
    <div class="container-fluid">
        <div class="col-md-8">
            <div class="row">
                <h1 class="mr-3 mb-2">Usuarios</h1>
                <?php if ($_SESSION["permisoCrear"]) : ?>
                    <button id="btnNuevo" class="btn btn-success" data-toggle="modal" data-target="#modal">
                        <i class="fa fa-plus"></i> Nuevo usuario</button>
                <?php endif; ?>
            </div><!-- /.col -->
        </div><!-- /.row -->
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
                        <h3 class="card-title">Listado de usuarios</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tblUsuarios" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>NOMBRE DE USUARIO</th>
                                    <th class="text-center">ROL</th>
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
                <h4 class="modal-title title-nuevo">Nuevo Usuario</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formNuevo" autocomplete="off">
                    <input type="hidden" id="id_usuario" name="usuario" value="">
                    <div class="form-row-nuevo">
                        <div id="input" class="input-data">
                            <input autocomplete="username"   id="nombre_usuario" class="input-nuevo" type="text" required>
                            <div class="line underline"></div>
                            <label class="barra label">Nombre de usuario</label>
                        </div>

                        <div id="clave" class="input-data">
                            <input autocomplete="new-password" type="password" id="clave_usuario" class="input-nuevo" type="text" required>
                            <div class="line underline"></div>
                            <label class="barra label">Contraseña</label>
                        </div>

                        <div id="clave_c" class="input-data">
                            <input autocomplete="new-password" type="password" id="conf_clave" class="input-nuevo" type="text" required>
                            <div class="line underline"></div>
                            <label class="barra label">Confirmar contraseña</label>
                        </div>
                        <div id="selectR" class="form-group">
                            <label style="font-size: 18px;" class="combo">Rol</label>
                            <select name="cboRol" id="cboRol" class="form-control select2 select2-success" data-dropdown-css-class="select2-dark">
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-start">
                        <button type="button" class="mr-1 btn btn-dark" data-dismiss="modal">
                            <i class="fa-solid fa-right-from-bracket"></i> Cerrar
                        </button>
                        <button id="btnAgregar" class="mr-1 btn btn-success btnfocusS">
                            <i class="fa-solid fa-user-plus"></i>
                            <span class="button-text"> Agregar</span>
                        </button>
                        <button style="display: none;" id="btnRestablecer" class="btn btn-info btnfocusI">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span class="button-text"> Restablecer</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal -->

<script src="assets/plugins/select2/js/select2.full.min.js"></script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            minimumResultsForSearch: -1,
            placeholder: 'SELECCIONA UN ROL'
        })
    })
    // OverlayScrollbars(document.querySelectorAll('.scroll'), {});
    var id_perfil_Act = '<?php echo $_SESSION["s_usuario"]->id_perfil; ?>'
    var accion="1";

    $(document).ready(function() {
        let mostrarCV = '<?php echo $_SESSION["mostrarCV"] ?>';
        let permisoE = '<?php echo $_SESSION["permisoEditar"] ?>';
        let permisoEl = '<?php echo $_SESSION["permisoEliminar"] ?>';
        let displayStart=0;
        let titulo_msj = "";
        let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        
        if(id_perfil_Act==1){
            accion = "2";
        }

        var tabla = $("#tblUsuarios").DataTable({
            "ajax": {
                "url": "ajax/usuarios.ajax.php",
                "type": "POST",
                "dataSrc": "",
                data: {
                'accion': accion
            },
            },
            mark: {
                separateWordSearch: false
            },
            ordering: false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "info":false,
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
                    data: "nombre_usuario"

                },
                {
                    targets: 2,
                    data: "descripcion",
                    render: function(data, type, full, meta) {
                        return "<center><span class='badge bg-5'>" + data + "</span></center>";
                    }
                },
                {
                    targets: 3,
                    data: "acciones",
                    visible: mostrarCV,
                    render: function(data, type, row, full, meta) {
                        if (row.id_usuario === 1) { // Verifica si es la primera fila
                            return ("<center style='white-space: nowrap;'>" +
                                (permisoE ?
                                    " <button type='button' class='btn btn-warning btnEditar' data-target='#modal' data-toggle='modal'  title='Editar'>" +
                                    " <i class='fa-solid fa-pencil'></i>" +
                                    "</button> " +
                                    " <button type='button' class='btn btn-info btnRestablecer' data-target='#modal' data-toggle='modal'  title='Restablecer contraseña'>" +
                                    " <i class='fa-solid fa-key'></i>" +
                                    "</button> " : "") +
                                "</center>");
                        } else {
                            return ("<center style='white-space: nowrap;'>" +
                                (permisoE ?
                                    " <button type='button' class='btn btn-warning btnEditar' data-target='#modal' data-toggle='modal'  title='Editar'>" +
                                    " <i class='fa-solid fa-pencil'></i>" +
                                    "</button> " +
                                    " <button type='button' class='btn btn-info btnRestablecer' data-target='#modal' data-toggle='modal'  title='Restablecer contraseña'>" +
                                    " <i class='fa-solid fa-key'></i>" +
                                    "</button> " : "") +

                                (permisoEl ?
                                    " <button type='button' class='btn btn-danger btnEliminar'  title='Eliminar'>" +
                                    " <i class='fa fa-trash'></i>" +
                                    "</button>" : "") +
                                "</center>");
                        }
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
                'combo': 9
            },
            success: function(respuesta) {
                var options;
                for (let index = 0; index < respuesta.length; index++) {
                    options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[index][1] + '</option>';
                }
                $("#cboRol").html(options);
            }
        });
        // let inputBusqueda = $('#tblUsuarios_filter input');
        // inputBusqueda.attr('placeholder', 'Buscar');
        $("#modal").on("shown.bs.modal", function() {
            if (accion == "cambiar") {
                $("#clave_usuario").focus();
            } else {
                $("#nombre_usuario").focus();
            }
        });

        $("#btnNuevo").on('click', function() {
            accion = "agregar";
            titulo_msj = "agregó";
            if ($("#btnAgregar").hasClass("btn-warning") || $("#btnRestablecer").hasClass("btn-info")) {
                $("#btnRestablecer").css("display", "none");
                $("#btnAgregar").css("display", "block");
                $("#btnAgregar").prop("disabled", false);
                $("#btnAgregar").removeClass('btnfocusW');
                $("#btnAgregar").addClass('btnfocusS');
                $("#clave").css("display", "block");
                $("#clave_c").css("display", "block");
                $("#input").css("display", "block");
                $("#selectR").css("display", "block");
                $(".header-color-nuevo").css("background-color", "");
                $(".modal-title").text("Nuevo Usuario");
                $("#btnAgregar .button-text").text(" Agregar");
                $('#btnAgregar').removeClass('btn-warning');
                $("#btnAgregar").addClass('btn-success');
                $("#btnAgregar").find("i").removeClass("fa-pen-to-square");
                $("#btnAgregar").find("i").addClass("fa-user-plus");
                $('.comboE').addClass('combo');
                $('.comboE').removeClass('comboE');
                $('.select2-warning').addClass('select2-success');
                $('.select2-warning').removeClass('select2-warning');
                $('.line').removeClass('underedit undercam');
                $('.line').addClass('underline');
                $('.barra').removeClass('labele labelc');
                $('.barra').addClass('label');
            }
            $("#formNuevo").trigger("reset");
            $('#cboRol').val(0).trigger('change');
        });

        $('#tblUsuarios tbody').on('click', '.btnEliminar', function() {
            titulo_msj = "eliminó"
            var e = tabla.row($(this).parents('tr')).data();
            if (tabla.row(this).child.isShown()) { //Cuando esta en tamaño responsivo
                e = tabla.row(this).data();
            }
            var id_usuario = e["id_usuario"];
            var src = new FormData();

            src.append('accion', 'delete');
            src.append('id_usuario', id_usuario);

            swal.fire({

                title: "¿Esta seguro de eliminar este usuario?",
                text: "Una vez eliminado no podra recuperarlo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Sí, Eliminar",
                cancelButtonText: "Cancelar"

            }).then(r => {

                if (r.value) {
                    $.ajax({
                        url: "ajax/usuarios.ajax.php",
                        method: "POST",
                        data: src,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(respuesta) {
                            tabla.ajax.reload(null, false);
                            Toast.fire({
                                icon: 'success',
                                title: 'El usuario se ' + titulo_msj + ' correctamente'
                            });
                        }
                    })
                }
            })
        });

        $('#tblUsuarios tbody').on('click', '.btnEditar', function() {
            // $("#clave_usuario").val("");
            // $("#conf_clave").val("");
            let row = tabla.row($(this).parents('tr')).data();
            if (tabla.row(this).child.isShown()) { //cuando esta en tamaño responsivo
                row = tabla.row(this).data();
            }
            if(row["id_usuario"]==1){
                $("#selectR").css("display", "none");
                
            }else{
                $("#selectR").css("display", "block");
            }
            titulo_msj = "editó"
            accion = "editar";
            $("#btnRestablecer").css("display", "none");
            $("#btnAgregar").css("display", "block");
            $("#btnAgregar").removeClass('btnfocusS');
            $("#btnAgregar").addClass('btnfocusW');
            $("#btnAgregar").prop("disabled", false);
            $("#clave").css("display", "none");
            $("#clave_c").css("display", "none");
            $("#input").css("display", "block");
            
            $(".header-color-nuevo").css("background-color", "rgb(255 193 7 / 56%)");
            $(".modal-title").text("Editar Usuario");
            $("#btnAgregar .button-text").text(" Editar");
            $('#btnAgregar').removeClass('btn-success');
            $("#btnAgregar").addClass('btn-warning');
            $("#btnAgregar").find("i").removeClass("fa-user-plus");
            $("#btnAgregar").find("i").addClass("fa-pen-to-square");
            $('.line').removeClass('underline undercam');
            $('.line').addClass('underedit');
            $('.combo').addClass('comboE');
            $('.combo').removeClass('combo comboC');
            $('.select2-success').addClass('select2-warning');
            $('.select2-success').removeClass('select2-success');
            $('.barra').removeClass('label labelc');
            $('.barra').addClass('labele');
            $("#id_usuario").val(row["id_usuario"]);
            $("#cedula").val(row["cedula"]);
            $("#nombre_usuario").val(row["nombre_usuario"]);
            $("#apellido").val(row["apellidos_profesor"]);
            $('#cboRol').val(row["id_perfil"]).trigger('change');
        });

        $('#tblUsuarios tbody').on('click', '.btnRestablecer', function() {
            let row = tabla.row($(this).parents('tr')).data();
            if (tabla.row(this).child.isShown()) { //cuando esta en tamaño responsivo
                row = tabla.row(this).data();
            }

            accion = "cambiar";
            $("#id_usuario").val(row["id_usuario"]);
            $("#btnRestablecer").css("display", "block");
            $("#btnAgregar").css("display", "none");
            $("#btnAgregar").prop("disabled", true);
            $("#formNuevo").trigger("reset");
            $("#clave").css("display", "block");
            $("#clave_c").css("display", "block");
            $("#input").css("display", "none");
            $("#selectR").css("display", "none");
            $(".header-color-nuevo").css("background-color", "#0b43959c");
            $(".modal-title").text("Restablecer Contraseña");
            $('.line').removeClass('underline underedit');
            $('.line').addClass('undercam');
            $('.barra').removeClass('label');
            $('.barra').addClass('labelc');

        });

        $(".input-nuevo").on("keypress", function(event) {
            // if (event.which === 13) {
            //     $("#btnAgregar").click();
            // }
        });

        $("#btnAgregar").on('click', function(event) {
            event.preventDefault();
            let id_usuario = $("#id_usuario").val().trim();
            let nombre_usuario = $("#nombre_usuario").val().trim();
            let clave_usuario = $("#clave_usuario").val().trim();
            let conf_clave = $("#conf_clave").val().trim();
            let id_perfil = $("#cboRol").val();
            let vacio; //Permite controlar los espacios vacios

            if (accion === "agregar") {
                vacio = (nombre_usuario === "" || clave_usuario === "" || conf_clave === "" || id_perfil === null) ? "C" : "";
            } else {
                vacio = (nombre_usuario === "" || id_perfil === "0") ? "C" : "";
            }
            if (vacio !== "") {
                Swal.fire({
                    title: '¡Error!',
                    text: 'Completa todos los campos requeridos',
                    icon: 'error',
                    confirmButtonText: "OK",
                    confirmButtonColor: '#b7040f',
                })
            } else if (!(clave_usuario == conf_clave)) {
                Swal.fire({
                    title: '¡Error!',
                    text: 'Las contraseñas no coinciden',
                    icon: 'error',
                    confirmButtonText: "OK",
                    confirmButtonColor: '#b7040f',
                })
            } else {
                var datos = new FormData();

                datos.append('id_usuario', id_usuario);
                datos.append('nombre_usuario', nombre_usuario);
                datos.append('clave_usuario', clave_usuario);
                datos.append('id_perfil', id_perfil);
                datos.append('accion', accion);
                Swal.fire({
                    title: '¡Confirmar!',
                    text: '¿Estas seguro que deseas ' + accion + ' el usuario?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Sí, " + accion,
                    confirmButtonColor: '#b7040f',
                    cancelButtonText: "Cancelar",
                    cancelButtonColor: '#454d5e'
                }).then(resultado => {
                    if (resultado.value) {
                        $.ajax({
                            url: "ajax/usuarios.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(resp) {
                                console.log(resp);
                                $("#modal").modal('hide');
                                if (resp) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'El usuario se ' + titulo_msj + ' correctamente'
                                    })
                                }
                                tabla.ajax.reload(null, false);
                                $("#id_usuario").val("");
                                $("#clave_usuario").val("");
                                $("#nombre_usuario").val("");
                                $('#cboRol').val(0).trigger('change');
                            }
                        });
                    }
                });
            }
        });

        $("#btnRestablecer").on('click', function(event) {
            event.preventDefault();
            let id_usuario = $("#id_usuario").val().trim();
            let clave_usuario = $("#clave_usuario").val().trim();
            let conf_clave = $("#conf_clave").val().trim();

            if (!(clave_usuario == conf_clave)) {
                Swal.fire({
                    title: '¡Error!',
                    text: 'Las contraseñas no coinciden',
                    icon: 'error',
                    confirmButton: false,

                })
            } else if (clave_usuario == "" || conf_clave== "") {
                Swal.fire({
                    title: '¡Error!',
                    text: 'Complete el campo de contraseña',
                    icon: 'error',
                    confirmButton: false,

                })
            }else {
                var datos = new FormData();
                datos.append('id_usuario', id_usuario);
                datos.append('clave_usuario', clave_usuario);
                datos.append('accion', accion);
                Swal.fire({
                    title: '¡Confirmar!',
                    text: '¿Estas seguro que deseas restablecer la contraseña?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Sí, " + accion,
                    confirmButtonColor: '#b7040f',
                    cancelButtonText: "Cancelar",
                    cancelButtonColor: '#454d5e'
                }).then(resultado => {
                    if (resultado.value) {
                        $.ajax({
                            url: "ajax/usuarios.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(resp) {
                                $("#modal").modal('hide');
                                if (resp) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'La contraseña se ha restablecido correctamente'
                                    })
                                }
                                tabla.ajax.reload(null, false);
                                $("#id_usuario").val("");
                                $("#clave_usuario").val("");
                            }
                        });
                    }
                });
            }
        });
    })
</script>