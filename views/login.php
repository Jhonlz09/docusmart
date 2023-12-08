<!DOCTYPE html>
<html lang="es">

<head>
    <!-- <link rel="shortcut icon" href="assets/img/logoTES.ico" /> -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar sesion</title>
    <link rel="stylesheet" href="assets/css/estilos.css">    
</head>

<body class="hold-transition login-page">

    <div class="container-login">
        <div class="wrap-login">
            <form autocomplete="off" class="needs-validation-login login-form" id="formLogin" method="post" novalidate>
                <span class="login-form-title">Iniciar sesión</span>

                <div class="wrap-input100">
                    <i class="fa-solid fa-user icon"></i>
                    <input autocomplete="off" class="input100" type="text" id="usuario" name="usuario" placeholder="Usuario" required>
                    <span class="focus-efecto"></span>
                    <div class="invalid-feedback">Debe ingresar su usuario*</div>
                </div>

                <div class="wrap-input100">
                    <i class="fa-solid fa-lock icon"></i>
                    <input autocomplete="off" class="input100" type="password" id="password" name="password" placeholder="Contraseña" required>
                    <span class="focus-efecto"></span>
                    <div class="invalid-feedback">Debe ingresar su contraseña*</div>
                </div>
                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <button type="submit" name="submit" class="login-form-btn">Ingresar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    $(document).ready(function() {
        $('#formLogin').submit(function(e) {
            e.preventDefault(); // Evita que se envíe el formulario de manera convencional
            // Verificar la validez del formulario
            if (!this.checkValidity()) {
                // Si el formulario no es válido, mostrar mensajes de validación
                this.classList.add('was-validated');
                return;
            }
            // O usando el atributo name del botón
            // O usando el atributo name del botón
            $('button[name="submit"]').hide();
            $('button[name="submit"]').prop('disabled', true);
            let username = $('#usuario').val();
            let password = $('#password').val();

            // Realizar una solicitud AJAX al archivo sesion.ajax.php
            $.ajax({
                type: 'POST',
                url: 'ajax/sesion.ajax.php',
                data: {
                    username: username,
                    password: password
                },
                success: function(response) {
                    // O usando el atributo name del botón
                    if (response === 'success') {
                        // Autenticación exitosa, redireccionar a otra página
                        window.location.href = "/docusmart/";
                    } else if (response === 'invalid_password') {
                        validarLogin('Contraseña incorrecta', false);
                    } else {
                        validarLogin('Usuario no existe', true)
                    }
                }
            });
        });
    });

    function validarLogin(title,limpiar) {
        Swal.fire({
            title: title,
            icon: 'error',
            background: '#d3d3d3a3',
            confirmButtonColor: '#b7040f',
            didClose: () => {
                setTimeout(function() {
                    if(limpiar){
                    // Vaciar los campos de entrada
                    $('#usuario').val('');
                    $('#password').val('');
                    // Establecer el foco en el campo "usuario"
                    $('#usuario').focus();
                    }else{
                    $('#password').val('');
                    $('#password').focus();
                    }
                    $('button[name="submit"]').show();
                    $('button[name="submit"]').prop('disabled', false);
                }, 0);
            }                   
        });
    }
</script>

</html>
