const Usuario = require('../models/Usuario');

exports.registrar = async (req, res) => {
  const { nombre, correo, contrasena } = req.body;
  try {
    await Usuario.registrarUsuario(nombre, correo, contrasena);
    res.json({ mensaje: 'Registro exitoso. Inicia sesión.' });
  } catch (error) {
    res.status(500).json({ error: 'Error al registrar usuario.' });
  }
};

exports.login = async (req, res) => {
  const { correo, contrasena } = req.body;
  try {
    const usuario = await Usuario.validarUsuario(correo, contrasena);
    if (usuario) {
      res.json({ usuario });
    } else {
      res.status(401).json({ error: 'Correo o contraseña incorrectos.' });
    }
  } catch (error) {
    res.status(500).json({ error: 'Error al iniciar sesión.' });
  }
};