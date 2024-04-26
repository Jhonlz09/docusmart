<?php

require_once "../controllers/configuracion.controlador.php";
require_once "../models/configuracion.modelo.php";

class ajaxConfig
{
    public $tipografico, $institucion, $rutalogo;
    public $elaborado, $aprobado, $cargo1, $cargo2;

    public function obtenerConfig()
    {

        $data = ControladorConfig::ctrobtenerConfig();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function EditarConfig(){
        $data = ControladorConfig::ctrEditarConfig($this->tipografico, $this->institucion, $this->rutalogo, $this->elaborado, $this->aprobado, $this->cargo1, $this->cargo2);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    public function EditarConfigSinLog(){
        $data = ControladorConfig::ctrEditarConfigSinLog($this->tipografico, $this->institucion, $this->elaborado, $this->aprobado, $this->cargo1, $this->cargo2);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
}
if (isset($_POST['accion']) && $_POST['accion'] == 1) { // parametro para listar silabos
    $c = new ajaxConfig();
    $c->obtenerConfig();
} else if ($_POST['accion'] == 2) {
    $c = new ajaxConfig();
    $c->tipografico = $_POST["tipo_grafico"];
    $c->institucion = $_POST["institucion"];
    if (!empty($_FILES['logo']['name'])) {
        $directorio_destino = '../assets/img/'; 
        $directorio_bd = 'assets/img/';
        $nombre_original = $_FILES['logo']['name'];
        $nombre_sanitizado = preg_replace("/[^a-zA-Z0-9_.]/", "", $nombre_original);
        
         // Eliminar la última imagen antes de guardar la nueva
        if (!empty($c->rutalogo) && file_exists($directorio_destino . $c->rutalogo)) {
            unlink($directorio_destino . $c->rutalogo);
        }

        $nombre_archivo = uniqid() . '_' . $nombre_sanitizado;
        $rutaLogo = $directorio_destino . $nombre_archivo;
        $rutaLogobd = $directorio_bd . $nombre_archivo;
        move_uploaded_file($_FILES['logo']['tmp_name'], $rutaLogo);
        $c->rutalogo = $rutaLogobd ;  // Mantenemos el nombre 'rutalogo' aquí si es el nombre que estás usando en otras partes del código
    }
    $c->aprobado = $_POST["aprobado"];
    $c->elaborado = $_POST["elaborado"];
    $c->cargo1 = $_POST["cargo1"];
    $c->cargo2 = $_POST["cargo2"];
    $c->EditarConfig();
} else if ($_POST['accion'] == 3) {
    $c = new ajaxConfig();
    $c->tipografico = $_POST["tipo_grafico"];
    $c->institucion = $_POST["institucion"];
    $c->aprobado = $_POST["aprobado"];
    $c->elaborado = $_POST["elaborado"];
    $c->cargo1 = $_POST["cargo1"];
    $c->cargo2 = $_POST["cargo2"];
    $c->EditarConfigSinLog();
}
