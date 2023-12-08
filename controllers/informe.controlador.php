<?php
class InformeControlador{

    static public function ctrGenerarGrafico($desde, $hasta){

        $datos = InformeModelo::mdlGenerarGrafico($desde, $hasta);

        return $datos;
    }

    static public function ctrListarInforme($infoAnio){
    
        $i = InformeModelo::mdlListarInforme($infoAnio);
    
        return $i;
    
    }

    static public function ctrListarInformeAnio($mes_ini, $mes_fin){
    
        $silabos = InformeModelo::mdlListarInformeAnio($mes_ini, $mes_fin);
    
        return $silabos;
    
    }
}