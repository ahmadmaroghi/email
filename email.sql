-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Mei 2017 pada 21.16
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.5.30

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
-- Struktur dari tabel `mail_detail`
--

CREATE TABLE `mail_detail` (
  `mail_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `mail_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mail_detail`
--

INSERT INTO `mail_detail` (`mail_id`, `username`, `mail_status`) VALUES
(1, 'martin@mail.com', 2),
(3, 'martin@mail.com', 2),
(4, 'admin@mail.com', 3),
(5, 'martin@mail.com', 2),
(6, 'martin@mail.com', 2),
(7, 'admin@mail.com', 2),
(8, 'martin@mail.com', 2),
(9, 'admin@mail.com', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail_header`
--

CREATE TABLE `mail_header` (
  `mail_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `mail_subject` varchar(255) DEFAULT NULL,
  `mail_message` text,
  `mail_date` datetime DEFAULT NULL,
  `mail_parent` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mail_header`
--

INSERT INTO `mail_header` (`mail_id`, `username`, `mail_subject`, `mail_message`, `mail_date`, `mail_parent`) VALUES
(1, 'admin@mail.com', 'tanya kabar', 'gimana kabar lu tin?', '2017-05-11 09:35:56', 0),
(2, 'martin@mail.com', 'tanya kabar', 'babi lu', '2017-05-11 09:36:06', 1),
(3, 'admin@mail.com', 'tanya kabar', 'anjing batak', '2017-05-11 09:36:19', 2),
(4, 'martin@mail.com', 'tanya kabar', 'ribut yuk', '2017-05-11 09:36:34', 3),
(5, 'admin@mail.com', 'tanya kabar', 'ayuk hahahah', '2017-05-11 09:36:48', 4),
(6, 'admin@mail.com', 'sdfasfa', 'dfdsfsdf', '2017-05-11 09:51:20', NULL),
(7, 'martin@mail.com', 'RE : sdfasfa', 'jhgsdghjsda', '2017-05-11 09:51:42', 6),
(8, 'admin@mail.com', 'RE : RE : sdfasfa', 'jsdjbas,jdba', '2017-05-11 09:51:58', 7),
(9, 'martin@mail.com', 'RE : RE : sdfasfa', '', '2017-05-11 10:04:07', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
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
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
