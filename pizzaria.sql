-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: pizzaria
-- ------------------------------------------------------
-- Server version	5.7.10-log

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
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCategoria` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` VALUES (1,'bruna');
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categoria_subcategoria`
--

DROP TABLE IF EXISTS `tbl_categoria_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categoria_subcategoria` (
  `idCateSub` int(11) NOT NULL AUTO_INCREMENT,
  `idCategoria` int(11) DEFAULT NULL,
  `idSubtegoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCateSub`),
  KEY `fkidCategoria_idx` (`idCategoria`),
  KEY `fkidSubcategoria_idx` (`idSubtegoria`),
  CONSTRAINT `fkidCategoria` FOREIGN KEY (`idCategoria`) REFERENCES `tbl_categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkidSubcategoria` FOREIGN KEY (`idSubtegoria`) REFERENCES `tbl_subcategoria` (`idSubcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria_subcategoria`
--

LOCK TABLES `tbl_categoria_subcategoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria_subcategoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_categoria_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_curiosidade`
--

DROP TABLE IF EXISTS `tbl_curiosidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_curiosidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagem1` varchar(200) DEFAULT NULL,
  `imagem2` varchar(200) DEFAULT NULL,
  `imagem3` varchar(200) DEFAULT NULL,
  `nome1` varchar(45) DEFAULT NULL,
  `nome2` varchar(45) DEFAULT NULL,
  `nome3` varchar(45) DEFAULT NULL,
  `texto1` text,
  `texto2` text,
  `texto3` text,
  `texto4` text,
  `texto5` text,
  `texto6` text,
  `nomevideo` varchar(200) DEFAULT NULL,
  `ativar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_curiosidade`
--

LOCK TABLES `tbl_curiosidade` WRITE;
/*!40000 ALTER TABLE `tbl_curiosidade` DISABLE KEYS */;
INSERT INTO `tbl_curiosidade` VALUES (1,'arquivo/b86d151d47ef1511c82b257c3096e9ed.jpg','arquivo/6a4120be23c814f80233ecbb34e71adc.jpg','arquivo/acabae316d73706508b25c00e6397022.jpg','et','brasil','anos 70','Temas e estilos também ajudam a manter seu documento coordenado. Quando você clica em Design e escolhe um novo tema, as imagens, gráficos e elementos gráficos SmartArt são alterados para corresponder ao novo tema. Quando você aplica estilos, os títulos são alterados para coincidir com o novo tema. Economize tempo no Word com novos botões que são mostrados no local em que você precisa deles. Para alterar a maneira como uma imagem se ajusta ao seu documento, clique nela e um botão de opções de lay','Temas e estilos também ajudam a manter seu documento coordenado. Quando você clica em Design e escolhe um novo tema, as imagens, gráficos e elementos gráficos SmartArt são alterados para corresponder ao novo tema. Quando você aplica estilos, os títulos são alterados para coincidir com o novo tema. Economize tempo no Word com novos botões que são mostrados no local em que você precisa deles. Para alterar a maneira como uma imagem se ajusta ao seu documento, clique nela e um botão de opções de lay','Temas e estilos também ajudam a manter seu documento coordenado. Quando você clica em Design e escolhe um novo tema, as imagens, gráficos e elementos gráficos SmartArt são alterados para corresponder ao novo tema. Quando você aplica estilos, os títulos são alterados para coincidir com o novo tema. Economize tempo no Word com novos botões que são mostrados no local em que você precisa deles. Para alterar a maneira como uma imagem se ajusta ao seu documento, clique nela e um botão de opções de lay','Temas e estilos também ajudam a manter seu documento coordenado. Quando você clica em Design e escolhe um novo tema, as imagens, gráficos e elementos gráficos SmartArt são alterados para corresponder ao novo tema. Quando você aplica estilos, os títulos são alterados para coincidir com o novo tema. Economize tempo no Word com novos botões que são mostrados no local em que você precisa deles. Para alterar a maneira como uma imagem se ajusta ao seu documento, clique nela e um botão de opções de lay','Temas e estilos também ajudam a manter seu documento coordenado. Quando você clica em Design e escolhe um novo tema, as imagens, gráficos e elementos gráficos SmartArt são alterados para corresponder ao novo tema. Quando você aplica estilos, os títulos são alterados para coincidir com o novo tema. Economize tempo no Word com novos botões que são mostrados no local em que você precisa deles. Para alterar a maneira como uma imagem se ajusta ao seu documento, clique nela e um botão de opções de lay','Temas e estilos também ajudam a manter seu documento coordenado. Quando você clica em Design e escolhe um novo tema, as imagens, gráficos e elementos gráficos SmartArt são alterados para corresponder ao novo tema. Quando você aplica estilos, os títulos são alterados para coincidir com o novo tema. Economize tempo no Word com novos botões que são mostrados no local em que você precisa deles. Para alterar a maneira como uma imagem se ajusta ao seu documento, clique nela e um botão de opções de lay','https://www.youtube.com/embed/pB-5XG-DbAA',1);
/*!40000 ALTER TABLE `tbl_curiosidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_faleconosco`
--

DROP TABLE IF EXISTS `tbl_faleconosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_faleconosco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  `celular` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `homePage` varchar(50) DEFAULT NULL,
  `linkFacebook` varchar(200) DEFAULT NULL,
  `sugestaoCriticas` varchar(500) DEFAULT NULL,
  `informacoesProdutos` varchar(200) DEFAULT NULL,
  `sexo` char(1) NOT NULL,
  `profissao` varchar(100) NOT NULL,
  `ativar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_faleconosco`
--

LOCK TABLES `tbl_faleconosco` WRITE;
/*!40000 ALTER TABLE `tbl_faleconosco` DISABLE KEYS */;
INSERT INTO `tbl_faleconosco` VALUES (1,'danielle narciso','011 0908-0909','011 09090-0909','dani@gmail.com','jskfdja','kajnfcds','isjdfuhds','pijadfoihoidsa','F','oiqejrfiu',NULL),(2,'danielle narciso','011 0908-0909','011 09090-0909','dani@gmail.com','jskfdja','kajnfcds','isjdfuhds','pijadfoihoidsa','F','oiqejrfiu',NULL),(3,'danielle narciso','011 0908-0909','011 09090-0909','dani@gmail.com','jskfdja','kajnfcds','isjdfuhds','pijadfoihoidsa','F','oiqejrfiu',NULL);
/*!40000 ALTER TABLE `tbl_faleconosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_homeproduto`
--

DROP TABLE IF EXISTS `tbl_homeproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_homeproduto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto1` varchar(200) DEFAULT NULL,
  `produto2` varchar(200) DEFAULT NULL,
  `produto3` varchar(200) DEFAULT NULL,
  `produto4` varchar(200) DEFAULT NULL,
  `produto5` varchar(200) DEFAULT NULL,
  `produto6` varchar(200) DEFAULT NULL,
  `nomeproduto1` varchar(100) DEFAULT NULL,
  `nomeproduto2` varchar(100) DEFAULT NULL,
  `nomeproduto3` varchar(100) DEFAULT NULL,
  `nomeproduto4` varchar(100) DEFAULT NULL,
  `nomeproduto5` varchar(100) DEFAULT NULL,
  `nomeproduto6` varchar(100) DEFAULT NULL,
  `ativar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_homeproduto`
--

LOCK TABLES `tbl_homeproduto` WRITE;
/*!40000 ALTER TABLE `tbl_homeproduto` DISABLE KEYS */;
INSERT INTO `tbl_homeproduto` VALUES (3,'arquivo/c2e2e7271ecaf25c5987e4aa76bd79ca.jpg','arquivo/11f666820ee34923ebd3631b6f68491f.jpg','arquivo/54f8fc8e362d98bc895a127b4e03e966.jpg','arquivo/0a08118e702035e9e0541619ea3a4687.jpg','arquivo/c7a2833a95cc9b12bee23362895ecd60.jpg','arquivo/7b6687fb81cedb78b56816635d166b8b.jpg','cachorro quente','calabresa','cholate','frango catupiry','portuguesa','quartro queijo',1);
/*!40000 ALTER TABLE `tbl_homeproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_homeslide`
--

DROP TABLE IF EXISTS `tbl_homeslide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_homeslide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagem1` varchar(200) DEFAULT NULL,
  `imagem2` varchar(200) DEFAULT NULL,
  `imagem3` varchar(200) DEFAULT NULL,
  `imagem4` varchar(200) DEFAULT NULL,
  `imagem5` varchar(200) DEFAULT NULL,
  `nomeimagem1` varchar(100) DEFAULT NULL,
  `nomeimagem2` varchar(100) DEFAULT NULL,
  `nomeimagem3` varchar(100) DEFAULT NULL,
  `nomeimagem4` varchar(100) DEFAULT NULL,
  `nomeimagem5` varchar(100) DEFAULT NULL,
  `ativar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_homeslide`
--

LOCK TABLES `tbl_homeslide` WRITE;
/*!40000 ALTER TABLE `tbl_homeslide` DISABLE KEYS */;
INSERT INTO `tbl_homeslide` VALUES (4,'arquivo/b86d151d47ef1511c82b257c3096e9ed.jpg','arquivo/b86d151d47ef1511c82b257c3096e9ed.jpg','arquivo/8a320fefcf4204648818850d09d293b6.jpg','arquivo/b86d151d47ef1511c82b257c3096e9ed.jpg','arquivo/b86d151d47ef1511c82b257c3096e9ed.jpg','fgdfxg','','','','',1),(5,'arquivo/4cdbc5dfdbfc8a0dd1136b5703949ab7.jpg','arquivo/5903d9e9a8884c8c04ad16559446735a.jpg','arquivo/0004d0b59e19461ff126e3a08a814c33.jpg','arquivo/6e93b7a88e80c289fac17695bf702dc0.jpg','arquivo/03ddb94749ec1487d7feb954d3af8af7.jpg','himan','angelica','fdgsd','carros','jovem guarda',1);
/*!40000 ALTER TABLE `tbl_homeslide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nivel`
--

DROP TABLE IF EXISTS `tbl_nivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nivel` (
  `idNivel` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `conteudo` tinyint(1) DEFAULT NULL,
  `faleConosco` tinyint(1) DEFAULT NULL,
  `produtos` tinyint(1) DEFAULT NULL,
  `usuario` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idNivel`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nivel`
--

LOCK TABLES `tbl_nivel` WRITE;
/*!40000 ALTER TABLE `tbl_nivel` DISABLE KEYS */;
INSERT INTO `tbl_nivel` VALUES (1,'cataloguista',0,0,1,0),(2,'operador basico',1,1,0,1),(3,'administrador',1,1,1,1);
/*!40000 ALTER TABLE `tbl_nivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nossoambiente`
--

DROP TABLE IF EXISTS `tbl_nossoambiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nossoambiente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome1` varchar(100) NOT NULL,
  `imagem1` varchar(200) NOT NULL,
  `nome2` varchar(100) NOT NULL,
  `imagem2` varchar(200) NOT NULL,
  `texto1` text,
  `texto2` text,
  `texto3` text,
  `ativar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nossoambiente`
--

LOCK TABLES `tbl_nossoambiente` WRITE;
/*!40000 ALTER TABLE `tbl_nossoambiente` DISABLE KEYS */;
INSERT INTO `tbl_nossoambiente` VALUES (6,'Minha','arquivo/23eb5a8964b909966b5161e0b7a51849.jpg','Minha Loja 2222','arquivo/fa13bcb2ac7ef825242b3d89397f7b98.jpg','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.',1),(7,'Minha 666','arquivo/23eb5a8964b909966b5161e0b7a51849.jpg','Minha Loja 2222','arquivo/59b514174bffe4ae402b3d63aad79fe0.jpg','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.',NULL);
/*!40000 ALTER TABLE `tbl_nossoambiente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pizzames`
--

DROP TABLE IF EXISTS `tbl_pizzames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pizzames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `imagem` varchar(200) NOT NULL,
  `ativar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pizzames`
--

LOCK TABLES `tbl_pizzames` WRITE;
/*!40000 ALTER TABLE `tbl_pizzames` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pizzames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `preco` varchar(45) DEFAULT NULL,
  `ativar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto`
--

LOCK TABLES `tbl_produto` WRITE;
/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` VALUES (1,'dfds','arquivo/d83eb4547eb0d7bee74a4b47774c4b68.jpg','edfw','dsfs',NULL);
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promocoes`
--

DROP TABLE IF EXISTS `tbl_promocoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_promocoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagem1` varchar(200) DEFAULT NULL,
  `descricao1` varchar(100) DEFAULT NULL,
  `imagem2` varchar(200) DEFAULT NULL,
  `descricao2` varchar(100) DEFAULT NULL,
  `imagem3` varchar(200) DEFAULT NULL,
  `descricao3` varchar(100) DEFAULT NULL,
  `ativar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promocoes`
--

LOCK TABLES `tbl_promocoes` WRITE;
/*!40000 ALTER TABLE `tbl_promocoes` DISABLE KEYS */;
INSERT INTO `tbl_promocoes` VALUES (4,'arquivo/59b514174bffe4ae402b3d63aad79fe0.jpg','Minha promoção 789','arquivo/23eb5a8964b909966b5161e0b7a51849.jpg','Minha Loja','arquivo/fa13bcb2ac7ef825242b3d89397f7b98.jpg','Minha curiosidade 3',NULL);
/*!40000 ALTER TABLE `tbl_promocoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobrepizzaria`
--

DROP TABLE IF EXISTS `tbl_sobrepizzaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sobrepizzaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome1` varchar(100) DEFAULT NULL,
  `imagem1` varchar(200) DEFAULT NULL,
  `nome2` varchar(100) DEFAULT NULL,
  `imagem2` varchar(200) DEFAULT NULL,
  `texto1` text,
  `texto2` text,
  `texto3` text,
  `texto4` text,
  `texto5` text,
  `texto6` text,
  `texto7` text,
  `ativar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobrepizzaria`
--

LOCK TABLES `tbl_sobrepizzaria` WRITE;
/*!40000 ALTER TABLE `tbl_sobrepizzaria` DISABLE KEYS */;
INSERT INTO `tbl_sobrepizzaria` VALUES (7,'oooooii','arquivo/b70431eb234ee4fd845666653fa5d70a.jpg','é a bruna','arquivo/b70431eb234ee4fd845666653fa5d70a.jpg','hgcfty','uyhuj','huih','ihuihu','iuj','iggy','iughi',NULL),(8,'oooooii','arquivo/2002f75d1d7582b75a40aa6b8c82c997.jpg','é a bruna','arquivo/469bba0a564235dfceede42db14f17b0.gif','hgcfty','uyhuj','bruna','ihuihu','iuj','iggy','iughi',NULL),(9,'Minha loja 666','arquivo/082dbe6dc9958732b3c2d1b8e300bdb7.jpg','Minha Loja 2222','arquivo/fa13bcb2ac7ef825242b3d89397f7b98.jpg','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.',NULL),(10,'ytyeer','arquivo/8a320fefcf4204648818850d09d293b6.jpg','yu','arquivo/10d5a0555a83f8bb41290c1e14e603e3.jpg','tuytyuh','tru','ru','ru','ury','uyuj','yiuyt',NULL);
/*!40000 ALTER TABLE `tbl_sobrepizzaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subcategoria`
--

DROP TABLE IF EXISTS `tbl_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_subcategoria` (
  `idSubcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nomeSubcategoria` varchar(100) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSubcategoria`),
  KEY `fkidCategoria_idx` (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subcategoria`
--

LOCK TABLES `tbl_subcategoria` WRITE;
/*!40000 ALTER TABLE `tbl_subcategoria` DISABLE KEYS */;
INSERT INTO `tbl_subcategoria` VALUES (1,'cgvdcgv',NULL),(2,'dgsdg',NULL);
/*!40000 ALTER TABLE `tbl_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `usuario` varchar(10) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `idNivel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkidNivel_idx` (`idNivel`),
  CONSTRAINT `fkidNivel` FOREIGN KEY (`idNivel`) REFERENCES `tbl_nivel` (`idNivel`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (9,'admin','011 4321-5604','admin@admin.com','admin','123',3),(10,'Marcel teste','011 4772-4700','marcel@gmail.com','marcelnt','123',2),(12,'Gabriel de Melo Marcondes','011 4707-2731','gabriel-santos1313@hotmail.com','gabriel','127',1),(13,'Bruna linda','011 4321-5604','bruna@gmail.com','bruna','123',2),(14,'joao','011 9568-5236','joao@gmail.com','joao','147',3),(15,'leticia','011 4774-5236','leticia@gmail.com','lele','456',2),(16,'teste','011 4774-5236','brhn@jsikfj','tete','123',1),(17,'luana','011 4774-5236','luana@bbb.com','lu','333',2);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-24 16:04:03
