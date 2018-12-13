-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2018 at 01:05 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cartx`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_st`
--

CREATE TABLE `log_st` (
  `id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `sumtotal` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_code`, `id_user`, `sumtotal`, `status`, `create_at`) VALUES
(1, 'JiLT898472', 1, NULL, 1, '2018-11-05 05:48:19'),
(2, '20181108075559y77a', 1, NULL, 1, '2018-11-08 07:55:59'),
(3, '20181108075638nbFP', 1, NULL, 1, '2018-11-08 07:56:38'),
(4, '20181108075711QynZ', 1, NULL, 1, '2018-11-08 07:57:11'),
(5, '20181108083038N9RF', 1, NULL, 1, '2018-11-08 08:30:38'),
(6, '201811081542039Z61', 1, NULL, 1, '2018-11-08 15:42:03'),
(7, '20181110114637PtZt', 1, NULL, 1, '2018-11-10 11:46:37'),
(8, '20181110115650NCR9', 23, NULL, 1, '2018-11-10 11:56:50'),
(9, '20181114090240IkSG', 15, NULL, 1, '2018-11-14 09:02:40'),
(10, '2018111508292335eT', 40, NULL, 1, '2018-11-15 08:29:23'),
(11, '20181116113356dA0v', 40, NULL, 1, '2018-11-16 11:33:56'),
(12, '20181116133440sHUx', 40, NULL, 1, '2018-11-16 13:34:40'),
(13, '20181121131035rqrx', 15, NULL, 1, '2018-11-21 13:10:35'),
(14, '20181121131438g24w', 15, NULL, 1, '2018-11-21 13:14:38'),
(15, '20181122101105dgN1', 36, NULL, 1, '2018-11-22 10:11:05'),
(16, '20181123084820Lx7-', 40, NULL, 1, '2018-11-23 08:48:20'),
(17, '20181126102833wibe', 21, NULL, 1, '2018-11-26 10:28:33'),
(18, '20181206090726n0RW', 39, NULL, 1, '2018-12-06 09:07:26'),
(19, '20181212141234hRnY', 23, NULL, 1, '2018-12-12 14:12:34'),
(20, '20181212141705_K_r', 15, NULL, 1, '2018-12-12 14:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `order_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `order_code`, `product_code`, `unit_price`, `quantity`, `create_at`) VALUES
(1, '1', 'Q3cKVoAKcu', 500, 2, '2018-11-05 05:48:19'),
(2, '1', 'praFVj_bt_', 115, 2, '2018-11-05 05:48:19'),
(3, '20181108075638nbFP', 'Q3cKVoAKcu', 500, 1, '2018-11-08 07:56:38'),
(4, '20181108083038N9RF', 'Q3cKVoAKcu', 500, 3, '2018-11-08 08:30:38'),
(5, '20181108083038N9RF', 'praFVj_bt_', 115, 2, '2018-11-08 08:30:38'),
(6, '201811081542039Z61', 'praFVj_bt_', 115, 1, '2018-11-08 15:42:03'),
(7, '20181110114637PtZt', 'praFVj_bt_', 115, 10, '2018-11-10 11:46:37'),
(8, '20181110115650NCR9', 'praFVj_bt_', 115, 15, '2018-11-10 11:56:50'),
(9, '20181114090240IkSG', 'praFVj_bt_', 115, 5, '2018-11-14 09:02:40'),
(10, '20181114090240IkSG', 'Y-7NCMEBMT', 350, 2, '2018-11-14 09:02:40'),
(11, '20181114090240IkSG', 'XghxSE7M2G', 4150, 1, '2018-11-14 09:02:40'),
(12, '20181114090240IkSG', 'HE6rdP-2r0', 35, 1, '2018-11-14 09:02:40'),
(13, '20181114090240IkSG', '36kzSfh1c3', 8, 3, '2018-11-14 09:02:40'),
(14, '20181114090240IkSG', 'uFx2hEzsDx', 95, 3, '2018-11-14 09:02:40'),
(15, '20181114090240IkSG', '6nRZ2QI6hB', 70, 5, '2018-11-14 09:02:40'),
(16, '20181114090240IkSG', 'IIqFjTWY7h', 25, 5, '2018-11-14 09:02:40'),
(17, '2018111508292335eT', 'wRNm9le1d8', 27, 6, '2018-11-15 08:29:23'),
(18, '2018111508292335eT', 'OUR1lR0Ma3', 55, 1, '2018-11-15 08:29:23'),
(19, '20181116113356dA0v', 'LZaUZ4FhPN', 10, 6, '2018-11-16 11:33:56'),
(20, '20181116133440sHUx', 'njtqv91KOT', 10, 6, '2018-11-16 13:34:40'),
(21, '20181121131035rqrx', 'GPG2wZXLhD', 84, 1, '2018-11-21 13:10:35'),
(22, '20181121131438g24w', 'PBz18zfJJX', 48, 1, '2018-11-21 13:14:38'),
(23, '20181121131438g24w', 'SWZ7X4g63Q', 36, 1, '2018-11-21 13:14:38'),
(24, '20181121131438g24w', 'alI5DGQ7oq', 72, 1, '2018-11-21 13:14:38'),
(25, '20181121131438g24w', 'oRbZvEPf8E', 65, 1, '2018-11-21 13:14:38'),
(26, '20181122101105dgN1', 'praFVj_bt_', 115, 5, '2018-11-22 10:11:05'),
(27, '20181123084820Lx7-', 'praFVj_bt_', 115, 6, '2018-11-23 08:48:20'),
(28, '20181123084820Lx7-', 'Jz-1k31AH4', 4, 3, '2018-11-23 08:48:20'),
(29, '20181123084820Lx7-', 'ZJ0v9DWdfN', 20, 1, '2018-11-23 08:48:20'),
(30, '20181123084820Lx7-', 'wo1WtA2snP', 20, 4, '2018-11-23 08:48:20'),
(31, '20181126102833wibe', 'lfS3tVgoKd', 2700, 1, '2018-11-26 10:28:33'),
(32, '20181206090726n0RW', 'DDrzZqoteG', 2300, 1, '2018-12-06 09:07:26'),
(33, '20181212141234hRnY', 'praFVj_bt_', 115, 1, '2018-12-12 14:12:34'),
(34, '20181212141705_K_r', 'praFVj_bt_', 115, 1, '2018-12-12 14:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `instoke` int(11) DEFAULT NULL,
  `lower` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `code`, `img`, `category`, `unit`, `Description`, `location`, `status`, `instoke`, `lower`, `create_at`) VALUES
(1, 'ทดสอบ', 'Q3cKVoAKcu', 'd11607a83d9d2f3db78074a23e0b9938.jpg', 1, 1, '', '$this->string()', 1, 0, 10, '2018-10-31 03:33:19'),
(2, 'กระดาษ A4', 'praFVj_bt_', '3892d986b0d58a19cd56c078cf29587a.jpg', 1, 1, '', '', NULL, 12, NULL, NULL),
(3, 'กระดาษ A4 สีชมพู', 'OyvJH7lDrf', 'ac5a4599c1fc00edf5b979441f430389.jpg', 1, 1, '', '', NULL, 3, NULL, NULL),
(4, 'กระดาษ A4 สีฟ้า', '5KvH9ZwEIt', '03b725ff8de3b3d07163d8ad806f8b5d.jpg', 1, 1, '', '', NULL, 16, NULL, NULL),
(6, 'กระดาษ A4 สีเขียว (100)', '_QNpufaE4Q', 'a861ed0083eebb6b6dde7072e55c9042.jpg', 1, 1, '', '', NULL, 6, NULL, NULL),
(8, 'กระดาษ A4 สีเหลือง (100)', 'Yw6OllItS9', 'b5cb49af19cdcf026ab98f2099bf8290.jpg', 1, 1, '', '', NULL, 6, NULL, NULL),
(9, 'กรรไกร 9นิ้ว', 'pLCwfWlvIV', '1802d478ddb9a54cc6cb318d7cdcbe88.jpg', 1, 4, '', '', NULL, 1, NULL, NULL),
(10, 'กาวยู้ฮู', '7-9s9Q1xFE', 'ec1b3bf2981a43ea685278525bf78585.jpg', 1, 4, '', '', NULL, 10, NULL, NULL),
(11, 'คลิปดำ No.108', 'GPG2wZXLhD', '86bdb0bd671504fc950c00e225c1296f.jpg', 1, 3, '', '', NULL, 0, NULL, NULL),
(12, 'คลิปดำ No.109', 'alI5DGQ7oq', '4a568d4c21fc5a07da726ce81e64d7da.jpg', 1, 3, '', '', NULL, 8, NULL, NULL),
(13, 'คลิปดำ No.110', 'PBz18zfJJX', 'c14d2d891a3de37871cd0368e781d0f7.jpg', 1, 3, '', '', NULL, 7, NULL, NULL),
(14, 'คลิปดำ No.111', 'SWZ7X4g63Q', '98643be7db16cd1b690c7da0440e4067.jpg', 1, 3, '', '', NULL, 5, NULL, NULL),
(15, 'เครื่องเจาะกระดาษ-เล็ก', 'M_DHma3P1h', '241b117ec0d8484992a488572dfb2a24.jpg', 1, 4, '', '', NULL, 3, NULL, NULL),
(16, 'เครื่องเจาะกระดาษ-ใหญ่', 'XEIyiJXL61', '891cc6dd49a683431c5c8f2b2c4eaa1c.jpg', 1, 4, '', '', NULL, 1, NULL, NULL),
(17, 'เครื่องเย็บกระดาษ No.10', 'BxjRGVzHr2', '58ea8d74dd3bfe27be17cfe78998f970.jpg', 1, 4, '', '', NULL, 8, NULL, NULL),
(18, 'เครื่องเย็บกระดาษ No.88', 'wHKb3_MoVf', '61a772992f586c776c28113ac0f517f4.jpg', 1, 4, '', '', NULL, 1, NULL, NULL),
(19, 'เครื่องเย็บกระดาษ HD 50', 'PDicztpoJi', 'c8b90c052286f0cd57e3e2e98e2b5e28.jpg', 1, 4, '', '', NULL, 1, NULL, NULL),
(20, 'เครื่องเหลาดินสอ', 'MN3v81BTkk', 'ec65bfb710d6833881fd1399821fa52e.jpg', 1, 4, '', '', NULL, 1, NULL, NULL),
(21, 'คัตเตอร์-ใหญ่', 'Vp4St-0HO8', '205d8b7b220f6c7cb98554749c53c4e3.jpg', 1, 4, '', '', NULL, 1, NULL, NULL),
(22, 'คัตเตอร์-เล็ก', 'Ki_LdPg7gs', 'e4a9bf0a1dc78f18535b958338f25fa4.jpg', 1, 4, '', '', NULL, 4, NULL, NULL),
(23, 'เชือกมัดสำนวน', 'IIqFjTWY7h', '25e0cd688b34a4ab459a8ecfa0e2e797.jpg', 1, 5, '', '', NULL, 16, NULL, NULL),
(24, 'ซองครุฑสีน้ำตาลพับ3', 'N6rdEDNWv6', '985bd5eba65dd831dfdc01e47664aecc.jpg', 1, 6, '', '', NULL, 150, NULL, NULL),
(25, 'ซองครุฑสีน้ำตาลพับ2', 'SAO09VrQs-', '', 1, 6, '', '', NULL, 1750, NULL, NULL),
(26, 'ซองครุฑสีน้ำตาล A4 ขยายข้าง', 'T0ttmhn61i', '', 1, 6, '', '', NULL, 350, NULL, NULL),
(27, 'ดินสอ HB', 'Jz-1k31AH4', '', 1, 7, '', '', NULL, 30, NULL, NULL),
(28, 'ดินสอ 2B', 'VY6IG1Bbrs', '', 1, 7, '', '', NULL, 8, NULL, NULL),
(29, 'ตลับชาติ-สีดำ', 'fwX1JtPW3e', '', 1, 8, '', '', NULL, 3, NULL, NULL),
(30, 'ตลับชาติ-สีแดง', 'HE6rdP-2r0', '', 1, 8, '', '', NULL, 2, NULL, NULL),
(31, 'ตลับชาติ-สีน้ำเงิน', '9KZkNKtHPB', '', 1, 8, '', '', NULL, 2, NULL, NULL),
(32, 'ที่ดึงลวดเย็บกระดาษ', 'p-Z5_XWvXA', '', 1, 4, '', '', NULL, 1, NULL, NULL),
(33, 'เทปกาวสีน้ำตาล', '7XdLrmDRk_', '', 1, 5, '', '', NULL, 30, NULL, NULL),
(34, 'เทปกาวผ้า (แล็กซีน) ขนาด 2 นิ้ว', 'JmFi70wIos', '', 1, 5, '', '', NULL, 1, NULL, NULL),
(35, 'เทปกาวผ้า (แล็กซีน) ขนาด 1.5 นิ้ว', 'OUR1lR0Ma3', '', 1, 5, '', '', NULL, 0, NULL, NULL),
(36, 'เทปกาวผ้า (แล็กซีน) ขนาด 2.5 นิ้ว', 'PjULj4RAT2', '', 1, 5, '', '', NULL, 2, NULL, NULL),
(37, 'เทปกาวสองหน้า-ชนิดบาง', 'e4nP-KV2FW', '', 1, 5, '', '', NULL, 10, NULL, NULL),
(38, 'เทปกาวสองหน้า-ชนิดหนา', 'AVeq-x1JKW', '', 1, 5, '', '', NULL, 1, NULL, NULL),
(39, 'น้ำยาลบคำผิด', 'DYIbuVV0BM', '', 1, 4, '', '', NULL, 14, NULL, NULL),
(40, 'ปากกาดำ', 'sHN44YrMAA', '', 1, 10, '', '', NULL, 16, NULL, NULL),
(41, 'ปากกาแดง', 'mG8jM7KMJE', '', 1, 10, '', '', NULL, 36, NULL, NULL),
(42, 'ปากกาน้ำเงิน', 'AeqgnhLm8G', '', 1, 10, '', '', NULL, 73, NULL, NULL),
(43, 'ปากกาเขียนไวท์บอร์ด-น้ำเงิน', 'ZJ0v9DWdfN', '', 1, 10, '', '', NULL, 1, NULL, NULL),
(44, 'ปากกาเคมี 2 หัว-สีดำ (16)', 'oa8p4f2R4K', '', 1, 10, '', '', NULL, 2, NULL, NULL),
(45, 'ปากกาเคมี 2 หัว-สีดำ (15)', 'QT-nN2Q6P9', '', 1, 10, '', '', NULL, 3, NULL, NULL),
(46, 'ปากกาเคมี 2 หัว-สีแดง (16)', '-61bPkVs04', '', 1, 10, '', '', NULL, 14, NULL, NULL),
(47, 'ปากกาเคมี 2 หัว-สีแดง (15)', 'vs-TicWcAO', '', 1, 10, '', '', NULL, 1, NULL, NULL),
(48, 'เป๊กทองเหลือง 1 นิ้ว (45)', 'djFeJF7NXw', '', 1, 3, '', '', NULL, 11, NULL, NULL),
(49, 'เป๊กทองเหลือง 1 นิ้ว (48)', 'lYQx8O6Gz2', '', 1, 3, '', '', NULL, 12, NULL, NULL),
(50, 'เป๊กทองเหลือง 1.5 นิ้ว', '6nRZ2QI6hB', '', 1, 3, '', '', NULL, 13, NULL, NULL),
(51, 'เป๊กทองเหลือง 2 นิ้ว (75)', 'YkR_J5huz4', '', 1, 3, '', '', NULL, 22, NULL, NULL),
(52, 'เป๊กทองเหลือง 2 นิ้ว (80)', 'u4KYICdFrF', '', 1, 3, '', '', NULL, 12, NULL, NULL),
(53, 'เป๊กทองเหลือง 3 นิ้ว', 'uFx2hEzsDx', '', 1, 3, '', '', NULL, 6, NULL, NULL),
(54, 'ผ้าหมึกพิมพ์ดีด', 'tzQ61ef2lH', 'c645410b14bac89a838acd2bad159c25.jpg', 1, 3, '', '', NULL, 3, NULL, NULL),
(55, 'แฟ้มแขวน', 'wo1WtA2snP', '', 1, 12, '', '', NULL, 71, NULL, NULL),
(56, 'แฟ้มพลาสติกแบบห่วง', 'E-R7Yl9KFl', '', 1, 12, '', '', NULL, 4, NULL, NULL),
(57, 'แฟ้มอ่อน (ขนาดF4)', 'LZaUZ4FhPN', '', 1, 12, '', '', NULL, 5, NULL, NULL),
(58, 'แฟ้มอ่อน (ขนาดA4)', 'njtqv91KOT', '', 1, 12, '', '', NULL, 6, NULL, NULL),
(59, 'แฟ้มสันแคบหนา 2 นิ้ว', 'nR1FVFSFL6', '', 1, 12, '', '', NULL, 17, NULL, NULL),
(60, 'แฟ้มสันกว้างหนา 3 นิ้ว', 'GeT1OYJUUV', '', 1, 12, '', '', NULL, 18, NULL, NULL),
(61, 'แฟ้มเสนอเซ็น', '5-FMImLtyQ', '', 1, 12, '', '', NULL, 1, NULL, NULL),
(62, 'ไม้บรรทัด', 'D58_XK-s5v', '', 1, 4, '', '', NULL, 7, NULL, NULL),
(63, 'ยางลบ', 'JuZNxNPJ8t', '', 1, 4, '', '', NULL, 48, NULL, NULL),
(64, 'ลวดเสียบกระดาษ', 'DzUnCPJgqY', '', 1, 3, '', '', NULL, 107, NULL, NULL),
(65, 'ลวดเย็บกระดาษ No.10', '36kzSfh1c3', '', 1, 3, '', '', NULL, 36, NULL, NULL),
(66, 'ลวดเย็บกระดาษ No.35', 'VHpkvqVNmk', '', 1, 3, '', '', NULL, 42, NULL, NULL),
(67, 'ลวดเย็บกระดาษ No. M8', 'hb9pFmXJmO', '', 1, 3, '', '', NULL, 16, NULL, NULL),
(68, 'ลวดเย็บกระดาษ T3-10MB', 'YLmIjI5CFY', '', 1, 3, '', '', NULL, 3, NULL, NULL),
(69, 'สก็อตเทปใส', 'wRNm9le1d8', '', 1, 5, '', '', NULL, 17, NULL, NULL),
(70, 'สมุดบันทึก 4/150 80p', 'v4R74FJUk_', '', 1, 13, '', '', NULL, 3, NULL, NULL),
(71, 'สมุดบัญชีน้ำเงิน-ใหญ่', 'B2tzTXCzUo', '', 1, 13, '', '', NULL, 16, NULL, NULL),
(72, 'สมุดบัญชีน้ำเงิน-เล็ก', 'oRbZvEPf8E', '', 1, 13, '', '', NULL, 27, NULL, NULL),
(73, 'หมึกเติมแท่นประทับตรา-สีดำ', 'o5wjUUjZDb', '', 1, 14, '', '', NULL, 4, NULL, NULL),
(74, 'หมึกเติมแท่นประทับตรา-สีแดง', 'PVHHNNaS8X', '', 1, 14, '', '', NULL, 7, NULL, NULL),
(75, 'หมึกเติมเครื่องรันนิ่ง', '4ECvrlWMmO', '', 1, 3, '', '', NULL, 3, NULL, NULL),
(76, 'หมึกถ่ายเอกสารริโก้', 'hSbw9XYTiR', '', 1, 3, '', '', NULL, 3, NULL, NULL),
(77, 'หมึกเครื่องอัดสำเนา ริโก้ DX3443', 'eABMOmwCoy', '', 1, 3, '', '', NULL, 5, NULL, NULL),
(78, 'หมึกถ่ายเอกสาร kyocera tr-6329', 'HBJti-IXyk', '', 1, 3, '', '', NULL, 1, NULL, NULL),
(79, 'เหล็กแทงสำนวน', 'LaUx2sfHEw', '', 1, 4, '', '', NULL, 4, NULL, NULL),
(80, 'ถ้วยกระดาษ', 'kfF7vtMViv', '', 4, 3, '', '', NULL, 1, NULL, NULL),
(81, 'ถ่าน 2A', 'sjCE7_s6vU', '', 4, 15, '', '', NULL, 40, NULL, NULL),
(82, 'หมึกเลเซอร์ Brother 2280', 'DDrzZqoteG', '', 2, 3, '', '', NULL, 2, NULL, NULL),
(83, 'ผงหมึกเลเซอร์ brother 2025', '-YBmWT3KPi', '', 2, 15, '', '', NULL, 2, NULL, NULL),
(84, 'ผงหมึกเลเซอร์ brother 3250', 'AdIcUkgfx0', '', 2, 3, '', '', NULL, 1, NULL, NULL),
(85, 'ผงหมึกเลเซอร์ XEROX 3435', 'YI8OAPMxOq', '', 2, 3, '', '', NULL, 2, NULL, NULL),
(86, 'หมึกพิมพ์samsung 3050 N', 'XWBtVA5NVE', '', 2, 3, '', '', NULL, 2, NULL, NULL),
(87, 'หมึกพิมพ์ samsung ML-2250', 'MxXVPz6eDz', '', 2, 3, '', '', NULL, 1, NULL, NULL),
(88, 'หมึกพิมพ์ CANNON HP 12A', 'lfS3tVgoKd', '', 2, 3, '', '', NULL, 1, NULL, NULL),
(89, 'หมึกพิมพ์ OKI 391', 'Y-7NCMEBMT', '', 2, 3, '', '', NULL, 2, NULL, NULL),
(90, 'หมึกพิมพ์ HP 80A', 'kcZGRkaEq9', '', 2, 3, '', '', NULL, 1, NULL, NULL),
(91, 'หมึกพิมพ์ HP 26A', 'XghxSE7M2G', '', 2, 3, '', '', NULL, 2, NULL, NULL),
(92, 'หมึกพิมพ์ samsungb 203u 203s', 'NvvtiYswZW', '', 2, 3, '', '', NULL, 2, NULL, NULL),
(93, 'หมึกพิมพ์ cannon 328', 'a6Ax8FQKNP', '', 2, 3, '', '', NULL, 1, NULL, NULL),
(94, 'หมึกพิมพ์ยี่ห้อ EPSON LQ-300', 'rkCWe4tA4M', '', 2, 3, '', '', NULL, 1, NULL, NULL),
(95, 'หมึกชนิดเติม Brother (bk)', 'umSn2LganY', '', 2, 14, '', '', NULL, 3, NULL, NULL),
(96, 'หมึกชนิดเติม Brother', 'HUCqO_10jo', '', 2, 14, '', '', NULL, 3, NULL, NULL),
(97, 'หมึกชนิดเติม Brother (M)', 'KCS3hQKknh', '', 2, 14, '', '', NULL, 3, NULL, NULL),
(98, 'หมึกชนิดเติม Brother (ํY)', 'PBfGaQTGXn', '', 2, 14, '', '', NULL, 3, NULL, NULL),
(99, 'ปลั๊กไฟยาว 5 เมตร', 'krC9VP80p1', '', 3, 4, '', '', NULL, 1, NULL, NULL);

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
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL,
  `receipt_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `receipt_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sumtotal` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`id`, `receipt_code`, `user_id`, `receipt_from`, `sumtotal`, `status`, `create_at`) VALUES
(1, 'R1234567890', 9929, NULL, NULL, NULL, '2018-12-14 01:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_list`
--

CREATE TABLE `receipt_list` (
  `id` int(11) NOT NULL,
  `receipt_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receipt_list`
--

INSERT INTO `receipt_list` (`id`, `receipt_code`, `product_code`, `unit_price`, `quantity`, `create_at`) VALUES
(1, 'R1234567890', 'Q3cKVoAKcu', 500, 0, '2018-12-14 01:01:42'),
(2, 'R1234567890', 'praFVj_bt_', 115, 12, '2018-12-14 01:01:42'),
(3, 'R1234567890', 'OyvJH7lDrf', 100, 3, '2018-12-14 01:01:42'),
(4, 'R1234567890', '5KvH9ZwEIt', 95, 16, '2018-12-14 01:01:42'),
(5, 'R1234567890', '_QNpufaE4Q', 100, 6, '2018-12-14 01:01:42'),
(6, 'R1234567890', 'Yw6OllItS9', 100, 6, '2018-12-14 01:01:42'),
(7, 'R1234567890', 'pLCwfWlvIV', 85, 1, '2018-12-14 01:01:42'),
(8, 'R1234567890', '7-9s9Q1xFE', 69, 10, '2018-12-14 01:01:42'),
(9, 'R1234567890', 'GPG2wZXLhD', 84, 0, '2018-12-14 01:01:42'),
(10, 'R1234567890', 'alI5DGQ7oq', 72, 8, '2018-12-14 01:01:42'),
(11, 'R1234567890', 'PBz18zfJJX', 48, 7, '2018-12-14 01:01:42'),
(12, 'R1234567890', 'SWZ7X4g63Q', 36, 5, '2018-12-14 01:01:42'),
(13, 'R1234567890', 'M_DHma3P1h', 175, 3, '2018-12-14 01:01:42'),
(14, 'R1234567890', 'XEIyiJXL61', 750, 1, '2018-12-14 01:01:42'),
(15, 'R1234567890', 'BxjRGVzHr2', 75, 8, '2018-12-14 01:01:42'),
(16, 'R1234567890', 'wHKb3_MoVf', 325, 1, '2018-12-14 01:01:42'),
(17, 'R1234567890', 'PDicztpoJi', 85, 1, '2018-12-14 01:01:42'),
(18, 'R1234567890', 'MN3v81BTkk', 380, 1, '2018-12-14 01:01:42'),
(19, 'R1234567890', 'Vp4St-0HO8', 50, 1, '2018-12-14 01:01:42'),
(20, 'R1234567890', 'Ki_LdPg7gs', 35, 4, '2018-12-14 01:01:42'),
(21, 'R1234567890', 'IIqFjTWY7h', 25, 16, '2018-12-14 01:01:42'),
(22, 'R1234567890', 'N6rdEDNWv6', 2, 150, '2018-12-14 01:01:42'),
(23, 'R1234567890', 'SAO09VrQs-', 1, 1750, '2018-12-14 01:01:42'),
(24, 'R1234567890', 'T0ttmhn61i', 5, 350, '2018-12-14 01:01:42'),
(25, 'R1234567890', 'Jz-1k31AH4', 4, 30, '2018-12-14 01:01:42'),
(26, 'R1234567890', 'VY6IG1Bbrs', 5, 8, '2018-12-14 01:01:42'),
(27, 'R1234567890', 'fwX1JtPW3e', 30, 3, '2018-12-14 01:01:42'),
(28, 'R1234567890', 'HE6rdP-2r0', 35, 2, '2018-12-14 01:01:42'),
(29, 'R1234567890', '9KZkNKtHPB', 35, 2, '2018-12-14 01:01:42'),
(30, 'R1234567890', 'p-Z5_XWvXA', 28, 1, '2018-12-14 01:01:42'),
(31, 'R1234567890', '7XdLrmDRk_', 25, 30, '2018-12-14 01:01:42'),
(32, 'R1234567890', 'JmFi70wIos', 75, 1, '2018-12-14 01:01:42'),
(33, 'R1234567890', 'OUR1lR0Ma3', 55, 0, '2018-12-14 01:01:42'),
(34, 'R1234567890', 'PjULj4RAT2', 100, 2, '2018-12-14 01:01:42'),
(35, 'R1234567890', 'e4nP-KV2FW', 28, 10, '2018-12-14 01:01:42'),
(36, 'R1234567890', 'AVeq-x1JKW', 220, 1, '2018-12-14 01:01:42'),
(37, 'R1234567890', 'DYIbuVV0BM', 75, 14, '2018-12-14 01:01:42'),
(38, 'R1234567890', 'sHN44YrMAA', 5, 16, '2018-12-14 01:01:42'),
(39, 'R1234567890', 'mG8jM7KMJE', 5, 36, '2018-12-14 01:01:42'),
(40, 'R1234567890', 'AeqgnhLm8G', 5, 73, '2018-12-14 01:01:42'),
(41, 'R1234567890', 'ZJ0v9DWdfN', 20, 1, '2018-12-14 01:01:42'),
(42, 'R1234567890', 'oa8p4f2R4K', 16, 2, '2018-12-14 01:01:42'),
(43, 'R1234567890', 'QT-nN2Q6P9', 15, 3, '2018-12-14 01:01:42'),
(44, 'R1234567890', '-61bPkVs04', 16, 14, '2018-12-14 01:01:42'),
(45, 'R1234567890', 'vs-TicWcAO', 15, 1, '2018-12-14 01:01:42'),
(46, 'R1234567890', 'djFeJF7NXw', 45, 11, '2018-12-14 01:01:42'),
(47, 'R1234567890', 'lYQx8O6Gz2', 48, 12, '2018-12-14 01:01:42'),
(48, 'R1234567890', '6nRZ2QI6hB', 70, 13, '2018-12-14 01:01:42'),
(49, 'R1234567890', 'YkR_J5huz4', 75, 22, '2018-12-14 01:01:42'),
(50, 'R1234567890', 'u4KYICdFrF', 80, 12, '2018-12-14 01:01:42'),
(51, 'R1234567890', 'uFx2hEzsDx', 95, 6, '2018-12-14 01:01:42'),
(52, 'R1234567890', 'tzQ61ef2lH', 75, 3, '2018-12-14 01:01:42'),
(53, 'R1234567890', 'wo1WtA2snP', 20, 71, '2018-12-14 01:01:42'),
(54, 'R1234567890', 'E-R7Yl9KFl', 60, 4, '2018-12-14 01:01:42'),
(55, 'R1234567890', 'LZaUZ4FhPN', 10, 5, '2018-12-14 01:01:42'),
(56, 'R1234567890', 'njtqv91KOT', 10, 6, '2018-12-14 01:01:42'),
(57, 'R1234567890', 'nR1FVFSFL6', 75, 17, '2018-12-14 01:01:42'),
(58, 'R1234567890', 'GeT1OYJUUV', 75, 18, '2018-12-14 01:01:42'),
(59, 'R1234567890', '5-FMImLtyQ', 150, 1, '2018-12-14 01:01:42'),
(60, 'R1234567890', 'D58_XK-s5v', 5, 7, '2018-12-14 01:01:42'),
(61, 'R1234567890', 'JuZNxNPJ8t', 5, 48, '2018-12-14 01:01:42'),
(62, 'R1234567890', 'DzUnCPJgqY', 10, 107, '2018-12-14 01:01:42'),
(63, 'R1234567890', '36kzSfh1c3', 8, 36, '2018-12-14 01:01:42'),
(64, 'R1234567890', 'VHpkvqVNmk', 7, 42, '2018-12-14 01:01:42'),
(65, 'R1234567890', 'hb9pFmXJmO', 12, 16, '2018-12-14 01:01:42'),
(66, 'R1234567890', 'YLmIjI5CFY', 35, 3, '2018-12-14 01:01:42'),
(67, 'R1234567890', 'wRNm9le1d8', 27, 17, '2018-12-14 01:01:42'),
(68, 'R1234567890', 'v4R74FJUk_', 220, 3, '2018-12-14 01:01:42'),
(69, 'R1234567890', 'B2tzTXCzUo', 80, 16, '2018-12-14 01:01:42'),
(70, 'R1234567890', 'oRbZvEPf8E', 65, 27, '2018-12-14 01:01:42'),
(71, 'R1234567890', 'o5wjUUjZDb', 10, 4, '2018-12-14 01:01:42'),
(72, 'R1234567890', 'PVHHNNaS8X', 35, 7, '2018-12-14 01:01:42'),
(73, 'R1234567890', '4ECvrlWMmO', 95, 3, '2018-12-14 01:01:42'),
(74, 'R1234567890', 'hSbw9XYTiR', 2500, 3, '2018-12-14 01:01:42'),
(75, 'R1234567890', 'eABMOmwCoy', 550, 5, '2018-12-14 01:01:42'),
(76, 'R1234567890', 'HBJti-IXyk', 4900, 1, '2018-12-14 01:01:42'),
(77, 'R1234567890', 'LaUx2sfHEw', 35, 4, '2018-12-14 01:01:42'),
(78, 'R1234567890', 'kfF7vtMViv', 1250, 1, '2018-12-14 01:01:42'),
(79, 'R1234567890', 'sjCE7_s6vU', 6, 40, '2018-12-14 01:01:42'),
(80, 'R1234567890', 'DDrzZqoteG', 2300, 2, '2018-12-14 01:01:42'),
(81, 'R1234567890', '-YBmWT3KPi', 2050, 2, '2018-12-14 01:01:42'),
(82, 'R1234567890', 'AdIcUkgfx0', 5800, 1, '2018-12-14 01:01:42'),
(83, 'R1234567890', 'YI8OAPMxOq', 4300, 2, '2018-12-14 01:01:42'),
(84, 'R1234567890', 'XWBtVA5NVE', 5800, 2, '2018-12-14 01:01:42'),
(85, 'R1234567890', 'MxXVPz6eDz', 4300, 1, '2018-12-14 01:01:42'),
(86, 'R1234567890', 'lfS3tVgoKd', 2700, 1, '2018-12-14 01:01:42'),
(87, 'R1234567890', 'Y-7NCMEBMT', 350, 2, '2018-12-14 01:01:42'),
(88, 'R1234567890', 'kcZGRkaEq9', 3750, 1, '2018-12-14 01:01:42'),
(89, 'R1234567890', 'XghxSE7M2G', 4150, 2, '2018-12-14 01:01:42'),
(90, 'R1234567890', 'NvvtiYswZW', 3700, 2, '2018-12-14 01:01:42'),
(91, 'R1234567890', 'a6Ax8FQKNP', 2550, 1, '2018-12-14 01:01:42'),
(92, 'R1234567890', 'rkCWe4tA4M', 160, 1, '2018-12-14 01:01:42'),
(93, 'R1234567890', 'umSn2LganY', 280, 3, '2018-12-14 01:01:42'),
(94, 'R1234567890', 'HUCqO_10jo', 250, 3, '2018-12-14 01:01:42'),
(95, 'R1234567890', 'KCS3hQKknh', 250, 3, '2018-12-14 01:01:42'),
(96, 'R1234567890', 'PBfGaQTGXn', 250, 3, '2018-12-14 01:01:42'),
(97, 'R1234567890', 'krC9VP80p1', 550, 1, '2018-12-14 01:01:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_st`
--
ALTER TABLE `log_st`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_list`
--
ALTER TABLE `receipt_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_st`
--
ALTER TABLE `log_st`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receipt_list`
--
ALTER TABLE `receipt_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
