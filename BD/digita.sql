-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-11-2021 a las 11:14:03
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `digita`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta`
--

DROP TABLE IF EXISTS `acta`;
CREATE TABLE IF NOT EXISTS `acta` (
  `ID_ACTA` int NOT NULL AUTO_INCREMENT,
  `TOTAL_VOTOS` int NOT NULL,
  PRIMARY KEY (`ID_ACTA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta_img_voto`
--

DROP TABLE IF EXISTS `acta_img_voto`;
CREATE TABLE IF NOT EXISTS `acta_img_voto` (
  `ID_ACTA_IMG_VOTO` int NOT NULL AUTO_INCREMENT,
  `ACTA_ID` int NOT NULL,
  `IMG_VOTO_ID` int NOT NULL,
  PRIMARY KEY (`ID_ACTA_IMG_VOTO`),
  KEY `FK_ACTA_IMG_VOTO_REF_IMG_VOTO` (`IMG_VOTO_ID`),
  KEY `FK_ACTA_IMG_VOTO_REF_ACTA` (`ACTA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE IF NOT EXISTS `configuracion` (
  `ID_CONFIGURACION` int NOT NULL AUTO_INCREMENT,
  `TOTAL_ACTAS` int NOT NULL,
  `NUMERO_CANDIDATOS` int NOT NULL,
  `TOTAL_POSIBLES_ACTAS` int NOT NULL,
  `ESTADO_GENERACION` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_CONFIGURACION`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`ID_CONFIGURACION`, `TOTAL_ACTAS`, `NUMERO_CANDIDATOS`, `TOTAL_POSIBLES_ACTAS`, `ESTADO_GENERACION`) VALUES
(1, 20, 10, 50, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_voto`
--

DROP TABLE IF EXISTS `img_voto`;
CREATE TABLE IF NOT EXISTS `img_voto` (
  `ID_IMG_VOTO` int NOT NULL AUTO_INCREMENT,
  `PATH` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_IMG_VOTO`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `img_voto`
--

INSERT INTO `img_voto` (`ID_IMG_VOTO`, `PATH`) VALUES
(1, '0.jpg'),
(2, '1.jpg'),
(3, '2.jpg'),
(4, '3.jpg'),
(5, '4.jpg'),
(6, '5.jpg'),
(7, '6.jpg'),
(8, '7.jpg'),
(9, '8.jpg'),
(10, '9.jpg'),
(11, '10.jpg'),
(12, '11.jpg'),
(13, '12.jpg'),
(14, '13.jpg'),
(15, '14.jpg'),
(16, '15.jpg'),
(17, '16.jpg'),
(18, '17.jpg'),
(19, '18.jpg'),
(20, '19.jpg'),
(21, '20.jpg'),
(22, '21.jpg'),
(23, '22.jpg'),
(24, '23.jpg'),
(25, '24.jpg'),
(26, '25.jpg'),
(27, '26.jpg'),
(28, '27.jpg'),
(29, '28.jpg'),
(30, '29.jpg'),
(31, '30.jpg'),
(32, '31.jpg'),
(33, '32.jpg'),
(34, '33.jpg'),
(35, '34.jpg'),
(36, '35.jpg'),
(37, '36.jpg'),
(38, '37.jpg'),
(39, '38.jpg'),
(40, '39.jpg'),
(41, '40.jpg'),
(42, '41.jpg'),
(43, '42.jpg'),
(44, '43.jpg'),
(45, '44.jpg'),
(46, '45.jpg'),
(47, '46.jpg'),
(48, '47.jpg'),
(49, '48.jpg'),
(50, '49.jpg'),
(51, '50.jpg'),
(52, '51.jpg'),
(53, '52.jpg'),
(54, '53.jpg'),
(55, '54.jpg'),
(56, '55.jpg'),
(57, '56.jpg'),
(58, '57.jpg'),
(59, '58.jpg'),
(60, '59.jpg'),
(61, '60.jpg'),
(62, '61.jpg'),
(63, '62.jpg'),
(64, '63.jpg'),
(65, '64.jpg'),
(66, '65.jpg'),
(67, '66.jpg'),
(68, '67.jpg'),
(69, '68.jpg'),
(70, '69.jpg'),
(71, '70.jpg'),
(72, '71.jpg'),
(73, '72.jpg'),
(74, '73.jpg'),
(75, '74.jpg'),
(76, '75.jpg'),
(77, '76.jpg'),
(78, '77.jpg'),
(79, '78.jpg'),
(80, '79.jpg'),
(81, '80.jpg'),
(82, '81.jpg'),
(83, '82.jpg'),
(84, '83.jpg'),
(85, '84.jpg'),
(86, '85.jpg'),
(87, '86.jpg'),
(88, '87.jpg'),
(89, '88.jpg'),
(90, '89.jpg'),
(91, '90.jpg'),
(92, '91.jpg'),
(93, '92.jpg'),
(94, '93.jpg'),
(95, '94.jpg'),
(96, '95.jpg'),
(97, '96.jpg'),
(98, '97.jpg'),
(99, '98.jpg'),
(100, '99.jpg'),
(101, '100.jpg'),
(102, '101.jpg'),
(103, '102.jpg'),
(104, '103.jpg'),
(105, '104.jpg'),
(106, '105.jpg'),
(107, '106.jpg'),
(108, '107.jpg'),
(109, '108.jpg'),
(110, '109.jpg'),
(111, '110.jpg'),
(112, '111.jpg'),
(113, '112.jpg'),
(114, '113.jpg'),
(115, '114.jpg'),
(116, '115.jpg'),
(117, '116.jpg'),
(118, '117.jpg'),
(119, '118.jpg'),
(120, '119.jpg'),
(121, '120.jpg'),
(122, '121.jpg'),
(123, '122.jpg'),
(124, '123.jpg'),
(125, '124.jpg'),
(126, '125.jpg'),
(127, '126.jpg'),
(128, '127.jpg'),
(129, '128.jpg'),
(130, '129.jpg'),
(131, '130.jpg'),
(132, '131.jpg'),
(133, '132.jpg'),
(134, '133.jpg'),
(135, '134.jpg'),
(136, '135.jpg'),
(137, '136.jpg'),
(138, '137.jpg'),
(139, '138.jpg'),
(140, '139.jpg'),
(141, '140.jpg'),
(142, '141.jpg'),
(143, '142.jpg'),
(144, '143.jpg'),
(145, '144.jpg'),
(146, '145.jpg'),
(147, '146.jpg'),
(148, '147.jpg'),
(149, '148.jpg'),
(150, '149.jpg'),
(151, '150.jpg'),
(152, '151.jpg'),
(153, '152.jpg'),
(154, '153.jpg'),
(155, '154.jpg'),
(156, '155.jpg'),
(157, '156.jpg'),
(158, '157.jpg'),
(159, '158.jpg'),
(160, '159.jpg'),
(161, '160.jpg'),
(162, '161.jpg'),
(163, '162.jpg'),
(164, '163.jpg'),
(165, '164.jpg'),
(166, '165.jpg'),
(167, '166.jpg'),
(168, '167.jpg'),
(169, '168.jpg'),
(170, '169.jpg'),
(171, '170.jpg'),
(172, '171.jpg'),
(173, '172.jpg'),
(174, '173.jpg'),
(175, '174.jpg'),
(176, '175.jpg'),
(177, '176.jpg'),
(178, '177.jpg'),
(179, '178.jpg'),
(180, '179.jpg'),
(181, '180.jpg'),
(182, '181.jpg'),
(183, '182.jpg'),
(184, '183.jpg'),
(185, '184.jpg'),
(186, '185.jpg'),
(187, '186.jpg'),
(188, '187.jpg'),
(189, '188.jpg'),
(190, '189.jpg'),
(191, '190.jpg'),
(192, '191.jpg'),
(193, '192.jpg'),
(194, '193.jpg'),
(195, '194.jpg'),
(196, '195.jpg'),
(197, '196.jpg'),
(198, '197.jpg'),
(199, '198.jpg'),
(200, '199.jpg'),
(201, '200.jpg'),
(202, '201.jpg'),
(203, '202.jpg'),
(204, '203.jpg'),
(205, '204.jpg'),
(206, '205.jpg'),
(207, '206.jpg'),
(208, '207.jpg'),
(209, '208.jpg'),
(210, '209.jpg'),
(211, '210.jpg'),
(212, '211.jpg'),
(213, '212.jpg'),
(214, '213.jpg'),
(215, '214.jpg'),
(216, '215.jpg'),
(217, '216.jpg'),
(218, '217.jpg'),
(219, '218.jpg'),
(220, '219.jpg'),
(221, '220.jpg'),
(222, '221.jpg'),
(223, '222.jpg'),
(224, '223.jpg'),
(225, '224.jpg'),
(226, '225.jpg'),
(227, '226.jpg'),
(228, '227.jpg'),
(229, '228.jpg'),
(230, '229.jpg'),
(231, '230.jpg'),
(232, '231.jpg'),
(233, '232.jpg'),
(234, '233.jpg'),
(235, '234.jpg'),
(236, '235.jpg'),
(237, '236.jpg'),
(238, '237.jpg'),
(239, '238.jpg'),
(240, '239.jpg'),
(241, '240.jpg'),
(242, '241.jpg'),
(243, '242.jpg'),
(244, '243.jpg'),
(245, '244.jpg'),
(246, '245.jpg'),
(247, '246.jpg'),
(248, '247.jpg'),
(249, '248.jpg'),
(250, '249.jpg'),
(251, '250.jpg'),
(252, '251.jpg'),
(253, '252.jpg'),
(254, '253.jpg'),
(255, '254.jpg'),
(256, '255.jpg'),
(257, '256.jpg'),
(258, '257.jpg'),
(259, '258.jpg'),
(260, '259.jpg'),
(261, '260.jpg'),
(262, '261.jpg'),
(263, '262.jpg'),
(264, '263.jpg'),
(265, '264.jpg'),
(266, '265.jpg'),
(267, '266.jpg'),
(268, '267.jpg'),
(269, '268.jpg'),
(270, '269.jpg'),
(271, '270.jpg'),
(272, '271.jpg'),
(273, '272.jpg'),
(274, '273.jpg'),
(275, '274.jpg'),
(276, '275.jpg'),
(277, '276.jpg'),
(278, '277.jpg'),
(279, '278.jpg'),
(280, '279.jpg'),
(281, '280.jpg'),
(282, '281.jpg'),
(283, '282.jpg'),
(284, '283.jpg'),
(285, '284.jpg'),
(286, '285.jpg'),
(287, '286.jpg'),
(288, '287.jpg'),
(289, '288.jpg'),
(290, '289.jpg'),
(291, '290.jpg'),
(292, '291.jpg'),
(293, '292.jpg'),
(294, '293.jpg'),
(295, '294.jpg'),
(296, '295.jpg'),
(297, '296.jpg'),
(298, '297.jpg'),
(299, '298.jpg'),
(300, '299.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

DROP TABLE IF EXISTS `sesion`;
CREATE TABLE IF NOT EXISTS `sesion` (
  `ID_SESION` int NOT NULL AUTO_INCREMENT,
  `HORA_INICIO` time NOT NULL,
  `HORA_FINAL` time NOT NULL,
  `TIEMPO_TOTAL` time NOT NULL,
  `USUARIO_ID` int NOT NULL,
  `FECHA_SESION` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TOTAL_ACTAS` int NOT NULL,
  PRIMARY KEY (`ID_SESION`),
  KEY `FK_SESION_REF_USUARIO` (`USUARIO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_USUARIO` int NOT NULL AUTO_INCREMENT,
  `NOMBRE_PERSONA` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMBRE_USUARIO` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CLAVE` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ROL_USUARIO` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `NOMBRE_PERSONA`, `NOMBRE_USUARIO`, `CLAVE`, `ROL_USUARIO`) VALUES
(1, 'JOSUE ISRAEL CHAVEZ VARGAS', 'ADMIN', 'digita2021', 'ADMINISTRADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_error`
--

DROP TABLE IF EXISTS `usuario_error`;
CREATE TABLE IF NOT EXISTS `usuario_error` (
  `ID_USUARIO_ERROR` int NOT NULL AUTO_INCREMENT,
  `USUARIO_ID` int NOT NULL,
  `SESION_ID` int NOT NULL,
  `ACTA_ID` int NOT NULL,
  `CANTIDAD` int NOT NULL,
  PRIMARY KEY (`ID_USUARIO_ERROR`),
  KEY `FK_USUARIO_ERROR_REF_USUARIO` (`USUARIO_ID`),
  KEY `FK_USUARIO_ERROR_REF_SESION` (`SESION_ID`),
  KEY `FK_USUARIO_ERROR_REF_ACTA` (`ACTA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acta_img_voto`
--
ALTER TABLE `acta_img_voto`
  ADD CONSTRAINT `acta_img_voto_ibfk_1` FOREIGN KEY (`ACTA_ID`) REFERENCES `acta` (`ID_ACTA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acta_img_voto_ibfk_2` FOREIGN KEY (`IMG_VOTO_ID`) REFERENCES `img_voto` (`ID_IMG_VOTO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_error`
--
ALTER TABLE `usuario_error`
  ADD CONSTRAINT `usuario_error_ibfk_1` FOREIGN KEY (`USUARIO_ID`) REFERENCES `usuario` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_error_ibfk_3` FOREIGN KEY (`SESION_ID`) REFERENCES `sesion` (`ID_SESION`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_error_ibfk_4` FOREIGN KEY (`ACTA_ID`) REFERENCES `acta` (`ID_ACTA`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
