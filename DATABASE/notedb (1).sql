-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2024 at 06:12 PM
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
-- Database: `notedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(55) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `fullname`, `email`, `updationDate`) VALUES
(4, 'admin', 'd00f5d5217896fb7fd601412cb890830', 'K. T. T. Karunarathne', 'thamodhikarunarathnedvp@gmail.com', '2024-05-17 04:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(5) NOT NULL,
  `UserID` int(5) DEFAULT NULL,
  `Module` varchar(250) DEFAULT NULL,
  `Title` varchar(250) DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `File` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `Subject` varchar(250) DEFAULT NULL,
  `Level` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `UserID`, `Module`, `Title`, `Description`, `File`, `CreationDate`, `Subject`, `Level`) VALUES
(16, 1, 'Computer Programming I', 'introduction to computers', 'note about introduction to computers', '657ab7eab4d3692dfb455e7d8b8bd4d71718989950.pdf', '2024-06-21 17:12:30', 'CMIS', 'level1'),
(17, 1, 'Computer Programming II', 'computers', 'blahhh', 'd89b7fc85e5e2bac581a36e91db0e3911725894529.pdf', '2024-09-09 15:08:49', 'CMIS', 'level2'),
(18, 1, 'Computer Programming II', 'computers', 'blhhhh', 'add65647ea2746e67755b3308fac3bcb1726221614.pdf', '2024-09-13 10:00:14', 'CMIS', 'level1'),
(19, 1, 'Computer Programming II', 'introduction to computers', 'blhhhh', 'd89b7fc85e5e2bac581a36e91db0e3911726221638.pdf', '2024-09-13 10:00:38', 'CMIS', 'level1'),
(20, 1, 'Computer Programming II', 'Role of Construction', 'blhhh', 'd89b7fc85e5e2bac581a36e91db0e3911726221662.pdf', '2024-09-13 10:01:02', 'CMIS', 'level1');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(50) DEFAULT NULL,
  `Department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `SubjectName`, `SubjectCode`, `Department`) VALUES
(2, 'Computer Programming II', 'CMIS 1212', 'CMIS'),
(3, 'Computer Programming I', 'CMIS 1123', 'CMIS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `UserName` tinytext NOT NULL,
  `Email` tinytext NOT NULL,
  `Password` longtext NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `UserName`, `Email`, `Password`, `RegDate`, `Status`) VALUES
(1, 'K. T. T. Karunarathne', 'thamodhikarunarathnedvp@gmail.com', '26ee51b3a30d2de246b1ca6bae2b7611', '2024-05-16 10:09:51', 1),
(6, 'Nilmi Weerakon', 'nilmiweerakon@gmail.com', '26ee51b3a30d2de246b1ca6bae2b7611', '2024-06-18 21:18:51', 1),
(7, 'Pershani Sewwandi', 'pershanisewwandi@gmail.com', '26ee51b3a30d2de246b1ca6bae2b7611', '2024-06-18 21:21:40', 1),
(8, 'miyuru', 'shihanperera@gmail.com', '26ee51b3a30d2de246b1ca6bae2b7611', '2024-09-13 15:48:38', 1),
(9, 'thamodhi', 'thamodhi2021@gmail.com', '26ee51b3a30d2de246b1ca6bae2b7611', '2024-09-13 15:49:47', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
