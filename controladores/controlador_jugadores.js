const Jugador = require('../models/Jugador');

exports.listar = async (req, res) => {
  try {
    const jugadores = await Jugador.obtenerJugadores();
    res.json(jugadores);
  } catch (error) {
    res.status(500).json({ error: 'Error al obtener jugadores.' });
  }
};