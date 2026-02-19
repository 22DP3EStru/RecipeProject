-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: recipeproject
-- ------------------------------------------------------
-- Server version	8.0.41

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Zupas','2025-06-12 18:09:05','2025-06-12 18:09:05'),(2,'Pamatēdieni','2025-06-12 18:09:05','2025-06-12 18:09:05'),(3,'Deserti','2025-06-12 18:09:05','2025-06-12 18:09:05'),(4,'Uzkodas','2025-06-12 18:09:05','2025-06-12 18:09:05'),(5,'Dzērieni','2025-06-12 18:09:05','2025-06-12 18:09:05');
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_recipe_id_foreign` (`recipe_id`),
  CONSTRAINT `comments_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (2,1,26,'2026-02-11 08:04:37','2026-02-11 08:04:37'),(3,1,27,'2026-02-12 16:32:40','2026-02-12 16:32:40'),(4,15,25,'2026-02-13 14:05:46','2026-02-13 14:05:46');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_06_01_172624_create_personal_access_tokens_table',1),(5,'2025_06_02_191403_create_categories_table',1),(6,'2025_06_02_191404_create_recipes_table',1),(7,'2025_06_02_191405_create_comments_table',1),(8,'2025_06_02_191406_create_ratings_table',1),(9,'2025_06_10_202144_add_is_admin_to_users_table',1),(10,'2025_06_11_215711_create_favorites_table',1),(11,'2025_06_15_000001_add_ingredients_and_instructions_to_recipes_table',1),(12,'2025_06_14_125322_create_newrecipes_table',2),(13,'2025_06_15_200014_add_category_to_recipes_table',3),(14,'2025_12_18_133141_make_category_id_nullable_in_recipes',4),(15,'2026_01_06_124955_create_recipe_reviews_table',5),(16,'2026_02_11_092627_create_favorites_table',6);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_reviews`
--

LOCK TABLES `recipe_reviews` WRITE;
/*!40000 ALTER TABLE `recipe_reviews` DISABLE KEYS */;
INSERT INTO `recipe_reviews` VALUES (1,19,1,5,'ļoti labi','2026-01-07 10:20:42','2026-01-07 10:20:42');
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
  `description` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `difficulty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `servings` int DEFAULT NULL,
  `prep_time` int DEFAULT NULL,
  `cook_time` int DEFAULT NULL,
  `ingredients` text COLLATE utf8mb4_unicode_ci,
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipes_user_id_foreign` (`user_id`),
  KEY `recipes_category_id_foreign` (`category_id`),
  CONSTRAINT `recipes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recipes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (1,'Kartupeļu pankūkas','Tradicionālās latviešu kartupeļu pankūkas ar skābo krējumu. Vienkārša un garda recepte visai ģimenei!','Brokastis','Viegla',NULL,20,30,'1 kg kartupeļu\r\n2 olas\r\n2 sīpoli\r\n3 ēd.k. kviešu milti\r\nSāls un pipari pēc garšas\r\nAugu eļļa cepšanai\r\n200g skābais krējums pasniegšanai','Nomizo un sarīvē kartupeļus, nospiež lieko šķidrumu.\r\nNomizo un smalki sarīvē sīpolus.\r\nLielā bļodā sajauc kartupeļus, sīpolus, olas, miltus, sāli un piparus.\r\nUzkarsē pannu ar eļļu un ar karoti liek kartupeļu masu, izveido pankūkas.\r\nCep uz vidējas uguns 3-4 minūtes no katras puses līdz zeltaini brūnas.\r\nPasniedz ar skābo krējumu un zaļumiem',NULL,1,2,'2025-06-11 20:09:06','2025-11-22 12:11:55'),(17,'Pelēkie zirņi ar speķi','Gardas pusdienas gan svētkos, gan ikdienā.','Pusdienas','Vidēja',4,480,60,'300 g pelēko zirņu\r\n150 g kūpināta speķa\r\n1 sīpols\r\nSāls','Zirņus izmērcē aukstā ūdenī un atstāj uzbriest uz nakti.\r\nVāra līdz mīksti, nosāla.\r\nSpeķi un sīpolu apcep pannā.\r\nSajauc ar zirņiem un pasniedz karstus.',NULL,14,NULL,'2025-12-18 11:48:05','2025-12-18 11:48:05'),(18,'Aukstā zupa','Vasaras garšīgākais ēdiens visapkārt.','Zupas','Viegla',4,15,NULL,'1 l kefīra\r\n2 vārītas bietes\r\n2 svaigi gurķi\r\n2 olas\r\nDilles\r\nSāls','Bietes un gurķus sagriež salmiņos.\r\nOlas sakapā.\r\nVisu sajauc ar kefīru, pievieno sāli un dilles.\r\nPasniedz atdzesētu.',NULL,14,NULL,'2025-12-18 11:49:48','2025-12-18 11:49:48'),(19,'Cepta vista ar kartupeļiem','Garšīgas un vieglas vakariņas, kas garšos visai ģimenei.','Vakariņas','Vidēja',4,15,45,'1 vesela vista (≈1.5 kg)\r\n800 g kartupeļu\r\n3 ķiploka daiviņas\r\nSāls, pipari, paprika\r\n2 ēdk. eļļas','Vistu ierīvē ar garšvielām un eļļu.\r\nKartupeļus sagriež, sajauc ar ķiploku un sāli.\r\nCep 180 °C ~45 min.',NULL,14,NULL,'2025-12-18 12:13:59','2025-12-18 12:13:59'),(20,'Rupjmaizes kārtojums','Garšīgs un tradicionāls deserts','Deserti','Viegla',4,15,NULL,'200 g rupjmaizes drumstalu\r\n300 g putukrējuma\r\n200 g brūkleņu ievārījuma\r\n1 ēdk. cukura','Saputo krējumu ar cukuru.\r\nKārto slāņos: maize → ievārījums → krējums.\r\nAtdzesē pirms pasniegšanas.',NULL,1,NULL,'2025-12-18 12:16:05','2025-12-18 12:16:05'),(21,'Siera ķiploku grauzdiņi','Uzkodas tops','Uzkodas','Viegla',4,10,10,'4 šķēles baltmaizes\r\n100 g siera\r\n2 ķiploka daiviņas\r\n1 ēdk. sviesta','Maizi apsmērē ar sviestu un ķiploku.\r\nPārkaisa sieru.\r\nCep cepeškrāsnī līdz siers izkūst.',NULL,1,NULL,'2025-12-18 12:17:14','2025-12-18 12:17:14'),(22,'Dzērveņu moss','Sena bet laba recepte','Dzērieni','Viegla',4,10,10,'200 g dzērveņu\r\n1 l ūdens\r\n3 ēdk. cukura','Dzērvenes uzvāra ūdenī.\r\nPievieno cukuru, izkāš.\r\nAtdzesē un pasniedz.',NULL,1,NULL,'2025-12-18 12:18:08','2025-12-18 12:18:08'),(23,'Kartupeļu-olu salāti','Garšīgi salāti, kas ir no mūsu mīļākajiem dārzeņiem.','Salāti','Vidēja',4,10,20,'4 vārīti kartupeļi\r\n3 vārītas olas\r\n2 marinēti gurķi\r\n3 ēdk. skābā krējuma','Visu sagriež kubiņos.\r\nSajauc ar krējumu un sāli.',NULL,1,NULL,'2025-12-18 12:19:26','2025-12-18 12:19:26'),(24,'Dārzeņu sacepums','Kaut kas, kas nav ar gaļu','Veģetārās','Vidēja',4,15,35,'Brokolis, burkāns, paprika\r\n200 ml saldā krējuma\r\n100 g siera\r\nSāls','Dārzeņus liek cepamtraukā.\r\nPārlej krējumu, pārkaisa sieru.\r\nCep 180 °C 35 min.',NULL,1,NULL,'2025-12-18 12:20:26','2025-12-18 12:20:26'),(25,'Auzu putra ar augļiem','Garšīgs un veselīgs','Vegānās','Viegla',2,5,10,'100 g auzu pārslu\r\n300 ml augu piena\r\nBanāns, ogas','Vāra auzas augu pienā.\r\nPievieno augļus un pasniedz.',NULL,1,NULL,'2025-12-18 12:21:20','2025-12-18 12:21:20'),(26,'Cepti kartupeļi ar zaļumiem','Garšīgs un speciāls','Bezglutēna','Vidēja',4,10,30,'1 kg kartupeļu\r\n2 ēdk. eļļas\r\nSāls, dilles','Kartupeļus sagriež, apmaisa ar eļļu.\r\nCep 200 °C 30 min.\r\nPārkaisa ar dillēm.',NULL,1,NULL,'2025-12-18 12:23:07','2025-12-18 12:23:07'),(27,'Omlete ar sieru','Ātra un super garšīga','Ātras receptes','Viegla',1,2,5,'2 olas\r\n50 g siera\r\nSāls','Olas sakuļ ar sāli.\r\nCep pannā, pievieno sieru.\r\nSaloka un pasniedz.',NULL,1,NULL,'2025-12-18 12:24:00','2025-12-18 12:24:00');
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
INSERT INTO `sessions` VALUES ('0cBVwWjGplSODpyNApolYC3sfli1mBhpRiAFgjkZ',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoic2w5U2ZURlZORWRzVWR1TmxxUk4zc2xWa3B2Q1Q5WVhnQ2hZOEZtTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1750067536),('LoGQ8kuqcBLNoraiNNGMS2Ka6CxKNl3vNR6BUWLR',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN3NqeFhXMWRzdmZmck9RR0VHMWtud1FWZm43VGFyN1RxUkhVWU9vRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1750069385);
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
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@example.com','2025-06-12 18:09:04','$2y$12$/BpRN/16Mokc5Y9ibMfSfevGd0gldF9kHUjjjoYXsptWQ90OzB8Ye','0yjGYzlWufGjQzw8gTbZTPTtCBJjlPnC0t2ET2hJ0cpmQm7jbnxprX6fdky7',1,'2025-06-12 18:09:05','2025-06-13 07:17:17'),(8,'Elmārs Daudziņš','elmars.ss@gmail.com',NULL,'$2y$12$LwkFYJd5kLrUXVrkhP0Ih.CDiRPeIFTbWFKX5sXIm325rVL88sfcO',NULL,0,'2025-06-16 05:33:46','2025-06-16 05:33:46'),(9,'linda berzina','linda.berzina@gmail.com',NULL,'$2y$12$xi9gs4G5mrjvpK07sCuwAeV7LtoLJsT1YGE6BEOEL4nZFtY54ujrO',NULL,0,'2025-06-16 07:08:18','2025-06-16 07:08:18'),(10,'Artūrs','artur@gmail.com',NULL,'$2y$12$CsGr6fB7prlVEz8aS34Fo.cPpA00tTereB3802H0QfTcCpbxMX0OC',NULL,0,'2025-06-18 17:38:01','2025-06-18 17:38:01'),(11,'Eliza','pukulis@gmail.com',NULL,'$2y$12$VrxLpAcStrR/CMCB1elUaeEf86Gx1UNXxUIYa80VEnnW51j30/De6',NULL,0,'2025-06-19 02:53:21','2025-06-19 02:54:06'),(12,'Estere Rūja','estere.ruja@gmail.com',NULL,'$2y$12$Y2qjraDWyY9IJY7/wnW0ZOdLQGIpIXSmPcG90JybLIuNHu7gaAeiy',NULL,0,'2025-11-20 10:11:21','2025-11-20 10:11:21'),(13,'Emīlija Draudziņaz','emilija@gmail.com',NULL,'$2y$12$a8CaRB2a93pRv8//xxedge9tNSta5Ke6Dc2w0D86mYl5qXaVbsqRS',NULL,0,'2025-11-20 16:23:18','2025-11-20 16:23:18'),(14,'kate ozolina','kate.ozolina@gmail.com',NULL,'$2y$12$ZAIMG71PIhMhCps41xBiUuD5.53hj2/T7k/YHNOdzF6NZx4xEqxv6',NULL,0,'2025-12-18 11:42:44','2025-12-18 11:42:44'),(15,'ralfas','ralfas.asdf@gmail.com',NULL,'$2y$12$weQgm7LyB/kZPnpvbZzI8uOqo.n9Yjb1FOxQ0X9tIcJBbZ8Oe4r7e',NULL,0,'2026-02-13 14:05:12','2026-02-13 14:05:12');
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

-- Dump completed on 2026-02-19 12:34:59
