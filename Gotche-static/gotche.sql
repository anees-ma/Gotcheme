-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2018 at 08:14 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gotche`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', '$2y$11$JGFiWV5rSmg5JipIIy1KbeBlFzhADngT6NH.vQWNiEfK4YbY/lmmC');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(3) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `item_name`, `quantity`, `file`) VALUES
(61, 'jjnjn', 'jnjnj', 'C:/xampp/htdocs/Gotche-static/Stock/uploads/stock1.jpg'),
(62, 'jnjnjn', 'jnj', 'C:/xampp/htdocs/Gotche-static/Stock/uploads/stock11.jpg'),
(63, 'iuiuiu', '60kg', 'C:/xampp/htdocs/Gotche-static/Stock/uploads/stock12.jpg'),
(64, 'jjnj', '20kg', 'C:/xampp/htdocs/Gotche-static/Stock/uploads/stock13.jpg'),
(65, 'yutyyt', '30kg', 'C:/xampp/htdocs/Gotche-static/Stock/uploads/stock14.jpg'),
(66, 'jhjhj', '70kg', 'C:/xampp/htdocs/Gotche-static/Stock/uploads/ethics.png'),
(67, 'oioioio', '30kg', 'C:/xampp/htdocs/Gotche-static/Stock/uploads/healthy-environment.png'),
(68, 'uduudud', '30kg', 'C:/xampp/htdocs/Gotche-static/Stock/uploads/career-development.png'),
(69, 'jjj', 'uiuiuiu', 'C:/xampp/htdocs/Gotche-static/Stock/uploads/mission.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
