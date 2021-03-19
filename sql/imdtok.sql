-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 19 mrt 2021 om 22:02
-- Serverversie: 10.4.10-MariaDB
-- PHP-versie: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imdtok`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `leeftijd` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `leeftijd`) VALUES
(1, 'Warrel', 'vanelverdinghe.ward@gmail.com', '123456', '1998-04-03'),
(3, 'Ada', 'r0755066@student.thomasmore.be', '654321', '2000-03-01'),
(4, 'Bob', 'r0785346@student.thomasmore.be', 'StormOpZee', '1999-03-01'),
(8, 'ninja', 'r0744470@student.thomasmore.be', '$2y$15$V3i69Ri3PjpV5zCTHIBXnusdTvHfm3EQSc4wGtrOP9uT4KYbrQv2i', '2002-03-03'),
(11, 'ninja', 'acid2@youtube.com', '$2y$15$r.aMDn1jfeX/doE/vw2u9O/vETtqXvMGuOwdAlbhtY1OmCBlWPFAO', '1998-04-03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
