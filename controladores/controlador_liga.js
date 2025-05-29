const db = require('../config/conexion');

exports.unirseLiga = (id_usuario, id_liga) => {
  return new Promise((resolve, reject) => {
    const sql = 'INSERT INTO ligas_usuarios (id_usuario, id_liga) VALUES (?, ?)';
    db.query(sql, [id_usuario, id_liga], (err, result) => {
      if (err) return reject(err);
      resolve(result);
    });
  });
};

exports.obtenerClasificacion = (id_liga) => {
  return new Promise((resolve, reject) => {
    const sql = `
      SELECT u.nombre, SUM(p.puntos) as total
      FROM usuarios u
      JOIN equipos e ON u.id_usuario = e.id_usuario
      JOIN puntos p ON e.id_jugador = p.id_jugador
      JOIN ligas_usuarios lu ON lu.id_usuario = u.id_usuario
      WHERE lu.id_liga = ?
      GROUP BY u.id_usuario
      ORDER BY total DESC
    `;
    db.query(sql, [id_liga], (err, results) => {
      if (err) return reject(err);
      resolve(results);
    });
  });
};