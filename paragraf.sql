-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2018 at 04:25 AM
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
-- Table structure for table `insured`
--

CREATE TABLE `insured` (
  `insured_id` int(11) NOT NULL,
  `policie_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `insured_email` varchar(128) NOT NULL,
  `born` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insured`
--

INSERT INTO `insured` (`insured_id`, `policie_id`, `name`, `insured_email`, `born`) VALUES
(14, 2, 'a a', 'adsa@s.com', '2019-02-01'),
(15, 2, 'Dika Jankovic', 'dika@gmail.com', '2019-02-01'),
(16, 2, 'Dada L', 'dl@gmail.com', '2018-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `policie`
--

CREATE TABLE `policie` (
  `policie_id` int(11) NOT NULL,
  `carrier_of_policy` varchar(128) NOT NULL,
  `car_mobile` varchar(64) NOT NULL,
  `car_email` varchar(128) NOT NULL,
  `starts` date NOT NULL,
  `ends` date NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `policie`
--

INSERT INTO `policie` (`policie_id`, `carrier_of_policy`, `car_mobile`, `car_email`, `starts`, `ends`, `created`) VALUES
(1, 'Dimitrije Jankovic', '+381601479990', 'dika@gmail.com', '2018-11-01', '2018-11-02', '2018-11-21 22:22:56'),
(2, 'Dragana Lavrnja', '+381601504030', 'dl@gmail.com', '2018-11-09', '2018-11-17', '2018-11-21 22:29:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `insured`
--
ALTER TABLE `insured`
  ADD PRIMARY KEY (`insured_id`);

--
-- Indexes for table `policie`
--
ALTER TABLE `policie`
  ADD PRIMARY KEY (`policie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `insured`
--
ALTER TABLE `insured`
  MODIFY `insured_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `policie`
--
ALTER TABLE `policie`
  MODIFY `policie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
