-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 09, 2020 at 12:59 PM
-- Server version: 10.3.23-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kesg4851_web_organisasi`
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
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `id_dewan`, `id_pac`, `nama_akun`, `username`, `password`, `id_level`, `dibuat`, `diperbarui`) VALUES
(1, 1, NULL, 'MASTER', 'master', '$2y$10$zIl9WAoV9tGx5jvxGj9TMe09JlI7R5x/ywwETEAiQUpPj9tHmmm4K', 1, '2020-07-08 10:11:03', '2020-07-08 10:11:03');

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
  `id_sub_jabatan` int(3) DEFAULT 1,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
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
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dewan`
--

INSERT INTO `dewan` (`id_dewan`, `nama`, `alamat`, `no_telp`, `dibuat`, `diperbarui`) VALUES
(1, 'Master', 'Indonesia', '081123547896', '2020-07-08 10:06:10', '2020-07-08 10:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(4) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  `slug` varchar(128) NOT NULL,
  `tipe` enum('Gambar','Video','','') NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Tidak Ada');

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
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sub_jabatan`
--

CREATE TABLE `sub_jabatan` (
  `id_sub_jabatan` int(3) NOT NULL,
  `id_jabatan` int(3) DEFAULT NULL,
  `nama_sub_jabatan` varchar(30) NOT NULL,
  `prioritas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_jabatan`
--

INSERT INTO `sub_jabatan` (`id_sub_jabatan`, `id_jabatan`, `nama_sub_jabatan`, `prioritas`) VALUES
(1, 1, 'Tidak Ada', 0);

-- --------------------------------------------------------

--
-- Table structure for table `web_profile`
--

CREATE TABLE `web_profile` (
  `id_profile` int(1) NOT NULL,
  `judul` varchar(50) DEFAULT NULL COMMENT 'home',
  `logo` text DEFAULT NULL COMMENT 'home',
  `subtitle` varchar(100) DEFAULT NULL COMMENT 'home',
  `ket` text DEFAULT NULL COMMENT 'home',
  `isi` text DEFAULT NULL COMMENT 'home',
  `kontak` text NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `diperbarui` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_profile`
--

INSERT INTO `web_profile` (`id_profile`, `judul`, `logo`, `subtitle`, `ket`, `isi`, `kontak`, `dibuat`, `diperbarui`) VALUES
(1, 'Web Organisasi', NULL, 'WEB Organisasi', 'ini keterangaannnnnnn', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam placerat aliquam diam, sit amet fringilla nibh mollis vitae. Suspendisse a erat enim. Etiam mattis libero ut viverra molestie. Vestibulum eros magna, vestibulum sit amet sollicitudin quis, sagittis id nibh. Vestibulum molestie vulputate augue, quis consectetur risus luctus ac. In id venenatis nisl. Etiam sed mi ac risus sagittis ornare. Cras nec laoreet augue. Integer porttitor lectus sapien, vitae auctor ipsum interdum varius. Integer sit amet dictum tortor. Pellentesque ut tincidunt dolor. Duis commodo mattis lacus, ac tempus ex suscipit a. Duis mauris ligula, consequat a aliquet sed, rutrum vitae justo. Nulla vel metus ut lacus laoreet elementum. Mauris vitae pretium tortor, eget maximus libero. Donec a euismod lacus. Nunc fringilla quam non suscipit aliquam. Morbi non justo neque. Vestibulum condimentum mauris vitae turpis malesuada, sed maximus tellus rutrum. Ut et ullamcorper sem. Maecenas odio quam, maximus non porttitor id, consequat ut nulla. Curabitur vitae feugiat ex. Nam pulvinar vehicula molestie. Duis posuere vel sem at efficitur. Nam viverra quam felis, et tincidunt turpis rhoncus sed. Pellentesque feugiat diam odio, eget luctus ex pulvinar vel. Etiam cursus libero nisl, ut ullamcorper elit feugiat a. Cras pellentesque lectus nulla, id aliquam mi scelerisque aliquam. Nulla nibh mi, bibendum sit amet sem dapibus, sollicitudin blandit eros. Quisque vel pellentesque lacus, id aliquam odio. Morbi nec laoreet justo. Fusce feugiat quam ac magna feugiat semper. Mauris maximus fringilla dui, ut tristique leo efficitur id. Nunc id sapien malesuada lectus viverra pretium. Proin in massa et quam pretium volutpat vel ac neque. Integer et lectus sed ipsum dapibus varius. Nulla facilisi. Vivamus quis enim auctor, sodales mi sed, aliquam diam. Integer aliquam consectetur maximus. Sed in leo justo. Aliquam a felis purus. Proin tincidunt risus sed metus finibus ultrices et sed dui. Phasellus vulputate magna ut tellus bibendum, laoreet euismod eros bibendum. Cras ut libero vel neque ornare facilisis. Sed ornare convallis tortor, in mollis turpis lobortis in. Nunc mattis tristique risus vitae sodales. Phasellus rutrum, ex sit amet pretium porttitor, magna libero porttitor ante, id porta nunc ante vitae arcu.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget quam nec ligula sollicitudin mattis at eu neque. Vestibulum et lorem leo. In ut porttitor nulla. Aliquam ullamcorper euismod quam, fermentum malesuada sapien molestie nec. Nulla fringilla facilisis sem, eu molestie neque viverra eu. Nunc fringilla, enim a pulvinar porttitor, arcu enim faucibus nulla, id consequat ante ligula eget erat. Quisque ullamcorper maximus iaculis. Donec turpis felis, maximus nec tellus ultrices, sagittis maximus metus. Vestibulum aliquet ultricies justo in sodales. Pellentesque eu posuere quam, non condimentum neque.</p>', '2020-07-05 19:05:33', '2020-07-08 06:53:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `id_dewan` (`id_dewan`),
  ADD KEY `id_pac` (`id_pac`),
  ADD KEY `id_level` (`id_level`);

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
  MODIFY `id_akun` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dewan`
--
ALTER TABLE `dewan`
  MODIFY `id_dewan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pac`
--
ALTER TABLE `pac`
  MODIFY `id_pac` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_jabatan`
--
ALTER TABLE `sub_jabatan`
  MODIFY `id_sub_jabatan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_profile`
--
ALTER TABLE `web_profile`
  MODIFY `id_profile` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`id_dewan`) REFERENCES `dewan` (`id_dewan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akun_ibfk_2` FOREIGN KEY (`id_pac`) REFERENCES `pac` (`id_pac`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akun_ibfk_3` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_jabatan_ibfk_1` FOREIGN KEY (`id_sub_jabatan`) REFERENCES `sub_jabatan` (`id_sub_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pac`
--
ALTER TABLE `pac`
  ADD CONSTRAINT `pac_ibfk_1` FOREIGN KEY (`id_dewan`) REFERENCES `dewan` (`id_dewan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_jabatan`
--
ALTER TABLE `sub_jabatan`
  ADD CONSTRAINT `id_jabatan_constraint` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
