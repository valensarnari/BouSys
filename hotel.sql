-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2024 a las 01:11:38
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
  `Comentario` longtext DEFAULT NULL,
  `ID_Reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Apellido` text NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Nacionalidad` text NOT NULL,
  `Sexo` text NOT NULL,
  `Email` text NOT NULL,
  `Telefono` text NOT NULL,
  `Contrasena` text NOT NULL,
  `Fecha_Registro` datetime NOT NULL,
  `Puntos` int(11) NOT NULL DEFAULT 0,
  `Jerarquia` text NOT NULL DEFAULT '2',
  `Activo` tinyint(1) NOT NULL DEFAULT 1,
  `tipo_de_documento` text DEFAULT NULL,
  `numero_de_documento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cochera`
--

CREATE TABLE `cochera` (
  `id` int(11) NOT NULL,
  `Numero_Cochera` int(11) NOT NULL,
  `Estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id` int(11) NOT NULL,
  `Numero_Habitacion` int(11) NOT NULL,
  `Tipo` text NOT NULL,
  `Estado` text NOT NULL,
  `Puntos` int(11) NOT NULL,
  `Cantidad_Adultos_Maximo` int(11) NOT NULL,
  `Cantidad_Ninos_Maximo` int(11) DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1,
  `ID_precio_por_noche` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id` int(11) NOT NULL,
  `Fecha_Pago` datetime NOT NULL,
  `Medio_De_Pago` text NOT NULL,
  `Descuento` decimal(10,0) DEFAULT NULL,
  `Aumento` decimal(10,0) DEFAULT NULL,
  `Total` decimal(10,0) NOT NULL,
  `ID_Reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio_por_noche`
--

CREATE TABLE `precio_por_noche` (
  `id` int(11) NOT NULL,
  `tipo_de_habitacion` text NOT NULL,
  `monto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_cochera`
--

CREATE TABLE `reserva_cochera` (
  `id` int(11) NOT NULL,
  `ID_Reserva` int(11) NOT NULL,
  `ID_Cochera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `reserva_cochera`
--
DELIMITER $$
CREATE TRIGGER `actualizar_estado_cochera_insercion` AFTER INSERT ON `reserva_cochera` FOR EACH ROW BEGIN
    UPDATE Cochera c
    JOIN Reserva_Total rt ON rt.id = NEW.ID_Reserva
    SET c.Estado = CASE
        WHEN rt.Fecha_Inicio <= CURDATE() AND rt.Fecha_Fin >= CURDATE() AND rt.Estado = 'Confirmada' THEN 'Ocupado'
        ELSE c.Estado
    END
    WHERE c.id = NEW.ID_Cochera;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_habitacion`
--

CREATE TABLE `reserva_habitacion` (
  `id` int(11) NOT NULL,
  `ID_Reserva` int(11) NOT NULL,
  `ID_Habitacion` int(11) NOT NULL,
  `Cantidad_Adultos` int(11) NOT NULL,
  `Cantidad_Ninos` int(11) DEFAULT NULL,
  `Cuna` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `reserva_habitacion`
--
DELIMITER $$
CREATE TRIGGER `points` AFTER INSERT ON `reserva_habitacion` FOR EACH ROW BEGIN
    -- Actualizar puntos del cliente
    UPDATE Cliente c
    JOIN Reserva_Total rt ON c.id = rt.ID_Cliente
    JOIN Habitacion h ON NEW.ID_Habitacion = h.id
    SET c.Puntos = c.Puntos + h.Puntos
    WHERE rt.id = NEW.ID_Reserva;

    -- Actualizar estado de la habitación
    UPDATE Habitacion h
    JOIN Reserva_Total rt ON rt.id = NEW.ID_Reserva
    SET h.Estado = CASE
        WHEN rt.Fecha_Inicio <= CURDATE() AND rt.Fecha_Fin >= CURDATE() AND rt.Estado = 'Confirmada' THEN 'Ocupado'
        ELSE h.Estado
    END
    WHERE h.id = NEW.ID_Habitacion;
END
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
-- Disparadores `reserva_total`
--
DELIMITER $$
CREATE TRIGGER `actualizar_estado_habitacion_modificacion` AFTER UPDATE ON `reserva_total` FOR EACH ROW BEGIN
    IF NEW.Estado = 'Cancelada' THEN
        -- Si la reserva se cancela, actualizar todas las habitaciones y cocheras asociadas a 'Disponible'
        UPDATE Habitacion h
        JOIN reserva_habitacion rh ON h.id = rh.ID_Habitacion
        SET h.Estado = 'Disponible'
        WHERE rh.ID_Reserva = NEW.id;

        UPDATE Cochera c
        JOIN reserva_cochera rc ON c.id = rc.ID_Cochera
        SET c.Estado = 'Disponible'
        WHERE rc.ID_Reserva = NEW.id;
    ELSE
        -- Para otros casos, actualizar el estado según las fechas y el estado de la reserva
        UPDATE Habitacion h
        JOIN reserva_habitacion rh ON h.id = rh.ID_Habitacion
        SET h.Estado = CASE
            WHEN NEW.Fecha_Inicio <= CURDATE() AND NEW.Fecha_Fin >= CURDATE() AND NEW.Estado = 'Confirmada' THEN 'Ocupado'
            ELSE 'Disponible'
        END
        WHERE rh.ID_Reserva = NEW.id;

        UPDATE Cochera c
        JOIN reserva_cochera rc ON c.id = rc.ID_Cochera
        SET c.Estado = CASE
            WHEN NEW.Fecha_Inicio <= CURDATE() AND NEW.Fecha_Fin >= CURDATE() AND NEW.Estado = 'Confirmada' THEN 'Ocupado'
            ELSE 'Disponible'
        END
        WHERE rc.ID_Reserva = NEW.id;
    END IF;
END
$$
DELIMITER ;

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
(1, 'Gerente1', 'gerente@gerente.com', '$2y$10$ORbIR19mdW6cx7cqpdLdL.rsUxzw7rJAtBmG5QlcZTX.yPYK0NdmO', '0', 1),
(2, 'Recepcionista1', 'recepcionista1@recepcionista.com', 'Recepcionista123', '1', 0),
(8, 'Recepcionista2', 'recepcionista@recepcionista.com', '$2y$10$KtH9LgFx.iyhYWQ/CiROK.kQm4YVlhl6f9UKj6fSE7htZKtZX0fiW', '1', 1);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_precio_por_noche` (`ID_precio_por_noche`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Reserva` (`ID_Reserva`);

--
-- Indices de la tabla `precio_por_noche`
--
ALTER TABLE `precio_por_noche`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cochera`
--
ALTER TABLE `cochera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `precio_por_noche`
--
ALTER TABLE `precio_por_noche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserva_cochera`
--
ALTER TABLE `reserva_cochera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserva_habitacion`
--
ALTER TABLE `reserva_habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserva_total`
--
ALTER TABLE `reserva_total`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario_empleados`
--
ALTER TABLE `usuario_empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`ID_Reserva`) REFERENCES `reserva_total` (`id`);

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`ID_precio_por_noche`) REFERENCES `precio_por_noche` (`id`) ON UPDATE CASCADE;

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

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `actualizar_estado_habitaciones_diario` ON SCHEDULE EVERY 1 DAY STARTS '2024-10-23 00:01:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    -- Actualizar todas las habitaciones a 'Disponible' por defecto
    UPDATE habitacion SET Estado = 'Disponible' WHERE Activo = 1;
    
    -- Actualizar a 'Ocupado' las habitaciones que tienen reservas para el día actual
    UPDATE habitacion h
    JOIN reserva_habitacion rh ON h.id = rh.ID_Habitacion
    JOIN reserva_total rt ON rh.ID_Reserva = rt.id
    SET h.Estado = 'Ocupado'
    WHERE rt.Fecha_Inicio <= CURDATE() AND rt.Fecha_Fin >= CURDATE()
    AND rt.Estado = 'Confirmada' AND h.Activo = 1;

    -- Actualizar todas las cocheras a 'Disponible' por defecto
    UPDATE cochera SET Estado = 'Disponible';
    
    -- Actualizar a 'Ocupado' las cocheras que tienen reservas para el día actual
    UPDATE cochera c
    JOIN reserva_cochera rc ON c.id = rc.ID_Cochera
    JOIN reserva_total rt ON rc.ID_Reserva = rt.id
    SET c.Estado = 'Ocupado'
    WHERE rt.Fecha_Inicio <= CURDATE() AND rt.Fecha_Fin >= CURDATE()
    AND rt.Estado = 'Confirmada';
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
