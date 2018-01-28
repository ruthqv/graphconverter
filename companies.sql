-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-01-2018 a las 13:01:33
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravue`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE `companies` (
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capital` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enviroment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employees` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `companies`
--

INSERT INTO `companies` (`name`, `capital`, `enviroment`, `employees`) VALUES
('Company1', '200', '57', '500'),
('Company2', '500', '58', '501'),
('Company3', '10', '59', '502'),
('Company4', '601', '60', '30'),
('Company5', '50', '61', '31'),
('Company6', '300', '63', '601'),
('Company7', '604', '64', '50'),
('Company8', '100', '65', '300'),
('Company9', '900', '58', '604'),
('Company10', '607', '59', '100'),
('Company11', '608', '57', '900'),
('Company12', '609', '58', '59'),
('Company13', '610', '59', '60'),
('Company14', '611', '57', '61'),
('Company15', '612', '58', '63'),
('Company16', '613', '59', '64'),
('Company17', '614', '60', '65'),
('Company18', '60', '61', '58'),
('Company19', '61', '63', '59'),
('Company20', '63', '64', '57'),
('Company21', '64', '65', '58'),
('Company22', '619', '633', '63'),
('Company23', '620', '634', '64'),
('Company24', '60', '635', '65'),
('Company25', '61', '30', '58'),
('Company26', '63', '31', '59'),
('Company27', '30', '638', '57'),
('Company28', '31', '639', '58'),
('Company29', '626', '640', '639'),
('Company30', '627', '30', '640'),
('Company31', '628', '31', '30'),
('Company32', '629', '643', '31'),
('Company33', '30', '61', '643'),
('Company34', '31', '63', '61'),
('Company35', '632', '64', '63'),
('Company36', '633', '57', '64'),
('Company37', '634', '58', '57'),
('Company38', '635', '59', '58'),
('Company39', '30', '60', '59'),
('Company40', '31', '61', '60'),
('Company41', '638', '63', '61'),
('Company42', '639', '64', '63'),
('Company43', '640', '65', '64'),
('Company44', '30', '58', '65'),
('Company45', '31', '633', '58'),
('Company46', '643', '634', '639'),
('Company47', '644', '635', '640'),
('Company48', '645', '30', '30'),
('Company49', '646', '31', '31'),
('Company50', '30', '638', '643'),
('Company51', '31', '639', '61'),
('Company52', '649', '640', '63'),
('Company53', '650', '30', '64'),
('Company54', '651', '31', '57'),
('Company55', '652', '633', '58'),
('Company56', '653', '634', '59'),
('Company57', '30', '635', '60'),
('Company58', '31', '30', '61'),
('Company59', '656', '31', '63'),
('Company60', '657', '638', '64'),
('Company61', '658', '639', '65'),
('Company62', '30', '640', '58'),
('Company63', '31', '30', '633');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
