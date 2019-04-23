# ************************************************************
# Sequel Pro SQL dump
# Version 5438
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.3.14-MariaDB)
# Database: thesis
# Generation Time: 2019-04-14 21:55:10 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ak_data_master_dosen
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_master_dosen`;

CREATE TABLE `ak_data_master_dosen` (
  `dosen_id` char(20) NOT NULL DEFAULT '',
  `dosen_nip` int(11) NOT NULL,
  `dosen_nama` varchar(128) NOT NULL DEFAULT '',
  `dosen_email` varchar(128) NOT NULL DEFAULT '',
  `dosen_alamat` text DEFAULT NULL,
  `dosen_kontak` char(18) NOT NULL DEFAULT '',
  `dosen_kuota` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`dosen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_master_dosen` WRITE;
/*!40000 ALTER TABLE `ak_data_master_dosen` DISABLE KEYS */;

INSERT INTO `ak_data_master_dosen` (`dosen_id`, `dosen_nip`, `dosen_nama`, `dosen_email`, `dosen_alamat`, `dosen_kontak`, `dosen_kuota`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('DOS1904150001',1234,'Akasaka Ryuunosuke','akasakapratama@gmail.com','Jl. Sakurasou No. 4','087710545682',10,'Master','2019-04-15 01:43:45','Master','2019-04-15 02:10:00',0);

/*!40000 ALTER TABLE `ak_data_master_dosen` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_master_jadwal
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_master_jadwal`;

CREATE TABLE `ak_data_master_jadwal` (
  `jadwal_id` char(20) NOT NULL DEFAULT '',
  `mahasiswa_id` char(20) NOT NULL DEFAULT '',
  `dosen_id` char(20) NOT NULL DEFAULT '',
  `tanggal_ujian` datetime NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`jadwal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table ak_data_master_mahasiswa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_master_mahasiswa`;

CREATE TABLE `ak_data_master_mahasiswa` (
  `mahasiswa_id` char(20) NOT NULL DEFAULT '',
  `user_id` char(20) NOT NULL DEFAULT '',
  `mahasiswa_nim` int(11) NOT NULL,
  `mahasiswa_nama` varchar(128) NOT NULL DEFAULT '',
  `mahasiswa_email` varchar(128) NOT NULL DEFAULT '',
  `mahasiswa_alamat` text DEFAULT NULL,
  `mahasiswa_kontak` char(18) NOT NULL DEFAULT '',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`mahasiswa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_master_mahasiswa` WRITE;
/*!40000 ALTER TABLE `ak_data_master_mahasiswa` DISABLE KEYS */;

INSERT INTO `ak_data_master_mahasiswa` (`mahasiswa_id`, `user_id`, `mahasiswa_nim`, `mahasiswa_nama`, `mahasiswa_email`, `mahasiswa_alamat`, `mahasiswa_kontak`, `created_by`, `created_date`, `updated_by`, `last_update`, `deleted`)
VALUES
	('DOS1904150001','USR003',41180220,'Gilang Pratama Priadi','pratamapriadi96@gmail.com','Jl. Raya Banjaran No. 112 D','087710545682','Master','2019-04-15 02:09:05',NULL,NULL,0);

/*!40000 ALTER TABLE `ak_data_master_mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;


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
	('APP19011700001','SISTEM INFORMASI PENGAJUAN THESIS');

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
  `instansi_logo` varchar(128) NOT NULL DEFAULT '',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`instansi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ak_data_sistem_instansi` WRITE;
/*!40000 ALTER TABLE `ak_data_sistem_instansi` DISABLE KEYS */;

INSERT INTO `ak_data_sistem_instansi` (`instansi_id`, `instansi_nama`, `instansi_alamat`, `instansi_kontak`, `instansi_logo`, `deleted`)
VALUES
	('INS19011700001','Akasaka Dev','Jl. Raya Banjaran No. 112 D','087710545682','',0);

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
	('lf8p4u4euhbvooc3nsuf3nckkht2839c','::1',1555278811,X'5F5F63695F6C6173745F726567656E65726174657C693A313535353237383734363B');

/*!40000 ALTER TABLE `ak_data_sistem_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_thesis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_thesis`;

CREATE TABLE `ak_data_thesis` (
  `thesis_id` char(20) NOT NULL DEFAULT '',
  `user_id` char(20) NOT NULL DEFAULT '',
  `thesis_judul` varchar(128) NOT NULL DEFAULT '',
  `thesis_tujuan` text NOT NULL,
  `thesis_rumusan_masalah` text NOT NULL,
  `thesis_kerangka_teori` text NOT NULL,
  `thesis_metodologi_penelitian` text NOT NULL,
  `thesis_status` enum('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu',
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`thesis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table ak_data_thesis_kata
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_thesis_kata`;

CREATE TABLE `ak_data_thesis_kata` (
  `kata_id` char(20) NOT NULL DEFAULT '',
  `kata_input` enum('Judul','Rumusan','Kerangka') DEFAULT 'Judul',
  `kata_daftar` text NOT NULL,
  `kata_maksimum` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(128) NOT NULL DEFAULT '',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`kata_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



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
  UNIQUE KEY `user_login` (`user_login`),
  KEY `level_id` (`level_id`),
  CONSTRAINT `ak_data_user_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `ak_data_user_level` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `ak_data_user` WRITE;
/*!40000 ALTER TABLE `ak_data_user` DISABLE KEYS */;

INSERT INTO `ak_data_user` (`user_id`, `level_id`, `user_nama`, `user_login`, `user_pass`, `last_login`, `created_date`, `deleted`)
VALUES
	('USR003','LVL19011700003','Gilang Pratama Priadi','pratamapriadi96@gmai','$2y$10$/mJ.I3mHUenwfrbvO6lDC.RJEr9MA3CGf0hxDc1/PKWg/quGBrxOG',NULL,'2019-04-15 02:09:05',0),
	('USR19011700001','LVL19011700001','Master','master','$2y$10$NHbq0Ggd9szyUcUJe.9OD.b5GcQ0HHU14GPJE6S.aX4SauqQhUo1K','2019-04-15 03:42:31','2019-01-17 09:47:21',0),
	('USR19011700002','LVL19011700002','Kepala Jurusan','kajur','$2y$10$NHbq0Ggd9szyUcUJe.9OD.b5GcQ0HHU14GPJE6S.aX4SauqQhUo1K','2019-04-14 23:10:39','2019-01-17 09:47:21',0);

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
	('LVL19011700001','Master',0),
	('LVL19011700002','Kepala Jurusan',0),
	('LVL19011700003','Mahasiswa',0);

/*!40000 ALTER TABLE `ak_data_user_level` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
