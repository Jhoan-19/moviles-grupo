<?php
session_start();
require '../modelos/Liga.php';

$ligaModel = new Liga();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    $id_usuario = $_SESSION['usuario']['id_usuario'];
    $id_liga = $_POST['id_liga'];

    if ($accion === 'unirse') {
        if ($ligaModel->unirseLiga($id_usuario, $id_liga)) {
            $_SESSION['mensaje'] = "Te has unido a la liga.";
        } else {
            $_SESSION['error'] = "Error al unirse a la liga.";
        }
    }
    header("Location: ../views/ligas.php");
    exit();
}
?>