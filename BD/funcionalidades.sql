-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2018 a las 15:15:52
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
-- Estructura de tabla para la tabla `funcionalidades`
--

CREATE TABLE `funcionalidades` (
  `func_ID` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `funcionalidades`
--

INSERT INTO `funcionalidades` (`func_ID`, `descripcion`, `comentario`) VALUES
(1, 'Gestión de Libros', 'Ingreso de libros al sistema'),
(2, 'Gestión de Autores', 'Registro de autores'),
(3, 'Gestión de socios', 'Administración de socios'),
(4, 'Reserva de libros', 'Reservar un libro para retiro en sucursal (validez 3 dias)'),
(5, 'Préstamo de libros', 'Registro de préstamos'),
(6, 'Devolución de libros', 'Registro de devoluciónes'),
(7, 'Consulta de catálogo', 'Permite visualizar los contenidos disponibles'),
(8, 'Reporte de préstamos', 'Muestra el listado de libros prestados'),
(9, 'Reporte de socios deudores', 'Muestra un listado con los socios deudores'),
(10, 'Listado de socios', 'Muestra los socios activos'),
(11, 'Gestión de sanciones', 'Alta de sanciones a socios deudores'),
(12, 'Gestión de usuarios', ''),
(13, 'Gestión de perfiles', ''),
(14, 'Reporte de reservas', 'Listado de reservas activas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `funcionalidades`
--
ALTER TABLE `funcionalidades`
  ADD PRIMARY KEY (`func_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
