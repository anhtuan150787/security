-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2018 at 08:45 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zend2`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` smallint(6) NOT NULL,
  `account_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `account_username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `account_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_password_salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_status` tinyint(4) NOT NULL,
  `account_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_account_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_name`, `account_username`, `account_password`, `account_password_salt`, `account_status`, `account_email`, `account_phone`, `account_picture`, `group_account_id`) VALUES
(1, 'Anh Tuấn', 'anhtuan150787', 'e49ed34b584d6a4ac562647850517b13', '65601daf9197d19f660233df5f7961c9', 1, 'anhtuan150787@gmail.com', '0944518855', 'users_1526116994.4535_img.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE `acl` (
  `acl_id` smallint(6) NOT NULL,
  `acl_module` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acl_controller` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acl_action` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acl_status` tinyint(4) NOT NULL,
  `acl_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `acl_parent` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acl`
--

INSERT INTO `acl` (`acl_id`, `acl_module`, `acl_controller`, `acl_action`, `acl_status`, `acl_name`, `acl_parent`) VALUES
(1, 'admin', 'index', 'index', 1, 'Trang chủ', 0),
(7, '', '', '', 1, 'Nhóm quản trị', 0),
(8, 'admin', 'groupaccount', 'index', 1, 'Danh sách', 7),
(9, 'admin', 'groupaccount', 'add', 1, 'Thêm', 7),
(10, 'admin', 'groupaccount', 'edit', 1, 'Cập nhật', 7),
(11, 'admin', 'groupaccount', 'delete', 1, 'Xóa', 7),
(12, '', '', '', 1, 'Tài khoản quản trị', 0),
(13, 'admin', 'account', 'index', 1, 'Danh sách', 12),
(14, 'admin', 'account', 'add', 1, 'Thêm', 12),
(15, 'admin', 'account', 'delete', 1, 'Xóa', 12),
(16, 'admin', 'account', 'edit', 1, 'Cập nhật', 12),
(17, '', '', '', 1, 'Menu CMS', 0),
(18, 'admin', 'menu', 'index', 1, 'Danh sách', 17),
(19, 'admin', 'menu', 'add', 1, 'Thêm', 17),
(20, 'admin', 'menu', 'delete', 1, 'Xóa', 17),
(21, 'admin', 'menu', 'edit', 1, 'Cập nhật', 17),
(22, '', '', '', 1, 'Quyền', 0),
(23, 'admin', 'acl', 'index', 1, 'Danh sách', 22),
(24, 'admin', 'acl', 'add', 1, 'Thêm', 22),
(25, 'admin', 'acl', 'delete', 1, 'Xóa', 22),
(26, 'admin', 'acl', 'edit', 1, 'Cập nhật', 22),
(35, 'admin', 'groupaccount', 'acl', 1, 'Phân quyền', 7),
(36, '', '', '', 1, 'Menu', 0),
(37, 'admin', 'groupnavigation', 'index', 1, 'Danh sách', 36),
(38, 'admin', 'groupnavigation', 'add', 1, 'Thêm', 36),
(39, 'admin', 'groupnavigation', 'delete', 1, 'Xóa', 36),
(40, 'admin', 'groupnavigation', 'edit', 1, 'Cập nhật', 36),
(124, '', '', '', 1, 'Cấu hình chung Website', 0),
(125, 'admin', 'websitegeneral', 'edit', 1, 'Cập nhật', 124),
(126, 'admin', 'websitegeneral', 'delete-picture', 1, 'Xóa Favicon', 124),
(127, 'admin', 'account', 'delete-picture', 1, 'Xóa hình đại diện', 12),
(128, '', '', '', 1, 'Cấu hình gửi Email', 0),
(129, 'admin', 'websiteemail', 'edit', 1, 'Cập nhật', 128),
(130, '', '', '', 1, 'API', 0),
(131, 'admin', 'api', 'sendmail', 1, 'Gửi email', 130),
(132, '', '', '', 1, 'Bài viết', 0),
(133, 'admin', 'post', 'index', 1, 'Danh sách', 132),
(134, 'admin', 'post', 'add', 1, 'Thêm', 132),
(135, 'admin', 'post', 'edit', 1, 'Cập nhật', 132),
(136, 'admin', 'post', 'delete', 1, 'Xóa', 132),
(137, 'admin', 'post', 'delete-picture', 1, 'Xóa hình đại diện', 132),
(138, '', '', '', 1, 'Danh mục bài viết', 0),
(139, 'admin', 'postcategory', 'index', 1, 'Danh sách', 138),
(140, 'admin', 'postcategory', 'add', 1, 'Thêm', 138),
(141, 'admin', 'postcategory', 'delete', 1, 'Xóa', 138),
(142, 'admin', 'postcategory', 'edit', 1, 'Cập nhật', 138),
(143, '', '', '', 1, 'Thông báo', 0),
(144, 'admin', 'message', 'index', 1, 'Hiển thị', 143),
(145, '', '', '', 1, 'Liên kết', 0),
(146, 'admin', 'navigation', 'index', 1, 'Danh sách', 145),
(147, 'admin', 'navigation', 'add', 1, 'Thêm', 145),
(148, 'admin', 'navigation', 'delete', 1, 'Xóa', 145),
(149, '', '', '', 1, 'Nội dung trang', 0),
(150, 'admin', 'page', 'index', 1, 'Danh sách', 149),
(151, 'admin', 'page', 'add', 1, 'Thêm', 149),
(152, 'admin', 'page', 'edit', 1, 'Cập nhật', 149),
(153, 'admin', 'page', 'delete', 1, 'Xóa', 149),
(154, '', '', '', 1, 'Nhóm Giao diện', 0),
(155, 'admin', 'grouptemplate', 'index', 1, 'Danh sách', 154),
(156, 'admin', 'grouptemplate', 'edit', 1, 'Cập nhật', 154),
(157, 'admin', 'grouptemplate', 'add', 1, 'Thêm', 154),
(158, 'admin', 'grouptemplate', 'delete', 1, 'Xóa', 154),
(159, '', '', '', 1, 'Giao diện', 0),
(161, 'admin', 'template', 'index', 1, 'Danh sách', 159),
(166, '', '', '', 1, 'Sản phẩm', 0),
(167, 'admin', 'product', 'index', 1, 'Danh sách', 166),
(168, 'admin', 'product', 'add', 1, 'Thêm', 166),
(169, 'admin', 'product', 'delete', 1, 'Xóa', 166),
(170, 'admin', 'product', 'edit', 1, 'Cập nhật', 166),
(171, '', '', '', 1, 'Danh mục sản phẩm', 0),
(172, 'admin', 'productcategory', 'index', 1, 'Danh sách', 171),
(173, 'admin', 'productcategory', 'add', 1, 'Thêm', 171),
(174, 'admin', 'productcategory', 'delete', 1, 'Xóa', 171),
(175, 'admin', 'productcategory', 'edit', 1, 'Cập nhật', 171),
(176, 'admin', 'product', 'delete-picture', 1, ' Xóa hình đại diện', 166),
(190, '', '', '', 1, 'Liên hệ khách hàng', 0),
(191, 'admin', 'contact', 'index', 1, 'Danh sách', 190),
(192, 'admin', 'contact', 'edit', 1, 'Xem chi tiết', 190),
(193, 'admin', 'product', 'delete-picture-multi', 1, 'Xóa hình Slide', 166),
(194, 'admin', 'productcategory', 'delete-picture', 1, 'Xóa hình', 171),
(195, 'admin', 'template', 'add', 1, 'Thêm', 159),
(196, 'admin', 'template', 'delete', 1, 'Xóa', 159),
(197, 'admin', 'template', 'edit', 1, 'Cập nhật', 159),
(198, 'admin', 'template', 'delete-picture', 1, 'Xóa hình', 159),
(199, 'admin', 'template', 'delete-picture-multi', 1, 'Xóa Slide hình', 159),
(200, '', '', '', 1, 'Danh mục dịch vụ', 0),
(201, 'admin', 'servicecategory', 'index', 1, 'Danh sách', 200),
(202, 'admin', 'servicecategory', 'add', 1, 'Thêm', 200),
(203, 'admin', 'servicecategory', 'delete', 1, 'Xóa', 200),
(204, 'admin', 'servicecategory', 'edit', 1, 'Cập nhật', 200),
(205, '', '', '', 1, 'Dịch vụ', 0),
(206, 'admin', 'service', 'index', 1, 'Danh sách', 205),
(207, 'admin', 'service', 'add', 1, 'Thêm', 205),
(208, 'admin', 'service', 'delete', 1, 'Xóa', 205),
(209, 'admin', 'service', 'edit', 1, 'Cập nhật', 205),
(210, 'admin', 'service', 'delete-picture', 1, 'Xóa hình', 205),
(211, 'admin', 'servicecategory', 'delete-picture', 1, 'Xóa hình', 200);

--
-- Triggers `acl`
--
DELIMITER $$
CREATE TRIGGER `AFTER_DELETE_ACL` AFTER DELETE ON `acl` FOR EACH ROW BEGIN
	DELETE FROM group_acl WHERE acl_id = OLD.acl_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_type` tinyint(4) NOT NULL,
  `category_status` tinyint(4) NOT NULL,
  `category_parent` int(11) NOT NULL,
  `category_name_vn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_description_vn` text COLLATE utf8_unicode_ci,
  `category_description_en` text COLLATE utf8_unicode_ci,
  `category_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_type`, `category_status`, `category_parent`, `category_name_vn`, `category_name_en`, `category_description_vn`, `category_description_en`, `category_picture`) VALUES
(4, 1, 1, 0, 'Tin tức', 'News', '', NULL, NULL),
(5, 3, 1, 0, 'Tư Vấn & Huấn Luyện', 'Consultancies & Training', '<p class=\"MsoNormal\">Đ&agrave;o tạo nghiệp vụ kỹ năng đặc biệt, kiến thức ph&aacute;p luật, sử dụng trang thiết bị, phản ứng nhanh.</p>', '<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis</p>', 'category_1527518935.8346_resort.png'),
(6, 3, 1, 0, 'Cung Cấp Nhân Sự An Ninh', 'Physical Security', '<p class=\"MsoNormal\">Cao ốc văn ph&ograve;ng, Trung t&acirc;m thương mại, kh&aacute;ch sạn, ng&acirc;n h&agrave;ng, nh&agrave; m&aacute;y x&iacute; nghiệp, c&ocirc;ng trường. nh&agrave; ri&ecirc;ng.</p>', '<p class=\"MsoNormal\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis</p>', 'category_1527518924.8685_surveillance.png'),
(7, 3, 1, 0, 'Giải Pháp An Ninh An toàn', 'Security/ Safety Solutions', '<p class=\"MsoNormal\">Tư vấn lựa chọn phương &aacute;n bảo vệ, PCCC, thiết bị bảo vệ, camera gi&aacute;m s&aacute;t, hệ thống chống đột nhập.</p>', '<p class=\"MsoNormal\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis</p>', 'category_1527518911.7099_building.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_phone` int(11) NOT NULL,
  `contact_content` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `contact_date` datetime NOT NULL,
  `contact_status` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_fullname`, `contact_email`, `contact_phone`, `contact_content`, `contact_date`, `contact_status`) VALUES
(11, 'Anh Tuấn', 'anhtuan150787@gmail.com', 944518855, 'Website rõ ràng, tinh tế, hình ảnh đẹp', '2018-01-03 00:00:00', 1),
(12, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'Test Gửi email Website', '2018-01-15 14:28:38', NULL),
(13, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'Test Gửi email Website', '2018-01-15 14:30:38', NULL),
(14, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'Test Gửi email Website', '2018-01-15 14:33:37', NULL),
(15, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'Test Gửi email Website', '2018-01-15 14:34:41', NULL),
(16, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'test', '2018-01-15 14:40:00', 1),
(17, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'test', '2018-01-15 14:40:17', NULL),
(18, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'test', '2018-01-15 14:42:12', NULL),
(19, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'sd', '2018-01-15 14:43:36', NULL),
(20, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'asd', '2018-01-15 14:44:05', 1),
(21, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'dfg', '2018-01-15 14:44:32', NULL),
(22, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'dfg', '2018-01-15 14:49:38', 1),
(23, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'sdsd', '2018-01-15 14:52:48', 1),
(24, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'sdsd', '2018-01-15 14:55:55', 1),
(25, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'sdsd', '2018-01-15 14:56:16', 1),
(26, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'sdsd', '2018-01-15 14:57:11', NULL),
(27, 'Anh Tuấn', 'test@yahoo.com', 944112211, 'sd', '2018-01-15 15:03:24', NULL),
(28, 'test', 'test@yahoo.com', 944112211, 'test ', '2018-01-15 22:01:05', 1),
(30, 'rwa', 'test@yahoo.com', 944112211, '123', '2018-05-30 21:58:28', 0),
(31, '12312', '123@yahoo.com', 123123, '123', '2018-05-30 21:59:40', 0),
(32, '12312', '123@yahoo.com', 123123, '123', '2018-05-31 21:32:05', 0),
(33, 'test', 'test@yahoo.com', 944512211, 'sds', '2018-05-31 21:33:07', 0),
(34, 'test', 'test@yahoo.com', 944512211, 'sds', '2018-05-31 21:35:41', 0),
(35, 'test', 'test@yahoo.com', 2123123, 'asd', '2018-05-31 21:36:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `group_account`
--

CREATE TABLE `group_account` (
  `group_account_id` smallint(6) NOT NULL,
  `group_account_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `group_account_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_account`
--

INSERT INTO `group_account` (`group_account_id`, `group_account_name`, `group_account_status`) VALUES
(1, 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_acl`
--

CREATE TABLE `group_acl` (
  `group_acl_id` smallint(6) NOT NULL,
  `acl_id` smallint(6) NOT NULL,
  `group_account_id` smallint(6) NOT NULL,
  `group_acl_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_acl`
--

INSERT INTO `group_acl` (`group_acl_id`, `acl_id`, `group_account_id`, `group_acl_status`) VALUES
(9394, 1, 1, 1),
(9395, 7, 1, 1),
(9396, 8, 1, 1),
(9397, 9, 1, 1),
(9398, 10, 1, 1),
(9399, 11, 1, 1),
(9400, 35, 1, 1),
(9401, 12, 1, 1),
(9402, 13, 1, 1),
(9403, 14, 1, 1),
(9404, 15, 1, 1),
(9405, 16, 1, 1),
(9406, 127, 1, 1),
(9407, 17, 1, 1),
(9408, 18, 1, 1),
(9409, 19, 1, 1),
(9410, 20, 1, 1),
(9411, 21, 1, 1),
(9412, 22, 1, 1),
(9413, 23, 1, 1),
(9414, 24, 1, 1),
(9415, 25, 1, 1),
(9416, 26, 1, 1),
(9417, 36, 1, 1),
(9418, 37, 1, 1),
(9419, 38, 1, 1),
(9420, 39, 1, 1),
(9421, 40, 1, 1),
(9422, 124, 1, 1),
(9423, 125, 1, 1),
(9424, 126, 1, 1),
(9425, 128, 1, 1),
(9426, 129, 1, 1),
(9427, 130, 1, 1),
(9428, 131, 1, 1),
(9429, 132, 1, 1),
(9430, 133, 1, 1),
(9431, 134, 1, 1),
(9432, 135, 1, 1),
(9433, 136, 1, 1),
(9434, 137, 1, 1),
(9435, 138, 1, 1),
(9436, 139, 1, 1),
(9437, 140, 1, 1),
(9438, 141, 1, 1),
(9439, 142, 1, 1),
(9440, 143, 1, 1),
(9441, 144, 1, 1),
(9442, 145, 1, 1),
(9443, 146, 1, 1),
(9444, 147, 1, 1),
(9445, 148, 1, 1),
(9446, 149, 1, 1),
(9447, 150, 1, 1),
(9448, 151, 1, 1),
(9449, 152, 1, 1),
(9450, 153, 1, 1),
(9451, 154, 1, 1),
(9452, 155, 1, 1),
(9453, 156, 1, 1),
(9454, 157, 1, 1),
(9455, 158, 1, 1),
(9456, 159, 1, 1),
(9458, 161, 1, 1),
(9461, 166, 1, 1),
(9462, 167, 1, 1),
(9463, 168, 1, 1),
(9464, 169, 1, 1),
(9465, 170, 1, 1),
(9466, 171, 1, 1),
(9467, 172, 1, 1),
(9468, 173, 1, 1),
(9469, 174, 1, 1),
(9470, 175, 1, 1),
(9471, 176, 1, 1),
(9485, 190, 1, 1),
(9486, 191, 1, 1),
(9487, 192, 1, 1),
(9488, 193, 1, 1),
(9489, 194, 1, 1),
(9490, 198, 1, 1),
(9491, 197, 1, 1),
(9492, 196, 1, 1),
(9493, 195, 1, 1),
(9494, 199, 1, 1),
(9495, 201, 1, 1),
(9496, 202, 1, 1),
(9497, 203, 1, 1),
(9498, 204, 1, 1),
(9499, 200, 1, 1),
(9500, 205, 1, 1),
(9501, 210, 1, 1),
(9502, 209, 1, 1),
(9503, 208, 1, 1),
(9504, 207, 1, 1),
(9505, 206, 1, 1),
(9506, 211, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_menu`
--

CREATE TABLE `group_menu` (
  `group_menu_id` smallint(6) NOT NULL,
  `group_account_id` smallint(6) NOT NULL,
  `menu_id` smallint(6) NOT NULL,
  `group_menu_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_menu`
--

INSERT INTO `group_menu` (`group_menu_id`, `group_account_id`, `menu_id`, `group_menu_status`) VALUES
(3942, 1, 3, 1),
(3943, 1, 4, 1),
(3944, 1, 16, 1),
(3945, 1, 17, 1),
(3946, 1, 18, 1),
(3947, 1, 19, 1),
(3948, 1, 20, 1),
(3950, 1, 22, 1),
(3951, 1, 5, 1),
(3952, 1, 6, 1),
(3953, 1, 7, 1),
(3955, 1, 9, 1),
(3956, 1, 10, 1),
(3958, 1, 12, 1),
(3959, 1, 13, 1),
(3961, 1, 15, 1),
(3962, 1, 25, 1),
(3963, 1, 26, 1),
(3964, 1, 27, 1),
(3965, 1, 28, 1),
(3967, 1, 30, 1),
(3975, 1, 38, 1),
(3976, 1, 39, 1),
(3978, 1, 42, 1),
(3979, 1, 44, 1),
(3980, 1, 45, 1),
(3981, 1, 43, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_navigation`
--

CREATE TABLE `group_navigation` (
  `group_navigation_id` tinyint(4) NOT NULL,
  `group_navigation_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `group_navigation_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_navigation`
--

INSERT INTO `group_navigation` (`group_navigation_id`, `group_navigation_name`, `group_navigation_status`) VALUES
(5, 'Menu top', 1);

--
-- Triggers `group_navigation`
--
DELIMITER $$
CREATE TRIGGER `AFTER_DELETE_GROUP_NAVIGATION` AFTER DELETE ON `group_navigation` FOR EACH ROW BEGIN
	DELETE FROM navigation WHERE group_navigation_id = OLD.group_navigation_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `group_template`
--

CREATE TABLE `group_template` (
  `group_template_id` tinyint(4) NOT NULL,
  `group_template_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_template_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_template`
--

INSERT INTO `group_template` (`group_template_id`, `group_template_name`, `group_template_status`) VALUES
(5, 'Giao diện chung', 1),
(6, 'Banner slide trang chủ', 1),
(7, 'Tại sao chọn chúng tôi', 1),
(8, 'Ý kiến đánh giá', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` smallint(6) NOT NULL,
  `menu_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `menu_parent` smallint(6) DEFAULT '0',
  `menu_status` tinyint(4) NOT NULL,
  `menu_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_icon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `menu_position` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_parent`, `menu_status`, `menu_url`, `menu_icon`, `menu_position`) VALUES
(3, 'Chức năng', 0, 1, '', '', 0),
(4, 'Trang chủ', 3, 1, 'admin', 'fa fa-home', 1),
(5, 'Hệ thống', 0, 1, '', '', 0),
(6, 'Menu', 5, 1, '', 'fa fa-sitemap', 0),
(7, 'Danh sách', 6, 1, 'admin/menu/index', '', 0),
(9, 'Quyền', 5, 1, '', 'fa fa-lock', 0),
(10, 'Danh sách', 9, 1, 'admin/acl/index', '', 0),
(12, 'Tài khoản quản trị', 5, 1, '', 'fa fa-user', 0),
(13, 'Danh sách', 12, 1, 'admin/account/index', '', 0),
(15, 'Nhóm quản trị', 12, 1, 'admin/group-account/index', '', 0),
(16, 'Cấu hình Website', 3, 1, '', 'fa fa-gear', 6),
(17, 'Cấu hình chung', 16, 1, 'admin/website-general/edit', '', 0),
(18, 'Email', 42, 1, 'admin/website-email/edit', '', 0),
(19, 'Bài viết', 3, 1, '', 'fa fa-files-o', 3),
(20, 'Danh sách', 19, 1, 'admin/post/index', '', 0),
(22, 'Danh mục', 19, 1, 'admin/post-category/index', '', 0),
(25, 'Giao diện', 3, 1, '', 'fa fa-desktop', 5),
(26, 'Menu', 25, 1, 'admin/group-navigation', '', 0),
(27, 'Nội dung trang', 3, 1, '', 'fa fa-file-o', 4),
(28, 'Danh sách', 27, 1, 'admin/page', '', 0),
(30, 'Tùy chỉnh giao diện', 25, 1, 'admin/group-template', '', 0),
(38, 'Khách hàng', 3, 1, '', 'fa fa-users', 7),
(39, 'Liên hệ', 38, 1, 'admin/contact/index', '', 1),
(42, 'Cấu hình', 5, 1, '', 'fa fa-gear', 4),
(43, 'Dịch vụ', 3, 1, '', 'fa fa-shield', 3),
(44, 'Danh sách', 43, 1, 'admin/service/index', '', 0),
(45, 'Danh mục', 43, 1, 'admin/service-category/index', '', 0);

--
-- Triggers `menu`
--
DELIMITER $$
CREATE TRIGGER `AFTER_DELETE_MENU` AFTER DELETE ON `menu` FOR EACH ROW BEGIN
	DELETE FROM group_menu WHERE menu_id = OLD.menu_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `navigation_id` tinyint(4) NOT NULL,
  `navigation_name_vn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `navigation_parent` tinyint(4) DEFAULT '0',
  `navigation_status` tinyint(4) NOT NULL,
  `navigation_url_id` bigint(4) DEFAULT NULL,
  `navigation_position` tinyint(4) NOT NULL,
  `group_navigation_id` tinyint(4) NOT NULL,
  `navigation_type` tinyint(4) NOT NULL,
  `navigation_url_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `navigation_name_en` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`navigation_id`, `navigation_name_vn`, `navigation_parent`, `navigation_status`, `navigation_url_id`, `navigation_position`, `group_navigation_id`, `navigation_type`, `navigation_url_name`, `navigation_name_en`) VALUES
(1, 'Trang chủ', 0, 1, NULL, 1, 5, 4, '/', 'Home'),
(2, 'Giới thiệu', 0, 1, 2, 2, 5, 1, '/gioi-thieu-p-2', 'About us'),
(3, 'Tin tức', 0, 1, 4, 4, 5, 3, '/tin-tuc-nc-4', 'News'),
(4, 'Tuyển dụng', 0, 1, NULL, 5, 5, 4, '#', 'Recruitment'),
(5, 'Đào tạo', 4, 1, 3, 1, 5, 1, '/dao-tao-p-3', 'Tranning'),
(6, 'Cơ hội nghề nghiệp', 4, 1, 4, 2, 5, 1, '/co-hoi-nghe-nghiep-p-4', 'Career opportunities'),
(10, 'Liên hệ', 0, 1, NULL, 6, 5, 4, '/lien-he', 'Contact'),
(11, 'Dịch vụ', 0, 1, NULL, 3, 5, 4, '#', 'Services'),
(12, 'Tư Vấn & Huấn Luyện', 11, 1, 5, 1, 5, 5, '/tu-van-huan-luyen-sc-5', 'Consultancies & Training'),
(13, 'Cung Cấp Nhân Sự An Ninh', 11, 1, 6, 2, 5, 5, '/cung-cap-nhan-su-an-ninh-sc-6', 'Physical Security'),
(14, 'Giải Pháp An Ninh An toàn', 11, 1, 7, 3, 5, 5, '/giai-phap-an-ninh-an-toan-sc-7', '	Security/ Safety Solutions');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `post_status` tinyint(4) NOT NULL,
  `post_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_type` tinyint(4) NOT NULL,
  `post_view` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `post_title_vn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_quote_vn` text COLLATE utf8_unicode_ci,
  `post_quote_en` text COLLATE utf8_unicode_ci,
  `post_body_vn` longtext COLLATE utf8_unicode_ci,
  `post_body_en` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_status`, `post_picture`, `post_type`, `post_view`, `category_id`, `post_title_vn`, `post_title_en`, `post_quote_vn`, `post_quote_en`, `post_body_vn`, `post_body_en`) VALUES
(2, 1, NULL, 2, 0, NULL, 'Giới thiệu', 'About us', NULL, NULL, '<p>Organized and operated as from April 2017 by Mr. Le Hoang Phi Hung, who had over 20 years of experiences in security industry.</p>\r\n<p>- Former Country Security Manager at DHL Express, Former Security Manager at MGM Grand Ho Tram Strip, Former Security Superintendent at Nui Phao Mining/ Masan Resources, Country Security &amp; Audit Manager at DHL Ecommerce...</p>\r\n<p>- Former Head of Training for Rapid Emergency Response Guard Team at Long Hai Security Services Ltd.</p>\r\n<p>- Former Head of Long Hai Security Team at Saigon Tower, Metropolitan Tower, Sunwah Tower, Sheraton Saigon Hotel (formerly Transfiled Construction Site), Nike Factory, Metro Cash &amp; Carry&hellip;.</p>\r\n<p>- Executive Protection for VIPs such as Don Johnson, Kimberly Clark, ACE Life, Coca-Cola, Heineken, DHL, Billionaires from US, Investors from England&hellip;&hellip;</p>\r\n<p>- Members of TAPA (Transported Assets Protection Association), SEATAG Offshore (Advanced Fire Fighting &amp; Evacuation), IATA (Dangerous Goods), FFBD (Karate, Self Defense, Tonfa), DRT (Disaster Response Team from Singapore), OSAC (Overseas Security Advisory Council)&hellip;</p>\r\n<p>&bull; License<br /> - Business Registration Certificate No. 0314334740, April 05, 2017 (Department of Planning &amp; Investment of Ho Chi Minh City)<br /> - Certificate of Satisfaction of Conditions on Security and Order No. 686/GXCN (Ministry of Public Security)</p>\r\n<p>Security is a major concern of everyone. We are committed to being a trusted partner in safety and security. We help client s to create and maintain a safe environment for their employees, customer and business partners. We are motivated to strive for excellence as we understand our professional security services are a major part of your brands and operations.</p>', '<p>Organized and operated as from April 2017 by Mr. Le Hoang Phi Hung, who had over 20 years of experiences in security industry.</p>\r\n<p>- Former Country Security Manager at DHL Express, Former Security Manager at MGM Grand Ho Tram Strip, Former Security Superintendent at Nui Phao Mining/ Masan Resources, Country Security &amp; Audit Manager at DHL Ecommerce...</p>\r\n<p>- Former Head of Training for Rapid Emergency Response Guard Team at Long Hai Security Services Ltd.</p>\r\n<p>- Former Head of Long Hai Security Team at Saigon Tower, Metropolitan Tower, Sunwah Tower, Sheraton Saigon Hotel (formerly Transfiled Construction Site), Nike Factory, Metro Cash &amp; Carry&hellip;.</p>\r\n<p>- Executive Protection for VIPs such as Don Johnson, Kimberly Clark, ACE Life, Coca-Cola, Heineken, DHL, Billionaires from US, Investors from England&hellip;&hellip;</p>\r\n<p>- Members of TAPA (Transported Assets Protection Association), SEATAG Offshore (Advanced Fire Fighting &amp; Evacuation), IATA (Dangerous Goods), FFBD (Karate, Self Defense, Tonfa), DRT (Disaster Response Team from Singapore), OSAC (Overseas Security Advisory Council)&hellip;</p>\r\n<p>&bull; License<br /> - Business Registration Certificate No. 0314334740, April 05, 2017 (Department of Planning &amp; Investment of Ho Chi Minh City)<br /> - Certificate of Satisfaction of Conditions on Security and Order No. 686/GXCN (Ministry of Public Security)</p>\r\n<p>Security is a major concern of everyone. We are committed to being a trusted partner in safety and security. We help client s to create and maintain a safe environment for their employees, customer and business partners. We are motivated to strive for excellence as we understand our professional security services are a major part of your brands and operations.</p>'),
(3, 1, NULL, 2, 0, NULL, 'Đào tạo', 'Trainning', NULL, NULL, '<p><span style=\"font-size: 11pt;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(4, 1, NULL, 2, 0, NULL, 'Cơ hội nghề nghiệp', 'Career opportunities', NULL, NULL, '<p><span style=\"font-size: 11pt;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>', '<p><span style=\"font-size: 11pt;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>'),
(6, 1, 'post_1527257481.6884_g1.jpg', 3, NULL, 5, 'Đánh giá An ninh/ An toàn', 'Security / Safety Assessment', '<p><span style=\"color: #424242; font-size: 15px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 15px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p><span style=\"font-size: 11pt;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>\r\n<p>&nbsp;</p>'),
(7, 1, 'post_1527257581.5719_g2.jpg', 3, NULL, 5, 'Huấn luyện An ninh', 'Security Training', '<p><span style=\"color: #424242; font-size: 15px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 15px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(8, 1, 'post_1527257622.9879_g3.jpg', 3, NULL, 5, 'Huấn luyện Tự vệ', 'Self Defense Training', '<p><span style=\"color: #424242; font-size: 15px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 15px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(9, 1, 'post_1527257696.3055_g4.jpg', 3, NULL, 5, 'Quản lý rủi ro', 'Risk Management', '<p><span style=\"color: #424242; font-size: 15px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 15px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(10, 1, 'post_1527257743.841_g5.jpg', 3, NULL, 5, 'Phương án dự phòng', 'Contingency Plan', '<p><span style=\"color: #424242; font-size: 15px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 15px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(11, 1, 'post_1527257797.1481_g6.jpg', 3, NULL, 5, 'PCCC & Thoát hiểm', 'Fire Fighting & Evacuation', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(12, 1, 'post_1527257836.6315_g1.jpg', 3, NULL, 5, 'Tư vấn Pháp lý', 'Legal Advisory ', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(13, 1, 'post_1527257911.7125_g2.jpg', 3, NULL, 6, 'Bảo vệ hộ tống', 'VIP Escort Protection', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p><span style=\"font-size: 11pt;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magnaat etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>\r\n<p>&nbsp;</p>'),
(14, 1, 'post_1527257985.6494_g3.jpg', 3, NULL, 6, 'Hỗ trợ khẩn cấp', 'Emergency Assistance Responses', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(15, 1, 'post_1527258028.8491_g5.jpg', 3, NULL, 6, 'Bảo vệ hộ tống tiền/ đồ vật quý giá', 'Cash/ Valuables Escort Protection', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(16, 1, 'post_1527258053.8654_g6.jpg', 3, NULL, 6, 'Sự kiện đặc biệt', 'Sự kiện đặc biệt', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(17, 1, 'post_1527258090.8445_g1.jpg', 3, NULL, 6, 'Bảo vệ Văn phòng, Nhà máy, Công ty, Kho bãi', 'Site Security', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(18, 1, 'post_1527258118.9197_g2.jpg', 3, NULL, 6, 'Đưa đón Sân bay', 'Airport Pick Up & Transportation', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(19, 1, 'post_1527258141.6431_g3.jpg', 3, NULL, 6, 'Xác minh thông tin cá nhân', 'Private Investigation', '<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"font-size: 11pt;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(20, 1, 'post_1527258170.7625_g4.jpg', 3, NULL, 7, 'Hệ thống camera quan sát', 'CCTV', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(21, 1, 'post_1527258206.2319_g5.jpg', 3, NULL, 7, 'Hệ thống Kiểm soát ra vào', 'Access Control', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(22, 1, 'post_1527258242.1834_g6.jpg', 3, NULL, 7, 'Hệ thống Báo trộm', 'Burglary Detection', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(23, 1, 'post_1527258274.7874_g1.jpg', 3, NULL, 7, 'Hệ thống Báo cháy', 'Fire Alarm', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p><span style=\"color: #424242; font-size: 14px;\">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>Lorem<span style=\"font-size: 11pt;\"> ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</span></p>', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>'),
(24, 1, 'post_1527520262.2075_g1.jpg', 1, NULL, 4, 'Post Title Will Be Here', 'Post Title Will Be Here', '<p class=\"MsoNormal\">Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi</p>', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi</p>', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.&nbsp;Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.</p>', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.&nbsp;Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.</p>'),
(25, 1, 'post_1527520337.2757_g2.jpg', 1, NULL, 4, 'Post Title Will Be Here', 'Post Title Will Be Here', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi</p>', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi</p>', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.&nbsp;Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.</p>', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.&nbsp;Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.</p>');
INSERT INTO `post` (`post_id`, `post_status`, `post_picture`, `post_type`, `post_view`, `category_id`, `post_title_vn`, `post_title_en`, `post_quote_vn`, `post_quote_en`, `post_body_vn`, `post_body_en`) VALUES
(26, 1, 'post_1527520370.5271_g3.jpg', 1, NULL, 4, 'Post Title Will Be Here', 'Post Title Will Be Here', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi</p>', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi</p>', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.&nbsp;Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.</p>', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.&nbsp;Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `template_id` tinyint(4) NOT NULL,
  `template_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template_content_vn` text COLLATE utf8_unicode_ci,
  `group_template_id` tinyint(4) NOT NULL,
  `template_status` tinyint(4) NOT NULL,
  `template_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template_content_en` text COLLATE utf8_unicode_ci,
  `template_title_vn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template_title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`template_id`, `template_picture`, `template_content_vn`, `group_template_id`, `template_status`, `template_name`, `template_content_en`, `template_title_vn`, `template_title_en`) VALUES
(7, 'template_1527342569.7571_logo.png', '', 5, 1, 'Logo', '<p></p>\r\n<p>&nbsp;</p>', '', ''),
(17, 'template_1527259888.7489_slide1.jpg', '<p>Ch&uacute;ng t&ocirc;i gắn kết chặc chẽ với c&ocirc;ng việc kinh doanh của c&aacute;c bạn v&agrave; tạo ra một m&ocirc;i trường l&agrave;m việc an to&agrave;n cho nh&acirc;n vi&ecirc;n, kh&aacute;ch h&agrave;ng, đối t&aacute;c, để c&aacute;c bạn c&oacute; thể chuy&ecirc;n t&acirc;m v&agrave;o c&ocirc;ng việc v&agrave; chăm s&oacute;c gia đ&igrave;nh của minh</p>', 6, 1, 'AN TOÀN CHO DOANH NGHIỆP', '<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>', '<span>AN TOÀN</span> CHO DOANH NGHIỆP', 'Lorem <span>ipsum dolor</span>'),
(18, 'template_1527259996.0589_slide2.jpg', '<p>An to&agrave;n l&agrave; nhu cầu thiết yếu của mỗi người v&agrave; những dịch vụ An ninh của ch&uacute;ng t&ocirc;i nhằm mục đ&iacute;ch l&agrave;m cho kh&aacute;ch h&agrave;ng cảm nhận được sự an to&agrave;n tuyệt đối</p>', 6, 1, 'GIẢI PHÁP AN NINH', '<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>', 'GIẢI PHÁP <span>AN NINH</span>', 'Lorem <span>ipsum dolor</span>'),
(19, 'template_1527342633.0308_about.jpg', '', 5, 1, 'Hình Về chúng tôi (Trang chủ)', '<p></p>\r\n<p>&nbsp;</p>', '', ''),
(20, 'template_1527345181.4123_customer.png', '<p>An<span style=\"font-size: 11pt;\"> ninh trật tư giữ vững 24/24 l&agrave; tr&aacute;ch nhiệm của Kim Quy. Ch&uacute;ng t&ocirc;i lu&ocirc;n lắng nghe v&agrave; đ&aacute;p ứng mọi y&ecirc;u cầu bảo vệ của qu&yacute; kh&aacute;ch</span></p>', 7, 1, 'Hỗ trợ 24/7', '<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>', 'Hỗ trợ 24/7', 'Lorem ipsum dolor'),
(21, 'template_1527345646.2866_employee.png', '<p>Đội<span style=\"font-size: 11pt;\"> ngũ nh&acirc;n vi&ecirc;n được đ&agrave;o tạo huấn luyện chuy&ecirc;n nghiệp, đảm bảo phải tu&acirc;n thủ tuyệt đối c&aacute;c nội quy, quy định của b&ecirc;n chủ quản.</span></p>', 7, 1, 'Đội ngũ chuyên nghiệp', '<p></p>\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis</p>', 'Đội ngũ chuyên nghiệp', 'Lorem ipsum dolor'),
(22, 'template_1527345334.2742_locked.png', '<p>Tuyệt<span style=\"font-size: 11pt;\"> đối bảo mật những th&ocirc;ng tin quan trọng của kh&aacute;ch h&agrave;ng về kỹ thuật cũng như kinh doanh.</span></p>', 7, 1, 'Bảo mật tuyệt đối', '<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis</p>', 'Bảo mật tuyệt đối', 'Lorem ipsum dolor'),
(23, 'template_1527345391.6131_lock.png', '<p><span style=\"font-size: 11pt;\">Cam kết chất lượng v&agrave; khả năng tối ưu h&oacute;a đối với mỗi sản phẩm, dịch vụ m&agrave; ch&uacute;ng t&ocirc;i cung cấp.</span></p>', 7, 1, 'Dịch vụ đảm bảo', '<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.</p>', 'Dịch vụ đảm bảo', 'Lorem ipsum dolor'),
(24, NULL, '<p><span style=\"font-size: 11pt;\">C&ocirc;ng ty Kim QUy l&agrave; c&ocirc;ng ty chuy&ecirc;n cung cấp dịch vụ bảo vệ chuy&ecirc;n nghiệp, uy t&iacute;n v&agrave; chất lượng. Với đội ngũ bảo vệ được trang bị, đ&agrave;o tạo kỹ lưỡng về t&aacute;c phong l&agrave;m việc, ăn n&oacute;i, đi đứng v&agrave; v&otilde; thuật th&agrave;nh thạo. L&agrave; lực lượng bảo vệ lu&ocirc;n đi đầu để hướng dẫn cho mọi đối tượng tho&aacute;t nạn khi gặp nguy hiểm, lu&ocirc;n c&oacute; &yacute; thức đặt t&iacute;nh mạng con người v&agrave; t&agrave;i sản của kh&aacute;ch h&agrave;ng l&ecirc;n h&agrave;ng đầu.</span></p>', 5, 1, 'Giới thiệu dịch vụ (Trang chủ)', '<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis&nbsp;Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis</p>', '', ''),
(25, NULL, '<div class=\"owl-item\">\r\n<div class=\"single-testimonial2\">\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.</p>\r\n<div class=\"testimonial2\">\r\n<div class=\"inner\">\r\n<div class=\"client-info\">\r\n<h2>David Max</h2>\r\n<h3>Ceo &amp; Founder</h3>\r\n</div>\r\n</div>\r\n<div class=\"inner\">\r\n<div class=\"testimonial2-client-img\"><img src=\"/public/pictures/contents/testimonial1.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"owl-item\">\r\n<div class=\"single-testimonial2\">\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.</p>\r\n<div class=\"testimonial2\">\r\n<div class=\"inner\">\r\n<div class=\"client-info\">\r\n<h2>David Max</h2>\r\n<h3>Ceo &amp; Founder</h3>\r\n</div>\r\n</div>\r\n<div class=\"inner\">\r\n<div class=\"testimonial2-client-img\"><img src=\"/public/pictures/contents/testimonial1.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 8, 1, 'Ý kiến 1', '<div class=\"owl-item\">\r\n<div class=\"single-testimonial2\">\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.</p>\r\n<div class=\"testimonial2\">\r\n<div class=\"inner\">\r\n<div class=\"client-info\">\r\n<h2>David Max</h2>\r\n<h3>Ceo &amp; Founder</h3>\r\n</div>\r\n</div>\r\n<div class=\"inner\">\r\n<div class=\"testimonial2-client-img\"><img src=\"/public/pictures/contents/testimonial1.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"owl-item\">\r\n<div class=\"single-testimonial2\">\r\n<p>Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec ac nec.</p>\r\n<div class=\"testimonial2\">\r\n<div class=\"inner\">\r\n<div class=\"client-info\">\r\n<h2>David Max</h2>\r\n<h3>Ceo &amp; Founder</h3>\r\n</div>\r\n</div>\r\n<div class=\"inner\">\r\n<div class=\"testimonial2-client-img\"><img src=\"/public/pictures/contents/testimonial1.jpg\" alt=\"\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '', ''),
(26, NULL, '<p>Ch&uacute;ng t&ocirc;i gắn kết chặc chẽ với c&ocirc;ng việc kinh doanh của c&aacute;c bạn v&agrave; tạo ra một m&ocirc;i trường l&agrave;m việc an to&agrave;n cho nh&acirc;n vi&ecirc;n, kh&aacute;ch h&agrave;ng, đối t&aacute;c, để c&aacute;c bạn c&oacute; thể chuy&ecirc;n t&acirc;m v&agrave;o c&ocirc;ng việc v&agrave; chăm s&oacute;c gia đ&igrave;nh của m&igrave;nh.</p>', 5, 1, 'Giới thiệu footer', '<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi. Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi</p>', '', ''),
(32, NULL, '', 5, 1, 'Địa chỉ', '<p></p>\r\n<p>&nbsp;</p>', '03D1 Khu Biệt Thự Thảo Nguyên Sài Gòn, Đường số 2 Hoàng Hữu Nam, P. Long Thạnh Mỹ, Q.9, Tp.HCM', '03D1 Khu Biệt Thự Thảo Nguyên Sài Gòn, Đường số 2 Hoàng Hữu Nam, P. Long Thạnh Mỹ, Q.9, Tp.HCM'),
(33, NULL, '', 5, 1, 'Email', '<p></p>\r\n<p>&nbsp;</p>', 'info@gtsec.asia, ops@gtsec.asia', 'info@gtsec.asia, ops@gtsec.asia'),
(34, NULL, '', 5, 1, 'Số điện thoại', '<p></p>\r\n<p>&nbsp;</p>', '+84 937 266 388 / +84 933 885 828', '+84 937 266 388 / +84 933 885 828'),
(35, NULL, '', 5, 1, 'Facebook link', '<p></p>\r\n<p>&nbsp;</p>', 'https://facebook.com', 'https://facebook.com'),
(36, 'template_1527601526.608_pg_hd.jpg', '', 5, 1, 'Banner header của Page', '<p></p>\r\n<p>&nbsp;</p>', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `template_picture`
--

CREATE TABLE `template_picture` (
  `template_picture_id` int(11) NOT NULL,
  `template_picture_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `template_picture`
--

INSERT INTO `template_picture` (`template_picture_id`, `template_picture_name`, `template_id`) VALUES
(6, 'template_1526915629.3282_lock.png', 16),
(7, 'template_1526915629.3339_g1.jpg', 16),
(8, 'template_1526915629.3368_g3.jpg', 16),
(9, 'template_1526915634.3839_g6.jpg', 16),
(10, 'template_1526915645.0633_g3.jpg', 16),
(11, 'template_1526915645.0685_employee.png', 16),
(12, 'template_1526915645.0713_g5.jpg', 16);

-- --------------------------------------------------------

--
-- Table structure for table `website_email`
--

CREATE TABLE `website_email` (
  `website_email_id` tinyint(4) NOT NULL,
  `website_email_system_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_email_system_host` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_email_system_port` smallint(6) DEFAULT NULL,
  `website_email_system_username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_email_system_password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_email_system_ssl` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `website_email`
--

INSERT INTO `website_email` (`website_email_id`, `website_email_system_name`, `website_email_system_host`, `website_email_system_port`, `website_email_system_username`, `website_email_system_password`, `website_email_system_ssl`) VALUES
(1, 'localhost.localdomain', 'smtp.googlemail.com', 465, 'anhtuan150787.4@gmail.com', 'smqboefvodhhdpxx', 'ssl');

-- --------------------------------------------------------

--
-- Table structure for table `website_general`
--

CREATE TABLE `website_general` (
  `website_general_id` tinyint(4) NOT NULL,
  `website_general_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_general_keyword` text COLLATE utf8_unicode_ci,
  `website_general_description` text COLLATE utf8_unicode_ci,
  `website_general_favicon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_general_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `website_general`
--

INSERT INTO `website_general` (`website_general_id`, `website_general_title`, `website_general_keyword`, `website_general_description`, `website_general_favicon`, `website_general_email`) VALUES
(1, 'CMS', 'CMS', 'CMS', 'favicon_1527305627.2647_logo.png', 'anhtuan150787@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `acl`
--
ALTER TABLE `acl`
  ADD PRIMARY KEY (`acl_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `group_account`
--
ALTER TABLE `group_account`
  ADD PRIMARY KEY (`group_account_id`);

--
-- Indexes for table `group_acl`
--
ALTER TABLE `group_acl`
  ADD PRIMARY KEY (`group_acl_id`);

--
-- Indexes for table `group_menu`
--
ALTER TABLE `group_menu`
  ADD PRIMARY KEY (`group_menu_id`);

--
-- Indexes for table `group_navigation`
--
ALTER TABLE `group_navigation`
  ADD PRIMARY KEY (`group_navigation_id`);

--
-- Indexes for table `group_template`
--
ALTER TABLE `group_template`
  ADD PRIMARY KEY (`group_template_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`navigation_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `template_picture`
--
ALTER TABLE `template_picture`
  ADD PRIMARY KEY (`template_picture_id`);

--
-- Indexes for table `website_email`
--
ALTER TABLE `website_email`
  ADD PRIMARY KEY (`website_email_id`);

--
-- Indexes for table `website_general`
--
ALTER TABLE `website_general`
  ADD PRIMARY KEY (`website_general_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `acl`
--
ALTER TABLE `acl`
  MODIFY `acl_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `group_account`
--
ALTER TABLE `group_account`
  MODIFY `group_account_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_acl`
--
ALTER TABLE `group_acl`
  MODIFY `group_acl_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9507;

--
-- AUTO_INCREMENT for table `group_menu`
--
ALTER TABLE `group_menu`
  MODIFY `group_menu_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3982;

--
-- AUTO_INCREMENT for table `group_navigation`
--
ALTER TABLE `group_navigation`
  MODIFY `group_navigation_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_template`
--
ALTER TABLE `group_template`
  MODIFY `group_template_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `navigation_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `template_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `template_picture`
--
ALTER TABLE `template_picture`
  MODIFY `template_picture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
