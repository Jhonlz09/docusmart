<?php 

class Conexion {
    static public function ConexionDB(){
        $host = "localhost";
        $dbname = "dbdocusmart";
        $username = "root"; // Cambia esto con tu nombre de usuario MySQL
        $password = ""; // Cambia esto con tu contraseña MySQL
        $port = "3306"; // Puerto predeterminado de MySQL
        $opciones = array(
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Manejo de errores
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4" // Establecer codificación de caracteres
        );

        try {
            $conexion = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password, $opciones);
            return $conexion;
        } catch(PDOException $e) {
            echo("No se pudo conectar a la base de datos, $e");
        }
    }
}
?>
