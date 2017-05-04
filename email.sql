-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2017 at 05:06 
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `email`
--

-- --------------------------------------------------------

--
-- Table structure for table `mail_detail`
--

CREATE TABLE `mail_detail` (
  `mail_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `mail_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_detail`
--

INSERT INTO `mail_detail` (`mail_id`, `username`, `mail_status`) VALUES
(1, 'martin@mail.com', 3),
(2, 'yogi@mail.com', 3),
(3, 'yogi@mail.com', 3),
(4, 'yogi@mail.com', 3),
(5, 'admin@mail.com', 3),
(6, 'martin@mail.com', 3),
(6, 'yogi@mail.com', 3),
(7, 'admin@mail.com', 3),
(8, 'admin@mail.com', 3),
(9, 'yogi@mail.com', 1),
(10, 'yogi@mail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mail_header`
--

CREATE TABLE `mail_header` (
  `mail_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `mail_subject` varchar(255) DEFAULT NULL,
  `mail_message` text,
  `mail_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_header`
--

INSERT INTO `mail_header` (`mail_id`, `username`, `mail_subject`, `mail_message`, `mail_date`) VALUES
(1, 'admin@mail.com', 'Test Subject', 'ini pesan 1', '2017-04-27 15:56:14'),
(2, 'martin@mail.com', 'test', 'pesan yogi 1', '2017-04-27 16:31:34'),
(3, 'martin@mail.com', 'tes', 'coba lagi', '2017-04-29 09:09:22'),
(4, 'martin@mail.com', 'ke yogi', 'ke yogi 1', '2017-05-01 20:46:06'),
(5, 'martin@mail.com', 'ke admin', 'ke admin 1', '2017-05-01 20:46:35'),
(6, 'admin@mail.com', 'aaa', 'aaaa', '2017-05-01 21:46:15'),
(7, 'yogi@mail.com', 'kita coba', 'coba dong', '2017-05-01 22:05:45'),
(8, 'martin@mail.com', 'sdadas', 'sdasdad', '2017-05-03 05:59:38'),
(9, 'admin@mail.com', 'sdasdsd', 'shjgajdkjdhi', '2017-05-03 07:58:39'),
(10, 'martin@mail.com', '123', 'coba', '2017-05-04 16:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `reply_detail`
--

CREATE TABLE `reply_detail` (
  `reply_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `reply_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply_detail`
--

INSERT INTO `reply_detail` (`reply_id`, `username`, `reply_status`) VALUES
(1, 'admin@mail.com', 1),
(2, 'admin@mail.com', 1),
(3, 'martin@mail.com', 1),
(4, 'martin@mail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reply_header`
--

CREATE TABLE `reply_header` (
  `reply_id` int(11) NOT NULL,
  `mail_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `reply_message` text,
  `reply_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply_header`
--

INSERT INTO `reply_header` (`reply_id`, `mail_id`, `username`, `reply_message`, `reply_date`) VALUES
(1, 1, 'martin@mail.com', 'ini pesan 2', '2017-04-27 16:07:58'),
(2, 1, 'martin@mail.com', 'ini pesan 3', '2017-04-27 16:14:28'),
(3, 1, 'admin@mail.com', 'ini pesan 4', '2017-04-27 16:20:59'),
(4, 5, 'admin@mail.com', 'ke martin dari admin', '2017-05-01 20:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `address`) VALUES
('admin', 'admin@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
('martin', 'martin@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
('yogi', 'yogi@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mail_detail`
--
ALTER TABLE `mail_detail`
  ADD PRIMARY KEY (`mail_id`,`username`);

--
-- Indexes for table `mail_header`
--
ALTER TABLE `mail_header`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `reply_detail`
--
ALTER TABLE `reply_detail`
  ADD PRIMARY KEY (`reply_id`,`username`);

--
-- Indexes for table `reply_header`
--
ALTER TABLE `reply_header`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mail_header`
--
ALTER TABLE `mail_header`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `reply_header`
--
ALTER TABLE `reply_header`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
