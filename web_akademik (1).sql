-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2022 at 11:41 PM
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
  `no_form` varchar(100) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_jenis_permohonan` int(11) NOT NULL,
  `approval_admin` int(11) NOT NULL DEFAULT 0 COMMENT '0=admin not validate,1=admin validate,2=duplicate\r\n',
  `status_surat` int(11) NOT NULL COMMENT '0=not create,1=create surat',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_formulir`
--

INSERT INTO `data_formulir` (`id_formulir`, `no_form`, `id_mahasiswa`, `id_jenis_permohonan`, `approval_admin`, `status_surat`, `updated_at`, `created_at`) VALUES
(24, 'FR-KALBIS-OPR-44519/V1/R0', 29, 1, 1, 1, '2022-06-11 01:17:07', '2022-06-10 20:17:07'),
(25, 'FR-KALBIS-OPR-45195/V1/R0', 29, 2, 1, 1, '2022-06-11 02:29:32', '2022-06-10 21:29:32'),
(26, 'FR-KALBIS-OPR-63046/V1/R0', 29, 1, 2, 0, '2022-06-14 16:33:21', '2022-06-14 11:33:21'),
(30, 'FR-KALBIS-OPR-97790/V1/R0', 29, 1, 1, 0, '2022-06-14 21:30:05', '2022-06-14 16:30:05'),
(31, 'FR-KALBIS-OPR-25634/V1/R0', 29, 1, 0, 0, '2022-06-16 02:20:23', '2022-06-15 21:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `data_karyawan_kampus`
--
-- Error reading structure for table web_akademik.data_karyawan_kampus: #1932 - Table 'web_akademik.data_karyawan_kampus' doesn't exist in engine
-- Error reading data for table web_akademik.data_karyawan_kampus: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `web_akademik`.`data_karyawan_kampus`' at line 1

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
(9, 29, '2018104030', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 30, '2018104031', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 33, '2018104032', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `data_surat`
--

CREATE TABLE `data_surat` (
  `id_surat` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `id_formulir` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_file` varchar(200) NOT NULL,
  `file_pdf` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_surat`
--

INSERT INTO `data_surat` (`id_surat`, `no_surat`, `id_formulir`, `id_admin`, `nama_file`, `file_pdf`, `created_at`) VALUES
(70, '001/AO-SRT/IV/2022', 24, 1, '001-AO-SRT-IV-2022_surat_pengantar_riset_Muhammad Hadits Alkhafidl.pdf', '/assets/data/001-AO-SRT-IV-2022_surat_pengantar_riset_Muhammad Hadits Alkhafidl.pdf', '2022-06-10 00:00:00'),
(72, '001/AO-SRT/VI/2022', 25, 1, '001-AO-SRT-VI-2022_surat_magang_Muhammad Hadits Alkhafidl.pdf', '/assets/data/001-AO-SRT-VI-2022_surat_magang_Muhammad Hadits Alkhafidl.pdf', '2022-06-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `data_surat_kp`
--

CREATE TABLE `data_surat_kp` (
  `id_surat_kp` int(11) NOT NULL,
  `id_formulir` int(11) NOT NULL,
  `alamat_surat` text NOT NULL,
  `nama_perusahaan` varchar(156) NOT NULL,
  `perwakilan_perusahaan` varchar(156) NOT NULL,
  `jabatan` char(50) NOT NULL,
  `telp_perusahaan` char(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_surat_kp`
--

INSERT INTO `data_surat_kp` (`id_surat_kp`, `id_formulir`, `alamat_surat`, `nama_perusahaan`, `perwakilan_perusahaan`, `jabatan`, `telp_perusahaan`) VALUES
(7, 25, 'warakas 7', 'PT.ABC', 'Marsel', 'Human Resource', '09888732817');

-- --------------------------------------------------------

--
-- Table structure for table `data_surat_pengantar_riset`
--

CREATE TABLE `data_surat_pengantar_riset` (
  `id_pengantar_riset` int(11) NOT NULL,
  `id_formulir` int(11) NOT NULL,
  `jenis_tugas` varchar(50) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `alamat_surat` text NOT NULL,
  `nama_perusahaan` varchar(156) NOT NULL,
  `perwakilan_perusahaan` varchar(156) NOT NULL,
  `jabatan` char(60) NOT NULL,
  `telp_perusahaan` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_surat_pengantar_riset`
--

INSERT INTO `data_surat_pengantar_riset` (`id_pengantar_riset`, `id_formulir`, `jenis_tugas`, `judul`, `alamat_surat`, `nama_perusahaan`, `perwakilan_perusahaan`, `jabatan`, `telp_perusahaan`) VALUES
(12, 24, 'tugas akhir', 'bla bala bla', 'sakaraw', 'jarang untung', 'jamal', 'rektor', '082125961874'),
(13, 26, '', '', '', '', '', '', ''),
(17, 30, 'tugas akhir', 'Test', 'asd', 'asd', 'asd', 'asd', '123123'),
(18, 31, 'tugas kuliah', 'Perbandingan Metode Pengembangan Aplikasi Pada Perusahaan A', 'Jalan Kebon Asih', 'PT. A', 'Ramli Suseno', 'Human Resource', '0988832912318');

-- --------------------------------------------------------

--
-- Table structure for table `data_ttd`
--

CREATE TABLE `data_ttd` (
  `id_ttd` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jabatan` char(30) NOT NULL,
  `tanda_tangan` varchar(250) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_ttd`
--

INSERT INTO `data_ttd` (`id_ttd`, `nama`, `jabatan`, `tanda_tangan`, `updated_at`, `created_at`) VALUES
(2, 'Muhammad Hadits Alkhafidl', 'Head of Student Academic', '/assets/data/ttd/ttd.png', '2022-06-05 20:39:00', '2022-04-26 17:42:00');

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
-- Error reading structure for table web_akademik.karyawan: #1932 - Table 'web_akademik.karyawan' doesn't exist in engine
-- Error reading data for table web_akademik.karyawan: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `web_akademik`.`karyawan`' at line 1

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
  `jabatan` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `email`, `password`, `nama_lengkap`, `tempat`, `tgl_lahir`, `jenis_kelamin`, `no_telp`, `alamat`, `foto`, `jabatan`, `created_at`, `updated_at`) VALUES
(29, '2018104030@student.kalbis.ac.id', '7815696ecbf1c96e6894b779456d330e', 'Muhammad Hadits Alkhafidl', 'Jakarta', '2000-02-03', 'Pria', '1234441', 'Jalan Kebon Bawang XI No 38', '/assets/data/mahasiswa/foto_profilM/2018104030_04-41-24.jpg', 'Mahasiswa', '2022-02-23 18:03:00', '2022-05-17 05:25:54'),
(30, '2018104031@student.kalbis.ac.id', '202cb962ac59075b964b07152d234b70', 'Jajang Sutarna', 'Madura', '2000-04-05', 'Pria', '087781918933', 'Jalan Alur Laut Selatan Nomor 33', '', 'Mahasiswa', '2022-04-15 12:46:00', '2022-04-15 12:46:00'),
(33, '2018104032@student.kalbis.ac.id', '202cb962ac59075b964b07152d234b70', 'Tarmidi Sukmah', 'Magelang', '2000-05-02', 'Pria', '123123123', 'Jalan Kebawa terus', '/assets/data/mahasiswa/foto_profilM/2018104032_11-26-11.jpg', 'Mahasiswa', '2022-05-14 11:26:00', '2022-05-14 11:26:00');

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
  `nama` varchar(200) NOT NULL,
  `username` varchar(156) NOT NULL,
  `password` varchar(156) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id`, `nama`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, '', 'admin', '202cb962ac59075b964b07152d234b70', '2022-01-03 10:14:11', '2022-01-03 10:14:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_formulir`
--
ALTER TABLE `data_formulir`
  ADD PRIMARY KEY (`id_formulir`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_dosen` (`approval_admin`);

--
-- Indexes for table `data_mahasiswa_kampus`
--
ALTER TABLE `data_mahasiswa_kampus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_studi` (`program_studi`),
  ADD KEY `mhs` (`id_mahasiswa`);

--
-- Indexes for table `data_surat`
--
ALTER TABLE `data_surat`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `data_surat_kp`
--
ALTER TABLE `data_surat_kp`
  ADD PRIMARY KEY (`id_surat_kp`);

--
-- Indexes for table `data_surat_pengantar_riset`
--
ALTER TABLE `data_surat_pengantar_riset`
  ADD PRIMARY KEY (`id_pengantar_riset`);

--
-- Indexes for table `data_ttd`
--
ALTER TABLE `data_ttd`
  ADD PRIMARY KEY (`id_ttd`);

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
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_formulir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `data_mahasiswa_kampus`
--
ALTER TABLE `data_mahasiswa_kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `data_surat`
--
ALTER TABLE `data_surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `data_surat_kp`
--
ALTER TABLE `data_surat_kp`
  MODIFY `id_surat_kp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_surat_pengantar_riset`
--
ALTER TABLE `data_surat_pengantar_riset`
  MODIFY `id_pengantar_riset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `data_ttd`
--
ALTER TABLE `data_ttd`
  MODIFY `id_ttd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
-- Constraints for table `data_mahasiswa_kampus`
--
ALTER TABLE `data_mahasiswa_kampus`
  ADD CONSTRAINT `data_mhs` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `prog_studi` FOREIGN KEY (`program_studi`) REFERENCES `program_studi` (`id`);

--
-- Constraints for table `data_surat`
--
ALTER TABLE `data_surat`
  ADD CONSTRAINT `id_admin` FOREIGN KEY (`id_admin`) REFERENCES `superadmin` (`id`);

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
