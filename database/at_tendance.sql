-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 04:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `at_tendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `uname` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `img` varchar(250) NOT NULL,
  `time_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `mname`, `lname`, `age`, `gender`, `uname`, `pass`, `img`, `time_create`) VALUES
(1, 'ADMIN', 'ADMIN', 'ADMIN', '22', 'male', 'admin', 'admin123', 'sillon.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(250) NOT NULL,
  `time_in` date NOT NULL DEFAULT current_timestamp(),
  `hour_in` time NOT NULL DEFAULT current_timestamp(),
  `time_out` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `emp_id`, `time_in`, `hour_in`, `time_out`, `status`) VALUES
(85, 'S24000024', '2024-07-19', '10:35:16', 'July 19, 2024 10:35 AM', 'Late Time In'),
(86, 'S24000048', '2024-07-19', '10:36:07', '', 'Late Time In');

-- --------------------------------------------------------

--
-- Table structure for table `countofdays`
--

CREATE TABLE `countofdays` (
  `id` int(11) NOT NULL,
  `days` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countofdays`
--

INSERT INTO `countofdays` (`id`, `days`) VALUES
(27, '24-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `dob` varchar(250) NOT NULL,
  `age` int(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `posistion` varchar(250) NOT NULL,
  `money` int(100) NOT NULL,
  `img` varchar(250) NOT NULL,
  `time_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `emp_id`, `fname`, `mname`, `lname`, `dob`, `age`, `gender`, `posistion`, `money`, `img`, `time_create`) VALUES
(23, 'S24000000', 'ays', 'd', 'ajdjkb', '2018-01-30', 6, 'Male', 'Tanod', 200, 'Screenshot (2).png', '2024-07-19 02:33:30'),
(24, 'S24000024', 'hvj', 'hvjjhv', 'jhv', '2024-07-10', 0, 'Male', 'Tanod', 200, 'Screenshot_20240703-152057_1.png', '2024-07-19 02:34:07'),
(25, 'S24000048', 'vjg', 'jv', 'jhvjhv', '2024-07-10', 0, 'Female', 'Tanod', 200, '2022-04-30 11_50_10.060+0800.jpg', '2024-07-19 02:35:50');

-- --------------------------------------------------------

--
-- Table structure for table `loginrec`
--

CREATE TABLE `loginrec` (
  `id` int(11) NOT NULL,
  `login_id` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `login` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loginrec`
--

INSERT INTO `loginrec` (`id`, `login_id`, `fname`, `login`, `logout`) VALUES
(32, 'S24000000', 'ays', '2024-07-19 02:33:07', '');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_rec`
--

CREATE TABLE `payroll_rec` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `dob` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `position` varchar(250) NOT NULL,
  `wages` varchar(250) NOT NULL,
  `buwan` varchar(250) NOT NULL,
  `tuig` year(4) NOT NULL DEFAULT current_timestamp(),
  `time_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll_rec`
--

INSERT INTO `payroll_rec` (`id`, `emp_id`, `fname`, `mname`, `lname`, `dob`, `age`, `gender`, `position`, `wages`, `buwan`, `tuig`, `time_time`) VALUES
(16, 'S24000000', 'ays', 'd', 'ajdjkb', '2018-01-30', '6', 'Male', 'Tanod', '150', 'July', '2024', '2024-07-19 02:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `pos_and_amount`
--

CREATE TABLE `pos_and_amount` (
  `id` int(11) NOT NULL,
  `posistion` varchar(250) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_and_amount`
--

INSERT INTO `pos_and_amount` (`id`, `posistion`, `amount`, `time_created`) VALUES
(16, 'Tanod', '200', '2024-07-19 02:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `mname` varchar(250) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `dob` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `c_number` varchar(250) NOT NULL,
  `uname` varchar(250) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `img` varchar(250) NOT NULL,
  `time_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `fname`, `mname`, `lname`, `dob`, `age`, `gender`, `c_number`, `uname`, `pass`, `img`, `time_create`) VALUES
(18, 'ays', 'd', 'ajdjkb', '2018-01-30', '6', 'Male', '12345678900', '123', '12345678900', 'IMG_20220625_184040_387.jpg', '2024-07-19 02:26:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countofdays`
--
ALTER TABLE `countofdays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginrec`
--
ALTER TABLE `loginrec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_rec`
--
ALTER TABLE `payroll_rec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_and_amount`
--
ALTER TABLE `pos_and_amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `countofdays`
--
ALTER TABLE `countofdays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `loginrec`
--
ALTER TABLE `loginrec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `payroll_rec`
--
ALTER TABLE `payroll_rec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pos_and_amount`
--
ALTER TABLE `pos_and_amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
