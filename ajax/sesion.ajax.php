<?php

require_once "../controllers/sesion.controlador.php";
require_once "../models/sesion.modelo.php";

class ajaxSesion
{

    public $usuario, $password;

    public function ajaxLogin()
    {

        $data = SesionControlador::login($this->usuario, $this->password);

        echo $data;
    }

}

if (isset($_POST['username'])) { 
    $u = new ajaxSesion();
    $u->usuario = $_POST["username"];
    $u->password = $_POST["password"];
    $u->ajaxLogin();
}  