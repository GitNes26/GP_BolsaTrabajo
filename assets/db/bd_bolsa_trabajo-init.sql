-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-06-2023 a las 18:36:36
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
  `user_id` int(11) NOT NULL,
  `experiencies_ids` text COLLATE utf8mb4_unicode_520_ci,
  `skills` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Competencias',
  `abilities` text COLLATE utf8mb4_unicode_520_ci COMMENT 'Habilidades'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

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
(1, 'sa@gmail.com', '$2y$10$FqGf4LbqbHdNzvmKTBul5e0CnCPnn.0h3Tf2Vb5g/id1jrO6cX8fy', 1, 1, '2023-05-24 02:45:33', '2023-06-10 12:26:31', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `business_lines`
--
ALTER TABLE `business_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `company_rankings`
--
ALTER TABLE `company_rankings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `fk_candidate_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `fk_company_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
