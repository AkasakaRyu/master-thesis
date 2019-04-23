# ************************************************************
# Sequel Pro SQL dump
# Version 5438
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.3.14-MariaDB)
# Database: inventori
# Generation Time: 2019-04-18 00:21:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ak_data_bill_of_materials
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_bill_of_materials`;

CREATE TABLE `ak_data_bill_of_materials` (
  `bom_id` char(20) NOT NULL DEFAULT '',
  `bom_items_id` char(20) NOT NULL DEFAULT '',
  `bom_qty` int(11) NOT NULL DEFAULT 0,
  `bom_description` text DEFAULT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`bom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_bill_of_materials` WRITE;
/*!40000 ALTER TABLE `ak_data_bill_of_materials` DISABLE KEYS */;

INSERT INTO `ak_data_bill_of_materials` (`bom_id`, `bom_items_id`, `bom_qty`, `bom_description`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('BOM0001','PRT1904160001',0,'-','Master','2019-04-18 04:11:06',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_bill_of_materials` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `insert_bom` AFTER INSERT ON `ak_data_bill_of_materials` FOR EACH ROW INSERT INTO `ak_data_parts_stock_in`
	(`bom_id`,`parts_id`,`parts_qty_in`,`stock_type`,`parts_stock_date`,`created_by`)
	VALUES (NEW.`bom_id`,NEW.`bom_items_id`,NEW.`bom_qty`,'Bill of Material',current_timestamp(),NEW.`created_by`) */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table ak_data_bill_of_materials_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_bill_of_materials_details`;

CREATE TABLE `ak_data_bill_of_materials_details` (
  `bom_details_id` char(20) NOT NULL DEFAULT '',
  `bom_id` char(20) NOT NULL DEFAULT '',
  `items_id` char(20) NOT NULL DEFAULT '',
  `unit_id` char(20) NOT NULL DEFAULT '',
  `items_type` enum('Mesin','Material','Parts') DEFAULT NULL,
  `bom_qty` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`bom_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_bill_of_materials_details` WRITE;
/*!40000 ALTER TABLE `ak_data_bill_of_materials_details` DISABLE KEYS */;

INSERT INTO `ak_data_bill_of_materials_details` (`bom_details_id`, `bom_id`, `items_id`, `unit_id`, `items_type`, `bom_qty`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('POD1904180001','BOM0001','MAT1904170002','UNI1904170003','Material',1,'Master','2019-04-18 03:57:10',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_bill_of_materials_details` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `insert_bom_details` AFTER INSERT ON `ak_data_bill_of_materials_details` FOR EACH ROW IF (NEW.`items_type`="Mesin") THEN
	INSERT INTO `ak_data_machine_stock_out`
	(`bom_details_id`,`machine_id`,`machine_qty_out`,`stock_type`,`machine_stock_date`,`created_by`)
	VALUES (NEW.`bom_details_id`,NEW.`items_id`,NEW.`bom_qty`,'Bill of Material',current_timestamp(),NEW.`created_by`);
ELSEIF (NEW.`items_type`="Material") THEN
	INSERT INTO `ak_data_material_stock_out`
	(`bom_details_id`,`material_id`,`material_qty_out`,`stock_type`,`material_stock_date`,`created_by`)
	VALUES (NEW.`bom_details_id`,NEW.`items_id`,NEW.`bom_qty`,'Bill of Material',current_timestamp(),NEW.`created_by`);
ELSEIF (NEW.`items_type`="Parts") THEN
	INSERT INTO `ak_data_parts_stock_out`
	(`bom_details_id`,`parts_id`,`parts_qty_out`,`stock_type`,`parts_stock_date`,`created_by`)
	VALUES (NEW.`bom_details_id`,NEW.`items_id`,NEW.`bom_qty`,'Bill of Material',current_timestamp(),NEW.`created_by`);
END IF */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `delete_bom_details` BEFORE DELETE ON `ak_data_bill_of_materials_details` FOR EACH ROW BEGIN
    DECLARE items char(20);
    
    SELECT DISTINCTROW SUBSTRING(items_id,1,3) INTO items 
    FROM ak_data_bill_of_materials_details
    WHERE items_id=OLD.items_id;
    
    IF (items="MAT")
    THEN
    	DELETE FROM ak_data_material_stock_out
    	WHERE material_id=OLD.items_id
    	AND bom_details_id=OLD.bom_details_id;
    ELSEIF (items="WAR")
    THEN
    	DELETE FROM ak_data_machine_stock_out
    	WHERE machine_id=OLD.items_id
    	AND bom_details_id=OLD.bom_details_id;
    ELSEIF (items="PRT")
    THEN
    	DELETE FROM ak_data_parts_stock_out
    	WHERE parts_id=OLD.items_id
    	AND bom_details_id=OLD.bom_details_id;
    END IF;
END */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table ak_data_customs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_customs`;

CREATE TABLE `ak_data_customs` (
  `customs_id` char(20) NOT NULL DEFAULT '',
  `customs_kode_id` char(20) NOT NULL DEFAULT '',
  `distribution_id` char(20) NOT NULL DEFAULT '',
  `customs_document_id` char(20) NOT NULL DEFAULT '',
  `customs_document_number` varchar(128) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`customs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table ak_data_distribution
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_distribution`;

CREATE TABLE `ak_data_distribution` (
  `distribution_id` char(20) NOT NULL DEFAULT '',
  `comrec_id` char(20) NOT NULL DEFAULT '',
  `distribution_type` enum('Penerimaan','Pengiriman') DEFAULT NULL,
  `distribution_date` date NOT NULL,
  `distribution_description` text DEFAULT NULL,
  `distribution_grandtotal` decimal(50,0) NOT NULL DEFAULT 0,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`distribution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_distribution` WRITE;
/*!40000 ALTER TABLE `ak_data_distribution` DISABLE KEYS */;

INSERT INTO `ak_data_distribution` (`distribution_id`, `comrec_id`, `distribution_type`, `distribution_date`, `distribution_description`, `distribution_grandtotal`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('DIST0001','COM1904160001','Penerimaan','2019-04-18','-',0,'Master','2019-04-18 03:15:00',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_distribution` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_karyawan_department
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_karyawan_department`;

CREATE TABLE `ak_data_karyawan_department` (
  `departement_id` char(20) NOT NULL DEFAULT '',
  `departement_name` varchar(128) NOT NULL DEFAULT '',
  `departemen_description` text DEFAULT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) NOT NULL DEFAULT '',
  `last_update` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`departement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table ak_data_karyawan_divisi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_karyawan_divisi`;

CREATE TABLE `ak_data_karyawan_divisi` (
  `divisi_id` char(20) NOT NULL DEFAULT '',
  `departement_id` char(20) NOT NULL DEFAULT '',
  `divisi_nama` varchar(128) NOT NULL DEFAULT '',
  `divisi_description` text DEFAULT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`divisi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table ak_data_machine
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_machine`;

CREATE TABLE `ak_data_machine` (
  `machine_id` char(20) NOT NULL DEFAULT '',
  `machine_type_id` char(20) NOT NULL DEFAULT '',
  `specification_id` char(20) NOT NULL DEFAULT '',
  `unit_id` char(20) NOT NULL DEFAULT '',
  `machine_number` varchar(128) NOT NULL DEFAULT '',
  `machine_name` varchar(128) NOT NULL DEFAULT '',
  `machine_brand` varchar(128) NOT NULL DEFAULT '',
  `machine_desc` text DEFAULT NULL,
  `machine_stock` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`machine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_machine` WRITE;
/*!40000 ALTER TABLE `ak_data_machine` DISABLE KEYS */;

INSERT INTO `ak_data_machine` (`machine_id`, `machine_type_id`, `specification_id`, `unit_id`, `machine_number`, `machine_name`, `machine_brand`, `machine_desc`, `machine_stock`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('WAR1904160001','SPEC1904160002','SPEC1904160001','UNI1904160001','1234','Mesin 1','Yamahmud','-',357,'Master','2019-04-16 05:24:46','Master','2019-04-16 05:25:49',0),
	('WAR1904160002','SPEC1904160002','SPEC1904160002','UNI1904160001','5678','ABCDEF','ABC','-',0,'Master','2019-04-16 05:26:11','Master','2019-04-16 05:26:16',1);

/*!40000 ALTER TABLE `ak_data_machine` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_machine_specification
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_machine_specification`;

CREATE TABLE `ak_data_machine_specification` (
  `specification_id` char(20) NOT NULL DEFAULT '',
  `specification_name` varchar(128) NOT NULL DEFAULT '',
  `specification_desc` text NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL,
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`specification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_machine_specification` WRITE;
/*!40000 ALTER TABLE `ak_data_machine_specification` DISABLE KEYS */;

INSERT INTO `ak_data_machine_specification` (`specification_id`, `specification_name`, `specification_desc`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('SPEC1904160001','250cc','-','Master','0000-00-00 00:00:00',NULL,NULL,0),
	('SPEC1904160002','Test','-','Master','0000-00-00 00:00:00','Master','2019-04-16 05:08:56',0),
	('SPEC1904170003','Berat','Berat Mesin','Master','0000-00-00 00:00:00',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_machine_specification` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_machine_stock_in
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_machine_stock_in`;

CREATE TABLE `ak_data_machine_stock_in` (
  `machine_stock_in_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_details_id` char(20) NOT NULL DEFAULT '',
  `machine_id` char(20) NOT NULL DEFAULT '',
  `machine_stock_date` date NOT NULL,
  `machine_qty_in` int(11) NOT NULL DEFAULT 0,
  `stock_type` varchar(128) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`machine_stock_in_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `insert_stock_machine_in` AFTER INSERT ON `ak_data_machine_stock_in` FOR EACH ROW UPDATE `ak_data_machine`
SET `machine_stock` = `machine_stock`+NEW.`machine_qty_in`
WHERE `machine_id`=NEW.`machine_id` */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `delete_stock_machine_in` BEFORE DELETE ON `ak_data_machine_stock_in` FOR EACH ROW UPDATE `ak_data_machine`
SET `machine_stock` = `machine_stock`+OLD.`machine_qty_in`
WHERE `machine_id`=OLD.`machine_id` */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table ak_data_machine_stock_out
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_machine_stock_out`;

CREATE TABLE `ak_data_machine_stock_out` (
  `machine_stock_out_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_details_id` char(20) DEFAULT NULL,
  `bom_details_id` char(20) DEFAULT NULL,
  `machine_id` char(20) NOT NULL DEFAULT '',
  `machine_stock_date` date NOT NULL,
  `machine_qty_out` int(11) NOT NULL DEFAULT 0,
  `stock_type` varchar(128) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`machine_stock_out_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_machine_stock_out` WRITE;
/*!40000 ALTER TABLE `ak_data_machine_stock_out` DISABLE KEYS */;

INSERT INTO `ak_data_machine_stock_out` (`machine_stock_out_id`, `order_details_id`, `bom_details_id`, `machine_id`, `machine_stock_date`, `machine_qty_out`, `stock_type`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	(1,'POD1904180004',NULL,'WAR1904160001','2019-04-18',10,'','Master','2019-04-18 00:34:24',NULL,NULL,0),
	(2,'POD1904180007',NULL,'WAR1904160001','0000-00-00',12,'Sales Order','Master','2019-04-18 01:45:32',NULL,NULL,0),
	(3,'POD1904180008',NULL,'WAR1904160001','2019-04-18',1,'Sales Order','Master','2019-04-18 01:48:01',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_machine_stock_out` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `insert_stock_machine_out` AFTER INSERT ON `ak_data_machine_stock_out` FOR EACH ROW UPDATE `ak_data_machine`
SET `machine_stock` = `machine_stock`-NEW.`machine_qty_out`
WHERE `machine_id`=NEW.`machine_id` */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `delete_stock_machine_out` BEFORE DELETE ON `ak_data_machine_stock_out` FOR EACH ROW UPDATE `ak_data_machine`
SET `machine_stock` = `machine_stock`+OLD.`machine_qty_out`
WHERE `machine_id`=OLD.`machine_id` */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table ak_data_machine_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_machine_type`;

CREATE TABLE `ak_data_machine_type` (
  `machine_type_id` char(20) NOT NULL DEFAULT '',
  `machine_type_name` varchar(128) NOT NULL DEFAULT '',
  `machine_type_desc` text NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`machine_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_machine_type` WRITE;
/*!40000 ALTER TABLE `ak_data_machine_type` DISABLE KEYS */;

INSERT INTO `ak_data_machine_type` (`machine_type_id`, `machine_type_name`, `machine_type_desc`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('SPEC1904160001','Injeksi','-','Master','2019-04-16 05:23:08','Master','2019-04-16 05:24:02',1),
	('SPEC1904160002','Gear','-','Master','2019-04-16 05:23:59',NULL,NULL,0),
	('SPEC1904170003','XWA540','Mesin Giling','Master','2019-04-17 18:17:59',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_machine_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_master_color
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_master_color`;

CREATE TABLE `ak_data_master_color` (
  `color_id` char(20) NOT NULL DEFAULT '',
  `color_name` varchar(128) NOT NULL DEFAULT '',
  `color_desc` text NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_master_color` WRITE;
/*!40000 ALTER TABLE `ak_data_master_color` DISABLE KEYS */;

INSERT INTO `ak_data_master_color` (`color_id`, `color_name`, `color_desc`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('CLR1904160001','Hijau','Warna Hijau','Master','2019-04-16 03:42:14','Master','2019-04-16 03:42:19',0),
	('CLR1904160002','Biru','Warna Biru','Master','2019-04-16 03:42:34','Master','2019-04-16 03:42:37',1);

/*!40000 ALTER TABLE `ak_data_master_color` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_master_comrec
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_master_comrec`;

CREATE TABLE `ak_data_master_comrec` (
  `comrec_id` char(20) NOT NULL DEFAULT '',
  `comrec_name` varchar(128) NOT NULL DEFAULT '',
  `comrec_type` enum('Supplier','Customer','Internal') DEFAULT NULL,
  `comrec_address` text DEFAULT NULL,
  `comrec_city` varchar(128) DEFAULT NULL,
  `comrec_country` varchar(128) DEFAULT NULL,
  `comrec_postal_code` varchar(128) DEFAULT NULL,
  `comrec_office_phone` char(18) DEFAULT NULL,
  `comrec_contact_person` varchar(128) DEFAULT NULL,
  `comrec_desc` text DEFAULT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`comrec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_master_comrec` WRITE;
/*!40000 ALTER TABLE `ak_data_master_comrec` DISABLE KEYS */;

INSERT INTO `ak_data_master_comrec` (`comrec_id`, `comrec_name`, `comrec_type`, `comrec_address`, `comrec_city`, `comrec_country`, `comrec_postal_code`, `comrec_office_phone`, `comrec_contact_person`, `comrec_desc`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('COM1904160001','CV. ABCDEF','Supplier','Jl. Raya Banjaran No. 112 D','Bandung','Indonesia','40377','087710545682','1234','-','Master','2019-04-16 03:59:26','Master','2019-04-16 04:00:19',0),
	('COM1904160002','PT. GHIJKL','Customer','Jl. Raya Banjaran No, 112 D','Bandung','Indonesia','40377','087710545682','123','123','Master','2019-04-16 04:01:43',NULL,'0000-00-00 00:00:00',0),
	('COM1904160003','PT. MNOPQ','Internal','-','Bandung','Indonesia','40377','087710545682','-','-','Master','2019-04-16 04:02:15',NULL,'0000-00-00 00:00:00',0);

/*!40000 ALTER TABLE `ak_data_master_comrec` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_master_currency
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_master_currency`;

CREATE TABLE `ak_data_master_currency` (
  `currency_id` char(20) NOT NULL DEFAULT '',
  `currency_name` varchar(128) NOT NULL DEFAULT '',
  `currency_desc` text NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_master_currency` WRITE;
/*!40000 ALTER TABLE `ak_data_master_currency` DISABLE KEYS */;

INSERT INTO `ak_data_master_currency` (`currency_id`, `currency_name`, `currency_desc`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('WAR1904160001','IDR','Indonesia Dollar Rupiah (hehe)','Master','2019-04-16 04:09:59','0000-00-00 00:00:00','2019-04-16 04:10:52',0),
	('WAR1904160002','USD','US. Dollar','Master','2019-04-16 04:10:12',NULL,NULL,0),
	('WAR1904160003','JPY','Japan Yen','Master','2019-04-16 04:10:32',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_master_currency` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_master_unit
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_master_unit`;

CREATE TABLE `ak_data_master_unit` (
  `unit_id` char(20) NOT NULL DEFAULT '',
  `unit_name` varchar(128) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_master_unit` WRITE;
/*!40000 ALTER TABLE `ak_data_master_unit` DISABLE KEYS */;

INSERT INTO `ak_data_master_unit` (`unit_id`, `unit_name`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('UNI1904160001','Test 1','Master','2019-04-16 03:32:52','Master','2019-04-18 00:25:28',1),
	('UNI1904160002','Test 2','Master','2019-04-16 03:32:59','Master','2019-04-16 03:34:08',1),
	('UNI1904170003','KG','Master','2019-04-17 18:13:12',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_master_unit` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_master_warehouse
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_master_warehouse`;

CREATE TABLE `ak_data_master_warehouse` (
  `warehouse_id` char(20) NOT NULL DEFAULT '',
  `warehouse_name` varchar(128) NOT NULL DEFAULT '',
  `warehouse_desc` text DEFAULT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL,
  `updated` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_master_warehouse` WRITE;
/*!40000 ALTER TABLE `ak_data_master_warehouse` DISABLE KEYS */;

INSERT INTO `ak_data_master_warehouse` (`warehouse_id`, `warehouse_name`, `warehouse_desc`, `created_by`, `created_date`, `updated`, `last_update`, `deleted`)
VALUES
	('WAR1904160001','Warehouse 1','-','Master','0000-00-00 00:00:00',NULL,NULL,0),
	('WAR1904160002','Warehouse 2','-','Master','0000-00-00 00:00:00',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_master_warehouse` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_material
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_material`;

CREATE TABLE `ak_data_material` (
  `material_id` char(20) NOT NULL DEFAULT '',
  `material_type_id` char(20) NOT NULL DEFAULT '',
  `unit_id` char(20) NOT NULL DEFAULT '',
  `color_id` char(20) NOT NULL DEFAULT '',
  `material_name` varchar(128) NOT NULL DEFAULT '',
  `material_formula` varchar(128) NOT NULL DEFAULT '',
  `material_condition` varchar(128) NOT NULL DEFAULT '',
  `material_desc` text DEFAULT NULL,
  `material_stock` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_material` WRITE;
/*!40000 ALTER TABLE `ak_data_material` DISABLE KEYS */;

INSERT INTO `ak_data_material` (`material_id`, `material_type_id`, `unit_id`, `color_id`, `material_name`, `material_formula`, `material_condition`, `material_desc`, `material_stock`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('MAT1904160001','MTY1904160001','UNI1904160001','CLR1904160001','Test','-','-','-',0,'Master','2019-04-16 12:22:47','Master','2019-04-18 01:19:16',1),
	('MAT1904170002','MTY1904160001','UNI1904170003','CLR1904160001','Biji Plastik','DAA280','ORIGINAL','-',-13,'Master','2019-04-17 18:35:31',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_material` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_material_stock_in
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_material_stock_in`;

CREATE TABLE `ak_data_material_stock_in` (
  `material_stock_in_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_details_id` char(20) NOT NULL DEFAULT '',
  `material_id` char(20) NOT NULL DEFAULT '',
  `material_stock_date` date NOT NULL,
  `material_qty_in` int(11) NOT NULL DEFAULT 0,
  `stock_type` varchar(128) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`material_stock_in_id`),
  KEY `order_detail_id` (`order_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `insert_stock_material_in` AFTER INSERT ON `ak_data_material_stock_in` FOR EACH ROW UPDATE `ak_data_material`
SET `material_stock` = `material_stock`+NEW.`material_qty_in`
WHERE `material_id`=NEW.`material_id` */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `delete_stock_material_in` BEFORE DELETE ON `ak_data_material_stock_in` FOR EACH ROW UPDATE `ak_data_material`
SET `material_stock` = `material_stock`-OLD.`material_qty_in`
WHERE `material_id`=OLD.`material_id` */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table ak_data_material_stock_out
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_material_stock_out`;

CREATE TABLE `ak_data_material_stock_out` (
  `material_stock_out_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_details_id` char(20) DEFAULT NULL,
  `bom_details_id` char(20) DEFAULT NULL,
  `material_id` char(20) NOT NULL DEFAULT '',
  `material_stock_date` date NOT NULL,
  `material_qty_out` int(11) NOT NULL DEFAULT 0,
  `stock_type` varchar(128) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`material_stock_out_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_material_stock_out` WRITE;
/*!40000 ALTER TABLE `ak_data_material_stock_out` DISABLE KEYS */;

INSERT INTO `ak_data_material_stock_out` (`material_stock_out_id`, `order_details_id`, `bom_details_id`, `material_id`, `material_stock_date`, `material_qty_out`, `stock_type`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	(1,'POD1904180005',NULL,'MAT1904170002','2019-04-18',12,'','Master','2019-04-18 00:41:52',NULL,NULL,0),
	(2,NULL,'POD1904180001','MAT1904170002','2019-04-18',1,'Bill of Material','Master','2019-04-18 03:57:10',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_material_stock_out` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `insert_stock_material_out` AFTER INSERT ON `ak_data_material_stock_out` FOR EACH ROW UPDATE `ak_data_material`
SET `material_stock` = `material_stock`-NEW.`material_qty_out`
WHERE `material_id`=NEW.`material_id` */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `delete_stock_material_out` BEFORE DELETE ON `ak_data_material_stock_out` FOR EACH ROW UPDATE `ak_data_material`
SET `material_stock` = `material_stock`+OLD.`material_qty_out`
WHERE `material_id`=OLD.`material_id` */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table ak_data_material_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_material_type`;

CREATE TABLE `ak_data_material_type` (
  `material_type_id` char(20) NOT NULL DEFAULT '',
  `material_type_name` varchar(128) NOT NULL DEFAULT '',
  `material_type_desc` text NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`material_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_material_type` WRITE;
/*!40000 ALTER TABLE `ak_data_material_type` DISABLE KEYS */;

INSERT INTO `ak_data_material_type` (`material_type_id`, `material_type_name`, `material_type_desc`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('MTY1904160001','Gas','-','Master','2019-04-16 12:20:40','Master','2019-04-16 12:20:45',0);

/*!40000 ALTER TABLE `ak_data_material_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_parts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_parts`;

CREATE TABLE `ak_data_parts` (
  `parts_id` char(20) NOT NULL DEFAULT '',
  `color_id` char(20) NOT NULL DEFAULT '',
  `parts_type_id` char(20) NOT NULL DEFAULT '',
  `unit_id` char(20) NOT NULL DEFAULT '',
  `parts_number` varchar(128) NOT NULL DEFAULT '',
  `parts_name` varchar(128) NOT NULL DEFAULT '',
  `parts_model` varchar(128) NOT NULL DEFAULT '',
  `parts_desc` text DEFAULT NULL,
  `parts_stock` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`parts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_parts` WRITE;
/*!40000 ALTER TABLE `ak_data_parts` DISABLE KEYS */;

INSERT INTO `ak_data_parts` (`parts_id`, `color_id`, `parts_type_id`, `unit_id`, `parts_number`, `parts_name`, `parts_model`, `parts_desc`, `parts_stock`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('PRT1904160001','CLR1904160001','PTY1904160001','UNI1904160001','12345','Parts 1','-','-',106,'Master','2019-04-16 12:45:19',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_parts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_parts_stock_in
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_parts_stock_in`;

CREATE TABLE `ak_data_parts_stock_in` (
  `parts_stock_in_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_details_id` char(20) DEFAULT NULL,
  `bom_details_id` char(20) DEFAULT NULL,
  `bom_id` char(20) DEFAULT NULL,
  `parts_id` char(20) NOT NULL DEFAULT '',
  `parts_stock_date` date NOT NULL,
  `parts_qty_in` int(11) NOT NULL DEFAULT 0,
  `stock_type` varchar(128) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`parts_stock_in_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_parts_stock_in` WRITE;
/*!40000 ALTER TABLE `ak_data_parts_stock_in` DISABLE KEYS */;

INSERT INTO `ak_data_parts_stock_in` (`parts_stock_in_id`, `order_details_id`, `bom_details_id`, `bom_id`, `parts_id`, `parts_stock_date`, `parts_qty_in`, `stock_type`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	(1,'POD1904180003',NULL,NULL,'PRT1904160001','2019-04-18',120,'','Master','2019-04-18 00:29:32',NULL,NULL,0),
	(2,NULL,NULL,'BOM0001','PRT1904160001','2019-04-18',0,'Bill of Material','Master','2019-04-18 04:11:06',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_parts_stock_in` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `insert_stock_parts_in` AFTER INSERT ON `ak_data_parts_stock_in` FOR EACH ROW UPDATE `ak_data_parts`
SET `parts_stock` = `parts_stock`+NEW.`parts_qty_in`
WHERE `parts_id`=NEW.`parts_id` */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `delete_stock_parts_in` BEFORE DELETE ON `ak_data_parts_stock_in` FOR EACH ROW UPDATE `ak_data_parts`
SET `parts_stock` = `parts_stock`-OLD.`parts_qty_in`
WHERE `parts_id`=OLD.`parts_id` */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table ak_data_parts_stock_out
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_parts_stock_out`;

CREATE TABLE `ak_data_parts_stock_out` (
  `parts_stock_out_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_details_id` char(20) DEFAULT NULL,
  `bom_details_id` char(20) DEFAULT NULL,
  `parts_id` char(20) NOT NULL DEFAULT '',
  `parts_stock_date` date NOT NULL,
  `parts_qty_out` int(11) NOT NULL DEFAULT 0,
  `stock_type` varchar(128) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`parts_stock_out_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_parts_stock_out` WRITE;
/*!40000 ALTER TABLE `ak_data_parts_stock_out` DISABLE KEYS */;

INSERT INTO `ak_data_parts_stock_out` (`parts_stock_out_id`, `order_details_id`, `bom_details_id`, `parts_id`, `parts_stock_date`, `parts_qty_out`, `stock_type`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	(1,'POD1904180006',NULL,'PRT1904160001','2019-04-18',14,'','Master','2019-04-18 00:42:53',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_parts_stock_out` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `insert_stock_parts_out` AFTER INSERT ON `ak_data_parts_stock_out` FOR EACH ROW UPDATE `ak_data_parts`
SET `parts_stock` = `parts_stock`-NEW.`parts_qty_out`
WHERE `parts_id`=NEW.`parts_id` */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `delete_stock_parts_out` BEFORE DELETE ON `ak_data_parts_stock_out` FOR EACH ROW UPDATE `ak_data_parts`
SET `parts_stock` = `parts_stock`+OLD.`parts_qty_out`
WHERE `parts_id`=OLD.`parts_id` */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table ak_data_parts_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_parts_type`;

CREATE TABLE `ak_data_parts_type` (
  `parts_type_id` char(20) NOT NULL DEFAULT '',
  `parts_type_name` varchar(128) NOT NULL DEFAULT '',
  `parts_type_desc` text NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`parts_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_parts_type` WRITE;
/*!40000 ALTER TABLE `ak_data_parts_type` DISABLE KEYS */;

INSERT INTO `ak_data_parts_type` (`parts_type_id`, `parts_type_name`, `parts_type_desc`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('PTY1904160001','Test','-','Master','2019-04-16 12:43:33',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_parts_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_scrap
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_scrap`;

CREATE TABLE `ak_data_scrap` (
  `scrap_id` char(20) NOT NULL DEFAULT '',
  `unit_id` char(20) NOT NULL DEFAULT '',
  `color_id` char(20) NOT NULL DEFAULT '',
  `comrec_id` char(20) NOT NULL DEFAULT '',
  `scrap_number` varchar(128) NOT NULL DEFAULT '',
  `scrap_name` varchar(128) NOT NULL DEFAULT '',
  `scrap_description` text DEFAULT NULL,
  `scrap_stock` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`scrap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table ak_data_sistem_app_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_sistem_app_info`;

CREATE TABLE `ak_data_sistem_app_info` (
  `app_info_id` char(20) NOT NULL DEFAULT '',
  `app_info_name` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`app_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ak_data_sistem_app_info` WRITE;
/*!40000 ALTER TABLE `ak_data_sistem_app_info` DISABLE KEYS */;

INSERT INTO `ak_data_sistem_app_info` (`app_info_id`, `app_info_name`)
VALUES
	('APP19011700001','Enterprise Resource Planing');

/*!40000 ALTER TABLE `ak_data_sistem_app_info` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_sistem_instansi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_sistem_instansi`;

CREATE TABLE `ak_data_sistem_instansi` (
  `instansi_id` char(20) NOT NULL DEFAULT '',
  `instansi_nama` varchar(128) NOT NULL DEFAULT '',
  `instansi_alamat` text DEFAULT NULL,
  `instansi_kontak` char(18) NOT NULL DEFAULT '',
  `instansi_logo` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`instansi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ak_data_sistem_instansi` WRITE;
/*!40000 ALTER TABLE `ak_data_sistem_instansi` DISABLE KEYS */;

INSERT INTO `ak_data_sistem_instansi` (`instansi_id`, `instansi_nama`, `instansi_alamat`, `instansi_kontak`, `instansi_logo`)
VALUES
	('INS19011700001','PT. JUAHN INDONESIA','Jl. Pangkalan 6 Desa, Ciketing Udik, Bantargebang, Kota Bekasi, Jawa Barat','08112400975',NULL);

/*!40000 ALTER TABLE `ak_data_sistem_instansi` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_sistem_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_sistem_log`;

CREATE TABLE `ak_data_sistem_log` (
  `id` varchar(128) NOT NULL DEFAULT '',
  `ip_address` varchar(45) NOT NULL DEFAULT '',
  `timestamp` int(10) unsigned NOT NULL,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ak_data_sistem_log` WRITE;
/*!40000 ALTER TABLE `ak_data_sistem_log` DISABLE KEYS */;

INSERT INTO `ak_data_sistem_log` (`id`, `ip_address`, `timestamp`, `data`)
VALUES
	('5nc2lsn5u53lmisnlhehpi2k2pnn65ck','::1',1555546796,X'5F5F63695F6C6173745F726567656E65726174657C693A313535353534363631303B6B6573656D706174616E7C693A313B69647C733A31343A225553523139303131373030303031223B6C6576656C7C733A363A224D6173746572223B6E616D617C733A363A224D6173746572223B6C6173745F6C6F67696E7C733A31393A22323031392D30342D31372031393A35343A3332223B637265617465645F646174657C733A31393A22323031392D30312D31372030393A34373A3231223B73697374656D5F6E616D657C733A32373A22456E7465727072697365205265736F7572636520506C616E696E67223B4C6F67676564496E7C623A313B'),
	('tr0j5o56cuov1d3n78vr5qbj06fu6lbq','::1',1555524927,X'5F5F63695F6C6173745F726567656E65726174657C693A313535353532343932373B6B6573656D706174616E7C693A313B69647C733A31343A225553523139303131373030303031223B6C6576656C7C733A363A224D6173746572223B6E616D617C733A363A224D6173746572223B6C6173745F6C6F67696E7C733A31393A22323031392D30342D31372031393A30303A3532223B637265617465645F646174657C733A31393A22323031392D30312D31372030393A34373A3231223B73697374656D5F6E616D657C733A32373A22456E7465727072697365205265736F7572636520506C616E696E67223B4C6F67676564496E7C623A313B');

/*!40000 ALTER TABLE `ak_data_sistem_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_transaction_post_order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_transaction_post_order`;

CREATE TABLE `ak_data_transaction_post_order` (
  `order_id` char(20) NOT NULL DEFAULT '',
  `comrec_id` char(20) NOT NULL DEFAULT '',
  `order_type` enum('Sales Order','Purchase Order') DEFAULT NULL,
  `order_date` date NOT NULL,
  `order_description` text DEFAULT NULL,
  `order_grandtotal` decimal(50,0) NOT NULL DEFAULT 0,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_transaction_post_order` WRITE;
/*!40000 ALTER TABLE `ak_data_transaction_post_order` DISABLE KEYS */;

INSERT INTO `ak_data_transaction_post_order` (`order_id`, `comrec_id`, `order_type`, `order_date`, `order_description`, `order_grandtotal`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('SALES0001','COM1904160001','Purchase Order','2019-04-18','PO 1',3241200,'Master','2019-04-18 00:33:26',NULL,NULL,0),
	('SALES0002','COM1904160001','Sales Order','2019-04-18','PO 2',2937980,'Master','2019-04-18 00:43:36',NULL,NULL,0),
	('SALES0003','COM1904160001','Sales Order','2019-04-18','PO 3',-719280,'Master','2019-04-18 01:45:37',NULL,NULL,0),
	('SALES0004','COM1904160001','Sales Order','2019-04-18','PO 4',-827280,'Master','2019-04-18 01:48:05',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_transaction_post_order` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_transaction_post_order_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_transaction_post_order_details`;

CREATE TABLE `ak_data_transaction_post_order_details` (
  `order_details_id` char(20) NOT NULL DEFAULT '',
  `order_id` char(20) NOT NULL DEFAULT '',
  `items_id` char(20) NOT NULL DEFAULT '',
  `unit_id` char(20) NOT NULL DEFAULT '',
  `order_type` enum('Sales Order','Purchase Order') DEFAULT NULL,
  `items_type` enum('Mesin','Material','Parts') DEFAULT NULL,
  `order_date` date NOT NULL,
  `order_qty` int(11) NOT NULL DEFAULT 0,
  `order_price` decimal(10,0) NOT NULL DEFAULT 0,
  `order_subtotal` decimal(10,0) NOT NULL DEFAULT 0,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_transaction_post_order_details` WRITE;
/*!40000 ALTER TABLE `ak_data_transaction_post_order_details` DISABLE KEYS */;

INSERT INTO `ak_data_transaction_post_order_details` (`order_details_id`, `order_id`, `items_id`, `unit_id`, `order_type`, `items_type`, `order_date`, `order_qty`, `order_price`, `order_subtotal`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('POD1904180003','SALES0001','PRT1904160001','UNI1904170003','Purchase Order','Parts','0000-00-00',120,28900,3468000,'Master','2019-04-18 00:29:32',NULL,NULL,0),
	('POD1904180004','SALES0002','WAR1904160001','UNI1904170003','Sales Order','Mesin','0000-00-00',10,120000,1200000,'Master','2019-04-18 00:34:24',NULL,NULL,0),
	('POD1904180006','SALES0002','PRT1904160001','UNI1904170003','Sales Order','Parts','0000-00-00',14,167890,2350460,'Master','2019-04-18 00:42:53',NULL,NULL,0),
	('POD1904180007','SALES0003','WAR1904160001','UNI1904170003','Sales Order','Mesin','0000-00-00',12,10000,120000,'Master','2019-04-18 01:45:32',NULL,NULL,0),
	('POD1904180008','SALES0004','WAR1904160001','UNI1904170003','Sales Order','Mesin','2019-04-18',1,12000,12000,'Master','2019-04-18 01:48:01',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_transaction_post_order_details` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `insert_po_detail` AFTER INSERT ON `ak_data_transaction_post_order_details` FOR EACH ROW IF (NEW.`order_type`="Purchase Order") THEN
	IF (NEW.`items_type`="Mesin") THEN
		INSERT INTO `ak_data_machine_stock_in`
		(`order_details_id`,`machine_id`,`machine_qty_in`,`stock_type`,`machine_stock_date`,`created_by`)
		VALUES (NEW.`order_details_id`,NEW.`items_id`,NEW.`order_qty`,'Purchase Order',NEW.`order_date`,NEW.`created_by`);
	ELSEIF (NEW.`items_type`="Material") THEN
		INSERT INTO `ak_data_material_stock_in`
		(`order_details_id`,`material_id`,`material_qty_in`,`stock_type`,`material_stock_date`,`created_by`)
		VALUES (NEW.`order_details_id`,NEW.`items_id`,NEW.`order_qty`,'Purchase Order',NEW.`order_date`,NEW.`created_by`);
	ELSEIF (NEW.`items_type`="Parts") THEN
		INSERT INTO `ak_data_parts_stock_in`
		(`order_details_id`,`parts_id`,`parts_qty_in`,`stock_type`,`parts_stock_date`,`created_by`)
		VALUES (NEW.`order_details_id`,NEW.`items_id`,NEW.`order_qty`,'Purchase Order',NEW.`order_date`,NEW.`created_by`);
	END IF;
ELSEIF (NEW.`order_type`="Sales Order") THEN
	IF (NEW.`items_type`="Mesin") THEN
		INSERT INTO `ak_data_machine_stock_out`
		(`order_details_id`,`machine_id`,`machine_qty_out`,`stock_type`,`machine_stock_date`,`created_by`)
		VALUES (NEW.`order_details_id`,NEW.`items_id`,NEW.`order_qty`,'Sales Order',NEW.`order_date`,NEW.`created_by`);
	ELSEIF (NEW.`items_type`="Material") THEN
		INSERT INTO `ak_data_material_stock_out`
		(`order_details_id`,`material_id`,`material_qty_out`,`stock_type`,`material_stock_date`,`created_by`)
		VALUES (NEW.`order_details_id`,NEW.`items_id`,NEW.`order_qty`,'Sales Order',NEW.`order_date`,NEW.`created_by`);
	ELSEIF (NEW.`items_type`="Parts") THEN
		INSERT INTO `ak_data_parts_stock_out`
		(`order_details_id`,`parts_id`,`parts_qty_out`,`stock_type`,`parts_stock_date`,`created_by`)
		VALUES (NEW.`order_details_id`,NEW.`items_id`,NEW.`order_qty`,'Sales Order',NEW.`order_date`,NEW.`created_by`);
	END IF;
END IF */;;
/*!50003 SET SESSION SQL_MODE="STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `delete_po_detail` BEFORE DELETE ON `ak_data_transaction_post_order_details` FOR EACH ROW BEGIN
    DECLARE items char(20);
    
    UPDATE ak_data_transaction_post_order
    SET order_grandtotal = order_grandtotal - OLD.order_subtotal;
    
    SELECT DISTINCTROW SUBSTRING(items_id,1,3) INTO items 
    FROM ak_data_transaction_post_order_details
    WHERE items_id=OLD.items_id;
    
    IF (items="MAT")
    THEN
    	DELETE FROM ak_data_material_stock_in
    	WHERE material_id=OLD.items_id
    	AND order_details_id=OLD.order_details_id;
    ELSEIF (items="WAR")
    THEN
    	DELETE FROM ak_data_machine_stock_in
    	WHERE machine_id=OLD.items_id
    	AND order_details_id=OLD.order_details_id;
    ELSEIF (items="PRT")
    THEN
    	DELETE FROM ak_data_parts_stock_in
    	WHERE parts_id=OLD.items_id
    	AND order_details_id=OLD.order_details_id;
    END IF;
END */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table ak_data_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_user`;

CREATE TABLE `ak_data_user` (
  `user_id` char(20) NOT NULL DEFAULT '',
  `level_id` char(20) NOT NULL DEFAULT '',
  `user_nama` varchar(128) NOT NULL DEFAULT '',
  `user_login` char(20) NOT NULL DEFAULT '',
  `user_pass` varchar(60) NOT NULL DEFAULT '',
  `last_login` datetime DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`),
  KEY `level_id` (`level_id`),
  CONSTRAINT `ak_data_user_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `ak_data_user_level` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_user` WRITE;
/*!40000 ALTER TABLE `ak_data_user` DISABLE KEYS */;

INSERT INTO `ak_data_user` (`user_id`, `level_id`, `user_nama`, `user_login`, `user_pass`, `last_login`, `created_date`, `deleted`)
VALUES
	('USR19011700001','LVL19011700001','Master','master','$2y$10$NHbq0Ggd9szyUcUJe.9OD.b5GcQ0HHU14GPJE6S.aX4SauqQhUo1K','2019-04-18 01:15:31','2019-01-17 09:47:21',0);

/*!40000 ALTER TABLE `ak_data_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_user_level
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_user_level`;

CREATE TABLE `ak_data_user_level` (
  `level_id` char(20) NOT NULL DEFAULT '',
  `level_nama` varchar(128) NOT NULL DEFAULT '',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_user_level` WRITE;
/*!40000 ALTER TABLE `ak_data_user_level` DISABLE KEYS */;

INSERT INTO `ak_data_user_level` (`level_id`, `level_nama`, `deleted`)
VALUES
	('LVL19011700001','Master',0);

/*!40000 ALTER TABLE `ak_data_user_level` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_vehicle
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_vehicle`;

CREATE TABLE `ak_data_vehicle` (
  `vehicle_id` char(20) NOT NULL DEFAULT '',
  `color_id` char(20) NOT NULL DEFAULT '',
  `vehicle_model_id` char(20) NOT NULL DEFAULT '',
  `vehicle_type_id` char(20) NOT NULL DEFAULT '',
  `vehicle_plate_number` char(10) NOT NULL DEFAULT '',
  `vehicle_name` varchar(128) NOT NULL DEFAULT '',
  `vehicle_brand` varchar(128) NOT NULL DEFAULT '',
  `vehicle_production_year` char(4) NOT NULL DEFAULT '',
  `vehicle_cylinder` char(4) NOT NULL DEFAULT '0000',
  `vehicle_chasis_number` varchar(128) NOT NULL DEFAULT '',
  `vehicle_machine_number` varchar(128) NOT NULL DEFAULT '',
  `vehicle_bpkb_number` varchar(128) NOT NULL DEFAULT '',
  `vehicle_owner` varchar(128) NOT NULL DEFAULT '',
  `vehicle_valid_date` date NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL,
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table ak_data_vehicle_model
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_vehicle_model`;

CREATE TABLE `ak_data_vehicle_model` (
  `vehicle_model_id` char(20) NOT NULL DEFAULT '',
  `vehicle_model_name` varchar(128) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`vehicle_model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table ak_data_vehicle_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_vehicle_type`;

CREATE TABLE `ak_data_vehicle_type` (
  `vehicle_type_id` char(20) NOT NULL DEFAULT '',
  `vehicle_type_name` varchar(128) NOT NULL DEFAULT '',
  `vehicle_type_desc` text NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`vehicle_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
