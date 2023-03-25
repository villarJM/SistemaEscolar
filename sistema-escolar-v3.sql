-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2023 a las 02:59:56
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_escolar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `idnumcon` int(10) NOT NULL,
  `idmatricula` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `edad` int(5) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` bigint(10) NOT NULL,
  `semestre` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `turno` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`idnumcon`, `idmatricula`, `nombre`, `apellido`, `edad`, `email`, `telefono`, `semestre`, `turno`) VALUES
(19350734, 1, 'Vianey', 'Alonso Ramirez', 21, 'l19350734@tuxtepec.tecnm.mx', 2871819827, 'PRIMERO', 'MATUTINO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `idasignatura` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `asignatura` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `creditoteo` int(10) NOT NULL,
  `creditopra` int(10) NOT NULL,
  `totalcredito` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`idasignatura`, `asignatura`, `creditoteo`, `creditopra`, `totalcredito`) VALUES
('1D1', 'Calculo Diferencial.', 3, 2, 5),
('1D2', 'FUND. DE PROGRAMACION', 3, 2, 5),
('2D1', 'Calculo Integral.', 3, 2, 5),
('2D2', 'PROG. ORIENTADA A OBJ.', 3, 2, 5),
('3D1', 'Calculo Vectorial.', 3, 2, 5),
('3D2', 'ESTRUCTURA DE DATOS', 3, 2, 5),
('4D1', 'Ecuaciones Diferenciales.', 3, 2, 5),
('4D2', 'METODOS NUMERICOS', 3, 2, 5),
('5D1', 'Des. Sustentable.', 3, 2, 5),
('5D2', 'FUND. DE TELEC.', 3, 2, 5),
('6D1', 'LENG. Y AUTOMATAS I', 3, 2, 5),
('6D2', 'REDES DE COMP.', 3, 2, 5),
('7D1', 'LENG. Y AUT. II', 3, 2, 5),
('8D1', 'PROG LOG Y FUN.', 3, 2, 5),
('9D1', 'RESIDENCIAS', 5, 5, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturaalumno`
--

CREATE TABLE `asignaturaalumno` (
  `idasignar` int(10) NOT NULL,
  `idasignatura` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `idnumcon` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `asignaturaalumno`
--

INSERT INTO `asignaturaalumno` (`idasignar`, `idasignatura`, `idnumcon`) VALUES
(1, '1D1', 19350734),
(2, '2D1', 19350734),
(3, '3D1', 19350734),
(4, '4D1', 19350734),
(5, '5D1', 19350734);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturacarrera`
--

CREATE TABLE `asignaturacarrera` (
  `idasignar` int(10) NOT NULL,
  `idasignatura` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `idmatricula` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `asignaturacarrera`
--

INSERT INTO `asignaturacarrera` (`idasignar`, `idasignatura`, `idmatricula`) VALUES
(1, '1D1', 1),
(2, '2D1', 1),
(3, '3D1', 1),
(4, '4D1', 1),
(5, '5D1', 1),
(6, '6D1', 1),
(7, '7D1', 1),
(8, '8D1', 1),
(9, '9D1', 1),
(10, '1D2', 1),
(11, '2D2', 1),
(12, '3D2', 1),
(13, '4D2', 1),
(14, '5D2', 1),
(15, '6D2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones_parciales`
--

CREATE TABLE `calificaciones_parciales` (
  `idcali` int(10) NOT NULL,
  `idnumcon` int(10) NOT NULL,
  `idprofesor` int(10) NOT NULL,
  `idasignatura` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `unidadI` decimal(10,0) NOT NULL,
  `unidadII` decimal(10,0) NOT NULL,
  `unidadIII` decimal(10,0) NOT NULL,
  `unidadIV` decimal(10,0) NOT NULL,
  `unidadV` decimal(10,0) NOT NULL,
  `unidadVI` decimal(10,0) NOT NULL,
  `unidadVII` decimal(10,0) NOT NULL,
  `unidadVIII` decimal(10,0) NOT NULL,
  `promedio_final` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `idmatricula` int(10) NOT NULL,
  `carrera` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`idmatricula`, `carrera`, `estado`) VALUES
(0, '', 1),
(1, 'Ingeniería en Sistemas Computacionales.', 1),
(2, 'Licenciatura en Informática.', 1),
(3, 'Ingeniería Civil.', 1),
(4, 'Licenciatura en Administración.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `idgrupo` int(10) NOT NULL,
  `grupo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `turno` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`idgrupo`, `grupo`, `turno`) VALUES
(1, 'A', 'MATUTINO'),
(2, 'B', 'MATUTINO'),
(3, 'A', 'VESPERTINO'),
(4, 'B', 'VESPERTINO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idgrupos` int(10) NOT NULL,
  `idmatricula` int(10) NOT NULL,
  `idprofesor` int(10) NOT NULL,
  `idnumcon` int(10) NOT NULL,
  `idasignatura` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `idgrupo` int(10) NOT NULL,
  `idhorario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idhorario` int(10) NOT NULL,
  `horario` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idhorario`, `horario`) VALUES
(1, '07:00:00 - 08:00:00'),
(2, '08:00:00 - 09:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imparte`
--

CREATE TABLE `imparte` (
  `idimparte` int(10) NOT NULL,
  `idasignatura` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `idprofesor` int(10) NOT NULL,
  `idhorario` int(10) NOT NULL,
  `idgrupo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` int(10) NOT NULL,
  `permiso` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `permiso`) VALUES
(1, 'nuevo_alumno'),
(2, 'configuracion'),
(3, 'alumnos'),
(4, 'reticula'),
(5, 'calificaciones'),
(6, 'usuarios'),
(7, 'capturar'),
(8, 'registrar_profesor'),
(9, 'registrar_carrera'),
(10, 'registrar_materia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisousuario`
--

CREATE TABLE `permisousuario` (
  `id` int(10) NOT NULL,
  `idpermiso` int(10) NOT NULL,
  `idusuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permisousuario`
--

INSERT INTO `permisousuario` (`id`, `idpermiso`, `idusuario`) VALUES
(1, 1, 19350325),
(2, 2, 19350325),
(3, 3, 19350325),
(4, 4, 19350325),
(5, 5, 19350325),
(6, 6, 19350325),
(7, 7, 19350325),
(8, 8, 19350325),
(9, 9, 19350325),
(10, 10, 19350325),
(11, 4, 19350734),
(12, 5, 19350734);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `idprofesor` int(10) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` bigint(10) NOT NULL,
  `estado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`idprofesor`, `nombre`, `apellido`, `email`, `telefono`, `estado`) VALUES
(1, 'MISAEL', 'Villar Julian', 'villarmisael7@gmail.com', 2871819827, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reticula`
--

CREATE TABLE `reticula` (
  `idreticula` int(10) NOT NULL,
  `idcarrera` int(5) NOT NULL,
  `idnumcon` int(10) NOT NULL,
  `idasignatura` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `idcali` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idtipo` int(10) NOT NULL,
  `idusuario` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idtipo`, `idusuario`, `nombre`, `usuario`, `contrasena`, `estado`) VALUES
(1, 19350325, 'Misael Villar Julian', 'ADMIN', '73acd9a5972130b75066c82595a1fae3', 1),
(2, 19350734, 'Vianey Alonso Ramirez', 'Vianey', 'bdd63d9def6cbf749fc3784379e16e49', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`idnumcon`),
  ADD KEY `idmatricula` (`idmatricula`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`idasignatura`);

--
-- Indices de la tabla `asignaturaalumno`
--
ALTER TABLE `asignaturaalumno`
  ADD PRIMARY KEY (`idasignar`),
  ADD UNIQUE KEY `idasignatura` (`idasignatura`,`idnumcon`),
  ADD KEY `idnumcon` (`idnumcon`);

--
-- Indices de la tabla `asignaturacarrera`
--
ALTER TABLE `asignaturacarrera`
  ADD PRIMARY KEY (`idasignar`);

--
-- Indices de la tabla `calificaciones_parciales`
--
ALTER TABLE `calificaciones_parciales`
  ADD PRIMARY KEY (`idcali`),
  ADD UNIQUE KEY `idnumcon` (`idnumcon`,`idprofesor`,`idasignatura`),
  ADD KEY `idprofesor` (`idprofesor`),
  ADD KEY `idasignatura` (`idasignatura`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`idmatricula`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idgrupo`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idgrupos`),
  ADD UNIQUE KEY `idmatricula` (`idmatricula`,`idprofesor`,`idnumcon`),
  ADD UNIQUE KEY `idmateria` (`idasignatura`),
  ADD UNIQUE KEY `idgrupo` (`idgrupo`),
  ADD UNIQUE KEY `idhorario` (`idhorario`),
  ADD KEY `idnumcon` (`idnumcon`),
  ADD KEY `idprofesor` (`idprofesor`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idhorario`);

--
-- Indices de la tabla `imparte`
--
ALTER TABLE `imparte`
  ADD PRIMARY KEY (`idimparte`),
  ADD UNIQUE KEY `idasignatura` (`idasignatura`,`idprofesor`),
  ADD UNIQUE KEY `idhorario` (`idhorario`),
  ADD UNIQUE KEY `idgrupo` (`idgrupo`),
  ADD KEY `idprofesor` (`idprofesor`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `permisousuario`
--
ALTER TABLE `permisousuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpermiso` (`idpermiso`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`idprofesor`);

--
-- Indices de la tabla `reticula`
--
ALTER TABLE `reticula`
  ADD PRIMARY KEY (`idreticula`),
  ADD UNIQUE KEY `idnumcon` (`idnumcon`),
  ADD UNIQUE KEY `idasignatura` (`idasignatura`),
  ADD UNIQUE KEY `idcali` (`idcali`),
  ADD UNIQUE KEY `idcarrera` (`idcarrera`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idtipo`),
  ADD UNIQUE KEY `clave_usuario` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaturaalumno`
--
ALTER TABLE `asignaturaalumno`
  MODIFY `idasignar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `asignaturacarrera`
--
ALTER TABLE `asignaturacarrera`
  MODIFY `idasignar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `calificaciones_parciales`
--
ALTER TABLE `calificaciones_parciales`
  MODIFY `idcali` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idgrupo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idgrupos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imparte`
--
ALTER TABLE `imparte`
  MODIFY `idimparte` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisousuario`
--
ALTER TABLE `permisousuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `idprofesor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idtipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`idmatricula`) REFERENCES `carrera` (`idmatricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignaturaalumno`
--
ALTER TABLE `asignaturaalumno`
  ADD CONSTRAINT `asignaturaalumno_ibfk_1` FOREIGN KEY (`idasignatura`) REFERENCES `asignatura` (`idasignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignaturaalumno_ibfk_2` FOREIGN KEY (`idnumcon`) REFERENCES `alumnos` (`idnumcon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificaciones_parciales`
--
ALTER TABLE `calificaciones_parciales`
  ADD CONSTRAINT `calificaciones_parciales_ibfk_1` FOREIGN KEY (`idnumcon`) REFERENCES `alumnos` (`idnumcon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calificaciones_parciales_ibfk_2` FOREIGN KEY (`idprofesor`) REFERENCES `profesores` (`idprofesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calificaciones_parciales_ibfk_3` FOREIGN KEY (`idasignatura`) REFERENCES `asignatura` (`idasignatura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`idnumcon`) REFERENCES `alumnos` (`idnumcon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupos_ibfk_2` FOREIGN KEY (`idmatricula`) REFERENCES `carrera` (`idmatricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupos_ibfk_3` FOREIGN KEY (`idprofesor`) REFERENCES `profesores` (`idprofesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupos_ibfk_4` FOREIGN KEY (`idasignatura`) REFERENCES `asignatura` (`idasignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupos_ibfk_5` FOREIGN KEY (`idgrupo`) REFERENCES `grupo` (`idgrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupos_ibfk_6` FOREIGN KEY (`idhorario`) REFERENCES `horario` (`idhorario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imparte`
--
ALTER TABLE `imparte`
  ADD CONSTRAINT `imparte_ibfk_1` FOREIGN KEY (`idasignatura`) REFERENCES `asignatura` (`idasignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `imparte_ibfk_2` FOREIGN KEY (`idprofesor`) REFERENCES `profesores` (`idprofesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `imparte_ibfk_3` FOREIGN KEY (`idhorario`) REFERENCES `horario` (`idhorario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `imparte_ibfk_4` FOREIGN KEY (`idgrupo`) REFERENCES `grupo` (`idgrupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisousuario`
--
ALTER TABLE `permisousuario`
  ADD CONSTRAINT `permisousuario_ibfk_1` FOREIGN KEY (`idpermiso`) REFERENCES `permisos` (`idpermiso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisousuario_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reticula`
--
ALTER TABLE `reticula`
  ADD CONSTRAINT `reticula_ibfk_1` FOREIGN KEY (`idnumcon`) REFERENCES `alumnos` (`idnumcon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reticula_ibfk_2` FOREIGN KEY (`idasignatura`) REFERENCES `asignatura` (`idasignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reticula_ibfk_3` FOREIGN KEY (`idcali`) REFERENCES `calificaciones_parciales` (`idcali`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reticula_ibfk_4` FOREIGN KEY (`idcarrera`) REFERENCES `carrera` (`idmatricula`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
