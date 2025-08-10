-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2025 at 02:45 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fts`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` smallint(5) UNSIGNED NOT NULL,
  `sandi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `sandi`) VALUES
(1, '12345');

-- --------------------------------------------------------

--
-- Table structure for table `perkiraan`
--

CREATE TABLE `perkiraan` (
  `ID_Perkiraan` smallint(5) UNSIGNED NOT NULL,
  `ID_Wilayah` smallint(5) UNSIGNED NOT NULL,
  `Tahun` varchar(5) NOT NULL,
  `Jumlah` varchar(20) NOT NULL,
  `Tahun_Perkiraan` varchar(5) NOT NULL,
  `Jumlah_Perkiraan` varchar(20) NOT NULL,
  `Selisih` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perkiraan`
--

INSERT INTO `perkiraan` (`ID_Perkiraan`, `ID_Wilayah`, `Tahun`, `Jumlah`, `Tahun_Perkiraan`, `Jumlah_Perkiraan`, `Selisih`) VALUES
(1, 1, '2023', '25686', '2024', '17030', '8656'),
(2, 2, '2023', '17331', '2024', '17030', '301'),
(3, 3, '2023', '23610', '2024', '7527', '16083'),
(4, 4, '2023', '14376', '2024', '17030', '-2654'),
(5, 5, '2023', '37908', '2024', '26533', '11375'),
(6, 6, '2023', '22467', '2024', '17030', '5437'),
(7, 7, '2023', '69296', '2024', '45539', '23757'),
(8, 8, '2023', '37407', '2024', '26533', '10874'),
(9, 9, '2023', '28746', '2024', '17030', '11716'),
(10, 10, '2023', '27240', '2024', '17030', '10210'),
(11, 11, '2023', '17570', '2024', '17030', '540'),
(12, 12, '2023', '9814', '2024', '7527', '2287'),
(13, 13, '2023', '37654', '2024', '26533', '11121'),
(14, 14, '2023', '29915', '2024', '26533', '3382'),
(15, 15, '2023', '3516', '2024', '7527', '-4011'),
(16, 16, '2023', '10456', '2024', '7527', '2929'),
(17, 17, '2023', '8832', '2024', '7527', '1305'),
(18, 18, '2023', '24003', '2024', '17030', '6973'),
(19, 19, '2023', '19061', '2024', '17030', '2031'),
(20, 20, '2023', '14099', '2024', '7527', '6572'),
(21, 21, '2023', '20124', '2024', '17030', '3094'),
(22, 22, '2023', '16129', '2024', '7527', '8602'),
(23, 23, '2023', '19805', '2024', '7527', '12278'),
(24, 24, '2023', '13338', '2024', '7527', '5811'),
(25, 25, '2023', '8592', '2024', '7527', '1065'),
(26, 26, '2023', '63450', '2024', '36036', '27414'),
(27, 27, '2023', '8641', '2024', '7527', '1114'),
(28, 28, '2023', '7118', '2024', '7527', '-409'),
(29, 29, '2023', '5574', '2024', '7527', '-1953'),
(30, 30, '2023', '6108', '2024', '7527', '-1419'),
(31, 31, '2023', '5329', '2024', '7527', '-2198'),
(32, 32, '2023', '12076', '2024', '7527', '4549'),
(33, 33, '2023', '10140', '2024', '7527', '2613');

-- --------------------------------------------------------

--
-- Table structure for table `stunting`
--

CREATE TABLE `stunting` (
  `id_stunting` smallint(6) NOT NULL,
  `id_wilayah` smallint(6) NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `jumlah` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stunting`
--

INSERT INTO `stunting` (`id_stunting`, `id_wilayah`, `tahun`, `jumlah`) VALUES
(1, 1, '2023', '25686'),
(2, 2, '2023', '17331'),
(3, 3, '2023', '23610'),
(4, 4, '2023', '14376'),
(5, 5, '2023', '37908'),
(6, 6, '2023', '22467'),
(7, 7, '2023', '69296'),
(8, 8, '2023', '37407'),
(9, 9, '2023', '28746'),
(10, 10, '2023', '27240'),
(11, 11, '2023', '17570'),
(12, 12, '2023', '9814'),
(13, 13, '2023', '37654'),
(14, 14, '2023', '29915'),
(15, 15, '2023', '3516'),
(16, 16, '2023', '10456'),
(17, 17, '2023', '8832'),
(18, 18, '2023', '24003'),
(19, 19, '2023', '19061'),
(20, 20, '2023', '14099'),
(21, 21, '2023', '20124'),
(22, 22, '2023', '16129'),
(23, 23, '2023', '19805'),
(24, 24, '2023', '13338'),
(25, 25, '2023', '8592'),
(26, 26, '2023', '63450'),
(27, 27, '2023', '8641'),
(28, 28, '2023', '7118'),
(29, 29, '2023', '5574'),
(30, 30, '2023', '6108'),
(31, 31, '2023', '5329'),
(32, 32, '2023', '12076'),
(33, 33, '2023', '10140'),
(34, 1, '2024', '21526'),
(35, 2, '2024', '13496'),
(36, 3, '2024', '11075'),
(37, 4, '2024', '14190'),
(38, 5, '2024', '28899'),
(39, 6, '2024', '18244'),
(40, 7, '2024', '42042'),
(41, 8, '2024', '24560'),
(42, 9, '2024', '20783'),
(43, 10, '2024', '20751'),
(44, 11, '2024', '14510'),
(45, 12, '2024', '7012'),
(46, 13, '2024', '30609'),
(47, 14, '2024', '28675'),
(48, 15, '2024', '2775'),
(49, 16, '2024', '8363'),
(50, 17, '2024', '5819'),
(51, 18, '2024', '14994'),
(52, 19, '2024', '15229'),
(53, 20, '2024', '9133'),
(54, 21, '2024', '14437'),
(55, 22, '2024', '11307'),
(56, 23, '2024', '9618'),
(57, 24, '2024', '11804'),
(58, 25, '2024', '8203'),
(59, 26, '2024', '40486'),
(60, 27, '2024', '6517'),
(61, 28, '2024', '6265'),
(62, 29, '2024', '3487'),
(63, 30, '2024', '3692'),
(64, 31, '2024', '2988'),
(65, 32, '2024', '6756'),
(66, 33, '2024', '7642');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `ID_Wilayah` smallint(5) UNSIGNED NOT NULL,
  `Provinsi` varchar(50) NOT NULL,
  `Kabupaten` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`ID_Wilayah`, `Provinsi`, `Kabupaten`) VALUES
(1, 'Sumatera Utara', 'Tapanuli Tengah'),
(2, 'sumatra utara', 'Tapanuli Utara'),
(3, 'sumatra utara', 'Tapanuli Selatan'),
(4, 'sumatra utara', 'Nias'),
(5, 'sumatra utara', 'Langkat'),
(6, 'sumatra utara', 'Karo'),
(7, 'sumatra utara', 'Deli Serdang'),
(8, 'sumatra utara', 'Simalungun'),
(9, 'sumatra utara', 'Asahan'),
(10, 'sumatra utara', 'LabuhanBatu'),
(11, 'sumatra utara', 'Dairi'),
(12, 'sumatra utara', 'Toba'),
(13, 'sumatra utara', 'Mandailing Natal'),
(14, 'sumatra utara', 'Nias Selatan'),
(15, 'sumatra utara', 'Pakpak Bharat'),
(16, 'sumatra utara', 'Humbang Hasundutan'),
(17, 'sumatra utara', 'Samosir'),
(18, 'sumatra utara', 'Serdang Bedagai'),
(19, 'sumatra utara', 'Batu Bara'),
(20, 'sumatra utara', 'Padang Lawas Utara'),
(21, 'sumatra utara', 'Padang Lawas '),
(22, 'sumatra utara', 'LabuhaBatu Selatan'),
(23, 'sumatra utara', 'LabuhanBatu Utara'),
(24, 'sumatra utara', 'Nias Utara'),
(25, 'sumatra utara', 'Nias Barat'),
(26, 'sumatra utara', 'Kota Medan'),
(27, 'sumatra utara', 'Kota Pematang Siantar'),
(28, 'sumatra utara', 'Kota Sibolga'),
(29, 'sumatra utara', 'Kota Tanjung Balai'),
(30, 'sumatra utara', 'Kota Binjai'),
(31, 'sumatra utara', 'Kota Tebing Tinggi'),
(32, 'sumatra utara', 'Kota Padang Sidempuan'),
(33, 'sumatra utara', 'Kota GunungSitoli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `perkiraan`
--
ALTER TABLE `perkiraan`
  ADD PRIMARY KEY (`ID_Perkiraan`);

--
-- Indexes for table `stunting`
--
ALTER TABLE `stunting`
  ADD PRIMARY KEY (`id_stunting`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`ID_Wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `ID_Wilayah` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
