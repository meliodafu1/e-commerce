-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 05:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, 'user_account', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `product_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`product_id`, `product_image`) VALUES
(1, 'uploads/p1.avif'),
(2, 'uploads/special-lamb.jpg'),
(3, 'uploads/dry-dog.jpg'),
(4, 'uploads/pet-one.jpg'),
(5, 'uploads/top-breed.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_status` varchar(255) NOT NULL,
  `product_stocks` int(11) NOT NULL,
  `product_description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`id`, `product_name`, `product_price`, `product_status`, `product_stocks`, `product_description`) VALUES
(1, 'High Quality Adult Pedigree Food', 500.00, 'Available', 2019, 'Each recipe below includes its related AAFCO nutrient profile when available on the product’s official webpage: Growth, Maintenance, All Life Stages, Supplemental or Unspecified. Important: Because many websites do not reliably specify which Growth or All Life Stages recipes are safe for large breed puppies, we do not include that data in this report. Be sure to check actual packaging for that information.'),
(2, 'Special Dog Lamb Rice', 1500.00, 'Available', 509, 'Each recipe below includes its related AAFCO nutrient profile when available on the product’s official webpage: Growth, Maintenance, All Life Stages, Supplemental or Unspecified. Important: Because many websites do not reliably specify which Growth or All Life Stages recipes are safe for large breed puppies, we do not include that data in this report. Be sure to check actual packaging for that information.'),
(3, 'Dry Dog Food', 300.00, 'Available', 1051, 'Each recipe below includes its related AAFCO nutrient profile when available on the product’s official webpage: Growth, Maintenance, All Life Stages, Supplemental or Unspecified. Important: Because many websites do not reliably specify which Growth or All Life Stages recipes are safe for large breed puppies, we do not include that data in this report. Be sure to check actual packaging for that information.'),
(4, 'Pet One Pet Food Pet One Adult Maintenance Dry Dog Food 5kg', 2500.00, 'Available', 59, 'Each recipe below includes its related AAFCO nutrient profile when available on the product’s official webpage: Growth, Maintenance, All Life Stages, Supplemental or Unspecified. Important: Because many websites do not reliably specify which Growth or All Life Stages recipes are safe for large breed puppies, we do not include that data in this report. Be sure to check actual packaging for that information.'),
(5, 'Top Breed Dog Meal', 750.00, 'Available', 384, 'Each recipe below includes its related AAFCO nutrient profile when available on the product’s official webpage: Growth, Maintenance, All Life Stages, Supplemental or Unspecified. Important: Because many websites do not reliably specify which Growth or All Life Stages recipes are safe for large breed puppies, we do not include that data in this report. Be sure to check actual packaging for that information.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `Name`, `Email`, `Password`, `updated_at`, `created_at`, `type`, `image`) VALUES
(1, 'maurin.raphael', 'Raphael Maurin', 'graysama29@gmail.com', '$2y$10$8/b5toTv.bzGRT/6qg3a1elLSABIdbCjUDRn8G.dOmuUptvRYlap.', '2023-06-02 20:41:31', '2023-06-02 13:41:31', 'user', 'uploads/Ellipse 1.png'),
(2, 'raphael.maurin', 'Raphael Maurin', 'graysama29@gmail.com', '$2y$10$18dzYwbVoCCDMzJGR617fOMFOWPcryNMiKSpu7z9dg6ldd8u9FI3e', '2023-06-04 18:59:47', '2023-06-02 20:41:38', 'admin', 'uploads/1685933987.png'),
(3, 'meliodafu2', 'Raphael', 'maurin.raphaelmarfe@gmail.com', '$2y$10$hxLkDOG6kv873qvXxXhyZ.GBRYCwNo8XqKMjdLKQbI32q3u1xGN.2', '2023-06-03 05:36:10', '2023-06-02 21:02:07', 'admin', 'uploads/1685745370.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
