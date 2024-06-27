-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2022 at 02:01 AM
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
-- Table structure for table `wp_orders`
--

DROP TABLE IF EXISTS `wp_orders`;
CREATE TABLE IF NOT EXISTS `wp_orders` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(18) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `customer_id` bigint(20) NOT NULL,
  `sf_account_id` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  `order_description` varchar(512) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `order_status` tinyint(4) DEFAULT '0' COMMENT 'Tráng thái đơn hàng: 1 đặt thành công, 2 đang xử lý, 3 xử lý xong, 8 trả lại, 9 đóng lại',
  `order_total` float DEFAULT '0',
  `paid` float DEFAULT '0',
  `payments` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT '1' COMMENT 'Hình thức thanh toán: 1 trả tiền nhận hàng, 2 chuyển khoản',
  `rec_address` varchar(2048) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Địa chỉ nhận',
  `province_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `ward_id` int(11) DEFAULT NULL,
  `invoice_require` tinyint(1) DEFAULT '0' COMMENT 'Yêu cầu hóa đơn 0/1',
  `tax_number` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Mã số thuế',
  `company_info` varchar(512) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Thông tin công ty',
  `company_address` varchar(512) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Địa chỉ công ty',
  `rec_invoice_address` varchar(512) COLLATE utf8mb4_unicode_520_ci DEFAULT '' COMMENT 'Địa chỉ nhận hóa đơn',
  `promotion` varchar(2048) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'JSON{code,title, value}',
  `booktype` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'apparel',
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sf_order_id` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `order_handler` varchar(155) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `contact_name` varchar(125) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `contact_phone` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `voucher` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `shipping_fee` float NOT NULL DEFAULT '0',
  `order_temp` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_orders`
--

INSERT INTO `wp_orders` (`ID`, `order_code`, `customer_id`, `sf_account_id`, `order_description`, `order_status`, `order_total`, `paid`, `payments`, `rec_address`, `province_id`, `district_id`, `ward_id`, `invoice_require`, `tax_number`, `company_info`, `company_address`, `rec_invoice_address`, `promotion`, `booktype`, `date_created`, `date_updated`, `sf_order_id`, `order_handler`, `contact_name`, `contact_phone`, `parent_id`, `voucher`, `discount`, `shipping_fee`, `order_temp`) VALUES
(1, 'do_0', 6, '', 'VO Si Hung 0936851323 đặt hàng.', 1, 36450000, 0, 'Showroom', '{ \\\"name\\\" : \\\"ĐỖ THỊ TUYẾT NGỌC\\\", \\\"phone\\\" : \\\"0918199200\\\", \\\"address\\\" : \\\"555 Trần Hưng Đạo, Tp. Quy Nhơn, Bình Đinh.\\\" }', 50, 561, 9422, 0, '', '', '', '', NULL, 'apparel', '2022-03-13 01:44:20', '2022-03-13 01:44:20', '', '', '', '', 0, '', 0, 0, '1'),
(2, 'do_1060', 6, '', 'VO Si Hung 0936851323 đặt hàng.', 1, 10000000, 0, 'Showroom', '{ \\\"name\\\" : \\\"ĐỖ THỊ TUYẾT NGỌC\\\", \\\"phone\\\" : \\\"0918199200\\\", \\\"address\\\" : \\\"555 Trần Hưng Đạo, Tp. Quy Nhơn, Bình Đinh.\\\" }', 50, 561, 9422, 0, '', '', '', '', NULL, 'Bike', '2022-03-13 01:44:20', '2022-03-13 01:44:21', '', '', '', '', 1, '', 0, 0, '1'),
(3, 'do_1021', 6, '', 'VO Si Hung 0936851323 đặt hàng.', 1, 20000000, 0, 'Showroom', '{ \\\"name\\\" : \\\"ĐỖ THỊ TUYẾT NGỌC\\\", \\\"phone\\\" : \\\"0918199200\\\", \\\"address\\\" : \\\"555 Trần Hưng Đạo, Tp. Quy Nhơn, Bình Đinh.\\\" }', 50, 561, 9422, 0, '', '', '', '', NULL, 'Bike', '2022-03-13 01:44:20', '2022-03-13 01:44:21', '', '', '', '', 1, '', 0, 0, '1'),
(4, 'do_pca1', 6, '', 'VO Si Hung 0936851323 đặt hàng.', 1, 300000, 0, 'Showroom', '{ \\\"name\\\" : \\\"ĐỖ THỊ TUYẾT NGỌC\\\", \\\"phone\\\" : \\\"0918199200\\\", \\\"address\\\" : \\\"555 Trần Hưng Đạo, Tp. Quy Nhơn, Bình Đinh.\\\" }', 50, 561, 9422, 0, '', '', '', '', NULL, 'PCA', '2022-03-13 01:44:20', '2022-03-13 01:44:21', '', '', '', '', 1, '', 0, 0, '1'),
(5, 'do_pca2', 6, '', 'VO Si Hung 0936851323 đặt hàng.', 1, 50000, 0, 'Showroom', '{ \\\"name\\\" : \\\"ĐỖ THỊ TUYẾT NGỌC\\\", \\\"phone\\\" : \\\"0918199200\\\", \\\"address\\\" : \\\"555 Trần Hưng Đạo, Tp. Quy Nhơn, Bình Đinh.\\\" }', 50, 561, 9422, 0, '', '', '', '', NULL, 'PCA', '2022-03-13 01:44:20', '2022-03-13 01:44:21', '', '', '', '', 1, '', 0, 0, '1'),
(6, 'do_pk1', 6, '', 'VO Si Hung 0936851323 đặt hàng.', 1, 6000000, 0, 'Showroom', '{ \\\"name\\\" : \\\"ĐỖ THỊ TUYẾT NGỌC\\\", \\\"phone\\\" : \\\"0918199200\\\", \\\"address\\\" : \\\"555 Trần Hưng Đạo, Tp. Quy Nhơn, Bình Đinh.\\\" }', 50, 561, 9422, 0, '', '', '', '', NULL, 'Package', '2022-03-13 01:44:20', '2022-03-13 01:44:21', '', '', '', '', 1, '', 0, 0, '1'),
(7, 'do_pk2', 6, '', 'VO Si Hung 0936851323 đặt hàng.', 1, 100000, 0, 'Showroom', '{ \\\"name\\\" : \\\"ĐỖ THỊ TUYẾT NGỌC\\\", \\\"phone\\\" : \\\"0918199200\\\", \\\"address\\\" : \\\"555 Trần Hưng Đạo, Tp. Quy Nhơn, Bình Đinh.\\\" }', 50, 561, 9422, 0, '', '', '', '', NULL, 'Package', '2022-03-13 01:44:20', '2022-03-13 01:44:21', '', '', '', '', 1, '', 0, 0, '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
