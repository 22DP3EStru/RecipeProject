-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: localhost    Database: recipeproject
-- ------------------------------------------------------
-- Server version	8.0.45

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Zupas','2026-05-21 20:20:49','2026-05-21 20:20:49'),(3,'Deserti','2026-05-21 20:20:49','2026-05-21 20:20:49'),(4,'Uzkodas','2026-05-21 20:20:49','2026-05-21 20:20:49'),(5,'Dzērieni','2026-05-21 20:20:49','2026-05-21 20:20:49'),(6,'Brokastis','2026-05-21 20:42:25','2026-05-21 20:42:25'),(7,'Pusdienas','2026-05-21 20:42:25','2026-05-21 20:42:25'),(8,'Vakariņas','2026-05-21 20:42:25','2026-05-21 20:42:25'),(9,'Salāti','2026-05-21 20:42:25','2026-05-21 20:42:25'),(10,'Veģetārās','2026-05-21 20:42:25','2026-05-21 20:42:25'),(11,'Vegānās','2026-05-21 20:42:25','2026-05-21 20:42:25'),(12,'Bezglutēna','2026-05-21 20:42:25','2026-05-21 20:42:25'),(13,'Ātrās receptes','2026-05-21 20:42:25','2026-05-21 20:42:25');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `recipe_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_recipe_id_foreign` (`recipe_id`),
  KEY `comments_parent_id_foreign` (`parent_id`),
  CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorites` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `recipe_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `favorites_user_id_recipe_id_unique` (`user_id`,`recipe_id`),
  KEY `favorites_recipe_id_foreign` (`recipe_id`),
  CONSTRAINT `favorites_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_06_01_172624_create_personal_access_tokens_table',1),(5,'2025_06_02_191403_create_categories_table',1),(6,'2025_06_02_191404_create_recipes_table',1),(7,'2025_06_02_191405_create_comments_table',1),(8,'2025_06_10_202144_add_is_admin_to_users_table',1),(9,'2025_06_14_125322_create_newrecipes_table',1),(10,'2026_01_06_124955_create_recipe_reviews_table',1),(11,'2026_02_11_092627_create_favorites_table',1),(12,'2026_02_27_193821_add_media_to_recipes_table',1),(13,'2026_02_27_203221_add_media_fields_to_recipes_table',1),(14,'2026_02_27_210226_create_recipe_ingredients_table',1),(15,'2026_03_30_201019_add_views_to_recipes_table',1),(16,'2026_04_01_164944_add_profile_photo_to_users_table',1),(17,'2026_04_01_181822_add_parent_id_to_comments_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newrecipes`
--

DROP TABLE IF EXISTS `newrecipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `newrecipes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prep_time` int DEFAULT NULL,
  `cook_time` int DEFAULT NULL,
  `servings` int DEFAULT NULL,
  `difficulty` enum('Easy','Medium','Hard') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `newrecipes_user_id_foreign` (`user_id`),
  CONSTRAINT `newrecipes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newrecipes`
--

LOCK TABLES `newrecipes` WRITE;
/*!40000 ALTER TABLE `newrecipes` DISABLE KEYS */;
/*!40000 ALTER TABLE `newrecipes` ENABLE KEYS */;
UNLOCK TABLES;

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

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_ingredients`
--

DROP TABLE IF EXISTS `recipe_ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_ingredients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `recipe_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `unit` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipe_ingredients_recipe_id_foreign` (`recipe_id`),
  CONSTRAINT `recipe_ingredients_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_ingredients`
--

LOCK TABLES `recipe_ingredients` WRITE;
/*!40000 ALTER TABLE `recipe_ingredients` DISABLE KEYS */;
INSERT INTO `recipe_ingredients` VALUES (1,4,'Auzu pārslas',100.00,'g','2026-05-21 21:09:12','2026-05-21 21:09:12'),(2,4,'Piens',400.00,'ml','2026-05-21 21:09:12','2026-05-21 21:09:12'),(3,4,'Medus',1.00,'ēdk.','2026-05-21 21:09:12','2026-05-21 21:09:12'),(4,4,'Mellenes',50.00,'g','2026-05-21 21:09:12','2026-05-21 21:09:12'),(5,4,'Zemenes',50.00,'g','2026-05-21 21:09:12','2026-05-21 21:09:12'),(6,4,'Kanēlis',1.00,'mg','2026-05-21 21:09:12','2026-05-21 21:09:12'),(7,5,'Makaroni',300.00,'g','2026-05-21 21:12:09','2026-05-21 21:12:09'),(8,5,'Vistas fileja',400.00,'g','2026-05-21 21:12:09','2026-05-21 21:12:09'),(9,5,'Saldais krējums',200.00,'ml','2026-05-21 21:12:09','2026-05-21 21:12:09'),(10,5,'Parmezāns',50.00,'g','2026-05-21 21:12:09','2026-05-21 21:12:09'),(11,5,'Ķiploku daiviņas',2.00,NULL,'2026-05-21 21:12:09','2026-05-21 21:12:09'),(12,5,'Sāls',NULL,NULL,'2026-05-21 21:12:09','2026-05-21 21:12:09'),(13,5,'Pipars',NULL,NULL,'2026-05-21 21:12:09','2026-05-21 21:12:09'),(26,6,'Laša fileja',2.00,'gab','2026-05-21 21:17:15','2026-05-21 21:17:15'),(27,6,'Paprika',1.00,'gab','2026-05-21 21:17:15','2026-05-21 21:17:15'),(28,6,'Cukīnī',1.00,'gab','2026-05-21 21:17:15','2026-05-21 21:17:15'),(29,6,'Burkāns',1.00,'gab','2026-05-21 21:17:15','2026-05-21 21:17:15'),(30,6,'Olīveļļa',NULL,NULL,'2026-05-21 21:17:15','2026-05-21 21:17:15'),(31,6,'Citrona sula',NULL,NULL,'2026-05-21 21:17:15','2026-05-21 21:17:15'),(32,7,'Tumšā šokolāde',200.00,'g','2026-05-21 21:19:36','2026-05-21 21:19:36'),(33,7,'Sviests',150.00,'g','2026-05-21 21:19:36','2026-05-21 21:19:36'),(34,7,'Olas',3.00,'gab','2026-05-21 21:19:36','2026-05-21 21:19:36'),(35,7,'Cukurs',120.00,'g','2026-05-21 21:19:36','2026-05-21 21:19:36'),(36,7,'Milti',80.00,'g','2026-05-21 21:19:36','2026-05-21 21:19:36'),(37,8,'Banāns',1.00,'gab','2026-05-21 21:22:31','2026-05-21 21:22:31'),(38,8,'Saldētas zemenes',150.00,'g','2026-05-21 21:22:31','2026-05-21 21:22:31'),(39,8,'Piens',200.00,'ml','2026-05-21 21:22:31','2026-05-21 21:22:31'),(40,8,'Medus',1.00,'ēdk.','2026-05-21 21:22:31','2026-05-21 21:22:31'),(41,9,'Bagete',1.00,'gab','2026-05-21 21:25:06','2026-05-21 21:25:06'),(42,9,'Siers',100.00,'g','2026-05-21 21:25:06','2026-05-21 21:25:06'),(43,9,'Ķiploku daiviņas',2.00,'gab','2026-05-21 21:25:06','2026-05-21 21:25:06'),(44,9,'Sviests',NULL,NULL,'2026-05-21 21:25:06','2026-05-21 21:25:06'),(45,10,'Romaine salāti',NULL,NULL,'2026-05-21 21:27:16','2026-05-21 21:27:16'),(46,10,'Vistas fileja',200.00,'g','2026-05-21 21:27:16','2026-05-21 21:27:16'),(47,10,'Grauzdiņi',NULL,NULL,'2026-05-21 21:27:16','2026-05-21 21:27:16'),(48,10,'Parmezāns',NULL,NULL,'2026-05-21 21:27:16','2026-05-21 21:27:16'),(49,10,'Cēzara mērce',NULL,NULL,'2026-05-21 21:27:16','2026-05-21 21:27:16'),(50,11,'Tomāti',800.00,'g','2026-05-21 21:29:28','2026-05-21 21:29:28'),(51,11,'Sīpols',1.00,'gab','2026-05-21 21:29:28','2026-05-21 21:29:28'),(52,11,'Ķiploku daiviņas',2.00,'gab','2026-05-21 21:29:28','2026-05-21 21:29:28'),(53,11,'Saldais krējums',200.00,'ml','2026-05-21 21:29:28','2026-05-21 21:29:28'),(54,11,'Baziliks',NULL,NULL,'2026-05-21 21:29:28','2026-05-21 21:29:28'),(55,12,'Brokoļi',NULL,NULL,'2026-05-21 21:31:43','2026-05-21 21:31:43'),(56,12,'Burkāni',NULL,NULL,'2026-05-21 21:31:43','2026-05-21 21:31:43'),(57,12,'Paprika',NULL,NULL,'2026-05-21 21:31:43','2026-05-21 21:31:43'),(58,12,'Sojas mērce',NULL,NULL,'2026-05-21 21:31:43','2026-05-21 21:31:43'),(59,12,'Rīsi',NULL,NULL,'2026-05-21 21:31:43','2026-05-21 21:31:43'),(60,13,'Sarkanās pupiņas',NULL,NULL,'2026-05-21 21:33:42','2026-05-21 21:33:42'),(61,13,'Kukurūza',NULL,NULL,'2026-05-21 21:33:42','2026-05-21 21:33:42'),(62,13,'Tomāti',NULL,NULL,'2026-05-21 21:33:42','2026-05-21 21:33:42'),(63,13,'Sīpols',NULL,NULL,'2026-05-21 21:33:42','2026-05-21 21:33:42'),(64,13,'Čillī garšvielas',NULL,NULL,'2026-05-21 21:33:42','2026-05-21 21:33:42'),(65,14,'Banāni',2.00,'gab','2026-05-21 21:35:40','2026-05-21 21:35:40'),(66,14,'Olas',2.00,'gab','2026-05-21 21:35:40','2026-05-21 21:35:40'),(67,14,'Bezglutēna milti',100.00,'g','2026-05-21 21:35:40','2026-05-21 21:35:40'),(68,14,'Piens',100.00,'ml','2026-05-21 21:35:40','2026-05-21 21:35:40'),(69,15,'Tortilijas',2.00,'gab','2026-05-21 21:37:31','2026-05-21 21:37:31'),(70,15,'Tomātu mērce',NULL,NULL,'2026-05-21 21:37:31','2026-05-21 21:37:31'),(71,15,'Siers',NULL,NULL,'2026-05-21 21:37:31','2026-05-21 21:37:31'),(72,15,'Šķiņķis',NULL,NULL,'2026-05-21 21:37:31','2026-05-21 21:37:31'),(73,15,'Oregano',NULL,NULL,'2026-05-21 21:37:31','2026-05-21 21:37:31');
/*!40000 ALTER TABLE `recipe_ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_reviews`
--

DROP TABLE IF EXISTS `recipe_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `recipe_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `rating` tinyint unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `recipe_reviews_recipe_id_user_id_unique` (`recipe_id`,`user_id`),
  KEY `recipe_reviews_user_id_foreign` (`user_id`),
  CONSTRAINT `recipe_reviews_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recipe_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_reviews`
--

LOCK TABLES `recipe_reviews` WRITE;
/*!40000 ALTER TABLE `recipe_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipe_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int unsigned NOT NULL DEFAULT '0',
  `ingredients` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prep_time` int DEFAULT NULL,
  `cook_time` int DEFAULT NULL,
  `servings` int DEFAULT NULL,
  `difficulty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipes_user_id_foreign` (`user_id`),
  CONSTRAINT `recipes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (4,'Auzu putra ar ogām un medu','Silta un veselīga brokastu putra ar svaigām ogām un medu.',1,'100 g Auzu pārslas\n400 ml Piens\n1 ēdk. Medus\n50 g Mellenes\n50 g Zemenes\n1 mg Kanēlis','Katliņā uzvāra pienu.\r\nPievieno auzu pārslas un vāra 5–7 minūtes.\r\nIemaisa medu un kanēli.\r\nPasniedz ar svaigām ogām.',5,10,2,'Viegla','Brokastis',7,'2026-05-21 21:09:12','2026-05-21 21:09:12','recipes/images/P6ZoAZIOxQNAXp6yYbZVElcJI3OKIdI4OIm7ran1.jpg',NULL,NULL,NULL),(5,'Krēmīga vistas pasta','Sātīga pasta ar vistas fileju un krēmīgu siera mērci.',1,'300 g Makaroni\n400 g Vistas fileja\n200 ml Saldais krējums\n50 g Parmezāns\n2 Ķiploku daiviņas\nSāls\nPipars','Novāra makaronus.\r\nApcep vistas gabaliņus.\r\nPievieno ķiplokus un saldo krējumu.\r\nIemaisa sieru un makaronus.\r\nPasniedz karstu.',15,25,4,'Vidēja','Pusdienas',7,'2026-05-21 21:12:09','2026-05-21 21:12:09','recipes/images/amK9VXobBo8XC2HtCjla3mgCdDjGWS9Ls9QtgdEu.jpg',NULL,NULL,NULL),(6,'Cepts lasis ar dārzeņiem','Vieglas un veselīgas vakariņas ar lasi un ceptiem dārzeņiem.',1,'2 gab Laša fileja\n1 gab Paprika\n1 gab Cukīnī\n1 gab Burkāns\nOlīveļļa\nCitrona sula','Sagriež dārzeņus.\r\nNovieto visu uz pannas.\r\nApslaka ar eļļu un citronu sulu.\r\nCep 200°C apmēram 25 minūtes.',10,30,2,'Vidēja','Vakariņas',7,'2026-05-21 21:14:44','2026-05-21 21:17:15','recipes/images/bIlQ1W3IupbMgnpqKkUDRERpwwsCLGmLrPlfHfV6.jpg',NULL,NULL,NULL),(7,'Šokolādes braunijs','Bagātīgs un mitrs šokolādes deserts.',1,'200 g Tumšā šokolāde\n150 g Sviests\n3 gab Olas\n120 g Cukurs\n80 g Milti','Izkausē šokolādi ar sviestu.\r\nSaputo olas ar cukuru.\r\nSajauc visas sastāvdaļas.\r\nCep 180°C 30 minūtes.',15,30,6,'Vidēja','Deserti',7,'2026-05-21 21:19:36','2026-05-21 21:19:36','recipes/images/xEuMNNZ496JaA9ed33olXZH69KX3x7TAVtrcy7LG.jpg',NULL,NULL,NULL),(8,'Zemeņu banānu smūtijs','Atsvaidzinošs augļu dzēriens ikdienai.',1,'1 gab Banāns\n150 g Saldētas zemenes\n200 ml Piens\n1 ēdk. Medus','Visas sastāvdaļas ievieto blenderī.\r\nBlendē līdz viendabīgai konsistencei.\r\nPasniedz aukstu.',5,0,2,'Viegla','Dzērieni',7,'2026-05-21 21:22:31','2026-05-21 21:22:31','recipes/images/QNkipvhpjG3aWtiP4rhpGLdMbGgz2v0YgCq6YV4l.jpg',NULL,NULL,NULL),(9,'Siera ķiploku grauzdiņi','Kraukšķīga uzkoda ar sieru un ķiplokiem.',1,'1 gab Bagete\n100 g Siers\n2 gab Ķiploku daiviņas\nSviests','Sagriež bageti šķēlēs.\r\nUzsmērē sviestu un ķiplokus.\r\nPārkaisa sieru.\r\nCep līdz siers izkusis.',10,15,4,'Viegla','Uzkodas',7,'2026-05-21 21:25:06','2026-05-21 21:25:06','recipes/images/YoHbDH2HTyrZlWFRDyGQxoeFRbLfte9L96CK670N.jpg',NULL,NULL,NULL),(10,'Cēzara salāti','Klasiski salāti ar vistu un kraukšķīgiem grauzdiņiem.',1,'Romaine salāti\n200 g Vistas fileja\nGrauzdiņi\nParmezāns\nCēzara mērce','Apcep vistu.\r\nSajauc salātus ar mērci.\r\nPievieno vistu, sieru un grauzdiņus.',15,10,2,'Vidēja','Salāti',7,'2026-05-21 21:27:16','2026-05-21 21:27:16','recipes/images/EodiRcWXLTA9L3Na1YtZbajxTBRNZYMvfL9ywDsh.jpg',NULL,NULL,NULL),(11,'Tomātu krēmzupa','Silta un krēmīga tomātu zupa ar baziliku.',1,'800 g Tomāti\n1 gab Sīpols\n2 gab Ķiploku daiviņas\n200 ml Saldais krējums\nBaziliks','Apcep sīpolus un ķiplokus.\r\nPievieno tomātus un vāra.\r\nSablendē.\r\nPievieno saldo krējumu.',10,25,4,'Viegla','Zupas',7,'2026-05-21 21:29:28','2026-05-21 21:29:28','recipes/images/G4ZP0ODbgnJ4yoXzP5FL72dfz7wbQeyqYwLpa3ix.jpg',NULL,NULL,NULL),(12,'Dārzeņu wok panna','Ātra veģetāra maltīte ar svaigiem dārzeņiem.',1,'Brokoļi\nBurkāni\nPaprika\nSojas mērce\nRīsi','Apcep dārzeņus wok pannā.\r\nPievieno sojas mērci.\r\nPasniedz ar rīsiem.',10,15,3,'Viegla','Veģetārās',7,'2026-05-21 21:31:43','2026-05-21 21:31:43','recipes/images/HXX6yOv8QgNpjaIXgavtrPJvhX760Wt5lJqh4CrI.jpg',NULL,NULL,NULL),(13,'Vegānu čili sautējums','Pikants pupiņu un tomātu sautējums bez dzīvnieku produktiem.',1,'Sarkanās pupiņas\nKukurūza\nTomāti\nSīpols\nČillī garšvielas','Apcep sīpolus.\r\nPievieno pārējās sastāvdaļas.\r\nSautē 30 minūtes.',15,35,4,'Vidēja','Vegānās',7,'2026-05-21 21:33:42','2026-05-21 21:33:42','recipes/images/qKvNFkDWgpZCOfGR60cTkWtGkq7DiSvKBHRLc8JQ.jpg',NULL,NULL,NULL),(14,'Bezglutēna banānu pankūkas','Mīkstas pankūkas bez glutēna.',1,'2 gab Banāni\n2 gab Olas\n100 g Bezglutēna milti\n100 ml Piens','Sajauc sastāvdaļas.\r\nCep pankūkas uz pannas.\r\nPasniedz ar augļiem.',10,15,2,'Viegla','Bezglutēna',7,'2026-05-21 21:35:39','2026-05-21 21:35:40','recipes/images/9o59JfN2jONQHjAYVgYW6q7O32gFiMwWkY9Ejci3.jpg',NULL,NULL,NULL),(15,'Tortiljas pica','Ātra mājas pica uz tortiljas bāzes.',1,'2 gab Tortilijas\nTomātu mērce\nSiers\nŠķiņķis\nOregano','Uz tortiljas uzklāj mērci.\r\nPievieno sieru un šķiņķi.\r\nCep 10 minūtes 200°C.',5,10,2,'Viegla','Ātras receptes',7,'2026-05-21 21:37:31','2026-05-21 21:37:31','recipes/images/IxfzALOTtoJPVfbuu2QhK354tJuhuesN07ITc88v.webp',NULL,NULL,NULL);
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('Pw4TII5AE0FkMe6um8diD8pbFJxN92HJwDwPYLOL',1,'172.18.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYWxyVm5mQkJ3djNrOW5mUlFFOHhGdWwwbkNIUVNjMzcyejBPQUNXZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wZGYvYWRtaW4tc3RhdGlzdGljcyI7czo1OiJyb3V0ZSI7czoyMDoicGRmLmFkbWluLnN0YXRpc3RpY3MiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1779400128);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

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
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@example.com',NULL,'2026-05-21 20:20:48','$2y$12$sHDhOriqc7yD1Bppr8n/ZusktVaAqO2LUzjGXkCHfb6pxD0FTYSQi','0lMPUkSFg2YDMZpCMzvnLBEjonUw5fwIMq3QLNCK5TP7eByww2UG7BEjrhq6','2026-05-21 20:20:49','2026-05-21 20:48:06',1),(7,'Elīza Strūberga','eliza.struberga@gmail.com',NULL,'2026-05-21 20:49:14','$2y$12$sRHen91s6igdnOxkpdFfKuFFMWHg2CuppPdIfioEfCoqPXfA0KGsy',NULL,'2026-05-21 20:48:59','2026-05-21 20:49:14',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-21 21:52:58
