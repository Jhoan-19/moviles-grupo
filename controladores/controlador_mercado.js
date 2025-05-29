const Mercado = require('../models/Mercado');

exports.listar = async (req, res) => {
  try {
    const jugadores = await Mercado.listarDisponibles();
    res.json(jugadores);
  } catch (error) {
    res.status(500).json({ error: 'Error al listar jugadores.' });
  }
};

exports.vender = async (req, res) => {
  const { id_jugador, id_usuario } = req.body;
  try {
    await Mercado.venderJugador(id_jugador, id_usuario);
    res.json({ mensaje: 'Jugador vendido correctamente.' });
  } catch (error) {
    res.status(500).json({ error: 'Error al vender jugador.' });
  }
};