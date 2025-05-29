const Puntos = require('../models/Puntos');

exports.obtenerPuntos = async (req, res) => {
  const { id_usuario } = req.params;
  try {
    const total = await Puntos.calcularPuntosUsuario(id_usuario);
    res.json({ puntos_totales: total });
  } catch (error) {
    res.status(500).json({ error: 'Error al calcular puntos.' });
  }
};