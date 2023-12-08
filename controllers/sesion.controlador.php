<?php 

class SesionControlador {

    static public  function login($usuario, $password) {
        $r = SesionModelo::mdlIniciarSesion($usuario, $password);
        return $r;
    }

}
?>