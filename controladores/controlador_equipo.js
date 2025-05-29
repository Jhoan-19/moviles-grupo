const Equipo = require('../models/Equipo');

exports.agregarJugador = async (req, res) => {
  const { id_usuario, id_jugador } = req.body;
  try {
    await Equipo.agregarJugador(id_usuario, id_jugador);
    res.json({ mensaje: 'Jugador añadido a tu equipo.' });
  } catch (error) {
    res.status(500).json({ error: 'Error al añadir jugador.' });
  }
};

exports.obtenerEquipo = async (req, res) => {
  const { id_usuario } = req.params;
  try {
    const equipo = await Equipo.obtenerEquipo(id_usuario);
    res.json(equipo);
  } catch (error) {
    res.status(500).json({ error: 'Error al obtener el equipo.' });
  }
};