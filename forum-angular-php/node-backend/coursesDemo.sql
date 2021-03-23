-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2020 at 08:37 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bddforum`
--

-- --------------------------------------------------------

--
-- Table structure for table `coursesDemo`
--

CREATE TABLE `coursesDemo` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `nbEtuds` int(11) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursesDemo`
--

INSERT INTO `coursesDemo` (`id`, `nom`, `nbEtuds`, `dateCreation`) VALUES
(1, 'cours 1', 22, '2020-02-28 14:53:11'),
(2, 'prog web', 44, '2020-02-28 14:53:24'),
(3, 'programmation concurrente', 20, '2020-03-09 10:18:05'),
(4, 'optimisation', 50, '2020-03-09 10:18:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coursesDemo`
--
ALTER TABLE `coursesDemo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coursesDemo`
--
ALTER TABLE `coursesDemo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
