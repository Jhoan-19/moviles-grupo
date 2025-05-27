<?php
class Usuario {
    private $db;

    public function __construct() {
        include("../config/conexion.php");
        $this->db = $conexion;
    }

    public function registrarUsuario($nombre, $correo, $contrasena) {
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sss', $nombre, $correo, $contrasena_hash);
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return "Error al registrar: " . mysqli_stmt_error($stmt);
            }
        } else {
            return "Error al preparar la consulta: " . mysqli_error($this->db);
        }
    }

    public function validarUsuario($correo, $contrasena) {
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = mysqli_prepare($this->db, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $correo);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            if ($usuario = mysqli_fetch_assoc($resultado)) {
                if (password_verify($contrasena, $usuario['contrasena'])) {
                    return $usuario;
                } else {
                    return "Contraseña incorrecta.";
                }
            } else {
                return "Usuario no encontrado.";
            }
        } else {
            return "Error en la consulta: " . mysqli_error($this->db);
        }
    }
}
?>