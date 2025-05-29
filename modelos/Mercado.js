const db = require('../config/conexion');

exports.listarDisponibles = () => {
  return new Promise((resolve, reject) => {
    db.query('SELECT * FROM jugadores WHERE disponible = 1', (err, results) => {
      if (err) return reject(err);
      resolve(results);
    });
  });
};

exports.venderJugador = (id_jugador, id_usuario) => {
  return new Promise((resolve, reject) => {
    const sql = 'DELETE FROM equipos WHERE id_jugador = ? AND id_usuario = ?';
    db.query(sql, [id_jugador, id_usuario], (err, result) => {
      if (err) return reject(err);
      resolve(result);
    });
  });
};