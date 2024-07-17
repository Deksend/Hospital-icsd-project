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
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctors` (
  `doctor_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  PRIMARY KEY (`doctor_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (1,'Δημήτρης','Παπαδόπουλος','Ορθοπεδικός','dimitris@example.com','password1','Εξειδικευμένος Ορθοπαιδικός με πολυετή εμπειρία στη χειρουργική και θεραπεία ορθοπαιδικών παθήσεων.\''),(2,'Μαρία','Γεωργίου','Οφθαλμίατρος','maria@example.com','password22','\'Έμπειρος Οφθαλμίατρος με εξειδίκευση στη διάγνωση και θεραπεία παθήσεων των ματιών.\''),(3,'Αλεξάνδρα','Σταυρίδου','Ψυχίατρος','alexandra@example.com','password3','\'Πιστοποιημένος Ψυχίατρος με εμπειρία στην ψυχιατρική φροντίδα και ψυχοθεραπεία.\''),(4,'Γιάννης','Κωνσταντίνου','Δερματολόγος','giannis@example.com','password4','Εξειδικευμένος Δερματολόγος με εμπειρία στη διάγνωση και θεραπεία δερματικών παθήσεων.\''),(5,'Ελένη','Παπανδρέου','Γυναικολόγος','eleni@example.com','password5','\'Πιστοποιημένος Γυναικολόγος με εμπειρία στη γυναικολογική φροντίδα και αναπαραγωγική υγεία.\''),(9,'Παρασκευας','Κυριακιου','Οφθαλμιατρος','evdomadiaios@example.com','savvato','Πιστοποιημένος Οφθαλμίατρος με πολυετή εμπειρία στη φροντίδα και θεραπεία οφθαλμικών προβλημάτων.\'');
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
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
