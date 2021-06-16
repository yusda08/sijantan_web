-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table sijantan.data_jembatan
DROP TABLE IF EXISTS `data_jembatan`;
CREATE TABLE IF NOT EXISTS `data_jembatan` (
  `jembatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `ruas` varchar(255) NOT NULL,
  `sta` varchar(100) NOT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`jembatan_id`) USING BTREE,
  UNIQUE KEY `nomor` (`nomor`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sijantan.data_jembatan: ~2 rows (approximately)
DELETE FROM `data_jembatan`;
/*!40000 ALTER TABLE `data_jembatan` DISABLE KEYS */;
INSERT INTO `data_jembatan` (`jembatan_id`, `nomor`, `nama`, `kecamatan`, `ruas`, `sta`, `latitude`, `longitude`, `create_at`, `update_at`) VALUES
	(7, 1, '1', '1', '1', '1', NULL, NULL, '2021-06-15 11:59:25', NULL),
	(8, 2, '1', 'Hatungun', '1', '1', '-2.796768577851124', '114.97862209472653', '2021-06-16 10:35:12', '2021-06-16 10:36:22');
/*!40000 ALTER TABLE `data_jembatan` ENABLE KEYS */;

-- Dumping structure for table sijantan.data_jembatan_aset
DROP TABLE IF EXISTS `data_jembatan_aset`;
CREATE TABLE IF NOT EXISTS `data_jembatan_aset` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `jembatan_id` int(11) DEFAULT NULL,
  `foto_judul` varchar(255) DEFAULT NULL,
  `foto_path` varchar(255) DEFAULT NULL,
  `foto_name` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_data_jembatan_aset_data_jembatan` (`jembatan_id`),
  CONSTRAINT `FK_data_jembatan_aset_data_jembatan` FOREIGN KEY (`jembatan_id`) REFERENCES `data_jembatan` (`jembatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sijantan.data_jembatan_aset: ~0 rows (approximately)
DELETE FROM `data_jembatan_aset`;
/*!40000 ALTER TABLE `data_jembatan_aset` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_jembatan_aset` ENABLE KEYS */;

-- Dumping structure for table sijantan.data_jembatan_spesifikasi
DROP TABLE IF EXISTS `data_jembatan_spesifikasi`;
CREATE TABLE IF NOT EXISTS `data_jembatan_spesifikasi` (
  `jembatan_id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `kondisi_id` int(11) NOT NULL,
  `panjang` int(11) DEFAULT NULL,
  `lebar` int(11) DEFAULT NULL,
  `jumlah_bentang` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`jembatan_id`,`tahun`),
  KEY `FK_data_jembatan_spesifikasi_uti_jembatan_kondisi` (`kondisi_id`),
  CONSTRAINT `FK_data_jembatan_spesifikasi_uti_jembatan_kondisi` FOREIGN KEY (`kondisi_id`) REFERENCES `uti_jembatan_kondisi` (`kondisi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sijantan.data_jembatan_spesifikasi: ~0 rows (approximately)
DELETE FROM `data_jembatan_spesifikasi`;
/*!40000 ALTER TABLE `data_jembatan_spesifikasi` DISABLE KEYS */;
INSERT INTO `data_jembatan_spesifikasi` (`jembatan_id`, `tahun`, `kondisi_id`, `panjang`, `lebar`, `jumlah_bentang`, `create_at`, `update_at`) VALUES
	(7, 2021, 1, 1, 1, 11, '2021-06-16 10:35:44', NULL);
/*!40000 ALTER TABLE `data_jembatan_spesifikasi` ENABLE KEYS */;

-- Dumping structure for table sijantan.data_jembatan_tipekondisi
DROP TABLE IF EXISTS `data_jembatan_tipekondisi`;
CREATE TABLE IF NOT EXISTS `data_jembatan_tipekondisi` (
  `jembatan_id` int(11) NOT NULL,
  `tipekondisi_id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `kondisi_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`jembatan_id`,`tipekondisi_id`,`tahun`) USING BTREE,
  KEY `FK_data_jembatan_tipekondisi_uti_jembatan_tipekondisi` (`tipekondisi_id`),
  KEY `FK_data_jembatan_tipekondisi_uti_jembatan_kondisi` (`kondisi_id`),
  CONSTRAINT `FK_data_jembatan_tipekondisi_uti_jembatan_kondisi` FOREIGN KEY (`kondisi_id`) REFERENCES `uti_jembatan_kondisi` (`kondisi_id`),
  CONSTRAINT `FK_data_jembatan_tipekondisi_uti_jembatan_tipekondisi` FOREIGN KEY (`tipekondisi_id`) REFERENCES `uti_jembatan_tipekondisi` (`tipekondisi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sijantan.data_jembatan_tipekondisi: ~4 rows (approximately)
DELETE FROM `data_jembatan_tipekondisi`;
/*!40000 ALTER TABLE `data_jembatan_tipekondisi` DISABLE KEYS */;
INSERT INTO `data_jembatan_tipekondisi` (`jembatan_id`, `tipekondisi_id`, `tahun`, `tipe`, `kondisi_id`, `create_at`, `update_at`) VALUES
	(7, 1, '2021', '1', 1, '2021-06-16 10:35:44', NULL),
	(7, 2, '2021', '1', 1, '2021-06-16 10:35:44', NULL),
	(7, 3, '2021', '1', 2, '2021-06-16 10:35:44', NULL),
	(7, 4, '2021', '1', 3, '2021-06-16 10:35:44', NULL);
/*!40000 ALTER TABLE `data_jembatan_tipekondisi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
