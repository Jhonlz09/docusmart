<?php 

class UsuarioControlador {

    static public function ctrMostrarUsuarios(){

        $us = UsuarioModelo::mdlMostrarUsuarios();

        return $us;
    }

    static public function ctrMostrarUsuariosSuper(){

        $us = UsuarioModelo::mdlMostrarUsuariosSuper();

        return $us;
    }

    static public function ctrAgregarUsuarios($usuario, $password, $rol){

        $password = crypt($password, '$2a$07$azybxcags23425sdg23sdfhsd$');
        $us = UsuarioModelo::mdlAgregarUsuarios($usuario, $password, $rol);

        return $us;
    }

    static public function ctrEditarUsuarios($id_usuario,$usuario, $rol){

        $us = UsuarioModelo::mdlEditarUsuarios($id_usuario,$usuario, $rol);

        return $us;
    }

    static public function ctrEliminarUsuario($id_usuario){

        $us = UsuarioModelo::mdlEliminarUsuario($id_usuario);

        return $us;
    }

    static public function ctrRestablecerClaveUsuario($id_usuario, $password){
        
        $password = crypt($password, '$2a$07$azybxcags23425sdg23sdfhsd$');
        $us = UsuarioModelo::mdlRestablecerClaveUsuario($id_usuario, $password);

        return $us;
    }
}
?>