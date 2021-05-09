-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2021 at 12:11 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `Id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_akun` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`Id`, `username`, `password`, `jenis_akun`) VALUES
(18, 'muhriz', 'dfb865699329a282e347662b7e3dd87a', 'Penjual'),
(24, 'yahyariz', 'a0e3696b58a0089b973732bc0f44667f', 'Pembeli'),
(28, 'wadidaw', '912fed94a40af47e77e64cb7b5bcc9b4', 'Penjual'),
(30, 'wadagidaw', 'c4a728d2f79e1c367c0a2e70e6caab1c', 'Pembeli'),
(31, 'what', 'd5c84f46ee7dab71ae3054172900e86d', 'Pembeli'),
(32, '', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(33, 'siapa', '20c1a26a55039b30866c9d0aa51953ca', 'Pembeli'),
(34, 'muhriz14', '2ab05793232afca044a0ca740cdee6ba', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `list_beli`
-- (See below for the actual view)
--
CREATE TABLE `list_beli` (
`nopol` varchar(255)
,`merk_mobil` varchar(255)
,`tipe_mobil` varchar(255)
,`nama_beli` varchar(255)
,`nope_beli` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `list_jual`
-- (See below for the actual view)
--
CREATE TABLE `list_jual` (
`nama_profil` varchar(255)
,`nomor_hp` varchar(255)
,`nopol` varchar(255)
,`merk_mobil` varchar(255)
,`tipe_mobil` varchar(255)
,`harga` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `nopol` varchar(255) NOT NULL,
  `merk_mobil` varchar(255) NOT NULL,
  `tipe_mobil` varchar(255) NOT NULL,
  `pemilik_mobil` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`nopol`, `merk_mobil`, `tipe_mobil`, `pemilik_mobil`, `harga`) VALUES
('B0131HJH', 'Toyota', 'Avanza', 'Riziq Muhammad Yahya', 'RP 300.000.000'),
('B1234ABC', 'BMW', 'F320i sports line', 'Muhammad Syahrizal', 'RP 420.000.000'),
('B5678DEF', 'Toyota', 'Nav One', 'Riziq Muhammad Yahya', 'Rp 350.000.000'),
('B7685POV', 'Ferrari', 'Ferrari', 'Firsta Adi Pradana', 'Rp 1.000.000.000');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `username_profil` varchar(255) NOT NULL,
  `nama_profil` varchar(255) NOT NULL,
  `nomor_hp` varchar(255) NOT NULL,
  `nomor_polisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`username_profil`, `nama_profil`, `nomor_hp`, `nomor_polisi`) VALUES
('muhriz', 'Muhammad Riziq Yahya', '085798765432', ''),
('wadidaw', 'Adli Hamid Ibrahim', '085612345678', '');

-- --------------------------------------------------------

--
-- Table structure for table `profil_beli`
--

CREATE TABLE `profil_beli` (
  `username_beli` varchar(255) NOT NULL,
  `nama_beli` varchar(255) NOT NULL,
  `nope_beli` varchar(255) NOT NULL,
  `nopol_beli` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil_beli`
--

INSERT INTO `profil_beli` (`username_beli`, `nama_beli`, `nope_beli`, `nopol_beli`) VALUES
('siapa', 'seorang', 'pria', ''),
('wadagidaw', 'Muhammad Syahrizal', '089912345678', 'B1234ABC'),
('what', 'Firsta Adi Pradana', '089987654321', 'B7685POV'),
('yahyariz', 'Riziq Muhammad Yahya', '085787654321', 'B0131HJH');

-- --------------------------------------------------------

--
-- Structure for view `list_beli`
--
DROP TABLE IF EXISTS `list_beli`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_beli`  AS  select `a`.`nopol` AS `nopol`,`a`.`merk_mobil` AS `merk_mobil`,`a`.`tipe_mobil` AS `tipe_mobil`,`b`.`nama_beli` AS `nama_beli`,`b`.`nope_beli` AS `nope_beli` from (`mobil` `a` join `profil_beli` `b` on(`a`.`nopol` = `b`.`nopol_beli`)) ;

-- --------------------------------------------------------

--
-- Structure for view `list_jual`
--
DROP TABLE IF EXISTS `list_jual`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_jual`  AS  select `a`.`nama_profil` AS `nama_profil`,`a`.`nomor_hp` AS `nomor_hp`,`b`.`nopol` AS `nopol`,`b`.`merk_mobil` AS `merk_mobil`,`b`.`tipe_mobil` AS `tipe_mobil`,`b`.`harga` AS `harga` from (`profil` `a` join `mobil` `b` on(`a`.`nomor_polisi` = `b`.`nopol`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`nopol`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`username_profil`);

--
-- Indexes for table `profil_beli`
--
ALTER TABLE `profil_beli`
  ADD PRIMARY KEY (`username_beli`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
