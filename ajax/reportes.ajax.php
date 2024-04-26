<?php

require_once "../controllers/reportes.controlador.php";
require_once "../models/reportes.modelo.php";

class ajaxReportes{
    
    public function ajaxListarEmpresarial(){
    
        $reportes = ReportesControlador::ctrListarEmpresarial();
    
        echo json_encode($reportes);
    
    }
    public function ajaxListarComunicaciones(){
    
        $reportes = ReportesControlador::ctrListarComunicaciones();
    
        echo json_encode($reportes);
    
    }

    public function ajaxListarTurismo(){
    
        $reportes = ReportesControlador::ctrListarTurismo();
    
        echo json_encode($reportes);
    
    }

    public function ajaxListarInnovacion(){
    
        $reportes = ReportesControlador::ctrListarInnovacion();
    
        echo json_encode($reportes);
    
    }

    public function ajaxListarEducacion(){
    
        $reportes = ReportesControlador::ctrListarEducacion();
    
        echo json_encode($reportes);
    
    }

    public function ajaxListarEnfermeria(){
    
        $reportes = ReportesControlador::ctrListarEnfermeria();
    
        echo json_encode($reportes);
    
    }

    public function ajaxListarGastronomia(){
    
        $reportes = ReportesControlador::ctrListarGastronomia();
    
        echo json_encode($reportes);
    
    }

    public function ajaxListarDeporte(){
    
        $reportes = ReportesControlador::ctrListarDeporte();
    
        echo json_encode($reportes);
    
    }

    public function ajaxListarMecanica(){
    
        $reportes = ReportesControlador::ctrListarMecanica();
    
        echo json_encode($reportes);
    
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar productos
    $r = new ajaxReportes();
    $r -> ajaxListarEmpresarial();
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para listar productos
    $r = new ajaxReportes();
    $r -> ajaxListarComunicaciones();
}else if(isset($_POST['accion']) && $_POST['accion'] == 3){ // parametro para listar productos
    $r = new ajaxReportes();
    $r -> ajaxListarTurismo();
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // parametro para listar productos
    $r = new ajaxReportes();
    $r -> ajaxListarInnovacion();
}else if(isset($_POST['accion']) && $_POST['accion'] == 5){ // parametro para listar productos
    $r = new ajaxReportes();
    $r -> ajaxListarEducacion();
}else if(isset($_POST['accion']) && $_POST['accion'] == 6){ // parametro para listar productos
    $r = new ajaxReportes();
    $r -> ajaxListarEnfermeria();
}else if(isset($_POST['accion']) && $_POST['accion'] == 7){ // parametro para listar productos
    $r = new ajaxReportes();
    $r -> ajaxListarGastronomia();
}else if(isset($_POST['accion']) && $_POST['accion'] == 8){ // parametro para listar productos
    $r = new ajaxReportes();
    $r -> ajaxListarDeporte();
}else if(isset($_POST['accion']) && $_POST['accion'] == 9){ // parametro para listar productos
    $r = new ajaxReportes();
    $r -> ajaxListarMecanica();
}
