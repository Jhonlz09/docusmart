<?php

class ControladorConfig {

    static public function ctrObtenerConfig(){
        $data = ModeloConfig::mdlObtenerConfig();
        return $data;
    }
    static public function ctrEditarConfig($tipo_grafico,$institucion,$rutalogo,$elaborado,$aprobado,$cargo1,$cargo2){
        $data = ModeloConfig::mdlEditarConfig($tipo_grafico,$institucion,$rutalogo,$elaborado,$aprobado,$cargo1,$cargo2);
        return $data;
    }
    static public function ctrEditarConfigSinLog($tipo_grafico,$institucion,$elaborado,$aprobado,$cargo1,$cargo2){
        $data = ModeloConfig::mdlEditarConfigSinLog($tipo_grafico,$institucion,$elaborado,$aprobado,$cargo1,$cargo2);
        return $data;
    }

}