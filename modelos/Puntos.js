const db = require('../config/conexion');

exports.calcularPuntosUsuario = (id_usuario) => {
  return new Promise((resolve, reject) => {
    const sql = `
      SELECT SUM(p.puntos) AS total
      FROM puntos p
      INNER JOIN equipos e ON p.id_jugador = e.id_jugador
      WHERE e.id_usuario = ?
    `;
    db.query(sql, [id_usuario], (err, results) => {
      if (err) return reject(err);
      resolve(results[0].total || 0);
    });
  });
};