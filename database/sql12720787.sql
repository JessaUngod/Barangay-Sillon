-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: sql12.freesqldatabase.com
-- Generation Time: Jul 28, 2024 at 03:14 PM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql12720787`
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
  `time_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `time_in` varchar(250) NOT NULL,
  `hour_in` varchar(250) NOT NULL,
  `time_out` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countofdays`
--

CREATE TABLE `countofdays` (
  `id` int(11) NOT NULL,
  `days` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `time_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loginrec`
--

CREATE TABLE `loginrec` (
  `id` int(11) NOT NULL,
  `login_id` varchar(250) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `tuig` varchar(250) NOT NULL,
  `time_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pos_and_amount`
--

CREATE TABLE `pos_and_amount` (
  `id` int(11) NOT NULL,
  `posistion` varchar(250) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `time_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `countofdays`
--
ALTER TABLE `countofdays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `loginrec`
--
ALTER TABLE `loginrec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `payroll_rec`
--
ALTER TABLE `payroll_rec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pos_and_amount`
--
ALTER TABLE `pos_and_amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
