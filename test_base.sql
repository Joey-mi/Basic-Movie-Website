-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: movie_theatres
-- ------------------------------------------------------
-- Server version	8.0.31

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

DROP DATABASE IF EXISTS `movie_theatres`;
CREATE DATABASE `movie_theatres` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `movie_theatres`;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `admin_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_reference`
--

DROP TABLE IF EXISTS `booking_reference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_reference` (
  `booking_id` int unsigned NOT NULL AUTO_INCREMENT,
  `cus_email` varchar(255) NOT NULL,
  PRIMARY KEY (`booking_id`),
  CONSTRAINT `fk_cus_email` FOREIGN KEY (`cus_email`) REFERENCES `customer` (`customer_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_reference`
--

LOCK TABLES `booking_reference` WRITE;
/*!40000 ALTER TABLE `booking_reference` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking_reference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cinema`
--

DROP TABLE IF EXISTS `cinema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cinema` (
  `cinema_name` varchar(255) NOT NULL,
  `postal_code` char(6) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street_num` int unsigned NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  PRIMARY KEY (`cinema_name`),
  UNIQUE KEY `postal_code_UNIQUE` (`postal_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cinema`
--

LOCK TABLES `cinema` WRITE;
/*!40000 ALTER TABLE `cinema` DISABLE KEYS */;
/*!40000 ALTER TABLE `cinema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contains_report_ticket`
--

DROP TABLE IF EXISTS `contains_report_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contains_report_ticket` (
  `report_no` int unsigned NOT NULL,
  `ticket_no` int NOT NULL,
  PRIMARY KEY (`report_no`,`ticket_no`),
  KEY `fk_tick_no_idx` (`ticket_no`),
  CONSTRAINT `fk_report` FOREIGN KEY (`report_no`) REFERENCES `movie_report` (`report_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tick_no` FOREIGN KEY (`ticket_no`) REFERENCES `ticket` (`ticket_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contains_report_ticket`
--

LOCK TABLES `contains_report_ticket` WRITE;
/*!40000 ALTER TABLE `contains_report_ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `contains_report_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `customer_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customer_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `help_issues`
--

DROP TABLE IF EXISTS `help_issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `help_issues` (
  `a_email` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `help_id` int unsigned NOT NULL AUTO_INCREMENT,
  `issue_details` longtext DEFAULT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`a_email`,`c_email`,`help_id`),
  UNIQUE KEY `help_id_UNIQUE` (`help_id`),
  KEY `fk_c_email_idx` (`c_email`),
  CONSTRAINT `fk_a_email` FOREIGN KEY (`a_email`) REFERENCES `admin` (`admin_email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_c_email` FOREIGN KEY (`c_email`) REFERENCES `customer` (`customer_email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help_issues`
--

LOCK TABLES `help_issues` WRITE;
/*!40000 ALTER TABLE `help_issues` DISABLE KEYS */;
/*!40000 ALTER TABLE `help_issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movie` (
  `movie_name` varchar(255) NOT NULL,
  `movie_desc` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `movie_path` varchar(255) NULL,
  PRIMARY KEY (`movie_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie`
--

LOCK TABLES `movie` WRITE;
/*!40000 ALTER TABLE `movie` DISABLE KEYS */;
/*!40000 ALTER TABLE `movie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie_report`
--

DROP TABLE IF EXISTS `movie_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movie_report` (
  `report_no` int unsigned NOT NULL AUTO_INCREMENT,
  `sales_date` date NOT NULL,
  `sales_time` time,
  `theatre_no` int unsigned NOT NULL,
  `sales_value` int NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `run_date` date NOT NULL,
  PRIMARY KEY (`report_no`),
  KEY `fk_admin_email` (`admin_email`),
  KEY `fk_movie_name` (`movie_name`),
  CONSTRAINT `fk_admin_email` FOREIGN KEY (`admin_email`) REFERENCES `admin` (`admin_email`),
  CONSTRAINT `fk_movie_name` FOREIGN KEY (`movie_name`) REFERENCES `movie` (`movie_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie_report`
--

LOCK TABLES `movie_report` WRITE;
/*!40000 ALTER TABLE `movie_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `movie_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `transaction_no` int unsigned NOT NULL AUTO_INCREMENT,
  `debit` char(1) DEFAULT NULL COMMENT '- Datatype is Char(1) for a flag. Used debit, ''T'', or not use debit, ''F''.',
  `credit` char(1) DEFAULT NULL COMMENT '- Datatype is Char(1) for a flag. Used credit, ''''T'', or not use credit, ''F''.',
  `amount` decimal(10,0) NOT NULL,
  `cemail` varchar(255) NOT NULL,
  PRIMARY KEY (`transaction_no`),
  KEY `fk_customer_em` (`cemail`),
  CONSTRAINT `fk_customer_em` FOREIGN KEY (`cemail`) REFERENCES `customer` (`customer_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seat`
--

DROP TABLE IF EXISTS `seat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seat` (
  `seat_no` smallint NOT NULL,
  `type` varchar(155) DEFAULT NULL,
  `theatre_no` int unsigned NOT NULL,
  PRIMARY KEY (`seat_no`, `theatre_no`),
  KEY `fk_thea_num_idx` (`theatre_no`),
  CONSTRAINT `fk_thea_num` FOREIGN KEY (`theatre_no`) REFERENCES `theatre_hall` (`theatre_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seat`
--

LOCK TABLES `seat` WRITE;
/*!40000 ALTER TABLE `seat` DISABLE KEYS */;
/*!40000 ALTER TABLE `seat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `show_time`
--

DROP TABLE IF EXISTS `show_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `show_time` (
  `s_date` date NOT NULL,
  `s_time` time NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  PRIMARY KEY (`s_date`,`s_time`,`movie_name`),
  KEY `fk_movie_name_idx` (`movie_name`),
  KEY `time_idx` (`s_time`),
  KEY `date_idx` (`s_date`),
  CONSTRAINT `fk_movi_name` FOREIGN KEY (`movie_name`) REFERENCES `movie` (`movie_name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `show_time`
--

LOCK TABLES `show_time` WRITE;
/*!40000 ALTER TABLE `show_time` DISABLE KEYS */;
/*!40000 ALTER TABLE `show_time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shown_in`
--

DROP TABLE IF EXISTS `shown_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shown_in` (
  `m_name` varchar(255) NOT NULL,
  `theatre_num` int unsigned NOT NULL,
  PRIMARY KEY (`m_name`, `theatre_num`),
  KEY `fk_mname` (`m_name`),
  KEY `fk_thtr_num_idx` (`theatre_num`),
  CONSTRAINT `fk_mname` FOREIGN KEY (`m_name`) REFERENCES `movie` (`movie_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_thtr_num` FOREIGN KEY (`theatre_num`) REFERENCES `theatre_hall` (`theatre_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shown_in`
--

LOCK TABLES `shown_in` WRITE;
/*!40000 ALTER TABLE `shown_in` DISABLE KEYS */;
/*!40000 ALTER TABLE `shown_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theatre_hall`
--

DROP TABLE IF EXISTS `theatre_hall`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `theatre_hall` (
  `theatre_no` int unsigned NOT NULL AUTO_INCREMENT,
  `cinema_name` varchar(255) NOT NULL,
  PRIMARY KEY (`theatre_no`),
  KEY `fk_cinema_name` (`cinema_name`),
  CONSTRAINT `fk_cinema_name` FOREIGN KEY (`cinema_name`) REFERENCES `cinema` (`cinema_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theatre_hall`
--

LOCK TABLES `theatre_hall` WRITE;
/*!40000 ALTER TABLE `theatre_hall` DISABLE KEYS */;
/*!40000 ALTER TABLE `theatre_hall` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket` (
  `ticket_no` int NOT NULL AUTO_INCREMENT,
  `bookid` int unsigned,
  `sdate` date NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `stime` time NOT NULL,
  `barcode` char(13) NOT NULL,
  `sold_flag` char(1) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `seat_no` smallint NOT NULL,
  `theatre_no` int unsigned NOT NULL,
  PRIMARY KEY (`ticket_no`),
  KEY `fk_bookid_idx` (`bookid`),
  KEY `fk_sdate_idx` (`sdate`),
  KEY `fk_stime_idx` (`stime`),
  KEY `fk_moname_idx` (`movie_name`),
  KEY `fk_theatr_num_idx` (`theatre_no`),
  KEY `fk_seatnum_idx` (`seat_no`),
  CONSTRAINT `fk_bookid` FOREIGN KEY (`bookid`) REFERENCES `booking_reference` (`booking_id`),
  CONSTRAINT `fk_moname` FOREIGN KEY (`movie_name`) REFERENCES `movie` (`movie_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_sdate` FOREIGN KEY (`sdate`) REFERENCES `show_time` (`s_date`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_seatnum` FOREIGN KEY (`seat_no`) REFERENCES `seat` (`seat_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_stime` FOREIGN KEY (`stime`) REFERENCES `show_time` (`s_time`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_theatr_num` FOREIGN KEY (`theatre_no`) REFERENCES `theatre_hall` (`theatre_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-20 16:40:16