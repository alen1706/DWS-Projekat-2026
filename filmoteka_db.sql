-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2026 at 09:31 PM
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
-- Database: `filmoteka_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banovani_korisnici`
--

CREATE TABLE `banovani_korisnici` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `razlog` text NOT NULL,
  `datum_bana` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banovani_korisnici`
--

INSERT INTO `banovani_korisnici` (`id`, `korisnik_id`, `razlog`, `datum_bana`) VALUES
(1, 4, 'ništa', '2026-05-27 11:33:17'),
(4, 6, 'nisi na vrijeme', '2026-05-27 16:01:41'),
(5, 10, 'ne znam bruda', '2026-05-27 16:01:46'),
(6, 13, 'safaf', '2026-05-28 10:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `poruka` text NOT NULL,
  `datum_slanja` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `ime`, `email`, `poruka`, `datum_slanja`) VALUES
(1, 'Rijad Ferhatović', 'rijad.ferhatovic.25@size.ba', 'STRANICA JE PREDOBRA.', '2026-05-27 13:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `filmovi`
--

CREATE TABLE `filmovi` (
  `id` int(11) NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `opis` text DEFAULT NULL,
  `slika` varchar(255) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT 0.0,
  `link_gledanje` varchar(255) DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `prezime` varchar(50) NOT NULL,
  `datum_rodenja` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guest') DEFAULT 'guest',
  `bio` varchar(100) DEFAULT '',
  `profilna_slika` varchar(255) DEFAULT 'guest.png',
  `status` enum('active','banned') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `email`, `prezime`, `datum_rodenja`, `username`, `password`, `role`, `bio`, `profilna_slika`, `status`) VALUES
(1, 'Admin', NULL, 'Administrator', '2000-01-01', 'admin', '$2y$10$w6Ym75M5nN4mNfE630Hn/.Z/F3VfJ6W/R1X/oY6.h7UuE3HfeD/mO', 'admin', '', 'guest.png', 'active'),
(4, 'aknf', NULL, 'shfas', '5243-02-04', 'alenalen', '$2y$10$sX3MSaUX.cuJJNlM1lnU5.i5vUbHSyfJnxP8NCw5cG/9sJ0i1n9Sm', 'guest', '', 'guest.png', 'banned'),
(6, 'Rijad', NULL, 'Ferhatović', '2006-02-04', 'rijad.ferhatovic', '$2y$10$56SrI9fMr5fCcnjDPGYSMu7Vg4cs.yzbPcC/a4mOpPcktB.MEcac.', 'guest', 'Student Politehničkog fakulteta u Zenici, odsjek Softverskog Inženjerstva.', 'user_6_1779532287.png', 'banned'),
(10, 'Rijad', NULL, 'Ferhatović', '2006-02-03', 'rikson', '$2y$10$/FSCWLCzfRqkvB9xT6fUmejMFlSboqgsD4zx.sJhFT7j9IRao.Clm', 'guest', '', 'guest.png', 'banned'),
(13, 'Rijad', 'rijad.ferhatovic.25@size.ba', '', '0000-00-00', 'rijadferhatovic', '$2y$10$4Mp1Gxn9Dma/Sy9cEuybAO6uJZfumojpysDVPr5uufW.gFMwRFSei', 'guest', '', 'guest.png', 'banned'),
(14, 'Rijad', 'rijadferhatovic53@gmail.com', 'Ferhatović', '2006-02-04', 'rijadrijad', '$2y$10$IZeBsKFGeoxUcxmtZ8VGleQjQej4jSFxSDQdWX1yuVrCStlAA2wQi', 'guest', 'asfafa', '14_1780082356.png', 'active'),
(18, 'Admin', 'admin@size.ba', 'Filmoteka', '0000-00-00', 'admin1', '$2y$10$YkmY4BqtYam1R974ABsqkOY3FMsUgSY9MCaWmpv3UYpy3D3Mioww6', 'admin', '', 'guest.png', 'active'),
(19, 'Amar', 'amar@gmail.com', 'Ferhatovic', '0000-00-00', 'amaramar', '$2y$10$xutqRX3H8j2WnBYg/YKGRushI0i6lhYT6jOh/PI1gj5k.jotN2p6C', 'guest', '', 'guest.png', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `postavke_sistema`
--

CREATE TABLE `postavke_sistema` (
  `kljuc` varchar(50) NOT NULL,
  `vrijednost` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postavke_sistema`
--

INSERT INTO `postavke_sistema` (`kljuc`, `vrijednost`) VALUES
('hero_index', '0');

-- --------------------------------------------------------

--
-- Table structure for table `zbirka_stavke`
--

CREATE TABLE `zbirka_stavke` (
  `id` int(11) NOT NULL,
  `zbirka_id` int(11) NOT NULL,
  `tmdb_id` int(11) NOT NULL,
  `media_type` enum('movie','tv') NOT NULL,
  `dodano_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zbirke`
--

CREATE TABLE `zbirke` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `tip` enum('javna','privatna') DEFAULT 'privatna',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zbirke`
--

INSERT INTO `zbirke` (`id`, `user_id`, `naziv`, `tip`, `created_at`) VALUES
(7, 13, 'dubadabadoo', 'privatna', '2026-05-27 18:45:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banovani_korisnici`
--
ALTER TABLE `banovani_korisnici`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filmovi`
--
ALTER TABLE `filmovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `email_3` (`email`),
  ADD UNIQUE KEY `email_4` (`email`),
  ADD UNIQUE KEY `email_5` (`email`),
  ADD UNIQUE KEY `email_6` (`email`);

--
-- Indexes for table `postavke_sistema`
--
ALTER TABLE `postavke_sistema`
  ADD PRIMARY KEY (`kljuc`);

--
-- Indexes for table `zbirka_stavke`
--
ALTER TABLE `zbirka_stavke`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zbirka_id` (`zbirka_id`);

--
-- Indexes for table `zbirke`
--
ALTER TABLE `zbirke`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banovani_korisnici`
--
ALTER TABLE `banovani_korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `filmovi`
--
ALTER TABLE `filmovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `zbirka_stavke`
--
ALTER TABLE `zbirka_stavke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `zbirke`
--
ALTER TABLE `zbirke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banovani_korisnici`
--
ALTER TABLE `banovani_korisnici`
  ADD CONSTRAINT `banovani_korisnici_ibfk_1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `zbirka_stavke`
--
ALTER TABLE `zbirka_stavke`
  ADD CONSTRAINT `zbirka_stavke_ibfk_1` FOREIGN KEY (`zbirka_id`) REFERENCES `zbirke` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
