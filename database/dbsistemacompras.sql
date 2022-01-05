-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-11-2021 a las 21:23:36
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbsistemacompras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion`
--

DROP TABLE IF EXISTS `accion`;
CREATE TABLE IF NOT EXISTS `accion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `accion`
--

INSERT INTO `accion` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Gestionar producto', 'Esta acción permitirá al usuario gestionar productos'),
(2, 'Gestionar pedido', 'Esta acción permitirá al usuario gestionar sus pedidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_privilegio`
--

DROP TABLE IF EXISTS `accion_privilegio`;
CREATE TABLE IF NOT EXISTS `accion_privilegio` (
  `id` int(11) NOT NULL,
  `idacccion` int(11) NOT NULL,
  `idprivilegio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `accion_privilegio`
--

INSERT INTO `accion_privilegio` (`id`, `idacccion`, `idprivilegio`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
CREATE TABLE IF NOT EXISTS `bitacora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtipobitacora` int(11) DEFAULT NULL,
  `idusuario` bigint(20) UNSIGNED DEFAULT NULL,
  `fechahora` datetime DEFAULT NULL,
  `detalle` text,
  PRIMARY KEY (`id`),
  KEY `idusuario` (`idusuario`),
  KEY `idtipobitacora` (`idtipobitacora`)
) ENGINE=InnoDB AUTO_INCREMENT=480 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `idtipobitacora`, `idusuario`, `fechahora`, `detalle`) VALUES
(128, 1, 78, '2020-08-31 21:36:50', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(129, 3, 78, '2020-08-31 21:44:00', 'El usuario con id: 78 Alejandro Cruz registro la categoria con ID:117 con nombre: Electrónicos'),
(130, 3, 78, '2020-08-31 21:47:30', 'El usuario con id: 78 Alejandro Cruz registró la subcategoria con ID:27 con nombre: Celulares'),
(131, 3, 78, '2020-08-31 21:48:43', 'El usuario con id: 78 Alejandro Cruz registró la subcategoria con ID:28 con nombre: camara'),
(132, 3, 78, '2020-08-31 21:51:30', 'El usuario con id: 78 Alejandro Cruz registro la categoria con ID:118 con nombre: Muebles'),
(133, 3, 78, '2020-08-31 21:53:16', 'El usuario con id: 78 Alejandro Cruz registró la subcategoria con ID:29 con nombre: Camas'),
(134, 3, 78, '2020-08-31 21:54:52', 'El usuario con id: 78 Alejandro Cruz registró la subcategoria con ID:30 con nombre: Mesas'),
(135, 1, 77, '2020-08-31 21:58:39', 'El usuario con id: 77 Super Administrador inicio sesion'),
(136, 3, 77, '2020-08-31 22:01:19', 'El usuario con id: 77 Super Administrador registro al administrador con ID:81 con nombre: Dayler y apellidos: Taboada Frias'),
(137, 3, 77, '2020-08-31 22:02:32', 'El usuario con id: 77 Super Administrador registro al administrador con ID:82 con nombre: Rodrigo y apellidos: Duarte Barrientos'),
(138, 1, 78, '2020-08-31 22:04:46', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(139, 3, 78, '2020-08-31 22:07:42', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:83 con nombre: Roberto y apellidos: Diaz Suarez'),
(140, 3, 78, '2020-08-31 22:12:05', 'El usuario con id: 78 Alejandro Cruz actulizó el estado al usuario con ID:83 con nombre: Roberto y apellidos: Diaz Suarez'),
(144, 1, 78, '2020-08-31 22:15:10', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(145, 1, 81, '2020-08-31 23:06:56', 'El usuario con id: 81 Dayler Taboada Frias inicio sesion'),
(146, 1, 78, '2020-08-31 23:07:31', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(147, 1, 77, '2020-08-31 23:08:17', 'El usuario con id: 77 Super Administrador inicio sesion'),
(148, 3, 77, '2020-08-31 23:13:47', 'El usuario con id: 77 Super Administrador registro al administrador con ID:84 con nombre: khipu dev a y apellidos: Marquez Copaña'),
(149, 2, 77, '2020-08-31 23:14:18', 'El usuario con id: 77 Super Administrador editó al usuario con ID:84 con nombre: khipu dev adddd y apellidos: Marquez Copaña'),
(150, 4, 77, '2020-08-31 23:14:56', 'El usuario con id: 77 Super Administrador eliminó al administrador con ID:84 con nombre: khipu dev adddd y apellidos: Marquez Copaña'),
(151, 3, 77, '2020-08-31 23:15:53', 'El usuario con id: 77 Super Administrador registro al administrador con ID:85 con nombre: khipu dev a y apellidos: Marquez Copaña'),
(152, 1, 81, '2020-09-01 00:15:34', 'El usuario con id: 81 Dayler Taboada Frias inicio sesion'),
(153, 1, 78, '2020-09-01 00:15:49', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(154, 4, 78, '2020-09-01 00:16:04', 'El usuario con id: 78 Alejandro Cruz eliminó al usuario con ID:83 con nombre: Roberto y apellidos: Diaz Suarez'),
(155, 3, 78, '2020-09-01 00:50:38', 'El usuario con id: 78 Alejandro Cruz actualizó el estado del cliente con ID:19 con nombre:  y apellidos: Ledesma'),
(156, 2, 78, '2020-09-01 01:03:10', 'El usuario con id: 78 Alejandro Cruz actualizó el estado del cliente con ID:19 con nombre:  y apellidos: Ledesma'),
(157, 3, 78, '2020-09-01 01:14:42', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:86 con nombre: Marcela y apellidos: Marquez Copaña'),
(158, 3, 78, '2020-09-01 01:15:38', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:87 con nombre: Cesar Michael y apellidos: Marquez Copaña'),
(159, 1, 81, '2020-09-01 08:15:20', 'El usuario con id: 81 Dayler Taboada Frias inicio sesion'),
(160, 3, 81, '2020-09-01 08:21:06', 'El usuario con id: 81 Dayler Taboada Frias registro al usuario con ID:88 con nombre: Marcelo y apellidos: Marquez'),
(161, 2, 81, '2020-09-01 08:21:49', 'El usuario con id: 81 Dayler Taboada Frias editó al usuario con ID:88 con nombre: Marcelo y apellidos: Marquez'),
(162, 1, 88, '2020-09-01 08:22:05', 'El usuario con id: 88 Marcelo Marquez inicio sesion'),
(163, 3, 77, '2020-09-01 08:41:50', 'El cliente con ID:21 con nombre:  y apellidos: Taboada Frias'),
(164, 1, 81, '2020-09-01 08:42:18', 'El usuario con id: 81 Dayler Taboada Frias inicio sesion'),
(165, 1, 81, '2020-09-01 09:31:23', 'El usuario con id: 81 Dayler Taboada Frias inicio sesion'),
(166, 3, 81, '2020-09-01 09:32:07', 'El usuario con id: 81 Dayler Taboada Frias actulizó el estado al usuario con ID:86 con nombre: Marcela y apellidos: Marquez Copaña'),
(167, 3, 81, '2020-09-01 09:32:09', 'El usuario con id: 81 Dayler Taboada Frias actulizó el estado al usuario con ID:86 con nombre: Marcela y apellidos: Marquez Copaña'),
(168, 2, 81, '2020-09-01 09:32:28', 'El usuario con id: 81 Dayler Taboada Frias editó la subcategoria con ID:27 con nombre: Celulares'),
(169, 2, 81, '2020-09-01 09:32:44', 'El usuario con id: 81 Dayler Taboada Frias editó la subcategoria con ID:28 con nombre: camara'),
(170, 2, 81, '2020-09-01 09:32:54', 'El usuario con id: 81 Dayler Taboada Frias editó la subcategoria con ID:29 con nombre: Camas'),
(171, 2, 81, '2020-09-01 09:33:12', 'El usuario con id: 81 Dayler Taboada Frias editó la subcategoria con ID:30 con nombre: Mesas'),
(172, 2, 81, '2020-09-01 09:33:25', 'El usuario con id: 81 Dayler Taboada Frias editó la subcategoria con ID:30 con nombre: Mesas'),
(173, 2, 81, '2020-09-01 09:33:41', 'El usuario con id: 81 Dayler Taboada Frias editó la categoria con ID:117 con nombre: Electrónicos'),
(174, 3, 81, '2020-09-01 09:36:26', 'El usuario con id: 81 Dayler Taboada Frias registro la categoria con ID:119 con nombre: sdsd'),
(175, 2, 81, '2020-09-01 09:36:37', 'El usuario con id: 81 Dayler Taboada Frias editó la categoria con ID:118 con nombre: Muebles'),
(176, 1, 77, '2020-09-01 10:04:17', 'El usuario con id: 77 Super Administrador inicio sesion'),
(177, 2, 77, '2020-09-01 10:04:40', 'El usuario con id: 77 Super Administrador editó al usuario con ID:81 con nombre: Dayler y apellidos: Taboada Frias'),
(178, 2, 77, '2020-09-01 10:06:40', 'El usuario con id: 77 Super Administrador editó al usuario con ID:82 con nombre: Rodrigo y apellidos: Duarte Barrientos'),
(179, 1, 77, '2020-09-01 10:08:15', 'El usuario con id: 77 Super Administrador inicio sesion'),
(180, 3, 77, '2020-09-01 10:09:37', 'El usuario con id: 77 Super Administrador registró al administrador con ID:89 con nombre: Dayler y apellidos: Taboada Frias'),
(181, 2, 77, '2020-09-01 10:09:57', 'El usuario con id: 77 Super Administrador editó al usuario con ID:89 con nombre: dayler y apellidos: Taboada Frias'),
(182, 1, 81, '2020-09-01 10:11:40', 'El usuario con id: 81 Dayler Taboada Frias inicio sesion'),
(183, 3, 81, '2020-09-01 10:14:16', 'El usuario con id: 81 Dayler Taboada Frias registro al usuario con ID:90 con nombre: Dayler y apellidos: Taboada Frias'),
(184, 4, 81, '2020-09-01 10:14:46', 'El usuario con id: 81 Dayler Taboada Frias eliminó al usuario con ID:90 con nombre: Dayler y apellidos: Taboada Frias'),
(185, 2, 81, '2020-09-01 10:14:52', 'El usuario con id: 81 Dayler Taboada Frias editó al usuario con ID:88 con nombre: Marcelod y apellidos: Marquez'),
(186, 3, 81, '2020-09-01 10:18:23', 'El usuario con id: 81 Dayler Taboada Frias registro al usuario con ID:91 con nombre: Marcela y apellidos: Martins'),
(187, 3, 81, '2020-09-01 10:18:44', 'El usuario con id: 81 Dayler Taboada Frias actulizó el estado al usuario con ID:91 con nombre: Marcela y apellidos: Martins'),
(188, 3, 77, '2020-09-15 16:14:08', 'El cliente con ID:22 con nombre:  y apellidos: Taboada Frias se registró'),
(189, 3, 77, '2020-09-15 16:17:47', 'El cliente con ID:23 con nombre:  y apellidos: Taboada Frias se registró'),
(190, 1, 78, '2020-09-17 19:23:19', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(191, 3, 78, '2020-09-17 19:24:32', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:92 con nombre: Dayler y apellidos: Taboada Frias'),
(192, 1, 78, '2020-09-19 21:23:08', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(193, 1, 78, '2020-09-23 17:09:46', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(194, 3, 78, '2020-09-23 18:07:02', 'El usuario con id: 78 Alejandro Cruz registro la empresa con ID: con nombre: fd'),
(195, 3, 78, '2020-09-23 18:07:34', 'El usuario con id: 78 Alejandro Cruz registro la empresa con ID: con nombre: fd'),
(196, 3, 78, '2020-09-23 18:08:54', 'El usuario con id: 78 Alejandro Cruz registro la empresa con ID:5 con nombre: sdsd'),
(197, 1, 78, '2020-09-24 17:19:50', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(198, 3, 78, '2020-09-24 17:37:59', 'El usuario con id: 78 Alejandro Cruz registro la empresa con ID:6 con nombre: dsf'),
(199, 3, 78, '2020-09-24 18:04:39', 'El usuario con id: 78 Alejandro Cruz editó la empresa con ID:1 con nombre: Chiriguano'),
(200, 4, 78, '2020-09-24 18:20:10', 'El usuario con id: 78 Alejandro Cruz eliminó la empresa con ID:6 con nombre: dsf'),
(201, 3, 78, '2020-09-24 18:20:22', 'El usuario con id: 78 Alejandro Cruz editó la empresa con ID:5 con nombre: sdsd'),
(202, 1, 78, '2020-09-25 17:31:48', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(203, 1, 78, '2020-09-25 21:40:04', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(204, 1, 78, '2020-09-26 18:33:01', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(205, 1, 78, '2020-09-27 16:09:14', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(206, 1, 78, '2020-09-27 19:04:55', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(207, 1, 78, '2020-09-28 00:42:00', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(208, 3, 78, '2020-09-28 02:33:54', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:29 con nombre: Representate de empresa'),
(209, 3, 78, '2020-09-28 02:40:05', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:30 con nombre: Representate de empresa'),
(210, 4, 78, '2020-09-28 02:56:08', 'El usuario con id: 78 Alejandro Cruz eliminó la categoria con ID:30 con nombre: Representate de empresa'),
(211, 3, 78, '2020-09-28 02:57:58', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:31 con nombre: Representante de la empresa'),
(212, 1, 78, '2020-09-28 14:08:10', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(218, 3, 78, '2020-09-28 16:38:59', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(220, 3, 78, '2020-09-28 18:26:22', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(222, 3, 78, '2020-09-28 18:31:42', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(223, 3, 78, '2020-09-28 18:42:39', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(224, 3, 78, '2020-09-28 18:43:34', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(225, 3, 78, '2020-09-28 18:43:40', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(226, 3, 78, '2020-09-28 19:57:20', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(227, 3, 78, '2020-09-28 20:09:27', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(228, 3, 78, '2020-09-28 20:12:33', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(229, 3, 78, '2020-09-28 20:17:51', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(230, 3, 78, '2020-09-28 20:20:23', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(231, 3, 78, '2020-09-28 20:21:01', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(232, 3, 78, '2020-09-28 20:21:23', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:32 con nombre: s'),
(233, 4, 78, '2020-09-28 20:25:51', 'El usuario con id: 78 Alejandro Cruz eliminó la categoria con ID:32 con nombre: s'),
(234, 3, 78, '2020-09-28 20:26:40', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(235, 3, 78, '2020-09-28 20:34:01', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(236, 3, 78, '2020-09-28 20:35:00', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(237, 3, 78, '2020-09-28 20:42:29', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(238, 3, 78, '2020-09-28 20:45:37', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(239, 3, 78, '2020-09-28 20:45:51', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(240, 3, 78, '2020-09-28 20:47:50', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(241, 3, 78, '2020-09-28 20:48:42', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(242, 3, 78, '2020-09-28 20:49:05', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(243, 1, 78, '2020-09-30 10:47:47', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(244, 1, 78, '2020-09-30 12:04:30', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(245, 3, 78, '2020-09-30 12:05:40', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:93 con nombre: Dayler y apellidos: Taboada Frias'),
(246, 1, 93, '2020-09-30 12:06:02', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(247, 1, 93, '2020-09-30 12:29:15', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(248, 1, 93, '2020-09-30 14:46:45', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(249, 1, 78, '2020-09-30 14:47:46', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(250, 3, 78, '2020-09-30 14:49:11', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(251, 3, 78, '2020-09-30 14:51:23', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(252, 3, 78, '2020-09-30 14:51:31', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(253, 3, 78, '2020-09-30 14:55:18', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(254, 3, 78, '2020-09-30 14:58:20', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(255, 3, 78, '2020-09-30 15:01:11', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(256, 3, 78, '2020-09-30 15:07:48', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:39 con nombre: sdsd'),
(257, 3, 78, '2020-09-30 15:08:31', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(258, 3, 78, '2020-09-30 15:08:42', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(259, 3, 78, '2020-09-30 15:08:52', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:38 con nombre: sdsd'),
(260, 3, 78, '2020-09-30 15:09:33', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:39 con nombre: sdsd'),
(261, 4, 78, '2020-09-30 15:10:09', 'El usuario con id: 78 Alejandro Cruz eliminó la categoria con ID:39 con nombre: sdsd'),
(262, 3, 78, '2020-09-30 15:10:18', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:40 con nombre: sdsd'),
(263, 3, 78, '2020-09-30 15:10:39', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:40 con nombre: sdsd'),
(264, 3, 78, '2020-09-30 15:10:52', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:40 con nombre: sdsd'),
(265, 3, 78, '2020-09-30 15:12:09', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(266, 3, 78, '2020-09-30 15:12:51', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(267, 3, 78, '2020-09-30 15:12:58', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(268, 3, 78, '2020-09-30 15:14:06', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(269, 3, 78, '2020-09-30 15:14:21', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(270, 3, 78, '2020-09-30 15:18:12', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(271, 3, 78, '2020-09-30 15:42:12', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(272, 1, 93, '2020-09-30 15:42:29', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(273, 1, 78, '2020-09-30 16:09:07', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(274, 3, 78, '2020-09-30 16:16:11', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(275, 1, 93, '2020-09-30 16:17:48', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(276, 1, 78, '2020-09-30 17:22:36', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(277, 3, 78, '2020-09-30 17:27:11', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:41 con nombre: Representante de la empresa'),
(278, 3, 78, '2020-09-30 17:28:26', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:41 con nombre: Representante de la empresa'),
(279, 3, 78, '2020-09-30 17:28:40', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:41 con nombre: Representante de la empresa'),
(280, 3, 78, '2020-09-30 17:29:00', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(281, 1, 93, '2020-09-30 17:29:52', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(282, 1, 78, '2020-09-30 17:30:32', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(283, 3, 78, '2020-09-30 17:30:46', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(284, 1, 93, '2020-09-30 17:31:05', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(285, 1, 78, '2020-09-30 18:12:34', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(286, 1, 93, '2020-09-30 20:00:57', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(287, 1, 78, '2020-09-30 20:01:27', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(288, 3, 78, '2020-09-30 20:01:36', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(289, 1, 93, '2020-09-30 20:02:11', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(290, 1, 78, '2020-09-30 21:19:22', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(291, 3, 78, '2020-09-30 21:24:49', 'El usuario con id: 78 Alejandro Cruz editó la empresa con ID:2 con nombre: Comercial ramada'),
(292, 4, 78, '2020-09-30 21:27:21', 'El usuario con id: 78 Alejandro Cruz eliminó la empresa con ID:5 con nombre: sdsd'),
(293, 1, 93, '2020-09-30 21:46:44', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(294, 1, 93, '2020-09-30 21:48:58', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(295, 1, 93, '2020-09-30 22:00:35', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(296, 1, 93, '2020-09-30 22:27:20', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(297, 1, 78, '2020-09-30 22:27:36', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(298, 3, 78, '2020-09-30 22:29:03', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:94 con nombre: root y apellidos: root'),
(299, 3, 78, '2020-09-30 22:29:24', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:3 con nombre: Repartidor'),
(300, 1, 78, '2020-09-30 22:31:18', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(301, 1, 94, '2020-09-30 22:31:46', 'El usuario con id: 94 root root inicio sesion'),
(302, 1, 93, '2020-09-30 22:36:02', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(303, 1, 78, '2020-09-30 22:36:24', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(304, 3, 78, '2020-09-30 22:36:46', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:2 con nombre: Empresa'),
(305, 1, 94, '2020-09-30 22:37:00', 'El usuario con id: 94 root root inicio sesion'),
(306, 1, 93, '2020-09-30 22:37:19', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(307, 1, 94, '2020-09-30 22:40:17', 'El usuario con id: 94 root root inicio sesion'),
(308, 1, 94, '2020-09-30 23:04:04', 'El usuario con id: 94 root root inicio sesion'),
(309, 1, 93, '2020-09-30 23:06:28', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(310, 1, 94, '2020-09-30 23:06:51', 'El usuario con id: 94 root root inicio sesion'),
(311, 1, 78, '2020-09-30 23:08:56', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(312, 3, 78, '2020-09-30 23:09:09', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:3 con nombre: Repartidor'),
(313, 1, 94, '2020-09-30 23:09:34', 'El usuario con id: 94 root root inicio sesion'),
(314, 1, 94, '2020-09-30 23:24:52', 'El usuario con id: 94 root root inicio sesion'),
(315, 1, 93, '2020-09-30 23:25:32', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(316, 1, 78, '2020-09-30 23:36:02', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(317, 2, 78, '2020-09-30 23:36:18', 'El usuario con id: 78 Alejandro Cruz editó al usuario con ID:86 con nombre: Marcela y apellidos: Marquez Copaña'),
(318, 2, 78, '2020-09-30 23:40:52', 'El usuario con id: 78 Alejandro Cruz editó al usuario con ID:86 con nombre: Marcela y apellidos: Marquez Copaña'),
(319, 1, 78, '2020-09-30 23:56:11', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(320, 3, 78, '2020-10-01 00:12:41', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:95 con nombre: cxz\\ y apellidos: asdasd'),
(321, 4, 78, '2020-10-01 00:16:37', 'El usuario con id: 78 Alejandro Cruz eliminó al usuario con ID:95 con nombre: cxz\\ y apellidos: asdasd'),
(322, 5, 78, '2020-10-01 00:36:18', 'El usuario con id: 78 Alejandro Cruz cobró a la empresa con ID:1 con nombre: Chiriguano'),
(323, 1, 78, '2020-10-01 08:17:37', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(324, 3, 78, '2020-10-01 08:18:09', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:42 con nombre: hola mundo'),
(325, 2, 78, '2020-10-01 08:19:19', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:42 con nombre: Representante de la empresa'),
(326, 3, 78, '2020-10-01 08:21:34', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:43 con nombre: hhhh'),
(327, 2, 78, '2020-10-01 08:21:54', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:43 con nombre: hhhh'),
(328, 2, 78, '2020-10-01 08:24:15', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:43 con nombre: hhhh'),
(329, 2, 78, '2020-10-01 08:24:29', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:43 con nombre: hhhh'),
(330, 4, 78, '2020-10-01 08:24:42', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:42 con nombre: Representante de la empresa'),
(331, 4, 78, '2020-10-01 08:24:54', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:38 con nombre: sdsd'),
(332, 4, 78, '2020-10-01 08:25:02', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:40 con nombre: sdsd'),
(333, 4, 78, '2020-10-01 08:25:26', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:43 con nombre: hhhh'),
(334, 4, 78, '2020-10-01 08:25:52', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:41 con nombre: Representante de la empresa'),
(335, 3, 78, '2020-10-01 08:26:21', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:44 con nombre: Persona que puede ver'),
(336, 2, 78, '2020-10-01 08:26:30', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:44 con nombre: Persona que puede ver'),
(337, 2, 78, '2020-10-01 08:26:37', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:44 con nombre: Persona que puede ver'),
(338, 4, 78, '2020-10-01 08:26:42', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:44 con nombre: Persona que puede ver'),
(339, 3, 78, '2020-10-01 08:26:55', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:45 con nombre: c'),
(340, 2, 78, '2020-10-01 08:27:04', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:45 con nombre: c'),
(341, 4, 78, '2020-10-01 08:29:44', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:45 con nombre: c'),
(342, 3, 78, '2020-10-01 08:29:59', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:46 con nombre: Representate de empresa'),
(343, 2, 78, '2020-10-01 08:30:09', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:46 con nombre: Representate de empresa'),
(344, 2, 78, '2020-10-01 08:30:22', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:46 con nombre: Representate de empresass'),
(345, 3, 78, '2020-10-01 08:31:42', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:96 con nombre: Marcela y apellidos: Viveros'),
(347, 1, 78, '2020-10-01 08:34:53', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(348, 3, 78, '2020-10-01 08:38:58', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:97 con nombre: Marcela y apellidos: Marquez Copaña'),
(350, 1, 78, '2020-10-01 08:43:09', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(351, 2, 78, '2020-10-01 09:18:16', 'El usuario con id: 78 Alejandro Cruz editó al usuario con ID:86 con nombre: Marcela y apellidos: Marquez Copaña'),
(352, 2, 78, '2020-10-01 09:18:34', 'El usuario con id: 78 Alejandro Cruz editó al usuario con ID:88 con nombre: Marcelod y apellidos: Marquez'),
(353, 2, 78, '2020-10-01 09:18:46', 'El usuario con id: 78 Alejandro Cruz editó al usuario con ID:93 con nombre: Dayler y apellidos: Taboada Frias'),
(354, 2, 78, '2020-10-01 09:19:13', 'El usuario con id: 78 Alejandro Cruz editó al usuario con ID:87 con nombre: Cesar Michael y apellidos: Marquez Copaña'),
(355, 2, 78, '2020-10-01 09:19:28', 'El usuario con id: 78 Alejandro Cruz editó al usuario con ID:91 con nombre: Marcela y apellidos: Martins'),
(356, 2, 78, '2020-10-01 09:19:47', 'El usuario con id: 78 Alejandro Cruz editó al usuario con ID:94 con nombre: root y apellidos: root'),
(357, 2, 78, '2020-10-01 09:19:58', 'El usuario con id: 78 Alejandro Cruz editó al usuario con ID:92 con nombre: Dayler y apellidos: Taboada Frias'),
(358, 4, 78, '2020-10-01 09:20:32', 'El usuario con id: 78 Alejandro Cruz eliminó al usuario con ID:96 con nombre: Marcela y apellidos: Viveros'),
(359, 2, 78, '2020-10-01 09:20:47', 'El usuario con id: 78 Alejandro Cruz editó al usuario con ID:97 con nombre: Marcela y apellidos: Marquez Copaña'),
(360, 1, 93, '2020-10-01 09:22:50', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(361, 1, 78, '2020-10-01 09:27:44', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(362, 3, 78, '2020-10-01 09:30:39', 'El usuario con id: 78 Alejandro Cruz registro la empresa con ID:7 con nombre: Homemarket'),
(363, 1, 78, '2020-10-01 09:40:07', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(364, 1, 93, '2020-10-01 09:41:22', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(365, 1, 93, '2020-10-01 10:15:32', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(366, 1, 94, '2020-10-01 10:16:06', 'El usuario con id: 94 root root inicio sesion'),
(367, 1, 93, '2020-10-01 10:42:58', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(368, 1, 78, '2020-10-01 10:45:59', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(369, 2, 78, '2020-10-01 10:46:53', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:3 con nombre: Repartidor'),
(370, 1, 94, '2020-10-01 10:49:29', 'El usuario con id: 94 root root inicio sesion'),
(371, 1, 78, '2020-10-01 10:53:01', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(372, 3, 78, '2020-10-01 10:57:55', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:47 con nombre: Representate de empresa'),
(373, 2, 78, '2020-10-01 10:58:26', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:47 con nombre: Representate de empresa'),
(374, 1, 78, '2020-10-10 18:19:38', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(375, 1, 78, '2020-10-10 20:56:38', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(376, 1, 78, '2020-10-10 21:07:02', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(377, 6, 78, '2020-10-10 21:07:19', 'El usuario con id: 78 Alejandro Cruz cerro su session'),
(378, 1, 78, '2020-10-10 21:07:27', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(379, 2, 78, '2020-10-10 21:24:08', 'El usuario con id: 78 Alejandro Cruz actualizó el estado del cliente con ID:23 con nombre:  y apellidos: Taboada Frias'),
(380, 2, 78, '2020-10-10 21:24:15', 'El usuario con id: 78 Alejandro Cruz actualizó el estado del cliente con ID:23 con nombre:  y apellidos: Taboada Frias'),
(381, 6, 78, '2020-10-10 21:32:49', 'El usuario con id: 78 Alejandro Cruz cerro su sesión'),
(382, 1, 78, '2020-10-10 21:38:33', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(383, 1, 93, '2020-10-11 16:02:11', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(384, 6, 93, '2020-10-11 18:15:00', 'El usuario con id: 93 Dayler Taboada Frias cerro su sesión'),
(385, 1, 78, '2020-10-11 18:49:31', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(386, 6, 78, '2020-10-11 19:39:57', 'El usuario con id: 78 Alejandro Cruz cerro su sesión'),
(387, 1, 93, '2020-10-11 19:40:12', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(388, 6, 93, '2020-10-11 19:40:37', 'El usuario con id: 93 Dayler Taboada Frias cerro su sesión'),
(389, 1, 94, '2020-10-11 19:40:49', 'El usuario con id: 94 root root inicio sesion'),
(390, 6, 94, '2020-10-11 19:41:13', 'El usuario con id: 94 root root cerro su sesión'),
(391, 1, 78, '2020-10-12 10:40:44', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(392, 4, 78, '2020-10-12 10:41:09', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:47 con nombre: Representate de empresa'),
(393, 4, 78, '2020-10-12 10:41:14', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:46 con nombre: Representate de empresass'),
(394, 3, 78, '2020-10-12 10:45:03', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:98 con nombre: Usuario y apellidos: De Prueba'),
(395, 2, 78, '2020-10-12 10:45:29', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:31 con nombre: Representante de la empresa'),
(396, 6, 78, '2020-10-12 10:45:37', 'El usuario con id: 78 Alejandro Cruz cerro su sesión'),
(397, 1, 98, '2020-10-12 10:45:45', 'El usuario con id: 98 Usuario De Prueba inicio sesion'),
(398, 6, 98, '2020-10-12 10:49:37', 'El usuario con id: 98 Usuario De Prueba cerro su sesión'),
(399, 1, 78, '2020-10-12 10:50:07', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(400, 3, 78, '2020-10-12 10:51:51', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:99 con nombre: Usuario y apellidos: prueba2'),
(401, 6, 78, '2020-10-12 10:51:57', 'El usuario con id: 78 Alejandro Cruz cerro su sesión'),
(402, 1, 99, '2020-10-12 10:52:12', 'El usuario con id: 99 Usuario prueba2 inicio sesion'),
(403, 6, 99, '2020-10-12 10:54:43', 'El usuario con id: 99 Usuario prueba2 cerro su sesión'),
(404, 1, 99, '2020-10-12 10:56:48', 'El usuario con id: 99 Usuario prueba2 inicio sesion'),
(405, 6, 99, '2020-10-12 11:06:32', 'El usuario con id: 99 Usuario prueba2 cerro su sesión'),
(406, 1, 78, '2020-10-12 11:06:44', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(407, 3, 78, '2020-10-12 11:07:47', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:100 con nombre: Repartidor y apellidos: usuario'),
(408, 6, 78, '2020-10-12 11:07:51', 'El usuario con id: 78 Alejandro Cruz cerro su sesión'),
(409, 1, 100, '2020-10-12 11:08:00', 'El usuario con id: 100 Repartidor usuario inicio sesion'),
(410, 6, 100, '2020-10-12 11:08:07', 'El usuario con id: 100 Repartidor usuario cerro su sesión'),
(411, 1, 99, '2020-10-12 11:08:15', 'El usuario con id: 99 Usuario prueba2 inicio sesion'),
(412, 6, 99, '2020-10-12 11:10:37', 'El usuario con id: 99 Usuario prueba2 cerro su sesión'),
(413, 1, 78, '2020-10-12 11:10:48', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(414, 2, 78, '2020-10-12 11:11:00', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:31 con nombre: Representante de la empresa'),
(415, 6, 78, '2020-10-12 11:11:48', 'El usuario con id: 78 Alejandro Cruz cerro su sesión'),
(416, 1, 93, '2020-10-12 11:11:57', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(417, 6, 93, '2020-10-12 11:15:50', 'El usuario con id: 93 Dayler Taboada Frias cerro su sesión'),
(418, 1, 99, '2020-10-12 11:16:02', 'El usuario con id: 99 Usuario prueba2 inicio sesion'),
(419, 6, 99, '2020-10-12 11:26:47', 'El usuario con id: 99 Usuario prueba2 cerro su sesión'),
(420, 1, 100, '2020-10-12 11:26:55', 'El usuario con id: 100 Repartidor usuario inicio sesion'),
(421, 6, 100, '2020-10-12 11:28:56', 'El usuario con id: 100 Repartidor usuario cerro su sesión'),
(422, 1, 78, '2020-10-12 11:29:07', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(423, 3, 78, '2020-10-12 11:30:07', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:48 con nombre: prueba'),
(424, 2, 78, '2020-10-12 11:30:17', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:48 con nombre: prueba'),
(425, 3, 78, '2020-10-12 11:30:43', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:49 con nombre: fdfd'),
(426, 2, 78, '2020-10-12 11:30:55', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:49 con nombre: fdfd'),
(427, 4, 78, '2020-10-12 11:31:03', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:48 con nombre: prueba'),
(428, 4, 78, '2020-10-12 11:31:08', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:49 con nombre: fdfd'),
(429, 3, 78, '2020-10-12 11:31:17', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:50 con nombre: fdfd'),
(430, 2, 78, '2020-10-12 11:31:25', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:50 con nombre: fdfd'),
(431, 3, 78, '2020-10-12 11:44:35', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:51 con nombre: sdsd'),
(432, 2, 78, '2020-10-12 11:44:44', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:51 con nombre: sdsd'),
(433, 3, 78, '2020-10-12 11:59:40', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:52 con nombre: sdsd'),
(434, 2, 78, '2020-10-12 11:59:48', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:52 con nombre: sdsd'),
(435, 2, 78, '2020-10-12 11:59:55', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:52 con nombre: sdsd'),
(436, 3, 78, '2020-10-12 12:00:20', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:53 con nombre: hola'),
(437, 2, 78, '2020-10-12 12:00:33', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:53 con nombre: hola'),
(438, 4, 78, '2020-10-12 12:05:39', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:53 con nombre: hola'),
(439, 4, 78, '2020-10-12 12:05:47', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:52 con nombre: sdsd'),
(440, 3, 78, '2020-10-12 12:05:56', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:54 con nombre: hola'),
(441, 2, 78, '2020-10-12 12:06:05', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:54 con nombre: hola'),
(442, 2, 78, '2020-10-12 12:06:20', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:54 con nombre: hola'),
(443, 2, 78, '2020-10-12 12:06:33', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:54 con nombre: hola'),
(444, 2, 78, '2020-10-12 12:06:47', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:54 con nombre: hola'),
(445, 4, 78, '2020-10-12 12:06:59', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:54 con nombre: hola'),
(446, 4, 78, '2020-10-12 12:07:03', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:51 con nombre: sdsd'),
(447, 3, 78, '2020-10-12 12:07:28', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:55 con nombre: hola mundo'),
(448, 2, 78, '2020-10-12 12:09:36', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:55 con nombre: hola mundo'),
(449, 4, 78, '2020-10-12 12:09:46', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:55 con nombre: hola mundo'),
(450, 3, 78, '2020-10-12 12:11:15', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:56 con nombre: Representate de empresa'),
(451, 2, 78, '2020-10-12 12:11:26', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:56 con nombre: Representate de empresa'),
(452, 4, 78, '2020-10-12 12:12:23', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:56 con nombre: Representate de empresa'),
(453, 3, 78, '2020-10-12 12:12:33', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:57 con nombre: s'),
(454, 2, 78, '2020-10-12 12:16:15', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:57 con nombre: s'),
(455, 2, 78, '2020-10-12 12:16:26', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:57 con nombre: s'),
(456, 2, 78, '2020-10-12 12:16:33', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:57 con nombre: s'),
(457, 4, 78, '2020-10-12 12:16:40', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:57 con nombre: s'),
(458, 4, 78, '2020-10-12 12:16:46', 'El usuario con id: 78 Alejandro Cruz eliminó el rol con ID:50 con nombre: fdfd'),
(459, 3, 78, '2020-10-12 12:16:59', 'El usuario con id: 78 Alejandro Cruz registro el rol con ID:58 con nombre: hola mundo'),
(460, 2, 78, '2020-10-12 12:17:12', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:58 con nombre: hola mundo'),
(461, 2, 78, '2020-10-12 12:19:01', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:58 con nombre: hola mundo'),
(462, 2, 78, '2020-10-12 12:19:07', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:58 con nombre: hola mundo'),
(463, 2, 78, '2020-10-12 12:19:17', 'El usuario con id: 78 Alejandro Cruz editó el rol con ID:58 con nombre: hola mundo'),
(464, 1, 92, '2020-10-12 12:41:11', 'El usuario con id: 92 Dayler Taboada Frias inicio sesion'),
(465, 6, 92, '2020-10-12 12:41:25', 'El usuario con id: 92 Dayler Taboada Frias cerro su sesión'),
(466, 1, 93, '2020-10-12 12:41:36', 'El usuario con id: 93 Dayler Taboada Frias inicio sesion'),
(467, 6, 93, '2020-10-12 12:47:41', 'El usuario con id: 93 Dayler Taboada Frias cerro su sesión'),
(468, 1, 78, '2020-10-12 12:47:50', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(469, 3, 78, '2020-10-12 12:48:39', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:101 con nombre: Agustin y apellidos: Saavedra'),
(470, 3, 78, '2020-10-12 12:50:23', 'El usuario con id: 78 Alejandro Cruz registro al usuario con ID:102 con nombre: Mario y apellidos: Delgadillo'),
(471, 6, 78, '2020-10-12 12:50:30', 'El usuario con id: 78 Alejandro Cruz cerro su sesión'),
(472, 1, 102, '2020-10-12 12:50:41', 'El usuario con id: 102 Mario Delgadillo inicio sesion'),
(473, 1, 101, '2020-10-12 15:47:58', 'El usuario con id: 101 Agustin Saavedra inicio sesion'),
(474, 6, 101, '2020-10-12 16:28:53', 'El usuario con id: 101 Agustin Saavedra cerro su sesión'),
(475, 1, 78, '2020-10-12 17:37:11', 'El usuario con id: 78 Alejandro Cruz inicio sesion'),
(476, 6, 78, '2020-10-12 17:37:31', 'El usuario con id: 78 Alejandro Cruz cerro su sesión'),
(477, 1, 99, '2020-10-12 18:00:09', 'El usuario con id: 99 Usuario prueba2 inicio sesion'),
(478, 3, 77, '2021-10-21 21:27:29', 'El cliente con ID:24 con nombre:  y apellidos: taboada se registró'),
(479, 1, 81, '2021-10-21 21:39:00', 'El usuario con id: 81 Dayler  inicio sesion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `descripcion` text,
  `imagen` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `imagen`, `color`) VALUES
(117, 'Electrónicos', '&lt;p&gt;Se podrán registrar diversos dispositivos electrónicos, a los cuales el usuario podrá acceder de manera sencilla, estos productos pueden ser: celulares ,  audífonos,  cámaras y demás &lt;/p&gt;', 'HomeMarket.png', '#1f44ff'),
(118, 'Muebles', '&lt;p&gt;Se podrán exhibir los diversos tipos de muebles como ser camas, mesas de noche, mesas, sillas y demás &lt;/p&gt;', 'HomeMarket.png', '#f41010'),
(119, 'sdsd', '&lt;p&gt;dd&lt;/p&gt;', 'HomeMarket.png', '#6b1414');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(100) DEFAULT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `verificado` tinyint(4) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `imagen`, `nombres`, `apellidos`, `telefono`, `fechanacimiento`, `sexo`, `email`, `password`, `estado`, `verificado`, `token`) VALUES
(19, 'telefono-movil.png', 'Gloria', 'Ledesma', '67104624', '2000-06-15', '1', 'gloriaL@gmail.com', '$2y$10$Hprl5hX.lJYktbsu/4d5DubRZIcPduCKbzahM5SWvLWDqposUGOF.', '1', 0, 'db4d49f26a94c960fc84de1db4b561c00d7c73e3a86681357faebc940df2'),
(21, 'HomeMarket.png', 'Amanda', 'Taboada Frias', '67104624', '2000-06-15', '2', 'alejandrooo@gmail.com', '$2y$10$2YksMCZcHh41OB5ciKtb1O781kw.lJZHaDe0UAquUCWc/lBynqQc6', '1', 0, '070462201de27a794f9bceaf3a2c73b26a9ceef1c4a7fa4e45fca4b2c83c'),
(22, NULL, 'Dayler', 'Taboada Frias', '67104624', '1998-06-19', '1', 'daylertaboadad@gmail.com', '$2y$10$qYrPhNsA/Mbb0ATGBffGT.9KomiprUlbsNLH8/yH3fEeoq42aZ4Fa', '1', 1, ''),
(23, NULL, 'Dayler', 'Taboada Frias', '67104624', '2001-11-10', '1', 'daylertaboada@gmail.com', '$2y$12$BVuwQmsf.ApRc2RjC/kPjuKslUZyImeOdqmOri/m838bqLWj3Jixu', '1', 0, '5f8743babae91ed5db5bc7173c86be1e34986bd9edded36105e8704060be'),
(24, 'logoSaint.png', 'dayler', 'taboada', '67104624', '1999-01-01', '1', 'dayler1999@hotmail.com', '$2y$10$jaLN3KdJulq0TwOIkk/Z/OQEhf2BZIxq/pLvn8k4eVmlQ9UY3s1K.', '1', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobro`
--

DROP TABLE IF EXISTS `cobro`;
CREATE TABLE IF NOT EXISTS `cobro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) DEFAULT NULL,
  `monto` varchar(50) DEFAULT NULL,
  `idusuario` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `totalActual` varchar(50) DEFAULT NULL,
  `totalAnterior` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idempresa` (`idempresa`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cobro`
--

INSERT INTO `cobro` (`id`, `idempresa`, `monto`, `idusuario`, `fecha`, `totalActual`, `totalAnterior`) VALUES
(1, 1, '100', 78, '2020-09-24 19:02:39', NULL, NULL),
(3, 1, '200', 78, '2020-09-25 18:12:05', '1105.6', '1305.6'),
(4, 1, '100', 78, '2020-09-25 18:13:24', '1105.6', '1205.6'),
(5, 1, '100', 78, '2020-09-25 18:14:35', '1005.6', '1105.6'),
(6, 1, '100', 78, '2020-09-25 18:17:32', '1005.6', '1105.6'),
(7, 1, '1000', 78, '2020-09-30 17:23:29', '105.6', '1105.6'),
(8, 1, '100', 78, '2020-09-30 17:23:42', '1005.6', '1105.6'),
(9, 1, '100', 78, '2020-09-30 21:20:37', '1005.6', '1105.6'),
(10, 1, '100', 78, '2020-09-30 21:23:57', '1005.6', '1105.6'),
(13, 1, '1000', 78, '2020-10-01 00:36:18', '1045.6', '2045.6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE IF NOT EXISTS `comentario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `calificacion` varchar(50) DEFAULT NULL,
  `comentario` text,
  `promedio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idproducto` (`idproducto`),
  KEY `idcliente` (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

DROP TABLE IF EXISTS `detallepedido`;
CREATE TABLE IF NOT EXISTS `detallepedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpedido` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `cantidad` varchar(50) DEFAULT NULL,
  `precio` varchar(50) DEFAULT NULL,
  `subtotal` varchar(50) DEFAULT NULL,
  `comision` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IXFK_detallepedido_pedido` (`idpedido`),
  KEY `IXFK_detallepedido_producto` (`idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`id`, `idpedido`, `idproducto`, `cantidad`, `precio`, `subtotal`, `comision`) VALUES
(19, 26, 6, '1', '10000', '10000', '520'),
(20, 27, 6, '1', '10000', '10000', '520'),
(21, 28, 6, '1', '10000', '10000', '520'),
(22, 29, 6, '1', '10000', '10000', '520'),
(23, 30, 6, '1', '10000', '10000', '520'),
(24, 31, 26, '2', '14', '28', '1.456'),
(25, 32, 6, '1', '10000', '10000', '520'),
(26, 33, 6, '1', '10000', '10000', '520'),
(27, 34, 3, '1', '67', '67', '1.876'),
(28, 34, 4, '2', '1800', '3600', '100.8'),
(29, 35, 13, '1', '3500', '3500', '98'),
(30, 35, 19, '1', '30000', '30000', '840'),
(31, 35, 20, '1', '30000', '30000', '840'),
(32, 35, 23, '1', '30000', '30000', '840'),
(33, 35, 22, '1', '30000', '30000', '840'),
(34, 35, 21, '1', '30000', '30000', '840'),
(35, 36, 27, '1', '200', '200', '6.4'),
(36, 37, 3, '1', '67', '67', '1.876'),
(37, 38, 3, '1', '67', '67', '1.876'),
(38, 39, 3, '1', '67', '67', '1.876'),
(39, 39, 4, '1', '1800', '1800', '50.4'),
(40, 40, 3, '1', '67', '67', '1.876'),
(41, 40, 4, '2', '1800', '3600', '100.8'),
(42, 41, 13, '1', '3500', '3500', '98'),
(43, 41, 21, '1', '30000', '30000', '840'),
(44, 42, 13, '1', '3500', '3500', '98'),
(45, 43, 13, '2', '3500', '7000', '196'),
(46, 43, 19, '1', '30000', '30000', '840'),
(47, 43, 21, '2', '30000', '60000', '1680'),
(48, 44, 21, '2', '30000', '60000', '1680'),
(49, 44, 13, '1', '3500', '3500', '98');

--
-- Disparadores `detallepedido`
--
DROP TRIGGER IF EXISTS `TR_Disminuir`;
DELIMITER $$
CREATE TRIGGER `TR_Disminuir` AFTER INSERT ON `detallepedido` FOR EACH ROW BEGIN
  update producto set stock=stock -new.cantidad
  where id=new.idproducto;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

DROP TABLE IF EXISTS `direccion`;
CREATE TABLE IF NOT EXISTS `direccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `longitud` varchar(100) DEFAULT NULL,
  `latitud` varchar(100) DEFAULT NULL,
  `referencia` text,
  `calle` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idcliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id`, `idcliente`, `nombre`, `longitud`, `latitud`, `referencia`, `calle`) VALUES
(4, 22, 'Representate de empresa', '-63.1678783', '-17.8272098', 's', '5'),
(5, 22, 'Casa de mi madre', '-63.185763359069824', '-17.83915588831184', 'Portón café', '4'),
(9, 22, 'fdfd', '-122.44542493595883', '37.76878967151739', 'ss', '7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `representante` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `comision` float DEFAULT NULL,
  `totalcomision` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `descripcion`, `representante`, `direccion`, `telefono`, `imagen`, `comision`, `totalcomision`) VALUES
(1, 'Chiriguano', 'Somos una empresa dedicada a la comercializacion de computadoras de escritorio y portatiles', 'Dayler Taboada', 'asdf', '74664433', 'chiriguano.jpg', 5.2, '1045.6'),
(2, 'Comercial ramada', 'asdfasdf', 'Nanet Taboada Frias', 'asdf', '67233322', 'ramada.jpg', 2.8, '0'),
(3, 'Hipermaxi tecnologic', 'Somos una empresa dedicada a la venta de batidoras , licuadoras ,entre otros enseres de cocina.', 'Margoth Espinoza', NULL, '12345678', 'HIPERMAXI.jpg', 10, '0'),
(7, 'Homemarket', '..', 'Dayler Taboada Frias', 'Av. Radial 13 5to anillo', '67104624', 'HomeMarket.png', 3.2, '6.4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) DEFAULT NULL,
  `idempresa` int(11) DEFAULT NULL,
  `idrepartidor` int(11) DEFAULT NULL,
  `comision` varchar(50) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `fechahora` datetime DEFAULT NULL,
  `latitud` varchar(50) DEFAULT NULL,
  `longuitud` varchar(50) DEFAULT NULL,
  `detalle` varchar(250) DEFAULT NULL,
  `estadopedidoactual` varchar(50) DEFAULT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `razonSocial` varchar(50) DEFAULT NULL,
  `calle` varchar(50) DEFAULT NULL,
  `referencia` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idrepartidor` (`idrepartidor`),
  KEY `idcliente` (`idcliente`),
  KEY `idempresa` (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `idcliente`, `idempresa`, `idrepartidor`, `comision`, `total`, `fechahora`, `latitud`, `longuitud`, `detalle`, `estadopedidoactual`, `nit`, `razonSocial`, `calle`, `referencia`) VALUES
(26, 22, 1, 9, '520', '10000', NULL, '-17.8376782', '-63.1732076', 'referencia color negro', '2', '1111133423332', 'Dayler Taboada', '3', 'puerta principal de madera y de color café'),
(27, 22, 1, NULL, '520', '10000', NULL, '-17.8272098', '-63.1678783', 'dfs', '5', '1111133423332', 'Dayler Taboada', '5', 'puerta principal de madera y de color café'),
(28, 22, 1, 12, '520', '10000', '2020-09-30 21:59:19', '-17.8272098', '-63.1678783', 'referencia color negro', '4', '1111133423332', 'Dayler Taboada', '7', 'puerta principal de madera y de color café'),
(29, 22, 1, 11, '520', '10000', '2020-09-30 22:16:29', '-17.8272098', '-63.1678783', 'referencia color negro', '5', '1111133423334', 'Dayler Taboada', '7', 'puerta principal de madera y de color café'),
(30, 22, 1, NULL, '520', '10000', '2020-09-30 23:06:08', '-17.8376321', '-63.1730777', 'referencia color negro', '5', '1111133423332', 'Dayler Taboada', '7', 'puerta principal de madera y de color café'),
(31, 22, 1, 12, '1.456', '28', '2020-10-01 08:11:24', '-17.8272098', '-63.1678783', 'referencia color negro', '2', '1111133423334', 'Dayler Taboada', '3', 'puerta principal de madera y de color café'),
(32, 22, 1, 12, '520', '10000', '2020-10-01 11:05:23', '-17.8272098', '-63.1678783', 'referencia color negro', '2', '1111133423332', 'Dayler Taboada', '3', 'puerta principal de madera y de color café'),
(33, 22, 1, 12, '520', '10000', '2020-10-09 17:05:02', '-17.83915588831184', '-63.185763359069824', 'referencia color negro', '2', '1111133423332', 'personal', '4', 'Portón café'),
(34, 22, 2, 14, '102.676', '3667', '2020-10-09 17:06:28', '-17.83915588831184', '-63.185763359069824', 'referencia color negro', '3', '1111133423332', 'Dayler Taboada Frias', '4', 'Portón café'),
(35, 22, 2, 14, '4298', '153500', '2020-10-11 20:02:27', '-17.8272098', '-63.1678783', 'referencia color negro', '4', '1111133423332', 'Dayler Taboada Frias', '5', 's'),
(36, 22, 7, 13, '6.4', '200', '2020-10-12 10:56:17', '-17.83915588831184', '-63.185763359069824', 'referencia color negro', '5', '1111133423332', 'Dayler Taboada Frias', '4', 'Portón café'),
(37, 22, 2, NULL, '1.876', '67', '2020-10-12 16:58:09', '-17.8272098', '-63.1678783', 'referencia color negro', '1', '1111133423332', 'Dayler Taboada', '5', 's'),
(38, 22, 2, NULL, '1.876', '67', '2020-10-12 17:03:03', '-17.8272098', '-63.1678783', 'referencia color negro', '1', '1111133423332', 'Dayler Taboada Frias', '5', 's'),
(39, 22, 2, NULL, '52.276', '1867', '2020-10-12 17:04:02', '-17.8272098', '-63.1678783', 'referencia color negro', '1', '1111133423334', 'Dayler Taboada Frias', '5', 'puerta principal de madera y de color café'),
(40, 22, 2, NULL, '102.676', '3667', '2020-10-12 17:09:34', '-17.83915588831184', '-63.185763359069824', 'referencia color negro', '1', '1111133423332', 'Dayler Taboada Frias', '4', 'Portón café'),
(41, 22, 2, NULL, '938', '33500', '2020-10-12 17:17:19', '-17.8272098', '-63.1678783', 'referencia color negro', '1', '1111133423332', 'personal', '5', 's'),
(42, 22, 2, NULL, '98', '3500', '2020-10-12 17:29:24', '37.76878967151739', '-122.44542493595883', 'referencia color negro', '1', '1111133423334', 'Dayler Taboada Frias', '7', 'ss'),
(43, 22, 2, NULL, '2716', '97000', '2020-10-12 17:54:22', '-17.83915588831184', '-63.185763359069824', 'referencia color negro', '1', '1111133423332', 'Dayler Taboada Frias', '4', 'Portón café'),
(44, 24, 2, NULL, '1778', '63500', '2021-10-21 21:36:53', 'null', 'null', NULL, '1', '12312321323', 'Dayler Taboada Frias', '4', 'portón de madera de color rojo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--

DROP TABLE IF EXISTS `privilegio`;
CREATE TABLE IF NOT EXISTS `privilegio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `privilegio`
--

INSERT INTO `privilegio` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Listar , buscar  y ver', 'Este privilegio permitirá listar'),
(2, 'Buscar', 'Este privilegio permitirá buscar'),
(3, 'Registrar', 'Este privilegio permitirá registrar'),
(4, 'Editar', 'Este privilegio permitirá editar'),
(5, 'Eliminar ', 'Este privilegio permitirá eliminar'),
(6, 'Asignar repartidor', '..'),
(7, 'Cambiar estado', '...');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio` double(10,2) DEFAULT NULL,
  `imagen` varchar(500) DEFAULT NULL,
  `descripcion` text,
  `idsubcategoria` int(11) DEFAULT NULL,
  `idempresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idsubcategoria` (`idsubcategoria`),
  KEY `idempresa` (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `stock`, `precio`, `imagen`, `descripcion`, `idsubcategoria`, `idempresa`) VALUES
(3, 'Cargador FULL HuweiP90', 0, 67.00, 'cargador.jpg', 'Cargador original carga rapida  de entrada tipo C y US', 27, 2),
(4, 'Zony Xperia Z2', 0, 1800.00, 'sony.jpg', 'Celular de marca Sony Xperia Z2 ,con memoria RAM de 2GB y camara de 8mp.', 27, 2),
(5, 'Samsung S10', 0, 800.00, '1601559744sansung.jpg', 'Celular de marca SAMSUNG S10 con una memoria RAM de 1GB ,espacio en memoria de 10GB y camara de 10mp.', 27, 1),
(6, 'Iphone20 enterprise', 2, 10000.00, '1601559766iphone.jpg', 'Celular de marca Iphone de 10GB de RAM,espacio de 100GB en memoria y camara de 50mp', 27, 1),
(13, 'Celular Huawei Y9 2019', 2, 3500.00, 'huweiy90.jpg', 'El celular es de marca HUAWEI  tiene una memoria de 16GB , memoria RAM de 3GB ,al igual que una camara frontal y delantera.', 27, 2),
(19, 'Celular Toshiba Handeabook', 0, 30000.00, 'toshiba.jpg', 'Este celular tiene una capacidad de memoria de 100GB y memoria RAM de 8GB.', 27, 2),
(20, 'Huawei Y9 version Plus', 1, 30000.00, 'huweiy90.jpg', 'Es celular tiene un espacio de 120GB y memoria RAM de 6GB , cuenta con 3 camaras traseras y 4 frontales.', 27, 2),
(21, 'Huawei Y9 version Plus', 1, 30000.00, 'toshiba.jpg', 'Este celular tiene una memoria de 36GB y 4GB de RAM  ,al igual que 3 camaras frontales y 2 delanteras .', 27, 2),
(22, 'Huawei Y9 version Plus', 1, 30000.00, 'huweiy90.jpg', 'Es celular tiene un espacio de 120GB y memoria RAM de 6GB , cuenta con 3 camaras traseras y 4 frontales.', 27, 2),
(23, 'Huawei Y9 version Plus', 6, 30000.00, 'toshiba.jpg', 'Este celular tiene una memoria de 36GB y 4GB de RAM  ,al igual que 3 camaras frontales y 2 delanteras .', 27, 2),
(24, 'Replica celular Huawei Y9', 2, 2.00, 'toshiba.jpg', 'dad', 27, 2),
(25, 'Iphone7', 1, 100000.00, 'gestionar direccion.png', 'dasdd', 27, 2),
(26, 'Toshiba', 0, 14.00, '1601559800toshiba.jpg', '..', 27, 1),
(27, 'Celular Xiaomi', 4, 200.00, '1602514412telefono-movil.png', '...', 27, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidor`
--

DROP TABLE IF EXISTS `repartidor`;
CREATE TABLE IF NOT EXISTS `repartidor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` bigint(11) UNSIGNED DEFAULT NULL,
  `idempresa` int(11) DEFAULT NULL,
  `cantidadDePedidos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idusuario` (`idusuario`),
  KEY `idempresa` (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `repartidor`
--

INSERT INTO `repartidor` (`id`, `idusuario`, `idempresa`, `cantidadDePedidos`) VALUES
(9, 87, 1, 1),
(10, 91, 3, NULL),
(11, 92, 1, 1),
(12, 94, 1, 3),
(13, 100, 7, 0),
(14, 101, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision`
--

DROP TABLE IF EXISTS `revision`;
CREATE TABLE IF NOT EXISTS `revision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valoracion` int(11) DEFAULT NULL,
  `reseña` text,
  `idcliente` int(11) DEFAULT NULL,
  `idpedido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idcliente` (`idcliente`),
  KEY `idpedido` (`idpedido`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `revision`
--

INSERT INTO `revision` (`id`, `valoracion`, `reseña`, `idcliente`, `idpedido`) VALUES
(8, 4, 's', 22, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `condicion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `descripcion`, `condicion`) VALUES
(1, 'Administrador', 'El rol de administrar tiene la responsabilidad de gestionar cualquier procedimiento en el sistema', 1),
(2, 'Empresa', 'El rol de empresa tiene la responsabilidad de gestionar productos , gestionar pedido y gestionar promocion.', 1),
(3, 'Repartidor', 'El repartidor es la logística de la empresa, que se encargará de llevar el pedido al cliente.', 1),
(4, 'SuperAdministrador', 'El super-administrador podrá registrar,editar yeliminar administradores.', 1),
(31, 'Representante de la empresa', '..', NULL),
(58, 'hola mundo', 's', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_accion`
--

DROP TABLE IF EXISTS `rol_accion`;
CREATE TABLE IF NOT EXISTS `rol_accion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idrol` int(11) DEFAULT NULL,
  `idaccion` int(11) DEFAULT NULL,
  `eliminado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idrol` (`idrol`),
  KEY `idaccion` (`idaccion`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol_accion`
--

INSERT INTO `rol_accion` (`id`, `idrol`, `idaccion`, `eliminado`) VALUES
(16, 31, 1, 0),
(17, 31, 2, 0),
(42, 2, 1, 0),
(49, 2, 2, 0),
(52, 3, 2, 0),
(54, 3, 1, 1),
(85, 58, 1, 0),
(86, 58, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_privilegio`
--

DROP TABLE IF EXISTS `rol_privilegio`;
CREATE TABLE IF NOT EXISTS `rol_privilegio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idrol` int(11) DEFAULT NULL,
  `idprivilegio` int(11) DEFAULT NULL,
  `eliminado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idrol` (`idrol`),
  KEY `idprivilegio` (`idprivilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol_privilegio`
--

INSERT INTO `rol_privilegio` (`id`, `idrol`, `idprivilegio`, `eliminado`) VALUES
(13, 31, 1, 0),
(15, 31, 3, 0),
(16, 31, 4, 0),
(17, 31, 5, 0),
(18, 31, 6, 0),
(19, 31, 7, 0),
(41, 2, 1, NULL),
(42, 2, 2, 0),
(43, 2, 4, 0),
(44, 2, 6, 0),
(45, 2, 3, 0),
(46, 2, 5, 0),
(52, 3, 7, 0),
(53, 2, 7, 0),
(54, 3, 6, 1),
(55, 3, 1, 0),
(82, 31, 2, 0),
(122, 58, 1, 0),
(123, 58, 2, 0),
(124, 58, 3, 1),
(125, 58, 4, 0),
(126, 58, 5, 1),
(127, 58, 6, 1),
(128, 58, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
CREATE TABLE IF NOT EXISTS `subcategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `imagen` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idcategoria` (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `idcategoria`, `nombre`, `descripcion`, `imagen`, `color`) VALUES
(27, 117, 'Celulares', '&lt;p&gt;Se exhibirán todas las marcas de celulares para toda la clientela &lt;/p&gt;', 'HomeMarket.png', '#64cbf7'),
(28, 117, 'camara', '&lt;p&gt;Se podran exhibir todas las marcas de camaras disponibles en el mercado &lt;/p&gt;', 'HomeMarket.png', '#00fffb'),
(29, 118, 'Camas', '&lt;p&gt;Se dispondrá al publico diversos tamaños de camas, así como diferentes estilos de estas &lt;/p&gt;', 'HomeMarket.png', '#ff8800'),
(30, 118, 'Mesas', '&lt;p&gt;Se podrán a disposición los diversos tipos de mesa, de diversos materiales &lt;/p&gt;', 'HomeMarket.png', '#ffad1f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipobitacora`
--

DROP TABLE IF EXISTS `tipobitacora`;
CREATE TABLE IF NOT EXISTS `tipobitacora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipobitacora`
--

INSERT INTO `tipobitacora` (`id`, `nombre`) VALUES
(1, 'Inicio de sesion'),
(2, 'Editar'),
(3, 'Registrar'),
(4, 'Eliminar'),
(5, 'Cobrar'),
(6, 'Salió');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ci` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `idrol` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `idrol` (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `apellidos`, `email`, `imagen`, `password`, `remember_token`, `created_at`, `updated_at`, `ci`, `telefono`, `sexo`, `fechanacimiento`, `idrol`, `estado`) VALUES
(77, 'Super', 'Administrador', 'super@gmail.com', 'HomeMarket.png', '$2y$10$epv.qWy0MqYjUoJM67.Wzew55dyyqu9ASgZMwARBKNdGDv145Fpzu', NULL, NULL, NULL, '1111111', '67104624', 1, '2001-07-04', 4, 1),
(78, 'Alejandro', 'Cruz', 'alejandro@gmail.com', 'HomeMarket.png', '$2y$10$h9B7bUJTejhPyITIre5Hfu780a4xdzQtDmx56GMvLPC54WOyE823S', NULL, NULL, NULL, '1111111', '67104624', 1, '2001-10-18', 1, 1),
(81, 'Dayler', 'Taboada Frias', 'daylertaboadaA@gmail.com', 'HomeMarket.png', '$2y$10$KwAnQQEY/B1LvfXdG8VWpO2KYGBsAB8iqtQOmNBk2NmGnw8xN0PWW', NULL, NULL, NULL, '124452534', '71015844', 1, '2000-07-31', 1, 1),
(82, 'Rodrigo', 'Duarte Barrientos', 'rodrigo@gmail.com', 'HomeMarket.png', '$2y$10$US5p3DCwh8HnukEvxVcrV.zODg4RxQup3ckfei8AMkiE/6R3zy6u6', NULL, NULL, NULL, '12693473', '76685448', 1, '2000-02-25', 1, 1),
(85, 'khipu dev a', 'Marquez Copaña', 'daylertaboxxada@gmail.com', 'HomeMarket.png', '$2y$10$38dDm0/W5j9xQx4m452SreRhmcjDvPSeb.ai4jtj.elWmChcnGf76', NULL, NULL, NULL, '1111111', '67104624', 2, '2001-02-08', 1, 1),
(86, 'Marcela', 'Marquez Copaña', 'addsadmin@hotmail.com', 'repartidor1.jpg', '$2y$10$7oL6TCKw7fk8t7vnyb3Igeho8PSCLdJT4GqgWZcSREFk7xngP5nb6', NULL, NULL, NULL, '7766554', '67104624', 2, '2000-06-16', 2, 1),
(87, 'Cesar Michael', 'Marquez Copaña', 'addsmin@hotmail.com', 'repartidor1.jpg', '$2y$10$ENNoCvSaj.GtVBeSpUpC5uqCmq12eXcaRe8.GXxNwg5obi.OJZ1.u', NULL, NULL, NULL, '7766554', '67104624', 1, '2001-06-16', 3, 1),
(88, 'Marcelod', 'Marquez', 'marcelo@hotmail.com', 'repartidor1.jpg', '$2y$10$KHfsKxSw.iSECbaeRElHjeJ31QEPxD1UoRZWgGUUpQf0o95DNBm.2', NULL, NULL, NULL, '1111111', '67104624', 1, '2000-07-14', 2, 1),
(89, 'dayler', 'Taboada Frias', 'dayler@hotmail.com', 'HomeMarket.png', '$2y$10$5whLaPCB5p5mXXIwQ7FqOewuxa1qLOom7znHcjL2UqGk11jUV15qa', NULL, NULL, NULL, '7766554', '67104624', 1, '2001-02-24', 1, 1),
(91, 'Marcela', 'Martins', 'adddmin@hotmail.com', 'repartidor1.jpg', '$2y$10$AysvHfBgNaPK2w.CMEx2PuXFBfHqyorYV5zi8zifBjBgbGgILjkke', NULL, NULL, NULL, '7766554', '67104624', 1, '2001-07-07', 3, 0),
(92, 'Dayler', 'Taboada Frias', 'dayler1999@hotmail.com', 'repartidor1.jpg', '$2y$10$XtTp9Ezs3RpVZrM.BsYb8Oz6ZF783PGPLI1DzXZkuixFQFPMjM8pG', NULL, NULL, NULL, '32123131', '67104624', 1, '2001-07-11', 3, 1),
(93, 'Dayler', 'Taboada Frias', 'dayler10010@hotmail.com', 'repartidor1.jpg', '$2y$10$JpQ7X6UhLrQX0r5/Xejpy.IOyDiwSJ10pg59zJLZ5IwuqD6GdxhDq', NULL, NULL, NULL, '7735743', '67104624', 1, '2000-05-31', 2, 1),
(94, 'root', 'root', 'root@hotmail.com', 'repartidor1.jpg', '$2y$10$nrn6dxYHp.Gm.RE9QvZpTu/.wPCMK.lthfOr/ouMiqY4roM4l2za.', NULL, NULL, NULL, '7766554', '67104624', 1, '2000-06-01', 3, 1),
(98, 'Usuario', 'De Prueba', 'usuarioPrueba@gmail.com', 'repartidor1.jpg', '$2y$10$Ob4adyZwWBG3fIS2vmNsLuvDB6Rgg1k74812HCRwbWxvUtk58vkVm', NULL, NULL, NULL, '7766554', '67104624', 1, '1998-07-25', 31, 1),
(99, 'Usuario', 'prueba2', 'usuarioPrueba2@gmail.com', 'repartidor1.jpg', '$2y$10$4xbQIaYbInUn2StXFeMm3OrteGxNEbIKMWpvRn6.hxKhI7AGjGPt6', NULL, NULL, NULL, '7766554', '67104624', 1, '1997-05-15', 31, 1),
(100, 'Repartidor', 'usuario', 'usuarioRepartidor@gmail.com', 'repartidor1.jpg', '$2y$10$X1MJ1iRzqx8dHt5gM.ITOO2xR/b.iylIy/vlnZmQWxyzLt9I6OJkq', NULL, NULL, NULL, '1111111', '67104624', 2, '2000-01-05', 3, 1),
(101, 'Agustin', 'Saavedra', 'agustin@gmail.com', 'repartidor1.jpg', '$2y$10$9PSgMby/iaHJ9bKlOJT1YOn9zd97CfWgAHFDUEBvnZWZYuq.EBdr.', NULL, NULL, NULL, '7766554', '67104624', 1, '2000-06-10', 3, 1),
(102, 'Mario', 'Delgadillo', 'mario@gmail.com', 'repartidor1.jpg', '$2y$10$4THFuF.V5UnMyCPQkSIvR.OA8KqfRc0gHaYEsTnWrjSu.WYxDyh9O', NULL, NULL, NULL, '7766554', '67104624', 1, '1999-06-19', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioempresa`
--

DROP TABLE IF EXISTS `usuarioempresa`;
CREATE TABLE IF NOT EXISTS `usuarioempresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` bigint(20) UNSIGNED NOT NULL,
  `idempresa` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idusuario` (`idusuario`),
  KEY `idempresa` (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarioempresa`
--

INSERT INTO `usuarioempresa` (`id`, `idusuario`, `idempresa`, `estado`) VALUES
(47, 86, 1, NULL),
(48, 88, 1, NULL),
(51, 93, 1, NULL),
(53, 98, 1, NULL),
(54, 99, 7, NULL),
(55, 102, 2, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bitacora_ibfk_2` FOREIGN KEY (`idtipobitacora`) REFERENCES `tipobitacora` (`id`);

--
-- Filtros para la tabla `cobro`
--
ALTER TABLE `cobro`
  ADD CONSTRAINT `cobro_ibfk_1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cobro_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `FK_detallepedido_pedido` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_detallepedido_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idrepartidor`) REFERENCES `repartidor` (`id`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idsubcategoria`) REFERENCES `subcategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `repartidor`
--
ALTER TABLE `repartidor`
  ADD CONSTRAINT `repartidor_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repartidor_ibfk_2` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `revision`
--
ALTER TABLE `revision`
  ADD CONSTRAINT `revision_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `revision_ibfk_2` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_accion`
--
ALTER TABLE `rol_accion`
  ADD CONSTRAINT `rol_accion_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_accion_ibfk_2` FOREIGN KEY (`idaccion`) REFERENCES `accion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_privilegio`
--
ALTER TABLE `rol_privilegio`
  ADD CONSTRAINT `rol_privilegio_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_privilegio_ibfk_2` FOREIGN KEY (`idprivilegio`) REFERENCES `privilegio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarioempresa`
--
ALTER TABLE `usuarioempresa`
  ADD CONSTRAINT `usuarioempresa_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarioempresa_ibfk_2` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarioempresa_ibfk_3` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarioempresa_ibfk_4` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE detallepedido ADD calificado TINYINT (4) DEFAULT 0 ;
ALTER TABLE detallepedido ADD promedio decimal(6,2) null;
ALTER TABLE detallepedido ADD calificacion VARCHAR(255) null ;
ALTER TABLE detallepedido ADD comentario TEXT null;

