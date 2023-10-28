-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 12:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbanksystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_samples`
--

CREATE TABLE `blood_samples` (
  `id` int(11) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `quantity_in_ml` int(11) NOT NULL,
  `collected_on` date NOT NULL,
  `expiration_date` date NOT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_samples`
--

INSERT INTO `blood_samples` (`id`, `blood_group`, `quantity_in_ml`, `collected_on`, `expiration_date`, `hospital_id`, `date`) VALUES
(2, 'A+', 300, '2023-10-28', '2023-11-09', 8, '2023-10-28 05:22:00'),
(3, 'A-', 400, '2023-10-15', '2023-11-25', 8, '2023-10-28 05:29:12'),
(4, 'AB-', 250, '2023-10-13', '2023-11-03', 8, '2023-10-28 05:53:40'),
(5, 'B-', 500, '2023-10-04', '2023-10-27', 8, '2023-10-28 06:26:09'),
(6, 'A+', 450, '2023-10-12', '2023-10-31', 8, '2023-10-28 06:40:48'),
(7, 'B+', 450, '2023-10-05', '2023-10-31', 11, '2023-10-28 10:16:00'),
(8, 'AB-', 500, '2023-10-19', '2024-01-16', 11, '2023-10-28 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `registration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `name`, `email`, `password`, `address`, `city`, `state`, `postal_code`, `phone_number`, `registration_date`) VALUES
(5, 'Sample Hospital 1', 'samplehospital1@example.com', '$2y$10$VcTYUndFSKenRCmiTx35wOUkeVcn5BXVaOyWJ1VEURGwu5jnGO.7G', '123 Main Street', 'Sample City', 'Sample State', '12345', '123-456-7890', '2023-10-28'),
(6, 'Sample Hospital 2', 'samplehospital2@example.com', '$2y$10$70VzA5HiQRrNZ.qXI4S0GeWt3A4G.Qadn2dggwNJSS/Jyy8cFAEli', '456 Elm Street', 'Sampleville', 'Test State', '54321', '987-654-3210', '2023-10-28'),
(7, 'Healthcare Center', 'healthcare@example.com', '$2y$10$5mC0bghF4/.Ls213NftZ7.j8mxqFMfOjI4t/5RNt1qofXn3AvrxXW', '789 Oak Street', 'Citytown', 'Medicare State', '67890', '456-789-1234', '2023-10-28'),
(8, 'City General Hospital', 'cityhospital@example.com', '$2y$10$W.7YtlH3yq2ALx8UAW4vYeDf0Pi2D2KL1El.fXd0jyjNCB0OM.UOC', '321 Hospital Lane', 'Metro City', 'Healthstate', '56789', '345-678-2345', '2023-10-28'),
(9, 'Sunshine Medical Center', 'sunshinemed@example.com', '$2y$10$E9SzVn9v2XtsLaVvlaCQUuCo8KcPo.U3niJMHubpO1Ww..Whor1Cm', '101 Sunny Avenue', 'Sunnyville', 'Healthstate', '34567', '234-567-3456', '2023-10-28'),
(10, 'MediCare Central Hospital', 'medicarecentral@example.com', '$2y$10$CHzdMakGlXxv0K0OhN7ZwOXF2MlwG0EYUDJojQonnIug70luQMWQK', '555 Wellness Road', 'Medi City', 'Healtherland', '98765', '123-234-4567', '2023-10-28'),
(11, 'Community Care Hospital', 'communitycare@example.com', '$2y$10$p9//0yqCYLsa2/TpM5yEbevtQgvBSOx3smrz2PLKwnHhsa90KaA/2', '999 Caring Circle', 'Community Town', 'Caring State', '23456', '789-890-5678', '2023-10-28'),
(12, 'LifeSaver Hospital', 'lifesaver@example.com', '$2y$10$jCUh6x.ybEIbcBjeQ/eyneM8ZOWKT2yavVPuOpH7p5kd.GNsijAri', '777 Life Way', 'Rescueville', 'Life Nation', '87654', '567-678-7890', '2023-10-28'),
(13, 'Wellness Medical Center', 'wellnessmed@example.com', '$2y$10$VObWgpH5gcTTfd6H5TjHke1Y8/wG3ps2D.8oU8pvBN5lEt96fy2AS', '333 Wellness Drive', 'Healthyville', 'Healtherland', '65432', '456-567-6789', '2023-10-28'),
(14, 'Hope Hospital', 'hopehospital@example.com', '$2y$10$dWyKCZuVghtzwqzFwp0XXORD8hQCzwy/LvJxholYeYOU1vFPs6Y7W', '222 Hope Street', 'Hope City', 'Healthstate', '54321', '123-234-3456', '2023-10-28'),
(15, 'Sunrise Medical Institute', 'sunrisemed@example.com', '$2y$10$g8qvaGtJhIM1/U8SLWMBjev3D/W0hcjpRRTSvM2zmMScCgl.BtCE.', '123 Sunrise Lane', 'Dawnville', 'Healthland', '43210', '567-678-7890', '2023-10-28'),
(16, 'Pioneer Healthcare', 'pioneerhealth@example.com', '$2y$10$fKYKQlznRjx/0wXzwJg9Z.mdIposQb5.Y1HMhQjPgfhrYfN9DsU2e', '111 Progress Road', 'Innovation City', 'Wellness State', '76543', '234-345-4567', '2023-10-28'),
(17, 'Eternal Hope Hospital', 'eternalhope@example.com', '$2y$10$wXxKn8rGTTPGdNFqsUgt5eN3p00L/CEhB7rDp5sjvdjzEdOBdSDMu', '888 Eternal Avenue', 'Hopeville', 'Healthland', '21098', '678-789-8901', '2023-10-28'),
(18, 'Medical Excellence Center', 'medicalexcellence@example.com', '$2y$10$SaFRn7/.flUh3sqPPOt1XOUnsen1/MtI8AHrX/0aoYV2KcKRxNN5O', '444 Excellence Drive', 'Excellence Town', 'Healtherland', '12345', '345-456-5678', '2023-10-28'),
(19, 'SafeCare Medical Clinic', 'safecare@example.com', '$2y$10$dV9dfK3/P8EO8loWHrWCHOuXvX0NFqabSWEoIhU6gtAqgUlD7JWnq', '555 Safe Lane', 'Safety City', 'Healthstate', '87654', '234-345-4567', '2023-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `receiver`
--

CREATE TABLE `receiver` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `registration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receiver`
--

INSERT INTO `receiver` (`id`, `name`, `email`, `password`, `blood_group`, `address`, `city`, `state`, `postal_code`, `phone_number`, `registration_date`) VALUES
(2, 'a', 'a@a.com', '$2y$10$iJkTzZpr0HfGX/DO34/eCOpXKH9gi5Qv.XdcszP/kv9dX6BIm9omW', 'A+', '12', '12', '12', '12', '12', '2023-10-27'),
(3, 'new nmae', 'a@aa.com', '$2y$10$ATFOOUBscifvExKUrhM10eZQpRszPSXRy3efXCW/s7kAOV4lUNtMC', 'B+', 'dd', 'dd', 'ss', '22', '22', '2023-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `sample_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_samples`
--
ALTER TABLE `blood_samples`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `receiver`
--
ALTER TABLE `receiver`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `sample_id` (`sample_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_samples`
--
ALTER TABLE `blood_samples`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `receiver`
--
ALTER TABLE `receiver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_samples`
--
ALTER TABLE `blood_samples`
  ADD CONSTRAINT `blood_samples_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`id`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`receiver_id`) REFERENCES `receiver` (`id`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`sample_id`) REFERENCES `blood_samples` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
