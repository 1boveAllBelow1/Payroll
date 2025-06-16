-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2025 at 06:04 PM
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
-- Database: `payroll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_pass`) VALUES
(2025001, ''),
(1, ''),
(2025001, '12');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_name` varchar(10) NOT NULL,
  `Salary` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_name`, `Salary`) VALUES
('fgfgf', 45),
('sds', 34),
('erere', 34),
('sds', 2),
('ere', 34),
('tty', 34);

-- --------------------------------------------------------

--
-- Table structure for table `employee_credentials`
--

CREATE TABLE `employee_credentials` (
  `employee_id` int(10) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` int(100) NOT NULL,
  `class_name` varchar(10) NOT NULL,
  `branch` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_credentials`
--

INSERT INTO `employee_credentials` (`employee_id`, `full_name`, `email`, `mobile_no`, `class_name`, `branch`, `password`) VALUES
(2025001, 'John Doe', 'hwuehdwhw@yahoo.com', 6666666, '', 'IT', '$2y$10$5Fl7CGKO1dvDrPeCC/fWY.woP/gRLe9njGRTVz78deF32/DQOBbaq');

-- --------------------------------------------------------

--
-- Table structure for table `employee_payroll`
--

CREATE TABLE `employee_payroll` (
  `payroll_id` int(11) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `class_name` varchar(100) DEFAULT NULL,
  `base_salary` decimal(10,2) DEFAULT NULL,
  `sss_deduction` decimal(10,2) DEFAULT NULL,
  `philhealth_deduction` decimal(10,2) DEFAULT NULL,
  `pagibig_deduction` decimal(10,2) DEFAULT NULL,
  `taxable_income` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `net_income` decimal(10,2) DEFAULT NULL,
  `payroll_month` int(11) NOT NULL,
  `payroll_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_payroll`
--

INSERT INTO `employee_payroll` (`payroll_id`, `employee_id`, `class_name`, `base_salary`, `sss_deduction`, `philhealth_deduction`, `pagibig_deduction`, `taxable_income`, `tax`, `net_income`, `payroll_month`, `payroll_year`) VALUES
(3, 2025001, '1', 17100.00, 769.50, 855.00, 400.00, 15075.50, 0.00, 12060.40, 2, 2024);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_credentials`
--
ALTER TABLE `employee_credentials`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employee_payroll`
--
ALTER TABLE `employee_payroll`
  ADD PRIMARY KEY (`payroll_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_credentials`
--
ALTER TABLE `employee_credentials`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2025006;

--
-- AUTO_INCREMENT for table `employee_payroll`
--
ALTER TABLE `employee_payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_payroll`
--
ALTER TABLE `employee_payroll`
  ADD CONSTRAINT `employee_payroll_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee_credentials` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
