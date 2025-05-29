const db = require('../config/conexion');

exports.agregarJugador = (id_usuario, id_jugador) => {
  return new Promise((resolve, reject) => {
    const sql = 'INSERT INTO equipos (id_usuario, id_jugador) VALUES (?, ?)';
    db.query(sql, [id_usuario, id_jugador], (err, result) => {
      if (err) return reject(err);
      resolve(result);
    });
  });
};

exports.obtenerEquipo = (id_usuario) => {
  return new Promise((resolve, reject) => {
    const sql = `
      SELECT j.* FROM jugadores j
      INNER JOIN equipos e ON j.id_jugador = e.id_jugador
      WHERE e.id_usuario = ?
    `;
    db.query(sql, [id_usuario], (err, results) => {
      if (err) return reject(err);
      resolve(results);
    });
  });
};