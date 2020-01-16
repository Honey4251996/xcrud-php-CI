-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2019 at 08:44 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alhawaj1_4season_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `area_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `area_name`) VALUES
(1, 'A ali'),
(2, 'Adliya'),
(3, 'Al Dur'),
(4, 'Al-Malikiyah'),
(5, 'AlSeef'),
(6, 'Amwaj Island'),
(7, 'Arad'),
(8, 'Budaiya'),
(9, 'Busaiteen'),
(10, 'Diyar AlMuharraq'),
(11, 'Hamad Town'),
(12, 'Hidd'),
(13, 'Hoora'),
(14, 'Isa Town'),
(15, 'Jid Ali'),
(16, 'Jidhafs'),
(17, 'Jurdab'),
(18, 'Mahooz'),
(19, 'Manama'),
(20, 'Muharraq'),
(21, 'Qudaibiya'),
(22, 'Riffa'),
(23, 'Saar'),
(24, 'Salmabad'),
(25, 'Sanabis'),
(26, 'Sitra'),
(27, 'Tubli');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `tel_num` varchar(25) NOT NULL,
  `mobile_num` varchar(25) NOT NULL,
  `building` varchar(20) DEFAULT NULL,
  `road` varchar(20) DEFAULT NULL,
  `block` varchar(5) DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `remark` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `tel_num`, `mobile_num`, `building`, `road`, `block`, `area`, `address`, `remark`, `status`, `created_by`, `created_at`) VALUES
(8, 'Hussainm', '', '000000000', NULL, NULL, NULL, NULL, '', '', 1, 1, '2018-05-05 10:12:00'),
(9, 'Ali', '', '212000000', NULL, NULL, NULL, NULL, '', '', 1, 1, '2018-05-05 10:13:02'),
(10, 'Hussain jh', '', '3333333', NULL, NULL, NULL, NULL, '322g - 611 - 506', '', 1, 1, '2018-05-05 10:18:27'),
(11, 'Hussain aljawad', '', '36141481', NULL, NULL, NULL, NULL, '322 - 611 - 506', '', 1, 1, '2018-08-09 20:06:57'),
(12, 'Hussain jannousan', '', '36228299', NULL, NULL, NULL, NULL, '322 - 611 - 506', '', 1, 1, '2018-12-01 23:02:20'),
(13, 'Barbar', '', '36228298', NULL, NULL, NULL, NULL, '', '', 1, 1, '2018-12-01 23:15:54'),
(14, 'Sanad', '', '3456', NULL, NULL, NULL, NULL, '', '', 1, 1, '2018-12-01 23:18:50'),
(15, 'Sanad', '', '23372', NULL, NULL, NULL, NULL, '', '', 1, 1, '2018-12-01 23:19:35'),
(16, 'Sanad', '123345', '3456ss', NULL, NULL, NULL, NULL, '', '', 1, 1, '2018-12-01 23:20:33'),
(17, 'Sitra', '', '23457573', NULL, NULL, NULL, NULL, '', '', 1, 1, '2018-12-01 23:22:54'),
(18, 'Huusain garden', '', '36141451', NULL, NULL, NULL, NULL, '', 'My gardeen', 1, 1, '2018-12-09 00:37:30'),
(19, 'Customer - 38223822', '', '38223822', '3131', '13431', NULL, 2, '', '', 1, 1, '2019-04-17 16:29:15'),
(20, 'Customer - 382238221', '', '382238221', '233', '3566', '35', 2, '', '', 1, 1, '2019-04-17 16:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `ex_actions`
--

CREATE TABLE `ex_actions` (
  `ex_action_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `ex_action_type_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ex_actions`
--

INSERT INTO `ex_actions` (`ex_action_id`, `order_id`, `ex_action_type_id`, `created_by`, `created_at`) VALUES
(3, 3, 1, 1, '2018-05-05 10:13:56'),
(4, 4, 1, 1, '2018-05-05 10:15:58'),
(5, 5, 1, 1, '2018-05-05 10:16:46'),
(6, 6, 1, 1, '2018-05-05 10:19:01'),
(7, 5, 2, 1, '2018-05-05 10:21:00'),
(8, 3, 2, 1, '2018-05-05 10:22:04'),
(9, 7, 1, 1, '2018-05-05 10:36:00'),
(10, 6, 2, 1, '2018-05-05 11:14:11'),
(11, 8, 1, 1, '2018-05-05 14:58:37'),
(12, 9, 1, 1, '2018-05-23 12:15:06'),
(13, 9, 2, 1, '2018-05-23 12:18:26'),
(14, 10, 1, 1, '2018-08-09 20:07:12'),
(15, 10, 2, 1, '2018-08-10 13:31:27'),
(16, 4, 2, 1, '2018-08-10 13:35:35'),
(17, 8, 2, 1, '2018-10-21 23:57:23'),
(18, 7, 2, 1, '2018-10-21 23:57:33'),
(19, 11, 1, 1, '2018-11-29 10:46:15'),
(20, 12, 1, 1, '2018-12-01 23:02:35'),
(21, 13, 1, 1, '2018-12-01 23:15:57'),
(22, 14, 1, 1, '2018-12-01 23:19:40'),
(23, 15, 1, 1, '2018-12-01 23:20:42'),
(24, 16, 1, 1, '2018-12-01 23:23:11'),
(25, 16, 2, 1, '2018-12-01 23:25:47'),
(26, 15, 2, 1, '2018-12-01 23:26:07'),
(27, 17, 1, 1, '2018-12-09 00:37:36'),
(28, 18, 1, 1, '2018-12-09 00:50:49'),
(29, 12, 2, 1, '2018-12-09 00:57:59'),
(30, 18, 2, 1, '2018-12-09 00:58:20'),
(31, 17, 2, 1, '2018-12-09 00:59:21'),
(32, 19, 1, 3, '2018-12-09 01:15:09'),
(33, 19, 2, 3, '2018-12-09 01:15:23'),
(34, 20, 1, 1, '2019-01-19 18:15:35'),
(35, 21, 1, 1, '2019-01-19 18:16:06'),
(36, 22, 1, 1, '2019-01-19 18:16:26'),
(37, 22, 2, 1, '2019-01-19 18:16:46'),
(38, 23, 1, 1, '2019-03-31 16:49:36'),
(39, 24, 1, 1, '2019-04-07 17:16:29'),
(40, 25, 1, 1, '2019-04-07 17:53:30'),
(41, 26, 1, 1, '2019-04-07 17:53:50'),
(42, 27, 1, 1, '2019-04-07 17:56:21'),
(43, 28, 1, 1, '2019-04-07 17:57:24'),
(44, 29, 1, 1, '2019-04-07 18:16:25'),
(45, 30, 1, 1, '2019-04-07 18:26:12'),
(46, 31, 1, 1, '2019-04-07 23:26:33'),
(47, 32, 1, 1, '2019-04-07 23:39:24'),
(48, 33, 1, 1, '2019-04-07 23:42:35'),
(49, 34, 1, 1, '2019-04-07 23:44:52'),
(50, 35, 1, 1, '2019-04-07 23:48:25'),
(51, 36, 1, 1, '2019-04-07 23:50:19'),
(52, 37, 1, 1, '2019-04-08 11:54:20'),
(53, 38, 1, 1, '2019-04-08 11:55:16'),
(54, 39, 1, 1, '2019-04-08 12:02:13'),
(55, 40, 1, 1, '2019-04-08 12:17:54'),
(56, 41, 1, 1, '2019-04-08 12:24:18'),
(57, 42, 1, 1, '2019-04-08 12:32:10'),
(58, 43, 1, 1, '2019-04-08 12:35:51'),
(59, 44, 1, 1, '2019-04-08 12:49:10'),
(60, 45, 1, 1, '2019-04-08 12:51:12'),
(61, 46, 1, 1, '2019-04-08 15:32:11'),
(62, 47, 1, 1, '2019-04-09 08:39:12'),
(63, 48, 1, 1, '2019-04-09 08:40:02'),
(64, 49, 1, 1, '2019-04-09 11:07:22'),
(65, 50, 1, 1, '2019-04-09 11:11:49'),
(66, 51, 1, 1, '2019-04-09 11:16:07'),
(67, 52, 1, 1, '2019-04-09 11:17:35'),
(68, 53, 1, 1, '2019-04-09 11:20:02'),
(69, 54, 1, 1, '2019-04-09 11:25:44'),
(70, 55, 1, 1, '2019-04-09 11:32:20'),
(71, 56, 1, 1, '2019-04-09 11:33:01'),
(72, 57, 1, 1, '2019-04-09 12:48:39'),
(73, 58, 1, 1, '2019-04-09 13:59:41'),
(74, 59, 1, 1, '2019-04-09 14:06:47'),
(75, 60, 1, 1, '2019-04-09 14:08:10'),
(76, 61, 1, 1, '2019-04-09 14:18:30'),
(77, 62, 1, 1, '2019-04-09 15:43:13'),
(78, 63, 1, 1, '2019-04-09 17:39:36'),
(79, 64, 1, 1, '2019-04-09 18:02:22'),
(80, 21, 2, 1, '2019-04-09 18:03:34'),
(81, 24, 2, 1, '2019-04-09 18:06:01'),
(82, 28, 2, 1, '2019-04-09 18:06:53'),
(83, 65, 1, 1, '2019-04-09 18:33:44'),
(84, 66, 1, 1, '2019-04-09 18:35:31'),
(85, 27, 2, 1, '2019-04-09 18:36:21'),
(86, 67, 1, 1, '2019-04-09 18:45:07'),
(87, 68, 1, 1, '2019-04-09 19:48:41'),
(88, 69, 1, 1, '2019-04-09 20:03:52'),
(89, 70, 1, 1, '2019-04-09 20:19:49'),
(90, 71, 1, 1, '2019-04-09 20:25:16'),
(91, 72, 1, 1, '2019-04-09 20:26:50'),
(92, 73, 1, 1, '2019-04-10 15:11:24'),
(93, 74, 1, 1, '2019-04-10 16:27:00'),
(94, 75, 1, 1, '2019-04-10 17:11:58'),
(95, 76, 1, 1, '2019-04-10 17:14:23'),
(96, 77, 1, 1, '2019-04-10 17:17:19'),
(97, 78, 1, 1, '2019-04-10 17:20:37'),
(98, 79, 1, 1, '2019-04-10 17:23:09'),
(99, 80, 1, 1, '2019-04-10 17:26:36'),
(100, 81, 1, 1, '2019-04-11 16:31:02'),
(101, 82, 1, 1, '2019-04-11 16:41:07'),
(102, 83, 1, 1, '2019-04-11 17:54:40'),
(103, 84, 1, 1, '2019-04-17 16:29:17'),
(104, 85, 1, 1, '2019-04-17 16:30:15'),
(105, 86, 1, 1, '2019-04-17 16:38:06'),
(106, 23, 2, 1, '2019-04-17 16:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `ex_action_lines`
--

CREATE TABLE `ex_action_lines` (
  `ex_action_line_id` int(11) NOT NULL,
  `ex_action_id` int(11) NOT NULL,
  `line_id` int(11) NOT NULL,
  `quantity` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ex_action_lines`
--

INSERT INTO `ex_action_lines` (`ex_action_line_id`, `ex_action_id`, `line_id`, `quantity`) VALUES
(5, 3, 5, '5.000'),
(6, 3, 6, '1.000'),
(7, 3, 7, '2.000'),
(8, 4, 8, '9.000'),
(9, 4, 9, '1.000'),
(10, 4, 10, '1.000'),
(11, 5, 11, '5.000'),
(12, 5, 12, '1.000'),
(13, 6, 13, '3.000'),
(14, 7, 11, '-5.000'),
(15, 7, 12, '-1.000'),
(16, 8, 5, '-5.000'),
(17, 8, 6, '-1.000'),
(18, 8, 7, '-2.000'),
(19, 9, 14, '5.000'),
(20, 10, 13, '-3.000'),
(21, 11, 15, '3.450'),
(22, 11, 16, '3.000'),
(23, 12, 17, '5.000'),
(24, 12, 18, '3.750'),
(25, 13, 17, '-5.000'),
(26, 13, 18, '-3.750'),
(27, 14, 19, '1.000'),
(28, 15, 19, '-1.000'),
(29, 16, 9, '-1.000'),
(30, 16, 8, '-9.000'),
(31, 16, 10, '-1.000'),
(32, 17, 16, '-3.000'),
(33, 17, 15, '-3.450'),
(34, 18, 14, '-5.000'),
(35, 19, 20, '1.000'),
(36, 20, 21, '5.000'),
(37, 21, 22, '2.000'),
(38, 22, 23, '999.000'),
(39, 23, 24, '99.000'),
(40, 24, 25, '8.000'),
(41, 24, 26, '2.000'),
(42, 24, 27, '6.000'),
(43, 24, 28, '4.000'),
(44, 24, 29, '9.000'),
(45, 25, 27, '-6.000'),
(46, 25, 29, '-9.000'),
(47, 25, 26, '-2.000'),
(48, 25, 28, '-4.000'),
(49, 25, 25, '-8.000'),
(50, 26, 24, '-99.000'),
(51, 27, 30, '1.000'),
(52, 27, 31, '2.000'),
(53, 27, 32, '1.000'),
(54, 28, 33, '5.000'),
(55, 29, 21, '-5.000'),
(56, 30, 33, '-5.000'),
(57, 31, 32, '-1.000'),
(58, 31, 31, '-2.000'),
(59, 31, 30, '-1.000'),
(60, 32, 34, '1.000'),
(61, 33, 34, '-1.000'),
(62, 34, 35, '5.000'),
(63, 35, 36, '6.000'),
(64, 36, 37, '8.000'),
(65, 37, 37, '-8.000'),
(66, 38, 38, '1.000'),
(67, 39, 39, '4.000'),
(68, 40, 40, '8.000'),
(69, 40, 41, '8.000'),
(70, 41, 42, '5.000'),
(71, 42, 43, '5.000'),
(72, 43, 44, '8.000'),
(73, 44, 45, '6.000'),
(74, 45, 46, '5.000'),
(75, 46, 47, '5.000'),
(76, 47, 48, '5.000'),
(77, 48, 49, '8.000'),
(78, 49, 50, '7.000'),
(79, 50, 51, '85.000'),
(80, 51, 52, '5.000'),
(81, 52, 53, '5.000'),
(82, 53, 54, '5.000'),
(83, 54, 55, '4.000'),
(84, 55, 56, '5.000'),
(85, 55, 57, '5.000'),
(86, 56, 58, '5.000'),
(87, 57, 59, '8.000'),
(88, 58, 60, '5.000'),
(89, 58, 61, '5.000'),
(90, 59, 62, '5.000'),
(91, 60, 63, '24.000'),
(92, 61, 64, '4.000'),
(93, 62, 65, '4.000'),
(94, 63, 66, '1.000'),
(95, 63, 67, '5.000'),
(96, 63, 68, '5.000'),
(97, 63, 69, '2.000'),
(98, 64, 70, '4.000'),
(99, 65, 71, '8.000'),
(100, 66, 72, '7.000'),
(101, 67, 73, '8.000'),
(102, 68, 74, '8.000'),
(103, 69, 75, '55.000'),
(104, 70, 76, '2.000'),
(105, 71, 77, '5.000'),
(106, 71, 78, '5.000'),
(107, 71, 79, '2.000'),
(108, 72, 80, '5.000'),
(109, 72, 81, '5.000'),
(110, 73, 82, '8.000'),
(111, 74, 83, '7.000'),
(112, 75, 84, '7.000'),
(113, 76, 85, '5.000'),
(114, 77, 86, '5.000'),
(115, 77, 87, '2.000'),
(116, 78, 88, '2.000'),
(117, 79, 89, '2.000'),
(118, 79, 90, '5.000'),
(119, 80, 36, '-6.000'),
(120, 81, 39, '-4.000'),
(121, 82, 44, '-8.000'),
(122, 83, 91, '1.000'),
(123, 83, 92, '2.000'),
(124, 83, 93, '1.000'),
(125, 84, 94, '2.000'),
(126, 85, 43, '-5.000'),
(127, 86, 95, '4.000'),
(128, 87, 96, '7.000'),
(129, 88, 97, '7.000'),
(130, 89, 98, '1.000'),
(131, 89, 99, '1.000'),
(132, 90, 100, '1.000'),
(133, 90, 101, '1.000'),
(134, 91, 102, '1.000'),
(135, 92, 103, '1.000'),
(136, 93, 104, '1.000'),
(137, 94, 105, '1.000'),
(138, 95, 106, '1.000'),
(139, 96, 107, '1.000'),
(140, 97, 108, '1.000'),
(141, 98, 109, '2.000'),
(142, 99, 110, '1.000'),
(143, 100, 111, '1.000'),
(144, 100, 112, '2.000'),
(145, 101, 113, '5.000'),
(146, 102, 114, '4.000'),
(147, 103, 115, '2.000'),
(148, 104, 116, '1.000'),
(149, 105, 117, '1.000'),
(150, 106, 38, '-1.000');

-- --------------------------------------------------------

--
-- Table structure for table `ex_action_types`
--

CREATE TABLE `ex_action_types` (
  `ex_action_type_id` int(11) NOT NULL,
  `action_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ex_action_types`
--

INSERT INTO `ex_action_types` (`ex_action_type_id`, `action_title`) VALUES
(1, 'Collection'),
(2, 'Submission');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `unit_id` int(11) NOT NULL DEFAULT '1',
  `dialog_id` int(11) NOT NULL DEFAULT '1',
  `show_dialog_on_select` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `image`, `unit_id`, `dialog_id`, `show_dialog_on_select`) VALUES
(11, '2m x 3m', '', 1, 1, 1),
(12, '3m x 4m', '', 1, 1, 1),
(13, 'Rectangle', '', 3, 2, 1),
(14, '1m X 3m', '', 1, 1, 1),
(15, '2.5 x 3.5', '', 1, 1, 1),
(16, '1.5 x 2', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_services`
--

CREATE TABLE `item_services` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `price` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_services`
--

INSERT INTO `item_services` (`id`, `item_id`, `service_id`, `price`) VALUES
(30, 11, 7, '6.000'),
(31, 12, 7, '12.000'),
(32, 13, 7, '1.000'),
(33, 14, 7, '3.000'),
(34, 15, 7, '6.000'),
(35, 16, 7, '3.000');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `customer` int(11) NOT NULL,
  `total` decimal(10,3) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `status`, `customer`, `total`, `created_by`, `created_at`) VALUES
(3, 2, 9, '48.000', 1, '2018-05-05 10:13:56'),
(4, 2, 9, '78.000', 1, '2018-05-05 10:15:58'),
(5, 2, 8, '42.000', 1, '2018-05-05 10:16:46'),
(6, 2, 10, '36.000', 1, '2018-05-05 10:19:01'),
(7, 2, 10, '30.000', 1, '2018-05-05 10:36:00'),
(8, 2, 10, '21.450', 1, '2018-05-05 14:58:37'),
(9, 2, 10, '33.750', 1, '2018-05-23 12:15:06'),
(10, 2, 11, '12.000', 1, '2018-08-09 20:07:12'),
(11, 3, 0, '12.000', 1, '2018-11-29 10:46:15'),
(12, 2, 12, '30.000', 1, '2018-12-01 23:02:35'),
(13, 3, 13, '12.000', 1, '2018-12-01 23:15:57'),
(14, 3, 15, '5994.000', 1, '2018-12-01 23:19:40'),
(15, 2, 16, '594.000', 1, '2018-12-01 23:20:42'),
(16, 2, 17, '141.000', 1, '2018-12-01 23:23:11'),
(17, 2, 18, '24.000', 1, '2018-12-09 00:37:36'),
(18, 2, 15, '60.000', 1, '2018-12-09 00:50:49'),
(19, 2, 18, '12.000', 3, '2018-12-09 01:15:09'),
(20, 1, 11, '60.000', 1, '2019-01-19 18:15:35'),
(21, 2, 9, '36.000', 1, '2019-01-19 18:16:06'),
(22, 2, 10, '24.000', 1, '2019-01-19 18:16:26'),
(23, 2, 8, '6.000', 1, '2019-03-31 16:49:36'),
(24, 2, 8, '12.000', 1, '2019-04-07 17:16:29'),
(25, 1, 9, '96.000', 1, '2019-04-07 17:53:30'),
(26, 1, 8, '60.000', 1, '2019-04-07 17:53:50'),
(27, 2, 9, '30.000', 1, '2019-04-07 17:56:21'),
(28, 2, 8, '48.000', 1, '2019-04-07 17:57:24'),
(29, 1, 9, '72.000', 1, '2019-04-07 18:16:25'),
(30, 1, 8, '15.000', 1, '2019-04-07 18:26:12'),
(31, 1, 9, '30.000', 1, '2019-04-07 23:26:33'),
(32, 1, 8, '30.000', 1, '2019-04-07 23:39:24'),
(33, 1, 8, '48.000', 1, '2019-04-07 23:42:35'),
(34, 1, 9, '84.000', 1, '2019-04-07 23:44:52'),
(35, 1, 9, '1020.000', 1, '2019-04-07 23:48:25'),
(36, 1, 8, '30.000', 1, '2019-04-07 23:50:19'),
(37, 1, 8, '60.000', 1, '2019-04-08 11:54:20'),
(38, 1, 8, '60.000', 1, '2019-04-08 11:55:16'),
(39, 1, 8, '12.000', 1, '2019-04-08 12:02:13'),
(40, 1, 8, '90.000', 1, '2019-04-08 12:17:54'),
(41, 1, 8, '30.000', 1, '2019-04-08 12:24:18'),
(42, 1, 8, '48.000', 1, '2019-04-08 12:32:10'),
(43, 1, 8, '60.000', 1, '2019-04-08 12:35:51'),
(44, 1, 8, '30.000', 1, '2019-04-08 12:49:10'),
(45, 1, 12, '24.000', 1, '2019-04-08 12:51:12'),
(46, 1, 8, '24.000', 1, '2019-04-08 15:32:11'),
(47, 1, 10, '24.000', 1, '2019-04-09 08:39:12'),
(48, 1, 11, '78.000', 1, '2019-04-09 08:40:02'),
(49, 1, 9, '24.000', 1, '2019-04-09 11:07:22'),
(50, 1, 8, '48.000', 1, '2019-04-09 11:11:49'),
(51, 1, 9, '42.000', 1, '2019-04-09 11:16:07'),
(52, 1, 9, '48.000', 1, '2019-04-09 11:17:35'),
(53, 1, 9, '24.000', 1, '2019-04-09 11:20:02'),
(54, 1, 8, '330.000', 1, '2019-04-09 11:25:44'),
(55, 1, 8, '12.000', 1, '2019-04-09 11:32:20'),
(56, 1, 10, '72.000', 1, '2019-04-09 11:33:01'),
(57, 1, 10, '45.000', 1, '2019-04-09 12:48:39'),
(58, 1, 8, '48.000', 1, '2019-04-09 13:59:41'),
(59, 1, 9, '84.000', 1, '2019-04-09 14:06:47'),
(60, 1, 8, '42.000', 1, '2019-04-09 14:08:10'),
(61, 1, 8, '15.000', 1, '2019-04-09 14:18:30'),
(62, 1, 9, '54.000', 1, '2019-04-09 15:43:13'),
(63, 1, 11, '12.000', 1, '2019-04-09 17:39:36'),
(64, 1, 12, '42.000', 1, '2019-04-09 18:02:22'),
(65, 1, 8, '21.000', 1, '2019-04-09 18:33:44'),
(66, 1, 0, '12.000', 1, '2019-04-09 18:35:31'),
(67, 1, 17, '24.000', 1, '2019-04-09 18:45:07'),
(68, 1, 17, '42.000', 1, '2019-04-09 19:48:41'),
(69, 1, 8, '42.000', 1, '2019-04-09 20:03:52'),
(70, 1, 10, '18.000', 1, '2019-04-09 20:19:49'),
(71, 1, 11, '18.000', 1, '2019-04-09 20:25:16'),
(72, 1, 10, '12.000', 1, '2019-04-09 20:26:50'),
(73, 1, 10, '6.000', 1, '2019-04-10 15:11:24'),
(74, 1, 10, '6.000', 1, '2019-04-10 16:27:00'),
(75, 1, 12, '6.000', 1, '2019-04-10 17:11:58'),
(76, 1, 9, '6.000', 1, '2019-04-10 17:14:23'),
(77, 1, 11, '6.000', 1, '2019-04-10 17:17:19'),
(78, 1, 10, '6.000', 1, '2019-04-10 17:20:37'),
(79, 1, 11, '12.000', 1, '2019-04-10 17:23:09'),
(80, 1, 11, '6.000', 1, '2019-04-10 17:26:36'),
(81, 1, 10, '18.000', 1, '2019-04-11 16:31:02'),
(82, 1, 8, '30.000', 1, '2019-04-11 16:41:07'),
(83, 1, 8, '24.000', 1, '2019-04-11 17:54:40'),
(84, 1, 19, '24.000', 1, '2019-04-17 16:29:17'),
(85, 1, 19, '3.000', 1, '2019-04-17 16:30:15'),
(86, 1, 20, '6.000', 1, '2019-04-17 16:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_lines`
--

CREATE TABLE `order_lines` (
  `line_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `quantity` decimal(10,3) NOT NULL,
  `user_note` varchar(100) DEFAULT NULL,
  `system_note` varchar(100) DEFAULT NULL,
  `discount` decimal(10,3) NOT NULL,
  `total` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_lines`
--

INSERT INTO `order_lines` (`line_id`, `order_id`, `service_id`, `item_id`, `price`, `quantity`, `user_note`, `system_note`, `discount`, `total`) VALUES
(5, 3, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(6, 3, 7, 12, '12.000', '1.000', NULL, '', '0.000', '12.000'),
(7, 3, 7, 14, '3.000', '2.000', NULL, '', '0.000', '6.000'),
(8, 4, 7, 11, '6.000', '9.000', NULL, '', '0.000', '54.000'),
(9, 4, 7, 12, '12.000', '1.000', NULL, '', '0.000', '12.000'),
(10, 4, 7, 12, '12.000', '1.000', NULL, '', '0.000', '12.000'),
(11, 5, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(12, 5, 7, 12, '12.000', '1.000', NULL, '', '0.000', '12.000'),
(13, 6, 7, 12, '12.000', '3.000', NULL, '', '0.000', '36.000'),
(14, 7, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(15, 8, 7, 13, '1.000', '3.450', NULL, '1.5m x 2.3m', '0.000', '3.450'),
(16, 8, 7, 11, '6.000', '3.000', NULL, '', '0.000', '18.000'),
(17, 9, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(18, 9, 7, 13, '1.000', '3.750', NULL, '1.5m x 2.5m', '0.000', '3.750'),
(19, 10, 7, 12, '12.000', '1.000', NULL, '', '0.000', '12.000'),
(20, 11, 7, 12, '12.000', '1.000', NULL, '', '0.000', '12.000'),
(21, 12, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(22, 13, 7, 11, '6.000', '2.000', NULL, '', '0.000', '12.000'),
(23, 14, 7, 11, '6.000', '999.000', NULL, '', '0.000', '5994.000'),
(24, 15, 7, 11, '6.000', '99.000', NULL, '', '0.000', '594.000'),
(25, 16, 7, 11, '6.000', '8.000', NULL, '', '0.000', '48.000'),
(26, 16, 7, 12, '12.000', '2.000', NULL, '', '0.000', '24.000'),
(27, 16, 7, 14, '3.000', '6.000', NULL, '', '0.000', '18.000'),
(28, 16, 7, 15, '6.000', '4.000', NULL, '', '0.000', '24.000'),
(29, 16, 7, 16, '3.000', '9.000', NULL, '', '0.000', '27.000'),
(30, 17, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(31, 17, 7, 14, '3.000', '2.000', NULL, '', '0.000', '6.000'),
(32, 17, 7, 12, '12.000', '1.000', NULL, '', '0.000', '12.000'),
(33, 18, 7, 12, '12.000', '5.000', NULL, '', '0.000', '60.000'),
(34, 19, 7, 12, '12.000', '1.000', NULL, '', '0.000', '12.000'),
(35, 20, 7, 12, '12.000', '5.000', NULL, '', '0.000', '60.000'),
(36, 21, 7, 11, '6.000', '6.000', NULL, '', '0.000', '36.000'),
(37, 22, 7, 16, '3.000', '8.000', NULL, '', '0.000', '24.000'),
(38, 23, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(39, 24, 7, 16, '3.000', '4.000', NULL, '', '0.000', '12.000'),
(40, 25, 7, 11, '6.000', '8.000', NULL, '', '0.000', '48.000'),
(41, 25, 7, 11, '6.000', '8.000', NULL, '', '0.000', '48.000'),
(42, 26, 7, 12, '12.000', '5.000', NULL, '', '0.000', '60.000'),
(43, 27, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(44, 28, 7, 11, '6.000', '8.000', NULL, '', '0.000', '48.000'),
(45, 29, 7, 12, '12.000', '6.000', NULL, '', '0.000', '72.000'),
(46, 30, 7, 14, '3.000', '5.000', NULL, '', '0.000', '15.000'),
(47, 31, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(48, 32, 7, 15, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(49, 33, 7, 11, '6.000', '8.000', NULL, '', '0.000', '48.000'),
(50, 34, 7, 12, '12.000', '7.000', NULL, '', '0.000', '84.000'),
(51, 35, 7, 12, '12.000', '85.000', NULL, '', '0.000', '1020.000'),
(52, 36, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(53, 37, 7, 12, '12.000', '5.000', NULL, '', '0.000', '60.000'),
(54, 38, 7, 12, '12.000', '5.000', NULL, '', '0.000', '60.000'),
(55, 39, 7, 14, '3.000', '4.000', NULL, '', '0.000', '12.000'),
(56, 40, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(57, 40, 7, 12, '12.000', '5.000', NULL, '', '0.000', '60.000'),
(58, 41, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(59, 42, 7, 11, '6.000', '8.000', NULL, '', '0.000', '48.000'),
(60, 43, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(61, 43, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(62, 44, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(63, 45, 7, 13, '1.000', '24.000', NULL, '4m x 6m', '0.000', '24.000'),
(64, 46, 7, 11, '6.000', '4.000', NULL, '', '0.000', '24.000'),
(65, 47, 7, 11, '6.000', '4.000', NULL, '', '0.000', '24.000'),
(66, 48, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(67, 48, 7, 15, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(68, 48, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(69, 48, 7, 11, '6.000', '2.000', NULL, '', '0.000', '12.000'),
(70, 49, 7, 11, '6.000', '4.000', NULL, '', '0.000', '24.000'),
(71, 50, 7, 11, '6.000', '8.000', NULL, '', '0.000', '48.000'),
(72, 51, 7, 11, '6.000', '7.000', NULL, '', '0.000', '42.000'),
(73, 52, 7, 11, '6.000', '8.000', NULL, '', '0.000', '48.000'),
(74, 53, 7, 14, '3.000', '8.000', NULL, '', '0.000', '24.000'),
(75, 54, 7, 11, '6.000', '55.000', NULL, '', '0.000', '330.000'),
(76, 55, 7, 11, '6.000', '2.000', NULL, '', '0.000', '12.000'),
(77, 56, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(78, 56, 7, 15, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(79, 56, 7, 11, '6.000', '2.000', NULL, '', '0.000', '12.000'),
(80, 57, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(81, 57, 7, 16, '3.000', '5.000', NULL, '', '0.000', '15.000'),
(82, 58, 7, 11, '6.000', '8.000', NULL, '', '0.000', '48.000'),
(83, 59, 7, 12, '12.000', '7.000', NULL, '', '0.000', '84.000'),
(84, 60, 7, 11, '6.000', '7.000', NULL, '', '0.000', '42.000'),
(85, 61, 7, 14, '3.000', '5.000', NULL, '', '0.000', '15.000'),
(86, 62, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(87, 62, 7, 12, '12.000', '2.000', NULL, '', '0.000', '24.000'),
(88, 63, 7, 11, '6.000', '2.000', NULL, '', '0.000', '12.000'),
(89, 64, 7, 11, '6.000', '2.000', NULL, '', '0.000', '12.000'),
(90, 64, 7, 15, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(91, 65, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(92, 65, 7, 15, '6.000', '2.000', NULL, '', '0.000', '12.000'),
(93, 65, 7, 16, '3.000', '1.000', NULL, '', '0.000', '3.000'),
(94, 66, 7, 11, '6.000', '2.000', NULL, '', '0.000', '12.000'),
(95, 67, 7, 11, '6.000', '4.000', NULL, '', '0.000', '24.000'),
(96, 68, 7, 11, '6.000', '7.000', NULL, '', '0.000', '42.000'),
(97, 69, 7, 11, '6.000', '7.000', NULL, '', '0.000', '42.000'),
(98, 70, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(99, 70, 7, 12, '12.000', '1.000', NULL, '', '0.000', '12.000'),
(100, 71, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(101, 71, 7, 12, '12.000', '1.000', NULL, '', '0.000', '12.000'),
(102, 72, 7, 12, '12.000', '1.000', NULL, '', '0.000', '12.000'),
(103, 73, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(104, 74, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(105, 75, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(106, 76, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(107, 77, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(108, 78, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(109, 79, 7, 11, '6.000', '2.000', NULL, '', '0.000', '12.000'),
(110, 80, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(111, 81, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000'),
(112, 81, 7, 15, '6.000', '2.000', NULL, '', '0.000', '12.000'),
(113, 82, 7, 11, '6.000', '5.000', NULL, '', '0.000', '30.000'),
(114, 83, 7, 11, '6.000', '4.000', NULL, '', '0.000', '24.000'),
(115, 84, 7, 12, '12.000', '2.000', NULL, '', '0.000', '24.000'),
(116, 85, 7, 16, '3.000', '1.000', NULL, '', '0.000', '3.000'),
(117, 86, 7, 11, '6.000', '1.000', NULL, '', '0.000', '6.000');

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

CREATE TABLE `order_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `paid` decimal(10,3) NOT NULL,
  `given` decimal(10,3) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_payments`
--

INSERT INTO `order_payments` (`payment_id`, `order_id`, `payment_type`, `paid`, `given`, `created_by`, `created_at`) VALUES
(1, 4, 'cash', '5.000', '5.000', 1, '2018-05-05 10:15:58'),
(2, 5, 'cash', '42.000', '42.000', 1, '2018-05-05 10:21:00'),
(3, 6, 'cash', '20.000', '20.000', 1, '2018-05-05 11:14:11'),
(4, 6, 'card', '16.000', '16.000', 1, '2018-05-05 11:14:11'),
(5, 9, 'cash', '33.750', '33.750', 1, '2018-05-23 12:18:26'),
(6, 10, 'cash', '12.000', '12.000', 1, '2018-08-10 13:31:27'),
(7, 4, 'cash', '73.000', '73.000', 1, '2018-08-10 13:35:35'),
(8, 8, 'cash', '21.450', '21.450', 1, '2018-10-21 23:57:23'),
(9, 7, 'cash', '30.000', '30.000', 1, '2018-10-21 23:57:33'),
(10, 16, 'cash', '141.000', '141.000', 1, '2018-12-01 23:25:47'),
(11, 15, 'cash', '594.000', '594.000', 1, '2018-12-01 23:26:07'),
(12, 18, 'cash', '50.000', '50.000', 1, '2018-12-09 00:50:49'),
(13, 12, 'cash', '30.000', '30.000', 1, '2018-12-09 00:57:59'),
(14, 18, 'cash', '10.000', '10.000', 1, '2018-12-09 00:58:20'),
(15, 17, 'cash', '24.000', '24.000', 1, '2018-12-09 00:59:21'),
(16, 19, 'cash', '12.000', '12.000', 3, '2018-12-09 01:15:23'),
(17, 21, 'cash', '36.000', '36.000', 1, '2019-01-19 18:16:06'),
(18, 22, 'cash', '24.000', '24.000', 1, '2019-01-19 18:16:46'),
(19, 24, 'cash', '12.000', '12.000', 1, '2019-04-09 18:06:01'),
(20, 28, 'cash', '48.000', '48.000', 1, '2019-04-09 18:06:53'),
(21, 27, 'cash', '30.000', '30.000', 1, '2019-04-09 18:36:21'),
(22, 23, 'cash', '6.000', '6.000', 1, '2019-04-17 16:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `status_id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`status_id`, `title`) VALUES
(1, 'Pending'),
(2, 'Submitted'),
(3, 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL,
  `permission_title` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `permission_title`) VALUES
(1, 'Change Settings'),
(2, 'Collect Order'),
(3, 'Submit Order'),
(4, 'View Customers'),
(5, 'Edit Customers'),
(6, 'View Orders'),
(7, 'Cancel Orders'),
(8, 'Manage Services'),
(9, 'Manage Users'),
(10, 'Manage Permissions'),
(11, 'See Reports'),
(12, 'General Settings');

-- --------------------------------------------------------

--
-- Table structure for table `qty_dialogs`
--

CREATE TABLE `qty_dialogs` (
  `dialog_id` int(11) NOT NULL,
  `dialog_name` varchar(25) NOT NULL,
  `html_id` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qty_dialogs`
--

INSERT INTO `qty_dialogs` (`dialog_id`, `dialog_name`, `html_id`) VALUES
(1, 'Quantity', 'qty-dialog'),
(2, 'Rectangle Area', 'area-rectangle-dialog');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `image`, `status`) VALUES
(7, 'Wash Carpet', '', 1),
(8, 'Sofa Cleaning', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `value`) VALUES
(67, 'login_type', 'list_users'),
(69, 'company_logo', ''),
(70, 'company_name', 'Four Seasons Laundry'),
(71, 'company_tel', '+973 36303880 - 36303881'),
(72, 'receipt_header', ''),
(73, 'receipt_footer', ''),
(75, 'address_on_receipt', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `stage_id` int(11) NOT NULL,
  `stage_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(20) NOT NULL,
  `unit_label` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_label`) VALUES
(4, 'Kilograms', 'kg'),
(2, 'Meter', 'm'),
(3, 'Meter Square', 'm2'),
(1, 'Piece', 'pc');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `user_type` int(11) NOT NULL,
  `password` varchar(128) NOT NULL,
  `confirm_password` varchar(128) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `mobile`, `user_type`, `password`, `confirm_password`, `status`, `image`) VALUES
(1, 'admin', 'admin', '', 1, '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 1, ''),
(2, 'jalal', 'jalal', '', 2, 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 0, ''),
(3, 'Bus1', 'Bus1', '', 2, '0b042d41e205576224c1915684770b8a644ca80cd8f44b5524a410b9c5a87180', '0b042d41e205576224c1915684770b8a644ca80cd8f44b5524a410b9c5a87180', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_type`
--

CREATE TABLE `users_type` (
  `type_id` int(11) NOT NULL,
  `type_title` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_type`
--

INSERT INTO `users_type` (`type_id`, `type_title`) VALUES
(1, 'Admin'),
(2, 'Emploee');

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `type_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_permission`
--

INSERT INTO `user_permission` (`type_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `mobile_num` (`mobile_num`);

--
-- Indexes for table `ex_actions`
--
ALTER TABLE `ex_actions`
  ADD PRIMARY KEY (`ex_action_id`);

--
-- Indexes for table `ex_action_lines`
--
ALTER TABLE `ex_action_lines`
  ADD PRIMARY KEY (`ex_action_line_id`);

--
-- Indexes for table `ex_action_types`
--
ALTER TABLE `ex_action_types`
  ADD PRIMARY KEY (`ex_action_type_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_services`
--
ALTER TABLE `item_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_lines`
--
ALTER TABLE `order_lines`
  ADD PRIMARY KEY (`line_id`);

--
-- Indexes for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `qty_dialogs`
--
ALTER TABLE `qty_dialogs`
  ADD PRIMARY KEY (`dialog_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`),
  ADD UNIQUE KEY `unit_name` (`unit_name`,`unit_label`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_type`
--
ALTER TABLE `users_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`type_id`,`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ex_actions`
--
ALTER TABLE `ex_actions`
  MODIFY `ex_action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `ex_action_lines`
--
ALTER TABLE `ex_action_lines`
  MODIFY `ex_action_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `ex_action_types`
--
ALTER TABLE `ex_action_types`
  MODIFY `ex_action_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `item_services`
--
ALTER TABLE `item_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `order_lines`
--
ALTER TABLE `order_lines`
  MODIFY `line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `order_payments`
--
ALTER TABLE `order_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `qty_dialogs`
--
ALTER TABLE `qty_dialogs`
  MODIFY `dialog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_type`
--
ALTER TABLE `users_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
