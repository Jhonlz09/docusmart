<?php

require_once "../controllers/combos.controlador.php";
require_once "../models/combos.modelo.php";

class ajaxCombos{
    public function comboProfesores(){

        $data = ControladorCombos::ctrComboProfesores();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function comboMaterias(){

        $data = ControladorCombos::ctrComboMaterias();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function comboHorario(){

        $data = ControladorCombos::ctrComboHorario();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function comboPeriodo(){

        $data = ControladorCombos::ctrComboPeriodo();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function comboCarrera(){

        $data = ControladorCombos::ctrComboCarrera();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function comboDireccion(){

        $data = ControladorCombos::ctrComboDireccion();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function comboTemporada(){

        $data = ControladorCombos::ctrComboTemporada();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function comboNivel(){

        $data = ControladorCombos::ctrComboNivel();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function comboRol(){

        $data = ControladorCombos::ctrComboRol();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
if(isset($_POST['combo']) && $_POST['combo'] == 1){ // parametro para listar silabos
    $c = new AjaxCombos();
    $c -> comboProfesores();
}else if($_POST['combo'] == 2){
    $c = new AjaxCombos();
    $c -> comboMaterias();
}else if($_POST['combo'] == 3){
    $c = new AjaxCombos();
    $c -> comboHorario();
}else if($_POST['combo'] == 4){
    $c = new AjaxCombos();
    $c -> comboPeriodo();
}else if($_POST['combo'] == 5){
    $c = new AjaxCombos();
    $c -> comboTemporada();
}else if($_POST['combo'] == 6){
    $c = new AjaxCombos();
    $c -> comboDireccion();
}else if($_POST['combo'] == 7){
    $c = new AjaxCombos();
    $c -> comboCarrera();
}else if($_POST['combo'] == 8){
    $c = new AjaxCombos();
    $c -> comboNivel();
}else if($_POST['combo'] == 9){
    $c = new AjaxCombos();
    $c -> comboRol();
}
