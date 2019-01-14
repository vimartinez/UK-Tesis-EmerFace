-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2018 a las 15:16:18
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
-- Estructura de tabla para la tabla `perf_funcionalidad`
--

CREATE TABLE `perf_funcionalidad` (
  `perFunc_iD` int(11) NOT NULL,
  `per_ID` int(11) NOT NULL,
  `func_ID` int(11) NOT NULL,
  `eliminado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perf_funcionalidad`
--

INSERT INTO `perf_funcionalidad` (`perFunc_iD`, `per_ID`, `func_ID`, `eliminado`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 2, 3, 1),
(5, 1, 4, 0),
(6, 3, 4, 0),
(7, 2, 4, 1),
(8, 1, 5, 0),
(9, 1, 6, 0),
(10, 1, 7, 0),
(11, 1, 8, 0),
(12, 1, 9, 0),
(13, 1, 10, 1),
(14, 1, 11, 0),
(17, 3, 7, 0),
(18, 2, 1, 0),
(19, 2, 2, 0),
(20, 2, 3, 0),
(21, 2, 4, 0),
(22, 2, 5, 0),
(23, 2, 6, 0),
(24, 2, 7, 0),
(25, 1, 14, 0),
(26, 2, 14, 0),
(27, 1, 12, 0),
(28, 1, 13, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `perf_funcionalidad`
--
ALTER TABLE `perf_funcionalidad`
  ADD PRIMARY KEY (`perFunc_iD`),
  ADD KEY `perFunc_perfil` (`per_ID`),
  ADD KEY `perFunc_func` (`func_ID`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `perf_funcionalidad`
--
ALTER TABLE `perf_funcionalidad`
  ADD CONSTRAINT `perFunc_func` FOREIGN KEY (`func_ID`) REFERENCES `funcionalidades` (`func_ID`),
  ADD CONSTRAINT `perFunc_perfil` FOREIGN KEY (`per_ID`) REFERENCES `perfiles` (`perf_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
