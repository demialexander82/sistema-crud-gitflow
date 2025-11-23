-- Estructura de la tabla `personajes`
CREATE TABLE IF NOT EXISTS `personajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `nivel` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Datos de ejemplo para la tabla `personajes`
INSERT INTO `personajes` (`id`, `nombre`, `color`, `tipo`, `nivel`, `fecha_creacion`) VALUES
(1, 'Mario', '#FF0000', 'Heroe', 85, '2025-11-22 20:00:00'),
(2, 'Luigi', '#00FF00', 'Heroe', 80, '2025-11-22 20:05:00'),
(3, 'Bowser', '#FFA500', 'Villano', 90, '2025-11-22 20:10:00'),
(4, 'Princesa Peach', '#FFC0CB', 'Heroe', 75, '2025-11-22 20:15:00'),
(5, 'Yoshi', '#00FF00', 'Aliado', 70, '2025-11-22 20:20:00');

-- Estructura de la tabla `usuarios`
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Datos de ejemplo para la tabla `usuarios`
-- La contraseña es 'admin123' (hash generado con password_hash)
INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`, `email`, `fecha_registro`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@ejemplo.com', '2025-11-22 20:00:00');
