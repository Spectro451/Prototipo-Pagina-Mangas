-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2025 a las 06:04:05
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `manga`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id`, `usuario_id`, `manga_id`, `titulo`, `imagen`) VALUES
(1, 5, 1145, '...no Onna', 'https://cdn.myanimelist.net/images/manga/2/817.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` enum('SI','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `password`, `admin`) VALUES
(5, 'pipi', 'carlosleviaa13@gmail.com', '$2y$10$D66JrjAB0sJQBw5WrmfF1.vE/9sVKv.Jm7dVkGd7fvpok2eBsiHhS', 'NO'),
(7, 'Spectro451', 'bastyfarias30@gmail.com', '$2y$10$4sOjbxdx3LgQSVrbRJnRQeKNQhuAvWHV/DtCYyCl3dqWmx0ovu/xO', 'SI'),
(8, 'nfioandaw', 'yocelynandreaaa@gmail.com', '$2y$10$sunwGNoV1QFqdZQM5OaN/eDZe2BDPc3Z4m.J5g1a4TvAsO2zZc4tS', 'NO'),
(9, 'fwadwad', 'basty_isa@hotmail.com', '$2y$10$2kW7kzhL2OV6nlys4wU8OuWlkTwHFthON.cQ3HHmv2XPNzTxnZyhG', 'NO'),
(10, 'fawdaz<x<da', 'kiwipoto123@gmail.com', '$2y$10$q.NoVPFoyGAwecRl28msGOiFujPuv2sgm9JilMj44PcwV2w54dMUG', 'NO'),
(11, 'fnwauiodboia', 'peo@gmail.com', '$2y$10$U7yorRwz16zbxL8/tKWnk.EaDHwoJ/HURotgfXaBAo0QAfFm1H5Im', 'NO'),
(12, 'pilinpi', 'poto21312@gmail.com', '$2y$10$FyKr0jKxWp8H7Z.diP37G.xnIbvvocnDLhwbFyDXuigCrvNLsR95W', 'NO'),
(14, 'reyAdmin', 'ReyAdmin', 'SuperAdmin', 'SI');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`manga_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
