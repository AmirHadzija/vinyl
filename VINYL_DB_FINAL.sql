CREATE DATABASE  IF NOT EXISTS `vinyl_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `vinyl_db`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: vinyl_db
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address1` varchar(50) NOT NULL DEFAULT 'not_registered',
  `postal_code` varchar(10) DEFAULT NULL,
  `phone` varchar(20) NOT NULL DEFAULT 'not_registered',
  `id_city` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`id_city`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `id_address_city_fk_idx` (`id_city`),
  CONSTRAINT `id_address_city_fk` FOREIGN KEY (`id_city`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (37,'not_registered',NULL,'not_registered',2,'2018-06-27 14:42:21'),(42,'Kopaonicka 7','11130','0692290371',1,'2018-07-17 14:37:35'),(76,'Kopaonicka 7','11130','011 334 0000',1,'2018-07-23 00:54:13'),(77,'Php Developera 15','11000','011 224 5555',1,'2018-07-23 00:55:34'),(78,'Php Developera 19','11000','011 3322 444',13,'2018-07-23 00:56:23'),(79,'not_registered',NULL,'not_registered',2,'2018-07-23 00:59:56'),(80,'not_registered',NULL,'not_registered',2,'2018-07-23 01:01:39');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album_genres`
--

DROP TABLE IF EXISTS `album_genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album_genres` (
  `id_album` int(11) NOT NULL,
  `id_genres` int(11) NOT NULL,
  PRIMARY KEY (`id_album`,`id_genres`),
  KEY `id_genres_albums_fk_idx` (`id_genres`),
  CONSTRAINT `id_album_genres_fk` FOREIGN KEY (`id_album`) REFERENCES `albums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_genres_albums_fk` FOREIGN KEY (`id_genres`) REFERENCES `genres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album_genres`
--

LOCK TABLES `album_genres` WRITE;
/*!40000 ALTER TABLE `album_genres` DISABLE KEYS */;
INSERT INTO `album_genres` VALUES (85,3),(86,3),(88,3),(108,4),(85,5),(86,5),(88,5),(99,5),(92,6),(109,6),(84,7),(85,7),(96,7),(98,7),(93,8),(85,9),(86,9),(87,9),(88,9),(89,9),(90,9),(91,9),(94,9),(95,9),(97,9),(100,9),(101,9),(103,9),(104,9),(105,9),(106,9),(107,9),(108,9),(101,10),(102,10),(105,10),(107,10),(98,11),(99,11),(103,11),(107,11);
/*!40000 ALTER TABLE `album_genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` longtext,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `single` enum('yes','no') NOT NULL DEFAULT 'no',
  `id_images` int(11) NOT NULL,
  `date_released` date DEFAULT NULL,
  `price` decimal(5,2) NOT NULL,
  `type` enum('LP','EP','7','10','12','45RPM','78RPM') NOT NULL,
  `inventory_total` int(11) NOT NULL,
  `inventory_presented` int(11) NOT NULL,
  `on_sale` enum('yes','no') NOT NULL DEFAULT 'no',
  `items_sold` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`id_images`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `id_albums_images_fk_idx` (`id_images`),
  CONSTRAINT `id_albums_images_fk` FOREIGN KEY (`id_images`) REFERENCES `images` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` VALUES (84,'Kind of Blue','<p>Clita philosophia mei ea. An has tota fabulas propriae. Nibh oratio prompta ut sed, ius id quas aeque. In sed ubique virtute, per inani decore ea, pro dolor omnesque cu. Agam tempor honestatis ne eos. Nonumy praesent hendrerit no vix.</p>\r\n<p> </p>\r\n<p>Suas aliquip ad usu. Vidit equidem albucius id qui, tamquam comprehensam necessitatibus ius ad. Viderer reprimique eu mea, mea et dicit quaeque neglegentur. Vix lucilius accusata mediocritatem ex, has rebum prompta fastidii cu.</p>\r\n<p> </p>\r\n<p>Eam aeque maluisset in. Nibh oratio disputando sit eu, sed novum integre alienum id. Movet debitis cu sit, at etiam vitae discere eum. Doctus voluptaria an mel, vero meis moderatius mea cu. Alienum eloquentiam quo ut.</p>','2018-07-12 09:58:10','no',123,'1959-08-17',15.99,'LP',8,7,'no',0),(85,'Sketches of Spain','<p>Has alienum oporteat contentiones id. Atqui etiam sanctus mei ex. Ea eam ignota doming contentiones, et sit utinam pertinacia. Ut pri consul copiosae posidonium, dolore recusabo quaestio eum ne, mucius vocibus intellegat qui no. Elit scripserit cu vix, veri quando sea id.</p>\r\n<p> </p>\r\n<p>Minimum tractatos reformidans id pro, eu ius posidonium inciderint contentiones, ut duo dicit aliquip tibique. Quando probatus cu sed. Id quot mollis intellegat sit. His solum omnes eu, cum ut quando oratio instructior. Ius ne quot natum aliquip.</p>\r\n<p> </p>\r\n<p>Quo in errem legere honestatis. Aperiri lucilius hendrerit et est. Liber labores ex eos, cum periculis laboramus at. At viris veniam splendide ius. Usu quot noluisse prodesset at, mea id dicat ceteros apeirian.</p>','2018-07-12 10:01:21','no',124,'1960-07-18',16.29,'LP',6,5,'no',0),(86,'The Freewheelin','<p>Cu natum impetus cotidieque mel, ex nam veri augue ceteros. Qui id perfecto intellegat intellegebat. Erat corpora duo ad, per appetere recusabo ea. Has an aeque dicit quaerendum, no est homero oportere, est ad ferri sapientem persequeris. Per in vero falli ludus, in duo tation latine deleniti. Id nam nostrum verterem.</p>\r\n<p> </p>\r\n<p>Populo discere deseruisse ne nam, duo idque omnes scripserit cu. Ius inimicus definitiones at. Verterem consequat disputando nam an. Graece iuvaret sit eu. Ex sea urbanitas vituperata. Sumo accommodare vis ex, at his quidam apeirian expetenda.</p>\r\n<p> </p>\r\n<p>Eos quem mediocritatem at, an vivendo menandri eum, ea his tincidunt mnesarchum. Vis ex munere molestie, cum prima diceret lucilius ne, assum option mei ex. Sumo utinam forensibus ut qui, et vidisse abhorreant mei. Utinam tamquam sadipscing in pro, cu facer paulo pro. Id sale latine periculis mea, quo eu iudicabit deterruisset. Usu ex reque libris, in nisl nominavi percipit vel.</p>','2018-07-12 10:08:27','no',125,'1963-05-27',17.80,'LP',10,10,'yes',0),(87,'Satisfaction - Little By Little','<p>Tation dicunt intellegat mel ad, ubique omnium conclusionemque cu vix. Sententiae honestatis consequuntur mei et. At eos vide elitr, mea te omnes eirmod. Nec eu alia homero bonorum, vivendo appareat definiebas quo ea.</p>\r\n<p> </p>\r\n<p>Eu duo nibh audire, sed an maiorum voluptaria. Adhuc petentium pro ea, ex usu appareat expetenda, cum an modo causae. Ei diam utroque eam, cu nec stet modus. Vim eu quando aliquid periculis.</p>\r\n<p> </p>\r\n<p>Erat noster luptatum duo eu, sed ex solum melius, persius scaevola sit ei. Cu nec eros concludaturque, altera denique dolores usu at, lorem fugit dolorem et sea. Mei ipsum forensibus ad, fugit iracundia et ius. Offendit epicurei scripserit ut nam, in sapientem cotidieque nec, modo feugiat petentium ea vix.</p>','2018-07-12 10:19:22','yes',126,'1965-06-06',11.99,'7',13,13,'no',0),(88,'Harvest','<p>No eos saepe malorum, ut vis invenire abhorreant elaboraret. Doctus aliquip noluisse pri eu. Ex sea fugit tacimates referrentur, an dolore habemus volutpat sit. Qui esse tempor patrioque in, vis deterruisset mediocritatem eu.</p>\r\n<p> </p>\r\n<p>Ut ius prima etiam, mea et autem ludus, eam labitur consectetuer ei. Facete abhorreant persequeris ei sit, aliquip disputationi vel ut. Dico habeo putant nam an. An cum convenire vituperatoribus, qui aliquid labores pertinax ne. Eos ex clita veritus, noster offendit menandri eu vim, est vero aperiri tacimates ut.</p>\r\n<p> </p>\r\n<p>Idque reprehendunt qui ne, et vis tantas copiosae, eum duis fastidii eu. Oblique electram vel id. Gloriatur abhorreant rationibus eos id, erat ludus deterruisset ei vel, ad eam eius intellegat. Affert noster fabellas vel id. Eu omnis assum his, eos malis possim elaboraret et. Atqui intellegat sit cu, soluta dissentiet mea ad.</p>','2018-07-12 14:57:46','no',127,'1972-02-01',18.74,'LP',6,6,'no',0),(89,'In Rainbows','<p>Ei case dicant vel, pro at ipsum etiam, odio legimus contentiones id nam. In eos reprimique dissentiet. Cum omnesque consequuntur no. Paulo epicurei efficiantur id nec. Vim posse graecis ocurreret at, labores atomorum ne pri, id stet integre laboramus est. At vel stet fierent.</p>\r\n<p> </p>\r\n<p>Duo ea justo mucius instructior, ei vel etiam dissentias. Nec ne omnis movet. Te iisque offendit usu, inermis facilis iudicabit sed id. Facete phaedrum ei sed. Salutandi iudicabit disputando eos ne. At sensibus tractatos principes has, te impedit petentium adversarium has. Sit dico accusamus intellegebat te, porro detracto honestatis te vix, vivendum phaedrum argumentum ea per.</p>\r\n<p> </p>\r\n<p>Ius id natum solet intellegat, sit dolor eleifend euripidis ad. Ignota incorrupte ne mea, in veniam offendit instructior his, ea erant dolores mea. At ius lorem definiebas. Per ei delicata voluptatibus, solum interpretaris et cum, et aeque eleifend duo. Deserunt electram petentium ne his, est graece aeterno copiosae ne, denique omittam mea ex.</p>','2018-07-12 15:06:19','no',128,'2007-12-03',20.00,'LP',18,18,'no',0),(90,'The Dark Side of the Moon','<p>Nibh inimicus principes sea te, nec eripuit adolescens sadipscing ne. Delenit recusabo vim at. Eam in probatus hendrerit, virtute scribentur qui et. Fuisset propriae ponderum vim et. Probo minim possim at mel.</p>\r\n<p> </p>\r\n<p>Diam numquam consulatu nam in. Has ut lucilius aliquando, ut sea invidunt inimicus. Usu agam timeam ei. Hinc dicta vim cu, ea doctus accommodare nec, no per zril eruditi detracto. Eam at populo minimum inciderint, nec vidit modus elitr at, an postulant disputationi usu. An suscipit sapientem liberavisse has, eu pro eirmod placerat.</p>\r\n<p> </p>\r\n<p>Amet quodsi rationibus has ad, no per nihil euripidis. In mel quas appetere delicata, his voluptaria suscipiantur te. No sit iudico bonorum nominati. Natum solum his ea, adhuc adversarium nec ut. Laoreet delicata eum an, duo minim altera lucilius no, his nonumy mnesarchum delicatissimi ad.</p>','2018-07-12 15:10:05','no',129,'1973-03-01',16.66,'LP',9,9,'no',0),(91,'Born to Run','<p>Posse legimus persequeris sit ne, in quas probo illum usu, qui et nihil impetus appellantur. Denique vituperata qui no, sit cu congue repudiare vituperatoribus. Magna saepe eum at, soluta suscipit eleifend vim ea. Ad affert populo perpetua est. Dolore facilisi efficiantur has ei. Ad nam wisi quidam, mei ei imperdiet philosophia. Pro tempor feugiat in.</p>\r\n<p> </p>\r\n<p>Error iusto detraxit ex vim. Cu eos veniam alterum facilisis, id vis ubique verterem conceptam. Sumo primis conclusionemque sit te. Stet suscipit dissentias in has, id natum soleat perfecto ius, ignota delectus usu ei. Te est ridens fierent accumsan, sit eu consetetur percipitur.</p>\r\n<p> </p>\r\n<p>Ei nam iusto apeirian. Sit prima interpretaris ut. Ea falli accommodare sit. Has ne antiopam comprehensam, esse utamur vel et.</p>','2018-07-12 15:13:42','no',130,'1975-08-25',23.33,'LP',12,12,'no',0),(92,'Kill at Will','<p>Vix ut perfecto lobortis platonem, pro in legere euismod nostrum. His no illum fuisset delicatissimi, ne mel autem dicat nonumy, dolor tempor putant ad per. Te vis decore maluisset expetendis. Usu ei omnes ponderum voluptatibus, pri id facete nostrum, illud lucilius postulant ad nam. At wisi eirmod sed, vim at sensibus conclusionemque. In tamquam mandamus eos, sit omnium oportere gubergren an. Te albucius suavitate signiferumque has, his quaestio deseruisse an.</p>\r\n<p> </p>\r\n<p>Mei ut alii nemore legendos. Id mea epicuri mentitum, unum argumentum accommodare ius cu. Ullum vocibus civibus id mei, eu choro officiis est. Ut sea delicata persequeris, ei vix quodsi invenire.</p>\r\n<p> </p>\r\n<p>Quo cu putent apeirian, quidam everti mandamus te sed, mutat nostro aliquando his te. Ius ea recusabo democritum, eius sanctus facilisi cum cu. Utamur suscipit concludaturque an nam, ad qui quis putant, eam audire omittam consulatu eu. Eu illum debitis accusamus qui, eleifend persecuti incorrupte id quo. Mel erat invenire expetendis no. Oporteat periculis ea mea, cum ei modus conceptam. Ad quodsi oblique nominati vix, an primis graeci assueverit nec.</p>','2018-07-12 15:18:36','no',131,'1990-12-18',16.77,'EP',16,16,'no',1),(93,'Legend','<p>Vitae possim urbanitas nec te. Cum cu ubique gubergren. Laudem vivendum te his. Pri ei possim prompta, dicat quando conceptam has ad. Tale vituperata assueverit eu has, mollis definitionem id quo. Est ferri disputationi eu, te mazim diceret vituperata eos, in debet tempor nam.</p>\r\n<p> </p>\r\n<p>Nam ferri fugit percipit at, probo graeci deleniti in vis. Mei iuvaret expetenda maiestatis ad, id brute viris docendi cum. No eos quidam interesset, clita euismod tractatos pro cu. No odio nisl imperdiet ius, ne dicta oblique pertinacia vel, falli numquam cum id. Legimus vivendo consetetur vim ne, id ius quis oblique labores. Cu sonet persius suscipit per, eos laoreet conclusionemque et.</p>\r\n<p> </p>\r\n<p>Ne melius incorrupte vel, mei ad porro dicat. In omnis zril vis, hinc veri error mei ea. Et quodsi utroque partiendo quo, denique moderatius efficiendi ex nam. Aperiam accusamus necessitatibus ne pro, vel in commodo menandri.</p>','2018-07-12 15:26:46','no',132,'1984-05-01',25.08,'7',15,15,'no',0),(94,'Faces And Places Vol 12','<p>Ei percipit posidonium honestatis has, sea case homero iisque te. Mel ut vero mazim, prompta epicurei praesent mea te, ignota mollis consulatu ei est. Et modo definitionem ius. Eos eu summo consequat interesset, usu ex dico maiorum suscipit, nemore aperiam reprehendunt cum at.</p>\r\n<p> </p>\r\n<p>Ex nullam patrioque mea. Ex dico deseruisse referrentur sit, mei at docendi dissentias efficiantur. Vix probo deserunt comprehensam an. At nec integre lucilius, et eius quodsi quo. Cu has patrioque concludaturque, vis animal volutpat ne, ne has expetenda referrentur delicatissimi.</p>\r\n<p> </p>\r\n<p>Sea dico aperiri praesent ad, ea veritus menandri molestiae pri. Per oporteat signiferumque ea, tempor recusabo mei ei, et mei tractatos definitiones. Mutat vocent tractatos duo ad, detracto postulant et cum. Id vel magna molestiae disputationi, te cum aperiri tibique euripidis. Sea habemus copiosae efficiantur ut.</p>','2018-07-12 15:31:54','no',133,'1970-01-01',18.00,'12',4,4,'no',0),(95,'Rumours','<p>Id natum corrumpit ius, posse quaestio referrentur est ne. Vitae putent nostro mea no, mea aliquid aliquando ne. Usu offendit dissentias no, pri ei prodesset scripserit temporibus. Eum id tota mediocrem. Natum veritus convenire pro id.</p>\r\n<p> </p>\r\n<p>Ut illud alienum cum, te dicant oblique omnesque usu, purto eloquentiam delicatissimi mei in. Velit soluta denique vim cu. Saepe apeirian vix no. Fierent insolens vim ei. Eam at melius periculis. Esse invenire consectetuer no sea. Qui id malis mundi feugiat.</p>\r\n<p> </p>\r\n<p>In sed aliquid reprimique, qui numquam torquatos no. Elitr iriure singulis vix ne, vis iuvaret pericula intellegam ut. Nec ei torquatos reprehendunt, solum tollit efficiantur sed ut. Sea ornatus persecuti no, et cum eros voluptaria liberavisse. His tota habeo ut, qui aliquam accusam no.</p>','2018-07-13 20:50:48','no',134,'1977-02-04',18.99,'LP',14,14,'no',0),(96,'Blue Train','<p>Est ei mutat copiosae. Ne eum mollis noluisse, mea at meliore ancillae consulatu. Sit illud aeterno minimum ei, eam at oblique perpetua consequuntur. Id ponderum torquatos vix, eu has consul offendit scribentur, virtute posidonium no est. Et mea mollis corpora, enim aeque viderer ea usu. Clita populo nostro vis id, ne vel justo prodesset.</p>\r\n<p> </p>\r\n<p>No quis summo nam, his te neglegentur reprehendunt. Mel vero tacimates dissentiunt at, in amet utinam contentiones his. Ut per facete adipiscing philosophia. Cu mea simul semper, solet virtute graecis ut vel. Ad sit evertitur dissentiet.</p>\r\n<p> </p>\r\n<p>No quidam consectetuer sit, reque debitis splendide per ut, duis vivendum recteque an ius. Et vis hinc periculis definitiones. Ad adhuc iriure volutpat nec, ad ubique facilisis consequuntur ius, duis intellegebat id eum. Partem ornatus has an. Nec id facilis complectitur intellegebat, eam an etiam labore, sed te partiendo explicari consequat. Has te corrumpit assentior, cu ullum virtute similique vis.</p>','2018-07-13 20:54:18','no',135,'1957-09-15',21.44,'12',3,3,'no',1),(97,'Led Zeppelin','<p>Ei case graeco admodum sea, cu quo paulo percipit consectetuer. Maiestatis moderatius pri id, cetero audiam signiferumque per id. Pro vocent albucius sensibus an. Ad quo sale porro convenire. At malorum definitionem nec, ex eum mandamus explicari.</p>\r\n<p> </p>\r\n<p>Id cum aperiam lobortis definitiones, eum an sumo contentiones. Pro cu iudico expetenda, audiam philosophia cum no. Id duo indoctum sententiae, usu et ubique legere. Eu has lorem tollit ancillae.</p>\r\n<p> </p>\r\n<p>Paulo quodsi honestatis eum in. Cetero reformidans ut sit. Vim congue luptatum percipitur et, quaeque omnesque ei eum. Cum assum oporteat in. Te cum augue laoreet consetetur.</p>','2018-07-13 20:57:43','no',136,'1969-01-12',26.66,'EP',12,12,'no',6),(98,'Songs for Young Lovers','<p>Sit cu minim legere mediocritatem. Cum insolens argumentum no, nec in insolens nominati, an cum aliquid similique. Id mel ipsum minimum contentiones. Vitae mollis te ius, eu mei mandamus molestiae, eu graeci officiis nec. Ad soluta referrentur eos, per eu nullam cetero timeam. Imperdiet temporibus ad usu, per in harum dolores erroribus.</p>\r\n<p> </p>\r\n<p>Vis etiam meliore legendos cu, vim in illud nihil legimus, usu in movet adolescens. Pro id quem magna. Option tacimates pri te, ea pro doctus sanctus. Legimus antiopam deseruisse mea ei, vel cu dico exerci. At vel dicta ullamcorper, ex augue virtute fierent eos. Ea est augue virtute.</p>\r\n<p> </p>\r\n<p>Vel ut vocibus habemus, ei est possim oportere honestatis. Solum error vix ea. Bonorum dolorum adversarium ei vix, te volutpat periculis usu. Vix no diceret delicata, movet omnesque quaestio vel ea, ex antiopam petentium ius. Eum vidit qualisque no.</p>','2018-07-13 21:01:49','no',137,'1954-11-07',23.33,'10',3,3,'no',0),(99,'Belafonte at Carnegie Hall','<p>Usu cu salutandi constituto persequeris, an pri alia causae. Sea dignissim euripidis adversarium ex, et his autem mucius. Eum no alii alia omnes. Ad cum veri latine ancillae, ex nam summo tollit, mei prompta constituto an. His vero nostrum interesset id. Te facer graecis sea, quo no errem aperiri.</p>\r\n<p> </p>\r\n<p>Ius no persius pertinax, in illud illum labore vix. Sea at deserunt forensibus, no tale mandamus sed, fugit mundi ei his. Cu cum omnes veniam dissentiet, ne pro quidam dolorem. Soleat tibique oporteat in vim, nibh omnes per in. Te vidit summo nostro usu.</p>\r\n<p> </p>\r\n<p>Vis ne putent option intellegebat, mel at eius salutandi. Ex has eros possit, nam facete omittam id. Duo autem lorem et, per te partem reprimique. Pro at simul iuvaret, mei idque gubergren id. Quot novum soluta mel ut. Ne facilis indoctum conclusionemque mel.</p>','2018-07-13 21:08:52','no',138,'1959-10-01',13.33,'45RPM',2,2,'no',0),(100,'Tommy','<p>Sit purto tota officiis ne, no luptatum assentior pri, cum agam omnes alienum no. Nulla viderer lucilius an vix. Vix eu odio prodesset maiestatis, per et paulo scriptorem. Eam at cetero molestie ullamcorper. Id duo summo scaevola deseruisse, eius nihil volutpat id pri.</p>\r\n<p> </p>\r\n<p>Dolore efficiantur consequuntur ex est, qui sumo veri essent at, mei eu oblique tractatos. Ad porro tation recteque eam. Mel eu rebum regione reformidans, ut veritus disputando his. Ne mel tale nullam impedit. Simul oportere mediocritatem te mei. Te pro prompta tibique honestatis. Homero officiis sit ex, tantas fastidii cu mel.</p>\r\n<p> </p>\r\n<p>Tation nonumes est no, ne pri diceret periculis. Debet singulis recusabo ex nec, ei lucilius definitionem mel. Labore intellegebat vix ei, ei has odio inermis deserunt, id duo habeo lorem populo. Sea ea sale postea, ad nec audire moderatius definiebas. Eum at eros vide fugit.</p>','2018-07-13 21:37:42','no',139,'1969-05-23',31.99,'LP',14,13,'no',4),(101,'Abraxas','<p>Ex qui justo periculis dissentiunt, cu ignota omittantur concludaturque pro. Sanctus torquatos usu ex, maiorum feugait ne his, sea ea aeque delenit. Eu facilisi quaerendum eum, eam ea quot dicunt vocibus. Eum ne timeam audire. Te per consulatu inciderint, ea dicam vidisse concludaturque quo, est in possim aperiri tamquam.</p>\r\n<p> </p>\r\n<p>Ei melius neglegentur quo, vel vidit admodum at, cu primis labitur vis. Ut causae phaedrum sed. Denique nominavi lobortis at vim, has ea vocent atomorum, cum tritani luptatum periculis an. Ut mei reque tantas possit, et eos debet vocent.</p>\r\n<p> </p>\r\n<p>Primis temporibus ad per, has ad quod quas petentium, ea mea erant munere sententiae. Congue lucilius sensibus sit et. Et soleat aliquam constituam has, aeque zril reprimique in usu. Duo in repudiandae necessitatibus. Nulla dolorum suscipit at has, etiam homero quo et.</p>','2018-07-13 23:24:46','no',140,'1970-09-23',15.99,'12',3,3,'no',0),(102,'Whats Going On','<p>Ut aeque sonet singulis duo, ut verear imperdiet vel. Vel posse vocent deserunt at, ei interesset instructior nec. Virtute antiopam in vim, vocibus praesent interpretaris in eam. Eos verterem dissentias no. Veri omnis errem ea sit, an mea nonumy legere reprehendunt.</p>\r\n<p> </p>\r\n<p>Error tempor pri id. Dicam electram mea ne, qui novum partiendo te, te viris legere volumus pri. His ea etiam sonet, ex his dolorum deleniti. Et pro habeo illud contentiones, no vix animal aeterno officiis, id gloriatur tincidunt his. No usu volutpat hendrerit. Ne debitis recusabo concludaturque ius. Ad causae principes vel, sapientem democritum mea ut.</p>\r\n<p> </p>\r\n<p>An quot regione sadipscing mea, vide etiam corrumpit in vel, vim eu solum lorem audiam. Vix mucius quaeque liberavisse ne. Clita dicam vim ei, delectus posidonium est ei. Vis probo mucius ut.</p>','2018-07-13 23:34:54','no',141,'1971-05-21',23.00,'78RPM',13,13,'yes',1),(103,'Goodbye Yellow Brick Road','<p>Cum vidit quodsi no, modus perpetua sapientem ut his, an discere dolorem instructior eos. Dicunt concludaturque est ex. Vel amet dico voluptua an, brute omnes eos ad. Consul graeco malorum vix te.</p>\r\n<p> </p>\r\n<p>Senserit signiferumque ut nec, vel an argumentum constituam. Id mei soluta praesent, nec ne sale liberavisse deterruisset. Ne tempor verterem eos, ea nam altera nominati. Cu mea tota dolore.</p>\r\n<p> </p>\r\n<p>Nam id vide euismod, ea vim falli causae integre, sed ei dolorem vivendum ocurreret. Ius no volumus delicata gubergren. Eirmod volutpat postulant has ei, oblique facilisis constituto ne pro, vix aeque noster tamquam in. An vim mnesarchum eloquentiam. Pri case postulant voluptatibus ne. Est ei posse cetero tractatos, quo lorem error percipit at.</p>','2018-07-13 23:41:28','no',142,'1973-10-05',22.49,'LP',4,4,'yes',0),(104,'Highway to Hell','<p>Ad eam feugiat comprehensam, aliquid accusam imperdiet et sea. Ea mea congue convenire temporibus, ea movet mundi ius. Has doctus nominati moderatius at. At eum errem noster lobortis, at duo saepe graece. Ut vide decore pertinacia has, vide consul aeterno usu ne.</p>\r\n<p> </p>\r\n<p>Sea at ocurreret adolescens philosophia. Nec ut feugiat voluptatibus, cum ad omittam copiosae molestiae. Aperiam honestatis sea te, atomorum inimicus pri an. Incorrupte temporibus cum cu, ea qui admodum nominavi imperdiet, pro an illud vitae. Prima ceteros mentitum id duo, an mei quot accusata. No eros novum movet nam, ut cum mutat animal. Pri ei duis everti, id aeterno invidunt pertinax usu.</p>\r\n<p> </p>\r\n<p>At qui incorrupte reprimique, ignota inciderint mediocritatem ius ad. Postea urbanitas vel ne, te est verear saperet imperdiet. Ea ignota indoctum cotidieque eum. Has idque mentitum vituperata ut, eligendi euripidis philosophia usu te.</p>','2018-07-23 01:30:05','no',146,'1979-07-27',18.22,'78RPM',16,15,'no',0),(105,'Bohemian Rhapsody','<p>Ius at sale justo petentium, quando inermis mel no, sed cu novum adipisci perpetua. Altera eruditi et mea. Vix ad habeo nonumes intellegat, in omnes omnesque posidonium cum. Vim oportere recteque ei, mea eruditi voluptatibus ne. Eu sint scripserit mel, an malis paulo ceteros has, sea ad alii sadipscing. Ceteros sensibus mea ea.</p>\r\n<p> </p>\r\n<p>Deleniti verterem laboramus eum cu. Sed prima tacimates et. Id laudem diceret partiendo qui, at usu percipit sensibus, soleat legimus in his. Quo aperiam tritani in, ea vel feugiat veritus disputando, duo at hinc inani. Ex homero facete apeirian sea. Ad vis exerci deleniti disputando, nam atqui minimum eu.</p>\r\n<p> </p>\r\n<p>Eum natum facilis consequat te. Odio modus tantas vis no, his utinam intellegam consectetuer in, at equidem dissentiet his. Et vis errem moderatius, vim legimus euripidis et. Mea unum concludaturque no, mea dicunt prodesset ei. Vidit probo corrumpit cu sed.</p>','2018-07-23 01:35:28','yes',147,'1975-10-31',15.66,'7',21,21,'no',0),(106,'Synchronicity','<p>Choro suscipit qualisque te pro, mel an maiestatis omittantur, duo id esse facete ocurreret. Ridens oblique in vim, no eos ignota scripta, brute repudiare ei eos. Cu aeterno aliquando conceptam his, eam modus tractatos ex. Te commune quaestio vulputate pro, pro an amet porro salutandi. Dicit pertinax cu vix.</p>\r\n<p> </p>\r\n<p>Ea vim illud scriptorem, usu id nobis atomorum. Vis id exerci albucius. Ut eos posse atqui minimum, aliquip concludaturque eam ad. Erat denique nec te. Pri ad prima illum. Eius mnesarchum dissentias ad vis, his ne facer fuisset.</p>\r\n<p> </p>\r\n<p>Pri at petentium constituto honestatis. Ex dictas deserunt quo. Usu ad primis eirmod timeam, ne quodsi aliquip ius. Sit nobis menandri eu. Ei delectus invenire vim. Sint nobis democritum eam ea, assum euismod voluptatibus ex mei.</p>','2018-07-23 02:16:36','no',148,'1983-06-17',19.99,'EP',7,7,'no',0),(107,'Thriller','<p>Ne nam persius reprimique. Ne alia aperiri propriae mel, sea augue error consulatu an. Ea per nemore essent dolorum. Ut est illud dictas numquam, nam eu diam reque malorum, fugit clita deterruisset usu in. Sit lorem eirmod ex, unum vivendo ocurreret per ei.</p>\r\n<p> </p>\r\n<p>Eum noluisse platonem posidonium ea, qui no dicunt percipit. Eam prima lucilius ullamcorper ut. Option alienum his ne, vix elitr constituto no. Quo verear iracundia in. Eu duo nibh vulputate, eum id sanctus commune, aeterno denique te qui. Nam unum dicta salutandi cu. Et mundi equidem his, populo integre atomorum ei quo.</p>\r\n<p> </p>\r\n<p>Cu inani ullamcorper ius, in vis periculis abhorreant appellantur. Cum ut magna tation moderatius, reque veniam per ad. Aliquam ullamcorper id eam. Sed cu platonem constituam.</p>','2018-07-23 02:20:40','no',149,'1982-11-30',20.11,'EP',19,18,'no',0),(108,'Violator','<p>Eam id legere saperet, ne usu malorum mediocrem. Eum ea copiosae sadipscing, ius liber omittantur deterruisset eu. Per in mundi prompta perfecto, eum te admodum albucius. Vim affert oporteat ex, an tation rationibus qui. Odio omnium ceteros eum at, sed ad idque soluta invenire.</p>\r\n<p> </p>\r\n<p>Pri ea nemore delectus, nostrud scriptorem has in. Eu menandri democritum mel, augue appetere dignissim ne mel. Nec facer constituto ut, et quaeque saperet atomorum est. Nulla detraxit no pri, et vix labore lucilius. Wisi saperet usu ex, vix ne harum iusto. Pri no duis adolescens liberavisse.</p>\r\n<p> </p>\r\n<p>Ea cum vocent feugiat liberavisse, quo facilisis dissentias et. Eu inani probatus pro, duo labore deserunt pertinax at, stet utinam te mea. Ut justo laoreet quo. Aliquid constituam ne vel. Has no autem singulis deseruisse, est praesent hendrerit tincidunt cu, oporteat similique eu vim.</p>','2018-07-23 02:26:29','no',150,'1990-03-19',17.77,'10',8,7,'no',0),(109,'Straight Outta Compton','<p>Omnium fuisset necessitatibus mei cu. Petentium appellantur eu mei, vim dicat deseruisse ex. Erat omnes mei ea. Eos alii placerat eleifend ei, purto mentitum pri in, postea fastidii volutpat sed ex.</p>\r\n<p> </p>\r\n<p>Et novum verterem vulputate qui, in dolorem delicatissimi eum. Nonumes sapientem est ut, eos wisi dicunt epicuri id. Pro atqui soleat in. Ei duo dicta mandamus. His perfecto concludaturque ne. Primis quidam eu qui. Cu vix legimus petentium euripidis, justo corrumpit ne pro.</p>\r\n<p> </p>\r\n<p>Quo et meis semper. Vidisse euripidis eu est, brute torquatos ex sed. Eam ex saperet ponderum deserunt. Iuvaret qualisque conclusionemque qui ei, vis id novum laoreet. Sed dicit postea copiosae ut, has ei omnium signiferumque, justo invidunt an sit. Ut ius ferri aliquid molestiae, putent audire mnesarchum cu eam.</p>','2018-07-23 02:33:32','no',151,'1988-08-08',14.44,'10',3,3,'no',1);
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albums_songs`
--

DROP TABLE IF EXISTS `albums_songs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albums_songs` (
  `id_albums` int(11) NOT NULL,
  `id_songs` int(11) NOT NULL,
  PRIMARY KEY (`id_albums`,`id_songs`),
  KEY `id_songs_albums_fk_idx` (`id_songs`),
  CONSTRAINT `id_albums_songs_fk` FOREIGN KEY (`id_albums`) REFERENCES `albums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_songs_albums_fk` FOREIGN KEY (`id_songs`) REFERENCES `songs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums_songs`
--

LOCK TABLES `albums_songs` WRITE;
/*!40000 ALTER TABLE `albums_songs` DISABLE KEYS */;
INSERT INTO `albums_songs` VALUES (84,241),(84,242),(84,243),(84,244),(84,245),(85,246),(85,247),(85,248),(85,249),(85,250),(85,251),(85,252),(85,253),(85,254),(85,255),(85,256),(85,257),(85,258),(85,259),(85,260),(85,261),(85,262),(85,263),(86,264),(86,265),(86,266),(86,267),(86,268),(86,269),(86,270),(86,271),(86,272),(86,273),(86,274),(86,275),(86,276),(86,277),(86,278),(87,279),(87,280),(88,281),(88,282),(88,283),(88,284),(88,285),(88,286),(88,287),(88,288),(88,289),(88,290),(89,291),(89,292),(89,293),(89,294),(89,295),(89,296),(89,297),(89,298),(89,299),(89,300),(90,301),(90,302),(90,303),(90,304),(90,305),(90,306),(90,307),(90,308),(90,309),(90,310),(91,311),(91,312),(91,313),(92,313),(91,314),(92,314),(91,315),(92,315),(91,316),(92,316),(91,317),(92,317),(91,318),(92,318),(93,319),(93,320),(93,321),(93,322),(93,323),(93,324),(93,325),(93,326),(93,327),(93,328),(93,329),(93,330),(93,331),(94,332),(94,333),(94,334),(94,335),(94,336),(94,337),(95,338),(95,339),(95,340),(95,341),(95,342),(95,343),(95,344),(95,345),(95,346),(95,347),(95,348),(96,349),(96,350),(96,351),(96,352),(96,353),(97,354),(97,355),(97,356),(97,357),(97,358),(97,359),(97,360),(97,361),(97,362),(98,363),(98,364),(98,365),(98,366),(98,367),(98,368),(98,369),(98,370),(99,371),(99,372),(99,373),(99,374),(99,375),(99,376),(99,377),(99,378),(99,379),(99,380),(99,381),(99,382),(99,383),(99,384),(99,385),(99,386),(99,387),(99,388),(99,389),(100,390),(100,391),(100,392),(100,393),(100,394),(100,395),(100,396),(100,397),(100,398),(100,399),(100,400),(100,401),(100,402),(100,403),(100,404),(100,405),(100,406),(100,407),(100,408),(100,409),(100,410),(100,411),(100,412),(100,413),(101,414),(101,415),(101,416),(101,417),(101,418),(101,419),(101,420),(101,421),(101,422),(101,423),(103,423),(101,424),(103,424),(101,425),(103,425),(101,426),(103,426),(101,427),(103,427),(101,428),(103,428),(101,429),(103,429),(101,430),(103,430),(101,431),(103,431),(102,432),(103,432),(102,433),(103,433),(102,434),(103,434),(102,435),(103,435),(102,436),(103,436),(102,437),(103,437),(102,438),(103,438),(102,439),(103,439),(102,440),(103,440),(104,441),(104,442),(104,443),(104,444),(104,445),(104,446),(104,447),(104,448),(104,449),(104,450),(105,451),(105,452),(105,453),(105,454),(105,455),(105,456),(105,457),(105,458),(105,459),(105,460),(105,461),(105,462),(105,463),(105,464),(105,465),(105,466),(105,467),(105,468),(105,469),(105,470),(105,471),(105,472),(105,473),(106,474),(106,475),(106,476),(106,477),(106,478),(106,479),(106,480),(106,481),(106,482),(106,483),(107,484),(107,485),(107,486),(107,487),(107,488),(107,489),(107,490),(107,491),(107,492),(108,493),(108,494),(108,495),(108,496),(108,497),(108,498),(108,499),(108,500),(108,501),(109,502),(109,503),(109,504),(109,505),(109,506),(109,507),(109,508),(109,509),(109,510),(109,511),(109,512),(109,513),(109,514);
/*!40000 ALTER TABLE `albums_songs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT 'none',
  `description` text,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_images` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_images`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `id_artists_images_fk_idx` (`id_images`),
  CONSTRAINT `id_artists_images_fk` FOREIGN KEY (`id_images`) REFERENCES `images` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (26,'The Beatles',NULL,'2018-07-11 23:37:28',76),(27,'Miles Davis',NULL,'2018-07-11 23:41:38',76),(29,'Bob Dylan',NULL,'2018-07-12 10:08:27',76),(31,'The Rolling Stones',NULL,'2018-07-12 10:19:22',76),(32,'Neil Young',NULL,'2018-07-12 14:57:46',76),(33,'Radiohead',NULL,'2018-07-12 15:06:19',76),(34,'Pink Floyd',NULL,'2018-07-12 15:10:05',76),(35,'Bruce Springsteen',NULL,'2018-07-12 15:13:42',76),(36,'Ice Cube',NULL,'2018-07-12 15:18:36',76),(37,'Bob Marley and the Wailers',NULL,'2018-07-12 15:26:46',76),(38,'Jimi Hendrix',NULL,'2018-07-12 15:31:54',76),(39,'Fleetwood Mac',NULL,'2018-07-13 20:50:48',76),(40,'John Coltrane',NULL,'2018-07-13 20:54:18',76),(41,'Led Zeppelin',NULL,'2018-07-13 20:57:43',76),(42,'Frank Sinatra',NULL,'2018-07-13 21:01:49',76),(43,'Harry Belafonte',NULL,'2018-07-13 21:08:52',76),(44,'The Who',NULL,'2018-07-13 21:37:42',76),(45,'Santana',NULL,'2018-07-13 23:24:46',76),(47,'Marvin Gaye',NULL,'2018-07-13 23:34:54',76),(48,'Elton John',NULL,'2018-07-13 23:41:28',76),(49,'AC DC',NULL,'2018-07-23 01:30:05',76),(50,'Queen',NULL,'2018-07-23 01:35:28',76),(51,'Barry White',NULL,'2018-07-23 02:10:40',76),(52,'The Police',NULL,'2018-07-23 02:16:36',76),(53,'Michael Jackson',NULL,'2018-07-23 02:20:40',76),(54,'Depeche Mode',NULL,'2018-07-23 02:26:29',76),(55,'NWA',NULL,'2018-07-23 02:33:32',76);
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artists_albums`
--

DROP TABLE IF EXISTS `artists_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artists_albums` (
  `id_artists` int(11) NOT NULL,
  `id_albums` int(11) NOT NULL,
  PRIMARY KEY (`id_artists`,`id_albums`),
  KEY `id_albums_artists_fk_idx` (`id_albums`),
  CONSTRAINT `id_albums_artists_fk` FOREIGN KEY (`id_albums`) REFERENCES `albums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_artists_albums_fk` FOREIGN KEY (`id_artists`) REFERENCES `artists` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists_albums`
--

LOCK TABLES `artists_albums` WRITE;
/*!40000 ALTER TABLE `artists_albums` DISABLE KEYS */;
INSERT INTO `artists_albums` VALUES (27,84),(27,85),(29,86),(31,87),(32,88),(33,89),(34,90),(35,91),(36,92),(37,93),(38,94),(39,95),(40,96),(41,97),(42,98),(43,99),(44,100),(45,101),(47,102),(48,103),(49,104),(50,105),(51,105),(52,106),(53,107),(54,108),(55,109);
/*!40000 ALTER TABLE `artists_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(45) NOT NULL,
  `id_country` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`id_country`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `id_country_city_fk_idx` (`id_country`),
  CONSTRAINT `id_country_city_fk` FOREIGN KEY (`id_country`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,'Belgrade',1,'2018-06-14 13:40:06'),(2,'not_registered',2,'2018-06-21 11:43:16'),(13,'Beograd',1,'2018-07-24 13:38:04');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `message` longtext NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `viewed` enum('0','1') NOT NULL DEFAULT '0',
  `source` enum('inbox','outbox') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_us`
--

LOCK TABLES `contact_us` WRITE;
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
INSERT INTO `contact_us` VALUES (21,'Luka','luka@mail.com','Pitanje u vezi saradnje','Hteo bih da saradjujem sa vama na razvoju vaseg web shopa. Razmotrite opciju razvoja vaseg sajta u Yii framework okruzenju...\r\n\r\nPozdrav,\r\n\r\nLuka','2018-07-24 13:42:57','1','inbox'),(22,'vinyl.com','luka@mail.com','Odgovor na vase pitanje','<p>Postovani,</p>\r\n<p>Vise smo nego zainteresovani za saradnju sa Vama, trebalo bi da zakazemo sastanak kako bi razmotrili sve ideje i videli da li ima prostora za saradnju.</p>\r\n<p> </p>\r\n<p>Pozdrav,</p>\r\n<p>Amir Hadzija</p>\r\n<p>vinyl.com</p>','2018-07-24 13:45:34','0','outbox');
/*!40000 ALTER TABLE `contact_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(45) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` VALUES (1,'Serbia','2018-06-14 13:39:50'),(2,'not_registered','2018-06-21 11:42:53');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `errors`
--

DROP TABLE IF EXISTS `errors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `errors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `error_log` text NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `errors`
--

LOCK TABLES `errors` WRITE;
/*!40000 ALTER TABLE `errors` DISABLE KEYS */;
INSERT INTO `errors` VALUES (4,'Error : There was a problem with image uploading on 02.07.2018  15:32:48','2018-07-02 15:32:48'),(5,'error','2018-07-02 18:28:22'),(6,'There was a problem with inserting a new product on 02.07.2018  19:14:13','2018-07-02 19:14:13'),(7,'There was a problem with inserting a new product on 02.07.2018  19:21:13','2018-07-02 19:21:13'),(8,'There was a problem with inserting a new product on 02.07.2018  19:29:42','2018-07-02 19:29:42'),(9,'Error : There was a problem with image uploading on 03.07.2018  11:51:54','2018-07-03 11:51:54'),(10,'Error : There was a problem with image uploading on 03.07.2018  11:53:34','2018-07-03 11:53:34'),(11,'Error : There was a problem with image uploading on 03.07.2018  11:54:08','2018-07-03 11:54:08'),(12,'Error : There was a problem with image uploading on 03.07.2018  11:55:53','2018-07-03 11:55:53'),(13,'Error : There was a problem with image uploading on 03.07.2018  12:00:28','2018-07-03 12:00:28'),(14,'Error : There was a problem with image uploading on 03.07.2018  12:01:29','2018-07-03 12:01:29'),(15,'Error : There was a problem with image uploading on 03.07.2018  12:02:00','2018-07-03 12:02:00'),(16,'Error : There was a problem with image uploading on 03.07.2018  12:02:38','2018-07-03 12:02:38'),(17,'Error : There was a problem with image uploading on 03.07.2018  12:04:18','2018-07-03 12:04:18'),(18,'Error : There was a problem with image uploading on 03.07.2018  12:05:30','2018-07-03 12:05:30'),(19,'Error : There was a problem with image uploading on 03.07.2018  12:07:12','2018-07-03 12:07:12'),(20,'Error : There was a problem with image uploading on 03.07.2018  12:08:51','2018-07-03 12:08:51'),(21,'Error : There was a problem with image uploading on 03.07.2018  12:10:17','2018-07-03 12:10:17'),(22,'Error : There was a problem with image uploading on 03.07.2018  12:12:19','2018-07-03 12:12:19'),(23,'Error : There was a problem with image uploading on 03.07.2018  12:13:59','2018-07-03 12:13:59'),(24,'Error : There was a problem with image uploading on 03.07.2018  12:14:37','2018-07-03 12:14:37'),(25,'Error : There was a problem with image uploading on 03.07.2018  12:16:00','2018-07-03 12:16:00'),(26,'Error : There was a problem with image uploading on 03.07.2018  12:16:45','2018-07-03 12:16:45'),(27,'Error : There was a problem with image uploading on 03.07.2018  12:18:26','2018-07-03 12:18:26'),(28,'Error : There was a problem with image uploading on 03.07.2018  12:19:29','2018-07-03 12:19:29'),(29,'Error : There was a problem with image uploading on 03.07.2018  12:19:32','2018-07-03 12:19:32'),(30,'Error : There was a problem with image uploading on 03.07.2018  12:19:40','2018-07-03 12:19:40'),(31,'There was a problem with deleting a product on 11.07.2018  23:14:29','2018-07-11 23:14:29'),(32,'There was a problem with inserting a new product on 12.07.2018  10:06:54','2018-07-12 10:06:54'),(33,'There was a problem with inserting a new product on 12.07.2018  10:13:10','2018-07-12 10:13:10'),(34,'There was a problem with inserting a new product on 12.07.2018  15:18:36','2018-07-12 15:18:36'),(35,'There was a problem with inserting a new product on 13.07.2018  23:28:13','2018-07-13 23:28:13'),(36,'There was a problem with inserting a new product on 13.07.2018  23:41:28','2018-07-13 23:41:29'),(37,'Error : There was a problem with updating user permission on 20.07.2018  00:34:14','2018-07-20 00:34:14'),(38,'Error : There was a problem with updating user permission on 20.07.2018  00:37:21','2018-07-20 00:37:21'),(39,'Error : There was a problem with updating user permission on 20.07.2018  00:38:41','2018-07-20 00:38:41'),(40,'Error : There was a problem with updating user permission on 20.07.2018  00:39:12','2018-07-20 00:39:12'),(41,'Error : There was a problem with updating user permission on 20.07.2018  00:44:01','2018-07-20 00:44:01'),(42,'Error : There was a problem with updating user permission on 20.07.2018  00:44:45','2018-07-20 00:44:45'),(43,'Error : There was a problem with inserting contact form data on 20.07.2018  16:56:28','2018-07-20 16:56:28'),(44,'Error : There was a problem with inserting contact form data on 20.07.2018  16:57:36','2018-07-20 16:57:36'),(45,'Error : There was a problem with inserting contact form data on 20.07.2018  16:58:41','2018-07-20 16:58:41'),(46,'Error : There was a problem with inserting contact form data on 20.07.2018  16:59:14','2018-07-20 16:59:14'),(47,'There was a problem with inserting a new product on 23.07.2018  02:10:40','2018-07-23 02:10:40'),(48,'There was a problem with inserting a new product on 23.07.2018  02:10:51','2018-07-23 02:10:51'),(49,'There was a problem with inserting a new product on 23.07.2018  02:11:21','2018-07-23 02:11:21');
/*!40000 ALTER TABLE `errors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genres`
--

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` VALUES (1,'Blues'),(2,'Classical'),(3,'Country'),(4,'Electronic'),(5,'Folk'),(6,'Hip-hop'),(7,'Jazz'),(8,'Reggae'),(9,'Rock'),(10,'Funk / Soul'),(11,'Pop');
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(255) NOT NULL DEFAULT 'none',
  `img_root` varchar(255) NOT NULL DEFAULT 'none',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (76,'http://localhost/vinyl/images/albums/default_images/artist_default.jpg','none','2018-07-02 20:44:41'),(123,'http://localhost/vinyl/images/albums/miles_davis/kind_of_blue_1531382290.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\miles_davis\\kind_of_blue_1531382290.jpeg','2018-07-12 09:58:10'),(124,'http://localhost/vinyl/images/albums/miles_davis/sketches_of_spain_1531382481.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\miles_davis\\sketches_of_spain_1531382481.jpeg','2018-07-12 10:01:21'),(125,'http://localhost/vinyl/images/albums/bob_dylan/the_freewheelin_1531382907.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\bob_dylan\\the_freewheelin_1531382907.jpeg','2018-07-12 10:08:27'),(126,'http://localhost/vinyl/images/albums/the_rolling_stones/satisfaction_-_little_by_little_1531383562.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\the_rolling_stones\\satisfaction_-_little_by_little_1531383562.jpeg','2018-07-12 10:19:22'),(127,'http://localhost/vinyl/images/albums/neil_young/harvest_1531400266.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\neil_young\\harvest_1531400266.jpeg','2018-07-12 14:57:46'),(128,'http://localhost/vinyl/images/albums/radiohead/in_rainbows_1531400779.png','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\radiohead\\in_rainbows_1531400779.png','2018-07-12 15:06:19'),(129,'http://localhost/vinyl/images/albums/pink_floyd/the_dark_side_of_the_moon_1531401005.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\pink_floyd\\the_dark_side_of_the_moon_1531401005.jpeg','2018-07-12 15:10:05'),(130,'http://localhost/vinyl/images/albums/bruce_springsteen/born_to_run_1531401222.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\bruce_springsteen\\born_to_run_1531401222.jpeg','2018-07-12 15:13:42'),(131,'http://localhost/vinyl/images/albums/ice_cube/kill_at_will_1531401516.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\ice_cube\\kill_at_will_1531401516.jpeg','2018-07-12 15:18:36'),(132,'http://localhost/vinyl/images/albums/bob_marley_and_the_wailers/legend_1531402006.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\bob_marley_and_the_wailers\\legend_1531402006.jpeg','2018-07-12 15:26:46'),(133,'http://localhost/vinyl/images/albums/jimi_hendrix/faces_and_places_vol_12_1531402314.jpg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\jimi_hendrix\\faces_and_places_vol_12_1531402314.jpg','2018-07-12 15:31:54'),(134,'http://localhost/vinyl/images/albums/fleetwood_mac/rumours_1531507848.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\fleetwood_mac\\rumours_1531507848.jpeg','2018-07-13 20:50:48'),(135,'http://localhost/vinyl/images/albums/john_coltrane/blue_train_1531508058.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\john_coltrane\\blue_train_1531508058.jpeg','2018-07-13 20:54:18'),(136,'http://localhost/vinyl/images/albums/led_zeppelin/led_zeppelin_1531508263.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\led_zeppelin\\led_zeppelin_1531508263.jpeg','2018-07-13 20:57:43'),(137,'http://localhost/vinyl/images/albums/frank_sinatra/songs_for_young_lovers_1531508509.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\frank_sinatra\\songs_for_young_lovers_1531508509.jpeg','2018-07-13 21:01:49'),(138,'http://localhost/vinyl/images/albums/harry_belafonte/belafonte_at_carnegie_hall_1531508932.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\harry_belafonte\\belafonte_at_carnegie_hall_1531508932.jpeg','2018-07-13 21:08:52'),(139,'http://localhost/vinyl/images/albums/the_who/tommy_1531510662.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\the_who\\tommy_1531510662.jpeg','2018-07-13 21:37:42'),(140,'http://localhost/vinyl/images/albums/santana/abraxas_1531517086.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\santana\\abraxas_1531517086.jpeg','2018-07-13 23:24:46'),(141,'http://localhost/vinyl/images/albums/marvin_gaye/whats_going_on_1531517694.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\marvin_gaye\\whats_going_on_1531517694.jpeg','2018-07-13 23:34:54'),(142,'http://localhost/vinyl/images/albums/elton_john/goodbye_yellow_brick_road_1531518088.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\elton_john\\goodbye_yellow_brick_road_1531518088.jpeg','2018-07-13 23:41:28'),(143,'http://localhost/vinyl/images/users/default-user.png','C:\\wamp64\\www\\vinyl\\public\\images\\users\\default-user.png','2018-07-18 18:50:20'),(144,'http://localhost/vinyl/images/users/_userdir_BGamir1989/1532301600_user_BGamir1989.jpeg','C:wamp64wwwvinylpublicimagesusers\\_userdir_bgamir19891532301600_user_BGamir1989.jpeg','2018-07-22 00:17:30'),(145,'http://localhost/vinyl/images/users/_userdir_Anchi93/1532215562_user_Anchi93.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\users\\_userdir_anchi93\\1532215562_user_Anchi93.jpeg','2018-07-22 01:26:02'),(146,'http://localhost/vinyl/images/albums/ac_dc/highway_to_hell_1532302205.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\ac_dc\\highway_to_hell_1532302205.jpeg','2018-07-23 01:30:05'),(147,'http://localhost/vinyl/images/albums/queen/bohemian_rhapsody_1532302528.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\queen\\bohemian_rhapsody_1532302528.jpeg','2018-07-23 01:35:28'),(148,'http://localhost/vinyl/images/albums/the_police/synchronicity_1532304996.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\the_police\\synchronicity_1532304996.jpeg','2018-07-23 02:16:36'),(149,'http://localhost/vinyl/images/albums/michael_jackson/thriller_1532305240.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\michael_jackson\\thriller_1532305240.jpeg','2018-07-23 02:20:40'),(150,'http://localhost/vinyl/images/albums/depeche_mode/violator_1532305589.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\depeche_mode\\violator_1532305589.jpeg','2018-07-23 02:26:29'),(151,'http://localhost/vinyl/images/albums/nwa/straight_outta_compton_1532306012.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\albums\\nwa\\straight_outta_compton_1532306012.jpeg','2018-07-23 02:33:32'),(152,'http://localhost/vinyl/images/users/_userdir_Anchi93/1532362332_user_Anchi93.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\users\\_userdir_anchi93\\1532362332_user_Anchi93.jpeg','2018-07-23 18:12:12'),(153,'http://localhost/vinyl/images/users/_userdir_Luka2018/1532432467_user_Luka2018.jpeg','C:\\wamp64\\www\\vinyl\\public\\images\\users\\_userdir_luka2018\\1532432467_user_Luka2018.jpeg','2018-07-24 13:41:07');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `order_notes` text,
  `order_status` enum('processed','unprocessed') DEFAULT 'unprocessed',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`,`id_user`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `id_user_orders_fk_idx` (`id_user`),
  CONSTRAINT `id_user_orders_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (2,57,'Ukoliko je moguce poslati posiljku nakon 24.07.2018.\r\n\r\nTada branim zavrsni i necu biti u mogucnosti da preuzmem porudzbinu ukoliko stigne ranije.\r\n\r\nHvala','unprocessed','2018-07-24 13:35:22',52.10),(3,58,'Jako mi je bitno da dobijem porudzbinu pre 24.07. \r\nImam odbranu zavrsnog, zelim da se opustim uz zvuke Enjoj The Silence od Depche Moda...\r\n\r\nPozdrav','unprocessed','2018-07-24 13:39:43',35.99),(4,56,'','unprocessed','2018-07-24 13:47:13',32.28);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_albums`
--

DROP TABLE IF EXISTS `orders_albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_albums` (
  `id_orders` int(11) NOT NULL,
  `id_albums` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id_orders`,`id_albums`),
  KEY `id_albums_orders_fk_idx` (`id_albums`),
  CONSTRAINT `id_albums_orders_fk` FOREIGN KEY (`id_albums`) REFERENCES `albums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_orders_albums_fk` FOREIGN KEY (`id_orders`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_albums`
--

LOCK TABLES `orders_albums` WRITE;
/*!40000 ALTER TABLE `orders_albums` DISABLE KEYS */;
INSERT INTO `orders_albums` VALUES (2,100,1),(2,107,1),(3,104,1),(3,108,1),(4,84,1),(4,85,1);
/*!40000 ALTER TABLE `orders_albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_archive`
--

DROP TABLE IF EXISTS `orders_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_notes` text NOT NULL,
  `product_titles` text NOT NULL,
  `quantity` varchar(45) NOT NULL,
  `total` decimal(5,2) NOT NULL,
  `unit_price` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_end_status` enum('processed','canceled') NOT NULL DEFAULT 'processed',
  PRIMARY KEY (`id`,`id_user`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `id_user_fk_idx` (`id_user`),
  CONSTRAINT `id_user_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_archive`
--

LOCK TABLES `orders_archive` WRITE;
/*!40000 ALTER TABLE `orders_archive` DISABLE KEYS */;
INSERT INTO `orders_archive` VALUES (60,57,'2018-07-24 13:33:31','Moja prva kupovina u vasoj prodavnici.\r\nSvidja mi se.\r\n\r\nHvala','Kill at Will,Straight Outta Compton','1,1',31.21,'16.77,14.44','2018-07-24 13:36:02','processed');
/*!40000 ALTER TABLE `orders_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_album` int(11) NOT NULL,
  `precentage` int(11) NOT NULL,
  `starting_point` int(255) NOT NULL,
  `duration` int(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expired` enum('no','yes') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`,`id_album`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `id_sales_album_fk_idx` (`id_album`),
  CONSTRAINT `id_sales_album_fk` FOREIGN KEY (`id_album`) REFERENCES `albums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (12,103,25,1532365133,864000,'2018-07-23 18:58:53','no'),(13,102,10,1532365197,864000,'2018-07-23 18:59:57','no'),(14,86,16,1532365221,864000,'2018-07-23 19:00:21','no');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=515 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `songs`
--

LOCK TABLES `songs` WRITE;
/*!40000 ALTER TABLE `songs` DISABLE KEYS */;
INSERT INTO `songs` VALUES (198,'So What','2018-07-04 21:01:01'),(199,'Freddie Freeloader','2018-07-04 21:01:01'),(200,'Blue in Green','2018-07-04 21:01:01'),(201,'All Blues','2018-07-04 21:01:01'),(202,'Flamenco Sketches','2018-07-04 21:01:01'),(241,'So What','2018-07-12 09:58:10'),(242,'Freddie Freeloader','2018-07-12 09:58:10'),(243,'Blue in Green','2018-07-12 09:58:10'),(244,'All Blues','2018-07-12 09:58:10'),(245,'Flamenco Sketches','2018-07-12 09:58:10'),(246,'Concierto de Aranjuez (Adagio)','2018-07-12 10:01:21'),(247,'Will o\' the Wisp','2018-07-12 10:01:21'),(248,'The Pan Piper (Alborada de Vigo)','2018-07-12 10:01:21'),(249,'Saeta','2018-07-12 10:01:21'),(250,'Solea','2018-07-12 10:01:21'),(251,'Blowin\' In The Wind','2018-07-12 10:06:54'),(252,'Girl From The North Country','2018-07-12 10:06:54'),(253,'Masters Of War','2018-07-12 10:06:54'),(254,'	Down The Highway','2018-07-12 10:06:54'),(255,'Bob Dylan\'s Blues','2018-07-12 10:06:54'),(256,'A Hard Rain\'s A-Gonna Fall','2018-07-12 10:06:54'),(257,'	Don\'t Think Twice, It\'s All Right','2018-07-12 10:06:54'),(258,'Bob Dylan\'s Dream','2018-07-12 10:06:54'),(259,'Oxford Town','2018-07-12 10:06:54'),(260,'Talking World War III Blues','2018-07-12 10:06:54'),(261,'Corrina, Corrina','2018-07-12 10:06:54'),(262,'Honey, Just Allow Me One More Chance','2018-07-12 10:06:54'),(263,'	I Shall Be Free','2018-07-12 10:06:54'),(264,'Blowin\' In The Wind','2018-07-12 10:08:27'),(265,'Girl From The North Country','2018-07-12 10:08:27'),(266,'Masters Of War','2018-07-12 10:08:27'),(267,'	Down The Highway','2018-07-12 10:08:27'),(268,'Bob Dylan\'s Blues','2018-07-12 10:08:27'),(269,'A Hard Rain\'s A-Gonna Fall','2018-07-12 10:08:27'),(270,'	Don\'t Think Twice, It\'s All Right','2018-07-12 10:08:27'),(271,'Bob Dylan\'s Dream','2018-07-12 10:08:27'),(272,'Oxford Town','2018-07-12 10:08:27'),(273,'Talking World War III Blues','2018-07-12 10:08:27'),(274,'Corrina, Corrina','2018-07-12 10:08:27'),(275,'Honey, Just Allow Me One More Chance','2018-07-12 10:08:27'),(276,'	I Shall Be Free','2018-07-12 10:08:27'),(277,'(I Can\'t Get No) Satisfaction','2018-07-12 10:13:10'),(278,'Little By Little','2018-07-12 10:13:10'),(279,'(I Can\'t Get No) Satisfaction','2018-07-12 10:19:22'),(280,'	Little By Little','2018-07-12 10:19:22'),(281,'Out on the Weekend','2018-07-12 14:57:46'),(282,'Harvest','2018-07-12 14:57:46'),(283,'A Man Needs a Maid','2018-07-12 14:57:46'),(284,'Heart of Gold','2018-07-12 14:57:46'),(285,'Are You Ready for the Country?','2018-07-12 14:57:46'),(286,'Old Man','2018-07-12 14:57:46'),(287,'There\'s a World','2018-07-12 14:57:46'),(288,'Alabama','2018-07-12 14:57:46'),(289,'The Needle and the Damage Done','2018-07-12 14:57:46'),(290,'Words (Between the Lines of Age)','2018-07-12 14:57:46'),(291,'15 Step','2018-07-12 15:06:19'),(292,'Bodysnatchers','2018-07-12 15:06:19'),(293,'Nude','2018-07-12 15:06:19'),(294,'Weird Fishes Arpeggi','2018-07-12 15:06:19'),(295,'All I Need','2018-07-12 15:06:19'),(296,'Faust Arp','2018-07-12 15:06:19'),(297,'Reckoner','2018-07-12 15:06:19'),(298,'House of Cards','2018-07-12 15:06:19'),(299,'Jigsaw Falling into Place','2018-07-12 15:06:19'),(300,'Videotape','2018-07-12 15:06:19'),(301,'Speak to Me','2018-07-12 15:10:05'),(302,'Breathe','2018-07-12 15:10:05'),(303,'On the Run','2018-07-12 15:10:05'),(304,'Time','2018-07-12 15:10:05'),(305,'The Great Gig in the Sky','2018-07-12 15:10:05'),(306,'Money','2018-07-12 15:10:05'),(307,'Us and Them','2018-07-12 15:10:05'),(308,'Any Colour You Like','2018-07-12 15:10:05'),(309,'Brain Damage','2018-07-12 15:10:05'),(310,'Eclipse','2018-07-12 15:10:05'),(311,'Thunder Road','2018-07-12 15:13:42'),(312,'Tenth Avenue Freeze-Out','2018-07-12 15:13:42'),(313,'Night','2018-07-12 15:13:42'),(314,'Backstreets','2018-07-12 15:13:42'),(315,'Born to Run','2018-07-12 15:13:42'),(316,'She\'s the One','2018-07-12 15:13:42'),(317,'Meeting Across the River','2018-07-12 15:13:42'),(318,'Jungleland','2018-07-12 15:13:42'),(319,'Is This Love','2018-07-12 15:26:46'),(320,'No Woman, No Cry','2018-07-12 15:26:46'),(321,'Could You Be Loved','2018-07-12 15:26:46'),(322,'Three Little Birds','2018-07-12 15:26:46'),(323,'Buffalo Soldier','2018-07-12 15:26:46'),(324,'Get Up, Stand Up','2018-07-12 15:26:46'),(325,'Stir It Up','2018-07-12 15:26:46'),(326,'I Shot the Sheriff','2018-07-12 15:26:46'),(327,'Waiting in Vain','2018-07-12 15:26:46'),(328,'Redemption Song','2018-07-12 15:26:46'),(329,'Satisfy My Soul','2018-07-12 15:26:46'),(330,'Exodus','2018-07-12 15:26:46'),(331,'Jamming','2018-07-12 15:26:46'),(332,' Suspicious','2018-07-12 15:31:54'),(333,'Bring Back My Baby','2018-07-12 15:31:54'),(334,'Wipe The Sweat','2018-07-12 15:31:54'),(335,'Voice In The Wind','2018-07-12 15:31:54'),(336,'Under The Table','2018-07-12 15:31:54'),(337,'Not Trigger','2018-07-12 15:31:54'),(338,'Second Hand News','2018-07-13 20:50:48'),(339,'Dreams','2018-07-13 20:50:48'),(340,'Never Going Back Again','2018-07-13 20:50:48'),(341,'Don\'t Stop','2018-07-13 20:50:48'),(342,'Go Your Own Way','2018-07-13 20:50:48'),(343,'Songbird','2018-07-13 20:50:48'),(344,'The Chain','2018-07-13 20:50:48'),(345,'You Make Loving Fun','2018-07-13 20:50:48'),(346,'I Don\'t Want to Know','2018-07-13 20:50:48'),(347,'Oh Daddy','2018-07-13 20:50:48'),(348,'Gold Dust Woman','2018-07-13 20:50:48'),(349,'Blue Train','2018-07-13 20:54:18'),(350,'Moment\'s Notice','2018-07-13 20:54:18'),(351,'Locomotion','2018-07-13 20:54:18'),(352,'I\'m Old Fashioned','2018-07-13 20:54:18'),(353,'Lazy Bird','2018-07-13 20:54:18'),(354,'Good Times Bad Times','2018-07-13 20:57:43'),(355,'Babe I\'m Gonna Leave You','2018-07-13 20:57:43'),(356,'You Shook Me','2018-07-13 20:57:43'),(357,'Dazed and Confused','2018-07-13 20:57:43'),(358,'Your Time Is Gonna Come','2018-07-13 20:57:43'),(359,'Black Mountain Side','2018-07-13 20:57:43'),(360,'Communication Breakdown','2018-07-13 20:57:43'),(361,'I Can\'t Quit You Baby','2018-07-13 20:57:43'),(362,'How Many More Times','2018-07-13 20:57:43'),(363,'My Funny Valentine','2018-07-13 21:01:49'),(364,'The Girl Next Door','2018-07-13 21:01:49'),(365,'A Foggy Day','2018-07-13 21:01:49'),(366,'Like Someone in Love','2018-07-13 21:01:49'),(367,'I Get a Kick Out of You','2018-07-13 21:01:49'),(368,'Little Girl Blue','2018-07-13 21:01:49'),(369,'They Can\'t Take That Away from Me','2018-07-13 21:01:49'),(370,'Violets for Your Furs','2018-07-13 21:01:49'),(371,'Introduction-Darlin\' Cora','2018-07-13 21:08:52'),(372,'Sylvie','2018-07-13 21:08:52'),(373,'Cotton Fields','2018-07-13 21:08:52'),(374,'John Henry','2018-07-13 21:08:52'),(375,'Take My Mother Home','2018-07-13 21:08:52'),(376,'The Marching Saints','2018-07-13 21:08:52'),(377,'The Banana Boat Song (Day-O)','2018-07-13 21:08:52'),(378,'Jamaica Farewell','2018-07-13 21:08:52'),(379,'Man Piaba','2018-07-13 21:08:52'),(380,'All My Trials','2018-07-13 21:08:52'),(381,'Mama Look a Boo Boo','2018-07-13 21:08:52'),(382,'Come Back Liza','2018-07-13 21:08:52'),(383,'Man Smart (Woman Smarter)','2018-07-13 21:08:52'),(384,'Hava Nagila','2018-07-13 21:08:52'),(385,'Danny Boy','2018-07-13 21:08:52'),(386,'Merci Bon Dieu','2018-07-13 21:08:52'),(387,'Cucurrucucu Paloma','2018-07-13 21:08:52'),(388,'Shenandoah','2018-07-13 21:08:52'),(389,'Matilda','2018-07-13 21:08:52'),(390,'Overture','2018-07-13 21:37:42'),(391,'It\'s A Boy','2018-07-13 21:37:42'),(392,'1921','2018-07-13 21:37:42'),(393,'Amazing Journey','2018-07-13 21:37:42'),(394,'Sparks','2018-07-13 21:37:42'),(395,'Eyesight To The Blind (The Hawker)','2018-07-13 21:37:42'),(396,'Christmas','2018-07-13 21:37:42'),(397,'Cousin Kevin','2018-07-13 21:37:42'),(398,'The Acid Queen','2018-07-13 21:37:42'),(399,'Underture','2018-07-13 21:37:42'),(400,'Do You Think It\'s Alright?','2018-07-13 21:37:42'),(401,'Fiddle About','2018-07-13 21:37:42'),(402,'Pinball Wizard','2018-07-13 21:37:42'),(403,'There\'s A Doctor','2018-07-13 21:37:42'),(404,'Go To The Mirror!','2018-07-13 21:37:42'),(405,'Tommy Can You Hear Me?','2018-07-13 21:37:42'),(406,'Smash The Mirror','2018-07-13 21:37:42'),(407,'Sensation','2018-07-13 21:37:42'),(408,'Miracle Cure','2018-07-13 21:37:42'),(409,'Sally Simpson','2018-07-13 21:37:42'),(410,'I\'m Free','2018-07-13 21:37:42'),(411,'Welcome','2018-07-13 21:37:42'),(412,'Tommy\'s Holiday Camp','2018-07-13 21:37:42'),(413,'We\'re Not Gonna Take It','2018-07-13 21:37:42'),(414,'Singing Winds, Crying Beasts','2018-07-13 23:24:46'),(415,'Black Magic Woman - Gypsy Queen','2018-07-13 23:24:46'),(416,'Oye Como Va','2018-07-13 23:24:46'),(417,'Incident At Neshabur','2018-07-13 23:24:46'),(418,'Se A Cabo','2018-07-13 23:24:46'),(419,'Mother\'s Daughter','2018-07-13 23:24:46'),(420,'Samba Pa Ti','2018-07-13 23:24:46'),(421,'Hope You\'re Feeling Better','2018-07-13 23:24:46'),(422,'El Nicoya','2018-07-13 23:24:46'),(423,'What\'s Going On','2018-07-13 23:28:13'),(424,'What\'s Happening Brother','2018-07-13 23:28:13'),(425,'Flyin\' High (In The Friendly Sky)','2018-07-13 23:28:13'),(426,'Save The Children','2018-07-13 23:28:13'),(427,'God Is Love','2018-07-13 23:28:13'),(428,'Mercy Mercy Me (The Ecology)','2018-07-13 23:28:13'),(429,'Right On','2018-07-13 23:28:13'),(430,'Wholy Holy','2018-07-13 23:28:13'),(431,'Inner City Blues (Make Me Wanna Holler)','2018-07-13 23:28:13'),(432,'What\'s Going On','2018-07-13 23:34:54'),(433,'What\'s Happening Brother','2018-07-13 23:34:54'),(434,'Flyin\' High (In The Friendly Sky)','2018-07-13 23:34:54'),(435,'Save The Children','2018-07-13 23:34:54'),(436,'God Is Love','2018-07-13 23:34:54'),(437,'Mercy Mercy Me (The Ecology)','2018-07-13 23:34:54'),(438,'Right On','2018-07-13 23:34:54'),(439,'Wholy Holy','2018-07-13 23:34:54'),(440,'Inner City Blues (Make Me Wanna Holler)','2018-07-13 23:34:54'),(441,'Highway to Hell','2018-07-23 01:30:05'),(442,'Girls Got Rhythm','2018-07-23 01:30:05'),(443,'Walk All Over You','2018-07-23 01:30:05'),(444,'Touch Too Much','2018-07-23 01:30:05'),(445,'Beating Around the Bush','2018-07-23 01:30:05'),(446,'Shot Down in Flames','2018-07-23 01:30:05'),(447,'Get It Hot','2018-07-23 01:30:05'),(448,'If You Want Blood (You\'ve Got It)','2018-07-23 01:30:05'),(449,'Love Hungry Man','2018-07-23 01:30:05'),(450,'Night Prowler','2018-07-23 01:30:05'),(451,'Bohemian Rhapsody','2018-07-23 01:35:28'),(452,'I\'m in Love with My Car','2018-07-23 01:35:28'),(453,'Mellow Mood (Pt. I)','2018-07-23 02:10:40'),(454,'You\'re the First, the Last, My Everything','2018-07-23 02:10:40'),(455,'I Can\'t Believe You Love Me','2018-07-23 02:10:40'),(456,'Can\'t Get Enough of Your Love, Babe','2018-07-23 02:10:40'),(457,'Oh Love, Well We Finally Made It','2018-07-23 02:10:40'),(458,'I Love You More Than Anything (In This World Girl)','2018-07-23 02:10:40'),(459,'Mellow Mood (Pt. II)','2018-07-23 02:10:40'),(460,'Mellow Mood (Pt. I)','2018-07-23 02:10:51'),(461,'You\'re the First, the Last, My Everything','2018-07-23 02:10:51'),(462,'I Can\'t Believe You Love Me','2018-07-23 02:10:51'),(463,'Can\'t Get Enough of Your Love, Babe','2018-07-23 02:10:51'),(464,'Oh Love, Well We Finally Made It','2018-07-23 02:10:51'),(465,'I Love You More Than Anything (In This World Girl)','2018-07-23 02:10:51'),(466,'Mellow Mood (Pt. II)','2018-07-23 02:10:51'),(467,'Mellow Mood (Pt. I)','2018-07-23 02:11:21'),(468,'You\'re the First, the Last, My Everything','2018-07-23 02:11:21'),(469,'I Can\'t Believe You Love Me','2018-07-23 02:11:21'),(470,'Can\'t Get Enough of Your Love, Babe','2018-07-23 02:11:21'),(471,'Oh Love, Well We Finally Made It','2018-07-23 02:11:21'),(472,'I Love You More Than Anything (In This World Girl)','2018-07-23 02:11:21'),(473,'Mellow Mood (Pt. II)','2018-07-23 02:11:21'),(474,'Synchronicity I','2018-07-23 02:16:36'),(475,'Walking in Your Footsteps','2018-07-23 02:16:36'),(476,'O My God','2018-07-23 02:16:36'),(477,'Mother','2018-07-23 02:16:36'),(478,'Miss Gradenko','2018-07-23 02:16:36'),(479,'Synchronicity II','2018-07-23 02:16:36'),(480,'Every Breath You Take','2018-07-23 02:16:36'),(481,'King of Pain','2018-07-23 02:16:36'),(482,'Wrapped Around Your Finger','2018-07-23 02:16:36'),(483,'Tea in the Sahara','2018-07-23 02:16:36'),(484,'Wanna Be Startin\' Somethin','2018-07-23 02:20:40'),(485,'Baby Be Mine','2018-07-23 02:20:40'),(486,'The Girl Is Mine','2018-07-23 02:20:40'),(487,'Thriller','2018-07-23 02:20:40'),(488,'Beat It','2018-07-23 02:20:40'),(489,'Billie Jean','2018-07-23 02:20:40'),(490,'Human Nature','2018-07-23 02:20:40'),(491,'P.Y.T. (Pretty Young Thing)','2018-07-23 02:20:40'),(492,'The Lady in My Life','2018-07-23 02:20:40'),(493,'World in My Eyes','2018-07-23 02:26:29'),(494,'Sweetest Perfection','2018-07-23 02:26:29'),(495,'Personal Jesus','2018-07-23 02:26:29'),(496,'Halo','2018-07-23 02:26:29'),(497,'Waiting for the Night','2018-07-23 02:26:29'),(498,'Enjoy the Silence','2018-07-23 02:26:29'),(499,'Policy of Truth','2018-07-23 02:26:29'),(500,'Blue Dress','2018-07-23 02:26:29'),(501,'Clean','2018-07-23 02:26:29'),(502,'Straight Outta Compton','2018-07-23 02:33:32'),(503,'Fuck tha Police','2018-07-23 02:33:32'),(504,'Gangsta Gangsta','2018-07-23 02:33:32'),(505,'If It Ain\'t Ruff','2018-07-23 02:33:32'),(506,'Parental Discretion Iz Advised','2018-07-23 02:33:32'),(507,'8 Ball (Remix)','2018-07-23 02:33:32'),(508,'Something Like That','2018-07-23 02:33:32'),(509,'Express Yourself','2018-07-23 02:33:32'),(510,'Compton\'s N the House (Remix)','2018-07-23 02:33:32'),(511,'I Ain\'t tha 1','2018-07-23 02:33:32'),(512,'Dopeman (Remix)','2018-07-23 02:33:32'),(513,'Quiet On tha Set','2018-07-23 02:33:32'),(514,'Something 2 Dance 2','2018-07-23 02:33:32');
/*!40000 ALTER TABLE `songs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL DEFAULT 'not_registered',
  `last_name` varchar(50) NOT NULL DEFAULT 'not_registered',
  `username` varchar(50) NOT NULL DEFAULT 'not_registered',
  `email` varchar(50) NOT NULL DEFAULT 'not_registered',
  `password` varchar(100) NOT NULL DEFAULT 'not_registered',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `id_address` int(11) NOT NULL DEFAULT '37',
  `id_img` int(11) NOT NULL DEFAULT '143',
  `permission` enum('not_registered','regular','moderator','admin') NOT NULL DEFAULT 'not_registered',
  PRIMARY KEY (`id`,`id_address`,`id_img`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `id_users_address_fk_idx` (`id_address`),
  CONSTRAINT `id_users_address_fk` FOREIGN KEY (`id_address`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'Amir','Hadzija','BGamir1989','amir@mail.com','$2y$10$P/NVO7TLHEohbt6qjxiwMuIolxN.Dl6DOzRETRhU8NMq9LCYuNzBa','2018-06-21 13:43:59',0,42,144,'admin'),(56,'Aneta','Hadzija','Anchi93','aneta@mail.com','$2y$10$QbCsGlAGDDIh88Z7VLqUIOYum1X9JWzNkscGnY5TfwC7m9KcuBuuK','2018-07-23 00:54:13',0,76,152,'regular'),(57,'Tamara','Vasic','Tamara2018','taca@mail.com','$2y$10$0GB6hXQxrJYkwWl7GL7b6eWSnBKLVytm0RqaBdf74SaUJ140g1.O2','2018-07-23 00:55:34',0,77,143,'regular'),(58,'Djordje','Buleski','Djole2018','djole@mail.com','$2y$10$5MS4dWg4/9a3Gcj0uYr4GeGDHBEpW6KuMTWTPNuTWIKl32e8g4bzy','2018-07-23 00:56:23',0,78,143,'regular'),(59,'Luka','Krkljes','Luka2018','luka@mail.com','$2y$10$l0KR9Y4V/t.BX8MZMaqhgeFG062zssZ.IvtlWol.qnORRgUx0l9aO','2018-07-23 00:59:56',0,79,153,'regular'),(60,'Igor','Janosevic','Igor2018','igor@mail.com','$2y$10$FqVobj6N3bBjtrNsu2BTL.MhDeuxdE/9MK/O6TfywuZJcxBcViTDa','2018-07-23 01:01:39',0,80,143,'regular');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'vinyl_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-24 13:51:34
