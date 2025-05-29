const Liga = require('../models/Liga');

exports.unirse = async (req, res) => {
  const { id_usuario, id_liga } = req.body;
  try {
    await Liga.unirseLiga(id_usuario, id_liga);
    res.json({ mensaje: 'Te has unido a la liga.' });
  } catch (error) {
    res.status(500).json({ error: 'Error al unirse a la liga.' });
  }
};

exports.clasificacion = async (req, res) => {
  const { id_liga } = req.params;
  try {
    const clasificacion = await Liga.obtenerClasificacion(id_liga);
    res.json(clasificacion);
  } catch (error) {
    res.status(500).json({ error: 'Error al obtener la clasificación.' });
  }
};