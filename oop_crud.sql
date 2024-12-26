-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2024 at 10:06 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oop_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'Ini Adalah Judul Artikel yang Pertama', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore debitis at placeat nemo ipsam! Iste perspiciatis neque tempora corrupti nostrum dolore delectus exercitationem iure? Ab omnis necessitatibus tempora minus ducimus!\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Animi odit provident, mollitia omnis neque rem eos distinctio et dolore tempora sint suscipit, laboriosam possimus atque. Veritatis molestias et impedit est.', '2024-12-26 11:05:48'),
(2, 'Ini Adalah Judul Artikel yang Kedua', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore debitis at placeat nemo ipsam! Iste perspiciatis neque tempora corrupti nostrum dolore delectus exercitationem iure? Ab omnis necessitatibus tempora minus ducimus!\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Animi odit provident, mollitia omnis neque rem eos distinctio et dolore tempora sint suscipit, laboriosam possimus atque. Veritatis molestias et impedit est.', '2024-12-26 11:05:48'),
(3, 'Judul Ketiga', 'Isi artikel ketiga', '2024-12-26 14:16:00'),
(4, 'ini judul keempat', 'isi konten keempat ya', '2024-12-26 14:24:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
