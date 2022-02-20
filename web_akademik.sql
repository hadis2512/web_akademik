-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2022 at 10:47 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_formulir`
--

CREATE TABLE `data_formulir` (
  `id_formulir` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_jenis_permohonan` int(11) NOT NULL,
  `approval` int(11) NOT NULL COMMENT '0= not approval, 1=approval',
  `id_dosen` int(11) NOT NULL,
  `status_permohonan` int(11) NOT NULL COMMENT '1=surat riset, 2=surat kerja praktik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_karyawan_kampus`
--

CREATE TABLE `data_karyawan_kampus` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `nip` char(15) NOT NULL,
  `program_studi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_karyawan_kampus`
--

INSERT INTO `data_karyawan_kampus` (`id`, `id_karyawan`, `nip`, `program_studi`) VALUES
(2, 6, 'H96219041', 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_mahasiswa_kampus`
--

CREATE TABLE `data_mahasiswa_kampus` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nim` char(15) NOT NULL,
  `program_studi` int(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_mahasiswa_kampus`
--

INSERT INTO `data_mahasiswa_kampus` (`id`, `id_mahasiswa`, `nim`, `program_studi`, `created_at`, `updated_at`) VALUES
(8, 28, '2018104030', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `nama` char(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Ilmu Komputer dan Desain', '2022-02-10 08:55:07', '2022-02-10 08:55:07'),
(2, 'Bisnis dan Komunikasi\r\n', '2022-02-10 08:55:07', '2022-02-10 08:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(156) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama`) VALUES
(1, 'Dosen'),
(2, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `jenispermohonan`
--

CREATE TABLE `jenispermohonan` (
  `id` int(11) NOT NULL,
  `nama` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenispermohonan`
--

INSERT INTO `jenispermohonan` (`id`, `nama`) VALUES
(1, 'Surat Pengantar Riset'),
(2, 'Surat Pengantar Kerja Praktik');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `email` varchar(156) NOT NULL,
  `password` varchar(156) NOT NULL,
  `nama_lengkap` varchar(156) NOT NULL,
  `tempat` varchar(156) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` char(10) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `foto` varchar(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `email`, `password`, `nama_lengkap`, `tempat`, `tgl_lahir`, `jenis_kelamin`, `no_telp`, `alamat`, `foto`, `id_jabatan`, `is_active`, `updated_at`, `created_at`) VALUES
(6, 'Jamal@gmail.com', '202cb962ac59075b964b07152d234b70', 'Abdul Jamal Billah', 'Jakarta', '1966-02-10', 'Pria', '1234441', 'jalan kebon bawang 11, RT.004, RW.01 Kebon Bawang, Tanjung Priok 14320', '', 1, 1, '2022-02-20 13:20:00', '2022-02-20 13:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `email` varchar(156) NOT NULL,
  `password` varchar(156) NOT NULL,
  `nama_lengkap` varchar(156) NOT NULL,
  `tempat` varchar(156) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` char(7) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `foto` varchar(156) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `email`, `password`, `nama_lengkap`, `tempat`, `tgl_lahir`, `jenis_kelamin`, `no_telp`, `alamat`, `foto`, `id_jabatan`, `is_active`, `created_at`, `updated_at`) VALUES
(28, '2018104030@student.kalbis.ac.id', 'd41d8cd98f00b204e9800998ecf8427e', 'Muhammad Hadits Alkhafidl', 'Jakarta', '2000-08-23', 'Pria', '1234441', 'asdsad', '', 2, 1, '2022-02-20 17:03:00', '2022-02-20 17:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `nama` char(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'D3', '2022-02-10 08:39:07', '2022-02-10 08:39:07'),
(2, 'S1', '2022-02-10 08:39:07', '2022-02-10 08:39:07'),
(3, 'S2', '2022-02-10 08:39:07', '2022-02-10 08:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `id_program` int(11) NOT NULL,
  `program_studi` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id`, `id_fakultas`, `id_program`, `program_studi`) VALUES
(2, 1, 2, 'Informatika\r\n'),
(3, 1, 2, 'Sistem  Informasi\r\n'),
(4, 2, 1, 'Akuntansi'),
(5, 2, 2, 'Akuntansi');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id` int(11) NOT NULL,
  `username` varchar(156) NOT NULL,
  `password` varchar(156) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', '2022-01-03 10:14:11', '2022-01-03 10:14:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_formulir`
--
ALTER TABLE `data_formulir`
  ADD PRIMARY KEY (`id_formulir`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_jenis_permohonan` (`id_jenis_permohonan`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `data_karyawan_kampus`
--
ALTER TABLE `data_karyawan_kampus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_prodi` (`program_studi`);

--
-- Indexes for table `data_mahasiswa_kampus`
--
ALTER TABLE `data_mahasiswa_kampus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_studi` (`program_studi`),
  ADD KEY `mhs` (`id_mahasiswa`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenispermohonan`
--
ALTER TABLE `jenispermohonan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_program` (`id_program`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_formulir`
--
ALTER TABLE `data_formulir`
  MODIFY `id_formulir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_karyawan_kampus`
--
ALTER TABLE `data_karyawan_kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_mahasiswa_kampus`
--
ALTER TABLE `data_mahasiswa_kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenispermohonan`
--
ALTER TABLE `jenispermohonan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_karyawan_kampus`
--
ALTER TABLE `data_karyawan_kampus`
  ADD CONSTRAINT `id_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`),
  ADD CONSTRAINT `id_prodi_karyawan` FOREIGN KEY (`program_studi`) REFERENCES `program_studi` (`id`);

--
-- Constraints for table `data_mahasiswa_kampus`
--
ALTER TABLE `data_mahasiswa_kampus`
  ADD CONSTRAINT `data_mhs` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `prog_studi` FOREIGN KEY (`program_studi`) REFERENCES `program_studi` (`id`);

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `id_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `id_jabatan1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`);

--
-- Constraints for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD CONSTRAINT `fakultas` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id`),
  ADD CONSTRAINT `program` FOREIGN KEY (`id_program`) REFERENCES `program` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
