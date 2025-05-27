<?php
session_start();
require '../modelos/Puntos.php';

$puntosModel = new Puntos();
$id_usuario = $_SESSION['usuario']['id_usuario'];
$total = $puntosModel->calcularPuntosUsuario($id_usuario);

$_SESSION['puntos_totales'] = $total;
header("Location: ../views/perfil.php");
exit();
?>