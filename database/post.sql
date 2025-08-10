-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Aug 10, 2025 at 11:01 AM
-- Server version: 9.4.0
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `created_at`) VALUES
('373a4eb8-75d9-11f0-bdb8-3ac9d974984d', 'frist post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum tempor arcu. Ut laoreet lectus accumsan laoreet scelerisque. Nulla dictum arcu ut condimentum efficitur. In lectus est, euismod ac orci id, ultrices ornare est. Ut nec tempus justo. Cras ultrices tellus nec arcu molestie interdum. Curabitur et orci magna. Donec eget libero lorem.\r\n\r\nSed tristique magna id diam condimentum, ac imperdiet lorem aliquet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam et nibh aliquet, porta felis a, rhoncus lacus. Aliquam vestibulum diam ligula, vel suscipit leo sollicitudin a. Sed vestibulum turpis eleifend bibendum porta. Duis tincidunt mattis fringilla. Donec ultrices est non libero ultrices pretium. Nullam viverra dolor ut ipsum elementum semper. Donec pellentesque arcu eget scelerisque dignissim. Sed vulputate dapibus erat, ac maximus mi sodales sed. Praesent at nisl tortor.\r\n\r\nMaecenas vehicula varius dui, non congue felis porttitor ac. Fusce finibus nibh eu est congue pellentesque. In tristique ex at mauris placerat dapibus. In eleifend felis in quam fermentum imperdiet. Phasellus finibus nunc at felis lobortis porttitor. Proin ac magna a sem porttitor dignissim. Morbi eleifend tempus velit, ut posuere purus placerat ut.\r\n\r\nNunc faucibus congue mauris nec mattis. Pellentesque ac metus suscipit, fermentum sem facilisis, dapibus enim. Praesent velit nibh, sodales in odio in, gravida ultricies turpis. Sed egestas tellus eget justo ornare tempus. Quisque accumsan, massa ut egestas interdum, velit ante lobortis purus, sed dictum risus erat ac turpis. Morbi a dignissim lacus, quis luctus eros. Praesent vel mollis enim. Maecenas sollicitudin viverra ex quis faucibus. Curabitur ac magna hendrerit, blandit nisl eget, sollicitudin enim. Vivamus pharetra urna ligula, at sodales lacus hendrerit sed. Ut ac mattis justo.\r\n\r\nNullam tempor volutpat justo id vestibulum. Nullam consequat vestibulum urna ac consectetur. Sed eleifend fermentum blandit. Etiam ex massa, varius ut nibh sed, molestie viverra nunc. Cras tincidunt congue ligula, non condimentum orci lobortis quis. Duis efficitur nisi a porttitor eleifend. In eu tellus in erat pellentesque eleifend. Integer pellentesque pulvinar ex imperdiet auctor. Aliquam tincidunt ante id turpis rutrum luctus. ', '2025-08-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
