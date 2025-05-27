<?php
class Jugador {
    private $db;

    public function __construct() {
        include("../config/conexion.php");
        $this->db = $conexion;
    }

    public function obtenerJugadores() {
        $sql = "SELECT * FROM jugadores";
        $result = mysqli_query($this->db, $sql);
        $jugadores = [];
        while ($fila = mysqli_fetch_assoc($result)) {
            $jugadores[] = $fila;
        }
        return $jugadores;
    }

    public function obtenerJugadorPorId($id) {
        $sql = "SELECT * FROM jugadores WHERE id_jugador = $id";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }
}
?>