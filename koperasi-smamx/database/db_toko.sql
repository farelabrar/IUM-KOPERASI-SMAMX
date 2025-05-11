-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table db_toko.barang: ~2 rows (approximately)
INSERT INTO `barang` (`id`, `id_barang`, `id_kategori`, `nama_barang`, `merk`, `harga_beli`, `harga_jual`, `satuan_barang`, `stok`, `tgl_input`, `tgl_update`) VALUES
	(4, 'BR001', 8, 'Pensil', 'Faber Castel', '1500', '2500', 'PCS', '48', '9 May 2025, 22:55', NULL),
	(5, 'BR002', 8, 'Pulpen', 'Joyko', '1750', '2500', 'PCS', '46', '9 May 2025, 22:58', NULL),
	(7, 'BR003', 10, 'Golda', 'Golda', '3000', '3500', 'PCS', '1', '10 May 2025, 20:58', NULL);

-- Dumping data for table db_toko.kategori: ~4 rows (approximately)
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `tgl_input`) VALUES
	(8, 'ATK', '9 May 2025, 22:55'),
	(9, 'Makanan', '9 May 2025, 22:55'),
	(10, 'Minuman', '9 May 2025, 22:55'),
	(11, 'Snack', '9 May 2025, 23:42');

-- Dumping data for table db_toko.login: ~0 rows (approximately)
INSERT INTO `login` (`id_login`, `user`, `pass`, `id_member`) VALUES
	(1, 'admin', '202cb962ac59075b964b07152d234b70', 1);

-- Dumping data for table db_toko.member: ~0 rows (approximately)
INSERT INTO `member` (`id_member`, `nm_member`, `alamat_member`, `telepon`, `email`, `gambar`, `NIK`) VALUES
	(1, 'Admin', 'Surabayaa', '081234567890', 'Admin@gmail.com', '1746804646ikon.jpg', '');

-- Dumping data for table db_toko.nota: ~4 rows (approximately)
INSERT INTO `nota` (`id_nota`, `id_barang`, `id_member`, `jumlah`, `total`, `tanggal_input`, `periode`) VALUES
	(38, 'BR001', 1, '1', '2500', '9 May 2025, 23:36', '05-2025'),
	(39, 'BR002', 1, '3', '7500', '9 May 2025, 23:36', '05-2025'),
	(40, 'BR003', 1, '3', '10500', '10 May 2025, 21:20', '05-2025'),
	(41, 'BR001', 1, '1', '2500', '10 May 2025, 21:21', '05-2025'),
	(42, 'BR002', 1, '1', '2500', '10 May 2025, 21:22', '05-2025');

-- Dumping data for table db_toko.penjualan: ~2 rows (approximately)
INSERT INTO `penjualan` (`id_penjualan`, `id_barang`, `id_member`, `jumlah`, `total`, `tanggal_input`) VALUES
	(30, 'BR001', 1, '1', '2500', '10 May 2025, 21:21'),
	(31, 'BR002', 1, '1', '2500', '10 May 2025, 21:22');

-- Dumping data for table db_toko.toko: ~0 rows (approximately)
INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `tlp`, `nama_pemilik`) VALUES
	(1, 'SMA MUHAMMADIYAH 10', 'SURABAYA', '081234567890', 'Salim Bahrisy');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
