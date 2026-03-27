-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2026 a las 14:57:47
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
-- Base de datos: `gest_exp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expediente_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `nombre_original` varchar(255) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `tamaño` int(11) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_adjuntos`
--

CREATE TABLE `archivos_adjuntos` (
  `id` int(20) UNSIGNED NOT NULL,
  `expediente_id` int(11) UNSIGNED NOT NULL,
  `nombre_original` varchar(255) NOT NULL,
  `ruta_archivo` varchar(255) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `subido_por` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `archivos_adjuntos`
--

INSERT INTO `archivos_adjuntos` (`id`, `expediente_id`, `nombre_original`, `ruta_archivo`, `tipo`, `subido_por`, `fecha`) VALUES
(1, 29, 'about_3.jpg', 'writable/uploads/expedientes/1772722089_fb53bbf1663b16e626cd.jpg', 'jpg', 1, '2026-03-05 15:48:09'),
(2, 30, 'jose_redes.pdf', 'writable/uploads/expedientes/1772722140_20401af0349ef123ff27.pdf', 'pdf', 1, '2026-03-05 15:49:00'),
(3, 30, 'nguere-corp2.pdf', 'writable/uploads/expedientes/1772722140_a13a10cdc5f1ff845397.pdf', 'pdf', 1, '2026-03-05 15:49:00'),
(4, 31, 'about_3.jpg', 'writable/uploads/expedientes/1773045634_e9b19d7cd03137d98be3.jpg', 'jpg', 1, '2026-03-09 09:40:34'),
(5, 31, 'ademy-dark.jpg', 'writable/uploads/expedientes/1773045634_4521afea05d5caeb8d80.jpg', 'jpg', 1, '2026-03-09 09:40:34'),
(6, 32, 'test.pdf', 'writable/uploads/expedientes/1773050150_8e25cf9a31162de63d96.pdf', 'pdf', 1, '2026-03-09 10:55:50'),
(7, 32, 'WEB-2.pdf', 'writable/uploads/expedientes/1773050150_9eef2c0871ca3cfecf36.pdf', 'pdf', 1, '2026-03-09 10:55:50'),
(8, 35, 'audit-exteiores.pdf', 'writable/uploads/expedientes/1774350776_120e9b911cfeaf99b612.pdf', 'pdf', 1, '2026-03-24 12:12:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expediente_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `mensaje` text NOT NULL,
  `archivo_adjunto` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `decisiones`
--

CREATE TABLE `decisiones` (
  `id` int(11) NOT NULL,
  `expediente_id` bigint(20) UNSIGNED DEFAULT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `decision` enum('aprobado','rechazado','observado') DEFAULT NULL,
  `firma_digital` varchar(255) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `descripcion`, `created_at`) VALUES
(1, 'Recepcion', 'Recepcion', '2026-03-03 10:53:58'),
(2, 'Web y Multimedia', 'Web y Multimedia', '2026-03-03 10:53:58'),
(3, 'Sistemas', 'Sistemas', '2026-03-03 10:53:58'),
(4, 'Finanzas', NULL, '2026-03-03 10:53:58'),
(5, 'Recursos Humanos', NULL, '2026-03-03 10:53:58'),
(6, 'Legal', NULL, '2026-03-03 10:53:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `orden` int(11) DEFAULT 0,
  `es_final` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `descripcion`, `color`, `orden`, `es_final`) VALUES
(1, 'registrado', 'Expediente recién creado', 'secondary', 1, 0),
(2, 'en_revision', 'En revisión', 'info', 2, 0),
(3, 'observado', 'Tiene observaciones', 'warning', 3, 0),
(4, 'aprobado', 'Expediente aprobado', 'success', 4, 1),
(5, 'rechazado', 'Expediente rechazado', 'danger', 5, 1),
(6, 'archivado', 'Expediente archivado', 'dark', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expedientes`
--

CREATE TABLE `expedientes` (
  `id` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo_expedientes` int(11) DEFAULT NULL,
  `codigo_qr` varchar(255) DEFAULT NULL,
  `hash_publico` varchar(64) NOT NULL,
  `departamento_actual` bigint(20) UNSIGNED DEFAULT NULL,
  `asignado_a` bigint(20) UNSIGNED DEFAULT NULL,
  `prioridad` enum('baja','media','alta','urgente') DEFAULT 'media',
  `nivel_confidencialidad` enum('publico','interno','confidencial','reservado') DEFAULT 'interno',
  `creado_por` bigint(20) UNSIGNED NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `estado_id` int(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `expedientes`
--

INSERT INTO `expedientes` (`id`, `codigo`, `titulo`, `descripcion`, `tipo_expedientes`, `codigo_qr`, `hash_publico`, `departamento_actual`, `asignado_a`, `prioridad`, `nivel_confidencialidad`, `creado_por`, `fecha_creacion`, `fecha_actualizacion`, `estado_id`) VALUES
(8, 'EXP001', 'Exediente de prestamo', 'Descripción del expediente uno', 1, 'QR001', 'HASH001', 1, 3, NULL, NULL, 1, '2026-03-04 15:05:47', '2026-03-10 15:30:59', 3),
(9, 'EXP002', 'Expediente Dos', 'Descripción del expediente dos', 2, 'QR002', 'HASH002', 4, 3, NULL, NULL, 1, '2026-03-04 15:05:47', '2026-03-09 10:52:08', 1),
(10, 'EXP003', 'Expediente Tres', 'Descripción del expediente tres', 1, 'QR003', 'HASH003', 4, NULL, NULL, NULL, 2, '2026-03-04 15:05:47', '2026-03-09 10:51:39', 2),
(11, 'EXP-2026-69A83C4640FEB', '', 'qefggegege', NULL, NULL, '26914a568ffe55c9593c189fa99f8b2758a6c0cdd6131f9937c047d33ad7277e', 2, NULL, NULL, NULL, 0, '2026-03-04 15:05:58', '2026-03-25 10:31:55', 2),
(12, 'EXP-2026-69A9684EBC13B', '', NULL, NULL, NULL, 'b5da8feb65fd284992fb8f345213af8cfd4ac03387b26a430477526be8509cb6', 1, NULL, 'media', 'interno', 0, '2026-03-05 12:26:06', NULL, NULL),
(13, 'EXP-2026-69A968B4AC847', '', NULL, NULL, NULL, '334e221cfc883eb91ddfba76391b205c8f0afd4147832dc05bbe34860e1c2299', 1, NULL, 'media', 'interno', 0, '2026-03-05 12:27:48', NULL, NULL),
(14, 'EXP-2026-69A968D8291C6', '', NULL, NULL, NULL, '8b58f68c1756d65565b8ff7414b52623d8cb9bf0d35bff67d0ef14276adb5977', 1, NULL, 'media', 'interno', 0, '2026-03-05 12:28:24', NULL, NULL),
(15, 'EXP-2026-69A9694A8ADFE', '', '', NULL, NULL, '176bc054700b085fdafcf88fa5b11c2223ebc524dba4db6707183adbb4c40890', 1, NULL, NULL, NULL, 0, '2026-03-05 12:30:18', '2026-03-06 11:48:20', 2),
(16, 'EXP-2026-69A969B92A6D5', '', NULL, NULL, NULL, '1626bc930d6aa77ac017d65a4fc028c42d67b9993756e466b6b9f1fbf217458a', 1, NULL, 'media', 'interno', 0, '2026-03-05 12:32:09', NULL, NULL),
(17, 'EXP-2026-69A96A551CD3D', 'wgegggggw', 'efgwggwggw', NULL, 'writable/uploads/qrs/exp_17.png', '558ac3a97384bcbeaa170b0717b7a485ad994960883111bcada984676940b6f4', 2, 4, NULL, NULL, 0, '2026-03-05 12:34:45', '2026-03-09 15:14:27', 1),
(19, 'EXP-2026-69A96DBBA6A34', '', NULL, 1, 'writable/uploads/qrs/exp_69a96dbba6b38.png', '838ac5c81eb54006ae629824e6fa5c3145d89b2d3a8ddfce29bbee8cca56b58e', 1, NULL, 'baja', 'publico', 1, '2026-03-05 11:49:15', '2026-03-05 11:49:15', 1),
(23, 'EXP-2026-69A96E78B78DA', '', NULL, 1, 'writable/uploads/qrs/exp_69a96e78b79a7.png', '7ea6f747578dc459d90c3b5de902814545e8e4d42ee95c738713d6572a7cf92a', 1, NULL, 'baja', 'publico', 1, '2026-03-05 11:52:24', '2026-03-05 11:52:24', 1),
(24, 'EXP-2026-69A9775A1FD7D', 'Expeidnye de pagos segesa', 'Expeidnye de pagos segesa', 1, 'writable/uploads/qrs/exp_69a9775a1fe35.png', 'a84d521de7eb53d55f2199eeab2e8a49e212da6af6ea2dde77b90602ee8c45ab', 2, NULL, 'baja', 'publico', 1, '2026-03-05 12:30:18', '2026-03-25 10:46:03', 1),
(25, 'EXP-2026-69A986460A0E1', 'jrgrtjjrtj', 'kkkykyykk', 1, 'writable/uploads/qrs/exp_69a986460a18f.png', '68a31f9171742ab171fe8a0cfca0d612001f958a0732655278693ecff4d9725f', 1, NULL, 'baja', 'publico', 1, '2026-03-05 13:33:58', '2026-03-05 13:33:58', 1),
(26, 'EXP-2026-69A986A9A42F1', 'programa de infantil', 'gggggggw', 2, 'writable/uploads/qrs/exp_69a986a9a43ab.png', 'ad6fed91c1958a829a9ee9e8679de16eae9df4c21a302fd9e62a2a5f5c51bcc2', 2, NULL, NULL, NULL, 1, '2026-03-05 13:35:37', '2026-03-25 10:59:28', 1),
(27, 'EXP-2026-69A989C5B4ECA', 'credito martin', 'credito martin', 1, 'writable/uploads/qrs/exp_69a989c5b4f75.png', '8b9487a2f421b0236ff590402ba1c79190d788012497bf41477638c7f08905dd', 2, 4, 'baja', 'publico', 1, '2026-03-05 13:48:53', '2026-03-09 15:31:08', 1),
(28, 'EXP-2026-69A99734BCBF8', 'th4tt4jhhtthj', 'proyecto lucerna', 1, 'writable/uploads/qrs/exp_69a99734bcccb.png', 'cdaa7dc31f0d7c5ee617eadfc3e99344cc56d8c54a5cc9f7b655336911cf281f', 2, NULL, NULL, NULL, 1, '2026-03-05 14:46:12', '2026-03-25 11:00:52', 1),
(29, 'EXP-2026-69A997A913B6D', 'th4tt4jhhtthj', 'programa televiisvo', 1, 'writable/uploads/qrs/exp_69a997a913c08.png', 'c9ac49a62b564b5a53262537e3f0bdbd8238f858c2f4f370d58aefcbb682c4ff', 2, NULL, NULL, NULL, 1, '2026-03-05 14:48:09', '2026-03-25 11:09:13', 1),
(30, 'EXP-2026-69A997DCC3BA4', 'martin credito', 'gwergwe', 1, 'writable/uploads/qrs/exp_69a997dcc3c5e.png', 'e94ab36c2023b347c643ee0bcfb9c8e4df5937fc5b8a55abadc18026ba6f2940', NULL, NULL, 'baja', 'publico', 1, '2026-03-05 14:49:00', '2026-03-06 12:30:47', 1),
(31, 'EXP-2026-69AE878239D2A', 'proycto ademyproycto ademy', 'proycto ademyproycto ademy', 2, 'writable/uploads/qrs/exp_69ae878239dc9.png', 'dd99240c093a6dcc6d725b376bf27609167cc610140f57d83b2f825d516b6827', 2, NULL, NULL, NULL, 1, '2026-03-09 08:40:34', '2026-03-09 09:59:12', 3),
(32, 'EXP-2026-69AE9926A9C5A', 'Venta de Gas', 'Venta de Gas', 2, 'writable/uploads/qrs/exp_69ae9926a9d23.png', '0863918f50b0edf71d43e87688eec5271dc3f2d0c0474bdbed18363e2f27dd70', 3, NULL, 'baja', 'publico', 1, '2026-03-09 09:55:50', '2026-03-09 11:00:36', 1),
(33, 'EXP-2026-69AEA20564825', 'eeeeeet22r2', '4y23y44y2', 2, 'writable/uploads/qrs/exp_69aea205648c7.png', 'a87b28a6c1b9c1fd1ef1ff4e7c4e2ee4c52fe236dbfcf5cfd0fdc94a4e754483', 2, NULL, 'baja', 'publico', 2, '2026-03-09 10:33:41', '2026-03-26 08:40:48', 1),
(34, 'EXP-2026-69AEAB0EA018D', '2t424t2', 'y5y5y', 2, 'writable/uploads/qrs/exp_69aeab0ea022e.png', 'be44f5a2509b05b5b0181263afeae43f384ace63d6384dcf16d4782e421425e6', 1, NULL, 'baja', 'publico', 2, '2026-03-09 11:12:14', '2026-03-09 11:12:14', 1),
(35, 'EXP-2026-69C271B7E2B56', 'libro bantues', 'libro bantueslibro bantueslibro bantues', 1, 'writable/uploads/qrs/exp_69c271b7e2bf4.png', 'ae857a4348a8cea89ad3e4e4b7bf02423bde4e2220557a92d0949eab7cf6c7f2', 1, NULL, 'media', 'publico', 1, '2026-03-24 11:12:56', '2026-03-24 11:12:56', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expediente_asignaciones`
--

CREATE TABLE `expediente_asignaciones` (
  `id` int(20) UNSIGNED NOT NULL,
  `expediente_id` int(11) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expediente_logs`
--

CREATE TABLE `expediente_logs` (
  `id` int(11) NOT NULL,
  `expediente_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `accion` varchar(255) NOT NULL,
  `comentario` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metricas_expedientes`
--

CREATE TABLE `metricas_expedientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empresa_id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) DEFAULT 0,
  `abiertos` int(11) DEFAULT 0,
  `cerrados` int(11) DEFAULT 0,
  `vencidos` int(11) DEFAULT 0,
  `promedio_resolucion_horas` decimal(10,2) DEFAULT 0.00,
  `actualizado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expediente_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `estado_anterior` varchar(50) DEFAULT NULL,
  `estado_nuevo` varchar(50) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_expediente`
--

CREATE TABLE `movimientos_expediente` (
  `id` int(11) NOT NULL,
  `expediente_id` int(11) DEFAULT NULL,
  `departamento_origen` int(11) DEFAULT NULL,
  `departamento_destino` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `accion` varchar(100) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `ip_origen` varchar(50) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos_expediente`
--

INSERT INTO `movimientos_expediente` (`id`, `expediente_id`, `departamento_origen`, `departamento_destino`, `usuario_id`, `accion`, `comentario`, `ip_origen`, `fecha`) VALUES
(1, 8, 2, 1, 1, NULL, '', NULL, '2026-03-06 13:22:59'),
(2, 27, 1, 2, 1, NULL, '', NULL, '2026-03-06 13:29:06'),
(3, 17, 1, 2, 1, NULL, '', NULL, '2026-03-06 13:45:21'),
(4, 31, 1, 2, 1, NULL, '', NULL, '2026-03-09 08:44:49'),
(5, 10, 2, 4, 2, NULL, '', NULL, '2026-03-09 09:51:39'),
(6, 9, 2, 4, 0, NULL, '', NULL, '2026-03-09 09:52:08'),
(7, 32, 1, 1, 2, NULL, '', NULL, '2026-03-09 09:59:29'),
(8, 32, 1, 2, 2, NULL, '', NULL, '2026-03-09 09:59:43'),
(9, 32, 2, 3, 0, NULL, '', NULL, '2026-03-09 10:00:36'),
(10, 32, 3, 3, 2, NULL, '', NULL, '2026-03-09 10:02:22'),
(11, 11, 1, 2, 2, NULL, '', NULL, '2026-03-25 09:31:55'),
(12, 26, 1, 2, 2, NULL, '', NULL, '2026-03-25 09:59:28'),
(13, 28, 1, 2, 2, NULL, '', NULL, '2026-03-25 10:00:52'),
(14, 29, 1, 2, 2, NULL, '', NULL, '2026-03-25 10:09:13'),
(15, 33, 1, 2, 2, NULL, '', NULL, '2026-03-26 07:40:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `leido` tinyint(1) DEFAULT 0,
  `url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `departamento_id` int(11) DEFAULT NULL,
  `expediente_id` int(11) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `usuario_id`, `titulo`, `mensaje`, `leido`, `url`, `created_at`, `departamento_id`, `expediente_id`, `tipo`) VALUES
(4, 0, 'Nuevo expediente asignado', 'Se ha asignado el expediente #28', 0, NULL, '2026-03-25 11:00:52', 2, 28, 'asignacion'),
(5, 3, 'Nuevo expediente asignado', 'Se ha asignado el expediente #28', 1, NULL, '2026-03-25 11:00:52', 2, 28, 'asignacion'),
(6, 4, 'Nuevo expediente asignado', 'Se ha asignado el expediente #28', 0, NULL, '2026-03-25 11:00:52', 2, 28, 'asignacion'),
(7, 3, 'Nuevo expediente asignado', 'Se ha asignado el expediente #29', 1, NULL, '2026-03-25 11:09:13', 2, 29, 'asignacion'),
(8, 4, 'Nuevo expediente asignado', 'Se ha asignado el expediente #29', 0, NULL, '2026-03-25 11:09:13', 2, 29, 'asignacion'),
(9, 3, 'Nuevo expediente asignado', 'Se ha asignado el expediente #33', 1, NULL, '2026-03-26 08:40:48', 2, 33, 'asignacion'),
(10, 4, 'Nuevo expediente asignado', 'Se ha asignado el expediente #33', 0, NULL, '2026-03-26 08:40:48', 2, 33, 'asignacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `qr_logs`
--

CREATE TABLE `qr_logs` (
  `id` int(11) NOT NULL,
  `expediente_id` int(11) DEFAULT NULL,
  `ip_visitante` varchar(50) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`) VALUES
(1, 'Director general', NULL),
(2, 'Jefe de Seccion', NULL),
(3, 'Empleado', NULL),
(6, 'empleado', '  empleado'),
(7, 'admin', NULL),
(9, 'Secretaria', ' Secretaria, Registra y revisa expedienets');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_expedientes`
--

CREATE TABLE `tipos_expedientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_expedientes`
--

INSERT INTO `tipos_expedientes` (`id`, `nombre`) VALUES
(1, 'Tipo A'),
(2, 'Tipo B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contacto` varchar(20) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT 1,
  `password` varchar(100) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `departamento_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `contacto` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo','bloqueado') DEFAULT 'activo',
  `ultimo_acceso` datetime DEFAULT NULL,
  `email_verificado_en` datetime DEFAULT NULL,
  `token_recuperacion` varchar(255) DEFAULT NULL,
  `token_expiracion` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `role_id`, `departamento_id`, `nombre`, `apellido`, `email`, `contacto`, `password`, `profile_image`, `estado`, `ultimo_acceso`, `email_verificado_en`, `token_recuperacion`, `token_expiracion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(0, 2, 5, 'aquiles', '', 'aquiles@gmail.com', '88558828', '$2y$10$GnASf2qT9uE67bnhFYmMZOyWXy.EZg8aInqsogCDsqrPmQoSRlkom', NULL, 'activo', NULL, NULL, NULL, NULL, '2026-03-03 11:46:50', '2026-03-25 10:07:43', NULL),
(1, 1, 5, 'jose', 'edu', 'admin@gmail.com', '2822828282', '$2y$10$G6S/2mIBOEWO7bKgpQjFyOP0p1rBOX6U2NLpaTJsBDA2N8etrxQUC', '1772536408_1b347bc73700a9c4b755.jpeg', 'activo', NULL, NULL, NULL, NULL, '2026-03-02 13:50:27', '2026-03-03 12:33:47', NULL),
(2, 9, 1, 'anna', 'edu', 'ana@gmail.com', '1235693', '$2y$10$QIKXYxnZ1sW/lqmHEWxYgu3TGJg2pS4asDDy4Oeu9zv4p2kEAcHLu', NULL, 'activo', NULL, NULL, NULL, NULL, '2026-03-02 13:51:19', '2026-03-09 11:10:51', NULL),
(3, 2, 2, 'Rosa akara', 'Gómez', 'rosa.akara@gmail.com', '987654321', '$2y$10$qEMDzrJW8JRuHP8heFc98ODFZ3ntYkxXa6rBHmkwB3NVauBD.DTFi', NULL, 'activo', NULL, NULL, NULL, NULL, '2026-03-02 13:51:19', '2026-03-25 10:07:54', NULL),
(4, 3, 2, 'marcel', 'Pérez', 'marcel@gmail.com', '555555555', '$2y$10$7S.sIW0CW3sTvH5GT1Uyte2Wa/Cie9XqJnkHucAKGusD1fIE5SjPm', NULL, 'activo', NULL, NULL, NULL, NULL, '2026-03-02 13:51:19', '2026-03-09 10:08:05', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `archivos_adjuntos`
--
ALTER TABLE `archivos_adjuntos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_expediente` (`expediente_id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comentarios_expediente` (`expediente_id`),
  ADD KEY `fk_comentarios_usuario` (`usuario_id`);

--
-- Indices de la tabla `decisiones`
--
ALTER TABLE `decisiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_usuario_id` (`usuario_id`),
  ADD KEY `idx_expediente_id` (`expediente_id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD UNIQUE KEY `hash_publico` (`hash_publico`),
  ADD KEY `idx_prioridad` (`prioridad`),
  ADD KEY `idx_hash` (`hash_publico`),
  ADD KEY `fk_expedientes_creado_por` (`creado_por`),
  ADD KEY `fk_expedientes_departamento` (`departamento_actual`),
  ADD KEY `fk_expedientes_estado` (`estado_id`),
  ADD KEY `fk_tipo_expediente` (`tipo_expedientes`);

--
-- Indices de la tabla `expediente_asignaciones`
--
ALTER TABLE `expediente_asignaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`user_id`),
  ADD KEY `fk_asignacion_expediente` (`expediente_id`);

--
-- Indices de la tabla `expediente_logs`
--
ALTER TABLE `expediente_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metricas_expedientes`
--
ALTER TABLE `metricas_expedientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movimientos_expediente` (`expediente_id`),
  ADD KEY `fk_movimientos_usuario` (`usuario_id`);

--
-- Indices de la tabla `movimientos_expediente`
--
ALTER TABLE `movimientos_expediente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `qr_logs`
--
ALTER TABLE `qr_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_expedientes`
--
ALTER TABLE `tipos_expedientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_estado` (`estado`),
  ADD KEY `fk_usuarios_roles` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos_adjuntos`
--
ALTER TABLE `archivos_adjuntos`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `expediente_asignaciones`
--
ALTER TABLE `expediente_asignaciones`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `expediente_logs`
--
ALTER TABLE `expediente_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientos_expediente`
--
ALTER TABLE `movimientos_expediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipos_expedientes`
--
ALTER TABLE `tipos_expedientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos_adjuntos`
--
ALTER TABLE `archivos_adjuntos`
  ADD CONSTRAINT `fk_archivo_expediente` FOREIGN KEY (`expediente_id`) REFERENCES `expedientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentarios_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `decisiones`
--
ALTER TABLE `decisiones`
  ADD CONSTRAINT `fk_decisiones_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `expedientes`
--
ALTER TABLE `expedientes`
  ADD CONSTRAINT `fk_expedientes_creado_por` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_expedientes_departamento` FOREIGN KEY (`departamento_actual`) REFERENCES `departamentos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_expedientes_estado` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipo_expediente` FOREIGN KEY (`tipo_expedientes`) REFERENCES `tipos_expedientes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `expediente_asignaciones`
--
ALTER TABLE `expediente_asignaciones`
  ADD CONSTRAINT `expediente_asignaciones_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_asignacion_expediente` FOREIGN KEY (`expediente_id`) REFERENCES `expedientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `fk_movimientos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
