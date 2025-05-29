const db = require('../config/conexion');
const bcrypt = require('bcrypt');

exports.registrarUsuario = (nombre, correo, contrasena) => {
  return new Promise(async (resolve, reject) => {
    const hash = await bcrypt.hash(contrasena, 10);
    const sql = 'INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)';
    db.query(sql, [nombre, correo, hash], (err, result) => {
      if (err) return reject(err);
      resolve(result);
    });
  });
};

exports.validarUsuario = (correo, contrasena) => {
  return new Promise((resolve, reject) => {
    const sql = 'SELECT * FROM usuarios WHERE correo = ?';
    db.query(sql, [correo], async (err, results) => {
      if (err) return reject(err);
      if (results.length === 0) return resolve(null);
      const usuario = results[0];
      const match = await bcrypt.compare(contrasena, usuario.contrasena);
      if (match) resolve(usuario);
      else resolve(false);
    });
  });
};