<?php
class Liga {
    private $db;

    public function __construct() {
        include("../config/conexion.php");
        $this->db = $conexion;
    }

    public function unirseLiga($id_usuario, $id_liga) {
        $sql = "INSERT INTO ligas_usuarios (id_usuario, id_liga) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $id_usuario, $id_liga);
        return mysqli_stmt_execute($stmt);
    }

    public function obtenerClasificacion($id_liga) {
        $sql = "SELECT u.nombre, SUM(p.puntos) as total
                FROM usuarios u
                JOIN equipos e ON u.id_usuario = e.id_usuario
                JOIN puntos p ON e.id_jugador = p.id_jugador
                JOIN ligas_usuarios lu ON lu.id_usuario = u.id_usuario
                WHERE lu.id_liga = ?
                GROUP BY u.id_usuario
                ORDER BY total DESC";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id_liga);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }
}
?>