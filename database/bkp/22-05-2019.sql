-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: frame_sistema
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

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
  `piso_depto` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
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
  `color` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frame_functions`
--

LOCK TABLES `frame_functions` WRITE;
/*!40000 ALTER TABLE `frame_functions` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2015_01_20_084450_create_roles_table',1),(4,'2015_01_20_084525_create_role_user_table',1),(5,'2015_01_24_080208_create_permissions_table',1),(6,'2015_01_24_080433_create_permission_role_table',1),(7,'2015_12_04_003040_add_special_role_column',1),(8,'2017_10_17_170735_create_permission_user_table',1),(9,'2019_01_11_214043_create_clients_table',1),(10,'2019_01_11_220313_add_row_users',1),(11,'2019_01_13_185347_create_countries_table',1),(12,'2019_01_13_185757_create_contracts_table',1),(13,'2019_01_13_190125_create_workdays_table',1),(14,'2019_01_13_190306_create_studies_table',1),(15,'2019_01_16_011325_create_proyect_categories_table',1),(16,'2019_01_16_211256_create_providers_table',1),(17,'2019_01_16_233338_create_frame_functions_table',1),(18,'2019_01_16_233351_create_sat_functions_table',1),(19,'2019_01_17_005831_create_workers_categories_table',1),(20,'2019_01_27_030342_create_projects_table',1),(21,'2019_01_27_185508_create_project_providers_table',1),(22,'2019_02_13_215718_add_row_clients',1),(23,'2019_02_14_183756_drop_column_provider_afip',1),(24,'2019_02_14_184134_add_column_project_provider',1),(25,'2019_02_14_200023_drop_columns_workers_categories',1),(26,'2019_02_15_024554_drop_columns_providers',1),(27,'2019_02_15_173148_add_column_clients',1),(28,'2019_02_18_192152_create_provider_assessments_table',1),(29,'2019_02_19_174458_add_column_user',1),(30,'2019_02_20_122244_update_schema_frame_function',1),(31,'2019_02_20_122539_update_schema_s_a_t_function',1),(32,'2019_02_20_214917_add_column_category_sat',1),(33,'2019_02_21_172914_add_column_crew',1),(34,'2019_02_28_115935_add_columb_project_provider',1),(35,'2019_03_06_012241_add_column_workers_category',1),(36,'2019_03_06_175513_add_column_work_days',1),(37,'2019_03_06_214246_add_column_project_provider_v1',1),(38,'2019_03_19_194407_add_row_project_providers',1),(39,'2019_03_20_023433_add_column_workers_category_v1',1),(40,'2019_04_03_180315_update_telephone_providers',1),(41,'2019_04_04_174318_add_column_calendar_drop_other_column',1),(42,'2019_05_03_021220_add_row_cbu_crew',1),(43,'2019_05_15_203958_add_column_provider_or004',1),(44,'2019_05_15_210507_add_column_by_providers_or004',1),(45,'2019_05_16_183858_add_column_function_frame_or007',1),(46,'2019_05_20_185634_add_column_providers_or014',1),(47,'2019_05_20_201322_update_column_providers_projects_or014',1),(48,'2019_05_20_202109_update_column_projects_or014',1),(49,'2019_05_21_152048_add_column_clients_or015',1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
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
  `id_workday` int(11) NOT NULL,
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
  `hour_initial` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hour_end` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_providers`
--

LOCK TABLES `project_providers` WRITE;
/*!40000 ALTER TABLE `project_providers` DISABLE KEYS */;
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
  `observations` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_center` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_proyect_category` int(11) NOT NULL,
  `id_team_referring` int(11) DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `finish_date` timestamp NULL DEFAULT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provider_assessments`
--

LOCK TABLES `provider_assessments` WRITE;
/*!40000 ALTER TABLE `provider_assessments` DISABLE KEYS */;
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
  `social_work` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_work_code` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_telephone` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_function_frame` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cbu` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_account` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_account` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias_account` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referring` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `providers`
--

LOCK TABLES `providers` WRITE;
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyect_categories`
--

LOCK TABLES `proyect_categories` WRITE;
/*!40000 ALTER TABLE `proyect_categories` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studies`
--

LOCK TABLES `studies` WRITE;
/*!40000 ALTER TABLE `studies` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workdays`
--

LOCK TABLES `workdays` WRITE;
/*!40000 ALTER TABLE `workdays` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workers_categories`
--

LOCK TABLES `workers_categories` WRITE;
/*!40000 ALTER TABLE `workers_categories` DISABLE KEYS */;
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

-- Dump completed on 2019-05-22 19:19:55
