<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; 
$basedatos = "moviles";

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena, $basedatos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>