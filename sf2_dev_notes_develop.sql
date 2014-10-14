-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21 Wrz 2014, 23:46
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sf2.dev.notes.develop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `pictureName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picturePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `slider`
--

INSERT INTO `slider` (`id`, `link`, `description`, `pictureName`, `picturePath`, `order`) VALUES
(6, 'http://www.onet.pl', 'Portal informacyjny onet', '58473c1748f68ae7d097bac776d3cbff18cc8b86.jpeg', 'E:\\workspace\\sf2.dev.notes.develop\\sf2.dev.notes.develop\\src\\Piotr\\SliderBundle\\Entity/../../../../web/uploads/sliderPictures', 0),
(7, 'http://interia.pl', 'Portal informacyjny interia..', 'ea6eaea48f7d66de9c05e7863afcb7bc2de79f4b.jpeg', 'E:\\workspace\\sf2.dev.notes.develop\\sf2.dev.notes.develop\\src\\Piotr\\SliderBundle\\Entity/../../../../web/uploads/sliderPictures', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
