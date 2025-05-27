<?php
session_start();
require '../modelos/Mercado.php';

$mercado = new Mercado();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    $id_usuario = $_SESSION['usuario']['id_usuario'];
    $id_jugador = $_POST['id_jugador'];

    if ($accion === 'vender') {
        if ($mercado->venderJugador($id_jugador, $id_usuario)) {
            $_SESSION['mensaje'] = "Jugador vendido correctamente.";
        } else {
            $_SESSION['error'] = "Error al vender jugador.";
        }
    }
    header("Location: ../views/mercado.php");
    exit();
}
?>