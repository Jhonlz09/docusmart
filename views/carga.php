<head>
    <title>Cargar</title>
</head>
<script>
window.scrollTo(0, 0);
</script> 

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>Documentos</h1>
            </div><!-- /.col -->
            <div class="col" style="white-space:nowrap">
                <a href="controllers/descargar_plantilla_docs.php" class="float-right">
                    <i class="fas fa-download"></i> Descargar formato
                </a>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- FILA PARA INPUT FILE -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Seleccionar archivo de carga</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> <!-- ./ end card-tools -->
                    </div> <!-- ./ end card-header -->
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="form_carga_docs">
                            <div class="row">
                                <div id="colini" class="colc">
                                    <input style="border-color: #343a40;" type="file" name="fileDocs" id="fileDocs" class="form-control" accept=".xls, .xlsx">
                                </div>
                                <div id="res" class="colc" style="margin: auto; text-align: center; width:100%!important">
                                    <button type="submit" value="Cargar" class="btn btn-primary" id="btnCargarDocs"><i class="fa-solid fa-arrow-up-from-bracket mr-2"></i> <span style="display: inline-block;">Cargar </span></button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- ./ end card-body -->
                </div>
            </div>
        </div>
        <!-- FILA PARA IMAGEN DEL GIF -->
        <div class="row mx-0">
            <div class="col-lg-12 mx-0 text-center">
                <img src="assets/img/loading-29.gif" id="img_cargaDocs" style="display:none;">
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>Carreras</h1>
            </div><!-- /.col -->
            <div class="col" style="white-space:nowrap">
                <a href="controllers/descargar_plantilla_docs.php" class="float-right">
                    <i class="fas fa-download"></i> Descargar formato
                </a>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- FILA PARA INPUT FILE -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Seleccionar archivo de carga</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> <!-- ./ end card-tools -->
                    </div> <!-- ./ end card-header -->
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="form_carga_carrera">
                            <div class="row">
                                <div id="colini" class="colc">
                                    <input style="border-color: #343a40;" type="file" name="fileCarrera" id="fileCarrera" class="form-control" accept=".xls, .xlsx">
                                </div>
                                <div id="res" class="colc" style="margin: auto; text-align: center; width:100%!important">
                                    <button type="submit" value="Cargar" class="btn btn-primary" id="btnCargarCarrera"><i class="fa-solid fa-arrow-up-from-bracket mr-2"></i> <span style="display: inline-block;">Cargar </span></button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- ./ end card-body -->
                </div>
            </div>
        </div>
        <!-- FILA PARA IMAGEN DEL GIF -->
        <div class="row mx-0">
            <div class="col-lg-12 mx-0 text-center">
                <img src="assets/img/loading-29.gif" id="img_cargaCarrera" style="display:none;">
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>Materias</h1>
            </div><!-- /.col -->
            <div class="col" style="white-space:nowrap">
                <a href="controllers/descargar_plantilla_docs.php" class="float-right">
                    <i class="fas fa-download"></i> Descargar formato
                </a>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- FILA PARA INPUT FILE -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Seleccionar archivo de carga</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> <!-- ./ end card-tools -->
                    </div> <!-- ./ end card-header -->
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="form_carga_materia">
                            <div class="row">
                                <div id="colini" class="colc">
                                    <input style="border-color: #343a40;" type="file" name="fileMateria" id="fileMateria" class="form-control" accept=".xls, .xlsx">
                                </div>
                                <div id="res" class="colc" style="margin: auto; text-align: center; width:100%!important">
                                    <button type="submit" value="Cargar" class="btn btn-primary" id="btnCargarMateria"><i class="fa-solid fa-arrow-up-from-bracket mr-2"></i> <span style="display: inline-block;">Cargar </span></button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- ./ end card-body -->
                </div>
            </div>
        </div>
        <!-- FILA PARA IMAGEN DEL GIF -->
        <div class="row mx-0">
            <div class="col-lg-12 mx-0 text-center">
                <img src="assets/img/loading-29.gif" id="img_cargaMateria" style="display:none;">
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>Profesores</h1>
            </div><!-- /.col -->
            <div class="col" style="white-space:nowrap">
                <a href="controllers/descargar_plantilla_docs.php" class="float-right">
                    <i class="fas fa-download"></i> Descargar formato
                </a>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- FILA PARA INPUT FILE -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Seleccionar archivo de carga</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> <!-- ./ end card-tools -->
                    </div> <!-- ./ end card-header -->
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" id="form_carga_profesor">
                            <div class="row">
                                <div id="colini" class="colc">
                                    <input style="border-color: #343a40;" type="file" name="fileProfesor" id="fileProfesor" class="form-control" accept=".xls, .xlsx">
                                </div>
                                <div id="res" class="colc" style="margin: auto; text-align: center; width:100%!important">
                                    <button type="submit" value="Cargar" class="btn btn-primary" id="btnCargarProfesor"><i class="fa-solid fa-arrow-up-from-bracket mr-2"></i> <span style="display: inline-block;">Cargar </span></button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- ./ end card-body -->
                </div>
            </div>
        </div>
        <!-- FILA PARA IMAGEN DEL GIF -->
        <div class="row mx-0">
            <div class="col-lg-12 mx-0 text-center">
                <img src="assets/img/loading-29.gif" id="img_cargaProfesor" style="display:none;">
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- Modal-->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div style="background-color:lightgrey;" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalles</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background:rgb(223 223 223)" class="modal-body">
                <div id="accordion">
                    <div class="card card-success">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a id="filasExitosas" class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                                </a>
                            </h4>
                        </div>
                    </div>
                    <div class="card card-danger">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a id="filasNo" class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false">
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">
                                <dl class="row" style="font-size: 1.2em">
                                    <dt class="pt-0 col-10">Filas con campos vacios:</dt>
                                    <dd id="filaVacia" class="pt-0 col-2"></dd>
                                    <dt class="pt-0 col-10">Filas repetidas/existentes:</dt>
                                    <dd id="filaRep" class="pt-0 col-2"></dd>
                                    <dt class="pt-0 col-10">Filas con campos no existentes:</dt>
                                    <dd id="filaInc" class="pt-0 col-2"></dd>
                                    <dt class="pt-0 pb-2 col-12 offset-12">A continuacion se detallan los campos no encontrados:</dt>
                                    <dt class="pt-0 col-4">Cedula(s)</dt>
                                    <dd id="filaCedula" class="pt-0 col-8"></dd>
                                    <dt class="pt-0 col-4">Codigo de materia</dt>
                                    <dd id="filaCodigo" class="pt-0 col-8"></dd>
                                    <dt class="pt-0 col-4">Periodo</dt>
                                    <dd id="filaPer" class="pt-0 col-8"></dd>

                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>
    OverlayScrollbars(document.querySelectorAll('.scroll-modal'), {
        autoUpdate: true,
        scrollbars: {
            autoHide: 'leave'
        }
    });
    $(document).ready(function() {

        $("#form_carga_docs").on("submit", function(e) {
            e.preventDefault();
            submitForm('fileDocs', form_carga_docs , 'btnCargarDocs', 'img_cargaDocs' )
        });

        $("#form_carga_carrera").on("submit", function(e) {
            e.preventDefault();
            submitForm('fileCarrera', 'form_carga_carrera', 'btnCargarCarrera','img_cargaCarrera' )
        });

        $("#form_carga_materia").on("submit", function(e) {
            e.preventDefault();
            submitForm('fileMateria', 'form_carga_materia', 'btnCargarMateria', 'img_cargaMateria' )
        });

        $("#form_carga_profesor").on("submit", function(e) {
            e.preventDefault();
            submitForm('fileProfesor', 'form_carga_profesor', 'btnCargarProfesor', 'img_cargaDocsProfesor' )
        });

        function submitForm(inpfile, form, btnCargar, img_carga) {
            /*===================================================================*/
            //VALIDAR QUE SE SELECCIONE UN ARCHIVO
            /*===================================================================*/
            if ($("#"+inpfile).get(0).files.length == 0) {
                showAlert("Debe seleccionar un archivo.");
            } else {
                /*===================================================================*/
                //VALIDAR QUE EL ARCHIVO SELECCIONADO SEA EN EXTENSION XLS O XLSX
                /*===================================================================*/
                var extensiones_permitidas = [".xls", ".xlsx"];
                var input_file = $("#"+inpfile);
                var exp_reg = new RegExp(
                    "([a-zA-Z0-9s_\\-.:])+(" +
                    extensiones_permitidas.join("|") +")$"
                );

                if (!exp_reg.test(input_file.val().toLowerCase())) {
                    showAlert("Debe seleccionar un archivo con formato .xls o .xlsx");
                    return false;
                }

                var datos = new FormData($(form)[0]);
                $("#"+btnCargar).prop("disabled", true);
                $("#"+img_carga).attr("style", "display:block");
                $("#"+img_carga).attr("style", "width:16rem");
                $(".nav-link.setA").addClass("setD");
                $(".nav-link.setA").removeClass("setA");
                $(".nav-link.setA.active").addClass("setD");
                $(".nav-link.setA.active").removeClass("setA");

                $.ajax({
                    url: "ajax/carga.ajax.php",
                    type: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(src) {
                        handleAjaxResponse(inpfile,src, btnCargar,img_carga);
                    },
                });
            }

            function showAlert(message) {
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: message,
                    showConfirmButton: false,
                    timer: 2000,
                });
            }

            function handleAjaxResponse(inpfile,src, btnCargar,img_carga) {
                console.log(src);
                $("#"+inpfile).val("");
                let MateriasNo = src.MateriasNoRegistradas;
                let cedulasNo = src.CedulasNoRegistradas;
                let periodoNo = src.PeriodoNoRegistrado;
                document.getElementById('filasExitosas').textContent = 'Filas insertadas correctamente: ' + src.silabosRegistrados;
                document.getElementById('filasNo').textContent = 'Filas no insertadas: ' + src.silabosNoRegistrados;
                document.getElementById('filaVacia').textContent = src.silabosVacios;
                document.getElementById('filaRep').textContent = src.silabosRepetidos;
                document.getElementById('filaInc').textContent = src.silabosIncorrectos;
                document.getElementById('filaCedula').textContent = cedulasNo.length > 0 ? cedulasNo.join(', ') : 'NINGUN(O)';
                document.getElementById('filaCodigo').textContent = MateriasNo.length > 0 ? MateriasNo.join(', ') : 'NINGUN(O)';
                document.getElementById('filaPer').textContent = periodoNo.length > 0 ? periodoNo.join(', ') : 'NINGUN(O)';

                if (src.silabosRegistrados > 0) {
                    let txt = '';
                    if (src.silabosNoRegistrados > 0) {
                        txt = 'No se pudieron insertar ' +
                            src.silabosNoRegistrados +
                            ' fila(s)'
                    }
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Se insertaron " +
                            src.silabosRegistrados +
                            " fila(s) correctamente",
                        text: txt,
                        showConfirmButton: true,
                        showCancelButton: true,
                        confirmButtonText: "Ver detalles",
                        cancelButtonText: "Cerrar",
                    }).then((r) => {
                        if (r.value) {
                            $('#modal-default').modal('show');
                        }
                    });

                    $("#"+btnCargar).prop("disabled", false);
                    $("#"+img_carga).attr("style", "display:none");

                    $(".nav-link.setD").addClass("setA");
                    $(".nav-link.setD").removeClass("setD");
                    $(".nav-link.setD.active").addClass("setA");
                    $(".nav-link.setD.active").removeClass("setD");
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "No se pudo insertar ninguna fila",
                        showConfirmButton: true,
                        showCancelButton: true,
                        confirmButtonText: "Ver detalles",
                        cancelButtonText: "Cerrar"
                    }).then((r) => {
                        if (r.value) {
                            $('#modal-default').modal('show');
                        }
                    });

                    $("#"+btnCargar).prop("disabled", false);
                    $("#"+img_carga).attr("style", "display:none");
                    $(".nav-link.setD").addClass("setA");
                    $(".nav-link.setD").removeClass("setD");
                    $(".nav-link.setD.active").addClass("setA");
                    $(".nav-link.setD.active").removeClass("setD");
                }
            }
        }

    });
</script>