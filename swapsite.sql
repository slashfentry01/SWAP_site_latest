-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 04:28 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swapsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `number` int(15) DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `zone` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `number`, `image`, `role`, `zone`) VALUES
('admin', 'admin@test.com', '$2y$10$IKTP1HP8XPLFXMcPZip9xuqmqPHG9kUoGqYHy2Nfe4aVWNCQRnaQm', 999, 'McDonalds-Drive-Thru.jpg', 'admin', 'all'),
('bai', 'bai@bai.com', '$2y$10$nyjcgxWqbzes6tqtZ06wPOm8QhIRw/CWrm7h..cQ46NZxR83oQNrO', 123, 'yusuf picture.jpeg', 'admin', 'inventory'),
('doog', 'doog@gmail.com', '$2y$10$qQvwobAuVTo0NPFDv5BUDew.1ma5TZWRq4UaMeuA4JUal192h3oay', 85330637, 'yusuf picture.jpeg', 'admin', 'stores'),
('hehehe', 'hehehe@hi.com', '$2y$10$B51Doytth74db2dZRuhW2Ow.iO3Bxs8DAJxIvfcNFRetBlOBDkypi', 86777, 'yusuf picture.jpeg', 'admin', 'stores'),
('inventory', 'inventory@test.com', '$2y$10$IKTP1HP8XPLFXMcPZip9xuqmqPHG9kUoGqYHy2Nfe4aVWNCQRnaQm', 123, 'jayPrichett.jpg', 'admin', 'inventory'),
('popo', 'popo@popo.coom', '$2y$10$f3QixjciMbAkBgXzPzGbEevQ3p5aenktrywelqkfWSzOKOXoZT8nG', 123, 'yusuf picture.jpeg', 'admin', 'normal user'),
('qwert', 'qw@qw.com', '$2y$10$eJp8NR2skAj6WP/r34Lr0edvR9AEVR3hUkcQkTTA8V8tbsCrUmdnm', 123, 'securit.jpg', 'admin', 'all'),
('user', 'user@test.com', '$2y$10$3XVf.QMsGIvd6Sx6.l39qu6gMB0jcttS/9/zNDEpro0lMLBc6EP2G', 123, 'jayPrichett.jpg', 'users', 'normaluser'),
('yoo', 'yoo@yoo.com', '$2y$10$0qI0MJtrNQftq5ujROvTj.E2oSMxwWRdBMyrPyh7e8glivaEhc.Nm', 12345, 'yusuf picture.jpeg', 'admin', 'all');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
