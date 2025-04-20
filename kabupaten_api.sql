-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 02:53 PM
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
-- Database: `kabupaten_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `name`) VALUES
(1, 'Surabaya'),
(2, 'Sidoarjo'),
(3, 'Gresik'),
(4, 'Malang'),
(5, 'Banyuwangi'),
(6, 'Jember'),
(7, 'Probolinggo'),
(8, 'Pasuruan'),
(9, 'Mojokerto'),
(10, 'Kediri'),
(11, 'Blitar'),
(12, 'Tulungagung'),
(13, 'Trenggalek'),
(14, 'Ngawi'),
(15, 'Madiun'),
(16, 'Ponorogo'),
(17, 'Magetan'),
(18, 'Pacitan'),
(19, 'Lamongan'),
(20, 'Bojonegoro'),
(21, 'Tuban'),
(22, 'Nganjuk'),
(23, 'Jombang'),
(24, 'Bondowoso'),
(25, 'Situbondo'),
(26, 'Lumajang'),
(27, 'Bangil'),
(28, 'Batu'),
(29, 'Pamekasan'),
(30, 'Sumenep'),
(31, 'Sampang'),
(32, 'Bangkalan'),
(33, 'Ternate'),
(34, 'Kota Mojokerto'),
(35, 'Kota Kediri'),
(36, 'Kota Madiun');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `api_key` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `api_key`) VALUES
(6, 'Aprinia', 'saprinia@gmail.com', '$2y$10$nbw7lormvt6ex3wAzluzY.fZHlu80aOBawRIC3ANyZTOB6YYJr9hu', '70829c60faca5fa092e0be1eb14f602c48a4a9c05e0811b44be122ef0e725bd8'),
(7, 'Aprinia Salsabila', 'apriniasalsabila99@gmail.com', '$2y$10$D4KQfSY4WbGk8EQUYE7cb.g1d2Q2NBMSeISiQ5PvPPb/I8ADLYhvm', 'ce496b72a93ebac8bd710c5902d807c0acacfc5ec05096becaf071f68f1663d6'),
(8, '', '', '$2y$10$V9zzMGt2yEQx9eccuJqLjevT8zEOZDMkf3lmC6MZjerVEDmwgey2S', '0ce860cf2957911d245f9b83b033efe46e966c01a118432f192b46759f261c1e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `api_key` (`api_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
