-- MySQL dump 10.13  Distrib 5.6.43, for Linux (x86_64)
--
-- Host: localhost    Database: frame_sistema
-- ------------------------------------------------------
-- Server version	5.6.43

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_tango` int(11) DEFAULT NULL,
  `nick` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuit` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_number` int(11) NOT NULL,
  `id_country` int(11) NOT NULL,
  `cp` int(11) NOT NULL,
  `location` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_telephone` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_name` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_telephone` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retencion_ganancia` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `iibb` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `iva` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (2,109,'Mixto','24312067978','Estudio Mixto SRL','Mario Bravo',867,2,1175,'buenos Aires','1568788311',NULL,'Sofia Palladino','sofia@estudiomixto.com','1568788311','0','0','0','1','2019-02-19 18:50:15','2019-02-19 18:50:15');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
INSERT INTO `contracts` VALUES (1,'Eventual','1','2019-02-13 18:12:34','2019-02-13 18:12:34'),(2,'Plazo Fijo','1','2019-02-13 18:12:34','2019-02-13 18:12:34'),(3,'Servicios','1','2019-02-13 18:12:34','2019-02-13 18:12:34'),(4,'Tiempo indeterminado','1','2019-03-01 19:21:29','2019-03-01 19:21:29');
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `male` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `female` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Alemania','alemán','alemana','2019-02-13 18:12:33','2019-02-13 18:12:33'),(2,'Argentina','argentino','argentina','2019-02-13 18:12:33','2019-02-13 18:12:33'),(3,'Bolivia','boliviano','boliviana','2019-02-13 18:12:33','2019-02-13 18:12:33'),(4,'Brasil','brasileño','brasileña','2019-02-13 18:12:33','2019-02-13 18:12:33'),(5,'Chile','chileno','chilena','2019-02-13 18:12:33','2019-02-13 18:12:33'),(6,'Colombia','colombiano','colombiana','2019-02-13 18:12:33','2019-02-13 18:12:33'),(7,'Costa Rica','costarricense','costarricense','2019-02-13 18:12:33','2019-02-13 18:12:33'),(8,'Cuba','cubano','cubana','2019-02-13 18:12:33','2019-02-13 18:12:33'),(9,'Ecuador','ecuatoriano','ecuatoriana','2019-02-13 18:12:34','2019-02-13 18:12:34'),(10,'España','español','española','2019-02-13 18:12:34','2019-02-13 18:12:34'),(11,'Francia','francés','francesa','2019-02-13 18:12:34','2019-02-13 18:12:34'),(12,'México','mexicano','mexicana','2019-02-13 18:12:34','2019-02-13 18:12:34'),(13,'Italia','italiano','italiana','2019-02-13 18:12:34','2019-02-13 18:12:34'),(14,'Paraguay','paraguayo','paraguaya','2019-02-13 18:12:34','2019-02-13 18:12:34'),(15,'Perú','peruano','peruana','2019-02-13 18:12:34','2019-02-13 18:12:34'),(16,'Republica Dominicana','dominicano','dominicana','2019-02-13 18:12:34','2019-02-13 18:12:34'),(17,'Uruguay','uruguayo','uruguaya','2019-02-13 18:12:34','2019-02-13 18:12:34'),(18,'Venezuela','venezolano','venezolana','2019-02-13 18:12:34','2019-02-13 18:12:34'),(19,'Estados Unidos','estadounidense','estadounidense','2019-02-13 18:12:34','2019-02-13 18:12:34');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frame_functions`
--

DROP TABLE IF EXISTS `frame_functions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frame_functions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_proyect_category` int(11) NOT NULL,
  `id_workers_category` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frame_functions`
--

LOCK TABLES `frame_functions` WRITE;
/*!40000 ALTER TABLE `frame_functions` DISABLE KEYS */;
INSERT INTO `frame_functions` VALUES (1,'Productor General',NULL,1,'[\"453\"]','1','2019-02-21 01:19:14','2019-04-30 21:26:20'),(4,'Director de programas',NULL,1,'[\"452\"]','1','2019-04-03 16:57:34','2019-04-03 16:57:34'),(5,'Jefe Técnico',NULL,1,'[\"8\"]','1','2019-04-30 21:27:01','2019-04-30 21:27:01');
/*!40000 ALTER TABLE `frame_functions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2015_01_20_084450_create_roles_table',1),(4,'2015_01_20_084525_create_role_user_table',1),(5,'2015_01_24_080208_create_permissions_table',1),(6,'2015_01_24_080433_create_permission_role_table',1),(7,'2015_12_04_003040_add_special_role_column',1),(8,'2017_10_17_170735_create_permission_user_table',1),(9,'2019_01_11_214043_create_clients_table',1),(10,'2019_01_11_220313_add_row_users',1),(11,'2019_01_13_185347_create_countries_table',1),(12,'2019_01_13_185757_create_contracts_table',1),(13,'2019_01_13_190125_create_workdays_table',1),(14,'2019_01_13_190306_create_studies_table',1),(15,'2019_01_16_011325_create_proyect_categories_table',1),(16,'2019_01_16_211256_create_providers_table',1),(17,'2019_01_16_233338_create_frame_functions_table',1),(18,'2019_01_16_233351_create_sat_functions_table',1),(19,'2019_01_17_005831_create_workers_categories_table',1),(20,'2019_01_27_030342_create_projects_table',1),(21,'2019_01_27_185508_create_project_providers_table',1),(22,'2019_02_13_215718_add_row_clients',2),(23,'2019_02_14_183756_drop_column_provider_afip',3),(24,'2019_02_14_184134_add_column_project_provider',3),(25,'2019_02_14_200023_drop_columns_workers_categories',3),(26,'2019_02_15_173148_add_column_clients',4),(27,'2019_02_15_024554_drop_columns_providers',5),(28,'2019_02_18_192152_create_provider_assessments_table',6),(29,'2019_02_19_174458_add_column_user',7),(30,'2019_02_20_122244_update_schema_frame_function',8),(31,'2019_02_20_122539_update_schema_s_a_t_function',8),(32,'2019_02_20_214917_add_column_category_sat',9),(33,'2019_02_21_172914_add_column_crew',10),(34,'2019_02_28_115935_add_columb_project_provider',11),(35,'2019_03_06_012241_add_column_workers_category',12),(36,'2019_03_06_175513_add_column_work_days',13),(37,'2019_03_06_214246_add_column_project_provider',14),(38,'2019_03_11_181530_add_column_project_provider',15),(39,'2019_03_19_194407_add_row_project_providers',16),(40,'2019_03_20_023433_add_column_workers_category',17),(41,'2019_04_01_174627_add_column_project_providers',18),(42,'2019_04_03_180315_update_telephone_providers',19),(43,'2019_04_04_174318_add_column_calendar_drop_other_column',20);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('villalbaezequiel64@gmail.com.ar','$2y$10$Rg2Yv7VLIE7GRIJ4LbXf.eYuH4jJjGKvpN.tkq85qzBPN2tp8xOZG','2019-02-18 20:45:21'),('villalbaezequiel64@gmail.com','$2y$10$h7GPN3rvaF5CU7crY5Oyye9vJXDGRFxDEoFP2XYJFmbwVDLG58fVm','2019-03-11 18:40:04'),('esteban@estudiomixto.com','$2y$10$3xCeMEuNPclqZM6xNVhBw.hYXfbsImOPREyr1kxBt/YuUTTFF2cc.','2019-03-12 05:21:58'),('estebancivilla@gmail.com','$2y$10$2EFV3MY39MbC1VMR7UmcE.IasaoU7jQzDEkHck1UAB2iRCgX7S/iu','2019-03-12 05:23:09');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_user`
--

LOCK TABLES `permission_user` WRITE;
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Navegar roles','roles.index','Lista y navega todos los roles del sistema','2019-02-13 18:12:34','2019-02-13 18:12:34'),(2,'Ver detalle de un rol','roles.show','Ve en detalle cada rol del sistema','2019-02-13 18:12:34','2019-02-13 18:12:34'),(3,'Creación de roles','roles.create','Podría crear nuevos roles en el sistema','2019-02-13 18:12:34','2019-02-13 18:12:34'),(4,'Edición de roles','roles.edit','Podría editar cualquier dato de un rol del sistema','2019-02-13 18:12:34','2019-02-13 18:12:34'),(5,'Eliminar roles','roles.destroy','Podría eliminar cualquier rol del sistema','2019-02-13 18:12:34','2019-02-13 18:12:34'),(6,'Creación de roles Request HTTP','roles.store','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(7,'Edición de roles Request HTTP','roles.update','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(8,'Navegar Clientes','clients.index','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(9,'Ver detalle de Clientes','clients.show','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(10,'Edición de Clientes','clients.edit','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(11,'Eliminar Clientes','clients.destroy','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(12,'Creación de Clientes Request HTTP','clients.store','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(13,'Edición de Clientes Request HTTP','clients.update','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(14,'Creación de Clientes','clients.create','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(15,'Navegar Funciones FRAME','frame_functions.index','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(16,'Ver detalle de Funciones FRAME','frame_functions.show','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(17,'Edición de Funciones FRAME','frame_functions.edit','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(18,'Eliminar Funciones FRAME','frame_functions.destroy','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(19,'Creación de Funciones FRAME Request HTTP','frame_functions.store','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(20,'Edición de Funciones FRAME Request HTTP','frame_functions.update','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(21,'Creación de Funciones FRAME','frame_functions.create','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(22,'Navegar Proyectos','projects.index','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(23,'Ver detalle de Proyectos','projects.show','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(24,'Edición de Proyectos','projects.edit','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(25,'Eliminar Proyectos','projects.destroy','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(26,'Creación de Proyectos Request HTTP','projects.store','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(27,'Edición de Proyectos Request HTTP','projects.update','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(28,'Creación de Proyectos','projects.create','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(29,'Navegar Proveedores','providers.index','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(30,'Ver detalle de Proveedores','providers.show','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(31,'Edición de Proveedores','providers.edit','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(32,'Eliminar Proveedores','providers.destroy','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(33,'Creación de Proveedores Request HTTP','providers.store','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(34,'Edición de Proveedores Request HTTP','providers.update','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(35,'Creación de Proveedores','providers.create','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(36,'Navegar Funciones SAT','sat_functions.index','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(37,'Ver detalle de Funciones SAT','sat_functions.show','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(38,'Edición de Funciones SAT','sat_functions.edit','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(39,'Eliminar Funciones SAT','sat_functions.destroy','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(40,'Creación de Funciones SAT Request HTTP','sat_functions.store','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(41,'Edición de Funciones SAT Request HTTP','sat_functions.update','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(42,'Creación de Funciones SAT','sat_functions.create','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(43,'Navegar Categorias de Trabajos','workers_categories.index','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(44,'Ver detalle de Categorias de Trabajos','workers_categories.show','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(45,'Edición de Categorias de Trabajos','workers_categories.edit','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(46,'Eliminar Categorias de Trabajos','workers_categories.destroy','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(47,'Creación de Categorias de Trabajos Request HTTP','workers_categories.store','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(48,'Edición de Categorias de Trabajos Request HTTP','workers_categories.update','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(49,'Creación de Categorias de Trabajos','workers_categories.create','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(50,'Navegar Utilidades / Contratos','contracts.index','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(51,'Ver detalle de Utilidades / Contratos','contracts.show','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(52,'Edición de Utilidades / Contratos','contracts.edit','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(53,'Eliminar Utilidades / Contratos','contracts.destroy','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(54,'Creación de Utilidades / Contratos Request HTTP','contracts.store','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(55,'Edición de Utilidades / Contratos Request HTTP','contracts.update','...','2019-02-13 18:12:34','2019-02-13 18:12:34'),(56,'Creación de Utilidades / Contratos','contracts.create','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(57,'Navegar Utilidades / Paises','countries.index','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(58,'Ver detalle de Utilidades / Paises','countries.show','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(59,'Edición de Utilidades / Paises','countries.edit','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(60,'Eliminar Utilidades / Paises','countries.destroy','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(61,'Creación de Utilidades / Paises Request HTTP','countries.store','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(62,'Edición de Utilidades / Paises Request HTTP','countries.update','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(63,'Creación de Utilidades / Paises','countries.create','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(64,'Navegar Utilidades / Categorias de Proyectos','proyect_categories.index','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(65,'Ver detalle de Utilidades / Categorias de Proyectos','proyect_categories.show','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(66,'Edición de Utilidades / Categorias de Proyectos','proyect_categories.edit','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(67,'Eliminar Utilidades / Categorias de Proyectos','proyect_categories.destroy','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(68,'Creación de Utilidades / Categorias de Proyectos Request HTTP','proyect_categories.store','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(69,'Edición de Utilidades / Categorias de Proyectos Request HTTP','proyect_categories.update','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(70,'Creación de Utilidades / Categorias de Proyectos','proyect_categories.create','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(71,'Navegar Utilidades / Niveles Educativos','studies.index','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(72,'Ver detalle de Utilidades / Niveles Educativos','studies.show','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(73,'Edición de Utilidades / Niveles Educativos','studies.edit','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(74,'Eliminar Utilidades / Niveles Educativos','studies.destroy','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(75,'Creación de Utilidades / Niveles Educativos Request HTTP','studies.store','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(76,'Edición de Utilidades / Niveles Educativos Request HTTP','studies.update','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(77,'Creación de Utilidades / Niveles Educativos','studies.create','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(78,'Navegar Utilidades / Jornadas de Trabajos','workdays.index','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(79,'Ver detalle de Utilidades / Jornadas de Trabajos','workdays.show','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(80,'Edición de Utilidades / Jornadas de Trabajos','workdays.edit','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(81,'Eliminar Utilidades / Jornadas de Trabajos','workdays.destroy','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(82,'Creación de Utilidades / Jornadas de Trabajos Request HTTP','workdays.store','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(83,'Edición de Utilidades / Jornadas de Trabajos Request HTTP','workdays.update','...','2019-02-13 18:12:35','2019-02-13 18:12:35'),(84,'Creación de Utilidades / Jornadas de Trabajos','workdays.create','...','2019-02-13 18:12:35','2019-02-13 18:12:35');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_providers`
--

DROP TABLE IF EXISTS `project_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_providers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `id_function_frame` int(11) NOT NULL,
  `id_category_sat` int(11) NOT NULL,
  `id_provider` int(11) NOT NULL,
  `id_contract` int(11) NOT NULL,
  `salary_workdays` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_workdays` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_workdays_text` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_contract_category_function` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_daily` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_liquidate` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salaty_difference` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date_contract` timestamp NULL DEFAULT NULL,
  `finish_date_contract` timestamp NULL DEFAULT NULL,
  `count_workdays_crew` int(11) NOT NULL,
  `start_afip` timestamp NULL DEFAULT NULL,
  `finish_afip` timestamp NULL DEFAULT NULL,
  `is_reemplazo` enum('1','0','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_crew_reemplazo` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calendar` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_hours` varchar(2500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_providers`
--

LOCK TABLES `project_providers` WRITE;
/*!40000 ALTER TABLE `project_providers` DISABLE KEYS */;
INSERT INTO `project_providers` VALUES (36,24,2,453,7,1,'1.500,00','7.500,00','mil muchos muchos','40.738,95','1.357,96','42.096,91','710,17','2019-04-09 03:00:00','2019-05-09 03:00:00',5,'2019-04-09 03:00:00','2019-05-09 03:00:00','1','0','{\"20190409\":{\"start\":\"Tue Apr 09 2019 10:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\",\"finish\":\"Tue Apr 09 2019 19:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\"},\"20190410\":{\"start\":\"Wed Apr 10 2019 10:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\",\"finish\":\"Wed Apr 10 2019 19:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\"},\"20190411\":{\"start\":\"Thu Apr 11 2019 10:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\",\"finish\":\"Thu Apr 11 2019 19:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\"},\"20190412\":{\"start\":\"Fri Apr 12 2019 08:30:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\",\"finish\":\"Fri Apr 12 2019 04:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\"},\"20190413\":{\"start\":\"2019-04-13 00:00:00\",\"finish\":\"2019-04-13 00:00:00\"},\"20190414\":{\"start\":\"2019-04-14 00:00:00\",\"finish\":\"2019-04-14 00:00:00\"},\"20190415\":{\"start\":\"2019-04-15 00:00:00\",\"finish\":\"2019-04-15 00:00:00\"},\"20190416\":{\"start\":\"2019-04-16 00:00:00\",\"finish\":\"2019-04-16 00:00:00\"},\"20190417\":{\"start\":\"2019-04-17 00:00:00\",\"finish\":\"2019-04-17 00:00:00\"},\"20190418\":{\"start\":\"2019-04-18 00:00:00\",\"finish\":\"2019-04-18 00:00:00\"},\"20190419\":{\"start\":\"2019-04-19 00:00:00\",\"finish\":\"2019-04-19 00:00:00\"},\"20190420\":{\"start\":\"2019-04-20 00:00:00\",\"finish\":\"2019-04-20 00:00:00\"},\"20190421\":{\"start\":\"2019-04-21 00:00:00\",\"finish\":\"2019-04-21 00:00:00\"},\"20190422\":{\"start\":\"2019-04-22 00:00:00\",\"finish\":\"2019-04-22 00:00:00\"},\"20190423\":{\"start\":\"2019-04-23 00:00:00\",\"finish\":\"2019-04-23 00:00:00\"},\"20190424\":{\"start\":\"2019-04-24 00:00:00\",\"finish\":\"2019-04-24 00:00:00\"},\"20190425\":{\"start\":\"2019-04-25 00:00:00\",\"finish\":\"2019-04-25 00:00:00\"},\"20190426\":{\"start\":\"2019-04-26 00:00:00\",\"finish\":\"2019-04-26 00:00:00\"},\"20190427\":{\"start\":\"2019-04-27 00:00:00\",\"finish\":\"2019-04-27 00:00:00\"},\"20190428\":{\"start\":\"2019-04-28 00:00:00\",\"finish\":\"2019-04-28 00:00:00\"},\"20190429\":{\"start\":\"2019-04-29 00:00:00\",\"finish\":\"2019-04-29 00:00:00\"},\"20190430\":{\"start\":\"2019-04-30 00:00:00\",\"finish\":\"2019-04-30 00:00:00\"},\"20190501\":{\"start\":\"2019-05-01 00:00:00\",\"finish\":\"2019-05-01 00:00:00\"},\"20190502\":{\"start\":\"2019-05-02 00:00:00\",\"finish\":\"2019-05-02 00:00:00\"},\"20190503\":{\"start\":\"2019-05-03 00:00:00\",\"finish\":\"2019-05-03 00:00:00\"},\"20190504\":{\"start\":\"2019-05-04 00:00:00\",\"finish\":\"2019-05-04 00:00:00\"},\"20190505\":{\"start\":\"2019-05-05 00:00:00\",\"finish\":\"2019-05-05 00:00:00\"},\"20190506\":{\"start\":\"2019-05-06 00:00:00\",\"finish\":\"2019-05-06 00:00:00\"},\"20190507\":{\"start\":\"2019-05-07 00:00:00\",\"finish\":\"2019-05-07 00:00:00\"},\"20190508\":{\"start\":\"2019-05-08 00:00:00\",\"finish\":\"2019-05-08 00:00:00\"},\"20190509\":{\"start\":\"2019-05-09 00:00:00\",\"finish\":\"2019-05-09 00:00:00\"}}',NULL,'1','2019-04-09 20:01:40','2019-04-10 01:06:05'),(37,24,2,453,10,1,'1.500,00','7.500,00','mil muchos muchos','40.738,95','1.357,96','1.357,96','710,17','2019-04-09 03:00:00','2019-05-09 03:00:00',5,'2019-04-09 03:00:00','2019-05-09 03:00:00','2','7','{\"20190409\":{\"start\":\"2019-04-09 00:00:00\",\"finish\":\"2019-04-09 00:00:00\"},\"20190410\":{\"start\":\"2019-04-10 00:00:00\",\"finish\":\"2019-04-10 00:00:00\"},\"20190411\":{\"start\":\"2019-04-11 00:00:00\",\"finish\":\"2019-04-11 00:00:00\"},\"20190412\":{\"start\":\"2019-04-12 00:00:00\",\"finish\":\"2019-04-12 00:00:00\"},\"20190413\":{\"start\":\"2019-04-13 00:00:00\",\"finish\":\"2019-04-13 00:00:00\"},\"20190414\":{\"start\":\"2019-04-14 00:00:00\",\"finish\":\"2019-04-14 00:00:00\"},\"20190415\":{\"start\":\"2019-04-15 00:00:00\",\"finish\":\"2019-04-15 00:00:00\"},\"20190416\":{\"start\":\"2019-04-16 00:00:00\",\"finish\":\"2019-04-16 00:00:00\"},\"20190417\":{\"start\":\"2019-04-17 00:00:00\",\"finish\":\"2019-04-17 00:00:00\"},\"20190418\":{\"start\":\"2019-04-18 00:00:00\",\"finish\":\"2019-04-18 00:00:00\"},\"20190419\":{\"start\":\"2019-04-19 00:00:00\",\"finish\":\"2019-04-19 00:00:00\"},\"20190420\":{\"start\":\"2019-04-20 00:00:00\",\"finish\":\"2019-04-20 00:00:00\"},\"20190421\":{\"start\":\"2019-04-21 00:00:00\",\"finish\":\"2019-04-21 00:00:00\"},\"20190422\":{\"start\":\"2019-04-22 00:00:00\",\"finish\":\"2019-04-22 00:00:00\"},\"20190423\":{\"start\":\"2019-04-23 00:00:00\",\"finish\":\"2019-04-23 00:00:00\"},\"20190424\":{\"start\":\"2019-04-24 00:00:00\",\"finish\":\"2019-04-24 00:00:00\"},\"20190425\":{\"start\":\"2019-04-25 00:00:00\",\"finish\":\"2019-04-25 00:00:00\"},\"20190426\":{\"start\":\"2019-04-26 00:00:00\",\"finish\":\"2019-04-26 00:00:00\"},\"20190427\":{\"start\":\"2019-04-27 00:00:00\",\"finish\":\"2019-04-27 00:00:00\"},\"20190428\":{\"start\":\"2019-04-28 00:00:00\",\"finish\":\"2019-04-28 00:00:00\"},\"20190429\":{\"start\":\"2019-04-29 00:00:00\",\"finish\":\"2019-04-29 00:00:00\"},\"20190430\":{\"start\":\"2019-04-30 00:00:00\",\"finish\":\"2019-04-30 00:00:00\"},\"20190501\":{\"start\":\"2019-05-01 00:00:00\",\"finish\":\"2019-05-01 00:00:00\"},\"20190502\":{\"start\":\"2019-05-02 00:00:00\",\"finish\":\"2019-05-02 00:00:00\"},\"20190503\":{\"start\":\"2019-05-03 00:00:00\",\"finish\":\"2019-05-03 00:00:00\"},\"20190504\":{\"start\":\"2019-05-04 00:00:00\",\"finish\":\"2019-05-04 00:00:00\"},\"20190505\":{\"start\":\"2019-05-05 00:00:00\",\"finish\":\"2019-05-05 00:00:00\"},\"20190506\":{\"start\":\"2019-05-06 00:00:00\",\"finish\":\"2019-05-06 00:00:00\"},\"20190507\":{\"start\":\"2019-05-07 00:00:00\",\"finish\":\"2019-05-07 00:00:00\"},\"20190508\":{\"start\":\"2019-05-08 00:00:00\",\"finish\":\"2019-05-08 00:00:00\"},\"20190509\":{\"start\":\"2019-05-09 00:00:00\",\"finish\":\"2019-05-09 00:00:00\"}}',NULL,'0','2019-04-09 20:01:46','2019-04-09 20:01:46'),(38,25,3,452,3,1,'1.500,00','7.500,00','Siete Mil quinientos pesos','40.738,95','1.357,96','6.789,82','710,17','2019-04-15 03:00:00','2019-04-19 03:00:00',5,'2019-04-15 03:00:00','2019-04-19 03:00:00','1','0','{\"20190415\":{\"start\":\"2019-04-15 00:00:00\",\"finish\":\"2019-04-15 00:00:00\"},\"20190416\":{\"start\":\"Tue Apr 16 2019 08:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\",\"finish\":\"Tue Apr 16 2019 21:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\"},\"20190417\":{\"start\":\"Wed Apr 17 2019 08:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\",\"finish\":\"Wed Apr 17 2019 21:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\"},\"20190418\":{\"start\":\"2019-04-18 00:00:00\",\"finish\":\"2019-04-18 00:00:00\"},\"20190419\":{\"start\":\"2019-04-19 00:00:00\",\"finish\":\"2019-04-19 00:00:00\"}}','[{\"start\":\"Wed Apr 17 2019 21:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\",\"finish\":\"Wed Apr 17 2019 23:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\",\"price\":\"150\"}]','1','2019-04-10 01:10:17','2019-04-10 01:21:07'),(39,25,2,453,4,3,'1.800,00','5.400,00','Cinco mil cuatrocientos pesos','40.738,95','1.357,96','6.789,82','1.326,10','2019-04-15 03:00:00','2019-04-19 03:00:00',3,'2019-04-15 03:00:00','2019-04-19 03:00:00','1','0','{\"20190415\":{\"start\":\"2019-04-15 00:00:00\",\"finish\":\"2019-04-15 00:00:00\"},\"20190416\":{\"start\":\"Tue Apr 16 2019 08:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\",\"finish\":\"Tue Apr 16 2019 18:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\"},\"20190417\":{\"start\":\"Wed Apr 17 2019 08:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\",\"finish\":\"Wed Apr 17 2019 18:00:00 GMT-0300 (hora est\\u00e1ndar de Argentina)\"},\"20190418\":{\"start\":\"2019-04-18 00:00:00\",\"finish\":\"2019-04-18 00:00:00\"},\"20190419\":{\"start\":\"2019-04-19 00:00:00\",\"finish\":\"2019-04-19 00:00:00\"}}',NULL,'1','2019-04-10 01:10:22','2019-04-10 01:20:14'),(40,25,3,452,12,3,'1.400,00','7.000,00','Siete mil pesos','40.738,95','1.357,96','6.789,82','210,17','2019-04-15 03:00:00','2019-04-19 03:00:00',5,'2019-04-15 03:00:00','2019-04-19 03:00:00','2','3','{\"20190415\":{\"start\":\"2019-04-15 00:00:00\",\"finish\":\"2019-04-15 00:00:00\"},\"20190416\":{\"start\":\"2019-04-16 00:00:00\",\"finish\":\"2019-04-16 00:00:00\"},\"20190417\":{\"start\":\"2019-04-17 00:00:00\",\"finish\":\"2019-04-17 00:00:00\"},\"20190418\":{\"start\":\"2019-04-18 00:00:00\",\"finish\":\"2019-04-18 00:00:00\"},\"20190419\":{\"start\":\"2019-04-19 00:00:00\",\"finish\":\"2019-04-19 00:00:00\"}}',NULL,'0','2019-04-10 01:10:25','2019-04-10 01:10:25'),(41,26,4,452,12,3,'1.359,00','6.795,00','Seis setecientos noventa y cinco','40.738,95','1.357,96','6.789,82','5,17','2019-05-06 03:00:00','2019-05-10 03:00:00',5,'2019-05-06 03:00:00','2019-05-10 03:00:00','1','0','{\"20190506\":{\"start\":\"2019-05-06 00:00:00\",\"finish\":\"2019-05-06 00:00:00\"},\"20190507\":{\"start\":\"2019-05-07 00:00:00\",\"finish\":\"2019-05-07 00:00:00\"},\"20190508\":{\"start\":\"2019-05-08 00:00:00\",\"finish\":\"2019-05-08 00:00:00\"},\"20190509\":{\"start\":\"2019-05-09 00:00:00\",\"finish\":\"2019-05-09 00:00:00\"},\"20190510\":{\"start\":\"2019-05-10 00:00:00\",\"finish\":\"2019-05-10 00:00:00\"}}',NULL,'0','2019-04-30 21:42:00','2019-04-30 21:42:00');
/*!40000 ALTER TABLE `project_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_proyect_category` int(11) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `finish_date` timestamp NULL DEFAULT NULL,
  `count_workdays` int(11) NOT NULL,
  `duration_workdays` int(11) NOT NULL,
  `id_workday` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (24,2,'frozzen','test disney',2,'2019-04-09 03:00:00','2019-04-30 03:00:00',5,8,2,22,'1','2019-04-09 20:01:40','2019-04-09 20:02:16'),(25,2,'Video Clip Mixto',NULL,2,'2019-04-15 03:00:00','2019-04-19 03:00:00',5,8,5,5,'1','2019-04-10 01:10:17','2019-04-10 01:11:49'),(26,2,'Video para Dietetica',NULL,1,'2019-05-13 03:00:00','2019-05-17 03:00:00',5,8,2,5,'0','2019-04-30 21:42:00','2019-04-30 21:48:32');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provider_assessments`
--

DROP TABLE IF EXISTS `provider_assessments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provider_assessments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_provider` int(11) NOT NULL,
  `id_project` int(11) DEFAULT NULL,
  `description` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provider_assessments`
--

LOCK TABLES `provider_assessments` WRITE;
/*!40000 ALTER TABLE `provider_assessments` DISABLE KEYS */;
INSERT INTO `provider_assessments` VALUES (1,1,NULL,NULL,4,'2019-02-28 16:29:27','2019-02-28 16:29:27'),(2,2,NULL,NULL,5,'2019-02-28 16:38:59','2019-02-28 16:38:59'),(3,3,NULL,NULL,5,'2019-03-01 19:37:15','2019-03-01 19:37:15'),(4,4,NULL,NULL,5,'2019-03-01 19:41:53','2019-03-01 19:41:53'),(5,5,NULL,NULL,5,'2019-03-08 18:57:24','2019-03-08 18:57:24'),(6,6,NULL,NULL,5,'2019-03-08 19:09:31','2019-03-08 19:09:31'),(7,8,NULL,NULL,5,'2019-03-14 15:37:13','2019-03-14 15:37:13');
/*!40000 ALTER TABLE `provider_assessments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `providers`
--

DROP TABLE IF EXISTS `providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `providers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `address` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_number` int(11) NOT NULL,
  `piso_depto` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp` int(11) NOT NULL,
  `location` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_study` int(11) NOT NULL,
  `social_work` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_telephone` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_function_frame` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `providers`
--

LOCK TABLES `providers` WRITE;
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
INSERT INTO `providers` VALUES (3,12,'Av. Rivadavia',6006,'10 C',1406,'Ciudad Autonoma de Buenos Aires','2',3,'OSDE','156867861',NULL,'[\"3\"]','2019-03-01 19:37:15','2019-03-01 19:37:15'),(4,13,'Mario Bravo, 867',867,NULL,1147,'CABA','2',3,'OSDE','1568788355',NULL,'[\"2\"]','2019-03-01 19:41:53','2019-03-01 19:41:53'),(6,15,'Mario Bravo',1111,'1 B',1406,'Ciudad Autonoma de Buenos Aires','2',3,'Osde','1567878656',NULL,'[\"3\"]','2019-03-08 19:09:31','2019-03-08 19:09:31'),(7,16,'Belgrano',2710,NULL,1744,'paso del rey','2',3,'osde','02374682579','1162322902','[\"2\"]','2019-03-12 05:33:02','2019-04-09 22:15:09'),(8,17,'Tronador',867,'1B',1147,'CABA','2',3,NULL,'67878656',NULL,'[\"1\"]','2019-03-14 15:37:13','2019-03-14 15:37:13'),(10,19,'nicolas avellaneda, 2726',2726,NULL,1744,'moreno','5',3,NULL,NULL,NULL,'[\"2\",\"3\",\"4\"]','2019-04-03 22:53:47','2019-04-03 22:53:47'),(11,20,'Mario Bravo',867,'1B',1147,'CABA','2',2,NULL,'1568788311',NULL,'[\"2\",\"3\"]','2019-04-04 18:41:17','2019-04-04 18:41:17'),(12,21,'Mario Bravo',867,'1B',1147,'CABA','2',3,NULL,'1568788311',NULL,'[\"2\",\"3\",\"4\"]','2019-04-04 18:42:38','2019-04-04 18:42:38');
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyect_categories`
--

DROP TABLE IF EXISTS `proyect_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyect_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyect_categories`
--

LOCK TABLES `proyect_categories` WRITE;
/*!40000 ALTER TABLE `proyect_categories` DISABLE KEYS */;
INSERT INTO `proyect_categories` VALUES (1,'TV','1','2019-02-13 18:12:34','2019-02-13 18:12:34'),(2,'DIGITAL','1','2019-02-13 18:12:34','2019-02-13 18:12:34');
/*!40000 ALTER TABLE `proyect_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (3,1,3,'2019-02-14 17:48:23','2019-02-14 17:48:23'),(4,1,5,'2019-02-14 20:58:16','2019-02-14 20:58:16'),(5,1,4,'2019-02-14 20:59:12','2019-02-14 20:59:12');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','slug',NULL,'2019-02-13 18:12:35','2019-02-13 18:12:35','all-access');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sat_functions`
--

DROP TABLE IF EXISTS `sat_functions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sat_functions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_workers_category` int(11) NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sat_functions`
--

LOCK TABLES `sat_functions` WRITE;
/*!40000 ALTER TABLE `sat_functions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sat_functions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studies`
--

DROP TABLE IF EXISTS `studies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studies`
--

LOCK TABLES `studies` WRITE;
/*!40000 ALTER TABLE `studies` DISABLE KEYS */;
INSERT INTO `studies` VALUES (1,'Secundario Completo','1','2019-02-13 18:12:34','2019-02-13 18:12:34'),(2,'Terciario','1','2019-02-13 18:12:34','2019-02-13 18:12:34'),(3,'Universitario','1','2019-02-13 18:12:34','2019-02-13 18:12:34');
/*!40000 ALTER TABLE `studies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_dni` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dni` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuit` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civil_status` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` timestamp NULL DEFAULT NULL,
  `id_country` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_crew` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Hernan','Pellegrini','hernan.pellegrini@frame.com.ar','dni','109899678','109899678','male','casado','2019-02-14 03:00:00','2',NULL,'$2y$10$sxPtXSy3kyO0rvOr34m5FO4eZj/9zb1oQ9inL8FhlPORzJ5uSof4m','0','1',NULL,'2019-02-14 17:47:55','2019-02-14 17:48:23'),(4,'Ezequiel','Villalba','villalbaezequiel@gmail.com','dni','38679374','20386793744','male','soltero','1994-12-23 03:00:00','2',NULL,'$2y$10$LJUVeQMMh7gUL8NHVieI5..1xNXy4375vy/a53eyf75wXkcRVRgcC','0','1','SdFbhlV6fDvRZy0cyo9j0xqg4iPkzifXQxyILVaYEVXVy2mt676uGkcGPOqx','2019-02-14 18:26:47','2019-03-12 05:31:14'),(5,'Esteban','Civilla','esteban@estudiomixto.com','dni','31206797','31206797','male','casado','1989-09-10 03:00:00','2',NULL,'$2y$10$HLKVMynBIShjBOjfbC2Ks.SRV8JIG/.STyxFWc.l0K05.xbpZzY7.','0','1','geR4kyyBVpgGVjKsPsq1muS7E9vOeUXcWcFOVVRzJxRHjXTLqPbfFOf9aG5k','2019-02-14 20:57:36','2019-03-08 17:50:24'),(12,'Esteban','Sivilla','estebancivilla@gmail.com','dni','31206798','24312067981','male','casado','1984-05-06 03:00:00','2',NULL,'$2y$10$SArfrdb5vSSbe.fuA2E5veykXZTiVxrVMSG5SpmpEfY67ifxinaUa','0','1',NULL,'2019-03-01 19:37:15','2019-03-01 19:37:15'),(13,'Celeste','Bertino','celbertino@gmail.com','dni','31505098','24315050981','female','casado','1984-09-26 03:00:00','2',NULL,'$2y$10$UncxaLFsrJ4BZlgHuppCbOsTkCBGdPibWbCei5vmwztp5hgYGYhce','0','1','R7MPDioUcQEpkMrYR9jO5y8Mjq0bmC2RaUAvycMg9l0ceRkXRpmtzeG1iArI','2019-03-01 19:41:53','2019-03-01 19:47:49'),(15,'Pedro','Picapiedra','info@estudiomixto.com','dni','31206779','24312067792','male','soltero','2019-03-11 03:00:00','2',NULL,'$2y$10$oD/xXOgi2fuwYtDKlIui3OQ.LmboRFihPD31QTPxo5M5aN0n092/K','1','1','qgGoPmyTnFRHCgN3wr7R1DuhEDThNBY4b3K2Ij2QajKie2SMCfr1HU60ISfd','2019-03-08 19:09:31','2019-04-04 02:26:15'),(16,'Ezequiel','Villalba','villalbaezequiel64@gmail.com','dni','33666999','20336669994','male','casado','2019-03-11 03:00:00','2',NULL,'$2y$10$OmLZy4E3GXENHpHA1W3h8uBnlQx0f34TJOM9ljCpLa1dRWxXMZv8S','1','1',NULL,'2019-03-12 05:33:02','2019-04-09 22:15:09'),(17,'Hernan','Pellegrini','pellegrinihernan@gmail.com','dni','309876787','243098767874','male','casado','1977-10-11 03:00:00','2',NULL,'$2y$10$U6VwGe36x4RXAmlrRxZiD.s2qQCCznsSCf7GSEJM/QtumBD8dfQSK','1','1',NULL,'2019-03-14 15:37:13','2019-03-14 15:40:46'),(19,'Mauricio','Villalba','evillalba@socialsnack.com','dni','33666111','20336669911','male','casado','1992-02-18 02:00:00','2',NULL,'$2y$10$0FfMtsTglooAngRUHFiWJOqyEofd32ptp5zeowSfT69ddVt4RPJdS','1','1',NULL,'2019-04-03 22:53:47','2019-04-03 22:53:47'),(20,'Valeria','Mattiangeli','valeria@estudiomixto.com','dni','35969893','27359698939','female','casado','1989-03-10 03:00:00','2',NULL,'$2y$10$l/qwLiWehc6gZhuVuMljlOOSsXzNxQKXMcbdnSOy/Ln5qTp6R/4mq','1','1',NULL,'2019-04-04 18:41:17','2019-04-04 18:41:17'),(21,'Sofia','Palladino','sofia@estudiomixto.com','dni','18366861','27183668619','female','casado','0000-00-00 00:00:00','2',NULL,'$2y$10$fRazZ80IZr5bHgvKIIfw1e0prXAC1SDqDwoKarakisWHAZM9/8wBK','1','1',NULL,'2019-04-04 18:42:38','2019-04-04 18:42:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workdays`
--

DROP TABLE IF EXISTS `workdays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workdays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` int(11) DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workdays`
--

LOCK TABLES `workdays` WRITE;
/*!40000 ALTER TABLE `workdays` DISABLE KEYS */;
INSERT INTO `workdays` VALUES (1,'Mensual',30,'30 días','1','2019-02-13 18:12:34','2019-03-14 15:34:59'),(2,'Semanal Laboral',5,'Dias Habiles','1','2019-02-13 18:12:34','2019-03-07 00:48:57'),(3,'Semana + sábado',6,'Dias Hábiles, más Sábado','1','2019-02-13 18:12:34','2019-03-07 00:50:31'),(4,'Semana',7,'Más de 5 días hasta 15 días','1','2019-03-06 21:13:11','2019-03-07 00:48:59'),(5,'Jornada',1,'Menos de 5 días','1','2019-03-06 21:14:22','2019-03-07 00:50:33');
/*!40000 ALTER TABLE `workdays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workers_categories`
--

DROP TABLE IF EXISTS `workers_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workers_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number_category` int(11) NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sueldo_basico` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sueldo_adicional` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sueldo_bruto` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sueldo_bruto_texto` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sueldo_neto` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_afip` int(11) DEFAULT NULL,
  `presentismo` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=562 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workers_categories`
--

LOCK TABLES `workers_categories` WRITE;
/*!40000 ALTER TABLE `workers_categories` DISABLE KEYS */;
INSERT INTO `workers_categories` VALUES (5,2,'Camarógrafo Realizador','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta con dos (centavos o centésimos)','35.364,6162',NULL,'$3.969,09','1','2019-02-21 01:11:40','2019-03-06 04:28:22'),(6,2,'Escenógrafo','$26.638,21','$13.052,72','$43.660,02',NULL,'35.364,6162',NULL,'$3.969,09','1','2019-02-21 01:12:30','2019-03-06 04:28:25'),(7,2,'Iluminador','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta con dos (centavos o centésimos)','35.364,6162',NULL,'$3.969,09','1','2019-02-21 01:13:04','2019-03-06 04:28:27'),(8,2,'Operador Técnico de Planta Transmisora','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta','35.364,6162',NULL,'$3.969,09','1','2019-02-21 01:13:50','2019-03-06 04:28:30'),(9,2,'Tec. de Mant. afectado a Planta Trasmisora','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta','35.364,6162',NULL,'$3.969,09','1','2019-02-21 01:14:59','2019-03-06 04:28:32'),(10,2,'Técnico de Mantenimiento Electrónico','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta','35.364,6162',NULL,'$3.969,09','1','2019-02-21 01:15:43','2019-03-06 04:28:34'),(11,3,'Asistente de Dirección','$25.053,29','$9.520,25','$38.030,89','Treinta y ocho mil treinta con ochenta y nueve (centavos)','30.805,0209',NULL,'$3.457,35','1','2019-02-21 01:20:25','2019-03-06 04:28:10'),(452,1,'Director de Programas','$28.137,09','$17.585,68','$50.295,00','Cincuenta mil doscientos noventa y cinco','40.738,95',1,'$4.572,28','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(453,1,'Productor de Programas','$28.137,09','$17.585,68','$50.295,00','Cincuenta mil doscientos noventa y cinco','40.738,95',1,'$4.572,28','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(454,1,'Tecnico Electronico','$28.137,09','$17.585,68','$50.295,00','Cincuenta mil doscientos noventa y cinco','40.738,95',1,'$4.572,28','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(455,2,'Camarografo Realizador','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta con dos (centavos o centésimos)','35.364,6162',1,'$3.969,09','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(456,2,'Escenografo','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta con dos (centavos o centésimos)','35.364,6162',1,'$3.969,09','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(457,2,'Iluminador','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta con dos (centavos o centésimos)','35.364,6162',1,'$3.969,09','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(458,2,'Operador Realizador Cinematografico','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta con dos (centavos o centésimos)','35.364,6162',1,'$3.969,09','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(459,2,'Operador Tecnico de Planta Trasmisora','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta con dos (centavos o centésimos)','35.364,6162',1,'$3.969,09','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(460,2,'Tec. de Mant. afectado a Planta Trasmisora','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta con dos (centavos o centésimos)','35.364,6162',1,'$3.969,09','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(461,2,'Tecnico de Mantenimiento Electrónico','$26.638,21','$13.052,72','$43.660,02','Cuarenta y tres mil seiscientos sesenta con dos (centavos o centésimos)','35.364,6162',1,'$3.969,09','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(462,3,'Asistente de Direccion','$25.053,29','$9.520,25','$38.030,89','Treinta y ocho mil treinta con ochenta y nueve (centavos o centésimos)','30.805,0209',1,'$3.457,35','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(463,3,'Asesor de Vestuario','$25.053,29','$9.520,25','$38.030,89','Treinta y ocho mil treinta con ochenta y nueve (centavos o centésimos)','30.805,0209',1,'$3.457,35','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(464,3,'Coordinador','$25.053,29','$9.520,25','$38.030,89','Treinta y ocho mil treinta con ochenta y nueve (centavos o centésimos)','30.805,0209',1,'$3.457,35','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(465,3,'Creativo de Campañas Promocionales','$25.053,29','$9.520,25','$38.030,89','Treinta y ocho mil treinta con ochenta y nueve (centavos o centésimos)','30.805,0209',1,'$3.457,35','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(466,3,'Operador de Camaras de Video Tape Portatil','$25.053,29','$9.520,25','$38.030,89','Treinta y ocho mil treinta con ochenta y nueve (centavos o centésimos)','30.805,0209',1,'$3.457,35','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(467,3,'Operador Tecnico de VTR Especializado en Conversion de Normas','$25.053,29','$9.520,25','$38.030,89','Treinta y ocho mil treinta con ochenta y nueve (centavos o centésimos)','30.805,0209',1,'$3.457,35','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(468,3,'Operador Tecnico Editor de VTR','$25.053,29','$9.520,25','$38.030,89','Treinta y ocho mil treinta con ochenta y nueve (centavos o centésimos)','30.805,0209',1,'$3.457,35','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(469,3,'Tecnico en Efectos Especiales Visuales','$25.053,29','$9.520,25','$38.030,89','Treinta y ocho mil treinta con ochenta y nueve (centavos o centésimos)','30.805,0209',1,'$3.457,35','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(470,3,'Tecnico en Proceso Cinematográfico','$25.053,29','$9.520,25','$38.030,89','Treinta y ocho mil treinta con ochenta y nueve (centavos o centésimos)','30.805,0209',1,'$3.457,35','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(471,4,'Conpaginador Musical','$23.648,97','$8.277,14','$35.118,72','Treinta y cinco mil ciento dieciocho con setenta y dos (centavos o centésimos)','28.446,1632',1,'$3.192,61','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(472,4,'Mezclador de Control Central','$23.648,97','$8.277,14','$35.118,72','Treinta y cinco mil ciento dieciocho con setenta y dos (centavos o centésimos)','28.446,1632',1,'$3.192,61','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(473,4,'Operador de Camaras','$23.648,97','$8.277,14','$35.118,72','Treinta y cinco mil ciento dieciocho con setenta y dos (centavos o centésimos)','28.446,1632',1,'$3.192,61','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(474,4,'Operador de Computadoras','$23.648,97','$8.277,14','$35.118,72','Treinta y cinco mil ciento dieciocho con setenta y dos (centavos o centésimos)','28.446,1632',1,'$3.192,61','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(475,4,'Operador de Sonido','$23.648,97','$8.277,14','$35.118,72','Treinta y cinco mil ciento dieciocho con setenta y dos (centavos o centésimos)','28.446,1632',1,'$3.192,61','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(476,4,'Operador de Video Film','$23.648,97','$8.277,14','$35.118,72','Treinta y cinco mil ciento dieciocho con setenta y dos (centavos o centésimos)','28.446,1632',1,'$3.192,61','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(477,4,'Operador Tecnico de Video','$23.648,97','$8.277,14','$35.118,72','Treinta y cinco mil ciento dieciocho con setenta y dos (centavos o centésimos)','28.446,1632',1,'$3.192,61','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(478,4,'Operador Tecnico de Video Tape','$23.648,97','$8.277,14','$35.118,72','Treinta y cinco mil ciento dieciocho con setenta y dos (centavos o centésimos)','28.446,1632',1,'$3.192,61','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(479,4,'Realizador de Escenografia','$23.648,97','$8.277,14','$35.118,72','Treinta y cinco mil ciento dieciocho con setenta y dos (centavos o centésimos)','28.446,1632',1,'$3.192,61','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(480,4,'Tecnico Mecanico','$23.648,97','$8.277,14','$35.118,72','Treinta y cinco mil ciento dieciocho con setenta y dos (centavos o centésimos)','28.446,1632',1,'$3.192,61','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(481,5,'Ambientador General','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(482,5,'Asistente de Iluminacion','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(483,5,'Continuista','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(484,5,'Dibujante de Arte Publicitario','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(485,5,'Dibujante Tecnico','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(486,5,'Fotografo','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(487,5,'Oficial Administrativo','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(488,5,'Operador de Maquinas Contables','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(489,5,'Promotor de Ventas','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(490,5,'Proyectorista de Control Central','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(491,5,'Secretaria Bilingüe','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(492,5,'Tecnico de Mantenimiento Mecanico','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(493,5,'Tecnico Electricista','$22.305,99','$7.137,92','$32.388,29','Treinta y dos mil trescientos ochenta y ocho con veintinueve (centavos o centésimos)','26.234,5149',1,'$2.944,39','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(494,6,'Asistente de Produccion','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(495,6,'Caracterizador','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(496,6,'Carpintero Realizador','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(497,6,'Cobrador','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(498,6,'Conductor Motorista Mecanico','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(499,6,'Operador Revisor de Filmoteca','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(500,6,'Perforador de Maquinas Contables','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(501,6,'Perfoverificador de Computadoras','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(502,6,'Pintor Corporeo Letrista','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(503,6,'Redactor de Textos Publicitarios','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(504,6,'Tapicero Realizador','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(505,6,'Tecnico de Mant. de Aire Acondicionado','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(506,6,'Utilero de Calle','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(507,6,'Utilero Realizador','$21.055,43','$6.106,07','$29.877,65','Veintinueve mil ochocientos setenta y siete con sesenta y cinco (centavos o centésimos)','24.200,8965',1,'$2.716,15','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(508,7,'Asistente de Arte','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(509,7,'Asistente de camara especializado / Grip','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(510,7,'Auxiliar Administrativo','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(511,7,'Auxiliar de Estudios','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(512,7,'Ayudante de Utilero de Calle','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(513,7,'Calderista','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(514,7,'Chequeador','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(515,7,'Compaginador de Filmoteca','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(516,7,'Laborista Fotografico','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(517,7,'Microfonista','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(518,7,'Modista Realizadora','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(519,7,'Montador de Escenografia','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(520,7,'Oficial de Mantenimiento de Edificio','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(521,7,'Peinador','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(522,7,'Pintor Corporeo','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(523,7,'Reflectorista','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(524,7,'Secretaria','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:07','2019-03-28 16:53:07'),(525,7,'Sombrerero','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(526,7,'Tablerista de Iluminacion','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(527,7,'Utilero','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(528,7,'Utilero Preparador','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(529,7,'Visualizador / Logger','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(530,7,'Asistente Peinador','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(531,7,'Asistente Maquillador','$19.865,78','$5.264,43','$27.643,24','Veintisiete mil seiscientos cuarenta y tres con veinticuatro (centavos o centésimos)','22.391,0244',1,'$2.513,02','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(532,8,'Auxiliar de Almacenes y/o Deposito','$18.736,19','$4.403,01','$25.453,12','Veinticinco mil cuatrocientos cincuenta y tres con doce (centavos o centésimos)','20.617,0272',1,'$2.313,92','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(533,8,'Auxiliar de Despacho','$18.736,19','$4.403,01','$25.453,12','Veinticinco mil cuatrocientos cincuenta y tres con doce (centavos o centésimos)','20.617,0272',1,'$2.313,92','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(534,8,'Auxiliar de Trafico','$18.736,19','$4.403,01','$25.453,12','Veinticinco mil cuatrocientos cincuenta y tres con doce (centavos o centésimos)','20.617,0272',1,'$2.313,92','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(535,8,'Auxiliar Mimeografista','$18.736,19','$4.403,01','$25.453,12','Veinticinco mil cuatrocientos cincuenta y tres con doce (centavos o centésimos)','20.617,0272',1,'$2.313,92','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(536,8,'Conductor de Camaras','$18.736,19','$4.403,01','$25.453,12','Veinticinco mil cuatrocientos cincuenta y tres con doce (centavos o centésimos)','20.617,0272',1,'$2.313,92','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(537,8,'Telecontrol','$18.736,19','$4.403,01','$25.453,12','Veinticinco mil cuatrocientos cincuenta y tres con doce (centavos o centésimos)','20.617,0272',1,'$2.313,92','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(538,9,'Auxiliar Electricista','$17.667,09','$3.798,42','$23.612,06','Veintitrés mil seiscientos doce con seis (centavos o centésimos)','19.125,7686',1,'$2.146,55','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(539,9,'Conductor de Automotores de Intendencia','$17.667,09','$3.798,42','$23.612,06','Veintitrés mil seiscientos doce con seis (centavos o centésimos)','19.125,7686',1,'$2.146,55','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(540,9,'Conductor de Automotores de Operaciones','$17.667,09','$3.798,42','$23.612,06','Veintitrés mil seiscientos doce con seis (centavos o centésimos)','19.125,7686',1,'$2.146,55','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(541,9,'Modista','$17.667,09','$3.798,42','$23.612,06','Veintitrés mil seiscientos doce con seis (centavos o centésimos)','19.125,7686',1,'$2.146,55','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(542,9,'Operador de Telex','$17.667,09','$3.798,42','$23.612,06','Veintitrés mil seiscientos doce con seis (centavos o centésimos)','19.125,7686',1,'$2.146,55','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(543,9,'Preparador de Sastreria','$17.667,09','$3.798,42','$23.612,06','Veintitrés mil seiscientos doce con seis (centavos o centésimos)','19.125,7686',1,'$2.146,55','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(544,9,'Telefonista ( Operador/a )','$17.667,09','$3.798,42','$23.612,06','Veintitrés mil seiscientos doce con seis (centavos o centésimos)','19.125,7686',1,'$2.146,55','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(545,10,'Auxiliar de Camarines','$16.384,16','$3.440,67','$21.807,32','Veintiún mil ochocientos siete con treinta y dos (centavos o centésimos)','17.663,9292',1,'$1.982,48','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(546,10,'Auxiliar de Camarines','$16.384,16','$3.440,67','$21.807,32','Veintiún mil ochocientos siete con treinta y dos (centavos o centésimos)','17.663,9292',1,'$1.982,48','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(547,10,'Auxiliar de Camarines','$16.384,16','$3.440,67','$21.807,32','Veintiún mil ochocientos siete con treinta y dos (centavos o centésimos)','17.663,9292',1,'$1.982,48','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(548,10,'Auxiliar de Forilloteca','$16.384,16','$3.440,67','$21.807,32','Veintiún mil ochocientos siete con treinta y dos (centavos o centésimos)','17.663,9292',1,'$1.982,48','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(549,10,'Auxiliar Revisor de Filmoteca','$16.384,16','$3.440,67','$21.807,32','Veintiún mil ochocientos siete con treinta y dos (centavos o centésimos)','17.663,9292',1,'$1.982,48','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(550,10,'Ayudante de Realizacion','$16.384,16','$3.440,67','$21.807,32','Veintiún mil ochocientos siete con treinta y dos (centavos o centésimos)','17.663,9292',1,'$1.982,48','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(551,10,'Ayudante General de Tecnica','$16.384,16','$3.440,67','$21.807,32','Veintiún mil ochocientos siete con treinta y dos (centavos o centésimos)','17.663,9292',1,'$1.982,48','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(552,11,'Mozo de Cafeteria','$15.469,24','$2.861,81','$20.164,16','Veinte mil ciento sesenta y cuatro con dieciséis (centavos o centésimos)','16.332,9696',1,'$1.833,11','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(553,11,'Ordenanza','$15.469,24','$2.861,81','$20.164,16','Veinte mil ciento sesenta y cuatro con dieciséis (centavos o centésimos)','16.332,9696',1,'$1.833,11','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(554,11,'Auxiliar de Deposito','$15.469,24','$2.861,81','$20.164,16','Veinte mil ciento sesenta y cuatro con dieciséis (centavos o centésimos)','16.332,9696',1,'$1.833,11','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(555,11,'Auxiliar de limpieza','$15.469,24','$2.861,81','$20.164,16','Veinte mil ciento sesenta y cuatro con dieciséis (centavos o centésimos)','16.332,9696',1,'$1.833,11','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(556,11,'Auxiliar Recepcionista','$15.469,24','$2.861,81','$20.164,16','Veinte mil ciento sesenta y cuatro con dieciséis (centavos o centésimos)','16.332,9696',1,'$1.833,11','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(557,11,'Bombero','$15.469,24','$2.861,81','$20.164,16','Veinte mil ciento sesenta y cuatro con dieciséis (centavos o centésimos)','16.332,9696',1,'$1.833,11','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(558,11,'Jardinero','$15.469,24','$2.861,81','$20.164,16','Veinte mil ciento sesenta y cuatro con dieciséis (centavos o centésimos)','16.332,9696',1,'$1.833,11','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(559,11,'Peon de Estudios','$15.469,24','$2.861,81','$20.164,16','Veinte mil ciento sesenta y cuatro con dieciséis (centavos o centésimos)','16.332,9696',1,'$1.833,11','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(560,11,'Sereno','$15.469,24','$2.861,81','$20.164,16','Veinte mil ciento sesenta y cuatro con dieciséis (centavos o centésimos)','16.332,9696',1,'$1.833,11','1','2019-03-28 16:53:08','2019-03-28 16:53:08'),(561,12,'Cadete','$14.598,2','$2.335,71','$18.627,3','Dieciocho mil seiscientos veintisiete con treinta (centavos o centésimos)','15.088,113',1,'$1.693,39','1','2019-03-28 16:53:08','2019-03-28 16:53:08');
/*!40000 ALTER TABLE `workers_categories` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-02  6:54:40
