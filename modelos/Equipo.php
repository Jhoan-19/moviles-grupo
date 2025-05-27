<?php
class Equipo {
    private $db;

    public function __construct() {
        include("../config/conexion.php");
        $this->db = $conexion;
    }

    public function agregarJugador($id_usuario, $id_jugador) {
        $sql = "INSERT INTO equipos (id_usuario, id_jugador) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $id_usuario, $id_jugador);
        return mysqli_stmt_execute($stmt);
    }

    public function obtenerEquipo($id_usuario) {
        $sql = "SELECT j.* FROM jugadores j
                INNER JOIN equipos e ON j.id_jugador = e.id_jugador
                WHERE e.id_usuario = $id_usuario";
        $result = mysqli_query($this->db, $sql);
        $equipo = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $equipo[] = $row;
        }
        return $equipo;
    }
}
?>