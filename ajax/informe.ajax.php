<?php

require_once "../controllers/informe.controlador.php";
require_once "../models/informe.modelo.php";

class ajaxInforme{

    public $desde, $hasta, $id_año;

    public function ajaxPDF(){
    
        $pdf = InformeControlador::ctrGenerarGrafico($this->desde, $this->hasta);
        echo json_encode($pdf);
    }

    public function ajaxListarInforme(){
    
        $i = InformeControlador::ctrListarInforme($this->id_año);
    
        echo json_encode($i);
    
    }

    public function ajaxListarInformeAnio(){
    
        $i = InformeControlador::ctrListarInformeAnio($this->desde, $this->hasta);
    
        echo json_encode($i);
    
    }
}
if(isset($_POST['accion']) && $_POST['accion'] == 1){
    $archivo = new ajaxInforme();
    $archivo ->desde = $_POST["desde"];
    $archivo ->hasta = $_POST["hasta"];
    $archivo -> ajaxPDF();
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para listar informe
    $i = new ajaxInforme();
    $i ->id_año = $_POST["infoAnio"];
    $i -> ajaxListarInforme();
}else if(isset($_POST['accion']) && $_POST['accion'] == 3){ // parametro para listar informe por año
    $i = new ajaxInforme();
    $i ->desde = $_POST["mes_ini"];
    $i ->hasta = $_POST["mes_fin"];
    $i -> ajaxListarInformeAnio();
}