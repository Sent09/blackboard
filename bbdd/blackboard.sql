-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2015 a las 20:44:17
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `blackboard`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivospost`
--

CREATE TABLE IF NOT EXISTS `archivospost` (
`idarchivospost` int(11) NOT NULL,
  `url` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `idpost` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `archivospost`
--

INSERT INTO `archivospost` (`idarchivospost`, `url`, `extension`, `idpost`) VALUES
(1, 'archivo_1.pdf', '.pdf', 23),
(2, 'archivo_1.jpg', '.jpg', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `megusta`
--

CREATE TABLE IF NOT EXISTS `megusta` (
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `idpost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `megusta`
--

INSERT INTO `megusta` (`login`, `idpost`) VALUES
('usuario', 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE IF NOT EXISTS `notificaciones` (
`idnotificaciones` int(11) NOT NULL,
  `loginusuario` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `loginusuarioseguido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nuevosposts` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idnotificaciones`, `loginusuario`, `loginusuarioseguido`, `nuevosposts`) VALUES
(6, 'usuario', 'usuario', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE IF NOT EXISTS `post` (
`idpost` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gusta` int(11) DEFAULT NULL,
  `fechapost` datetime DEFAULT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`idpost`, `descripcion`, `gusta`, `fechapost`, `login`) VALUES
(2, 'qweqw eqw eqw eqwe ', 0, '2015-05-04 00:00:00', 'usuario'),
(3, 'qweqw eqw eqw eqwe ', 0, '2015-05-04 00:00:00', 'usuario'),
(4, 'wqe qwe qwe qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(5, 'wqe qwe qwe qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(6, 'qwe qwe qwe qw', 0, '2015-05-04 00:00:00', 'usuario'),
(8, 'qwe qwe qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(9, 'qwe qwe qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(10, 'qweqweqwe', 0, '2015-05-04 00:00:00', 'usuario'),
(12, 'qwerqwe', 0, '2015-05-04 00:00:00', 'usuario'),
(13, 'qweqweqwe qw eqw', 0, '2015-05-04 00:00:00', 'usuario'),
(14, 'qweqw e qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(15, 'qweqw e qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(16, 'qweqw e qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(18, 'qweqw e qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(19, 'qweqw e qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(20, 'qwe qwe qwe qwe qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(21, 'qwe qwe qwe qwe qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(22, 'qwe qwe qwe qwe qwe', 0, '2015-05-04 00:00:00', 'usuario'),
(23, 'qwe qwe qwe ', 0, '2015-05-04 00:00:00', 'usuario'),
(24, 'nuevo post', 0, '2015-05-10 00:00:00', 'usuario'),
(25, 'Yessi es mongola', 0, '2015-05-11 00:00:00', 'usuario'),
(26, 'Quiero mucho a Eu', 0, '2015-05-16 00:00:00', 'usuario'),
(27, 'qweqweqwe', 1, '2015-05-17 00:00:00', 'usuario'),
(28, 'qweqweqwee qwe qwe', 0, '2015-05-17 00:00:00', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `fechaalta` date NOT NULL,
  `isactivo` tinyint(1) NOT NULL DEFAULT '0',
  `isroot` tinyint(1) NOT NULL DEFAULT '0',
  `rol` enum('administrador','usuario') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'usuario',
  `fechalogin` datetime DEFAULT NULL,
  `urlfoto` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`login`, `clave`, `nombre`, `apellidos`, `email`, `fechaalta`, `isactivo`, `isroot`, `rol`, `fechalogin`, `urlfoto`) VALUES
('user', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'nombre', 'apellido', 'andresfuentesfernandez@gmail.com', '2015-05-02', 1, 0, 'usuario', '2015-05-02 00:00:00', NULL),
('usuario', 'b665e217b51994789b02b1838e730d6b93baa30f', 'Nombre', 'Apellidos', 'qwe@gmail.com', '2015-05-02', 1, 0, 'usuario', '2015-05-19 00:00:00', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivospost`
--
ALTER TABLE `archivospost`
 ADD PRIMARY KEY (`idarchivospost`), ADD KEY `idpost` (`idpost`);

--
-- Indices de la tabla `megusta`
--
ALTER TABLE `megusta`
 ADD KEY `login` (`login`), ADD KEY `idpost` (`idpost`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
 ADD PRIMARY KEY (`idnotificaciones`), ADD KEY `loginusuario` (`loginusuario`), ADD KEY `loginusuarioseguido` (`loginusuarioseguido`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`idpost`), ADD KEY `login` (`login`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivospost`
--
ALTER TABLE `archivospost`
MODIFY `idarchivospost` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
MODIFY `idnotificaciones` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivospost`
--
ALTER TABLE `archivospost`
ADD CONSTRAINT `archivospost_ibfk_1` FOREIGN KEY (`idpost`) REFERENCES `post` (`idpost`);

--
-- Filtros para la tabla `megusta`
--
ALTER TABLE `megusta`
ADD CONSTRAINT `megusta_ibfk_1` FOREIGN KEY (`login`) REFERENCES `usuario` (`login`),
ADD CONSTRAINT `megusta_ibfk_2` FOREIGN KEY (`idpost`) REFERENCES `post` (`idpost`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`loginusuario`) REFERENCES `usuario` (`login`),
ADD CONSTRAINT `notificaciones_ibfk_2` FOREIGN KEY (`loginusuarioseguido`) REFERENCES `usuario` (`login`);

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`login`) REFERENCES `usuario` (`login`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
