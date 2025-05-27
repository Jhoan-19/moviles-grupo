<?php
session_start();
require '../modelos/Jugador.php';

$jugadorModel = new Jugador();
$jugadores = $jugadorModel->obtenerJugadores();
$_SESSION['jugadores'] = $jugadores;
header("Location: ../views/jugadores.php");
exit();
?>