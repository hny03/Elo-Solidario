-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: elo_solidario
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.22.04.1


--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_organizacao` varchar(255) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome_representante` varchar(255) DEFAULT NULL,
  `email_representante` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnpj` (`cnpj`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
INSERT INTO `usuarios` VALUES (1,
'ONG Teste Solidário',
'12345678000195',
'11987654321',
'teste@ongsolidario.com',
'$2y$10$Yq2KT82f5fxcAKQB0mxiyeBfczJWUW/2FQcQs90EIxPK.AusCMMcW',
'João Silva',
'joao.silva@ongsolidario.com');
UNLOCK TABLES;

-- Dump completed on 2025-09-06 11:02:10


