-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 07:48 AM
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
-- Database: `hotel_booking_record`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_records`
--

CREATE TABLE `booking_records` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `image_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_records`
--

INSERT INTO `booking_records` (`id`, `full_name`, `email`, `phone_number`, `room_type`, `check_in_date`, `check_out_date`, `image_file`) VALUES
(5, 'Maryjane Chinazor', 'okwuazichinazor@gmail.com', 2147483647, 'Deluxe', '2025-06-12', '2025-06-24', '-13.jpg'),
(6, 'Gladys Adanne', 'adanne@gmail.com', 2147483647, 'Family Room', '2025-06-05', '2025-06-11', '-14.jpg'),
(8, 'Maryjane Chinazor Okwuazi', 'okwuazichinazor@gmail.com', 2147483647, 'Executive Room', '2025-06-05', '2025-06-20', '-16.jpg'),
(9, 'Lexis Alexander', 'lexiscode@gmail.com', 2147483647, 'Suite', '2025-06-13', '2025-06-28', '-17.jpg'),
(10, 'Maryjane Chy', 'okwuazichinazor@gmail.com', 2147483647, 'Executive Room', '2025-06-20', '2025-06-30', '-18.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `room_type`) VALUES
(7, 'Deluxe'),
(8, 'Presidential Room'),
(10, 'Deluxe'),
(11, 'Family Room'),
(13, 'Double room'),
(15, 'Executive Room'),
(16, 'Executive Room'),
(17, 'single room'),
(18, 'Suite');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_records`
--
ALTER TABLE `booking_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_records`
--
ALTER TABLE `booking_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
