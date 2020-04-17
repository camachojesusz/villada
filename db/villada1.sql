-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2020 a las 06:34:50
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `villada1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_arrival`
--

DROP TABLE IF EXISTS `ia_arrival`;
CREATE TABLE `ia_arrival` (
  `id_arrival` int(10) UNSIGNED NOT NULL,
  `sheet_arrival` text DEFAULT NULL,
  `supply_arrival` int(10) UNSIGNED DEFAULT NULL,
  `date_arrival` timestamp NOT NULL DEFAULT current_timestamp(),
  `boxes_arrival` int(10) UNSIGNED DEFAULT NULL,
  `weight_arrival` double UNSIGNED DEFAULT NULL,
  `type_destare` enum('0','1') DEFAULT '0',
  `val_destare` float DEFAULT NULL,
  `destare_arrival` float UNSIGNED DEFAULT NULL,
  `totalweight_arrival` float UNSIGNED DEFAULT NULL,
  `status_classify` enum('0','1','2') NOT NULL DEFAULT '0',
  `merma_arrival` float DEFAULT NULL,
  `observe_arrival` text DEFAULT NULL,
  `status_arrival` enum('0','1') NOT NULL DEFAULT '1',
  `iduser_arrival` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_category`
--

DROP TABLE IF EXISTS `ia_category`;
CREATE TABLE `ia_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `description_c` text DEFAULT NULL,
  `add_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ia_category`
--

INSERT INTO `ia_category` (`category_id`, `description_c`, `add_timestamp`, `status`, `user_id`) VALUES
(1, '', '2020-03-23 18:53:43', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_classify`
--

DROP TABLE IF EXISTS `ia_classify`;
CREATE TABLE `ia_classify` (
  `classify_id` int(10) UNSIGNED NOT NULL,
  `arrival_id` int(10) UNSIGNED NOT NULL,
  `product_size_id` int(10) UNSIGNED DEFAULT NULL,
  `boxes_c` int(10) UNSIGNED DEFAULT NULL,
  `weight_c` float UNSIGNED DEFAULT NULL,
  `type_destare` enum('0','1') DEFAULT '0',
  `val_destare` float UNSIGNED NOT NULL,
  `destare_c` float UNSIGNED DEFAULT NULL,
  `total_weight_c` float UNSIGNED DEFAULT NULL,
  `add_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_clone_arrival`
--

DROP TABLE IF EXISTS `ia_clone_arrival`;
CREATE TABLE `ia_clone_arrival` (
  `id_arrival` int(10) UNSIGNED NOT NULL,
  `sheet_arrival` text DEFAULT NULL,
  `supply_arrival` int(10) UNSIGNED DEFAULT NULL,
  `date_arrival` timestamp NOT NULL DEFAULT current_timestamp(),
  `boxes_arrival` int(10) UNSIGNED DEFAULT NULL,
  `weight_arrival` double UNSIGNED DEFAULT NULL,
  `type_destare` enum('0','1') DEFAULT '0',
  `val_destare` float DEFAULT NULL,
  `destare_arrival` float UNSIGNED DEFAULT NULL,
  `totalweight_arrival` float UNSIGNED DEFAULT NULL,
  `status_classify` enum('0','1','2') NOT NULL DEFAULT '0',
  `merma_arrival` float DEFAULT NULL,
  `observe_arrival` text DEFAULT NULL,
  `status_arrival` enum('0','1') NOT NULL DEFAULT '1',
  `iduser_arrival` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_destiny`
--

DROP TABLE IF EXISTS `ia_destiny`;
CREATE TABLE `ia_destiny` (
  `destiny_id` int(10) UNSIGNED NOT NULL,
  `description_d` text NOT NULL,
  `type_destare` enum('0','1') DEFAULT '0',
  `destare` float UNSIGNED DEFAULT NULL,
  `street` text DEFAULT NULL,
  `numint` varchar(10) DEFAULT NULL,
  `numext` varchar(10) DEFAULT NULL,
  `local` text DEFAULT NULL,
  `muni` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `postal_code` varchar(5) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `add_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_driver`
--

DROP TABLE IF EXISTS `ia_driver`;
CREATE TABLE `ia_driver` (
  `driver_id` int(10) UNSIGNED NOT NULL,
  `sheet_licence` text NOT NULL,
  `type_licence` text NOT NULL,
  `experiencie_drive` varchar(5) DEFAULT NULL,
  `name` text NOT NULL,
  `ap1` text NOT NULL,
  `ap2` text NOT NULL,
  `street` text DEFAULT NULL,
  `numint` varchar(10) DEFAULT NULL,
  `numext` varchar(10) DEFAULT NULL,
  `local` text DEFAULT NULL,
  `muni` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `postal_code` varchar(5) DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `mobile_phone` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `add_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_employee`
--

DROP TABLE IF EXISTS `ia_employee`;
CREATE TABLE `ia_employee` (
  `id_employee` int(10) UNSIGNED NOT NULL,
  `curp_employee` text NOT NULL,
  `name_employee` text NOT NULL,
  `ap1_employee` text NOT NULL,
  `ap2_employee` text NOT NULL,
  `street_employee` text DEFAULT NULL,
  `numint_employee` varchar(10) DEFAULT NULL,
  `numext_employee` varchar(10) DEFAULT NULL,
  `local_employee` text DEFAULT NULL,
  `muni_employee` text DEFAULT NULL,
  `state_employee` text DEFAULT NULL,
  `postalcode_employee` varchar(5) DEFAULT NULL,
  `phone_employee` text DEFAULT NULL,
  `cel_employee` text DEFAULT NULL,
  `email_employee` text DEFAULT NULL,
  `drivercandidate_employee` enum('0','1') NOT NULL DEFAULT '0',
  `typelicence_employee` text DEFAULT NULL,
  `sheetlicence_employee` varchar(20) DEFAULT NULL,
  `experieciedrive_employee` varchar(5) DEFAULT NULL,
  `register_employee` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_employee` enum('0','1') NOT NULL DEFAULT '1',
  `iduser_employee` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ia_employee`
--

INSERT INTO `ia_employee` (`id_employee`, `curp_employee`, `name_employee`, `ap1_employee`, `ap2_employee`, `street_employee`, `numint_employee`, `numext_employee`, `local_employee`, `muni_employee`, `state_employee`, `postalcode_employee`, `phone_employee`, `cel_employee`, `email_employee`, `drivercandidate_employee`, `typelicence_employee`, `sheetlicence_employee`, `experieciedrive_employee`, `register_employee`, `status_employee`, `iduser_employee`) VALUES
(1, 'CASJ970224HMCMNS09', 'JOSÉ DE JESÚS', 'CAMACHO', 'SÁNCHEZ', 'CALLE DEL SOL', '0', '0', 'TENANCINGO', 'TENANCINGO', 'México', '52400', '7226351114', '7226351114', 'jesus@gmail.com', '0', '', '', '', '2020-03-23 18:04:08', '1', 1),
(2, 'DIBS971108MMCZST00', 'SELENE YADIRA', 'DIAZ', 'BUSTOS', 'DE LAS FLORES', '2', '234', 'TENANCINGO', 'TENANCINGO', 'México', '52400', '7288282828', '7288282820', 'selene@yahoo.com', '1', 'tipo a', 'F-12UJS', '2', '2020-03-23 18:07:09', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_origin`
--

DROP TABLE IF EXISTS `ia_origin`;
CREATE TABLE `ia_origin` (
  `id_origin` int(10) UNSIGNED NOT NULL,
  `describe_origin` text DEFAULT NULL,
  `producer_origin` varchar(250) DEFAULT NULL,
  `location_origin` text DEFAULT NULL,
  `register_origin` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_origin` enum('0','1') NOT NULL DEFAULT '1',
  `iduser_origin` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_price`
--

DROP TABLE IF EXISTS `ia_price`;
CREATE TABLE `ia_price` (
  `id_price` int(10) UNSIGNED NOT NULL,
  `date_price` timestamp NOT NULL DEFAULT current_timestamp(),
  `vality_price` enum('0','1') NOT NULL DEFAULT '1',
  `product_price` int(10) UNSIGNED DEFAULT NULL,
  `size_price` int(10) UNSIGNED DEFAULT NULL,
  `value_price` double NOT NULL,
  `iduser_price` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_producer`
--

DROP TABLE IF EXISTS `ia_producer`;
CREATE TABLE `ia_producer` (
  `id_producer` int(10) UNSIGNED NOT NULL,
  `noctrl_producer` varchar(8) NOT NULL,
  `noctrl_e_producer` varchar(250) NOT NULL,
  `document_producer` enum('0','1') DEFAULT NULL,
  `describedocument_producer` text DEFAULT NULL,
  `describe_producer` text NOT NULL,
  `name_producer` text NOT NULL,
  `ap1_producer` text NOT NULL,
  `ap2_producer` text NOT NULL,
  `street_producer` text DEFAULT NULL,
  `numint_producer` varchar(5) DEFAULT NULL,
  `numext_producer` varchar(5) DEFAULT NULL,
  `local_producer` text DEFAULT NULL,
  `muni_producer` text DEFAULT NULL,
  `state_producer` text DEFAULT NULL,
  `postalcode_producer` varchar(5) DEFAULT NULL,
  `phone_producer` text DEFAULT NULL,
  `cel_producer` text DEFAULT NULL,
  `email_producer` text DEFAULT NULL,
  `register_producer` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_producer` enum('0','1') NOT NULL DEFAULT '1',
  `iduser_producer` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_product`
--

DROP TABLE IF EXISTS `ia_product`;
CREATE TABLE `ia_product` (
  `id_product` int(10) UNSIGNED NOT NULL,
  `key_product` text NOT NULL,
  `keycontrol_product` varchar(5) DEFAULT NULL,
  `describe_product` text DEFAULT NULL,
  `character_product` text DEFAULT NULL,
  `ctrl_size` set('0','1') NOT NULL,
  `register_product` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_product` enum('0','1') NOT NULL DEFAULT '1',
  `iduser_product` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_product_size`
--

DROP TABLE IF EXISTS `ia_product_size`;
CREATE TABLE `ia_product_size` (
  `product_size_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `quality_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `add_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_ps` enum('0','1') NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_profile`
--

DROP TABLE IF EXISTS `ia_profile`;
CREATE TABLE `ia_profile` (
  `id_profile` int(10) UNSIGNED NOT NULL,
  `describe_profile` set('A','C','V','L') DEFAULT NULL,
  `character_profile` text DEFAULT NULL,
  `register_profile` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_profile` enum('0','1') NOT NULL DEFAULT '1',
  `iduser_profile` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ia_profile`
--

INSERT INTO `ia_profile` (`id_profile`, `describe_profile`, `character_profile`, `register_profile`, `status_profile`, `iduser_profile`) VALUES
(1, 'A', 'ADMINISTRADOR', '2020-03-23 18:02:02', '1', 1),
(2, 'C', 'COMPRAS', '2020-03-23 18:02:02', '1', 1),
(3, 'V', 'VENTAS', '2020-03-23 18:02:02', '1', 1),
(4, 'L', 'LOGISTICA', '2020-03-23 18:02:02', '1', 1),
(5, 'C,V', 'COMPRAS Y VENTAS', '2020-03-23 18:02:02', '1', 1),
(6, 'C,L', 'COMPRAS Y LOGISTICA', '2020-03-23 18:02:02', '1', 1),
(7, 'V,L', 'VENTAS Y LOGISTICA', '2020-03-23 18:02:02', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_quality`
--

DROP TABLE IF EXISTS `ia_quality`;
CREATE TABLE `ia_quality` (
  `quality_id` int(10) UNSIGNED NOT NULL,
  `description_q` text DEFAULT NULL,
  `add_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ia_quality`
--

INSERT INTO `ia_quality` (`quality_id`, `description_q`, `add_timestamp`, `status`, `user_id`) VALUES
(1, '', '2020-03-23 18:54:36', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_size_box`
--

DROP TABLE IF EXISTS `ia_size_box`;
CREATE TABLE `ia_size_box` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `destare_value` float DEFAULT NULL,
  `default_value` enum('0','1') NOT NULL DEFAULT '0',
  `add_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_states`
--

DROP TABLE IF EXISTS `ia_states`;
CREATE TABLE `ia_states` (
  `id` int(10) UNSIGNED NOT NULL,
  `inegi_id` varchar(2) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `abrev` varchar(10) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `add_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ia_states`
--

INSERT INTO `ia_states` (`id`, `inegi_id`, `name`, `abrev`, `status`, `add_timestamp`, `user_id`) VALUES
(1, '01', 'Aguascalientes', 'Ags.', '1', '2020-03-17 04:27:54', 1),
(2, '02', 'Baja California', 'BC', '1', '2020-03-17 04:27:54', 1),
(3, '03', 'Baja California Sur', 'BCS', '1', '2020-03-17 04:27:54', 1),
(4, '04', 'Campeche', 'Camp.', '1', '2020-03-17 04:27:54', 1),
(5, '05', 'Coahuila de Zaragoza', 'Coah.', '1', '2020-03-17 04:27:54', 1),
(6, '06', 'Colima', 'Col.', '1', '2020-03-17 04:27:54', 1),
(7, '07', 'Chiapas', 'Chis.', '1', '2020-03-17 04:27:54', 1),
(8, '08', 'Chihuahua', 'Chih.', '1', '2020-03-17 04:27:54', 1),
(9, '09', 'Ciudad de México', 'CDMX', '1', '2020-03-17 04:27:54', 1),
(10, '10', 'Durango', 'Dgo.', '1', '2020-03-17 04:27:54', 1),
(11, '11', 'Guanajuato', 'Gto.', '1', '2020-03-17 04:27:54', 1),
(12, '12', 'Guerrero', 'Gro.', '1', '2020-03-17 04:27:54', 1),
(13, '13', 'Hidalgo', 'Hgo.', '1', '2020-03-17 04:27:54', 1),
(14, '14', 'Jalisco', 'Jal.', '1', '2020-03-17 04:27:54', 1),
(15, '15', 'México', 'Mex.', '1', '2020-03-17 04:27:54', 1),
(16, '16', 'Michoacán de Ocampo', 'Mich.', '1', '2020-03-17 04:27:54', 1),
(17, '17', 'Morelos', 'Mor.', '1', '2020-03-17 04:27:54', 1),
(18, '18', 'Nayarit', 'Nay.', '1', '2020-03-17 04:27:54', 1),
(19, '19', 'Nuevo León', 'NL', '1', '2020-03-17 04:27:54', 1),
(20, '20', 'Oaxaca', 'Oax.', '1', '2020-03-17 04:27:54', 1),
(21, '21', 'Puebla', 'Pue.', '1', '2020-03-17 04:27:54', 1),
(22, '22', 'Querétaro', 'Qro.', '1', '2020-03-17 04:27:54', 1),
(23, '23', 'Quintana Roo', 'Q. Roo', '1', '2020-03-17 04:27:54', 1),
(24, '24', 'San Luis Potosí', 'SLP', '1', '2020-03-17 04:27:54', 1),
(25, '25', 'Sinaloa', 'Sin.', '1', '2020-03-17 04:27:54', 1),
(26, '26', 'Sonora', 'Son.', '1', '2020-03-17 04:27:54', 1),
(27, '27', 'Tabasco', 'Tab.', '1', '2020-03-17 04:27:54', 1),
(28, '28', 'Tamaulipas', 'Tamps.', '1', '2020-03-17 04:27:54', 1),
(29, '29', 'Tlaxcala', 'Tlax.', '1', '2020-03-17 04:27:54', 1),
(30, '30', 'Veracruz de Ignacio de la Llave', 'Ver.', '1', '2020-03-17 04:27:54', 1),
(31, '31', 'Yucatán', 'Yuc.', '1', '2020-03-17 04:27:54', 1),
(32, '32', 'Zacatecas', 'Zac.', '1', '2020-03-17 04:27:54', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_supply`
--

DROP TABLE IF EXISTS `ia_supply`;
CREATE TABLE `ia_supply` (
  `id_supply` int(10) UNSIGNED NOT NULL,
  `origin_supply` int(10) UNSIGNED DEFAULT NULL,
  `product_supply` int(10) UNSIGNED DEFAULT NULL,
  `register_supply` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_supply` enum('0','1') NOT NULL DEFAULT '1',
  `iduser_supply` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_users`
--

DROP TABLE IF EXISTS `ia_users`;
CREATE TABLE `ia_users` (
  `id_users` int(10) UNSIGNED NOT NULL,
  `username_users` text DEFAULT NULL,
  `userpass_users` varchar(30) DEFAULT NULL,
  `employee_users` int(10) UNSIGNED DEFAULT NULL,
  `profile_users` int(10) UNSIGNED DEFAULT NULL,
  `register_users` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_users` enum('0','1') NOT NULL DEFAULT '1',
  `iduser_users` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ia_users`
--

INSERT INTO `ia_users` (`id_users`, `username_users`, `userpass_users`, `employee_users`, `profile_users`, `register_users`, `status_users`, `iduser_users`) VALUES
(1, 'admin', '1234567890', 1, 1, '2020-03-23 18:04:08', '1', 1),
(2, 'selene', '1234567890', 2, 1, '2020-03-23 18:07:10', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_vehicle`
--

DROP TABLE IF EXISTS `ia_vehicle`;
CREATE TABLE `ia_vehicle` (
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `key_v` text DEFAULT NULL,
  `description_v` text DEFAULT NULL,
  `vehicle_type` int(10) UNSIGNED NOT NULL,
  `add_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ia_vehicle_type`
--

DROP TABLE IF EXISTS `ia_vehicle_type`;
CREATE TABLE `ia_vehicle_type` (
  `vt_id` int(10) UNSIGNED NOT NULL,
  `description_vt` text DEFAULT NULL,
  `add_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ia_arrival`
--
ALTER TABLE `ia_arrival`
  ADD PRIMARY KEY (`id_arrival`);

--
-- Indices de la tabla `ia_category`
--
ALTER TABLE `ia_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indices de la tabla `ia_classify`
--
ALTER TABLE `ia_classify`
  ADD PRIMARY KEY (`classify_id`);

--
-- Indices de la tabla `ia_clone_arrival`
--
ALTER TABLE `ia_clone_arrival`
  ADD PRIMARY KEY (`id_arrival`);

--
-- Indices de la tabla `ia_destiny`
--
ALTER TABLE `ia_destiny`
  ADD PRIMARY KEY (`destiny_id`);

--
-- Indices de la tabla `ia_driver`
--
ALTER TABLE `ia_driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indices de la tabla `ia_employee`
--
ALTER TABLE `ia_employee`
  ADD PRIMARY KEY (`id_employee`);

--
-- Indices de la tabla `ia_origin`
--
ALTER TABLE `ia_origin`
  ADD PRIMARY KEY (`id_origin`);

--
-- Indices de la tabla `ia_price`
--
ALTER TABLE `ia_price`
  ADD PRIMARY KEY (`id_price`);

--
-- Indices de la tabla `ia_producer`
--
ALTER TABLE `ia_producer`
  ADD PRIMARY KEY (`id_producer`);

--
-- Indices de la tabla `ia_product`
--
ALTER TABLE `ia_product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indices de la tabla `ia_product_size`
--
ALTER TABLE `ia_product_size`
  ADD PRIMARY KEY (`product_size_id`);

--
-- Indices de la tabla `ia_profile`
--
ALTER TABLE `ia_profile`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indices de la tabla `ia_quality`
--
ALTER TABLE `ia_quality`
  ADD PRIMARY KEY (`quality_id`);

--
-- Indices de la tabla `ia_size_box`
--
ALTER TABLE `ia_size_box`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ia_states`
--
ALTER TABLE `ia_states`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ia_supply`
--
ALTER TABLE `ia_supply`
  ADD PRIMARY KEY (`id_supply`);

--
-- Indices de la tabla `ia_users`
--
ALTER TABLE `ia_users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indices de la tabla `ia_vehicle`
--
ALTER TABLE `ia_vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indices de la tabla `ia_vehicle_type`
--
ALTER TABLE `ia_vehicle_type`
  ADD PRIMARY KEY (`vt_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ia_arrival`
--
ALTER TABLE `ia_arrival`
  MODIFY `id_arrival` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_category`
--
ALTER TABLE `ia_category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ia_classify`
--
ALTER TABLE `ia_classify`
  MODIFY `classify_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_clone_arrival`
--
ALTER TABLE `ia_clone_arrival`
  MODIFY `id_arrival` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_destiny`
--
ALTER TABLE `ia_destiny`
  MODIFY `destiny_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_driver`
--
ALTER TABLE `ia_driver`
  MODIFY `driver_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_employee`
--
ALTER TABLE `ia_employee`
  MODIFY `id_employee` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ia_origin`
--
ALTER TABLE `ia_origin`
  MODIFY `id_origin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_price`
--
ALTER TABLE `ia_price`
  MODIFY `id_price` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_producer`
--
ALTER TABLE `ia_producer`
  MODIFY `id_producer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_product`
--
ALTER TABLE `ia_product`
  MODIFY `id_product` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_product_size`
--
ALTER TABLE `ia_product_size`
  MODIFY `product_size_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_profile`
--
ALTER TABLE `ia_profile`
  MODIFY `id_profile` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ia_quality`
--
ALTER TABLE `ia_quality`
  MODIFY `quality_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ia_size_box`
--
ALTER TABLE `ia_size_box`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_states`
--
ALTER TABLE `ia_states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `ia_supply`
--
ALTER TABLE `ia_supply`
  MODIFY `id_supply` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_users`
--
ALTER TABLE `ia_users`
  MODIFY `id_users` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ia_vehicle`
--
ALTER TABLE `ia_vehicle`
  MODIFY `vehicle_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ia_vehicle_type`
--
ALTER TABLE `ia_vehicle_type`
  MODIFY `vt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
