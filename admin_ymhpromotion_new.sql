-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th4 01, 2022 lúc 09:11 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `admin_ymh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wp_customer_address`
--

DROP TABLE IF EXISTS `wp_customer_address`;
CREATE TABLE IF NOT EXISTS `wp_customer_address` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) DEFAULT 0,
  `title` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(55) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_address` tinyint(1) DEFAULT 0,
  `province_id` int(11) DEFAULT NULL COMMENT 'thành phố',
  `district_id` int(11) DEFAULT NULL COMMENT 'quận huyện',
  `ward_id` int(11) DEFAULT NULL COMMENT 'phường xã',
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Đang đổ dữ liệu cho bảng `wp_customer_address`
--

INSERT INTO `wp_customer_address` (`ID`, `customer_id`, `title`, `full_name`, `phone`, `email`, `address`, `default_address`, `province_id`, `district_id`, `ward_id`, `date_created`, `date_updated`) VALUES
(2, 2, 'ĐỊA CHỈ GIAO HÀNG', 'Ngo Uyen Thi', '0986149226', 'ngouyenthi80@gmail.com', 'Han Hai Nguyen', 1, 50, 556, 9354, '2021-12-16 08:42:27', '2021-12-16 08:42:27'),
(4, 4, 'ĐỊA CHỈ GIAO HÀNG', 'Bao', '0913857668', 'nguytienbao2015@gmail.com', 'fdsf sdfsdf', 0, 60, 668, 10811, '2021-12-22 07:45:49', '2021-12-22 07:45:49'),
(39, 7, 'ĐỊA CHỈ GIAO HÀNG', 'ĐỖ THỊ TUYẾT NGỌC', '0918199200', '', '555 Trần Hưng Đạo, Tp. Quy Nhơn, Bình Đinh.', 1, 50, 561, 9422, '2022-02-16 04:14:23', '2022-03-23 13:47:27'),
(44, 52, 'ĐỊA CHỈ GIAO HÀNG', 'ĐỖ THỊ TUYẾT NGỌC', '0918199200', '', '792 Trần Hưng Đạo, Tp. Quy Nhơn, Bình Đinh.', 0, 60, 665, 10773, '2022-02-16 10:52:10', '2022-02-16 10:52:10'),
(45, 52, 'ĐỊA CHỈ GIAO HÀNG', 'ĐỖ THỊ TUYẾT TUYẾT', '0918199200', '', '792 Trần Hưng Đạo, Tp. Quy Nhơn, Bình Đinh.', 1, 43, 480, 8417, '2022-02-16 10:59:36', '2022-02-16 11:00:40'),
(49, 49, 'ĐỊA CHỈ GIAO HÀNG', 'LUU QUI NAM', '0938297883', '', '341/18H Lac Long Quan Street, 5 Ward, District 11, HCMC', 1, 62, 683, 10958, '2022-03-04 06:57:03', '2022-03-04 07:34:09'),
(50, 49, 'ĐỊA CHỈ GIAO HÀNG', 'Lưu Kiến hoa', '0938521252', '', '123 Võ thị sáu', 0, 50, 548, 9228, '2022-03-07 06:32:07', '2022-03-07 06:32:07'),
(51, 60, 'ĐỊA CHỈ GIAO HÀNG', 'Long Khoa', '09876654433', '', 'Nguyen Huu Canh TPHCM', 0, 4, 39, 631, '2022-03-11 09:47:09', '2022-03-11 09:47:09'),
(52, 60, 'ĐỊA CHỈ GIAO HÀNG', 'Long Khoa', '09876654433', '', 'Nguyen Huu Canh TPHCM', 0, 4, 39, 631, '2022-03-11 09:47:10', '2022-03-11 09:47:10'),
(53, 60, 'ĐỊA CHỈ GIAO HÀNG', 'Long Khoa', '09876654433', '', 'Nguyen Huu Canh TPHCM', 0, 4, 39, 631, '2022-03-11 09:47:10', '2022-03-11 09:47:10'),
(54, 60, 'ĐỊA CHỈ GIAO HÀNG', 'Long Khoa', '09876654433', '', 'Nguyen Huu Canh TPHCM', 0, 4, 39, 631, '2022-03-11 09:47:10', '2022-03-11 09:47:10'),
(55, 60, 'ĐỊA CHỈ GIAO HÀNG', 'Long Khoa', '09876654433', '', 'Nguyen Huu Canh TPHCM', 0, 4, 39, 631, '2022-03-11 09:47:11', '2022-03-11 09:47:11'),
(56, 60, 'ĐỊA CHỈ GIAO HÀNG', 'Long Khoa', '09876654433', '', 'Nguyen Huu Canh TPHCM', 0, 4, 39, 631, '2022-03-11 09:47:11', '2022-03-11 09:47:11'),
(57, 60, 'ĐỊA CHỈ GIAO HÀNG', 'Long Khoa', '09876654433', '', 'Nguyen Huu Canh TPHCM', 1, 4, 39, 631, '2022-03-11 09:47:11', '2022-03-11 09:47:11'),
(58, 60, 'ĐỊA CHỈ GIAO HÀNG', 'Long Khoa', '09876654433', '', 'Nguyen Huu Canh TPHCM', 0, 4, 39, 631, '2022-03-11 09:47:11', '2022-03-11 09:47:11'),
(59, 60, 'ĐỊA CHỈ GIAO HÀNG', 'Hồ Đăng Long Khoa', '0927827765', '', 'd15 binh thanh', 0, 4, 39, 631, '2022-03-11 09:48:33', '2022-03-11 09:48:33'),
(64, 61, 'ĐỊA CHỈ GIAO HÀNG', 'Hồ Đăng Long Khoa', '0927827763', '', 'BINH THANH', 1, 49, 538, 9124, '2022-03-11 10:21:04', '2022-03-11 10:21:04'),
(65, 62, 'ĐỊA CHỈ GIAO HÀNG', 'Lưu Thành tâm', '0938232387', '', '123 Abc', 0, 50, 556, 9354, '2022-03-16 03:54:53', '2022-03-16 03:54:53'),
(66, 62, 'ĐỊA CHỈ GIAO HÀNG', 'LUU QUI NAM', '0938297883', '', '341/18H Lac Long Quan Street, 5 Ward, District 11, HCMC', 1, 62, 687, 0, '2022-03-16 04:09:27', '2022-03-16 04:09:27'),
(67, 50, 'ĐỊA CHỈ GIAO HÀNG', 'LUU QUI NAM', '0938297883', '', '341/18H Lac Long Quan Street, 5 Ward, District 11, HCMC', 1, 62, 687, 0, '2022-03-16 04:10:01', '2022-03-16 04:10:01'),
(68, 62, 'ĐỊA CHỈ GIAO HÀNG', 'Luu thanh tài', '0938297883', '', '341/18H Lac Long Quan Street, 5 Ward, District 11, HCMC', 1, 53, 600, 9922, '2022-03-16 04:16:39', '2022-03-16 04:16:39'),
(69, 66, 'ĐỊA CHỈ GIAO HÀNG', 'Lưu Quí Nam', '0938297885', '', '123 Abc', 0, 39, 436, 7891, '2022-03-23 06:57:30', '2022-03-23 06:57:30'),
(70, 68, 'ĐỊA CHỈ GIAO HÀNG', 'Ngụy Tiến Bảo', '0919088910', '', 'address test', 1, 50, 560, 9402, '2022-03-23 08:46:00', '2022-03-23 08:46:00'),
(71, 69, 'ĐỊA CHỈ GIAO HÀNG', 'Lưu Quí Nam', '0938232397', '', '1A/23C đường số 18B,', 1, 50, 556, 9356, '2022-03-28 07:48:50', '2022-03-28 07:48:50'),
(72, 71, 'ĐỊA CHỈ GIAO HÀNG', 'Lưu Quí Nam', '0938232385', '', '123 võ thị sáu', 0, 50, 545, 9188, '2022-03-29 02:31:37', '2022-03-29 02:31:37'),
(73, 73, '', 'Lưu Hoàn Nam', '0978876872', 'msacitigym1@gmail.com', '62a Cach Mang Thang Tam Ward 6', 1, 0, 0, 0, '2022-03-31 09:01:54', '2022-03-31 09:01:54'),
(74, 74, '', 'Lưu Hoàn thanh tâm', '0978876872', 'msacitigym1@gmail.com', '62a Cach Mang Thang Tam Ward 6', 1, 0, 0, 0, '2022-03-31 09:07:12', '2022-03-31 09:07:12'),
(75, 79, 'ĐỊA CHỈ GIAO HÀNG', 'Hoàng thái Tông', '0938230325', '', '123 Võ thị sáu, P6, Q3', 1, 50, 554, 9316, '2022-03-31 09:23:07', '2022-03-31 09:23:07'),
(76, 68, 'ĐỊA CHỈ GIAO HÀNG', 'Ngụy Hớn Tuyền', '0919088910', '', 'ABC', 0, 18, 182, 3222, '2022-04-01 09:01:45', '2022-04-01 09:01:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wp_sf_free_coupon`
--

DROP TABLE IF EXISTS `wp_sf_free_coupon`;
CREATE TABLE IF NOT EXISTS `wp_sf_free_coupon` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `free_coupon_id` varchar(20) DEFAULT '',
  `free_coupon_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `mileage` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `serial_no` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `warranty_effective_date` datetime DEFAULT NULL,
  `warranty_expired_date` datetime DEFAULT NULL,
  `warranty_mileage` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `warranty_policy_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `service_date` datetime DEFAULT NULL,
  `applied` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `sf_account_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `web_user_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `application_dealer_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `FrameNo` varchar(255) DEFAULT '',
  `CouponCategoryLevel` varchar(255) DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `wp_sf_free_coupon`
--

INSERT INTO `wp_sf_free_coupon` (`ID`, `free_coupon_id`, `free_coupon_name`, `mileage`, `serial_no`, `warranty_effective_date`, `warranty_expired_date`, `warranty_mileage`, `warranty_policy_type`, `service_date`, `applied`, `sf_account_id`, `web_user_id`, `application_dealer_code`, `FrameNo`, `CouponCategoryLevel`) VALUES
(1, 'CP0001', 'Coupon 211', '123', '324', '2021-12-03 00:00:00', '2022-05-12 00:00:00', '', '', '2022-05-12 00:00:00', '1', '', '65', '', '', ''),
(2, 'CP0002', 'Coupon 222', '123', '324', '2022-03-31 00:00:00', '2022-05-30 00:00:00', '', '', '2022-05-31 00:00:00', '1', '', '6', '', '', ''),
(3, 'CP00011', 'Coupon 211', '123', '324', '2021-12-03 00:00:00', '2022-05-12 00:00:00', '', '', '2022-05-12 00:00:00', '1', '223', '65', '', '', ''),
(8, 'CP0005', 'Coupon 211', '123', '324', '2021-12-03 00:00:00', '2022-05-12 00:00:00', '', '', '2022-05-12 00:00:00', '1', '', '65', '', '', ''),
(4, 'CP000134', 'Coupon 211', '123', '324', '2021-12-03 00:00:00', '2022-05-12 00:00:00', '', '', '1970-01-01 08:00:00', '1', '223', '7', '88yuihkj', '', ''),
(5, 'CP0002343', 'Coupon 222', '123', '324', '2022-03-31 00:00:00', '2022-05-30 00:00:00', '', '', '2022-05-31 00:00:00', '1', '223', '7', '', '', ''),
(6, 'CP003134', 'Coupon 511', '123', '324', '2021-12-03 00:00:00', '2022-05-12 00:00:00', '', '', '1970-01-01 08:00:00', '1', '7897897', '7', '88yuihkj', '', ''),
(7, 'CP00012', '1111Coupon 22112', '123', '324', '2021-12-03 00:00:00', '2022-05-12 00:00:00', '', '', '2021-05-12 00:00:00', '1', '4343', '65', '', '', ''),
(9, 'a0rO0000005woIZIAY', 'COUPON-000000056', '', 'GN0001', '2022-01-01 00:00:00', '2022-04-01 00:00:00', '3500', '', '1970-01-01 08:00:00', '1', '', '7', 'RY01A', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wp_sf_promotions`
--

DROP TABLE IF EXISTS `wp_sf_promotions`;
CREATE TABLE IF NOT EXISTS `wp_sf_promotions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `promotion_id` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `promotion_code` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `promotion_name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_type` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'default',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Đang đổ dữ liệu cho bảng `wp_sf_promotions`
--

INSERT INTO `wp_sf_promotions` (`ID`, `promotion_id`, `promotion_code`, `promotion_name`, `record_type`) VALUES
(10, 'a0CO000000VcnFKMAZ', 'PM0003', 'Chương trình khuyến mãi Bike tháng 3', 'default'),
(11, 'a0CO000000Vcrb0MAB', 'PM04', 'Promotion Private (Voucher)', 'default');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wp_sf_promotion_items`
--

DROP TABLE IF EXISTS `wp_sf_promotion_items`;
CREATE TABLE IF NOT EXISTS `wp_sf_promotion_items` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sf_record_type` varchar(50) NOT NULL DEFAULT 'Discount Amount',
  `promotion_type` varchar(50) DEFAULT 'default',
  `promotion_item_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_item_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_item_name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_id` varchar(20) DEFAULT NULL,
  `valid_from` datetime NOT NULL,
  `valid_to` datetime NOT NULL,
  `voucher_amount` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `description` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `wp_sf_promotion_items`
--

INSERT INTO `wp_sf_promotion_items` (`ID`, `sf_record_type`, `promotion_type`, `promotion_item_id`, `promotion_item_code`, `promotion_item_name`, `promotion_id`, `valid_from`, `valid_to`, `voucher_amount`, `discount`, `description`, `published`) VALUES
(12, '% Discount', 'default', 'a0DO000000EuUAYMA3', 'PII-0135', 'Private Promotion Loyalty Member 2022', 'a0CO000000Vcrb0MAB', '2022-03-09 00:00:00', '2022-04-07 00:00:00', 0, 20, '', 0),
(11, 'Promotion Bike', '', 'a0DO000000EuBsPMAV', 'PII-0127', 'Promotion Bike >400cc', 'a0CO000000VcnFKMAZ', '2022-02-27 00:00:00', '2022-03-31 00:00:00', 2500000, 2, 'Voucher Opening', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wp_sf_promotion_pack`
--

DROP TABLE IF EXISTS `wp_sf_promotion_pack`;
CREATE TABLE IF NOT EXISTS `wp_sf_promotion_pack` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `promotion_item_id` varchar(20) DEFAULT NULL,
  `item_pack_id` varchar(20) DEFAULT NULL,
  `promotion_pack_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_pack_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `wp_sf_promotion_pack`
--

INSERT INTO `wp_sf_promotion_pack` (`ID`, `promotion_item_id`, `item_pack_id`, `promotion_pack_code`, `promotion_pack_name`) VALUES
(31, 'a0DO000000EuBsPMAV', 'a2EO0000006JMlVMAW', 'PIP-0005', 'PIP-0005'),
(30, 'a0DO000000EuBsPMAV', 'a2EO0000006JMlaMAG', 'PIP-0006', 'PIP-0006'),
(29, 'a0DO000000EuBsPMAV', 'a2EO0000006JMlfMAG', 'PIP-0007', 'PIP-0007'),
(28, 'a0DO000000EuBsPMAV', 'a2EO0000006JMlpMAG', 'PIP-0009', 'PIP-0009'),
(27, 'a0DO000000EuBsPMAV', 'a2EO0000006JMlkMAG', 'PIP-0008', 'PIP-0008'),
(26, 'a0DO000000EuBsPMAV', 'a2EO0000006JMlQMAW', 'PIP-0004', 'PIP-0004');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wp_sf_promotion_product`
--

DROP TABLE IF EXISTS `wp_sf_promotion_product`;
CREATE TABLE IF NOT EXISTS `wp_sf_promotion_product` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `record_type` varchar(20) DEFAULT NULL,
  `promotion_item_id` varchar(20) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `color_code` varchar(20) NOT NULL,
  `discount` float NOT NULL DEFAULT 0,
  `list_price` float DEFAULT 0,
  `sale_price` float DEFAULT 0,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `wp_sf_promotion_product`
--

INSERT INTO `wp_sf_promotion_product` (`ID`, `record_type`, `promotion_item_id`, `product_code`, `color_code`, `discount`, `list_price`, `sale_price`) VALUES
(31, 'PCA', 'a0DO000000EuUAYMA3', 'TRAIN007GSOQ', '', 0, 0, 0),
(30, 'PCA', 'a0DO000000EuUAYMA3', 'TRAIN007GSSa', '', 5, 0, 0),
(29, 'PCA', 'a0DO000000EuUAYMA3', '90798AJBKT0B', '', 4, 0, 0),
(27, 'Bike', 'a0DO000000EuBsPMAV', 'YMHMT09SP2022', '010C', 9, 0, 0),
(28, 'Bike', 'a0DO000000EuBsPMAV', 'YMHMT092022Red', '010B', 17, 1000000, 1000000),
(25, 'Bike', 'a0DO000000EuBsPMAV', 'BS2G00', '060A', 10, 0, 0),
(26, 'Bike', 'a0DO000000EuBsPMAV', 'B8D600', '010A', 10, 1000000, 10000000),
(24, 'Bike', 'a0DO000000EuBsPMAV', 'BS2G00', '050C', 10, 0, 0),
(23, 'Bike', 'a0DO000000EuBsPMAV', 'YMHMT092022Black', '010B', 7, 1000000, 1000000),
(22, 'Bike', 'a0DO000000EuBsPMAV', 'B0C500', '010A', 10, 0, 0),
(32, 'PCA', 'a0DO000000EuUAYMA3', 'TRAIN007GW1g', '', 12, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
