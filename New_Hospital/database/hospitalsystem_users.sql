CREATE DATABASE  IF NOT EXISTS `hospitalsystem` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `hospitalsystem`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: hospitalsystem
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `tautotita` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('patients','secretary','doctors','guests') NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Δημήτρης','Παπαδόπουλος','AB1234567','dimitris.doctor@example.com','password1','doctors'),(2,'Μαρία','Γεωργίου','CD9876543','maria.doctor@example.com','password2','doctors'),(3,'Αλεξάνδρα','Σταυρίδου','EF4567890','alexandra.doctor@example.com','password3','doctors'),(4,'Γιάννης','Κωνσταντίνου','GH7890123','giannis.doctor@example.com','password4','doctors'),(5,'Ελένη','Παπανδρέου','IJ3216549','eleni.doctor@example.com','password5','doctors'),(6,'Αναστασία','Παπαδοπούλου','KL0123456','anastasia.patient@example.com','password6','patients'),(7,'Γιώργος','Καραγιάννης','MN1234567','giorgos.patient@example.com','password7','patients'),(8,'Ελένη','Δημητρίου','OP2345678','eleni.patient@example.com','password8','patients'),(9,'Δημήτρης','Νικολαΐδης','QR3456789','dimnik.patient@example.com','password9','patients'),(10,'Μαρία','Σταματίου','ST4567890','mariast.patient@example.com','password10','patients'),(11,'Ελένη','Παπαδοπούλου','UV5678901','secretary@example.com','password123','secretary'),(27,'Αναστασία','Παπαδοπούλου','','01234567891','','patients'),(28,'Γιώργος','Καραγιάννης','','12345678902','','patients'),(29,'Ελένη','Δημητρίου','','23456789013','','patients'),(30,'Δημήτρης','Νικολαΐδης','','34567890124','','patients'),(31,'Μαρία','Σταματίου','','45678901235','','patients'),(34,'Ελένη','Παπαδοπούλου','','eleni@example.com','password123','secretary'),(35,'Δημήτρης','Παπαδόπουλος','','dimitris@example.com','password1','doctors'),(36,'Μαρία','Γεωργίου','','maria@example.com','password2','doctors'),(37,'Αλεξάνδρα','Σταυρίδου','','alexandra@example.com','password3','doctors'),(38,'Γιάννης','Κωνσταντίνου','','giannis@example.com','password4','doctors');
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

-- Dump completed on 2024-06-16 22:13:40
