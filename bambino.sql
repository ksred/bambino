-- MySQL dump 10.13  Distrib 5.1.61, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bambino
-- ------------------------------------------------------
-- Server version	5.1.61-0ubuntu0.11.10.1

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `delivery_address` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,1,'FTFD',123,'ftfd@metal.com','For\nThe\nFallen\nDreams','2012-11-02 11:47:27'),(2,1,'Sakura',12345678,'saku@ra.com','Sakura\nCherry Blossom\nWorld','2012-11-02 12:11:34'),(3,1,'Tree',123456,'tree@leaf.com','The world\nSolar system','2012-11-18 15:06:22');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_orders`
--

DROP TABLE IF EXISTS `customers_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_orders`
--

LOCK TABLES `customers_orders` WRITE;
/*!40000 ALTER TABLE `customers_orders` DISABLE KEYS */;
INSERT INTO `customers_orders` VALUES (1,1,1,8,'2012-11-02 11:51:18'),(2,1,1,9,'2012-11-02 11:52:48'),(3,1,1,10,'2012-11-02 11:53:09'),(4,1,1,12,'2012-11-02 11:53:21'),(5,1,1,13,'2012-11-02 11:53:27'),(6,1,1,15,'2012-11-02 11:54:38'),(7,1,1,16,'2012-11-02 12:00:22'),(8,1,1,1,'2012-11-02 12:03:22'),(9,1,2,2,'2012-11-02 12:11:56'),(10,1,3,3,'2012-11-18 15:08:16'),(11,1,2,4,'2012-11-18 15:15:01'),(12,1,2,5,'2012-12-10 13:27:38'),(13,1,2,6,'2013-03-30 11:17:10');
/*!40000 ALTER TABLE `customers_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails_config`
--

DROP TABLE IF EXISTS `emails_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reply_to` varchar(50) NOT NULL,
  `theme` int(11) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails_config`
--

LOCK TABLES `emails_config` WRITE;
/*!40000 ALTER TABLE `emails_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails_theme`
--

DROP TABLE IF EXISTS `emails_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `header_colour` varchar(10) NOT NULL,
  `font_size` int(11) NOT NULL,
  `font_family` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails_theme`
--

LOCK TABLES `emails_theme` WRITE;
/*!40000 ALTER TABLE `emails_theme` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails_theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stock_id` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,1,'it001','First item yo',2,'2012-11-02 12:02:51'),(2,1,'it002','Yosh',3,'2012-11-02 12:03:11'),(4,1,'va001','Valve',3,'2012-11-18 15:07:49'),(5,1,'tr001','Running Shoes',3,'2012-12-03 07:56:29'),(6,1,'me001','Me item',0,'2012-12-10 13:27:16');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items_meta`
--

DROP TABLE IF EXISTS `items_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_id` varchar(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `orders_items_id` int(11) NOT NULL,
  `details` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `retail` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items_meta`
--

LOCK TABLES `items_meta` WRITE;
/*!40000 ALTER TABLE `items_meta` DISABLE KEYS */;
INSERT INTO `items_meta` VALUES (1,1,1,'it001',1,1,'size L',0,0,0,'2012-11-02 12:03:21',0),(2,1,2,'it002',1,2,'(none)',0,0,0,'2012-11-02 12:03:22',0),(3,1,1,'it001',2,3,'Size M',0,0,0,'2012-11-02 12:11:56',0),(4,1,2,'it002',2,4,'(none)',3,100,200,'2012-11-02 12:11:56',1),(5,1,4,'va001',3,5,'(none)',2,0,0,'2012-11-18 15:08:16',0),(6,1,1,'it001',3,6,'(none)',1,10,30,'2012-11-18 15:08:16',0),(7,1,1,'it001',4,7,'(none)',14,0,0,'2012-11-18 15:15:01',0),(8,1,2,'it002',4,8,'(none)',3,0,0,'2012-12-03 07:55:58',0),(9,1,5,'tr001',2,9,'They\'re for running',2,100,200,'2012-12-03 07:56:43',1),(10,1,1,'it001',4,10,'(none)',2,0,0,'2012-12-03 10:12:28',NULL),(11,1,5,'tr001',4,11,'(none)',3,100,200,'2012-12-03 10:13:00',NULL),(12,1,1,'it001',4,12,'(none)',1,50,70,'2012-12-03 10:13:24',0),(13,1,5,'tr001',4,13,'(none)',1,100,200,'2012-12-03 11:27:19',NULL),(14,1,6,'me001',5,14,'(none)',1,0,0,'2012-12-10 13:27:38',1),(15,1,5,'tr001',5,15,'(none)',1,100,200,'2013-02-15 07:33:59',NULL),(16,1,5,'tr001',6,16,'(none)',2,100,200,'2013-03-30 11:17:10',NULL),(17,1,1,'it001',6,17,'Customer two left feet',3,50,70,'2013-03-30 11:17:10',0),(18,1,2,'it002',6,18,'(none)',1,0,0,'2013-03-30 11:19:24',NULL);
/*!40000 ALTER TABLE `items_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_order_id` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'tr001',1,2,'2012-11-02 12:03:21'),(2,'tr002',1,1,'2012-11-02 12:11:56'),(3,'ca1234',1,1,'2012-11-18 15:08:16'),(4,'tr020',1,1,'2012-11-18 15:15:01'),(5,'tr003',1,2,'2012-12-10 13:27:38'),(6,'tr045',1,1,'2013-03-30 11:17:10');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_items`
--

DROP TABLE IF EXISTS `orders_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_items`
--

LOCK TABLES `orders_items` WRITE;
/*!40000 ALTER TABLE `orders_items` DISABLE KEYS */;
INSERT INTO `orders_items` VALUES (1,1,1,1),(2,1,1,2),(3,1,2,1),(4,1,2,2),(5,1,3,4),(6,1,3,1),(9,1,2,5),(10,1,4,1),(11,1,4,5),(12,1,4,1),(13,1,4,5),(15,1,5,5),(17,1,6,1),(18,1,6,2);
/*!40000 ALTER TABLE `orders_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_notes`
--

DROP TABLE IF EXISTS `orders_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `note` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_notes`
--

LOCK TABLES `orders_notes` WRITE;
/*!40000 ALTER TABLE `orders_notes` DISABLE KEYS */;
INSERT INTO `orders_notes` VALUES (1,1,1,'wanna be free','2012-11-02 12:03:22'),(2,1,2,'tester heyo','2012-11-02 12:11:56');
/*!40000 ALTER TABLE `orders_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_status`
--

DROP TABLE IF EXISTS `orders_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_status`
--

LOCK TABLES `orders_status` WRITE;
/*!40000 ALTER TABLE `orders_status` DISABLE KEYS */;
INSERT INTO `orders_status` VALUES (1,'Pending',1),(2,'Delivered',1),(3,'Sent',1),(4,'Received',1),(5,'Cancelled',1);
/*!40000 ALTER TABLE `orders_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (2,1,'Beacon','Day','beacon@day.con','2012-10-30 18:05:40'),(3,1,'Last Night','A person','last@night.com','2012-11-02 07:45:15');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Trailrunner','Online shop','info@trailrunner.co.za','20f6ac3f854879e54fca9fb6c64a3f1d','2012-10-27 14:59:23');
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

-- Dump completed on 2013-04-16  6:15:11
