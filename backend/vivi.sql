-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2019 at 05:13 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vivi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0',
  `alamat` varchar(50) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `alamat`, `username`) VALUES
(2, 'PDM Pekalongan', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Jln Raya Kajen', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `kode_daftar` varchar(50) DEFAULT NULL,
  `nama_asset` varchar(50) DEFAULT NULL,
  `jenis_asset` int(2) DEFAULT NULL COMMENT '1 = bergerak, 0 = tidak bergerak',
  `jml_asset` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT NULL COMMENT '0 = blm diterima, 1 = ditolak, 2 = diterima',
  `tanggal` date DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `kode_daftar`, `nama_asset`, `jenis_asset`, `jml_asset`, `status`, `tanggal`, `tahun`) VALUES
(3, 'PCMPKL-6', 'Meja', 0, 4, 2, '2019-06-01', 2019),
(6, 'PCMPKL-8', 'Meja', 0, 8, 2, '2019-06-01', 2019),
(7, 'PCMPKL-8', 'Mobil', 1, 8, 1, '2018-06-01', 2018),
(9, 'PCMPKL-6', 'Mobil', 1, 2, 0, '2019-06-05', 2019),
(10, 'PCMPKL-8', 'Kursi', 0, 2, 0, '2018-06-12', 2018),
(11, 'PCMPKL-8', 'Kursi', 0, 4, 0, '2019-09-02', NULL),
(12, 'PCMPKL-8', 'Kursia', 0, 4, 0, '2019-09-02', NULL),
(14, 'PCMPKL-8', 'Kurs', 0, 4, 0, '2019-09-02', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `kode_daftar` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` text,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `kode_daftar`, `nama`, `email`, `alamat`, `password`) VALUES
(4, 'PCMPKL-4', 'PCM BOJONG', 'bojong@bojong.com', 'Bojong', 'admin'),
(5, 'PCMPKL-5', 'PCM KARANGANYAR', 'karanganyar@g.com', 'Karanganyar', 'admin'),
(7, 'PCMPKL-6', 'PCM KESESI', 'kesesi@kes.com', 'kesesi pekalongan', 'admin'),
(8, 'PCMPKL-8', 'PCM KAJEN', 'kajen@gamail.com', 'jln Pahlawan Kajen', 'admin'),
(9, 'PCMPKL-9', 'PCM WONOPRINGGO', 'wopi@wopi.com', 'Wonopringgo', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
