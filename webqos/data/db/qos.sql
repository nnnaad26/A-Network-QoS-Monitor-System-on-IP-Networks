-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 07:43 AM
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
-- Database: `qos`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_raspi`
--

CREATE TABLE `data_raspi` (
  `data_raspi_id` int(11) NOT NULL,
  `raspi_id` int(11) DEFAULT NULL,
  `bandwidth` double DEFAULT NULL,
  `latency` double DEFAULT NULL,
  `jitter` double DEFAULT NULL,
  `packet_loss` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_raspi`
--

INSERT INTO `data_raspi` (`data_raspi_id`, `raspi_id`, `bandwidth`, `latency`, `jitter`, `packet_loss`, `created_at`, `updated_at`) VALUES
(2, 2, 1.1518041479705696, 5003.941, 0.02731423562220334, 0, '2024-11-16 17:41:38', '2024-11-16 17:41:38'),
(3, 2, 1.1496321355089716, 5013.395, 0.02768744759662059, 0, '2024-11-16 17:41:48', '2024-11-16 17:41:48'),
(4, 2, 1.1501597954139764, 5011.095, 0.03194106782603558, 0, '2024-11-16 17:41:58', '2024-11-16 17:41:58'),
(5, 2, 1.1515240877510762, 5005.157999999999, 0.032011075788566816, 0, '2024-11-16 17:42:08', '2024-11-16 17:42:08'),
(6, 2, 1.15037604640018, 5010.153, 0.03401142840190186, 0, '2024-11-16 17:42:19', '2024-11-16 17:42:19'),
(7, 2, 1.1513055651216475, 5006.108, 0.02826388105623391, 0, '2024-11-16 17:42:29', '2024-11-16 17:42:29'),
(8, 2, 1.1510248278074, 5007.329000000001, 0.02892974757871707, 0, '2024-11-16 17:42:39', '2024-11-16 17:42:39'),
(9, 2, 1.151446330193851, 5005.496, 0.02422066124986668, 0, '2024-11-16 17:42:49', '2024-11-16 17:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'achmad', 'admin'),
(2, 'nadia', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `raspi`
--

CREATE TABLE `raspi` (
  `raspi_id` int(11) NOT NULL,
  `raspi_name` varchar(255) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raspi`
--

INSERT INTO `raspi` (`raspi_id`, `raspi_name`, `model`, `created_at`, `updated_at`) VALUES
(1, 'Raspberry Pi', '1', '2024-11-16 07:28:16', '2024-11-16 16:45:10'),
(2, 'Raspberry Pi', '2', '2024-11-16 07:28:40', '2024-11-16 16:45:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_raspi`
--
ALTER TABLE `data_raspi`
  ADD PRIMARY KEY (`data_raspi_id`),
  ADD KEY `raspi_id` (`raspi_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raspi`
--
ALTER TABLE `raspi`
  ADD PRIMARY KEY (`raspi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_raspi`
--
ALTER TABLE `data_raspi`
  MODIFY `data_raspi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `raspi`
--
ALTER TABLE `raspi`
  MODIFY `raspi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_raspi`
--
ALTER TABLE `data_raspi`
  ADD CONSTRAINT `data_raspi_ibfk_1` FOREIGN KEY (`raspi_id`) REFERENCES `raspi` (`raspi_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
