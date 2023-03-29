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

-- Dumping data for table db_lkp.akun: ~1 rows (approximately)
/*!40000 ALTER TABLE `akun` DISABLE KEYS */;
INSERT INTO `akun` (`id`, `username`, `password`, `nama`) VALUES
	(1, 'admin', 'admin', 'admin');
/*!40000 ALTER TABLE `akun` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_lkp.instruktur: ~2 rows (approximately)
/*!40000 ALTER TABLE `instruktur` DISABLE KEYS */;
INSERT INTO `instruktur` (`Id`, `NamaInstruktur`, `Kelamin`, `Tempatlahir`, `Tanggallahir`, `Namaibu`, `Alamat`, `Email`) VALUES
	(1, 'Habib Muhammad, S.Pd', 'Laki - Laki', 'Blitar', '04/02/1999', 'Rupiah', 'Srengat', 'habib@cenditama.com'),
	(2, 'Haris Dwi Saputra, S.Pi', 'Laki - Laki', 'Blitar', '29/03/2023', 'Cenditama', 'Blitar', 'haris@cenditama.com');
/*!40000 ALTER TABLE `instruktur` ENABLE KEYS */;

-- Dumping structure for table db_lkp.lulusan
CREATE TABLE IF NOT EXISTS `lulusan` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` text,
  `Kelamin` text,
  `Jeniskursus` text,
  `Kelas` text,
  `Tgllulus` text,
  `Ttl` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_lkp.lulusan: ~0 rows (approximately)
/*!40000 ALTER TABLE `lulusan` DISABLE KEYS */;
/*!40000 ALTER TABLE `lulusan` ENABLE KEYS */;

-- Dumping structure for table db_lkp.peserta
CREATE TABLE IF NOT EXISTS `peserta` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` text,
  `Kelamin` text,
  `Nipd` text,
  `Nik` text,
  `Nokk` text,
  `Jeniskursus` text,
  `Kelas` text,
  `Tanggalmasuk` text,
  `Ttl` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_lkp.peserta: ~1 rows (approximately)
/*!40000 ALTER TABLE `peserta` DISABLE KEYS */;
INSERT INTO `peserta` (`Id`, `Nama`, `Kelamin`, `Nipd`, `Nik`, `Nokk`, `Jeniskursus`, `Kelas`, `Tanggalmasuk`, `Ttl`) VALUES
	(1, 'Nama peserta', 'Laki - Laki', '1000', '350503', '350503', 'Microsoft Office', 'Reguler', '01/03/2023', '01/06/2005');
/*!40000 ALTER TABLE `peserta` ENABLE KEYS */;

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

-- Dumping data for table db_lkp.profil: ~1 rows (approximately)
/*!40000 ALTER TABLE `profil` DISABLE KEYS */;
INSERT INTO `profil` (`id`, `Namalkp`, `Alamat`, `Kelurahan`, `Kecamatan`, `Kota`, `Provinsi`, `Rt`, `Rw`, `Kodepos`, `Namayayasan`, `Telepon`, `Nofax`, `Email`, `Npsn`) VALUES
	(1, 'LKP CENDITAMA', 'Jalan Veteran 44 ', 'Kepanjen kidul', 'Kepanjen kidul', 'Blitar', 'Jawa Timur', '', '', '', '', '', '', '', '123');
/*!40000 ALTER TABLE `profil` ENABLE KEYS */;

-- Dumping structure for table db_lkp.rombel
CREATE TABLE IF NOT EXISTS `rombel` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Namarombel` text,
  `Kelas` text,
  `Jumlahpeserta` text,
  `Ruangan` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_lkp.rombel: ~2 rows (approximately)
/*!40000 ALTER TABLE `rombel` DISABLE KEYS */;
INSERT INTO `rombel` (`Id`, `Namarombel`, `Kelas`, `Jumlahpeserta`, `Ruangan`) VALUES
	(1, 'Microsoft Office', 'pagi', '15', 'depan'),
	(2, 'Desain Grafis', 'Reguler', '15', 'depan');
/*!40000 ALTER TABLE `rombel` ENABLE KEYS */;

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

-- Dumping data for table db_lkp.sapras: ~0 rows (approximately)
/*!40000 ALTER TABLE `sapras` DISABLE KEYS */;
/*!40000 ALTER TABLE `sapras` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
