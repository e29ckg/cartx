-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2018 at 04:35 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1541393296),
('m180924_030329_create_user_table', 1541393298),
('m180925_032309_profile', 1541393298),
('m181030_031511_product', 1541393298),
('m181030_070804_product_catalog', 1541393298),
('m181030_071221_product_unit', 1541393298),
('m181102_122933_order', 1541393299),
('m181102_123037_order_list', 1541393299);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `code`, `id_user`, `status`, `create_at`) VALUES
(1, 'JiLT898472', '1', 1, '2018-11-05 05:48:19'),
(2, '20181108075559y77a', '1', 1, '2018-11-08 07:55:59'),
(3, '20181108075638nbFP', '1', 1, '2018-11-08 07:56:38'),
(4, '20181108075711QynZ', '1', 1, '2018-11-08 07:57:11'),
(5, '20181108083038N9RF', '1', 1, '2018-11-08 08:30:38'),
(6, '201811081542039Z61', '1', 1, '2018-11-08 15:42:03'),
(7, '20181110114637PtZt', '1', 1, '2018-11-10 11:46:37'),
(8, '20181110115650NCR9', '23', 1, '2018-11-10 11:56:50'),
(9, '20181114090240IkSG', '15', 1, '2018-11-14 09:02:40'),
(10, '2018111508292335eT', '40', 1, '2018-11-15 08:29:23'),
(11, '20181116113356dA0v', '40', 1, '2018-11-16 11:33:56'),
(12, '20181116133440sHUx', '40', 1, '2018-11-16 13:34:40'),
(13, '20181121131035rqrx', '15', 1, '2018-11-21 13:10:35'),
(14, '20181121131438g24w', '15', 1, '2018-11-21 13:14:38'),
(15, '20181122101105dgN1', '36', 1, '2018-11-22 10:11:05'),
(16, '20181123084820Lx7-', '40', 1, '2018-11-23 08:48:20'),
(17, '20181126102833wibe', '21', 1, '2018-11-26 10:28:33'),
(18, '20181206090726n0RW', '39', 1, '2018-12-06 09:07:26'),
(19, '20181212141234hRnY', '23', 1, '2018-12-12 14:12:34'),
(20, '20181212141705_K_r', '15', 1, '2018-12-12 14:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `id_order` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `id_product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `id_order`, `id_product`, `quantity`, `create_at`) VALUES
(1, '1', '1', 2, '2018-11-05 05:48:19'),
(2, '1', '2', 2, '2018-11-05 05:48:19'),
(3, '20181108075638nbFP', '1', 1, '2018-11-08 07:56:38'),
(4, '20181108083038N9RF', '1', 3, '2018-11-08 08:30:38'),
(5, '20181108083038N9RF', '2', 2, '2018-11-08 08:30:38'),
(6, '201811081542039Z61', '2', 1, '2018-11-08 15:42:03'),
(7, '20181110114637PtZt', '2', 10, '2018-11-10 11:46:37'),
(8, '20181110115650NCR9', '2', 15, '2018-11-10 11:56:50'),
(9, '20181114090240IkSG', '2', 5, '2018-11-14 09:02:40'),
(10, '20181114090240IkSG', '89', 2, '2018-11-14 09:02:40'),
(11, '20181114090240IkSG', '91', 1, '2018-11-14 09:02:40'),
(12, '20181114090240IkSG', '30', 1, '2018-11-14 09:02:40'),
(13, '20181114090240IkSG', '65', 3, '2018-11-14 09:02:40'),
(14, '20181114090240IkSG', '53', 3, '2018-11-14 09:02:40'),
(15, '20181114090240IkSG', '50', 5, '2018-11-14 09:02:40'),
(16, '20181114090240IkSG', '23', 5, '2018-11-14 09:02:40'),
(17, '2018111508292335eT', '69', 6, '2018-11-15 08:29:23'),
(18, '2018111508292335eT', '35', 1, '2018-11-15 08:29:23'),
(19, '20181116113356dA0v', '57', 6, '2018-11-16 11:33:56'),
(20, '20181116133440sHUx', '58', 6, '2018-11-16 13:34:40'),
(21, '20181121131035rqrx', '11', 1, '2018-11-21 13:10:35'),
(22, '20181121131438g24w', '13', 1, '2018-11-21 13:14:38'),
(23, '20181121131438g24w', '14', 1, '2018-11-21 13:14:38'),
(24, '20181121131438g24w', '12', 1, '2018-11-21 13:14:38'),
(25, '20181121131438g24w', '72', 1, '2018-11-21 13:14:38'),
(26, '20181122101105dgN1', '2', 5, '2018-11-22 10:11:05'),
(27, '20181123084820Lx7-', '2', 6, '2018-11-23 08:48:20'),
(28, '20181123084820Lx7-', '27', 3, '2018-11-23 08:48:20'),
(29, '20181123084820Lx7-', '43', 1, '2018-11-23 08:48:20'),
(30, '20181123084820Lx7-', '55', 4, '2018-11-23 08:48:20'),
(31, '20181126102833wibe', '88', 1, '2018-11-26 10:28:33'),
(32, '20181206090726n0RW', '82', 1, '2018-12-06 09:07:26'),
(33, '20181212141234hRnY', '2', 1, '2018-12-12 14:12:34'),
(34, '20181212141705_K_r', '2', 1, '2018-12-12 14:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `lower` int(11) DEFAULT NULL,
  `instoke` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `code`, `img`, `category`, `unit`, `Description`, `location`, `price`, `status`, `lower`, `instoke`, `create_at`) VALUES
(1, 'ทดสอบ', 'Q3cKVoAKcu', 'd11607a83d9d2f3db78074a23e0b9938.jpg', 1, 1, '', '$this->string()', 500, 1, 10, 0, '2018-10-31 03:33:19'),
(2, 'กระดาษ A4', 'praFVj_bt_', '3892d986b0d58a19cd56c078cf29587a.jpg', 1, 1, '', '', 115, NULL, NULL, 12, NULL),
(3, 'กระดาษ A4 สีชมพู', 'OyvJH7lDrf', 'ac5a4599c1fc00edf5b979441f430389.jpg', 1, 1, '', '', 100, NULL, NULL, 3, NULL),
(4, 'กระดาษ A4 สีฟ้า', '5KvH9ZwEIt', '03b725ff8de3b3d07163d8ad806f8b5d.jpg', 1, 1, '', '', 95, NULL, NULL, 16, NULL),
(6, 'กระดาษ A4 สีเขียว (100)', '_QNpufaE4Q', 'a861ed0083eebb6b6dde7072e55c9042.jpg', 1, 1, '', '', 100, NULL, NULL, 6, NULL),
(8, 'กระดาษ A4 สีเหลือง (100)', 'Yw6OllItS9', 'b5cb49af19cdcf026ab98f2099bf8290.jpg', 1, 1, '', '', 100, NULL, NULL, 6, NULL),
(9, 'กรรไกร 9นิ้ว', 'pLCwfWlvIV', '1802d478ddb9a54cc6cb318d7cdcbe88.jpg', 1, 4, '', '', 85, NULL, NULL, 1, NULL),
(10, 'กาวยู้ฮู', '7-9s9Q1xFE', 'ec1b3bf2981a43ea685278525bf78585.jpg', 1, 4, '', '', 69, NULL, NULL, 10, NULL),
(11, 'คลิปดำ No.108', 'GPG2wZXLhD', '86bdb0bd671504fc950c00e225c1296f.jpg', 1, 3, '', '', 84, NULL, NULL, 0, NULL),
(12, 'คลิปดำ No.109', 'alI5DGQ7oq', '4a568d4c21fc5a07da726ce81e64d7da.jpg', 1, 3, '', '', 72, NULL, NULL, 8, NULL),
(13, 'คลิปดำ No.110', 'PBz18zfJJX', 'c14d2d891a3de37871cd0368e781d0f7.jpg', 1, 3, '', '', 48, NULL, NULL, 7, NULL),
(14, 'คลิปดำ No.111', 'SWZ7X4g63Q', '98643be7db16cd1b690c7da0440e4067.jpg', 1, 3, '', '', 36, NULL, NULL, 5, NULL),
(15, 'เครื่องเจาะกระดาษ-เล็ก', 'M_DHma3P1h', '241b117ec0d8484992a488572dfb2a24.jpg', 1, 4, '', '', 175, NULL, NULL, 3, NULL),
(16, 'เครื่องเจาะกระดาษ-ใหญ่', 'XEIyiJXL61', '891cc6dd49a683431c5c8f2b2c4eaa1c.jpg', 1, 4, '', '', 750, NULL, NULL, 1, NULL),
(17, 'เครื่องเย็บกระดาษ No.10', 'BxjRGVzHr2', '58ea8d74dd3bfe27be17cfe78998f970.jpg', 1, 4, '', '', 75, NULL, NULL, 8, NULL),
(18, 'เครื่องเย็บกระดาษ No.88', 'wHKb3_MoVf', '61a772992f586c776c28113ac0f517f4.jpg', 1, 4, '', '', 325, NULL, NULL, 1, NULL),
(19, 'เครื่องเย็บกระดาษ HD 50', 'PDicztpoJi', 'c8b90c052286f0cd57e3e2e98e2b5e28.jpg', 1, 4, '', '', 85, NULL, NULL, 1, NULL),
(20, 'เครื่องเหลาดินสอ', 'MN3v81BTkk', 'ec65bfb710d6833881fd1399821fa52e.jpg', 1, 4, '', '', 380, NULL, NULL, 1, NULL),
(21, 'คัตเตอร์-ใหญ่', 'Vp4St-0HO8', '205d8b7b220f6c7cb98554749c53c4e3.jpg', 1, 4, '', '', 50, NULL, NULL, 1, NULL),
(22, 'คัตเตอร์-เล็ก', 'Ki_LdPg7gs', 'e4a9bf0a1dc78f18535b958338f25fa4.jpg', 1, 4, '', '', 35, NULL, NULL, 4, NULL),
(23, 'เชือกมัดสำนวน', 'IIqFjTWY7h', '25e0cd688b34a4ab459a8ecfa0e2e797.jpg', 1, 5, '', '', 25, NULL, NULL, 16, NULL),
(24, 'ซองครุฑสีน้ำตาลพับ3', 'N6rdEDNWv6', '985bd5eba65dd831dfdc01e47664aecc.jpg', 1, 6, '', '', 2, NULL, NULL, 150, NULL),
(25, 'ซองครุฑสีน้ำตาลพับ2', 'SAO09VrQs-', '', 1, 6, '', '', 1, NULL, NULL, 1750, NULL),
(26, 'ซองครุฑสีน้ำตาล A4 ขยายข้าง', 'T0ttmhn61i', '', 1, 6, '', '', 5, NULL, NULL, 350, NULL),
(27, 'ดินสอ HB', 'Jz-1k31AH4', '', 1, 7, '', '', 4, NULL, NULL, 30, NULL),
(28, 'ดินสอ 2B', 'VY6IG1Bbrs', '', 1, 7, '', '', 5, NULL, NULL, 8, NULL),
(29, 'ตลับชาติ-สีดำ', 'fwX1JtPW3e', '', 1, 8, '', '', 30, NULL, NULL, 3, NULL),
(30, 'ตลับชาติ-สีแดง', 'HE6rdP-2r0', '', 1, 8, '', '', 35, NULL, NULL, 2, NULL),
(31, 'ตลับชาติ-สีน้ำเงิน', '9KZkNKtHPB', '', 1, 8, '', '', 35, NULL, NULL, 2, NULL),
(32, 'ที่ดึงลวดเย็บกระดาษ', 'p-Z5_XWvXA', '', 1, 4, '', '', 28, NULL, NULL, 1, NULL),
(33, 'เทปกาวสีน้ำตาล', '7XdLrmDRk_', '', 1, 5, '', '', 25, NULL, NULL, 30, NULL),
(34, 'เทปกาวผ้า (แล็กซีน) ขนาด 2 นิ้ว', 'JmFi70wIos', '', 1, 5, '', '', 75, NULL, NULL, 1, NULL),
(35, 'เทปกาวผ้า (แล็กซีน) ขนาด 1.5 นิ้ว', 'OUR1lR0Ma3', '', 1, 5, '', '', 55, NULL, NULL, 0, NULL),
(36, 'เทปกาวผ้า (แล็กซีน) ขนาด 2.5 นิ้ว', 'PjULj4RAT2', '', 1, 5, '', '', 100, NULL, NULL, 2, NULL),
(37, 'เทปกาวสองหน้า-ชนิดบาง', 'e4nP-KV2FW', '', 1, 5, '', '', 28, NULL, NULL, 10, NULL),
(38, 'เทปกาวสองหน้า-ชนิดหนา', 'AVeq-x1JKW', '', 1, 5, '', '', 220, NULL, NULL, 1, NULL),
(39, 'น้ำยาลบคำผิด', 'DYIbuVV0BM', '', 1, 4, '', '', 75, NULL, NULL, 14, NULL),
(40, 'ปากกาดำ', 'sHN44YrMAA', '', 1, 10, '', '', 5, NULL, NULL, 16, NULL),
(41, 'ปากกาแดง', 'mG8jM7KMJE', '', 1, 10, '', '', 5, NULL, NULL, 36, NULL),
(42, 'ปากกาน้ำเงิน', 'AeqgnhLm8G', '', 1, 10, '', '', 5, NULL, NULL, 73, NULL),
(43, 'ปากกาเขียนไวท์บอร์ด-น้ำเงิน', 'ZJ0v9DWdfN', '', 1, 10, '', '', 20, NULL, NULL, 1, NULL),
(44, 'ปากกาเคมี 2 หัว-สีดำ (16)', 'oa8p4f2R4K', '', 1, 10, '', '', 16, NULL, NULL, 2, NULL),
(45, 'ปากกาเคมี 2 หัว-สีดำ (15)', 'QT-nN2Q6P9', '', 1, 10, '', '', 15, NULL, NULL, 3, NULL),
(46, 'ปากกาเคมี 2 หัว-สีแดง (16)', '-61bPkVs04', '', 1, 10, '', '', 16, NULL, NULL, 14, NULL),
(47, 'ปากกาเคมี 2 หัว-สีแดง (15)', 'vs-TicWcAO', '', 1, 10, '', '', 15, NULL, NULL, 1, NULL),
(48, 'เป๊กทองเหลือง 1 นิ้ว (45)', 'djFeJF7NXw', '', 1, 3, '', '', 45, NULL, NULL, 11, NULL),
(49, 'เป๊กทองเหลือง 1 นิ้ว (48)', 'lYQx8O6Gz2', '', 1, 3, '', '', 48, NULL, NULL, 12, NULL),
(50, 'เป๊กทองเหลือง 1.5 นิ้ว', '6nRZ2QI6hB', '', 1, 3, '', '', 70, NULL, NULL, 13, NULL),
(51, 'เป๊กทองเหลือง 2 นิ้ว (75)', 'YkR_J5huz4', '', 1, 3, '', '', 75, NULL, NULL, 22, NULL),
(52, 'เป๊กทองเหลือง 2 นิ้ว (80)', 'u4KYICdFrF', '', 1, 3, '', '', 80, NULL, NULL, 12, NULL),
(53, 'เป๊กทองเหลือง 3 นิ้ว', 'uFx2hEzsDx', '', 1, 3, '', '', 95, NULL, NULL, 6, NULL),
(54, 'ผ้าหมึกพิมพ์ดีด', 'tzQ61ef2lH', 'c645410b14bac89a838acd2bad159c25.jpg', 1, 3, '', '', 75, NULL, NULL, 3, NULL),
(55, 'แฟ้มแขวน', 'wo1WtA2snP', '', 1, 12, '', '', 20, NULL, NULL, 71, NULL),
(56, 'แฟ้มพลาสติกแบบห่วง', 'E-R7Yl9KFl', '', 1, 12, '', '', 60, NULL, NULL, 4, NULL),
(57, 'แฟ้มอ่อน (ขนาดF4)', 'LZaUZ4FhPN', '', 1, 12, '', '', 10, NULL, NULL, 5, NULL),
(58, 'แฟ้มอ่อน (ขนาดA4)', 'njtqv91KOT', '', 1, 12, '', '', 10, NULL, NULL, 6, NULL),
(59, 'แฟ้มสันแคบหนา 2 นิ้ว', 'nR1FVFSFL6', '', 1, 12, '', '', 75, NULL, NULL, 17, NULL),
(60, 'แฟ้มสันกว้างหนา 3 นิ้ว', 'GeT1OYJUUV', '', 1, 12, '', '', 75, NULL, NULL, 18, NULL),
(61, 'แฟ้มเสนอเซ็น', '5-FMImLtyQ', '', 1, 12, '', '', 150, NULL, NULL, 1, NULL),
(62, 'ไม้บรรทัด', 'D58_XK-s5v', '', 1, 4, '', '', 5, NULL, NULL, 7, NULL),
(63, 'ยางลบ', 'JuZNxNPJ8t', '', 1, 4, '', '', 5, NULL, NULL, 48, NULL),
(64, 'ลวดเสียบกระดาษ', 'DzUnCPJgqY', '', 1, 3, '', '', 10, NULL, NULL, 107, NULL),
(65, 'ลวดเย็บกระดาษ No.10', '36kzSfh1c3', '', 1, 3, '', '', 8, NULL, NULL, 36, NULL),
(66, 'ลวดเย็บกระดาษ No.35', 'VHpkvqVNmk', '', 1, 3, '', '', 7, NULL, NULL, 42, NULL),
(67, 'ลวดเย็บกระดาษ No. M8', 'hb9pFmXJmO', '', 1, 3, '', '', 12, NULL, NULL, 16, NULL),
(68, 'ลวดเย็บกระดาษ T3-10MB', 'YLmIjI5CFY', '', 1, 3, '', '', 35, NULL, NULL, 3, NULL),
(69, 'สก็อตเทปใส', 'wRNm9le1d8', '', 1, 5, '', '', 27, NULL, NULL, 17, NULL),
(70, 'สมุดบันทึก 4/150 80p', 'v4R74FJUk_', '', 1, 13, '', '', 220, NULL, NULL, 3, NULL),
(71, 'สมุดบัญชีน้ำเงิน-ใหญ่', 'B2tzTXCzUo', '', 1, 13, '', '', 80, NULL, NULL, 16, NULL),
(72, 'สมุดบัญชีน้ำเงิน-เล็ก', 'oRbZvEPf8E', '', 1, 13, '', '', 65, NULL, NULL, 27, NULL),
(73, 'หมึกเติมแท่นประทับตรา-สีดำ', 'o5wjUUjZDb', '', 1, 14, '', '', 10, NULL, NULL, 4, NULL),
(74, 'หมึกเติมแท่นประทับตรา-สีแดง', 'PVHHNNaS8X', '', 1, 14, '', '', 35, NULL, NULL, 7, NULL),
(75, 'หมึกเติมเครื่องรันนิ่ง', '4ECvrlWMmO', '', 1, 3, '', '', 95, NULL, NULL, 3, NULL),
(76, 'หมึกถ่ายเอกสารริโก้', 'hSbw9XYTiR', '', 1, 3, '', '', 2500, NULL, NULL, 3, NULL),
(77, 'หมึกเครื่องอัดสำเนา ริโก้ DX3443', 'eABMOmwCoy', '', 1, 3, '', '', 550, NULL, NULL, 5, NULL),
(78, 'หมึกถ่ายเอกสาร kyocera tr-6329', 'HBJti-IXyk', '', 1, 3, '', '', 4900, NULL, NULL, 1, NULL),
(79, 'เหล็กแทงสำนวน', 'LaUx2sfHEw', '', 1, 4, '', '', 35, NULL, NULL, 4, NULL),
(80, 'ถ้วยกระดาษ', 'kfF7vtMViv', '', 4, 3, '', '', 1250, NULL, NULL, 1, NULL),
(81, 'ถ่าน 2A', 'sjCE7_s6vU', '', 4, 15, '', '', 6, NULL, NULL, 40, NULL),
(82, 'หมึกเลเซอร์ Brother 2280', 'DDrzZqoteG', '', 2, 3, '', '', 2300, NULL, NULL, 2, NULL),
(83, 'ผงหมึกเลเซอร์ brother 2025', '-YBmWT3KPi', '', 2, 15, '', '', 2050, NULL, NULL, 2, NULL),
(84, 'ผงหมึกเลเซอร์ brother 3250', 'AdIcUkgfx0', '', 2, 3, '', '', 5800, NULL, NULL, 1, NULL),
(85, 'ผงหมึกเลเซอร์ XEROX 3435', 'YI8OAPMxOq', '', 2, 3, '', '', 4300, NULL, NULL, 2, NULL),
(86, 'หมึกพิมพ์samsung 3050 N', 'XWBtVA5NVE', '', 2, 3, '', '', 5800, NULL, NULL, 2, NULL),
(87, 'หมึกพิมพ์ samsung ML-2250', 'MxXVPz6eDz', '', 2, 3, '', '', 4300, NULL, NULL, 1, NULL),
(88, 'หมึกพิมพ์ CANNON HP 12A', 'lfS3tVgoKd', '', 2, 3, '', '', 2700, NULL, NULL, 1, NULL),
(89, 'หมึกพิมพ์ OKI 391', 'Y-7NCMEBMT', '', 2, 3, '', '', 350, NULL, NULL, 2, NULL),
(90, 'หมึกพิมพ์ HP 80A', 'kcZGRkaEq9', '', 2, 3, '', '', 3750, NULL, NULL, 1, NULL),
(91, 'หมึกพิมพ์ HP 26A', 'XghxSE7M2G', '', 2, 3, '', '', 4150, NULL, NULL, 2, NULL),
(92, 'หมึกพิมพ์ samsungb 203u 203s', 'NvvtiYswZW', '', 2, 3, '', '', 3700, NULL, NULL, 2, NULL),
(93, 'หมึกพิมพ์ cannon 328', 'a6Ax8FQKNP', '', 2, 3, '', '', 2550, NULL, NULL, 1, NULL),
(94, 'หมึกพิมพ์ยี่ห้อ EPSON LQ-300', 'rkCWe4tA4M', '', 2, 3, '', '', 160, NULL, NULL, 1, NULL),
(95, 'หมึกชนิดเติม Brother (bk)', 'umSn2LganY', '', 2, 14, '', '', 280, NULL, NULL, 3, NULL),
(96, 'หมึกชนิดเติม Brother', 'HUCqO_10jo', '', 2, 14, '', '', 250, NULL, NULL, 3, NULL),
(97, 'หมึกชนิดเติม Brother (M)', 'KCS3hQKknh', '', 2, 14, '', '', 250, NULL, NULL, 3, NULL),
(98, 'หมึกชนิดเติม Brother (ํY)', 'PBfGaQTGXn', '', 2, 14, '', '', 250, NULL, NULL, 3, NULL),
(99, 'ปลั๊กไฟยาว 5 เมตร', 'krC9VP80p1', '', 3, 4, '', '', 550, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_catalog`
--

CREATE TABLE `product_catalog` (
  `id` int(11) NOT NULL,
  `name_catalog` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) DEFAULT NULL,
  `detail_catalog` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_catalog`
--

INSERT INTO `product_catalog` (`id`, `name_catalog`, `order`, `detail_catalog`) VALUES
(1, 'วัสดุสำนักงาน', 1, ''),
(2, 'วัสดุคอมพิวเตอร์', 2, ''),
(3, 'วัสดุไฟฟ้า', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_unit`
--

CREATE TABLE `product_unit` (
  `id` int(11) NOT NULL,
  `name_unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `detail_unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_unit`
--

INSERT INTO `product_unit` (`id`, `name_unit`, `detail_unit`) VALUES
(1, 'รีม', NULL),
(2, 'ใบ', NULL),
(3, 'กล่อง', NULL),
(4, 'อัน', NULL),
(5, 'ม้วน', NULL),
(6, 'ซอง', NULL),
(7, 'แท่ง', NULL),
(8, 'ตลับ', NULL),
(9, 'ผืน', NULL),
(10, 'ด้าม', NULL),
(11, 'คู่', NULL),
(12, 'แฟ้ม', NULL),
(13, 'เล่ม', NULL),
(14, 'ขวด', NULL),
(15, 'ก้อน', NULL),
(16, 'ไม้', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_card` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `bloodtype` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idc` smallint(6) DEFAULT NULL,
  `dep` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `st` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `id_card`, `fullname`, `name`, `sname`, `img`, `birthday`, `bloodtype`, `idc`, `dep`, `address`, `postcode`, `phone`, `create_at`, `updated_at`, `st`) VALUES
(1, '1', NULL, 'นาย', 'Admin', 'S-Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(12, '9', '', 'นางสาวสุทธินี ตรงชิต', '', NULL, '372553005ff78378a9f3946b00e6c377.jpg', NULL, 'A', NULL, 'เจ้าพนักงานศาลยุติธรรมชำนาญการ', '', '', '0909804895', '2017-06-12 01:01:03', '2018-11-10 06:49:31', 3),
(15, '12', '', 'นางสาวดลยา เยาวหลี', '', NULL, '6b4bab86276493cbfa467640bd3397b8.jpg', NULL, 'A', NULL, 'เจ้าพนักงานศาลยุติธรรมปฏิบัติการ', '', '', '0895213842', '2017-06-12 01:11:15', '2018-11-10 06:49:31', 8),
(16, '13', '', 'นายเอกชวัทธน์  สาระเกตุ', '', NULL, 'c9fa7087314d3c45610c77a3b53e2595.jpg', NULL, 'A', NULL, 'เจ้าพนักงานศาลยุติธรรมปฏิบัติการ', '', '', '0867526064', '2017-06-12 01:11:46', '2018-11-10 06:49:31', 8),
(17, '14', '1739900030097', 'นางสาวอภิญญา ท้วมจุ้ย', '', NULL, '007b52accf58e1794cea95d4918f0eea.jpg', NULL, 'A', NULL, 'นักจิตวิทยาปฏิบัติการ', '', '', '', '2017-05-17 23:18:21', '2018-11-10 06:49:31', 9),
(18, '15', '', 'นางสาววาสินี  กมลกุล', '', NULL, 'ee12bfe72ce4448543b467820ed2d47b.jpg', NULL, 'A', NULL, 'เจ้าพนักงานศาลยุติธรรมปฏิบัติการ', '', '', '0862699405', '2017-06-12 01:12:44', '2018-11-10 06:49:31', 11),
(19, '16', '', 'นางสาวโชติกา  ดีดอนกลาย', '', NULL, '5f339992a7c6116fdcb02c74c58b74d7.jpg', NULL, 'A', NULL, 'เจ้าหน้าที่ศาลยุติธรรมชำนาญงาน', '', '', '0868862701', '2017-06-12 01:15:03', '2018-11-10 06:49:31', 13),
(21, '18', '', 'นางสาวพิมพ์พร สาตร์สาคร', '', NULL, '6a32198c7132db02b0064afcf3d400f2.jpg', NULL, 'A', NULL, 'เจ้าหน้าที่ศาลยุติธรรมปฏิบัติงาน', '', '', '', '2017-05-17 23:22:49', '2018-11-10 06:49:31', 15),
(22, '19', '', 'นางวลัยพร  สายทอง', '', NULL, '172a1725a3335043169ce95f5caad5bb.jpg', NULL, 'A', NULL, 'เจ้าหน้าที่ศาลยุติธรรมชำนาญงาน', '', '', '', '2018-01-30 19:37:05', '2018-11-10 06:49:31', 13),
(23, '20', '', 'นางนุจรีย์  สุขจินดา', '', NULL, '61960b6e0f79e06e70402bc113d3c085.jpg', '2017-10-10', 'B', NULL, 'เจ้าหน้าที่ศาลยุติธรรมชำนาญงาน', '', '', '09-1010-0159', '2018-01-30 19:38:08', '2018-11-10 06:49:31', 14),
(24, '21', '', 'นางสาวนงนุช ใจเสงี่ยม', '', NULL, '43efb207fd5c6c73929b19c08439a829.jpg', NULL, 'A', NULL, 'เจ้าหน้าที่ศาลยุติธรรมปฏิบัติงาน', '', '', '08-1011-3850', '2018-01-30 19:40:10', '2018-11-10 06:49:31', 16),
(25, '22', '', 'นายวิชาญ  วุฒิชาติวิจิตรกุล', '', NULL, '640dccdd6cbc054ad750326afcec9b13.jpg', NULL, 'A', NULL, 'พนักงานขับรถยนต์', '', '', '0844124141', '2017-06-12 01:14:22', '2018-11-10 06:49:31', 19),
(26, '23', '3-7601-00601-15-2', 'นายพเยาว์ สนพลาย', '', NULL, 'afb5848ca1725170ea9dd7b3b156dcc1.jpg', '1981-02-12', 'A', NULL, 'พนักงานคอมพิวเตอร์', '41 หมู่ ๓ ต.นาพันสาม อ.เมือง จ.เพชรบุรี ', '76000', '08-3831-9929', '2017-06-14 19:56:52', '2018-11-10 06:49:31', 19),
(27, '24', '', 'นายฐานัน อยู่หนุน', '', NULL, '3fa80667297206f11d9dea1b6fb39f34.jpg', NULL, 'A', NULL, 'พนักงานสถานที่', '', '', '', '2017-05-17 23:24:14', '2018-11-10 06:49:31', 20),
(31, '28', '', 'ทดสอบ', '', NULL, '', NULL, 'A', NULL, 'ผู้อำนวยการสำนักงานประจำศาลฯ', '', '', '', '2018-07-22 19:27:20', '2018-11-10 06:49:31', 99),
(32, '29', '3-1018-01232-41-9', 'นายภาสกร  กุลภู่พรทิพย์', '', NULL, '251d5e77c31e96c31938aa30d7b7fe13.jpg', '1958-05-13', 'A', NULL, 'ผู้อำนวยการสำนักงานประจำศาลฯ', '30/4 หมู่ 4 ซอย เนติรรม แขวงศาลากลาง เขต บางกรวย จ.นนทบุรี ', '', '08-9495-1038', '2017-06-14 19:56:30', '2018-11-10 06:49:31', 1),
(33, '30', '3-1001-00982-46-1', 'นางสาววิลาสินี  ศรสุวรรณ', '', NULL, 'c1b5f1f9637bb5e22342021dbaf34290.jpg', '1980-12-03', 'O', NULL, 'นักวิชาการเงินและบัญชีชำนาญการ', '21/2 หมู่ 3 แขวง หนองจอก เขตหนองจอก กรุงเทพฯ', '10530', '08-9203-9106', '2018-01-30 19:33:00', '2018-11-10 06:49:31', 5),
(36, '33', '3770100351687', 'นางสาวภัณฑิลา  จันทวงษ์', '', NULL, '375c36677ae05c7a387210add0fd7f35.jpg', '1980-05-29', 'B', NULL, 'เจ้าหน้าที่ศาลยุติธรรมปฏิบัติงาน', '', '77000', '0623897818', '2017-06-11 21:57:57', '2018-11-10 06:49:31', 23),
(37, '34', '1779900122196', 'นางสาววรรณพร  โพธิ์อำไพ', '', NULL, '', '1991-07-22', 'A', NULL, 'เลขาสมทบ', '509/1 ตำบลอ่าวน้อย อ.เมือง จังหวัดประจวบคีรีขันธ์ ', '77210', '090-4380847', '2017-05-21 18:56:32', '2018-11-10 06:49:31', 50),
(38, '35', '3-7702-00243-60-6', 'นางสาวเนตรนภา  เกิดเปี่ยม', '', NULL, '3e28f4dec7ecc18534a0d81b7db8be21.jpg', '1980-09-17', 'A', NULL, 'เจ้าพนักงานศาลยุติธรรมชำนาญการ', '711 ม.7 ต.กุยบุรี จ.ประจวบฯ ', '77150', '09-5364-9846', '2017-11-21 21:48:58', '2018-11-10 06:49:31', 4),
(39, '36', '1869900059884', 'นางสาววิชชุดา  ศุภวิมุติ', '', NULL, 'a8804578423f330a9b4fea9882148a70.jpg', '1986-10-30', 'O', NULL, 'เจ้าพนักงานการเงินและบัญชีปฏิบัติงาน', '2/1 หมู่ 4 ต.นาทุ่ง อ.เมือง จ.ชุมพร ', '86000', '0887687703', '2017-06-11 23:30:27', '2018-11-10 06:49:31', 17),
(40, '37', '1-2408-00136-63-9', 'นางสาวอรณี  คะสุระ', '', NULL, '0d59517e0097e0c36bffad63e4c0cc45.jpg', '1994-01-01', 'O', NULL, 'นิติกร', '42 ซ.3 สุขสมบูรณ์ ถ.ดอนเหียง ต.ประจวบคีรีขันธ์ อ.ประจวบคีรีขันธ์ จ.ประจวบคีรีขันธ์ ,ที่อยู่ปัจจุบัน สำนักสงฆ์พุทธสิงขร หมู่ 6 บ้านด่านสิงขร ต.คลองวาฬ อ.เมือง จ.ประจวบคีรีขันธ์ 77000', '77000', '09-2534-6272', '2017-08-02 21:24:59', '2018-11-10 06:49:31', 22),
(41, '38', '3-4511-00016-90-3', 'นางแววตา  พรมบุตร', '', NULL, '86bb81b14e27c0a57807889ac4511bf3.jpg', '1973-09-21', 'O', NULL, 'นิติกรชำนาญการ', '529/228 หมู่ 22 บ้านแก่นทองธานี ซ.12 ตำบลบ้านเป็ด อ.เมือง จ.ขอนแก่น 40000', '40000', '09-8260-7761', '2018-01-08 20:10:58', '2018-11-10 06:49:31', 6),
(42, '39', '3-4099-00634-98-6', 'นางสาวฐิตาภา เชื้อทอง', '', NULL, 'c600db525d1fc94fa5fe35396f765840.jpg', '1974-06-07', 'A', NULL, 'นิติกรชำนาญการ', '160/169 หมู่ 2 ถนน ราตะผดุง ตำบล ในเมือง อำเภอเมือง จ.ขอนแก่น', '40000', '08-1380-7313', '2017-11-29 19:40:03', '2018-11-10 06:49:31', 7),
(43, '40', '3-7701-00076-61-9', 'นางสาวดวงกมล  กลัดสมบูรณ์', '', NULL, 'ac197ff05997b381c517f2b4b88ab7e9.jpg', '1968-12-07', 'A', NULL, 'เจ้าพนักงานศาลยุติธรรมชำนาญการ', '543/25 หมู่ 2 ถ.เพชรเกษม ต.เกาะหลัก อ.เมือง จ.ประจวบคีรีขันธ์', '77000', '08-1946-4369', '2017-12-03 21:11:11', '2018-11-10 06:49:31', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ycL9iR8or0IKi3HeIavohF4CNqfqxfNw', '$2y$13$Ya8DAcFBQOS2TXC0JGAndeZwf8kFfr2ZjDu.AxProhFGCsv0C4XHC', 'LNUi7vtfO9I4foNzSOHlIQ66s3x32O7E_1541393298', 'e29ckg@gmail.com', 9, 10, 0, 0),
(9, 'boom', 'x44Q-Hm3bXo2WxHl2qMBe1NDmbPU6Fn3', '$2y$13$D/KmYOo0wE/TUTugOU3/R.ImmdU2mJWAx9tgYgfpli4/u4LUFENku', NULL, 'boom@pkkjc.org', NULL, 10, NULL, NULL),
(12, '2520', '48JMqpoYsGXe0Fv3_blAwrROX1pQVnlG', '$2y$13$9Nt.6aaxYVz45CMUy0PDGuY/FsCTECtVItwSkGbq8NAN4C7tMQlwC', NULL, '2520@pkkjc.org', NULL, 10, NULL, NULL),
(13, '5971', 'RZI3Bo5mKGJNrnESu87ljwSNHDWMnuwJ', '$2y$13$NmWazAcGEYx5LLclTVWLmO1sDKEBEarMCdojdICRzJNYSCPvrnLzy', NULL, '5971@pkkjc.org', NULL, 10, NULL, NULL),
(14, 'user24', 'x2JTP3iWHBd4_Xsh2Fg1KYA22_IL5IVp', '$2y$13$28wThjvvHGj1DMDFYH/2BODplvdyWmIth7fn1zO86P2SOrunGdQAe', NULL, 'user24@pkkjc.org', NULL, 10, NULL, NULL),
(15, '10015', 'm5LDWGeBUNa9QzUtLNmNim6wK_6nr3Pt', '$2y$13$6tR4figfNJPBanqz/jQ7..HUvZEgL022ulHW6gtSKwWhqPACddGzC', NULL, '10015@pkkjc.org', NULL, 10, NULL, NULL),
(16, 'id1817', 'LG1b7thpFM8AQGAnP6XSQHx24tG5JAts', '$2y$13$Ne/g.lNnrMNSpkD/19Dx9ugTy.Sq/uoBmy/lacUQcHO2PcVL8e0Ya', NULL, 'id1817@pkkjc.org', NULL, 10, NULL, NULL),
(18, '10020', '1WFkt1tzmcUFFOi8yVMarD0vKsRJw6kE', '$2y$13$A1X/Qtn35MyQEbgq5pJyiucgST.lhdIPW.x/hYddry9t9KJkZRzgi', NULL, '10020@pkkjc.org', NULL, 10, NULL, NULL),
(19, 'id08', '2jIzMJZ6fv1ACe18KT9jYgDhqVeB-fkD', '$2y$13$c3P0telPZE4gqjm7a3cNeO7cf08Ne.w6Tc.Pu.M4PRtFpw5yaRAyi', NULL, '0008@pkkjc.org', NULL, 10, NULL, NULL),
(20, 'kung', 'c6EbBdKccIHEiDvbkEJnRgoXt8GB2qPW', '$2y$13$k.BQPsSh1RJ9J8mx8e8qeulz9SQ1H4gg.zR3egtn2De.CbhRNBDmK', NULL, '7777@pkkjc.org', NULL, 10, NULL, NULL),
(21, '1122', 'P_3GxGt7QwBgF1KKjW6YNr2b_LBPedTg', '$2y$13$7WaaOqH6RSVIQjEw5FJnGOPf0fS5uV0UZl8cQbyqLj2wBEm2d2ycq', NULL, '1122@pkkjc.org', NULL, 10, NULL, NULL),
(22, '500', 'qApleICEH1NIIhgY4a5xcSYsyhSWDYkK', '$2y$13$n/lL83anhSs86cbl4ziRoeGCBFcZHqzVtdfDFpZEaiEdBolS3OVba', NULL, '500@pkkjc.org', NULL, 10, NULL, NULL),
(23, '9929', 'eo7pTV5Iv04eOMqJwUi__vceB8Mbt1NJ', '$2y$13$.ukIbw1XO85WlQrmCM69rOQkV6s8j2TeLPTZrYSMLiw7WACbJWUE.', NULL, '9929@pkkjc.org', 9, 10, NULL, NULL),
(24, 'id2323', 'vaTRyUB1QZ7YUssfnJj-3Xfg9R1Am9lC', '$2y$13$7qXxumHLHZKF39XqNO/XtOJwBjfW8OSICTwIFHx6iqKLiBAin6KB2', NULL, '2323@pkkjc.org', NULL, 10, NULL, NULL),
(28, 'demo', '1WeYq2HGGwD5TV8-x8spW3U_zDChfA7h', '$2y$13$m5dHLqQCjT7o1mdLFHEU7eDeje35YMynNuYvJtUZp47b66RoSWIS.', NULL, 'demo@demo.com', NULL, 10, NULL, NULL),
(29, '8888', 'SEMQEaQzs7ygbAKC0mm7WTGvLIMILndy', '$2y$13$lMw3xCp0XIaVrQO45bUm2O5/OJfiI5FAcjtYpeWRUzO07.Ej2Hzbi', NULL, '8888@demo.com', NULL, 10, NULL, NULL),
(30, 'ja31223', 'R2j7YM_vV7VYREfKoebU5ttI8zWGdY4_', '$2y$13$S0uCOoLrqt4FyAnEZ4n5K.ZFC6kdxlNWnHR7S1CNeNDe3RzxVl2ce', NULL, 'iEgjKyhq6@coj.go.th', NULL, 10, NULL, NULL),
(33, 'oum', 'eZ4AWeeO9fVqZg0o9eh79yvb5wa8sALF', '$2y$13$/ySbLznRdv6w5Ck6gU8o7O.JFKGDTjML9bM/woRYQCF.k8HP/J8Lq', NULL, 'VuJNl588Q@coj.go.th', NULL, 10, NULL, NULL),
(34, '22196', 'dfaldmxG-FGKrPUyBsZc338oTzp-K1HM', '$2y$13$vF8WGAGOffsEhkAqZI.HnuI7FUBJVeBtvSKYDQik2jV61KXFITEBK', NULL, 'e0atXS92S@coj.go.th', NULL, 10, NULL, NULL),
(35, 'nate', 'VIhUFhMuHuT259IEJboigwLn63Br3CKr', '$2y$13$Yo.5GK/5yCBlejbVvXdA2euJ4UsmlUYR9oBww00dXdNguRixrbYOe', NULL, 'AMJ4llrfS@coj.go.th', NULL, 10, NULL, NULL),
(36, 'kaew', 'm9YhFxT6xS8giorwD8iORKPNlE07zf_b', '$2y$13$nRs6w6ltK2lQt9NLGMlXru7D5pR/rWc5ZhAhuCU.TvbLa4uaxsWjO', NULL, 's-ZiYyXNW@coj.go.th', NULL, 10, NULL, NULL),
(37, 'all', 'vHORjcDJr84WD60P9Lp8C-VoM0fup8Vc', '$2y$13$vXc6Fy.7szTaRYRSwOtRSOso03pYSzGosYGV0oNYmHTeQWqp/yVWu', NULL, 'YnwAGb36u@coj.go.th', NULL, 10, NULL, NULL),
(38, 'waw', 'qCpOFTuPFdbF1IT8F7Fzf3YUcyAGDu46', '$2y$13$UpKYuZMWwqh4dHKWZwI2Ge8FdFm/TVR9U/jGscCnjOivIgLaeRoLq', NULL, 'l1b2jSWgE@coj.go.th', NULL, 10, NULL, NULL),
(39, 'oui', 'We6N4xsyoTCtoivxejDir_Bjyz49xYhq', '$2y$13$ivnolcyY1MNHn6i9JOMhnuUzQALFtpUu2m1l5GBeq8aX1wQMNSWBS', NULL, '4t0qrmKlw@coj.go.th', NULL, 10, NULL, NULL),
(40, 'tuk', 'iYpLCflNPBT6Dxsqf8pfw4ZZO4CuzoIM', '$2y$13$KXOZcYLbTEC0rqcQ9bmGfusyEFmKQ8AHJFEoIfVYwOToWbbwJOuP6', NULL, '4y5lnQ1a_@coj.go.th', NULL, 10, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `product_catalog`
--
ALTER TABLE `product_catalog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_catalog` (`name_catalog`);

--
-- Indexes for table `product_unit`
--
ALTER TABLE `product_unit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_unit` (`name_unit`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `product_catalog`
--
ALTER TABLE `product_catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_unit`
--
ALTER TABLE `product_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
