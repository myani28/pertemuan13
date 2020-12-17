-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.3.21-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_apps
CREATE DATABASE IF NOT EXISTS `db_apps` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_apps`;

-- Dumping structure for table db_apps.bahanbaku
CREATE TABLE IF NOT EXISTS `bahanbaku` (
  `no_inventaris` int(11) NOT NULL AUTO_INCREMENT,
  `nm_inventaris` char(50) NOT NULL,
  `stok` char(50) NOT NULL,
  `harsat` char(50) NOT NULL,
  PRIMARY KEY (`no_inventaris`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table db_apps.inputproses
CREATE TABLE IF NOT EXISTS `inputproses` (
  `kd_produksi` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_produksi` date NOT NULL,
  `bhnbaku` char(50) NOT NULL,
  `bhnpendukung` char(50) NOT NULL,
  `waktu` char(50) NOT NULL,
  PRIMARY KEY (`kd_produksi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table db_apps.laporanbahanbaku
CREATE TABLE IF NOT EXISTS `laporanbahanbaku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nm_bahanbaku` char(50) NOT NULL,
  `tgl_produksi` date NOT NULL,
  `jmlh_produksi` int(11) NOT NULL,
  `harsat` float NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table db_apps.laporanbiayaproduksi
CREATE TABLE IF NOT EXISTS `laporanbiayaproduksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_produksi` date NOT NULL,
  `bahanbaku_keluar` int(11) NOT NULL,
  `bahanpendukung_keluar` int(11) NOT NULL,
  `hrg_bahanbaku` float NOT NULL,
  `hrg_bahanpendukung` float NOT NULL,
  `total_bahanbaku` float NOT NULL,
  `total_bahanpendukung` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table db_apps.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) NOT NULL,
  `posisi` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table db_apps.modul
CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `nama_modul` varchar(150) NOT NULL,
  `link_menu` text NOT NULL,
  `link_folder` text NOT NULL,
  `posisi` int(11) NOT NULL,
  `icon_menu` varchar(150) NOT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table db_apps.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(45) NOT NULL,
  `usernm` varchar(20) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
