const db = require('../config/conexion');

exports.obtenerJugadores = () => {
  return new Promise((resolve, reject) => {
    db.query('SELECT * FROM jugadores', (err, results) => {
      if (err) return reject(err);
      resolve(results);
    });
  });
};

exports.obtenerJugadorPorId = (id) => {
  return new Promise((resolve, reject) => {
    db.query('SELECT * FROM jugadores WHERE id_jugador = ?', [id], (err, results) => {
      if (err) return reject(err);
      resolve(results[0]);
    });
  });
};