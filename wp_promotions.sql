-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2022 at 11:49 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ymh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_promotions`
--

DROP TABLE IF EXISTS `wp_promotions`;
CREATE TABLE IF NOT EXISTS `wp_promotions` (
  `ID` int(11) NOT NULL,
  `product_code` varchar(11) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `product_type` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `color_code` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `promotion_id` varchar(12) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `promotion_item_id` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `item_pack_id` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `promotion_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `promotion_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `discount_value` float NOT NULL DEFAULT '0',
  `list_price` float NOT NULL,
  `sale_price` float NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
