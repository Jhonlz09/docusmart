<head>
    <title>Reporte mensual</title>
    <link href="assets/plugins/datatables-searchpanes/css/searchPanes.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables-select/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
</head>
<!-- Contenido Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Reporte mensual</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- card -->
                        <div class="card">
                            <div class="card-header" style="display: inline-flex; align-items: center;">
                                     
                                        <h3 class="card-title mr-3">
                                            Listado de silabos
                                        </h3>
                                        <select name="temporada" id="cboTemp" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        </select>
                                        <select name="Mes" id="cboMes" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger">
                                        </select>
                            </div>          
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">EMPRESARIAL</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">COMUNICACIONES ESTRATÉGICAS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">TURISMO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">INNOVACIÓN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-invierno" data-toggle="pill" href="#custom-content-below-invierno" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">EDUCACIÓN</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                    <table id="tblEmpresarial" class="table table-bordered table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>CARRERA</th>
                                            <th>MATERIA</th>
                                            <th>PROFESOR</th>
                                            <th>PERIODO</th>
                                            <th>MODALIDAD</th>
                                            <th>SILABO</th> 
                                            <th>FECHA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                    </div>
                                    <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <table id="tblComunicaciones" class="table table-bordered table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>CARRERA</th>
                                            <th>MATERIA</th>
                                            <th>PROFESOR</th>
                                            <th>PERIODO</th>
                                            <th>MODALIDAD</th>
                                            <th>SILABO</th> 
                                            <th>FECHA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                    </div>
                                    <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                                    <table id="tblTurismo" class="table table-bordered table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>CARRERA</th>
                                            <th>MATERIA</th>
                                            <th>PROFESOR</th>
                                            <th>PERIODO</th>
                                            <th>MODALIDAD</th>
                                            <th>SILABO</th> 
                                            <th>FECHA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                    </div>
                                    <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
                                    <table id="tblInnovacion" class="table table-bordered table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>CARRERA</th>
                                            <th>MATERIA</th>
                                            <th>PROFESOR</th>
                                            <th>PERIODO</th>
                                            <th>MODALIDAD</th>
                                            <th>SILABO</th> 
                                            <th>FECHA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                    </div>
                                    <div class="tab-pane fade" id="custom-content-below-invierno" role="tabpanel" aria-labelledby="custom-content-invierno">
                                    <table id="tblEducacion" class="table table-bordered table-striped w-100">
                                    <thead>
                                        <tr>
                                        <th>CARRERA</th>
                                        <th>MATERIA</th>
                                        <th>PROFESOR</th>
                                        <th>PERIODO</th>
                                        <th>MODALIDAD</th>
                                        <th>SILABO</th> 
                                        <th>FECHA</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                    </div>
                                </div>
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

<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="assets/plugins/datatables-searchpanes/js/dataTables.searchPanes.min.js"type="text/javascript"></script>
<script src="assets/plugins/datatables-searchpanes/js/searchPanes.bootstrap4.min.js" type="text/javascript"></script>
<script src="assets/plugins/datatables-select/js/dataTables.select.min.js" type="text/javascript"></script>
<script src="assets/plugins/datatables-select/js/select.bootstrap4.min.js" type="text/javascript"></script>

<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>
<script src="assets/js/reporte.js"></script>

