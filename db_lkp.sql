-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_lkp
CREATE DATABASE IF NOT EXISTS `db_lkp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_lkp`;

-- Dumping structure for table db_lkp.akun
CREATE TABLE IF NOT EXISTS `akun` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` text,
  `password` text,
  `nama` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_lkp.instruktur
CREATE TABLE IF NOT EXISTS `instruktur` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `NamaInstruktur` text,
  `Kelamin` text,
  `Tempatlahir` text,
  `Tanggallahir` text,
  `Namaibu` text,
  `Alamat` text,
  `Email` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_lkp.lulusan
CREATE TABLE IF NOT EXISTS `lulusan` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nipd` int(6) DEFAULT NULL,
  `Tgllulus` date DEFAULT NULL,
  `Tglcetak` date DEFAULT NULL,
  `Instruktur` int(11) DEFAULT NULL,
  `n1` text,
  `n2` text,
  `n3` text,
  `n4` text,
  `n5` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_lkp.peserta
CREATE TABLE IF NOT EXISTS `peserta` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` text,
  `Kelamin` text,
  `Nipd` int(6) DEFAULT NULL,
  `Nik` text,
  `Nokk` text,
  `Jeniskursus` text,
  `Kelas` text,
  `Tglmasuk` date DEFAULT NULL,
  `Ttl` varchar(50) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Nipd` (`Nipd`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_lkp.presensi
CREATE TABLE IF NOT EXISTS `presensi` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tgl` date NOT NULL,
  `Nipd` int(11) NOT NULL,
  `Jeniskursus` text NOT NULL,
  `Instruktur` int(11) NOT NULL DEFAULT '0',
  `Materi` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_lkp.profil
CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Namalkp` text NOT NULL,
  `Alamat` text,
  `Kelurahan` text,
  `Kecamatan` text,
  `Kota` text,
  `Provinsi` text,
  `Rt` text,
  `Rw` text,
  `Kodepos` text,
  `Namayayasan` text,
  `Telepon` text,
  `Nofax` text,
  `Email` text,
  `Npsn` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_lkp.rombel
CREATE TABLE IF NOT EXISTS `rombel` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Namarombel` text,
  `Kelas` text,
  `Jumlahpeserta` text,
  `Ruangan` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_lkp.sapras
CREATE TABLE IF NOT EXISTS `sapras` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Jenissarana` text NOT NULL,
  `Namaprasarana` text NOT NULL,
  `Nosertifikat` text NOT NULL,
  `Panjang` text NOT NULL,
  `Lebar` text NOT NULL,
  `Luaslahan` text NOT NULL,
  `kondisi` text NOT NULL,
  `Banyaknya` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_lkp.unitkompetensi
CREATE TABLE IF NOT EXISTS `unitkompetensi` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Rombel` int(11) NOT NULL,
  `Uk1` text NOT NULL,
  `Uk2` text NOT NULL,
  `Uk3` text NOT NULL,
  `Uk4` text NOT NULL,
  `Uk5` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
