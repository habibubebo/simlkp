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

-- Dumping data for table db_lkp.akun: ~0 rows (approximately)
/*!40000 ALTER TABLE `akun` DISABLE KEYS */;
REPLACE INTO `akun` (`id`, `username`, `password`, `nama`) VALUES
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_lkp.instruktur: ~2 rows (approximately)
/*!40000 ALTER TABLE `instruktur` DISABLE KEYS */;
REPLACE INTO `instruktur` (`Id`, `NamaInstruktur`, `Kelamin`, `Tempatlahir`, `Tanggallahir`, `Namaibu`, `Alamat`, `Email`) VALUES
	(2, 'Haris, S.Pi', 'Laki - Laki', 'Blitar', '29/03/2023', 'Cenditama', 'Blitar', 'haris@cenditama.com'),
	(3, 'Habib, S.Pd', 'Laki - Laki', 'Blitar', '1999-02-04', 'Cenditama', 'Blitar', 'habib@cenditama.com');
/*!40000 ALTER TABLE `instruktur` ENABLE KEYS */;

-- Dumping structure for table db_lkp.lulusan
CREATE TABLE IF NOT EXISTS `lulusan` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nipd` int(6) DEFAULT NULL,
  `Nama` text,
  `Ttl` text,
  `Kelamin` text,
  `Jeniskursus` text,
  `Kelas` text,
  `Tglmasuk` date DEFAULT NULL,
  `Tgllulus` date DEFAULT NULL,
  `Tglcetak` date DEFAULT NULL,
  `n1` text,
  `n2` text,
  `n3` text,
  `n4` text,
  `n5` text,
  `Instruktur` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_lkp.lulusan: ~1 rows (approximately)
/*!40000 ALTER TABLE `lulusan` DISABLE KEYS */;
/*!40000 ALTER TABLE `lulusan` ENABLE KEYS */;

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
  `Tanggalmasuk` date DEFAULT NULL,
  `Ttl` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Nipd` (`Nipd`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_lkp.peserta: ~2 rows (approximately)
/*!40000 ALTER TABLE `peserta` DISABLE KEYS */;
REPLACE INTO `peserta` (`Id`, `Nama`, `Kelamin`, `Nipd`, `Nik`, `Nokk`, `Jeniskursus`, `Kelas`, `Tanggalmasuk`, `Ttl`) VALUES
	(1, 'Nama peserta benar', 'Laki - Laki', 1001, '12345', '1234', 'Microsoft Office', 'Reguler', '2023-04-02', 'blitar, 17 agustus 1945'),
	(2, 'Nama peserta benar d', 'Laki - Laki', 1000, '12345', '1234', 'Desain Grafis', 'Reguler', '2023-04-02', '29/03/2023');
/*!40000 ALTER TABLE `peserta` ENABLE KEYS */;

-- Dumping structure for table db_lkp.presensi
CREATE TABLE IF NOT EXISTS `presensi` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tgl` date NOT NULL,
  `Nipd` int(11) NOT NULL,
  `Jeniskursus` text NOT NULL,
  `Instruktur` text NOT NULL,
  `Materi` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_lkp.presensi: ~0 rows (approximately)
/*!40000 ALTER TABLE `presensi` DISABLE KEYS */;
REPLACE INTO `presensi` (`Id`, `Tgl`, `Nipd`, `Jeniskursus`, `Instruktur`, `Materi`) VALUES
	(1, '2023-04-02', 1001, 'Microsoft Office', 'Habib, S.Pd', 'excel 1');
/*!40000 ALTER TABLE `presensi` ENABLE KEYS */;

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

-- Dumping data for table db_lkp.profil: ~0 rows (approximately)
/*!40000 ALTER TABLE `profil` DISABLE KEYS */;
REPLACE INTO `profil` (`id`, `Namalkp`, `Alamat`, `Kelurahan`, `Kecamatan`, `Kota`, `Provinsi`, `Rt`, `Rw`, `Kodepos`, `Namayayasan`, `Telepon`, `Nofax`, `Email`, `Npsn`) VALUES
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_lkp.rombel: ~3 rows (approximately)
/*!40000 ALTER TABLE `rombel` DISABLE KEYS */;
REPLACE INTO `rombel` (`Id`, `Namarombel`, `Kelas`, `Jumlahpeserta`, `Ruangan`) VALUES
	(1, 'Microsoft Office', 'pagi', '15', 'depan'),
	(2, 'Desain Grafis', 'Reguler', '15', 'depan'),
	(3, 'Simple Microsoft Office', 'Reguler', '15', 'depan');
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
