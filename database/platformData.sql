-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 02:44 PM
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
-- Database: `donations_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `needs`
--

CREATE TABLE `needs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `need_status` varchar(255) NOT NULL DEFAULT 'open',
  `amount` decimal(10,2) NOT NULL,
  `collected_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `image_path` varchar(255) DEFAULT NULL,
  `supp_doc` varchar(255) DEFAULT NULL,
  `isUrgent` tinyint(1) NOT NULL DEFAULT 0,
  `need_type` varchar(255) NOT NULL DEFAULT 'need',
  `national_id` varchar(20) NOT NULL,
  `rqst_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `needs`
--

INSERT INTO `needs` (`id`, `user_id`, `title`, `description`, `status`, `need_status`, `amount`, `collected_amount`, `image_path`, `supp_doc`, `isUrgent`, `need_type`, `national_id`, `rqst_date`, `created_at`, `updated_at`, `category`) VALUES
(2, 5, 'مشروع سقيا', 'حفر بئر في قرية حفير مشو', 'pending', 'open', 450000.00, 450000.00, 'water.jpeg', NULL, 0, 'need', '', '2025-03-26', '2025-03-26 11:10:38', '2025-05-02 08:47:17', 'others'),
(3, 5, 'مشروع اطعام النازحين', 'توفير مواد غذائية للنازحين المقيمين في ام درمان.', 'approved', 'open', 2690000.00, 65000.00, 'feeding.jpeg', NULL, 1, 'need', '', '2025-03-26', '2025-03-26 11:12:29', '2025-04-29 15:32:46', 'food'),
(5, 1, 'عملية جراجية', 'حوجة الى المساعدة في سداد رسوم عملية قلب مفتوح', 'pending', 'open', 1200000.00, 0.00, 'sur_prc.jpeg', NULL, 1, 'need', '', '2025-04-03', '2025-04-04 00:17:00', '2025-04-04 00:17:00', 'health'),
(6, 1, 'حوجة الى سكن لنازح', 'حوجة الى السكن بعد النزوح جراء الحرب', 'pending', 'open', 650000.00, 0.00, 'destroyed.jpeg', NULL, 0, 'need', '', '2025-04-03', '2025-04-04 00:19:54', '2025-04-04 00:19:54', 'others'),
(7, 1, 'حوجة الى دواء', 'حوجة الى دواء مرض سكري', 'pending', 'open', 50000.00, 0.00, 'drugs.jpg', NULL, 1, 'need', '', '2025-04-03', '2025-04-04 00:22:23', '2025-04-04 00:22:23', 'health'),
(8, 1, 'مراجعة الطبيب', 'حوجة الى مراجعة الطبيب و صرف الادوية', 'pending', 'open', 250000.00, 0.00, 'doctor_review.jpg', NULL, 0, 'need', '', '2025-04-03', '2025-04-04 00:23:54', '2025-04-04 00:23:54', 'health'),
(9, 1, 'الحصول على ادوات مدرسية', 'الحصول على ملابس مدرسة و الادوات المدرسية', 'pending', 'open', 180000.00, 0.00, 'sch_tools.png', NULL, 0, 'need', '', '2025-04-03', '2025-04-04 00:25:45', '2025-04-04 00:25:45', 'education'),
(11, 1, 'سداد رسوم مستشفى', 'الحوجة الى سداد رسوم مستشفى', 'pending', 'open', 3450000.00, 4000.00, 'process.jpeg', NULL, 1, 'need', '', '2025-04-03', '2025-04-04 00:29:06', '2025-04-07 17:16:56', 'health'),
(12, 1, 'سداد رسوم مدرسة', 'للتمكن من الجلوس للامتحان و استخراج النتيجة', 'pending', 'open', 7230000.00, 0.00, 'school.webp', NULL, 0, 'need', '', '2025-04-03', '2025-04-04 00:30:43', '2025-04-04 00:30:43', 'education');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `needs`
--
ALTER TABLE `needs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `needs_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `needs`
--
ALTER TABLE `needs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `needs`
--
ALTER TABLE `needs`
  ADD CONSTRAINT `needs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
