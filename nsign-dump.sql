-- MySQL dump 10.16  Distrib 10.1.22-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: nsign
-- ------------------------------------------------------
-- Server version	10.1.22-MariaDB

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
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('admin','3',1490986314),('manager','10',1491063312),('manager','11',1491063566),('manager','12',1491063614),('manager','13',1491063634),('manager','14',1491063676),('manager','15',1491063806),('manager','16',1491064266),('manager','17',1491064313),('manager','18',1491065034),('manager','19',1491065293),('manager','20',1491065314),('manager','21',1491065325),('manager','22',1491065411),('manager','23',1491133535),('manager','24',1491197615),('manager','5',1491059930),('manager','7',1491062514);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('admin',1,'Администратор',NULL,NULL,1490986313,1490986313),('editOrderPermition',2,'Редактирование заявок',NULL,NULL,1490986313,1490986313),('editUserPermition',2,'Редактирование пользователей',NULL,NULL,1490986313,1490986313),('manager',1,'Менеджер',NULL,NULL,1490986313,1490986313),('viewAdminPage',2,'Просмотр админки',NULL,NULL,1490986313,1490986313),('viewOrderPage',2,'Просмотр списка заявок',NULL,NULL,1490986313,1490986313),('viewUsersPage',2,'Просмотр списка пользователей',NULL,NULL,1490986313,1490986313);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('admin','editUserPermition'),('admin','manager'),('manager','editOrderPermition'),('manager','viewAdminPage'),('manager','viewUsersPage');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dishes`
--

DROP TABLE IF EXISTS `dishes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dishes`
--

LOCK TABLES `dishes` WRITE;
/*!40000 ALTER TABLE `dishes` DISABLE KEYS */;
INSERT INTO `dishes` VALUES (6,'Салат Оливье','e-37I1mUyl14Ia-K8plMak2IGn7xgrYu.jpg','Салат Оливье'),(7,'Пицца Гавайская','E-U18Vm9vaoCZ-sI5cD0Z53DEe0co1wb.jpg','Пицца Гавайская'),(8,'Салат овощной','qE2J9ozFYh_HmbJikwfL7ytuwaGHW_RC.jpg','Салат овощной'),(9,'Борщ','jd2mrg4eoNhv2TxmcxaTjJuD6j6Cutjk.jpg','Борщ'),(10,'Винегрет','Ga9rIAAY8EJogoVgM0DM2TuQc6wInzXO.jpg','Винегрет'),(12,'Салат Цезарь','BTy5a2g8hLd2ZOZrRVSx6Cj8d9PCcUcl.jpg','Салат Цезарь');
/*!40000 ALTER TABLE `dishes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dishes_ingridients`
--

DROP TABLE IF EXISTS `dishes_ingridients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dishes_ingridients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dish_id` int(11) NOT NULL,
  `ingridient_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ixDishes` (`dish_id`),
  KEY `ixIngridients` (`ingridient_id`),
  CONSTRAINT `fk-dishes-id` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-ingridients-id` FOREIGN KEY (`ingridient_id`) REFERENCES `ingridients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dishes_ingridients`
--

LOCK TABLES `dishes_ingridients` WRITE;
/*!40000 ALTER TABLE `dishes_ingridients` DISABLE KEYS */;
INSERT INTO `dishes_ingridients` VALUES (21,6,22),(22,6,16),(23,6,18),(24,6,24),(25,6,13),(32,7,21),(33,7,22),(34,7,24),(35,7,28),(36,7,35),(37,7,37),(38,7,17),(39,8,14),(40,8,17),(41,8,18),(42,8,19),(43,8,22),(44,8,23),(45,8,27),(46,9,13),(47,9,14),(48,9,22),(49,9,23),(50,9,33),(51,10,13),(52,10,14),(53,10,16),(54,10,18),(55,10,22),(56,10,33),(64,12,17),(65,12,18),(66,12,19),(67,12,21),(68,12,22),(69,12,27),(70,12,40),(71,12,41);
/*!40000 ALTER TABLE `dishes_ingridients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingridients`
--

DROP TABLE IF EXISTS `ingridients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingridients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `state` enum('Активен','Скрыт') NOT NULL DEFAULT 'Активен',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingridients`
--

LOCK TABLES `ingridients` WRITE;
/*!40000 ALTER TABLE `ingridients` DISABLE KEYS */;
INSERT INTO `ingridients` VALUES (13,'Картофель','y9adR7tkAUGnXGm3g41inZgucNVSci6T.png','Активен'),(14,'Морковь','_fGHULdptyR5S4guO4yqTbvhOsct15Gd.jpg','Активен'),(16,'Горох','4fvVAqxY9sNN5vn6YJd1rMJ8caPJru2c.jpg','Скрыт'),(17,'Помидоры','zhD9D1l6jTG4DDzEAjhjsqVFwMXUB-MZ.jpg','Активен'),(18,'Огурцы','raR4Gx9otHv_Bj3xSpKXmg95Uj5_N1XY.jpg','Активен'),(19,'Редис','_xefhvQdnmmjjH0yRG0y4G-zqElRFbWj.jpg','Активен'),(20,'Баклажан','kfSIYrm0dBVjCNlgoVk32RUMGb0wUGxA.jpg','Активен'),(21,'Салат','HYUigKQFYqvHhkSX4zcET6aifF535K_k.jpg','Активен'),(22,'Лук','VNqgMezVWNEQsKMu_JZBmbwMnULCZI6j.jpg','Активен'),(23,'Капуста','lp4K8e0mlzO5JeKfS1eTuffVOdTwWrLP.jpg','Активен'),(24,'Колбаса','uLwU12ZmQCeNE7ie4eRrnTLVy7DvBP32.jpg','Активен'),(25,'Тесто','h4gjIXVfldiVFvkw9gejRipTr714jMvg.jpg','Скрыт'),(26,'Яйца','EI3DyInW2UJScvL4r1h20JTyxVFBaiBg.jpg','Активен'),(27,'Оливковое масло','KlmgVTQqiZfIgL-iCAuCJjxb5L4KmtTH.jpg','Активен'),(28,'Майонез','KqCPwdYp3tW1pFJE72NowxtbHYeyTDek.jpg','Активен'),(33,'Свекла','s7_3qcejuh0bUzFl_7dkIfkxC6khthKQ.jpg','Активен'),(34,'Оливки','yfCzjJbTYlf5k1iskKvEODIiiyfq3OfQ.jpg','Активен'),(35,'Ананас','hLK8Gfk9Wf6jWVacb4wsLzVx4aefLVWt.jpg','Активен'),(37,'Тесто','CfYGXg5-EVfga5B3Q9Pk2cp5NSPSGaQf.jpg','Активен'),(39,'Кукуруза','OwdeqkUw2Puf9APGwskAzwAfVzFPa4Z7.jpg','Активен'),(40,'Сухарики','fEZ6KYUPDqdqFpzs6YPa0chckIJkjq2y.jpg','Активен'),(41,'Сыр','b3G8PduC41TwKfDxeAGtDdSHP5OXjZNh.jpg','Активен');
/*!40000 ALTER TABLE `ingridients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object` varchar(100) NOT NULL,
  `object_name` varchar(100) NOT NULL,
  `field` varchar(100) NOT NULL,
  `old_value` varchar(255) NOT NULL,
  `new_value` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1490904155),('m130524_201442_init',1490904496),('m140506_102106_rbac_init',1490904162),('m170331_173931_create_user_status_table',1490983305),('m170421_114540_create_table_ingridients',1492775921),('m170421_115901_create_table_dishes',1492776215),('m170421_120407_create_table_dishes_ingridients',1492778404);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `good_id` int(11) DEFAULT NULL,
  `customer_fio` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `comments` text,
  `status` enum('Принята','Отказана','Брак') NOT NULL DEFAULT 'Принята',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `good_id-ix` (`good_id`),
  CONSTRAINT `fk-goods` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `synonym_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'bad',NULL),(3,'fig',NULL);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_counter`
--

DROP TABLE IF EXISTS `tag_counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_counter` (
  `tag_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `counter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_counter`
--

LOCK TABLES `tag_counter` WRITE;
/*!40000 ALTER TABLE `tag_counter` DISABLE KEYS */;
INSERT INTO `tag_counter` VALUES (1,12,3),(1,14,2),(1,15,3);
/*!40000 ALTER TABLE `tag_counter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_user`
--

DROP TABLE IF EXISTS `tag_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_user`
--

LOCK TABLES `tag_user` WRITE;
/*!40000 ALTER TABLE `tag_user` DISABLE KEYS */;
INSERT INTO `tag_user` VALUES (1,1,1,12),(2,1,1,14),(3,1,1,15),(4,2,1,15),(5,2,1,12),(6,3,1,15),(8,3,1,12),(9,3,1,14);
/*!40000 ALTER TABLE `tag_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'admin','WSZU1nIPXEikh-Hl7BgHUl46Lgd4hL23','$2y$13$7untMefdb1C8KYfxBcuEouYyf/gDCMKO9MjiZ/yGiXUO5k2GFi24K',NULL,'admin@admin.ru',10,1491056091,1491056091),(5,'manager','xVJqsd4_5Vtusbhe-5iuuzatqyCLfaLH','$2y$13$Wp0SdYh2kiOgkW84ZnIs7OnOsLHmoTwfFniACXlKoITryT9e0WH6S',NULL,'manager@manager.ru',10,1491056996,1491059930),(20,'sklad','','$2y$13$rpQqnsV0.CxqXL8rUgPseOFh4CCOhmUXob.pERtf11E6.2aUljR9G',NULL,'sklad@sklad.ru',10,1491065314,1491065314),(22,'zavhoz','-zZJjB3kU4mHYIXCMBS8mMEeE-eJKe6k','$2y$13$efuKIIHf6CBF2Cn.oYFRq.OffFO2Q/JzFxwBbaTR4jcGetzukaxzy',NULL,'zavhoz@zavhoz.ru',10,1491065411,1491065411),(24,'dvornik','','$2y$13$cPmxccGT/DepnBettXQwHeDvhQsRbsZ.UE1Tz0WyLYVOiAPa9WcKq',NULL,'dvornik@dvornik.ru',10,1491197615,1491197615);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_status` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_status`
--

LOCK TABLES `user_status` WRITE;
/*!40000 ALTER TABLE `user_status` DISABLE KEYS */;
INSERT INTO `user_status` VALUES (0,'Заблокирован','BLOCKED'),(10,'Активен','ACTIVE');
/*!40000 ALTER TABLE `user_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `user_view`
--

DROP TABLE IF EXISTS `user_view`;
/*!50001 DROP VIEW IF EXISTS `user_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `user_view` (
  `id` tinyint NOT NULL,
  `username` tinyint NOT NULL,
  `password_hash` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `role` tinyint NOT NULL,
  `role_title` tinyint NOT NULL,
  `status_title` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `user_view`
--

/*!50001 DROP TABLE IF EXISTS `user_view`*/;
/*!50001 DROP VIEW IF EXISTS `user_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`zdorov`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `user_view` AS select `u`.`id` AS `id`,`u`.`username` AS `username`,`u`.`password_hash` AS `password_hash`,`u`.`email` AS `email`,`u`.`status` AS `status`,`aa`.`item_name` AS `role`,`ai`.`description` AS `role_title`,`us`.`title` AS `status_title` from (((`user` `u` join `auth_assignment` `aa` on((`aa`.`user_id` = `u`.`id`))) join `auth_item` `ai` on((`ai`.`name` = `aa`.`item_name`))) join `user_status` `us` on((`us`.`id` = `u`.`status`))) */;
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

-- Dump completed on 2017-04-23  0:44:51
