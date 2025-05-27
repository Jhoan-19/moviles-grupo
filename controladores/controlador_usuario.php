<?php
session_start();
require '../modelos/Usuario.php';

$usuarioModel = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'registro') {
        $nombre = $_POST['nombre'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $contrasena = $_POST['contrasena'] ?? '';
        $confirmar = $_POST['confirmar'] ?? '';

        if ($contrasena !== $confirmar) {
            $_SESSION['error'] = "Las contraseñas no coinciden.";
            header("Location: ../views/registro.php");
            exit();
        }

        $resultado = $usuarioModel->registrarUsuario($nombre, $correo, $contrasena);
        if ($resultado === true) {
            $_SESSION['mensaje'] = "Registro exitoso. Inicia sesión.";
            header("Location: ../views/login.php");
        } else {
            $_SESSION['error'] = $resultado;
            header("Location: ../views/registro.php");
        }

    } elseif ($accion === 'login') {
        $correo = $_POST['correo'] ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        $resultado = $usuarioModel->validarUsuario($correo, $contrasena);
        if (is_array($resultado)) {
            $_SESSION['usuario'] = $resultado;
            header("Location: ../views/perfil.php");
        } else {
            $_SESSION['error'] = $resultado;
            header("Location: ../views/login.php");
        }
    }
}
?>