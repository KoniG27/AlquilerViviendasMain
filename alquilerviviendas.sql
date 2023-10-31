-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2023 a las 17:03:09
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alquilerviviendas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `housing`
--

CREATE TABLE `housing` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `type` varchar(15) DEFAULT NULL,
  `form` varchar(20) NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `owner` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `housing`
--

INSERT INTO `housing` (`id`, `titulo`, `type`, `form`, `price`, `owner`, `description`) VALUES
(0, 'Pnsdvkjsnv', 'Casa', 'Vacacional', 150000.00, 1, 'Casa vacacional con 3 habitaciones'),
(1, 'Abc', 'Apartamento', 'Vacacional', 40.00, 1, '2 rooms, 1 kitchen, 1 living room, 1 toi'),
(2, 'Easdasd', 'ApartmentAparta', 'Vacacional', 28.00, 2, '2 rooms, 1 kitchen, 1 living room, 1 toi'),
(3, 'Qscvaca', 'Apartamento', 'Vacacional', 45.00, 3, '2 rooms, 1 kitchen, 1 living room, 1 toi'),
(4, 'Fadwswad', 'Casa', 'Mensual', 120.50, 3, '5 rooms, 1 kitchen, 1 living room, 2 toi'),
(5, 'Gasdsad', 'Apartamento', 'Vacacional', 45.00, 3, '2 rooms, 1 kitchen, 1 living room, 1 toi'),
(6, 'Rdfvfdv', 'Duplex', 'Mensual', 105.00, 3, '3 rooms, 1 kitchen, 1 living room, 1 toi'),
(7, 'Hsdcada', 'Duplex', 'Mensual', 95.80, 1, '3 rooms, 1 kitchen, 1 living room, 1 toi'),
(8, 'Yadscda', 'Edificio', 'Mensual', 15000.00, 1, '3 floor'),
(10, 'Lojscinds', 'Casa', 'Vacacional', 135.50, 1, '5 rooms, 1 kitchen, 1 living room, 2 toi'),
(11, 'Gadwd', 'Casa', 'Vacacional', 145.50, 1, '5 rooms, 1 kitchen, 1 living room, 2 toi'),
(12, 'Nasdef', 'Casa', 'Vacacional', 112.50, 2, '5 rooms, 1 kitchen, 1 living room, 2 toi'),
(16, 'Wsdvfdvfdv', 'Edificio', 'Mensual', 50000.00, 1, 'Edificio de x plantas con y metros cuadrados...');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `housingbook`
--

CREATE TABLE `housingbook` (
  `id` int(10) UNSIGNED NOT NULL,
  `housingId` int(10) UNSIGNED DEFAULT NULL,
  `userId` int(10) UNSIGNED DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `ndays` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Not Conform'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `housingbook`
--

INSERT INTO `housingbook` (`id`, `housingId`, `userId`, `startDate`, `endDate`, `ndays`, `status`) VALUES
(1, 1, 1, '2022-02-01', '2022-02-15', 14, 'Conform'),
(2, 2, 2, '2022-04-01', '2022-04-08', 7, 'Conform'),
(3, 3, 3, '2022-06-01', '2022-06-30', 29, 'Conform'),
(4, 7, 1, '2023-02-09', '2023-02-20', 11, 'Not Conform'),
(5, 4, 1, '2023-02-10', '2023-02-24', 14, 'Not Conform'),
(6, 1, 1, '2023-02-17', '2023-02-23', 6, 'Not Conform'),
(7, 1, 1, '2023-02-10', '2023-02-16', 6, 'Not Conform');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `pass` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `pass`) VALUES
(1, 'Admin', 'Admin@gmail.com', '1234'),
(2, 'Prasath', 'Prasath@gmail.com', '12345'),
(3, 'admin', 'admin@gmail.com', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `housing`
--
ALTER TABLE `housing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_houseOwner` (`owner`);

--
-- Indices de la tabla `housingbook`
--
ALTER TABLE `housingbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_housing` (`housingId`),
  ADD KEY `FK_tenant` (`userId`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `housing`
--
ALTER TABLE `housing`
  ADD CONSTRAINT `FK_houseOwner` FOREIGN KEY (`owner`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `housingbook`
--
ALTER TABLE `housingbook`
  ADD CONSTRAINT `FK_housing` FOREIGN KEY (`housingId`) REFERENCES `housing` (`id`),
  ADD CONSTRAINT `FK_tenant` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
