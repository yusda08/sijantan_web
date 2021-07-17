-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table sijantan.pengaduan_jalan
DROP TABLE IF EXISTS `pengaduan_jalan`;
CREATE TABLE IF NOT EXISTS `pengaduan_jalan` (
  `tiket_kode` char(10) NOT NULL,
  `kd_user` int(11) NOT NULL,
  `jalan_nama` tinytext NOT NULL,
  `pengadu_nama` varchar(255) NOT NULL,
  `pengadu_no_hp` char(15) NOT NULL,
  `pengadu_ket` text NOT NULL,
  `pengadu_tgl` datetime NOT NULL,
  `status_respon` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`tiket_kode`),
  UNIQUE KEY `hash_code` (`tiket_kode`) USING BTREE,
  KEY `kd_user` (`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sijantan.pengaduan_jalan: ~1 rows (approximately)
DELETE FROM `pengaduan_jalan`;
/*!40000 ALTER TABLE `pengaduan_jalan` DISABLE KEYS */;
INSERT INTO `pengaduan_jalan` (`tiket_kode`, `kd_user`, `jalan_nama`, `pengadu_nama`, `pengadu_no_hp`, `pengadu_ket`, `pengadu_tgl`, `status_respon`) VALUES
	('86C90911FB', 11, 'Serawi - Bakarangan', 'Yusda Helmani', '085348824545', 'Ini Contoh Pengaduan', '2021-06-22 00:00:00', b'1');
/*!40000 ALTER TABLE `pengaduan_jalan` ENABLE KEYS */;

-- Dumping structure for table sijantan.pengaduan_jalan_aset
DROP TABLE IF EXISTS `pengaduan_jalan_aset`;
CREATE TABLE IF NOT EXISTS `pengaduan_jalan_aset` (
  `aset_pengaduan_id` int(11) NOT NULL AUTO_INCREMENT,
  `tiket_kode` char(10) NOT NULL,
  `lat` char(25) NOT NULL,
  `long` char(25) NOT NULL,
  `foto_path` text NOT NULL,
  `foto_name` text NOT NULL,
  `foto_name_thumb` text NOT NULL,
  PRIMARY KEY (`aset_pengaduan_id`),
  KEY `FK_pengaduan_jalan_aset_pengaduan_jalan` (`tiket_kode`) USING BTREE,
  CONSTRAINT `FK_pengaduan_jalan_aset_pengaduan_jalan` FOREIGN KEY (`tiket_kode`) REFERENCES `pengaduan_jalan` (`tiket_kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sijantan.pengaduan_jalan_aset: ~2 rows (approximately)
DELETE FROM `pengaduan_jalan_aset`;
/*!40000 ALTER TABLE `pengaduan_jalan_aset` DISABLE KEYS */;
INSERT INTO `pengaduan_jalan_aset` (`aset_pengaduan_id`, `tiket_kode`, `lat`, `long`, `foto_path`, `foto_name`, `foto_name_thumb`) VALUES
	(18, '86C90911FB', '11', '12', 'public/uploads/img/pengaduan/jalan/', '1624345831_89ee0d84095ea21ecfbe.jpg', '1624345831_89ee0d84095ea21ecfbe_thumb.jpg'),
	(19, '86C90911FB', '21', '22', 'public/uploads/img/pengaduan/jalan/', '1624345832_345ca0c693b2d7eeba12.jpg', '1624345832_345ca0c693b2d7eeba12_thumb.jpg');
/*!40000 ALTER TABLE `pengaduan_jalan_aset` ENABLE KEYS */;

-- Dumping structure for table sijantan.pengaduan_jalan_respon
DROP TABLE IF EXISTS `pengaduan_jalan_respon`;
CREATE TABLE IF NOT EXISTS `pengaduan_jalan_respon` (
  `respon_id` int(11) NOT NULL AUTO_INCREMENT,
  `tiket_kode` char(10) NOT NULL,
  `respon_ket` text NOT NULL,
  `respon_tgl` datetime NOT NULL,
  `foto_name` varchar(255) DEFAULT NULL,
  `foto_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`respon_id`) USING BTREE,
  KEY `FK_pengaduan_jalan_respon_pengaduan_jalan` (`tiket_kode`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sijantan.pengaduan_jalan_respon: ~5 rows (approximately)
DELETE FROM `pengaduan_jalan_respon`;
/*!40000 ALTER TABLE `pengaduan_jalan_respon` DISABLE KEYS */;
INSERT INTO `pengaduan_jalan_respon` (`respon_id`, `tiket_kode`, `respon_ket`, `respon_tgl`, `foto_name`, `foto_path`) VALUES
	(7, '86C90911FB', 'Ini Respon 1', '2021-06-22 15:11:10', '', ''),
	(8, '86C90911FB', 'Ini Respon 2', '2021-06-22 15:11:10', '', ''),
	(10, '86C90911FB', 'asdasdad', '2021-07-13 14:40:17', '', ''),
	(11, '86C90911FB', 'Dianggarkan pada ta', '2021-07-13 14:44:47', '', ''),
	(14, '86C90911FB', 'asd asdasda', '2021-07-17 22:42:16', '1626532936_d5265f13faf87c7248a1.jpg', 'public/uploads/img/respon/jalan/');
/*!40000 ALTER TABLE `pengaduan_jalan_respon` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
