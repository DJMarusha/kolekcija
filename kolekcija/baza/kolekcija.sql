-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 26, 2018 at 10:00 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kolekcija`
--

-- --------------------------------------------------------

--
-- Table structure for table `filmovi`
--

CREATE TABLE `filmovi` (
  `id` int(11) NOT NULL,
  `naslov` varchar(250) COLLATE utf8_bin NOT NULL,
  `id_zanr` int(11) NOT NULL,
  `godina` year(4) NOT NULL,
  `trajanje` int(11) NOT NULL,
  `slika` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `filmovi`
--

INSERT INTO `filmovi` (`id`, `naslov`, `id_zanr`, `godina`, `trajanje`, `slika`) VALUES
(65, 'Hackers', 14, 1995, 107, 'hackers_1995.jpg'),
(66, 'Takedown', 4, 2000, 156, 'operation_takedown_2000.jpg'),
(67, 'Pirates of Silicon Valley', 7, 1999, 155, 'pirates_of_silicone_valley_1999.jpg'),
(68, 'The Social Network', 4, 2010, 120, 'the_social_network_2010.jpg'),
(69, 'Antitrust', 14, 2001, 165, 'antitrust_2001.jpg'),
(70, 'Firewall', 14, 2006, 165, 'firewall_2006.jpg'),
(71, 'Tron', 2, 1982, 156, 'tron_1982.jpg'),
(72, 'Tron legacy', 2, 2010, 125, 'tron_legacy_2010.jpg'),
(73, 'WarGames', 19, 1983, 174, 'war_games_1983.jpg'),
(74, 'Swordfish', 14, 2001, 159, 'operation_swordfish_2001.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `zanr`
--

CREATE TABLE `zanr` (
  `id` int(11) NOT NULL,
  `naziv` varchar(150) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `zanr`
--

INSERT INTO `zanr` (`id`, `naziv`) VALUES
(1, '3D film'),
(2, 'Akcijski film'),
(3, 'Art film'),
(4, 'Biografski film'),
(5, 'Crtani film'),
(6, 'Dokumentarni film'),
(7, 'Dramski film'),
(8, 'Eksperimentalni film'),
(9, 'Erotski film'),
(10, 'Film ceste'),
(11, 'Film noir'),
(12, 'Francuski novi val'),
(13, 'Komedija'),
(14, 'Kriminalistički film'),
(15, 'Pornografski film'),
(16, 'Povijesni film'),
(17, 'Pustolovni film'),
(18, 'Ratni film'),
(19, 'Triler'),
(20, 'Vestern');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filmovi`
--
ALTER TABLE `filmovi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_zanr` (`id_zanr`);

--
-- Indexes for table `zanr`
--
ALTER TABLE `zanr`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filmovi`
--
ALTER TABLE `filmovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `zanr`
--
ALTER TABLE `zanr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `filmovi`
--
ALTER TABLE `filmovi`
  ADD CONSTRAINT `filmovi_ibfk_1` FOREIGN KEY (`id_zanr`) REFERENCES `zanr` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
