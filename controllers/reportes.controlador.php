<?php

class ReportesControlador{

    static public function ctrListarEmpresarial(){
    
        $reportes = ReportesModelo::mdlListarEmpresarial();
    
        return $reportes;
    
    }

    static public function ctrListarComunicaciones(){
    
        $reportes = ReportesModelo::mdlListarComunicaciones();
    
        return $reportes;
    
    }

    static public function ctrListarTurismo(){
    
        $reportes = ReportesModelo::mdlListarTurismo();
    
        return $reportes;
    
    }

    static public function ctrListarInnovacion(){
    
        $reportes = ReportesModelo::mdlListarInnovacion();
    
        return $reportes;
    
    }

    static public function ctrListarEducacion(){
    
        $reportes = ReportesModelo::mdlListarEducacion();
    
        return $reportes;
    
    }

    static public function ctrListarEnfermeria(){
    
        $reportes = ReportesModelo::mdlListarEnfermeria();
    
        return $reportes;
    
    }
    static public function ctrListarGastronomia(){
        
        $reportes = ReportesModelo::mdlListarGastronomia();
    
        return $reportes;
    
    }

    static public function ctrListarDeporte(){
        
        $reportes = ReportesModelo::mdlListarDeporte();
    
        return $reportes;
    
    }

    static public function ctrListarMecanica(){
        
        $reportes = ReportesModelo::mdlListarMecanica();
    
        return $reportes;
    
    }
}