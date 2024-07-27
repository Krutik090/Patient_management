-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2024 at 06:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petientdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `petient_data`
--

CREATE TABLE `petient_data` (
  `pname` varchar(200) NOT NULL,
  `pstatus` int(10) NOT NULL,
  `age` int(10) NOT NULL,
  `pweight` float NOT NULL,
  `gender` varchar(10) NOT NULL,
  `addr` varchar(200) NOT NULL,
  `cno` decimal(10,0) NOT NULL,
  `medicine` varchar(500) NOT NULL,
  `report` varchar(100) NOT NULL,
  `pid` int(10) NOT NULL,
  `rid` int(10) NOT NULL,
  `pdate` date NOT NULL,
  `ptime` varchar(10) NOT NULL,
  `reference` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petient_data`
--

INSERT INTO `petient_data` (`pname`, `pstatus`, `age`, `pweight`, `gender`, `addr`, `cno`, `medicine`, `report`, `pid`, `rid`, `pdate`, `ptime`, `reference`) VALUES
('krutik thakar', 0, 23, 82, 'male', 'karamsad            ', 9328068456, 'azithromacine', 'reports/krutik thakar_report.pdf', 2, 12, '2024-07-23', '8PM-9PM', 'vivek');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `username` varchar(100) NOT NULL,
  `uemail` varchar(50) NOT NULL,
  `mypassword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`username`, `uemail`, `mypassword`) VALUES
('admin', 'admin@123.com', '$2y$10$KUX93NU61w155qz7jbVJseufPycl7Xey.hhtg8JG9Gc4bzB8j20iu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `mypassword` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `mypassword`, `created_at`) VALUES
(2, 'krutikthakar2539@gmail.com', 'krutik thakar', '$2y$10$06R6hgL6wj9JFUh9kxo73uEJ4EuuVv.ZFPKQbfo4xHndJeOwvvtf6', '2024-04-10 10:24:35'),
(3, 'vivek123@gmail.com', 'vivek', '$2y$10$EElp/ZBzJ/6Q0uRVJZISTuMk065f2cmUI5gQtKKcV18mugSlV5z/m', '2024-04-10 10:28:25'),
(4, 'smitcafe123@gmail.com', 'smityo', '$2y$10$1CJBmswm0P9lTEjNZtU3m.PrSIwUabohV5guO/I6Z1w.9NgU5K1Dm', '2024-04-12 05:57:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `petient_data`
--
ALTER TABLE `petient_data`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `petient_data`
--
ALTER TABLE `petient_data`
  MODIFY `rid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `petient_data`
--
ALTER TABLE `petient_data`
  ADD CONSTRAINT `petient_data_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
