-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2024 a las 02:11:44
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
DROP DATABASE IF EXISTS hotel;
CREATE DATABASE hotel;
use hotel;
--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `Calificacion` int(11) NOT NULL,
  `Comentario` longtext,
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
  `Jerarquia` varchar(30) NOT NULL DEFAULT '2',
  `Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `Nombre`, `Apellido`, `Fecha_Nacimiento`, `Documento`, `Nacionalidad`, `Sexo`, `Email`, `Telefono`, `Contrasena`, `Fecha_Registro`, `Puntos`, `Jerarquia`, `Activo`) VALUES
(3, 'Juan', 'Pérez', '1980-05-23', 12345678, 'Argentina', 'Masculino', 'juan.perez@mail.com', '123456789', '$2y$10$UdqbNu4voedDJFsuYrrLCuGYHs6JsN3ZUXQ6q09FdPOMmnTCzxTI2', '2024-10-01 12:00:00', 22600, '2', 1),
(4, 'Ana', 'Gómez', '1990-06-15', 87654321, 'Argentina', 'Femenino', 'ana.gomez@mail.com', '987654321', '$2y$10$ajqkMVdGSr7NuL6Jl9F3S.aSSzixUyabQiryX7I2me253wjSk.biW', '2024-10-01 13:00:00', 14600, '2', 1),
(5, 'Carlos', 'López', '1975-07-20', 56789012, 'Argentina', 'Masculino', 'carlos.lopez@mail.com', '123987456', '$2y$10$eLeMiI4smGoNuSCGlJDtJ.EMMsde/H2t/zujiqVEcyMS09td0vtgW', '2024-10-01 14:00:00', 15550, '2', 1);

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
(2, 102, 'Disponible'),
(3, 103, 'Disponible'),
(4, 104, 'Ocupado');

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
  `Cantidad_Ninos_Maximo` int(11),
  `Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id`, `Numero_Habitacion`, `Tipo`, `Precio_Por_Noche`, `Estado`, `Puntos`, `Cantidad_Adultos_Maximo`, `Cantidad_Ninos_Maximo`, `Activo`) VALUES
(1, 201, 'Suite', 15000, 'Disponible', 500, 2, 2, 1),
(2, 202, 'Simple', 6000, 'Disponible', 50, 2, 1, 1),
(3, 204, 'Doble', 9000, 'Ocupado', 200, 2, 1, 1),
(4, 205, 'Doble', 8000, 'Ocupado', 200, 2, 2, 1),
(5, 203, 'Simple', 5000, 'Ocupado', 50, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id` int(11) NOT NULL,
  `Fecha_Pago` datetime NOT NULL,
  `Medio_De_Pago` text NOT NULL,
  `Descuento` decimal(10,0),
  `Aumento` decimal(10,0),
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
  `ID_Cochera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva_cochera`
--

INSERT INTO `reserva_cochera` (`id`, `ID_Reserva`, `ID_Cochera`) VALUES
(1, 1, 1),
(2, 4, 1),
(3, 5, 4);

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
  `Cantidad_Ninos` int(11),
  `Cuna` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva_habitacion`
--

INSERT INTO `reserva_habitacion` (`id`, `ID_Reserva`, `ID_Habitacion`, `Cantidad_Adultos`, `Cantidad_Ninos`, `Cuna`) VALUES
(1, 1, 1, 1, 1, 0),
(2, 2, 5, 1, 0, 1),
(3, 3, 4, 1, 0, 0),
(4, 3, 5, 1, 0, 1),
(5, 4, 2, 1, 0, 0),
(6, 5, 3, 1, 0, 0);

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
  `Check_In` datetime NULL,
  `Check_Out` datetime NULL,
  `Fecha_Reserva` datetime NOT NULL,
  `Valor_Total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva_total`
--

INSERT INTO `reserva_total` (`id`, `ID_Cliente`, `Estado`, `Fecha_Inicio`, `Fecha_Fin`, `Check_In`, `Check_Out`, `Fecha_Reserva`, `Valor_Total`) VALUES
(1, 5, 'Cancelada', '2024-10-25', '2024-10-30', '2024-10-25 00:00:00', '2024-10-30 00:00:00', '2024-10-21 17:37:03', 75000),
(2, 4, 'Cancelada', '2024-10-20', '2024-10-30', '2024-10-20 00:00:00', '2024-10-30 00:00:00', '2024-10-22 20:22:18', 20000),
(3, 5, 'Confirmada', '2024-10-20', '2024-10-26', '2024-10-20 00:00:00', '2024-10-26 00:00:00', '2024-10-22 20:37:52', 26000),
(4, 5, 'Cancelada', '2024-10-21', '2024-10-26', '2024-10-21 00:00:00', '2024-10-26 00:00:00', '2024-10-22 20:55:38', 12000),
(5, 5, 'Confirmada', '2024-10-22', '2024-10-26', '2024-10-22 00:00:00', '2024-10-26 00:00:00', '2024-10-22 21:05:44', 18000);

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
(1, 'Gerente1', 'gerente@gerente.com', '$2y$10$nV0NV3GcFqJe2T4S4CRP/uJleQXULf6zZQeXATnURex0Yds9qFSCi', '0', 1),
(2, 'Recepcionista1', 'recepcionista@despedido.com', '$2y$10$rfFbCksGgv4uooAGyfeaTOYrdbH4vdl2NsPhGccID1bNjyR2Jb33K', '1', 0),
(8, 'Recepcionista2', 'recepcionista@recepcionista.com', '$2y$10$OGigXuelBFE427/qJLfYseiasSOWXdAVlka/SFlJ4s0S5GcC.4..W', '1', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reserva_habitacion`
--
ALTER TABLE `reserva_habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reserva_total`
--
ALTER TABLE `reserva_total`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
