<?php
class Puntos {
    private $db;

    public function __construct() {
        include("../config/conexion.php");
        $this->db = $conexion;
    }

    public function calcularPuntosUsuario($id_usuario) {
        $sql = "SELECT SUM(p.puntos) AS total
                FROM puntos p
                INNER JOIN equipos e ON p.id_jugador = e.id_jugador
                WHERE e.id_usuario = $id_usuario";
        $result = mysqli_query($this->db, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }
}
?>