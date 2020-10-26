-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2020 at 07:32 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

CREATE DATABASE course_backend_db;

USE course_backend_db;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_backend_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_GAME001_LEADERBOARD` ()  NO SQL
BEGIN
	SELECT * FROM game001_leaderboard ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_GAME006_LEADERBOARD` ()  NO SQL
BEGIN
	SELECT * FROM game006_leaderboard ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_GAME007_LEADERBOARD` ()  NO SQL
BEGIN
	SELECT * FROM game007_leaderboard ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_GAME_DATA_BY_STATUS` (IN `pStatus` BOOLEAN)  NO SQL
BEGIN
	SELECT * FROM game_tbl WHERE status = pStatus;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `game001_leaderboard`
-- (See below for the actual view)
--
CREATE TABLE `game001_leaderboard` (
`email` varchar(100)
,`nama_depan` varchar(50)
,`nama_belakang` varchar(50)
,`kota` varchar(100)
,`provinsi` varchar(100)
,`score` int(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `game006_leaderboard`
-- (See below for the actual view)
--
CREATE TABLE `game006_leaderboard` (
`email` varchar(100)
,`nama_depan` varchar(50)
,`nama_belakang` varchar(50)
,`kota` varchar(100)
,`provinsi` varchar(100)
,`score` int(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `game007_leaderboard`
-- (See below for the actual view)
--
CREATE TABLE `game007_leaderboard` (
`email` varchar(100)
,`nama_depan` varchar(50)
,`nama_belakang` varchar(50)
,`kota` varchar(100)
,`provinsi` varchar(100)
,`score` int(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `game_tbl`
--

CREATE TABLE `game_tbl` (
  `game_id` int(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah_level` int(11) NOT NULL,
  `tipe_leaderboard` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_tbl`
--

INSERT INTO `game_tbl` (`game_id`, `nama`, `jumlah_level`, `tipe_leaderboard`, `status`) VALUES
(1, 'Game-001', 10, 1, 1),
(2, 'Game-002', 7, 1, 0),
(6, 'Game-006', 50, 1, 1),
(7, 'Game-007', 24, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kota_tbl`
--

CREATE TABLE `kota_tbl` (
  `kota_id` int(255) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `provinsi_id` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota_tbl`
--

INSERT INTO `kota_tbl` (`kota_id`, `nama_kota`, `provinsi_id`, `status`) VALUES
(1, 'Bandung', 1, 1),
(2, 'Sumedang', 1, 1),
(3, 'Garut', 1, 1),
(4, 'Semarang', 2, 1),
(5, 'Surakarta', 2, 1),
(6, 'Tegal', 2, 1),
(7, 'Surabaya', 3, 1),
(8, 'Malang', 3, 1),
(9, 'Batu', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi_tbl`
--

CREATE TABLE `provinsi_tbl` (
  `provinsi_id` int(255) NOT NULL,
  `nama_provinsi` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi_tbl`
--

INSERT INTO `provinsi_tbl` (`provinsi_id`, `nama_provinsi`, `status`) VALUES
(1, 'Jawa Barat', 1),
(2, 'Jawa Tengah', 1),
(3, 'Jawa Timur', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_game_data_tbl`
--

CREATE TABLE `user_game_data_tbl` (
  `user_game_data_id` int(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `game_id` int(255) NOT NULL,
  `level` int(11) NOT NULL,
  `score` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_game_data_tbl`
--

INSERT INTO `user_game_data_tbl` (`user_game_data_id`, `nik`, `game_id`, `level`, `score`, `status`) VALUES
(1, '1000000000000001', 1, 1, 67, 1),
(2, '1000000000000001', 1, 2, 60, 1),
(3, '1000000000000002', 1, 1, 87, 1),
(4, '1000000000000003', 1, 1, 61, 1),
(5, '1000000000000001', 6, 3, 80, 1),
(6, '1000000000000001', 6, 4, 67, 1),
(7, '1000000000000001', 6, 5, 97, 1),
(8, '1000000000000001', 7, 6, 60, 1),
(9, '1000000000000002', 7, 2, 70, 1),
(10, '1000000000000002', 7, 3, 99, 1),
(11, '1000000000000002', 7, 4, 70, 1),
(12, '1000000000000003', 7, 2, 50, 1),
(13, 'admin', 1, 1, 88, 1),
(14, 'admin', 1, 2, 78, 1),
(15, 'admin', 1, 3, 90, 1),
(16, 'admin', 1, 4, 38, 1),
(17, 'admin', 1, 5, 68, 1),
(18, 'admin', 1, 6, 99, 1),
(19, 'admin', 6, 1, 80, 1),
(20, 'admin', 6, 2, 70, 1),
(21, 'admin', 6, 3, 90, 1),
(22, 'admin', 6, 4, 58, 1),
(23, 'admin', 6, 5, 48, 1),
(24, 'admin', 6, 6, 100, 1),
(25, 'admin', 7, 1, 40, 1),
(26, 'admin', 7, 2, 60, 1),
(27, 'admin', 7, 3, 70, 1),
(28, 'admin', 7, 4, 98, 1),
(29, 'admin', 7, 5, 68, 1),
(30, 'admin', 7, 6, 50, 1),
(36, 'admin', 1, 7, 100, 1),
(40, 'admin', 1, 8, 88, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `nik` varchar(16) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `nomor_handphone` varchar(15) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `token` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` int(10) NOT NULL,
  `kota_id` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`nik`, `nama_depan`, `nama_belakang`, `nomor_handphone`, `tanggal_lahir`, `tempat_lahir`, `email`, `password`, `token`, `alamat`, `kode_pos`, `kota_id`, `status`) VALUES
('1000000000000001', 'Ani', 'Marni', '081012349002', '0000-00-00', 'Bandung', 'animarni@gmail.com', 'f43433f2d32d', '4f33gf43h45656', 'Gedebage, Bandung', 0, 1, 1),
('1000000000000002', 'Budi', 'Yanto', '081012345678', '0000-00-00', 'Bandung', 'budiyanto@gmail.com', 'f43433f24545', '4f3fdfd3h45656', 'Gedebage, Bandung', 0, 1, 1),
('1000000000000003', 'Charlie', 'Darwin', '081012349999', '0000-00-00', 'Bandung', 'charliedarwin@gmail.com', 'f43433f2bv5g', '56565f43h45656', 'Gedebage, Bandung', 0, 1, 1),
('admin', 'admin', 'admin', '081277738295', '2001-08-22', 'Batam', 'admin@agate.id', '21232f297a57a5a743894a0e4a801fc3', '6249932f3f4c572ae4f9296f6c542b28', 'Summarecon Bandung, Gedebage', 10000, 1, 1);

-- --------------------------------------------------------

--
-- Structure for view `game001_leaderboard`
--
DROP TABLE IF EXISTS `game001_leaderboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `game001_leaderboard`  AS  select `user_tbl`.`email` AS `email`,`user_tbl`.`nama_depan` AS `nama_depan`,`user_tbl`.`nama_belakang` AS `nama_belakang`,`kota_tbl`.`nama_kota` AS `kota`,`provinsi_tbl`.`nama_provinsi` AS `provinsi`,`user_game_data_tbl`.`score` AS `score` from (((`user_game_data_tbl` join `user_tbl`) join `kota_tbl`) join `provinsi_tbl`) where ((`user_game_data_tbl`.`game_id` = 1) and (`user_game_data_tbl`.`nik` = `user_tbl`.`nik`) and (`user_tbl`.`kota_id` = `kota_tbl`.`kota_id`) and (`kota_tbl`.`provinsi_id` = `provinsi_tbl`.`provinsi_id`) and (`user_tbl`.`status` = 1) and (`user_game_data_tbl`.`status` = 1)) group by `user_tbl`.`nik` order by `user_game_data_tbl`.`score` desc ;

-- --------------------------------------------------------

--
-- Structure for view `game006_leaderboard`
--
DROP TABLE IF EXISTS `game006_leaderboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `game006_leaderboard`  AS  select `user_tbl`.`email` AS `email`,`user_tbl`.`nama_depan` AS `nama_depan`,`user_tbl`.`nama_belakang` AS `nama_belakang`,`kota_tbl`.`nama_kota` AS `kota`,`provinsi_tbl`.`nama_provinsi` AS `provinsi`,`user_game_data_tbl`.`score` AS `score` from (((`user_game_data_tbl` join `user_tbl`) join `kota_tbl`) join `provinsi_tbl`) where ((`user_game_data_tbl`.`game_id` = 6) and (`user_game_data_tbl`.`nik` = `user_tbl`.`nik`) and (`user_tbl`.`kota_id` = `kota_tbl`.`kota_id`) and (`kota_tbl`.`provinsi_id` = `provinsi_tbl`.`provinsi_id`) and (`user_tbl`.`status` = 1) and (`user_game_data_tbl`.`status` = 1)) group by `user_tbl`.`nik` order by `user_game_data_tbl`.`score` desc ;

-- --------------------------------------------------------

--
-- Structure for view `game007_leaderboard`
--
DROP TABLE IF EXISTS `game007_leaderboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `game007_leaderboard`  AS  select `user_tbl`.`email` AS `email`,`user_tbl`.`nama_depan` AS `nama_depan`,`user_tbl`.`nama_belakang` AS `nama_belakang`,`kota_tbl`.`nama_kota` AS `kota`,`provinsi_tbl`.`nama_provinsi` AS `provinsi`,`user_game_data_tbl`.`score` AS `score` from (((`user_game_data_tbl` join `user_tbl`) join `kota_tbl`) join `provinsi_tbl`) where ((`user_game_data_tbl`.`game_id` = 7) and (`user_game_data_tbl`.`nik` = `user_tbl`.`nik`) and (`user_tbl`.`kota_id` = `kota_tbl`.`kota_id`) and (`kota_tbl`.`provinsi_id` = `provinsi_tbl`.`provinsi_id`) and (`user_tbl`.`status` = 1) and (`user_game_data_tbl`.`status` = 1)) group by `user_tbl`.`nik` order by `user_game_data_tbl`.`score` desc ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game_tbl`
--
ALTER TABLE `game_tbl`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `kota_tbl`
--
ALTER TABLE `kota_tbl`
  ADD PRIMARY KEY (`kota_id`),
  ADD KEY `provinsi_id` (`provinsi_id`);

--
-- Indexes for table `provinsi_tbl`
--
ALTER TABLE `provinsi_tbl`
  ADD PRIMARY KEY (`provinsi_id`);

--
-- Indexes for table `user_game_data_tbl`
--
ALTER TABLE `user_game_data_tbl`
  ADD PRIMARY KEY (`user_game_data_id`),
  ADD KEY `FK_USER_TBL_NIK` (`nik`),
  ADD KEY `FK_GAME_TBL_GAME_ID` (`game_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `FK_KOTA_TBL_KOTA_ID` (`kota_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game_tbl`
--
ALTER TABLE `game_tbl`
  MODIFY `game_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kota_tbl`
--
ALTER TABLE `kota_tbl`
  MODIFY `kota_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `provinsi_tbl`
--
ALTER TABLE `provinsi_tbl`
  MODIFY `provinsi_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_game_data_tbl`
--
ALTER TABLE `user_game_data_tbl`
  MODIFY `user_game_data_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kota_tbl`
--
ALTER TABLE `kota_tbl`
  ADD CONSTRAINT `provinsi_id` FOREIGN KEY (`provinsi_id`) REFERENCES `provinsi_tbl` (`provinsi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_game_data_tbl`
--
ALTER TABLE `user_game_data_tbl`
  ADD CONSTRAINT `FK_GAME_TBL_GAME_ID` FOREIGN KEY (`game_id`) REFERENCES `game_tbl` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USER_TBL_NIK` FOREIGN KEY (`nik`) REFERENCES `user_tbl` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD CONSTRAINT `FK_KOTA_TBL_KOTA_ID` FOREIGN KEY (`kota_id`) REFERENCES `kota_tbl` (`kota_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
