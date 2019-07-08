-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2019 at 03:11 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booksdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `idbuku` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `idkategori` int(11) DEFAULT NULL,
  `imgfile` varchar(100) DEFAULT NULL,
  `sinopsis` text,
  `thnterbit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`idbuku`, `judul`, `pengarang`, `penerbit`, `idkategori`, `imgfile`, `sinopsis`, `thnterbit`) VALUES
(20, 'Kekeka', 'Cgang', 'Penerbit 2', 6, '', 'yyy', 2018),
(21, 'Rerere', 'GG', 'HH', 2, '195739.jpg', 'weraeraeraeraerraerea', 2015),
(22, 'Test', 'Siapa', 'PT Abadi', 4, '195739.jpg', 'dsadasdasd', 2017),
(23, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(24, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(25, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(26, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(27, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(28, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(29, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(30, 'Test22', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(31, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(32, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(33, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(34, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(35, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(36, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(37, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(38, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(39, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(40, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(41, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(42, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017),
(43, 'Test', 'Siapa', 'PT Abadi', 4, '', 'dsadasdasd', 2017);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `kategori`) VALUES
(1, 'Buku Teks'),
(2, 'Majalah'),
(3, 'Skripsi'),
(4, 'Thesis'),
(5, 'Disertasi'),
(6, 'Novel'),
(7, 'Tes'),
(8, 'Dani');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `fullname`, `role`) VALUES
('adm', '123', 'gant', 'admin'),
('admin', '123456', 'Administrator', 'admin'),
('robby', '123', 'Robby', 'operator'),
('rosihanari', '123456', 'Rosihan Ari Yuana', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`idbuku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `idbuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
