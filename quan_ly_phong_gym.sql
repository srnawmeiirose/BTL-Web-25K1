-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2025 at 05:52 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quan_ly_phong_gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `don_hang_id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `so_luong` int NOT NULL,
  `don_gia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dang_ky`
--

CREATE TABLE `dang_ky` (
  `id` int NOT NULL,
  `nguoi_dung_id` int NOT NULL,
  `goi_tap_id` int NOT NULL,
  `ngay_dang_ky` date NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_het_han` date NOT NULL,
  `trang_thai` enum('con_han','het_han') DEFAULT 'con_han'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dang_ky`
--

INSERT INTO `dang_ky` (`id`, `nguoi_dung_id`, `goi_tap_id`, `ngay_dang_ky`, `ngay_bat_dau`, `ngay_het_han`, `trang_thai`) VALUES
(1, 2, 3, '2025-12-01', '2025-12-01', '2025-12-30', 'con_han');

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int NOT NULL,
  `nguoi_dung_id` int NOT NULL,
  `ngay_dat` datetime DEFAULT CURRENT_TIMESTAMP,
  `tong_tien` decimal(10,2) DEFAULT NULL,
  `trang_thai` enum('cho_xu_ly','dang_giao','hoan_thanh','huy') DEFAULT 'cho_xu_ly'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`id`, `nguoi_dung_id`, `ngay_dat`, `tong_tien`, `trang_thai`) VALUES
(1, 2, '2025-12-24 23:28:14', 30000.00, 'cho_xu_ly');

-- --------------------------------------------------------

--
-- Table structure for table `goi_tap`
--

CREATE TABLE `goi_tap` (
  `id` int NOT NULL,
  `ten_goi` varchar(20) NOT NULL,
  `so_ngay_dung` int NOT NULL,
  `gia` int NOT NULL,
  `mo_ta` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `goi_tap`
--

INSERT INTO `goi_tap` (`id`, `ten_goi`, `so_ngay_dung`, `gia`, `mo_ta`) VALUES
(1, 'Gói ngày', 1, 30000, 'Tập 1 ngày, thích chọn buổi nào cũng được.'),
(2, 'Gói tuần', 7, 150000, 'Tập trong 7 ngày liên tục, mọi khung giờ.'),
(3, 'Gói tháng', 30, 400000, 'Tập trong 1 tháng, tập giờ nào thì tập.'),
(4, 'Gói năm', 365, 6000000, 'Tập trong 1 năm, tùy chọn khung giờ và khoảng thười gian tập trong ngày.');

-- --------------------------------------------------------

--
-- Table structure for table `loai_san_pham`
--

CREATE TABLE `loai_san_pham` (
  `id` int NOT NULL,
  `ten_loai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loai_san_pham`
--

INSERT INTO `loai_san_pham` (`id`, `ten_loai`) VALUES
(1, 'Thực phẩm chức năng'),
(2, 'Đồ uống'),
(3, 'Phụ kiện'),
(4, 'Gói tập'),
(5, 'Whey – BCAA');

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `id` int NOT NULL,
  `tai_khoan` varchar(255) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `sdt` varchar(10) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `gioi_tinh` enum('nam','nu','khac') DEFAULT NULL,
  `vai_tro_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id`, `tai_khoan`, `mat_khau`, `ho_ten`, `sdt`, `email`, `dia_chi`, `ngay_sinh`, `gioi_tinh`, `vai_tro_id`) VALUES
(1, 'tamtam', 'pass_tamtam', 'Nguyễn Thị Thanh Tâm', '0966030056', 'tamtam@gmail.com', 'Đại Thanh', '2005-01-01', 'nu', 1),
(2, 'client', 'pass_client', 'Nguyễn Thị Bưởi', '0966000000', 'client@gmail.com', 'Hà Tây', '2000-06-06', 'nu', 2);

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `id` int NOT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `mo_ta` text,
  `hinh_anh` text,
  `loai_san_pham_id` int DEFAULT NULL,
  `trang_thai` enum('con_hang','het_hang') DEFAULT 'con_hang'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`id`, `ten_san_pham`, `gia`, `mo_ta`, `hinh_anh`, `loai_san_pham_id`, `trang_thai`) VALUES
(2, 'Omega-3  ', 150000.00, 'Thực phẩm bổ sung', 'omega3.jpg', 5, 'con_hang'),
(3, 'Whey Protein A', 200000.00, 'Thực phẩm bổ sung', 'whey1.jpg', 1, 'con_hang'),
(4, 'Whey Protein A', 200000.00, 'Thực phẩm bổ sung', 'whey2.jpg', 1, 'con_hang'),
(5, 'Whey Protein A', 200000.00, 'Thực phẩm bổ sung', 'whey3.jpg', 1, 'con_hang'),
(6, 'Whey Protein A', 200000.00, 'Thực phẩm bổ sung', 'whey4.jpg', 1, 'con_hang'),
(7, 'Găng loại A', 200000.00, 'Găng tập luyện', 'gang2.jpg', 3, 'con_hang'),
(8, 'Găng loại A', 200000.00, 'Găng tập luyện', 'gang3.png', 3, 'con_hang'),
(9, 'Găng loại A', 200000.00, 'Găng tập luyện', 'gang4.jpg', 3, 'con_hang'),
(10, 'Găng loại A', 200000.00, 'Găng tập luyện', 'gang5.jpg', 3, 'con_hang'),
(11, 'Găng loại A', 200000.00, 'Găng tập luyện', 'gang6.jpg', 3, 'con_hang'),
(12, 'Găng loại A', 200000.00, 'Găng tập luyện', 'strap.jpg', 3, 'con_hang'),
(13, 'Găng loại A', 200000.00, 'Găng tập luyện', 'strap1.jpg', 3, 'con_hang'),
(14, 'Găng loại A', 200000.00, 'Găng tập luyện', 'strap2.jpg', 3, 'con_hang'),
(15, 'Găng loại A', 200000.00, 'Găng tập luyện', 'strap3.png', 3, 'con_hang'),
(16, 'Găng loại A', 200000.00, 'Găng tập luyện', 'strap4.png', 3, 'con_hang'),
(17, 'Găng loại A', 200000.00, 'Găng tập luyện', 'strap5.png', 3, 'con_hang'),
(18, 'Ring', 250000.00, 'Hỗ trợ kéo xà', 'ring.jpg', 5, 'con_hang'),
(19, 'Khăn thấm mồ hôi', 20000.00, 'Khăn', 'khan.png', 5, 'con_hang'),
(20, 'parallets', 200000.00, 'Hỗ trợ chống đẩy', 'parallets.jpg', 5, 'con_hang'),
(21, 'Thảm tập yoga', 200000.00, 'Hỗ trợ tập Yoga', 'tham-tap-yoga-8mm-dinh-tuyen-2-lop-pt8927.jpg', 5, 'con_hang'),
(22, 'Combo xà đơn-kép', 500000.00, 'Hỗ trợ kéo xà', 'comboxadonkep.jpg', 5, 'con_hang');

-- --------------------------------------------------------

--
-- Table structure for table `thanh_toan`
--

CREATE TABLE `thanh_toan` (
  `id` int NOT NULL,
  `don_hang_id` int DEFAULT NULL,
  `phuong_thuc` enum('tien_mat','chuyen_khoan') DEFAULT NULL,
  `trang_thai` enum('chua_thanh_toan','da_thanh_toan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ton_kho`
--

CREATE TABLE `ton_kho` (
  `san_pham_id` int NOT NULL,
  `so_luong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vai_tro`
--

CREATE TABLE `vai_tro` (
  `id` int NOT NULL,
  `ten_vai_tro` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vai_tro`
--

INSERT INTO `vai_tro` (`id`, `ten_vai_tro`) VALUES
(1, 'quan_tri_vien'),
(2, 'hoi_vien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`don_hang_id`,`san_pham_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `dang_ky`
--
ALTER TABLE `dang_ky`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`),
  ADD KEY `goi_tap_id` (`goi_tap_id`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`);

--
-- Indexes for table `goi_tap`
--
ALTER TABLE `goi_tap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loai_san_pham`
--
ALTER TABLE `loai_san_pham`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tai_khoan` (`tai_khoan`),
  ADD UNIQUE KEY `sdt` (`sdt`),
  ADD KEY `vai_tro_id` (`vai_tro_id`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loai_san_pham_id` (`loai_san_pham_id`);

--
-- Indexes for table `thanh_toan`
--
ALTER TABLE `thanh_toan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `don_hang_id` (`don_hang_id`);

--
-- Indexes for table `ton_kho`
--
ALTER TABLE `ton_kho`
  ADD PRIMARY KEY (`san_pham_id`);

--
-- Indexes for table `vai_tro`
--
ALTER TABLE `vai_tro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dang_ky`
--
ALTER TABLE `dang_ky`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `goi_tap`
--
ALTER TABLE `goi_tap`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loai_san_pham`
--
ALTER TABLE `loai_san_pham`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `thanh_toan`
--
ALTER TABLE `thanh_toan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vai_tro`
--
ALTER TABLE `vai_tro`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`don_hang_id`) REFERENCES `don_hang` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`id`);

--
-- Constraints for table `dang_ky`
--
ALTER TABLE `dang_ky`
  ADD CONSTRAINT `dang_ky_ibfk_1` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dung` (`id`),
  ADD CONSTRAINT `dang_ky_ibfk_2` FOREIGN KEY (`goi_tap_id`) REFERENCES `goi_tap` (`id`);

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dung` (`id`);

--
-- Constraints for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD CONSTRAINT `nguoi_dung_ibfk_1` FOREIGN KEY (`vai_tro_id`) REFERENCES `vai_tro` (`id`);

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`loai_san_pham_id`) REFERENCES `loai_san_pham` (`id`);

--
-- Constraints for table `thanh_toan`
--
ALTER TABLE `thanh_toan`
  ADD CONSTRAINT `thanh_toan_ibfk_1` FOREIGN KEY (`don_hang_id`) REFERENCES `don_hang` (`id`);

--
-- Constraints for table `ton_kho`
--
ALTER TABLE `ton_kho`
  ADD CONSTRAINT `ton_kho_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
