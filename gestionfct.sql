-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2018 a las 22:42:34
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestionfct`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `ciclo_id` int(11) NOT NULL,
  `nif` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poblacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigopostal` int(11) DEFAULT NULL,
  `provincia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tlf_fijo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tlf_movil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fotografia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `ciclo_id`, `nif`, `nombre`, `apellido1`, `apellido2`, `direccion`, `poblacion`, `codigopostal`, `provincia`, `tlf_fijo`, `tlf_movil`, `email`, `fotografia`, `update_at`) VALUES
(3, 5, '49080660V', 'Jorge', 'Salazar', 'Rami', 'C/ Macias Belmonte nº31 2ºB', 'Huelva', 21002, 'Avila', '987987987', '654143309', 'rafarzt@gmail.com', NULL, NULL),
(4, 4, '49083660V', 'Rafael', 'Perez', 'Torres', 'C/ Macias Belmonte nº31 2ºB', 'Huelva', 21002, 'Badajoz', '987987987', '654143309', 'rafa3t@gmail.com', 'ads.jpg', '2018-03-10 22:21:47'),
(5, 4, '49020660V', 'Alberto', 'Perez', 'Torres', 'C/ Prueba 123', 'Niebla', 24534, 'Huelva', '959323232', '654143309', 'alberto@name.com', 'essesaassa.png', '2018-03-10 22:23:16'),
(6, 6, '49080631V', 'Marcos', 'Perez', 'Lazo', 'C/ Limon 123', 'Niebla', 25441, 'Huelva', '959810664', '654121212', 'marcos_442@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclos`
--

CREATE TABLE `ciclos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `horasfct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ciclos`
--

INSERT INTO `ciclos` (`id`, `codigo`, `nombre`, `grado`, `horasfct`) VALUES
(4, 'AFI', 'Administración y Finanzas', 'medio', 370),
(5, 'ASIR', 'Administración de Sistemas Informáticos y Redes', 'medio', 370),
(6, 'DAW', 'Despliegue Aplicaciones Web', 'superior', 370);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclos_prof`
--

CREATE TABLE `ciclos_prof` (
  `profesores_id` int(11) NOT NULL,
  `ciclos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ciclos_prof`
--

INSERT INTO `ciclos_prof` (`profesores_id`, `ciclos_id`) VALUES
(5, 4),
(6, 5),
(7, 4),
(8, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `CIF` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_tutor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poblacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigopostal` int(11) DEFAULT NULL,
  `provincia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tlf_fijo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tlf_movil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `CIF`, `nombre`, `nombre_tutor`, `direccion`, `poblacion`, `codigopostal`, `provincia`, `tlf_fijo`, `tlf_movil`, `email`) VALUES
(1, 'W1452191H', 'Agilia', 'Manuel', 'C/ Macias Belmonte nº31 2ºB', 'Huelva', 21002, 'Cuenca', '959818181', '654654654', 'alberto@name.com'),
(2, 'W1432191H', 'Renfe', 'Mariano', 'C/Renfe 123', 'Huelva', 23441, 'Huelva', '987654321', '654123789', 'renfe@gmail.com'),
(3, 'W1452194H', 'Sony', 'Mr Kennedy', 'C/ Prueba 123', 'Niebla', 24534, 'Huelva', '954323232', '632102020', 'al3berto@name.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fct`
--

CREATE TABLE `fct` (
  `id` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `empresas_id` int(11) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  `anyo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `periodo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cod_ciclo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fct`
--

INSERT INTO `fct` (`id`, `alumno_id`, `empresas_id`, `profesor_id`, `anyo`, `periodo`, `cod_ciclo`) VALUES
(10, 4, 3, 6, '2018', '2', 'DAW'),
(11, 4, 2, 7, '2018', '3', 'AFI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fotografia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `tlf_fijo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tlf_movil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `nombre`, `apellido1`, `apellido2`, `fotografia`, `update_at`, `tlf_fijo`, `tlf_movil`, `username`, `email`, `rol`) VALUES
(5, 'Alberto', 'Perez', 'Gonzalez', NULL, NULL, '959878774', '656451215', 'albertp', 'alberto_p@name.com', 'profesor'),
(6, 'Mateo', 'Ruiz', 'Torres', NULL, NULL, '959810332', '654142003', 'prof_mateo', 'mateo@gmail.com', 'profesor'),
(7, 'Rafael', 'Ruiz', 'Torres', NULL, NULL, '984143309', '632151515', 'profesor_rafa', 'rafarzt@gmail.com', 'director'),
(8, 'Enrique', 'Martinez', 'Sanchez', NULL, NULL, '959878787', '654123210', 'Enrique25', 'enrique@gmail.com', 'profesor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alumnos_nif_uindex` (`nif`),
  ADD UNIQUE KEY `alumnos_email_uindex` (`email`),
  ADD KEY `alumnos_ciclos_id_fk` (`ciclo_id`);

--
-- Indices de la tabla `ciclos`
--
ALTER TABLE `ciclos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ciclos_codigo_uindex` (`codigo`);

--
-- Indices de la tabla `ciclos_prof`
--
ALTER TABLE `ciclos_prof`
  ADD PRIMARY KEY (`profesores_id`,`ciclos_id`),
  ADD KEY `IDX_5D1CD224DC431A97` (`profesores_id`),
  ADD KEY `IDX_5D1CD22472C378CA` (`ciclos_id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empresas_CIF_uindex` (`CIF`);

--
-- Indices de la tabla `fct`
--
ALTER TABLE `fct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fct_alumnos_id_fk` (`alumno_id`),
  ADD KEY `fct_empresas_id_fk` (`empresas_id`),
  ADD KEY `fct_profesores_id_fk` (`profesor_id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profesores_username_uindex` (`username`),
  ADD UNIQUE KEY `profesores_email_uindex` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ciclos`
--
ALTER TABLE `ciclos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fct`
--
ALTER TABLE `fct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `FK_5EC5A6ABD8F6DC8` FOREIGN KEY (`ciclo_id`) REFERENCES `ciclos` (`id`);

--
-- Filtros para la tabla `ciclos_prof`
--
ALTER TABLE `ciclos_prof`
  ADD CONSTRAINT `FK_5D1CD22472C378CA` FOREIGN KEY (`ciclos_id`) REFERENCES `ciclos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5D1CD224DC431A97` FOREIGN KEY (`profesores_id`) REFERENCES `profesores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `fct`
--
ALTER TABLE `fct`
  ADD CONSTRAINT `FK_AAA3E3C1602B00EE` FOREIGN KEY (`empresas_id`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `FK_AAA3E3C1E52BD977` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`),
  ADD CONSTRAINT `FK_AAA3E3C1FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
