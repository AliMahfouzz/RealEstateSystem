-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: kontrol
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `broker_applies`
--

DROP TABLE IF EXISTS `broker_applies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `broker_applies` (
  `idbroker_applies` int NOT NULL AUTO_INCREMENT,
  `idusers` varchar(45) DEFAULT NULL,
  `idunits` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `typeofpayment` varchar(450) DEFAULT NULL,
  `name` varchar(450) DEFAULT NULL,
  `phone1` varchar(450) DEFAULT NULL,
  `phone2` varchar(450) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `address` varchar(450) DEFAULT NULL,
  `class` varchar(450) DEFAULT NULL,
  `job` varchar(450) DEFAULT NULL,
  `monthly_income` varchar(450) DEFAULT NULL,
  `budget` varchar(450) DEFAULT NULL,
  `preferences` varchar(450) DEFAULT NULL,
  `notes` varchar(450) DEFAULT NULL,
  `duration_of_installment` varchar(450) DEFAULT NULL,
  `paid` varchar(450) DEFAULT '0',
  PRIMARY KEY (`idbroker_applies`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `broker_applies`
--

LOCK TABLES `broker_applies` WRITE;
/*!40000 ALTER TABLE `broker_applies` DISABLE KEYS */;
INSERT INTO `broker_applies` VALUES (10,'2','1','2500','2022-06-16 15:48:15','installments','Halla Whitley','+1 (668) 894-6599','+1 (857) 791-3798','xygu@mailinator.com','Ut voluptatem reicie','Sed odio neque cupid','Proident quisquam N','441','54','Cupidatat in deserun','Corrupti rerum quam','12','1'),(9,'2','1','2500','2022-06-16 15:46:10','cash','asd','12345678901','123123312123','admin@admin.com','asdasdassda','','','22221','123123312132','asdasddasdas','adsadssaddas','','1'),(8,'2','1','2500','2022-05-25 20:09:54','installments','ali','123456789012','','ali@hotmail.com','cairo, egypt','one','developer','','10000','test','test test test','12','1');
/*!40000 ALTER TABLE `broker_applies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `idprojects` int NOT NULL AUTO_INCREMENT,
  `pname` varchar(450) DEFAULT NULL,
  `description` varchar(450) DEFAULT NULL,
  `startdate` varchar(450) DEFAULT NULL,
  `enddate` varchar(450) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idprojects`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'first project','new qahira building','2022-05-16','2022-05-28','1652653795b.jpg'),(2,'project 2','p2','2022-05-03','2022-05-31','1652910359aswan.png');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `idquestions` int NOT NULL AUTO_INCREMENT,
  `title` varchar(450) DEFAULT NULL,
  `description` text,
  `idusers` varchar(45) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  `replied_user` varchar(450) DEFAULT NULL,
  `replied_comment` varchar(450) DEFAULT NULL,
  `replied_file` varchar(450) DEFAULT NULL,
  `status` varchar(45) DEFAULT '0',
  PRIMARY KEY (`idquestions`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'Issue 1','i cannot apply for new qahira village','1',NULL,'1','ok it should works fine right now!!','165270430274H8.gif','1'),(2,'question 1','issue with the view','2','1652725944tanta.png','1','it is solved right now','1652726151OIP.jpg','1'),(3,'question12','asdasdjkljsldkjaklsjdalks','2','1652911568young-woman-pharmacist-pharmacy.jpg','1','ahjakshdjkahskdjhajksd','1652911612analysis.png','1');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rent`
--

DROP TABLE IF EXISTS `rent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rent` (
  `idrent` int NOT NULL AUTO_INCREMENT,
  `idunits` varchar(450) DEFAULT NULL,
  `rentperiod` varchar(450) DEFAULT NULL,
  `rentprice` varchar(450) DEFAULT '0',
  PRIMARY KEY (`idrent`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rent`
--

LOCK TABLES `rent` WRITE;
/*!40000 ALTER TABLE `rent` DISABLE KEYS */;
INSERT INTO `rent` VALUES (1,'1','1 month','50000');
/*!40000 ALTER TABLE `rent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale`
--

DROP TABLE IF EXISTS `sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sale` (
  `idsale` int NOT NULL AUTO_INCREMENT,
  `idunits` varchar(450) DEFAULT NULL,
  `saleinstallment` varchar(450) DEFAULT '0',
  `saleperiod` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idsale`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale`
--

LOCK TABLES `sale` WRITE;
/*!40000 ALTER TABLE `sale` DISABLE KEYS */;
INSERT INTO `sale` VALUES (2,'2','1200000','1 month');
/*!40000 ALTER TABLE `sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `units` (
  `idunits` int NOT NULL AUTO_INCREMENT,
  `idprojects` varchar(450) DEFAULT NULL,
  `uname` varchar(450) DEFAULT NULL,
  `udescription` varchar(450) DEFAULT NULL,
  `unittype` varchar(450) DEFAULT NULL,
  `paymentmethod` varchar(450) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  `price` varchar(450) DEFAULT '0',
  PRIMARY KEY (`idunits`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'1','first round','3 bedrooms, 1 bathroom, 1 kitchen','Town house','rent','1652688041unit.jpg','0'),(2,'2','unit2','u2','Town house','sale','1652910891aswan.png','0');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `idusers` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(450) DEFAULT NULL,
  `lname` varchar(450) DEFAULT NULL,
  `email` varchar(450) DEFAULT NULL,
  `password` varchar(450) DEFAULT NULL,
  `phone` varchar(450) DEFAULT NULL,
  `image` varchar(450) DEFAULT NULL,
  `role` int DEFAULT '0',
  PRIMARY KEY (`idusers`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','admin@admin.com','123456789','012345456456456','1652650661icons8-user-40.png',0),(2,'broker','b','broker@broker.com','123456789','1234567890123','1652651389icons8-male-user-40.png',1),(3,'t','t1','t@t.com','123456789','12345678901','1652908587trammal.jpg',1),(4,'broker1','b','broker1@broker.com','123456789','123456789','1652910207analysis.png',1);
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

-- Dump completed on 2022-06-16 16:55:51
