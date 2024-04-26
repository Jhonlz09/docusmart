<?php

class ControladorCombos {

    static public function ctrComboProfesores(){
        $data = ModeloCombos::mdlComboProfesores();
        return $data;
    }
    static public function ctrComboMaterias(){
        $data = ModeloCombos::mdlComboMaterias();
        return $data;
    }
    static public function ctrComboHorario(){
        $data = ModeloCombos::mdlComboHorario();
        return $data;
    }
    static public function ctrComboPeriodo(){
        $data = ModeloCombos::mdlComboPeriodo();
        return $data;
    }
    static public function ctrComboCarrera(){
        $data = ModeloCombos::mdlComboCarrera();
        return $data;
    }

    static public function ctrComboDireccion(){
        $data = ModeloCombos::mdlComboDireccion();
        return $data;
    }

    static public function ctrComboTemporada(){
        $data = ModeloCombos::mdlComboTemporada();
        return $data;
    }

    static public function ctrComboNivel(){
        $data = ModeloCombos::mdlComboNivel();
        return $data;
    }

    static public function ctrComboRol(){
        $data = ModeloCombos::mdlComboRol();
        return $data;
    }

}