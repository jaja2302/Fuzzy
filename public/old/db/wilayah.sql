-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2025 at 08:32 AM
-- Server version: 8.0.42-cll-lve
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuzzytim_series`
--

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id_wilayah` smallint UNSIGNED NOT NULL,
  `provinsi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kabupaten` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id_wilayah`, `provinsi`, `kabupaten`) VALUES
(1, 'Sumatera Utara', 'Tapanuli Tengah'),
(3, 'sumatra utara', 'Tapanuli Utara'),
(4, 'sumatra utara', 'Tapanuli Selatan'),
(5, 'sumatra utara', 'Nias'),
(8, 'sumatra utara', 'Langkat'),
(9, 'sumatra utara', 'Karo'),
(10, 'sumatra utara', 'Deli Serdang'),
(11, 'sumatra utara', 'Simalungun'),
(12, 'sumatra utara', 'Asahan'),
(13, 'sumatra utara', 'LabuhanBatu'),
(14, 'sumatra utara', 'Dairi'),
(15, 'sumatra utara', 'Toba'),
(16, 'sumatra utara', 'Mandailing Natal'),
(17, 'sumatra utara', 'Nias Selatan'),
(18, 'sumatra utara', 'Pakpak Bharat'),
(19, 'sumatra utara', 'Humbang Hasundutan'),
(20, 'sumatra utara', 'Samosir'),
(21, 'sumatra utara', 'Serdang Bedagai'),
(22, 'sumatra utara', 'Batu Bara'),
(23, 'sumatra utara', 'Padang Lawas Utara'),
(24, 'sumatra utara', 'Padang Lawas '),
(25, 'sumatra utara', 'LabuhaBatu Selatan'),
(26, 'sumatra utara', 'LabuhanBatu Utara'),
(27, 'sumatra utara', 'Nias Utara'),
(28, 'sumatra utara', 'Nias Barat'),
(29, 'sumatra utara', 'Kota Medan'),
(30, 'sumatra utara', 'Kota Pematang Siantar'),
(31, 'sumatra utara', 'Kota Sibolga'),
(32, 'sumatra utara', 'Kota Tanjung Balai'),
(33, 'sumatra utara', 'Kota Binjai'),
(34, 'sumatra utara', 'Kota Tebing Tinggi'),
(35, 'sumatra utara', 'Kota Padang Sidempuan'),
(36, 'sumatra utara', 'Kota GunungSitoli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id_wilayah` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
