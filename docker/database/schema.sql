# Schema inicial do Database

-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: media_checking
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lib_tipo_midia`
--

DROP TABLE IF EXISTS `lib_tipo_midia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lib_tipo_midia` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NOW(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lib_tipo_midia`
--

/*!40000 ALTER TABLE `lib_tipo_midia` DISABLE KEYS */;
INSERT INTO `lib_tipo_midia` VALUES (1,'Imagem','2023-09-18 18:18:55',NULL,NULL),(2,'Vídeo','2023-09-18 18:18:55',NULL,NULL),(3,'N/A','2023-09-18 18:18:55','2023-09-22 21:05:19',NULL),(8,'teste 1','2023-09-22 20:36:15','2023-09-22 20:36:15',NULL);
/*!40000 ALTER TABLE `lib_tipo_midia` ENABLE KEYS */;

--
-- Table structure for table `lib_vertical`
--

DROP TABLE IF EXISTS `lib_vertical`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lib_vertical` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tipo_midia_id` bigint unsigned NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NOW(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lib_vertical_tipo_midia_id_foreign` (`tipo_midia_id`),
  CONSTRAINT `lib_vertical_tipo_midia_id_foreign` FOREIGN KEY (`tipo_midia_id`) REFERENCES `lib_tipo_midia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lib_vertical`
--

/*!40000 ALTER TABLE `lib_vertical` DISABLE KEYS */;
INSERT INTO `lib_vertical` VALUES (1,2,'DOOH Embarcado',1,'2023-09-13 18:33:05',NULL,NULL),(2,3,'Navee',0,'2023-09-14 18:33:05','2023-10-04 15:35:38',NULL),(3,1,'Sinalização Interna',0,'2023-09-15 18:33:05','2023-10-04 15:35:54',NULL),(4,1,'OOH',1,'2023-09-16 18:33:05',NULL,NULL),(5,2,'DOOH Terminais',1,'2023-09-17 18:33:05',NULL,NULL),(6,3,'Serviços e Experiênciais',0,'2023-09-18 18:33:05','2023-10-04 15:35:26',NULL);
/*!40000 ALTER TABLE `lib_vertical` ENABLE KEYS */;

--
-- Table structure for table `lib_produto`
--

DROP TABLE IF EXISTS `lib_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lib_produto` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vertical_id` bigint unsigned NOT NULL,
  `tipo_midia_id` bigint NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_lar` decimal(8,2) unsigned NOT NULL,
  `area_alt` decimal(8,2) unsigned NOT NULL,
  `visual_lar` decimal(8,2) unsigned NOT NULL,
  `visual_alt` decimal(8,2) unsigned NOT NULL,
  `palco_lar` bigint DEFAULT NULL,
  `palco_alt` bigint DEFAULT NULL,
  `status_palco` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NOW(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lib_produto_vertical_id_foreign` (`vertical_id`),
  CONSTRAINT `lib_produto_vertical_id_foreign` FOREIGN KEY (`vertical_id`) REFERENCES `lib_vertical` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lib_produto`
--

/*!40000 ALTER TABLE `lib_produto` DISABLE KEYS */;
INSERT INTO `lib_produto` VALUES (1,4,1,'Bilheteria (Frente)',1.55,2.92,1.55,2.92,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(2,4,1,'Bilheteria (Lateral)',3.70,2.92,3.70,2.92,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(3,4,1,'Bilheteria (Traseira)',2.92,1.65,2.92,1.65,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(4,4,1,'MUB Vertical',1.19,1.79,1.12,1.72,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(5,4,1,'Painel Plataforma Vertical / Painel Bilheteria',1.23,2.34,1.15,2.26,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(6,4,1,'Painel Plataforma Horizontal',2.34,1.23,2.26,1.15,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(7,4,1,'Painel Entrada',2.93,1.43,2.87,1.37,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(8,4,1,'Painel Entrada Adesivo',2.93,1.43,2.93,1.43,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(9,4,1,'Catracas (Comum)',0.00,0.00,0.00,0.00,NULL,NULL,0,0,'2023-09-22 19:50:47','2023-10-04 16:06:25',NULL),(10,4,1,'Catracas (Cadeirante)',0.00,0.00,0.00,0.00,NULL,NULL,0,0,'2023-09-22 19:50:47','2023-10-04 16:06:12',NULL),(11,4,1,'Catracas (Estreita)',0.00,0.00,0.00,0.00,NULL,NULL,0,0,'2023-09-22 19:50:47','2023-10-04 16:05:50',NULL),(12,4,1,'Mega Coluna',1.36,3.96,1.30,3.90,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(13,4,1,'Painel Quadrado (Antigo Painel Muro)',2.35,2.35,2.30,2.30,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(14,4,1,'Testeira BB',3.95,0.75,3.90,0.70,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(15,4,1,'Painel Aéreo',3.95,1.45,3.90,1.40,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(16,4,1,'Painel Placa',3.80,2.50,3.80,2.50,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(17,4,1,'Mega Painel 1 e 2',16.83,2.43,16.76,2.36,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(18,4,1,'Testeira',4.04,0.49,4.04,0.49,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(19,4,1,'Painel Passarela',4.80,3.00,4.80,3.00,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(20,4,1,'Painel Externo',3.00,1.00,3.00,1.00,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(21,4,1,'Testeiras',3.12,0.84,3.12,0.84,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(22,4,1,'Testeira Escada',3.72,0.67,3.72,0.67,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(23,4,1,'Painel Subida Escada',2.30,2.15,2.24,2.09,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(24,4,1,'Painel Quadrado',2.35,2.35,2.30,2.30,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(25,4,1,'Painel Giga',22.78,4.19,22.78,4.19,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(26,4,1,'Painel Fundão',5.00,2.50,5.00,2.50,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(27,4,1,'Lycra Modelo 1',3.50,4.40,3.50,4.40,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(28,4,1,'Lycra Modelo 2',4.40,5.00,4.40,5.00,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(29,4,1,'Lycra Modelo 3',2.90,2.60,2.90,2.60,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(30,4,1,'Lycra Modelo 4',6.20,4.20,6.20,4.20,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(31,4,1,'Lycra Modelo 5',6.90,4.20,6.90,4.20,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(32,4,1,'Painel Aéreo',6.00,1.30,6.00,1.30,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(33,4,1,'Painel Placa Horizontal Interna',5.00,3.00,5.00,3.00,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(34,4,1,'Painel Placa Horizontal Externa',4.00,2.00,4.00,2.00,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(35,3,1,'Custo Backseat',0.00,0.00,0.00,0.00,NULL,NULL,0,0,'2023-09-22 19:50:47','2023-10-04 16:02:21',NULL),(36,4,1,'Painel Plataforma com Assento Acoplado',2.30,1.00,2.40,1.10,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(37,4,1,'Envelopamento Fachada Sala Vip 1',3.10,2.03,3.10,2.03,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(38,4,1,'Envelopamento Fachada Sala Vip 2',3.20,2.03,3.20,2.03,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(39,4,1,'Envelopamento Fachada Sala Vip 3',1.60,2.03,1.60,2.03,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(40,4,1,'Envelopamento Fachada Sala Vip 4',2.96,2.03,2.96,2.03,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(41,4,1,'Envelopamento Fachada Sala Vip 5',3.15,2.03,3.15,2.03,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(42,4,1,'Envelopamento Fachada Sala Vip 6',3.05,2.03,3.05,2.03,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(43,4,1,'Painel de Coluna',0.60,2.70,0.68,2.78,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(44,4,1,'Painel Master Backlight',2.86,1.35,2.93,1.43,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(45,4,1,'Painel de Coluna Backlight Embarque',0.56,1.10,0.59,1.13,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(46,4,1,'Painel de Coluna Clássico',0.72,1.13,0.72,1.13,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(47,4,1,'Painel Coluna Backlight',0.70,2.00,0.68,1.98,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(48,4,1,'Painel Coluna Desembarque',0.68,1.94,0.68,1.94,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(49,4,1,'Painel Master Backlight',2.86,1.35,2.93,1.43,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(50,4,1,'Mub',1.10,1.70,1.20,1.80,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(51,4,1,'Mub Backlight',1.10,1.70,1.20,1.80,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(52,4,1,'Totem de Plataforma',0.61,1.35,0.63,1.37,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(53,4,1,'Testeiras Backlight',3.90,0.90,3.98,0.98,NULL,NULL,0,1,'2023-09-22 19:50:47',NULL,NULL),(54,1,2,'DOOH (TV Ônibus)',1366.00,768.00,1366.00,768.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(55,5,2,'Mega Aéreo (Alvorada)',686.00,342.00,686.00,342.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(56,5,2,'Picolé (Alvorada)',170.00,342.00,170.00,342.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(57,5,2,'Mega Aéreo (Campo Grande)',550.00,270.00,550.00,270.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(58,5,2,'Testeiras (Campo Grande)',410.00,140.00,410.00,140.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(59,5,2,'CDT (Paulo Portela)',1440.00,144.00,1440.00,144.00,1920,1080,0,1,'2023-09-22 19:50:47',NULL,NULL),(60,5,2,'Telão P6 (Duque de Caxias)',572.00,304.00,572.00,304.00,1366,768,1,1,'2023-09-22 19:50:47',NULL,NULL),(61,5,2,'Painel Marquise P6 (Duque de Caxias)',510.00,204.00,510.00,204.00,1366,768,1,1,'2023-09-22 19:50:47',NULL,NULL),(62,5,2,'Totem Digital 42\" e 49\" (Duque de Caxias)',1366.00,768.00,1366.00,768.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(63,5,2,'Telas 40\" (Duque de Caxias)',1366.00,768.00,1366.00,768.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(64,5,2,'Dispenser de Álcool em Gel (Duque de Caxias)',1366.00,768.00,1366.00,768.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(65,5,2,'Telão LED P4 (Nilópolis)',768.00,510.00,768.00,510.00,1366,768,1,1,'2023-09-22 19:50:47',NULL,NULL),(66,5,2,'TV 32\" (Nilópolis)',1366.00,768.00,1366.00,768.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(67,5,2,'TV 40\" (Menezes Cortes)',1366.00,768.00,1366.00,768.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(68,5,2,'Dispenser de Álcool em Gel (Menezes Cortes)',768.00,1366.00,768.00,1366.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(69,5,2,'Carregador Digital 32\" (Menezes Cortes)',768.00,1366.00,768.00,1366.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(70,5,2,'Telão LED P4 Full Color (Nova Iguaçu)',288.00,586.00,288.00,586.00,1366,768,1,1,'2023-09-22 19:50:47',NULL,NULL),(71,5,2,'TV 32\" (Nova Iguaçu)',1366.00,768.00,1366.00,768.00,1366,768,0,1,'2023-09-22 19:50:47',NULL,NULL),(73,4,1,'Painel Saída da Passarela',2.10,0.85,2.10,0.85,NULL,NULL,0,1,'2023-09-29 17:22:50','2023-10-05 23:03:57',NULL);
/*!40000 ALTER TABLE `lib_produto` ENABLE KEYS */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(6,'2016_06_01_000004_create_oauth_clients_table',1),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(8,'2019_08_19_000000_create_failed_jobs_table',1),(9,'2019_12_14_000001_create_personal_access_tokens_table',1),(10,'2023_09_11_195836_create_lib_tipo_midia',1),(11,'2023_09_11_196603_create_lib_vertical',1),(12,'2023_09_11_202558_create_lib_produto',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `users` DISABLE KEYS (senha do Admin: teste123)*/;
INSERT INTO `users` 
VALUES (1,'Admin','test@exemple.com',NULL,
  '$2y$10$HmUO845Pvp1/FpQgLJ6MCO/kUxfKSkuiOI23mJlGQTNkkr1JtCUFm',NULL,
  '2023-09-12 22:22:57','2023-10-04 19:54:00'),
  (2,'Robson Souza','robson.souza@onbusdigital.com.br',NULL,
  '$2y$10$HmUO845Pvp1/FpQgLJ6MCO/kUxfKSkuiOI23mJlGQTNkkr1JtCUFm',NULL,
  '2023-09-12 22:22:57','2023-10-04 19:54:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('robson.souza@onbusdigital.com.br','$2y$10$iUgJWx8FNCghblFSsDgKy.LcC2Ri3xl93kMQ.3nnMm5KU9h4jHTRG','2023-10-04 19:54:29');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'media_checking'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-06  7:46:51
