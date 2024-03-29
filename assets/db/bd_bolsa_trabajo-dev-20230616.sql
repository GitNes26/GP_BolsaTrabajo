-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bd_bolsa_trabajo
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vacancy_id` int NOT NULL,
  `candidate_id` int NOT NULL,
  `status` enum('Pendiente','Recibida','En evaluación','Aceptada','Rechazada','Cancelada') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pendiente',
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `canceled_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,2,1,'En evaluación',1,'2023-06-06 02:26:52','2023-06-08 03:39:57',NULL),(13,1,1,'Pendiente',1,'2023-06-08 01:04:02',NULL,NULL),(14,3,1,'Cancelada',1,'2023-06-08 01:04:34','2023-06-08 01:28:10',NULL),(15,8,1,'En evaluación',1,'2023-06-08 02:08:08','2023-06-09 08:44:36',NULL),(16,8,7,'Recibida',1,'2023-06-09 08:19:59','2023-06-09 08:43:05',NULL),(17,9,8,'Aceptada',1,'2023-06-09 10:46:50','2023-06-09 10:59:07',NULL),(18,4,1,'Pendiente',1,'2023-06-14 02:18:51',NULL,NULL),(19,11,1,'En evaluación',1,'2023-06-16 01:19:48','2023-06-16 01:21:19',NULL);
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `area` varchar(45) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Informática',1,'2023-05-17 08:57:09',NULL,NULL),(2,'Calidad',1,'2023-05-17 08:57:12',NULL,NULL),(3,'Recursos Humanos',1,'2023-05-17 08:57:18',NULL,NULL),(4,'Contabilidad',1,'2023-05-23 10:10:47',NULL,NULL),(5,'Finanzas',1,'2023-05-23 10:10:49',NULL,NULL),(6,'Ingenieria',1,'2023-06-15 09:45:25',NULL,NULL),(7,'Diseño',1,'2023-06-15 09:45:31',NULL,NULL);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_lines`
--

DROP TABLE IF EXISTS `business_lines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `business_lines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `business_line` varchar(45) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_lines`
--

LOCK TABLES `business_lines` WRITE;
/*!40000 ALTER TABLE `business_lines` DISABLE KEYS */;
INSERT INTO `business_lines` VALUES (1,'Tecnologías Informaticas',1,'2023-05-17 08:48:20','2023-06-16 01:23:47',NULL),(2,'Metal Mecánica',1,'2023-05-17 08:58:02',NULL,NULL),(3,'Moda',1,'2023-05-17 08:58:05',NULL,NULL),(4,'Contable',1,'2023-05-23 10:10:40',NULL,NULL),(5,'Salud',1,'2023-06-09 10:54:28','2023-06-09 10:54:35',NULL),(6,'me equivoqueasa',0,'2023-06-09 10:54:42','2023-06-09 10:54:50','2023-06-09 10:54:52'),(7,'Automotriz',1,'2023-06-16 01:23:36',NULL,NULL);
/*!40000 ALTER TABLE `business_lines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `candidates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cellphone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `age` int NOT NULL,
  `professional_info` longtext COLLATE utf8mb4_general_ci,
  `photo_path` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'sin_perfil.webp',
  `cv_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `languages` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `profession_id` int DEFAULT NULL,
  `interest_tags_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `enable` tinyint NOT NULL DEFAULT '1',
  `user_id` int NOT NULL,
  `experiencies_ids` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `skills` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'Competencias',
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'Habilidades',
  PRIMARY KEY (`id`),
  KEY `fk_candidate_user_idx` (`user_id`),
  CONSTRAINT `fk_candidate_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidates`
--

LOCK TABLES `candidates` WRITE;
/*!40000 ALTER TABLE `candidates` DISABLE KEYS */;
INSERT INTO `candidates` VALUES (1,'Candidato 1','Del 1','8784531313',26,'<p><br></p>','candidates/7-Candidato 1.WEBP','','Inglés - Básico',1,'',1,7,NULL,NULL,NULL),(6,'Candidato 1 nuevo','Del nuevo 1','8741464853',50,'<p><br></p>',NULL,NULL,'Inglés - Básico',1,'2,5',1,10,NULL,NULL,NULL),(7,'Candidato 2','de Pruebas','8794131381',46,'<p></p><p></p><p><b>Habilidades</b></p><ul><li>Habilidad 1</li><li>Habilidad 2</li><li>...</li></ul><hr class=\"custom-separator\"><b>Competencias</b><p></p><ul><li>Competencia 1</li><li>Competencia 2</li><li>....</li></ul><hr class=\"custom-separator\"><b>EXPERIENCIAS</b><p></p><ul><li><b>Empresa - Puesto | </b>01/01/2020<b> - </b>02/02/2023<br>Descripción de lo que hacías...</li><li><span style=\"font-weight: bolder;\">Empresa - Puesto |&nbsp;</span>01/01/2020<span style=\"font-weight: bolder;\">&nbsp;-&nbsp;</span>02/02/2023<br>Descripción de lo que hacías...</li></ul><p><br></p>',NULL,NULL,'Inglés - Avanzado',1,'2',1,11,NULL,NULL,NULL),(8,'Samuel','Garza del Toro','8745464464',30,'<p></p><p></p><p><b>Habilidades</b></p><ul><li>Habilidad 1</li><li>Habilidad 2</li><li>...</li></ul><hr class=\"custom-separator\"><b>Competencias</b><p></p><ul><li>Competencia 1</li><li>Competencia 2</li><li>....</li></ul><hr class=\"custom-separator\"><b>EXPERIENCIAS</b><p></p><ul><li><b>Empresa - Puesto | </b>01/01/2020<b> - </b>02/02/2023<br>Descripción de lo que hacías...</li><li><span style=\"font-weight: bolder;\">Empresa - Puesto |&nbsp;</span>01/01/2020<span style=\"font-weight: bolder;\">&nbsp;-&nbsp;</span>02/02/2023<br>Descripción de lo que hacías...</li></ul><p><br></p>',NULL,NULL,'Inglés - Avanzado',1,'2',1,14,NULL,NULL,NULL),(9,'Yennyx','Yenny','8717464446',26,'<p></p><p></p><p><b>Habilidades</b></p><ul><li>Habilidad 1</li><li>Habilidad 2</li><li>...</li></ul><hr class=\"custom-separator\"><b>Competencias</b><p></p><ul><li>Competencia 1</li><li>Competencia 2</li><li>....</li></ul><hr class=\"custom-separator\"><b>EXPERIENCIAS</b><p></p><ul><li><b>Empresa - Puesto | </b>01/01/2020<b> - </b>02/02/2023<br>Descripción de lo que hacías...</li><li><span style=\"font-weight: bolder;\">Empresa - Puesto |&nbsp;</span>01/01/2020<span style=\"font-weight: bolder;\">&nbsp;-&nbsp;</span>02/02/2023<br>Descripción de lo que hacías...</li></ul><p><br></p>','candidates/18-Yennyx.WEBP','candidates/18-Yennyx-cv.PDF','Inglés - Avanzado',1,'',1,18,NULL,NULL,NULL),(11,'Naniela','Jimenez','8715646545',25,'<p></p><p></p><p><b>Habilidades</b></p><ul><li>Habilidad 1</li><li>Habilidad 2</li><li>...</li></ul><hr class=\"custom-separator\"><b>Competencias</b><p></p><ul><li>Competencia 1</li><li>Competencia 2</li><li>....</li></ul><hr class=\"custom-separator\"><b>EXPERIENCIAS</b><p></p><ul><li><b>Empresa - Puesto | </b>01/01/2020<b> - </b>02/02/2023<br>Descripción de lo que hacías...</li><li><span style=\"font-weight: bolder;\">Empresa - Puesto |&nbsp;</span>01/01/2020<span style=\"font-weight: bolder;\">&nbsp;-&nbsp;</span>02/02/2023<br>Descripción de lo que hacías...</li></ul><p><br></p>','candidates/19-Naniela.JPEG','candidates/19-Naniela-cv.PDF','Inglés - Avanzado',2,'',1,19,NULL,NULL,NULL),(12,'El Nuevo','Dominguez','8715646456',28,'<p></p><p></p><p><b>Habilidades</b></p><ul><li>Habilidad 1</li><li>Habilidad 2</li><li>...</li></ul><hr class=\"custom-separator\"><b>Competencias</b><p></p><ul><li>Competencia 1</li><li>Competencia 2</li><li>....</li></ul><hr class=\"custom-separator\"><b>EXPERIENCIAS</b><p></p><ul><li><b>Empresa - Puesto | </b>01/01/2020<b> - </b>02/02/2023<br>Descripción de lo que hacías...</li><li><span style=\"font-weight: bolder;\">Empresa - Puesto |&nbsp;</span>01/01/2020<span style=\"font-weight: bolder;\">&nbsp;-&nbsp;</span>02/02/2023<br>Descripción de lo que hacías...</li></ul><p><br></p>','candidates/21-El Nuevo.JPEG','candidates/21-El Nuevo-cv.PDF','Inglés - Avanzado',5,'',1,21,NULL,NULL,NULL),(14,'Soy el Nuevos','de nuevos','8715616161',25,'<p></p><p></p><p><b>Habilidades</b></p><ul><li>Habilidad 1</li><li>Habilidad 2</li><li>...</li></ul><hr class=\"custom-separator\"><b>Competencias</b><p></p><ul><li>Competencia 1</li><li>Competencia 2</li><li>....</li></ul><hr class=\"custom-separator\"><b>EXPERIENCIAS</b><p></p><ul><li><b>Empresa - Puesto | </b>01/01/2020<b> - </b>02/02/2023<br>Descripción de lo que hacías...</li><li><span style=\"font-weight: bolder;\">Empresa - Puesto |&nbsp;</span>01/01/2020<span style=\"font-weight: bolder;\">&nbsp;-&nbsp;</span>02/02/2023<br>Descripción de lo que hacías...</li></ul><p><br></p>','candidates/22-Soy el Nuevos.JPG','candidates/22-Soy el Nuevos-cv.PDF','Inglés - Avanzado',2,'',1,22,NULL,NULL,NULL),(15,'Lateral','Dominguez','8712561564',25,'<p></p><p></p><p><b>Habilidades</b></p><ul><li>Habilidad 1</li><li>Habilidad 2</li><li>...</li></ul><hr class=\"custom-separator\"><b>Competencias</b><p></p><ul><li>Competencia 1</li><li>Competencia 2</li><li>....</li></ul><hr class=\"custom-separator\"><b>EXPERIENCIAS</b><p></p><ul><li><b>Empresa - Puesto | </b>01/01/2020<b> - </b>02/02/2023<br>Descripción de lo que hacías...</li><li><span style=\"font-weight: bolder;\">Empresa - Puesto |&nbsp;</span>01/01/2020<span style=\"font-weight: bolder;\">&nbsp;-&nbsp;</span>02/02/2023<br>Descripción de lo que hacías...</li></ul><p><br></p>','candidates/24-Lateral.JPG','candidates/24-Lateral-cv.PDF','Inglés - Avanzado',4,'',1,24,NULL,NULL,NULL);
/*!40000 ALTER TABLE `candidates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `logo_path` varchar(100) DEFAULT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_phone` varchar(10) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `state` varchar(45) NOT NULL,
  `municipality` varchar(45) NOT NULL,
  `business_line_id` int NOT NULL,
  `company_ranking_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_company_businnes_line_idx` (`business_line_id`),
  KEY `fk_company_ranking_idx` (`company_ranking_id`),
  KEY `fk_company_user_idx` (`user_id`),
  CONSTRAINT `fk_company_businnes_line` FOREIGN KEY (`business_line_id`) REFERENCES `business_lines` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_company_ranking` FOREIGN KEY (`company_ranking_id`) REFERENCES `company_rankings` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_company_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'La Nueva Empresa','Enim irure tota','companies/Meyer Dennis Traders.PNG','Zelda Summers','2131231313','rh@gmail.com','Coahuila','Torreon',3,2,1),(2,'Morrison Hester Traders','Culpa expedita ','companies/Morrison Hester Traders.JPEG','Eleanor Massey','5464544646','dasexun@mailinator.com','Chiapas','Acala',4,1,2),(7,'Empresa  1','soy una empresa',NULL,'Contacto 1','4165876878','rh@gmail.com','Coahuila','Torreon',1,1,6),(9,'Empresa Registrada','Esta es una empresa creada desde el administrativo.',NULL,'Micaela Juárez','8774464446','rh@gmail.com','Campeche','Calkini',2,3,4),(10,'Creando empresa','Creando empresa desde el admin a un usuario ya existente.',NULL,'Natalia Morones','7895432454','rh@gmail.com','Durango','Gomez Palacio',3,3,3),(11,'Seré Empresa - no cambie img','Soy una empresa de prubea.','companies/Seré Empresa - no cambie img.JPEG','Nancy Najera','8711564464','rh@gmail.com','Zacatecas','Banon',2,2,8),(12,'Otra empresa','asdasjklsadlñ','companies/Otra empresa.JPEG','Contacto 1','7897513135','rh@gmail.com','Guerrero','Acapulco',2,2,9),(13,'CALIDAD EN CASA','empresa de salud y bienestar.','companies/CALIDAD EN CASA.WEBP','Maria Mares','8710215213','maria@rh.com','Durango','Gomez Palacio',3,2,13),(14,'KoalaTecno','Empresa de desarrollo..........','companies/KoalaTecno.JPEG','Natalia Morones','8797897979','rh@gmail.com','Coahuila','Arteaga',1,2,16),(15,'Empresa nu','asdhajklsdhsaklj','companies/Empresa nu.JPEG','Micaela Juárez','8711564464','rh@gmail.com','Coahuila','Acuna',2,1,17),(16,'Empresa 15','sadas','companies/Empresa 15.JPEG','Micaela Juárez','8715646465','rh@gmail.com','Durango','Gomez Palacio',2,2,23);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_rankings`
--

DROP TABLE IF EXISTS `company_rankings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_rankings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_ranking` varchar(45) NOT NULL,
  `description` varchar(50) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_rankings`
--

LOCK TABLES `company_rankings` WRITE;
/*!40000 ALTER TABLE `company_rankings` DISABLE KEYS */;
INSERT INTO `company_rankings` VALUES (1,'Micro','de 0 a 10 empleados',1,'2023-05-17 08:22:11',NULL,NULL),(2,'Pequeña','de 11 a 50 empleados',1,'2023-05-17 08:22:31',NULL,NULL),(3,'Mediana A','de 51 a 250 empleados',1,'2023-05-17 08:22:51','2023-05-17 08:25:20',NULL),(4,'Una mas','prueba',0,'2023-05-17 08:26:19',NULL,'2023-05-17 08:26:21');
/*!40000 ALTER TABLE `company_rankings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experiences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company` varchar(100) NOT NULL,
  `position` varchar(45) NOT NULL,
  `description` varchar(150) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `initial_date` datetime NOT NULL,
  `final_date` datetime DEFAULT NULL,
  `candidate_id` int NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiences`
--

LOCK TABLES `experiences` WRITE;
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;
/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `belongs_to` int NOT NULL,
  `file_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'fa-light fa-circle',
  `order` int DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `show_counter` tinyint NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Administración',NULL,'admin',0,'#','fa-solid fa-folder-tree',1,1,1,'2023-05-08 14:00:00','2023-06-07 11:23:23',NULL),(2,'Usuarios',NULL,'users',1,'usuarios.php','fa-light fa-users',1,1,1,'2023-05-08 14:02:00','2023-06-09 10:51:39',NULL),(3,'Módulos',NULL,'modules',1,'modulos.php','fa-light fa-kaaba',2,1,0,'2023-05-08 14:03:00','2023-05-17 09:03:28',NULL),(4,'Giros',NULL,'business_lines',1,'giros.php','fa-light fa-briefcase',NULL,1,0,'2023-05-15 11:38:46','2023-05-17 09:03:46',NULL),(5,'Etiquetas',NULL,'tags',1,'etiquetas.php','fa-light fa-tags',NULL,1,0,'2023-05-17 07:45:23',NULL,NULL),(6,'Áreas',NULL,'areas',1,'areas.php','fa-light fa-objects-column',NULL,1,0,'2023-05-17 07:50:08','2023-05-17 08:47:09',NULL),(7,'Clasificaciones de Empresa',NULL,'company_rankigns',1,'clasificaciones-empresa.php','far fa-circle',NULL,1,0,'2023-05-17 07:56:22',NULL,NULL),(8,'Empresas',NULL,'companies',0,'#','fa-solid fa-buildings',NULL,1,1,'2023-05-17 09:01:43','2023-06-07 11:33:26',NULL),(9,'Listado',NULL,'companies_list',8,'empresas.php','fa-sharp fa-light fa-list-tree',NULL,1,0,'2023-05-25 11:57:34','2023-06-06 02:52:09',NULL),(10,'Vacantes',NULL,'vacancies',8,'vacantes.php','fa-light fa-file-lines',NULL,1,0,'2023-06-01 10:03:35',NULL,NULL),(11,'Candidatos',NULL,'canidates',0,'#','fa-solid fa-user-tie',NULL,1,0,'2023-06-06 02:49:27','2023-06-06 02:49:50',NULL),(12,'Listado',NULL,'candidates_list',11,'candidatos.php','fa-sharp fa-light fa-list-tree',NULL,1,0,'2023-06-06 02:51:32','2023-06-06 02:51:48',NULL),(13,'Solicitudes',NULL,'companies_applications',8,'solicitudes.php','fa-light fa-memo-circle-check',NULL,1,0,'2023-06-06 02:57:46','2023-06-06 02:59:02',NULL),(14,'Mis Solicitudes',NULL,'canidates_applications',11,'mis-solicitudes.php','fa-light fa-memo-circle-check',NULL,1,0,'2023-06-06 02:58:54','2023-06-08 01:54:24',NULL),(15,'Profesiones',NULL,'professions',1,'profesiones.php','fa-light fa-toolbox',NULL,1,1,'2023-06-09 12:30:13',NULL,NULL),(16,'Solicitudes',NULL,'applications',1,'solicitudes.php','fa-light fa-memo-circle-check',NULL,0,1,'2023-06-13 08:53:58',NULL,NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professions`
--

DROP TABLE IF EXISTS `professions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profession` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professions`
--

LOCK TABLES `professions` WRITE;
/*!40000 ALTER TABLE `professions` DISABLE KEYS */;
INSERT INTO `professions` VALUES (1,'Programador',1,'2023-06-09 01:08:13',NULL,NULL),(2,'Emprendedor',1,'2023-06-09 01:09:27',NULL,NULL),(3,'Chofer',0,'2023-06-09 01:12:00','2023-06-09 01:15:44','2023-06-09 01:15:46'),(4,'Gerente',1,'2023-06-12 12:41:06',NULL,NULL),(5,'Cocinero',1,'2023-06-12 12:41:15',NULL,NULL),(6,'Carpintero',1,'2023-06-16 01:24:58',NULL,NULL);
/*!40000 ALTER TABLE `professions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `pages_read` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `pages_write` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `pages_update` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `pages_delete` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SuperAdmin',1,'todas','todas','todas','todas','2023-05-08 08:17:54',NULL,NULL),(2,'Administrador',1,'1,2,4,5,6,7,8,9,10,11,12,13,14','1,2,4,5,6,7,8,9,10,11,12,13,14','1,2,4,5,6,7,8,9,10,11,12,13,14','1,2,4,5,6,7,8,9,10,11,12,13,14','2023-05-08 08:17:54',NULL,NULL),(3,'Empresa',1,'8,10,13','8,10,13','8,10,13','8,10,13','2023-05-08 08:17:54',NULL,NULL),(4,'Candidato',1,'11,13,14','11,13,14','11,13,14','11,13,14','2023-05-08 08:17:54',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'música',1,'2023-05-17 08:58:21',NULL,NULL),(2,'computadoras',1,'2023-05-17 08:58:25',NULL,NULL),(3,'ropa',1,'2023-05-17 08:58:32',NULL,NULL),(4,'contaduria',1,'2023-05-23 10:11:08',NULL,NULL),(5,'cuentas',1,'2023-05-23 10:11:15',NULL,NULL),(6,'finanzas',1,'2023-05-23 10:11:18',NULL,NULL),(7,'salud y belleza',1,'2023-06-15 09:37:25',NULL,NULL),(8,'software',1,'2023-06-15 09:37:31',NULL,NULL),(9,'hardware',1,'2023-06-15 09:37:33',NULL,NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `role_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'nes@gmail.com','$2y$10$L4zA0yzj/cdFSq4RjTDxcOkpwkP9vlCSBfyFQzpw4R0qrECaf38nC',1,1,'2023-05-24 02:45:33','2023-06-08 11:05:21',NULL),(2,'gustavo@gmail.com','$2y$10$VVlv.fewbfZbv5YnqiuCzOsFtYk/GtlUU4eDBR/XYNzsqlkDSMyFi',1,3,'2023-05-24 03:01:33','2023-06-08 02:44:27',NULL),(3,'sam@gmail.com','$2y$10$AU9ZIbk55Io4kfThyijNwua1N3geP7cy2D2hqrvZLq6CY2/fDMYy2',1,3,'2023-06-02 02:54:13',NULL,NULL),(4,'otromx@gmail.com','$2y$10$C4sm7kKwqstdmwK07Cgm9OPssLpzRM787ydudOSGA6AG5uP2eILXe',0,3,'2023-06-07 09:08:00','2023-06-07 09:08:14','2023-06-08 11:13:42'),(5,'editar@gmail','$2y$10$TwHwEjkHz64.YNuzb9aMI.KwQ7KUYz.Tlx1GoHpW6/wWm4x2AQWUu',0,2,'2023-06-07 09:08:47','2023-06-07 09:09:00','2023-06-07 09:10:41'),(6,'empresa@gmail.com','$2y$10$xRAlqJr1OHF8BwbMASsPBO3ZOzjOcFjnePf9AjkfkyjHqBwbN3K8K',1,3,'2023-06-07 11:56:57',NULL,NULL),(7,'candidato@gmail.com','$2y$10$IMmVFwcMcs9r9P.GPuKhxOxbh2RSbDAw8aN4W1moi1.6WXQZ.2RyW',1,4,'2023-06-07 12:16:41','2023-06-16 03:58:10',NULL),(8,'nuevo@gmail.com','$2y$10$ws8htWbBKH.gmzYN6SSsxO5DTXFNz8phmXSocS6imiC0ULGVsT.uO',1,3,'2023-06-08 03:53:52','2023-06-12 10:49:35',NULL),(9,'otraempresa@gmail.com','$2y$10$IQ/muTAhxRm8SuNonqVbjO5PRLTqv0Zx0iU4XhuAzxVQaYbuYYPTe',1,3,'2023-06-08 04:00:15','2023-06-12 10:54:43',NULL),(10,'candidato1@gmail.com','$2y$10$.V8UFzcJQBoLG9HsofSTreOEeSY7IryBeg9VfNDm9a7dK5h28k1PG',0,4,'2023-06-09 08:12:37',NULL,'2023-06-16 11:22:26'),(11,'candidato2@gmail.com','$2y$10$ma8DCNKhtlcJ9W.53UzOf.3/PkglCLKvuaZEnHws.GpVgZ4OcPBmS',0,4,'2023-06-09 08:18:28',NULL,'2023-06-16 11:22:18'),(12,'sinrol@gmail.com','$2y$10$t7ayYXUbiETvAV7bvQxg/uL3qFzQ.2lkUS/GSZR2DAWe9tGbXLhb.',1,NULL,'2023-06-09 09:25:44',NULL,NULL),(13,'rocio@hotmail.com','$2y$10$ZmVdMEADGgpc9spUBZUaxO4fD1vRHeOeAaY9p5NV2tfPZoG87RGrG',1,3,'2023-06-09 10:19:39','2023-06-12 10:58:58',NULL),(14,'samuel_candidato@gmail.com','$2y$10$IN4Iz.QOPlC/I7S4k8EGDO0eSVOZkz.z03dxf0aqjgPJLUrMtR9v.',1,4,'2023-06-09 10:37:29',NULL,NULL),(15,'nueva_empresa@gmail.com','$2y$10$INsbflm4qV4AEnU8bzMyzu8XIsStsamomTvU7NXJnA7UV.f.b/Foa',1,3,'2023-06-09 10:53:17','2023-06-09 10:53:37',NULL),(16,'soynuevo@gmail.com','$2y$10$61hiiuMFEvEf0Svo8rwKS.ej5N7cb7k8L4hqtnCPSBIi0Iq1xQQVW',1,3,'2023-06-09 03:11:58','2023-06-12 10:59:24',NULL),(17,'nu@gmail.com','$2y$10$YVREjsiIsMy.0Z7D4WeOJeGfiXHW.0UOt2/IMdZyyzfgVi3Z.96Dq',1,3,'2023-06-12 11:39:16',NULL,NULL),(18,'ca@gmail.com','$2y$10$hUFYoYifZ6LbRhRC7fUiWuubjowtKNChob8oieN9hfC.qF0/fSvTS',1,4,'2023-06-12 11:42:39','2023-06-16 03:52:23',NULL),(19,'g@mail.com','$2y$10$YomCvfd10BWzUXCpn.MPVOaezfzwX5MIj8Xr/ouptNjhKTntuH2SK',1,4,'2023-06-12 12:44:54','2023-06-16 11:42:44','2023-06-16 11:22:04'),(20,'unadmin@gmail.com','$2y$10$rx4Wvx0BZ96ySZpCQsZzV.afRVn6c.s7qVPAaYt6gdXsB8rogXWdG',1,2,'2023-06-13 08:22:22',NULL,NULL),(21,'candidatonuevo@gmail.com','$2y$10$u3E.BAYJRy8sqHgPbsSK6elXdOH9dkBYvijvv9mBxqd8l8Ltda4Ni',1,4,'2023-06-16 11:03:08','2023-06-16 03:52:39',NULL),(22,'nuevo@nuevo.com','$2y$10$naK02FVcRi3fQ5bjVa6Ax.izK4Eh98O3Q6Ur/jl5EUJ/.dlhdguR.',1,4,'2023-06-16 11:25:56','2023-06-16 12:43:10',NULL),(23,'jj@gmail.com','$2y$10$Vq1CyyBWI/QRczxtOfAqqe6kaCupJ.rPowhsflBYQM1kF6odtPG2.',1,3,'2023-06-16 01:12:50',NULL,NULL),(24,'a@gmail.com','$2y$10$UNW5YL4xhMV0mhPhJ8vgl.TZPll.xf2w9ncYCpu7ey4ugMVlW2K6y',1,4,'2023-06-16 02:30:22','2023-06-16 03:46:46',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacancies`
--

DROP TABLE IF EXISTS `vacancies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vacancies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vacancy` varchar(45) NOT NULL,
  `description` varchar(150) NOT NULL,
  `company_id` int NOT NULL,
  `area_id` int NOT NULL,
  `min_salary` decimal(10,2) DEFAULT '0.00',
  `max_salary` decimal(10,2) DEFAULT '0.00',
  `job_type` enum('Medio Tiempo','Tiempo Completo','Prácticas') NOT NULL COMMENT 'AUN NO IMPLEMENTADO',
  `schedules` text NOT NULL,
  `more_info` longtext,
  `tags_ids` text,
  `publication_date` datetime DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `requirements` text,
  `necessary_experience` text,
  `benefits` text,
  `days` varchar(100) DEFAULT NULL COMMENT 'Dias a laborar, AUN NO IMPLEMENTADO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacancies`
--

LOCK TABLES `vacancies` WRITE;
/*!40000 ALTER TABLE `vacancies` DISABLE KEYS */;
INSERT INTO `vacancies` VALUES (1,'Contador Público','Hará esto y aquello...',1,4,500.00,10000.00,'Prácticas','8 horas - Lunes a viernes','<p><b>en negritas</b>, ya no hay negritas</p><p><b>Requisitos</b></p><ul><li><b>Lsita1</b></li><li><b>Lista 2</b></li></ul>','4','2023-06-07 00:00:00','2023-06-08 23:59:59',1,'2023-06-02 11:35:25','2023-06-05 12:18:38',NULL,NULL,NULL,NULL,NULL),(2,'Programador','asdasjdkjasdkljaslkdjasñldasdas',2,2,15000.00,25000.00,'Tiempo Completo','6 horas - Lunes a sábado','<p>Hola mundo</p><p><b>Requerimientos</b></p><ul><li>Esto</li><li>Aquello</li><li>lo otro</li></ul><p><b>Beneficios</b></p><ul><li>benefi 1</li><li>el 2</li></ul>','4','2023-06-08 00:00:00','2023-06-26 23:59:59',1,'2023-06-02 02:26:50','2023-06-14 01:40:15','2023-06-05 08:23:33',NULL,NULL,NULL,NULL),(3,'Iste sint et vel pra','Dolorem id eaque mo',1,3,150.00,250.00,'Prácticas','Odit illo vel volupt','Dolore sunt voluptat.','4','2023-06-04 00:00:00','2023-10-26 23:59:59',1,'2023-06-05 08:58:03','2023-06-05 12:49:25',NULL,NULL,NULL,NULL,NULL),(4,'Auxiliar de programación','Temporibus molestiae',2,1,12000.00,15000.00,'Tiempo Completo','4 horas - Lunes a viernes','<p><b>las negritas</b></p><p>Expedita Nam tempore.</p>','4','2023-06-05 00:00:00','2023-06-30 23:59:59',1,'2023-06-05 09:00:32','2023-06-14 01:41:41',NULL,NULL,NULL,NULL,NULL),(5,'Practicante de contabilidad','Id aut cumque labor',1,4,1000.00,2500.00,'Prácticas','4 horas - Lunes a viernes','Quam quibusdam aperi.','4','2020-08-24 00:00:00','2023-02-12 23:59:59',1,'2023-06-05 09:07:13','2023-06-14 01:39:45',NULL,NULL,NULL,NULL,NULL),(6,'Jefe de calidad','Laborum voluptas et ',2,2,25000.00,30000.00,'Tiempo Completo','8 horas - Lunes a viernes | 4 horas Sábados','Rerum architecto aut.','4','2016-04-28 00:00:00','2023-12-27 23:59:59',1,'2023-06-05 09:08:01','2023-06-14 01:39:33',NULL,NULL,NULL,NULL,NULL),(8,'Auxiliar Contable - Editada','Descripción de la vacante. Descripción de la vacante.  Descripción de la vacante.  Descripción de la vacante.  Descripción de la vacante.  Descripción',7,1,8000.00,11500.00,'Tiempo Completo','8 horas - Lunes a viernes','<p class=\"\">\n						<span class=\"fw-bolder\">Requisitos</span>\n						</p><ul class=\"\" id=\"output_requirements\">\n							<li>Requerimiento 1</li>\n							<li>Requerimiento 1</li>\n							<li>Requerimiento 1</li>\n						</ul>\n					<p></p>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Expriencia necesaria</span>\n						</p><ul class=\"\" id=\"output_necessary_experience\">\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n						</ul>\n					<p></p>\n					<!-- ./ DETALLES DEL EMPELO -->\n					<hr>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Beneficios</span>\n						</p><ul class=\"\" id=\"output_benefits\">\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n						</ul>\n					<p></p>','4','2023-06-08 00:00:00','2023-06-16 23:59:59',1,'2023-06-08 02:06:37','2023-06-14 01:37:43',NULL,NULL,NULL,NULL,NULL),(9,'Emprendedor','XXX......',13,2,1000.00,1500.00,'Tiempo Completo','8 horas - Lunes a viernes | 4 horas Sábados','<p class=\"\">\n						<span class=\"fw-bolder\">Requisitos</span>\n						</p><ul class=\"\" id=\"output_requirements\">\n							<li>Carismático</li>\n							<li>Autodidacta</li>\n							<li>Requerimiento 1</li>\n						</ul>\n					<p></p>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Expriencia necesaria</span>\n						</p><ul class=\"\" id=\"output_necessary_experience\">\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n						</ul>\n					<p></p>\n					<!-- ./ DETALLES DEL EMPELO -->\n					<hr>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Beneficios</span>\n						</p><ul class=\"\" id=\"output_benefits\">\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li></ul><p><a href=\"http://www.google.com\" target=\"_blank\">www.google.com</a><br></p><ul class=\"\" id=\"output_benefits\">\n						</ul>\n					<p></p>','4','2023-06-09 00:00:00','2023-06-16 23:59:59',1,'2023-06-09 10:31:18','2023-06-14 01:37:31',NULL,NULL,NULL,NULL,NULL),(10,'Emprendedor','Descripción de la vacante.......',13,2,100.00,150.00,'Tiempo Completo','8 horas - Lunes a viernes','<p class=\"\">\n						<span class=\"fw-bolder\">Requisitos</span>\n						</p><ul class=\"\" id=\"output_requirements\">\n							<li>Requerimiento 1</li>\n							<li>Requerimiento 1</li>\n							<li>Requerimiento 1</li>\n						</ul>\n					<p></p>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Expriencia necesaria</span>\n						</p><ul class=\"\" id=\"output_necessary_experience\">\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n						</ul>\n					<p></p>\n					<!-- ./ DETALLES DEL EMPELO -->\n					<hr>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Beneficios</span>\n						</p><ul class=\"\" id=\"output_benefits\">\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n						</ul>\n					<p></p>','4','2023-06-09 00:00:00','2023-06-16 23:59:59',0,'2023-06-09 10:32:32','2023-06-14 01:36:56','2023-06-14 01:37:15',NULL,NULL,NULL,NULL),(11,'Auxiliar de calidad','sadsadas',16,2,150.00,250.00,'Prácticas','8 horas - Lunes a viernes | 4 horas Sábados','<p class=\"\"><span class=\"fw-bolder\">Requisitos</span></p><ul class=\"\" id=\"output_requirements\"><li>Requerimiento 1</li><li>Requerimiento 1</li><li>Requerimiento 1</li></ul><p></p><p class=\"\"><span class=\"fw-bolder\">Expriencia necesaria</span></p><ul class=\"\" id=\"output_necessary_experience\"><li>Experiencias 1</li><li>Experiencias 1</li><li>Experiencias 1</li></ul><p></p><hr><p class=\"\"><span class=\"fw-bolder\">Beneficios</span></p><ul class=\"\" id=\"output_benefits\"><li>Beneficio 1</li><li>Beneficio 1</li><li>Beneficio 1</li></ul><p></p>','1,2,4','2023-06-16 00:00:00','2023-06-23 23:59:59',1,'2023-06-16 01:19:05',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `vacancies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_candidates`
--

DROP TABLE IF EXISTS `vw_candidates`;
/*!50001 DROP VIEW IF EXISTS `vw_candidates`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_candidates` AS SELECT 
 1 AS `id`,
 1 AS `name`,
 1 AS `last_name`,
 1 AS `cellphone`,
 1 AS `age`,
 1 AS `professional_info`,
 1 AS `photo_path`,
 1 AS `cv_path`,
 1 AS `languages`,
 1 AS `profession_id`,
 1 AS `interest_tags_ids`,
 1 AS `enable`,
 1 AS `user_id`,
 1 AS `experiencies_ids`,
 1 AS `skills`,
 1 AS `abilities`,
 1 AS `email`,
 1 AS `created_at`,
 1 AS `profession`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_companies`
--

DROP TABLE IF EXISTS `vw_companies`;
/*!50001 DROP VIEW IF EXISTS `vw_companies`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_companies` AS SELECT 
 1 AS `id`,
 1 AS `company`,
 1 AS `description`,
 1 AS `logo_path`,
 1 AS `contact_name`,
 1 AS `contact_phone`,
 1 AS `contact_email`,
 1 AS `state`,
 1 AS `municipality`,
 1 AS `business_line_id`,
 1 AS `company_ranking_id`,
 1 AS `user_id`,
 1 AS `business_line`,
 1 AS `company_ranking`,
 1 AS `cr_description`,
 1 AS `email`,
 1 AS `created_at`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vw_candidates`
--

/*!50001 DROP VIEW IF EXISTS `vw_candidates`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_candidates` AS select `c`.`id` AS `id`,`c`.`name` AS `name`,`c`.`last_name` AS `last_name`,`c`.`cellphone` AS `cellphone`,`c`.`age` AS `age`,`c`.`professional_info` AS `professional_info`,`c`.`photo_path` AS `photo_path`,`c`.`cv_path` AS `cv_path`,`c`.`languages` AS `languages`,`c`.`profession_id` AS `profession_id`,`c`.`interest_tags_ids` AS `interest_tags_ids`,`c`.`enable` AS `enable`,`c`.`user_id` AS `user_id`,`c`.`experiencies_ids` AS `experiencies_ids`,`c`.`skills` AS `skills`,`c`.`abilities` AS `abilities`,`u`.`email` AS `email`,`u`.`created_at` AS `created_at`,`p`.`profession` AS `profession` from ((`candidates` `c` join `professions` `p` on((`p`.`id` = `c`.`profession_id`))) join `users` `u` on((`c`.`user_id` = `u`.`id`))) where (`u`.`active` = 1) order by `c`.`id` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_companies`
--

/*!50001 DROP VIEW IF EXISTS `vw_companies`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_companies` AS select `c`.`id` AS `id`,`c`.`company` AS `company`,`c`.`description` AS `description`,`c`.`logo_path` AS `logo_path`,`c`.`contact_name` AS `contact_name`,`c`.`contact_phone` AS `contact_phone`,`c`.`contact_email` AS `contact_email`,`c`.`state` AS `state`,`c`.`municipality` AS `municipality`,`c`.`business_line_id` AS `business_line_id`,`c`.`company_ranking_id` AS `company_ranking_id`,`c`.`user_id` AS `user_id`,`bl`.`business_line` AS `business_line`,`cr`.`company_ranking` AS `company_ranking`,`cr`.`description` AS `cr_description`,`u`.`email` AS `email`,`u`.`created_at` AS `created_at` from (((`companies` `c` join `users` `u` on((`c`.`user_id` = `u`.`id`))) join `business_lines` `bl` on((`c`.`business_line_id` = `bl`.`id`))) join `company_rankings` `cr` on((`c`.`company_ranking_id` = `cr`.`id`))) where (`u`.`active` = 1) order by `c`.`id` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-16 16:04:01
