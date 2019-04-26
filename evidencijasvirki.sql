-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2019 at 04:36 PM
-- Server version: 5.6.43-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hiperion_edunova`
--

-- --------------------------------------------------------

--
-- Table structure for table `bend`
--

CREATE TABLE `bend` (
  `sifra` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  `korisnickoime` varchar(50) NOT NULL,
  `lozinka` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bend`
--

INSERT INTO `bend` (`sifra`, `naziv`, `korisnickoime`, `lozinka`, `email`) VALUES
(1, 'Bend 01', 'bend01', '12345', 'bend01@gmail.com'),
(2, 'Bend 02', 'bend02', '12345', 'bend02@gmail.com'),
(3, 'Bend 03', 'bend03', '12345', 'bend03@gmail.com'),
(4, 'Bend 04', 'bend04', '12345', 'bend04@gmail.com'),
(5, 'Bend 05', 'bend05', '12345', 'bend05@gmail.com'),
(7, 'Bend0622121', 'sestica', 'bedjggg5566998', 'tjakopec@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `nastup`
--

CREATE TABLE `nastup` (
  `sifra` int(11) NOT NULL,
  `datumpocetka` datetime DEFAULT NULL,
  `cijena` decimal(18,2) NOT NULL,
  `adresa` varchar(100) NOT NULL,
  `vrstasvirke` varchar(100) NOT NULL,
  `bend` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nastup`
--

INSERT INTO `nastup` (`sifra`, `datumpocetka`, `cijena`, `adresa`, `vrstasvirke`, `bend`) VALUES
(7, '2019-05-22 00:00:00', '5000.00', 'adresa2', 'svatovi', 1),
(3, '2019-05-05 00:00:00', '5000.00', 'adresa2', 'svatovi', 2),
(5, '2019-05-22 00:00:00', '5000.00', 'adresa56655656', 'svatovi', 5);

-- --------------------------------------------------------

--
-- Table structure for table `operater`
--

CREATE TABLE `operater` (
  `sifra` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `lozinka` char(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `operater`
--

INSERT INTO `operater` (`sifra`, `ime`, `prezime`, `email`, `lozinka`) VALUES
(1, 'Leon', 'Mikić', 'leon.mikic93@gmail.com', '$2y$10$0oeK5JKlHslw1ksWLcimZOV2ggnEh5vltZq3ckemw4eIH79GYpTwi');

-- --------------------------------------------------------

--
-- Table structure for table `svirac`
--

CREATE TABLE `svirac` (
  `sifra` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bend` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `svirac`
--

INSERT INTO `svirac` (`sifra`, `ime`, `prezime`, `email`, `bend`) VALUES
(1, 'Ivan', 'Ivić', 'ivan@gmail.com', 2),
(8, 'Filip', 'Filipic', 'test@gmail.com', 5),
(3, 'Josip', 'Veliki', 'josip@gmail', 3),
(4, 'Luka', 'Lukić', 'luka@gmail.com', 4),
(5, 'Gabriel', 'Lustig', 'gabriel@gmail.com', 5),
(7, 'Marko', 'Marić', 'test@test.com', 1),
(10, 'Danijel', 'Danijelić', 'test@gmail.com', 3),
(11, 'Tomislav', 'Tomić', 'test@test.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bend`
--
ALTER TABLE `bend`
  ADD PRIMARY KEY (`sifra`);

--
-- Indexes for table `nastup`
--
ALTER TABLE `nastup`
  ADD PRIMARY KEY (`sifra`),
  ADD KEY `bend` (`bend`);

--
-- Indexes for table `operater`
--
ALTER TABLE `operater`
  ADD PRIMARY KEY (`sifra`);

--
-- Indexes for table `svirac`
--
ALTER TABLE `svirac`
  ADD PRIMARY KEY (`sifra`),
  ADD KEY `bend` (`bend`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bend`
--
ALTER TABLE `bend`
  MODIFY `sifra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nastup`
--
ALTER TABLE `nastup`
  MODIFY `sifra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `operater`
--
ALTER TABLE `operater`
  MODIFY `sifra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `svirac`
--
ALTER TABLE `svirac`
  MODIFY `sifra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
