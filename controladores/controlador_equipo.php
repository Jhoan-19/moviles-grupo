<?php
session_start();
require '../modelos/Equipo.php';

$equipoModel = new Equipo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_SESSION['usuario']['id_usuario'];
    $id_jugador = $_POST['id_jugador'];

    if ($equipoModel->agregarJugador($id_usuario, $id_jugador)) {
        $_SESSION['mensaje'] = "Jugador añadido a tu equipo.";
    } else {
        $_SESSION['error'] = "Error al añadir jugador.";
    }
    header("Location: ../views/equipo.php");
    exit();
}
?>