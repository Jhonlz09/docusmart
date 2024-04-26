<?php

require_once "../utils/database/conexion.php";

class ModeloConfig{
    static public function mdlObtenerConfig(){
        $c = Conexion::ConexionDB()->prepare("SELECT tipo_grafico, institucion, rutalogo, aprobadopor, elaboradopor, cargoaprobado, cargoelaborado FROM tblconfiguracion");
        
        $c -> execute();

        return $c ->fetchAll();
        
    }

    static public function mdlEditarConfig($tipo_grafico,$institucion,$rutalogo,$elaborado,$aprobado,$cargo1,$cargo2){
        $c = Conexion::ConexionDB()->prepare("UPDATE tblconfiguracion SET tipo_grafico=:tipografico,institucion=:institucion, rutalogo=:rutalogo,aprobadopor=:aprobado,cargoaprobado=:cargoaprobado,elaboradopor=:elaborado,cargoelaborado=:cargoelaborado");
        
        $c -> bindParam(":tipografico", $tipo_grafico, PDO::PARAM_INT);
        $c -> bindParam(":institucion", $institucion, PDO::PARAM_STR);
        $c -> bindParam(":rutalogo", $rutalogo, PDO::PARAM_STR);
        $c -> bindParam(":elaborado", $elaborado, PDO::PARAM_STR);
        $c -> bindParam(":aprobado", $aprobado, PDO::PARAM_STR);
        $c -> bindParam(":cargoaprobado", $cargo1, PDO::PARAM_STR);
        $c -> bindParam(":cargoelaborado", $cargo2, PDO::PARAM_STR);

        if($c -> execute()){
            return 'La configuracion se guardo correctamente';
        }else{
            return 'Error, no se pudo editar la configuracion';
        }  
        
    }

    static public function mdlEditarConfigSinLog($tipo_grafico,$institucion,$elaborado,$aprobado,$cargo1,$cargo2){
        $c = Conexion::ConexionDB()->prepare("UPDATE tblconfiguracion SET tipo_grafico=:tipografico,institucion=:institucion,aprobadopor=:aprobado,cargoaprobado=:cargoaprobado,elaboradopor=:elaborado,cargoelaborado=:cargoelaborado");
        
        $c -> bindParam(":tipografico", $tipo_grafico, PDO::PARAM_INT);
        $c -> bindParam(":institucion", $institucion, PDO::PARAM_STR);
        $c -> bindParam(":elaborado", $elaborado, PDO::PARAM_STR);
        $c -> bindParam(":aprobado", $aprobado, PDO::PARAM_STR);
        $c -> bindParam(":cargoaprobado", $cargo1, PDO::PARAM_STR);
        $c -> bindParam(":cargoelaborado", $cargo2, PDO::PARAM_STR);

        if($c -> execute()){
            return 'La configuracion se guardo correctamente';
        }else{
            return 'Error, no se pudo editar la configuracion';
        }  
        
    }
    

}