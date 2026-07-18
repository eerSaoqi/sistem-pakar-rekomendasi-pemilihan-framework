-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2026 at 02:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `software architecture advisor`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_framework`
--

CREATE TABLE `kategori_framework` (
  `id` int NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_framework`
--

INSERT INTO `kategori_framework` (`id`, `kode`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'KT01', 'Backend', 'Framework Backend', '2026-07-11 13:58:26', '2026-07-11 13:58:26'),
(2, 'KT02', 'Frontend', 'Framework Frontend', '2026-07-11 13:58:26', '2026-07-11 13:58:26'),
(3, 'KT03', 'Mobile', 'Framework Mobile', '2026-07-11 13:58:26', '2026-07-11 13:58:26'),
(4, 'KT04', 'Full Stack', 'Framework Full Stack', '2026-07-11 13:58:26', '2026-07-11 13:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pertanyaan`
--

CREATE TABLE `kategori_pertanyaan` (
  `id` int NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `pertanyaan_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opsi_jawaban`
--

CREATE TABLE `opsi_jawaban` (
  `id` int NOT NULL,
  `pertanyaan_id` int DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `jawaban` varchar(100) DEFAULT NULL,
  `nilai_cf` decimal(3,2) DEFAULT NULL,
  `urutan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` int NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `pertanyaan` text,
  `tipe` enum('radio','checkbox','select') DEFAULT NULL,
  `urutan` int DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `kode`, `pertanyaan`, `tipe`, `urutan`, `aktif`, `created_at`, `updated_at`) VALUES
(1, 'K01', 'Bahasa pemrograman yang paling dikuasai', NULL, 1, 1, NULL, NULL),
(2, 'K02', 'Tingkat pengalaman developer', NULL, 2, 1, NULL, NULL),
(3, 'K03', 'Berapa jumlah anggota tim?', NULL, 3, 1, NULL, NULL),
(4, 'K04', 'Jenis aplikasi yang akan dibuat', NULL, 4, 1, NULL, NULL),
(5, 'K05', 'Platform utama aplikasi', NULL, 5, 1, NULL, NULL),
(6, 'K06', 'Target jumlah pengguna', NULL, 6, 1, NULL, NULL),
(7, 'K07', 'Seberapa cepat proyek harus selesai?', NULL, 7, 1, NULL, NULL),
(8, 'K08', 'Apakah membutuhkan REST API?', NULL, 8, 1, NULL, NULL),
(9, 'K09', 'Apakah membutuhkan autentikasi bawaan?', NULL, 9, 1, NULL, NULL),
(10, 'K10', 'Apakah membutuhkan Server Side Rendering (SSR)?', NULL, 10, 1, NULL, NULL),
(11, 'K11', 'Apakah SEO menjadi prioritas?', NULL, 11, 1, NULL, NULL),
(12, 'K12', 'Apakah membutuhkan komunikasi real-time (WebSocket)?', NULL, 12, 1, NULL, NULL),
(13, 'K13', 'Apakah aplikasi harus berjalan di Android dan iOS?', NULL, 13, 1, NULL, NULL),
(14, 'K14', 'Seberapa penting performa aplikasi?', NULL, 14, 1, NULL, NULL),
(15, 'K15', 'Seberapa penting keamanan aplikasi?', NULL, 15, 1, NULL, NULL),
(16, 'K16', 'Seberapa penting skalabilitas aplikasi?', NULL, 16, 1, NULL, NULL),
(17, 'K17', 'Seberapa penting dokumentasi framework?', NULL, 17, 1, NULL, NULL),
(18, 'K18', 'Seberapa penting komunitas framework?', NULL, 18, 1, NULL, NULL),
(19, 'K19', 'Seberapa penting kemudahan maintenance?', NULL, 19, 1, NULL, NULL),
(20, 'K20', 'Apakah ingin framework yang mudah dipelajari?', NULL, 20, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `kategori_framework`
--
ALTER TABLE `kategori_framework`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `kategori_pertanyaan`
--
ALTER TABLE `kategori_pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`);

--
-- Indexes for table `opsi_jawaban`
--
ALTER TABLE `opsi_jawaban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_framework`
--
ALTER TABLE `kategori_framework`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_pertanyaan`
--
ALTER TABLE `kategori_pertanyaan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opsi_jawaban`
--
ALTER TABLE `opsi_jawaban`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategori_pertanyaan`
--
ALTER TABLE `kategori_pertanyaan`
  ADD CONSTRAINT `kategori_pertanyaan_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `kategori_pertanyaan_ibfk_2` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`);

--
-- Constraints for table `opsi_jawaban`
--
ALTER TABLE `opsi_jawaban`
  ADD CONSTRAINT `opsi_jawaban_ibfk_1` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
