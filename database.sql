-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 03, 2021 lúc 08:00 AM
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

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procedureName` ()  BEGIN
/*Xu ly*/
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_author_field` (IN `fillterFiled` VARCHAR(50))  BEGIN
SELECT * 
        FROM author 
        WHERE author.phone IN (SELECT written.phone_author
                               FROM field JOIN written ON field.isbn=written.isbn
                               WHERE field.title LIKE fillterFiled);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_author_keywords` (IN `fillterFiled1` VARCHAR(50), IN `fillterFiled2` VARCHAR(50))  BEGIN
SELECT * 
                FROM author 
                WHERE author.phone IN (SELECT written.phone_author
                                       FROM keyword JOIN written ON keyword.isbn=written.isbn
                                       WHERE keyword.title IN (fillterFiled1,fillterFiled2));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_book_author` (IN `author_name` VARCHAR(50))  BEGIN
SELECT *
        FROM book
        WHERE book.isbn IN (SELECT written.isbn
        FROM author JOIN written ON author.phone=written.phone_author
        WHERE author.name LIKE author_name) AND book.deleted=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_book_filed` (IN `fillterFiled` VARCHAR(50))  BEGIN
SELECT *
                FROM field JOIN book ON field.isbn=book.isbn
                WHERE field.title LIKE fillterFiled AND book.deleted=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_book_keyword` (IN `fillterKeyword` VARCHAR(50))  BEGIN
		SELECT * 
        FROM keyword,book 
        WHERE keyword.isbn=book.isbn AND keyword.title LIKE fillterKeyword AND book.deleted=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_book_push_year` (IN `pushYear` YEAR(4))  BEGIN
		SELECT * 
        FROM book 
        WHERE year=pushYear AND deleted=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_bought_in_month` (IN `id` INT(11))  BEGIN
  SELECT *
        FROM book
        WHERE isbn IN (SELECT DISTINCT(bought.isbn)
        FROM invoice JOIN bought ON invoice.id=bought.invoice_id
        WHERE MONTH(invoice.date_pay)=12 AND invoice.customer_id=id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i10` ()  BEGIN
SELECT author.name,author.phone,SUM(bought.num)
            FROM author,bought,written,invoice
            WHERE MONTH(invoice.date_pay)='12' AND bought.invoice_id=invoice.id AND bought.isbn=written.isbn AND written.phone_author=author.phone
            GROUP BY author.name
            ORDER BY SUM(bought.num) DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i11` ()  BEGIN
SELECT book.isbn,book.name,SUM(bought.num),book.thumbnail
            FROM bought,book,invoice
            WHERE MONTH(invoice.date_pay)='12' AND bought.invoice_id=invoice.id AND bought.isbn=book.isbn
            GROUP BY book.isbn
            ORDER BY SUM(bought.num) DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i12` ()  BEGIN
SELECT *
            FROM invoice
            WHERE invoice.method_pay=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i13` ()  BEGIN
SELECT *
            FROM invoice
            WHERE invoice.method_pay=1 AND invoice.state=5;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i14` ()  BEGIN
SELECT count(storageaddress.address_id),addressstore.address
            FROM storageaddress JOIN addressstore ON storageaddress.address_id=addressstore.id
            GROUP BY storageaddress.address_id
            HAVING count(storageaddress.address_id) < 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i15` ()  BEGIN
SELECT storageaddress.isbn,book.name,storageaddress.quantity,addressstore.address,storageaddress.ngaynhap
            FROM storageaddress,book,addressstore
            WHERE MONTH(storageaddress.ngaynhap)='12' AND book.isbn=storageaddress.isbn AND addressstore.id=storageaddress.address_id
            ORDER BY addressstore.address ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i16` ()  BEGIN
SELECT COUNT(bought.id),bought.id_store,addressstore.address
            FROM bought,invoice,addressstore
            WHERE MONTH(invoice.date_pay)='12' AND bought.invoice_id=invoice.id AND bought.id_store=addressstore.id
            GROUP BY bought.id_store;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i4` ()  BEGIN
SELECT * 
FROM book
WHERE book.isbn IN (SELECT DISTINCT(bought.isbn)
		    FROM bought JOIN invoice ON bought.invoice_id=invoice.id
		    WHERE invoice.date_pay='2021-12-01') AND book.deleted=1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i5` ()  BEGIN
SELECT DISTINCT(bought.isbn),SUM(bought.num),book.name,book.thumbnail,invoice.date_pay
            FROM bought,invoice,book
            WHERE invoice.date_pay='2021-12-01' AND bought.invoice_id=invoice.id AND book.isbn=bought.isbn
            GROUP BY bought.isbn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i6` ()  BEGIN
SELECT DISTINCT(bought.isbn),SUM(bought.num),book.name,book.price,book.thumbnail,invoice.date_pay
            FROM bought,invoice,book
            WHERE invoice.date_pay='2021-12-01' AND bought.invoice_id=invoice.id AND book.isbn=bought.isbn AND bought.typebook=0
            GROUP BY bought.isbn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i7` ()  BEGIN
SELECT DISTINCT(bought.isbn),SUM(bought.num),book.name,book.price,book.thumbnail,invoice.date_pay
            FROM bought,invoice,book
            WHERE invoice.date_pay='2021-12-01' AND bought.invoice_id=invoice.id AND book.isbn=bought.isbn AND bought.typebook=1
            GROUP BY bought.isbn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i8` ()  BEGIN
SELECT DISTINCT(lend.isbn),COUNT(lend.isbn),book.name,book.price,book.thumbnail,invoice.date_pay
            FROM lend,invoice,book
            WHERE invoice.date_pay='2021-12-01' AND lend.invoice_id=invoice.id AND book.isbn=lend.isbn
            GROUP BY lend.isbn;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_i9` ()  BEGIN
SELECT author.name,author.phone,SUM(bought.num)
            FROM author,bought,written,invoice
            WHERE invoice.date_pay='2021-12-01' AND bought.invoice_id=invoice.id AND bought.isbn=written.isbn AND written.phone_author=author.phone
            GROUP BY author.name
            ORDER BY SUM(bought.num) DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_trans_in_month` (IN `id` INT(11))  BEGIN
  SELECT * 
  FROM invoice
  WHERE invoice.customer_id=id 
  AND MONTH(invoice.date_pay)=12;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_trans_in_month_error` (IN `id` INT(11))  BEGIN
SELECT * 
            FROM invoice
            WHERE invoice.customer_id=id AND MONTH(invoice.date_pay)=12 AND state=5;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `store_trans_not_complete` (IN `id` INT(11))  BEGIN
SELECT * 
            FROM invoice
            WHERE invoice.customer_id=id AND MONTH(invoice.date_pay)=12 AND state IN (0,4);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addressstore`
--

CREATE TABLE `addressstore` (
  `id` int(11) NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `addressstore`
--

INSERT INTO `addressstore` (`id`, `address`) VALUES
(0, 'Thành phố Hồ Chí Minh'),
(1, 'Hà Nội');

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
('0123456789', 'Nguyễn Văn A'),
('1234567890', 'Nguyễn Văn B'),
('2345678910', 'Nguyễn Văn D'),
('3456789012', 'Lê Thị E'),
('4567890123', 'Lê Thị F');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nxb_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `typebook` int(11) NOT NULL DEFAULT 2,
  `thumbnail` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`isbn`, `name`, `nxb_id`, `price`, `typebook`, `thumbnail`, `year`, `deleted`) VALUES
('111111', 'Đơn giản hóa cuộc sống', 5, 98000, 0, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/i/m/image_237790.jpg', 2018, 1),
('123456', 'Tâm tĩnh lặng', 6, 23, 2, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/i/m/image_237789.jpg', 2000, 1),
('234567', 'Marry Curie', 6, 75000, 2, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/600x600/9df78eab33525d08d6e5fb8d27136e95/i/m/image_237524.jpg', 2019, 1),
('241651', 'Dr. Stone', 4, 30000, 2, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/d/r/dr.-stone---tap-9.jpg', 2018, 0),
('281626', 'Nhân loại - Một lịch sử tràn đầy hi vọng', 6, 200000, 1, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/i/m/image_244718_1_4399.jpg', 2017, 1),
('372209', 'Gokusen', 5, 45000, 0, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/n/x/nxbtre_full_29122021_041207.jpg', 2017, 1),
('411407', 'Công cụ và vũ khí', 6, 152000, 2, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/n/x/nxbtre_full_15562021_025621.jpg', 2017, 1),
('498406', 'Đôi giày ba-lê', 6, 135000, 0, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/i/m/image_244718_1_5092.jpg', 2017, 1),
('593777', 'Boruto', 4, 25000, 2, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/b/o/boruto---naruto-hau-sinh-kha-uy---tap-9.jpg', 2017, 1),
('642978', 'Tinh hoa đạo học', 5, 1500000, 1, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/b/_/b_-s_ch-tinh-hoa-_o-h_c-_ng-ph_ng.jpg', 2018, 1),
('687906', 'Ý Chí', 6, 122000, 1, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/i/m/image_244718_1_1497.jpg', 2018, 1),
('811749', '7 viên ngọc rồng', 4, 40000, 0, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/d/r/dragon-ball-super-tap-13.jpg', 2020, 1),
('823843', 'Bleach', 4, 25000, 1, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/b/l/bleach---tap-57.jpg', 2020, 1),
('837527', 'Bảy kiểu người tôi gặp trong hiệu sách', 6, 53000, 2, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/i/m/image_244718_1_4724.jpg', 2021, 1),
('871415', 'Hậu khủng hoảng', 5, 178000, 0, 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/n/x/nxbtre_full_15142021_031408.jpg', 2020, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bought`
--

CREATE TABLE `bought` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `num` int(11) NOT NULL,
  `total_money` int(11) NOT NULL,
  `typebook` int(11) NOT NULL DEFAULT 0,
  `id_store` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bought`
--

INSERT INTO `bought` (`id`, `invoice_id`, `isbn`, `num`, `total_money`, `typebook`, `id_store`) VALUES
(8, 12, '241651', 1, 30000, 0, 0),
(9, 13, '241651', 1, 30000, 0, 1),
(10, 14, '241651', 1, 30000, 0, 0),
(11, 14, '593777', 2, 0, 0, 0),
(12, 15, '241651', 1, 30000, 1, 1),
(13, 15, '593777', 2, 0, 0, 0),
(14, 20, '111111', 1, 98000, 0, 1),
(15, 20, '241651', 1, 30000, 0, 0),
(16, 20, '593777', 1, 25000, 1, 0),
(17, 21, '111111', 1, 98000, 1, 0),
(18, 21, '241651', 1, 30000, 1, 0),
(19, 21, '372209', 1, 45000, 0, 0),
(20, 21, '593777', 1, 25000, 0, 1),
(21, 22, '372209', 1, 45000, 1, 0),
(22, 22, '593777', 1, 25000, 1, 0);

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
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `bank_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `branch_bank` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_end` date NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `seri` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `creditcard`
--

INSERT INTO `creditcard` (`id`, `customer_id`, `bank_name`, `branch_bank`, `date_end`, `username`, `seri`) VALUES
(1, 5, 'OCB', 'Thủ Đức', '2023-12-11', 'Nguyễn Tấn Lộc', '03684257935');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `email`, `address`, `name`, `password`, `phone`, `role_id`) VALUES
(5, 'a@gmail.com', '462 trần hưng đạo phường 2 quận 5222', 'Nguyễn Tấn Lộc', 'b4cbd48886a5331c5eb2fedadabe311c', '03476512', 1),
(6, 'staff@gmail.com', 'Hà nội', 'Nguyễn Tấn Lộc', 'b4cbd48886a5331c5eb2fedadabe311c', '0347651292', 2);

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
('123456', 'https://www.fahasa.com/tam-tinh-lang-buoc-cham-lai-de-thanh-cong.html'),
('234567', 'https://www.fahasa.com/marie-curie-nha-nu-khoa-hoc-kiet-xuat.html'),
('241651', 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/d/r/dr.-stone---tap-9.jpg'),
('281626', 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/i/m/image_244718_1_4399.jpg'),
('411407', 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/n/x/nxbtre_full_15562021_025621.jpg'),
('593777', 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/b/o/boruto---naruto-hau-sinh-kha-uy---tap-9.jpg'),
('642978', 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/b/_/b_-s_ch-tinh-hoa-_o-h_c-_ng-ph_ng.jpg'),
('687906', 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/i/m/image_244718_1_1497.jpg'),
('823843', 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/b/l/bleach---tap-57.jpg'),
('837527', 'https://cdn0.fahasa.com/media/catalog/product/cache/1/small_image/400x400/9df78eab33525d08d6e5fb8d27136e95/i/m/image_244718_1_4724.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `field`
--

CREATE TABLE `field` (
  `id` int(11) NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `field`
--

INSERT INTO `field` (`id`, `isbn`, `title`) VALUES
(1, '241651', 'Truyện tranh'),
(2, '241651', 'Khoa học'),
(3, '281626', 'Lịch sử'),
(4, '372209', 'Truyện tranh'),
(5, '372209', 'Hành động'),
(6, '411407', 'Hành động'),
(7, '411407', 'Lịch sử'),
(8, '498406', 'Truyện tranh'),
(9, '498406', 'Tình yêu'),
(10, '593777', 'Truyện tranh'),
(11, '593777', 'Hành động'),
(12, '642978', 'Lịch sử'),
(13, '642978', 'Đạo học'),
(14, '687906', 'Con người'),
(15, '811749', 'Truyện tranh'),
(16, '811749', 'Hành động'),
(17, '823843', 'Truyện tranh'),
(18, '823843', 'Hành động'),
(19, '837527', 'Con người'),
(20, '871415', 'Kinh tế'),
(21, '111111', 'Cuộc sống');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_money` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `method_pay` int(11) DEFAULT NULL,
  `date_pay` date DEFAULT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `invoice`
--

INSERT INTO `invoice` (`id`, `customer_id`, `total_money`, `state`, `method_pay`, `date_pay`, `fullname`, `phone`, `address`) VALUES
(6, 5, 278000, 5, 1, '2021-12-01', 'Nguyễn 1Tấn Lộc', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(7, 5, 278000, 5, 1, '2021-12-01', 'Nguyễn Tấn Lộc', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(8, 5, 278000, 5, 1, '2021-12-01', 'Nguyễn Tấn Lộc', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(9, 6, 278000, 0, 0, '2021-12-01', 'Nguyễn Tấn Lộc', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(10, 5, 180000, 0, 1, '2021-12-01', 'L1', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(11, 5, 180000, 0, 0, '2021-12-01', 'L1', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(12, 5, 30000, 0, 0, '2021-12-01', 'l2', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(13, 5, 30000, 0, 0, '2021-12-01', 'l2', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(14, 5, 55000, 0, 0, '2021-12-01', 'l3', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(15, 5, 55000, 0, 0, '2021-12-01', 'l4', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(16, 5, 55000, 0, 0, '2021-12-01', 'l5', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(17, 5, 153000, 0, 0, '2021-12-01', 'l6', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(18, 5, 153000, 0, 0, '2021-12-01', 'a1', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(19, 5, 153000, 0, 0, '2021-12-01', 'a2', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(20, 5, 153000, 0, 0, '2021-12-01', 'a3', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(21, 5, 198000, 0, 0, '2021-12-01', 'a4', '0347651292', '462 trần hưng đạo phường 2 quận 5'),
(22, 5, 70000, 0, 0, '2021-12-01', 'a6', '0347651292', '462 trần hưng đạo phường 2 quận 5');

--
-- Bẫy `invoice`
--
DELIMITER $$
CREATE TRIGGER `before_update_state_invoice` BEFORE UPDATE ON `invoice` FOR EACH ROW BEGIN
	IF(old.state=1) THEN
    	SET new.state=3;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `keyword`
--

CREATE TABLE `keyword` (
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `keyword`
--

INSERT INTO `keyword` (`title`, `isbn`) VALUES
('Chiến đấu', '281626'),
('Chiến đấu', '811749'),
('Chiến đấu', '823843'),
('Nhân sinh', '241651'),
('Nhân sinh', '411407'),
('Nhân sinh', '498406'),
('Nhân sinh', '687906'),
('Nhân sinh', '837527'),
('Phá hủy', '411407'),
('Phá hủy', '498406'),
('Sáng tạo', '372209'),
('Sáng tạo', '837527'),
('Sáng tạo', '871415');

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
  `date_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lend`
--

INSERT INTO `lend` (`id`, `invoice_id`, `isbn`, `link_encode`, `date_start`, `date_end`) VALUES
(4, 11, '687906', 'https://www.w3schools.com/sql/sql_groupby.asp', '2021-12-02', '2021-12-10'),
(5, 13, '837527', 'https://www.w3schools.com/sql/sql_groupby.asp', '2021-12-02', '2021-12-03');

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
(4, 'Nhà Xuất Bản Kim Đồng'),
(5, 'Nhà Xuất Bản Trẻ'),
(6, 'Tân Viẹt');

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
('111111', 1, 8),
('123456', 1, 9),
('234567', 1, 11),
('241651', 1, 10),
('372209', 1, 10),
('411407', 1, 5),
('498406', 1, 17),
('593777', 1, 15),
('811749', 1, 2),
('837527', 0, 8),
('871415', 0, 20);

--
-- Bẫy `printed_book`
--
DELIMITER $$
CREATE TRIGGER `before_update_state_printed_book` BEFORE UPDATE ON `printed_book` FOR EACH ROW BEGIN
IF(old.quantity > 0) THEN
    	SET new.state=1;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `storageaddress`
--

CREATE TABLE `storageaddress` (
  `id` int(11) NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `ngaynhap` date DEFAULT NULL,
  `ngayxuat` date DEFAULT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `storageaddress`
--

INSERT INTO `storageaddress` (`id`, `isbn`, `quantity`, `ngaynhap`, `ngayxuat`, `address_id`) VALUES
(53, '123456', 3, '2021-12-01', NULL, 0),
(54, '123456', 6, '2021-12-01', NULL, 0),
(55, '111111', 8, '2021-12-01', NULL, 1),
(56, '234567', 6, '2021-12-01', NULL, 1),
(59, '234567', 5, '2021-12-01', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `written`
--

CREATE TABLE `written` (
  `phone_author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `written`
--

INSERT INTO `written` (`phone_author`, `isbn`) VALUES
('0123456789', '241651'),
('0123456789', '281626'),
('0123456789', '823843'),
('1234567890', '372209'),
('1234567890', '411407'),
('1234567890', '837527'),
('2345678910', '241651'),
('2345678910', '411407'),
('2345678910', '498406'),
('2345678910', '593777'),
('2345678910', '871415'),
('3456789012', '281626'),
('3456789012', '372209'),
('3456789012', '642978'),
('3456789012', '687906'),
('4567890123', '372209'),
('4567890123', '498406'),
('4567890123', '811749'),
('4567890123', '871415');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addressstore`
--
ALTER TABLE `addressstore`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `c_invoiceid4` (`invoice_id`),
  ADD KEY `idstore` (`id`),
  ADD KEY `fk_store` (`id_store`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_credit_id` (`customer_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`isbn`);

--
-- Chỉ mục cho bảng `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_field_isbn` (`isbn`);

--
-- Chỉ mục cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice_cus_id` (`customer_id`);

--
-- Chỉ mục cho bảng `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`title`,`isbn`),
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
  ADD KEY `isbn` (`isbn`),
  ADD KEY `fk_addressid` (`address_id`) USING BTREE;

--
-- Chỉ mục cho bảng `written`
--
ALTER TABLE `written`
  ADD PRIMARY KEY (`phone_author`,`isbn`),
  ADD KEY `fk_wisbn` (`isbn`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addressstore`
--
ALTER TABLE `addressstore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `bought`
--
ALTER TABLE `bought`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `creditcard`
--
ALTER TABLE `creditcard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `field`
--
ALTER TABLE `field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `lend`
--
ALTER TABLE `lend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `nxb`
--
ALTER TABLE `nxb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `storageaddress`
--
ALTER TABLE `storageaddress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_nxb` FOREIGN KEY (`nxb_id`) REFERENCES `nxb` (`id`);

--
-- Các ràng buộc cho bảng `bought`
--
ALTER TABLE `bought`
  ADD CONSTRAINT `bought_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`),
  ADD CONSTRAINT `c_invoiceid4` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  ADD CONSTRAINT `fk_store` FOREIGN KEY (`id_store`) REFERENCES `addressstore` (`id`);

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
  ADD CONSTRAINT `fk_credit_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Các ràng buộc cho bảng `ebook`
--
ALTER TABLE `ebook`
  ADD CONSTRAINT `ebook_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

--
-- Các ràng buộc cho bảng `field`
--
ALTER TABLE `field`
  ADD CONSTRAINT `fk_field_isbn` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

--
-- Các ràng buộc cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_cus_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

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
  ADD CONSTRAINT `fk_addid` FOREIGN KEY (`address_id`) REFERENCES `addressstore` (`id`),
  ADD CONSTRAINT `storageaddress_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

--
-- Các ràng buộc cho bảng `written`
--
ALTER TABLE `written`
  ADD CONSTRAINT `fk_wisbn` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`),
  ADD CONSTRAINT `fk_wphone` FOREIGN KEY (`phone_author`) REFERENCES `author` (`phone`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
