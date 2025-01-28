-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2025 a las 22:47:55
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
-- Base de datos: `gestio_equipos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenamiento`
--

CREATE TABLE `almacenamiento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacenamiento`
--

INSERT INTO `almacenamiento` (`id`, `nombre`) VALUES
(1, '215'),
(2, '250'),
(3, '500'),
(4, '1000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` varchar(10) NOT NULL,
  `id_modelo` int(11) DEFAULT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `id_procesador` int(11) DEFAULT NULL,
  `id_almacenamiento` int(11) DEFAULT NULL,
  `id_ram` int(11) DEFAULT NULL,
  `id_grafica` int(11) DEFAULT NULL,
  `id_windows` int(11) DEFAULT NULL,
  `windows_licencia` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `id_modelo`, `serial`, `id_procesador`, `id_almacenamiento`, `id_ram`, `id_grafica`, `id_windows`, `windows_licencia`, `foto`, `fecha_compra`) VALUES
('PCAI-001', 1, '58M66W3', 1, 1, 1, 1, 1, 'NA', 'views/fotos/VOSTRO.jpg', '0000-00-00'),
('PCAI-002', 3, 'PF46GGK7', 2, 3, 1, 2, 1, '0BWUJ-7649V-PP5XZ-1ANPY-XXWHZ', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-003', 4, 'PF0L2AUB', 3, 3, 1, 1, 1, 'NA', 'views/fotos/Thinkpad E340.jpg', '0000-00-00'),
('PCAI-004', 3, 'PF3JER8S', 4, 3, 1, 2, 1, 'AOCJ7-R3XMH-2WKF6-P3KTX-5WF6S', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-005', 11, 'N6N0CX00B00922C', 5, 2, 1, 4, 1, 'NA', 'views/fotos/X415JA.jpg', '0000-00-00'),
('PCAI-007', 17, '5CD7020354', 6, 3, 2, 1, 1, '0URT2-BMEF9-3WRC4-MIC0F-6L8VC', 'views/fotos/HP ProBook 440 G3.jpg', '0000-00-00'),
('PCAI-008', 3, 'PF3XVY7F', 5, 2, 1, 1, 1, 'K1LGS-R33YK-QTUBV-YELFZ-09RP1', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-009', 11, 'NCN0CX03140350A', 5, 4, 1, 4, 1, 'MDUYV-39ATA-PIPS3-SM14E-KH6F2', 'views/fotos/X415JA.jpg', '0000-00-00'),
('PCAI-010', 11, 'N6N0CX02336223B', 1, 2, 1, 4, 2, 'NA', 'views/fotos/X415JA.jpg', '0000-00-00'),
('PCAI-011', 3, 'PF3JEP2Z', 4, 3, 1, 2, 1, 'MSGPE-ZZB0D-UU975-TC5E9-PAL5H', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-013', 11, 'R3N0CX01J725102', 5, 4, 1, 4, 1, 'NA', 'views/fotos/X415JA.jpg', '0000-00-00'),
('PCAI-014', 11, 'R3N0CX01J72510', 5, 4, 1, 1, 1, 'A4U6Y-98LTV-RQFH0-7WJUR-YSFLU', 'views/fotos/X415JA.jpg', '0000-00-00'),
('PCAI-015', 1, '5YP66W3', 5, 3, 1, 1, 1, 'TW9NH-Z7L7I-1ZFBI-SSDTR-BJA9Z', 'views/fotos/VOSTRO.jpg', '0000-00-00'),
('PCAI-016', 11, 'M7N0CX14T407299', 5, 2, 1, 1, 1, 'VEWYY-9FPYA-2UDBA-MCBXP-LRPET', 'views/fotos/X415JA.jpg', '0000-00-00'),
('PCAI-017', 17, '5CD618740L', 7, 1, 1, 1, 1, 'NA', 'views/fotos/HP EliteBook 1040 G31.png', '0000-00-00'),
('PCAI-018', 19, 'R8N0CV18439534A', 8, 3, 1, 1, 1, 'NA', 'views/fotos/X415JA.jpg', '0000-00-00'),
('PCAI-019', 3, 'R8N0CV184431349', 8, 3, 1, 4, 1, '9ERJ7-E9QSZ-3TEFG-8TNXL-32GFR', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-021', 16, '5CD304103X', 15, 3, 2, 4, 1, 'NA', 'views/fotos/Laptop 15-ef2500la.jfif', '0000-00-00'),
('PCAI-022', 7, 'PC0GYVZ1', 1, 3, 2, 4, 1, 'NA', 'views/fotos/ThinkPad X260.jpg', '0000-00-00'),
('PCAI-025', 3, 'PF4Q9Y76', 4, 2, 1, 2, 1, 'NA', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-026', 8, 'NA', 4, 3, 1, 2, 1, '7N7LU-QRZQT-KBVAZ-YIQ6L-FR5QP', 'views/fotos/IdeaPad 1s.jpg', '0000-00-00'),
('PCAI-027', 8, 'PF4N8ZEL', 12, 2, 2, 2, 1, 'C56N6-0F84B-T0K1R-QZOD0-ID1WN', 'views/fotos/IdeaPad 1s.jpg', '0000-00-00'),
('PCAI-028', 3, 'NA', 4, 2, 2, 2, 1, 'NA', 'views/fotos/IdeaPad 3.png', '2024-08-15'),
('PCAI-029', 3, 'X2A96182114820', 2, 2, 2, 2, 1, '8LSD2-ABDZU-CBHLY-RVSMB-MF91K', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-030', 3, 'X2A96182114887', 14, 2, 2, 1, 1, '1NQX0-8K4B3-QAV6S-KZ56K-Y6KBY', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-031', 3, '32K96538301947', 2, 2, 2, 2, 1, 'T5CC9-DPUAT-WQJYD-X2Y7R-OR3R0', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-033', 3, 'X2A96182114893', 4, 2, 2, 2, 1, 'NA', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-034', 3, 'PF4SCV17', 15, 3, 2, 2, 1, 'NA', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-035', 3, 'PF9XB4129', 12, 2, 2, 2, 1, 'E59LQ-HHQAY-ZDMY5-60S1C-8LFUI', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-036', 3, 'NA', 2, 2, 2, 2, 1, 'E5WYZ-XPNJQ-6K07Q-7GHJT-NSYB5', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-037', 3, 'PF9XB4303261', 2, 2, 2, 2, 1, 'TY6DB-BCDD2-MT43N-DXFWI-THYUL', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-038', 10, 'S2NRCX03H688089', 16, 3, 2, 1, 1, 'NA', 'views/fotos/TUF FX507Z.jpg', '0000-00-00'),
('PCAI-039', 3, 'PF9XB4303261', 2, 2, 2, 2, 1, 'NA', 'views/fotos/IdeaPad 3.png', '0000-00-00'),
('PCAI-040', 20, 'PFL4LTPSL', 2, 3, 4, 2, 1, 'NA', 'views/fotos/V14 G4 AMN.jpg', '0000-00-00'),
('PCAI-041', 9, 'PW06YNHT', 8, 2, 1, 4, 1, 'NA', 'views/fotos/IdeaPad flex 5.jpg', '0000-00-00'),
('PCAI-042', 19, 'NA', 14, 3, 2, 1, 1, 'NA', 'views/fotos/LOQ1.png', '0000-00-00'),
('PCAI-043', 18, 'MP2MMVT3', 14, 3, 2, 5, 1, 'NA', 'views/fotos/LOQ.jpg', '0000-00-00'),
('PCAI-044', 1, 'NA', 1, 1, 1, 1, 1, 'NA', '', '0000-00-00'),
('PCAI-045', 1, '58M66W3', 5, 2, 1, 4, 1, 'NA', 'views/fotos/VOSTRO.jpg', '0000-00-00'),
('PCAI-046', 18, 'MP2M1XQB', 14, 3, 2, 5, 1, 'NA', 'views/fotos/LOQ1.png', '0000-00-00'),
('PCAI-047', 3, 'NA', 2, 2, 1, 2, 1, 'NA', 'views/fotos/IdeaPad 3.png', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_usuario`
--

CREATE TABLE `equipo_usuario` (
  `cedula` int(11) NOT NULL,
  `id_equipo` varchar(10) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `acta_entrega` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipo_usuario`
--

INSERT INTO `equipo_usuario` (`cedula`, `id_equipo`, `fecha_entrega`, `id_estado`, `acta_entrega`) VALUES
(3, 'PCAI-010', '0000-00-00', 1, ''),
(4, 'PCAI-039', '2024-07-29', 1, 'ACM-ADM-FO-048 CONTRATO DE APRENDIZAJE (2) (1).pdf'),
(6, 'PCAI-004', '2022-10-15', 1, ''),
(7, 'PCAI-011', '2024-05-12', 1, ''),
(8, 'PCAI-002', '2023-04-04', 1, ''),
(9, 'PCAI-027', '2024-04-30', 1, ''),
(10, 'PCAI-033', '0000-00-00', 1, ''),
(11, 'PCAI-036', '2023-10-16', 1, ''),
(12, 'PCAI-046', '2024-08-13', 1, ''),
(13, 'PCAI-043', '2024-08-07', 1, ''),
(14, 'PCAI-015', '2023-10-18', 1, ''),
(15, 'PCAI-042', '2024-08-08', 1, ''),
(16, 'PCAI-016', '2023-11-15', 1, ''),
(18, 'PCAI-038', '2024-07-23', 1, ''),
(19, 'PCAI-013', '2024-01-18', 1, ''),
(20, 'PCAI-014', '2024-04-18', 1, ''),
(21, 'PCAI-019', '2024-02-19', 1, ''),
(22, 'PCAI-003', '2024-03-19', 1, ''),
(23, 'PCAI-009', '2024-04-01', 1, ''),
(24, 'PCAI-021', '2024-04-22', 1, ''),
(25, 'PCAI-030', '2024-04-22', 1, ''),
(27, 'PCAI-026', '2024-04-20', 1, ''),
(28, 'PCAI-018', '0000-00-00', 1, ''),
(29, 'PCAI-035', '2024-03-01', 1, ''),
(30, 'PCAI-022', '0000-00-00', 1, ''),
(31, 'PCAI-029', '2024-04-29', 1, ''),
(32, 'PCAI-031', '2024-08-08', 1, ''),
(33, 'PCAI-034', '2024-06-05', 1, ''),
(34, 'PCAI-041', '2024-08-15', 1, ''),
(36, 'PCAI-007', '2024-06-25', 1, ''),
(37, 'PCAI-037', '2024-07-20', 1, ''),
(38, 'PCAI-040', '0000-00-00', 1, ''),
(39, 'PCAI-025', '0000-00-00', 1, ''),
(40, 'PCAI-047', '2024-08-01', 1, ''),
(41, 'PCAI-008', '2024-08-15', 1, ''),
(48, 'PCAI-028', '2024-09-03', 1, NULL),
(49, 'PCAI-001', '0000-00-00', 1, ''),
(49, 'PCAI-005', '2024-02-07', 1, ''),
(51, 'PCAI-045', '2024-08-28', 1, ''),
(52, 'PCAI-017', '0000-00-00', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `estado`) VALUES
(1, 'Bueno'),
(2, 'Malo'),
(3, 'Fuera de Uso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grafica`
--

CREATE TABLE `grafica` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grafica`
--

INSERT INTO `grafica` (`id`, `nombre`) VALUES
(1, 'Intel Iris Xe Graphics\r\n'),
(2, 'AMD Radeon Graphics\r\n'),
(3, 'Intel HD Graphics 520\r\n'),
(4, 'Intel UHD Graphics\r\n'),
(5, 'RTX 3050');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_equipo_usuario` varchar(10) DEFAULT NULL,
  `tipo_mantenimiento` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `foro` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`) VALUES
(1, 'LENOVO'),
(2, 'ASUS'),
(3, 'DELL'),
(4, 'HP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id`, `id_marca`, `nombre`) VALUES
(1, 3, 'VOSTRO 14 3000'),
(2, 3, 'Inspiron 3480'),
(3, 1, 'IdeaPad 3'),
(4, 1, 'Thinkpad E340'),
(5, 1, 'V310-14ISK 80SX'),
(6, 1, '310-14ISK'),
(7, 1, 'ThinkPad X260'),
(8, 1, 'IdeaPad 1s'),
(9, 1, 'IdeaPad flex 5'),
(10, 1, 'TUF'),
(11, 2, 'X415JA'),
(12, 2, 'ASUS X415JA'),
(13, 2, 'X515EA'),
(14, 2, 'ASUS TUF Gaming FX505DT'),
(15, 4, 'HP ProBook 440 G3'),
(16, 4, 'Laptop 15-ef2500la'),
(17, 4, 'HP EliteBook 1040 G3'),
(18, 1, 'LOQ'),
(19, 2, 'Vivobook'),
(20, 1, 'V14 G4 AMN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesador`
--

CREATE TABLE `procesador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesador`
--

INSERT INTO `procesador` (`id`, `nombre`) VALUES
(1, 'Core i5-1135G7\r\n'),
(2, 'Ryzen 5 5500U\r\n'),
(3, 'Core i5-6200U\r\n'),
(4, 'Ryzen 3 5300U\r\n'),
(5, 'Core i5-1035G1\r\n'),
(6, 'Core i7-6500U\r\n'),
(7, 'Core i7-6600U\r\n'),
(8, 'Core i3-1115G4\r\n'),
(9, 'Ryzen 7 5700U\r\n'),
(10, 'Core I7 6700\r\n'),
(11, 'Core i5 '),
(12, 'Ryzen 5 7520U\r\n'),
(13, 'Core i3 1315U'),
(14, 'Ryzen 7 Series'),
(15, 'Ryzen 7 7000'),
(16, 'Core i5 12500H');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietario`
--

CREATE TABLE `propietario` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propietario`
--

INSERT INTO `propietario` (`cedula`, `nombre`, `apellido`, `cargo`, `foto`) VALUES
(1, 'Alejandro', 'Zapata Ferraro', 'Gerente general', 'views/fotosPropietarios/acemaUser.jpeg'),
(2, 'Winder Enrique', 'Juarez Ortíz', 'Gerente de ingeniería', 'views/fotosPropietarios/acemaUser.jpeg'),
(3, 'Natalia', 'Villegas Aguirre', 'Dirección de proyectos', 'views/fotosPropietarios/acemaUser.jpeg'),
(4, 'Jonathan', 'Molano Correa', 'Ingeniero de diseño', 'views/fotosPropietarios/acemaUser.jpeg'),
(5, 'Mariana', 'Agudelo Varela', 'Gerencia administrativa y de calidad', 'views/fotosPropietarios/acemaUser.jpeg'),
(6, 'Anyi Natalia', 'Ochoa Blanco', 'Auxiliar de ingeniería', 'views/fotosPropietarios/acemaUser.jpeg'),
(7, 'Felipe', 'Gutiérrez Zapata', 'Coordinador de proyectos', 'views/fotosPropietarios/acemaUser.jpeg'),
(8, 'Kevin Smit', 'Montes Villa', 'Ingeniero de diseño', 'views/fotosPropietarios/acemaUser.jpeg'),
(9, 'Yuliana', 'David Jaramillo', 'Auxiliar de compras', 'views/fotosPropietarios/acemaUser.jpeg'),
(10, 'Duvan Esteban', 'Muñoz Ordoñez', 'Ingeniero de diseño', 'views/fotosPropietarios/acemaUser.jpeg'),
(11, 'Michael', 'Zapata Monsalve', 'Auxiliar de ingeniería', 'views/fotosPropietarios/acemaUser.jpeg'),
(12, 'Miguel Ángel', 'Toro Ruiz', 'Auxiliar de ingeniería', 'views/fotosPropietarios/acemaUser.jpeg'),
(13, 'Alejandro', 'Rivera Pérez', 'Auxiliar de ingeniería', 'views/fotosPropietarios/acemaUser.jpeg'),
(14, 'Mateo', 'Sepúlveda Zapata', 'Ingeniero de diseño', 'views/fotosPropietarios/acemaUser.jpeg'),
(15, 'Santiago', 'Ríos Rueda', 'Ingeniero de diseño', 'views/fotosPropietarios/acemaUser.jpeg'),
(16, 'Leonardo', 'Londoño Oquendo', 'Ingeniero de diseño', 'views/fotosPropietarios/acemaUser.jpeg'),
(17, 'María Doralba', 'Agudelo Taborda', 'Auxiliar de servicios generales', 'views/fotosPropietarios/acemaUser.jpeg'),
(18, 'Carlos Alberto', 'Vásquez Serrano', 'Ingeniero de diseño', 'views/fotosPropietarios/acemaUser.jpeg'),
(19, 'Andrés Felipe', 'Arroyave Arias', 'Practicante de Ingeniería', 'views/fotosPropietarios/acemaUser.jpeg'),
(20, 'María Fernanda', 'Florez Ruiz', 'Directora Financiera', 'views/fotosPropietarios/acemaUser.jpeg'),
(21, 'Leidy Daniela', 'Ruiz Zapata', 'Directora de Talento humano', 'views/fotosPropietarios/acemaUser.jpeg'),
(22, 'Jorge Andrés', 'Toro Córdoba', 'Ingeniero de diseño', 'views/fotosPropietarios/acemaUser.jpeg'),
(23, 'Brayan Stiven', 'Rodríguez Duque', 'Profesional de ofertas', 'views/fotosPropietarios/acemaUser.jpeg'),
(24, 'Carlos Alfredo', 'Ruales Pantoja', 'Ingeniero de diseño civil', 'views/fotosPropietarios/acemaUser.jpeg'),
(25, 'Johny Ferney', 'Londoño Giraldo', 'Diseñador de ingeniería', 'views/fotosPropietarios/acemaUser.jpeg'),
(26, 'Edilson Justino', 'Sierra Carreño', 'Ingeniero eléctrico de proyectos', 'views/fotosPropietarios/acemaUser.jpeg'),
(27, 'Lady Johanna', 'Gonzalez Álvarez', 'Gerente comercial - Región Caribe', 'views/fotosPropietarios/acemaUser.jpeg'),
(28, 'Natalia', 'Restrepo Marín', 'Coordinadora SGI', 'views/fotosPropietarios/acemaUser.jpeg'),
(29, 'Santiago', 'Montoya Marín', 'Analista TI', 'views/fotosPropietarios/acemaUser.jpeg'),
(30, 'David Camilo', 'Osorio Arias', 'Ingeniero civil de proyectos', 'views/fotosPropietarios/acemaUser.jpeg'),
(31, 'Maria José', 'Sierra Barrios', 'Profesional de ofertas', 'views/fotosPropietarios/acemaUser.jpeg'),
(32, 'Valentina', 'Arango Barrada', 'Directora de compras', 'views/fotosPropietarios/acemaUser.jpeg'),
(33, 'Julian Andrés', 'Rendón Ardila', 'Gerente de proyectos', 'views/fotosPropietarios/acemaUser.jpeg'),
(34, 'Yhorgen Andrés', 'Carvajal Naranjo', 'Auxiliar de compras', 'views/fotosPropietarios/acemaUser.jpeg'),
(36, 'John Esleyder', 'Cardona Lopez', 'Practicante de proyectos', 'views/fotosPropietarios/acemaUser.jpeg'),
(37, 'Duvian Alejandro', 'Gallo Vergara', 'Auxiliar de ingeniería', 'views/fotosPropietarios/acemaUser.jpeg'),
(38, 'Daniela', 'Tobon', 'Directora Financiera', 'views/fotosPropietarios/acemaUser.jpeg'),
(39, 'Diego', 'Otalvaro', 'Auxiliar de Proyectos', 'views/fotosPropietarios/acemaUser.jpeg'),
(40, 'Madeleyn Giseth', 'Ramirez Loaiza', 'Diseñadora Grafica', 'views/fotosPropietarios/acemaUser.jpeg'),
(41, 'Maria Jose', 'Santodomingo', 'Analista de Logistica e Inventario', 'views/fotosPropietarios/acemaUser.jpeg'),
(43, '', '', '', 'views/fotosPropietarios/acemaUser.jpeg'),
(48, 'Miguel Angel ', 'Largo Gutierrez', 'Practicante Desarrollo Software', 'views/fotosPropietarios/acemaUser.jpeg'),
(49, 'Reserva', 'Reserva', 'NA', 'views/fotosPropietarios/Reserva_Reserva_acemaUser.jpeg'),
(50, 'Lina Maria', 'Panessco', '--', 'views/fotosPropietarios/Lina Maria_Panessco_acemaUser.jpeg'),
(51, 'CONEXONISTAS', 'GENERAL', 'CONEXIONISTAS', 'views/fotosPropietarios/CONEXONISTAS_GENERAL_acemaUser.jpeg'),
(52, 'SUPERVISOR', 'HSEQ', 'SUPERVISOR', 'views/fotosPropietarios/SUPERVISOR_HSEQ_acemaUser.jpeg'),
(53, 'Amanda', 'Querida', 'Ventas', 'views/fotosPropietarios/Amanda_Querida_acemaUser.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ram`
--

CREATE TABLE `ram` (
  `id` int(11) NOT NULL,
  `valor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ram`
--

INSERT INTO `ram` (`id`, `valor`) VALUES
(1, '8'),
(2, '16'),
(3, '32'),
(4, '12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mantenimiento`
--

CREATE TABLE `tipo_mantenimiento` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_mantenimiento`
--

INSERT INTO `tipo_mantenimiento` (`id`, `tipo`) VALUES
(1, 'Preventivo'),
(2, 'correctivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `windows`
--

CREATE TABLE `windows` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `windows`
--

INSERT INTO `windows` (`id`, `nombre`) VALUES
(1, 'Windows 10'),
(2, 'Windows 11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenamiento`
--
ALTER TABLE `almacenamiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_modelo` (`id_modelo`),
  ADD KEY `id_procesador` (`id_procesador`),
  ADD KEY `id_almacenamiento` (`id_almacenamiento`),
  ADD KEY `id_ram` (`id_ram`),
  ADD KEY `id_grafica` (`id_grafica`),
  ADD KEY `id_windows` (`id_windows`);

--
-- Indices de la tabla `equipo_usuario`
--
ALTER TABLE `equipo_usuario`
  ADD PRIMARY KEY (`cedula`,`id_equipo`),
  ADD KEY `id_equipo` (`id_equipo`),
  ADD KEY `fk_estado` (`id_estado`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grafica`
--
ALTER TABLE `grafica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_equipo_usuario` (`id_equipo_usuario`),
  ADD KEY `tipo_mantenimiento` (`tipo_mantenimiento`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `procesador`
--
ALTER TABLE `procesador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_mantenimiento`
--
ALTER TABLE `tipo_mantenimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `windows`
--
ALTER TABLE `windows`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenamiento`
--
ALTER TABLE `almacenamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `grafica`
--
ALTER TABLE `grafica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `procesador`
--
ALTER TABLE `procesador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `propietario`
--
ALTER TABLE `propietario`
  MODIFY `cedula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `ram`
--
ALTER TABLE `ram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_mantenimiento`
--
ALTER TABLE `tipo_mantenimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `windows`
--
ALTER TABLE `windows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`id_modelo`) REFERENCES `modelo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `equipo_ibfk_2` FOREIGN KEY (`id_procesador`) REFERENCES `procesador` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `equipo_ibfk_3` FOREIGN KEY (`id_almacenamiento`) REFERENCES `almacenamiento` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `equipo_ibfk_4` FOREIGN KEY (`id_ram`) REFERENCES `ram` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `equipo_ibfk_5` FOREIGN KEY (`id_grafica`) REFERENCES `grafica` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `equipo_ibfk_7` FOREIGN KEY (`id_windows`) REFERENCES `windows` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `equipo_usuario`
--
ALTER TABLE `equipo_usuario`
  ADD CONSTRAINT `equipo_usuario_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `propietario` (`cedula`) ON DELETE CASCADE,
  ADD CONSTRAINT `equipo_usuario_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `mantenimiento_ibfk_1` FOREIGN KEY (`id_equipo_usuario`) REFERENCES `equipo_usuario` (`id_equipo`) ON DELETE CASCADE,
  ADD CONSTRAINT `mantenimiento_ibfk_2` FOREIGN KEY (`tipo_mantenimiento`) REFERENCES `tipo_mantenimiento` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
