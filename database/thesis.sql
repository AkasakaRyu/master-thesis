# ************************************************************
# Sequel Pro SQL dump
# Version 5438
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.3.14-MariaDB)
# Database: thesis
# Generation Time: 2019-06-03 23:32:28 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ak_data_jadwal
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_jadwal`;

CREATE TABLE `ak_data_jadwal` (
  `jadwal_id` char(20) NOT NULL DEFAULT '',
  `mahasiswa_id` char(20) NOT NULL DEFAULT '',
  `dosen_id` char(20) NOT NULL DEFAULT '',
  `jadwal_tanggal` date NOT NULL,
  `created_by` varchar(128) NOT NULL DEFAULT 'System',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(128) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`jadwal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_VALUE_ON_ZERO" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `insert_jadwal` AFTER INSERT ON `ak_data_jadwal` FOR EACH ROW UPDATE ak_data_master_dosen
SET dosen_kuota = dosen_kuota-1
WHERE dosen_id = NEW.dosen_id */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_VALUE_ON_ZERO" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `update_jadwal` AFTER UPDATE ON `ak_data_jadwal` FOR EACH ROW IF (NEW.dosen_id=OLD.dosen_id) THEN
	UPDATE ak_data_master_dosen
	SET dosen_kuota = dosen_kuota-1
	WHERE dosen_id = NEW.dosen_id;
	
	UPDATE ak_data_master_dosen
	SET dosen_kuota = dosen_kuota+1
	WHERE dosen_id = OLD.dosen_id;
ELSE
	UPDATE ak_data_master_dosen
	SET dosen_kuota = (dosen_kuota+1)-1
	WHERE dosen_id = NEW.dosen_id;
END IF */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_VALUE_ON_ZERO" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `delete_jadwal` AFTER DELETE ON `ak_data_jadwal` FOR EACH ROW UPDATE ak_data_master_dosen
SET dosen_kuota = dosen_kuota+1
WHERE dosen_id = OLD.dosen_id */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


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
	('APP19011700001','THESIS SUBMISSION SYSTEM');

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
	('INS19011700001','Kode Panda Developer','Jl. Raya Banjaran No. 112 D','087710545682','',0);

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
	('1e7shpqaplq4lbsd1lelc7ahpbefu60t','182.0.244.58',1559586159,X'794E7948784433364241305A536243435876326931664F324538596169547345647A45304A64396167353948515373304F48684B68366D786876347934475A6343673669714D5F69774675797674636B5776356F39672E2E'),
	('3sdq8tjbeidhf404hj9viq2unro29njd','118.137.108.88',1559599387,X'3930467A7161494C4D72597161546342464A557269685674736C5139706A6F524939786F4C2D3778616133326A583974364C35644A433030555864536B56544A3772653943766551696F656E6A654F624731576B71672E2E'),
	('7u5esog1seup9cl35lj4t9ojgppjpcpg','::1',1559604708,X'5F5F63695F6C6173745F726567656E65726174657C693A313535393630343638383B6B6573656D706174616E7C693A313B69647C733A31343A225553523139303131373030303031223B6C6576656C7C733A31343A2241646D696E6973747261746F7273223B6163636573737C733A31343A224C564C3139303131373030303031223B6E616D617C733A363A224D6173746572223B6C6173745F6C6F67696E7C733A31393A22323031392D30362D30342030363A30303A3336223B637265617465645F646174657C733A31393A22323031392D30312D31372030393A34373A3231223B73697374656D5F6E616D657C733A32343A22544845534953205355424D495353494F4E2053595354454D223B4C6F67676564496E7C623A313B'),
	('9nbpho2dduu48tnmv5eeea194n12gkav','118.137.108.88',1559600667,X'3445746149394468635833647238324E354A542D424848466B7631476C6E643067346F3565537A574E744E54534647532D6E666871325145384254634D786E57482D453849516E796F67767966394C4176754E4E54772E2E'),
	('bva3u8h6ho85opt2t4ddl86im7m199a7','182.0.244.58',1559586157,''),
	('cups3khudeci9r26qtbs83uni9oembl8','118.137.108.88',1559601558,X'37542D30757730735F672D587066504C314A3471457270774B6F346A3252776971545142754C626931496433527144504D4345717645666B4E5150723934435774793164525465473470567370634A71544656686F412E2E'),
	('eun2k54aahkocltcvs74keu21rk13lk1','182.0.244.58',1559601152,X'2D34542D586B457A5974594A777457487A2D5357746C665335356D51424D6374455830584233475A2D72584C305A77474A4B6B5055464D4746304263444A766C6443702D6A476950566847483753595A764A5745384469387A7A2D3359794E657173397765576C35663664455954503770484F47684472497162694D427A5A655A58672D714F674D6931466D524B4E5934425477632D6344706D3267486C4957626B6754366F796B6F69576F4D6952704E37734A334B306A3374786F4643776D4B7848316445323278736847752D627656545533674647466649525761674A6A68446834535437324A514F5F785747314D5630685572443753434F6C6F674A6361465437434D765F4D4B3554566D534A46707551466E784D6C315F54326D647146503470506654387575556F5749657448305668614573726C4C7A5878456D68753274593450617169755F6B6F6F4E6366596F657237436747306D6866522D587A6152456D4F5236556E6472646F4A302D6951765A514552613346715039636B6371754E4335754F334E7A4576724469494B485866672E2E'),
	('fht2l5pq1jmoq3fupd0crgb1f632g97l','182.0.244.58',1559602885,X'5439796D55556A2D5577423462525939655343484C7A62546E52783579364151327851553854616974677850464677306770495544667043744171624855676D63535A38496F4170783656414775666E56325F534B6A7A4E77705534476A4E57716D356E52534838424F43657A4265484E543253312D337173637537454331554E4331326F4838744669444C5A6971426632544B44485F3955626239324B6A59623559554D715F48733033654F4A7835436134566F7745614E453735354C336841517265616659305A52395F754255626258775475336A56475851324C4D5465564534456D4D737041535032523139374267424239712D366C364455496F335651476537674B6B467A5039764F716730636274764B4A565138467139594158566343754B4C627A4B3636654B4B6B496746464E6A61786F66586B374D56696F724A522D784E4842455F5F767532524D386E74323449547576534F4C5F77445A6C364E4C50397477504C4F63535F583742737864626B324B347232774D5166565A694E4367374173436D743854594D664E4765476C52512E2E'),
	('h21ha1jr8acs9l84tdiicb95pf8unvlv','182.0.244.58',1559602876,X'616B2D3557596E6A5978576453314C7A7235615A4279486868525466366166477A336238797578377156417030354449564F32367464336571524B524753654462753276756D646369306C52547566655A374C6573672E2E'),
	('n4k7o0cf5nb37q5juqoi0jpue9fmmeik','182.0.244.58',1559586622,X'4E624A654C7645526A59315A73523638453939537564425238375548614E733750454B67527367625732534B5167765138734670702D394B4573302D33735359516849584264687752735A52544F37664D52524E37772E2E'),
	('vk7tk84ancu4lqrfmcjn0t6jbgrh4c07','66.249.90.184',1559599391,X'6C587A4C4E41556B6657454F3630505165644E5861563039435F57515630595575734A50516F704D43346B79487659724646457156416A55353056735532793455647231704159567444416B4A75636249716F6738672E2E');

/*!40000 ALTER TABLE `ak_data_sistem_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ak_data_thesis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ak_data_thesis`;

CREATE TABLE `ak_data_thesis` (
  `thesis_id` char(20) NOT NULL DEFAULT '',
  `user_id` char(20) NOT NULL DEFAULT '',
  `thesis_judul` varchar(128) NOT NULL DEFAULT '',
  `thesis_tujuan` text DEFAULT NULL,
  `thesis_rumusan_masalah` text DEFAULT NULL,
  `thesis_kerangka_teori` text DEFAULT NULL,
  `thesis_metodologi_penelitian` text DEFAULT NULL,
  `thesis_keterangan` text DEFAULT NULL,
  `thesis_status` enum('Waiting','Approved','Rejected') NOT NULL DEFAULT 'Waiting',
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
  `user_login` varchar(128) NOT NULL DEFAULT '',
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
	('USR19011700001','LVL19011700001','Master','master','$2y$10$NHbq0Ggd9szyUcUJe.9OD.b5GcQ0HHU14GPJE6S.aX4SauqQhUo1K','2019-06-04 06:31:31','2019-01-17 02:47:21',0),
	('USR19011700002','LVL19011700002','Kepala Jurusan','kajur','$2y$10$NHbq0Ggd9szyUcUJe.9OD.b5GcQ0HHU14GPJE6S.aX4SauqQhUo1K','2019-06-04 04:54:42','2019-01-17 02:47:21',0);

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
	('LVL19011700001','Administrators',0),
	('LVL19011700002','Head of Department',0),
	('LVL19011700003','Students',0);

/*!40000 ALTER TABLE `ak_data_user_level` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
