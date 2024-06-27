-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2022 at 02:04 AM
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
-- Table structure for table `wp_order_details`
--

DROP TABLE IF EXISTS `wp_order_details`;
CREATE TABLE IF NOT EXISTS `wp_order_details` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `dealer_id` bigint(20) NOT NULL,
  `dealer_name` varchar(155) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dealer_address` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `contact_name` varchar(125) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `contact_phone` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `sku` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `deposit` float DEFAULT '0',
  `price` float DEFAULT '0',
  `price_old` float DEFAULT '0',
  `sale_off` float DEFAULT '0',
  `sub_total` float DEFAULT '0',
  `description` varchar(512) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Ghi chú',
  `sf_order_id` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `product_type` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `product_url` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `product_code` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `sf_color` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `sf_size` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `sf_status` tinyint(1) DEFAULT '1',
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `size` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `post_ID` bigint(20) DEFAULT NULL,
  `promotion` varchar(2048) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `sf_order_handler` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_order_details`
--

INSERT INTO `wp_order_details` (`ID`, `order_id`, `dealer_id`, `dealer_name`, `dealer_address`, `contact_name`, `contact_phone`, `item_id`, `sku`, `quantity`, `deposit`, `price`, `price_old`, `sale_off`, `sub_total`, `description`, `sf_order_id`, `product_type`, `product_name`, `product_url`, `product_code`, `sf_color`, `sf_size`, `sf_status`, `date_created`, `date_updated`, `size`, `color`, `image`, `post_ID`, `promotion`, `sf_order_handler`) VALUES
(1, 2, 1060, 'YAMAHA YFS Cần Thơ', '317 Đường Nguyễn Văn Linh, Phường An Khánh, Ninh Kiều, Cần Thơ', NULL, NULL, 779, '779', 1, 10000000, 139000000, 0, 0, 10000000, 'YAMAHA YFS Cần Thơ@317 Đường Nguyễn Văn Linh, Phường An Khánh, Ninh Kiều, Cần Thơ', NULL, 'Bike', 'MT 03', 'http://localhost:89/bikes/model/mt-03/', '', '', '', 1, '2022-03-13 00:17:23', '2022-03-13 01:44:21', '', 'http://localhost:89/wp-content/uploads/2021/10/2020-Yamaha-MT-03-2-removebg-preview-3.png', 'http://localhost:89/wp-content/uploads/2021/10/2020-Yamaha-MT-03-2-removebg-preview-3.png', 779, '\"\"', ''),
(2, 3, 1021, 'YAMAHA YFS TP. HỒ CHÍ MINH', '117A Lê Văn Khương, Phường Hiệp Thành, Quận 12, TP.HCM (Cách cầu vượt Tân Thới Hiệp 500m)', NULL, NULL, 782, '782', 2, 10000000, 139000000, 0, 0, 20000000, 'YAMAHA YFS TP. HỒ CHÍ MINH@117A Lê Văn Khương, Phường Hiệp Thành, Quận 12, TP.HCM (Cách cầu vượt Tân Thới Hiệp 500m)', NULL, 'Bike', 'MT 15', 'http://localhost:89/bikes/model/mt-15/', '', '', '', 1, '2022-03-13 00:17:23', '2022-03-13 01:44:21', '', 'http://localhost:89/wp-content/uploads/2021/10/2020-Yamaha-MT-03-2-removebg-preview-3.png', 'http://localhost:89/wp-content/uploads/2021/10/2020-Yamaha-MT-03-2-removebg-preview-3.png', 782, '[{\"promotion_item\":\"Voucher 5.000.000\\u0111 \\u00e1p d\\u1ee5ng cho t\\u1ea5t c\\u1ea3 SP trang ph\\u1ee5c v\\u00e0 ph\\u1ee5 ki\\u1ec7n\",\"promotion_value\":\"5000000\"},{\"promotion_item\":\"M\\u1ed9t n\\u0103m s\\u1eed d\\u1ee5ng d\\u1ecbch v\\u1ee5 c\\u1ee9u h\\u1ed9 ZuttoRide\",\"promotion_value\":\"0\"},{\"promotion_item\":\"T\\u1eb7ng \\u00e1o m\\u01b0a (YMH)\",\"promotion_value\":\"0\"}]', ''),
(3, 4, 1021, 'YAMAHA YFS TP. HỒ CHÍ MINH', '117A Lê Văn Khương, Phường Hiệp Thành, Quận 12, TP.HCM (Cách cầu vượt Tân Thới Hiệp 500m)', NULL, NULL, 1179, '1179', 2, 0, 100000, 0, 0, 200000, 'YAMAHA YFS TP. HỒ CHÍ MINH@117A Lê Văn Khương, Phường Hiệp Thành, Quận 12, TP.HCM (Cách cầu vượt Tân Thới Hiệp 500m)', NULL, 'PCA', 'Áo Polo thể thao nam Yamaha Racing 2020', 'http://localhost:89/apparels/model/ao-polo-the-thao-nam-yamaha-racing-2020/', '', '', '', 1, '2022-03-13 00:17:23', '2022-03-13 01:44:21', 'S', '#1e73be', 'http://localhost:89/wp-content/uploads/2021/10/Ao_Polo_Xanh-removebg-preview-258x300.png', 1179, '\"false\"', ''),
(4, 4, 1021, 'YAMAHA YFS TP. HỒ CHÍ MINH', '117A Lê Văn Khương, Phường Hiệp Thành, Quận 12, TP.HCM (Cách cầu vượt Tân Thới Hiệp 500m)', NULL, NULL, 1085, '1085', 1, 0, 100000, 0, 0, 100000, 'YAMAHA YFS TP. HỒ CHÍ MINH@117A Lê Văn Khương, Phường Hiệp Thành, Quận 12, TP.HCM (Cách cầu vượt Tân Thới Hiệp 500m)', NULL, 'PCA', 'Yamaha Paddock Factory Racing Monster Polo Hyper naked', 'http://localhost:89/apparels/model/yamaha-paddock-factory-racing-monster-polo-1/', '', '', '', 1, '2022-03-13 00:17:23', '2022-03-13 01:44:21', 'S', '#dd3333', 'http://localhost:89/wp-content/uploads/2021/10/Rectangle-202-52-258x300.png', 1085, '\"false\"', ''),
(5, 5, 1015, 'YAMAHA 2S HIỆP PHƯỚC', '91B Nguyễn Văn Tạo, ấp 2, xã Long Thới, huyện Nhà Bè, thành phố Hồ Chí Minh', NULL, NULL, 1192, '1192', 1, 0, 100000, 50000, 50000, 50000, 'YAMAHA 2S HIỆP PHƯỚC@91B Nguyễn Văn Tạo, ấp 2, xã Long Thới, huyện Nhà Bè, thành phố Hồ Chí Minh', NULL, 'PCA', 'Áo khoác thể thao nam Yamaha Racing Monster', 'http://localhost:89/apparels/model/ao-khoac-the-thao-nam-yamaha-racing-monster/', '', '', '', 1, '2022-03-13 00:17:23', '2022-03-13 01:44:21', 'S', '#1e73be', 'http://localhost:89/wp-content/uploads/2021/10/Ao_khoac_Xanh-removebg-preview-258x300.png', 1192, '[{\"promotion_item\":\"Voucher 300000 \\u00e1p d\\u1ee5ng cho t\\u1ea5t c\\u1ea3 SP trang ph\\u1ee5c v\\u00e0 ph\\u1ee5 ki\\u1ec7n\",\"promotion_value\":\"300000\"},{\"promotion_item\":\"T\\u1eb7ng m\\u0169 b\\u1ea3o hi\\u1ec3m 3\\/4\",\"promotion_value\":\"0\"}]', ''),
(6, 6, 1015, 'YAMAHA 2S HIỆP PHƯỚC', '91B Nguyễn Văn Tạo, ấp 2, xã Long Thới, huyện Nhà Bè, thành phố Hồ Chí Minh', NULL, NULL, 992, '992', 1, 0, 6000000, 0, 0, 6000000, 'YAMAHA 2S HIỆP PHƯỚC@91B Nguyễn Văn Tạo, ấp 2, xã Long Thới, huyện Nhà Bè, thành phố Hồ Chí Minh', NULL, 'package', 'MT 03', 'http://localhost:89/package/s-mt-03/', '', '', '', 1, '2022-03-13 00:17:23', '2022-03-13 01:44:21', '', '', 'http://localhost:89/wp-content/uploads/2021/10/img-service-package-a.jpg', 992, '\"<ul>\\n<li><span style=\\\\\\\"color: #ff0000;\\\\\\\">Lubricate &amp; adjust free play on drive chain<\\/span><\\/li>\\n<li><span style=\\\\\\\"color: #ff0000;\\\\\\\">Brake\\/Clutch fluid level inspection<\\/span><\\/li>\\n<li><span style=\\\\\\\"color: #ff0000;\\\\\\\">Tyre tread depth inspection<\\/span><\\/li>\\n<li><span style=\\\\\\\"color: #ff0000;\\\\\\\">Tyre pressure check<\\/span><\\/li>\\n<li><span style=\\\\\\\"color: #ff0000;\\\\\\\">Wheel bearing play inspection<\\/span><\\/li>\\n<\\/ul>\\n\"', ''),
(7, 7, 1021, 'YAMAHA YFS TP. HỒ CHÍ MINH', '117A Lê Văn Khương, Phường Hiệp Thành, Quận 12, TP.HCM (Cách cầu vượt Tân Thới Hiệp 500m)', NULL, NULL, 992, '992', 1, 0, 100000, 0, 0, 100000, 'YAMAHA YFS TP. HỒ CHÍ MINH@117A Lê Văn Khương, Phường Hiệp Thành, Quận 12, TP.HCM (Cách cầu vượt Tân Thới Hiệp 500m)', NULL, 'package', 'MT 03', 'http://localhost:89/package/s-mt-03/', '', '', '', 1, '2022-03-13 00:17:23', '2022-03-13 01:44:21', '', '', 'http://localhost:89/wp-content/uploads/2021/10/img-service-package-a.jpg', 992, '\"<ul>\\n<li><span style=\\\\\\\"color: #ff0000;\\\\\\\">Lubricate &amp; adjust free play on drive chain<\\/span><\\/li>\\n<li><span style=\\\\\\\"color: #ff0000;\\\\\\\">Brake\\/Clutch fluid level inspection<\\/span><\\/li>\\n<li><span style=\\\\\\\"color: #ff0000;\\\\\\\">Tyre tread depth inspection<\\/span><\\/li>\\n<li><span style=\\\\\\\"color: #ff0000;\\\\\\\">Tyre pressure check<\\/span><\\/li>\\n<li><span style=\\\\\\\"color: #ff0000;\\\\\\\">Wheel bearing play inspection<\\/span><\\/li>\\n<\\/ul>\\n\"', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
