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
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vacancy_id` int NOT NULL,
  `candidate_id` int NOT NULL,
  `status` enum('Pendiente','Recibida','En evaluación','Aceptada','Rechazada','Cancelada') NOT NULL DEFAULT 'Pendiente',
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `canceled_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,2,1,'En evaluación',1,'2023-06-06 02:26:52','2023-06-08 03:39:57',NULL),(13,1,1,'Pendiente',1,'2023-06-08 01:04:02',NULL,NULL),(14,3,1,'Cancelada',1,'2023-06-08 01:04:34','2023-06-08 01:28:10',NULL),(15,8,1,'Recibida',1,'2023-06-08 02:08:08','2023-06-08 03:46:29',NULL);
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `area` varchar(45) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Informática',1,'2023-05-17 08:57:09',NULL,NULL),(2,'Calidad',1,'2023-05-17 08:57:12',NULL,NULL),(3,'Recursos Humanos',1,'2023-05-17 08:57:18',NULL,NULL),(4,'Contabilidad',1,'2023-05-23 10:10:47',NULL,NULL),(5,'Finanzas',1,'2023-05-23 10:10:49',NULL,NULL);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_lines`
--

DROP TABLE IF EXISTS `business_lines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `business_lines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `business_line` varchar(45) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_lines`
--

LOCK TABLES `business_lines` WRITE;
/*!40000 ALTER TABLE `business_lines` DISABLE KEYS */;
INSERT INTO `business_lines` VALUES (1,'Tecnologías Informaticas',1,'2023-05-17 08:48:20','2023-05-17 08:57:50',NULL),(2,'Metal Mecánica',1,'2023-05-17 08:58:02',NULL,NULL),(3,'Moda',1,'2023-05-17 08:58:05',NULL,NULL),(4,'Contable',1,'2023-05-23 10:10:40',NULL,NULL);
/*!40000 ALTER TABLE `business_lines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `candidates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `cellphone` varchar(10) NOT NULL,
  `age` int NOT NULL,
  `professional_info` longtext,
  `cv_path` varchar(100) DEFAULT NULL,
  `languages` text,
  `area_id` int DEFAULT NULL,
  `interest_tags_ids` text,
  `user_id` int NOT NULL,
  `experiencies_ids` text,
  `skills` text COMMENT 'Competencias',
  `abilities` text COMMENT 'Habilidades',
  PRIMARY KEY (`id`),
  KEY `fk_candidate_user_idx` (`user_id`),
  CONSTRAINT `fk_candidate_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidates`
--

LOCK TABLES `candidates` WRITE;
/*!40000 ALTER TABLE `candidates` DISABLE KEYS */;
INSERT INTO `candidates` VALUES (1,'Candidato 1','Del 1','8784531313',26,'<p><br></p>','','Inglés - Básico',0,'null',7,NULL,NULL,NULL);
/*!40000 ALTER TABLE `candidates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'La Nueva Empresa','Enim irure tota','companies/Meyer Dennis Traders.PNG','Zelda Summers','2131231313','rh@gmail.com','Coahuila','Torreon',3,2,1),(2,'Morrison Hester Traders','Culpa expedita ','companies/Morrison Hester Traders.JPEG','Eleanor Massey','5464544646','dasexun@mailinator.com','Chiapas','Acala',4,1,2),(7,'Empresa  1','soy una empresa',NULL,'Contacto 1','4165876878','rh@gmail.com','Coahuila','Torreon',1,1,6),(9,'Empresa Registrada','Esta es una empresa creada desde el administrativo.',NULL,'Micaela Juárez','8774464446','rh@gmail.com','Campeche','Calkini',2,3,4),(10,'Creando empresa','Creando empresa desde el admin a un usuario ya existente.',NULL,'Natalia Morones','7895432454','rh@gmail.com','Durango','Gomez Palacio',3,3,3),(11,'Seré Empresa','Soy una empresa de prubea.',NULL,'Nancy Najera','8711564464','rh@gmail.com','Zacatecas','Banon',2,2,8),(12,'Otra empresa','asdasjklsadlñ',NULL,'Contacto 1','7897513135','rh@gmail.com','Guerrero','Acapulco',2,2,9);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_rankings`
--

DROP TABLE IF EXISTS `company_rankings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `company_rankings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_ranking` varchar(45) NOT NULL,
  `description` varchar(50) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
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
/*!50503 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
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
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu` varchar(100) NOT NULL,
  `description` text,
  `tag` varchar(100) NOT NULL,
  `belongs_to` int NOT NULL,
  `file_path` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT 'fa-light fa-circle',
  `order` int DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `show_counter` tinyint NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Administración',NULL,'admin',0,'#','fa-solid fa-folder-tree',1,1,1,'2023-05-08 14:00:00','2023-06-07 11:23:23',NULL),(2,'Usuarios',NULL,'users',1,'usuarios.php','fa-light fa-users',1,1,1,'2023-05-08 14:02:00','2023-06-07 11:32:49',NULL),(3,'Módulos',NULL,'modules',1,'modulos.php','fa-light fa-kaaba',2,1,0,'2023-05-08 14:03:00','2023-05-17 09:03:28',NULL),(4,'Giros',NULL,'business_lines',1,'giros.php','fa-light fa-briefcase',NULL,1,0,'2023-05-15 11:38:46','2023-05-17 09:03:46',NULL),(5,'Etiquetas',NULL,'tags',1,'etiquetas.php','fa-light fa-tags',NULL,1,0,'2023-05-17 07:45:23',NULL,NULL),(6,'Áreas',NULL,'areas',1,'areas.php','fa-light fa-objects-column',NULL,1,0,'2023-05-17 07:50:08','2023-05-17 08:47:09',NULL),(7,'Clasificaciones de Empresa',NULL,'company_rankigns',1,'clasificaciones-empresa.php','far fa-circle',NULL,1,0,'2023-05-17 07:56:22',NULL,NULL),(8,'Empresas',NULL,'companies',0,'#','fa-solid fa-buildings',NULL,1,1,'2023-05-17 09:01:43','2023-06-07 11:33:26',NULL),(9,'Listado',NULL,'companies_list',8,'empresas.php','fa-sharp fa-light fa-list-tree',NULL,1,0,'2023-05-25 11:57:34','2023-06-06 02:52:09',NULL),(10,'Vacantes',NULL,'vacancies',8,'vacantes.php','fa-light fa-file-lines',NULL,1,0,'2023-06-01 10:03:35',NULL,NULL),(11,'Candidatos',NULL,'canidates',0,'#','fa-solid fa-user-tie',NULL,1,0,'2023-06-06 02:49:27','2023-06-06 02:49:50',NULL),(12,'Listado',NULL,'candidates_list',11,'candidatos.php','fa-sharp fa-light fa-list-tree',NULL,1,0,'2023-06-06 02:51:32','2023-06-06 02:51:48',NULL),(13,'Solicitudes',NULL,'companies_applications',8,'solicitudes.php','fa-light fa-memo-circle-check',NULL,1,0,'2023-06-06 02:57:46','2023-06-06 02:59:02',NULL),(14,'Mis Solicitudes',NULL,'canidates_applications',11,'mis-solicitudes.php','fa-light fa-memo-circle-check',NULL,1,0,'2023-06-06 02:58:54','2023-06-08 01:54:24',NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(150) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `pages_read` text,
  `pages_write` text,
  `pages_update` text,
  `pages_delete` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SuperAdmin',1,'todas','todas','todas','todas','2023-05-08 08:17:54',NULL,NULL),(2,'Administrativo',1,'1,2,4,5,6,7,8,9,10,11,12,13,14','1,2,4,5,6,7,8,9,10,11,12,13,14','1,2,4,5,6,7,8,9,10,11,12,13,14','1,2,4,5,6,7,8,9,10,11,12,13,14','2023-05-08 08:17:54',NULL,NULL),(3,'Empresa',1,'todas','todas','todas','todas','2023-05-08 08:17:54',NULL,NULL),(4,'Candidato',1,'11,13,14','11,13,14','11,13,14','11,13,14','2023-05-08 08:17:54',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'música',1,'2023-05-17 08:58:21',NULL,NULL),(2,'computadoras',1,'2023-05-17 08:58:25',NULL,NULL),(3,'ropa',1,'2023-05-17 08:58:32',NULL,NULL),(4,'contaduria',1,'2023-05-23 10:11:08',NULL,NULL),(5,'cuentas',1,'2023-05-23 10:11:15',NULL,NULL),(6,'finanzas',1,'2023-05-23 10:11:18',NULL,NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `role_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'nes@gmail.com','$2y$10$L4zA0yzj/cdFSq4RjTDxcOkpwkP9vlCSBfyFQzpw4R0qrECaf38nC',1,1,'2023-05-24 02:45:33','2023-06-08 11:05:21',NULL),(2,'gustavo@gmail.com','$2y$10$VVlv.fewbfZbv5YnqiuCzOsFtYk/GtlUU4eDBR/XYNzsqlkDSMyFi',1,3,'2023-05-24 03:01:33','2023-06-08 02:44:27',NULL),(3,'sam@gmail.com','$2y$10$AU9ZIbk55Io4kfThyijNwua1N3geP7cy2D2hqrvZLq6CY2/fDMYy2',1,3,'2023-06-02 02:54:13',NULL,NULL),(4,'otromx@gmail.com','$2y$10$C4sm7kKwqstdmwK07Cgm9OPssLpzRM787ydudOSGA6AG5uP2eILXe',0,3,'2023-06-07 09:08:00','2023-06-07 09:08:14','2023-06-08 11:13:42'),(5,'editar@gmail','$2y$10$TwHwEjkHz64.YNuzb9aMI.KwQ7KUYz.Tlx1GoHpW6/wWm4x2AQWUu',0,2,'2023-06-07 09:08:47','2023-06-07 09:09:00','2023-06-07 09:10:41'),(6,'empresa@gmail.com','$2y$10$xRAlqJr1OHF8BwbMASsPBO3ZOzjOcFjnePf9AjkfkyjHqBwbN3K8K',1,3,'2023-06-07 11:56:57',NULL,NULL),(7,'candidato@gmail.com','$2y$10$IMmVFwcMcs9r9P.GPuKhxOxbh2RSbDAw8aN4W1moi1.6WXQZ.2RyW',1,4,'2023-06-07 12:16:41',NULL,NULL),(8,'nuevo@gmail.com','$2y$10$ws8htWbBKH.gmzYN6SSsxO5DTXFNz8phmXSocS6imiC0ULGVsT.uO',1,3,'2023-06-08 03:53:52',NULL,NULL),(9,'otraempresa@gmail.com','$2y$10$IQ/muTAhxRm8SuNonqVbjO5PRLTqv0Zx0iU4XhuAzxVQaYbuYYPTe',1,3,'2023-06-08 04:00:15',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacancies`
--

DROP TABLE IF EXISTS `vacancies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacancies`
--

LOCK TABLES `vacancies` WRITE;
/*!40000 ALTER TABLE `vacancies` DISABLE KEYS */;
INSERT INTO `vacancies` VALUES (1,'Contador Público','Hará esto y aquello...',1,4,500.00,10000.00,'Prácticas','8 horas - Lunes a viernes','<p><b>en negritas</b>, ya no hay negritas</p><p><b>Requisitos</b></p><ul><li><b>Lsita1</b></li><li><b>Lista 2</b></li></ul>','4','2023-06-07 00:00:00','2023-06-08 23:59:59',1,'2023-06-02 11:35:25','2023-06-05 12:18:38',NULL,NULL,NULL,NULL,NULL),(2,'Programador','asdasjdkjasdkljaslkdjasñldasdas',2,2,150.00,250.00,'Tiempo Completo','6 horas - Lunes a sábado','<p>Hola mundo</p><p><b>Requerimientos</b></p><ul><li>Esto</li><li>Aquello</li><li>lo otro</li></ul><p><b>Beneficios</b></p><ul><li>benefi 1</li><li>el 2</li></ul>','4','2023-06-08 00:00:00','2023-06-07 23:59:59',1,'2023-06-02 02:26:50','2023-06-05 12:41:18','2023-06-05 08:23:33',NULL,NULL,NULL,NULL),(3,'Iste sint et vel pra','Dolorem id eaque mo',1,3,150.00,250.00,'Prácticas','Odit illo vel volupt','Dolore sunt voluptat.','4','2023-06-04 00:00:00','2023-10-26 23:59:59',1,'2023-06-05 08:58:03','2023-06-05 12:49:25',NULL,NULL,NULL,NULL,NULL),(4,'Incididunt facere un','Temporibus molestiae',2,1,800.00,1000.00,'Tiempo Completo','4 horas - Lunes a viernes','<p><b>las negritas</b></p><p>Expedita Nam tempore.</p>','4','2023-06-05 00:00:00','2023-06-30 23:59:59',1,'2023-06-05 09:00:32','2023-06-05 09:40:32',NULL,NULL,NULL,NULL,NULL),(5,'Veritatis enim quibu','Id aut cumque labor',1,1,15.00,25.00,'Prácticas','Aut unde fugiat har','Quam quibusdam aperi.','2','2020-08-24 00:00:00','2023-02-12 23:59:59',1,'2023-06-05 09:07:13',NULL,NULL,NULL,NULL,NULL,NULL),(6,'Porro quaerat archit','Laborum voluptas et ',2,4,150.00,15550.00,'Medio Tiempo','Illum mollit Nam et','Rerum architecto aut.','2,3,6','2016-04-28 00:00:00','1997-12-27 23:59:59',1,'2023-06-05 09:08:01',NULL,NULL,NULL,NULL,NULL,NULL),(8,'Auxiliar Contable','Descripción de la vacante. Descripción de la vacante.  Descripción de la vacante.  Descripción de la vacante.  Descripción de la vacante.  Descripción',7,1,8000.00,11500.00,'Tiempo Completo','8 horas - Lunes a viernes','<p class=\"\">\n						<span class=\"fw-bolder\">Requisitos</span>\n						</p><ul class=\"\" id=\"output_requirements\">\n							<li>Requerimiento 1</li>\n							<li>Requerimiento 1</li>\n							<li>Requerimiento 1</li>\n						</ul>\n					<p></p>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Expriencia necesaria</span>\n						</p><ul class=\"\" id=\"output_necessary_experience\">\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n							<li>Experiencias 1</li>\n						</ul>\n					<p></p>\n					<!-- ./ DETALLES DEL EMPELO -->\n					<hr>\n					<p class=\"\">\n						<span class=\"fw-bolder\">Beneficios</span>\n						</p><ul class=\"\" id=\"output_benefits\">\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n							<li>Beneficio 1</li>\n						</ul>\n					<p></p>','4','2023-06-08 00:00:00','2023-06-09 23:59:59',1,'2023-06-08 02:06:37','2023-06-08 02:18:42',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `vacancies` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-08 16:01:56
