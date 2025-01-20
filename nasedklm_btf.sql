-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 20, 2025 at 02:04 PM
-- Server version: 8.0.34-26-beget-1-1
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nasedklm_btf`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log` (
  `id` bigint UNSIGNED NOT NULL,
  `log_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `batch_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int UNSIGNED DEFAULT NULL,
  `status` tinyint UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_robots` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `color_id` int UNSIGNED DEFAULT NULL,
  `order_by` int DEFAULT NULL,
  `home` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `meta_title`, `meta_keywords`, `meta_description`, `meta_robots`, `name`, `slug`, `subtitle`, `excerpt`, `description`, `picture`, `lang`, `external_id`, `parent_id`, `color_id`, `order_by`, `home`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, 'Bussiness class', 'bussiness-class', NULL, 'Линейка бренда Business Class представлена в 4х-форматах: от элегантных тонких сигарет формата Super Slims Сompact до классических формата King Size. \n\nSuper Slims Compact - 2 позиции с моноацетатным фильтром и классическим ароматом.\n\nSuper Slims - 2 позиции с моноацетатным фильтром и классическим ароматом.\n\nSlims - 3 позиции с моноацетатным фильтром и классическим ароматом.\n\nKing Size - 2 позиции с моноацетатным фильтром и классическим ароматом.', NULL, 'e8ad2c65376141d1e385c00d07f84c37b9fd86e6.svg', 'ru', NULL, NULL, 1, 1, 0, 1, '2024-11-15 08:22:17', '2024-11-20 12:07:17'),
(2, NULL, NULL, NULL, NULL, 'Ростовские', 'rostovskie', NULL, 'Бренд представлен в твердой и мягкой пачке формата King Sise.\nСигареты имеют классический, насыщенный и ярко выраженный аромат, а также моноацетатный фильтр.', NULL, '927884061e8959afa7ae545dce0f2afc674f0e79.svg', 'ru', NULL, NULL, NULL, 2, 0, 1, '2024-11-15 08:26:32', '2024-11-20 12:10:18'),
(3, NULL, NULL, NULL, NULL, 'Compliment', 'compliment', NULL, 'Сигареты бренда Compliment представлены в 3х-форматах: Super Slims Сompact,  Super Slims и Slims Standard. Табачная мешка типа American Blend, разработанная для каждого формата, имеет сбалансированный купаж различных сортов табака, который найдет отклик у широкой аудитории любителей классического аромата сигарет.\n\nSuper Slims Compact - 3 позиции с моноацетатным фильтром и классическим ароматом.\n\nSuper Slims -3 позиции с моноацетатным фильтром и классическим ароматом.\n\nSlims - 2 позиции с моноацетатным фильтром и классическим ароматом.', NULL, '33ce4617b853d8526ea27eae6ff47f931040802d.svg', 'ru', NULL, NULL, NULL, 3, 0, 1, '2024-11-15 08:27:17', '2024-11-20 12:08:27'),
(4, NULL, NULL, NULL, NULL, 'Dover', 'dover', NULL, 'Сигареты бренда DOVER представлены в двух наименованиях формата Slims: DOVER Export (черная пачка) и  DOVER Export W (светлая пачка).\n\nDOVER Export (черная пачка) имеет классический аромат с умеренной крепостью и моноацетатным фильтром.\n\nDOVER Export W (светлая пачка) имеет классический аромат с умеренной крепостью и моноацетатным фильтром.', NULL, 'de69a0713d5709da9ffb467ce5a7fec2adc0cd05.svg', 'ru', NULL, NULL, NULL, 4, 0, 1, '2024-11-15 08:30:07', '2024-11-20 12:09:00'),
(5, NULL, NULL, NULL, NULL, 'Сталинградские', 'stalingradskie2', NULL, 'Бренд представлен в твердой и мягкой пачке формата King Sise.\nСигареты имеют классический, насыщенный и  ярко выраженный аромат, а так же моноацетатный фильтр.', NULL, '7c8c4196a8483120f03c6a3d21aa40cd6f809192.svg', 'ru', NULL, NULL, NULL, 5, 0, 1, '2024-11-15 08:31:01', '2024-11-20 12:09:31'),
(6, NULL, NULL, NULL, NULL, 'Bayron', 'bayron', NULL, 'Сигареты бренда Bayron представлены в классическом формате King Sise двух наименований:\nBayron – моноацетатный фильтр и классический аромат.\n\nBayron W – моноацетатный фильтр и классический аромат. Табачная мешка, разработанная для этого бренда, передает полноту вкуса и насыщенность аромата.', NULL, 'd98c7035e5e21d1055e1167a327d815c71b74de4.svg', 'ru', NULL, NULL, NULL, 6, 0, 1, '2024-11-15 08:31:08', '2024-11-20 12:10:39'),
(7, NULL, NULL, NULL, NULL, 'Silver leaf', 'silver-leaf', NULL, NULL, NULL, '43bb5ca3c88a5bbc7142a67a624ed361411a39e7.svg', 'ru', NULL, 1, 1, 7, 0, 1, '2024-11-15 08:43:15', '2024-11-19 15:43:46'),
(8, NULL, NULL, NULL, NULL, 'Golden leaf', 'golden-leaf', NULL, NULL, NULL, 'e8480f460fa0ed8c9233623a467185d67b956435.svg', 'ru', NULL, 1, 2, 8, 0, 1, '2024-11-15 08:43:56', '2024-11-19 15:35:51'),
(15, NULL, NULL, NULL, NULL, 'Ростовские', 'rostovskie2', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 9, 0, 1, '2024-11-19 15:22:38', '2024-11-19 15:26:06'),
(20, NULL, NULL, NULL, NULL, 'Export', 'export-slims', NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, 20, 0, 1, '2024-11-19 15:48:56', '2024-11-20 10:24:45'),
(21, NULL, NULL, NULL, NULL, 'Сталинградские', 'stalingradskie', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 21, 0, 1, '2024-11-19 18:25:10', '2024-11-19 18:25:10'),
(22, NULL, NULL, NULL, NULL, 'Bayron', 'bayron2', NULL, NULL, NULL, NULL, NULL, NULL, 6, 1, 22, 0, 1, '2024-11-20 08:08:53', '2024-11-20 08:09:46'),
(23, NULL, NULL, NULL, NULL, 'Compliment 1', 'compliment-1', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 23, 0, 1, '2024-11-20 09:57:49', '2024-11-20 09:57:49'),
(24, NULL, NULL, NULL, NULL, 'Compliment 3', 'compliment-3', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 24, 0, 1, '2024-11-20 09:58:35', '2024-11-20 09:58:35'),
(25, NULL, NULL, NULL, NULL, 'Compliment 5', 'compliment-5', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 25, 0, 1, '2024-11-20 09:58:48', '2024-11-20 09:58:48'),
(27, NULL, NULL, NULL, NULL, 'Blue', 'Blue', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 26, 0, 1, '2024-11-20 10:36:47', '2024-11-20 10:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `category_good`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `category_good`;
CREATE TABLE `category_good` (
  `category_id` bigint UNSIGNED NOT NULL,
  `good_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_good`
--

INSERT INTO `category_good` (`category_id`, `good_id`) VALUES
(15, 4),
(15, 5),
(21, 7),
(22, 9),
(22, 8),
(21, 6),
(7, 10),
(8, 12),
(7, 11),
(8, 13),
(23, 14),
(24, 15),
(25, 16),
(23, 17),
(24, 18),
(25, 19),
(23, 20),
(24, 21),
(20, 22),
(20, 23),
(7, 24),
(8, 25),
(27, 26),
(7, 27),
(8, 28);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `code`, `external_id`) VALUES
(1, 'Светлогорск', NULL, 'a65dacbc-acfa-4ec7-9435-e9300a063aff');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dark Cornflower Blue', '#1f4085', 1, '2024-01-05 18:38:08', '2024-11-18 19:39:25'),
(2, 'Blood Orange', '#d5001a', 1, '2024-01-05 18:39:29', '2024-11-18 19:40:31'),
(3, 'American Yellow', '#f5ab00', 1, '2024-03-20 23:46:34', '2024-11-18 19:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL,
  `good_id` int UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `rating` double(3,2) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`) VALUES
(1, 'United States', 'US'),
(2, 'Canada', 'CA'),
(3, 'Afghanistan', 'AF'),
(4, 'Albania', 'AL'),
(5, 'Algeria', 'DZ'),
(6, 'American Samoa', 'AS'),
(7, 'Andorra', 'AD'),
(8, 'Angola', 'AO'),
(9, 'Anguilla', 'AI'),
(10, 'Antarctica', 'AQ'),
(11, 'Antigua and/or Barbuda', 'AG'),
(12, 'Argentina', 'AR'),
(13, 'Armenia', 'AM'),
(14, 'Aruba', 'AW'),
(15, 'Australia', 'AU'),
(16, 'Austria', 'AT'),
(17, 'Azerbaijan', 'AZ'),
(18, 'Bahamas', 'BS'),
(19, 'Bahrain', 'BH'),
(20, 'Bangladesh', 'BD'),
(21, 'Barbados', 'BB'),
(22, 'Belarus', 'BY'),
(23, 'Belgium', 'BE'),
(24, 'Belize', 'BZ'),
(25, 'Benin', 'BJ'),
(26, 'Bermuda', 'BM'),
(27, 'Bhutan', 'BT'),
(28, 'Bolivia', 'BO'),
(29, 'Bosnia and Herzegovina', 'BA'),
(30, 'Botswana', 'BW'),
(31, 'Bouvet Island', 'BV'),
(32, 'Brazil', 'BR'),
(33, 'British lndian Ocean Territory', 'IO'),
(34, 'Brunei Darussalam', 'BN'),
(35, 'Bulgaria', 'BG'),
(36, 'Burkina Faso', 'BF'),
(37, 'Burundi', 'BI'),
(38, 'Cambodia', 'KH'),
(39, 'Cameroon', 'CM'),
(40, 'Cape Verde', 'CV'),
(41, 'Cayman Islands', 'KY'),
(42, 'Central African Republic', 'CF'),
(43, 'Chad', 'TD'),
(44, 'Chile', 'CL'),
(45, 'China', 'CN'),
(46, 'Christmas Island', 'CX'),
(47, 'Cocos (Keeling) Islands', 'CC'),
(48, 'Colombia', 'CO'),
(49, 'Comoros', 'KM'),
(50, 'Congo', 'CG'),
(51, 'Cook Islands', 'CK'),
(52, 'Costa Rica', 'CR'),
(53, 'Croatia (Hrvatska)', 'HR'),
(54, 'Cuba', 'CU'),
(55, 'Cyprus', 'CY'),
(56, 'Czech Republic', 'CZ'),
(57, 'Democratic Republic of Congo', 'CD'),
(58, 'Denmark', 'DK'),
(59, 'Djibouti', 'DJ'),
(60, 'Dominica', 'DM'),
(61, 'Dominican Republic', 'DO'),
(62, 'East Timor', 'TP'),
(63, 'Ecudaor', 'EC'),
(64, 'Egypt', 'EG'),
(65, 'El Salvador', 'SV'),
(66, 'Equatorial Guinea', 'GQ'),
(67, 'Eritrea', 'ER'),
(68, 'Estonia', 'EE'),
(69, 'Ethiopia', 'ET'),
(70, 'Falkland Islands (Malvinas)', 'FK'),
(71, 'Faroe Islands', 'FO'),
(72, 'Fiji', 'FJ'),
(73, 'Finland', 'FI'),
(74, 'France', 'FR'),
(75, 'France, Metropolitan', 'FX'),
(76, 'French Guiana', 'GF'),
(77, 'French Polynesia', 'PF'),
(78, 'French Southern Territories', 'TF'),
(79, 'Gabon', 'GA'),
(80, 'Gambia', 'GM'),
(81, 'Georgia', 'GE'),
(82, 'Germany', 'DE'),
(83, 'Ghana', 'GH'),
(84, 'Gibraltar', 'GI'),
(85, 'Greece', 'GR'),
(86, 'Greenland', 'GL'),
(87, 'Grenada', 'GD'),
(88, 'Guadeloupe', 'GP'),
(89, 'Guam', 'GU'),
(90, 'Guatemala', 'GT'),
(91, 'Guinea', 'GN'),
(92, 'Guinea-Bissau', 'GW'),
(93, 'Guyana', 'GY'),
(94, 'Haiti', 'HT'),
(95, 'Heard and Mc Donald Islands', 'HM'),
(96, 'Honduras', 'HN'),
(97, 'Hong Kong', 'HK'),
(98, 'Hungary', 'HU'),
(99, 'Iceland', 'IS'),
(100, 'India', 'IN'),
(101, 'Indonesia', 'ID'),
(102, 'Iran (Islamic Republic of)', 'IR'),
(103, 'Iraq', 'IQ'),
(104, 'Ireland', 'IE'),
(105, 'Israel', 'IL'),
(106, 'Italy', 'IT'),
(107, 'Ivory Coast', 'CI'),
(108, 'Jamaica', 'JM'),
(109, 'Japan', 'JP'),
(110, 'Jordan', 'JO'),
(111, 'Kazakhstan', 'KZ'),
(112, 'Kenya', 'KE'),
(113, 'Kiribati', 'KI'),
(114, 'Korea, Democratic People\'s Republic of', 'KP'),
(115, 'Korea, Republic of', 'KR'),
(116, 'Kuwait', 'KW'),
(117, 'Kyrgyzstan', 'KG'),
(118, 'Lao People\'s Democratic Republic', 'LA'),
(119, 'Latvia', 'LV'),
(120, 'Lebanon', 'LB'),
(121, 'Lesotho', 'LS'),
(122, 'Liberia', 'LR'),
(123, 'Libyan Arab Jamahiriya', 'LY'),
(124, 'Liechtenstein', 'LI'),
(125, 'Lithuania', 'LT'),
(126, 'Luxembourg', 'LU'),
(127, 'Macau', 'MO'),
(128, 'Macedonia', 'MK'),
(129, 'Madagascar', 'MG'),
(130, 'Malawi', 'MW'),
(131, 'Malaysia', 'MY'),
(132, 'Maldives', 'MV'),
(133, 'Mali', 'ML'),
(134, 'Malta', 'MT'),
(135, 'Marshall Islands', 'MH'),
(136, 'Martinique', 'MQ'),
(137, 'Mauritania', 'MR'),
(138, 'Mauritius', 'MU'),
(139, 'Mayotte', 'TY'),
(140, 'Mexico', 'MX'),
(141, 'Micronesia, Federated States of', 'FM'),
(142, 'Moldova, Republic of', 'MD'),
(143, 'Monaco', 'MC'),
(144, 'Mongolia', 'MN'),
(145, 'Montserrat', 'MS'),
(146, 'Morocco', 'MA'),
(147, 'Mozambique', 'MZ'),
(148, 'Myanmar', 'MM'),
(149, 'Namibia', 'NA'),
(150, 'Nauru', 'NR'),
(151, 'Nepal', 'NP'),
(152, 'Netherlands', 'NL'),
(153, 'Netherlands Antilles', 'AN'),
(154, 'New Caledonia', 'NC'),
(155, 'New Zealand', 'NZ'),
(156, 'Nicaragua', 'NI'),
(157, 'Niger', 'NE'),
(158, 'Nigeria', 'NG'),
(159, 'Niue', 'NU'),
(160, 'Norfork Island', 'NF'),
(161, 'Northern Mariana Islands', 'MP'),
(162, 'Norway', 'NO'),
(163, 'Oman', 'OM'),
(164, 'Pakistan', 'PK'),
(165, 'Palau', 'PW'),
(166, 'Panama', 'PA'),
(167, 'Papua New Guinea', 'PG'),
(168, 'Paraguay', 'PY'),
(169, 'Peru', 'PE'),
(170, 'Philippines', 'PH'),
(171, 'Pitcairn', 'PN'),
(172, 'Poland', 'PL'),
(173, 'Portugal', 'PT'),
(174, 'Puerto Rico', 'PR'),
(175, 'Qatar', 'QA'),
(176, 'Republic of South Sudan', 'SS'),
(177, 'Reunion', 'RE'),
(178, 'Romania', 'RO'),
(179, 'Russian Federation', 'RU'),
(180, 'Rwanda', 'RW'),
(181, 'Saint Kitts and Nevis', 'KN'),
(182, 'Saint Lucia', 'LC'),
(183, 'Saint Vincent and the Grenadines', 'VC'),
(184, 'Samoa', 'WS'),
(185, 'San Marino', 'SM'),
(186, 'Sao Tome and Principe', 'ST'),
(187, 'Saudi Arabia', 'SA'),
(188, 'Senegal', 'SN'),
(189, 'Serbia', 'RS'),
(190, 'Seychelles', 'SC'),
(191, 'Sierra Leone', 'SL'),
(192, 'Singapore', 'SG'),
(193, 'Slovakia', 'SK'),
(194, 'Slovenia', 'SI'),
(195, 'Solomon Islands', 'SB'),
(196, 'Somalia', 'SO'),
(197, 'South Africa', 'ZA'),
(198, 'South Georgia South Sandwich Islands', 'GS'),
(199, 'Spain', 'ES'),
(200, 'Sri Lanka', 'LK'),
(201, 'St. Helena', 'SH'),
(202, 'St. Pierre and Miquelon', 'PM'),
(203, 'Sudan', 'SD'),
(204, 'Suriname', 'SR'),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ'),
(206, 'Swaziland', 'SZ'),
(207, 'Sweden', 'SE'),
(208, 'Switzerland', 'CH'),
(209, 'Syrian Arab Republic', 'SY'),
(210, 'Taiwan', 'TW'),
(211, 'Tajikistan', 'TJ'),
(212, 'Tanzania, United Republic of', 'TZ'),
(213, 'Thailand', 'TH'),
(214, 'Togo', 'TG'),
(215, 'Tokelau', 'TK'),
(216, 'Tonga', 'TO'),
(217, 'Trinidad and Tobago', 'TT'),
(218, 'Tunisia', 'TN'),
(219, 'Turkey', 'TR'),
(220, 'Turkmenistan', 'TM'),
(221, 'Turks and Caicos Islands', 'TC'),
(222, 'Tuvalu', 'TV'),
(223, 'Uganda', 'UG'),
(224, 'Ukraine', 'UA'),
(225, 'United Arab Emirates', 'AE'),
(226, 'United Kingdom', 'GB'),
(227, 'United States minor outlying islands', 'UM'),
(228, 'Uruguay', 'UY'),
(229, 'Uzbekistan', 'UZ'),
(230, 'Vanuatu', 'VU'),
(231, 'Vatican City State', 'VA'),
(232, 'Venezuela', 'VE'),
(233, 'Vietnam', 'VN'),
(234, 'Virgin Islands (British)', 'VG'),
(235, 'Virgin Islands (U.S.)', 'VI'),
(236, 'Wallis and Futuna Islands', 'WF'),
(237, 'Western Sahara', 'EH'),
(238, 'Yemen', 'YE'),
(239, 'Yugoslavia', 'YU'),
(240, 'Zaire', 'ZR'),
(241, 'Zambia', 'ZM'),
(242, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` enum('percent','fixed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `value` double NOT NULL,
  `currency_id` tinyint UNSIGNED DEFAULT NULL,
  `only_once` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `min_sum` double DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `started_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `name`, `description`, `type`, `value`, `currency_id`, `only_once`, `min_sum`, `status`, `started_at`, `expired_at`, `created_at`, `updated_at`) VALUES
(2, 'NG2024', 'Новогодняя скидка 2024', 'Купон на скидку в 24 процента', 'percent', 24, NULL, 1, 2024, 1, NULL, NULL, '2024-03-30 06:09:47', '2024-03-30 06:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_main` tinyint NOT NULL DEFAULT '0',
  `rate` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `symbol`, `is_main`, `rate`, `created_at`, `updated_at`) VALUES
(1, 'RUB', 'Рубли', '₽', 1, 1, NULL, '2024-03-31 10:06:01'),
(2, 'USD', 'Доллары', '$', 0, 0.0108019931, NULL, '2024-03-31 10:56:29'),
(3, 'EUR', 'Евро', '€', 0, 0.0100045918, NULL, '2024-03-31 10:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `customer_addresses`;
CREATE TABLE `customer_addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `type_id` int UNSIGNED DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entrance` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flat` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doorphone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `name`, `country_id`, `type_id`, `city`, `street_id`, `street_name`, `house`, `building`, `entrance`, `floor`, `flat`, `doorphone`, `notes`, `delivery_date`, `delivery_time`, `created_at`, `updated_at`) VALUES
(2, 1, 'Основной', 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-10-21', '17:18:00', '2023-12-13 08:48:03', '2024-10-21 14:33:14'),
(3, 18, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 08:57:12', '2023-12-13 08:57:12'),
(4, 19, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 09:08:59', '2023-12-13 09:08:59'),
(5, 20, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 09:10:12', '2023-12-13 09:10:12'),
(6, 21, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 09:11:19', '2023-12-13 09:11:19'),
(7, 22, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 09:14:38', '2023-12-13 09:14:38'),
(8, 23, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 09:17:16', '2023-12-13 09:17:16'),
(9, 24, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 09:18:33', '2023-12-13 09:18:33'),
(10, 25, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 09:28:21', '2023-12-13 09:28:21'),
(11, 26, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 09:30:03', '2023-12-13 09:30:03'),
(12, 27, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 09:31:13', '2023-12-13 09:31:13'),
(15, 30, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 10:00:22', '2023-12-13 10:00:22'),
(16, 31, NULL, 179, NULL, 'Светлогорск', 'Улица гагарина', NULL, '1', '6', '3', '4', '13', NULL, NULL, NULL, NULL, '2023-12-13 10:03:44', '2023-12-13 10:03:44'),
(17, 34, NULL, 179, 1, 'Светлогорск', 'Улица гагарина', NULL, '1', '2', '3', '4', '13', NULL, 'Тест', '2023-12-13', '16:11:00', '2023-12-13 12:12:36', '2023-12-13 12:12:36'),
(18, 35, NULL, 179, 1, 'Светлогорск', 'Улица гагарина', NULL, '1', '2', '3', '4', '13', NULL, 'Тест', '2023-12-13', '16:11:00', '2023-12-13 12:14:06', '2023-12-13 12:14:06'),
(19, 38, NULL, 179, 1, 'Светлогорск', 'Улица гагарина', NULL, '1', '2', '3', '4', '13', NULL, NULL, '2023-12-15', '12:47:00', '2023-12-15 08:47:55', '2023-12-15 08:47:55'),
(20, 40, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df55', NULL, '1', '1', '1', '1', '1', NULL, NULL, '2023-12-28', '11:10:00', '2023-12-28 07:11:39', '2023-12-28 07:11:39'),
(21, 42, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de41', NULL, '1', '1', '1', '1', '1', NULL, NULL, '2023-12-28', '11:26:00', '2023-12-28 07:28:59', '2023-12-28 07:28:59'),
(22, 43, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df0d', NULL, '1', '1', '1', '1', '1', NULL, NULL, '2023-12-28', '11:40:00', '2023-12-28 07:41:40', '2023-12-28 07:41:40'),
(23, 45, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dff7', NULL, '2', '2', '2', '2', '2', NULL, 'Ноте', '2023-12-28', '11:49:00', '2023-12-28 07:52:03', '2023-12-28 07:52:03'),
(24, 46, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df9a', NULL, '12342', '12312', '12312', '12312', '3213', NULL, NULL, '2023-12-28', '12:09:00', '2023-12-28 08:10:33', '2023-12-28 08:10:33'),
(25, 47, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de05', NULL, '453', '23423', '4234', '23423', '423', NULL, NULL, '2023-12-28', '12:14:00', '2023-12-28 08:15:26', '2023-12-28 08:15:26'),
(26, 48, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de3b', NULL, '1', '2', '3', '4', '5', NULL, NULL, '2023-12-28', '12:39:00', '2023-12-28 08:41:14', '2023-12-28 08:41:14'),
(27, 49, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df8e', NULL, '12', '23', '2345', '45', '45', NULL, NULL, '2023-12-28', '12:56:00', '2023-12-28 08:57:36', '2023-12-28 08:57:36'),
(28, 50, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df8e', NULL, '12', '23', '2345', '45', '45', NULL, NULL, '2023-12-28', '12:56:00', '2023-12-28 08:59:21', '2023-12-28 08:59:21'),
(29, 51, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df8e', NULL, '23', '2', '2', '2', '2', NULL, NULL, '2023-12-28', '13:10:00', '2023-12-28 09:11:43', '2023-12-28 09:11:43'),
(30, 52, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de1a', NULL, '2', '1', NULL, NULL, NULL, NULL, NULL, '2023-12-28', '13:14:00', '2023-12-28 09:15:39', '2023-12-28 09:15:39'),
(31, 53, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dece', NULL, '1', '1', '1', '1', '1', NULL, NULL, '2023-12-28', '15:38:00', '2023-12-28 11:39:22', '2023-12-28 11:39:22'),
(32, 54, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46def5', NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, '2023-12-28', '15:44:00', '2023-12-28 11:45:27', '2023-12-28 11:45:27'),
(33, 55, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46def5', NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, '2023-12-28', '15:44:00', '2023-12-28 12:25:17', '2023-12-28 12:25:17'),
(34, 56, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df8b', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-29', '11:09:00', '2023-12-29 07:11:02', '2023-12-29 07:11:02'),
(35, 57, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46ddde', NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-29', '11:25:00', '2023-12-29 07:26:29', '2023-12-29 07:26:29'),
(36, 58, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfb2', NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-30', '18:35:00', '2023-12-30 14:40:47', '2023-12-30 14:40:47'),
(37, 59, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de26', NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-30', '18:45:00', '2023-12-30 14:46:09', '2023-12-30 14:46:09'),
(38, 80, NULL, 179, 1, 'Светлогорск', NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-10', '15:35:00', '2024-01-10 11:36:33', '2024-01-10 11:36:33'),
(39, 81, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de35', 'Морской', '2', '1', '1', '1', '1', NULL, NULL, '2024-01-11', '14:26:00', '2024-01-11 10:27:34', '2024-01-11 10:27:34'),
(40, 82, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de02', 'Славянская', '5', '2', '1', '2', '12', NULL, 'Тестовый заказ', '2024-01-11', '14:43:00', '2024-01-11 10:45:19', '2024-01-11 10:45:19'),
(41, 83, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de3e', 'Приморская', '2', '5', '1', '3', '45', NULL, 'Тестовый', '2024-01-11', '15:11:00', '2024-01-11 11:12:52', '2024-01-11 11:12:52'),
(42, 84, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ', '2024-01-11', '15:17:00', '2024-01-11 11:17:57', '2024-01-11 11:17:57'),
(43, 85, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dea1', 'Береговая', '2', '2', '1', '2', '23', NULL, 'Тестовый заказ', '2024-01-11', '19:50:00', '2024-01-11 11:51:35', '2024-01-11 11:51:35'),
(44, 86, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfca', 'Малиновый', '11', '1', '1', '1', '1', NULL, NULL, '2024-01-11', '16:58:00', '2024-01-11 12:59:43', '2024-01-11 12:59:43'),
(45, 87, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df49', 'Вербный', '2', '1', '1', '1', '1', NULL, NULL, '2024-01-11', '17:00:00', '2024-01-11 13:03:31', '2024-01-11 13:03:31'),
(46, 88, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de3e', 'Приморская', '2', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-11', '17:07:00', '2024-01-11 13:11:04', '2024-01-11 13:11:04'),
(47, 89, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de95', 'Дачный', '2', '2', '1', NULL, '1', NULL, 'Тестовый заказ', '2024-01-12', '10:23:00', '2024-01-12 06:25:00', '2024-01-12 06:25:00'),
(48, 90, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de59', 'Вокзальная', '2', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ', '2024-01-12', '10:32:00', '2024-01-12 06:33:46', '2024-01-12 06:33:46'),
(49, 91, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dde1', 'Кольцевая', '2', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ', '2024-01-12', '10:37:00', '2024-01-12 06:38:56', '2024-01-12 06:38:56'),
(50, 92, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de38', 'Балтийская', '2', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ', '2024-01-12', '12:49:00', '2024-01-12 08:50:51', '2024-01-12 08:50:51'),
(51, 93, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de86', 'Ленинградская', '2', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ', '2024-01-12', '14:07:00', '2024-01-12 10:18:19', '2024-01-12 10:18:19'),
(52, 94, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de7a', 'Карла', '3', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-12', '15:37:00', '2024-01-12 11:38:55', '2024-01-12 11:38:55'),
(53, 95, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-12', '15:39:00', '2024-01-12 11:40:49', '2024-01-12 11:40:49'),
(54, 96, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df16', 'Пионерская', '2', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-17', '10:34:00', '2024-01-17 06:35:28', '2024-01-17 06:35:28'),
(55, 97, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46deda', 'Коммунальная', '1', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ', '2024-01-17', '13:00:00', '2024-01-17 08:01:23', '2024-01-17 08:01:23'),
(56, 98, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de3b', 'Аптечная', '8', NULL, NULL, NULL, '2', NULL, NULL, '2024-01-17', '14:10:00', '2024-01-17 09:22:04', '2024-01-17 09:22:04'),
(57, 99, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfd0', 'Гагарина', '2', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ', '2024-01-17', '16:22:00', '2024-01-17 11:23:26', '2024-01-17 11:23:26'),
(58, 100, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-18', '10:59:00', '2024-01-18 06:06:32', '2024-01-18 06:06:32'),
(59, 101, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dec2', 'Октябрьская', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-18', '12:18:00', '2024-01-18 07:27:39', '2024-01-18 07:27:39'),
(60, 102, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый Заказ!!!', '2024-01-18', '16:40:00', '2024-01-18 11:41:21', '2024-01-18 11:41:21'),
(61, 103, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-18', '16:42:00', '2024-01-18 11:42:48', '2024-01-18 11:42:48'),
(62, 104, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-18', '16:44:00', '2024-01-18 11:45:26', '2024-01-18 11:45:26'),
(63, 105, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de41', 'Дачная', '2', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-19', '12:12:00', '2024-01-19 07:15:32', '2024-01-19 07:15:32'),
(64, 106, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ', '2024-01-19', '13:24:00', '2024-01-19 08:25:02', '2024-01-19 08:25:02'),
(65, 107, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df22', '11-я', '1', NULL, NULL, '1', '1', NULL, NULL, '2024-01-19', '14:56:00', '2024-01-19 09:56:59', '2024-01-19 09:56:59'),
(66, 108, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df4f', 'Гоголя', '2', '1', '2', '4', '56', NULL, 'Тестовый сайт', '2024-01-19', '15:54:00', '2024-01-19 10:56:07', '2024-01-19 10:56:07'),
(67, 109, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-19', '15:57:00', '2024-01-19 10:58:13', '2024-01-19 10:58:13'),
(68, 110, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!!', '2024-01-21', '17:31:00', '2024-01-21 12:32:59', '2024-01-21 12:32:59'),
(69, 111, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-22', '13:46:00', '2024-01-22 08:46:49', '2024-01-22 08:46:49'),
(70, 112, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de35', 'Морской', '19', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-22', '16:02:00', '2024-01-22 11:03:25', '2024-01-22 11:03:25'),
(71, 113, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-22', '18:32:00', '2024-01-22 13:33:36', '2024-01-22 13:33:36'),
(72, 114, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-23', '11:24:00', '2024-01-23 06:25:40', '2024-01-23 06:25:40'),
(73, 115, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dedd', '12-я', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-23', '14:57:00', '2024-01-23 09:58:57', '2024-01-23 09:58:57'),
(74, 116, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dedd', '12-я', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-23', '14:57:00', '2024-01-23 10:00:22', '2024-01-23 10:00:22'),
(75, 117, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dece', 'Зеленая', '1', 'А', NULL, '4', '18', NULL, 'Код от домофона 05555', '2024-01-23', '17:03:00', '2024-01-23 12:13:03', '2024-01-23 12:13:03'),
(76, 118, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-25', '17:26:00', '2024-01-25 12:27:23', '2024-01-25 12:27:23'),
(77, 119, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-25', '17:29:00', '2024-01-25 12:30:49', '2024-01-25 12:30:49'),
(78, 120, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfac', 'Майский', '3', NULL, '2', NULL, '47', NULL, 'У дома закрытая территория, перед заездом позвонить', '2024-01-25', '17:50:00', '2024-01-25 12:52:44', '2024-01-25 12:52:44'),
(79, 121, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый Заказ!!!', '2024-01-26', '11:30:00', '2024-01-26 06:31:02', '2024-01-26 06:31:02'),
(80, 127, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dea7', 'Солнечная', '1', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-01-31', '16:14:00', '2024-01-31 11:15:58', '2024-01-31 11:15:58'),
(81, 128, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de56', '10-я', '1', '1', NULL, NULL, NULL, NULL, NULL, '2024-01-31', '16:29:00', '2024-01-31 11:29:53', '2024-01-31 11:29:53'),
(82, 129, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-31', '16:52:00', '2024-01-31 11:53:24', '2024-01-31 11:53:24'),
(83, 130, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dea7', 'Солнечная', '2', '1', '1', '4', '23', NULL, 'Тестовый заказ!!!', '2024-01-31', '17:58:00', '2024-01-31 13:01:38', '2024-01-31 13:01:38'),
(84, 131, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de41', 'Дачная', '6', '2', '2', '8', '103', NULL, NULL, '2024-02-02', '12:07:00', '2024-02-02 07:16:10', '2024-02-02 07:16:10'),
(85, 132, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df4c', 'Гагарина', '12а', NULL, NULL, NULL, NULL, NULL, '5 приборов. Закрывать на представительские', '2024-02-03', '14:47:00', '2024-02-03 09:57:17', '2024-02-03 09:57:17'),
(86, 133, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dea4', 'Тихая', '3', NULL, '1', '5', '26', NULL, NULL, '2024-02-04', '15:07:00', '2024-02-04 10:09:40', '2024-02-04 10:09:40'),
(87, 134, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de74', 'Яблоневая', '18А', NULL, NULL, '7', '87', NULL, 'Домофон не работает, позвоните', '2024-02-06', '13:48:00', '2024-02-06 08:51:00', '2024-02-06 08:51:00'),
(88, 135, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовая заявка!!!', '2024-02-06', '15:25:00', '2024-02-06 10:25:51', '2024-02-06 10:25:51'),
(89, 136, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовая заявка!!!', '2024-02-06', '15:26:00', '2024-02-06 10:26:58', '2024-02-06 10:26:58'),
(90, 137, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de05', 'Садовая', '4А', NULL, NULL, '2', '5', NULL, NULL, '2024-02-09', '19:00:00', '2024-02-09 12:08:42', '2024-02-09 12:08:42'),
(91, 138, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de74', 'Яблоневая', '19', NULL, '1', '7', '85', NULL, NULL, '2024-02-10', '16:13:00', '2024-02-10 11:22:24', '2024-02-10 11:22:24'),
(92, 139, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de05', 'Садовая', '4А', NULL, NULL, '2', '5', NULL, NULL, '2024-02-10', '18:46:00', '2024-02-10 13:53:14', '2024-02-10 13:53:14'),
(93, 140, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46deef', 'Кленовая', '2', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-02-12', '13:01:00', '2024-02-12 08:02:30', '2024-02-12 08:02:30'),
(94, 141, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfac', 'Майский', '9', NULL, '3', '3', '64', NULL, NULL, '2024-02-13', '18:29:00', '2024-02-13 13:32:58', '2024-02-13 13:32:58'),
(95, 142, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfc7', 'Олимпийский', '14', NULL, NULL, '3', '14', NULL, NULL, '2024-02-18', '12:17:00', '2024-02-18 07:26:42', '2024-02-18 07:26:42'),
(96, 144, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-18', '15:08:00', '2024-02-18 10:10:21', '2024-02-18 10:10:21'),
(97, 145, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df4c', 'Гагарина', '12а', NULL, NULL, '3', '9', NULL, NULL, '2024-02-18', '15:52:00', '2024-02-18 11:43:02', '2024-02-18 11:43:02'),
(98, 146, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-19', '15:43:00', '2024-02-19 10:50:28', '2024-02-19 10:50:28'),
(99, 149, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Карта 748757', '2024-02-20', '11:38:00', '2024-02-20 07:03:35', '2024-02-20 07:03:35'),
(100, 150, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Карта 748757', '2024-02-20', '12:06:00', '2024-02-20 07:07:05', '2024-02-20 07:07:05'),
(101, 151, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Карта 748757', '2024-02-20', '12:08:00', '2024-02-20 07:08:59', '2024-02-20 07:08:59'),
(102, 152, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de68', '1-я', '1', '2', '2', '222', '2', NULL, NULL, '2024-02-21', '18:29:00', '2024-02-21 13:31:14', '2024-02-21 13:31:14'),
(103, 153, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de38', 'Балтийская', '13', NULL, '1', '2', '24', NULL, 'Парковка у нашего дома огорожена забором, позвоните по телефону 89099250727, я открою ворота.  Код в подъезд 5555в', '2024-02-23', '19:30:00', '2024-02-23 09:22:15', '2024-02-23 09:22:15'),
(104, 154, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dee6', 'Железнодорожный', '3', NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-25', '16:00:00', '2024-02-25 12:16:27', '2024-02-25 12:16:27'),
(105, 155, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df9a', 'Железнодорожная', '21', NULL, NULL, NULL, NULL, NULL, 'Порезать пиццу небольшими кусочками', '2024-03-01', '09:43:00', '2024-03-01 06:13:55', '2024-03-01 06:13:55'),
(106, 156, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfb2', 'Пригородная', '3', NULL, NULL, '5', '64', NULL, NULL, '2024-03-01', '16:32:00', '2024-03-01 11:35:54', '2024-03-01 11:35:54'),
(107, 158, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dece', 'Зеленая', '8', NULL, '1', '2', '5', NULL, 'Код калитки 1248#, код входной двери 1248', '2024-03-02', '19:08:00', '2024-03-02 14:13:16', '2024-03-02 14:13:16'),
(108, 161, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '195584 бонусная карта', '2024-03-03', '18:36:00', '2024-03-03 13:40:48', '2024-03-03 13:40:48'),
(109, 165, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dea4', 'Тихая', '12', NULL, NULL, '4', '103', NULL, 'Тихая 12 кв 103', '2024-03-07', '20:17:00', '2024-03-07 15:23:41', '2024-03-07 15:23:41'),
(110, 166, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46ddf6', 'Ленина', '1', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!', '2024-03-08', '12:56:00', '2024-03-08 07:57:16', '2024-03-08 07:57:16'),
(111, 167, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df79', '5-я', '1', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!', '2024-03-08', '12:56:00', '2024-03-08 07:57:44', '2024-03-08 07:57:44'),
(112, 168, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df16', 'Пионерская', '30', NULL, '1', '3', '7', NULL, NULL, '2024-03-08', '16:44:00', '2024-03-08 11:46:12', '2024-03-08 11:46:12'),
(113, 169, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-08', '17:58:00', '2024-03-08 12:59:37', '2024-03-08 12:59:37'),
(114, 171, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-08', '17:55:00', '2024-03-08 13:03:35', '2024-03-08 13:03:35'),
(115, 174, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df2e', 'Штрауса', '4', NULL, NULL, NULL, '9', NULL, NULL, '2024-03-09', '11:13:00', '2024-03-09 06:18:18', '2024-03-09 06:18:18'),
(116, 175, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de41', 'Дачная', '6', NULL, '2', '4', '88', NULL, NULL, '2024-03-09', '13:55:00', '2024-03-09 09:00:47', '2024-03-09 09:00:47'),
(117, 176, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-03-09', '14:14:00', '2024-03-09 09:16:28', '2024-03-09 09:16:28'),
(118, 177, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46def8', 'Сосновая', '31', '3', NULL, NULL, NULL, NULL, NULL, '2024-03-10', '12:39:00', '2024-03-10 07:44:39', '2024-03-10 07:44:39'),
(119, 178, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46ddf6', 'Ленина', '15', NULL, NULL, '2', '17', NULL, 'День рождение', '2024-03-10', '14:09:00', '2024-03-10 09:13:02', '2024-03-10 09:13:02'),
(120, 179, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df16', 'Пионерская', '30', NULL, '1', '3', '7', NULL, NULL, '2024-03-10', '16:21:00', '2024-03-10 11:25:22', '2024-03-10 11:25:22'),
(121, 180, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df82', 'Архитектора', '36', NULL, NULL, NULL, '2', NULL, NULL, '2024-03-10', '16:31:00', '2024-03-10 11:38:54', '2024-03-10 11:38:54'),
(122, 181, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df0a', 'Московская', '18', NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-10', '20:16:00', '2024-03-10 15:19:49', '2024-03-10 15:19:49'),
(123, 182, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ', '2024-03-11', '13:49:00', '2024-03-11 08:50:14', '2024-03-11 08:50:14'),
(124, 183, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-03-12', '13:41:00', '2024-03-12 08:42:58', '2024-03-12 08:42:58'),
(125, 184, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de5f', 'Живописный', '345345', NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-13', '18:47:00', '2024-03-13 14:48:45', '2024-03-13 14:48:45'),
(126, 185, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-03-20', '16:35:00', '2024-03-20 12:36:31', '2024-03-20 12:36:31'),
(127, 186, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de05', 'Садовая', '1', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-03-26', '12:40:00', '2024-03-26 08:42:57', '2024-03-26 08:42:57'),
(128, 188, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dee0', 'Ивовый', '2', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-03-26', '16:01:00', '2024-03-26 12:02:56', '2024-03-26 12:02:56'),
(129, 189, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de83', 'Заречная', '2', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-03-27', '14:08:00', '2024-03-27 10:10:12', '2024-03-27 10:10:12'),
(137, 1, 'Офис', 179, NULL, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46deda', 'Коммунальная', '13', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-02 13:30:26', '2024-04-02 14:08:00'),
(139, 190, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-04-24', '17:31:00', '2024-04-24 13:32:40', '2024-04-24 13:32:40'),
(140, 191, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-04-26', '11:42:00', '2024-04-26 07:44:12', '2024-04-26 07:44:12'),
(141, 192, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '09:48:00', '2024-05-23 05:55:55', '2024-05-23 05:55:55'),
(142, 193, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '09:58:00', '2024-05-23 05:58:47', '2024-05-23 05:58:47'),
(143, 194, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '09:58:00', '2024-05-23 06:00:12', '2024-05-23 06:00:12'),
(144, 195, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:09:00', '2024-05-23 06:11:02', '2024-05-23 06:11:02'),
(145, 196, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:09:00', '2024-05-23 06:19:34', '2024-05-23 06:19:34'),
(146, 197, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:09:00', '2024-05-23 06:20:47', '2024-05-23 06:20:47'),
(147, 198, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:09:00', '2024-05-23 06:23:40', '2024-05-23 06:23:40'),
(148, 199, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:24:00', '2024-05-23 06:26:28', '2024-05-23 06:26:28'),
(149, 200, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:24:00', '2024-05-23 06:27:36', '2024-05-23 06:27:36'),
(150, 201, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:24:00', '2024-05-23 06:28:35', '2024-05-23 06:28:35'),
(151, 202, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:24:00', '2024-05-23 06:29:39', '2024-05-23 06:29:39'),
(152, 203, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:24:00', '2024-05-23 06:31:30', '2024-05-23 06:31:30'),
(153, 204, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:24:00', '2024-05-23 06:31:53', '2024-05-23 06:31:53'),
(154, 205, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:24:00', '2024-05-23 06:32:06', '2024-05-23 06:32:06'),
(155, 206, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:24:00', '2024-05-23 06:32:48', '2024-05-23 06:32:48'),
(156, 207, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:24:00', '2024-05-23 06:37:42', '2024-05-23 06:37:42'),
(157, 208, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:24:00', '2024-05-23 06:41:19', '2024-05-23 06:41:19'),
(158, 209, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:42:00', '2024-05-23 06:43:19', '2024-05-23 06:43:19'),
(159, 210, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:45:00', '2024-05-23 06:45:45', '2024-05-23 06:45:45'),
(160, 211, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '10:49:00', '2024-05-23 06:50:07', '2024-05-23 06:50:07'),
(161, 212, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '12:16:00', '2024-05-23 08:22:40', '2024-05-23 08:22:40'),
(162, 213, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '12:32:00', '2024-05-23 08:32:57', '2024-05-23 08:32:57'),
(163, 214, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '12:33:00', '2024-05-23 08:35:14', '2024-05-23 08:35:14'),
(164, 215, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '12:38:00', '2024-05-23 08:39:02', '2024-05-23 08:39:02'),
(165, 216, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-23', '16:59:00', '2024-05-23 13:00:24', '2024-05-23 13:00:24'),
(166, 217, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-05-24', '13:49:00', '2024-05-24 09:52:40', '2024-05-24 09:52:40'),
(167, 218, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-05-24', '13:54:00', '2024-05-24 09:55:49', '2024-05-24 09:55:49'),
(168, 219, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfaf', 'Верещагина', '2', '1', '1', '1', '1', NULL, 'Тестовый заказ!!!', '2024-05-24', '14:00:00', '2024-05-24 10:02:48', '2024-05-24 10:02:48'),
(169, 220, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de1d', 'Майская', '3', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-05-24', '15:11:00', '2024-05-24 10:13:16', '2024-05-24 10:13:16'),
(170, 221, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df4f', 'Гоголя', '2', '3', '5', '2', '7', NULL, 'Тестовый заказ!!!', '2024-05-24', '15:20:00', '2024-05-24 10:25:50', '2024-05-24 10:25:50'),
(171, 222, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-05-27', '13:35:00', '2024-05-27 07:36:40', '2024-05-27 07:36:40'),
(172, 223, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de41', 'Дачная', '6', NULL, '1', '6', '39', NULL, 'Код домофона #4230', '2024-05-28', '13:53:00', '2024-05-28 07:58:06', '2024-05-28 07:58:06'),
(173, 224, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df16', 'Пионерская', '30', NULL, '1', '3', '7', NULL, NULL, '2024-05-29', '19:13:00', '2024-05-29 13:19:15', '2024-05-29 13:19:15'),
(174, 225, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-05-30', '12:28:00', '2024-05-30 06:29:47', '2024-05-30 06:29:47'),
(175, 226, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df76', 'Ольховая', '17', NULL, '1', '4', '19', NULL, NULL, '2024-05-31', '18:48:00', '2024-05-31 12:51:29', '2024-05-31 12:51:29'),
(176, 227, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-01', '19:29:00', '2024-06-01 13:32:17', '2024-06-01 13:32:17'),
(177, 228, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de41', 'Дачная', '6', NULL, '1', '6', '39', NULL, NULL, '2024-06-03', '14:30:00', '2024-06-03 08:32:24', '2024-06-03 08:32:24'),
(178, 229, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de41', 'Дачная', '6', NULL, '1', '6', '39', NULL, 'код домофона #4230', '2024-06-04', '15:00:00', '2024-06-04 09:02:28', '2024-06-04 09:02:28'),
(179, 230, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df94', 'Динамо', '1а', NULL, NULL, '1', '5', NULL, NULL, '2024-06-05', '15:12:00', '2024-06-05 09:21:39', '2024-06-05 09:21:39'),
(180, 231, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfac', 'Майский', '19', NULL, '3', '6', '122', NULL, 'Код домофона: 02019', '2024-06-05', '16:20:00', '2024-06-05 10:22:53', '2024-06-05 10:22:53'),
(181, 232, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfac', 'Майский', '19', NULL, '3', '6', '122', NULL, 'Код домофона: 02019', '2024-06-05', '16:20:00', '2024-06-05 10:23:10', '2024-06-05 10:23:10'),
(182, 233, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfac', 'Майский', '19', NULL, '3', '6', '122', NULL, 'Код домофона: 02019', '2024-06-05', '16:20:00', '2024-06-05 10:25:25', '2024-06-05 10:25:25'),
(183, 234, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-07', '18:30:00', '2024-06-07 12:13:07', '2024-06-07 12:13:07'),
(184, 235, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-07', '18:30:00', '2024-06-07 12:13:18', '2024-06-07 12:13:18'),
(185, 236, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-07', '18:30:00', '2024-06-07 12:13:38', '2024-06-07 12:13:38'),
(186, 237, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-07', '20:30:00', '2024-06-07 14:34:08', '2024-06-07 14:34:08'),
(187, 238, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df94', 'Динамо', '1А', NULL, NULL, NULL, '5', NULL, NULL, '2024-06-08', '21:49:00', '2024-06-08 15:52:24', '2024-06-08 15:52:24'),
(188, 239, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfac', 'Майский', '19', NULL, '3', '6', '122', NULL, 'Код домофона: 02019', '2024-06-09', '14:15:00', '2024-06-09 08:18:13', '2024-06-09 08:18:13'),
(189, 240, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df16', 'Пионерская', '30', NULL, '1', '3', '7', NULL, 'Средиземноморский суп с морепродуктами - 2 штуки', '2024-06-09', '20:01:00', '2024-06-09 14:08:46', '2024-06-09 14:08:46'),
(190, 241, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df76', 'Ольховая', '19', '4', '1', '1', '1', NULL, 'Удобнее заехать через ворота 3', '2024-06-09', '21:32:00', '2024-06-09 15:38:00', '2024-06-09 15:38:00'),
(191, 242, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dea4', 'Тихая', '7', NULL, '1', '5', '24', NULL, NULL, '2024-06-10', '18:41:00', '2024-06-10 12:43:39', '2024-06-10 12:43:39'),
(192, 243, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Светлогорск, ул сосновая 5 кВ.13', '2024-06-13', '17:53:00', '2024-06-13 11:56:23', '2024-06-13 11:56:23'),
(193, 244, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-15', '14:17:00', '2024-06-15 08:26:18', '2024-06-15 08:26:18'),
(194, 245, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-15', '20:16:00', '2024-06-15 14:28:14', '2024-06-15 14:28:14'),
(195, 246, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Не добавляйте сыр в пасту с тунцом и салат с ростбифом пожалуйста. Требуется доставка в отель Хартман, перезвоните, пожалуйста. Спасибо!', '2024-06-17', '20:37:00', '2024-06-17 14:40:23', '2024-06-17 14:40:23'),
(196, 247, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-17', '20:48:00', '2024-06-17 15:04:54', '2024-06-17 15:04:54'),
(197, 248, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-17', '20:48:00', '2024-06-17 15:05:23', '2024-06-17 15:05:23'),
(198, 249, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-17', '20:48:00', '2024-06-17 15:05:35', '2024-06-17 15:05:35'),
(199, 250, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-17', '20:48:00', '2024-06-17 15:06:05', '2024-06-17 15:06:05'),
(200, 251, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-17', '20:48:00', '2024-06-17 15:06:13', '2024-06-17 15:06:13'),
(201, 252, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-17', '20:48:00', '2024-06-17 15:06:22', '2024-06-17 15:06:22'),
(202, 253, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-17', '20:48:00', '2024-06-17 15:06:51', '2024-06-17 15:06:51'),
(203, 254, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-17', '21:27:00', '2024-06-17 15:29:23', '2024-06-17 15:29:23'),
(204, 255, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df76', 'Ольховая', '19', '4', '1', '5', '35', NULL, NULL, '2024-06-18', '14:27:00', '2024-06-18 08:29:56', '2024-06-18 08:29:56'),
(205, 256, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-06-23', '14:57:00', '2024-06-23 08:58:05', '2024-06-23 08:58:05'),
(206, 257, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-08', '19:40:00', '2024-07-08 13:45:07', '2024-07-08 13:45:07'),
(207, 258, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df7c', 'Партизанский', '6', NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-10', '13:15:00', '2024-07-10 07:20:52', '2024-07-10 07:20:52'),
(208, 259, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de3b', 'Аптечная', '8', NULL, NULL, NULL, '2', NULL, 'Тестовый заказ!!!', '2024-07-11', '16:34:00', '2024-07-11 10:36:47', '2024-07-11 10:36:47'),
(209, 260, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df76', 'Ольховая', '17', NULL, '1', '4', '19', NULL, 'Подъезд и калитка территории открыты', '2024-07-11', '18:11:00', '2024-07-11 12:23:36', '2024-07-11 12:23:36'),
(210, 261, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-13', '12:54:00', '2024-07-13 06:57:05', '2024-07-13 06:57:05'),
(211, 262, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-13', '22:19:00', '2024-07-13 16:23:55', '2024-07-13 16:23:55'),
(212, 263, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-19', '16:48:00', '2024-07-19 10:50:46', '2024-07-19 10:50:46'),
(213, 264, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-19', '16:50:00', '2024-07-19 10:52:39', '2024-07-19 10:52:39'),
(214, 265, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-19', '16:59:00', '2024-07-19 11:03:33', '2024-07-19 11:03:33'),
(215, 266, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Самовывоз, подойду к 19:20', '2024-07-20', '19:20:00', '2024-07-20 13:47:30', '2024-07-20 13:47:30'),
(216, 267, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-21', '12:35:00', '2024-07-21 06:40:53', '2024-07-21 06:40:53'),
(217, 268, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ул.Сосновая 5-13', '2024-07-25', '19:18:00', '2024-07-25 13:20:12', '2024-07-25 13:20:12'),
(218, 269, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-28', '13:30:00', '2024-07-28 06:49:11', '2024-07-28 06:49:11'),
(219, 270, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-28', '13:30:00', '2024-07-28 06:49:21', '2024-07-28 06:49:21'),
(220, 271, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-28', '13:30:00', '2024-07-28 06:50:03', '2024-07-28 06:50:03'),
(221, 272, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-28', '13:30:00', '2024-07-28 06:50:10', '2024-07-28 06:50:10'),
(222, 273, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-28', '13:30:00', '2024-07-28 06:50:19', '2024-07-28 06:50:19'),
(223, 274, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-28', '14:37:00', '2024-07-28 08:39:21', '2024-07-28 08:39:21'),
(224, 275, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Доставка курьером', '2024-07-28', '14:35:00', '2024-07-28 08:47:36', '2024-07-28 08:47:36'),
(225, 276, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-07-28', '15:29:00', '2024-07-28 09:31:31', '2024-07-28 09:31:31'),
(226, 277, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'майский проезд 19, подъезд 1, этаж 2, квартира 6', '2024-07-28', '15:46:00', '2024-07-28 09:48:34', '2024-07-28 09:48:34'),
(227, 278, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-07', '18:00:00', '2024-08-07 11:47:37', '2024-08-07 11:47:37'),
(228, 279, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-07', '19:42:00', '2024-08-07 13:44:40', '2024-08-07 13:44:40'),
(229, 280, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-12', '22:00:00', '2024-08-12 16:35:24', '2024-08-12 16:35:24'),
(230, 281, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-13', '12:20:00', '2024-08-13 06:35:29', '2024-08-13 06:35:29'),
(231, 282, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-13', '12:20:00', '2024-08-13 06:35:50', '2024-08-13 06:35:50'),
(232, 283, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-13', '12:20:00', '2024-08-13 06:36:21', '2024-08-13 06:36:21'),
(233, 284, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-13', '12:20:00', '2024-08-13 06:36:57', '2024-08-13 06:36:57'),
(234, 285, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-13', '12:20:00', '2024-08-13 06:37:09', '2024-08-13 06:37:09'),
(235, 286, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Карта hartman 834452', '2024-08-14', '22:30:00', '2024-08-14 16:49:06', '2024-08-14 16:49:06'),
(236, 287, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-15', '14:34:00', '2024-08-15 08:39:10', '2024-08-15 08:39:10'),
(237, 288, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15', '21:14:00', '2024-08-15 15:20:50', '2024-08-15 15:20:50'),
(238, 289, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15', '21:14:00', '2024-08-15 15:21:12', '2024-08-15 15:21:12'),
(239, 290, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15', '21:19:00', '2024-08-15 15:21:31', '2024-08-15 15:21:31'),
(240, 291, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15', '21:21:00', '2024-08-15 15:22:32', '2024-08-15 15:22:32'),
(241, 292, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Позвонить за 10 минут', '2024-08-16', '18:00:00', '2024-08-16 09:03:44', '2024-08-16 09:03:44'),
(242, 293, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-20', '16:30:00', '2024-08-20 10:36:30', '2024-08-20 10:36:30'),
(243, 294, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-21', '19:20:00', '2024-08-21 13:23:41', '2024-08-21 13:23:41'),
(244, 295, NULL, 179, 3, 'Светлогорск', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Нужна доставка, яблоневая 18а', '2024-08-21', '20:37:00', '2024-08-21 14:42:08', '2024-08-21 14:42:08'),
(245, 296, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Верещагина 12\nПозвонить 89814540889', '2024-08-22', '13:40:00', '2024-08-22 07:46:04', '2024-08-22 07:46:04'),
(246, 297, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Буду через 25 минут', '2024-08-22', '21:27:00', '2024-08-22 15:32:00', '2024-08-22 15:32:00'),
(247, 298, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-23', '19:25:00', '2024-08-23 13:31:03', '2024-08-23 13:31:03'),
(248, 299, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-23', '19:32:00', '2024-08-23 13:39:32', '2024-08-23 13:39:32'),
(249, 300, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-23', '19:46:00', '2024-08-23 13:48:27', '2024-08-23 13:48:27'),
(250, 301, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Имя Дмитрий номер телефона +79109838554', '2024-08-25', '21:37:00', '2024-08-25 15:39:48', '2024-08-25 15:39:48'),
(251, 302, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Дима', '2024-08-25', '21:50:00', '2024-08-25 15:41:21', '2024-08-25 15:41:21'),
(252, 303, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Дима', '2024-08-25', '21:50:00', '2024-08-25 15:42:00', '2024-08-25 15:42:00'),
(253, 304, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-28', '16:12:00', '2024-08-28 10:14:42', '2024-08-28 10:14:42'),
(254, 305, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-08-28', '20:55:00', '2024-08-28 15:03:11', '2024-08-28 15:03:11'),
(255, 306, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-09-07', '16:21:00', '2024-09-07 10:25:34', '2024-09-07 10:25:34'),
(256, 307, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!! Адрес Карла Маркса 3А', '2024-09-08', '13:47:00', '2024-09-08 07:49:02', '2024-09-08 07:49:02'),
(257, 308, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Не Тестовый заказ!!!', '2024-09-08', '14:45:00', '2024-09-08 08:49:06', '2024-09-08 08:49:06'),
(259, 310, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-09-12', '21:05:00', '2024-09-12 15:08:24', '2024-09-12 15:08:24'),
(260, 311, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-18', '16:19:00', '2024-09-18 10:21:05', '2024-09-18 10:21:05'),
(261, 312, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Тестовый заказ!!!', '2024-09-19', '20:19:00', '2024-09-19 14:28:31', '2024-09-19 14:28:31'),
(262, 313, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-20', '21:08:00', '2024-09-20 15:16:17', '2024-09-20 15:16:17'),
(264, 315, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-21', '20:32:00', '2024-09-21 14:36:54', '2024-09-21 14:36:54'),
(265, 316, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-24', '20:27:00', '2024-09-24 14:28:21', '2024-09-24 14:28:21'),
(266, 317, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dff1', 'Калининградский', '59а', NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-25', '14:25:00', '2024-09-25 08:31:19', '2024-09-25 08:31:19'),
(267, 318, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de98', 'Сказочника', '2', NULL, NULL, NULL, NULL, NULL, 'Позвонить на указанный телефон я выйду', '2024-09-27', '18:30:00', '2024-09-27 10:09:19', '2024-09-27 10:09:19'),
(268, 319, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46df76', 'Ольховая', '32', '7', '1', '1', 'З', NULL, NULL, '2024-09-28', '20:32:00', '2024-09-28 14:37:14', '2024-09-28 14:37:14'),
(269, 320, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfb2', 'Пригородная', '1', '2', '1', '7', '33', NULL, NULL, '2024-09-29', '19:59:00', '2024-09-29 14:05:35', '2024-09-29 14:05:35');
INSERT INTO `customer_addresses` (`id`, `user_id`, `name`, `country_id`, `type_id`, `city`, `street_id`, `street_name`, `house`, `building`, `entrance`, `floor`, `flat`, `doorphone`, `notes`, `delivery_date`, `delivery_time`, `created_at`, `updated_at`) VALUES
(270, 321, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dece', 'Зеленая', '1а', NULL, NULL, NULL, '3а', NULL, NULL, '2024-09-29', '20:25:00', '2024-09-29 14:29:13', '2024-09-29 14:29:13'),
(271, 322, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dece', 'Зеленая', '1а', NULL, NULL, NULL, '3а', NULL, NULL, '2024-09-29', '20:25:00', '2024-09-29 14:29:53', '2024-09-29 14:29:53'),
(272, 323, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46ddf6', 'Ленина', '22', NULL, NULL, '1', NULL, NULL, 'Магазин косметики ,рядом с аптекой ригла напротив Кренделя . доп.пармезан. Не в блюдо а отдельно.', '2024-10-04', '14:52:00', '2024-10-04 08:57:58', '2024-10-04 08:57:58'),
(273, 324, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfb5', 'Горького', '14', NULL, NULL, '6', '103', NULL, NULL, '2024-10-05', '21:09:00', '2024-10-05 15:12:38', '2024-10-05 15:12:38'),
(274, 325, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46dfc7', 'Олимпийский', '3', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-07', '20:04:00', '2024-10-07 14:07:07', '2024-10-07 14:07:07'),
(275, 326, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-08', '15:13:00', '2024-10-08 09:15:32', '2024-10-08 09:15:32'),
(276, 327, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-08', '15:13:00', '2024-10-08 09:15:35', '2024-10-08 09:15:35'),
(277, 328, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-10', '15:20:00', '2024-10-10 09:58:46', '2024-10-10 09:58:46'),
(278, 329, NULL, 179, 3, 'Светлогорск', '[object Object]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-10', '19:35:00', '2024-10-10 13:59:01', '2024-10-10 13:59:01'),
(279, 330, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de38', 'Балтийская', '15', NULL, '15', '2', '24', NULL, 'Пиццу без соуса чили', '2024-10-14', '20:36:00', '2024-10-14 14:39:03', '2024-10-14 14:39:03'),
(280, 331, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de68', '1-я', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-17', '12:35:00', '2024-10-17 06:36:17', '2024-10-17 06:36:17'),
(283, 334, NULL, 179, 1, 'Светлогорск', '0484521b-c371-3e15-018c-7bfd8f46de68', '1-я', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-18', '13:31:00', '2024-10-18 07:35:48', '2024-10-18 07:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_methods`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `delivery_methods`;
CREATE TABLE `delivery_methods` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `external_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `sort` int UNSIGNED DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_methods`
--

INSERT INTO `delivery_methods` (`id`, `name`, `code`, `external_id`, `amount`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Доставка курьером', 'DeliveryByCourier', '76067ea3-356f-eb93-9d14-1fa00d082c4e', '200', 1, 1, '2023-12-10 16:15:50', '2024-06-18 08:37:34'),
(3, 'Самовывоз', 'DeliveryPickUp', '5b1508f9-fe5b-d6af-cb8d-043af587d5c2', '0', 2, 1, '2023-12-11 09:24:19', '2023-12-14 08:18:50'),
(5, 'Обычный заказ', 'Common', 'bbbef4dc-5a02-7ea3-81d3-826f4e8bb3e0', '0', 3, 0, '2023-12-14 08:18:50', '2023-12-14 08:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE `discounts` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `max_uses` int DEFAULT NULL,
  `max_uses_user` int DEFAULT NULL,
  `type` enum('percent','fixed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `discount_amount` decimal(10,0) NOT NULL,
  `min_amount` decimal(10,0) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `code`, `name`, `description`, `max_uses`, `max_uses_user`, `type`, `discount_amount`, `min_amount`, `status`, `starts_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'NG2023', 'Новогодняя скидка 2023', 'Новогодняя скидка 2023 на 12', 100, 1, 'percent', '12', '2000', 1, '2024-04-07 20:00:00', '2024-04-29 20:00:00', '2023-12-09 09:39:58', '2024-04-08 13:38:29'),
(3, 'NEW10', 'Скидка на первый заказ', 'Скидка 10% на первый заказ', NULL, 1, 'percent', '10', '950', 1, '2024-10-16 19:00:00', '2024-12-30 19:00:00', '2024-10-12 06:16:59', '2024-10-17 06:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 'Корзина', '2024-01-04 00:00:00', '2024-01-04 00:00:00', '00:00:00', '00:00:00', '2024-01-06 12:02:05', '2024-01-07 14:43:43'),
(2, 'Two', '2024-01-07 16:02:17', '2024-01-07 16:02:18', '00:00:00', '00:00:00', '2024-01-06 12:02:20', '2024-01-06 12:02:21'),
(3, 'Корзина', '2024-01-06 00:00:00', '2024-01-06 00:00:00', '00:00:00', '00:00:00', '2024-01-06 12:12:26', '2024-01-06 12:12:26'),
(4, 'ываываы', '2024-01-06 00:00:00', '2024-01-06 00:00:00', '00:00:00', '00:00:00', '2024-01-06 12:12:51', '2024-01-06 12:12:51'),
(5, 'Корзина', '2024-01-06 00:00:00', '2024-01-06 00:00:00', '00:00:00', '00:00:00', '2024-01-06 13:53:24', '2024-01-06 13:53:24'),
(6, 'Корзина', '2024-01-06 00:00:00', '2024-01-06 00:00:00', '00:00:00', '00:00:00', '2024-01-06 13:53:32', '2024-01-06 13:53:32'),
(9, 'Корзина', '2024-01-25 00:00:00', '2024-01-26 00:00:00', '00:00:00', '00:00:00', '2024-01-06 14:13:28', '2024-01-06 14:13:28'),
(10, 'Корзина', '2024-01-26 00:00:00', '2024-01-27 00:00:00', '00:00:00', '00:00:00', '2024-01-06 14:15:17', '2024-01-06 14:15:17'),
(11, 'Корзина', '2024-01-27 00:00:00', '2024-01-28 00:00:00', '00:00:00', '00:00:00', '2024-01-06 14:18:11', '2024-01-06 14:18:11'),
(12, 'Корзина', '2024-01-23 00:00:00', '2024-01-24 00:00:00', '00:00:00', '00:00:00', '2024-01-06 14:18:39', '2024-01-06 14:18:39'),
(13, 'Корзина', '2024-01-01 00:00:00', '2024-01-02 00:00:00', '20:10:00', '22:00:00', '2024-01-14 10:59:12', '2024-01-14 10:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE `features` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ru',
  `order_by` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `slug`, `unit`, `group`, `lang`, `order_by`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Длина', 'length', 'мм', 'common', 'ru', 2, 1, '2023-12-04 09:53:58', '2024-11-20 09:09:02'),
(4, 'Диаметр', 'diametr', 'мм', 'common', 'ru', 3, 1, '2023-12-04 09:57:01', '2024-11-20 09:09:11'),
(5, 'Смола', 'resin', 'мг', 'common', 'ru', 4, 1, '2023-12-04 09:58:19', '2024-11-20 09:09:26'),
(6, 'Никотин', 'nicotine', 'мг', 'common', 'ru', 5, 1, '2024-11-15 09:04:06', '2024-11-20 09:09:38'),
(7, 'Формат', NULL, NULL, 'common', 'ru', 1, 0, '2024-11-27 10:11:45', '2024-11-27 10:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `feature_good`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `feature_good`;
CREATE TABLE `feature_good` (
  `id` int NOT NULL,
  `feature_id` int UNSIGNED NOT NULL,
  `good_id` int UNSIGNED NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_good`
--

INSERT INTO `feature_good` (`id`, `feature_id`, `good_id`, `value`) VALUES
(1, 1, 1, 'King size'),
(2, 2, 1, '20 сигарет'),
(3, 3, 1, '80мм'),
(4, 4, 1, '21.36мм'),
(5, 5, 1, '6мг'),
(6, 6, 1, '0.6мг'),
(7, 1, 3, 'King size'),
(8, 2, 3, '20 сигарет'),
(9, 3, 3, '80'),
(10, 4, 3, '21.36'),
(11, 5, 3, '6'),
(12, 6, 3, '0.6'),
(13, 7, 3, 'King size'),
(14, 8, 3, '20 сигарет'),
(15, 9, 3, '80мм'),
(16, 10, 3, '21.36мм'),
(17, 11, 3, '6мг'),
(18, 12, 3, '0.6мг'),
(19, 4, 4, '7,7'),
(20, 3, 4, '83'),
(21, 5, 4, '8'),
(22, 6, 4, '0,7'),
(23, 19, 4, '7,7'),
(24, 20, 4, '83'),
(25, 21, 4, '8'),
(26, 22, 4, '0,6'),
(27, 4, 5, '7,7'),
(28, 3, 5, '83'),
(29, 5, 5, '8'),
(30, 6, 5, '0,6'),
(31, 28, 5, '83 мм'),
(32, 27, 5, '7,7 мм'),
(33, 29, 5, '8 мг'),
(34, 30, 5, '0,7 мг'),
(35, 4, 6, '7,7'),
(36, 3, 6, '83'),
(37, 5, 6, '8'),
(38, 6, 6, '0,6'),
(39, 4, 8, '7,7'),
(40, 3, 8, '83'),
(41, 5, 8, '8'),
(42, 6, 8, '0,6'),
(43, 4, 9, '7,7'),
(44, 3, 9, '83'),
(45, 5, 9, '6'),
(46, 6, 9, '0,7'),
(47, 4, 10, '7,7'),
(48, 3, 10, '83'),
(49, 5, 10, '7'),
(50, 6, 10, '0,7'),
(51, 4, 11, '5,4'),
(52, 3, 11, '99'),
(53, 5, 11, '4'),
(54, 6, 11, '0,5'),
(55, 4, 12, '7,7'),
(56, 3, 12, '83'),
(57, 5, 12, '8'),
(58, 6, 12, '0,7'),
(59, 4, 13, '5,4'),
(60, 3, 13, '99'),
(61, 5, 13, '4'),
(62, 6, 13, '0,5'),
(63, 4, 14, '5,4'),
(64, 3, 14, '99'),
(65, 5, 14, '4'),
(66, 6, 14, '0,5'),
(67, 4, 15, '5,4'),
(68, 3, 15, '99'),
(69, 5, 15, '4'),
(70, 6, 15, '0,5'),
(71, 4, 16, '5,4'),
(72, 3, 16, '99'),
(73, 5, 16, '4'),
(74, 6, 16, '0,5'),
(75, 4, 17, '5,4'),
(76, 3, 17, '83'),
(77, 5, 17, '3'),
(78, 6, 17, '0,4'),
(79, 4, 18, '5,4'),
(80, 3, 18, '83'),
(81, 5, 18, '3'),
(82, 6, 18, '0.4'),
(83, 4, 19, '5,4'),
(84, 3, 19, '83'),
(85, 5, 19, '3'),
(86, 6, 19, '0,3'),
(87, 4, 20, '7,1'),
(88, 3, 20, '83'),
(89, 5, 20, '6'),
(90, 6, 20, '0,6'),
(91, 4, 21, '7,1'),
(92, 3, 21, '83'),
(93, 5, 21, '8'),
(94, 6, 21, '0,7'),
(95, 4, 22, '7,1'),
(96, 3, 22, '83'),
(97, 5, 22, '6'),
(98, 6, 22, '0,6'),
(99, 4, 23, '7,1'),
(100, 3, 23, '83'),
(101, 5, 23, '4'),
(102, 6, 23, '0,4'),
(103, 4, 24, '7,1'),
(104, 3, 24, '83'),
(105, 5, 24, '6'),
(106, 6, 24, '0,6'),
(107, 4, 25, '7,1'),
(108, 3, 25, '83'),
(109, 5, 25, '5'),
(110, 6, 25, '0,5'),
(111, 4, 26, '7,1'),
(112, 3, 26, '83'),
(113, 5, 26, '6'),
(114, 6, 26, '0,6'),
(115, 4, 27, '5,4'),
(116, 3, 27, '83'),
(117, 5, 27, '3'),
(118, 6, 27, '0,5'),
(119, 4, 28, '5,4'),
(120, 3, 28, '83'),
(121, 5, 28, '6'),
(122, 6, 28, '0,6'),
(123, 4, 7, '7,7'),
(124, 3, 7, '83'),
(125, 5, 7, '9'),
(126, 6, 7, '0,7'),
(127, 7, 10, 'King size'),
(128, 7, 11, 'Super slims'),
(129, 7, 24, 'Compact'),
(130, 7, 27, 'Nano'),
(131, 7, 28, 'Nano'),
(132, 7, 12, 'King size'),
(133, 7, 13, 'Super slims'),
(134, 7, 25, 'Compact'),
(135, 7, 26, 'Compact'),
(136, 7, 4, 'KS (мягкая пачка)'),
(137, 7, 5, 'King size'),
(138, 7, 14, 'Super slims'),
(139, 7, 17, 'Nano'),
(140, 7, 20, 'Compact'),
(141, 7, 15, 'Super slims'),
(142, 7, 18, 'Nano'),
(143, 7, 21, 'Compact'),
(144, 7, 16, 'Super slims'),
(145, 7, 19, 'Nano'),
(146, 7, 22, 'Compact'),
(147, 7, 23, 'Compact'),
(148, 7, 7, 'KS (мягкая пачка)'),
(149, 7, 6, 'King size'),
(150, 7, 9, 'King size'),
(151, 7, 8, 'King size');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_picture`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `gallery_picture`;
CREATE TABLE `gallery_picture` (
  `id` int NOT NULL,
  `gallery_id` int UNSIGNED NOT NULL DEFAULT '0',
  `picture_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` bigint UNSIGNED NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_robots` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `custom` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `related_goods` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `oldprice` decimal(10,0) DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `order_by` int DEFAULT NULL,
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` int DEFAULT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available` tinyint(1) DEFAULT '1',
  `track_qty` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'N',
  `quantity` bigint DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `order_item_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `featured` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Y',
  `novelty` tinyint(1) DEFAULT '0',
  `hit` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `meta_title`, `meta_keywords`, `meta_description`, `meta_robots`, `name`, `slug`, `subtitle`, `excerpt`, `description`, `custom`, `related_goods`, `picture`, `price`, `oldprice`, `discount`, `order_by`, `lang`, `tags`, `brand_id`, `sku`, `barcode`, `code`, `external_id`, `available`, `track_qty`, `quantity`, `type_id`, `order_item_type`, `status`, `featured`, `novelty`, `hit`, `created_at`, `updated_at`) VALUES
(4, NULL, NULL, NULL, NULL, 'Ростовские', 'rostovskie-liuks-m', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 2, NULL, 1, 'N', 0, 0, '2024-11-19 14:51:15', '2024-12-04 07:23:27'),
(5, NULL, NULL, NULL, NULL, 'Ростовские', 'rostovskie-liuks', 'твердая пачка', NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 11, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 2, NULL, 1, 'N', 0, 0, '2024-11-19 18:14:48', '2024-12-04 08:56:44'),
(6, NULL, NULL, NULL, NULL, 'Сталинградские', 'stalingradskie', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 12, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, NULL, NULL, 1, 'N', 0, 0, '2024-11-19 18:25:59', '2024-12-04 08:57:00'),
(7, NULL, NULL, NULL, NULL, 'Сталинградские', 'stalingradskie-originalnye', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 6, NULL, 1, 'N', 0, 0, '2024-11-19 18:29:32', '2024-12-04 08:45:38'),
(8, NULL, NULL, NULL, NULL, 'Bayron W', 'bayron', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 10, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, NULL, NULL, 1, 'N', 0, 0, '2024-11-20 08:10:43', '2024-12-04 08:56:11'),
(9, NULL, NULL, NULL, NULL, 'Bayron', 'bayron-w', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 9, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, NULL, NULL, 1, 'N', 0, 0, '2024-11-20 08:12:20', '2024-12-04 08:55:58'),
(10, NULL, NULL, NULL, NULL, 'Silver Leaf', 'Silver Leaf1', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 10, NULL, 1, 'N', 0, 0, '2024-11-20 08:54:45', '2024-12-03 12:51:38'),
(11, NULL, NULL, NULL, NULL, 'Silver Leaf', 'Silver Leaf-super-slim', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 1, NULL, 1, 'N', 0, 0, '2024-11-20 08:56:14', '2024-12-03 07:37:50'),
(12, NULL, NULL, NULL, NULL, 'Golden Leaf', 'golden-leaf', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 10, NULL, 1, 'N', 0, 0, '2024-11-20 09:06:12', '2024-12-04 07:18:37'),
(13, NULL, NULL, NULL, NULL, 'Golden Leaf', 'golden-leaf-super-slim', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 1, NULL, 1, 'N', 0, 0, '2024-11-20 09:51:39', '2024-12-04 07:19:06'),
(14, NULL, NULL, NULL, NULL, 'Compliment 1', 'Compliment 1', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 6, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 1, NULL, 1, 'N', 0, 0, '2024-11-20 09:57:09', '2024-12-04 08:54:45'),
(15, NULL, NULL, NULL, NULL, 'Compliment 3', 'compliment-3', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 7, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 1, NULL, 1, 'N', 0, 0, '2024-11-20 10:00:22', '2024-12-04 08:54:57'),
(16, NULL, NULL, NULL, NULL, 'Compliment 5', 'compliment-5', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 8, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 1, NULL, 1, 'N', 0, 0, '2024-11-20 10:01:46', '2024-12-04 08:55:08'),
(17, NULL, NULL, NULL, NULL, 'Compliment 1', 'Compliment 1 Super Slims Compact', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 7, NULL, 1, 'N', 0, 0, '2024-11-20 10:03:50', '2024-12-04 08:40:05'),
(18, NULL, NULL, NULL, NULL, 'Compliment 3', 'Compliment 3 Super Slims Compact', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 7, NULL, 1, 'N', 0, 0, '2024-11-20 10:05:27', '2024-12-04 08:43:14'),
(19, NULL, NULL, NULL, NULL, 'Compliment 5', 'Compliment 5 Super Slims Compact', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 7, NULL, 1, 'N', 0, 0, '2024-11-20 10:06:57', '2024-12-04 08:44:12'),
(20, NULL, NULL, NULL, NULL, 'Compliment 1', 'Compliment 1 Slims Standard', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 8, NULL, 1, 'N', 0, 0, '2024-11-20 10:18:06', '2024-12-04 08:42:10'),
(21, NULL, NULL, NULL, NULL, 'Compliment 3', 'Compliment 3 Slims Standard', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 8, NULL, 1, 'N', 0, 0, '2024-11-20 10:20:19', '2024-12-04 08:43:28'),
(22, NULL, NULL, NULL, NULL, 'Export', 'export', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 1, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 9, NULL, 1, 'N', 0, 0, '2024-11-20 10:26:56', '2024-12-04 08:44:36'),
(23, NULL, NULL, NULL, NULL, 'Export W', 'export-w', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 2, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 9, NULL, 1, 'N', 0, 0, '2024-11-20 10:28:16', '2024-12-04 08:44:52'),
(24, NULL, NULL, NULL, NULL, 'Silver Leaf', 'Slims', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 3, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 9, NULL, 1, 'N', 0, 0, '2024-11-20 10:32:27', '2024-12-03 07:38:44'),
(25, NULL, NULL, NULL, NULL, 'Golden Leaf', 'Golden Leaf slims', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 4, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 9, NULL, 1, 'N', 0, 0, '2024-11-20 10:33:56', '2024-12-04 07:19:35'),
(26, NULL, NULL, NULL, NULL, 'Blue', 'Blue', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 5, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 9, NULL, 1, 'N', 0, 0, '2024-11-20 10:37:13', '2024-12-04 08:55:19'),
(27, NULL, NULL, NULL, NULL, 'Silver Leaf', 'Silver Leaf compact', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 4, NULL, 1, 'N', 0, 0, '2024-11-20 10:40:08', '2024-12-10 11:38:26'),
(28, NULL, NULL, NULL, NULL, 'Golden Leaf', 'Golden Leaf compact', NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 'шт.', NULL, NULL, NULL, 1, 'N', NULL, 4, NULL, 1, 'N', 0, 0, '2024-11-20 10:41:33', '2024-12-10 11:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `good_colors`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `good_colors`;
CREATE TABLE `good_colors` (
  `id` bigint UNSIGNED NOT NULL,
  `good_id` bigint UNSIGNED NOT NULL,
  `color_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `good_order`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `good_order`;
CREATE TABLE `good_order` (
  `order_id` bigint UNSIGNED NOT NULL,
  `good_id` bigint UNSIGNED NOT NULL,
  `price` int UNSIGNED DEFAULT NULL,
  `quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `good_ratings`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `good_ratings`;
CREATE TABLE `good_ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `good_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_modifiers`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `item_modifiers`;
CREATE TABLE `item_modifiers` (
  `item_id` bigint UNSIGNED NOT NULL,
  `modifier_id` bigint UNSIGNED NOT NULL,
  `amount` int UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` bigint DEFAULT '0',
  `iiko_order_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `merchants`;
CREATE TABLE `merchants` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `phone`, `email`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test', '+7(999)999-99-99', 'test@mail.ru', '<h3>Новая заявка</h3>\n      <p>С сайта Балтийская Табачная Фабрика пришло новая заявка, от:<br>\n      <p>\n        Имя: <b>Test</b><br>\n        Фамилия: <b>Testov</b><br>\n        Телефон: <b>+7(999)999-99-99</b><br>\n        Email: <b>test@mail.ru</b><br>\n        Компания: <b>Testify</b><br>\n        Город: <b>Testograd</b>\n      </p>', 'read', '2024-11-19 05:39:23', NULL),
(2, 'тест', '+7(121)212-12-12', '123@mai.ru', '<h3>Новая заявка</h3>\n      <p>С сайта Балтийская Табачная Фабрика пришло новая заявка, от:<br>\n      <p>\n        Имя: <b>тест</b><br>\n        Фамилия: <b>тест</b><br>\n        Телефон: <b>+7(121)212-12-12</b><br>\n        Email: <b>123@mai.ru</b><br>\n        Компания: <b>тест</b><br>\n        Город: <b>тест</b>\n      </p>', 'read', '2024-11-20 13:26:19', NULL),
(3, 'тест', '+7(121)212-12-12', '123@mai.ru', '<h3>Новая заявка</h3>\n      <p>С сайта Балтийская Табачная Фабрика пришло новая заявка, от:<br>\n      <p>\n        Имя: <b>тест</b><br>\n        Фамилия: <b>тест</b><br>\n        Телефон: <b>+7(121)212-12-12</b><br>\n        Email: <b>123@mai.ru</b><br>\n        Компания: <b>тест</b><br>\n        Город: <b>тест</b>\n      </p>', 'read', '2024-11-20 13:26:35', NULL),
(4, 'Test', '+7(657)567-66-45', 'kultura39@bk.ru', '<h3>Новая заявка</h3>\n      <p>С сайта Балтийская Табачная Фабрика пришло новая заявка, от:<br>\n      <p>\n        Имя: <b>Test</b><br>\n        Фамилия: <b>Кондратеня</b><br>\n        Телефон: <b>+7(657)567-66-45</b><br>\n        Email: <b>kultura39@bk.ru</b><br>\n        Компания: <b>Hookah Market</b><br>\n        Город: <b>Калининград</b>\n      </p>', 'read', '2024-11-20 13:29:21', NULL),
(5, 'Кирилл', '+7(911)454-73-30', 'i.tader@btf39.su', '<h3>Новая заявка</h3>\n      <p>С сайта Балтийская Табачная Фабрика пришло новая заявка, от:<br>\n      <p>\n        Имя: <b>Кирилл</b><br>\n        Фамилия: <b>Наседкин</b><br>\n        Телефон: <b>+7(911)454-73-30</b><br>\n        Email: <b>i.tader@btf39.su</b><br>\n        Компания: <b>БТФ</b><br>\n        Город: <b>Калининград</b>\n      </p>', 'read', '2024-11-25 12:20:11', NULL),
(6, 'Test777', '+7(921)996-08-38', 'btf102@yandex.ru', '<h3>Новая заявка</h3>\n      <p>С сайта Балтийская Табачная Фабрика пришло новая заявка, от:<br>\n      <p>\n        Имя: <b>Test777</b><br>\n        Фамилия: <b></b><br>\n        Телефон: <b>+7(921)996-08-38</b><br>\n        Email: <b>btf102@yandex.ru</b><br>\n        Компания: <b>Hookah Market</b><br>\n        Город: <b>Калининград</b>\n      </p>', 'new', '2024-12-03 14:36:46', NULL),
(7, 'Марина', '+7(891)469-61-03', 'marinaklgd2012@gmail.com', '<h3>Новая заявка</h3>\n      <p>С сайта Балтийская Табачная Фабрика пришло новая заявка, от:<br>\n      <p>\n        Имя: <b>Марина</b><br>\n        Фамилия: <b>Емельянова</b><br>\n        Телефон: <b>+7(891)469-61-03</b><br>\n        Email: <b>marinaklgd2012@gmail.com</b><br>\n        Компания: <b>Мурманск табак</b><br>\n        Город: <b>Мурманск</b>\n      </p>', 'new', '2024-12-04 11:45:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2023_11_18_193808_create_settings_table', 1),
(9, '2023_11_19_122744_create_goods_table', 1),
(10, '2023_11_19_123209_create_categories_table', 1),
(11, '2023_11_19_123859_create_comments_table', 1),
(12, '2023_11_19_124149_create_pages_table', 1),
(13, '2023_11_19_125701_create_category_good_table', 1),
(14, '2023_11_19_131330_create_users_table', 1),
(15, '2023_11_19_131611_create_password_resets_table', 1),
(16, '2023_11_19_131736_create_failed_jobs_table', 1),
(17, '2023_11_19_131917_create_sessions_table', 1),
(18, '2023_11_19_132058_create_posts_table', 1),
(20, '2023_11_19_132750_create_rubrics_table', 1),
(21, '2023_11_19_133031_create_orders_table', 1),
(22, '2023_11_19_133223_create_good_order_table', 1),
(23, '2023_11_19_142830_create_pictures_table', 1),
(24, '2023_11_19_143209_create_picture_good_table', 1),
(25, '2023_11_20_090055_create_galleries_table', 1),
(26, '2023_11_20_090546_create_gallery_picture_table', 1),
(27, '2023_11_20_091323_create_payments_table', 1),
(28, '2023_11_20_093202_create_payment_types_table', 1),
(29, '2023_11_26_193010_create_brands_table', 2),
(30, '2023_11_28_083454_create_temp_images_table', 3),
(31, '2023_11_30_135950_create_reviews_table', 3),
(32, '2023_12_01_133255_create_attributes_table', 4),
(33, '2023_12_06_143227_create_countries_table', 5),
(34, '2023_12_06_161257_create_customer_addresses_table', 5),
(35, '2023_12_06_193959_create_order_items_table', 5),
(36, '2023_12_07_155830_alter_orders_table', 6),
(37, '2023_12_07_221753_alter_users_table', 7),
(38, '2023_12_09_010201_create_discounts_table', 8),
(40, '2023_12_10_032117_create_shippings_table', 9),
(41, '2023_12_14_124507_create_cities_table', 10),
(42, '2023_12_19_110039_create_logs_table', 11),
(43, '2023_12_29_233737_create_events_table', 12),
(44, '2023_12_30_003759_create_wishlists_table', 13),
(45, '2024_01_05_124922_create_colors_table', 14),
(46, '2024_03_29_224545_alter_orders_table', 15),
(47, '2024_03_29_224851_create_coupons_table', 15),
(48, '2024_03_30_192020_create_currencies_table', 16),
(49, '2024_04_02_095902_alter_customer_addresses', 17),
(50, '2024_04_03_121226_alter_goods_table', 18),
(55, '2024_04_06_232521_create_slides_table', 19),
(58, '2024_04_22_105245_modifiers', 22),
(59, '2024_05_22_142904_create_item_modifiers_table', 23),
(60, '2023_11_20_093202_create_payment_methods_table', 24),
(61, '2024_09_30_005800_create_good_ratings_table', 24),
(62, '2024_10_06_202307_create_activity_log_table', 24),
(63, '2024_10_06_202308_add_event_column_to_activity_log_table', 24),
(64, '2024_10_06_202309_add_batch_uuid_column_to_activity_log_table', 24),
(65, '2024_10_06_215439_create_jobs_table', 24),
(66, '2024_10_08_021010_alter_orders_table', 25),
(67, '2024_10_09_025537_create_good_colors_table', 25),
(68, '2024_10_20_010148_alter_orders_table', 26),
(70, '2024_11_03_021622_create_merchants_table', 27),
(71, '2024_11_08_032936_create_permission_tables', 28),
(72, '2024_11_10_004049_create_role_user_table', 29),
(73, '2024_11_10_155002_create_services_table', 30),
(74, '2024_11_16_003800_create_partners_table', 31),
(75, '2024_11_18_232709_create_types_table', 32);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modifiers`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `modifiers`;
CREATE TABLE `modifiers` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `good_id` int NOT NULL,
  `group_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `defaultAmount` int NOT NULL DEFAULT '0',
  `minAmount` int NOT NULL DEFAULT '0',
  `maxAmount` int NOT NULL DEFAULT '0',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `hideIfDefaultAmount` tinyint(1) NOT NULL DEFAULT '0',
  `splittable` tinyint(1) NOT NULL DEFAULT '0',
  `freeOfChargeAmount` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modifiers`
--

INSERT INTO `modifiers` (`id`, `good_id`, `group_id`, `defaultAmount`, `minAmount`, `maxAmount`, `required`, `hideIfDefaultAmount`, `splittable`, `freeOfChargeAmount`) VALUES
('5109a305-912b-4a1b-89c6-a9a06c25a08c', 144, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('d5a00733-4581-4230-8541-0f5155ac3a66', 144, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 158, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 158, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 158, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 156, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 156, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 156, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5109a305-912b-4a1b-89c6-a9a06c25a08c', 142, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('d5a00733-4581-4230-8541-0f5155ac3a66', 142, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('5109a305-912b-4a1b-89c6-a9a06c25a08c', 140, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('d5a00733-4581-4230-8541-0f5155ac3a66', 140, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 157, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 157, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 157, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 159, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 159, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 159, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 161, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 161, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 161, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('382b3de6-0281-4490-abd3-1b0a195ade2f', 203, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('d19de23f-f79e-4a00-8a71-fb5e69a6291b', 203, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('5109a305-912b-4a1b-89c6-a9a06c25a08c', 228, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('d5a00733-4581-4230-8541-0f5155ac3a66', 228, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('382b3de6-0281-4490-abd3-1b0a195ade2f', 199, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('d19de23f-f79e-4a00-8a71-fb5e69a6291b', 199, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('382b3de6-0281-4490-abd3-1b0a195ade2f', 200, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('d19de23f-f79e-4a00-8a71-fb5e69a6291b', 200, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('382b3de6-0281-4490-abd3-1b0a195ade2f', 201, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('d19de23f-f79e-4a00-8a71-fb5e69a6291b', 201, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('382b3de6-0281-4490-abd3-1b0a195ade2f', 202, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('d19de23f-f79e-4a00-8a71-fb5e69a6291b', 202, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('382b3de6-0281-4490-abd3-1b0a195ade2f', 204, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('d19de23f-f79e-4a00-8a71-fb5e69a6291b', 204, '99e9dfea-52a9-40ff-a2a0-f6674317bd17', 0, 0, 0, 0, 0, 0, 0),
('5109a305-912b-4a1b-89c6-a9a06c25a08c', 138, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('d5a00733-4581-4230-8541-0f5155ac3a66', 138, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('5109a305-912b-4a1b-89c6-a9a06c25a08c', 139, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('d5a00733-4581-4230-8541-0f5155ac3a66', 139, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('5109a305-912b-4a1b-89c6-a9a06c25a08c', 141, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('d5a00733-4581-4230-8541-0f5155ac3a66', 141, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('5109a305-912b-4a1b-89c6-a9a06c25a08c', 143, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('d5a00733-4581-4230-8541-0f5155ac3a66', 143, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('5109a305-912b-4a1b-89c6-a9a06c25a08c', 145, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('d5a00733-4581-4230-8541-0f5155ac3a66', 145, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('5109a305-912b-4a1b-89c6-a9a06c25a08c', 146, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('d5a00733-4581-4230-8541-0f5155ac3a66', 146, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('5109a305-912b-4a1b-89c6-a9a06c25a08c', 147, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('d5a00733-4581-4230-8541-0f5155ac3a66', 147, '6d7d0e01-031f-4553-970b-9e7ca6e1736e', 0, 0, 0, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 148, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 148, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 148, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 150, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 150, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 150, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 151, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 151, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 151, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 152, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 152, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 152, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 153, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 153, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 153, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('dd8609e5-789c-4d5d-848d-c45b5acdd0e0', 154, 'f3c9b2f2-834d-43c9-bc5f-c42d41e3d279', 0, 0, 1, 0, 0, 0, 0),
('f1bf28a8-4930-4a67-92d2-c6d7a2c95fba', 154, 'f3c9b2f2-834d-43c9-bc5f-c42d41e3d279', 0, 0, 1, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 154, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 154, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 154, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 155, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 155, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 155, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 238, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 238, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 238, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 239, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 239, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 239, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 160, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 160, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 160, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('85fe8e9d-049a-41b8-88a5-29aca2ed9d04', 240, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('7e90f70f-73fc-4548-8417-2d4b4320ba3f', 240, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0),
('5a88c094-461a-4ccf-b913-1d176e496403', 240, '717ba2fa-adcb-4bfa-a7ec-ba313514a55e', 0, 0, 2, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `external_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` int UNSIGNED DEFAULT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `shipping` decimal(10,0) NOT NULL,
  `coupon_id` int UNSIGNED DEFAULT NULL,
  `discount_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(10,0) DEFAULT NULL,
  `grand_total` decimal(10,0) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `shipped_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `currency_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `good_id` bigint UNSIGNED NOT NULL,
  `size_id` int UNSIGNED DEFAULT NULL,
  `color_id` int UNSIGNED DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int DEFAULT NULL,
  `metatitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `robots` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `parent_id`, `metatitle`, `keywords`, `description`, `robots`, `title`, `slug`, `subtitle`, `text`, `image`, `custom`, `lang`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Балтийская табачная фабрика', NULL, 'Производство табачной продукции в Калининграде', NULL, 'Главная', 'home', '«Балтийская табачная фабрика: традиции вкуса, качество без компромиссов»', '<h2>Балтийская табачная фабрика — для вас с 1997 года.</h2><p>Балтийская табачная фабрика – это современное предприятие, специализирующееся на производстве высококачественных табачных изделий. Мы гордимся богатой историей и традициями, которые берут своё начало более 25 лет назад. Наша миссия – создавать продукцию, соответствующую самым высоким стандартам, и удовлетворять потребность наших клиентов как в России, так и за рубежом.</p>', NULL, '[{\"title\":\"Продукция\",\"alias\":\"production\",\"body\":\"<p>Каталог продукции: широкий ассортимент качественных табачных изделий. У нас вы найдёте сигареты с фильтром различных форматов по доступной цене.<\\/p><p>Откройте для себя мир изысканного вкуса и наслаждайтесь каждой затяжкой!<\\/p>\"},{\"title\":\"О Компании\",\"alias\":\"about\",\"body\":\"<p>Фабрика расположена в городе Калининграде и специализируется на производстве сигарет. Основной вид деятельности — производство табачных изделий.<\\/p>\"},{\"title\":\"Дистрибьюторы\",\"alias\":\"distributors\",\"body\":\"<p>Сеть дистрибьюторов, которые занимаются оптовой торговлей табачными изделиями, работают с\\r\\nпроизводителями и импортёрами, обеспечивая доставку товаров и поддерживая каналы сбыта.<\\/p>\"}]', 'ru', 1, 1, '2023-11-20 05:47:09', '2024-12-19 08:25:10'),
(2, NULL, 'Балтийская табачная фабрика', NULL, NULL, NULL, 'О компании', 'about', NULL, NULL, NULL, '[{\"title\":\"Основано в 1997 году\",\"alias\":\"text-1\",\"body\":\"<p class=\\\"MsoNormal\\\" style=\\\"text-indent:35.4pt\\\"><b><span style=\\\"font-size:12.0pt;\\r\\nline-height:107%\\\">Балтийская табачная фабрика <\\/span><\\/b><span style=\\\"font-size:12.0pt;line-height:107%\\\">– это современное предприятие,\\r\\nспециализирующееся на производстве высококачественных табачных изделий. Мы\\r\\nгордимся богатой историей и традициями, которые берут своё начало более 25 лет\\r\\nназад. Наша миссия – создавать продукцию, соответствующую самым высоким\\r\\nстандартам, и удовлетворять потребность наших клиентов как в России, так и за\\r\\nрубежом.<b><o:p><\\/o:p><\\/b><\\/span><\\/p>\"},{\"title\":\"Что мы предлагаем:\",\"alias\":\"text-2\",\"body\":\"<p class=\\\"MsoNormal\\\" style=\\\"text-align:justify;text-indent:35.4pt\\\"><span style=\\\"font-size:12.0pt;line-height:107%\\\">- <b>Широкий ассортимент продукции: <\\/b>Мы\\r\\nпроизводим различные виды табачной продукции. Каждое изделие создается с учетом\\r\\nвкусовых предпочтений наших клиентов.<o:p><\\/o:p><\\/span><\\/p><p class=\\\"MsoNormal\\\" style=\\\"text-align:justify;text-indent:35.4pt\\\"><span style=\\\"font-size:12.0pt;line-height:107%\\\">- <b>Качество и контроль: <\\/b>на\\r\\nкаждом этапе производства мы строго контролируем качество сырья и готовой\\r\\nпродукции. <\\/span><span style=\\\"font-size:12.0pt;mso-bidi-font-size:11.0pt;\\r\\nline-height:107%\\\">Технологический процесс включает в себя полный цикл\\r\\nпереработки табачного сырья, производство ацетатных фильтров и упаковку сигарет\\r\\nразличных форматов.<\\/span><span style=\\\"font-size:12.0pt;line-height:107%\\\"> Табачные\\r\\nмешки разработаны индивидуально для каждого бренда и формата сигарет из\\r\\nспециально отобранных высококачественных сортов табака в соответствии с\\r\\nмировыми стандартами. <o:p><\\/o:p><\\/span><\\/p><p>\\r\\n\\r\\n\\r\\n\\r\\n<\\/p><p class=\\\"MsoNormal\\\" style=\\\"text-align:justify;text-indent:35.4pt\\\"><b><span style=\\\"font-size:12.0pt;line-height:107%\\\">- Инновации: <\\/span><\\/b><span style=\\\"font-size:12.0pt;line-height:107%\\\">Мы постоянно внедряем современные\\r\\nтехнологии и методы производства, что позволяет совершенствовать продукцию и\\r\\nоптимизировать производственные процессы.<o:p><\\/o:p><\\/span><\\/p>\"},{\"title\":\"Контакты:\",\"alias\":\"text-3\",\"body\":\"<p class=\\\"MsoNormal\\\" style=\\\"text-align:justify\\\"><span style=\\\"font-size:12.0pt;\\r\\nline-height:107%\\\">Если у вас есть вопросы или вы хотите узнать больше о нашей\\r\\nпродукции, пожалуйста, свяжитесь с нами через раздел «<a href=\\\"\\/contacts\\\">Контакты<\\/a>». Мы всегда рады\\r\\nпомочь.<o:p><\\/o:p><\\/span><\\/p>\"},{\"title\":\"Ассортимент\",\"alias\":\"text-4\",\"body\":\"<p><span style=\\\"font-size: 16px; text-align: justify;\\\">Мы приглашаем вас ознакомиться с нашим <a href=\\\"\\/catalog\\\">ассортиментом<\\/a>. Благодарим вас за интерес к нашей продукции.<\\/span><\\/p>\"}]', 'ru', 4, 1, '2023-11-20 05:59:15', '2024-12-19 08:28:28'),
(3, NULL, NULL, NULL, NULL, NULL, 'Дистрибьюторы', 'distributors', 'Стать партнером', '<p>Приглашаем вас стать официальным дистрибьютором нашей табачной фабрики и расширить свой бизнес с <br>\r\nпомощью качественных и востребованных товаров. Заполните форму и наш один из Торговых Домов или <br> дистрибьюторов свяжется с вами!</p>', NULL, '', 'ru', 3, 1, '2023-11-20 08:30:19', '2024-11-14 11:59:11'),
(4, NULL, NULL, NULL, NULL, NULL, 'Каталог продукции', 'catalog', NULL, NULL, NULL, '', 'ru', 6, 1, '2023-11-20 09:16:46', '2024-11-14 12:24:01'),
(5, NULL, NULL, NULL, NULL, NULL, 'Контакты', 'contacts', NULL, NULL, NULL, '', 'ru', 7, 1, '2023-11-20 19:27:32', '2023-12-18 08:39:05'),
(6, NULL, NULL, NULL, NULL, NULL, 'Политика конфиденциальности', 'politika-konfidentsialnosti', NULL, '<p><br></p>', NULL, '', 'ru', 1, 1, '2023-11-26 03:05:55', '2024-12-03 13:28:38'),
(13, NULL, NULL, NULL, NULL, NULL, 'Обработка персональных данных', 'polzovatelskoe-soglashenie', NULL, NULL, NULL, '', 'ru', 3, 1, '2023-12-18 08:35:21', '2024-12-03 13:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coordinates` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `surname`, `email`, `phone`, `company`, `city`, `address`, `coordinates`, `site`, `schedule`, `picture`, `order_by`, `status`, `created_at`, `updated_at`) VALUES
(2, NULL, NULL, 'alemurashov@yandex.ru', '8(4012) 45-37-69', 'ООО «Форт-Пост Калининград»', 'Калининград', '236006, г. Калининград, ул. Правая Набережная, д. 10, литер А', NULL, NULL, NULL, NULL, 1, 1, '2024-11-17 23:54:50', '2024-11-19 10:56:40'),
(3, NULL, NULL, 'gelios06_dt@mail.ru', '8-8793-31-63-43', 'ООО «Ставропольская табачная компания»', 'Пятигорск', 'Пятигорск, ул. Адмиральского, 2, корпус 2', NULL, NULL, NULL, NULL, 20, 1, '2024-11-18 00:09:16', '2024-12-03 07:13:28'),
(4, NULL, NULL, 'kvinta97@mail.ru', '(8652)99-20-02', 'ООО «Квинта»', 'Ставрополь', '355035 г. Ставрополь пер. Торговый ,4/1, офис 29', NULL, NULL, NULL, NULL, 3, 1, '2024-11-18 00:10:42', '2024-11-19 10:59:47'),
(5, NULL, NULL, NULL, '8 (86137) 7-33-98', 'ООО фирма «Аверс-Табак»', 'Армавир', '352915, Краснодарский край, г. Армавир ул. Поветкина, 180/1', NULL, NULL, NULL, NULL, 4, 1, '2024-11-18 00:12:10', '2024-12-05 11:11:53'),
(8, NULL, NULL, 'south_polus@mail.ru', '8(861)231-77-01', 'ООО «Южный полюс»', 'Краснодар', 'г. Краснодар, ул. Новороссийская 210,Литер К, оф.8,9', NULL, NULL, NULL, NULL, 7, 1, '2024-11-19 03:37:45', '2024-12-05 12:23:22'),
(9, NULL, NULL, 'Business.class15@mail.ru', '8-962-433-35-89', 'ООО «Бизнес Класс»', 'Ростов-на-Дону', '346715, Ростовская область, Аксайский район, п. Янтарный, ул. Малое Зеленое Кольцо, дом 3, ТЦ «Альтус», офис 316', NULL, NULL, NULL, NULL, 9, 1, '2024-11-19 03:37:58', '2024-11-28 08:49:45'),
(10, NULL, NULL, 'info@agrofart.ru', '(8442) 49-36-36', 'ООО «АГРОФАРТ»', 'Волгоград', '400011, Волгоградская область, г. Волгоград, ул. Электролесовская, 43', NULL, NULL, NULL, NULL, 10, 1, '2024-11-19 03:39:23', '2024-11-19 11:05:03'),
(11, NULL, NULL, 'Lifa74@mail.ru', '89220130555', 'ООО «Берлей»', 'Челябинск', '456512, Челябинская область, Сосновский район, п. Красное поле, ул. Гранитная, д. 5, офис 7', NULL, NULL, NULL, NULL, 11, 1, '2024-11-19 11:06:16', '2024-11-19 11:06:38'),
(12, NULL, NULL, 'lifa64@mail.ru', '+7-987-369-46-27', 'ООО «АЗИМУТ»', 'Саратов', 'Саратов ул. Пионерская д. 32', '+7-987-369-46-27', NULL, NULL, NULL, 12, 1, '2024-11-19 11:07:58', '2024-11-19 11:07:58'),
(13, NULL, NULL, 'Galion.63@yandex.ru', '89277347473', 'ООО «Сириус»', 'Самара', 'Самара 22 партсъезда 10 А', NULL, NULL, NULL, NULL, 13, 1, '2024-11-19 11:10:07', '2024-11-19 11:10:07'),
(14, NULL, NULL, 'btknn@mail.ru', '+7-915-944-60-04', 'ООО «АВРОРА»', 'Нижний Новгород', '603092, г. Нижний Новгород, улица Московское шоссе, д. 302В, помещение 5', NULL, NULL, NULL, NULL, 14, 1, '2024-11-19 11:11:24', '2024-11-19 11:11:24'),
(15, NULL, NULL, 'brigantina.v@mail.ru', '+7 (905) 658-80-81', 'ООО «Бригантина»', 'Воронеж', '394028, Воронежская обл., г. Воронеж, ул. Волгоградская, д.30', NULL, NULL, NULL, NULL, 15, 1, '2024-11-19 11:12:50', '2024-11-19 11:12:50'),
(16, NULL, NULL, 'btkmoscow@mail.ru', '7 (901) 333-81-13', 'ООО «Балтийская Табачная Компания»', 'Москва', '143405, Московская обл, Красногорск г, Центральная ул, дом 3А, литер А2', NULL, NULL, NULL, NULL, 16, 1, '2024-11-19 11:14:39', '2024-11-19 11:14:39'),
(17, NULL, NULL, 'baltiktabak@mail.ru', '8-963-946-6575', 'ООО «Балтик-Табак»', 'Новосибирск', '630001, Новосибирская обл., г. Новосибирск, ул.Сухарная 35,  корпус 13а', NULL, NULL, NULL, NULL, 17, 1, '2024-11-19 11:15:47', '2024-11-19 11:15:47'),
(18, NULL, NULL, 'eurobalt16@gmail.com', '8-987-271-58-05', 'ООО \"Евробалт\"', 'Казань', 'Республика Татарстан, г. Казань, ул. Тихорецкая, д. 7 к.6, оф. 210', NULL, NULL, NULL, NULL, 18, 1, '2024-11-19 11:16:43', '2024-11-19 11:16:43'),
(19, NULL, NULL, 'Btf-rubin@yandex.ru', '+79328443337', 'ООО «Рубин»', 'Оренбург', 'Оренбург пер. Селивановский 58', NULL, NULL, NULL, NULL, 19, 1, '2024-11-19 11:17:41', '2024-11-19 11:17:41'),
(20, NULL, NULL, 'Officetab52020@gmail.com', '+7(959)556-60-26', 'ООО «Декамерон»', 'Луганск', '291016, Луганск, ул. Павла Сороки, 16А/17', NULL, NULL, NULL, NULL, 2, 1, '2024-11-19 11:19:23', '2024-12-05 11:10:20'),
(21, NULL, NULL, '01byron05@mail.ru', '8(812) 677-56-00', 'ООО «Байрон»', 'Санкт-Петербург', '192102, г. Санкт-Петербург, ул. Софийская д.4 , Лит. А, пом. 10Н, офис 222', NULL, NULL, NULL, NULL, 21, 1, '2024-11-19 11:20:22', '2024-11-19 11:20:22'),
(22, NULL, NULL, 'ktk.sibir@mail.ru', '8-983-163-46-77, 8-923-292-19-74', 'ООО «Красноярская табачная компания»', 'Красноярск', 'г. Красноярск, ул. Шахтеров, здание 35 В, помещение 15', NULL, NULL, NULL, NULL, 22, 1, '2024-11-19 11:22:01', '2024-11-19 11:22:01'),
(26, 'Кирилл', 'Наседкин', 'i.tader@btf39.su', '+7(911)454-73-30', 'БТФ', 'Калининград', NULL, NULL, NULL, NULL, NULL, 23, 0, '2024-11-25 08:20:11', '2024-11-25 08:20:11'),
(27, 'Test777', NULL, 'btf102@yandex.ru', '+7(921)996-08-38', 'Hookah Market', 'Калининград', NULL, NULL, NULL, NULL, NULL, 27, 0, '2024-12-03 10:36:46', '2024-12-03 10:36:46'),
(28, 'Марина', 'Емельянова', 'marinaklgd2012@gmail.com', '+7(891)469-61-03', 'Мурманск табак', 'Мурманск', NULL, NULL, NULL, NULL, NULL, 28, 0, '2024-12-04 07:45:12', '2024-12-04 07:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `paymentid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clientid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `orderid` int NOT NULL,
  `type_id` int DEFAULT NULL,
  `sum` decimal(10,0) NOT NULL,
  `key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ps_id` int DEFAULT NULL,
  `client_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_holder` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_expiry` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obtain_datetime` datetime DEFAULT NULL,
  `RRN` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `APPROVAL_CODE` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE `payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `external_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `external_id`, `name`, `code`, `description`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, '8de08bf2-2ff9-40b2-9afc-380fc6743494', 'Банковская карта курьеру', 'CARD', 'Эквайринг. доставка', 2, 1, NULL, NULL),
(2, '5125cb84-fe7b-4b69-ada5-b7f191fef65d', 'Онлайн оплата на сайте', 'ONLN', NULL, 3, 1, NULL, NULL),
(3, '09322f46-578a-d210-add7-eec222a08871', 'Наличные', 'CASH', 'наличные', 1, 1, NULL, NULL),
(4, '79301489-de16-47ff-a656-de6094ed233a', 'СБП', 'SBP', NULL, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `payment_types`;
CREATE TABLE `payment_types` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create role', 'web', '2024-11-08 02:33:24', '2024-11-08 02:33:24'),
(2, 'view role', 'web', '2024-11-08 02:35:24', '2024-11-08 02:35:24'),
(3, 'update role', 'web', '2024-11-08 02:35:41', '2024-11-08 02:35:41'),
(4, 'delete role', 'web', '2024-11-08 02:36:02', '2024-11-08 02:36:02'),
(9, 'delete-post', 'web', '2024-11-10 02:23:49', '2024-11-10 02:23:49'),
(10, 'view payments', 'web', '2024-11-10 02:29:50', '2024-11-10 03:13:09'),
(11, 'view payment methods', 'web', '2024-11-10 02:41:08', '2024-11-10 03:13:18'),
(12, 'create payment method', 'web', '2024-11-10 02:41:21', '2024-11-10 03:01:09'),
(13, 'update payment method', 'web', '2024-11-10 02:56:19', '2024-11-10 03:01:22'),
(14, 'delete payment method', 'web', '2024-11-10 03:01:33', '2024-11-10 03:01:33'),
(15, 'view colors', 'web', '2024-11-10 09:26:43', '2024-11-10 09:26:43'),
(16, 'view merchants', 'web', '2024-11-10 09:26:59', '2024-11-10 09:26:59'),
(17, 'delete goods', 'web', '2024-11-10 09:37:06', '2024-11-10 09:37:06'),
(18, 'change status good', 'web', '2024-11-10 09:43:40', '2024-11-10 09:43:40'),
(19, 'edit good', 'web', '2024-11-10 09:43:52', '2024-11-10 09:43:52'),
(20, 'delete good', 'web', '2024-11-10 09:44:04', '2024-11-10 09:44:04'),
(21, 'create category', 'web', '2024-11-10 10:41:17', '2024-11-10 10:41:17'),
(22, 'update category', 'web', '2024-11-10 12:12:28', '2024-11-10 12:12:28'),
(23, 'delete category', 'web', '2024-11-10 12:12:56', '2024-11-10 12:12:56'),
(24, 'restore category', 'web', '2024-11-10 12:13:12', '2024-11-10 12:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE `pictures` (
  `id` bigint UNSIGNED NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `path`, `name`, `alt`, `description`, `link`, `sort`, `created_at`, `updated_at`) VALUES
(9, 'SrhjvC3wz1VEL2K8.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-19 14:55:05', '2024-11-19 14:55:05'),
(10, 'fEfF5b99WT2dWYBU.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-19 15:07:21', '2024-11-19 15:07:21'),
(11, 'SrUQjnvDtQzlCRlb.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-19 15:07:58', '2024-11-19 15:07:58'),
(12, 'P06HCFE1AkPom3kU.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-19 15:27:08', '2024-11-19 15:27:08'),
(13, 'FHsggI7Iv7NMPIT5.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-19 15:33:08', '2024-11-19 15:33:08'),
(14, 'aS99YzQWkP9tkGLK.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-19 15:33:40', '2024-11-19 15:33:40'),
(15, '9tNTJ3l4GJl3tb97.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-19 15:35:42', '2024-11-19 15:35:42'),
(30, 'U46Fjl6Wi5oF1k9v.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 09:33:01', '2024-11-20 09:33:01'),
(31, 'nv70Dk81E5WEgmfq.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 09:34:06', '2024-11-20 09:34:06'),
(34, 'ctES5KKIe3mYt9aO.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 09:40:10', '2024-11-20 09:40:10'),
(35, 'EGs5LsdmOX1icDbR.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 09:40:33', '2024-11-20 09:40:33'),
(36, 'IUb0BPLOlAlx96bL.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 09:41:51', '2024-11-20 09:41:51'),
(37, 'EkAh2y9RLhLBdgBn.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 09:42:12', '2024-11-20 09:42:12'),
(38, 'qnPhdZ6P8ViThumd.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 09:42:31', '2024-11-20 09:42:31'),
(39, 'v3LuL5e2Taglvzjc.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 09:42:49', '2024-11-20 09:42:49'),
(40, 'odxSD7HLQmxHlGyv.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 09:43:06', '2024-11-20 09:43:06'),
(41, 'jVPyn4dxd1o1E4TP.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 09:53:19', '2024-11-20 09:53:19'),
(42, 'xZfuyJ3GPZX5197r.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 09:57:09', '2024-11-20 09:57:09'),
(43, 'CJfLB7yHeE8sfmad.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:00:22', '2024-11-20 10:00:22'),
(44, 'VQp9GIR1VRHz44rM.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:01:46', '2024-11-20 10:01:46'),
(45, 'Cd9w0jhHsA5es1nk.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:03:50', '2024-11-20 10:03:50'),
(46, 'cIiauIbezeZEpt6X.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:05:27', '2024-11-20 10:05:27'),
(47, 'Fs0Fk9p117QOgvcm.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:06:57', '2024-11-20 10:06:57'),
(48, 'Ow264pZIyS5xdNpq.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:18:06', '2024-11-20 10:18:06'),
(49, 'kdjQsPqwuWxrHZNl.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:20:19', '2024-11-20 10:20:19'),
(50, 'UQzgTopb4L0Q8du2.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:26:56', '2024-11-20 10:26:56'),
(51, 'QQ3280S12HVTkao1.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:28:16', '2024-11-20 10:28:16'),
(52, '6naskPvDJpbft4x0.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:32:27', '2024-11-20 10:32:27'),
(53, 'z6d3SEM4NrXUkvzn.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:33:56', '2024-11-20 10:33:56'),
(54, 'EnEDjdFn0ynioM2z.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:37:28', '2024-11-20 10:37:28'),
(55, 'ZqrMVqYPQWAffiMb.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:40:08', '2024-11-20 10:40:08'),
(56, '8jZQjVAktxfPGFdT.webp', NULL, NULL, NULL, NULL, NULL, '2024-11-20 10:41:33', '2024-11-20 10:41:33');

-- --------------------------------------------------------

--
-- Table structure for table `picture_good`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `picture_good`;
CREATE TABLE `picture_good` (
  `picture_id` bigint UNSIGNED NOT NULL,
  `good_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `picture_good`
--

INSERT INTO `picture_good` (`picture_id`, `good_id`) VALUES
(30, 10),
(31, 11),
(34, 5),
(35, 4),
(36, 12),
(37, 9),
(38, 8),
(39, 7),
(40, 6),
(41, 13),
(42, 14),
(43, 15),
(44, 16),
(45, 17),
(46, 18),
(47, 19),
(48, 20),
(49, 21),
(50, 22),
(51, 23),
(52, 24),
(53, 25),
(54, 26),
(55, 27),
(56, 28);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `rubric_id` int DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `metatitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `robots` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `preview` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `rubric_id`, `user_id`, `metatitle`, `keywords`, `description`, `robots`, `name`, `slug`, `tagline`, `excerpt`, `body`, `preview`, `picture`, `tags`, `lang`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, 'Празднуйте вместе с нами!22', 'prazdnuyte-vmeste-s-nami', 'Скидка 15% в день рождения!', 'Мы предоставляем скидку 15% на всё меню в честь вашего дня рождения если вы отметите его у нас! Предложение действует 3 дня до и 3 дня после даты', '<p>Мы предоставляем скидку 15% на всё меню в честь вашего дня рождения если вы отметите его у нас! Предложение действует 3 дня до и 3 дня после даты.</p><p><strong>*Скидка и подарок действуют не только в зале нашего ресторана, но и навынос и на доставку.</strong></p><p>Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия</p>', 'posts/preview/jWAO5wCBB8v6KBLFPDhkxpTOzseSTgjuDOyXAnJk.png', 'posts/qPlB4g6mPzNhLuEfKTG8hIblWVSnr6uGSn4ekV1I.jpg', NULL, 'ru', 1, '2023-11-20 09:43:39', '2024-11-01 00:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2024-11-08 22:28:56', '2024-11-10 02:03:04'),
(2, 'admin', 'web', '2024-11-08 22:29:29', '2024-11-08 22:29:29'),
(4, 'user', 'web', '2024-11-09 01:29:02', '2024-11-09 01:29:02'),
(5, 'staff', 'web', '2024-11-09 01:29:12', '2024-11-09 01:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(22, 1),
(23, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`) VALUES
(20, 2, 1),
(21, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rubrics`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `rubrics`;
CREATE TABLE `rubrics` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int DEFAULT NULL,
  `metatitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `robots` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `order_by` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--
-- Creation: Dec 03, 2024 at 11:24 AM
-- Last update: Jan 20, 2025 at 11:02 AM
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0X0LgKabK6P111aNdSX6iQ4F2M8OsZs3BmxYT8Mj', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3g1eXp0cEdyWUpEVFRWZ0VUR1hhTjFPbFhva2ExbUJQekw5NU5KbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzc6Imh0dHBzOi8vYnRmLnN1L21vai1yZWJlbm9rL21vZG55ZS1tb2RlbGktZGV0c2tpeC1rb2x5YXNvay10ZW5kZW5jaWktMjAxNi1nb2RhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357792),
('0zQrm9Gl2zMRfoVxDmJdMbnsQlvEsncXhBP10oMx', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTFIYVd1OTVTdUVRZFJoNXBKVWs2c3UxWFJxdHdDNWVuaGp4cVNQSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njk6Imh0dHBzOi8vYnRmLnN1L2JhbmtpL3Nwb3NvYnktcG9wb2xuZW5peWEtcGxhc3Rpa292b2ota2FydHktYWxmYS1iYW5rYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357763),
('10iLmEwzSxuuRJR7zs2fDFck5sw2VUQSl09NJb9N', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibE16Rm9kTFQzVjh6V2J0Wk9BQ2dHRkNLbmI1UWdrbmdGM2Fobmk2MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHBzOi8vYnRmLnN1L3pkb3JvdmUvb3Bhc25hLWxpLWtpc3RhLXNoaGl0b3ZpZG5vai16aGVsZXp5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357840),
('13GtwnKEBERQDZyfjLeHfdNgNLQMT5NczgNKrILZ', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlJwZVVabmVGNHJodGk5NlpoQklTd29ESmladVpZcFBobW1qVFdkdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODM6Imh0dHBzOi8vYnRmLnN1L3V4b2QtemEtdm9sb3NhbWkva2VyYXRpbm92b2UtdnlwcnlhbWxlbmllLXZvbG9zLWNvY29jaG9jby1rb2tvLWNob2tvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357799),
('1MX7li3nTsfstCkCi9J9VUVOBH3y54pXd7F9CPqy', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUNsUndWS0ZOME9GTWtxbWcyejA2N3ZYenJZMVBSZ29QMzZhUVBycCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTg6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL3Z5YXphbmF5YS1tb2RhLTIwMTctMjAxOC10cmVuZHkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363547),
('1SkAfoCUmfanAYP82AL1geG4x7JFNfZdacNdYQxx', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1dEaVRQZ2psajlqTHJNd2FiODU1QTd3aTRZV01aeThJV09zQzJhaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzQ6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL2ZsaXMtY2h0by16YS10a2FuLXNvc3Rhdi1zdm9qc3R2YS1pLWRvc3RvaW5zdHZhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363677),
('1tOrNcF1RvVDao1BtjxtdPVRedGIjBgnZXzek3PS', NULL, '66.249.68.7', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.6834.83 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1F5OFJCVFh2d3JJQkZES1dwWFpPWktEV3hUNXlDRm1EeTMyOWx3aCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTc6Imh0dHA6Ly93d3cuYnRmLnN1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737366447),
('1vdOFQHcHS8Lxf9T6s0LthZYk9WlB8wLHiTNLArD', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHdBUTJPSXFIaU5jSHhJTVVIQnF2Wm5Ib3l5OTRLOU9qQjBmZ283aSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vYnRmLnN1L3pkb3JvdmUvbWVkLW90LWZ1cnVua3Vsb3YiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363646),
('2ah57oPgR4GE4kPXgVAOmCWyiiE3BpZNzdEfBirA', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1NIQWhOQ2puUmdFUVFXMFA5dlk3OXlNSjFwWkhRcENPMm9aTUcydCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODc6Imh0dHBzOi8vYnRmLnN1L21vai1yZWJlbm9rL29ydG9wZWRpY2hlc2tpZS1zdGVsa2ktb3QtcGxvc2tvc3RvcGl5YS1kbHlhLWtvcnJla2NpaS1zdG9weSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357801),
('2CLYobAef4b3nWkRXRsGA0KGAeVUbuWjuZbDBeHP', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWWt2VkZ1ZktiWGF0cVIwZmQxN3ZTNnIxU2JIMG1qZUx3aEFrckZ2TyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODE6Imh0dHBzOi8vYnRmLnN1L2xhbmRzaGFmdG55ai1kaXpham4vdWRvYnJlbml5YS1kbHlhLWdpZHJvcG9uaWtpLWdpZHJvcG9ubnl4LXNpc3RlbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363573),
('2dq81mAmZxWTE8CWv8MPJM5qOugJfYMszyqda7HS', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFZjbGk1a0hTV0l1bHp5MFRyeTA3QlpwSHcxSGUweUJNVmVINFFZRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTMxOiJodHRwczovL2J0Zi5zdS9kaXpham4taW50ZXJlcmEvMzktc292cmVtZW5ueXgtaWRlai1kaXpham5hLXJhem55eC1rb21uYXQtdi1rdmFydGlyZS1ub3ZpbmtpLWZvdG8taS10ZW5kZW5jaWktZm90by1kaXpham5vdi1pbnRlcmVyYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363681),
('2KLvKH62uRxZJshfEuVr7KmCsCPDWe2pHngWG8zP', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0hGandGVEZyOUpCV0hkM1dYV0R2OU93MGtONTBrSERkNWxKd1dQaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHBzOi8vYnRmLnN1L2xla2Fyc3R2ZW5ueWUtcmFzdGVuaXlhL2NoaXN0b3RlbC1vdC1yYWthIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363710),
('3zf3rEjf4vg5e4rTzQqb1IiUNLks8xuJcmSawbQc', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFpaYXhHVllXWWYxQk5XaVB6MEdJOGptak9JNVpxMjM0N1ZyazJYYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTEyOiJodHRwczovL2J0Zi5zdS9jdmV0eS1pLWtvbW5hdG55ZS1yYXN0ZW5peWEvdnlyYXNoaGl2YW5pZS1pbnpoaXJhLXYtZG9tYXNobml4LXVzbG92aXlheC1zb3J0YS1yYXptbm96aGVuaWUtaS11eG9kIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357795),
('46Qi51RGiVVfD7WO1uInWde7vspuJNAgzo0tM420', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibTdvT1A2d2FCdk4wYjVHYU1ydjYxVnM2UWU3c2lUWWZlSEJMdll0TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTY6Imh0dHBzOi8vYnRmLnN1L2tyYXNvdGEvbWFza2ktZGx5YS1jaHV2c3R2aXRlbG5vai1rb3poaS1saWNhLTUtc2hhZ292LWstemRvcm92b2otaS1rcmFzaXZvai1rb3poZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363643),
('4Bawyzw6YxfcXvIFtvyTDJOmbvpdl0tzLdZkZXPy', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYjdvM3pWNDVaazBZNEpjaHlyTXNmaHVLQUJTS0pJdHJlQnJ5azBpVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC95YWJsb255YS1sb2JvLW9waXNhbmllLXNvcnRhLWktb3R6eXZ5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357730),
('4gfDjtZAEt3Htg9K1fiYSPmIjAXHS0BDHFHm3cy5', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlVtNGlqSWIyaFpqamd0cFpLR0FoMDBBanFEbDdlclVCbHkwZ0V6RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzM6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL21vZG55ZS1tdXpoc2tpZS1jaGFzeS1vc2VuLXppbWEtMjAxNy0yMDE4LWZvdG8iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363634),
('4HhkJ4lRF45ribxaT3bxV7wNmqNfFkJnDS0tjl1V', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibnpMdVdwd1gzVzZoTnhRY2RsV0cyRUtnRDY0ZGpPZkw0c0xqMUJoZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHBzOi8vYnRmLnN1L290bm9zaGVuaXlhLzctb3JpZ2luYWxueXgtaWRlai1kbHlhLWRldmljaG5pa2EtcGVyZWQtc3ZhZGJvaiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357897),
('4lJvizYsMgAeuKTbLdg90RIXcLuQpzmAQvvrDRHu', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblZkQ3VhMHpLaE9McDdJNDJ1VDR5VVBTbFZ2MXU2NWxRV0gyMjJrSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTExOiJodHRwczovL2J0Zi5zdS9zYWQtaS1vZ29yb2Qvb2d1cmN5LTI5LWx1Y2hzaGl4LXNvcnRvdi1kbHlhLW90a3J5dG9nby1ncnVudGEtc2Ftb29weWx5YWVteWUtaS12eXNva291cm96aGFqbnllLTIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357846),
('4SKL751z3hliDQSjxYAu6qMf52DNcGBY6zOrzPQP', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXdMR0FrUFBMZHhzVlVkQWxxSUdZR1daUExCMFlJUGdURklmWFdURSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTI0OiJodHRwczovL2J0Zi5zdS9zb3ZldHktYXZ0b2x5dWJpdGVseWFtL3NodHJhZi16YS1uZWNoaXRhZW15ZS1ub21lcmEtdi0yMDE4LWdvZHUtb3R2ZXRzdHZlbm5vc3QtemEtZXpkdS1pLW1vZ3V0LWxpLWxpc2hpdC1wcmF2Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363644),
('57SfJg3GgkSN01zCuGMIoZLyPhiL0AyNi0O9odCs', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWQxSlUyUGEzVDYxb1JhZEQzRHFCZHhJanU0V0NDcFQ3VXRreHhvaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODU6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL3BsYXR5YS1kbHlhLWRldm9jaGVrLW5hLTItMy1nb2RhLTQxLWZvdG8ta3Jhc2l2eWUtaS1tb2RueWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363566),
('5Ak5y9rGbhgUGnwIlQhnLW70713mQknXK4DpIxLt', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDlQekVtZUNKNjZxbklIbUY5VG45dVQ0ckRqbWZXY1Q4WElCV2JUViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODk6Imh0dHBzOi8vYnRmLnN1L3V4b2QtemEtdm9sb3NhbWkva2FraWUtdml0YW1pbnktbHVjaHNoZS12c2Vnby12bGl5YXl1dC1uYS1zb3N0b3lhbmllLXZvbG9zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363699),
('5KCvLaoo3VnT0uiSSysMjeSwBKeVNEaIvtJD1mR6', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEc1dzB3MlpYZmpQQjhsSVNPbkk2MzMxNkxGSUVXaVNGS2VVS3VYMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTcyOiJodHRwczovL2J0Zi5zdS9kaXpham4taW50ZXJlcmEvemhlbHRheWEtc3BhbG55YS02NS1mb3RvLXNwYWxueWEtdi16aGVsdHl4LXRvbmF4LXpoZWx0eWotY3ZldC12LWludGVyZXJlLXV6a29qLXRlbW5vLXpoZWx0b2otaS1vcmFuemhldm9qLXNwYWxuaS1kaXpham4temhlbHRvLXplbGVub2otc3BhbG5pIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363664),
('5TmLilAOOkNgBfiQUod92sDohph8q8xRrliwv0Pq', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY3I5SUIwVlFvZkQ0QVBVMHpWU3FuemxRZXd0bzhMTThVdTdudWxRdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHBzOi8vYnRmLnN1L2N2ZXR5LWkta29tbmF0bnllLXJhc3Rlbml5YS9kaXppZ290ZWthLXV4b2Qtdi1kb21hc2huaXgtdXNsb3ZpeWF4LXJhem1ub3poZW5pZS1wb2xpdiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357686),
('5yxOklEtFpBh9vJtu5PZzNwJdNICWSriTZ1GUmgB', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSm1aNXhjRmhwYzlyOGY4UER2d2xUSFJuN25mSDVqRWYzb2xJdFBzMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODM6Imh0dHBzOi8vYnRmLnN1L3NvdmV0eS1hdnRvbHl1Yml0ZWx5YW0vbmVvZmljaWFsbnllLW1ldGtpLW5hLXByYXZheC1jaHRvLW9uaS16bmFjaGF0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357727),
('6GNTv9YzJZwsA3hErvUHdU3n77GlBEk6oMnhAk4d', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUpZN3k5NmRJVTVwbHRWdHh1QW1aa092blh4SmdqTnMwUXFPUjlDTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njg6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9zb3J0YS1wZXJzaWthLWluemhpcm5vZ28taS12eXJhc2hoaXZhbmllIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357866),
('6xVbUcwoWj24PTKjM2Y3fUdJRovSNswEcRHVJWTl', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3g1NTVnOWYxR3diWE1HZFdGRmxKMFpmajRrNnR5TDkxNk80NUR5eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTU2OiJodHRwczovL2J0Zi5zdS92YXNoLXl1cmlzdC9sZ290eS1wcmF2YS1pLXByaXZpbGVnaWktbW5vZ29kZXRueXgtc2VtZWotdi0yMDE4LWdvZHUtcG9tb3NoaC1pLXBvZGRlcnpoa2Etc2VtZWotY2h0by1wb2xvemhlbm8taS1rYWstcG9sdWNoaXQtZG9rdW1lbnR5LW5vdm9zdGkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363653),
('71VNUxttQWy1NRHzHGGN44FmVA7BFKsrpqjSTzyB', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3V3aWRWMFcxeFRwVURsVXY3U3FvZzFDZ0Ruek5HUXd5SmYxTG5XciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTMxOiJodHRwczovL2J0Zi5zdS92YXNoLXl1cmlzdC9tZXpoZXZhbmllLXplbWVsbm9nby11Y2hhc3RrYS1iZXNwbGF0bm8tbm92eWotemFrb24tMjAxNi1nb2RhLWRseWEtY2hlZ28tZXRvLW51emhuby15dXJpZGljaGVza2llLXNvdmV0eSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357785),
('7H3xENko4DQlYbrbEYBJEJUx1taYjkQTxyKL14TY', NULL, '128.199.251.40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlpCSGRIS21WUUFNWWtpOFdrakh3VldGUEtJc0hHamk3am5DS0liZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9idGYuc3Uvc2l0by93cC1pbmNsdWRlcy93bHdtYW5pZmVzdC54bWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737366653),
('7MM0wuTIeF082ky5vcyF2UTqjOvJXZFjsWJnR4r6', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMURpT0w5dWM2dmRzMWEzUDlmb0theHBQdlBmU0UyZlZCMU5zOUt2QSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODM6Imh0dHBzOi8vYnRmLnN1L21lYmVsL2thay1pc3ByYXZpdC1za3JpcC1kaXZhbmEtbmVvYnhvZGlteWUtaW5zdHJ1bWVudHktZGx5YS1yZW1vbnRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363632),
('7oO7kSRSENM9wAvSNe6Yw0xAOOQeSAGXoTfoXCoF', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidDhuRU9TRHRaRmxjOU5TcDh0elUzaTlPVE5MZ21ZQ3BtSFFtbVM5SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHBzOi8vYnRmLnN1L2JhbnlhLWktc2F1bmEvb2JzaGhlc3R2ZW5uYXlhLWJhbnlhLXByb2VrdC1pLXByYXZpbGEtcG9sem92YW5peWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363587),
('85tH4AMXyixBSMuT7BN0nNW2zyJ9FRe1tETVnFSt', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY05QcWxRaVZLMlZCbkF2Mm1LQ3JNNDF3VW11TE42ZXdBZmNLenpSbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTM6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL3BsYXR5YS10cmlrb3RhemhueWUtYm9sc2hpeC1yYXptZXJvdi02NC1mb3RvLWRseWEtcG9sbnl4LXpoZW5zaGhpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363636),
('99GbSuD3FgPKkGVIIEBuvKY2JM4iscK83KdXMgMX', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibFlDV3BMYkNHTUFtUE16RllPMkJqOTIwakJxRFJUU3RRbjQ5c3U3ZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTg6Imh0dHBzOi8vYnRmLnN1L25ldHJhZGljaW9ubmF5YS1tZWRpY2luYS9zbGFiaXRlbG55ai1zYm9yLXRyYXYtZGx5YS1vY2hpc2hoZW5peWEta2lzaGVjaG5pa2Etb3R6eXZ5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363597),
('9AX9fYcpVfS5wtEzoupPzevOYiGvfi56kwtcoyng', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUE4QzE5cG10R0NQUUtuU1VzSm1SRThrN3lJaTJlZVRaV25OSTJwZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTE6Imh0dHBzOi8vYnRmLnN1L2N2ZXR5LWkta29tbmF0bnllLXJhc3Rlbml5YS9lbmNpa2xvcGVkaXlhLWtvbW5hdG55eC1yYXN0ZW5pai1zLWZvdG9ncmFmaXlhbWkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357807),
('9ypIBj5skgVHqlXjIEP8OEtqHN2AUcLRwA3eyr8D', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOU5seEhUMUJlZ3lkS2dRdGFRZFVFTUdabnNiWjhHV2ZkRVZkWHdrSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjQ6Imh0dHBzOi8vYnRmLnN1L3V4b2QtemEtdm9sb3NhbWkvbWFza2EtZGx5YS12b2xvcy1pei1tZWRhLWkteWFqY2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357749),
('A1FOYzrmOG3UKaNDHthDwnED9YBDe25AGXJXQ09g', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTB4ZzJ3UGNRd2Zzd3VaNVJjekpTYUFuMWoxREpsNFJpclJyQ1ZoRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODg6Imh0dHBzOi8vYnRmLnN1L2F2dG9yZW1vbnQtaS10eXVuaW5nL2NodG8tdGFrb2UtZXRvdC10dXJib2tvbXBhdW5kLXBvbW9zaGgtYXZ0b2x5dWJpdGVseXUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363666),
('aFDryr78qB7JW230FgTS9pWFJprwjxJ3eaHBEZmP', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXhhODBpRlRmN2tpTXRmZVFvVXBjQ0Z4alVCSWJnT2hKZVR1VGpPQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTIwOiJodHRwczovL2J0Zi5zdS9jdmV0eS1pLWtvbW5hdG55ZS1yYXN0ZW5peWEveWFudGFybmF5YS1raXNsb3RhLXByaW1lbmVuaWUtZGx5YS1yYXN0ZW5pai1zLWNlbHl1LXV2ZWxpY2hlbml5YS11cm96aGFqbm9zdGkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357912),
('aFwoD386PCWeIQw4CyTI3dadY7LHuSjrHMspaLxT', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieG1PUUtPaDRuRGN2Ulg1a3pndmcyaWdSTGZSYlVDa2syQVBSUklmaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTQ1OiJodHRwczovL2J0Zi5zdS92c2Utb2JvLXZzZW0va2FrYXlhLWluZGVrc2FjaXlhLXZvZW5ueXgtc29jaWFsbnl4LWktc3RyYXhvdnl4LXBlbnNpai1idWRldC12LXJvc3NpaS1zLTEtZmV2cmFseWEtMjAxNy1nb2RhLXNhbXllLXBvc2xlZG5pZS1ub3Zvc3RpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363675),
('auXzDuBvaAqAzpgpE1noLzdkmZrIL9lZyqt8i3Pq', NULL, '40.77.167.11', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHphWjlablpFSk1qMFFqaklWVFNBMU1MVTdLZUgyUHJQMm91M2paUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTg6Imh0dHA6Ly9idGYuc3UvYm9sZXpuaS1pLWxlY2hlbmllL3ZlbnktY2hlbG92ZWthLWFuYXRvbWl5YS12ZW4tc3Ryb2VuaWUtZnVua2NpaS1rYXJ0aW5raS1uYS1ldXJvbGFiIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363281),
('AvGRfBU28A3OemfQqEW6KYdgEBBgRIADS0QMkMfr', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2tqWENuS2tyVHZuYXNVM1MwQkpEN3RKRUxMd0NUY0l4c0ZiUkllVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTI5OiJodHRwczovL2J0Zi5zdS9zb3ZldHktYXZ0b2x5dWJpdGVseWFtL3MtbmFjaGFsYS1nb2RhLW1vc2hlbm5pa2ktdm9zZW0tcmF6LXB5dGFsaXMtb2JtYW51dC1iaXpuZXNtZW5vdi1ydC1vdC1saWNhLXJvc3BvdHJlYm5hZHpvcmEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363583),
('baujpI0fFv8sttElct5dMvW9gId8QCBboAHWd9XB', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazZWSDZuS1B4c2owWXNJT1U5WndaN3BlTW5YWnl5OFpUbnQydTR2aSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA0OiJodHRwczovL2J0Zi5zdS9jdmV0eS1pLWtvbW5hdG55ZS1yYXN0ZW5peWEvemhlbHRleXV0LWxpc3R5YS11LWZpa3VzYS1jaHRvLWRlbGF0LWkta2FrLW9wcmVkZWxpdC1wcmljaGludSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357708),
('be2knmtHKesXqJSZvikoXo7cezuRdSo6t27loVAV', NULL, '40.77.167.72', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjZ6Z1h0UlBkbWl1RWNGRmhVT1pOMjFLYUMzc05pMnhLczRQa1dtYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9idGYuc3UvYml6bmVzLWktcHJvaXp2b2RzdHZvL3Jhc3Nyb2Noa2EtZXRvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363731),
('bINJ63NCoSNEdpRyFEXsBVI2ru3vDJMEkaiiyGJi', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicE9ZenNOWjhsbm9LWDdLc1FsZGxCZThYSjFPcDhjTlpRblN6ZWdmWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODY6Imh0dHBzOi8vYnRmLnN1L3V4b2QtemEtdm9sb3NhbWkvcHJpY2hlc2tpLWRseWEtZ3J5YXpueXgtdm9sb3MtOC12YXJpYW50b3YtdWtsYWRraS1mb3RvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357696),
('BlNRP5RYCrWlxXVSq5cIajN9Kq121vTMwvwQVuDm', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY01MRVU3OG9NVTlQUTJGRFNRTkI0c0ZaYmIwTzh5Ujh0R1VvSkNlRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA5OiJodHRwczovL2J0Zi5zdS92YXNoLXl1cmlzdC9rYWstcHJhdmlsbm8tbmFwaXNhdC16YXZlc2hoYW5pZS1vdC1ydWtpLWJlei1ub3Rhcml1c2EtaS1idWRldC1saS1vbm8tZGVqc3R2aXRlbG5vIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357933),
('BsXXep11pqigcYDq6jLoT9BQHQDMLeIsWxg4eDL2', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2NrV0VMMFlYRVloVDVkanEzeFROekI3TUZHanVXNGx2Q1ZKS0Z6ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHBzOi8vYnRmLnN1L3Zhc2gteXVyaXN0L2thay12eXBpc2F0LWl6LWt2YXJ0aXJ5LWJ5dnNoZWdvLW11emhhLWlsaS16aGVudSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363522),
('BtjMScjv693BKZwrXr009U0QCCWs6rPMLqZ53EHm', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUdpTTBEcVo1YlJSVk1kRWlDWmhoTTdpRFR6RzB5WUhGRTRLdjg3ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTQ6Imh0dHBzOi8vYnRmLnN1L2F2dG9yZW1vbnQtaS10eXVuaW5nL2thay1zYW1vc3RveWF0ZWxuby1wb21lbnlhdC1wcnV6aGlueS1uYS1zdG9qa2UtYXZ0b21vYmlseWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363716),
('bu3tb7mLkjsdhJJuc4V8yMnSfIJtCpngPqe7xkBR', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVW5JeVFrMUlnOFlMMW9NV0ZzSGV3Vm9XUDhlejdNWTdGcFlWOXlPOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTEzOiJodHRwczovL2J0Zi5zdS92c2Utb2JvLXZzZW0va2FrLW5lLW5hYnJhdC12ZXMtcG9zbGUtZGlldHktMTAtcHJvc3R5eC1zb3ZldG92LWthay1uYWRvbGdvLXpha3JlcGl0LXJlenVsdGF0eS1kaWV0eSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357853),
('BxcS0zi82bTJu0KrzWobW6ZSFlkQxdoI3pMpBzBU', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWJpUTJKN001Q3oySzhMT0pFbEVFWTBaVU5oVTFqYmgyVXdtQnV3SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODQ6Imh0dHBzOi8vYnRmLnN1L2F2dG9yZW1vbnQtaS10eXVuaW5nL2tsYXNzeS1hdnRvbW9iaWxlai1hLWItYy1kLWUtdGFibGljYS1zLXByaW1lcmFtaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357744),
('byialxK0eEhZTbnWAqQqReTpfYJGEPGlIUDk8hkG', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOG5KdGhJQnhiWFFWY2E3QUF1VEN2QzMzcUxJb2VZWWt2a1c2cG14byI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODg6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9rYWstY2hhc3RvLXBvbGl2YXQtcG9taWRvcnktaS1rYWstcHJhdmlsbm8temEtbmltaS11eGF6aGl2YXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363721),
('bYYVNSI2zbmIGrOv0bXSZyttYdhEA8Facit5q0ap', NULL, '185.157.97.241', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWh6T2tEVWVFdHRFblBMNXBEYWw1bVRiSWFySk9ZbmszNkpOc09EYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTM6Imh0dHA6Ly9idGYuc3UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737353517),
('C5ZBUtLhHZGRowkAkaj1CZUy1BK5vjymy8HaDvmH', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzB0ejBqWXdUS2hWYW4wbmZ5NXZESkVwaUgyQnhwVkl4MWtTSkI0ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTA6Imh0dHBzOi8vYnRmLnN1L3Zhc2gteXVyaXN0L3V2b2xuZW5pZS1yYWJvdG5pa2Etdi1zdnlhemktc28tc21lcnR5dS1wb3NoYWdvdmF5YS1pbnN0cnVrY2l5YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363617),
('C8jLLCFZAfQ47wwHj9Og8mC4mfRUfMhT35K18KUx', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTGJGNklxWU9CR0xlVDhnRW85WTdBYkIyM2pJNnVkUkhEWUFrZWYwMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHBzOi8vYnRmLnN1L2t1bGluYXIvcHAta29uZmV0eS04LXJhem55eC12a3Vzbnl4LWktcG9sZXpueXgtcmVjZXB0b3YiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363609),
('CCpYy8c6sQQN0Eu2QyIycQWIyGcJfGB78xDPLgi3', NULL, '66.249.68.4', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEhrcktvbm9iUUdEbEZTNW5KSWZjR0JRbW1RakR2Qlh4UnY0QnlhMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzc6Imh0dHA6Ly9idGYuc3UvZGl6YWpuLWludGVyZXJhL2N2ZXQta3V4bmktaWRlYWxub2Utc29jaGV0YW5pZS04NS1mb3RvLTEwMC1pZGVqIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737353870),
('CDWSGtT75PjeliDXFCxziNh5f5WwiAMVvzLDZfjB', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGswWFJxWlJKTkRwUXEyck1kVUY3Nk9YTVh6dFM4aTJNWlZxMkltSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE3OiJodHRwczovL2J0Zi5zdS9ib2xlem5pLWktbGVjaGVuaWUvc2luZHJvbS1tb3JnYW5pLWFkYW1zYS1zdG9rc2EtbWFzLXNpbXB0b215LW5lb3Rsb3pobmF5YS1wb21vc2hoLWktbGVjaGVuaWUtcHJpc3R1cGEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357816),
('CgbaPoy6UStpawaDybytSwZmWbVQsCXE95aIjakQ', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXFkYWlMdzU1VlAzeHdNbml3R3JpaTBQbEdjcGJaWERIOUh6QzB6cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTE6Imh0dHBzOi8vYnRmLnN1L3Zhc2gteXVyaXN0L3Nhbml0YXJueWUtbm9ybXktZGx5YS16aGlseXgtZG9tb3Ytb3R2ZXRzdHZlbm5vc3QtemEtbmFydXNoZW5peWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363726),
('CHoO2ZMIyAZq6jVma4siex4DJdcxvowDuKtqKLCA', NULL, '136.243.228.180', 'Mozilla/5.0 (compatible; DataForSeoBot/1.0; +https://dataforseo.com/dataforseo-bot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYm5OUzlCaTQ3STB6ZHFWQTZXbnBOYjBKdmwxSWVJYThoY25rdXhqZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly93d3cuYnRmLnN1L3NpdGVtYXAueG1sIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737359254),
('CJnKTDP5UuodSoeuXgYbtRQviJ3XfqS0SmS8bR28', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVVYUzhyMkFFNzlHbUkzRWNmdGVGM2VSeUdhSDQ4Y0RJN2lVWUxaWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODU6Imh0dHBzOi8vYnRmLnN1L3NvdmV0eS1hdnRvbHl1Yml0ZWx5YW0vc2Ftb3N0b3lhdGVsbmF5YS11c3Rhbm92a2EtZmFya29wYS1uYS1hdnRvbW9iaWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357797),
('cLCQbZ6wxgSp8FpdlXgqv8NDQB9VhMM8zvTtzVqu', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUks2OGRJb29qbnl5SzVlZ0dldjVHcnh6czVLR0g3aW04SUFDQWtCZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzE6Imh0dHBzOi8vYnRmLnN1L3pkb3JvdmF5YS16aGl6bi92cmVkbm8tbGktZXN0LW5hLW5vY2gtcGl0YW5pZS1wZXJlZC1zbm9tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357741),
('CWi4LMkEgTWjpDfFYhy4qjlPCjQKsSCw0gGDJAlE', NULL, '66.249.68.8', 'Googlebot-Image/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFdtVU9GVWZGVTRQWmpNWURFa0RsdEs0N3lweTBUQlRvb2NONGg2UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly93d3cuYnRmLnN1L2Zhdmljb24uaWNvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737366508),
('dcJ3meFZIB2op2Ho4Uor9ZfDp7X4nQCKY1BkTEAJ', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVZYT0czYlYyUnlMeGFkS2lRTGVYQ2ZlQmMxU0pXUTJTVjlocEo2QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHBzOi8vYnRmLnN1L21lYmVsL21lYmVsLWl6LWthcnRvbmEtMjItZm90by1kb20tbWVjaHR5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357916),
('DdHvuzngqLZ9FDWgjLX3KRs1bilfaNReskez1JHX', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZklyYkR6cGpUb3dvSVR4NmZaR1NuZmR6cHAwRTdNTHVyR3ZSbnB1bSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODY6Imh0dHBzOi8vYnRmLnN1L2JvbGV6bmktaS1sZWNoZW5pZS9uZW90bG96aG5heWEtcG9tb3NoaC1wcmkta2FyZGlvZ2Vubm9tLXNob2tlLWFsZ29yaXRtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357836),
('DFVLS0eroAPXcVzEvsUPJeYcJz5gDUeVLJ7Ovznc', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiODJXb1VDVXBBMWhPWU1PSThwTWpDVHlvS3I3dkdleFlBSW4wdlJsViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE1OiJodHRwczovL2J0Zi5zdS9rYWstdnNlLXVzdHJvZW5vL25lLXJhYm90YWV0LWRhdGNoaWstdXJvdm55YS10b3BsaXZhLXBvY2hlbXUtcGVyZXN0YWwtcHJhdmlsbm8tcG9rYXp5dmF0LWRpYWdub3N0aWthIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357776),
('dkbes3N3Z5jtEOdrXP9yGGOeujOIDn3eB2R7EWz0', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib0hpMVRTWDhuZDZQMDlMaUg1UElzM3lUcVpDUVhzUU9jWnpNME10NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL211emhza2llLWJyeXVraS1kemhvZ2dlcnkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357869),
('dWXePAyoT6BOD17a0ksMDx3Tkdj8jlymFlCKGAdW', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTEl6RFBYc2hYc1FpclUxc29JUjhqdmdoUmNGQU5DdXZSYWFndjE0MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODQ6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC92eXJhc2hoaXZhbmllLW1vcmtvdmktdi1vdGtyeXRvbS1ncnVudGUtb3Nub3ZueWUtZXRhcHktMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363742),
('EbJS0Zy9MLfv2Qxo4gK3ub6qXF5XUEMtJdXX3Uie', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib0pXWGdmM1JITktOZjY4cG1ZSVYxUzVYbUs2am14OGxhYkxQajR1TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA0OiJodHRwczovL2J0Zi5zdS9zb3ZldHktYXZ0b2x5dWJpdGVseWFtL3Nyb2stZGF2bm9zdGktcG8tc2h0cmFmYW0tZ2liZGQtaS1jaHRvLWJ1ZGV0LWVzbGktbmUtcGxhdGl0LXNodHJhZiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357908),
('eCRoSZuQvNztPAoD2BGAeDXLhTNofJHxIg4Hi9Bp', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWwzTVBKMWs4Q2NQb2RQc3pUWW4zSHBUakF3eWtURFBlelZvcGZ2ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjI6Imh0dHBzOi8vYnRmLnN1L2F2dG8vdGVzdC1kcmFqdi1yZW5hdWx0LWxvZ2FuLW5vdm9nby1wb2tvbGVuaXlhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363648),
('EfsqYqutT8MlzrnF7BUNruFXbSkoJ2Ey9XHtTiGN', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVBsODdHNTM4NUhaVFNrN0o0TEZjeUk5NURHNVJhejdzbWFxRUh4eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAwOiJodHRwczovL2J0Zi5zdS9ib2xlem5pLWktbGVjaGVuaWUvbmVkb3N0YXRvY2hub3N0LWFvcnRhbG5vZ28ta2xhcGFuYS0xLWktMi1zdGVwZW5pLXNpbXB0b215LWxlY2hlbmllIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357885),
('eGcgcOZU4nRTpJKctmaqpvX1nrfeJ8UCVWRaQvDN', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia3Y3dUFsd1dwTWRtNkFQdzhoWVV1cnV0cDlnWFdLQVFMNUZGcFE5eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODI6Imh0dHBzOi8vYnRmLnN1L3V4b2QtemEtbGljb20taS1tYWtpeWF6aC9wb2R0eWF6aGthLWxiYS1pLWJyb3Zlai03LW1ldG9kb3YtbGlmdGluZ2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363640),
('eH0t5l2COlQS1OBuc7YChslXNnUQooP7r5MN2KzH', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXN6c2ZUMDNpdHUzY2JhaW5BSjR5TWlkU3BReVRZd2N0bjE5a2JuciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODQ6Imh0dHBzOi8vYnRmLnN1L2JvbGV6bmktaS1sZWNoZW5pZS9wdW5rY2l5YS1wZXJpa2FyZGEtcG9rYXphbml5YS10ZXhuaWthLW9zbG96aG5lbml5YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363511),
('ekiFZpNmYFeX6hAsbkQG13vuRwQbaIL8BXWv5Rt3', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3F3WGR4TEdlSThsSHJ2NkFUbnlNNk9UVWM0REk3bXRxNVZYYWZGSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODc6Imh0dHBzOi8vYnRmLnN1L2F2dG95dXJpc3QvcGVyZXNlY2hlbmllLWdyYW5pY3ktcy1rYXpheHN0YW5vbS1uYS1hdnRvbW9iaWxlLWF2dG9icm9keWFnYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363612),
('Fhcl1plTQLl0WVIDEwk5whmbzlxzH8XXNib3okiT', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUE1NVEg1OGpZOXp6U2lTMGlFOTVJUkRuWGlhOFlJQ25MTDV1c3FPNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHBzOi8vYnRmLnN1L2JvbGV6bmktaS1sZWNoZW5pZS9jaHRvLXRha29lLWRla3N0cm9rYXJkaXlhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363729),
('fPJio5mYS9VXZTQqb0cvhuqLDerOdqXwQVbr8kfJ', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGJQVVloUmxXdjZMTjRPVHFvdkc3enJpNVpMcVNXTE9SeFlTUmhucCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHBzOi8vYnRmLnN1L2F2dG8vcHJvc3Rvai1pLWtvbXBha3RueWota3Jvc3NvdmVyLW1pdHN1YmlzaGktYXN4LTIwMTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357694),
('FrmqwHvJRScCX7b2Q4EDZz6lrRE3fO1y3L561yCf', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMURjNFlhODNScURjOU13YkhOaHFoREFTMkduVlZpcmpMYnFIc0UzRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzE6Imh0dHBzOi8vYnRmLnN1L3ZzZS1vYm8tdnNlbS9wZW5zaW9ubnlqLXZvenJhc3Qtdi1zaHZlamNhcmlpLXYtMjAxNy1nb2R1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357670),
('fsY28pWiTIOh6kwoYPSwBfw2OVTjxFPTeqBgtDLj', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieEtpdGtvVkl1MHc1cjFub3lZVndwN3pNbnhIbWtPU05NZkxMZzU0SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE3OiJodHRwczovL2J0Zi5zdS91eG9kLXphLWxpY29tLWktbWFraXlhemgvcGlnbWVudGFjaXlhLW5hLWxpY2UtcHJpY2hpbnktaS1sZWNoZW5pZS1rYWstaXpiYXZpdHN5YS12LWRvbWFzaG5peC11c2xvdml5YXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363680),
('Fw7Ez2e10oaxYQ7S4pmtUcc4VKiQbe5eLvmcosTR', NULL, '109.120.138.3', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMnZKcUZDbnBMekwxU1UwQzNybjNGZjBZQTdpMklTaW9BbEZ6RjhHNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vYnRmLnN1L2Zhdmljb24uaWNvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737370629),
('FWsDO6tEvHOTxhoN9OlaOjgA9icEqNtmh90rr4vM', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmo5NzZrOG4yWmhLWWpqa3hjV2hrNHA2UmloSHh5N0VoUDhENk1HbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODc6Imh0dHBzOi8vYnRmLnN1L3NvdmV0eS1hdnRvbHl1Yml0ZWx5YW0va2FrLW9wcmVkZWxpdC1iaXR5ai1hdnRvbW9iaWwtc2VrcmV0eS1wcmktcG9rdXBrZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363615),
('gcEroJzZLIOv3i6JpOxIrII6G2sJkOxwLoRtpfv5', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibDN1Uk4wTjNFMDlzelVtQ2JCbTBhaXhZcjdUVG1FMkdiQjVzMDQzbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTM6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9zYW15ZS12a3VzbnllLXBvbWlkb3J5LXZ5YmlyYWVtLWx1Y2hzaGlqLXNvcnQtZGx5YS1zdm9lZ28tcmVnaW9uYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363696),
('GIL06NNdavLwEYYJJna96hNnB1QAKT0zFEt69lDJ', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0o1bllMdkt0dDJkc200cVNGOTk0UUYzbWw2dEZtdGRSb3dZU3hUbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vYnRmLnN1L21vai1yZWJlbm9rL3Jldm5vc3Qtc3RhcnNoZWdvLXJlYmVua2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357778),
('gJC7FUoQuflWNNBJ5WsnfsURqKgb89GHuhYoVIQr', NULL, '209.38.110.11', 'Mozilla/5.0 (compatible)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV01Ha3Q0RTh4R0VTeHM2dG1YVnNSYUwybkVkeW5zVjI2TjRwTjJXZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTM6Imh0dHA6Ly9idGYuc3UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737359153),
('gMh7yez6wEosc8KgKZcZBCsiMLwrH5zJTpALOerl', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWjdHQ1VYWGlmZ3BNVGJJd2F6a1JRUVJPSlAwNUpyZjFueVJKd09ISiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njg6Imh0dHBzOi8vYnRmLnN1L2JhbmtpL2thay1wZXJldmVzdGktZGVuZ2ktcy1xaXdpLWtvc2hlbGthLW5hLXdlYm1vbmV5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363708),
('GubyMVRWNhVUrMC3LrN0ZNHQcod6MeV24D3r95nn', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkZPZlpwb05YYWdpMFNqZVQydUdZYzlCMklnMk5sekFUeUNhSDRyRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHBzOi8vYnRmLnN1L2t1bGluYXIva2FrLXZrdXNuby1wcmlnb3Rvdml0LXhlLWl6LXJ5YnkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363669),
('GYrU6JOVVEs8PRxUuzsvLSxkShecDbdcAfTGjwub', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYndsZXZsbTBXZ0NpOEI3ZWVkMEtLMEtxcVQydlYwWTNsTHoxR0ZjcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzg6Imh0dHBzOi8vYnRmLnN1L3NvdmV0eS1hdnRvbHl1Yml0ZWx5YW0va2FrLWktbmEtY2h0by16aGFyYS12bGl5YWV0LXYtYXZ0b21vYmlsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357827),
('h0XFt3mOfchU6mF3kI6YmGZIj7aL3WGytKZWpLwP', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmw5cHZnMzY5dkc4WXpKVVFhWm1WMDhFUnhwWE5tMnAyMGhOREdVRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAyOiJodHRwczovL2J0Zi5zdS9zb3ZldHktYXZ0b2x5dWJpdGVseWFtL2tha2F5YS1rb21wcmVzc2l5YS1kb2x6aG5hLWJ5dC12LWJlbnppbm92b20taS1kaXplbG5vbS1kdmlnYXRlbGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357873),
('h6z0nRAfnOGmOraLwBOqMdTCit682FMGttEqlzIu', NULL, '82.165.97.195', 'Mozilla/5.0 (Linux; Android 7.0; SM-G892A Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/60.0.3112.107 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2V4d2tNZHhmeGFZYTZUMVhmdzRlZUlhTUQ2V3VyWU9BRlNSRUREaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9idGYuc3Uvd3AtY29udGVudC90aGVtZXMvaW5jbHVkZS5waHAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737364031),
('hcl5XR6PluDRQ4HfmuQ6SWV98nvsuJnyErLvSUCr', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2FreXVxaUZSVzUya3FSVzJnVlFHWGl0WTZjVUJOMEh2YmJtb3dQciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTA6Imh0dHBzOi8vYnRmLnN1L3NvdmV0eS1hdnRvbHl1Yml0ZWx5YW0vbWFya2lyb3ZrYS1zaGluLWxlZ2tvdnl4LWF2dG9tb2JpbGVqLXMtcmFzc2hpZnJvdmtvaiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363622),
('hePcrXHjERJvcH7C1ETpXqNAWCRf53OiXTT5Kqi4', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVRFcndyTnpoYW12OVF5RFd2ZkxwZml5dTYzVnk2TGM4andRb1A2bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzE6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9rYWstb2JyYWJvdGF0LWtyeXpob3ZuaWstb3QtbXVjaG5pc3Rvai1yb3N5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363526),
('hfSeG39TKCQZhG5UYyYTLQrcEOc5iGpW9bUv1zGW', NULL, '66.249.79.104', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.6834.83 Mobile Safari/537.36 (compatible; GoogleOther)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0pJajhnNXAwejhiYWo4N1BpdlR0Y2dJZ1pYUnJ5V3dZN1FMM2k4SCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly9idGYuc3Uvc2FkLWktb2dvcm9kL3Bvc2Fka2EtbHVrYS1wb3JleWEtbmEtcmFzc2FkdSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737360926),
('Hi0FsEJ1QhqseeIDXUSMWHPh3BJ9TNTfxKK0jDPn', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHRySGhUckNVY0w4TDY4VmZuSDNPV3ExUnVGTlpRZHpPcDlFbjh2ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTQyOiJodHRwczovL2J0Zi5zdS9jdmV0eS1pLWtvbW5hdG55ZS1yYXN0ZW5peWEva2FrLXJhem1ub3poaXQtb3J4aWRlaS12LWRvbWFzaG5peC11c2xvdml5YXgtc3Bvc29ieS1yYXptbm96aGVuaXlhLWkta29tcG9uZW50eS1ncnVudGEtZGx5YS1vcnhpZGVpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363657),
('hYZeD7QexOofvuSYh7Zatf4hvhLHyobMMFq3ggh3', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibEtnSmNjYUk0VkpXVHhNaTBsRVluNFhtSWxudlE3cXlFVEJQcnlvMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAyOiJodHRwczovL2J0Zi5zdS92YXNoLXl1cmlzdC9jZWxldm9lLW5hem5hY2hlbmllLXplbWVsbm9nby11Y2hhc3RrYS1vYnNoaGllLXZvcHJvc3ktaS1uZWtvdG9yeWUtdG9ua29zdGkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363630),
('Im91MEOEXkPB4DbtnkXw8kx8TrKTMnSqZHEnETlN', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQWNlS0FxSlNabG1vbXlPYXFHYzFoSGN3QndVVXpMY0REd3JvYldWWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTc6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9pbnpoaXJueWotcGVyc2lrLWZvdG8taS1vcGlzYW5pZS1zb3J0YS12eXJhc2hoaXZhbmllLXNhemhlbmN5LXZpZGVvLTIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357828),
('IVO2pw2kpvSYEBsvb23LViLx7bA9tAlCMKZpfoP1', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTHFPbkRHZnhGakdhWGd4V2c2UkxiQVF0UkUxY2ZsajNxVGk2dWZURyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vYnRmLnN1L3pkb3JvdmUvcGFuaWNoZXNraWUtYXRha2kiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363580),
('IZDfrLqg0l7dbrPjtLuCHx2WwPHit4FDm2KInmdL', NULL, '40.77.167.72', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHo0cGdMd2lKRlRycFp6UFJjNnkwcTJ3ektHa2dxaTFzMXlWcE5leiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzI6Imh0dHA6Ly9idGYuc3Uvc2FkLWktb2dvcm9kL3Z5Z29ua2EtdHl1bHBhbm92LWdvdG92aW0tc3Vic3RyYXQtaS1sdWtvdmljeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363731),
('iznYkpJUOpubXuRfnerQcgpGwF3jsINExHYRl0Ki', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZVpna0tqd2lzaGJVUThMZ3FjT0FhM3RBQUNoQ3RnR3YwUjJTVmtWRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTg6Imh0dHBzOi8vYnRmLnN1L2F2dG9yZW1vbnQtaS10eXVuaW5nL25lLXJhYm90YWV0LXJlZ3VsaXJvdmthLWZhci12YXotMjExNC1uZS1yZWd1bGlydWV0c3lhLXZvb2JzaGhlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363607),
('J1sPdqINtC7APgn2Id9qr443bkDAHEYQ4na0cuT9', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXpwa3dSTm9FT1o3TGRkS3Q1UkkxUzdpaVpKd1h3Y3Z1blhEREtZciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTQxOiJodHRwczovL2J0Zi5zdS9hdnRvcmVtb250LWktdHl1bmluZy9wcml6bmFraS1wcmljaGlueS1uZWlzcHJhdm5vc3RpLWdlbmVyYXRvcmEtYXZ0b21vYmlseWEta2FrLW5hanRpLW9zbm92bnllLXZvem1vemhueWUtcG9sb21raS1wby1zaW1wdG9tYW0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357810),
('J6VTVNE07a8FZpidiWI6gL3tlslj8LtEdoHvLR6r', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVNUdEJ4YWw3ZnVQZVlJY25HZTlMT0FUUkxXT2tUS2gzZkdYaGlYUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjA6Imh0dHBzOi8vYnRmLnN1L2RvbWFzaG5pZS1waXRvbWN5L2thay1vdHVjaGl0LWtvc2hrdS1rdXNhdHN5YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357832),
('Jj6F9e3wxpmTuoBfXKfuhQUGXanDdkAvimJlWHjf', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEdBejZ3ZWFRZXUyd1JwOFB5MW41ZkFMbHo3YmdIUmdEWElQbHNtViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODU6Imh0dHBzOi8vYnRmLnN1L296aGlkYW5peWEvb3NvYmVubm9zdGktdm9zcGl0YW5peWEtcmViZW5rYS1kb3Noa29sbm9nby12b3pyYXN0YS12LXNlbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357714),
('JJPqlUgeeQZqcQROsP6oLA8k4t8aWqydXOt3uSPY', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1lBS2xKdTJBMzBMczhjYjRZWVVOR0tZajZpWW5lMkNsdmUxUjlDdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODc6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9rYWstYm9yb3RzeWEtcy1tdWNobmlzdG9qLXJvc29qLW5hLXNtb3JvZGluZS1sZWNoZW5pZS12aWRlbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357929),
('KLP0CB6skA7EtUZaEkp441sRgXvimx4CWyGarn4S', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUkxcDJQZHZOYTRTQWJQQzFxZU9Ob0ptOExjb1Q1Wk1RaWtmMzl1YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vYnRmLnN1L21lYmVsL2dvbHVib2otZGl2YW4tdi1pbnRlcmVyZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363689);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kT6iff3ozAv7zOsavjGeWXlHBydcS2VZRr3H4vV6', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0dwdkFsZGYxRncxQjlvemFBbVIwcFpPS3J0M1poSVpMa2dROUc5UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHBzOi8vYnRmLnN1L2Fsa29nb2wvdmluby1hbGF2ZXJkaS1raW5kem1hcmF1bGktaS1lZ28teGFyYWt0ZXJpc3Rpa2kiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363739),
('Kuwzr44YlPZ9orEtVxz4mIM7aP8XyBE978KRmHb2', NULL, '40.77.167.72', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaXBEOFEzekJkZDRHNHVUUWUybjVNV1E4MWhBdm5wa1NnbmxON0l1ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzc6Imh0dHA6Ly9idGYuc3UvbW9qLXJlYmVub2svcGFwYS1kb21hLTUtcG9kdml6aG55eC1pZ3Itcy1yb2RpdGVseWFtaS12LXZ5eG9kbm9qIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363730),
('kWngIq3kQavwu5QCTRtjd9idyAodg2BMjPlWIIF8', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNnBtM0p1MlphNXdaNkl5SDhrY2FKN3A4SU9XNGI5TmFabjYwZlVkbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTM6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9rYWstb2JyZXphdC1wb21pZG9yeS12LW90a3J5dG9tLWdydW50ZS1kbHlhLWx1Y2hzaGVqLXVyb3poYWpub3N0aSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357904),
('kXbQ38by4vxbtnkgFcQ7zMEWew2evOM8cIM8Z7T7', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUhrR1Y5WUlCVnZNZUhKa0pQUlRyVUV0a2FNc1cwUkVGcUhiTUNMRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAxOiJodHRwczovL2J0Zi5zdS91eG9kLXphLWxpY29tLWktbWFraXlhemgvcGVyZXNhZGthLWJyb3Zlai1mb3RvLWRvLWktcG9zbGUtbmFyYXNoaGl2YW5pZS12b2xvcy1uYS1icm92aSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363683),
('KyAIPbchHKMcDUmoTtYfboncBi3rACQvu8DbtG7D', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNE10T2RZQjJlaWFnMFJNMHFLSlZSTEJnN09IMTRIMkltRTVJVkladSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODI6Imh0dHBzOi8vYnRmLnN1L3BlbnNpaS9zbmlscy1rYWstdXpuYXQtc3Zvai1ub21lci1vbmxham4tc292cmVtZW5ueWotcHJlZHByaW5pbWF0ZWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357924),
('l1a7GN4i2H9aNWDGiOLGJCvzFhr4U3JLhr1Yu9qV', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNk5SSERhUURjYloweThlSzlCc3dBaEU5aEl5Q0s1MzZ1R2puU25YMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzU6Imh0dHBzOi8vYnRmLnN1L3pkb3JvdmF5YS16aGl6bi9jaHRvLXhvcm9zaG8tdXRvbHlhZXQtemhhemhkdS1waXQtaWxpLW5lLXBpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363493),
('l1G4WQoSYNRnOTcYIWCItGRsu4Q9PixMsMoFjENF', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRm5uU1BzN1FlRHpEc2RsZ2x1UHhUWmF3T3N3M3BkenFBZkJ5YWpuaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9rb2dkYS1zYXpoYXQteWFibG9uaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357862),
('l2Lkld2MTwpQKjRELsC2Xua1P0K1udr0X0i8Hiez', NULL, '209.38.110.11', 'Mozilla/5.0 (compatible)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMTNiVkFqSkRPZU9qbEloUGNUQU1wSjhhUENVQkVvRXVlZlMycUlkYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9idGYuc3UvZmF2aWNvbi5pY28iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737359153),
('l7J1wFyHUPnWUOOBWOVEjPUip1QAF6xApIY5AmJi', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic2FPSlZiTk5hWkhpNUZCZ1k5MXlLRkpCVEd5QXVxcEdnaGd0QUtxUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHBzOi8vYnRmLnN1L3V4b2QtemEtdm9sb3NhbWkva2FrLXNteWFnY2hpdC12b2xvc3ktbmFyb2RueWUtc3JlZHN0dmEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357772),
('L9y6H7eOprHMSC4aoYcn7Tgxmf0SWwMEEeANP7rO', NULL, '40.77.167.54', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmdFOFRvWEhrT1Via2N6QUlkV3FSY2RCaHFSRUU5cHAzWmVDaU5MUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTM1OiJodHRwOi8vYnRmLnN1L2xla2Fyc3R2ZW5ueWUtcmFzdGVuaXlhL3NoaXBvdm5pay1sZWNoZWJueWUtc3ZvanN0dmEtaS1wcm90aXZvcG9rYXphbml5YS1wcmltZW5lbmllLWN2ZXRvdi12ZXRvay1rb3JuZWotcGxvZG92LXNoaXBvdm5pa2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737355988),
('lD5QOqBOv5z7RwlKBEUZghn6C31EtmTy77FRQjUg', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNzNneVc4eU5OS01pb2Z1blNDb1ZYT3V4T1Z5YzAzRjBzeWJUOU5FaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHBzOi8vYnRmLnN1L2thay12c2UtdXN0cm9lbm8vc3R1ay12LXBlcmVkbmVqLXBvZHZlc2tlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357787),
('lfefgRA1BFmCrB7jsxjzDqUKl4Rykcw5Z7P7jh1L', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmJGbENFNFJSdUJWR3ZEOUJkeDVicmlRUkhhZG9xWEpwcFhScUtEMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODU6Imh0dHBzOi8vYnRmLnN1L3Zhc2gteXVyaXN0L2dyYWRvc3Ryb2l0ZWxueWotcGxhbi16ZW1lbG5vZ28tdWNoYXN0a2EtZ2RlLXBvbHVjaGF0LWdwenUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357854),
('lLUzROKvZtnaLAJl5dr1prtLiSBY6Lnq9Pm8OYMt', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQThnSU1YZUF6c3pxMW5mTzAzWGVmRnNHRmpNbzU2d3BSQXJOMkJTdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODI6Imh0dHBzOi8vYnRmLnN1L290bm9zaGVuaXlhL2thay1vdG9tc3RpdC1zb3NlZHlhbS1zdmVyeHUtemEtc2h1bS1uZS1uYXJ1c2hheWEtemFrb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357760),
('LM6PNJdr2t3sxdVMhdZaftZsYybxmr4iJpEKU2Zr', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTG1JUWhwVnNIblhvOEVybHRkZ3BnQk5pb2J1ZVNFd1BlN0tXQUthciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAyOiJodHRwczovL2J0Zi5zdS9rcmVkaXQtaS1pcG90ZWthL2luc3RydWtjaXlhLWthay1zbnlhdC1vYnJlbWVuZW5pZS1zLWt2YXJ0aXJ5LXBvc2xlLXBvZ2FzaGVuaXlhLWlwb3Rla2kiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363556),
('Lp43t1s488Ff1ET0duwWzdR9JRkwtK27h9iIvqXT', NULL, '198.235.24.133', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDNsZmZ1elhCNzY5TFRXVmE2YTZUdlpSaFB0eDlaWHVYTFhnRWxKWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHBzOi8vd3d3LmJ0Zi5zdSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737362300),
('lqLZAgHR7Sp07MiIUoxUySfSqxhvNxyK3CP5yy6c', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkdtejE2OEtjelphYno2TDZaaUlkR3hjMlBZaWt5VEZkbmZINFhWQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vYnRmLnN1L3pkb3JvdmUvc29kYS1vdC1penpob2dpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357824),
('M59N6E71Ae1anmVlZO62zMnmnPJ482MZSd854oJh', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEZUOWt0VkVFNUtlblBMQVFCRlptNkVLZXBnVkZrZnhLUnV6cjJOVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjE6Imh0dHBzOi8vYnRmLnN1L2Jpem5lcy1pZGVpL3RvcC0xMC1zYW15eC1wcmlieWxueXgtYml6bmVzLWlkZWoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357938),
('MAajPElijGzjaNKEnFmhduO0KVkaJpuzwtvnIKjI', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ1RlWnEwMTdpYmpBQUVlR2NzOUhhRnQxWmRlelJubTV0RTZCN1BvRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjE6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL3MtY2hlbS1ub3NpdC1wYXZsb3Bvc2Fkc2tpai1wbGF0b2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363658),
('mBzS30bACFbdWKWRDeE9Q7IOwJ7wptLkyAIaiTwp', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEFmT2t3RFhzMkcwOGc1SUNBWVlvdnp1QTVZbU5FaGRjUVB1Vm81NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTc6Imh0dHBzOi8vYnRmLnN1L2JvbGV6bmktaS1sZWNoZW5pZS90cmFuc3BvemljaXlhLW1hZ2lzdHJhbG55eC1zb3N1ZG92LXByaWNoaW55LXNpbXB0b215LWktbGVjaGVuaWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357940),
('mF2NLyQkaIjMTY5OGs2csP5iiOCDc3OB9BLVC7k7', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFVQdkY0RFk0Skx3OFdEM3gwcnlFdVZEWUJrVHZtUWpUak5zY2VlcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODg6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC94bG9yb3otdmlub2dyYWRhLWxlY2hlbmllLXpoZWxlem55bS1rdXBvcm9zb20taS1wcm9maWxha3Rpa2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363673),
('ms9ocQTvvhLxi7kz5XqhAsBjkCEudN6eG9xZHW0m', NULL, '82.165.97.195', 'Mozilla/5.0 (Linux; Android 7.0; SM-G892A Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/60.0.3112.107 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickpIMjFreFdDUHZoa3dtTXV5STBQWng1aTRVZGlEVDVIdVJsbXRMdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vYnRmLnN1L3dwLWNvbnRlbnQvdGhlbWVzL2luY2x1ZGUucGhwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737364044),
('MVGGY9GS3sC8xjfAvrULBuvsAlK094kAoNDn5DQb', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTNHNjB2ZGxhR0haaGR6SVMzaTVnNGY1TWVxNTAzVW40UlJ6M2RxbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vYnRmLnN1L2JhbmtpL29iem9yLWxpY2hub2dvLWthYmluZXRhLW1rYi1iYW5rYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357680),
('n0OSGTU1z9xGA21MFUb5zyw1DZs7NYMxWFDmzjd1', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHRtVHZrRVkwb0hMeUE2cnhOc1F1WE5QVHd4QkJXTndETFdrMTI4NSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAzOiJodHRwczovL2J0Zi5zdS9tb2RhLWktc3RpbC9rb2Z0eS1kbHlhLW1hbGNoaWtvdi03Ny1mb3RvLW1vZGVsaS1kbHlhLW5vdm9yb3poZGVubnl4LWktcG9kcm9zdGtvdi1tb2RhLW90Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357920),
('N67s5aZQQsWd0JlAO6RE5ZbuHkpJJ0lDnygGrDBi', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ3hrTE5PRHNKMHRFaDBSOThNV0VpSU04TXo5Rmt2Q1FJQmw2NEVLOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA1OiJodHRwczovL2J0Zi5zdS92YXNoLXl1cmlzdC96YXlhdmxlbmllLXYtZGV0c2tpai1zYWQta2FrLW5hcGlzYXQtb2JyYXplYy1wcmltZXItZG9rdW1lbnR5LWRseWEtemF5YXZsZW5peWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357894),
('ndrdZ53BHH6VenMylSZzaZmPkdjUcMNrUeAVWsoy', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHVQbjNtaHIyU2RNdnA0eENiMHJzU3NSNWx1V2I3a3p6alkxbmZxRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODE6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL2RsaW5uYXlhLXl1YmthLXMtY2hlbS1ub3NpdC16aW1vai1pLWthay1wb2RvYnJhdC1tb2RlbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357857),
('ne0DM3VHaAqh1ivULGOhUkOKzGFKzs8DiKJCBcom', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjNmM1pXaEswNm5ncVBhWmlSYllDY3Nhbkt0dVptMGdzMWd3cWJ3ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzY6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC95YWJsb255YS1nbG9zdGVyLW9waXNhbmllLWkteGFyYWt0ZXJpc3Rpa2Etc29ydGEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357849),
('NEKjk6jrt6RbuqTmNUflQqHDoFDVGVcgzUwqMulW', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXZNQ3RPdXRMNzE4OWVuTWs2b0NzS2Q4TXl5NGtwUXhjT1hGaXpobiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE0OiJodHRwczovL2J0Zi5zdS92YXNoLXl1cmlzdC9zb2RlcnpoYW5pZS1icmFjaG5vZ28tZG9nb3ZvcmEtY2hlbS1yZWd1bGlydWV0c3lhLWkta2FraWUtdXNsb3ZpeWEtdi1uZWdvLW1vemhuby12bmVzdGkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363604),
('nFTs8u6x5fJWqxRKnaxbkAhCJyWVTE63fpN1Yh9N', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibnNXR01tSmJiMHI4VVZWc1ZQRGdVdUluNTgwUTBDbkgyOEZVZVphYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjQ6Imh0dHBzOi8vYnRmLnN1L2Fsa29nb2wva29uc3RydWtjaXlhLXNhbW9nb25ub2dvLWFwcGFyYXRhLW1pZHpoZXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357841),
('NNEQtpuLmfuRudkmaehBqmhCyyrGCMNP0GFB3KPp', NULL, '40.77.167.54', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzduRTBxS0JQMTRTNG9NRlNrZkZ5OTd0ZDlJc2R4V3dvNU5iSWJvcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTI3OiJodHRwOi8vYnRmLnN1L2RpemFqbi1pbnRlcmVyYS9rcmFzbmF5YS1zcGFsbnlhLTU4LWZvdG8tZGl6YWpuLWludGVyZXJhLXYta3Jhc25vLWJlbHl4LWkta3Jhc25vLWNoZXJueXgtdG9uYXgtcy1zaW5pbWktYWtjZW50YW1pIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737355989),
('NP1KsAcmBjWD0ZyIpzNUat41Y15LDiUslyEQjlsK', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSE9zdFk2d0ZqcUhDMjRtVWZzS2FqVUF2TFVhckNIbHF1Rmswc0F3ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTQ6Imh0dHBzOi8vYnRmLnN1L3Zhc2gteXVyaXN0L3pheWF2bGVuaWUtby1wcmVrcmFzaGhlbmlpLWlzcG9sbml0ZWxub2dvLXByb2l6dm9kc3R2YS1vdC1kb2x6aG5pa2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357823),
('NrEs3F8qRgxRNYcPUa3lMoVpHqUarZWpHZoRVDEw', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVBnbFY0UWdoMDJlWGtXbXJ0UVo1N1M1RjNrNEFzODN6azUzRHJCRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHBzOi8vYnRmLnN1L3Zhc2hpLWRlbmdpL2J5dWR6aGV0LW90cHVza2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357879),
('NWavCaetF1mpFtkrpjLJzHdKlXmxd8T1zfjbXRK5', NULL, '66.249.79.103', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.6834.83 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicHhhY084T3FUZEh5YTBSU2JVTWs5NWZ0QkY1ZG9nTUxPUVYyb1o4dyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly9idGYuc3Uvc2FkLWktb2dvcm9kL3Bvc2Fka2EtbHVrYS1wb3JleWEtbmEtcmFzc2FkdSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737364526),
('NXh3jUdQeAGO5qfuAhfKUf8wnzTLjqrFcPe1tIel', NULL, '185.157.97.241', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiREJrVzIwZ2ttZlpNRmpKTmxSYXg3c0doUXNMZExob2kzOExTNXZINCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTQ6Imh0dHBzOi8vYnRmLnN1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737353517),
('NYcVRDukWbMc4HeRxcg64ZDTDeyTkjhnRbP8EEim', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlBORWROdVlMclBxeGxtRGJiY2t2UDh6c1VLYm1UNVg1c1lTRTFkNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vYnRmLnN1L2t1bGluYXIvdGVzdG8tZGx5YS1wcnlhbmljaG5vZ28tZG9taWthIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357820),
('nzGYZyBoCz2X06s1bCTx8Nz28Qc4RbOUAdCZmtTI', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZU14bjVoRWNZTFZ6VUp6T1NhTmw1bXRVMFVrS0hXc0RuemVac21OayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODE6Imh0dHBzOi8vYnRmLnN1L3V4b2QtemEtbGljb20taS1tYWtpeWF6aC9rb3JyZWtjaXlhLWJyb3Zlai1mb3RvLWRvLWktcG9zbGUtdGF0dWF6aCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363628),
('O2GJ39SrRLzNtVELXFjDD9NN3fDnisJQwJEBjAGz', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaXlnMGt3VTlvZG1UalBFZ1FuYVBsQXprVTRDaGkzcTlnMjVGNDdpUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHBzOi8vYnRmLnN1L3Zhc2gteXVyaXN0L2thay1wcm9waXNhdC1yZWJlbmthLXBvLW1lc3R1LXByb3Bpc2tpLW90Y2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357901),
('O8DtnmtPLNuuFL5ZKBiJQhcn7lrWDGbBG89F5H4P', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmdhTjl0VzI0cDFqeWpXblpMUktHM0NINXYxZVBvVGRoc1dSb2hjUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzY6Imh0dHBzOi8vYnRmLnN1L3Zhc2hpLWRlbmdpL2NodG8tdGFrb2Utc2V0ZXZvai1tYXJrZXRpbmctcmVqdGluZy1tbG0ta29tcGFuaWoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363626),
('O9K2Q4nVFGPpMyrhOLuLKd6FXfYWo0Cofj6n86B9', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3RVMWM3VWJPQXFKczVia0t6M0ZHVkdvZThXMkJyVFpUMExteExJYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTEzOiJodHRwczovL2J0Zi5zdS9sZWthcnN0dmVubnllLXJhc3Rlbml5YS96dmVyb2Jvai1mb3RvLXZpZHktcG9zYWRrYS1pLXV4b2Qtc2FqdC1vLXNhZGUtZGFjaGUtaS1rb21uYXRueXgtcmFzdGVuaXlheCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363701),
('OCzINzPdtTvDzzLlgVWeLjtAwRnQe7ozixwSSs4G', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUERaTWpES1l0NVlCWHJVdFlDcXNXcnBxVERZZWFkRjUzU0JUSHhjaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA3OiJodHRwczovL2J0Zi5zdS9kaXpham4taW50ZXJlcmEvcGxhbmlyb3ZrYS1nYXJkZXJvYm5vai1rb21uYXR5LXMtcmF6bWVyYW1pLTEwNy1mb3RvLXByb2VrdC1uYS0xLTUtMi0zLWktNC1rdiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357851),
('oJAIHRwT4tLzMz3ySd4Gc9u9p44Igviqi4bQImqi', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0l4Qno0dHhpa3BmVklLWHRtQlRrZmdGVFl0ck84Z2VIcGUxWEJaQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njc6Imh0dHBzOi8vYnRmLnN1L3phc2hoaXRhLXByYXYtcG90cmViaXRlbGVqL2Zvcm1hLW90a2F6YS1vdC1wcmV0ZW56aWoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357888),
('oksSQuRUByQzWP4YSErOGgU065U5phzYyiph98vM', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnNvQ0xJcTEwTEFHVThtam9UekE2dlhQWmxDUG12Um9TVWxrMW02eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHBzOi8vYnRmLnN1L2N2ZXR5LWkta29tbmF0bnllLXJhc3Rlbml5YS9taW5pLXJvenktdi1rdmFydGlyZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357935),
('ooSAkyWsXPFcppG1h4TJKpO0D3YSdu8hThiqvHY5', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid3RFUnU2eDFGd1R1OGFMZGZSMlFReXVjRllwUVo4eHBJaVZGV0I2TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwczovL2J0Zi5zdS96YXNoaGl0YS1wcmF2LXBvdHJlYml0ZWxlai9vYnJhemVjLWktYmxhbmstcHJldGVuemlpLXYtbXRzLWthay1uYXBpc2F0LWktcG9kYXQtZGx5YS16YXNoaGl0eS1zdm9peC1wcmF2Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357705),
('ouZ8wKqYLERavwSn6dGEckdwxLreMH1I1iAQsOHr', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUIzWmczRHpEb0JWVHJKNjZUY3JGeFFBaFZTbzlJanM2Y1JiaHVPcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTc6Imh0dHBzOi8vYnRmLnN1L3Zhc2gteXVyaXN0L2RvbGdpLXBvLWlwb3Rla2UtY2h0by1nb3Zvcml0LXBvc3Rhbm92bGVuaWUtby1zcGlzYW5paS1vc25vdm5vZ28tZG9sZ2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357845),
('OwBkdgsq3rrUSUIrFVwiuE7CWLnUUootia3MjIqN', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidDdubXBjV2toMjRwZGhIOXhDRlVlYmRBUHRIZ1dNZnhZRjJHdFpUQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA5OiJodHRwczovL2J0Zi5zdS9zYWQtaS1vZ29yb2Qva2FrLXByYXZpbG5vLXN1c2hpdC1iYXppbGlrLXN1c2hlbnlqLW5hLXppbXUtYmF6aWxpay12LWRvbWFzaG5peC11c2xvdml5YXgtc3VzZWtpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363712),
('owlxcSdBrmNZS1bq6Hq1do3QQLxVzs7NgZ55nnWx', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1d3bTFvclhRVzBCSHBXbHVpaTgwT1hQaTM1c0Z4djY0bGE4dWFjQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njk6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL2NodG8tbW9kbm8tbm9zaXQtemltb2otMjAxNy0yMDE4LWZvdG8tbW9kYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363732),
('Oxjat2LKBBQsIOakJvNGWf8xr8WuqcUbSd8VKeyP', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEY1dDNLd0p2WFg4eW5RYVFvVjlmNkg4SE9pbjhWa3N2REtpZ21YUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTI2OiJodHRwczovL2J0Zi5zdS9ieXRvdmF5YS10ZXhuaWthL2luZHVrY2lvbm55ai12b2RvbmFncmV2YXRlbC1ib2psZXItcHJlaW11c2hoZXN0dmEtaXNwb2x6b3Zhbml5YS1vYnpvci1wb3B1bHlhcm55eC1tb2RlbGVqLWNlbnkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357813),
('PDLYLKAZBkHJ5SOGfOqgHPRcnxoDDoIYsm90uHIc', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3JDVTBUaFM2WlhVOXRJdW5FY0t3c1lHak9mUXpKNTE0bGx6b0JIYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE5OiJodHRwczovL2J0Zi5zdS9tb2otcmViZW5vay9rYWstcG9tb2NoLXJlYmVua3UtcGVydm9rbGFzc25pa3Utcy1uYXJ1c2hlbmllbS16cmVuaXlhLXZrbHl1Y2hpdHN5YS12LXVjaGVibnV5dS1kZXlhdGVsbm9zdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363718),
('pkEkkbNVDo1GzeKNXBh4cZLpwuEWSTpm9vD42zh4', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGJUUzh4emo5Y3NkR2Joa1AyTUZta0hsc2NUb0VPRkV0RFVEdkNOaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTc6Imh0dHBzOi8vYnRmLnN1L3BlbnNpaS9taW50cnVkLXhvY2hldC1zZWtvbm9taXQtbmEtcG9zb2JpeWF4LXBvLXV4b2R1LXphLWludmFsaWRhbWktaS1wZW5zaW9uZXJhbWkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363706),
('PkRZ7cFYnXFCtCl3AoNxa6NCLArmzYJCFKGYdifm', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYW5GWFlLRHpkMnVobzBxYVhsdGRWMHBURzlLUVM1QkVvUklLNnFrRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE3OiJodHRwczovL2J0Zi5zdS9uZXRyYWRpY2lvbm5heWEtbWVkaWNpbmEva2FzdG9yb3ZvZS1tYXNsby1wcmktemFwb3JheC1rYWstc2xhYml0ZWxub2UtcHJpbWVuZW5pZS1pLXByYXZpbG55ZS1kb3ppcm92a2kiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357790),
('PP0RzVd1FWTPMinbu9IdFVesLqkPl1cfwiYr5Z1Y', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWRabTdDTE5tR1k4dExBQVhCaXNwdndCZGpWdUtxV01zZ3lvS3hXaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODU6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9yYW5uaWUtc29ydGEtdmlub2dyYWRhLW9waXNhbmllLWktb3Nub3ZueWUteGFyYWt0ZXJpc3Rpa2kiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363504),
('pWhGKb40a9agmogngzNPT6HJffKBfP2f7u9PCaZj', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2JsTFlJTHRLNFl2YXJxaHRtejNHOWNWTHhsekFWVDBLdXJjamM0ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njk6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9rYWtpZS1uZW9ieG9kaW15LXVkb2JyZW5peWEtZGx5YS1rbHVibmlraSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363692),
('Q4ZqJhqa8xc8csKw1sQzXs7T5l6dhllf2OAVu65e', NULL, '40.77.167.72', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidFE5YUMxNkx0cVkyeXh1WVM1VHNXcUdsdGhmYnRycXZUZG5nY3JGRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAwOiJodHRwOi8vYnRmLnN1L21vZGEtaS1zdGlsL2thay16YXZ5YXphdC1wbGF0b2stbmEtZ29sb3ZlLXJhem55bWktc3Bvc29iYW1pLXMtcG9zaGFnb3Z5bWktZm90by1pLXZpZGVvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737364110),
('Q8l19Uoh0yYcJAT23B7MEDDrWHwATYu3uCyZ1i7O', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0d5UFhkR21SY3VmWGVBdmRWcmFhcEczYlN2NHZqSExmdVc4WTNRSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODE6Imh0dHBzOi8vYnRmLnN1L3V4b2QtemEtdm9sb3NhbWkvbmlrb3Rpbm92YXlhLWtpc2xvdGEtZGx5YS12b2xvcy1wcmltZW5lbmllLW90enl2eSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357756),
('qm8nnD2Yw3GNujSoVFj5dbFekCqm3Eana2bUST98', NULL, '209.38.110.11', 'Mozilla/5.0 (compatible)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2NOcUZxQ3RvZm8zSjc3bDFMZW16amUyVjFpOVpJb2VKdElha28xbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTQ6Imh0dHBzOi8vYnRmLnN1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737359154),
('qR42pU1DaqVnV4Br5Qshy116IVO0AG2oJoL2qrYH', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDdDUTFhc2RxeGI0cHVsUUNxZmJ1Zkl5UldFeFNteVppUzdoTjRmdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODk6Imh0dHBzOi8vYnRmLnN1L2JhbnlhLWktc2F1bmEvYmFueWEtdi1kb21lLWlsaS1vdGRlbG5vLXBseXVzeS1pLW1pbnVzeS1yZXNoZW5pai1vcmxvdnN0cm9qIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363620),
('QUWeM8LcMQDY44OjERsAjGRWJlurmRqSp7pUVYTC', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUVkNHBEM2dNdUhWNW1QZkdObVhnaHNUOTV4STRCblV2NmF1YUhkUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTg6Imh0dHBzOi8vYnRmLnN1L3pkb3JvdmF5YS16aGl6bi9wb2xlem55ZS1zdm9qc3R2YS1yeWJ5LWthcnAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357877),
('RbAK3zhltgMyHMBn77MA2xW1zu9WZEor3ETo7c2d', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidXB0dzQ5UVZLbjY2NTRWSFl2dzljcnFmZXh1TkxISUREWHRJbWpkaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTQ6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL3BsYXRlLWJhcnlzaG55YS1rcmVzdHlhbmthLW1vZGVsaS1pLWJlc3BsYXRuYXlhLXZ5a3JvamthLW1ub2dvLWZvdG8iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357721),
('rBhRYQTn5J1Dr4XySWdrEaw6mkAezuy6TKKNEJAE', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEZoWmNpRFZIRUFYM2gzQ2xjdjlFY1lMbXhva0ZoRTNSRVBzVHZyZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9wb3NhZGthLWdydXNoaS12ZXNub2oiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363678),
('RBSAvlSJl4YNuYqUAPkhhTIyOwnqABWafVUJfvbg', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDJnd01UOFhDOHhFbWFEUzQwZmI2WFBZeGgySzg0cE1sZDV2QjFnRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzQ6Imh0dHBzOi8vYnRmLnN1L3BlY2hpLWkta2FtaW55L2NoZXJ0ZXpoLWJ1cnpodWpraS1uYS1kcm92YXgtcHJvc3RvLWktYnlzdHJvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357733),
('rET74Jdgqf1j9QzqotFWgvlC6LbwKfcXHkYqcjmI', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDZDWW9aZTl0bnpKdlpPT1B0dFp1VUpkRDMyTXVBNGhuUjZUdEYxeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODg6Imh0dHBzOi8vYnRmLnN1L2Jpem5lcy1pLXByb2l6dm9kc3R2by9jaHRvLXZ4b2RpdC12LW9ieWF6YW5ub3N0aS1hZG1pbmlzdHJhdG9yYS1yZXN0b3JhbmEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363705),
('ReyVlJrLYxHFW8AjrA3KCCRiXe7E5LN5lcOZe90R', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTVuRnRvUEQyQXN5RkpuUHQyYmdtWXl6SnVmM3c0Y05Bd0dTaDQwbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODY6Imh0dHBzOi8vYnRmLnN1L2F2dG95dXJpc3QvbmUtemF2b2RpdHN5YS1tYXNoaW5hLXN0YXJ0ZXItbmUta3J1dGl0LWR2aWdhdGVsLWF2dG9tb2JpbHlhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357848),
('rHPjyWqPtKgJoOAT5o0CGasldRAWl0mgEEhXHbuv', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidzlpcEt1dE01a05lZDlDOHY2WkVJWU1nUVRZUjhITW5zbVVLcnpvWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjY6Imh0dHBzOi8vYnRmLnN1L2t1bGluYXIva2FrLXByaWdvdG92aXQtbWFtYWx5Z3UtaXota3VrdXJ1em5vai1rcnVweSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363552),
('ruSwhatnCe6arq9exRtzUhWTaz28tG91jYy5lbc2', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibW5temphUnhlRHVBT0tMSUp6ejJpbktSTDFXRTdLTDRZTkhNdFpXYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njk6Imh0dHBzOi8vYnRmLnN1L25ldHJhZGljaW9ubmF5YS1tZWRpY2luYS9wcm9kdWt0eS1wb2xlem55ZS1kbHlhLXBvY2hlayI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357871),
('rVys5wgUcK8ZRgE9b401bPJyDTTZ0yhs6iFtzB50', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWEpyYkVIQWltaEhCbUlBeTFTcG9kQnI1TEdVNVc2QlJSRTRPVXFLeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODU6Imh0dHBzOi8vYnRmLnN1L3Zhc2gteXVyaXN0L2thay1wcm9pc3hvZGl0LXJhemRlbC1pbXVzaGhlc3R2YS1wb3NsZS1yYXp2b2RhLXYtYmVsYXJ1c2kiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357803),
('s19Y4UR7nlIsL6JOVHAYuznDiQc3iJZ7FiXENN0Q', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2FxQTBsYlpqREE2eWxTQ2p4eHRMZ1RNNkV6MUtRc2xtOUNDQUFQcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vYnRmLnN1L2Fsa29nb2wvdW5pa2FsbnlqLW5hcGl0b2stY2hpdmFzLXJpZ2FsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363530),
('s6HNkUU267CC971uA7EBO43HHlG1oXraMOrNtKoT', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1E4MHFQTmVTMTRlRm9BVFBXR0REQk1ObHRaMzZ3VkVQWWd2TEh3OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHBzOi8vYnRmLnN1L2t1bGluYXIvdmt1c255ZS1ibHl1ZGEtaXota29yeXVzaGtpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363601),
('SBtC2jnTcyOkfKpUuKuVQp5U6VLNJorcw4xg7ZMp', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGNRVHBtT2xwanRZcnhycEptWXp2TWFKalVDamxZU014U2lSeGxsdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vYnRmLnN1L2RpZXR5L3ZpdGFtaW55LWRseWEtdWx1Y2hzaGVuaXlhLXNsdXhhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363714),
('sCxFPzpMuGkpAudk6mkvawU9F5nIm9ZDCGq7A841', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUx5N2FXSE5KTktORTdOQzZKS25nZ1gxYXdlMkRtb3QwTU9HNGdCdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzM6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL2R6aGluc3ktYm9qZnJlbmR5LWRseWEtcG9sbnl4LWRldnVzaGVrLTMwLWZvdG8iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363694),
('sES0jpV3kkJndDtyhYEKoqOAYSiaAQGyD0y8YmKX', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicHFmOUZFbVpzQU04QTIzdWlxM0d6amM0M1V3cEZ5QklFazBUOTJ0YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzY6Imh0dHBzOi8vYnRmLnN1L3phc2hoaXRhLXByYXYtcG90cmViaXRlbGVqL2thay1ncmFtb3Ruby1vdHZldGl0LW5hLXByZXRlbnppeXUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357782),
('SOGZ37eCo8xmo7oJBPNyq5ZN1ON9JxTWadIMHZLM', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXhVSGF4Rmd3QlF6aWJhVEpjV0phampuNWR3Sk53TzFDOUlxRlFQSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njc6Imh0dHBzOi8vYnRmLnN1L21vZGEtaS1zdGlsL2tha2llLWR6aGluc3ktbW9kbnllLXYtMjAxOC1wb2xuYXlhLW1vZGEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363544),
('Sp4HLnCmdqgxlKzBbogn4VHzAB4wAOKVoVjxq1fR', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTlLampORDNDTDdQYU5tVHdvTFYyYmRqUGVXWERrMjBxbXM0Szd2dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzc6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9rYWstemFkZWxhdC1kdXBsby12LXlhYmxvbmUtY2hlbS16YW1hemF0LWktbGVjaGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363655),
('sq4f9Tq86VWy1TsvwxJP2TbDzG2dku0wiZbD0TLd', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSTNmdW1qVzBCR1MzOUlqVVBUYmVFdDFnamVUdHNmajNjY3ZkYlRlTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHBzOi8vYnRmLnN1L2t1bGluYXIva2FrLXZhcml0LWthbG1hcm92LTEwMDAtc2VrcmV0b3YiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357843),
('srCUG1mTz5oRnlQAFOi4cDx3VezoA6MAA10BA4I6', NULL, '66.249.79.36', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidFBnNHB3cWxXeHN3WFpqZFBVZzFmbzdSeDlFUDJBOEhLZkl2S1pxVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzc6Imh0dHA6Ly9idGYuc3UvZGl6YWpuLWludGVyZXJhL2N2ZXQta3V4bmktaWRlYWxub2Utc29jaGV0YW5pZS04NS1mb3RvLTEwMC1pZGVqIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737353869),
('SSPmngc62WZn0ysjftyipkpGtgPySb76vW6clm4w', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUFzY2hKWVBKZ1Z6T3Y2NjBKUThxM0pDWk8yaE9aaHdDTjUzWk5qaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHBzOi8vYnRmLnN1L2xhbmRzaGFmdG55ai1kaXpham4vdXhvZC16YS1nYXpvbm9tLW9zZW55dS1pLXZlc25vai1rYWxlbmRhci1yYWJvdC1mb3RvLXByaW1lcm92Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357700),
('t9KGBQSBPcWryXaGqaXGI4GolrWUK6yu3L2WY88S', NULL, '209.38.110.11', 'Mozilla/5.0 (compatible)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWl4Z2NzT0Q1Q2J1NzM4Y0N5bGlXcjhtcURzN0NWZ2Jjbk1tS0VyaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vYnRmLnN1L2Zhdmljb24uaWNvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737359155),
('TcuMwpeneJggonHRrWAjpDU7D1DGVbgF0DXdUJfK', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGR4OUsyYUdpejRCVDFlNlRlMDV5cjZCVkk3em4wZlJ5THNXV2N1UCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTA6Imh0dHBzOi8vYnRmLnN1L3BlbnNpaS9sZ290eS12b2VubnltLXBlbnNpb25lcmFtLXYtMjAxOC1nb2R1LXBlcmVjaGVuLWktcHJhdmlsYS1wb2x1Y2hlbml5YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363562),
('tDpkBrAmTaTTLjMIz09Nwben4iKgn8Ut99qZsh6v', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDBRRG9tTEh6VXVQTnU3ZEZFUjRCUHZJUGswZmk4SGlVV3VDakhQQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODc6Imh0dHBzOi8vYnRmLnN1L25ldHJhZGljaW9ubmF5YS1tZWRpY2luYS9wZXJla2lzLXZvZG9yb2RhLXByaW1lbmVuaWUtdi1uYXJvZG5vai1tZWRpY2luZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357717),
('tifkVGomNJgnYDg4CPjb2lS6bIQde4awiyWzogNH', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidG00a0ZWZlhxNXVYYm5xeEFXaTBjVEttY2FrS0JpbTBtYzFiY1lldiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9pbnpoaXJueWotcGVyc2lrLWZvdG8taS1vcGlzYW5pZS1zb3J0YS12eXJhc2hoaXZhbmllLXNhemhlbmN5LXZpZGVvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357821),
('tkJO8YO3zfOuFuSplQPKBNVt5lVxGWrSCShZJIdv', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUwzUmNGemoxSHJ2ZmprY0d6cXpuaXdsTHZqaVBmeG9wSVJNTlZnTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHBzOi8vYnRmLnN1L2xla2Fyc3R2ZW5ueWUtcmFzdGVuaXlhL2l2YW4tY2hhai1wcmktYmVyZW1lbm5vc3RpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363533),
('UMWhwq0yt6If8CQUbS2ZSslAcjIbqy7XGQ3Xn4Bj', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUxXZzJGakc0YzZnRmt2dGpENmxxcTJiT1c4bDh0SEhLdHdhSjBsZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHBzOi8vYnRmLnN1L2FsaW1lbnR5L3Jhc3Bpc2thLW8tcG9sdWNoZW5paS1hbGltZW50b3Ytb2JyYXplYy1rYWstbmFwaXNhdC1pLXRyZWJvdmFuaXlhLWstbmVqIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357856),
('v3K5thTSwOZ6PKfksoQboNHso7vpA2klLXxmpHa8', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienAxZGpxNjlGSDJTcWNoWDhxVnR1aGdONHVvWUVKZ1dQUmRyNmpVcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODE6Imh0dHBzOi8vYnRmLnN1L2RpZXR5L2thcnRvZmVsbmF5YS1kaWV0YS04MjEyLXh1ZGVlbS1uYS1rYXJ0b3Noa2UtbWlmLWlsaS1yZWFsbm9zdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357818),
('vEs5CkB7W6Qrkq51NoLm8khnslTvhBnGdNg2z3v0', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWFFb3RCVFRSblFUaUNsRTQyU0Q1bHV3NmRuekRzM2o3Y2o4Q05acSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHBzOi8vYnRmLnN1L2RpZXR5L21hc3NhemgtcHJpLXB5YXRvY2hub2otc2hwb3JlLXRleG5pa2Etdnlwb2xuZW5peWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357766),
('vIxTAW5rpMRXhBvw7N4TK93tfT6H2uOhjalOXlx7', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVDlDRldYR01SaHlWcUd4MG5Sa0gyWEV5em0yV1I5bm9OU2tJck9TSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODE6Imh0dHBzOi8vYnRmLnN1L3ZzZS1vYm8tdnNlbS9zZXZlcm55ai1zdGF6aC1kbHlhLXBlbnNpaS1kbHlhLXpoZW5zaGhpbi12LTIwMTctZ29kdSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357753),
('VJ9wFQBTM5r6TM9VQPXxECpLyc8kCGnuZBonklyd', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkhTeWg3UXI1OEw4a0pKUHNra0xTRVRQbG40Mk15Y09QWm9wU29SWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzY6Imh0dHBzOi8vYnRmLnN1L3pkb3JvdmUvbml0cmF0eS12LW92b3NoaGF4LXNwb3NvYnktb3ByZWRlbGVuaXlhLWktaXpiYXZsZW5peWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357804),
('VLElplYXYGje3o7pASstIwl46yhSbkJbC5dHIpOD', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDJ5ODRFRFJaY1Z5Q3VlNGhnRERhSldqY2RTSXpjWVc5Tk5xaFBLOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzY6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9zb3J0YS15YWJsb2stdi1iZWxhcnVzaS1vcGlzYW5pZS1sdWNoc2hpeC1zb3J0b3YiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363638),
('vNKssC9HagSyeD2ukWxAp79QTqwPokYr0DgtydkF', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmVWUk82VWVERk1vZGlXUmplbURlTGhSQ1REUkxuMmtXcGk5V3hKQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTI6Imh0dHBzOi8vYnRmLnN1L3NvdmV0eS1hdnRvbHl1Yml0ZWx5YW0vbW96aG5vLWxpLWV6ZGl0LW5hLXppbW5lai1yZXppbmUtbGV0b20taS1zaHRyYWYtdi0yMDE4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363736),
('VPBfMLmJ1nc8PzRG916Swvqig5QKskDe3hE6lPeX', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2dNQWFtRXdNbVFOc2Y4NVlYYWR3R3dFUTJRd3ZFVEVzN1ZsUjdZOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAwOiJodHRwczovL2J0Zi5zdS9rYWstdnNlLXVzdHJvZW5vL2thay1zZGVsYXQtYW5nZWxza2llLWdsYXpraS1zdm9pbWktcnVrYW1pLWktdXN0YW5vdml0LWl4LXYtZmFyeS1hdnRvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363652),
('vVyYqcZ3zs4lPSz1BHjuO8xkGvT8ZahlQIYyoj1o', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQm54b25SQXpuUlN3dnpJRGZUZ3k2NlJpdFNJSnQ0UHJzMXBwbTN4bSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODA6Imh0dHBzOi8vYnRmLnN1L2N2ZXR5LWkta29tbmF0bnllLXJhc3Rlbml5YS9saXN0LXJhc3Rlbml5YS1lZ28tc3Ryb2VuaWUtaS1mdW5rY2lpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363724),
('VX8kHvSMFdq50tmwOVYqRJ94RqhK6DwR4G8ouBHf', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTFp0TTM0OU1sb0IzWWdNaXcwRmNxbmFkRVJMSHBUR2ttT1RHYjc2cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njc6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9rYWstdnlyYXN0aXQtcG9taWRvcnktdi1vdGtyeXRvbS1ncnVudGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363650),
('W2IxkEBPbPrlTSlnzPr36sPknb6pGwhUfDEk0hZz', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkdtZkFCTGNTZVYwa2tvR29iNGZpUFprMG1WZ25lUGlNTGlEdTV0VyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHBzOi8vYnRmLnN1L2JvbGV6bmktaS1sZWNoZW5pZS9jaHRvLXRha29lLWthbGNpbm96LWkta2FrLWVnby1sZWNoaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357863),
('W39k1TFIHGKCRR5ThQH3YOcZ1hdVV8VBxqeK8aOy', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaXFhQkpMbVJ3NURzbjY5cVc3bTAwdEhrYWZIUjBRZGUwVlBFN3M3SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTExOiJodHRwczovL2J0Zi5zdS9jdmV0eS1pLWtvbW5hdG55ZS1yYXN0ZW5peWEvdXhvZC16YS1kcmFjZW5vai12LWRvbWFzaG5peC11c2xvdml5YXgtYm9sZXpuaS1kcmFjZW55LWktaXgtbGVjaGVuaWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357690),
('wBgQzcNO6PLqGBAPuganS4umM9Dd1JXE8vcSNFu2', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVFYSzlFTFFGbjNnT0ZuekJUc3dZMkRYYjR2U1RvaWY0ODBJeVJ1dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAzOiJodHRwczovL2J0Zi5zdS9iaXpuZXMtaS1wcm9penZvZHN0dm8vY2h0by10YWtvZS1pbnRlZ3JhY2l5YS1tZXpoZHVuYXJvZG5heWEtZWtvbm9taWNoZXNrYXlhLWludGVncmFjaXlhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363703),
('WgB7EC4MYrqXxFBD8c0V27G34AEHEaMZE5jcO2iU', NULL, '52.167.144.20', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNVp4c3RFQ1FvejI4a1F4S1h5d0d3MUpmd2R2M0FCSHNIelVFUXpYUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjI6Imh0dHBzOi8vYnRmLnN1L3BvbGV6bnllLXNvdmV0eS91a2xhZGthLXBhcmtldG5vai1kb3NraS1uYS1rbGVqIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737370974),
('wIBKiKzBsfNTBPojGjF0qJSiR44eKiQsPzPHQrud', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1ZVZ21EYko3ZloxTXdVMXIxZTRsUDljMDh4V3pVYUxXYmtHcVlVYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAzOiJodHRwczovL2J0Zi5zdS9zYWQtaS1vZ29yb2QvbHVrLXNodHV0Z2FydGVyLXJpemVuLW9waXNhbmllLXNvcnRhLXBvc2Fka2EtaS11eG9kLXZ5cmFzaGhpdmFuaWUtaXotc2VteWFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357927),
('WINVskW0QS3tCOLZLQ33kDELtfmLaV3oDnnd1AQT', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2tCYTROelljamNzVjNScTg0YjBhWGEycVlEdEZmOHFPOXFBQ0hEcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTI6Imh0dHBzOi8vYnRmLnN1L2N2ZXR5LWkta29tbmF0bnllLXJhc3Rlbml5YS9mb3RvLWNpcGVydXNhLWZvdG9ncmFmaWktY2lwZXJ1c2Etc3l0LWZvdG8tY3ZldG92Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357838),
('Wj5vWN1vPFyHY8Hmf32xGvh8nZsWtOSaHtdMZorT', NULL, '66.249.79.164', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXNuNk1pWDdyNnhOVFJzNUVtT2xWVndBQzdGVUgyN2tydG5sclg1bSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9idGYuc3UvYWRzLnR4dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737355520),
('wOtsSl2deQQBvSyDGIu6Waf8DO452LtI4Q4HWNRr', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicVdOYkJZMDFGWUZaOVdzZmpUZlZ0MHVLTDRmYWVYZnNvdHRrWVRQeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODg6Imh0dHBzOi8vYnRmLnN1L21vai1yZWJlbm9rL3RyYXZtYS1nb2xvdnktdS1yZWJlbmthLXRyZXZvemhueWUtc2ltcHRvbXktaS1wZXJ2YXlhLXBvbW9zaGgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363671),
('WUCxuqhjvBKLaVy6gvb8j971u3IQ8pGEUFwNcA53', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzVqRFpEc0xLMUtTbHJBRjdzRXdvOTlDTTVGbXVHS1AzTldrS0JlciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODM6Imh0dHBzOi8vYnRmLnN1L3BvZGVsa2kvcG9kZWxraS1pei1rYXJ0b25ueXgta29yb2Jvay1pZ3J1c2hraS1kbHlhLWRldGVqLWktZG9tYS1mb3RvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357835);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('wyu99gCjPwb8otdiy8JYOkZONUyOIyf3SETSmnde', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTGFUNTd3ZGJSS2I0VTBNWWU1azBrc2oxNG1zWk03cTdaelp2bkR6QSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwczovL2J0Zi5zdS9tZWJlbC9rYWstbmF6eXZhZXRzeWEtZGl2YW4ta290b3J5ai1yYXNrbGFkeXZhZXRzeWEtdnBlcmVkLXNlcnZpY2V5YXJkLXV5dXQtdmFzaGVnby1kb21hLXYtdmFzaGl4LXJ1a2F4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357711),
('wz2TbBDUuctC2kaRMXyINNJAFHGLVer2biasD6Rr', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEdSV1NPb2U4U2ZQZXZlbmhVeTVzd2dRUGF2eTJnQTNrN2M0SHJ1TyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzI6Imh0dHBzOi8vYnRmLnN1L3pkb3JvdmUvdnlzb2tpai1nZW1vZ2xvYmluLXUtbXV6aGNoaW4tcHJpY2hpbnktaS1sZWNoZW5pZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357702),
('XtkLrEKu52fxYxAU0KC8R03jirwq8zPkZsz83g0f', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWZUS2Qyc0dtQjBsbWZkUjlpY0tQNkZsS2FrWlhVaDZ3UUdIR2NiaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC91eG9kLXphLXZpc2huZWoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737363517),
('XTZgPagJLgY4InHQJX8O9YtpDQQk1mmSaYeuId3O', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiemhidDI2VDBUSVBYMGhoTlBQZ1hXU2MwY2NsOGVQcDdYR3ZxaVU2ViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vYnRmLnN1L3pkb3JvdmUvZW5lcmdvc2JlcmVnYXl1c2hoaWUtbGFtcHktdnJlZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737363687),
('XW1ifc1viRXEtSIr6ZTNz1vt9sachupWRsk51Xyx', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3hRUnF1VmxXRUVSdnp2Q0VSZDAzZmpMSjdLMHladDZKVElIVHVlTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA2OiJodHRwczovL2J0Zi5zdS9wZW5zaWkvbWludHJ1ZC1uZS1vYnN1emhkYWV0LXBvdnlzaGVuaWUtbWluaW1hbG5vZ28tdHJ1ZG92b2dvLXN0YXpoYS1kbHlhLXZ5eG9kYS1uYS1wZW5zaXl1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363591),
('xz7vQiPkClTS3lpPny3OaFm1PRNM7vBbwg79goa8', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYXVBY2ZKdzgxZkhCS3QwcXJXY0lIVUNCQjZiNkx5TUdxRHJVZThzUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzQ6Imh0dHBzOi8vYnRmLnN1L3NhZC1pLW9nb3JvZC9tb3Jrb3Yta2Fyb3RlbC1vcGlzYW5pZS1pLXhhcmFrdGVyaXN0aWthLXNvcnRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357737),
('Y8Z1wtaRwH64yx52vTMSQY90oWTM0F6Go2ZBFFWc', NULL, '52.167.144.20', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGIwOXdEaElrSHBhZ2Q1NVVJbTZIeGw2ZmhQelVhQkljNjJvc2lpOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly9idGYuc3UvYm9sZXpuaS1pLWxlY2hlbmllL3pkb3JvdmUtc2luZHJvbS1sYWplbGxhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737370974),
('YebghL771tcdWSzWVm6xfa8ueG6FqZeNdqA0Qw2w', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN05wS2VoUE5NU0xRNVVGT3d1dDI3VVFXbERKNVM0bjBLNlJNZ1duSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA2OiJodHRwczovL2J0Zi5zdS9sZWthcnN0dmVubnllLXJhc3Rlbml5YS9ib3JvdmF5YS1tYXRrYS12LWdpbmVrb2xvZ2lpLWxlY2hlYm55ZS1zdm9qc3R2YS1pLXByb3Rpdm9wb2themFuaXlhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357875),
('YjNaLJ3XCYLH3FgGS4gFFN3l6yNLLn72yt3DC2NZ', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTEpjekpsb3ZYbW1hUmhBSTJIeDRad3NVcDZKQXBBU2lMelRvd01hYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA2OiJodHRwczovL2J0Zi5zdS9ieXRvdmF5YS10ZXhuaWthL3Z5dHlhemhrYS1kbHlhLXZhbm5vai1pLXR1YWxldGEtdmlkeS12eWJvci1pLW1vbnRhemgtc3ZvaW1pLXJ1a2FtaS0xNS1mb3RvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357859),
('YjOo205fz9SdgNos2GHVvm7pWYPFyX53MdyKxRMk', NULL, '95.163.255.27', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiczlzNjZrWVY3THE2eEhJUnc4NlNSNUIxdE05cVJxY1pidEFLMFFVTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHBzOi8vYnRmLnN1L3BlY2hpLWkta2FtaW55L2R5bW94b2QtZGx5YS1nYXpvdm9nby1rb3RsYS12LWNoYXN0bm9tLWRvbWUtdHJlYm92YW5peWEtbWF0ZXJpYWx5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357758),
('yphSojmLApWJK3NUMdTqW9NyWWrxbxAn1DWxWYXZ', NULL, '95.163.255.26', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicHBJc2xDMVZNNzRHazNWM1oybUNUOWl3aUZTMzZPdFFuU1p2QjI1TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODk6Imh0dHBzOi8vYnRmLnN1L3pkb3JvdmUvb3NvYmVubm9zdGktcHJpbWVuZW5peWEtY2VmYXpvbGluYS1wb2themFuaXlhLWluc3RydWtjaXlhLWktb3R6eXZ5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357867),
('YQZ9QqYVDLdoyny66CmoFau1xgdv50r2O8mrKv3K', NULL, '95.163.255.29', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmQ5dENUbXJ3MlJ5eUUyWGlYVkUweDgxOFFkMHl0a0FQZFN6cnd4ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHBzOi8vYnRmLnN1L2RpemFqbi1pbnRlcmVyYS9tYXZyaXRhbnNraWotc3RpbC12LWludGVyZXJlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363661),
('z38G3zekEZhAJefXyoi5cjwoAFDar204P6GRYE2q', NULL, '95.163.255.28', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGpBSFlQcGtldHlOWTFWR2JNR2prNnE5cEJjb09XNG1Ta0dXb1VhTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAxOiJodHRwczovL2J0Zi5zdS9ieXRvdmF5YS10ZXhuaWthL3phbGl2bm9qLXNobGFuZy1kbHlhLXN0aXJhbG5vai1tYXNoaW55LXZpZHktaS12YXJpYW50eS1wb2RrbHl1Y2hlbml5YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357829),
('zCMd6AbPYkgVsz9rvk7igBrIVBH96kKH8p8PcLoT', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNEVUM0NZamJFWm03OTFreW93TGZROW5uTVlxa29XVGNFWFFNNDRmRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA5OiJodHRwczovL2J0Zi5zdS92YXNoLXl1cmlzdC9vYnJhemVjLXByb3Rva29sYS1zb2JyYW5peWEtemhpbGNvdi1tbm9nb2t2YXJ0aXJub2dvLWRvbWEta2FrLXByb3ZvZGl0c3lhLXNvYnJhbmllIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737363576),
('ZDqTD8HfI3fYBeiXiBP3CTV0XlQ828GVj3rb3AZQ', NULL, '43.130.40.120', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0F1emp5Vzh4UnZKOTRwR0lld1RINWVrRVRaODR1bkxORHNpSXRDMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTc6Imh0dHA6Ly93d3cuYnRmLnN1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737352490),
('zgIuoqmynzc1P7p1Gphfqi0G0M9dMF1s6P8uwDRG', NULL, '95.163.255.22', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWk5dkhEMXlVU1kzZko0UXVLTU5HTngwbFdBQjdJbHIySFN4ZjRRNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTEwOiJodHRwczovL2J0Zi5zdS91eG9kLXphLWxpY29tLWktbWFraXlhemgva29nZGEtbHVjaHNoZS1kZWxhdC10YXR1YXpoLWJyb3Zlai1pLW1pa3JvYmxlamRpbmctdi1rYWtvZS12cmVteWEtZ29kYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357887),
('ZI6ZNManntHzhLVXJUIVDVKQPwCz6vKEGekZl5wz', NULL, '95.163.255.25', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSExEQ1NQbmJIS1BmZ2xvN2pIYzdxZTQ1bVVmZ3k3YUczNGNoZEpXMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAxOiJodHRwczovL2J0Zi5zdS9zb3ZldHktYXZ0b2x5dWJpdGVseWFtL3JlbW9udC1sb2Jvdm9nby1zdGVrbGEtc3ZvaW1pLXJ1a2FtaS1yZW1vbnRpcnVlbS1sb2Jvdm9lLXN0ZWtsbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737357769),
('ZJtCXGLzbb9tV09gsOBtJWzJw6log9f3VCkfy8Fi', NULL, '95.163.255.24', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT05IQ296UWJ2RVNwYXlZcEFjMzZqRzg1UjZDazE3MnVtOVR6YWZmZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njc6Imh0dHBzOi8vYnRmLnN1L2Jpem5lcy1pZGVpL2Jpem5lcy1pZGV5YS1vdGtyeXRpeWEtZGV0c2tvZ28tYmFzc2VqbmEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1737357892),
('zzGZ5XbkO30qtVLOnouYQ4fFelfwjvT4uZFCxtGH', NULL, '95.163.255.23', 'Mozilla/5.0 (compatible; Linux x86_64; Mail.RU_Bot/2.0; +https://help.mail.ru/webmaster/indexing/robots)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQVByemJHV0o1YkJCNzdMN0Y5SU5BUUJXcm5UWml1ZThDQWtFcmxTQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg0OiJodHRwczovL2J0Zi5zdS9hbGltZW50eS9za29sa28tcGxhdHlhdC1hbGltZW50eS1uYS1vZG5vZ28tcmViZW5rYS12LTIwMTgtZ29kdS1rYWtvai1zZWpjaGFzLW1pbmltYWxueWotcmF6bWVyLXZ5cGxhdHktYWxpbWVudG92LW5hLW9kbm9nby1yZWJlbmthLXNrb2xrby1wcm9jZW50b3YtYWxpbWVudHktbmEtMS1yZWJlbmthIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737357812);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `key`, `value`, `lang`, `status`) VALUES
(2, 'Телефон', 'phone', '+74012313143', 'ru', 1),
(3, 'Адрес', 'address', 'г. Калининград, набережная Правая, 10, литер В', 'ru', 1),
(4, 'График работы', 'schedule', 'Пн-Пт: 09:00 - 18:00, <br class=\"d-md-none\"> Перерыв: 13:00 - 14:00 <br> Сб, Вс: Выходной', 'ru', 1),
(5, 'Координаты на карте', 'coords', '54.947113,20.159578', 'ru', 1),
(6, 'Название сайта', 'sitename', 'Балтийская табачная фабрика', 'ru', 1),
(8, 'Email', 'email', 'sekretar-kd@btf39.su', 'ru', 1),
(14, 'Телефон отдела кадров', 'phone2', '+74012313143', 'ru', 1),
(15, 'Мобильный телефон', 'mobile', '+79114547331', NULL, 1),
(16, 'Количество брендов', 'brands_count', '15', NULL, 1),
(17, 'Количество дистрибьюторов', 'distributors_count', '20', NULL, 1),
(18, 'Количество лет на рынке', 'years_count', '27', NULL, 1),
(19, 'Координаты сотрудников', 'employees_count', '245', 'ru', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE `slides` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ru',
  `order_by` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `name`, `tagline`, `description`, `link`, `picture`, `preview`, `lang`, `order_by`, `status`) VALUES
(4, 'Балтийская табачная фабрика', 'Добро пожаловать!', NULL, NULL, 'Fy9SayeDWhTOWf1p.webp', NULL, 'ru', 1, 1),
(5, 'О компании', 'Балтийская табачная фабрика', NULL, NULL, 'YVS9IVsD4bcpQk4Y.webp', NULL, 'ru', 2, 1),
(6, 'Каталог продукции', 'Tobacco', NULL, NULL, 'yoD71OzKB5YZRz0F.webp', NULL, 'ru', 3, 1),
(7, 'Дистрибьюторы', 'Партнеры', NULL, NULL, 'hx2fmzAvuKBVp940.webp', NULL, 'ru', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `streets`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `streets`;
CREATE TABLE `streets` (
  `id` int UNSIGNED NOT NULL,
  `cityId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classifierId` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `streets`
--

INSERT INTO `streets` (`id`, `cityId`, `name`, `code`, `external_id`, `classifierId`) VALUES
(3, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '10-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46de56', '39016001000021600'),
(4, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '11-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46df22', '39016001000021700'),
(5, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '12-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46dedd', '39016001000021800'),
(6, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '13-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46df9d', '39016001000021900'),
(7, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '14-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46df70', '39016001000022000'),
(8, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '15-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46de08', '39016001000020800'),
(9, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '16-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfeb', '39016001000022100'),
(10, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '17-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46de92', '39016001000022200'),
(11, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '18-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46ddf0', '39016001000022300'),
(12, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '19-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfc1', '39016001000022400'),
(13, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '1-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46de68', '39016001000020700'),
(14, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '20-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46df13', '39016001000022500'),
(15, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '21-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46de2c', '39016001000022600'),
(16, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '22-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46df88', '39016001000022700'),
(17, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '23-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46dec5', '39016001000022800'),
(18, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '24-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46ddea', '39016001000022900'),
(19, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '25-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46df46', '39016001000023000'),
(20, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '2-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46df28', '39016001000023300'),
(21, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '3-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfe8', '39016001000020900'),
(22, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '4-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46de9b', '39016001000021000'),
(23, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '5-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46df79', '39016001000021100'),
(24, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '6-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46de11', '39016001000021200'),
(25, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '7-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46debf', '39016001000021300'),
(26, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '8 Марта', NULL, '0484521b-c371-3e15-018c-7bfd8f46de23', '39016001000007200'),
(27, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '8-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46df85', '39016001000021400'),
(28, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', '9-я линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46de20', '39016001000021500'),
(29, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Аптечная', NULL, '0484521b-c371-3e15-018c-7bfd8f46de3b', '39016001000000100'),
(30, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Архитектора Попова', NULL, '0484521b-c371-3e15-018c-7bfd8f46df82', '39016001000008700'),
(31, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Аэлита гаражно-строительный кооп.', NULL, '0484521b-c371-3e15-018c-7bfd8f46de53', '39016001000019000'),
(32, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Балтийская', NULL, '0484521b-c371-3e15-018c-7bfd8f46de38', '39016001000000200'),
(33, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Балтийский проезд', NULL, '0484521b-c371-3e15-018c-7bfd8f46dee3', '39016001000015600'),
(34, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Баха', NULL, '0484521b-c371-3e15-018c-7bfd8f46df61', '39016001000000300'),
(35, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Баха переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dec8', '39016001000007400'),
(36, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Береговая', NULL, '0484521b-c371-3e15-018c-7bfd8f46dea1', '39016001000007500'),
(37, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Береговой переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dde7', '39016001000000400'),
(38, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Березовая', NULL, '0484521b-c371-3e15-018c-7bfd8f46dddb', '39016001000015700'),
(39, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Березовый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df04', '39016001000010700'),
(40, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Вербный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df49', '39016001000010600'),
(41, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Верещагина', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfaf', '39016001000000500'),
(42, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Верещагина переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dffa', '39016001000008800'),
(43, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Весенняя', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfe5', '39016001000013100'),
(44, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Вешняя', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfbe', '39016001000017700'),
(45, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Вознесенская', NULL, '0484521b-c371-3e15-018c-7bfd8f46df7f', '39016001000020100'),
(46, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Вокзальная', NULL, '0484521b-c371-3e15-018c-7bfd8f46de59', '39016001000000600'),
(47, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Гагарина', NULL, '0484521b-c371-3e15-018c-7bfd8f46df4c', '39016001000000700'),
(48, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Гагарина переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfd0', '39016001000009500'),
(49, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Гвардейский переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfa3', '39016001000000800'),
(50, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Гоголя', NULL, '0484521b-c371-3e15-018c-7bfd8f46df4f', '39016001000000900'),
(51, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Горького', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfb5', '39016001000001000'),
(52, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Горького переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de6b', '39016001000008900'),
(53, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Грибной переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df5b', '39016001000015800'),
(54, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Дачная', NULL, '0484521b-c371-3e15-018c-7bfd8f46de41', '39016001000001100'),
(55, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Дачный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de95', '39016001000012300'),
(56, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Динамо', NULL, '0484521b-c371-3e15-018c-7bfd8f46df94', '39016001000001200'),
(57, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Добрая', NULL, '0484521b-c371-3e15-018c-7bfd8f46df8b', '39016001000018400'),
(58, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Дубовая аллея', NULL, '0484521b-c371-3e15-018c-7bfd8f46dded', '39016001000013300'),
(59, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Еловый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dde4', '39016001000015900'),
(60, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Железнодорожная', NULL, '0484521b-c371-3e15-018c-7bfd8f46df9a', '39016001000001300'),
(61, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Железнодорожный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dee6', '39016001000007800'),
(62, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Живописный проезд', NULL, '0484521b-c371-3e15-018c-7bfd8f46de5f', '39016001000020300'),
(63, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Заречная', NULL, '0484521b-c371-3e15-018c-7bfd8f46de83', '39016001000001400'),
(64, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Заречный проезд', NULL, '0484521b-c371-3e15-018c-7bfd8f46df5e', '39016001000001500'),
(65, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Звездный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df1f', '39016001000019600'),
(66, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Зеленая', NULL, '0484521b-c371-3e15-018c-7bfd8f46dece', '39016001000001600'),
(67, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Земляничная', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfdc', '39016001000017500'),
(68, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Золотой переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46def5', '39016001000020200'),
(69, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Ивовый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dee0', '39016001000010800'),
(70, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Игашова', NULL, '0484521b-c371-3e15-018c-7bfd8f46df8e', '39016001000001800'),
(71, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Изумрудный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de89', '39016001000019400'),
(72, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Калининградский проспект', NULL, '0484521b-c371-3e15-018c-7bfd8f46dff1', '39016001000001900'),
(73, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Калининградское шоссе', NULL, '0484521b-c371-3e15-018c-7bfd8f46dff4', '39016001000016000'),
(74, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Карла Маркса', NULL, '0484521b-c371-3e15-018c-7bfd8f46de7a', '39016001000002800'),
(75, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Каштановая', NULL, '0484521b-c371-3e15-018c-7bfd8f46ddde', '39016001000016100'),
(76, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Кедровый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de0b', '39016001000016200'),
(77, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Кленовая', NULL, '0484521b-c371-3e15-018c-7bfd8f46deef', '39016001000016300'),
(78, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Кольцевая', NULL, '0484521b-c371-3e15-018c-7bfd8f46dde1', '39016001000010900'),
(79, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Кольцевой переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df64', '39016001000011000'),
(80, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Коммунальная', NULL, '0484521b-c371-3e15-018c-7bfd8f46deda', '39016001000009600'),
(81, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Комсомольский переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46ddf3', '39016001000010200'),
(82, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Корабельный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df6a', '39016001000019500'),
(83, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Косогорная', NULL, '0484521b-c371-3e15-018c-7bfd8f46df07', '39016001000016400'),
(84, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Красноармейский переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de65', '39016001000010300'),
(85, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Курортная', NULL, '0484521b-c371-3e15-018c-7bfd8f46de26', '39016001000002100'),
(86, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Ленина', NULL, '0484521b-c371-3e15-018c-7bfd8f46ddf6', '39016001000002200'),
(87, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Ленинградская', NULL, '0484521b-c371-3e15-018c-7bfd8f46de86', '39016001000002300'),
(88, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Лермонтовский переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de71', '39016001000002400'),
(89, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Лесная', NULL, '0484521b-c371-3e15-018c-7bfd8f46df3d', '39016001000002500'),
(90, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Лесной проезд', NULL, '0484521b-c371-3e15-018c-7bfd8f46deb9', '39016001000016500'),
(91, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Летний переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfcd', '39016001000009200'),
(92, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Луговой переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df55', '39016001000018200'),
(93, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Майская', NULL, '0484521b-c371-3e15-018c-7bfd8f46de1d', '39016001000002600'),
(94, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Майский проезд', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfac', '39016001000009100'),
(95, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Малиновый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfca', '39016001000016600'),
(96, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Малый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de44', '39016001000011100'),
(97, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Маяковского', NULL, '0484521b-c371-3e15-018c-7bfd8f46de9e', '39016001000002900'),
(98, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Мирная', NULL, '0484521b-c371-3e15-018c-7bfd8f46de4d', '39016001000019800'),
(99, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Мирный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df67', '39016001000017900'),
(100, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Мичурина', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfc4', '39016001000003000'),
(101, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Молодежная', NULL, '0484521b-c371-3e15-018c-7bfd8f46ded1', '39016001000019900'),
(102, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Морской бульвар', NULL, '0484521b-c371-3e15-018c-7bfd8f46de35', '39016001000016700'),
(103, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Московская', NULL, '0484521b-c371-3e15-018c-7bfd8f46df0a', '39016001000003100'),
(104, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Нахимова', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfd6', '39016001000003200'),
(105, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Некрасова', NULL, '0484521b-c371-3e15-018c-7bfd8f46de14', '39016001000003300'),
(106, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Новая', NULL, '0484521b-c371-3e15-018c-7bfd8f46dff7', '39016001000003400'),
(107, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Озерная', NULL, '0484521b-c371-3e15-018c-7bfd8f46df19', '39016001000011200'),
(108, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Озерный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de4a', '39016001000011400'),
(109, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Озерный проезд', NULL, '0484521b-c371-3e15-018c-7bfd8f46de5c', '39016001000011300'),
(110, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Окружная', NULL, '0484521b-c371-3e15-018c-7bfd8f46de1a', '39016001000016800'),
(111, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Октябрьская', NULL, '0484521b-c371-3e15-018c-7bfd8f46dec2', '39016001000003500'),
(112, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Олимпийский бульвар', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfc7', '39016001000012600'),
(113, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Ольховая', NULL, '0484521b-c371-3e15-018c-7bfd8f46df76', '39016001000008100'),
(114, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Ольховый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46ddfc', '39016001000008200'),
(115, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Ореховая', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfe2', '39016001000016900'),
(116, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Островского', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfa6', '39016001000003600'),
(117, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Отрадная', NULL, '0484521b-c371-3e15-018c-7bfd8f46df6d', '39016001000019700'),
(118, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Парковая', NULL, '0484521b-c371-3e15-018c-7bfd8f46ddf9', '39016001000003700'),
(119, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Партизанский переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df7c', '39016001000008300'),
(120, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Первомайская', NULL, '0484521b-c371-3e15-018c-7bfd8f46ded7', '39016001000013400'),
(121, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Первомайский переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46ddd8', '39016001000003900'),
(122, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Песочная', NULL, '0484521b-c371-3e15-018c-7bfd8f46de32', '39016001000004000'),
(123, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Пионерская', NULL, '0484521b-c371-3e15-018c-7bfd8f46df16', '39016001000004100'),
(124, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Победы проспект', NULL, '0484521b-c371-3e15-018c-7bfd8f46ded4', '39016001000004200'),
(125, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Подгорная', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfd9', '39016001000004300'),
(126, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Почтовая', NULL, '0484521b-c371-3e15-018c-7bfd8f46dee9', '39016001000004400'),
(127, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Преображенского', NULL, '0484521b-c371-3e15-018c-7bfd8f46de77', '39016001000004500'),
(128, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Прибалтийский переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df25', '39016001000010400'),
(129, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Прибой гаражно-строительный кооп.', NULL, '0484521b-c371-3e15-018c-7bfd8f46defb', '39016001000018600'),
(130, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Пригородная', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfb2', '39016001000004600'),
(131, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Приморская', NULL, '0484521b-c371-3e15-018c-7bfd8f46de3e', '39016001000004700'),
(132, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Прозрачный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df91', '39016001000020400'),
(133, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Прохладная', NULL, '0484521b-c371-3e15-018c-7bfd8f46de50', '39016001000004900'),
(134, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Пушкина', NULL, '0484521b-c371-3e15-018c-7bfd8f46df31', '39016001000005100'),
(135, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Радуга территория снт', NULL, '0484521b-c371-3e15-018c-7bfd8f46deec', '39016001000002700'),
(136, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Радужная', NULL, '0484521b-c371-3e15-018c-7bfd8f46de7d', '39016001000017000'),
(137, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Разина', NULL, '0484521b-c371-3e15-018c-7bfd8f46df2b', '39016001000005200'),
(138, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Рябиновая', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfbb', '39016001000017600'),
(139, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Рябиновый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de8f', '39016001000012000'),
(140, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Садовая', NULL, '0484521b-c371-3e15-018c-7bfd8f46de05', '39016001000005300'),
(141, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Санаторная', NULL, '0484521b-c371-3e15-018c-7bfd8f46df52', '39016001000012100'),
(142, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Светлая', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfd3', '39016001000019300'),
(143, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Светлый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46deaa', '39016001000018100'),
(144, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Северная линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfee', '39016001000023200'),
(145, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Северный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46deb6', '39016001000008600'),
(146, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Северный проезд', NULL, '0484521b-c371-3e15-018c-7bfd8f46df37', '39016001000020500'),
(147, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Сибирский переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df34', '39016001000005500'),
(148, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Сиреневый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df01', '39016001000005600'),
(149, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Сказочника Гофмана переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de98', '39016001000012500'),
(150, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Славянская', NULL, '0484521b-c371-3e15-018c-7bfd8f46de02', '39016001000011500'),
(151, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Славянский переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de0e', '39016001000011600'),
(152, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Советская', NULL, '0484521b-c371-3e15-018c-7bfd8f46df10', '39016001000010500'),
(153, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Согласия переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46deb0', '39016001000018000'),
(154, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Солнечная', NULL, '0484521b-c371-3e15-018c-7bfd8f46dea7', '39016001000017100'),
(155, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Сосновая', NULL, '0484521b-c371-3e15-018c-7bfd8f46def8', '39016001000009400'),
(156, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Сосновый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46ddff', '39016001000009700'),
(157, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Спортивная', NULL, '0484521b-c371-3e15-018c-7bfd8f46decb', '39016001000018900'),
(158, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Спортивный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dffd', '39016001000018700'),
(159, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Средняя', NULL, '0484521b-c371-3e15-018c-7bfd8f46def2', '39016001000017200'),
(160, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Станционная', NULL, '0484521b-c371-3e15-018c-7bfd8f46df0d', '39016001000005700'),
(161, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Студенческая', NULL, '0484521b-c371-3e15-018c-7bfd8f46de6e', '39016001000012200'),
(162, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Счастливая', NULL, '0484521b-c371-3e15-018c-7bfd8f46df40', '39016001000017800'),
(163, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Таежный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de17', '39016001000005800'),
(164, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Тельмана', NULL, '0484521b-c371-3e15-018c-7bfd8f46df58', '39016001000005900'),
(165, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Тихая', NULL, '0484521b-c371-3e15-018c-7bfd8f46dea4', '39016001000006000'),
(166, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Тихомирова', NULL, '0484521b-c371-3e15-018c-7bfd8f46de2f', '39016001000006100'),
(167, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Токарева', NULL, '0484521b-c371-3e15-018c-7bfd8f46debc', '39016001000006200'),
(168, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Тургенева', NULL, '0484521b-c371-3e15-018c-7bfd8f46df43', '39016001000006300'),
(169, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Тюменская', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfdf', '39016001000011700'),
(170, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Тюменский переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46df73', '39016001000011800'),
(171, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Фруктовая', NULL, '0484521b-c371-3e15-018c-7bfd8f46df97', '39016001000006400'),
(172, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Фруктовый переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dead', '39016001000013200'),
(173, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Фрунзе', NULL, '0484521b-c371-3e15-018c-7bfd8f46de8c', '39016001000006600'),
(174, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Хвойный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46de47', '39016001000017300'),
(175, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Хрустальная', NULL, '0484521b-c371-3e15-018c-7bfd8f46defe', '39016001000019100'),
(176, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Хуторская', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfa9', '39016001000008500'),
(177, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Хуторской переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfb8', '39016001000011900'),
(178, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Цветочная', NULL, '0484521b-c371-3e15-018c-7bfd8f46df3a', '39016001000020600'),
(179, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Центральная линия (Радуга тер. СНТ)', NULL, '0484521b-c371-3e15-018c-7bfd8f46de62', '39016001000023100'),
(180, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Центральная площадь', NULL, '0484521b-c371-3e15-018c-7bfd8f46de80', '39016001000009300'),
(181, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Штрауса', NULL, '0484521b-c371-3e15-018c-7bfd8f46df2e', '39016001000006800'),
(182, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Южная', NULL, '0484521b-c371-3e15-018c-7bfd8f46df1c', '39016001000020000'),
(183, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Южный проезд', NULL, '0484521b-c371-3e15-018c-7bfd8f46de29', '39016001000017400'),
(184, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Яблоневая', NULL, '0484521b-c371-3e15-018c-7bfd8f46de74', '39016001000007000'),
(185, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Ягодный переулок', NULL, '0484521b-c371-3e15-018c-7bfd8f46dfa0', '39016001000007100'),
(186, 'a65dacbc-acfa-4ec7-9435-e9300a063aff', 'Ясных зорь', NULL, '0484521b-c371-3e15-018c-7bfd8f46deb3', '39016001000018300');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `code`, `status`) VALUES
(1, 'Super slims', 'super-slims', 1),
(2, 'Люкс', 'lux', 1),
(3, 'Standart', 'standart', 1),
(4, 'Compact', 'compact', 1),
(5, 'w', 'w', 1),
(6, 'Оригинальные', 'original', 1),
(7, 'Super Slims Compact', 'Super Slims Compact', 1),
(8, 'Slims Standard', 'Slims Standard', 1),
(9, 'Slims', 'Slims', 1),
(10, 'King size', 'King size', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `role_id` int NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketingoptin` tinyint(1) DEFAULT '0',
  `date_of_birth` date DEFAULT NULL,
  `device_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `email_verified_at`, `password`, `is_admin`, `role_id`, `remember_token`, `picture`, `phone`, `address`, `city`, `region`, `zip`, `country`, `marketingoptin`, `date_of_birth`, `device_key`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Админ', NULL, 'btf101@yandex.ru', NULL, '$2y$10$P/x20Gv9GjEZRhBeDsRTiePPc2t40pHLkWOD3tu.Ivu0/M9phUbua', 1, 2, 'jh7eo8AXBGdOd1WZamktYHnV9YrCUpgoyAwZSJdAOPJh16uZB7MY9Ph2Jjhn', NULL, NULL, NULL, NULL, NULL, NULL, 'RU', 1, NULL, 'dW2fSmEuwr8NOYejD_Xh1U:APA91bHqROotCKwEemSLg7cC0B_ycOmsoCConJta0sGwLB1A93_lo9UOkTNKxNNRgKHVTDKraVlFxpR8PJ74hKqTCioAEbUPr_GYCAw904n-2GYUdI3v8LCriG7WNiFZtFlb_yMO8rrM', 1, '2023-11-20 05:41:33', '2024-11-16 07:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--
-- Creation: Dec 03, 2024 at 11:24 AM
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `good_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `good_id`) VALUES
(6, 1, 148),
(8, 1, 151),
(9, 1, 156),
(10, 1, 155),
(11, 1, 152),
(12, 1, 153),
(13, 1, 154),
(14, 1, 150),
(15, 1, 138),
(16, 1, 143),
(17, 1, 139);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);
ALTER TABLE `categories` ADD FULLTEXT KEY `categories_text_fulltext` (`description`);

--
-- Indexes for table `category_good`
--
ALTER TABLE `category_good`
  ADD KEY `category_good_category_id_foreign` (`category_id`),
  ADD KEY `category_good_good_id_foreign` (`good_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `delivery_methods`
--
ALTER TABLE `delivery_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_good`
--
ALTER TABLE `feature_good`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_picture`
--
ALTER TABLE `gallery_picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `picture_id` (`picture_id`),
  ADD KEY `gallery_id` (`gallery_id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_slug_index` (`slug`),
  ADD KEY `goods_brand_id_foreign` (`brand_id`);
ALTER TABLE `goods` ADD FULLTEXT KEY `goods_text_fulltext` (`description`);

--
-- Indexes for table `good_colors`
--
ALTER TABLE `good_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `good_colors_good_id_foreign` (`good_id`),
  ADD KEY `good_colors_color_id_foreign` (`color_id`);

--
-- Indexes for table `good_order`
--
ALTER TABLE `good_order`
  ADD KEY `good_order_order_id_foreign` (`order_id`),
  ADD KEY `good_order_good_id_foreign` (`good_id`);

--
-- Indexes for table `good_ratings`
--
ALTER TABLE `good_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `good_ratings_good_id_foreign` (`good_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `modifiers`
--
ALTER TABLE `modifiers`
  ADD KEY `modifiers_id_index` (`id`),
  ADD KEY `modifiers_good_id_index` (`good_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_good_id_foreign` (`good_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_slug_index` (`slug`);
ALTER TABLE `pages` ADD FULLTEXT KEY `pages_text_fulltext` (`text`);
ALTER TABLE `pages` ADD FULLTEXT KEY `pages_custom_fulltext` (`custom`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_good`
--
ALTER TABLE `picture_good`
  ADD KEY `good_id` (`good_id`),
  ADD KEY `image_id` (`picture_id`) USING BTREE;

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_author_id_index` (`user_id`);
ALTER TABLE `posts` ADD FULLTEXT KEY `posts_text_fulltext` (`body`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `rubrics`
--
ALTER TABLE `rubrics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_slug_index` (`slug`);
ALTER TABLE `services` ADD FULLTEXT KEY `services_body_fulltext` (`body`);
ALTER TABLE `services` ADD FULLTEXT KEY `services_custom_fulltext` (`custom`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `streets`
--
ALTER TABLE `streets`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `delivery_methods`
--
ALTER TABLE `delivery_methods`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feature_good`
--
ALTER TABLE `feature_good`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_picture`
--
ALTER TABLE `gallery_picture`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `good_colors`
--
ALTER TABLE `good_colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `good_ratings`
--
ALTER TABLE `good_ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rubrics`
--
ALTER TABLE `rubrics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `streets`
--
ALTER TABLE `streets`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_good`
--
ALTER TABLE `category_good`
  ADD CONSTRAINT `category_good_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_good_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`);

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Constraints for table `good_colors`
--
ALTER TABLE `good_colors`
  ADD CONSTRAINT `good_colors_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `good_colors_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `good_order`
--
ALTER TABLE `good_order`
  ADD CONSTRAINT `good_order_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`),
  ADD CONSTRAINT `good_order_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `good_ratings`
--
ALTER TABLE `good_ratings`
  ADD CONSTRAINT `good_ratings_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_good_id_foreign` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
