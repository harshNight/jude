-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2019 at 04:00 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

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
-- Table structure for table `login_table`
--

CREATE TABLE `login_table` (
  `login_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `authority` int(4) NOT NULL,
  `last_seen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_table`
--

INSERT INTO `login_table` (`login_id`, `username`, `password`, `authority`, `last_seen`) VALUES
(1, 'gabby', '1234', 1, '2019-08-04 18:45:38');

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
  `service` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cases`
--

INSERT INTO `tbl_cases` (`case_id`, `patient_ID`, `appointment_id`, `symptoms`, `diagnosis`, `prescription`, `date_created`, `service`) VALUES
(9, 'SNE-FAM-325', 'PT-73381-1', 'gfglv flgtklj', 'fkhkg mghgkuhuyiu ggtkykuki hgkgtk fkhgkgkgk\ngchvjlkhkhk;lhk kglgkggkjg\n\n,blgljghl', 'mfljglgjl\ngdfhfk\nfkgjl\nkgl', '2019-08-07 20:23:01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_card`
--

CREATE TABLE `tbl_company_card` (
  `comp_id` int(11) NOT NULL,
  `company_ID` varchar(20) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_address` varchar(100) NOT NULL,
  `company_phone` varchar(15) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_company_card`
--

INSERT INTO `tbl_company_card` (`comp_id`, `company_ID`, `company_name`, `company_address`, `company_phone`, `date_created`) VALUES
(1, 'COM-2442', 'james electronics', 'no 7 poly road, auchi', '08192837483', '2019-08-04 20:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kin`
--

CREATE TABLE `tbl_kin` (
  `kin_id` int(11) NOT NULL,
  `kin_name` varchar(50) NOT NULL,
  `kin_phone` varchar(15) NOT NULL,
  `kin_address` varchar(100) NOT NULL,
  `kin_relationship` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kin`
--

INSERT INTO `tbl_kin` (`kin_id`, `kin_name`, `kin_phone`, `kin_address`, `kin_relationship`) VALUES
(1, 'joseph david', '8227384738', 'sameas parent', 'son');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_biodata`
--

CREATE TABLE `tbl_patient_biodata` (
  `p_id` int(11) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `othernames` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `DOB` varchar(15) NOT NULL,
  `LGA` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `kin_ID` int(11) NOT NULL,
  `card_type` varchar(20) NOT NULL,
  `card_category` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `family_card_id` varchar(50) DEFAULT NULL,
  `patient_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_patient_biodata`
--

INSERT INTO `tbl_patient_biodata` (`p_id`, `surname`, `othernames`, `phone`, `address`, `sex`, `marital_status`, `DOB`, `LGA`, `state`, `nationality`, `occupation`, `religion`, `kin_ID`, `card_type`, `card_category`, `date_created`, `family_card_id`, `patient_ID`) VALUES
(1, 'omoh', 'joseph', '8138493847', 'no 4 aviele auchi', 'male', '0', '2019-08-07', 'estako central', 'edo state', 'nigerian', 'teacher', 'christian', 1, '1', 2, 2147483647, 'COM-2442', 'SNE-FAM-325');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_table`
--
ALTER TABLE `login_table`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tbl_cases`
--
ALTER TABLE `tbl_cases`
  ADD PRIMARY KEY (`case_id`);

--
-- Indexes for table `tbl_company_card`
--
ALTER TABLE `tbl_company_card`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `tbl_kin`
--
ALTER TABLE `tbl_kin`
  ADD PRIMARY KEY (`kin_id`);

--
-- Indexes for table `tbl_patient_biodata`
--
ALTER TABLE `tbl_patient_biodata`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_table`
--
ALTER TABLE `login_table`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cases`
--
ALTER TABLE `tbl_cases`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_company_card`
--
ALTER TABLE `tbl_company_card`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_kin`
--
ALTER TABLE `tbl_kin`
  MODIFY `kin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_patient_biodata`
--
ALTER TABLE `tbl_patient_biodata`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
