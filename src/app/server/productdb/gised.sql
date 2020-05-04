-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: gised
-- ------------------------------------------------------
-- Server version	5.7.27

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
-- Table structure for table `core_country_details`
--

DROP TABLE IF EXISTS `core_country_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_country_details` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `country_name` varchar(75) NOT NULL COMMENT 'Country name for this master table',
  `status` enum('Y','N') DEFAULT 'Y' COMMENT 'Active and inactive for this record',
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_country_details`
--

LOCK TABLES `core_country_details` WRITE;
/*!40000 ALTER TABLE `core_country_details` DISABLE KEYS */;
INSERT INTO `core_country_details` VALUES (2,'Afghanistan','Y'),(3,'Albania','Y'),(4,'Algeria','Y'),(5,'American Samoa','Y'),(6,'Andorra','Y'),(7,'Angola','Y'),(8,'Anguilla','Y'),(9,'Antarctica','Y'),(10,'Antigua And Barbuda','Y'),(11,'Argentina','Y'),(12,'Armenia','Y'),(13,'Aruba','Y'),(14,'Australia','Y'),(15,'Austria','Y'),(16,'Azerbaijan','Y'),(17,'Bahamas The','Y'),(18,'Bahrain','Y'),(19,'Bangladesh','Y'),(20,'Barbados','Y'),(21,'Belarus','Y'),(22,'Belgium','Y'),(23,'Belize','Y'),(24,'Benin','Y'),(25,'Bermuda','Y'),(26,'Bhutan','Y'),(27,'Bolivia','Y'),(28,'Bosnia and Herzegovina','Y'),(29,'Botswana','Y'),(30,'Bouvet Island','Y'),(31,'Brazil','Y'),(32,'British Indian Ocean Territory','Y'),(33,'Brunei','Y'),(34,'Bulgaria','Y'),(35,'Burkina Faso','Y'),(36,'Burundi','Y'),(37,'Cambodia','Y'),(38,'Cameroon','Y'),(39,'Canada','Y'),(40,'Cape Verde','Y'),(41,'Cayman Islands','Y'),(42,'Central African Republic','Y'),(43,'Chad','Y'),(44,'Chile','Y'),(45,'China','Y'),(46,'Christmas Island','Y'),(47,'Cocos (Keeling) Islands','Y'),(48,'Colombia','Y'),(49,'Comoros','Y'),(50,'Cook Islands','Y'),(51,'Costa Rica','Y'),(52,'Cote D\'Ivoire (Ivory Coast)','Y'),(53,'Croatia (Hrvatska)','Y'),(54,'Cuba','Y'),(55,'Cyprus','Y'),(56,'Czech Republic','Y'),(57,'Democratic Republic Of The Congo','Y'),(58,'Denmark','Y'),(59,'Djibouti','Y'),(60,'Dominica','Y'),(61,'Dominican Republic','Y'),(62,'East Timor','Y'),(63,'Ecuador','Y'),(64,'Egypt','Y'),(65,'El Salvador','Y'),(66,'Equatorial Guinea','Y'),(67,'Eritrea','Y'),(68,'Estonia','Y'),(69,'Ethiopia','Y'),(70,'External Territories of Australia','Y'),(71,'Falkland Islands','Y'),(72,'Faroe Islands','Y'),(73,'Fiji Islands','Y'),(74,'Finland','Y'),(75,'France','Y'),(76,'French Guiana','Y'),(77,'French Polynesia','Y'),(78,'French Southern Territories','Y'),(79,'Gabon','Y'),(80,'Gambia The','Y'),(81,'Georgia','Y'),(82,'Germany','Y'),(83,'Ghana','Y'),(84,'Gibraltar','Y'),(85,'Greece','Y'),(86,'Greenland','Y'),(87,'Grenada','Y'),(88,'Guadeloupe','Y'),(89,'Guam','Y'),(90,'Guatemala','Y'),(91,'Guernsey and Alderney','Y'),(92,'Guinea','Y'),(93,'Guinea-Bissau','Y'),(94,'Guyana','Y'),(95,'Haiti','Y'),(96,'Heard and McDonald Islands','Y'),(97,'Honduras','Y'),(98,'Hong Kong S.A.R.','Y'),(99,'Hungary','Y'),(100,'Iceland','Y'),(101,'India','Y'),(102,'Indonesia','Y'),(103,'Iran','Y'),(104,'Iraq','Y'),(105,'Ireland','Y'),(106,'Israel','Y'),(107,'Italy','Y'),(108,'Jamaica','Y'),(109,'Japan','Y'),(110,'Jersey','Y'),(111,'Jordan','Y'),(112,'Kazakhstan','Y'),(113,'Kenya','Y'),(114,'Kiribati','Y'),(115,'Korea North','Y'),(116,'Korea South','Y'),(117,'Kuwait','Y'),(118,'Kyrgyzstan','Y'),(119,'Laos','Y'),(120,'Latvia','Y'),(121,'Lebanon','Y'),(122,'Lesotho','Y'),(123,'Liberia','Y'),(124,'Libya','Y'),(125,'Liechtenstein','Y'),(126,'Lithuania','Y'),(127,'Luxembourg','Y'),(128,'Macau S.A.R.','Y'),(129,'Macedonia','Y'),(130,'Madagascar','Y'),(131,'Malawi','Y'),(132,'Malaysia','Y'),(133,'Maldives','Y'),(134,'Mali','Y'),(135,'Malta','Y'),(136,'Man (Isle of)','Y'),(137,'Marshall Islands','Y'),(138,'Martinique','Y'),(139,'Mauritania','Y'),(140,'Mauritius','Y'),(141,'Mayotte','Y'),(142,'Mexico','Y'),(143,'Micronesia','Y'),(144,'Moldova','Y'),(145,'Monaco','Y'),(146,'Mongolia','Y'),(147,'Montserrat','Y'),(148,'Morocco','Y'),(149,'Mozambique','Y'),(150,'Myanmar','Y'),(151,'Namibia','Y'),(152,'Nauru','Y'),(153,'Nepal','Y'),(154,'Netherlands Antilles','Y'),(155,'Netherlands The','Y'),(156,'New Caledonia','Y'),(157,'New Zealand','Y'),(158,'Nicaragua','Y'),(159,'Niger','Y'),(160,'Nigeria','Y'),(161,'Niue','Y'),(162,'Norfolk Island','Y'),(163,'Northern Mariana Islands','Y'),(164,'Norway','Y'),(165,'Oman','Y'),(166,'Pakistan','Y'),(167,'Palau','Y'),(168,'Palestinian Territory Occupied','Y'),(169,'Panama','Y'),(170,'Papua new Guinea','Y'),(171,'Paraguay','Y'),(172,'Peru','Y'),(173,'Philippines','Y'),(174,'Pitcairn Island','Y'),(175,'Poland','Y'),(176,'Portugal','Y'),(177,'Puerto Rico','Y'),(178,'Qatar','Y'),(179,'Republic Of The Congo','Y'),(180,'Reunion','Y'),(181,'Romania','Y'),(182,'Russia','Y'),(183,'Rwanda','Y'),(184,'Saint Helena','Y'),(185,'Saint Kitts And Nevis','Y'),(186,'Saint Lucia','Y'),(187,'Saint Pierre and Miquelon','Y'),(188,'Saint Vincent And The Grenadines','Y'),(189,'Samoa','Y'),(190,'San Marino','Y'),(191,'Sao Tome and Principe','Y'),(192,'Saudi Arabia','Y'),(193,'Senegal','Y'),(194,'Serbia','Y'),(195,'Seychelles','Y'),(196,'Sierra Leone','Y'),(197,'Singapore','Y'),(198,'Slovakia','Y'),(199,'Slovenia','Y'),(200,'Smaller Territories of the UK','Y'),(201,'Solomon Islands','Y'),(202,'Somalia','Y'),(203,'South Africa','Y'),(204,'South Georgia','Y'),(205,'South Sudan','Y'),(206,'Spain','Y'),(207,'Sri Lanka','Y'),(208,'Sudan','Y'),(209,'Suriname','Y'),(210,'Svalbard And Jan Mayen Islands','Y'),(211,'Swaziland','Y'),(212,'Sweden','Y'),(213,'Switzerland','Y'),(214,'Syria','Y'),(215,'Taiwan','Y'),(216,'Tajikistan','Y'),(217,'Tanzania','Y'),(218,'Thailand','Y'),(219,'Togo','Y'),(220,'Tokelau','Y'),(221,'Tonga','Y'),(222,'Trinidad And Tobago','Y'),(223,'Tunisia','Y'),(224,'Turkey','Y'),(225,'Turkmenistan','Y'),(226,'Turks And Caicos Islands','Y'),(227,'Tuvalu','Y'),(228,'Uganda','Y'),(229,'Ukraine','Y'),(230,'United Arab Emirates','Y'),(231,'United Kingdom','Y'),(232,'United States','Y'),(233,'United States Minor Outlying Islands','Y'),(234,'Uruguay','Y'),(235,'Uzbekistan','Y'),(236,'Vanuatu','Y'),(237,'Vatican City State (Holy See)','Y'),(238,'Venezuela','Y'),(239,'Vietnam','Y'),(240,'Virgin Islands (British)','Y'),(241,'Virgin Islands (US)','Y'),(242,'Wallis And Futuna Islands','Y'),(243,'Western Sahara','Y'),(244,'Yemen','Y'),(245,'Yugoslavia','Y'),(246,'Zambia','Y'),(247,'Zimbabwe','Y');
/*!40000 ALTER TABLE `core_country_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_country_state_details`
--

DROP TABLE IF EXISTS `core_country_state_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_country_state_details` (
  `country_state_details_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `r_country_id` int(11) NOT NULL COMMENT 'This field data refer from core_country_details table primary key',
  `r_state_id` int(11) NOT NULL COMMENT 'This field data refer from core_state_details table primary key',
  `status` enum('Y','N') DEFAULT 'Y' COMMENT 'Active and inactive for this record',
  PRIMARY KEY (`country_state_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_country_state_details`
--

LOCK TABLES `core_country_state_details` WRITE;
/*!40000 ALTER TABLE `core_country_state_details` DISABLE KEYS */;
INSERT INTO `core_country_state_details` VALUES (1,1,1,'Y');
/*!40000 ALTER TABLE `core_country_state_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_currency_type`
--

DROP TABLE IF EXISTS `core_currency_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_currency_type` (
  `currency_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `currency_type` varchar(10) NOT NULL COMMENT 'This field for currency type of country EX. INR',
  `description` varchar(50) NOT NULL COMMENT 'This field is explanation of currency_type EX. Indian Rupees',
  `status` enum('Y','N') DEFAULT 'Y' COMMENT 'Active and inactive for this record',
  PRIMARY KEY (`currency_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_currency_type`
--

LOCK TABLES `core_currency_type` WRITE;
/*!40000 ALTER TABLE `core_currency_type` DISABLE KEYS */;
INSERT INTO `core_currency_type` VALUES (1,'INR','Indian Rupees','Y');
/*!40000 ALTER TABLE `core_currency_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_state_details`
--

DROP TABLE IF EXISTS `core_state_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_state_details` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `state_name` varchar(75) NOT NULL COMMENT 'State name for this master table',
  `status` enum('Y','N') DEFAULT 'Y' COMMENT 'Active and inactive for this record',
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_state_details`
--

LOCK TABLES `core_state_details` WRITE;
/*!40000 ALTER TABLE `core_state_details` DISABLE KEYS */;
INSERT INTO `core_state_details` VALUES (1,'Tamil Nadu','Y');
/*!40000 ALTER TABLE `core_state_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_user_type`
--

DROP TABLE IF EXISTS `core_user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `user_type` varchar(25) NOT NULL COMMENT 'User type defined for the product',
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user_type`
--

LOCK TABLES `core_user_type` WRITE;
/*!40000 ALTER TABLE `core_user_type` DISABLE KEYS */;
INSERT INTO `core_user_type` VALUES (1,'Admin'),(2,'User');
/*!40000 ALTER TABLE `core_user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'AF','Afghanistan',93),(2,'AL','Albania',355),(3,'DZ','Algeria',213),(4,'AS','American Samoa',1684),(5,'AD','Andorra',376),(6,'AO','Angola',244),(7,'AI','Anguilla',1264),(8,'AQ','Antarctica',0),(9,'AG','Antigua And Barbuda',1268),(10,'AR','Argentina',54),(11,'AM','Armenia',374),(12,'AW','Aruba',297),(13,'AU','Australia',61),(14,'AT','Austria',43),(15,'AZ','Azerbaijan',994),(16,'BS','Bahamas The',1242),(17,'BH','Bahrain',973),(18,'BD','Bangladesh',880),(19,'BB','Barbados',1246),(20,'BY','Belarus',375),(21,'BE','Belgium',32),(22,'BZ','Belize',501),(23,'BJ','Benin',229),(24,'BM','Bermuda',1441),(25,'BT','Bhutan',975),(26,'BO','Bolivia',591),(27,'BA','Bosnia and Herzegovina',387),(28,'BW','Botswana',267),(29,'BV','Bouvet Island',0),(30,'BR','Brazil',55),(31,'IO','British Indian Ocean Territory',246),(32,'BN','Brunei',673),(33,'BG','Bulgaria',359),(34,'BF','Burkina Faso',226),(35,'BI','Burundi',257),(36,'KH','Cambodia',855),(37,'CM','Cameroon',237),(38,'CA','Canada',1),(39,'CV','Cape Verde',238),(40,'KY','Cayman Islands',1345),(41,'CF','Central African Republic',236),(42,'TD','Chad',235),(43,'CL','Chile',56),(44,'CN','China',86),(45,'CX','Christmas Island',61),(46,'CC','Cocos (Keeling) Islands',672),(47,'CO','Colombia',57),(48,'KM','Comoros',269),(49,'CG','Republic Of The Congo',242),(50,'CD','Democratic Republic Of The Congo',242),(51,'CK','Cook Islands',682),(52,'CR','Costa Rica',506),(53,'CI','Cote D\'Ivoire (Ivory Coast)',225),(54,'HR','Croatia (Hrvatska)',385),(55,'CU','Cuba',53),(56,'CY','Cyprus',357),(57,'CZ','Czech Republic',420),(58,'DK','Denmark',45),(59,'DJ','Djibouti',253),(60,'DM','Dominica',1767),(61,'DO','Dominican Republic',1809),(62,'TP','East Timor',670),(63,'EC','Ecuador',593),(64,'EG','Egypt',20),(65,'SV','El Salvador',503),(66,'GQ','Equatorial Guinea',240),(67,'ER','Eritrea',291),(68,'EE','Estonia',372),(69,'ET','Ethiopia',251),(70,'XA','External Territories of Australia',61),(71,'FK','Falkland Islands',500),(72,'FO','Faroe Islands',298),(73,'FJ','Fiji Islands',679),(74,'FI','Finland',358),(75,'FR','France',33),(76,'GF','French Guiana',594),(77,'PF','French Polynesia',689),(78,'TF','French Southern Territories',0),(79,'GA','Gabon',241),(80,'GM','Gambia The',220),(81,'GE','Georgia',995),(82,'DE','Germany',49),(83,'GH','Ghana',233),(84,'GI','Gibraltar',350),(85,'GR','Greece',30),(86,'GL','Greenland',299),(87,'GD','Grenada',1473),(88,'GP','Guadeloupe',590),(89,'GU','Guam',1671),(90,'GT','Guatemala',502),(91,'XU','Guernsey and Alderney',44),(92,'GN','Guinea',224),(93,'GW','Guinea-Bissau',245),(94,'GY','Guyana',592),(95,'HT','Haiti',509),(96,'HM','Heard and McDonald Islands',0),(97,'HN','Honduras',504),(98,'HK','Hong Kong S.A.R.',852),(99,'HU','Hungary',36),(100,'IS','Iceland',354),(101,'IN','India',91),(102,'ID','Indonesia',62),(103,'IR','Iran',98),(104,'IQ','Iraq',964),(105,'IE','Ireland',353),(106,'IL','Israel',972),(107,'IT','Italy',39),(108,'JM','Jamaica',1876),(109,'JP','Japan',81),(110,'XJ','Jersey',44),(111,'JO','Jordan',962),(112,'KZ','Kazakhstan',7),(113,'KE','Kenya',254),(114,'KI','Kiribati',686),(115,'KP','Korea North',850),(116,'KR','Korea South',82),(117,'KW','Kuwait',965),(118,'KG','Kyrgyzstan',996),(119,'LA','Laos',856),(120,'LV','Latvia',371),(121,'LB','Lebanon',961),(122,'LS','Lesotho',266),(123,'LR','Liberia',231),(124,'LY','Libya',218),(125,'LI','Liechtenstein',423),(126,'LT','Lithuania',370),(127,'LU','Luxembourg',352),(128,'MO','Macau S.A.R.',853),(129,'MK','Macedonia',389),(130,'MG','Madagascar',261),(131,'MW','Malawi',265),(132,'MY','Malaysia',60),(133,'MV','Maldives',960),(134,'ML','Mali',223),(135,'MT','Malta',356),(136,'XM','Man (Isle of)',44),(137,'MH','Marshall Islands',692),(138,'MQ','Martinique',596),(139,'MR','Mauritania',222),(140,'MU','Mauritius',230),(141,'YT','Mayotte',269),(142,'MX','Mexico',52),(143,'FM','Micronesia',691),(144,'MD','Moldova',373),(145,'MC','Monaco',377),(146,'MN','Mongolia',976),(147,'MS','Montserrat',1664),(148,'MA','Morocco',212),(149,'MZ','Mozambique',258),(150,'MM','Myanmar',95),(151,'NA','Namibia',264),(152,'NR','Nauru',674),(153,'NP','Nepal',977),(154,'AN','Netherlands Antilles',599),(155,'NL','Netherlands The',31),(156,'NC','New Caledonia',687),(157,'NZ','New Zealand',64),(158,'NI','Nicaragua',505),(159,'NE','Niger',227),(160,'NG','Nigeria',234),(161,'NU','Niue',683),(162,'NF','Norfolk Island',672),(163,'MP','Northern Mariana Islands',1670),(164,'NO','Norway',47),(165,'OM','Oman',968),(166,'PK','Pakistan',92),(167,'PW','Palau',680),(168,'PS','Palestinian Territory Occupied',970),(169,'PA','Panama',507),(170,'PG','Papua new Guinea',675),(171,'PY','Paraguay',595),(172,'PE','Peru',51),(173,'PH','Philippines',63),(174,'PN','Pitcairn Island',0),(175,'PL','Poland',48),(176,'PT','Portugal',351),(177,'PR','Puerto Rico',1787),(178,'QA','Qatar',974),(179,'RE','Reunion',262),(180,'RO','Romania',40),(181,'RU','Russia',70),(182,'RW','Rwanda',250),(183,'SH','Saint Helena',290),(184,'KN','Saint Kitts And Nevis',1869),(185,'LC','Saint Lucia',1758),(186,'PM','Saint Pierre and Miquelon',508),(187,'VC','Saint Vincent And The Grenadines',1784),(188,'WS','Samoa',684),(189,'SM','San Marino',378),(190,'ST','Sao Tome and Principe',239),(191,'SA','Saudi Arabia',966),(192,'SN','Senegal',221),(193,'RS','Serbia',381),(194,'SC','Seychelles',248),(195,'SL','Sierra Leone',232),(196,'SG','Singapore',65),(197,'SK','Slovakia',421),(198,'SI','Slovenia',386),(199,'XG','Smaller Territories of the UK',44),(200,'SB','Solomon Islands',677),(201,'SO','Somalia',252),(202,'ZA','South Africa',27),(203,'GS','South Georgia',0),(204,'SS','South Sudan',211),(205,'ES','Spain',34),(206,'LK','Sri Lanka',94),(207,'SD','Sudan',249),(208,'SR','Suriname',597),(209,'SJ','Svalbard And Jan Mayen Islands',47),(210,'SZ','Swaziland',268),(211,'SE','Sweden',46),(212,'CH','Switzerland',41),(213,'SY','Syria',963),(214,'TW','Taiwan',886),(215,'TJ','Tajikistan',992),(216,'TZ','Tanzania',255),(217,'TH','Thailand',66),(218,'TG','Togo',228),(219,'TK','Tokelau',690),(220,'TO','Tonga',676),(221,'TT','Trinidad And Tobago',1868),(222,'TN','Tunisia',216),(223,'TR','Turkey',90),(224,'TM','Turkmenistan',7370),(225,'TC','Turks And Caicos Islands',1649),(226,'TV','Tuvalu',688),(227,'UG','Uganda',256),(228,'UA','Ukraine',380),(229,'AE','United Arab Emirates',971),(230,'GB','United Kingdom',44),(231,'US','United States',1),(232,'UM','United States Minor Outlying Islands',1),(233,'UY','Uruguay',598),(234,'UZ','Uzbekistan',998),(235,'VU','Vanuatu',678),(236,'VA','Vatican City State (Holy See)',39),(237,'VE','Venezuela',58),(238,'VN','Vietnam',84),(239,'VG','Virgin Islands (British)',1284),(240,'VI','Virgin Islands (US)',1340),(241,'WF','Wallis And Futuna Islands',681),(242,'EH','Western Sahara',212),(243,'YE','Yemen',967),(244,'YU','Yugoslavia',38),(245,'ZM','Zambia',260),(246,'ZW','Zimbabwe',263);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_application_details`
--

DROP TABLE IF EXISTS `dm_application_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_application_details` (
  `application_details_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `application_name` varchar(100) DEFAULT '' COMMENT 'Available application type of this product',
  `status` char(1) DEFAULT 'Y',
  PRIMARY KEY (`application_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_application_details`
--

LOCK TABLES `dm_application_details` WRITE;
/*!40000 ALTER TABLE `dm_application_details` DISABLE KEYS */;
INSERT INTO `dm_application_details` VALUES (1,'Education','Y'),(2,'Medical','N');
/*!40000 ALTER TABLE `dm_application_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_form_brief_assesment`
--

DROP TABLE IF EXISTS `dm_form_brief_assesment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_form_brief_assesment` (
  `form_brief_assesment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `full_name` varchar(55) DEFAULT '' COMMENT 'Full name for this brief assesment form',
  `address` varchar(255) DEFAULT '' COMMENT 'Address for this brief assesment form',
  `email_id` varchar(100) DEFAULT '' COMMENT 'Email id for this brief assesment form',
  `telephone_number` varchar(15) DEFAULT '' COMMENT 'Telephone number for this brief assesment form',
  `website_url` varchar(100) DEFAULT '' COMMENT 'Web site name for this brief assesment form',
  `uploads` text COMMENT 'Uploaded files name',
  `created_date_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Created time of this record',
  `updated_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last modified date of this record',
  PRIMARY KEY (`form_brief_assesment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_form_brief_assesment`
--

LOCK TABLES `dm_form_brief_assesment` WRITE;
/*!40000 ALTER TABLE `dm_form_brief_assesment` DISABLE KEYS */;
INSERT INTO `dm_form_brief_assesment` VALUES (5,'fhjsdjhflsdljl','dkfdklgmldfk','klferklmrlgkfme','jkdfsdklfklsdkl','Y','\Z\0\0xœ«V*(-*È/NõO(ÊÏJM.1T²ŠVJËÌIÍKÌM5Ô+©(QÒóÀüX¥”Ô’D XŠg^Z~QnbIf~QúR‹K2ÊSSœJSÒSKëAðÑø&03R‹2óSüÓB2sS1\r)@ó¢N­\0þWbï','2020-04-30 18:02:32','2020-04-30 12:32:32'),(6,'SatheesKumar','ASDASDFsa','sdasfsdfs@fdfsd.com','234235346456','Y','\0\0\0xœË+ÍÉ\0_¼','2020-05-01 19:18:59','2020-05-01 13:48:59'),(7,'fksdfksdkl','gdfgdfhdfg','fsdifjij','fkljdklgkle','Y','\0\0\0xœË+ÍÉ\0_¼','2020-05-01 19:25:20','2020-05-01 13:55:20'),(8,'fdkwflwe','sdfmsdkmfl','fmwekflwem','fklmweklfmwe','Y','\0\0\0xœË+ÍÉ\0_¼','2020-05-01 19:33:38','2020-05-01 14:03:38'),(9,'dmflksdmf','flkmfklwr','rkfwekferf','kmfklwermf','Y','\0\0\0xœË+ÍÉ\0_¼','2020-05-01 19:37:15','2020-05-01 14:07:15'),(10,'dfsk;dfk;sd',';wefm;kwmfw',';lf,w;rlfer',';ldfe;rf','Y','\0\0\0xœs,*J¬\0£\0','2020-05-01 19:57:59','2020-05-01 14:27:59'),(11,'fsdjfjklsdfls','dfldfnmwlf','klfmwklmflwk','mfkmwklfmw','N','5\0\0\0xœ«V*(-*È/NõO(ÊÏJM.1T²Ê+ÍÉÑQJI-IÌÌIMñÌKË/ÊM,ÉÌÏƒHÕ\0M$','2020-05-01 20:00:23','2020-05-01 14:32:56'),(12,'kljflsdjklfs','fcsdmfkmsdk','fkmsdkfmsd;k','4534534534','N','X\0\0xœ=Â0†ÿKæRri]ÝœêàV$Ds‘óAzAüïF°´ãï{÷ÜÝE\ZsŠvn—ãObÝGWÆ#Ô|cQ}X½YI%åJ‚’ ¡ÕZ3¡ÓP\'ëÄ¡Ù”ŠÝ³7L1ü[z80•8ÚÍhÏÈKT&nfÜþVm&Õ„™¢íÜž<~ï{fR.y<Ÿ£so','2020-05-01 20:09:27','2020-05-01 14:40:14'),(13,'sdfnsjnfjk','cvnsjlvsn','fnljdsnvjlsdf','vjlfnjlvdflvndf','N','9\0\0xœ=Â0EÿË›KIÒŠèèæT7‘Í{1¤¯ ˆÿÝÖ¡v<pïár†œbír¼â™%¬@î†Áx”5ßª/«+¡„X©„\\¶+­õ);$ÝÔÉ+°È¦Tì6PÌÞ°‹á¿¶ô°gWâh7ƒ½ Ï™2r3ávt&Ì.ÚŽöÎã¯ð˜< fL}¾\0)ºk?','2020-05-01 20:13:26','2020-05-01 14:47:49'),(14,'sdfkmsdklf','kfmldmgfe','sfnjljv','fkefmgkelr','N','Í\0\0xœ½\nÂ0…_E2IÒTÐÑAp±nRB57’b›p“Nâ»‡–Rl»ÝÃùá{×£³J}FÛÀ=0²»N9¥eœ²­È¥”74 %[;¥I6‘ã‰”ÌÄf&WQjóuì´Å¶ÆvßÒ“]âÛ/\'ð!|0Ñjß«„e÷t^žž—áÐXUê‹iá¿]b´Î`òÌ\"\ró‡<­,Fˆ}ì©Þàª‡ž','2020-05-01 20:19:43','2020-05-01 14:51:46'),(15,'fsdjflsdfs','dflwjlwef','dfjfjwejfe','fjwejfijwi','Y','U\0\0xœ}½\nÂ0Fß%s‘ü´(ŽnNíà&%Ts#Wlo¸I\'ñÝ-B:ˆfÿÎáð=E˜9P„ÖwLw¸&%ög¡¥–²‘Fiµ5;kí…¼U›à¼è+á \rø\0wœ<ñ8$¤é\'–wVÈêŸXg1Ä„‹Üav7H…“‘\0ŒäZÂÊu9¢^_—èBF³–3ÇeÙ¿ÞžJg´','2020-05-03 12:17:38','2020-05-03 06:47:38'),(16,'fjksklfsdjl','fjlklfsjkl','kldjclsdkfjskld','438573948','N','j\0\0xœ}Ð=Â0à¿\"™‹ä£YÛÁMJ¨æ\"Û—tÿ»ÑACæ{Ÿ÷Ž{°°PÀë	opI‚mNLrÉ¹æJ´Z´Êc!þÖˆu°Ž5ÿ‰3ypßñW»œlhØÇîg‡4Éã\\Üñn…ˆÉgv»Ø+¤ŠV€<ÚÎýÚ–èÏsdÅëÒáDH1£áù‹nU','2020-05-03 14:51:43','2020-05-03 09:23:42');
/*!40000 ALTER TABLE `dm_form_brief_assesment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_form_detailed_presentation`
--

DROP TABLE IF EXISTS `dm_form_detailed_presentation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_form_detailed_presentation` (
  `form_detailed_presentation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `uploads` text COMMENT 'Uploaded files name',
  `created_date_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Created time of this record',
  `updated_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last modified date of this record',
  PRIMARY KEY (`form_detailed_presentation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_form_detailed_presentation`
--

LOCK TABLES `dm_form_detailed_presentation` WRITE;
/*!40000 ALTER TABLE `dm_form_detailed_presentation` DISABLE KEYS */;
INSERT INTO `dm_form_detailed_presentation` VALUES (2,'\0\0xœ}Ï±\nÂ0€áw¹Y$¹¶\"ŽnNup	Å»È‰í…ô:‰ï® qpÈúÃ7üOHKN:sYï|5»3 CçÚÆùm‡~B ¶AL¡[\'ŠpYA)‡)jê²-’g“`Ú/tc««¦¨ÄY”úx’‘ëäo\rëÎÝë\r>V¯','2020-04-30 18:52:16','2020-04-30 13:22:16'),(3,'\0\0\0xœË+ÍÉ\0_¼','2020-05-01 20:40:27','2020-05-01 15:10:27'),(4,'Û\0\0\0xœ}Ž1Â0FÿŠdI‹âè ¸´nRBñ.±½p¹Nâ7ºTp}ïûà½M\Z%q¦&\\„ŸtWg7¬­¬»ÝÁÞ{¤]|z·IL»639¥ï4ò0=k^\nÎÓ„²Æb#>H—:‘DÆ&\\cO?nQÿ«ª¹ŠDXr·Ÿ/qGÝ','2020-05-01 20:47:28','2020-05-01 15:17:28'),(5,'Û\0\0\0xœ}Ž1Â0FÿŠÜ,’âè ¸X7)¡x‰Ø^¸\\\'ñ¿›]*¸¾÷}ðÞGÉ\\¨‰á\'ÝÕÂþÎ8c¼±ÎlwÎ‡´K/Â`7#´k˜Éiˆ,}§‰‡éyæÕ±â2M¨hª†ð0âƒt©3Iblâ5õôãUî•Ÿ«H„¥ÔqûùÅGÙ','2020-05-01 20:48:25','2020-05-01 15:18:25'),(6,'þ\0\0xœ1Â0…ÿŠdI®­ƒ£ƒàbÜ¤„j.±M¸¤“øßM‡–R[\n.á¸{ùÞã½™kÈY¹>“}â=¶»2àÀyÆÄ\'ÙJ)odPK±qJ³õð,D{VJóB5¥\0HÅšu›c­-Ue0¶n­Ovuˆk!ƒqž}0ƒjß¨†k>r²9é,’±*×Sá?YÓ4*&Kïÿe‹½O(FÞYß‘%\r‹ÏÕû˜û','2020-05-01 20:50:36','2020-05-01 15:22:24'),(7,' \0\0xœ}Ï1‚0àÿÒÙ˜¶PG7\'Øiˆw5g„k®e2üwXÊàÐõå}É{?‰œ°á¾²Q×§²ÚjítcZçìÅ{˜Gú\"xsŽÔpR%¹Ïe\Z3ñ\\—¶HL™v€p[à¹®š¢\"\n1t¡§	ë¤=Èß5[wî(Â’öò°ndXZ³','2020-05-03 14:55:26','2020-05-03 09:25:26');
/*!40000 ALTER TABLE `dm_form_detailed_presentation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_form_details`
--

DROP TABLE IF EXISTS `dm_form_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_form_details` (
  `form_details_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `form_name` varchar(100) DEFAULT '' COMMENT 'Available forms in applications',
  `order_by` int(11) DEFAULT '0' COMMENT 'Order by of the form name to corresponding applications',
  PRIMARY KEY (`form_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_form_details`
--

LOCK TABLES `dm_form_details` WRITE;
/*!40000 ALTER TABLE `dm_form_details` DISABLE KEYS */;
INSERT INTO `dm_form_details` VALUES (1,'First Contact',1),(2,'Brief Assesment',2),(3,'Detailed Presentation',3),(4,'Final Approval',4);
/*!40000 ALTER TABLE `dm_form_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_form_first_contact`
--

DROP TABLE IF EXISTS `dm_form_first_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_form_first_contact` (
  `form_first_contact_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `first_name` varchar(25) DEFAULT '' COMMENT 'First name of the product user',
  `last_name` varchar(25) DEFAULT '' COMMENT 'Last name of the product user',
  `email_id` varchar(100) DEFAULT '' COMMENT 'Email id of the product user',
  `organization_name` varchar(255) DEFAULT '' COMMENT 'Organization name of the product user',
  `org_details` varchar(255) DEFAULT '' COMMENT 'Organization details of the product user',
  `sign_up_for_emails` enum('Y','N') DEFAULT 'Y' COMMENT 'Active and inactive for this record',
  `r_source_id` varchar(500) DEFAULT '' COMMENT 'This field data refer from dm_source table primary key',
  `brief_idea` text COMMENT 'Short idea of product user view',
  `explained_idea` text COMMENT 'Described idea of product user view',
  `about_group` text COMMENT 'About group of product user',
  `created_date_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Created time of this record',
  `updated_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last modified date of this record',
  PRIMARY KEY (`form_first_contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_form_first_contact`
--

LOCK TABLES `dm_form_first_contact` WRITE;
/*!40000 ALTER TABLE `dm_form_first_contact` DISABLE KEYS */;
INSERT INTO `dm_form_first_contact` VALUES (9,'wer;klekrfwefwer','rlwejrllrjwle','kdfrklflerfk','ewfwerlmflkermklf','gdfgdfgdf','Y','Š\0\0\0xœEŒÁ\rÀ wÉ»t*‚@\"ÅA<ªî^>¥?ûÎòM\'zèlt¦PÁq:ÝÆŠl<ùBqÞ½!âÛj«¥ýzªEM¢ÃófJ¦}õÌ¶ˆžLÁ0³','dsfjsklfkldskl','ekfwfwelflwekfl','kdkflweflmwklfmwe','2020-04-30 15:50:39','2020-04-30 10:22:41'),(10,'jfuirfiefeuiferjuf','jwejufjerufjuer','ilfjoerjfejfe','fdjoeuijfjfure','djweufjerufjuiergr','Y','‹\0\0\0xœEŒKÀ DïÂº\'èmhÀh\"b\0ã¢éÝëJw3o>/4žÞ±³Á°:_À$p‡%]|ãÉ—àí»±;Ò)h«¥|ª‘&Ñy3ÁRÉ´ŸMd¶uðýy¡0þ','jglkjlffjejefjeri','jerkljfejrfler','jtejewfuefjuer','2020-04-30 17:59:33','2020-04-30 12:29:33'),(11,'ksdmsdfklmfklm','idiwedfwe','we;orkwepofke','kowefkro','kferkfgerijger','Y','Œ\0\0\0xœEŒÍ\rÀ FwáÜ	º\r\rMDØxhº{{ÂÛû~¼ÂÐØá,Øƒ`’äH^|E›œÚœ#vAGocçK´ˆÞ³¦\'Ø:¹ÚÞÌÊþ_\0¼¤11I','Sample document','Hi Value os','ijfsdkflsk','2020-05-01 16:03:09','2020-05-03 06:45:13'),(12,'fksdkfmdklmdfklvmd','fksdgdfjlgdflgdfl','sdjkfnsjk','svfmsdgmkldf','kfvsdmklfgi','Y','\0\0\0xœEŒ;€ Dï’ÚØz”e`Â$0Žw—*vûö÷PÅÔæ\Z„öà²b#øbZ‹šž85u7ªó«Ðe,æšSýãÉâ9=šW\\Ê^¸Ù¤GÈ: #âºéý\0@&2‘','dfokgierjkpier','fgepogjeprogjpopfower','drgksdfmsdklfmsdklmfds','2020-05-01 16:11:54','2020-05-01 10:41:54'),(13,'SatheesKumar','Neeliyappan','satheesn@gmail.com','Testing','Testing','Y','˜\0\0\0xœEŒ±\rÃ0W1X{Õ™ Ðà; ‰ICEÝ£&Jwÿø75ïÜa”N.Ž •RØ=Ñ«/=px¬Ü\rî,þÛj+¹ýë¡&zV½ãZ®r.bÚ—Ð¸`óž`™´=òôù=5ù','','','','2020-05-01 17:09:32','2020-05-01 11:39:32'),(14,'dfjslfsd','djkwenjwkendw','eiljflwejfer','riwekfwikefw','kjfkwefmlfmwl','Y','Š\0\0\0xœEŒÁ\rÀ wÉ»t*‚@\"ÅA<ªî^>¥?ûÎòM\'zèlt¦PÁq:ÝÆŠl<ùBqÞ½!âÛj«¥ýzªEM¢ÃófJ¦}õÌ¶ˆžLÁ0³','','','','2020-05-01 17:20:45','2020-05-01 11:50:45'),(15,'SatheesKumar','Neeliyappan','sathees@gmail.com','Testing','Testing','Y','’\0\0\0xœEŒA€ ÿ²g_àÕ— !Kv!Œ—‹xkgšÞ”Ñµ˜¡Õ™¨X6ÑZ¥¨I\'îØ5TÌ^ªÆê·åCþug±ì·ê\'K&D+\\&àê!ã6ã\nù¤çá3Ï','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen Test.','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable Test.','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Test.','2020-05-01 17:37:14','2020-05-01 12:07:14'),(16,'SatheesKumar','Neeliyappan','nsathees@gmail.com','Testing','Testing','Y','Š\0\0\0xœEŒÍ\rÀ FwáÜ	Ü†FŒ&\"0šî^/ÕÛ÷ûh4­c\'…°\Z]@‘!¸Ž%mÇ“n+NÛw%3Œg ­–vú)\Z%±Ï?Ž±Ô¨ÒÏÅ3é\"\0¼JU0³','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC.','2020-05-01 17:50:51','2020-05-01 12:20:51'),(17,'ekrwrwelr','efnlwerfnm','kfklmerfr','kfgmerklfmkler','fkmkfwkler','Y','Š\0\0\0xœEŒÁ\rÀ wÉ»t*‚@\"ÅA<ªî^>¥?ûÎòM\'zèlt¦PÁq:ÝÆŠl<ùBqÞ½!âÛj«¥ýzªEM¢ÃófJ¦}õÌ¶ˆžLÁ0³','dkskdjaklskld','dkemdklwem','kfw;klefwer','2020-05-01 19:32:16','2020-05-01 14:02:16'),(18,'efkdwklefwkl','ffsdkflslfskl','d;kmkfmklmf','kfmsklmfklsd','fkfkkfsdklsdfkfskd','Y','\0\0\0xœEŒA€ ÿ²g_ÀÕ— ”@–ìB8ÿ.ñÖÎ4½©`hµBÆÛ¤Ø.“iÒgÔ¬\ZV¯UëôÛrI±üz°8ö™{‹e“®pù@{ÀyÑóF?2‘','fsdhfjsdjhsdjkfsdjkl','fkoweokfkefokfre','fowkropfkeprokfwepo','2020-05-03 14:46:40','2020-05-03 09:16:40');
/*!40000 ALTER TABLE `dm_form_first_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_gised_form`
--

DROP TABLE IF EXISTS `dm_gised_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_gised_form` (
  `gised_form_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'This tables primary key',
  `r_user_id` int(11) DEFAULT '0' COMMENT 'This key primary key for dm_user table',
  `r_status_id` int(11) DEFAULT '0' COMMENT 'This key primary key for dm_status table',
  `status` enum('Y','N','C') DEFAULT 'Y',
  PRIMARY KEY (`gised_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_gised_form`
--

LOCK TABLES `dm_gised_form` WRITE;
/*!40000 ALTER TABLE `dm_gised_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_gised_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_password`
--

DROP TABLE IF EXISTS `dm_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_password` (
  `password_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `login_password` varchar(255) DEFAULT '',
  PRIMARY KEY (`password_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_password`
--

LOCK TABLES `dm_password` WRITE;
/*!40000 ALTER TABLE `dm_password` DISABLE KEYS */;
INSERT INTO `dm_password` VALUES (1,'Ë+¯åy1…aé’ÂH'),(2,'Ë+¯åy1…aé’ÂH'),(9,'Ûç­e7En ãålïýŽ@'),(10,''),(11,'Ë+¯åy1…aé’ÂH'),(12,'Ë+¯åy1…aé’ÂH'),(13,'pÜX£0UMÏ¥aÙâ¸'),(14,'Ë+¯åy1…aé’ÂH');
/*!40000 ALTER TABLE `dm_password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_set_password`
--

DROP TABLE IF EXISTS `dm_set_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_set_password` (
  `set_password_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `r_user_id` int(11) DEFAULT '0' COMMENT 'This field data refer from dm_user table primary key',
  `link` varchar(255) DEFAULT NULL COMMENT 'Encrypted link generation for set password',
  `status` enum('Y','N') DEFAULT 'Y' COMMENT 'Active and inactive for this record',
  `created_date_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Created time of this record',
  `updated_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last modified date of this record',
  PRIMARY KEY (`set_password_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_set_password`
--

LOCK TABLES `dm_set_password` WRITE;
/*!40000 ALTER TABLE `dm_set_password` DISABLE KEYS */;
INSERT INTO `dm_set_password` VALUES (28,14,'MTR8fHxuc2F0aGVlcy55MmtAZ21haWwuY29tfHx8MjAyMC0wNS0wMiAxNToyNzozNQ==','N','2020-05-02 15:27:35','2020-05-02 10:10:43');
/*!40000 ALTER TABLE `dm_set_password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_source`
--

DROP TABLE IF EXISTS `dm_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_source` (
  `source_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `source_name` varchar(50) NOT NULL COMMENT 'This field is refers knowledge of source about this product',
  PRIMARY KEY (`source_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_source`
--

LOCK TABLES `dm_source` WRITE;
/*!40000 ALTER TABLE `dm_source` DISABLE KEYS */;
INSERT INTO `dm_source` VALUES (1,'Newspaper'),(2,'EDM'),(3,'SMS'),(4,'Website'),(5,'Press Ads'),(6,'Online'),(7,'Word of mouth'),(8,'Maildrop');
/*!40000 ALTER TABLE `dm_source` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_status`
--

DROP TABLE IF EXISTS `dm_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `status_code` varchar(5) NOT NULL COMMENT 'This field used to product each form status Ex. A',
  `status_value` varchar(30) NOT NULL COMMENT 'This field is explanation of status code Ex. Approved',
  `description` varchar(100) NOT NULL COMMENT 'This field is use of this record',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_status`
--

LOCK TABLES `dm_status` WRITE;
/*!40000 ALTER TABLE `dm_status` DISABLE KEYS */;
INSERT INTO `dm_status` VALUES (1,'A','Approved','Approved from the admin'),(2,'AA','Awaiting Approval','Not approved. Waiting for the admin Approval'),(3,'D','Form in Draft','The form stored by given values'),(4,'H','Hold','Form viewed by admin. Admin awaiting for something in form'),(5,'SA','Sanctioned','All approval process completed'),(6,'R','Rejected','Rejected from the admin');
/*!40000 ALTER TABLE `dm_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_user`
--

DROP TABLE IF EXISTS `dm_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `email_id` varchar(75) DEFAULT '' COMMENT 'Email id of the product user',
  `mobile_no` varchar(15) DEFAULT '' COMMENT 'Mobile no of the product user',
  `title` varchar(5) DEFAULT '' COMMENT 'Title of the product user',
  `first_name` varchar(50) DEFAULT '' COMMENT 'First name of the product user',
  `last_name` varchar(50) DEFAULT '' COMMENT 'Last name of the product user',
  `gender` varchar(10) DEFAULT '' COMMENT 'Gender of the product user',
  `age` varchar(3) DEFAULT '' COMMENT 'Age of the product user',
  `communication_address` varchar(255) DEFAULT NULL COMMENT 'Communication address of the product user',
  `permanent_address` varchar(255) DEFAULT NULL COMMENT 'Permanent address of the product user',
  `activation_status` enum('Y','N') DEFAULT 'Y' COMMENT 'Active and inactive for this record',
  `r_state_id` int(11) DEFAULT '0' COMMENT 'This field data refer from core_state_details table primary key',
  `r_country_id` int(11) DEFAULT '0' COMMENT 'This field data refer from core_country_details table primary key',
  `created_date_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Created time of this record',
  `updated_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last modified date of this record',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_user`
--

LOCK TABLES `dm_user` WRITE;
/*!40000 ALTER TABLE `dm_user` DISABLE KEYS */;
INSERT INTO `dm_user` VALUES (1,'sathees@gmail.com','9999999999','Mr','SatheesKumar','N','Male','30','Guindy, Chennai','Porur, Chennai','Y',1,1,'2020-04-16 09:39:56','2020-04-19 04:04:13'),(2,'bala@gmail.com','9999999999','Mr','Bala','Murugan','Male','30','Sidapet, Chennai','Taramani, Chennai','Y',1,1,'2020-04-16 09:39:56','2020-04-17 10:45:06'),(12,'priya@gmail.com','9551692216','Ms','Priya','','Female','23','','','',6,2,'0000-00-00 00:00:00','2020-05-01 11:36:36'),(14,'nsathees.y2k@gmail.com','9566956123','Mr','SatheesKumar','','Male','30','','','',1,2,'0000-00-00 00:00:00','2020-04-24 04:16:31'),(15,'nsatheeskumar.www@gmail.com','9566956123','Mr','Gised','Admin','Male','30','','','',1,2,'0000-00-00 00:00:00','2020-04-24 04:16:31');
/*!40000 ALTER TABLE `dm_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fact_status_tracking_details`
--

DROP TABLE IF EXISTS `fact_status_tracking_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fact_status_tracking_details` (
  `status_tracking_details_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `r_gised_id` int(11) DEFAULT '0',
  `r_user_id` int(11) DEFAULT '0',
  `r_application_details_id` int(11) DEFAULT '0' COMMENT 'This field data refer from dm_application_details table primary key',
  `r_form_details_id` int(11) DEFAULT '0' COMMENT 'This field data refer from dm_form_details table primary key',
  `r_form_id` int(11) DEFAULT '0' COMMENT 'This field data refer from primary key of any one of the following table dm_form_first_contact,dm_form_brief_assesment,dm_form_detailed_presentation',
  `r_status_id` int(11) DEFAULT '0' COMMENT 'This field data refer from dm_status table primary key',
  `approval_by` int(11) DEFAULT '0' COMMENT 'This field data refer from dm_user table primary key',
  `status` char(1) DEFAULT 'Y',
  `created_date_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Created date of this record',
  `update_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last modified date of this record',
  PRIMARY KEY (`status_tracking_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fact_status_tracking_details`
--

LOCK TABLES `fact_status_tracking_details` WRITE;
/*!40000 ALTER TABLE `fact_status_tracking_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `fact_status_tracking_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fact_user`
--

DROP TABLE IF EXISTS `fact_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fact_user` (
  `fact_user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto increment for this table',
  `r_user_id` int(11) DEFAULT '0' COMMENT 'This field data refer from dm_user table primary key',
  `r_password_id` int(11) DEFAULT '0' COMMENT 'This field data refer from dm_password table primary key',
  `r_user_type_id` int(11) DEFAULT '0' COMMENT 'This field data refer from core_user_type table primary key',
  PRIMARY KEY (`fact_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fact_user`
--

LOCK TABLES `fact_user` WRITE;
/*!40000 ALTER TABLE `fact_user` DISABLE KEYS */;
INSERT INTO `fact_user` VALUES (1,1,1,2),(2,2,2,1),(8,10,9,2),(9,1,10,2),(10,12,11,2),(12,14,13,2),(13,15,14,1);
/*!40000 ALTER TABLE `fact_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-04 10:30:11
