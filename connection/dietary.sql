-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 03:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dietary`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_name`, `password`, `name`) VALUES
(1, 'admin', '4297f44b13955235245b2497399d7a93', 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `checkup`
--

CREATE TABLE `checkup` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Weight` varchar(50) NOT NULL,
  `Height` varchar(50) NOT NULL,
  `eGFR` varchar(50) NOT NULL,
  `CKD_Status` varchar(50) NOT NULL,
  `BMI` varchar(50) NOT NULL,
  `Blood` varchar(50) NOT NULL,
  `UACR` varchar(50) NOT NULL,
  `Blood_sugar` varchar(50) NOT NULL,
  `Potassium` varchar(50) NOT NULL,
  `Creatinine` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkup`
--

INSERT INTO `checkup` (`id`, `name`, `age`, `Gender`, `Weight`, `Height`, `eGFR`, `CKD_Status`, `BMI`, `Blood`, `UACR`, `Blood_sugar`, `Potassium`, `Creatinine`) VALUES
(2, '', '12', 'Male', '123 kg', '123 cm', '0.72 mL/min/1.73m²', 'Stage 5 End Stage', '81.30 -> Obese', '49 -> High blood', '102.50', 'Prediabetes', '10.61 mmol/LHigh', '182.22 µmol/L ->High');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`) VALUES
(24, 'awdawd', 'cielomerwin@gmail.com', 'awdad'),
(26, 'John Merwin Cielo', 'cielomerwin@gmail.com', 'CKD is a condition in which the kidneys are damaged and cannot filter blood as well as they should. Because of this, excess fluid and waste from blood remain in the body and may cause other health problems, such as heart disease and stroke.'),
(27, 'John Merwin Cielo', 'cielomerwin@gmail.com', 'Your kidneys, each just the size of a computer mouse, filter all the blood in your body every 30 minutes. They work hard to remove wastes, toxins, and excess fluid. They also help control blood pressure, stimulate production of red blood cells, keep your bones healthy, and regulate blood chemicals that are essential to life.\r\n\r\nKidneys that function properly are critical for maintaining good health, however, more than one in seven American adults are estimated to have chronic kidney disease (CKD).\r\n\r\nYour kidneys, each just the size of a computer mouse, filter all the blood in your body every 30 minutes. They work hard to remove wastes, toxins, and excess fluid. They also help control blood pressure, stimulate production of red blood cells, keep your bones healthy, and regulate blood chemicals that are essential to life.\r\n\r\nKidneys that function properly are critical for maintaining good health, however, more than one in seven American adults are estimated to have chronic kidney disease (CKD).\r\n\r\nYour kidneys, each just the size of a computer mouse, filter all the blood in your body every 30 minutes. They work hard to remove wastes, toxins, and excess fluid. They also help control blood pressure, stimulate production of red blood cells, keep your bones healthy, and regulate blood chemicals that are essential to life.\r\n\r\nKidneys that function properly are critical for maintaining good health, however, more than one in seven American adults are estimated to have chronic kidney disease (CKD).\r\n\r\nYour kidneys, each just the size of a computer mouse, filter all the blood in your body every 30 minutes. They work hard to remove wastes, toxins, and excess fluid. They also help control blood pressure, stimulate production of red blood cells, keep your bones healthy, and regulate blood chemicals that are essential to life.\r\n\r\nKidneys that function properly are critical for maintaining good health, however, more than one in seven American adults are estimated to have chronic kidney disease (CKD).\r\n\r\nYour kidneys, each just the size of a computer mouse, filter all the blood in your body every 30 minutes. They work hard to remove wastes, toxins, and excess fluid. They also help control blood pressure, stimulate production of red blood cells, keep your bones healthy, and regulate blood chemicals that are essential to life.\r\n\r\nKidneys that function properly are critical for maintaining good health, however, more than one in seven American adults are estimated to have chronic kidney disease (CKD).\r\n\r\nYour kidneys, each just the size of a computer mouse, filter all the blood in your body every 30 minutes. They work hard to remove wastes, toxins, and excess fluid. They also help control blood pressure, stimulate production of red blood cells, keep your bones healthy, and regulate blood chemicals that are essential to life.\r\n\r\nKidneys that function properly are critical for maintaining good health, however, more than one in seven American adults are estimated to have chronic kidney disease (CKD).\r\n\r\nYour kidneys, each just the size of a computer mouse, filter all the blood in your body every 30 minutes. They work hard to remove wastes, toxins, and excess fluid. They also help control blood pressure, stimulate production of red blood cells, keep your bones healthy, and regulate blood chemicals that are essential to life.\r\n\r\nKidneys that function properly are critical for maintaining good health, however, more than one in seven American adults are estimated to have chronic kidney disease (CKD).\r\n\r\n'),
(28, 'John Merwin Cielo', 'cielomerwin@gmail.com', 'awdawdaw'),
(29, 'John Merwin Cielo', 'cielomerwin@gmail.com', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `name`, `email`, `password`, `code`, `status`) VALUES
(66, 'John Merwin Cielo', 'cielomerwin@gmail.com', '$2y$10$CRRFOGan9.8GJ.FWRF19beOJl58ts7j26GifEXF7jawMF2hKGSZ1m', 0, 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkup`
--
ALTER TABLE `checkup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `checkup`
--
ALTER TABLE `checkup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
