-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 03:40 PM
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
  `approval` int(11) NOT NULL DEFAULT 0 COMMENT '0= not approval, 1=approval,2=reject\r\n',
  `approval_admin` int(11) NOT NULL DEFAULT 0 COMMENT '0=admin not validate,1=admin validate,2=duplicate\r\n',
  `status_surat` int(11) NOT NULL COMMENT '0=not create,1=create surat',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_formulir`
--

INSERT INTO `data_formulir` (`id_formulir`, `no_form`, `id_mahasiswa`, `id_jenis_permohonan`, `approval`, `approval_admin`, `status_surat`, `created_at`) VALUES
(3, 'FR-KALBIS-OPR-99834/V1/R0', 29, 1, 1, 1, 1, '2022-04-01 18:56:00'),
(4, 'FR-KALBIS-OPR-52042/V1/R0', 29, 1, 1, 1, 1, '2022-04-03 16:48:00'),
(12, 'FR-KALBIS-OPR-46431/V1/R0', 29, 2, 1, 1, 1, '2022-04-03 17:36:00'),
(13, 'FR-KALBIS-OPR-14176/V1/R0', 29, 1, 0, 2, 0, '2022-04-11 12:16:00'),
(14, 'FR-KALBIS-OPR-25095/V1/R0', 30, 1, 0, 0, 0, '2022-04-15 13:26:00');

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
(2, 6, 'H96219041', 2),
(3, 7, 'h123123', 5);

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
(10, 30, '2018104031', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `data_surat`
--

CREATE TABLE `data_surat` (
  `id_surat` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `id_formulir` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_surat`
--

INSERT INTO `data_surat` (`id_surat`, `no_surat`, `id_formulir`, `created_at`) VALUES
(5, '1/AO-SRT/IV/2022', 3, '2022-04-21 00:00:00'),
(6, '2/AO-SRT/IV/2022', 4, '2022-04-21 00:00:00'),
(7, '1/WRII-SRT/VI/2022', 12, '2022-04-21 00:00:00');

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
(2, 12, 'Jalan Pulomas Selatan Kav.22 Jakarta Timur Daerah Khusus Ibukota Jakarta', 'Kalbis Institute', 'Mamat', 'Head Academic Advisor', '0274786766');

-- --------------------------------------------------------

--
-- Table structure for table `data_surat_pengantar_riset`
--

CREATE TABLE `data_surat_pengantar_riset` (
  `id_pengantar_riset` int(11) NOT NULL,
  `id_formulir` int(11) NOT NULL,
  `jenis_tugas` varchar(50) NOT NULL,
  `judul` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_surat_pengantar_riset`
--

INSERT INTO `data_surat_pengantar_riset` (`id_pengantar_riset`, `id_formulir`, `jenis_tugas`, `judul`) VALUES
(2, 3, 'tugas akhir', 'Assalamualaikum'),
(3, 4, 'tugas kuliah', 'wiuwiu'),
(5, 13, 'tugas akhir', 'asd'),
(6, 14, 'tugas akhir', 'Test aja');

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
  `jabatan` varchar(20) NOT NULL,
  `is_active` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `email`, `password`, `nama_lengkap`, `tempat`, `tgl_lahir`, `jenis_kelamin`, `no_telp`, `alamat`, `foto`, `jabatan`, `is_active`, `updated_at`, `created_at`) VALUES
(6, 'Jamal@gmail.com', '202cb962ac59075b964b07152d234b70', 'Abdul Jamal Billah', 'Jakarta', '1966-02-10', 'Pria', '1234441', 'jalan kebon bawang 11, RT.004, RW.01 Kebon Bawang, Tanjung Priok 14320', '', 'Dosen', 1, '2022-02-20 13:20:00', '2022-02-20 13:20:00'),
(7, 'loli@gmail.com', '202cb962ac59075b964b07152d234b70', 'Lolita Agesta', 'Jakarta', '1966-08-15', 'Wanita', '128371283', 'JL. Bambu Apus 3', '', 'Dosen', 1, '2022-04-16 14:29:00', '2022-04-16 14:29:00');

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
(29, '2018104030@student.kalbis.ac.id', '202cb962ac59075b964b07152d234b70', 'Muhammad Hadits Alkhafidl', 'Jakarta', '2000-02-03', 'Pria', '1234441', 'asdsad', '', 'Mahasiswa', '2022-02-23 18:03:00', '2022-02-23 18:03:00'),
(30, '2018104031@student.kalbis.ac.id', '202cb962ac59075b964b07152d234b70', 'Jajang Sutarna', 'Madura', '2000-04-05', 'Pria', '087781918933', 'Jalan Alur Laut Selatan Nomor 33', '', 'Mahasiswa', '2022-04-15 12:46:00', '2022-04-15 12:46:00');

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
  ADD KEY `id_dosen` (`approval_admin`);

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
-- Indexes for table `data_surat`
--
ALTER TABLE `data_surat`
  ADD PRIMARY KEY (`id_surat`);

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
  MODIFY `id_formulir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `data_karyawan_kampus`
--
ALTER TABLE `data_karyawan_kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_mahasiswa_kampus`
--
ALTER TABLE `data_mahasiswa_kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_surat`
--
ALTER TABLE `data_surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_surat_kp`
--
ALTER TABLE `data_surat_kp`
  MODIFY `id_surat_kp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_surat_pengantar_riset`
--
ALTER TABLE `data_surat_pengantar_riset`
  MODIFY `id_pengantar_riset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
-- Constraints for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD CONSTRAINT `fakultas` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id`),
  ADD CONSTRAINT `program` FOREIGN KEY (`id_program`) REFERENCES `program` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
