-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 02:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `age` int(10) NOT NULL,
  `pweight` float NOT NULL,
  `gender` varchar(10) NOT NULL,
  `addr` varchar(200) NOT NULL,
  `cno` decimal(10,0) NOT NULL,
  `medicine` varchar(500) NOT NULL,
  `report` varchar(100) NOT NULL,
  `pid` int(10) NOT NULL,
  `rid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petient_data`
--

INSERT INTO `petient_data` (`pname`, `age`, `pweight`, `gender`, `addr`, `cno`, `medicine`, `report`, `pid`, `rid`) VALUES
('krutik', 23, 82, 'male', 'Karamsad            ', 9328068456, 'azithromacine', '', 2, 2),
('krutik', 32, 50, 'male', 'anand             ', 9328068456, 'azithromacine', '', 2, 6),
('vivek jhala', 22, 58, 'male', '38, jagabhai park                                    ', 7802853147, 'on insuline', 'reports/vivek jhala_report.pdf', 2, 9),
('smiyu', 10, 45, 'male', 'bakrol', 784561397, 'kasuy nai', 'reports/smiyu_report.pdf', 2, 10);

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
  MODIFY `rid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
