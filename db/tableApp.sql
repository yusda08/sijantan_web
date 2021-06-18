-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table sijantan.app_news
DROP TABLE IF EXISTS `app_news`;
CREATE TABLE IF NOT EXISTS `app_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_judul` varchar(255) NOT NULL,
  `news_ket` text NOT NULL,
  `news_tgl` datetime NOT NULL,
  PRIMARY KEY (`news_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sijantan.app_news: ~0 rows (approximately)
DELETE FROM `app_news`;
/*!40000 ALTER TABLE `app_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_news` ENABLE KEYS */;

-- Dumping structure for table sijantan.app_running_text
DROP TABLE IF EXISTS `app_running_text`;
CREATE TABLE IF NOT EXISTS `app_running_text` (
  `run_id` int(11) NOT NULL AUTO_INCREMENT,
  `run_ket` text NOT NULL,
  `run_tgl` datetime NOT NULL,
  `status_aktif` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`run_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sijantan.app_running_text: ~0 rows (approximately)
DELETE FROM `app_running_text`;
/*!40000 ALTER TABLE `app_running_text` DISABLE KEYS */;
INSERT INTO `app_running_text` (`run_id`, `run_ket`, `run_tgl`, `status_aktif`) VALUES
	(1, 'Pemberitahuan Sekilas untuk Running Text', '2021-06-17 08:28:22', 1);
/*!40000 ALTER TABLE `app_running_text` ENABLE KEYS */;

-- Dumping structure for table sijantan.app_unit
DROP TABLE IF EXISTS `app_unit`;
CREATE TABLE IF NOT EXISTS `app_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alamat` text NOT NULL,
  `no_telpon` char(18) NOT NULL,
  `email` varchar(255) NOT NULL,
  `link_fb` varchar(255) NOT NULL,
  `link_instagram` varchar(255) NOT NULL,
  `link_youtube` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table sijantan.app_unit: ~0 rows (approximately)
DELETE FROM `app_unit`;
/*!40000 ALTER TABLE `app_unit` DISABLE KEYS */;
INSERT INTO `app_unit` (`id`, `alamat`, `no_telpon`, `email`, `link_fb`, `link_instagram`, `link_youtube`) VALUES
	(1, 'Jl. Kabupaten Tapin', '085555555', 'pupr.tapinkab@gm.mm', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://www.youtube.com/');
/*!40000 ALTER TABLE `app_unit` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
