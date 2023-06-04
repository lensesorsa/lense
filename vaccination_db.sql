-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 09:00 PM
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
(4, '2023-05-17', 'F', '+', 'hiwot', ''),
(5, '2023-06-18', 'F', '-', 'jerusalem', 'AB-'),
(6, '2023-06-06', 'F', '-', 'lense', 'AB+'),
(7, '2023-06-14', 'F', '+', 'edom', 'AB+'),
(8, '2023-06-01', 'M', '-', 'Adam', 'b+'),
(9, '2023-05-30', 'F', '-', 'lensa', 'AB+'),
(10, '2023-06-13', 'F', '-', 'dagim', 'AB-'),
(11, '2023-06-12', 'F', '-', 'salut', 'AB+'),
(12, '2023-06-07', 'M', '+', 'abcd', 'A'),
(13, '2023-06-02', 'F', '+', 'lense', 'AB-'),
(14, '2023-06-21', 'F', '-', 'helena', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `generalinformation`
--

CREATE TABLE `generalinformation` (
  `content_id` int(11) NOT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `generalinformation`
--

INSERT INTO `generalinformation` (`content_id`, `content`, `date`, `title`) VALUES
(1, 'the quick brown fox jumps over the lazy dog', '2023-06-02', 'story'),
(2, 'Statement of the Problem\r\nDue to the lack of adequate healthcare, Ethiopia has high Infant Mortality rates. The pooled prevalence of immunization among 12–23 month old children in Ethiopia was found to be 47% (95%, CI: 46.0, 47.0). A subgroup analysis by region indicated the lowest proportion of immunized children in the Afar region, 21% (95%, CI: 18.0, 24.0) and the highest in the Amhara region, 89% (95%, CI: 85.0, 92.0).\r\nYoung children are at increased risk for infectious diseases like diphtheria, pertussis, tetanus, hepatitis virus, measles, mumps, pneumonia, polio virus and rotavirus because their immune systems have not yet built up the necessary defenses to fight serious infections and diseases. Making sure that children have access to proper healthcare and immunization against diseases that can be prevented by vaccines is a huge challenge that is being faced by developing countries like ours.\r\nVaccinations start early in life to protect children before they are exposed. We can ', '2023-06-03', 'remainder');

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `n_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`n_id`, `name`) VALUES
(1, 'sosina'),
(2, 'helina'),
(3, 'metasebya');

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
  `c_id` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `m_name` varchar(100) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `woreda` int(11) DEFAULT NULL,
  `kebele` int(11) DEFAULT NULL,
  `house_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`P_id`, `c_id`, `email`, `f_name`, `m_name`, `number`, `woreda`, `kebele`, `house_no`) VALUES
(1, NULL, 'lense@gmail.com', 'endale', 'tigist', 978653421, NULL, NULL, NULL),
(2, NULL, 'lense@gmail.com', 'endale', 'tigist', 978653421, NULL, NULL, NULL),
(3, NULL, 'seni@gmail.com', 'lema', 'senayet', 912345678, NULL, NULL, NULL),
(4, NULL, 'seni@gmail.com', 'lema', 'senayet', 912345678, NULL, NULL, NULL),
(5, 5, 'hiwi@gmail.com', 'bekele', 'hiwot', 897645321, NULL, NULL, NULL),
(6, 6, 'aberash@gmail.com', 'debela', 'aberash', 913652855, NULL, NULL, NULL),
(7, 7, 'tesfaye@gmail.com', 'tesfaye', 'gelila', 112840245, NULL, NULL, NULL),
(8, 8, 'sol@ggmail.com', 'Solomon', 'Hilal', 912345678, NULL, NULL, NULL),
(9, 9, 'keneni@gmail.com', 'haile', 'keneni', 978654312, NULL, NULL, NULL),
(10, 10, 'abe@gmail.com', 'abebe', 'hana', 978654321, NULL, NULL, NULL),
(11, 11, 'temam@gmai.com', 'temam', 'teyba', 911223344, NULL, NULL, NULL),
(12, 12, 'b@gmail.com', 'defg', 'hijk', 9987654, NULL, NULL, NULL),
(13, 13, 's@gmail.com', 'senay', 'werty', 9876543, NULL, NULL, NULL),
(14, 14, 'sorsadebela@gmail.com', 'gezaw', 'hena', 987654567, 12, 1, 987);

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
(1, 7, NULL, NULL, NULL, NULL),
(2, 1, 1, '00:30:00', '2023-06-14', 'rota 2'),
(3, 2, NULL, NULL, '2023-06-11', 'BCG'),
(4, 3, NULL, NULL, '2023-06-12', ''),
(5, 8, NULL, NULL, NULL, NULL),
(6, 9, NULL, NULL, NULL, NULL),
(7, 10, NULL, NULL, NULL, NULL),
(8, 11, 1, '21:47:00', '2023-06-21', 'rota 2'),
(9, 11, 1, '21:47:00', '2023-06-21', 'rota 2'),
(10, 12, NULL, NULL, '2023-06-15', 'penta'),
(11, 12, NULL, NULL, '2023-06-15', 'penta'),
(12, 13, NULL, NULL, '2023-06-14', 'polio 3'),
(13, 13, NULL, NULL, '2023-06-14', 'polio 3'),
(14, 14, NULL, NULL, NULL, NULL),
(15, 14, NULL, NULL, '2023-06-04', 'BCG');

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
(NULL, 0, 0, 0, 16, '2023-05-05'),
(NULL, 1, 0, 1, 17, '2023-06-02'),
(NULL, 1, 0, 1, 18, '2023-06-02'),
(NULL, 1, 0, 1, 19, '2023-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `role`) VALUES
(1, 'lense', '1234', 'nurseclerk'),
(2, 'endale', '1234', 'parent'),
(3, 'endale', '1234', 'parent'),
(4, 'lema', 'qwert', 'parent'),
(6, 'debela', '1234', 'parent'),
(7, 'tesfaye', '1234', 'parent'),
(8, 'Solomon', '1234', 'parent'),
(9, 'haile', '1234', 'parent'),
(10, 'abebe', '1234', 'parent'),
(11, 'temam', '1234', 'parent'),
(12, 'defg', '1234', 'parent'),
(13, 'senay', '1234', 'parent'),
(14, 'gezaw', '1234', 'parent');

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
(5, NULL, '2023-05-30', 'polio 0'),
(6, NULL, '2023-06-03', 'BCG'),
(7, NULL, '2023-06-03', 'BCG'),
(8, NULL, '2023-06-03', 'BCG'),
(9, NULL, '2023-06-03', 'BCG'),
(10, NULL, '2023-06-03', 'BCG'),
(11, NULL, '2023-06-03', 'polio 0'),
(12, NULL, '2023-06-03', 'BCG'),
(13, NULL, '2023-06-03', 'BCG'),
(14, 3, '2023-06-04', 'vit_A'),
(15, 2, '2023-06-04', 'vit_A'),
(16, 11, '2023-06-04', 'BCG'),
(17, 1, '2023-06-04', 'BCG'),
(18, 12, '2023-06-04', 'BCG'),
(19, 13, '2023-06-04', 'BCG');

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

--
-- Dumping data for table `vaccine`
--

INSERT INTO `vaccine` (`v_id`, `exp_date`, `received_date`, `ammount`, `v_type`) VALUES
(1, '2023-09-15', '2023-06-01', 498, 'BCG'),
(2, '2023-10-31', '2023-05-24', 200, 'POLIO0'),
(4, '2023-12-31', '2023-05-28', 150, 'PCV'),
(5, '2023-12-31', '2023-06-03', 100, 'VIT-A'),
(6, '2024-01-31', '2023-06-03', 200, 'rota'),
(7, '2024-02-28', '2023-06-03', 300, 'penta'),
(8, '2023-09-03', '2023-06-04', 300, 'BCG');

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
(8, NULL, NULL, 1700, 1, '2023-05-30', NULL),
(9, NULL, NULL, 1300, 1, '2023-06-03', NULL),
(10, NULL, NULL, 1200, 1, '2023-06-03', NULL),
(11, NULL, NULL, 1200, 1, '2023-06-03', NULL),
(12, NULL, NULL, 1200, 1, '2023-06-03', NULL),
(13, NULL, NULL, 1300, 2, '2023-06-03', NULL),
(14, NULL, NULL, 1200, 1, '2023-06-03', NULL),
(15, NULL, NULL, 1200, 1, '2023-06-03', NULL),
(16, NULL, NULL, 1200, 1, '2023-06-03', NULL),
(17, NULL, NULL, 2000, 2, '2023-06-04', NULL),
(18, NULL, NULL, 2000, 2, '2023-06-04', NULL),
(19, NULL, NULL, 2000, 2, '2023-06-04', NULL),
(20, 2, NULL, 2000, 2, '2023-06-04', NULL),
(21, 11, NULL, 2000, 3000, '2023-06-04', NULL),
(22, 1, NULL, 2000, 2, '2023-06-04', NULL),
(23, 12, NULL, 8765, 2, '2023-06-04', NULL),
(24, 13, NULL, 8765, 6, '2023-06-04', NULL);

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
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `generalinformation`
--
ALTER TABLE `generalinformation`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nurseclerk`
--
ALTER TABLE `nurseclerk`
  MODIFY `NC_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `symptom`
--
ALTER TABLE `symptom`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vaccination_record`
--
ALTER TABLE `vaccination_record`
  MODIFY `VR_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vaccine`
--
ALTER TABLE `vaccine`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `variable_child_information`
--
ALTER TABLE `variable_child_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
