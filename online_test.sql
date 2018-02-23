-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2018 at 06:01 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasiltes`
--

CREATE TABLE `hasiltes` (
  `id` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban_peserta` enum('A','B','C','D') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `waktu_tes` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `instruksi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `waktu_tes`, `waktu_selesai`, `instruksi`) VALUES
(8, '2018-02-21 19:00:00', '2018-02-21 19:55:00', 'Coba'),
(9, '2018-02-23 16:45:00', '2018-02-24 23:45:00', 'Percobaan jadwal tes online ke 2');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `soal` varchar(300) NOT NULL,
  `pilihan_A` text NOT NULL,
  `pilihan_B` text NOT NULL,
  `pilihan_C` text NOT NULL,
  `pilihan_D` text NOT NULL,
  `kunci_jawaban` enum('A','B','C','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `id_jadwal`, `soal`, `pilihan_A`, `pilihan_B`, `pilihan_C`, `pilihan_D`, `kunci_jawaban`) VALUES
(9, 8, 'Soal 1', 'A', 'B', 'C', 'D', 'A'),
(10, 8, 'Soal 2', 'adawdasd', 'qweqsdasd', 'qweasdwd', 'qweasdawd', 'B'),
(11, 8, 'Soal 3', 'asdawda', 'wdasdawd', 'qwdasdawd', 'qweasd', 'A'),
(12, 8, 'Soal 4', 'qdasdawdqw', 'qwdasdawdw', 'qwdasdawd', 'qwasdawd', 'C'),
(13, 8, 'Tes 1', 'aweasdawd', 'qwdasdawd', 'qweasdawd', 'qweasdawd', 'A'),
(14, 9, 'Soal 1', 'qasdawdasd', 'qwddawdw', 'qwdadadw', 'qwasdawd', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `step` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `level`, `id_jadwal`, `step`) VALUES
(1, 'admin', 'admin', 'admin', 1, NULL, 0),
(3, 'lagi2@gmail.com', 'c365fa', 'lagi', 2, 8, 0),
(4, 'lagi1@gmail.com', '7bc9c5', 'lagi2', 2, 8, 0),
(5, 'lagi@gmail.com', '63b738', 'lagi3', 2, 8, 0),
(6, 'coba3@gmail.com', 'f140fc', 'coba 1', 2, 9, 2),
(7, 'coba2@gmail.com', 'c9d53c', 'coba 3', 2, 9, 1),
(8, 'coba5@gmail.com', '9f50f0', 'coba lagi', 2, 9, 0),
(9, 'dicobalagi@gmail.com', 'c4e3e8', 'tes', 2, 9, 0),
(10, 'dicobain@gmail.com', 'fe761f', 'lagi', 2, 9, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasiltes`
--
ALTER TABLE `hasiltes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password` (`password`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasiltes`
--
ALTER TABLE `hasiltes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasiltes`
--
ALTER TABLE `hasiltes`
  ADD CONSTRAINT `hasiltes_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`),
  ADD CONSTRAINT `hasiltes_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `hasiltes_ibfk_3` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id`);

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
