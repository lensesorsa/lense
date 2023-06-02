-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2023 at 02:13 PM
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
-- Database: `vaccination_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `c_id` int(11) NOT NULL,
  `DOB` date DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `HIV_status` char(1) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `blood_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`c_id`, `DOB`, `gender`, `HIV_status`, `name`, `blood_type`) VALUES
(1, '2023-05-23', 'M', '-', 'yomi', ''),
(2, '2023-05-23', 'M', '-', 'yomi', ''),
(3, '2023-05-17', 'F', '+', 'hiwot', ''),
(4, '2023-05-17', 'F', '+', 'hiwot', '');

-- --------------------------------------------------------

--
-- Table structure for table `generalinformation`
--

CREATE TABLE `generalinformation` (
  `content_id` int(11) NOT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `n_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nurseclerk`
--

CREATE TABLE `nurseclerk` (
  `NC_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `P_id` int(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `m_name` varchar(100) DEFAULT NULL,
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`P_id`, `address`, `c_id`, `email`, `f_name`, `m_name`, `number`) VALUES
(1, 'Addis Ababa\r\n-', NULL, 'lense@gmail.com', 'endale', 'tigist', 978653421),
(2, 'Addis Ababa\r\n-', NULL, 'lense@gmail.com', 'endale', 'tigist', 978653421),
(3, 'Addis Ababa\r\n-', NULL, 'seni@gmail.com', 'lema', 'senayet', 912345678),
(4, 'Addis Ababa\r\n-', NULL, 'seni@gmail.com', 'lema', 'senayet', 912345678);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `r_id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `n_id` int(11) DEFAULT NULL,
  `v_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `s_id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `n_id` int(11) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `v_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`s_id`, `c_id`, `n_id`, `time`, `date`, `v_type`) VALUES
(1, NULL, NULL, NULL, '2023-05-27', NULL),
(2, NULL, NULL, NULL, '2023-06-04', NULL),
(3, NULL, NULL, '02:15:00', '2023-06-09', NULL),
(4, NULL, NULL, '02:15:00', '2023-06-09', NULL),
(5, NULL, NULL, '03:30:00', '2023-05-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `symptom`
--

CREATE TABLE `symptom` (
  `c_id` int(11) DEFAULT NULL,
  `rash` tinyint(1) DEFAULT NULL,
  `vomit` tinyint(1) DEFAULT NULL,
  `fever` tinyint(1) DEFAULT NULL,
  `s_id` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symptom`
--

INSERT INTO `symptom` (`c_id`, `rash`, `vomit`, `fever`, `s_id`, `date`) VALUES
(NULL, 0, 1, 1, 1, NULL),
(NULL, 0, 0, 0, 2, '2023-05-24'),
(NULL, 0, 0, 0, 3, '2023-05-18'),
(NULL, 0, 0, 0, 4, '2023-05-18'),
(NULL, 0, 0, 0, 5, '2023-05-24'),
(NULL, 0, 0, 0, 6, '2023-05-24'),
(NULL, 0, 0, 0, 7, '2023-05-05'),
(NULL, 0, 0, 0, 8, '0000-00-00'),
(NULL, 0, 0, 0, 9, '0000-00-00'),
(NULL, 0, 0, 0, 10, '0000-00-00'),
(NULL, 0, 0, 0, 11, '0000-00-00'),
(NULL, 0, 0, 0, 12, '2023-05-24'),
(NULL, 0, 0, 0, 13, '2023-05-05'),
(NULL, 0, 0, 0, 14, '2023-05-05'),
(NULL, 0, 0, 0, 15, '2023-05-05'),
(NULL, 0, 0, 0, 16, '2023-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `new_password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `role`, `new_password`) VALUES
(1, 'lense', '1234', 'nurseclerk', 'qwert'),
(2, 'endale', '1234', 'parent', 'abcdef'),
(3, 'endale', '1234', 'parent', 'abcdef'),
(4, 'lema', '1234', 'parent', 'qwert'),
(5, 'lema', '1234', 'parent', 'qwert');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_record`
--

CREATE TABLE `vaccination_record` (
  `VR_id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `vaccine_type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccination_record`
--

INSERT INTO `vaccination_record` (`VR_id`, `c_id`, `date`, `vaccine_type`) VALUES
(1, NULL, '2023-05-29', 'BCG'),
(2, NULL, '2023-05-29', 'polio 0'),
(3, NULL, '2023-05-29', 'rota 2'),
(4, NULL, '2023-05-29', 'rota 2'),
(5, NULL, '2023-05-30', 'polio 0');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine`
--

CREATE TABLE `vaccine` (
  `v_id` int(11) NOT NULL,
  `exp_date` date DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `ammount` int(11) DEFAULT NULL,
  `v_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variable_child_information`
--

CREATE TABLE `variable_child_information` (
  `id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `allergy` varchar(300) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `z_score` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `modified_by` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variable_child_information`
--

INSERT INTO `variable_child_information` (`id`, `c_id`, `allergy`, `weight`, `z_score`, `date`, `modified_by`) VALUES
(1, NULL, NULL, 1200, 1, '2023-05-29', NULL),
(2, NULL, NULL, 1200, 1, '2023-05-29', NULL),
(3, NULL, NULL, 1200, 1, '2023-05-29', NULL),
(4, NULL, NULL, 1200, 1, '2023-05-29', NULL),
(5, NULL, NULL, 1300, 0, '2023-05-29', NULL),
(6, NULL, NULL, 1500, -1, '2023-05-29', NULL),
(7, NULL, NULL, 1500, -1, '2023-05-29', NULL),
(8, NULL, NULL, 1700, 1, '2023-05-30', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `generalinformation`
--
ALTER TABLE `generalinformation`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `nurseclerk`
--
ALTER TABLE `nurseclerk`
  ADD PRIMARY KEY (`NC_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`P_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `v_id` (`v_id`),
  ADD KEY `n_id` (`n_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `n_id` (`n_id`);

--
-- Indexes for table `symptom`
--
ALTER TABLE `symptom`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vaccination_record`
--
ALTER TABLE `vaccination_record`
  ADD PRIMARY KEY (`VR_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `variable_child_information`
--
ALTER TABLE `variable_child_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `generalinformation`
--
ALTER TABLE `generalinformation`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nurseclerk`
--
ALTER TABLE `nurseclerk`
  MODIFY `NC_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `symptom`
--
ALTER TABLE `symptom`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vaccination_record`
--
ALTER TABLE `vaccination_record`
  MODIFY `VR_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vaccine`
--
ALTER TABLE `vaccine`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variable_child_information`
--
ALTER TABLE `variable_child_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `child` (`c_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`v_id`) REFERENCES `vaccine` (`v_id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`n_id`) REFERENCES `nurse` (`n_id`),
  ADD CONSTRAINT `report_ibfk_3` FOREIGN KEY (`c_id`) REFERENCES `child` (`c_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `child` (`c_id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`n_id`) REFERENCES `nurse` (`n_id`);

--
-- Constraints for table `symptom`
--
ALTER TABLE `symptom`
  ADD CONSTRAINT `symptom_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `child` (`c_id`);

--
-- Constraints for table `vaccination_record`
--
ALTER TABLE `vaccination_record`
  ADD CONSTRAINT `vaccination_record_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `child` (`c_id`);

--
-- Constraints for table `variable_child_information`
--
ALTER TABLE `variable_child_information`
  ADD CONSTRAINT `variable_child_information_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `child` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
