-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-07-2026 a las 21:09:17
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
-- Base de datos: `reportes_ordenes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autobus`
--

CREATE TABLE `autobus` (
  `id` int(11) NOT NULL,
  `unidad` varchar(500) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autobus`
--

INSERT INTO `autobus` (`id`, `unidad`, `id_empresa`, `eliminado`) VALUES
(1, 'AM-001', 1, 0),
(2, 'AM-002', 1, 0),
(3, 'AM-003', 1, 0),
(4, 'AM-004', 1, 0),
(5, 'AM-005', 1, 0),
(6, 'AM-006', 1, 0),
(7, 'AM-007', 1, 0),
(8, 'AM-008', 1, 0),
(9, 'AM-009', 1, 0),
(10, 'AM-010', 1, 0),
(11, 'AM-011', 1, 0),
(12, 'AM-012', 1, 0),
(13, 'AM-013', 1, 0),
(14, 'AM-014', 1, 0),
(15, 'AM-015', 1, 0),
(16, 'AM-016', 1, 0),
(17, 'AM-017', 1, 0),
(18, 'AM-018', 1, 0),
(19, 'AM-019', 1, 0),
(20, 'AM-020', 1, 0),
(21, 'AM-021', 1, 0),
(22, 'AM-022', 1, 0),
(23, 'AM-023', 1, 0),
(24, 'AM-024', 1, 0),
(25, 'AM-025', 1, 0),
(26, 'AM-026', 1, 0),
(27, 'AM-027', 1, 0),
(28, 'AM-028', 1, 0),
(29, 'AM-029', 1, 0),
(30, 'AM-030', 1, 0),
(31, 'AM-031', 1, 0),
(32, 'AM-032', 1, 0),
(33, 'AM-033', 1, 0),
(34, 'AM-034', 1, 0),
(35, 'AM-035', 1, 0),
(36, 'AM-036', 1, 0),
(37, 'AM-037', 1, 0),
(38, 'AM-038', 1, 0),
(39, 'AM-039', 1, 0),
(40, 'AM-040', 1, 0),
(41, 'AM-041', 1, 0),
(42, 'AM-042', 1, 0),
(43, 'AM-043', 1, 0),
(44, 'AM-044', 1, 0),
(45, 'AM-045', 1, 0),
(46, 'AM-046', 1, 0),
(47, 'AM-047', 1, 0),
(48, 'AM-048', 1, 0),
(49, 'AM-049', 1, 0),
(50, 'AM-050', 1, 0),
(51, 'AM-051', 1, 0),
(52, 'AM-052', 1, 0),
(53, 'AM-053', 1, 0),
(54, 'AM-054', 1, 0),
(55, 'AM-055', 1, 0),
(56, 'AM-056', 1, 0),
(57, 'AM-057', 1, 0),
(58, 'AM-058', 1, 0),
(59, 'AM-059', 1, 0),
(60, 'AM-060', 1, 0),
(61, 'AM-061', 1, 0),
(62, 'AM-062', 1, 0),
(63, 'AM-063', 1, 0),
(64, 'AM-064', 1, 0),
(65, 'AM-065', 1, 0),
(66, 'AM-066', 1, 0),
(67, 'AM-067', 1, 0),
(68, 'AM-068', 1, 0),
(69, 'AM-069', 1, 0),
(70, 'AM-070', 1, 0),
(71, 'AM-071', 1, 0),
(72, 'AM-072', 1, 0),
(73, 'AM-073', 1, 0),
(74, 'AM-074', 1, 0),
(75, 'AM-075', 1, 0),
(76, 'AM-076', 1, 0),
(77, 'AM-077', 1, 0),
(78, 'AM-086', 1, 0),
(79, 'AM-087', 1, 0),
(80, 'TM-001', 1, 0),
(81, 'TM-002', 1, 0),
(82, 'TM-003', 1, 0),
(83, 'TM-004', 1, 0),
(84, 'TM-005', 1, 0),
(85, 'TM-006', 1, 0),
(86, 'TM-007', 1, 0),
(87, 'TM-008', 1, 0),
(88, 'TM-009', 1, 0),
(89, 'TM-010', 1, 0),
(90, 'TM-011', 1, 0),
(91, 'TM-012', 1, 0),
(92, 'TM-013', 1, 0),
(93, 'TM-014', 1, 0),
(94, 'TM-015', 1, 0),
(95, 'TM-016', 1, 0),
(96, 'TM-017', 1, 0),
(97, 'TM-018', 1, 0),
(98, 'TM-019', 1, 0),
(99, 'TM-020', 1, 0),
(100, 'TM-021', 1, 0),
(101, 'TM-022', 1, 0),
(102, 'TM-023', 1, 0),
(103, 'TM-024', 1, 0),
(104, 'TM-025', 1, 0),
(105, 'TM-026', 1, 0),
(106, 'TM-027', 1, 0),
(107, 'TM-028', 1, 0),
(108, 'TM-029', 1, 0),
(109, 'TM-030', 1, 0),
(110, 'TM-031', 1, 0),
(111, 'TM-032', 1, 0),
(112, 'TM-033', 1, 0),
(113, 'TM-034', 1, 0),
(114, 'TM-035', 1, 0),
(115, 'TM-036', 1, 0),
(116, 'TM-037', 1, 0),
(117, 'TM-038', 1, 0),
(118, 'TM-039', 1, 0),
(119, 'TM-040', 1, 0),
(120, 'TM-041', 1, 0),
(121, 'TM-042', 1, 0),
(122, 'TM-043', 1, 0),
(123, 'TM-044', 1, 0),
(124, 'TM-045', 1, 0),
(125, 'TM-046', 1, 0),
(126, 'TM-047', 1, 0),
(127, 'TM-048', 1, 0),
(128, 'TM-049', 1, 0),
(129, 'TM-050', 1, 0),
(130, 'TM-051', 1, 0),
(131, 'TM-052', 1, 0),
(132, 'TM-053', 1, 0),
(133, 'TM-054', 1, 0),
(134, 'TM-055', 1, 0),
(135, 'TM-056', 1, 0),
(136, 'TM-057', 1, 0),
(137, 'TM-058', 1, 0),
(138, 'TM-059', 1, 0),
(139, 'TM-060', 1, 0),
(140, 'TM-061', 1, 0),
(141, 'TM-062', 1, 0),
(142, 'TM-063', 1, 0),
(143, 'TM-064', 1, 0),
(144, 'TM-065', 1, 0),
(145, 'TM-066', 1, 0),
(146, 'TM-067', 1, 0),
(147, 'TM-068', 1, 0),
(148, 'TM-069', 1, 0),
(149, 'TM-070', 1, 0),
(150, 'TM-071', 1, 0),
(151, 'TM-072', 1, 0),
(152, 'TM-073', 1, 0),
(153, 'TM-074', 1, 0),
(154, 'TM-075', 1, 0),
(155, 'TM-076', 1, 0),
(156, 'UM-055', 1, 0),
(157, 'UM-056', 1, 0),
(158, 'VU-001', 1, 0),
(159, 'VU-002', 1, 0),
(160, 'VU-003', 1, 0),
(161, 'VU-004', 1, 0),
(162, 'AR-001', 2, 0),
(163, 'AR-002', 2, 0),
(164, 'AR-003', 2, 0),
(165, 'AR-004', 2, 0),
(166, 'AR-005', 2, 0),
(167, 'AR-006', 2, 0),
(168, 'AR-007', 2, 0),
(169, 'AR-008', 2, 0),
(170, 'AR-009', 2, 0),
(171, 'AR-010', 2, 0),
(172, 'AR-011', 2, 0),
(173, 'AR-012', 2, 0),
(174, 'AR-013', 2, 0),
(175, 'AR-014', 2, 0),
(176, 'AR-015', 2, 0),
(177, 'AR-016', 2, 0),
(178, 'AR-017', 2, 0),
(179, 'AR-018', 2, 0),
(180, 'AR-019', 2, 0),
(181, 'AR-020', 2, 0),
(182, 'AR-021', 2, 0),
(183, 'AR-022', 2, 0),
(184, 'AR-023', 2, 0),
(185, 'AR-024', 2, 0),
(186, 'AR-025', 2, 0),
(187, 'AR-026', 2, 0),
(188, 'AR-027', 2, 0),
(189, 'AR-028', 2, 0),
(190, 'AR-029', 2, 0),
(191, 'AR-030', 2, 0),
(192, 'AR-031', 2, 0),
(193, 'AR-032', 2, 0),
(194, 'AR-033', 2, 0),
(195, 'AR-034', 2, 0),
(196, 'AR-035', 2, 0),
(197, 'AR-036', 2, 0),
(198, 'AR-037', 2, 0),
(199, 'AR-038', 2, 0),
(200, 'TR-001', 2, 0),
(201, 'TR-002', 2, 0),
(202, 'TR-003', 2, 0),
(203, 'TR-004', 2, 0),
(204, 'TR-005', 2, 0),
(205, 'TR-006', 2, 0),
(206, 'TR-007', 2, 0),
(207, 'TR-008', 2, 0),
(208, 'TR-009', 2, 0),
(209, 'TR-010', 2, 0),
(210, 'TR-011', 2, 0),
(211, 'TR-012', 2, 0),
(212, 'TR-013', 2, 0),
(213, 'TR-014', 2, 0),
(214, 'TR-015', 2, 0),
(215, 'TR-016', 2, 0),
(216, 'TR-017', 2, 0),
(217, 'TR-018', 2, 0),
(218, 'TR-019', 2, 0),
(219, 'TR-020', 2, 0),
(220, 'TR-021', 2, 0),
(221, 'TR-022', 2, 0),
(222, 'TR-023', 2, 0),
(223, 'TR-024', 2, 0),
(224, 'TR-025', 2, 0),
(225, 'TR-026', 2, 0),
(226, 'TR-027', 2, 0),
(227, 'TR-028', 2, 0),
(228, 'TR-029', 2, 0),
(229, 'TR-030', 2, 0),
(230, 'TR-031', 2, 0),
(231, 'TR-032', 2, 0),
(232, 'TR-033', 2, 0),
(233, 'TR-034', 2, 0),
(234, 'TR-035', 2, 0),
(235, 'TR-036', 2, 0),
(236, 'TR-037', 2, 0),
(237, 'TR-038', 2, 0),
(238, 'TR-039', 2, 0),
(239, 'TR-040', 2, 0),
(240, 'TR-041', 2, 0),
(241, 'TR-042', 2, 0),
(242, 'TR-043', 2, 0),
(243, 'TR-044', 2, 0),
(244, 'TR-045', 2, 0),
(245, 'TR-046', 2, 0),
(246, 'TR-047', 2, 0),
(247, 'TR-048', 2, 0),
(248, 'TR-049', 2, 0),
(249, 'TR-050', 2, 0),
(250, 'TR-051', 2, 0),
(251, 'TR-052', 2, 0),
(252, 'TR-053', 2, 0),
(253, 'TR-054', 2, 0),
(254, 'TR-055', 2, 0),
(255, 'TR-056', 2, 0),
(256, 'TR-057', 2, 0),
(257, 'TR-058', 2, 0),
(258, 'TR-059', 2, 0),
(259, 'TR-060', 2, 0),
(260, 'TR-061', 2, 0),
(261, 'TR-062', 2, 0),
(262, 'TR-063', 2, 0),
(264, 'C112-140', 4, 0),
(265, 'C112-141', 4, 0),
(266, 'C112-142', 4, 0),
(267, 'C112-143', 4, 0),
(268, 'C112-144', 4, 0),
(269, 'C112-145', 4, 0),
(270, 'C112-146', 4, 0),
(271, 'C112-147', 4, 0),
(272, 'C112-148', 4, 0),
(273, 'C112-149', 4, 0),
(274, 'C112-150', 4, 0),
(275, 'C140-12', 4, 1),
(276, 'C140-13', 4, 1),
(277, 'C140-14', 4, 1),
(278, 'C140-15', 4, 1),
(279, 'C140-16', 4, 1),
(280, 'C140-17', 4, 1),
(281, 'C140-18', 4, 1),
(282, 'C140-19', 4, 1),
(283, 'C140-20', 4, 1),
(284, 'CIM-17', 3, 0),
(285, 'CIM-18', 3, 0),
(286, 'CIM-19', 3, 0),
(287, 'CIM-20', 3, 0),
(288, 'CIM-21', 3, 0),
(289, 'CIM-22', 3, 0),
(290, 'CIM-23', 3, 0),
(291, 'CIM-24', 3, 0),
(292, 'CIM-25', 3, 0),
(293, 'CIM-26', 3, 0),
(294, 'CIM-27', 3, 0),
(295, 'CIM-28', 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_razones`
--

CREATE TABLE `catalogo_razones` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `catalogo_razones`
--

INSERT INTO `catalogo_razones` (`id`, `descripcion`) VALUES
(1, 'CORRECTIVO TRONCAL'),
(2, 'CORRECTIVO ALIMENTADOR'),
(3, 'PREVENTIVO TRONCAL'),
(4, 'PREVENTIVO ALIMENTADOR'),
(5, 'ACCIDENTE TRONCAL'),
(6, 'ACCIDENTE ALIMENTADOR'),
(7, 'RESCATE VIAL TRONCAL'),
(8, 'RESCATE VIAL ALIMENTADOR'),
(9, 'CARROCERÍAS TRONCAL'),
(10, 'CARROCERÍAS ALIMENTADOR'),
(11, 'LLANTAS TRONCAL'),
(12, 'LLANTAS ALIMENTADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `eliminado`) VALUES
(1, 'Operadora Macrobus', 0),
(2, 'Ruta 380', 0),
(3, 'Circuito Interior Metropolitano', 0),
(4, 'Coordinado Metropolitano', 0),
(5, 'Complementaria GDL', 0),
(6, 'Alianza Camionera Tlaquepaque', 0),
(7, 'Milher Autobuses', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mecanicos`
--

CREATE TABLE `mecanicos` (
  `id` int(11) NOT NULL,
  `id_mecanico` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mecanicos`
--

INSERT INTO `mecanicos` (`id`, `id_mecanico`, `nombre`, `eliminado`) VALUES
(1, 100998, 'Julio Diaz', 0),
(2, 200912, 'Israel Arevalos', 0),
(3, 100060, 'Jaime Perez', 0),
(4, 101032, 'Javier Eugenio', 0),
(5, 102225, 'Antonio Arevalos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id` int(11) NOT NULL,
  `id_autobus` int(11) NOT NULL,
  `id_razon` int(11) NOT NULL,
  `id_supervisor` int(11) NOT NULL,
  `fecha_apertura` datetime NOT NULL,
  `fecha_liberacion` datetime DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`id`, `id_autobus`, `id_razon`, `id_supervisor`, `fecha_apertura`, `fecha_liberacion`, `fecha_cierre`, `estado`) VALUES
(1, 145, 3, 1, '2026-07-18 06:34:00', NULL, NULL, 1),
(2, 113, 3, 1, '2026-07-15 19:24:00', '2026-07-16 00:28:00', '2026-07-16 01:18:00', 3),
(3, 242, 1, 1, '2026-07-14 13:55:00', '2026-07-14 18:14:00', NULL, 2),
(4, 292, 6, 1, '2026-07-18 07:56:00', '2026-07-18 09:08:00', '2026-07-18 11:08:00', 3),
(5, 295, 4, 1, '2026-07-18 15:24:00', NULL, NULL, 1),
(6, 94, 11, 1, '2026-07-19 20:27:00', '2026-07-20 01:57:00', NULL, 2),
(7, 220, 9, 1, '2026-07-18 18:36:00', '2026-07-19 03:06:00', '2026-07-19 07:26:00', 3),
(8, 206, 3, 1, '2026-07-13 14:48:00', NULL, NULL, 1),
(9, 258, 1, 1, '2026-07-20 10:23:00', '2026-07-21 04:50:00', '2026-07-21 09:27:00', 3),
(10, 90, 5, 1, '2026-07-14 10:55:00', NULL, '2026-07-14 15:29:00', 4),
(11, 172, 8, 1, '2026-07-13 08:05:00', NULL, NULL, 1),
(12, 193, 10, 1, '2026-07-16 14:44:00', '2026-07-17 00:28:00', '2026-07-17 03:57:00', 3),
(13, 285, 8, 1, '2026-07-17 07:58:00', '2026-07-17 14:22:00', '2026-07-17 17:50:00', 3),
(14, 9, 10, 1, '2026-07-19 18:43:00', '2026-07-20 01:47:00', '2026-07-20 04:44:00', 3),
(15, 171, 10, 1, '2026-07-20 15:13:00', NULL, NULL, 1),
(16, 265, 10, 1, '2026-07-14 08:41:00', '2026-07-14 10:38:00', '2026-07-14 13:53:00', 3),
(17, 265, 12, 1, '2026-07-15 19:29:00', '2026-07-16 12:13:00', '2026-07-16 12:57:00', 4),
(18, 272, 8, 1, '2026-07-18 14:22:00', '2026-07-19 08:56:00', '2026-07-19 13:08:00', 4),
(19, 235, 9, 1, '2026-07-19 14:37:00', NULL, NULL, 1),
(20, 284, 4, 1, '2026-07-20 15:39:00', '2026-07-21 06:55:00', NULL, 2),
(21, 4, 8, 1, '2026-07-15 12:58:00', NULL, NULL, 1),
(22, 165, 10, 1, '2026-07-15 18:15:00', NULL, NULL, 1),
(23, 194, 4, 1, '2026-07-19 09:59:00', '2026-07-20 03:46:00', '2026-07-20 08:35:00', 3),
(24, 287, 12, 1, '2026-07-17 17:28:00', '2026-07-18 01:11:00', '2026-07-18 03:14:00', 3),
(25, 159, 10, 1, '2026-07-15 18:56:00', NULL, NULL, 1),
(26, 291, 8, 1, '2026-07-18 19:33:00', NULL, NULL, 1),
(27, 267, 10, 1, '2026-07-19 14:17:00', '2026-07-19 15:33:00', '2026-07-19 18:06:00', 3),
(28, 267, 2, 1, '2026-07-16 08:39:00', '2026-07-16 15:52:00', '2026-07-16 20:20:00', 3),
(29, 267, 4, 1, '2026-07-15 15:51:00', NULL, NULL, 1),
(30, 163, 4, 1, '2026-07-18 06:43:00', '2026-07-18 08:31:00', '2026-07-18 13:03:00', 3),
(31, 77, 4, 1, '2026-07-13 13:37:00', '2026-07-14 09:28:00', '2026-07-14 12:12:00', 3),
(32, 232, 11, 1, '2026-07-15 19:42:00', NULL, NULL, 1),
(33, 190, 2, 1, '2026-07-20 13:26:00', '2026-07-20 20:32:00', '2026-07-20 23:18:00', 3),
(34, 120, 5, 1, '2026-07-20 08:43:00', '2026-07-20 12:18:00', NULL, 2),
(35, 154, 7, 1, '2026-07-15 06:41:00', '2026-07-15 16:44:00', '2026-07-15 18:53:00', 3),
(36, 77, 8, 1, '2026-07-19 16:21:00', '2026-07-19 22:55:00', '2026-07-19 23:51:00', 3),
(37, 97, 7, 1, '2026-07-17 10:19:00', NULL, NULL, 1),
(38, 264, 6, 1, '2026-07-20 18:22:00', NULL, NULL, 1),
(39, 273, 12, 1, '2026-07-20 18:24:00', NULL, NULL, 1),
(40, 210, 7, 1, '2026-07-20 13:04:00', '2026-07-20 21:45:00', NULL, 2),
(41, 91, 9, 1, '2026-07-15 08:16:00', NULL, NULL, 1),
(42, 184, 8, 1, '2026-07-19 09:03:00', '2026-07-19 14:35:00', NULL, 2),
(43, 245, 5, 1, '2026-07-17 10:45:00', NULL, NULL, 1),
(44, 28, 6, 1, '2026-07-13 17:12:00', '2026-07-13 22:26:00', '2026-07-13 23:16:00', 4),
(45, 101, 7, 1, '2026-07-14 10:04:00', '2026-07-14 15:49:00', '2026-07-14 18:26:00', 3),
(46, 285, 4, 1, '2026-07-15 10:24:00', '2026-07-15 21:43:00', '2026-07-15 23:17:00', 3),
(47, 27, 2, 1, '2026-07-19 17:30:00', '2026-07-19 23:56:00', '2026-07-20 00:48:00', 3),
(48, 17, 12, 1, '2026-07-17 19:05:00', '2026-07-18 11:12:00', NULL, 2),
(49, 33, 6, 1, '2026-07-14 18:23:00', NULL, NULL, 1),
(50, 286, 10, 1, '2026-07-14 18:15:00', NULL, NULL, 1),
(51, 2, 6, 1, '2026-07-15 11:33:00', NULL, NULL, 1),
(52, 169, 12, 1, '2026-07-18 07:54:00', '2026-07-18 13:58:00', NULL, 2),
(53, 125, 3, 1, '2026-07-20 15:35:00', NULL, NULL, 1),
(54, 270, 12, 1, '2026-07-15 13:44:00', NULL, NULL, 1),
(55, 61, 10, 1, '2026-07-19 08:26:00', NULL, '2026-07-19 13:14:00', 4),
(56, 267, 2, 1, '2026-07-16 13:25:00', '2026-07-17 04:50:00', NULL, 2),
(57, 128, 3, 1, '2026-07-17 10:44:00', '2026-07-18 03:08:00', '2026-07-18 03:43:00', 3),
(58, 60, 10, 1, '2026-07-15 11:36:00', NULL, NULL, 1),
(59, 269, 10, 1, '2026-07-16 18:23:00', '2026-07-17 02:38:00', '2026-07-17 03:13:00', 4),
(60, 187, 12, 1, '2026-07-13 14:56:00', '2026-07-14 01:42:00', NULL, 2),
(61, 292, 6, 1, '2026-07-15 18:18:00', '2026-07-16 08:44:00', '2026-07-16 09:17:00', 3),
(62, 289, 10, 1, '2026-07-13 06:27:00', '2026-07-13 14:49:00', NULL, 2),
(63, 163, 2, 1, '2026-07-18 14:52:00', NULL, NULL, 1),
(64, 268, 12, 1, '2026-07-15 13:49:00', NULL, NULL, 1),
(65, 273, 4, 1, '2026-07-16 14:16:00', '2026-07-17 03:27:00', '2026-07-17 08:19:00', 3),
(66, 81, 7, 1, '2026-07-17 16:36:00', '2026-07-17 21:49:00', '2026-07-18 00:40:00', 3),
(67, 269, 12, 1, '2026-07-15 09:29:00', '2026-07-15 13:29:00', '2026-07-15 14:41:00', 4),
(68, 193, 2, 1, '2026-07-20 15:46:00', NULL, NULL, 1),
(69, 285, 2, 1, '2026-07-17 14:20:00', '2026-07-17 22:46:00', '2026-07-18 02:22:00', 3),
(70, 291, 12, 1, '2026-07-20 14:01:00', NULL, NULL, 1),
(71, 58, 10, 1, '2026-07-19 09:11:00', '2026-07-19 15:56:00', NULL, 2),
(72, 146, 7, 1, '2026-07-16 17:02:00', '2026-07-16 18:09:00', NULL, 2),
(73, 135, 9, 1, '2026-07-17 07:00:00', NULL, NULL, 1),
(74, 185, 6, 1, '2026-07-19 12:59:00', NULL, NULL, 1),
(75, 286, 10, 1, '2026-07-13 20:24:00', '2026-07-13 22:21:00', NULL, 2),
(76, 124, 9, 1, '2026-07-17 08:24:00', '2026-07-17 16:48:00', NULL, 2),
(77, 50, 12, 1, '2026-07-16 14:32:00', NULL, '2026-07-16 19:23:00', 4),
(78, 271, 4, 1, '2026-07-18 12:30:00', '2026-07-19 03:48:00', NULL, 2),
(79, 184, 2, 1, '2026-07-17 09:29:00', '2026-07-17 17:28:00', '2026-07-17 22:07:00', 3),
(80, 62, 6, 1, '2026-07-15 13:30:00', '2026-07-16 03:07:00', '2026-07-16 05:07:00', 3),
(81, 233, 9, 1, '2026-07-17 11:20:00', '2026-07-17 16:24:00', NULL, 2),
(82, 292, 10, 1, '2026-07-17 06:06:00', '2026-07-17 06:55:00', '2026-07-17 08:28:00', 3),
(83, 76, 2, 1, '2026-07-13 19:13:00', '2026-07-14 09:57:00', '2026-07-14 11:25:00', 3),
(84, 286, 2, 1, '2026-07-16 17:19:00', '2026-07-17 11:03:00', NULL, 2),
(85, 285, 12, 1, '2026-07-20 18:53:00', '2026-07-21 13:57:00', NULL, 2),
(86, 201, 7, 1, '2026-07-16 14:32:00', '2026-07-17 08:02:00', NULL, 2),
(87, 272, 10, 1, '2026-07-19 07:05:00', NULL, NULL, 1),
(88, 26, 10, 1, '2026-07-18 11:45:00', NULL, NULL, 1),
(89, 31, 12, 1, '2026-07-19 20:31:00', '2026-07-20 13:02:00', '2026-07-20 16:20:00', 3),
(90, 291, 6, 1, '2026-07-17 13:26:00', '2026-07-18 07:39:00', '2026-07-18 11:44:00', 3),
(91, 145, 3, 1, '2026-07-13 17:34:00', '2026-07-13 23:45:00', '2026-07-14 00:39:00', 3),
(92, 274, 2, 1, '2026-07-15 12:26:00', '2026-07-16 02:38:00', '2026-07-16 03:06:00', 3),
(93, 42, 6, 1, '2026-07-13 20:57:00', '2026-07-14 02:24:00', NULL, 2),
(94, 291, 8, 1, '2026-07-15 06:40:00', NULL, NULL, 1),
(95, 211, 1, 1, '2026-07-18 09:02:00', '2026-07-18 13:10:00', NULL, 2),
(96, 272, 10, 1, '2026-07-13 17:39:00', NULL, '2026-07-13 18:42:00', 4),
(97, 229, 9, 1, '2026-07-15 14:21:00', '2026-07-16 00:31:00', NULL, 2),
(98, 133, 7, 1, '2026-07-15 07:20:00', '2026-07-15 10:33:00', '2026-07-15 12:35:00', 3),
(99, 225, 9, 1, '2026-07-19 15:20:00', '2026-07-20 05:38:00', NULL, 2),
(100, 170, 10, 1, '2026-07-20 08:46:00', '2026-07-20 12:49:00', NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparacion`
--

CREATE TABLE `reparacion` (
  `id` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `id_mecanico` int(11) DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reparacion`
--

INSERT INTO `reparacion` (`id`, `id_orden`, `id_mecanico`, `descripcion`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(1, 1, NULL, 'Servicio preventivo', NULL, NULL, 0),
(2, 1, NULL, 'Cambio de aceite', NULL, NULL, 0),
(3, 1, NULL, 'Revisión niveles', NULL, NULL, 0),
(4, 1, NULL, 'Engrase general', NULL, NULL, 0),
(5, 1, 5, 'Antonio Arevalos', NULL, NULL, 0),
(6, 2, NULL, 'Revisión niveles', NULL, NULL, 0),
(7, 2, NULL, 'Cambio de aceite', NULL, NULL, 0),
(8, 2, 4, 'Javier Eugenio', '2026-07-15 20:51:00', '2026-07-15 21:43:00', 3),
(9, 3, NULL, 'Cambio compresor', NULL, NULL, 0),
(10, 3, NULL, 'Ajuste de frenos', NULL, NULL, 0),
(11, 3, NULL, 'Revisión sistema eléctrico', NULL, NULL, 0),
(12, 3, 5, 'Antonio Arevalos', '2026-07-14 14:40:00', NULL, 1),
(13, 4, NULL, 'Reparar faldón', NULL, NULL, 0),
(14, 4, NULL, 'Cambio espejo', NULL, NULL, 0),
(15, 4, NULL, 'Puerta dañada', NULL, NULL, 0),
(16, 4, NULL, 'Reparar defensa lateral', NULL, NULL, 0),
(17, 4, 5, 'Antonio Arevalos', '2026-07-18 11:38:00', '2026-07-18 13:56:00', 3),
(18, 5, NULL, 'Cambio filtros', NULL, NULL, 0),
(19, 5, NULL, 'Lubricación', NULL, NULL, 0),
(20, 5, NULL, 'Cambio aceite motor', NULL, NULL, 0),
(21, 5, 4, 'Javier Eugenio', '2026-07-18 18:03:00', NULL, 2),
(22, 6, NULL, 'Cambio de llanta', NULL, NULL, 0),
(23, 6, NULL, 'Balanceo', NULL, NULL, 0),
(24, 6, NULL, 'Cambio rin', NULL, NULL, 0),
(25, 6, 1, 'Julio Diaz', '2026-07-19 23:40:00', NULL, 1),
(26, 7, NULL, 'Reparar defensa', NULL, NULL, 0),
(27, 7, NULL, 'Cambio piezas carrocería', NULL, NULL, 0),
(28, 7, 1, 'Julio Diaz', '2026-07-18 20:27:00', '2026-07-18 23:04:00', 3),
(29, 8, NULL, 'Servicio preventivo', NULL, NULL, 0),
(30, 8, NULL, 'Cambio de aceite', NULL, NULL, 0),
(31, 8, NULL, 'Cambio de filtros', NULL, NULL, 0),
(32, 8, 3, 'Jaime Perez', '2026-07-13 16:56:00', NULL, 1),
(33, 9, NULL, 'Cambio de suspensión', NULL, NULL, 0),
(34, 9, NULL, 'Cambio bomba hidráulica', NULL, NULL, 0),
(35, 9, 4, 'Javier Eugenio', '2026-07-20 11:47:00', '2026-07-20 15:28:00', 3),
(36, 10, NULL, 'Revisión golpe frontal', NULL, NULL, 0),
(37, 10, NULL, 'Reparar carrocería', NULL, NULL, 0),
(38, 10, 4, 'Javier Eugenio', '2026-07-14 13:32:00', '2026-07-14 18:28:00', 3),
(39, 11, NULL, 'Arrastre unidad', NULL, NULL, 0),
(40, 11, NULL, 'Cambio batería', NULL, NULL, 0),
(41, 11, 1, 'Julio Diaz', '2026-07-13 09:31:00', NULL, 1),
(42, 12, NULL, 'Reparación carrocería', NULL, NULL, 0),
(43, 12, NULL, 'Cambio espejo', NULL, NULL, 0),
(44, 12, 4, 'Javier Eugenio', '2026-07-16 17:29:00', '2026-07-16 19:20:00', 3),
(45, 13, NULL, 'Arrastre unidad', NULL, NULL, 0),
(46, 13, NULL, 'Falla eléctrica', NULL, NULL, 0),
(47, 13, 5, 'Antonio Arevalos', '2026-07-17 11:47:00', '2026-07-17 13:37:00', 3),
(48, 14, NULL, 'Puerta servicio', NULL, NULL, 0),
(49, 14, NULL, 'Defensa trasera', NULL, NULL, 0),
(50, 14, 2, 'Israel Arevalos', '2026-07-19 22:03:00', '2026-07-20 00:40:00', 3),
(51, 15, NULL, 'Ajuste puertas', NULL, NULL, 0),
(52, 15, NULL, 'Cambio espejo', NULL, NULL, 0),
(53, 15, NULL, 'Defensa trasera', NULL, NULL, 0),
(54, 15, NULL, 'Reparación carrocería', NULL, NULL, 0),
(55, 15, 5, 'Antonio Arevalos', '2026-07-20 17:25:00', NULL, 1),
(56, 16, NULL, 'Ajuste puertas', NULL, NULL, 0),
(57, 16, NULL, 'Cambio espejo', NULL, NULL, 0),
(58, 16, NULL, 'Reparación carrocería', NULL, NULL, 0),
(59, 16, NULL, 'Puerta servicio', NULL, NULL, 0),
(60, 16, 2, 'Israel Arevalos', NULL, NULL, 0),
(61, 17, NULL, 'Cambio de llanta', NULL, NULL, 0),
(62, 17, NULL, 'Parchar llanta', NULL, NULL, 0),
(63, 17, 2, 'Israel Arevalos', '2026-07-15 22:24:00', '2026-07-16 03:22:00', 3),
(64, 18, NULL, 'Falla eléctrica', NULL, NULL, 0),
(65, 18, NULL, 'Revisión motor', NULL, NULL, 0),
(66, 18, NULL, 'Arrastre unidad', NULL, NULL, 0),
(67, 18, NULL, 'Cambio batería', NULL, NULL, 0),
(68, 18, 2, 'Israel Arevalos', NULL, NULL, 0),
(69, 19, NULL, 'Cambio parabrisas', NULL, NULL, 0),
(70, 19, NULL, 'Reparar defensa', NULL, NULL, 0),
(71, 19, NULL, 'Reparar faldón', NULL, NULL, 0),
(72, 19, 4, 'Javier Eugenio', '2026-07-19 16:26:00', NULL, 2),
(73, 20, NULL, 'Cambio aceite motor', NULL, NULL, 0),
(74, 20, NULL, 'Lubricación', NULL, NULL, 0),
(75, 20, 5, 'Antonio Arevalos', '2026-07-20 17:14:00', NULL, 1),
(76, 21, NULL, 'Cambio batería', NULL, NULL, 0),
(77, 21, NULL, 'Revisión alternador', NULL, NULL, 0),
(78, 21, NULL, 'Falla eléctrica', NULL, NULL, 0),
(79, 21, 5, 'Antonio Arevalos', '2026-07-15 15:34:00', NULL, 1),
(80, 22, NULL, 'Reparación carrocería', NULL, NULL, 0),
(81, 22, NULL, 'Cambio espejo', NULL, NULL, 0),
(82, 22, 3, 'Jaime Perez', '2026-07-15 20:09:00', NULL, 1),
(83, 23, NULL, 'Lubricación', NULL, NULL, 0),
(84, 23, NULL, 'Servicio general', NULL, NULL, 0),
(85, 23, NULL, 'Revisión frenos', NULL, NULL, 0),
(86, 23, NULL, 'Cambio aceite motor', NULL, NULL, 0),
(87, 23, 1, 'Julio Diaz', '2026-07-19 12:18:00', '2026-07-19 13:04:00', 3),
(88, 24, NULL, 'Parchar llanta', NULL, NULL, 0),
(89, 24, NULL, 'Cambio de llanta', NULL, NULL, 0),
(90, 24, 1, 'Julio Diaz', '2026-07-17 19:55:00', '2026-07-18 00:09:00', 3),
(91, 25, NULL, 'Reparación carrocería', NULL, NULL, 0),
(92, 25, NULL, 'Ajuste puertas', NULL, NULL, 0),
(93, 25, 1, 'Julio Diaz', '2026-07-15 20:23:00', NULL, 1),
(94, 26, NULL, 'Cambio batería', NULL, NULL, 0),
(95, 26, NULL, 'Arrastre unidad', NULL, NULL, 0),
(96, 26, NULL, 'Revisión motor', NULL, NULL, 0),
(97, 26, NULL, 'Falla eléctrica', NULL, NULL, 0),
(98, 26, 1, 'Julio Diaz', '2026-07-18 22:25:00', NULL, 1),
(99, 27, NULL, 'Cambio espejo', NULL, NULL, 0),
(100, 27, NULL, 'Reparación carrocería', NULL, NULL, 0),
(101, 27, 3, 'Jaime Perez', '2026-07-19 17:33:00', '2026-07-19 19:45:00', 3),
(102, 28, NULL, 'Cambio de balatas', NULL, NULL, 0),
(103, 28, NULL, 'Revisión suspensión', NULL, NULL, 0),
(104, 28, NULL, 'Fuga de aire', NULL, NULL, 0),
(105, 28, NULL, 'Cambio manguera neumática', NULL, NULL, 0),
(106, 28, 1, 'Julio Diaz', NULL, NULL, 0),
(107, 29, NULL, 'Cambio aceite motor', NULL, NULL, 0),
(108, 29, NULL, 'Cambio filtros', NULL, NULL, 0),
(109, 29, NULL, 'Revisión frenos', NULL, NULL, 0),
(110, 29, 2, 'Israel Arevalos', '2026-07-15 17:31:00', NULL, 1),
(111, 30, NULL, 'Cambio aceite motor', NULL, NULL, 0),
(112, 30, NULL, 'Lubricación', NULL, NULL, 0),
(113, 30, 5, 'Antonio Arevalos', '2026-07-18 10:08:00', '2026-07-18 13:22:00', 3),
(114, 31, NULL, 'Servicio general', NULL, NULL, 0),
(115, 31, NULL, 'Lubricación', NULL, NULL, 0),
(116, 31, 5, 'Antonio Arevalos', '2026-07-13 17:04:00', '2026-07-13 20:42:00', 3),
(117, 32, NULL, 'Rotación llantas', NULL, NULL, 0),
(118, 32, NULL, 'Cambio de llanta', NULL, NULL, 0),
(119, 32, 5, 'Antonio Arevalos', '2026-07-15 21:10:00', NULL, 1),
(120, 33, NULL, 'Ajuste puertas', NULL, NULL, 0),
(121, 33, NULL, 'Revisión suspensión', NULL, NULL, 0),
(122, 33, NULL, 'Cambio de balatas', NULL, NULL, 0),
(123, 33, NULL, 'Cambio manguera neumática', NULL, NULL, 0),
(124, 33, 2, 'Israel Arevalos', NULL, NULL, 0),
(125, 34, NULL, 'Revisión golpe frontal', NULL, NULL, 0),
(126, 34, NULL, 'Reparar defensa', NULL, NULL, 0),
(127, 34, NULL, 'Cambio piezas dañadas', NULL, NULL, 0),
(128, 34, 4, 'Javier Eugenio', NULL, NULL, 0),
(129, 35, NULL, 'Revisión eléctrica', NULL, NULL, 0),
(130, 35, NULL, 'Cambio batería', NULL, NULL, 0),
(131, 35, NULL, 'Falla motor', NULL, NULL, 0),
(132, 35, NULL, 'Revisión marcha', NULL, NULL, 0),
(133, 35, 3, 'Jaime Perez', '2026-07-15 10:06:00', '2026-07-15 10:53:00', 3),
(134, 36, NULL, 'Cambio batería', NULL, NULL, 0),
(135, 36, NULL, 'Revisión alternador', NULL, NULL, 0),
(136, 36, NULL, 'Falla eléctrica', NULL, NULL, 0),
(137, 36, 4, 'Javier Eugenio', '2026-07-19 19:44:00', '2026-07-19 20:53:00', 3),
(138, 37, NULL, 'Revisión marcha', NULL, NULL, 0),
(139, 37, NULL, 'Revisión eléctrica', NULL, NULL, 0),
(140, 37, NULL, 'Falla motor', NULL, NULL, 0),
(141, 37, NULL, 'Cambio batería', NULL, NULL, 0),
(142, 37, 3, 'Jaime Perez', NULL, NULL, 0),
(143, 38, NULL, 'Reparar defensa lateral', NULL, NULL, 0),
(144, 38, NULL, 'Revisión accidente', NULL, NULL, 0),
(145, 38, 4, 'Javier Eugenio', '2026-07-20 20:14:00', NULL, 2),
(146, 39, NULL, 'Parchar llanta', NULL, NULL, 0),
(147, 39, NULL, 'Revisión neumático', NULL, NULL, 0),
(148, 39, NULL, 'Balanceo', NULL, NULL, 0),
(149, 39, NULL, 'Cambio de llanta', NULL, NULL, 0),
(150, 39, 5, 'Antonio Arevalos', NULL, NULL, 0),
(151, 40, NULL, 'Cambio batería', NULL, NULL, 0),
(152, 40, NULL, 'Falla motor', NULL, NULL, 0),
(153, 40, 2, 'Israel Arevalos', '2026-07-20 14:44:00', NULL, 1),
(154, 41, NULL, 'Reparar puerta', NULL, NULL, 0),
(155, 41, NULL, 'Reparar defensa', NULL, NULL, 0),
(156, 41, 3, 'Jaime Perez', '2026-07-15 09:54:00', NULL, 1),
(157, 42, NULL, 'Arrastre unidad', NULL, NULL, 0),
(158, 42, NULL, 'Revisión alternador', NULL, NULL, 0),
(159, 42, NULL, 'Cambio batería', NULL, NULL, 0),
(160, 42, NULL, 'Revisión motor', NULL, NULL, 0),
(161, 42, 4, 'Javier Eugenio', '2026-07-19 12:32:00', NULL, 2),
(162, 43, NULL, 'Cambio parabrisas', NULL, NULL, 0),
(163, 43, NULL, 'Cambio piezas dañadas', NULL, NULL, 0),
(164, 43, 5, 'Antonio Arevalos', '2026-07-17 13:53:00', NULL, 1),
(165, 44, NULL, 'Puerta dañada', NULL, NULL, 0),
(166, 44, NULL, 'Reparar faldón', NULL, NULL, 0),
(167, 44, 3, 'Jaime Perez', NULL, NULL, 0),
(168, 45, NULL, 'Falla motor', NULL, NULL, 0),
(169, 45, NULL, 'Revisión marcha', NULL, NULL, 0),
(170, 45, NULL, 'Cambio batería', NULL, NULL, 0),
(171, 45, 4, 'Javier Eugenio', '2026-07-14 13:33:00', '2026-07-14 15:09:00', 3),
(172, 46, NULL, 'Servicio general', NULL, NULL, 0),
(173, 46, NULL, 'Cambio filtros', NULL, NULL, 0),
(174, 46, NULL, 'Cambio aceite motor', NULL, NULL, 0),
(175, 46, 1, 'Julio Diaz', '2026-07-15 13:04:00', '2026-07-15 15:07:00', 3),
(176, 47, NULL, 'Revisión suspensión', NULL, NULL, 0),
(177, 47, NULL, 'Cambio manguera neumática', NULL, NULL, 0),
(178, 47, NULL, 'Cambio de balatas', NULL, NULL, 0),
(179, 47, NULL, 'Ajuste puertas', NULL, NULL, 0),
(180, 47, 2, 'Israel Arevalos', '2026-07-19 20:08:00', '2026-07-19 21:29:00', 3),
(181, 48, NULL, 'Cambio de llanta', NULL, NULL, 0),
(182, 48, NULL, 'Parchar llanta', NULL, NULL, 0),
(183, 48, NULL, 'Cambio válvula', NULL, NULL, 0),
(184, 48, NULL, 'Revisión neumático', NULL, NULL, 0),
(185, 48, 5, 'Antonio Arevalos', '2026-07-17 21:02:00', NULL, 1),
(186, 49, NULL, 'Cambio espejo', NULL, NULL, 0),
(187, 49, NULL, 'Puerta dañada', NULL, NULL, 0),
(188, 49, NULL, 'Revisión accidente', NULL, NULL, 0),
(189, 49, NULL, 'Reparar faldón', NULL, NULL, 0),
(190, 49, 4, 'Javier Eugenio', '2026-07-22 12:52:06', NULL, 2),
(191, 50, NULL, 'Ajuste puertas', NULL, NULL, 0),
(192, 50, NULL, 'Cambio espejo', NULL, NULL, 0),
(193, 50, NULL, 'Puerta servicio', NULL, NULL, 0),
(194, 50, NULL, 'Defensa trasera', NULL, NULL, 0),
(195, 50, 1, 'Julio Diaz', NULL, NULL, 0),
(196, 51, NULL, 'Reparar defensa lateral', NULL, NULL, 0),
(197, 51, NULL, 'Reparar faldón', NULL, NULL, 0),
(198, 51, 2, 'Israel Arevalos', '2026-07-15 14:33:00', NULL, 1),
(199, 52, NULL, 'Balanceo', NULL, NULL, 0),
(200, 52, NULL, 'Cambio de llanta', NULL, NULL, 0),
(201, 52, 3, 'Jaime Perez', '2026-07-18 10:27:00', NULL, 1),
(202, 53, NULL, 'Servicio preventivo', NULL, NULL, 0),
(203, 53, NULL, 'Cambio de filtros', NULL, NULL, 0),
(204, 53, NULL, 'Revisión niveles', NULL, NULL, 0),
(205, 53, NULL, 'Engrase general', NULL, NULL, 0),
(206, 53, 1, 'Julio Diaz', '2026-07-20 19:34:00', NULL, 1),
(207, 54, NULL, 'Cambio válvula', NULL, NULL, 0),
(208, 54, NULL, 'Revisión neumático', NULL, NULL, 0),
(209, 54, 4, 'Javier Eugenio', NULL, NULL, 0),
(210, 55, NULL, 'Reparación carrocería', NULL, NULL, 0),
(211, 55, NULL, 'Cambio espejo', NULL, NULL, 0),
(212, 55, NULL, 'Defensa trasera', NULL, NULL, 0),
(213, 55, 1, 'Julio Diaz', '2026-07-19 12:26:00', '2026-07-19 13:22:00', 3),
(214, 56, NULL, 'Cambio manguera neumática', NULL, NULL, 0),
(215, 56, NULL, 'Revisión suspensión', NULL, NULL, 0),
(216, 56, NULL, 'Ajuste puertas', NULL, NULL, 0),
(217, 56, 2, 'Israel Arevalos', NULL, NULL, 0),
(218, 57, NULL, 'Cambio de filtros', NULL, NULL, 0),
(219, 57, NULL, 'Servicio preventivo', NULL, NULL, 0),
(220, 57, NULL, 'Engrase general', NULL, NULL, 0),
(221, 57, 4, 'Javier Eugenio', '2026-07-17 11:56:00', '2026-07-17 16:56:00', 3),
(222, 58, NULL, 'Ajuste puertas', NULL, NULL, 0),
(223, 58, NULL, 'Cambio espejo', NULL, NULL, 0),
(224, 58, 5, 'Antonio Arevalos', NULL, NULL, 0),
(225, 59, NULL, 'Ajuste puertas', NULL, NULL, 0),
(226, 59, NULL, 'Cambio espejo', NULL, NULL, 0),
(227, 59, NULL, 'Reparación carrocería', NULL, NULL, 0),
(228, 59, 1, 'Julio Diaz', '2026-07-16 20:55:00', '2026-07-16 23:37:00', 3),
(229, 60, NULL, 'Balanceo', NULL, NULL, 0),
(230, 60, NULL, 'Cambio de llanta', NULL, NULL, 0),
(231, 60, NULL, 'Parchar llanta', NULL, NULL, 0),
(232, 60, NULL, 'Cambio válvula', NULL, NULL, 0),
(233, 60, 1, 'Julio Diaz', '2026-07-13 15:31:00', NULL, 1),
(234, 61, NULL, 'Reparar faldón', NULL, NULL, 0),
(235, 61, NULL, 'Reparar defensa lateral', NULL, NULL, 0),
(236, 61, NULL, 'Cambio espejo', NULL, NULL, 0),
(237, 61, 1, 'Julio Diaz', '2026-07-15 20:29:00', '2026-07-15 22:14:00', 3),
(238, 62, NULL, 'Cambio espejo', NULL, NULL, 0),
(239, 62, NULL, 'Puerta servicio', NULL, NULL, 0),
(240, 62, NULL, 'Ajuste puertas', NULL, NULL, 0),
(241, 62, 2, 'Israel Arevalos', '2026-07-13 09:25:00', NULL, 1),
(242, 63, NULL, 'Cambio manguera neumática', NULL, NULL, 0),
(243, 63, NULL, 'Fuga de aire', NULL, NULL, 0),
(244, 63, NULL, 'Ajuste puertas', NULL, NULL, 0),
(245, 63, 5, 'Antonio Arevalos', NULL, NULL, 0),
(246, 64, NULL, 'Cambio de llanta', NULL, NULL, 0),
(247, 64, NULL, 'Balanceo', NULL, NULL, 0),
(248, 64, 2, 'Israel Arevalos', '2026-07-15 17:10:00', NULL, 1),
(249, 65, NULL, 'Cambio aceite motor', NULL, NULL, 0),
(250, 65, NULL, 'Lubricación', NULL, NULL, 0),
(251, 65, NULL, 'Cambio filtros', NULL, NULL, 0),
(252, 65, NULL, 'Servicio general', NULL, NULL, 0),
(253, 65, 1, 'Julio Diaz', '2026-07-16 17:57:00', '2026-07-16 21:42:00', 3),
(254, 66, NULL, 'Revisión marcha', NULL, NULL, 0),
(255, 66, NULL, 'Falla motor', NULL, NULL, 0),
(256, 66, NULL, 'Revisión eléctrica', NULL, NULL, 0),
(257, 66, 2, 'Israel Arevalos', '2026-07-17 19:32:00', '2026-07-17 23:13:00', 3),
(258, 67, NULL, 'Balanceo', NULL, NULL, 0),
(259, 67, NULL, 'Revisión neumático', NULL, NULL, 0),
(260, 67, NULL, 'Cambio válvula', NULL, NULL, 0),
(261, 67, NULL, 'Parchar llanta', NULL, NULL, 0),
(262, 67, 5, 'Antonio Arevalos', '2026-07-15 11:39:00', '2026-07-15 16:02:00', 3),
(263, 68, NULL, 'Cambio de balatas', NULL, NULL, 0),
(264, 68, NULL, 'Revisión suspensión', NULL, NULL, 0),
(265, 68, NULL, 'Ajuste puertas', NULL, NULL, 0),
(266, 68, 2, 'Israel Arevalos', '2026-07-20 17:02:00', NULL, 1),
(267, 69, NULL, 'Ajuste puertas', NULL, NULL, 0),
(268, 69, NULL, 'Revisión suspensión', NULL, NULL, 0),
(269, 69, NULL, 'Cambio de balatas', NULL, NULL, 0),
(270, 69, NULL, 'Cambio manguera neumática', NULL, NULL, 0),
(271, 69, 4, 'Javier Eugenio', '2026-07-17 15:21:00', '2026-07-17 18:44:00', 3),
(272, 70, NULL, 'Cambio de llanta', NULL, NULL, 0),
(273, 70, NULL, 'Parchar llanta', NULL, NULL, 0),
(274, 70, NULL, 'Revisión neumático', NULL, NULL, 0),
(275, 70, NULL, 'Balanceo', NULL, NULL, 0),
(276, 70, 1, 'Julio Diaz', '2026-07-20 17:33:00', NULL, 1),
(277, 71, NULL, 'Defensa trasera', NULL, NULL, 0),
(278, 71, NULL, 'Puerta servicio', NULL, NULL, 0),
(279, 71, 1, 'Julio Diaz', '2026-07-19 12:43:00', NULL, 1),
(280, 72, NULL, 'Arrastre a taller', NULL, NULL, 0),
(281, 72, NULL, 'Revisión eléctrica', NULL, NULL, 0),
(282, 72, NULL, 'Falla motor', NULL, NULL, 0),
(283, 72, NULL, 'Revisión marcha', NULL, NULL, 0),
(284, 72, 4, 'Javier Eugenio', '2026-07-16 19:19:00', NULL, 2),
(285, 73, NULL, 'Cambio parabrisas', NULL, NULL, 0),
(286, 73, NULL, 'Cambio piezas carrocería', NULL, NULL, 0),
(287, 73, 3, 'Jaime Perez', '2026-07-17 09:37:00', NULL, 1),
(288, 74, NULL, 'Reparar defensa lateral', NULL, NULL, 0),
(289, 74, NULL, 'Reparar faldón', NULL, NULL, 0),
(290, 74, NULL, 'Puerta dañada', NULL, NULL, 0),
(291, 74, NULL, 'Cambio espejo', NULL, NULL, 0),
(292, 74, 2, 'Israel Arevalos', '2026-07-19 15:29:00', NULL, 1),
(293, 75, NULL, 'Defensa trasera', NULL, NULL, 0),
(294, 75, NULL, 'Reparación carrocería', NULL, NULL, 0),
(295, 75, NULL, 'Cambio espejo', NULL, NULL, 0),
(296, 75, 5, 'Antonio Arevalos', '2026-07-13 23:40:00', NULL, 1),
(297, 76, NULL, 'Reparar defensa', NULL, NULL, 0),
(298, 76, NULL, 'Reparar puerta', NULL, NULL, 0),
(299, 76, 4, 'Javier Eugenio', '2026-07-17 11:10:00', NULL, 2),
(300, 77, NULL, 'Revisión neumático', NULL, NULL, 0),
(301, 77, NULL, 'Cambio de llanta', NULL, NULL, 0),
(302, 77, 4, 'Javier Eugenio', '2026-07-16 14:55:00', '2026-07-16 17:37:00', 3),
(303, 78, NULL, 'Cambio aceite motor', NULL, NULL, 0),
(304, 78, NULL, 'Revisión frenos', NULL, NULL, 0),
(305, 78, 4, 'Javier Eugenio', '2026-07-18 13:05:00', NULL, 2),
(306, 79, NULL, 'Revisión suspensión', NULL, NULL, 0),
(307, 79, NULL, 'Cambio de balatas', NULL, NULL, 0),
(308, 79, 1, 'Julio Diaz', NULL, NULL, 0),
(309, 80, NULL, 'Reparar faldón', NULL, NULL, 0),
(310, 80, NULL, 'Cambio espejo', NULL, NULL, 0),
(311, 80, NULL, 'Puerta dañada', NULL, NULL, 0),
(312, 80, 3, 'Jaime Perez', '2026-07-15 15:50:00', '2026-07-15 19:09:00', 3),
(313, 81, NULL, 'Cambio parabrisas', NULL, NULL, 0),
(314, 81, NULL, 'Reparar faldón', NULL, NULL, 0),
(315, 81, NULL, 'Cambio piezas carrocería', NULL, NULL, 0),
(316, 81, 2, 'Israel Arevalos', '2026-07-17 13:28:00', NULL, 1),
(317, 82, NULL, 'Defensa trasera', NULL, NULL, 0),
(318, 82, NULL, 'Puerta servicio', NULL, NULL, 0),
(319, 82, 1, 'Julio Diaz', '2026-07-17 06:40:00', '2026-07-17 08:15:00', 3),
(320, 83, NULL, 'Revisión suspensión', NULL, NULL, 0),
(321, 83, NULL, 'Cambio de balatas', NULL, NULL, 0),
(322, 83, NULL, 'Fuga de aire', NULL, NULL, 0),
(323, 83, NULL, 'Ajuste puertas', NULL, NULL, 0),
(324, 83, 1, 'Julio Diaz', NULL, NULL, 0),
(325, 84, NULL, 'Ajuste puertas', NULL, NULL, 0),
(326, 84, NULL, 'Fuga de aire', NULL, NULL, 0),
(327, 84, NULL, 'Cambio de balatas', NULL, NULL, 0),
(328, 84, 2, 'Israel Arevalos', '2026-07-16 20:26:00', NULL, 1),
(329, 85, NULL, 'Revisión neumático', NULL, NULL, 0),
(330, 85, NULL, 'Parchar llanta', NULL, NULL, 0),
(331, 85, NULL, 'Cambio válvula', NULL, NULL, 0),
(332, 85, 4, 'Javier Eugenio', '2026-07-20 20:38:00', NULL, 2),
(333, 86, NULL, 'Revisión eléctrica', NULL, NULL, 0),
(334, 86, NULL, 'Revisión marcha', NULL, NULL, 0),
(335, 86, NULL, 'Falla motor', NULL, NULL, 0),
(336, 86, 1, 'Julio Diaz', NULL, NULL, 0),
(337, 87, NULL, 'Defensa trasera', NULL, NULL, 0),
(338, 87, NULL, 'Ajuste puertas', NULL, NULL, 0),
(339, 87, NULL, 'Reparación carrocería', NULL, NULL, 0),
(340, 87, NULL, 'Cambio espejo', NULL, NULL, 0),
(341, 87, 4, 'Javier Eugenio', '2026-07-19 10:47:00', NULL, 2),
(342, 88, NULL, 'Cambio espejo', NULL, NULL, 0),
(343, 88, NULL, 'Ajuste puertas', NULL, NULL, 0),
(344, 88, 5, 'Antonio Arevalos', '2026-07-18 13:48:00', NULL, 1),
(345, 89, NULL, 'Revisión neumático', NULL, NULL, 0),
(346, 89, NULL, 'Balanceo', NULL, NULL, 0),
(347, 89, NULL, 'Parchar llanta', NULL, NULL, 0),
(348, 89, NULL, 'Cambio de llanta', NULL, NULL, 0),
(349, 89, 1, 'Julio Diaz', '2026-07-20 00:10:00', '2026-07-20 04:30:00', 3),
(350, 90, NULL, 'Reparar defensa lateral', NULL, NULL, 0),
(351, 90, NULL, 'Puerta dañada', NULL, NULL, 0),
(352, 90, 5, 'Antonio Arevalos', '2026-07-17 14:48:00', '2026-07-17 18:45:00', 3),
(353, 91, NULL, 'Engrase general', NULL, NULL, 0),
(354, 91, NULL, 'Revisión niveles', NULL, NULL, 0),
(355, 91, NULL, 'Cambio de aceite', NULL, NULL, 0),
(356, 91, 3, 'Jaime Perez', '2026-07-13 18:46:00', '2026-07-13 22:34:00', 3),
(357, 92, NULL, 'Ajuste puertas', NULL, NULL, 0),
(358, 92, NULL, 'Fuga de aire', NULL, NULL, 0),
(359, 92, 3, 'Jaime Perez', '2026-07-15 16:19:00', '2026-07-15 20:46:00', 3),
(360, 93, NULL, 'Cambio espejo', NULL, NULL, 0),
(361, 93, NULL, 'Reparar defensa lateral', NULL, NULL, 0),
(362, 93, 2, 'Israel Arevalos', '2026-07-14 00:07:00', NULL, 1),
(363, 94, NULL, 'Revisión alternador', NULL, NULL, 0),
(364, 94, NULL, 'Falla eléctrica', NULL, NULL, 0),
(365, 94, 5, 'Antonio Arevalos', '2026-07-15 09:41:00', NULL, 1),
(366, 95, NULL, 'Cambio compresor', NULL, NULL, 0),
(367, 95, NULL, 'Cambio de suspensión', NULL, NULL, 0),
(368, 95, 3, 'Jaime Perez', '2026-07-18 11:51:00', NULL, 1),
(369, 96, NULL, 'Reparación carrocería', NULL, NULL, 0),
(370, 96, NULL, 'Ajuste puertas', NULL, NULL, 0),
(371, 96, NULL, 'Defensa trasera', NULL, NULL, 0),
(372, 96, NULL, 'Puerta servicio', NULL, NULL, 0),
(373, 96, 4, 'Javier Eugenio', NULL, NULL, 0),
(374, 97, NULL, 'Cambio parabrisas', NULL, NULL, 0),
(375, 97, NULL, 'Reparar puerta', NULL, NULL, 0),
(376, 97, 1, 'Julio Diaz', '2026-07-15 16:30:00', NULL, 1),
(377, 98, NULL, 'Revisión eléctrica', NULL, NULL, 0),
(378, 98, NULL, 'Cambio batería', NULL, NULL, 0),
(379, 98, NULL, 'Revisión marcha', NULL, NULL, 0),
(380, 98, 2, 'Israel Arevalos', '2026-07-15 09:05:00', '2026-07-15 10:42:00', 3),
(381, 99, NULL, 'Cambio piezas carrocería', NULL, NULL, 0),
(382, 99, NULL, 'Reparar defensa', NULL, NULL, 0),
(383, 99, 4, 'Javier Eugenio', '2026-07-19 15:40:00', NULL, 2),
(384, 100, NULL, 'Reparación carrocería', NULL, NULL, 0),
(385, 100, NULL, 'Ajuste puertas', NULL, NULL, 0),
(386, 100, 3, 'Jaime Perez', '2026-07-20 11:22:00', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparacion_historial`
--

CREATE TABLE `reparacion_historial` (
  `id` int(11) NOT NULL,
  `id_reparacion` int(11) NOT NULL,
  `id_mecanico` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `motivo_pausa` enum('material','comida','banio','unidad','otro') DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reparacion_historial`
--

INSERT INTO `reparacion_historial` (`id`, `id_reparacion`, `id_mecanico`, `fecha_inicio`, `fecha_fin`, `motivo_pausa`, `estado`) VALUES
(1, 41, 1, '2026-07-13 08:00:00', '2026-07-13 08:42:00', NULL, 1),
(2, 233, 1, '2026-07-13 08:45:00', '2026-07-13 11:08:00', NULL, 1),
(3, 324, 1, '2026-07-13 11:15:00', '2026-07-13 13:33:00', NULL, 1),
(4, 195, 1, '2026-07-14 08:00:00', '2026-07-14 09:06:00', NULL, 1),
(5, 175, 1, '2026-07-15 08:00:00', '2026-07-15 09:21:00', NULL, 1),
(6, 376, 1, '2026-07-15 09:30:00', '2026-07-15 12:18:00', NULL, 1),
(7, 237, 1, '2026-07-15 12:30:00', '2026-07-15 15:26:00', NULL, 1),
(8, 106, 1, '2026-07-16 08:00:00', '2026-07-16 09:51:00', NULL, 1),
(9, 253, 1, '2026-07-16 10:00:00', '2026-07-16 11:28:00', NULL, 1),
(10, 336, 1, '2026-07-16 11:30:00', '2026-07-16 12:07:00', NULL, 1),
(11, 228, 1, '2026-07-16 12:15:00', '2026-07-16 14:42:00', NULL, 1),
(12, 319, 1, '2026-07-17 08:00:00', '2026-07-17 09:41:00', NULL, 1),
(13, 308, 1, '2026-07-17 09:45:00', '2026-07-17 12:13:00', NULL, 1),
(14, 90, 1, '2026-07-17 12:15:00', '2026-07-17 14:05:00', NULL, 1),
(15, 28, 1, '2026-07-18 08:00:00', '2026-07-18 08:45:00', NULL, 1),
(16, 98, 1, '2026-07-18 08:45:00', '2026-07-18 10:08:00', NULL, 1),
(17, 213, 1, '2026-07-19 08:00:00', '2026-07-19 10:19:00', NULL, 1),
(18, 279, 1, '2026-07-19 10:30:00', '2026-07-19 11:19:00', NULL, 1),
(19, 87, 1, '2026-07-19 11:30:00', '2026-07-19 12:29:00', NULL, 1),
(20, 25, 1, '2026-07-19 12:30:00', '2026-07-19 15:09:00', NULL, 1),
(21, 276, 1, '2026-07-20 08:00:00', '2026-07-20 10:45:00', NULL, 1),
(22, 206, 1, '2026-07-20 10:45:00', '2026-07-20 12:20:00', NULL, 1),
(23, 241, 2, '2026-07-13 08:00:00', '2026-07-13 10:23:00', NULL, 1),
(24, 362, 2, '2026-07-13 10:30:00', '2026-07-13 12:33:00', NULL, 1),
(25, 60, 2, '2026-07-14 08:00:00', '2026-07-14 08:35:00', NULL, 1),
(26, 380, 2, '2026-07-15 08:00:00', '2026-07-15 09:25:00', NULL, 1),
(27, 198, 2, '2026-07-15 09:30:00', '2026-07-15 11:30:00', NULL, 1),
(28, 248, 2, '2026-07-15 11:30:00', '2026-07-15 12:31:00', NULL, 1),
(29, 110, 2, '2026-07-15 12:45:00', '2026-07-15 15:07:00', NULL, 1),
(30, 217, 2, '2026-07-16 08:00:00', '2026-07-16 09:26:00', NULL, 1),
(31, 328, 2, '2026-07-16 09:30:00', '2026-07-16 11:28:00', NULL, 1),
(32, 316, 2, '2026-07-17 08:00:00', '2026-07-17 08:36:00', NULL, 1),
(33, 257, 2, '2026-07-17 08:45:00', '2026-07-17 10:40:00', NULL, 1),
(34, 68, 2, '2026-07-18 08:00:00', '2026-07-18 09:49:00', NULL, 1),
(35, 292, 2, '2026-07-19 08:00:00', '2026-07-19 09:49:00', NULL, 1),
(36, 180, 2, '2026-07-19 10:00:00', '2026-07-19 11:45:00', NULL, 1),
(37, 50, 2, '2026-07-19 11:45:00', '2026-07-19 12:29:00', NULL, 1),
(38, 153, 2, '2026-07-20 08:00:00', '2026-07-20 09:54:00', NULL, 1),
(39, 124, 2, '2026-07-20 10:00:00', '2026-07-20 12:49:00', NULL, 1),
(40, 266, 2, '2026-07-20 13:00:00', '2026-07-20 14:58:00', NULL, 1),
(41, 32, 3, '2026-07-13 08:00:00', '2026-07-13 09:21:00', NULL, 1),
(42, 167, 3, '2026-07-13 09:30:00', '2026-07-13 10:49:00', NULL, 1),
(43, 356, 3, '2026-07-13 11:00:00', '2026-07-13 11:55:00', NULL, 1),
(44, 133, 3, '2026-07-15 08:00:00', '2026-07-15 08:30:00', NULL, 1),
(45, 156, 3, '2026-07-15 08:30:00', '2026-07-15 11:07:00', NULL, 1),
(46, 359, 3, '2026-07-15 11:15:00', '2026-07-15 13:16:00', NULL, 1),
(47, 312, 3, '2026-07-15 13:30:00', '2026-07-15 14:22:00', NULL, 1),
(48, 82, 3, '2026-07-15 14:30:00', '2026-07-15 15:31:00', NULL, 1),
(49, 287, 3, '2026-07-17 08:00:00', '2026-07-17 11:00:00', NULL, 1),
(50, 142, 3, '2026-07-17 11:00:00', '2026-07-17 12:22:00', NULL, 1),
(51, 201, 3, '2026-07-18 08:00:00', '2026-07-18 09:01:00', NULL, 1),
(52, 368, 3, '2026-07-18 09:15:00', '2026-07-18 09:52:00', NULL, 1),
(53, 101, 3, '2026-07-19 08:00:00', '2026-07-19 09:52:00', NULL, 1),
(54, 386, 3, '2026-07-20 08:00:00', '2026-07-20 09:29:00', NULL, 1),
(55, 373, 4, '2026-07-13 08:00:00', '2026-07-13 09:28:00', NULL, 1),
(56, 171, 4, '2026-07-14 08:00:00', '2026-07-14 09:41:00', NULL, 1),
(57, 38, 4, '2026-07-14 09:45:00', '2026-07-14 12:02:00', NULL, 1),
(58, 190, 4, '2026-07-14 12:15:00', '2026-07-14 14:42:00', NULL, 1),
(59, 209, 4, '2026-07-15 08:00:00', '2026-07-15 10:00:00', NULL, 1),
(60, 8, 4, '2026-07-15 10:00:00', '2026-07-15 10:36:00', NULL, 1),
(61, 302, 4, '2026-07-16 08:00:00', '2026-07-16 10:24:00', NULL, 1),
(62, 44, 4, '2026-07-16 10:30:00', '2026-07-16 12:41:00', NULL, 1),
(63, 284, 4, '2026-07-16 12:45:00', '2026-07-16 15:19:00', NULL, 1),
(64, 299, 4, '2026-07-17 08:00:00', '2026-07-17 10:55:00', NULL, 1),
(65, 221, 4, '2026-07-17 11:00:00', '2026-07-17 13:19:00', NULL, 1),
(66, 271, 4, '2026-07-17 13:30:00', '2026-07-17 15:54:00', NULL, 1),
(67, 305, 4, '2026-07-18 08:00:00', '2026-07-18 10:46:00', NULL, 1),
(68, 21, 4, '2026-07-18 11:00:00', '2026-07-18 12:27:00', NULL, 1),
(69, 341, 4, '2026-07-19 08:00:00', '2026-07-19 10:11:00', NULL, 1),
(70, 161, 4, '2026-07-19 10:15:00', '2026-07-19 12:07:00', NULL, 1),
(71, 72, 4, '2026-07-19 12:15:00', '2026-07-19 14:26:00', NULL, 1),
(72, 383, 4, '2026-07-19 14:30:00', '2026-07-19 15:03:00', NULL, 1),
(73, 128, 4, '2026-07-20 08:00:00', '2026-07-20 09:27:00', NULL, 1),
(74, 35, 4, '2026-07-20 09:30:00', '2026-07-20 11:37:00', NULL, 1),
(75, 145, 4, '2026-07-20 11:45:00', '2026-07-20 12:19:00', NULL, 1),
(76, 332, 4, '2026-07-20 12:30:00', '2026-07-20 13:02:00', NULL, 1),
(77, 116, 5, '2026-07-13 08:00:00', '2026-07-13 10:10:00', NULL, 1),
(78, 296, 5, '2026-07-13 10:15:00', '2026-07-13 12:45:00', NULL, 1),
(79, 12, 5, '2026-07-14 08:00:00', '2026-07-14 09:41:00', NULL, 1),
(80, 365, 5, '2026-07-15 08:00:00', '2026-07-15 09:07:00', NULL, 1),
(81, 262, 5, '2026-07-15 09:15:00', '2026-07-15 12:09:00', NULL, 1),
(82, 224, 5, '2026-07-15 12:15:00', '2026-07-15 14:17:00', NULL, 1),
(83, 47, 5, '2026-07-17 08:00:00', '2026-07-17 09:23:00', NULL, 1),
(84, 164, 5, '2026-07-17 09:30:00', '2026-07-17 10:56:00', NULL, 1),
(85, 352, 5, '2026-07-17 11:00:00', '2026-07-17 11:57:00', NULL, 1),
(86, 185, 5, '2026-07-17 12:00:00', '2026-07-17 14:16:00', NULL, 1),
(87, 5, 5, '2026-07-18 08:00:00', '2026-07-18 09:55:00', NULL, 1),
(88, 113, 5, '2026-07-18 10:00:00', '2026-07-18 12:23:00', NULL, 1),
(89, 17, 5, '2026-07-18 12:30:00', '2026-07-18 14:40:00', NULL, 1),
(90, 344, 5, '2026-07-18 14:45:00', '2026-07-18 15:29:00', NULL, 1),
(91, 55, 5, '2026-07-20 08:00:00', '2026-07-20 09:37:00', NULL, 1),
(92, 75, 5, '2026-07-20 09:45:00', '2026-07-20 12:42:00', NULL, 1),
(93, 150, 5, '2026-07-20 12:45:00', '2026-07-20 14:40:00', NULL, 1),
(94, 284, 4, '2026-07-22 12:50:39', '2026-07-22 12:51:02', 'banio', 2),
(95, 190, 4, '2026-07-22 12:52:06', '2026-07-22 12:52:12', 'comida', 2),
(96, 190, 4, '2026-07-22 13:04:29', '2026-07-22 13:04:35', 'comida', 2),
(97, 161, 4, '2026-07-22 13:04:38', '2026-07-22 13:04:43', 'unidad', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supervisor`
--

CREATE TABLE `supervisor` (
  `id` int(11) NOT NULL,
  `id_supervisor` int(11) NOT NULL,
  `supervisor` varchar(255) NOT NULL,
  `chat_id` varchar(20) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `supervisor`
--

INSERT INTO `supervisor` (`id`, `id_supervisor`, `supervisor`, `chat_id`, `eliminado`) VALUES
(1, 100054, 'Carlos Gómez', '7014982858', 0),
(2, 100073, 'Orlando Contreras', '7014982858', 0),
(3, 100761, 'Jesús Vargas', '7014982858', 0),
(4, 102225, 'Marco Antonio Hernández', '7014982858', 0),
(5, 100611, 'Morfin Gallegos', '7014982858', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supervisor_razon`
--

CREATE TABLE `supervisor_razon` (
  `id` int(11) NOT NULL,
  `id_supervisor` int(11) NOT NULL,
  `id_razon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `supervisor_razon`
--

INSERT INTO `supervisor_razon` (`id`, `id_supervisor`, `id_razon`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 2, 5),
(14, 2, 6),
(15, 2, 9),
(16, 2, 10),
(17, 3, 2),
(18, 3, 4),
(19, 3, 8),
(20, 4, 11),
(21, 4, 12),
(22, 5, 1),
(23, 5, 3),
(24, 5, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autobus`
--
ALTER TABLE `autobus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unidad` (`unidad`),
  ADD KEY `fk_autobus_id_empresa` (`id_empresa`);

--
-- Indices de la tabla `catalogo_razones`
--
ALTER TABLE `catalogo_razones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `mecanicos`
--
ALTER TABLE `mecanicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orden_id_autobus` (`id_autobus`),
  ADD KEY `fk_orden_id_razon` (`id_razon`),
  ADD KEY `fk_orden_id_supervisor` (`id_supervisor`);

--
-- Indices de la tabla `reparacion`
--
ALTER TABLE `reparacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reparacion_id_mecanico` (`id_mecanico`),
  ADD KEY `fk_reparacion_id_orden` (`id_orden`);

--
-- Indices de la tabla `reparacion_historial`
--
ALTER TABLE `reparacion_historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reparacion` (`id_reparacion`),
  ADD KEY `id_mecanico` (`id_mecanico`);

--
-- Indices de la tabla `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `supervisor_razon`
--
ALTER TABLE `supervisor_razon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_supervisor_razon_id_supervisor` (`id_supervisor`),
  ADD KEY `fk_supervisor_razon_id_razon` (`id_razon`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autobus`
--
ALTER TABLE `autobus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- AUTO_INCREMENT de la tabla `catalogo_razones`
--
ALTER TABLE `catalogo_razones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mecanicos`
--
ALTER TABLE `mecanicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `reparacion`
--
ALTER TABLE `reparacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=387;

--
-- AUTO_INCREMENT de la tabla `reparacion_historial`
--
ALTER TABLE `reparacion_historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `supervisor_razon`
--
ALTER TABLE `supervisor_razon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autobus`
--
ALTER TABLE `autobus`
  ADD CONSTRAINT `fk_autobus_id_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `fk_orden_id_autobus` FOREIGN KEY (`id_autobus`) REFERENCES `autobus` (`id`),
  ADD CONSTRAINT `fk_orden_id_razon` FOREIGN KEY (`id_razon`) REFERENCES `catalogo_razones` (`id`),
  ADD CONSTRAINT `fk_orden_id_supervisor` FOREIGN KEY (`id_supervisor`) REFERENCES `supervisor` (`id`);

--
-- Filtros para la tabla `reparacion`
--
ALTER TABLE `reparacion`
  ADD CONSTRAINT `fk_reparacion_id_mecanico` FOREIGN KEY (`id_mecanico`) REFERENCES `mecanicos` (`id`),
  ADD CONSTRAINT `fk_reparacion_id_orden` FOREIGN KEY (`id_orden`) REFERENCES `orden` (`id`);

--
-- Filtros para la tabla `reparacion_historial`
--
ALTER TABLE `reparacion_historial`
  ADD CONSTRAINT `reparacion_historial_ibfk_1` FOREIGN KEY (`id_reparacion`) REFERENCES `reparacion` (`id`),
  ADD CONSTRAINT `reparacion_historial_ibfk_2` FOREIGN KEY (`id_mecanico`) REFERENCES `mecanicos` (`id`);

--
-- Filtros para la tabla `supervisor_razon`
--
ALTER TABLE `supervisor_razon`
  ADD CONSTRAINT `fk_supervisor_razon_id_razon` FOREIGN KEY (`id_razon`) REFERENCES `catalogo_razones` (`id`),
  ADD CONSTRAINT `fk_supervisor_razon_id_supervisor` FOREIGN KEY (`id_supervisor`) REFERENCES `supervisor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
