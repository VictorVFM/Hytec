-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: hytec
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `razaoSocial` varchar(50) NOT NULL,
  `nomeFantasia` varchar(50) NOT NULL,
  `dataFundacao` varchar(10) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'ROBERT BOSCH LIMITADA','Bosch Group','1966-07-20','45.990.181/0001-89','CADASTRO.TRIBUTARIO@BR.BOSCH.COM','(19)99287-5963'),(6,'Brasil SA','Brasil Soluções em TI','08/10/2023','38.214.611/0001-05','douglascrespo@gmail.com','(19)98819-5830'),(9,'Asteroid','CCNA Legal','02/10/2023','14.491.620/0001-85','dsfdas@gmail.com','(19)99233-3746'),(22,'Empilhadeiras Hyundai','Empilhadeiras Hyundai','01/10/2023','14.491.620/0001-85','admin@gmail.com','(19)99286-6283'),(23,'Prefeitura Municipal de Campinas','Ateduc','16/10/2018','14.491.620/0001-85','ateduc@gmail.com','(19)99233-3746'),(24,'Brasil Auto Peças LTDA','Brasil Auto','05/04/2023','16.976.817/0001-30','brauto@gmail.com','(11)97126-8445');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cep` varchar(9) NOT NULL,
  `logradouro` varchar(50) DEFAULT NULL,
  `bairro` varchar(30) NOT NULL,
  `estado` varchar(5) NOT NULL,
  `id_Cliente` int NOT NULL,
  `localidade` varchar(50) NOT NULL,
  `numero` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_Cliente` (`id_Cliente`),
  CONSTRAINT `Endereco_ibfk_1` FOREIGN KEY (`id_Cliente`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (6,'12345-678','Rua do Cliente','Jardim teste','s',1,'Cidade do Cliente',100),(8,'13056-201','Rua Sérgio Barbieri','Jardim Esplanada','SP',22,'Campinas',251),(9,'13070-071','Avenida João Erbolato','Jardim Chapadão','SP',23,'Campinas',456),(10,'13015-904','Avenida Anchieta','Centro','SP',24,'Campinas',1003);
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `dataInicial` datetime NOT NULL,
  `dataFinal` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES (11,'Comprar ração','2023-10-21 00:00:00','2023-10-21 00:00:00'),(13,'Pagar conta de agua','2023-10-31 00:00:00','2023-10-31 00:00:00'),(14,'Aprender HTML','2026-01-01 00:00:00','2027-01-01 00:00:00'),(17,'Fazer Apresentação do projeto','2023-10-17 19:00:00','2023-10-17 20:00:00'),(18,'Preencher documentação do MVP (Urgente)','2023-10-17 20:00:00','2023-10-17 21:00:00'),(20,'Pagar HD','2023-11-08 00:00:00','2023-11-01 00:00:00'),(21,'Pagar HD','2023-11-01 00:57:00','2023-11-02 15:59:00');
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `razaoSocial` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedor`
--

LOCK TABLES `fornecedor` WRITE;
/*!40000 ALTER TABLE `fornecedor` DISABLE KEYS */;
INSERT INTO `fornecedor` VALUES (1,'Fornecedor Freios','14.491.620/0001-85','(19)98819-5830'),(2,'Fornecedor Motors Sport Forza','16.218.871/0001-16','(69)20135-5434'),(3,'Fornecedor Embreagem Center SA','82.730.281/0001-00','(15)24156-7284');
/*!40000 ALTER TABLE `fornecedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notaservico`
--

DROP TABLE IF EXISTS `notaservico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notaservico` (
  `id` int NOT NULL,
  `ano` year NOT NULL,
  `id_Cliente` int NOT NULL,
  `dataNota` date NOT NULL,
  `horario` time NOT NULL,
  `id_Tecnico` int NOT NULL,
  `valorTotal` double NOT NULL,
  `observacoes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`ano`),
  KEY `id_Cliente` (`id_Cliente`),
  KEY `id_Tecnico` (`id_Tecnico`),
  CONSTRAINT `NotaServico_ibfk_1` FOREIGN KEY (`id_Cliente`) REFERENCES `cliente` (`id`),
  CONSTRAINT `NotaServico_ibfk_2` FOREIGN KEY (`id_Tecnico`) REFERENCES `tecnico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notaservico`
--

LOCK TABLES `notaservico` WRITE;
/*!40000 ALTER TABLE `notaservico` DISABLE KEYS */;
INSERT INTO `notaservico` VALUES (1,2023,23,'2023-11-04','13:00:00',3,6000,'O motor estava saindo fumaça e foi necessário trocar os dois freios.'),(2,2023,24,'2023-11-06','13:00:00',3,5000,''),(3,2023,24,'2023-11-09','13:00:00',3,10000,'');
/*!40000 ALTER TABLE `notaservico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peca`
--

DROP TABLE IF EXISTS `peca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peca` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `quantidade` int NOT NULL,
  `id_Fornecedor` int NOT NULL,
  `precoUnitario` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_Fornecedor` (`id_Fornecedor`),
  CONSTRAINT `Peca_ibfk_1` FOREIGN KEY (`id_Fornecedor`) REFERENCES `fornecedor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peca`
--

LOCK TABLES `peca` WRITE;
/*!40000 ALTER TABLE `peca` DISABLE KEYS */;
INSERT INTO `peca` VALUES (3,'Freio',300,1,150),(4,'Motor',100,2,300),(5,'Embreagem',400,3,200);
/*!40000 ALTER TABLE `peca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peca_notaservico`
--

DROP TABLE IF EXISTS `peca_notaservico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peca_notaservico` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_Peca` int NOT NULL,
  `id_Notaservico` int NOT NULL,
  `qtd` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_Peca` (`id_Peca`),
  KEY `id_Notaservico` (`id_Notaservico`),
  CONSTRAINT `peca_notaservico_ibfk_1` FOREIGN KEY (`id_Peca`) REFERENCES `peca` (`id`),
  CONSTRAINT `peca_notaservico_ibfk_2` FOREIGN KEY (`id_Notaservico`) REFERENCES `notaservico` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peca_notaservico`
--

LOCK TABLES `peca_notaservico` WRITE;
/*!40000 ALTER TABLE `peca_notaservico` DISABLE KEYS */;
INSERT INTO `peca_notaservico` VALUES (21,4,2,1),(22,3,3,2),(23,4,3,1),(24,5,3,3),(25,3,1,2),(26,4,1,1);
/*!40000 ALTER TABLE `peca_notaservico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tecnico`
--

DROP TABLE IF EXISTS `tecnico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tecnico` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `dataNascimento` date NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tecnico`
--

LOCK TABLES `tecnico` WRITE;
/*!40000 ALTER TABLE `tecnico` DISABLE KEYS */;
INSERT INTO `tecnico` VALUES (1,'Victor Hugo  ','500.310.369-88','2023-10-02','victor@gmail.com'),(2,'Eduardo Prates','196.989.970-08','1980-01-05','dudu_bala_tensa@gmail.com'),(3,'Antonio Master','131.351.620-10','2000-09-15','toninho2010@hotmail.com'),(4,'Gustavo','909.115.400-40','2021-11-17','guhzin_daZS011@gmail.com'),(5,'Wallace','909.115.400-40','1988-05-18','Wallace_ReiDelas@outlook.com'),(6,'Mendonça','171.477.052-46','1984-01-30','MendonçaTT7845@gmail.com'),(7,'Marcos Rocha','741.852.627-47','2000-10-04','marcosrocha@gmail.com'),(8,'Julia Rodrigues','798.465.165-49','2002-11-15','julia@gmail.com');
/*!40000 ALTER TABLE `tecnico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Admin','admin@gmail.com','123456'),(2,'kesede','kesede@gmail.com','123456');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'hytec'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-19 15:03:21
