<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/ee401dfd14.js" crossorigin="anonymous"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/alt/adminlte.min.css">
    <!-- Estilo css -->
    <link href="assets/css/estilos2.css" rel="stylesheet" type="text/css" />
    <!-- Jquery CSS -->
    <link rel="stylesheet" href="assets/plugins/jquery-ui/jquery-ui.min.css">
    <!-- DataTables -->
    <link href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <!-- JStree -->
    <link rel="stylesheet" href="assets/plugins/jstree/default-dark/style.min.css" />

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link href="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.css">
    <link href="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.min.css">
    <link rel="icon" id="icon_dynamic">
    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- jquery UI -->
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/js/adminlte/adminlte.min.js"></script>
    <!-- JSTREE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
    <!-- SweetAlert -->
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- InputMask -->
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Hight light dataTable -->
    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js),datatables.mark.js"></script>
    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
    <!-- <script src="assets/js/drive.js"></script> -->
</head>
<?php if (isset($_SESSION["s_usuario"])) {

?>

    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="wrapper">
            <?php
            include "modules/navbar.php";
            include "modules/sidebar.php";
            ?>
            <!-- Content Wrapper.-->
            <div class="content-wrapper">
                <?php include_once "views/" . $_SESSION["s_usuario"]->vista; ?>
            </div>
        </div>
        <script>
            $('.setA').on("click", function() {
                $('.setA').removeClass('active');
                $(this).addClass('active');
            });

            function cargarContenido(contenedor, contenido) {
                $("." + contenedor).load(contenido);
            }
        </script>
    </body>
<?php } else { ?>

    <body>
        <?php include "views/login.php"; ?>
    </body>
<?php } ?>

</html>
<script>
    class Repositorio {
        constructor() {
            this.key = "1LMAsGBb1viNSdhVB8eJjx-ZRnQbuHpoo";
            this.carpetaPrincipal = this.key;
            this.listadoDirectorios = [];
        }

        async listarCarpeta() {
            try {
                mostrarMensaje(true);
                const parametros = new FormData();
                parametros.append("peticion", "listarCarpeta");
                parametros.append("directorio", this.carpetaPrincipal);
                const resultado = await fetch("controllers/drive.controlador.php", {
                    method: "POST",
                    body: parametros,
                });
                const datos = await resultado.json();
                this.listadoDirectorios = datos.contenido;
                mostrarElementos();
                mostrarMensaje(false);
                return datos;
            } catch (error) {
                mostrarMensaje(false);
                return {
                    datos: false,
                    error: error
                };
            }
        }

        async crearCarpeta(nombre) {
            try {
                mostrarMensaje(true);
                let parametros = new FormData();
                parametros.append("peticion", "crearCarpeta");
                parametros.append("nombre", nombre);
                parametros.append("directorio", this.carpetaPrincipal);
                const resultado = await fetch("controllers/drive.controlador.php", {
                    method: "POST",
                    body: parametros,
                });
                const datos = resultado.json();
                mostrarMensaje(false);
                return datos;
            } catch (error) {
                mostrarMensaje(false);
                return {
                    datos: false,
                    error: error
                };
            }
        }

        async crearArchivo(archivo) {
            try {
                let parametros = new FormData();
                parametros.append("peticion", "crearArchivo");
                parametros.append("archivo", archivo);
                parametros.append("carpeta", this.carpetaPrincipal);
                const resultado = await fetch("controllers/drive.controlador.php", {
                    method: "POST",
                    body: parametros,
                });
                const datos = resultado.json();
                return datos;
            } catch (error) {
                return {
                    datos: false,
                    error: error
                };
            }
        }

        async eliminarArchivo(archivo) {
            try {
                let parametros = new FormData();
                parametros.append("peticion", "eliminarArchivo");
                parametros.append("archivo", archivo);
                const resultado = await fetch("controllers/drive.controlador.php", {
                    method: "POST",
                    body: parametros,
                });
                const datos = resultado.json();
                return datos;
            } catch (error) {
                return {
                    datos: false,
                    error: error
                };
            }
        }

        async eliminarCarpeta(directorio) {
            try {
                let parametros = new FormData();
                parametros.append("peticion", "eliminarCarpeta");
                parametros.append("directorio", directorio);
                const resultado = await fetch("controllers/drive.controlador.php", {
                    method: "POST",
                    body: parametros,
                });
                const datos = resultado.json();
                return datos;
            } catch (error) {
                return {
                    datos: false,
                    error: error
                };
            }
        }
    }
</script>