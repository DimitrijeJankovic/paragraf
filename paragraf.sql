-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2018 at 04:59 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paragraf`
--

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `policy_id` int(11) NOT NULL,
  `insurance_carrier` varchar(128) NOT NULL,
  `mobile` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `starting_date` date NOT NULL,
  `end_date` date NOT NULL,
  `name_of_insured` varchar(64) NOT NULL,
  `surname_of_insured` varchar(64) NOT NULL,
  `email_of_insured` varchar(128) NOT NULL,
  `date_of_birth_of_insured` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`policy_id`, `insurance_carrier`, `mobile`, `email`, `starting_date`, `end_date`, `name_of_insured`, `surname_of_insured`, `email_of_insured`, `date_of_birth_of_insured`, `date_created`) VALUES
(1, 'Dimitrije Jankovic', '+381601479990', 'dimitrije_jankovic@outlook.com', '2018-12-01', '2018-11-08', 'Pera', 'Ivanovic', 'pera@gmail.com', '1994-11-01', '2018-11-19 00:39:06'),
(2, 'Dragana Lavrnja', '+381601504030', 'dada@gmail.com', '2018-11-07', '2018-11-24', 'Marko ', 'Peric', 'mare@gmail.com', '1992-11-06', '2018-11-19 01:54:14'),
(15, 'das', '+381601479990', 'a@gmail.com', '2018-02-02', '2018-03-01', 'Dimitrije Jankovic', 'Jankovic', 'ad@s.com', '2018-01-01', '2018-11-20 04:56:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`policy_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
  MODIFY `policy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
