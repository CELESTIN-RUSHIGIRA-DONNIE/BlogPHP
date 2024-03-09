-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2024 at 10:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `links` varchar(50) NOT NULL,
  `creat_id` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `subtitle`, `description`, `links`, `creat_id`) VALUES
(1, 'Design', 'super Design', 'vsfejijriowwwwwwwwwwwwwwwwwwwww', 'ww.isig.ac.cd', '2024-01-23 10:27:42'),
(3, 'Design', 'Design cloth', 'cagewqmm', 'vagqpq', '2024-01-27 09:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `departmentcategory`
--

CREATE TABLE `departmentcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departmentcategory`
--

INSERT INTO `departmentcategory` (`id`, `name`, `description`, `image`, `created_at`) VALUES
(1, 'INFORMATIC', 'cdhqwujank', 'avatar-06.jpg', '2024-01-27 08:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `dept_categ_list`
--

CREATE TABLE `dept_categ_list` (
  `id` int(11) NOT NULL,
  `dept_cate_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `section` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dept_categ_list`
--

INSERT INTO `dept_categ_list` (`id`, `dept_cate_id`, `name`, `description`, `section`) VALUES
(1, 1, 'Software', 'vgaelnl', 'IF');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `visible` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `designation`, `description`, `image`, `visible`, `created_at`) VALUES
(2, 'MEDECINE', 'MED', 'eqwsdqqd', 'avatar-01.jpg', 0, '2024-01-22 10:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `creat_id` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `username`, `email`, `password`, `usertype`, `creat_id`) VALUES
(1, 'CELESTIN RUSHIGIRA', 'cele@gmail.com', '00', 'user', '2024-01-22 09:31:46'),
(3, 'DONNIE', 'fatuma32@gmail.com', '11', 'admin', '2024-01-22 09:48:07'),
(5, 'FATUMA ASSANI', 'fat@gmail.com', '12', 'admin', '2024-01-27 08:46:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departmentcategory`
--
ALTER TABLE `departmentcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept_categ_list`
--
ALTER TABLE `dept_categ_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_cate_id` (`dept_cate_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departmentcategory`
--
ALTER TABLE `departmentcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dept_categ_list`
--
ALTER TABLE `dept_categ_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dept_categ_list`
--
ALTER TABLE `dept_categ_list`
  ADD CONSTRAINT `dept_categ_list_ibfk_1` FOREIGN KEY (`dept_cate_id`) REFERENCES `departmentcategory` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
