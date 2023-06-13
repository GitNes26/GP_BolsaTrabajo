-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-06-2023 a las 18:06:32
-- Versión del servidor: 5.7.33
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_bolsa_trabajo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `vacancy_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `status` enum('Pendiente','Recibida','En evaluación','Aceptada','Rechazada','Cancelada') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Pendiente',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `canceled_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `applications`
--

INSERT INTO `applications` (`id`, `vacancy_id`, `candidate_id`, `status`, `active`, `created_at`, `updated_at`, `canceled_at`) VALUES
(1, 2, 1, 'En evaluación', 1, '2023-06-06 02:26:52', '2023-06-08 03:39:57', NULL),
(13, 1, 1, 'Pendiente', 1, '2023-06-08 01:04:02', NULL, NULL),
(14, 3, 1, 'Cancelada', 1, '2023-06-08 01:04:34', '2023-06-08 01:28:10', NULL),
(15, 8, 1, 'En evaluación', 1, '2023-06-08 02:08:08', '2023-06-09 08:44:36', NULL),
(16, 8, 7, 'Recibida', 1, '2023-06-09 08:19:59', '2023-06-09 08:43:05', NULL),
(17, 9, 8, 'Aceptada', 1, '2023-06-09 10:46:50', '2023-06-09 10:59:07', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `area` varchar(45) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `area`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Informática', 1, '2023-05-17 08:57:09', NULL, NULL),
(2, 'Calidad', 1, '2023-05-17 08:57:12', NULL, NULL),
(3, 'Recursos Humanos', 1, '2023-05-17 08:57:18', NULL, NULL),
(4, 'Contabilidad', 1, '2023-05-23 10:10:47', NULL, NULL),
(5, 'Finanzas', 1, '2023-05-23 10:10:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `business_lines`
--

CREATE TABLE `business_lines` (
  `id` int(11) NOT NULL,
  `business_line` varchar(45) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `business_lines`
--

INSERT INTO `business_lines` (`id`, `business_line`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tecnologías Informaticas', 1, '2023-05-17 08:48:20', '2023-05-17 08:57:50', NULL),
(2, 'Metal Mecánica', 1, '2023-05-17 08:58:02', NULL, NULL),
(3, 'Moda', 1, '2023-05-17 08:58:05', NULL, NULL),
(4, 'Contable', 1, '2023-05-23 10:10:40', NULL, NULL),
(5, 'Salud', 1, '2023-06-09 10:54:28', '2023-06-09 10:54:35', NULL),
(6, 'me equivoqueasa', 0, '2023-06-09 10:54:42', '2023-06-09 10:54:50', '2023-06-09 10:54:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `last_name` varchar(150) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `cellphone` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `age` int(11) NOT NULL,
  `professional_info` longtext COLLATE utf8mb4_unicode_520_ci,
  `cv_path` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `languages` text COLLATE utf8mb4_unicode_520_ci,
  `profession_id` int(11) DEFAULT NULL,
  `interest_tags_ids` text COLLATE utf8mb4_unicode_520_ci,
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `experiencies_ids` text COLLATE utf8mb4_unicode_520_ci,
  `skills` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Competencias',
  `abilities` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Habilidades'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `last_name`, `cellphone`, `age`, `professional_info`, `cv_path`, `languages`, `profession_id`, `interest_tags_ids`, `user_id`, `experiencies_ids`, `skills`, `abilities`) VALUES
(1, 'Candidato 1', 'Del 1', '8784531313', 26, '<p><br></p>', '', 'Inglés - Básico', 0, 'null', 7, NULL, NULL, NULL),
(6, 'Candidato 1 nuevo', 'Del nuevo 1', '8741464853', 50, '<p><br></p>', '', 'Inglés - Básico', 0, 'null', 10, NULL, NULL, NULL),
(7, 'Candidato 2', 'de Pruebas', '8794131381', 46, '<p></p><p></p><p><b>Habilidades</b></p><ul><li>Habilidad 1</li><li>Habilidad 2</li><li>...</li></ul><hr class=\"custom-separator\"><b>Competencias</b><p></p><ul><li>Competencia 1</li><li>Competencia 2</li><li>....</li></ul><hr class=\"custom-separator\"><b>EXPERIENCIAS</b><p></p><ul><li><b>Empresa - Puesto | </b>01/01/2020<b> - </b>02/02/2023<br>Descripción de lo que hacías...</li><li><span style=\"font-weight: bolder;\">Empresa - Puesto |&nbsp;</span>01/01/2020<span style=\"font-weight: bolder;\">&nbsp;-&nbsp;</span>02/02/2023<br>Descripción de lo que hacías...</li></ul><p><br></p>', '', 'Inglés - Avanzado', 0, '2', 11, NULL, NULL, NULL),
(8, 'Samuel', 'Garza del Toro', '8745464464', 30, '<p></p><p></p><p><b>Habilidades</b></p><ul><li>Habilidad 1</li><li>Habilidad 2</li><li>...</li></ul><hr class=\"custom-separator\"><b>Competencias</b><p></p><ul><li>Competencia 1</li><li>Competencia 2</li><li>....</li></ul><hr class=\"custom-separator\"><b>EXPERIENCIAS</b><p></p><ul><li><b>Empresa - Puesto | </b>01/01/2020<b> - </b>02/02/2023<br>Descripción de lo que hacías...</li><li><span style=\"font-weight: bolder;\">Empresa - Puesto |&nbsp;</span>01/01/2020<span style=\"font-weight: bolder;\">&nbsp;-&nbsp;</span>02/02/2023<br>Descripción de lo que hacías...</li></ul><p><br></p>', '', 'Inglés - Avanzado', 0, '2', 14, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `logo_path` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `contact_name` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `contact_phone` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `contact_email` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `state` varchar(45) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `municipality` varchar(45) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `business_line_id` int(11) NOT NULL,
  `company_ranking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `company`, `description`, `logo_path`, `contact_name`, `contact_phone`, `contact_email`, `state`, `municipality`, `business_line_id`, `company_ranking_id`, `user_id`) VALUES
(1, 'La Nueva Empresa', 'Enim irure tota', 'companies/Meyer Dennis Traders.PNG', 'Zelda Summers', '2131231313', 'rh@gmail.com', 'Coahuila', 'Torreon', 3, 2, 1),
(2, 'Morrison Hester Traders', 'Culpa expedita ', 'companies/Morrison Hester Traders.JPEG', 'Eleanor Massey', '5464544646', 'dasexun@mailinator.com', 'Chiapas', 'Acala', 4, 1, 2),
(7, 'Empresa  1', 'soy una empresa', NULL, 'Contacto 1', '4165876878', 'rh@gmail.com', 'Coahuila', 'Torreon', 1, 1, 6),
(9, 'Empresa Registrada', 'Esta es una empresa creada desde el administrativo.', NULL, 'Micaela Juárez', '8774464446', 'rh@gmail.com', 'Campeche', 'Calkini', 2, 3, 4),
(10, 'Creando empresa', 'Creando empresa desde el admin a un usuario ya existente.', NULL, 'Natalia Morones', '7895432454', 'rh@gmail.com', 'Durango', 'Gomez Palacio', 3, 3, 3),
(11, 'Seré Empresa', 'Soy una empresa de prubea.', NULL, 'Nancy Najera', '8711564464', 'rh@gmail.com', 'Zacatecas', 'Banon', 2, 2, 8),
(12, 'Otra empresa', 'asdasjklsadlñ', NULL, 'Contacto 1', '7897513135', 'rh@gmail.com', 'Guerrero', 'Acapulco', 2, 2, 9),
(13, 'CALIDAD EN CASA', 'empresa de salud y bienestar.', NULL, 'Maria Mares', '8710215213', 'maria@rh.com', 'Durango', 'Gomez Palacio', 3, 2, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_rankings`
--

CREATE TABLE `company_rankings` (
  `id` int(11) NOT NULL,
  `company_ranking` varchar(45) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `company_rankings`
--

INSERT INTO `company_rankings` (`id`, `company_ranking`, `description`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Micro', 'de 0 a 10 empleados', 1, '2023-05-17 08:22:11', NULL, NULL),
(2, 'Pequeña', 'de 11 a 50 empleados', 1, '2023-05-17 08:22:31', NULL, NULL),
(3, 'Mediana A', 'de 51 a 250 empleados', 1, '2023-05-17 08:22:51', '2023-05-17 08:25:20', NULL),
(4, 'Una mas', 'prueba', 0, '2023-05-17 08:26:19', NULL, '2023-05-17 08:26:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiences`
--

CREATE TABLE `experiences` (
  `id` int(11) NOT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `position` varchar(45) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `initial_date` datetime NOT NULL,
  `final_date` datetime DEFAULT NULL,
  `candidate_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `menu` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci,
  `tag` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `belongs_to` int(11) NOT NULL,
  `file_path` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT 'fa-light fa-circle',
  `order` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `show_counter` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `menu`, `description`, `tag`, `belongs_to`, `file_path`, `icon`, `order`, `active`, `show_counter`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administración', NULL, 'admin', 0, '#', 'fa-solid fa-folder-tree', 1, 1, 1, '2023-05-08 14:00:00', '2023-06-07 11:23:23', NULL),
(2, 'Usuarios', NULL, 'users', 1, 'usuarios.php', 'fa-light fa-users', 1, 1, 1, '2023-05-08 14:02:00', '2023-06-09 10:51:39', NULL),
(3, 'Módulos', NULL, 'modules', 1, 'modulos.php', 'fa-light fa-kaaba', 2, 1, 0, '2023-05-08 14:03:00', '2023-05-17 09:03:28', NULL),
(4, 'Giros', NULL, 'business_lines', 1, 'giros.php', 'fa-light fa-briefcase', NULL, 1, 0, '2023-05-15 11:38:46', '2023-05-17 09:03:46', NULL),
(5, 'Etiquetas', NULL, 'tags', 1, 'etiquetas.php', 'fa-light fa-tags', NULL, 1, 0, '2023-05-17 07:45:23', NULL, NULL),
(6, 'Áreas', NULL, 'areas', 1, 'areas.php', 'fa-light fa-objects-column', NULL, 1, 0, '2023-05-17 07:50:08', '2023-05-17 08:47:09', NULL),
(7, 'Profesiones', NULL, 'professions', 1, 'profesiones.php', 'fa-light fa-toolbox', NULL, 1, 1, '2023-06-09 12:30:13', NULL, NULL),
(8, 'Clasificaciones de Empresa', NULL, 'company_rankigns', 1, 'clasificaciones-empresa.php', 'far fa-circle', NULL, 1, 0, '2023-05-17 07:56:22', NULL, NULL),
(9, 'Empresas', NULL, 'companies', 0, '#', 'fa-solid fa-buildings', NULL, 1, 1, '2023-05-17 09:01:43', '2023-06-07 11:33:26', NULL),
(10, 'Listado', NULL, 'companies_list', 9, 'empresas.php', 'fa-sharp fa-light fa-list-tree', NULL, 1, 0, '2023-05-25 11:57:34', '2023-06-06 02:52:09', NULL),
(11, 'Vacantes', NULL, 'vacancies', 9, 'vacantes.php', 'fa-light fa-file-lines', NULL, 1, 0, '2023-06-01 10:03:35', NULL, NULL),
(12, 'Solicitudes', NULL, 'companies_applications', 9, 'solicitudes.php', 'fa-light fa-memo-circle-check', NULL, 1, 0, '2023-06-06 02:57:46', '2023-06-06 02:59:02', NULL),
(13, 'Candidatos', NULL, 'canidates', 0, '#', 'fa-solid fa-user-tie', NULL, 1, 0, '2023-06-06 02:49:27', '2023-06-06 02:49:50', NULL),
(14, 'Listado', NULL, 'candidates_list', 13, 'candidatos.php', 'fa-sharp fa-light fa-list-tree', NULL, 1, 0, '2023-06-06 02:51:32', '2023-06-06 02:51:48', NULL),
(15, 'Mis Solicitudes', NULL, 'canidates_applications', 13, 'mis-solicitudes.php', 'fa-light fa-memo-circle-check', NULL, 1, 0, '2023-06-06 02:58:54', '2023-06-08 01:54:24', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professions`
--

CREATE TABLE `professions` (
  `id` int(11) NOT NULL,
  `profession` varchar(150) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `professions`
--

INSERT INTO `professions` (`id`, `profession`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Programador', 1, '2023-06-09 01:08:13', NULL, NULL),
(2, 'Emprendedor', 1, '2023-06-09 01:09:27', NULL, NULL),
(3, 'Chofer', 0, '2023-06-09 01:12:00', '2023-06-09 01:15:44', '2023-06-09 01:15:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(150) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `pages_read` text COLLATE utf8mb4_unicode_520_ci,
  `pages_write` text COLLATE utf8mb4_unicode_520_ci,
  `pages_update` text COLLATE utf8mb4_unicode_520_ci,
  `pages_delete` text COLLATE utf8mb4_unicode_520_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `role`, `active`, `pages_read`, `pages_write`, `pages_update`, `pages_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SuperAdmin', 1, 'todas', 'todas', 'todas', 'todas', '2023-05-08 08:17:54', NULL, NULL),
(2, 'Administrativo', 1, '1,2,4,5,6,7,8,9,10,11,12,13,14,15', '1,2,4,5,6,7,8,9,10,11,12,13,14,15', '1,2,4,5,6,7,8,9,10,11,12,13,14,15', '1,2,4,5,6,7,8,9,10,11,12,13,14,15', '2023-05-08 08:17:54', NULL, NULL),
(3, 'Empresa', 1, '9,11,12', '9,11,12', '9,11,12', '9,11,12', '2023-05-08 08:17:54', NULL, NULL),
(4, 'Candidato', 1, '13,15', '13,15', '13,15', '13,15', '2023-05-08 08:17:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `tag`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'música', 1, '2023-05-17 08:58:21', NULL, NULL),
(2, 'computadoras', 1, '2023-05-17 08:58:25', NULL, NULL),
(3, 'ropa', 1, '2023-05-17 08:58:32', NULL, NULL),
(4, 'contaduria', 1, '2023-05-23 10:11:08', NULL, NULL),
(5, 'cuentas', 1, '2023-05-23 10:11:15', NULL, NULL),
(6, 'finanzas', 1, '2023-05-23 10:11:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `role_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `active`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'nes@gmail.com', '$2y$10$L4zA0yzj/cdFSq4RjTDxcOkpwkP9vlCSBfyFQzpw4R0qrECaf38nC', 1, 1, '2023-05-24 02:45:33', '2023-06-08 11:05:21', NULL),
(2, 'gustavo@gmail.com', '$2y$10$VVlv.fewbfZbv5YnqiuCzOsFtYk/GtlUU4eDBR/XYNzsqlkDSMyFi', 1, 3, '2023-05-24 03:01:33', '2023-06-08 02:44:27', NULL),
(3, 'sam@gmail.com', '$2y$10$AU9ZIbk55Io4kfThyijNwua1N3geP7cy2D2hqrvZLq6CY2/fDMYy2', 1, 3, '2023-06-02 02:54:13', NULL, NULL),
(4, 'otromx@gmail.com', '$2y$10$C4sm7kKwqstdmwK07Cgm9OPssLpzRM787ydudOSGA6AG5uP2eILXe', 0, 3, '2023-06-07 09:08:00', '2023-06-07 09:08:14', '2023-06-08 11:13:42'),
(5, 'editar@gmail', '$2y$10$TwHwEjkHz64.YNuzb9aMI.KwQ7KUYz.Tlx1GoHpW6/wWm4x2AQWUu', 0, 2, '2023-06-07 09:08:47', '2023-06-07 09:09:00', '2023-06-07 09:10:41'),
(6, 'empresa@gmail.com', '$2y$10$xRAlqJr1OHF8BwbMASsPBO3ZOzjOcFjnePf9AjkfkyjHqBwbN3K8K', 1, 3, '2023-06-07 11:56:57', NULL, NULL),
(7, 'candidato@gmail.com', '$2y$10$IMmVFwcMcs9r9P.GPuKhxOxbh2RSbDAw8aN4W1moi1.6WXQZ.2RyW', 1, 4, '2023-06-07 12:16:41', NULL, NULL),
(8, 'nuevo@gmail.com', '$2y$10$ws8htWbBKH.gmzYN6SSsxO5DTXFNz8phmXSocS6imiC0ULGVsT.uO', 1, 3, '2023-06-08 03:53:52', NULL, NULL),
(9, 'otraempresa@gmail.com', '$2y$10$IQ/muTAhxRm8SuNonqVbjO5PRLTqv0Zx0iU4XhuAzxVQaYbuYYPTe', 1, 3, '2023-06-08 04:00:15', NULL, NULL),
(10, 'candidato1@gmail.com', '$2y$10$.V8UFzcJQBoLG9HsofSTreOEeSY7IryBeg9VfNDm9a7dK5h28k1PG', 1, 4, '2023-06-09 08:12:37', NULL, NULL),
(11, 'candidato2@gmail.com', '$2y$10$ma8DCNKhtlcJ9W.53UzOf.3/PkglCLKvuaZEnHws.GpVgZ4OcPBmS', 1, 4, '2023-06-09 08:18:28', NULL, NULL),
(12, 'sinrol@gmail.com', '$2y$10$t7ayYXUbiETvAV7bvQxg/uL3qFzQ.2lkUS/GSZR2DAWe9tGbXLhb.', 1, NULL, '2023-06-09 09:25:44', NULL, NULL),
(13, 'rocio@hotmail.com', '$2y$10$ZmVdMEADGgpc9spUBZUaxO4fD1vRHeOeAaY9p5NV2tfPZoG87RGrG', 1, 3, '2023-06-09 10:19:39', NULL, NULL),
(14, 'samuel_candidato@gmail.com', '$2y$10$IN4Iz.QOPlC/I7S4k8EGDO0eSVOZkz.z03dxf0aqjgPJLUrMtR9v.', 1, 4, '2023-06-09 10:37:29', NULL, NULL),
(15, 'nueva_empresa@gmail.com', '$2y$10$INsbflm4qV4AEnU8bzMyzu8XIsStsamomTvU7NXJnA7UV.f.b/Foa', 1, 3, '2023-06-09 10:53:17', '2023-06-09 10:53:37', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacancies`
--

CREATE TABLE `vacancies` (
  `id` int(11) NOT NULL,
  `vacancy` varchar(45) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `min_salary` decimal(10,2) DEFAULT '0.00',
  `max_salary` decimal(10,2) DEFAULT '0.00',
  `job_type` enum('Medio Tiempo','Tiempo Completo','Prácticas') COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'AUN NO IMPLEMENTADO',
  `schedules` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `more_info` longtext COLLATE utf8mb4_unicode_520_ci,
  `tags_ids` text COLLATE utf8mb4_unicode_520_ci,
  `publication_date` datetime DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `requirements` text COLLATE utf8mb4_unicode_520_ci,
  `necessary_experience` text COLLATE utf8mb4_unicode_520_ci,
  `benefits` text COLLATE utf8mb4_unicode_520_ci,
  `days` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Dias a laborar, AUN NO IMPLEMENTADO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `vacancies`
--

INSERT INTO `vacancies` (`id`, `vacancy`, `description`, `company_id`, `area_id`, `min_salary`, `max_salary`, `job_type`, `schedules`, `more_info`, `tags_ids`, `publication_date`, `expiration_date`, `active`, `created_at`, `updated_at`, `deleted_at`, `requirements`, `necessary_experience`, `benefits`, `days`) VALUES
(1, 'Contador Público', 'Hará esto y aquello...', 1, 4, '500.00', '10000.00', 'Prácticas', '8 horas - Lunes a viernes', '<p><b>en negritas</b>, ya no hay negritas</p><p><b>Requisitos</b></p><ul><li><b>Lsita1</b></li><li><b>Lista 2</b></li></ul>', '4', '2023-06-07 00:00:00', '2023-06-08 23:59:59', 1, '2023-06-02 11:35:25', '2023-06-05 12:18:38', NULL, NULL, NULL, NULL, NULL),
(2, 'Programador', 'asdasjdkjasdkljaslkdjasñldasdas', 2, 2, '150.00', '250.00', 'Tiempo Completo', '6 horas - Lunes a sábado', '<p>Hola mundo</p><p><b>Requerimientos</b></p><ul><li>Esto</li><li>Aquello</li><li>lo otro</li></ul><p><b>Beneficios</b></p><ul><li>benefi 1</li><li>el 2</li></ul>', '4', '2023-06-08 00:00:00', '2023-06-07 23:59:59', 1, '2023-06-02 02:26:50', '2023-06-05 12:41:18', '2023-06-05 08:23:33', NULL, NULL, NULL, NULL),
(3, 'Iste sint et vel pra', 'Dolorem id eaque mo', 1, 3, '150.00', '250.00', 'Prácticas', 'Odit illo vel volupt', 'Dolore sunt voluptat.', '4', '2023-06-04 00:00:00', '2023-10-26 23:59:59', 1, '2023-06-05 08:58:03', '2023-06-05 12:49:25', NULL, NULL, NULL, NULL, NULL),
(4, 'Incididunt facere un', 'Temporibus molestiae', 2, 1, '800.00', '1000.00', 'Tiempo Completo', '4 horas - Lunes a viernes', '<p><b>las negritas</b></p><p>Expedita Nam tempore.</p>', '4', '2023-06-05 00:00:00', '2023-06-30 23:59:59', 1, '2023-06-05 09:00:32', '2023-06-05 09:40:32', NULL, NULL, NULL, NULL, NULL),
(5, 'Veritatis enim quibu', 'Id aut cumque labor', 1, 1, '15.00', '25.00', 'Prácticas', 'Aut unde fugiat har', 'Quam quibusdam aperi.', '2', '2020-08-24 00:00:00', '2023-02-12 23:59:59', 1, '2023-06-05 09:07:13', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Porro quaerat archit', 'Laborum voluptas et ', 2, 4, '150.00', '15550.00', 'Medio Tiempo', 'Illum mollit Nam et', 'Rerum architecto aut.', '2,3,6', '2016-04-28 00:00:00', '1997-12-27 23:59:59', 1, '2023-06-05 09:08:01', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Auxiliar Contable - Editada', 'Descripción de la vacante. Descripción de la vacante.  Descripción de la vacante.  Descripción de la vacante.  Descripción de la vacante.  Descripción', 7, 1, '8000.00', '11500.00', 'Tiempo Completo', '8 horas - Lunes a viernes', '<p class=\"\">\n						<span class=\"fw-bolder\">Requisitos</span>\n						</p><ul class=\"\" id=\"output_requirements\">\n							<li>Requerimiento 1</li>\n							<li>Requerimiento 1</li>\n							<li>Requerimiento 1</li>\n						</ul>\n					<p></p>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Expriencia necesaria</span>\n						</p><ul class=\"\" id=\"output_necessary_experience\">\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n						</ul>\n					<p></p>\n					<!-- ./ DETALLES DEL EMPELO -->\n					<hr>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Beneficios</span>\n						</p><ul class=\"\" id=\"output_benefits\">\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n						</ul>\n					<p></p>', '4', '2023-06-08 00:00:00', '2023-06-09 23:59:59', 1, '2023-06-08 02:06:37', '2023-06-09 09:01:14', NULL, NULL, NULL, NULL, NULL),
(9, 'Emprendedor', 'XXX......', 13, 2, '1000.00', '1500.00', 'Tiempo Completo', '8 horas - Lunes a viernes | 4 horas Sábados', '<p class=\"\">\n						<span class=\"fw-bolder\">Requisitos</span>\n						</p><ul class=\"\" id=\"output_requirements\">\n							<li>Carismático</li>\n							<li>Autodidacta</li>\n							<li>Requerimiento 1</li>\n						</ul>\n					<p></p>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Expriencia necesaria</span>\n						</p><ul class=\"\" id=\"output_necessary_experience\">\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n						</ul>\n					<p></p>\n					<!-- ./ DETALLES DEL EMPELO -->\n					<hr>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Beneficios</span>\n						</p><ul class=\"\" id=\"output_benefits\">\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li></ul><p><a href=\"http://www.google.com\" target=\"_blank\">www.google.com</a><br></p><ul class=\"\" id=\"output_benefits\">\n						</ul>\n					<p></p>', '4', '2023-06-09 00:00:00', '2023-06-11 23:59:59', 1, '2023-06-09 10:31:18', '2023-06-09 10:31:50', NULL, NULL, NULL, NULL, NULL),
(10, 'asdhjsa', 'asdsadsadsa', 13, 4, '100.00', '150.00', 'Tiempo Completo', '8 horas - Lunes a viernes', '<p class=\"\">\n						<span class=\"fw-bolder\">Requisitos</span>\n						</p><ul class=\"\" id=\"output_requirements\">\n							<li>Requerimiento 1</li>\n							<li>Requerimiento 1</li>\n							<li>Requerimiento 1</li>\n						</ul>\n					<p></p>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Expriencia necesaria</span>\n						</p><ul class=\"\" id=\"output_necessary_experience\">\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n						</ul>\n					<p></p>\n					<!-- ./ DETALLES DEL EMPELO -->\n					<hr>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Beneficios</span>\n						</p><ul class=\"\" id=\"output_benefits\">\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n						</ul>\n					<p></p>', '', '2023-06-09 00:00:00', '2023-06-16 23:59:59', 1, '2023-06-09 10:32:32', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `business_lines`
--
ALTER TABLE `business_lines`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_candidate_user_idx` (`user_id`);

--
-- Indices de la tabla `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_businnes_line_idx` (`business_line_id`),
  ADD KEY `fk_company_ranking_idx` (`company_ranking_id`),
  ADD KEY `fk_company_user_idx` (`user_id`);

--
-- Indices de la tabla `company_rankings`
--
ALTER TABLE `company_rankings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `business_lines`
--
ALTER TABLE `business_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `company_rankings`
--
ALTER TABLE `company_rankings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `professions`
--
ALTER TABLE `professions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `fk_candidate_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `fk_company_businnes_line` FOREIGN KEY (`business_line_id`) REFERENCES `business_lines` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_ranking` FOREIGN KEY (`company_ranking_id`) REFERENCES `company_rankings` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
