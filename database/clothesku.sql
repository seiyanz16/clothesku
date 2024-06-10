-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 03:13 PM
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
-- Database: `clothesku`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Nike', 'nike', 1, '2024-03-31 14:16:27', '2024-03-31 14:16:27'),
(6, 'Kenzo', 'kenzo', 1, '2024-04-03 01:04:22', '2024-04-03 01:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `showHome` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(25, 'Women', 'women', '25-1712045882.jpg', 1, 'yes', '2024-04-01 04:32:22', '2024-04-02 01:18:03'),
(26, 'Men', 'men', '26-1712045844.jpg', 1, 'yes', '2024-04-01 04:32:47', '2024-04-02 01:17:25'),
(27, 'Kids', 'kids', '27-1712045805.jpg', 1, 'yes', '2024-04-01 17:32:53', '2024-04-02 01:16:46'),
(28, 'Unisex', 'unisex', '28-1712045734.jpg', 1, 'yes', '2024-04-01 17:39:35', '2024-04-02 01:15:35'),
(29, 'Dummy Category', 'dummy-category', NULL, 0, 'no', '2024-04-01 21:51:55', '2024-04-01 23:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'US', NULL, NULL),
(2, 'Canada', 'CA', NULL, NULL),
(3, 'Afghanistan', 'AF', NULL, NULL),
(4, 'Albania', 'AL', NULL, NULL),
(5, 'Algeria', 'DZ', NULL, NULL),
(6, 'American Samoa', 'AS', NULL, NULL),
(7, 'Andorra', 'AD', NULL, NULL),
(8, 'Angola', 'AO', NULL, NULL),
(9, 'Anguilla', 'AI', NULL, NULL),
(10, 'Antarctica', 'AQ', NULL, NULL),
(11, 'Antigua and/or Barbuda', 'AG', NULL, NULL),
(12, 'Argentina', 'AR', NULL, NULL),
(13, 'Armenia', 'AM', NULL, NULL),
(14, 'Aruba', 'AW', NULL, NULL),
(15, 'Australia', 'AU', NULL, NULL),
(16, 'Austria', 'AT', NULL, NULL),
(17, 'Azerbaijan', 'AZ', NULL, NULL),
(18, 'Bahamas', 'BS', NULL, NULL),
(19, 'Bahrain', 'BH', NULL, NULL),
(20, 'Bangladesh', 'BD', NULL, NULL),
(21, 'Barbados', 'BB', NULL, NULL),
(22, 'Belarus', 'BY', NULL, NULL),
(23, 'Belgium', 'BE', NULL, NULL),
(24, 'Belize', 'BZ', NULL, NULL),
(25, 'Benin', 'BJ', NULL, NULL),
(26, 'Bermuda', 'BM', NULL, NULL),
(27, 'Bhutan', 'BT', NULL, NULL),
(28, 'Bolivia', 'BO', NULL, NULL),
(29, 'Bosnia and Herzegovina', 'BA', NULL, NULL),
(30, 'Botswana', 'BW', NULL, NULL),
(31, 'Bouvet Island', 'BV', NULL, NULL),
(32, 'Brazil', 'BR', NULL, NULL),
(33, 'British lndian Ocean Territory', 'IO', NULL, NULL),
(34, 'Brunei Darussalam', 'BN', NULL, NULL),
(35, 'Bulgaria', 'BG', NULL, NULL),
(36, 'Burkina Faso', 'BF', NULL, NULL),
(37, 'Burundi', 'BI', NULL, NULL),
(38, 'Cambodia', 'KH', NULL, NULL),
(39, 'Cameroon', 'CM', NULL, NULL),
(40, 'Cape Verde', 'CV', NULL, NULL),
(41, 'Cayman Islands', 'KY', NULL, NULL),
(42, 'Central African Republic', 'CF', NULL, NULL),
(43, 'Chad', 'TD', NULL, NULL),
(44, 'Chile', 'CL', NULL, NULL),
(45, 'China', 'CN', NULL, NULL),
(46, 'Christmas Island', 'CX', NULL, NULL),
(47, 'Cocos (Keeling) Islands', 'CC', NULL, NULL),
(48, 'Colombia', 'CO', NULL, NULL),
(49, 'Comoros', 'KM', NULL, NULL),
(50, 'Congo', 'CG', NULL, NULL),
(51, 'Cook Islands', 'CK', NULL, NULL),
(52, 'Costa Rica', 'CR', NULL, NULL),
(53, 'Croatia (Hrvatska)', 'HR', NULL, NULL),
(54, 'Cuba', 'CU', NULL, NULL),
(55, 'Cyprus', 'CY', NULL, NULL),
(56, 'Czech Republic', 'CZ', NULL, NULL),
(57, 'Democratic Republic of Congo', 'CD', NULL, NULL),
(58, 'Denmark', 'DK', NULL, NULL),
(59, 'Djibouti', 'DJ', NULL, NULL),
(60, 'Dominica', 'DM', NULL, NULL),
(61, 'Dominican Republic', 'DO', NULL, NULL),
(62, 'East Timor', 'TP', NULL, NULL),
(63, 'Ecudaor', 'EC', NULL, NULL),
(64, 'Egypt', 'EG', NULL, NULL),
(65, 'El Salvador', 'SV', NULL, NULL),
(66, 'Equatorial Guinea', 'GQ', NULL, NULL),
(67, 'Eritrea', 'ER', NULL, NULL),
(68, 'Estonia', 'EE', NULL, NULL),
(69, 'Ethiopia', 'ET', NULL, NULL),
(70, 'Falkland Islands (Malvinas)', 'FK', NULL, NULL),
(71, 'Faroe Islands', 'FO', NULL, NULL),
(72, 'Fiji', 'FJ', NULL, NULL),
(73, 'Finland', 'FI', NULL, NULL),
(74, 'France', 'FR', NULL, NULL),
(75, 'France, Metropolitan', 'FX', NULL, NULL),
(76, 'French Guiana', 'GF', NULL, NULL),
(77, 'French Polynesia', 'PF', NULL, NULL),
(78, 'French Southern Territories', 'TF', NULL, NULL),
(79, 'Gabon', 'GA', NULL, NULL),
(80, 'Gambia', 'GM', NULL, NULL),
(81, 'Georgia', 'GE', NULL, NULL),
(82, 'Germany', 'DE', NULL, NULL),
(83, 'Ghana', 'GH', NULL, NULL),
(84, 'Gibraltar', 'GI', NULL, NULL),
(85, 'Greece', 'GR', NULL, NULL),
(86, 'Greenland', 'GL', NULL, NULL),
(87, 'Grenada', 'GD', NULL, NULL),
(88, 'Guadeloupe', 'GP', NULL, NULL),
(89, 'Guam', 'GU', NULL, NULL),
(90, 'Guatemala', 'GT', NULL, NULL),
(91, 'Guinea', 'GN', NULL, NULL),
(92, 'Guinea-Bissau', 'GW', NULL, NULL),
(93, 'Guyana', 'GY', NULL, NULL),
(94, 'Haiti', 'HT', NULL, NULL),
(95, 'Heard and Mc Donald Islands', 'HM', NULL, NULL),
(96, 'Honduras', 'HN', NULL, NULL),
(97, 'Hong Kong', 'HK', NULL, NULL),
(98, 'Hungary', 'HU', NULL, NULL),
(99, 'Iceland', 'IS', NULL, NULL),
(100, 'India', 'IN', NULL, NULL),
(101, 'Indonesia', 'ID', NULL, NULL),
(102, 'Iran (Islamic Republic of)', 'IR', NULL, NULL),
(103, 'Iraq', 'IQ', NULL, NULL),
(104, 'Ireland', 'IE', NULL, NULL),
(106, 'Italy', 'IT', NULL, NULL),
(107, 'Ivory Coast', 'CI', NULL, NULL),
(108, 'Jamaica', 'JM', NULL, NULL),
(109, 'Japan', 'JP', NULL, NULL),
(110, 'Jordan', 'JO', NULL, NULL),
(111, 'Kazakhstan', 'KZ', NULL, NULL),
(112, 'Kenya', 'KE', NULL, NULL),
(113, 'Kiribati', 'KI', NULL, NULL),
(114, 'Korea, Democratic People\'s Republic of', 'KP', NULL, NULL),
(115, 'South Korea', 'KR', NULL, NULL),
(116, 'Kuwait', 'KW', NULL, NULL),
(117, 'Kyrgyzstan', 'KG', NULL, NULL),
(118, 'Lao People\'s Democratic Republic', 'LA', NULL, NULL),
(119, 'Latvia', 'LV', NULL, NULL),
(120, 'Lebanon', 'LB', NULL, NULL),
(121, 'Lesotho', 'LS', NULL, NULL),
(122, 'Liberia', 'LR', NULL, NULL),
(123, 'Libyan Arab Jamahiriya', 'LY', NULL, NULL),
(124, 'Liechtenstein', 'LI', NULL, NULL),
(125, 'Lithuania', 'LT', NULL, NULL),
(126, 'Luxembourg', 'LU', NULL, NULL),
(127, 'Macau', 'MO', NULL, NULL),
(128, 'Macedonia', 'MK', NULL, NULL),
(129, 'Madagascar', 'MG', NULL, NULL),
(130, 'Malawi', 'MW', NULL, NULL),
(131, 'Malaysia', 'MY', NULL, NULL),
(132, 'Maldives', 'MV', NULL, NULL),
(133, 'Mali', 'ML', NULL, NULL),
(134, 'Malta', 'MT', NULL, NULL),
(135, 'Marshall Islands', 'MH', NULL, NULL),
(136, 'Martinique', 'MQ', NULL, NULL),
(137, 'Mauritania', 'MR', NULL, NULL),
(138, 'Mauritius', 'MU', NULL, NULL),
(139, 'Mayotte', 'TY', NULL, NULL),
(140, 'Mexico', 'MX', NULL, NULL),
(141, 'Micronesia, Federated States of', 'FM', NULL, NULL),
(142, 'Moldova, Republic of', 'MD', NULL, NULL),
(143, 'Monaco', 'MC', NULL, NULL),
(144, 'Mongolia', 'MN', NULL, NULL),
(145, 'Montserrat', 'MS', NULL, NULL),
(146, 'Morocco', 'MA', NULL, NULL),
(147, 'Mozambique', 'MZ', NULL, NULL),
(148, 'Myanmar', 'MM', NULL, NULL),
(149, 'Namibia', 'NA', NULL, NULL),
(150, 'Nauru', 'NR', NULL, NULL),
(151, 'Nepal', 'NP', NULL, NULL),
(152, 'Netherlands', 'NL', NULL, NULL),
(153, 'Netherlands Antilles', 'AN', NULL, NULL),
(154, 'New Caledonia', 'NC', NULL, NULL),
(155, 'New Zealand', 'NZ', NULL, NULL),
(156, 'Nicaragua', 'NI', NULL, NULL),
(157, 'Niger', 'NE', NULL, NULL),
(158, 'Nigeria', 'NG', NULL, NULL),
(159, 'Niue', 'NU', NULL, NULL),
(160, 'Norfork Island', 'NF', NULL, NULL),
(161, 'Northern Mariana Islands', 'MP', NULL, NULL),
(162, 'Norway', 'NO', NULL, NULL),
(163, 'Oman', 'OM', NULL, NULL),
(164, 'Pakistan', 'PK', NULL, NULL),
(165, 'Palestine', 'PN', NULL, NULL),
(166, 'Panama', 'PA', NULL, NULL),
(167, 'Papua New Guinea', 'PG', NULL, NULL),
(168, 'Paraguay', 'PY', NULL, NULL),
(169, 'Peru', 'PE', NULL, NULL),
(170, 'Philippines', 'PH', NULL, NULL),
(171, 'Pitcairn', 'PN', NULL, NULL),
(172, 'Poland', 'PL', NULL, NULL),
(173, 'Portugal', 'PT', NULL, NULL),
(174, 'Puerto Rico', 'PR', NULL, NULL),
(175, 'Qatar', 'QA', NULL, NULL),
(176, 'Republic of South Sudan', 'SS', NULL, NULL),
(177, 'Reunion', 'RE', NULL, NULL),
(178, 'Romania', 'RO', NULL, NULL),
(179, 'Russian Federation', 'RU', NULL, NULL),
(180, 'Rwanda', 'RW', NULL, NULL),
(181, 'Saint Kitts and Nevis', 'KN', NULL, NULL),
(182, 'Saint Lucia', 'LC', NULL, NULL),
(183, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL),
(184, 'Samoa', 'WS', NULL, NULL),
(185, 'San Marino', 'SM', NULL, NULL),
(186, 'Sao Tome and Principe', 'ST', NULL, NULL),
(187, 'Saudi Arabia', 'SA', NULL, NULL),
(188, 'Senegal', 'SN', NULL, NULL),
(189, 'Serbia', 'RS', NULL, NULL),
(190, 'Seychelles', 'SC', NULL, NULL),
(191, 'Sierra Leone', 'SL', NULL, NULL),
(192, 'Singapore', 'SG', NULL, NULL),
(193, 'Slovakia', 'SK', NULL, NULL),
(194, 'Slovenia', 'SI', NULL, NULL),
(195, 'Solomon Islands', 'SB', NULL, NULL),
(196, 'Somalia', 'SO', NULL, NULL),
(197, 'South Africa', 'ZA', NULL, NULL),
(198, 'South Georgia South Sandwich Islands', 'GS', NULL, NULL),
(199, 'Spain', 'ES', NULL, NULL),
(200, 'Sri Lanka', 'LK', NULL, NULL),
(201, 'St. Helena', 'SH', NULL, NULL),
(202, 'St. Pierre and Miquelon', 'PM', NULL, NULL),
(203, 'Sudan', 'SD', NULL, NULL),
(204, 'Suriname', 'SR', NULL, NULL),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ', NULL, NULL),
(206, 'Swaziland', 'SZ', NULL, NULL),
(207, 'Sweden', 'SE', NULL, NULL),
(208, 'Switzerland', 'CH', NULL, NULL),
(209, 'Syrian Arab Republic', 'SY', NULL, NULL),
(210, 'Taiwan', 'TW', NULL, NULL),
(211, 'Tajikistan', 'TJ', NULL, NULL),
(212, 'Tanzania, United Republic of', 'TZ', NULL, NULL),
(213, 'Thailand', 'TH', NULL, NULL),
(214, 'Togo', 'TG', NULL, NULL),
(215, 'Tokelau', 'TK', NULL, NULL),
(216, 'Tonga', 'TO', NULL, NULL),
(217, 'Trinidad and Tobago', 'TT', NULL, NULL),
(218, 'Tunisia', 'TN', NULL, NULL),
(219, 'Turkey', 'TR', NULL, NULL),
(220, 'Turkmenistan', 'TM', NULL, NULL),
(221, 'Turks and Caicos Islands', 'TC', NULL, NULL),
(222, 'Tuvalu', 'TV', NULL, NULL),
(223, 'Uganda', 'UG', NULL, NULL),
(224, 'Ukraine', 'UA', NULL, NULL),
(225, 'United Arab Emirates', 'AE', NULL, NULL),
(226, 'United Kingdom', 'GB', NULL, NULL),
(227, 'United States minor outlying islands', 'UM', NULL, NULL),
(228, 'Uruguay', 'UY', NULL, NULL),
(229, 'Uzbekistan', 'UZ', NULL, NULL),
(230, 'Vanuatu', 'VU', NULL, NULL),
(231, 'Vatican City State', 'VA', NULL, NULL),
(232, 'Venezuela', 'VE', NULL, NULL),
(233, 'Vietnam', 'VN', NULL, NULL),
(234, 'Virgin Islands (British)', 'VG', NULL, NULL),
(235, 'Virgin Islands (U.S.)', 'VI', NULL, NULL),
(236, 'Wallis and Futuna Islands', 'WF', NULL, NULL),
(237, 'Western Sahara', 'EH', NULL, NULL),
(238, 'Yemen', 'YE', NULL, NULL),
(239, 'Yugoslavia', 'YU', NULL, NULL),
(240, 'Zaire', 'ZR', NULL, NULL),
(241, 'Zambia', 'ZM', NULL, NULL),
(242, 'Zimbabwe', 'ZW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartement` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartement`, `city`, `state`, `zip`, `created_at`, `updated_at`) VALUES
(1, 4, 'Vernon', 'Chwe', 'bonon@gmail.com', '32131234921', 101, 'Kp. Pos Citayam RT.04 RW.11 No.111', 'No. 123', 'Bogor', 'Jawa Barat', '16921', '2024-04-06 18:05:21', '2024-04-13 00:29:50'),
(2, 3, 'Muhamad', 'Ali', 'ali@gmail.com', '01232191231', 101, 'Kp. Citayam RT.05/RW.19 No. 182', 'No. 123', 'Bogor', 'Jawa Barat', '16921', '2024-04-07 21:37:10', '2024-06-02 02:43:11'),
(3, 5, 'Joshua', 'Hong', 'josh@gmail.com', '088888888888', 1, '123 Street', 'Wilco Apartement, No. 115', 'Los Angles', 'California', '12345', '2024-04-12 10:31:56', '2024-04-17 16:07:01'),
(4, 1, 'Zaskia', 'Fitri Sholehah', 'zaskia@gmail.com', '089639207274', 101, 'Kp. Pos Citayam RT.04 RW.11 No.111', 'No. 111', 'Bogor', 'Jawa Barat', '16921', '2024-04-14 00:22:45', '2024-04-14 00:22:45'),
(5, 6, 'Minghao', 'Xu', 'haosaranghao@gmail.com', '021393192102', 101, 'Jl. Rawa Panjang', 'No. 15', 'Bogor', 'Jawa Barat', '16921', '2024-04-15 13:38:41', '2024-04-17 15:47:58'),
(6, 12, 'Jihoon', 'Lee', 'woozi@gmail.com', '01232191231', 115, 'Kp. Pos Citayam RT.04 RW.11 No.111', 'No. 123', 'Bogor', 'Jawa Barat', '16921', '2024-06-03 07:13:15', '2024-06-03 07:13:15'),
(7, 9, 'Jeonghan', 'Yoon', 'jeonghan@gmail.com', '1234556612', 115, 'Block 123, Gangnam, Seoul', NULL, 'Gangnam', 'Seoul', '23421', '2024-06-08 06:14:43', '2024-06-08 06:14:43'),
(8, 17, 'Kohaku', 'Oukawa', 'oukohaku@gmail.com', '2312123121', 109, 'Abbey Road No. 57', 'Wilco Apartement, No. 115', 'Nogizaka', 'Nagasaki', '16921', '2024-06-08 06:24:25', '2024-06-08 06:24:25'),
(9, 8, 'Seungcheol', 'Choi', 'scoups@gmail.com', '01232191231', 115, 'Oppa Gangnam Style, Lalali Street 17', 'No. 234', 'Incheon', 'Incheon', '21323', '2024-06-08 10:42:52', '2024-06-08 10:42:52'),
(10, 10, 'Junhui', 'Wein', 'jun@gmail.com', '1232142124', 45, 'Nihaoma, Ni ai Wo St. 201', 'Mixue Apartement, No. 115', 'Shanghai', 'Shanghai', '21212', '2024-06-08 10:45:49', '2024-06-08 10:45:49'),
(11, 11, 'Wonwoo', 'Jeon', 'wonwoo@gmail.com', '02131249111', 115, 'GAM3 BO1, Monster St. 21', 'IF I Apart, Unit 821', 'Uichang-gu', 'Changwon-si', '212312', '2024-06-08 10:49:05', '2024-06-08 10:49:05'),
(12, 7, 'Soonyoung', 'Kwon', 'hoshi@gmail.com', '092141212211', 115, 'Horangi Power, Spider Street', 'Tiger Apartement, Unit 213', 'Namyangju-si', 'Gyeonggi', '21232', '2024-06-08 11:16:02', '2024-06-08 11:16:02'),
(13, 13, 'Mingyu', 'Kim', 'mingyu@gmail.com', '065131121294', 115, 'Migoo, Fire Street 27', 'Trauma Apartement, Unit 202', 'Dongan-gu', 'Anyang-si', '31343', '2024-06-08 11:31:09', '2024-06-08 11:31:09'),
(14, 14, 'Seokmin', 'Lee', 'dokyeom@gmail.com', '093213123213', 101, 'Kp. Missed Connection, RT. 21 RW. 12', NULL, 'Pancoran', 'Surabaya', '31922', '2024-06-08 11:33:53', '2024-06-08 11:33:53'),
(15, 15, 'Seungkwan', 'Boo', 'seungkwan@gmail.com', '087512321229', 101, 'Dandelion Village, Blok. 2 No. 121', NULL, 'Cipayung', 'Depok', '24012', '2024-06-08 11:35:49', '2024-06-08 11:35:49'),
(16, 16, 'Chan', 'Lee', 'dino@gmail.com', '084122321333', 109, 'Don\'t tell me wait, Dino Street', 'Kosan Pi Cheolin No. 1', 'Yokohama', 'Yokohama', '57132', '2024-06-08 11:38:07', '2024-06-08 11:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupons`
--

CREATE TABLE `discount_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `max_user` int(11) DEFAULT NULL,
  `type` enum('percent','fixed') NOT NULL DEFAULT 'fixed',
  `discount_amount` double(10,2) NOT NULL,
  `min_amount` double(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_coupons`
--

INSERT INTO `discount_coupons` (`id`, `code`, `name`, `max_uses`, `max_user`, `type`, `discount_amount`, `min_amount`, `status`, `start`, `end`, `created_at`, `updated_at`) VALUES
(2, 'EID2024', 'Eid Mubarak', 10, NULL, 'fixed', 10.00, 500.00, 1, '2024-04-09 08:00:27', '2024-04-30 07:27:35', '2024-04-08 17:27:41', '2024-04-17 15:50:31'),
(3, 'BACK2SCHOOL', 'Back to School Coupon', 2, NULL, 'percent', 10.00, 800.00, 1, '2024-04-09 08:00:11', '2024-04-27 08:13:20', '2024-04-08 18:13:24', '2024-04-12 02:59:17'),
(4, 'NEWMEMBER', 'New Member Coupon', 1, 1, 'fixed', 100.00, NULL, 1, '2024-04-15 13:39:55', '2024-04-30 13:37:57', '2024-04-15 06:38:38', '2024-04-15 06:38:38'),
(5, 'COBA', 'Coupon Coba', 5, NULL, 'fixed', 50.00, 150.00, 1, '2024-04-18 07:00:34', '2024-07-18 06:36:39', '2024-04-17 23:36:50', '2024-06-02 03:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_29_223640_create_categories_table', 2),
(6, '2024_03_30_120949_create_temp_images_table', 3),
(7, '2024_03_31_053137_create_sub_categories_table', 4),
(8, '2024_03_31_120006_create_brands_table', 5),
(13, '2024_03_31_133336_create_products_table', 6),
(14, '2024_03_31_135804_create_product_images_table', 6),
(15, '2024_04_06_155249_create_countries_table', 7),
(16, '2024_04_06_161817_create_orders_table', 8),
(17, '2024_04_06_161837_create_order_items_table', 8),
(18, '2024_04_06_161900_create_customer_addresses_table', 8),
(19, '2024_04_07_030450_create_shipping_charges_table', 9),
(20, '2024_04_08_044536_create_discount_coupons_table', 10),
(21, '2024_04_13_082037_create_wishlists_table', 11),
(22, '2024_04_14_090210_create_pages_table', 12),
(23, '2024_04_14_161414_create_product_ratings_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `shipping` double(10,2) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_code_id` int(11) DEFAULT NULL,
  `discount` double(10,2) DEFAULT NULL,
  `grand_total` double(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'cod',
  `card_number` int(11) DEFAULT NULL,
  `payment_status` enum('paid','not_paid') NOT NULL DEFAULT 'not_paid',
  `status` enum('pending','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `shipped_date` datetime DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartement` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `user_id`, `subtotal`, `shipping`, `coupon_code`, `coupon_code_id`, `discount`, `grand_total`, `payment_method`, `card_number`, `payment_status`, `status`, `shipped_date`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartement`, `city`, `state`, `zip`, `notes`, `created_at`, `updated_at`) VALUES
(48, '#ORD-00001', 4, 100.00, 20.00, NULL, NULL, 0.00, 120.00, 'transfer', 12345678, 'paid', 'delivered', '2024-04-17 11:39:17', 'Vernon', 'Chwe', 'bonon@gmail.com', '021393192102', 101, 'Kp. Pos Citayam RT.04 RW.11 No.111', 'No. 123', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-04-17 04:16:13', '2024-04-17 04:39:26'),
(50, '#ORD-00002', 3, 400.00, 20.00, 'NEWMEMBER', 4, 100.00, 320.00, 'cod', NULL, 'not_paid', 'delivered', '2024-04-18 11:41:17', 'Muhamad', 'Ali', 'ali@gmail.com', '01232191231', 101, 'Dummy Dummy Dummy Dummy Dummy Dummy Dummy Dummy', 'No. 123', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-04-17 04:40:40', '2024-04-17 04:41:35'),
(51, '#ORD-00003', 5, 460.00, 30.00, NULL, NULL, 0.00, 490.00, 'transfer', 12345678, 'paid', 'shipped', NULL, 'Joshua', 'Hong', 'josh@gmail.com', '088888888888', 1, '123 Street', 'Wilco Apartement, No. 115', 'Los Angles', 'California', '12345', NULL, '2024-04-17 05:01:18', '2024-04-17 05:05:02'),
(52, '#ORD-00004', 6, 550.00, 40.00, NULL, NULL, 0.00, 590.00, 'transfer', 12345678, 'paid', 'delivered', '2024-04-18 22:48:24', 'Minghao', 'Xu', 'haosaranghao@gmail.com', '021393192102', 101, 'Jl. Rawa Panjang', 'No. 15', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-04-17 15:45:17', '2024-04-17 15:48:33'),
(53, '#ORD-00005', 5, 1040.00, 30.00, 'EID2024', 2, 10.00, 1060.00, 'transfer', 23145611, 'paid', 'delivered', '2024-04-18 23:00:00', 'Joshua', 'Hong', 'josh@gmail.com', '088888888888', 1, '123 Street', 'Wilco Apartement, No. 115', 'Los Angles', 'California', '12345', NULL, '2024-04-17 15:58:57', '2024-04-17 16:00:06'),
(54, '#ORD-00006', 5, 200.00, 30.00, NULL, NULL, 0.00, 230.00, 'cod', NULL, 'paid', 'delivered', '2024-04-18 06:19:50', 'Joshua', 'Hong', 'josh@gmail.com', '088888888888', 1, '123 Street', 'Wilco Apartement, No. 115', 'Los Angles', 'California', '12345', NULL, '2024-04-17 16:08:07', '2024-04-17 23:20:00'),
(55, '#ORD-00007', 5, 300.00, 30.00, NULL, NULL, 0.00, 330.00, 'transfer', 56789345, 'paid', 'pending', NULL, 'Joshua', 'Hong', 'josh@gmail.com', '088888888888', 1, '123 Street', 'Wilco Apartement, No. 115', 'Los Angles', 'California', '12345', NULL, '2024-04-17 22:52:28', '2024-04-17 22:52:28'),
(57, '#ORD-00008', 6, 150.00, 20.00, NULL, NULL, 0.00, 170.00, 'cod', NULL, 'paid', 'delivered', '2024-04-18 06:28:00', 'Minghao', 'Xu', 'haosaranghao@gmail.com', '021393192102', 101, 'Jl. Rawa Panjang', 'No. 15', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-04-17 23:24:27', '2024-04-17 23:28:12'),
(58, '#ORD-00009', 6, 150.00, 20.00, NULL, NULL, 0.00, 170.00, 'cod', NULL, 'paid', 'delivered', '2024-04-19 06:45:08', 'Minghao', 'Xu', 'haosaranghao@gmail.com', '021393192102', 101, 'Jl. Rawa Panjang', 'No. 15', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-04-17 23:44:08', '2024-04-17 23:45:43'),
(59, '#ORD-00010', 3, 300.00, 20.00, 'COBA', 5, 50.00, 270.00, 'transfer', 12345678, 'not_paid', 'cancelled', NULL, 'Muhamad', 'Ali', 'ali@gmail.com', '01232191231', 101, 'Dummy Dummy Dummy Dummy Dummy Dummy Dummy Dummy', 'No. 123', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-04-19 00:49:58', '2024-06-03 05:11:59'),
(60, '#ORD-00011', 3, 670.00, 20.00, 'COBA', 5, 50.00, 640.00, 'cod', NULL, 'not_paid', 'cancelled', NULL, 'Muhamad', 'Ali', 'ali@gmail.com', '01232191231', 101, 'Dummy Dummy Dummy Dummy Dummy Dummy Dummy Dummy', 'No. 123', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-04-19 01:46:34', '2024-06-02 12:55:31'),
(61, '#ORD-00012', 4, 200.00, 20.00, 'COBA', 5, 50.00, 170.00, 'transfer', 12345678, 'paid', 'shipped', '2024-06-07 11:42:36', 'Vernon', 'Chwe', 'bonon@gmail.com', '32131234921', 101, 'Kp. Pos Citayam RT.04 RW.11 No.111', 'No. 123', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-04-19 22:48:31', '2024-06-07 04:42:50'),
(70, '#ORD-00013', 3, 100.00, 20.00, NULL, NULL, 0.00, 120.00, 'transfer', 123456789, 'paid', 'delivered', '2024-06-02 19:53:28', 'Muhamad', 'Ali', 'ali@gmail.com', '01232191231', 101, 'Dummy Dummy Dummy Dummy Dummy Dummy Dummy Dummy', 'No. 123', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-05-01 10:09:47', '2024-06-02 12:54:26'),
(71, '#ORD-00014', 3, 400.00, 20.00, NULL, NULL, 0.00, 420.00, 'transfer', 12345678, 'paid', 'cancelled', NULL, 'Muhamad', 'Ali', 'ali@gmail.com', '01232191231', 101, 'Dummy Dummy Dummy Dummy Dummy Dummy Dummy Dummy', 'No. 123', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-05-03 23:35:33', '2024-06-02 03:01:58'),
(72, '#ORD-00015', 6, 430.00, 20.00, NULL, NULL, 0.00, 450.00, 'cod', NULL, 'paid', 'delivered', '2024-06-02 08:34:07', 'Minghao', 'Xu', 'haosaranghao@gmail.com', '021393192102', 101, 'Jl. Rawa Panjang', 'No. 15', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-05-25 16:16:29', '2024-06-02 01:34:16'),
(73, '#ORD-00016', 5, 120.00, 30.00, NULL, NULL, 0.00, 150.00, 'transfer', 123456789, 'paid', 'cancelled', NULL, 'Joshua', 'Hong', 'josh@gmail.com', '088888888888', 1, '123 Street', 'Wilco Apartement, No. 115', 'Los Angles', 'California', '12345', NULL, '2024-05-27 07:07:20', '2024-06-01 06:25:11'),
(74, '#ORD-00017', 3, 430.00, 20.00, NULL, NULL, 0.00, 450.00, 'cod', NULL, 'paid', 'delivered', '2024-06-01 13:24:10', 'Muhamad', 'Ali', 'ali@gmail.com', '01232191231', 101, 'Dummy Dummy Dummy Dummy Dummy Dummy Dummy Dummy', 'No. 123', 'Bogor', 'Jawa Barat', '16921', 'Deket Bakso Mancung', '2024-06-01 03:16:28', '2024-06-02 03:00:50'),
(75, '#ORD-00018', 12, 207.00, 50.00, NULL, NULL, 0.00, 257.00, 'transfer', 12345678, 'paid', 'delivered', NULL, 'Jihoon', 'Lee', 'woozi@gmail.com', '01232191231', 115, 'Kp. Pos Citayam RT.04 RW.11 No.111', 'No. 123', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-06-03 07:13:16', '2024-06-03 07:19:46'),
(76, '#ORD-00019', 12, 207.00, 25.00, 'COBA', 5, 50.00, 182.00, 'cod', NULL, 'paid', 'shipped', '2024-06-08 13:11:56', 'Jihoon', 'Lee', 'woozi@gmail.com', '01232191231', 115, 'Kp. Pos Citayam RT.04 RW.11 No.111', 'No. 123', 'Bogor', 'Jawa Barat', '16921', NULL, '2024-06-07 02:47:36', '2024-06-07 06:12:02'),
(77, '#ORD-00020', 9, 100.00, 25.00, NULL, NULL, 0.00, 125.00, 'transfer', 122345671, 'paid', 'pending', NULL, 'Jeonghan', 'Yoon', 'jeonghan@gmail.com', '1234556612', 115, 'Block 123, Gangnam, Seoul', NULL, 'Gangnam', 'Seoul', '23421', NULL, '2024-06-08 06:15:39', '2024-06-08 06:15:39'),
(78, '#ORD-00021', 17, 240.00, 24.00, NULL, NULL, 0.00, 264.00, 'transfer', 212312312, 'paid', 'cancelled', NULL, 'Kohaku', 'Oukawa', 'oukohaku@gmail.com', '2312123121', 109, 'Abbey Road No. 57', 'Wilco Apartement, No. 115', 'Nogizaka', 'Nagasaki', '16921', NULL, '2024-06-08 06:25:13', '2024-06-08 06:38:56'),
(79, '#ORD-00022', 17, 200.00, 24.00, NULL, NULL, 0.00, 224.00, 'cod', NULL, 'not_paid', 'pending', NULL, 'Kohaku', 'Oukawa', 'oukohaku@gmail.com', '2312123121', 109, 'Abbey Road No. 57', 'Wilco Apartement, No. 115', 'Nogizaka', 'Nagasaki', '16921', NULL, '2024-06-08 06:42:52', '2024-06-08 06:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `size`, `color`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(50, 48, 15, 'Blazer Horanghae', 'M', 'Horanghae', 1, 100.00, 100.00, '2024-04-17 04:16:13', '2024-04-17 04:16:13'),
(51, 50, 19, 'Kenzo Sweater', 'XXL', 'White', 1, 400.00, 400.00, '2024-04-17 04:40:40', '2024-04-17 04:40:40'),
(52, 51, 21, 'Kenzo Vernon One Set', 'XL', 'Black', 1, 460.00, 460.00, '2024-04-17 05:01:18', '2024-04-17 05:01:18'),
(53, 52, 25, 'Hacheads Shirt Hoodie', 'M', 'Black', 1, 430.00, 430.00, '2024-04-17 15:45:17', '2024-04-17 15:45:17'),
(54, 52, 20, 'JKT48 Bday Shirt Lia', 'L', 'Blue', 1, 120.00, 120.00, '2024-04-17 15:45:17', '2024-04-17 15:45:17'),
(55, 53, 27, 'Hoodie Supreme', 'XL', 'Gray', 2, 120.00, 240.00, '2024-04-17 15:58:57', '2024-04-17 15:58:57'),
(56, 53, 14, 'JKT48 Bday Shirt Fiony 2024', 'XL', 'Black', 1, 400.00, 400.00, '2024-04-17 15:58:58', '2024-04-17 15:58:58'),
(57, 53, 14, 'JKT48 Bday Shirt Fiony 2024', 'M', 'Black', 1, 400.00, 400.00, '2024-04-17 15:58:58', '2024-04-17 15:58:58'),
(58, 54, 8, 'Kutang Sebong', 'XL', 'White', 1, 200.00, 200.00, '2024-04-17 16:08:07', '2024-04-17 16:08:07'),
(59, 55, 16, 'Long Coat Winter', 'All Size', 'Blue', 1, 300.00, 300.00, '2024-04-17 22:52:28', '2024-04-17 22:52:28'),
(60, 57, 17, 'Polcadot Dress', 'All Size', 'White', 1, 150.00, 150.00, '2024-04-17 23:24:27', '2024-04-17 23:24:27'),
(61, 58, 17, 'Polcadot Dress', 'All Size', 'Broken White', 1, 150.00, 150.00, '2024-04-17 23:44:08', '2024-04-17 23:44:08'),
(62, 59, 18, 'SKZ Baseball Jersey', 'XL', 'Black', 1, 100.00, 100.00, '2024-04-19 00:49:58', '2024-04-19 00:49:58'),
(63, 59, 18, 'SKZ Baseball Jersey', 'M', 'White', 1, 100.00, 100.00, '2024-04-19 00:49:58', '2024-04-19 00:49:58'),
(64, 59, 18, 'SKZ Baseball Jersey', 'L', 'White', 1, 100.00, 100.00, '2024-04-19 00:49:58', '2024-04-19 00:49:58'),
(65, 60, 20, 'JKT48 Bday Shirt Lia', 'L', 'Blue', 2, 120.00, 240.00, '2024-04-19 01:46:35', '2024-04-19 01:46:35'),
(66, 60, 25, 'Hacheads Shirt Hoodie', 'XL', 'Black', 1, 430.00, 430.00, '2024-04-19 01:46:35', '2024-04-19 01:46:35'),
(67, 61, 12, 'Baggy Jeans Dokyeom', 'All Size', 'Denim', 1, 200.00, 200.00, '2024-04-19 22:48:31', '2024-04-19 22:48:31'),
(70, 70, 15, 'Blazer Horanghae', 'M', 'Horanghae', 1, 100.00, 100.00, '2024-05-01 10:09:47', '2024-05-01 10:09:47'),
(71, 71, 12, 'Baggy Jeans Dokyeom', 'All Size', 'Denim', 2, 200.00, 400.00, '2024-05-03 23:35:33', '2024-05-03 23:35:33'),
(72, 72, 25, 'Hacheads Shirt Hoodie', 'L', 'Black', 1, 430.00, 430.00, '2024-05-25 16:16:30', '2024-05-25 16:16:30'),
(73, 73, 27, 'Hoodie Supreme', 'M', 'Gray', 1, 120.00, 120.00, '2024-05-27 07:07:20', '2024-05-27 07:07:20'),
(74, 74, 25, 'Hacheads Shirt Hoodie', 'L', 'Black', 1, 430.00, 430.00, '2024-06-01 03:16:29', '2024-06-01 03:16:29'),
(75, 75, 23, 'Rhude Brentwood Jacket', 'XL', 'Gray', 1, 207.00, 207.00, '2024-06-03 07:13:16', '2024-06-03 07:13:16'),
(76, 76, 23, 'Rhude Brentwood Jacket', 'L', 'Gray', 1, 207.00, 207.00, '2024-06-08 02:47:36', '2024-06-08 02:47:36'),
(77, 77, 15, 'Blazer Horanghae', 'L', 'Horanghae', 1, 100.00, 100.00, '2024-06-08 06:15:40', '2024-06-08 06:15:40'),
(78, 78, 26, 'Wool Cardigan Jun', 'XL', 'Gray', 2, 120.00, 240.00, '2024-06-08 06:25:13', '2024-06-08 06:25:13'),
(79, 79, 15, 'Blazer Horanghae', 'L', 'Horanghae', 2, 100.00, 200.00, '2024-06-08 06:42:52', '2024-06-08 06:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about-us', '<div style=\"line-height: 19px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque tenetur, quasi eum at ab cupiditate voluptas distinctio quos earum, fuga consectetur. Dolorum distinctio deserunt suscipit temporibus quisquam expedita eum error rerum fuga? Sint placeat ipsa voluptate in molestiae culpa quasi rerum quis. Soluta maiores quasi eius fuga pariatur nam hic, inventore fugiat officiis quisquam quis voluptatem? Ad, quidem! Dolore numquam tempore nemo inventore earum voluptatum aut asperiores eligendi optio suscipit consectetur at sit, necessitatibus maxime doloribus atque quisquam voluptate labore voluptatibus ab deserunt nam culpa ratione. Autem voluptatem consequuntur cumque, itaque esse eligendi aspernatur! Dolores eum nemo omnis ducimus laborum!</div><div style=\"line-height: 19px;\"><br></div><div style=\"line-height: 19px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque tenetur, quasi eum at ab cupiditate voluptas distinctio quos earum, fuga consectetur. Dolorum distinctio deserunt suscipit temporibus quisquam expedita eum error rerum fuga? Sint placeat ipsa voluptate in molestiae culpa quasi rerum quis. Soluta maiores quasi eius fuga pariatur nam hic, inventore fugiat officiis quisquam quis voluptatem? Ad, quidem! Dolore numquam tempore nemo inventore earum voluptatum aut asperiores eligendi optio suscipit consectetur at sit, necessitatibus maxime doloribus atque quisquam voluptate labore voluptatibus ab deserunt nam culpa ratione. Autem voluptatem consequuntur cumque, itaque esse eligendi aspernatur! Dolores eum nemo omnis ducimus laborum!<br></div>', 1, '2024-04-14 02:28:59', '2024-04-18 10:12:07'),
(3, 'Contact Us', 'contact-us', '<div style=\"line-height: 19px;\"><div style=\"\"><p style=\"vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(0, 29, 61); font-family: Poppins; background-color: rgb(241, 241, 241);\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content.</p><address style=\"vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; color: rgb(0, 29, 61); font-family: Poppins; background-color: rgb(241, 241, 241); outline: none !important;\">Jl. Karadenan No. 7<br style=\"vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;\">021-1234 Kab. Bogor<br style=\"vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;\">Jawa Barat, Indonesia 16211<br style=\"vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility;\"></address><a href=\"+62-1234-5678-9876\">+62-1234-5678-9876<br></a><a href=\"info@clothes.ku\">info@clothes.ku</a></div></div>', 1, '2024-04-14 02:53:39', '2024-04-14 07:53:11'),
(4, 'Privacy', 'privacy', '<div style=\"line-height: 19px;\">Pricvay&nbsp;</div><div style=\"line-height: 19px;\"><br></div><div style=\"line-height: 19px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque tenetur, quasi eum at ab cupiditate voluptas distinctio quos earum, fuga consectetur. Dolorum distinctio deserunt suscipit temporibus quisquam expedita eum error rerum fuga? Sint placeat ipsa voluptate in molestiae culpa quasi rerum quis. Soluta maiores quasi eius fuga pariatur nam hic, inventore fugiat officiis quisquam quis voluptatem? Ad, quidem! Dolore numquam tempore nemo inventore earum voluptatum aut asperiores eligendi optio suscipit consectetur at sit, necessitatibus maxime doloribus atque quisquam voluptate labore voluptatibus ab deserunt nam culpa ratione. Autem voluptatem consequuntur cumque, itaque esse eligendi aspernatur! Dolores eum nemo omnis ducimus laborum!</div><div style=\"line-height: 19px;\"><br></div><div style=\"line-height: 19px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque tenetur, quasi eum at ab cupiditate voluptas distinctio quos earum, fuga consectetur. Dolorum distinctio deserunt suscipit temporibus quisquam expedita eum error rerum fuga? Sint placeat ipsa voluptate in molestiae culpa quasi rerum quis. Soluta maiores quasi eius fuga pariatur nam hic, inventore fugiat officiis quisquam quis voluptatem? Ad, quidem! Dolore numquam tempore nemo inventore earum voluptatum aut asperiores eligendi optio suscipit consectetur at sit, necessitatibus maxime doloribus atque quisquam voluptate labore voluptatibus ab deserunt nam culpa ratione. Autem voluptatem consequuntur cumque, itaque esse eligendi aspernatur! Dolores eum nemo omnis ducimus laborum!</div>', 1, '2024-04-14 02:54:17', '2024-04-18 10:12:43'),
(5, 'Terms & Condition', 'terms-condition', '<div style=\"line-height: 19px;\">Terms and Condition</div><div style=\"line-height: 19px;\"><br></div><div style=\"line-height: 19px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque tenetur, quasi eum at ab cupiditate voluptas distinctio quos earum, fuga consectetur. Dolorum distinctio deserunt suscipit temporibus quisquam expedita eum error rerum fuga? Sint placeat ipsa voluptate in molestiae culpa quasi rerum quis. Soluta maiores quasi eius fuga pariatur nam hic, inventore fugiat officiis quisquam quis voluptatem? Ad, quidem! Dolore numquam tempore nemo inventore earum voluptatum aut asperiores eligendi optio suscipit consectetur at sit, necessitatibus maxime doloribus atque quisquam voluptate labore voluptatibus ab deserunt nam culpa ratione. Autem voluptatem consequuntur cumque, itaque esse eligendi aspernatur! Dolores eum nemo omnis ducimus laborum!</div><div style=\"line-height: 19px;\"><br></div><div style=\"line-height: 19px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque tenetur, quasi eum at ab cupiditate voluptas distinctio quos earum, fuga consectetur. Dolorum distinctio deserunt suscipit temporibus quisquam expedita eum error rerum fuga? Sint placeat ipsa voluptate in molestiae culpa quasi rerum quis. Soluta maiores quasi eius fuga pariatur nam hic, inventore fugiat officiis quisquam quis voluptatem? Ad, quidem! Dolore numquam tempore nemo inventore earum voluptatum aut asperiores eligendi optio suscipit consectetur at sit, necessitatibus maxime doloribus atque quisquam voluptate labore voluptatibus ab deserunt nam culpa ratione. Autem voluptatem consequuntur cumque, itaque esse eligendi aspernatur! Dolores eum nemo omnis ducimus laborum!</div>', 1, '2024-04-14 02:54:53', '2024-04-18 10:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `size` varchar(255) NOT NULL DEFAULT 'All Size',
  `color` varchar(255) DEFAULT NULL,
  `shipping_returns` text DEFAULT NULL,
  `related_products` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('yes','no') NOT NULL DEFAULT 'no',
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_qty` enum('yes','no') NOT NULL DEFAULT 'yes',
  `qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `size`, `color`, `shipping_returns`, `related_products`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `sku`, `barcode`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(8, 'Kutang Sebong', 'kutang-sebong', '<p>&nbsp;<span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino.</span></p>', 'M, L, XL, XXL', 'Black, White', '<p>lee chan dino&nbsp;<span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino:</span></p><ol><li><span style=\"font-size: 1rem;\">lee chan dino&nbsp;<span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino&nbsp;</span><span style=\"font-size: 1rem;\">lee chan dino</span></span></li><li><span style=\"font-size: 1rem;\"><span style=\"font-size: 1rem;\">lee chan dino&nbsp;<span style=\"font-size: 1rem;\">lee chan</span><br></span><br></span><br></li></ol>', '14,15,19,25', 200.00, 250.00, 26, 6, NULL, 'yes', 'KTM', '123', 'yes', 0, 1, '2024-04-01 04:39:10', '2024-04-17 16:08:07'),
(12, 'Baggy Jeans Dokyeom', 'baggy-jeans-dokyeom', 'salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute salute gedewiye salute .', 'All Size', 'Denim', '<p>salute gedewiye salute&nbsp;<span style=\"font-size: 1rem;\">salute gedewiye salute :</span></p><ul><li><span style=\"font-size: 1rem;\">salute gedewiye salute&nbsp;</span></li><li><span style=\"font-size: 1rem;\">salute gedewiye salute&nbsp; salute gedewiye salute&nbsp;<br></span><br></li></ul>', '8,27,15,18', 200.00, 205.00, 26, 18, NULL, 'yes', 'FDA', '213', 'yes', 28, 1, '2024-04-01 17:42:19', '2024-05-03 23:35:33'),
(14, 'JKT48 Bday Shirt Fiony 2024', 'jkt48-bday-shirt-fiony-2024', '<p>Bday TSHIRT INI SEBENERNYA AKU PENGEN BANGET YA ALLAH, MAHAL KASIH MURAH.</p>', 'S, M, L, XL, XXL', 'Black', '<p>lorem ipsum sit dolor amet:</p><ol><li>lorem</li><li>ipsum</li><li>sit dolor</li></ol>', '22,17,20,8', 400.00, 450.00, 28, 5, NULL, 'yes', 'PIO', '321', 'yes', 1, 1, '2024-04-02 02:04:53', '2024-04-17 15:58:58'),
(15, 'Blazer Horanghae', 'blazer-horanghae', '<p>lorem ipsum sit dolor amet hoshi&nbsp;<span style=\"font-size: 1rem;\">lorem ipsum sit dolor amet hoshi&nbsp;</span><span style=\"font-size: 1rem;\">lorem ipsum sit dolor amet hoshi&nbsp;</span><span style=\"font-size: 1rem;\">lorem ipsum sit dolor amet hoshi .</span></p>', 'S, M, L, XL', 'Horanghae', '<div>lorem ipsum sit dolor amet hoshi&nbsp;<span style=\"font-size: 1rem;\">lorem ipsum sit dolor amet hoshi&nbsp;</span><span style=\"font-size: 1rem;\">lorem ipsum sit dolor amet hoshi :</span><br></div><ol><li>lorem ipsum sit dolor amet hoshi&nbsp; lorem ipsum sit dolor amet hoshi&nbsp;</li><li>lorem ipsum sit&nbsp;</li><li>lorem ipsum sit dolor amet hoshi&nbsp;<br></li></ol>', '8,14,21,26', 100.00, 200.00, 28, 9, NULL, 'yes', 'FAF', '421', 'yes', 26, 1, '2024-04-02 23:37:47', '2024-06-08 06:42:52'),
(16, 'Long Coat Winter', 'long-coat-winter', '<p>Wonu otaku&nbsp;<span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem&nbsp;</span><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem&nbsp;</span><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem.&nbsp;</span><span style=\"font-size: 1rem;\">Wonu otaku&nbsp;</span><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem&nbsp;</span><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem&nbsp;</span><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem.&nbsp;</span></p><p>lorem lorem lorem lorem lorem lorem&nbsp;<span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem.</span></p><ol><li><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem</span></li><li><span style=\"font-size: 1rem;\">lorem lorem lorem lorem&nbsp;</span></li><li><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem<br></span><span style=\"font-size: 1rem;\"><br></span></li></ol>', 'All Size', 'Blue, Brown', '<p>&nbsp;<span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem&nbsp;</span><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem&nbsp;</span><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem&nbsp;</span><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem</span></p><p>lorem lorem lorem lorem lorem lorem&nbsp;<span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem.</span></p><ol><li><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem</span></li><li><span style=\"font-size: 1rem;\">lorem lorem lorem lorem&nbsp;</span></li><li><span style=\"font-size: 1rem;\">lorem lorem lorem lorem lorem lorem<br></span></li></ol>', '19,25,27,12', 300.00, 320.00, 28, 12, NULL, 'yes', 'GSW', '311', 'yes', 0, 1, '2024-04-03 01:06:14', '2024-04-20 09:59:40'),
(17, 'Polcadot Dress', 'polcadot-dress', '<p>lorem lorem lorem apa yang lorem? cepio lucu banget!</p>', 'All Size', 'Broken White, White', '<p>Syarat Returns jika barang rusak, wajib video unboxing. Ongkir ditanggung JOT.<br></p>', '14,22,20,26', 150.00, 200.00, 25, 13, NULL, 'yes', 'HFS', '232', 'yes', 39, 1, '2024-04-03 01:08:23', '2024-04-17 23:44:09'),
(18, 'SKZ Baseball Jersey', 'skz-baseball-jersey', '<p>Lorem ipsum sit dolor amet. Lorem ipsum sit dolor amet. Lorem ipsum sit dolor amet. Lorem ipsum sit dolor amet.</p><p><br></p><p>Jisungie love you~</p>', 'M, L, XL', 'White, Black', '<p>Syarat Returns jika barang rusak, wajib video unboxing. Ongkir ditanggung pemerintah.<br></p>', '8,14,12,19', 100.00, 120.00, 26, 6, NULL, 'yes', 'HJR', '211', 'yes', 18, 1, '2024-04-03 01:10:20', '2024-04-19 00:49:58'),
(19, 'Kenzo Sweater', 'kenzo-sweater', 'Jangan ragukan kualitas Kenzo broh. Deskripsi lengkapnya cek website Kenzo aja.', 'S, M, L, XL, XXL', 'Black, White', '<p>Syarat Returns jika barang rusak, wajib video unboxing. Ongkir ditanggung pemerintah.<br></p>', '16,19,25,27', 400.00, 550.00, 28, 10, 6, 'yes', 'POS', '412', 'yes', 4, 1, '2024-04-03 01:12:26', '2024-04-17 04:40:41'),
(20, 'JKT48 Bday Shirt Lia', 'jkt48-bday-shirt-lia', '<p>Birthday Shirt aseli coy, yang oshiin lia merapat. Pengemasan dan pengiriman terjamin secepat kilat gak kayak inisial JOT.</p>', 'S, M, L, XL, XXL', 'Blue', 'Syarat Returns jika barang rusak, wajib video unboxing. Ongkir ditanggung pemerintah.', '22,17,14,19', 120.00, 200.00, 28, 5, NULL, 'yes', 'PPR', '213', 'yes', 26, 1, '2024-04-03 01:14:33', '2024-04-19 01:46:35'),
(21, 'Kenzo Vernon One Set', 'kenzo-vernon-one-set', '<p>Trouser and Blazer&nbsp;</p>', 'M, L, XL', 'Black', '<p>&nbsp;returns and shipping<br></p><p>lorem lorem lorem lorem bonon ganteng lorem lorem lorem lorem lorem lorem</p><p>1 x 24 jam wajib lapor.</p>', '8,12,19', 460.00, 600.00, 26, 18, 6, 'yes', 'PAG', '249', 'yes', 16, 1, '2024-04-03 01:17:02', '2024-04-17 05:01:18'),
(22, 'Dress One Piece', 'dress-one-piece', '<p>biru biru biru biru biru biru biru biru&nbsp;<span style=\"font-size: 1rem;\">biru biru biru biru biru biru biru biru&nbsp;</span><span style=\"font-size: 1rem;\">biru biru biru biru biru biru biru biru&nbsp;</span><span style=\"font-size: 1rem;\">biru biru biru biru biru biru biru biru&nbsp;</span><span style=\"font-size: 1rem;\">biru biru biru biru biru biru biru biru&nbsp;</span><span style=\"font-size: 1rem;\">biru biru biru biru biru biru biru biru&nbsp;</span><span style=\"font-size: 1rem;\">biru biru biru biru biru biru biru biru.</span></p><p><span style=\"font-size: 1rem;\"><br></span></p><p>biru biru biru biru biru biru biru biru&nbsp;<span style=\"font-size: 1rem;\">biru biru biru biru biru biru biru biru&nbsp;</span><span style=\"font-size: 1rem;\">biru biru biru biru biru biru biru biru&nbsp;</span><span style=\"font-size: 1rem;\">biru biru biru biru biru biru biru biru&nbsp;</span><span style=\"font-size: 1rem;\">biru biru biru biru biru biru biru biru.</span><span style=\"font-size: 1rem;\"><br></span></p>', 'S, M, L, XL', 'Blue', '<p>shipping and returns</p>', '14,17,20,26', 320.00, 350.00, 25, 13, NULL, 'yes', 'FJV', '213', 'yes', 0, 1, '2024-04-03 01:19:33', '2024-04-17 03:38:34'),
(23, 'Rhude Brentwood Jacket', 'rhude-brentwood-jacket', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem delectus, ratione necessitatibus voluptatem architecto debitis reprehenderit veritatis amet atque excepturi illo quas impedit aut ipsa fugiat laudantium sapiente, voluptatibus explicabo?</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem delectus, ratione necessitatibus voluptatem architecto debitis reprehenderit veritatis amet atque excepturi illo quas impedit aut ipsa fugiat laudantium sapiente, voluptatibus explicabo?<br></p>', 'M, L, XL', 'Gray', '<p>Shipping</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem delectus, ratione necessitatibus voluptatem architecto debitis reprehenderit veritatis amet atque excepturi illo quas impedit aut ipsa fugiat laudantium sapiente, voluptatibus explicabo?<br></p>', '8,15,19,21', 207.00, 220.00, 26, 19, NULL, 'yes', 'M49', '163', 'yes', 15, 1, '2024-04-04 03:03:12', '2024-06-08 02:47:36'),
(24, 'Denim Jacket', 'denim-jacket', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet assumenda officiis dolorem deserunt debitis blanditiis possimus tenetur soluta veniam, laudantium fugiat reiciendis error omnis veritatis voluptates minus beatae dolor non?</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet assumenda officiis dolorem deserunt debitis blanditiis possimus tenetur soluta veniam, laudantium fugiat reiciendis error omnis veritatis voluptates minus beatae dolor non?<br></p>', 'All Size', 'Denim', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet assumenda officiis dolorem deserunt debitis blanditiis possimus tenetur soluta veniam, laudantium fugiat reiciendis error omnis veritatis voluptates minus beatae dolor non?<br></p>', '8,12,19,23', 300.00, 400.00, 26, 19, NULL, 'yes', 'WLS', '374', 'yes', 53, 1, '2024-04-04 03:27:02', '2024-04-17 03:56:45'),
(25, 'Hacheads Shirt Hoodie', 'hacheads-shirt-hoodie', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet assumenda officiis dolorem deserunt debitis blanditiis possimus tenetur soluta veniam, laudantium fugiat reiciendis error omnis veritatis voluptates minus beatae dolor non?</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet assumenda officiis dolorem deserunt debitis blanditiis possimus tenetur soluta veniam, laudantium fugiat reiciendis error omnis veritatis voluptates minus beatae dolor non?<br></p>', 'S, M, L, XL', 'Black', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet assumenda officiis dolorem deserunt debitis blanditiis possimus tenetur soluta veniam, laudantium fugiat reiciendis error omnis veritatis voluptates minus beatae dolor non?<br></p>', '12,16,23,24', 430.00, 500.00, 26, 24, NULL, 'yes', 'IE6', '421', 'yes', 4, 1, '2024-04-04 03:32:13', '2024-06-01 03:16:29'),
(26, 'Wool Cardigan Jun', 'wool-cardigan-jun', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet assumenda officiis dolorem deserunt debitis blanditiis possimus tenetur soluta veniam, laudantium fugiat reiciendis error omnis veritatis voluptates minus beatae dolor non?</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet assumenda officiis dolorem deserunt debitis blanditiis possimus tenetur soluta veniam, laudantium fugiat reiciendis error omnis veritatis voluptates minus beatae dolor non?<br></p>', 'S, M, L, XL', 'Gray', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet assumenda officiis dolorem deserunt debitis blanditiis possimus tenetur soluta veniam, laudantium fugiat reiciendis error omnis veritatis voluptates minus beatae dolor non?<br></p>', '23,25,24,12', 120.00, 150.00, 26, 22, NULL, 'yes', 'BZW', '543', 'no', 0, 1, '2024-04-04 03:34:46', '2024-04-20 11:15:44'),
(27, 'Hoodie Supreme', 'hoodie-supreme', '<p style=\"vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; font-family: Poppins; line-height: 1.5; color: rgb(0, 29, 61);\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet assumenda officiis dolorem deserunt debitis blanditiis possimus tenetur soluta veniam, laudantium fugiat reiciendis error omnis veritatis voluptates minus beatae dolor non?</p><p style=\"vertical-align: baseline; -webkit-tap-highlight-color: transparent; -webkit-font-smoothing: antialiased; text-rendering: optimizelegibility; font-family: Poppins; line-height: 1.5; color: rgb(0, 29, 61); outline: none !important;\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet assumenda officiis dolorem deserunt debitis blanditiis possimus tenetur soluta veniam, laudantium fugiat reiciendis error omnis veritatis voluptates minus beatae dolor non?</p>', 'S, M, L, XL', 'Gray', '<p>yaayyaya&nbsp;<span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie:</span></p><ol><li><span style=\"font-size: 1rem;\">yongbookie&nbsp;<span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie</span></span></li><li><span style=\"font-size: 1rem;\"><span style=\"font-size: 1rem;\">yongbookie&nbsp;<span style=\"font-size: 1rem;\">yongbookie&nbsp;</span></span></span></li><li><span style=\"font-size: 1rem;\"><span style=\"font-size: 1rem;\"><span style=\"font-size: 1rem;\">yongbookie&nbsp;<span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span>yongbookie&nbsp;<span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie&nbsp;</span><span style=\"font-size: 1rem;\">yongbookie</span><br></span><br></span><br></span></li></ol>', '15,19,25,26', 120.00, 150.00, 28, 10, NULL, 'yes', 'NUI', '479', 'yes', 5, 1, '2024-04-15 06:50:17', '2024-05-27 07:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(59, 22, '22-59-1712195060.jpg', NULL, '2024-04-03 18:44:20', '2024-04-03 18:44:20'),
(60, 22, '22-60-1712195066.jpg', NULL, '2024-04-03 18:44:26', '2024-04-03 18:44:26'),
(61, 22, '22-61-1712195070.jpg', NULL, '2024-04-03 18:44:30', '2024-04-03 18:44:30'),
(62, 20, '20-62-1712195143.jpg', NULL, '2024-04-03 18:45:43', '2024-04-03 18:45:43'),
(63, 20, '20-63-1712195145.jpg', NULL, '2024-04-03 18:45:45', '2024-04-03 18:45:45'),
(64, 20, '20-64-1712195149.jpg', NULL, '2024-04-03 18:45:49', '2024-04-03 18:45:49'),
(65, 17, '17-65-1712195195.jpg', NULL, '2024-04-03 18:46:35', '2024-04-03 18:46:35'),
(66, 14, '14-66-1712195270.jpg', NULL, '2024-04-03 18:47:50', '2024-04-03 18:47:50'),
(67, 14, '14-67-1712195273.jpg', NULL, '2024-04-03 18:47:53', '2024-04-03 18:47:53'),
(68, 14, '14-68-1712195277.jpg', NULL, '2024-04-03 18:47:57', '2024-04-03 18:47:57'),
(69, 14, '14-69-1712195279.jpg', NULL, '2024-04-03 18:47:59', '2024-04-03 18:47:59'),
(70, 21, '21-70-1712195330.jpg', NULL, '2024-04-03 18:48:50', '2024-04-03 18:48:50'),
(71, 21, '21-71-1712195337.jpg', NULL, '2024-04-03 18:48:57', '2024-04-03 18:48:57'),
(72, 19, '19-72-1712195375.jpg', NULL, '2024-04-03 18:49:35', '2024-04-03 18:49:35'),
(73, 19, '19-73-1712195378.jpg', NULL, '2024-04-03 18:49:38', '2024-04-03 18:49:38'),
(74, 16, '16-74-1712195414.jpg', NULL, '2024-04-03 18:50:14', '2024-04-03 18:50:14'),
(75, 16, '16-75-1712195416.jpg', NULL, '2024-04-03 18:50:16', '2024-04-03 18:50:16'),
(76, 15, '15-76-1712195466.jpg', NULL, '2024-04-03 18:51:06', '2024-04-03 18:51:06'),
(77, 15, '15-77-1712195479.jpg', NULL, '2024-04-03 18:51:19', '2024-04-03 18:51:19'),
(78, 15, '15-78-1712195491.jpg', NULL, '2024-04-03 18:51:30', '2024-04-03 18:51:31'),
(79, 15, '15-79-1712195515.jpg', NULL, '2024-04-03 18:51:55', '2024-04-03 18:51:55'),
(80, 12, '12-80-1712195570.jpg', NULL, '2024-04-03 18:52:50', '2024-04-03 18:52:50'),
(81, 12, '12-81-1712195579.jpg', NULL, '2024-04-03 18:52:59', '2024-04-03 18:52:59'),
(82, 12, '12-82-1712195589.jpg', NULL, '2024-04-03 18:53:09', '2024-04-03 18:53:09'),
(83, 8, '8-83-1712195731.jpg', NULL, '2024-04-03 18:55:31', '2024-04-03 18:55:31'),
(86, 18, '18-86-1712195786.jpg', NULL, '2024-04-03 18:56:26', '2024-04-03 18:56:26'),
(87, 18, '18-87-1712195796.jpg', NULL, '2024-04-03 18:56:36', '2024-04-03 18:56:36'),
(88, 18, '18-88-1712195806.jpg', NULL, '2024-04-03 18:56:45', '2024-04-03 18:56:46'),
(89, 23, '23-89-1712224992.jpg', NULL, '2024-04-04 03:03:12', '2024-04-04 03:03:12'),
(90, 23, '23-90-1712224995.jpg', NULL, '2024-04-04 03:03:15', '2024-04-04 03:03:15'),
(91, 23, '23-91-1712224997.jpg', NULL, '2024-04-04 03:03:17', '2024-04-04 03:03:17'),
(92, 24, '24-92-1712226423.jpg', NULL, '2024-04-04 03:27:03', '2024-04-04 03:27:03'),
(93, 24, '24-93-1712226425.jpg', NULL, '2024-04-04 03:27:05', '2024-04-04 03:27:05'),
(94, 25, '25-94-1712226733.jpg', NULL, '2024-04-04 03:32:13', '2024-04-04 03:32:13'),
(95, 25, '25-95-1712226735.jpg', NULL, '2024-04-04 03:32:15', '2024-04-04 03:32:15'),
(96, 26, '26-96-1712226886.jpg', NULL, '2024-04-04 03:34:46', '2024-04-04 03:34:46'),
(97, 26, '26-97-1712226889.jpg', NULL, '2024-04-04 03:34:48', '2024-04-04 03:34:49'),
(98, 26, '26-98-1712226890.jpg', NULL, '2024-04-04 03:34:50', '2024-04-04 03:34:50'),
(99, 27, '27-99-1713163817.jpg', NULL, '2024-04-15 06:50:17', '2024-04-15 06:50:17'),
(100, 27, '27-100-1713163819.jpg', NULL, '2024-04-15 06:50:19', '2024-04-15 06:50:19'),
(101, 16, '16-101-1713193876.jpg', NULL, '2024-04-15 15:11:16', '2024-04-15 15:11:16'),
(102, 16, '16-102-1713193880.jpg', NULL, '2024-04-15 15:11:20', '2024-04-15 15:11:20'),
(103, 8, '8-103-1713195819.jpg', NULL, '2024-04-15 15:43:39', '2024-04-15 15:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rating` double(3,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `product_id`, `username`, `email`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 25, 'Minghao', 'haosaranghao@gmail.com', 'bagus', 5.00, 0, '2024-04-14 23:56:45', '2024-04-14 23:56:45'),
(2, 25, 'Vernon', 'bonon@gmail.com', 'bagus gyu mantap', 5.00, 0, '2024-04-15 00:00:53', '2024-04-15 00:00:53'),
(3, 25, 'Joshua Hong', 'joshushu@gmail.com', 'b aja', 4.00, 0, '2024-04-15 01:22:04', '2024-04-15 01:22:04'),
(4, 25, 'Muhamad Ali', 'ali@gmail.com', 'bagus', 5.00, 0, '2024-04-15 04:03:56', '2024-04-15 04:03:56'),
(6, 27, 'Xu Minghao', 'haosaranghao@gmail.com', 'ini kayaknya KW deh, KW 1. tapi masih bagus lah, dikit', 4.00, 0, '2024-04-15 14:27:25', '2024-04-15 14:27:25'),
(7, 22, 'Xu Minghao', 'haosaranghao@gmail.com', 'Bajunya lucu, tapi saya dibilang aneh sama orang-orang. Ya, saya cowok', 4.00, 0, '2024-04-15 15:55:38', '2024-04-15 15:55:38'),
(8, 21, 'Joshua Hong', 'joshushu@gmail.com', 'Saya beli karena modelnya ganteng', 5.00, 0, '2024-04-17 05:01:59', '2024-04-17 05:01:59'),
(9, 14, 'Joshua Hong', 'joshushu@gmail.com', 'bagus, saya suka cepio soalnya', 5.00, 0, '2024-04-17 16:02:13', '2024-04-17 16:02:13'),
(10, 15, 'Xu Minghao', 'haosaranghao@gmail.com', 'maaf, aku anti horanghae', 1.00, 0, '2024-04-17 16:04:44', '2024-04-17 16:04:44'),
(11, 12, 'Xu Minghao', 'haosaranghao@gmail.com', 'SALUTE', 3.00, 0, '2024-04-17 16:05:30', '2024-04-17 16:05:30'),
(12, 18, 'Muhamad Ali', 'ali@gmail.com', 'han ilofyu', 5.00, 0, '2024-04-19 00:48:37', '2024-04-19 00:48:37'),
(13, 15, 'Vernon Chwe', 'bonon@gmail.com', 'aku suka horanghae\r\n\r\n(ini admin yg nulis)', 5.00, 0, '2024-04-20 09:53:48', '2024-04-20 09:53:48'),
(14, 20, 'Vernon Chwe', 'bonon@gmail.com', 'cantik', 5.00, 0, '2024-06-06 08:46:48', '2024-06-06 08:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, '101', 20.00, '2024-04-07 00:11:48', '2024-04-07 07:32:18'),
(3, 'rest_of_world', 50.00, '2024-04-07 00:13:46', '2024-04-07 20:38:06'),
(4, '1', 30.00, '2024-04-07 21:32:56', '2024-04-07 21:32:56'),
(5, '45', 25.00, '2024-04-17 23:30:24', '2024-04-17 23:30:24'),
(6, '115', 25.00, '2024-06-08 02:46:51', '2024-06-08 02:46:51'),
(7, '109', 24.00, '2024-06-08 06:22:45', '2024-06-08 06:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `showHome` enum('yes','no') NOT NULL DEFAULT 'no',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `showHome`, `category_id`, `created_at`, `updated_at`) VALUES
(5, 'Shirts', 'shirts', 1, 'yes', 28, '2024-04-01 04:33:17', '2024-04-03 00:56:58'),
(6, 'Shirts', 'shirts-men', 1, 'yes', 26, '2024-04-01 04:33:42', '2024-04-03 00:57:09'),
(7, 'Shirts & Blouses', 'shirts-blouses', 1, 'yes', 25, '2024-04-01 04:34:20', '2024-04-03 01:00:50'),
(8, 'Shirts', 'shirts-kids', 1, 'yes', 27, '2024-04-01 04:34:47', '2024-04-03 00:57:48'),
(9, 'Blazers & Waistscoats', 'blazers-waistscoats', 1, 'yes', 28, '2024-04-02 23:34:26', '2024-04-02 23:34:26'),
(10, 'Hoodies & Sweatshirts', 'hoodies-sweatshirts', 1, 'yes', 28, '2024-04-03 00:58:23', '2024-04-03 00:58:23'),
(11, 'Cardigans & Jumpers', 'cardigans-jumpers', 1, 'yes', 28, '2024-04-03 00:59:00', '2024-04-03 00:59:00'),
(12, 'Jackets & Coats', 'jackets-coats', 1, 'yes', 28, '2024-04-03 00:59:45', '2024-04-03 00:59:45'),
(13, 'Dresses', 'dresses', 1, 'yes', 25, '2024-04-03 01:00:11', '2024-04-03 01:00:11'),
(14, 'Skirts', 'skirts', 1, 'yes', 25, '2024-04-03 01:01:09', '2024-04-03 01:01:09'),
(15, 'Trousers', 'trousers', 1, 'yes', 28, '2024-04-03 01:02:12', '2024-04-03 01:02:12'),
(16, 'T-Shirt & Knitwear', 't-shirt-knitwear', 1, 'yes', 28, '2024-04-03 01:03:08', '2024-04-03 01:03:08'),
(17, 'Jeans', 'jeans', 1, 'yes', 28, '2024-04-03 01:03:40', '2024-04-03 01:03:40'),
(18, 'One Set', 'one-set-men', 1, 'yes', 26, '2024-04-03 01:17:28', '2024-04-03 17:26:50'),
(19, 'Jackets & Coats', 'jackets-coats-men', 1, 'yes', 26, '2024-04-03 17:19:20', '2024-04-03 17:19:20'),
(20, 'Trousers', 'trousers-men', 1, 'yes', 26, '2024-04-03 17:28:21', '2024-04-03 17:28:21'),
(21, 'Cardigans & Jumpers', 'cardigans-jumpers-women', 1, 'yes', 25, '2024-04-03 17:28:53', '2024-04-03 17:28:53'),
(22, 'Cardigans & Jumpers', 'cardigans-jumpers-men', 1, 'yes', 26, '2024-04-03 17:29:17', '2024-04-03 17:29:17'),
(23, 'Hoodies & Sweatshirts', 'hoodies-sweatshirts-women', 1, 'yes', 25, '2024-04-03 17:29:50', '2024-04-03 17:29:50'),
(24, 'Hoodies & Sweatshirts', 'hoodies-sweatshirts-men', 1, 'yes', 26, '2024-04-03 17:30:26', '2024-04-03 17:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@clothes.ku', NULL, NULL, '$2y$10$0QJcgUj.t.OUZQIRoafF1.iWhGG5Uhd4XUtxY34zi1m7vBf3yDhCm', 1, 1, NULL, '2024-03-29 15:36:14', '2024-04-14 07:33:48'),
(3, 'Muhamad Ali', 'ali@gmail.com', '089212314212', NULL, '$2y$10$5Iq/ys98ydvKGifKdCPN9uc1.1PYT8VdFyLhDfkxwWpYDAWZjXOtC', 0, 1, NULL, '2024-03-06 01:59:14', '2024-04-06 01:59:14'),
(4, 'Vernon Chwe', 'bonon@gmail.com', '021393192102', NULL, '$2y$10$1L1Wu4x9Ih5wdW1U31nvquK9mV19LVuHf8jxQFSGnVDjn7CIHoFa.', 0, 1, NULL, '2024-04-06 02:07:54', '2024-04-06 02:07:54'),
(5, 'Joshua Hong', 'joshushu@gmail.com', '088888888888', NULL, '$2y$10$indNLD5UCPx9Mx6XAPxjROzKfFQu0l2qNAhEZouFsL2hTOtjERHvu', 0, 1, NULL, '2024-04-12 10:28:36', '2024-04-13 13:03:14'),
(6, 'Minghao Xu', 'haosaranghao@gmail.com', '021393192102', NULL, '$2y$10$sBnMvqJxWYMKBm6QiRgZE.QmKVt/lntV7fFn1XMzkTTu4r6aUuxg6', 0, 0, NULL, '2024-05-14 01:09:29', '2024-05-25 16:14:25'),
(7, 'Hoshi Kwon', 'hoshi@gmail.com', NULL, NULL, '$2y$10$9A4M3UA/UN/.SBlX1gCeKukoIgNszSOI.yd.jfBcLHjJVFYCbdE.W', 0, 1, NULL, '2024-06-02 11:51:31', '2024-06-02 11:51:31'),
(8, 'Seungcheol Choi', 'scoups@gmail.com', NULL, NULL, '$2y$10$T4AEAlp4XKasZiE6RUKv1evs5gQ76IC.A5SOSKqxMsA506EgbmsG6', 0, 1, NULL, '2024-06-03 01:04:11', '2024-06-03 01:04:11'),
(9, 'Jeonghan Yoon', 'jeonghan@gmail.com', NULL, NULL, '$2y$10$SqCvdbsMntLwCabZfCkO4.O3t2nqDnNjan2yjgD3mTm.OR5xDLePC', 0, 1, NULL, '2024-06-03 01:05:19', '2024-06-03 01:05:19'),
(10, 'Junhui Wein', 'jun@gmail.com', '1232142124', NULL, '$2y$10$PFRYl2b.fH9rp6OBdevFcOfYpgg3Qcfvrs3aDp8314BMAjrZqBinC', 0, 1, NULL, '2024-06-03 01:05:56', '2024-06-08 10:44:32'),
(11, 'Wonwoo Jeon', 'wonwoo@gmail.com', NULL, NULL, '$2y$10$WSaS4ysN9ywnVIOJCMieMuvk/61b.9OM8vPWcwpHfUNzao6ct2eLm', 0, 1, NULL, '2024-06-03 01:06:56', '2024-06-03 01:06:56'),
(12, 'Jihoon Lee', 'woozi@gmail.com', '021393192102', NULL, '$2y$10$7J/u/Uxu0feIcfwU9loa1eya.YqzRYiE5tCUTNAtRXGTv2cwcZz7O', 0, 1, NULL, '2024-06-03 01:08:13', '2024-06-03 06:55:14'),
(13, 'Mingyu Kim', 'mingyu@gmail.com', NULL, NULL, '$2y$10$gbUOISV0guUf5biikEZqqet8QDfEm8l7cU9UAQfj7gebCoBPUxq8i', 0, 1, NULL, '2024-06-03 01:09:13', '2024-06-03 01:09:13'),
(14, 'Dokyeom Lee', 'dokyeom@gmail.com', NULL, NULL, '$2y$10$hIWX23vd1eDpM6nYPi54YuMpL2E6TypbCw1jg09V/GtOrAtifvFv2', 0, 1, NULL, '2024-06-03 01:11:35', '2024-06-03 01:11:35'),
(15, 'Seungkwan Boo', 'seungkwan@gmail.com', NULL, NULL, '$2y$10$QULRl26yP1mv7FJ7yuOWVu7eq0fLCZf0RBMip7cTCkiuwPqUduAlq', 0, 1, NULL, '2024-06-03 01:14:15', '2024-06-03 01:14:15'),
(16, 'Chan Lee', 'dino@gmail.com', NULL, NULL, '$2y$10$l7uOvWbyK5Xtvu9WKnDHBecCBkX0bPAQK1dMCZnwdgs7UZYUQJtI6', 0, 1, NULL, '2024-06-03 01:14:57', '2024-06-03 01:14:57'),
(17, 'Kohaku Oukawa', 'oukohaku@gmail.com', NULL, NULL, '$2y$10$yivwH6oysxh0XS9Ek4bYSumxbi.Zj8G6PhfcZcprnDNrRg31c2IdK', 0, 1, NULL, '2024-06-07 06:21:26', '2024-06-08 06:21:26'),
(18, 'Owner', 'owner@clothes.ku', NULL, NULL, '$2y$10$/3fiB/3P5S53wfdFsmcn6OlaYqQ5hgnd5sfg1VELlhA2WPusKoki6', 2, 1, NULL, '2024-06-09 01:50:30', '2024-06-09 01:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(8, 3, 15, '2024-04-13 03:28:08', '2024-04-13 03:28:08'),
(10, 6, 24, '2024-04-15 15:52:45', '2024-04-15 15:52:45'),
(11, 6, 26, '2024-04-15 15:52:52', '2024-04-15 15:52:52'),
(12, 4, 8, '2024-04-16 15:48:23', '2024-04-16 15:48:23'),
(13, 5, 27, '2024-04-17 05:00:18', '2024-04-17 05:00:18'),
(14, 4, 16, '2024-04-20 09:54:47', '2024-04-20 09:54:47'),
(15, 4, 23, '2024-04-20 11:21:49', '2024-04-20 11:21:49'),
(16, 12, 26, '2024-06-03 07:21:20', '2024-06-03 07:21:20'),
(17, 12, 24, '2024-06-03 07:21:31', '2024-06-03 07:21:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_country_id_foreign` (`country_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ratings_product_id_foreign` (`product_id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_images`
--
ALTER TABLE `temp_images`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
