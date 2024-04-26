<?php

require_once "../controllers/usuarios.controlador.php";
require_once "../models/usuarios.modelo.php";

class ajaxUsuario
{

    public $usuario, $id_usuario, $estado, $rol, $password;

    public function mostrarUsuarios()
    {

        $data = UsuarioControlador::ctrMostrarUsuarios();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function mostrarUsuariosSuper()
    {

        $data = UsuarioControlador::ctrMostrarUsuariosSuper();

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function agregarUsuarios()
    {

        $data = UsuarioControlador::ctrAgregarUsuarios($this->usuario, $this->password,$this->rol);

        echo json_encode($data);
    }

    public function editarUsuarios()
    {

        $data = UsuarioControlador::ctrEditarUsuarios($this->id_usuario, $this->usuario, $this->rol);

        echo json_encode($data);
    }

    public function eliminarUsuarios()
    {

        $data = UsuarioControlador::ctrEliminarUsuario($this->id_usuario);

        echo json_encode($data);
    }

    public function restablecerClaveUsuario()
    {

        $data = UsuarioControlador::ctrRestablecerClaveUsuario($this->id_usuario, $this->password);

        echo json_encode($data);
    }
}

if (isset($_POST["accion"]) && $_POST['accion'] == "1") {
    $data = new ajaxUsuario();
    $data->mostrarUsuarios();
} else {
    if ($_POST['accion'] == "2") {
        $data = new ajaxUsuario();
        $data->mostrarUsuariosSuper();
    }
    if ($_POST["accion"] == "agregar") {
        $agregar = new ajaxUsuario();
        $agregar->usuario = $_POST["nombre_usuario"];
        $agregar->password = $_POST["clave_usuario"];
        $agregar->rol = $_POST["id_perfil"];
        $agregar->agregarUsuarios();
    }
    if ($_POST["accion"] == "delete") {
        $eliminar = new ajaxUsuario();
        $eliminar->id_usuario = $_POST["id_usuario"];
        $eliminar->eliminarUsuarios();
    }
    if ($_POST["accion"] == "editar") {
        $editar = new ajaxUsuario();
        $editar->id_usuario = $_POST["id_usuario"];
        $editar->usuario = $_POST["nombre_usuario"];
        $editar->rol = $_POST["id_perfil"];
        $editar->editarUsuarios();
    }
    if ($_POST["accion"] == "cambiar") {
        $editar = new ajaxUsuario();
        
        $editar->id_usuario = $_POST["id_usuario"];

        $editar->password = $_POST["clave_usuario"];
        $editar->restablecerClaveUsuario();
    }
}
