-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2026 at 03:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `harga_beli` decimal(15,2) DEFAULT NULL,
  `harga_jual` decimal(15,2) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `satuan`, `harga_beli`, `harga_jual`, `jumlah`, `tanggal_masuk`, `keterangan`, `foto`) VALUES
(3, 'ATK001', 'Pulpen Pilot', 'pcs', 2000.00, 3500.00, 100, '2026-03-01', 'Alat tulis kantor', 'image_2026-03-11_094239280.png'),
(4, 'ATK002', 'Pensil ', 'pcs', 1500.00, 2500.00, 120, '2026-03-01', 'Alat tulis', 'image_2026-03-11_094302301.png'),
(5, 'ATK003', 'Buku Tulis', 'pcs', 5000.00, 8000.00, 80, '2026-03-02', 'Buku catatan', 'image_2026-03-11_094340155.png'),
(6, 'ATK004', 'Penghapus', 'pcs', 1000.00, 2000.00, 90, '2026-03-02', 'Penghapus pensil', 'image_2026-03-11_094354296.png'),
(7, 'ATK005', 'Penggaris', 'pcs', 2500.00, 4000.00, 60, '2026-03-02', 'Penggaris plastik', 'image_2026-03-11_094425766.png'),
(8, 'ATK006', 'Spidol Hitam', 'pcs', 4000.00, 6500.00, 50, '2026-03-03', 'Spidol papan', 'image_2026-03-11_094506425.png'),
(9, 'ATK007', 'Spidol Warna', 'set', 12000.00, 18000.00, 25, '2026-03-03', 'Spidol warna', 'image_2026-03-11_094539169.png'),
(10, 'ATK008', 'Stabilo', 'pcs', 4500.00, 7000.00, 40, '2026-03-03', 'Penanda teks', 'image_2026-03-11_094602599.png'),
(11, 'ATK009', 'Stapler', 'pcs', 15000.00, 22000.00, 20, '2026-03-04', 'Alat penjepit kertas', 'image_2026-03-11_094627352.png'),
(12, 'ATK010', 'Isi Stapler', 'box', 5000.00, 8000.00, 35, '2026-03-04', 'Isi stapler', 'image_2026-03-11_094710283.png'),
(13, 'ATK011', 'Gunting', 'pcs', 8000.00, 12000.00, 18, '2026-03-04', 'Gunting kertas', 'image_2026-03-11_094830511.png'),
(14, 'ATK012', 'Lem Kertas', 'pcs', 3000.00, 5000.00, 45, '2026-03-05', 'Lem cair', 'image_2026-03-11_094848203.png'),
(15, 'ATK013', 'Map Plastik', 'pcs', 2500.00, 4000.00, 70, '2026-03-05', 'Map dokumen', 'image_2026-03-11_094912734.png'),
(16, 'ATK014', 'Map Kertas', 'pcs', 2000.00, 3500.00, 65, '2026-03-05', 'Map arsip', 'image_2026-03-11_094938968.png'),
(17, 'ATK015', 'Binder Clip', 'box', 7000.00, 11000.00, 30, '2026-03-06', 'Penjepit dokumen', 'image_2026-03-11_094957583.png'),
(18, 'ATK016', 'Kertas HVS', 'rim', 45000.00, 55000.00, 22, '2026-03-06', 'Kertas printer', 'image_2026-03-11_095032454.png'),
(19, 'ATK017', 'Kertas HVS Sedang', 'rim', 50000.00, 60000.00, 20, '2026-03-06', 'Kertas dokumen', 'image_2026-03-11_095132199.png'),
(20, 'ATK018', 'Lakban', 'pcs', 6000.00, 9000.00, 28, '2026-03-07', 'Lakban bening', 'image_2026-03-11_095147440.png'),
(21, 'ATK019', 'Tipex', 'pcs', 3500.00, 6000.00, 32, '2026-03-07', 'Penghapus tinta', 'image_2026-03-11_095203004.png'),
(22, 'ATK020', 'Tempat Pensil', 'pcs', 12000.00, 18000.00, 15, '2026-03-07', 'Tempat alat tulis', 'image_2026-03-11_095226851.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
