<?php
class Mercado {
    private $db;

    public function __construct() {
        include("../config/conexion.php");
        $this->db = $conexion;
    }

    public function listarDisponibles() {
        $sql = "SELECT * FROM jugadores WHERE disponible = 1";
        $result = mysqli_query($this->db, $sql);
        $jugadores = [];
        while ($fila = mysqli_fetch_assoc($result)) {
            $jugadores[] = $fila;
        }
        return $jugadores;
    }

    public function venderJugador($id_jugador, $id_usuario) {
        $sql = "DELETE FROM equipos WHERE id_jugador = ? AND id_usuario = ?";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $id_jugador, $id_usuario);
        return mysqli_stmt_execute($stmt);
    }
}
?>