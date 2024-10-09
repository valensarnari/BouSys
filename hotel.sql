-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2024 a las 16:45:37
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
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `Calificacion` int(11) NOT NULL,
  `Comentario` longtext NOT NULL,
  `ID_Reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `Calificacion`, `Comentario`, `ID_Reserva`) VALUES
(6, 3, 'Aceptable', 3),
(7, 2, 'Podría mejorar', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Apellido` text NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Documento` int(11) NOT NULL,
  `Nacionalidad` text NOT NULL,
  `Sexo` text NOT NULL,
  `Email` text NOT NULL,
  `Telefono` text NOT NULL,
  `Contrasena` text NOT NULL,
  `Fecha_Registro` datetime NOT NULL,
  `Puntos` int(11) NOT NULL DEFAULT 0,
  `Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `Nombre`, `Apellido`, `Fecha_Nacimiento`, `Documento`, `Nacionalidad`, `Sexo`, `Email`, `Telefono`, `Contrasena`, `Fecha_Registro`, `Puntos`, `Activo`) VALUES
(3, 'Juan', 'Pérez', '1980-05-23', 12345678, 'Argentina', 'Masculino', 'juan.perez@mail.com', '123456789', '1234', '2024-10-01 12:00:00', 5100, 1),
(4, 'Ana', 'Gómez', '1990-06-15', 87654321, 'Argentina', 'Femenino', 'ana.gomez@mail.com', '987654321', '1234', '2024-10-01 13:00:00', 2900, 1),
(5, 'Carlos', 'López', '1975-07-20', 56789012, 'Argentina', 'Masculino', 'carlos.lopez@mail.com', '123987456', '1234', '2024-10-01 14:00:00', 50, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cochera`
--

CREATE TABLE `cochera` (
  `id` int(11) NOT NULL,
  `Numero_Cochera` int(11) NOT NULL,
  `Estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cochera`
--

INSERT INTO `cochera` (`id`, `Numero_Cochera`, `Estado`) VALUES
(1, 101, 'Disponible'),
(2, 102, 'Ocupado'),
(3, 103, 'Disponible'),
(4, 104, 'En mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id` int(11) NOT NULL,
  `Numero_Habitacion` int(11) NOT NULL,
  `Tipo` text NOT NULL,
  `Precio_Por_Noche` decimal(10,0) NOT NULL,
  `Estado` text NOT NULL,
  `Puntos` int(11) NOT NULL,
  `Cantidad_Adultos_Maximo` int(11) NOT NULL,
  `Cantidad_Ninos_Maximo` int(11) NOT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id`, `Numero_Habitacion`, `Tipo`, `Precio_Por_Noche`, `Estado`, `Puntos`, `Cantidad_Adultos_Maximo`, `Cantidad_Ninos_Maximo`, `Activo`) VALUES
(1, 201, 'Suite', 15000, 'Disponible', 500, 2, 2, 1),
(2, 202, 'Simple', 6000, 'Ocupado', 300, 2, 1, 1),
(3, 204, 'Doble', 9000, 'Disponible', 250, 2, 1, 1),
(4, 205, 'Doble', 8000, 'Ocupado', 150, 2, 2, 1),
(5, 203, 'Simple', 5000, 'Disponible', 100, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id` int(11) NOT NULL,
  `Fecha_Pago` datetime NOT NULL,
  `Medio_De_Pago` text NOT NULL,
  `Descuento` decimal(10,0) NOT NULL,
  `Aumento` decimal(10,0) NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `ID_Reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id`, `Fecha_Pago`, `Medio_De_Pago`, `Descuento`, `Aumento`, `Total`, `ID_Reserva`) VALUES
(1, '2024-10-01 15:00:00', 'Tarjeta de crédito', 1000, 0, 14000, 3),
(2, '2024-10-01 16:00:00', 'Tarjeta de débito', 500, 0, 7500, 4),
(3, '2024-10-01 15:00:00', 'Tarjeta de crédito', 1000, 0, 14000, 3),
(4, '2024-10-01 16:00:00', 'Tarjeta de débito', 500, 0, 7500, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_cochera`
--

CREATE TABLE `reserva_cochera` (
  `id` int(11) NOT NULL,
  `ID_Reserva` int(11) NOT NULL,
  `ID_Cochera` int(11) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_habitacion`
--

CREATE TABLE `reserva_habitacion` (
  `id` int(11) NOT NULL,
  `ID_Reserva` int(11) NOT NULL,
  `ID_Habitacion` int(11) NOT NULL,
  `Cantidad_Adultos` int(11) NOT NULL,
  `Cantidad_Ninos` int(11) NOT NULL,
  `Cuna` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva_habitacion`
--

INSERT INTO `reserva_habitacion` (`id`, `ID_Reserva`, `ID_Habitacion`, `Cantidad_Adultos`, `Cantidad_Ninos`, `Cuna`) VALUES
(3, 3, 1, 1, 1, 0),
(4, 4, 2, 1, 1, 1),
(11, 11, 1, 1, 1, 1),
(12, 11, 5, 1, 0, 0);

--
-- Disparadores `reserva_habitacion`
--
DELIMITER $$
CREATE TRIGGER `points` AFTER INSERT ON `reserva_habitacion` FOR EACH ROW UPDATE Cliente c
JOIN Reserva_Total rt ON c.id = rt.ID_Cliente
JOIN Reserva_Habitacion rh ON rt.id = rh.ID_Reserva
JOIN Habitacion h ON rh.ID_Habitacion = h.id
SET c.Puntos = c.Puntos + h.Puntos
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_total`
--

CREATE TABLE `reserva_total` (
  `id` int(11) NOT NULL,
  `ID_Cliente` int(11) NOT NULL,
  `Estado` text NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Check_In` datetime NOT NULL,
  `Check_Out` datetime NOT NULL,
  `Fecha_Reserva` datetime NOT NULL,
  `Valor_Total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva_total`
--

INSERT INTO `reserva_total` (`id`, `ID_Cliente`, `Estado`, `Fecha_Inicio`, `Fecha_Fin`, `Check_In`, `Check_Out`, `Fecha_Reserva`, `Valor_Total`) VALUES
(3, 3, 'Confirmada', '2024-10-01', '2024-10-03', '2024-10-01 12:00:00', '2024-10-03 12:00:00', '2024-09-25 10:00:00', 14000),
(4, 4, 'Cancelada', '2024-10-05', '2024-10-07', '2024-10-05 12:00:00', '2024-10-07 12:00:00', '2024-09-28 11:00:00', 7500),
(11, 4, 'Confirmada', '2024-10-24', '2024-10-31', '2024-10-24 11:11:40', '2024-10-31 11:11:40', '2024-10-09 16:11:38', 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_empleados`
--

CREATE TABLE `usuario_empleados` (
  `id` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Email` text NOT NULL,
  `Contrasena` text NOT NULL,
  `Jerarquia` text NOT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_empleados`
--

INSERT INTO `usuario_empleados` (`id`, `Nombre`, `Email`, `Contrasena`, `Jerarquia`, `Activo`) VALUES
(1, 'Gerente1', 'gerente@gerente.com', 'Gerente123', '0', 1),
(2, 'Recepcionista1', 'recepcionista1@recepcionista.com', 'Recepcionista123', '1', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Reserva` (`ID_Reserva`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cochera`
--
ALTER TABLE `cochera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Reserva` (`ID_Reserva`);

--
-- Indices de la tabla `reserva_cochera`
--
ALTER TABLE `reserva_cochera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Reserva` (`ID_Reserva`),
  ADD KEY `ID_Cochera` (`ID_Cochera`);

--
-- Indices de la tabla `reserva_habitacion`
--
ALTER TABLE `reserva_habitacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Reserva` (`ID_Reserva`),
  ADD KEY `ID_Habitacion` (`ID_Habitacion`);

--
-- Indices de la tabla `reserva_total`
--
ALTER TABLE `reserva_total`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Cliente` (`ID_Cliente`);

--
-- Indices de la tabla `usuario_empleados`
--
ALTER TABLE `usuario_empleados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cochera`
--
ALTER TABLE `cochera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reserva_cochera`
--
ALTER TABLE `reserva_cochera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserva_habitacion`
--
ALTER TABLE `reserva_habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reserva_total`
--
ALTER TABLE `reserva_total`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario_empleados`
--
ALTER TABLE `usuario_empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`ID_Reserva`) REFERENCES `reserva_total` (`id`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`ID_Reserva`) REFERENCES `reserva_total` (`id`);

--
-- Filtros para la tabla `reserva_cochera`
--
ALTER TABLE `reserva_cochera`
  ADD CONSTRAINT `reserva_cochera_ibfk_1` FOREIGN KEY (`ID_Reserva`) REFERENCES `reserva_total` (`id`),
  ADD CONSTRAINT `reserva_cochera_ibfk_2` FOREIGN KEY (`ID_Cochera`) REFERENCES `cochera` (`id`);

--
-- Filtros para la tabla `reserva_habitacion`
--
ALTER TABLE `reserva_habitacion`
  ADD CONSTRAINT `reserva_habitacion_ibfk_1` FOREIGN KEY (`ID_Reserva`) REFERENCES `reserva_total` (`id`),
  ADD CONSTRAINT `reserva_habitacion_ibfk_2` FOREIGN KEY (`ID_Habitacion`) REFERENCES `habitacion` (`id`);

--
-- Filtros para la tabla `reserva_total`
--
ALTER TABLE `reserva_total`
  ADD CONSTRAINT `reserva_total_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
