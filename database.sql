-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 07, 2021 lúc 04:48 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `database`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `author`
--

CREATE TABLE `author` (
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `author`
--

INSERT INTO `author` (`phone`, `name`) VALUES
('01234567894', 'Van A'),
('32168754219', 'Van B'),
('41369875126', 'Van C'),
('43698752164', 'Van D');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nxb_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `typebook` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`isbn`, `name`, `nxb_id`, `price`, `status`, `typebook`) VALUES
('111111', 'Nhà giả kim', 1, 99000, 0, 2),
('123456', 'Những đứa con của biển cả', 1, 50000, 1, 1),
('234567', 'Harry Potter', 3, 145000, 1, 0),
('456123', 'Overload', 2, 45000, 1, 2),
('789123', 'Ebook', 1, 50000, 1, 1),
('987654', 'Đứa con của quỷ dữ', 2, 25000, 0, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bought`
--

CREATE TABLE `bought` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bought`
--

INSERT INTO `bought` (`id`, `invoice_id`, `isbn`, `purchase_date`, `num`) VALUES
(1, 1, '111111', '2021-11-06', 2),
(2, 3, '234567', '2021-11-06', 1),
(3, 1, '234567', '2021-11-06', 2),
(4, 3, '987654', '2021-11-06', 4),
(5, 2, '987654', '2021-11-06', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cooperate`
--

CREATE TABLE `cooperate` (
  `author_phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nxb_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `creditcard`
--

CREATE TABLE `creditcard` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cus_gmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cre_username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cre_branch` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `gmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`gmail`, `user`, `address`, `name`) VALUES
('locnguyen@gmail.com', 'Tan Loc', 'Tay Ninh', 'Nguyen Tan Loc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ebook`
--

CREATE TABLE `ebook` (
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ebook`
--

INSERT INTO `ebook` (`isbn`, `link`) VALUES
('111111', 'http://localhost/database/index.php'),
('234567', 'https://langgo.edu.vn/download-tron-bo-harry-potter-song-ngu-anh-viet-full-ebook-audio'),
('456123', 'https://www.w3schools.com/mysql/mysql_orderby.asp'),
('789123', 'https://langgo.edu.vn/download-tron-bo-harry-potter-song-ngu-anh-viet-full-ebook-audio');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `field`
--

CREATE TABLE `field` (
  `field` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `cus_gmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `total_money` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `method_pay` int(11) DEFAULT NULL,
  `date_pay` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `invoice`
--

INSERT INTO `invoice` (`id`, `cus_gmail`, `total_money`, `state`, `method_pay`, `date_pay`) VALUES
(1, 'locnguyen@gmail.com', 20000, 0, 0, '2021-11-06'),
(2, 'locnguyen@gmail.com', 23231, 1, 0, '2021-11-06'),
(3, 'locnguyen@gmail.com', 33990000, 1, 0, '2021-11-05'),
(4, 'locnguyen@gmail.com', 50000, 0, 0, '2021-11-06'),
(5, 'locnguyen@gmail.com', 20000, 0, 1, '2021-11-06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `keyword`
--

CREATE TABLE `keyword` (
  `keyword` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lend`
--

CREATE TABLE `lend` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link_encode` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `suco` int(11) NOT NULL DEFAULT 0,
  `date_lend` date NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lend`
--

INSERT INTO `lend` (`id`, `invoice_id`, `isbn`, `link_encode`, `date_start`, `date_end`, `suco`, `date_lend`, `quantity`) VALUES
(1, 2, '111111', 'q1.com', '2021-11-08', '2021-11-10', 0, '2021-11-06', 1),
(2, 4, '456123', 'q1.com', '2021-11-11', '2021-11-18', 0, '2021-11-06', 1),
(3, 4, '456123', 'q3.com', '2021-11-11', '2021-11-25', 0, '2021-11-06', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nxb`
--

CREATE TABLE `nxb` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nxb`
--

INSERT INTO `nxb` (`id`, `name`) VALUES
(1, 'Kim đồng'),
(2, 'Ngọc nữ'),
(3, 'Nguyễn Ái Quốc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `printed_book`
--

CREATE TABLE `printed_book` (
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `printed_book`
--

INSERT INTO `printed_book` (`isbn`, `state`, `quantity`) VALUES
('111111', 1, 10),
('123456', 1, 15),
('456123', 1, 10),
('987654', 1, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `storageaddress`
--

CREATE TABLE `storageaddress` (
  `id` int(11) NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `ngaynhap` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `storageaddress`
--

INSERT INTO `storageaddress` (`id`, `isbn`, `address`, `quantity`, `ngaynhap`) VALUES
(4, '987654', 'Hà nội', 5, '2021-11-06'),
(5, '987654', 'Thành phố Hồ Chí Minh', 5, '2021-11-06'),
(6, '123456', 'Hà nội', 8, '2021-11-02'),
(7, '123456', 'Thành phố Hồ Chí Minh', 7, '2021-11-02'),
(8, '456123', 'Hà nội', 8, '2021-11-04'),
(9, '456123', 'Thành phố Hồ Chí Minh', 2, '2021-11-04'),
(18, '111111', 'Hà nội', 8, '2021-11-09'),
(19, '111111', 'Thành phố Hồ Chí Minh', 2, '2021-11-09'),
(28, '789123', 'Hà nội', 1, '2021-11-01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `written`
--

CREATE TABLE `written` (
  `id` int(11) NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `author_phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `written`
--

INSERT INTO `written` (`id`, `isbn`, `author_phone`) VALUES
(1, '111111', '01234567894'),
(2, '111111', '32168754219'),
(3, '111111', '41369875126'),
(4, '123456', '43698752164'),
(5, '123456', '01234567894'),
(6, '234567', '41369875126'),
(7, '456123', '41369875126'),
(8, '789123', '43698752164'),
(9, '987654', '32168754219'),
(10, '234567', '32168754219');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`phone`);

--
-- Chỉ mục cho bảng `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn`);

--
-- Chỉ mục cho bảng `bought`
--
ALTER TABLE `bought`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isbn` (`isbn`),
  ADD KEY `c_invoiceid4` (`invoice_id`);

--
-- Chỉ mục cho bảng `cooperate`
--
ALTER TABLE `cooperate`
  ADD PRIMARY KEY (`author_phone`,`nxb_id`),
  ADD KEY `nxb_id` (`nxb_id`);

--
-- Chỉ mục cho bảng `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`id`,`cus_gmail`);
ALTER TABLE `creditcard` ADD FULLTEXT KEY `cus_gmail` (`cus_gmail`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`gmail`);

--
-- Chỉ mục cho bảng `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`isbn`);

--
-- Chỉ mục cho bảng `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`field`,`isbn`),
  ADD KEY `isbn` (`isbn`);

--
-- Chỉ mục cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cus_gmail` (`cus_gmail`);

--
-- Chỉ mục cho bảng `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`keyword`,`isbn`),
  ADD KEY `isbn` (`isbn`);

--
-- Chỉ mục cho bảng `lend`
--
ALTER TABLE `lend`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_invoicelend` (`invoice_id`),
  ADD KEY `lend_ibfk_2` (`isbn`);

--
-- Chỉ mục cho bảng `nxb`
--
ALTER TABLE `nxb`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `printed_book`
--
ALTER TABLE `printed_book`
  ADD PRIMARY KEY (`isbn`);

--
-- Chỉ mục cho bảng `storageaddress`
--
ALTER TABLE `storageaddress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isbn` (`isbn`);

--
-- Chỉ mục cho bảng `written`
--
ALTER TABLE `written`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isbn` (`isbn`),
  ADD KEY `fkphone` (`author_phone`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bought`
--
ALTER TABLE `bought`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `lend`
--
ALTER TABLE `lend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nxb`
--
ALTER TABLE `nxb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `storageaddress`
--
ALTER TABLE `storageaddress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `written`
--
ALTER TABLE `written`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bought`
--
ALTER TABLE `bought`
  ADD CONSTRAINT `bought_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`),
  ADD CONSTRAINT `c_invoiceid4` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`);

--
-- Các ràng buộc cho bảng `cooperate`
--
ALTER TABLE `cooperate`
  ADD CONSTRAINT `cooperate_ibfk_1` FOREIGN KEY (`author_phone`) REFERENCES `author` (`phone`),
  ADD CONSTRAINT `cooperate_ibfk_2` FOREIGN KEY (`nxb_id`) REFERENCES `nxb` (`id`);

--
-- Các ràng buộc cho bảng `creditcard`
--
ALTER TABLE `creditcard`
  ADD CONSTRAINT `creditcard_ibfk_1` FOREIGN KEY (`cus_gmail`) REFERENCES `customer` (`gmail`);

--
-- Các ràng buộc cho bảng `ebook`
--
ALTER TABLE `ebook`
  ADD CONSTRAINT `ebook_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

--
-- Các ràng buộc cho bảng `field`
--
ALTER TABLE `field`
  ADD CONSTRAINT `field_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

--
-- Các ràng buộc cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`cus_gmail`) REFERENCES `customer` (`gmail`);

--
-- Các ràng buộc cho bảng `keyword`
--
ALTER TABLE `keyword`
  ADD CONSTRAINT `keyword_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

--
-- Các ràng buộc cho bảng `lend`
--
ALTER TABLE `lend`
  ADD CONSTRAINT `c_invoicelend` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  ADD CONSTRAINT `lend_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `ebook` (`isbn`);

--
-- Các ràng buộc cho bảng `printed_book`
--
ALTER TABLE `printed_book`
  ADD CONSTRAINT `printed_book_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

--
-- Các ràng buộc cho bảng `storageaddress`
--
ALTER TABLE `storageaddress`
  ADD CONSTRAINT `storageaddress_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

--
-- Các ràng buộc cho bảng `written`
--
ALTER TABLE `written`
  ADD CONSTRAINT `fkphone` FOREIGN KEY (`author_phone`) REFERENCES `author` (`phone`),
  ADD CONSTRAINT `written_ibfk_1` FOREIGN KEY (`author_phone`) REFERENCES `author` (`phone`),
  ADD CONSTRAINT `written_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
