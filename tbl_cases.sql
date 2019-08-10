-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2019 at 05:25 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jude`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cases`
--

CREATE TABLE `tbl_cases` (
  `case_id` int(11) NOT NULL,
  `patient_ID` varchar(20) NOT NULL,
  `appointment_id` varchar(20) NOT NULL,
  `symptoms` varchar(1000) DEFAULT NULL,
  `diagnosis` varchar(500) DEFAULT NULL,
  `prescription` varchar(500) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `service` int(11) DEFAULT '0',
  `lab_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cases`
--

INSERT INTO `tbl_cases` (`case_id`, `patient_ID`, `appointment_id`, `symptoms`, `diagnosis`, `prescription`, `date_created`, `service`, `lab_status`) VALUES
(9, 'SNE-FAM-325', 'PT-73381-1', 'sdsd slkdnlsjd ljsldjlksd sldkjsldkj sd lksjd', 'lkds dsldkslkd sdlkjsdlksjd  lksjdlksjdk slkdjsd ksndksjd slkdslkdjlksd', 'llkdsldmlksmdlsdsd;sld ksdlskdsd', '2019-08-07 20:23:01', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cases`
--
ALTER TABLE `tbl_cases`
  ADD PRIMARY KEY (`case_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cases`
--
ALTER TABLE `tbl_cases`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
