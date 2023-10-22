-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2021 at 08:46 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata_garut`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$3w/VJWI3zEkSaHlmMf0/wuuQoKH4EdpWPK8JwNe0d05CVTa.CKTCS');

-- --------------------------------------------------------

--
-- Table structure for table `destinasi_wisata`
--

CREATE TABLE `destinasi_wisata` (
  `id` int(11) NOT NULL,
  `namaTempat` varchar(100) NOT NULL,
  `detailSingkat` text NOT NULL,
  `gambarTempat` varchar(255) NOT NULL,
  `tombolTeks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `destinasi_wisata`
--

INSERT INTO `destinasi_wisata` (`id`, `namaTempat`, `detailSingkat`, `gambarTempat`, `tombolTeks`) VALUES
(29, 'Pantai Santolo', 'Pantai ini cukup dikenal di kota Bandung dan\r\nmerupakan daerah tujuan wisata, Kawasan Pantai\r\nSantolo merupakan tempat berkumpulnya nelayan\r\ntradisional yang akan dikembangkan menjadi daerah tujuan wisata yang indah', '601014e909850.png', 'Detail Pantai'),
(30, 'Gunung Papandayan', 'Gunung dengan ketinggian 2665 meter di atas\r\npermukaan laut yang terletak sekitar 70 km\r\nsebelah tenggara Kota Bandung, Pada Gunung\r\nPapandayan, terdapat beberapa kawah\r\nyang terkenal', '6010153978a91.png', 'Detail Gunung'),
(31, 'Darajat Pass', 'Obyek wisata yang menawarkan panorama indah\r\npegunungan serta wahana water park dan outbond\r\ndengan harga tiket masuk cukup terjangkau', '6010156cb9c17.png', 'Detail Tempat');

-- --------------------------------------------------------

--
-- Table structure for table `detail_website`
--

CREATE TABLE `detail_website` (
  `id` int(11) NOT NULL,
  `nama_web` varchar(50) NOT NULL,
  `hero` varchar(100) NOT NULL,
  `detail_web` varchar(100) NOT NULL,
  `header1` varchar(100) NOT NULL,
  `header2` varchar(100) NOT NULL,
  `header1_2` varchar(100) NOT NULL,
  `map` text NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `whatsapp` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `footer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_website`
--

INSERT INTO `detail_website` (`id`, `nama_web`, `hero`, `detail_web`, `header1`, `header2`, `header1_2`, `map`, `instagram`, `whatsapp`, `facebook`, `footer`) VALUES
(1, 'WISATA GARUT', '600ea06fac5b3.png', 'Rasakan Kebebasan yang Luar Biasa dengan Pergi ke Sini!\r\nTempat Spesial Untukmu dan Orang Terdekatmu', 'Mengapa Garut', 'Berikut beberapa tempat wisata populer di Garut yang cocok untukmu!', 'LOKASI', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.049926612468!2d107.89916231469749!3d-7.217374372869112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b04db89d03d5%3A0xfcc335155917764c!2sGedung%20Pendopo%20Kabupaten%20Garut!5e1!3m2!1sid!2sid!4v1611762186627!5m2!1sid!2sid\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>', 'https://www.instagram.com/ruchbiahadian/', 'https://wa.me/082321283813', 'https://web.facebook.com/ruchbia/', '© 2021 WISATA GARUT • All rights reserved • Muhammad Ruchbi Ahadian');

-- --------------------------------------------------------

--
-- Table structure for table `detail_wisata`
--

CREATE TABLE `detail_wisata` (
  `id` int(11) NOT NULL,
  `id_destinasi_wisata` int(11) NOT NULL,
  `header1` varchar(100) NOT NULL,
  `header2` varchar(100) NOT NULL,
  `header3` varchar(100) NOT NULL,
  `map` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_wisata`
--

INSERT INTO `detail_wisata` (`id`, `id_destinasi_wisata`, `header1`, `header2`, `header3`, `map`) VALUES
(14, 31, 'Mengapa Darajat Pass', 'Berikut beberapa alasan kuat kenapa Darajat Pass menjadi destinasi wisata\r\nyang cocok untukmu!', 'Lokasi', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.047008482315!2d107.74308451469756!3d-7.217720072872951!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68a5b004ceabfb%3A0x3814becc0fa05bd0!2sDarajat%20Pass!5e1!3m2!1sid!2sid!4v1611762395915!5m2!1sid!2sid\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
(15, 30, 'Mengapa Gunung Papandayan', 'Berikut beberapa alasan kuat kenapa Gunung ini menjadi destinasi wisata\r\nyang cocok untukmu!', 'Lokasi', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15272.733982063664!2d107.72229462582587!3d-7.3193037825490705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68a3d92fef0d13%3A0x32fef13d99e37776!2sGn.%20Papandayan!5e1!3m2!1sid!2sid!4v1611762359396!5m2!1sid!2sid\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
(16, 29, 'Mengapa Santolo', 'Berikut beberapa alasan kuat kenapa Pantai ini menjadi destinasi wisata\r\nyang cocok untukmu!', 'Lokasi', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15261.117040701232!2d107.67733057587853!3d-7.651121444995596!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6616140366a15d%3A0xb2758ff514ffcd!2sPantai%20Santolo!5e1!3m2!1sid!2sid!4v1611762296119!5m2!1sid!2sid\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `detail_wisata_harga`
--

CREATE TABLE `detail_wisata_harga` (
  `id` int(11) NOT NULL,
  `id_destinasi_wisata` int(11) NOT NULL,
  `dewasa` int(11) NOT NULL,
  `anak` int(11) NOT NULL,
  `dewasa_weekend` int(11) NOT NULL,
  `anak_weekend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_wisata_post`
--

CREATE TABLE `detail_wisata_post` (
  `id` int(11) NOT NULL,
  `id_detail_wisata` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `gambarTitle` varchar(100) NOT NULL,
  `gambarDetail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_wisata_post`
--

INSERT INTO `detail_wisata_post` (`id`, `id_detail_wisata`, `gambar`, `gambarTitle`, `gambarDetail`) VALUES
(22, 29, '601015e57c17b.png', 'Rasakan Kebebasan', 'Rasakan kebebasan yang sangat mantap dengan\r\nberjalan-jalan di pinggir pantai sembari melepas\r\nbeban pikiran untuk sementara, menyegarkan otak\r\nyang sudah lelah berfikir sepanjang waktu sembari\r\nmemanjakan jiwa dan raga dengan udara segar'),
(23, 29, '6010166bed1b5.png', 'Bersenang-Senang', 'Tempatnya bersenang-senang di pinggir pantai\r\ndengan orang terdekat, menikmati setiap detik\r\nyang berharga dengan mereka tanpa perlu\r\nmerogoh kocek yang banyak. Hiduplah di\r\nmomen ini!'),
(24, 29, '601016a0a0158.png', 'Rasakan Kelezatan yang Mantap', 'Nikmati berbagai macam seafood segar dengan\r\nrasa bintang lima harga kaki lima. Cobalah sensasi\r\nmakan di pinggir pantai sembari menikmati\r\npemandangan yang indah dan angin sepoi-sepoi\r\nyang sangat memantapkan jiwa dan raga'),
(25, 30, '601016df99ddd.png', 'Berenang di Alam Bebas', 'Rasakan kebebasan yang sangat mantap dengan\r\nberenang di alam terbuka sembari melepas\r\nbeban pikiran untuk sementara, menyegarkan otak\r\nyang sudah lelah berfikir sepanjang waktu sembari\r\nmemanjakan jiwa dan raga dengan udara segar'),
(26, 30, '601017053d883.png', 'Nikmati indahnya Alam', 'Cara mudah menikmati indahnya Indonesia\r\ndengan upaya seminimal mungkin\r\ndan hasil semaksimal mungkin yang\r\nkami tawarkan'),
(27, 30, '6010172671799.png', 'Rasakan Kebebasan yang Mantap', 'Dunia itu luas, ayo menjelajah tanpa\r\ntakut, menerjang apapun yang terjadi\r\nbersama-sama kita pasti bisa'),
(28, 31, '601017836ec6f.png', 'Wahana Hiburan', 'Rasakan kebebasan yang sangat mantap dengan\r\nbermain di air hangat yang segar sembari melepas\r\nbeban pikiran untuk sementara, menyegarkan otak\r\nyang sudah lelah berfikir sepanjang waktu sembari\r\nmemanjakan jiwa dan raga dengan udara segar'),
(29, 31, '601017acd662d.png', 'Bersenang-Senang', 'Tempatnya bersenang-senang serasa di pantai\r\ndengan orang terdekat, menikmati setiap detik\r\nyang berharga dengan mereka tanpa perlu\r\nmerogoh kocek yang banyak. Hiduplah di\r\nmomen ini!'),
(30, 31, '601017d5b9e1f.png', 'Keindahan Alam yang Tiada Duanya', 'Nikmati berbagai macam makanan segar dengan\r\nrasa bintang lima harga kaki lima. Cobalah sensasi\r\nmakan di atas gunung sembari menikmati\r\npemandangan yang indah dan angin sepoi-sepoi\r\nyang sangat memantapkan jiwa dan raga');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinasi_wisata`
--
ALTER TABLE `destinasi_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_website`
--
ALTER TABLE `detail_website`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_wisata`
--
ALTER TABLE `detail_wisata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_destinasi_wisata` (`id_destinasi_wisata`);

--
-- Indexes for table `detail_wisata_harga`
--
ALTER TABLE `detail_wisata_harga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_destinasi_wisata` (`id_destinasi_wisata`);

--
-- Indexes for table `detail_wisata_post`
--
ALTER TABLE `detail_wisata_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_detail_wisata` (`id_detail_wisata`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `destinasi_wisata`
--
ALTER TABLE `destinasi_wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `detail_website`
--
ALTER TABLE `detail_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_wisata`
--
ALTER TABLE `detail_wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `detail_wisata_harga`
--
ALTER TABLE `detail_wisata_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `detail_wisata_post`
--
ALTER TABLE `detail_wisata_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_wisata`
--
ALTER TABLE `detail_wisata`
  ADD CONSTRAINT `detail_wisata_ibfk_1` FOREIGN KEY (`id_destinasi_wisata`) REFERENCES `destinasi_wisata` (`id`);

--
-- Constraints for table `detail_wisata_harga`
--
ALTER TABLE `detail_wisata_harga`
  ADD CONSTRAINT `detail_wisata_harga_ibfk_1` FOREIGN KEY (`id_destinasi_wisata`) REFERENCES `destinasi_wisata` (`id`);

--
-- Constraints for table `detail_wisata_post`
--
ALTER TABLE `detail_wisata_post`
  ADD CONSTRAINT `detail_wisata_post_ibfk_1` FOREIGN KEY (`id_detail_wisata`) REFERENCES `detail_wisata` (`id_destinasi_wisata`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
