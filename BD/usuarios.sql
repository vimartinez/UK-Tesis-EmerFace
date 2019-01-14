-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2018 a las 13:11:09
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_ID` int(11) NOT NULL,
  `perf_ID` int(11) NOT NULL,
  `nombreApe` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `login` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fechaAlta` datetime NOT NULL,
  `fechaBaja` datetime DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `barrio` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `localidad` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `provincia` int(11) DEFAULT NULL,
  `mail` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `dni` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_ID`, `perf_ID`, `nombreApe`, `login`, `clave`, `fechaAlta`, `fechaBaja`, `direccion`, `barrio`, `localidad`, `provincia`, `mail`, `dni`, `eliminado`) VALUES
(1, 1, 'Victor Martinez', 'vic', 'victor', '2017-10-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '25987147', 0),
(2, 3, 'Victor Martinez', 'vimartinez', '123456', '2017-10-27 17:39:37', NULL, 'Matheu 845', 'barrio', 'Banfield', 1, 'victordmart@gmail.com', '23234234', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_ID`),
  ADD KEY `usuarios_perfiles` (`perf_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_perfiles` FOREIGN KEY (`perf_ID`) REFERENCES `perfiles` (`perf_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
