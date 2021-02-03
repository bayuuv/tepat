-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2020 at 06:50 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_organisasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(5) NOT NULL,
  `id_dewan` int(5) DEFAULT NULL,
  `id_pac` int(5) DEFAULT NULL,
  `nama_akun` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `id_level` int(2) NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `id_dewan`, `id_pac`, `nama_akun`, `username`, `password`, `id_level`, `dibuat`, `diperbarui`) VALUES
(1, 1, NULL, 'MASTER', 'master', '$2y$10$zIl9WAoV9tGx5jvxGj9TMe09JlI7R5x/ywwETEAiQUpPj9tHmmm4K', 1, '2020-07-04 13:50:38', '2020-07-04 13:50:38'),
(2, 2, NULL, 'ADMIN/DPP', 'admin', '$2y$10$7/TYKYzcb1dGWJaJDvfoe.VqM65lbWW9oxMAbJppi/eh5jnqXGici', 2, '2020-07-04 14:07:07', '2020-07-04 14:07:07'),
(3, 3, NULL, 'Golkar DPC', 'golkardpc', '$2y$10$n1SKHw09207/IrWqZqNOTe.o/gG2vdBMLRlUdvtagPGbXo.wGBs3u', 3, '2020-07-04 14:08:19', '2020-07-04 14:08:19'),
(4, NULL, 1, 'Golkar PAC', 'golkarpacbws', '$2y$10$Y9cz7HAnV786svxPLp7Fe.zFxsI4e5ORfO4P2dLmaufyFSkVGNBP.', 4, '2020-07-04 14:09:49', '2020-07-04 14:09:49'),
(5, 4, NULL, 'Demokrat DPC', 'demokratdpc', '$2y$10$t00nn6KchlOj5wDFKwxNR.bxMsknXUy0RXzWJPDVVcd/s.c..3jHO', 3, '2020-07-04 16:52:26', '2020-07-04 16:52:26'),
(6, 5, NULL, 'PAN DPP', 'pandpp', '$2y$10$k2yMA3xIJlT0/i6qg0m11OeQefYs1VBY5SAsg8edSJXLG5yGGFkmq', 2, '2020-07-05 06:02:27', '2020-07-05 06:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `no_anggota` varchar(5) NOT NULL,
  `id_akun` int(5) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `id_sub_jabatan` int(3) DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`no_anggota`, `id_akun`, `nik`, `nama_anggota`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `no_telp`, `foto`, `ktp`, `id_sub_jabatan`, `is_active`, `dibuat`, `diperbarui`) VALUES
('00004', 3, '1050241708900001', 'Marceline Dwi Normalita', 'Bondowoso', 'Bondowoso', '2000-03-12', 'P', '081556987445', '00004FC_Barcelona.png', '00004f884395c-f006-4bd2-aa8e-91e7b9573035.jpg', 1, 1, '2020-07-04 16:59:30', '2020-07-04 16:59:30'),
('00005', 3, '1050241708900001', 'Muhammad Khalil Zhillullah', 'Bondowoso', 'Bondowoso', '2000-12-26', 'L', '085331053300', '00005FC_Barcelona.png', '00005f884395c-f006-4bd2-aa8e-91e7b9573035.jpg', 4, 1, '2020-07-04 18:36:21', '2020-07-07 00:41:30'),
('00006', 4, '1050241708900001', 'Rifjan Jundilla', 'Bondowoso', 'Bondowoso', '2000-02-21', 'L', '081445223665', '000063.png', '00006Capture.PNG', 1, 1, '2020-07-04 18:37:03', '2020-07-04 18:37:03'),
('00007', 4, '1050241708900001', 'Amelia Kamila', 'Bondowoso', 'Bondowoso', '2006-09-16', 'P', '081336558994', '00007FC_Barcelona.png', '00007Capture.PNG', 1, 0, '2020-07-05 06:00:18', '2020-07-05 06:00:18'),
('00008', 6, '1050241708900001', 'Budi utomo', 'Bondowoso', 'Bondowoso', '1998-07-05', 'L', '085669774125', '00008FC_Barcelona.png', '00008Capture.PNG', 17, 0, '2020-07-05 06:03:19', '2020-07-07 00:29:44'),
('00009', 2, '1050241708900001', 'Joni Bolsom', 'Bondowoso', 'Bondowoso', '1997-04-14', 'L', '085333648015', '00009FC_Barcelona.png', '00009f884395c-f006-4bd2-aa8e-91e7b9573035.jpg', 5, 0, '2020-07-05 06:27:25', '2020-07-05 06:28:46'),
('00010', 4, '1050241708900001', 'Ahmad Salah', 'Jakarta', 'Jakarta', '1997-05-04', 'L', '085336552114', '000103.png', '00010Capture.PNG', 12, 0, '2020-07-05 18:17:56', '2020-07-05 11:18:15'),
('00011', 3, '1050241708900001', 'Ridwan Kamil', 'Bandung', 'Bandung', '1999-08-04', 'L', '085669887441', '000111.png', '00011Capture.PNG', 1, 0, '2020-07-05 18:24:42', '2020-07-05 18:24:42'),
('00012', 3, '1050241708900001', 'PAN Bondowoso DPP', 'Bondowoso', 'Bondowoso', '1995-02-14', 'L', '085336665284', '000121.png', '00012Capture.PNG', 1, 0, '2020-07-07 07:26:09', '2020-07-07 00:27:09'),
('00013', 3, '1050241708900001', 'Rendi  Jaya Golkar', 'Jember', 'Bandung', '1994-08-05', 'L', '085331046552', '00013Capture.PNG', '000131.png', 1, 0, '2020-07-07 16:01:49', '2020-07-07 09:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(4) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `konten` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dewan`
--

CREATE TABLE `dewan` (
  `id_dewan` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dewan`
--

INSERT INTO `dewan` (`id_dewan`, `nama`, `alamat`, `no_telp`, `dibuat`, `diperbarui`) VALUES
(1, 'Master', 'Indonesia', '085331053300', '2020-07-04 13:50:15', '2020-07-04 13:50:15'),
(2, 'ADMIN', 'Bondowoso', '081442556335', '2020-07-04 14:07:07', '2020-07-04 14:07:07'),
(3, 'Golkar DPC', 'Bondowoso', '081445221447', '2020-07-04 14:08:19', '2020-07-04 14:08:19'),
(4, 'Demokrat DPC', 'Bondowoso', '087445663221', '2020-07-04 16:52:26', '2020-07-04 16:52:26'),
(5, 'PAN DPP', 'Bondowoso', '081447885963', '2020-07-05 06:02:27', '2020-07-05 06:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(4) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `gambar` text,
  `video` text,
  `slug` varchar(128) NOT NULL,
  `tipe` enum('Gambar','Video','','') NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `judul`, `cover`, `gambar`, `video`, `slug`, `tipe`, `dibuat`, `diperbarui`) VALUES
(1, 'Web Politik', NULL, NULL, 'https://www.youtube.com/embed/4vOUuQcaIl4', 'web-politik', 'Video', '2020-07-07 02:01:35', '2020-07-07 02:01:35'),
(4, 'Tes Gambar', 'f884395c-f006-4bd2-aa8e-91e7b9573035.jpg', '<p><img src=\"http://localhost/web-organisasi/assets/uploaded_files/galeri/files/FC_Barcelona(3).png\" style=\"height:1217px; width:1200px\" /><img src=\"http://localhost/web-organisasi/assets/uploaded_files/galeri/files/banner(3).jpg\" style=\"height:1080px; width:1920px\" /></p>', NULL, 'tes-gambar', 'Gambar', '2020-07-07 06:49:14', '2020-07-07 06:49:14'),
(5, 'Tes Gambar2', 'FC_Barcelona.png', '<p><img src=\"http://localhost/web-organisasi/assets/uploaded_files/galeri/files/3(4).png\" style=\"height:1080px; width:1920px\" /></p>\r\n\r\n<p><img src=\"http://localhost/web-organisasi/assets/uploaded_files/galeri/files/4(3).png\" style=\"height:1080px; width:1920px\" /></p>\r\n\r\n<p>&nbsp;</p>', NULL, 'tes-gambar2', 'Gambar', '2020-07-07 12:35:45', '2020-07-07 12:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(3) NOT NULL,
  `jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'Tidak Ada'),
(2, 'Divisi Humas'),
(3, 'Divisi IT'),
(4, 'Divisi Kesehatan'),
(5, 'Divisi Anyar'),
(6, 'Divisi Baru');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(2) NOT NULL,
  `level` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `level`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'DPC'),
(4, 'PAC');

-- --------------------------------------------------------

--
-- Table structure for table `pac`
--

CREATE TABLE `pac` (
  `id_pac` int(5) NOT NULL,
  `id_dewan` int(5) NOT NULL,
  `nama_pac` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pac`
--

INSERT INTO `pac` (`id_pac`, `id_dewan`, `nama_pac`, `alamat`, `no_telp`, `dibuat`, `diperbarui`) VALUES
(1, 3, 'Golkar PAC', 'Bondowoso', '081445778996', '2020-07-04 14:09:49', '2020-07-04 14:09:49');

-- --------------------------------------------------------

--
-- Table structure for table `sub_jabatan`
--

CREATE TABLE `sub_jabatan` (
  `id_sub_jabatan` int(3) NOT NULL,
  `id_jabatan` int(3) DEFAULT NULL,
  `nama_sub_jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_jabatan`
--

INSERT INTO `sub_jabatan` (`id_sub_jabatan`, `id_jabatan`, `nama_sub_jabatan`) VALUES
(1, 1, 'Tidak Ada'),
(4, 1, 'Ketua Umum'),
(5, 1, 'Ketua Harian'),
(6, 1, 'Bendahara'),
(7, 2, 'Ketua'),
(8, 2, 'Anggota'),
(9, 3, 'Ketua'),
(10, 3, 'Anggota'),
(11, 4, 'Ketua'),
(12, 4, 'Anggota'),
(13, 5, 'Ketua'),
(14, 5, 'Wakil'),
(15, 5, 'Bendahara'),
(16, 5, 'Satgas'),
(17, 6, 'Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `web_profile`
--

CREATE TABLE `web_profile` (
  `id_profile` int(1) NOT NULL,
  `judul` varchar(50) DEFAULT NULL COMMENT 'home',
  `logo` text COMMENT 'home',
  `subtitle` varchar(100) DEFAULT NULL COMMENT 'home',
  `ket` text COMMENT 'home',
  `isi` text COMMENT 'home',
  `alamat` text,
  `kontak` varchar(80) NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_profile`
--

INSERT INTO `web_profile` (`id_profile`, `judul`, `logo`, `subtitle`, `ket`, `isi`, `alamat`, `kontak`, `dibuat`, `diperbarui`) VALUES
(1, 'Web Politik', 'FC_Barcelona.png', 'Organisasi politik', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...dasbmndasbkjdas,nj', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam placerat aliquam diam, sit amet fringilla nibh mollis vitae. Suspendisse a erat enim. Etiam mattis libero ut viverra molestie. Vestibulum eros magna, vestibulum sit amet sollicitudin quis, sagittis id nibh. Vestibulum molestie vulputate augue, quis consectetur risus luctus ac. In id venenatis nisl. Etiam sed mi ac risus sagittis ornare. Cras nec laoreet augue. Integer porttitor lectus sapien, vitae auctor ipsum interdum varius. Integer sit amet dictum tortor. Pellentesque ut tincidunt dolor. Duis commodo mattis lacus, ac tempus ex suscipit a. Duis mauris ligula, consequat a aliquet sed, rutrum vitae justo. Nulla vel metus ut lacus laoreet elementum. Mauris vitae pretium tortor, eget maximus libero. Donec a euismod lacus. Nunc fringilla quam non suscipit aliquam. Morbi non justo neque. Vestibulum condimentum mauris vitae turpis malesuada, sed maximus tellus rutrum. Ut et ullamcorper sem. Maecenas odio quam, maximus non porttitor id, consequat ut nulla. Curabitur vitae feugiat ex. Nam pulvinar vehicula molestie. Duis posuere vel sem at efficitur. Nam viverra quam felis, et tincidunt turpis rhoncus sed. Pellentesque feugiat diam odio, eget luctus ex pulvinar vel. Etiam cursus libero nisl, ut ullamcorper elit feugiat a. Cras pellentesque lectus nulla, id aliquam mi scelerisque aliquam. Nulla nibh mi, bibendum sit amet sem dapibus, sollicitudin blandit eros. Quisque vel pellentesque lacus, id aliquam odio. Morbi nec laoreet justo. Fusce feugiat quam ac magna feugiat semper. Mauris maximus fringilla dui, ut tristique leo efficitur id. Nunc id sapien malesuada lectus viverra pretium. Proin in massa et quam pretium volutpat vel ac neque. Integer et lectus sed ipsum dapibus varius. Nulla facilisi. Vivamus quis enim auctor, sodales mi sed, aliquam diam. Integer aliquam consectetur maximus. Sed in leo justo. Aliquam a felis purus. Proin tincidunt risus sed metus finibus ultrices et sed dui. Phasellus vulputate magna ut tellus bibendum, laoreet euismod eros bibendum. Cras ut libero vel neque ornare facilisis. Sed ornare convallis tortor, in mollis turpis lobortis in. Nunc mattis tristique risus vitae sodales. Phasellus rutrum, ex sit amet pretium porttitor, magna libero porttitor ante, id porta nunc ante vitae arcu.</p>', 'Bali', '+62 85331053300', '2020-07-05 19:05:33', '2020-07-05 12:09:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `id_dewan` (`id_dewan`),
  ADD KEY `id_pac` (`id_pac`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`no_anggota`),
  ADD KEY `id_sub_jabatan` (`id_sub_jabatan`),
  ADD KEY `id_akun` (`id_akun`) USING BTREE;

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `dewan`
--
ALTER TABLE `dewan`
  ADD PRIMARY KEY (`id_dewan`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `pac`
--
ALTER TABLE `pac`
  ADD PRIMARY KEY (`id_pac`),
  ADD KEY `id_dpc` (`id_dewan`);

--
-- Indexes for table `sub_jabatan`
--
ALTER TABLE `sub_jabatan`
  ADD PRIMARY KEY (`id_sub_jabatan`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `web_profile`
--
ALTER TABLE `web_profile`
  ADD PRIMARY KEY (`id_profile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dewan`
--
ALTER TABLE `dewan`
  MODIFY `id_dewan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pac`
--
ALTER TABLE `pac`
  MODIFY `id_pac` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_jabatan`
--
ALTER TABLE `sub_jabatan`
  MODIFY `id_sub_jabatan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `web_profile`
--
ALTER TABLE `web_profile`
  MODIFY `id_profile` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_jabatan_ibfk_1` FOREIGN KEY (`id_sub_jabatan`) REFERENCES `sub_jabatan` (`id_sub_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_jabatan`
--
ALTER TABLE `sub_jabatan`
  ADD CONSTRAINT `id_jabatan_constraint` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
