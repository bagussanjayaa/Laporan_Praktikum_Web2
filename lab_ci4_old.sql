-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2026 at 02:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab_ci4_old`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `slug` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `isi`, `gambar`, `status`, `slug`, `created_at`, `id_kategori`) VALUES
(1, 'Artikel pertama', 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf.', NULL, 0, 'artikel-pertama', '2026-04-03 09:58:05', 1),
(2, 'Artikel kedua', 'Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun.', NULL, 0, 'artikel-kedua', '2026-04-03 09:58:05', 2),
(3, 'Artikel Ketiga', 'Banyak yang bertanya-tanya mengapa kita menggunakan teks ini. Intinya, penggunaan Lorem Ipsum adalah untuk mendistribusikan huruf secara normal, sehingga pembaca tidak teralihkan oleh konten yang terbaca saat melihat tata letak halaman. Ini sangat berguna bagi desainer dalam mempresentasikan konsep visual.', NULL, 0, 'Artikel-Ketiga', '2026-04-03 09:58:05', NULL),
(4, 'Artikel Keempat', 'Ini adalah isi artikel keempat untuk uji coba pagination.', NULL, 0, 'artikel-keempat', '2026-04-09 10:26:46', 1),
(5, 'Artikel Kelima', 'Ini adalah isi artikel kelima untuk uji coba pagination.', NULL, 0, 'artikel-kelima', '2026-04-09 10:26:46', 3),
(6, 'Artikel Keenam', 'Ini adalah isi artikel keenam untuk uji coba pagination.', NULL, 0, 'artikel-keenam', '2026-04-09 10:26:46', 4),
(7, 'Artikel Ketujuh', 'Ini adalah isi artikel ketujuh untuk uji coba pagination.', NULL, 0, 'artikel-ketujuh', '2026-04-09 10:26:46', 2),
(8, 'Artikel Kedelapan', 'Ini adalah isi artikel kedelapan untuk uji coba pagination.', NULL, 0, 'artikel-kedelapan', '2026-04-09 10:26:46', 1),
(9, 'Artikel Kesembilan', 'Ini adalah isi artikel kesembilan untuk uji coba pagination.', NULL, 0, 'artikel-kesembilan', '2026-04-09 10:26:46', 3),
(10, 'Artikel Kesepuluh', 'Ini adalah isi artikel kesepuluh untuk uji coba pagination.', NULL, 0, 'artikel-kesepuluh', '2026-04-09 10:26:46', 4),
(13, 'Artikel API', 'artikel ini dibuat dari postman', NULL, 0, NULL, '2026-06-25 10:55:01', NULL),
(14, 'Z artikel', 'artikel yang dibuat di vue atau vite app', NULL, 0, NULL, '2026-06-25 16:37:12', NULL),
(15, 'Pokoknya Artikel', 'Adalah pokoknya', NULL, 0, NULL, '2026-06-25 16:49:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `slug_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `slug_kategori`) VALUES
(1, 'Teknologi', 'teknologi'),
(2, 'Pendidikan', 'pendidikan'),
(3, 'Kesehatan', 'kesehatan'),
(4, 'Olahraga', 'olahraga');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `useremail` varchar(200) DEFAULT NULL,
  `userpassword` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `useremail`, `userpassword`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$K1VbSQJlDWaSrxkv/DSE0Oy6h4o/H7JNXEd3Rd1F1Yv689pKRv91G');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategori_artikel` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `fk_kategori_artikel` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
