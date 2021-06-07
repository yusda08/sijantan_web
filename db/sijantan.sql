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

-- Dumping structure for table sijantan.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(225) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `link` varchar(225) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sijantan.menu: ~6 rows (approximately)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `nama`, `parent`, `link`, `urutan`, `icon`) VALUES
	(1, 'Home', 0, 'home', 1, 'fa-home'),
	(2, 'Setting', 0, '#', 2, 'fa-cogs'),
	(3, 'User', 2, 'setting/user', 1, 'fa-user'),
	(20, 'Menu', 2, 'setting/menu', 2, 'fa-circle');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table sijantan.menu_role
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE IF NOT EXISTS `menu_role` (
  `id_menu` int(11) NOT NULL,
  `kd_level` int(11) NOT NULL,
  `action` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_menu`,`kd_level`) USING BTREE,
  CONSTRAINT `FK_menu_role_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sijantan.menu_role: ~18 rows (approximately)
DELETE FROM `menu_role`;
/*!40000 ALTER TABLE `menu_role` DISABLE KEYS */;
INSERT INTO `menu_role` (`id_menu`, `kd_level`, `action`) VALUES
	(1, 1, b'1'),
	(2, 1, b'1'),
	(3, 1, b'1'),
	(20, 1, b'1');
/*!40000 ALTER TABLE `menu_role` ENABLE KEYS */;

-- Dumping structure for table sijantan.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `kd_user` int(11) NOT NULL,
  `kd_level` int(11) NOT NULL DEFAULT '0',
  `kode_group` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_telpon` varchar(128) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `is_active` int(11) DEFAULT '1',
  `is_login` int(11) DEFAULT '0',
  `last_login_dt` date NOT NULL,
  `last_login_tm` time NOT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kd_user`),
  KEY `kd_level` (`kd_level`),
  CONSTRAINT `FK_user_user_level` FOREIGN KEY (`kd_level`) REFERENCES `user_level` (`kd_level`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sijantan.user: ~0 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`kd_user`, `kd_level`, `kode_group`, `username`, `password`, `nama_user`, `email`, `no_telpon`, `foto`, `is_active`, `is_login`, `last_login_dt`, `last_login_tm`, `create_at`, `update_at`) VALUES
	(1, 1, '', 'admin', '$2y$10$G6od4Fc03ualqN8lBdLaVeGlrdmtQ8XcXTHnYBgev0qZhQ4vQzQmi', 'Super Admin', 'yusdahelmani@gmail.com', '-', '', 1, 0, '2019-04-03', '16:55:42', NULL, '2021-02-21 20:22:58');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table sijantan.user_level
DROP TABLE IF EXISTS `user_level`;
CREATE TABLE IF NOT EXISTS `user_level` (
  `kd_level` int(11) NOT NULL AUTO_INCREMENT,
  `ket_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kd_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table sijantan.user_level: ~0 rows (approximately)
DELETE FROM `user_level`;
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` (`kd_level`, `ket_level`) VALUES
	(1, 'Administrator'),
	(2, 'Pengguna');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;

-- Dumping structure for trigger sijantan.menu_after_insert
DROP TRIGGER IF EXISTS `menu_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `menu_after_insert` AFTER INSERT ON `menu` FOR EACH ROW BEGIN
insert menu_role (id_menu, kd_level, action) values (new.id, 1, 1);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
