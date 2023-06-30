-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2023 at 03:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puskesmas_sidrap`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `id_user`, `tgl`) VALUES
(1, 7, '2023-06-30'),
(2, 7, '2023-06-30'),
(3, 7, '2023-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `pagename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `pagename`) VALUES
(1, 'admin'),
(2, 'staf'),
(3, 'dokter'),
(4, 'perawat'),
(5, 'apoteker'),
(6, 'pasien'),
(7, 'auditor'),
(8, 'login'),
(9, 'logout'),
(10, 'beranda'),
(11, 'register');

-- --------------------------------------------------------

--
-- Table structure for table `page_access`
--

CREATE TABLE `page_access` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_page` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_access`
--

INSERT INTO `page_access` (`id`, `id_role`, `id_page`) VALUES
(1, 1, 1),
(2, 1, 10),
(3, 1, 8),
(4, 1, 9),
(5, 2, 2),
(6, 2, 8),
(7, 2, 9),
(8, 2, 10),
(9, 3, 3),
(10, 3, 8),
(11, 3, 9),
(12, 3, 10),
(13, 4, 4),
(14, 4, 8),
(15, 4, 9),
(16, 4, 10),
(17, 4, 4),
(18, 4, 8),
(19, 4, 9),
(20, 4, 10),
(21, 5, 5),
(22, 5, 8),
(23, 5, 9),
(24, 5, 10),
(25, 6, 6),
(26, 6, 8),
(27, 6, 9),
(28, 6, 10),
(30, 7, 7),
(31, 7, 8),
(32, 7, 9),
(33, 7, 10),
(35, 7, 4),
(36, 2, 11),
(37, 2, 6),
(39, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama_kk` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `agama` enum('islam','kristen','hindu','budha','katolik','konghuchu') NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `umur` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama_kk`, `nama`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `pekerjaan`, `agama`, `no_hp`, `umur`, `email`, `password`) VALUES
(1, 'Laode Muhamad Fitrah Ramadhan', 'Laode', '28/11/2002', 'Aspol Toddopuli Blok A No.5', 'pria', 'Mahasiswa', 'islam', '081943783411', 21, 'anonyrmoust@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(2, 'Muhammad Adnan Surya Azis', 'Adnan', '1970-01-01', 'Jl. Toddopuli 1 Setapak 5 No.34, Kassi-Kassi, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222', 'pria', 'Wirausaha', 'islam', '082345779012', 30, 'adnan@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(3, 'John Smith', 'Johnny', '1990-02-10', '123 Main Street, Anytown, USA', 'pria', 'Software Engineer', 'budha', '+1 (555) 123-4567', 33, 'voidcode@poliupg.ac.id', '25d55ad283aa400af464c76d713c07ad'),
(4, 'Emma Johnson', 'Em', '1985-03-15', '456 Elm Street, Cityville, USA', '', 'Marketing Manager', 'kristen', '+1 (555) 987-6543', 38, 'emma.johnson@example.com', '25d55ad283aa400af464c76d713c07ad'),
(5, 'David Thompson', 'Dave', '1992-11-22', '789 Oak Avenue, Townsville, USA', 'pria', 'Accountant', 'kristen', '+1 (555) 234-5678', 30, 'david.thompson@example.com', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medik`
--

CREATE TABLE `rekam_medik` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `no_kartu` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `tgl` varchar(255) NOT NULL,
  `anamnesa` varchar(255) NOT NULL,
  `saran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekam_medik`
--

INSERT INTO `rekam_medik` (`id`, `id_pasien`, `no_kartu`, `no`, `tgl`, `anamnesa`, `saran`) VALUES
(1, 1, 223344, 1, '10/03/2023', 'Contoh Anamnesa 1', 'Saran 1'),
(2, 2, 112233, 1, '07/11/2010', 'Contoh Anamnesa 2', 'Saran 2'),
(3, 1, 223344, 2, '21/05/2023', 'Contoh Anamnesa 3', 'Terapi 1'),
(4, 2, 112233, 2, '12/03/2011', 'Contoh Anamnesa 4', 'Terapi 2'),
(6, 2, 112233, 3, '17/5/2023', '<p>Oke123</p>', '<p>Baik</p>'),
(7, 1, 223344, 3, '18/5/2023', '<p>Anamnesa 1 Ok</p>', '<p>Therap Terserah</p>');

-- --------------------------------------------------------

--
-- Table structure for table `rekap_medis`
--

CREATE TABLE `rekap_medis` (
  `id` int(11) NOT NULL,
  `id_rekam_medik` int(11) NOT NULL,
  `tgl` varchar(255) NOT NULL,
  `id_ruang` int(11) NOT NULL,
  `anam_pem_fisik` longtext DEFAULT NULL,
  `diagnosis` longtext DEFAULT NULL,
  `terapi` longtext DEFAULT NULL,
  `asuhan` longtext DEFAULT NULL,
  `icd` longtext DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `kajian_subjektif` longtext DEFAULT NULL,
  `kajian_objektif` varchar(255) DEFAULT NULL,
  `paraf_paramedis` enum('terima','tolak','-') DEFAULT NULL,
  `paraf_medis` enum('terima','tolak','-') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekap_medis`
--

INSERT INTO `rekap_medis` (`id`, `id_rekam_medik`, `tgl`, `id_ruang`, `anam_pem_fisik`, `diagnosis`, `terapi`, `asuhan`, `icd`, `id_petugas`, `kajian_subjektif`, `kajian_objektif`, `paraf_paramedis`, `paraf_medis`) VALUES
(7, 3, '20/4/2023', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'asdadas21321321321', NULL, NULL, NULL),
(8, 3, '20/4/2023', 1, 'Anamnesis 1 Contoh', 'Belum ada Diagnosis (A)', 'Belum ada Terapi (P)', 'Belum ada Asuhan Keperawatan / Kebidanan', 'Belum ada ICD X', 0, 'Sakit', NULL, NULL, NULL),
(9, 4, '16/4/2023', 2, NULL, NULL, NULL, NULL, NULL, NULL, '<p>sdasdas</p>', NULL, NULL, NULL),
(10, 4, '16/4/2023', 2, NULL, NULL, NULL, NULL, NULL, NULL, '<p>dasdasda</p>', NULL, NULL, NULL),
(15, 6, '17/4/2023', 2, 'asdasas123123321321', 'Belum ada Diagnosis (A)', 'Belum ada Terapi (P)', NULL, 'Belum ada ICD X', 0, '<p>ASDasdadasdsadas</p>', NULL, NULL, NULL),
(16, 3, '17/4/2023', 2, NULL, NULL, NULL, NULL, NULL, NULL, '<p>dsadasdasd</p>', NULL, NULL, NULL),
(18, 7, '18/4/2023', 2, NULL, NULL, NULL, NULL, NULL, NULL, '<p>Okeokeokekeoke</p>', NULL, NULL, NULL),
(19, 7, '20/4/2023', 2, NULL, NULL, NULL, NULL, NULL, NULL, '<p>adsasdas1234</p>', NULL, NULL, NULL),
(20, 7, '30/5/2023', 1, NULL, NULL, NULL, NULL, NULL, NULL, '<p>dasdasdsa</p>', '<p>dasdasda</p>', NULL, NULL),
(21, 7, '30/5/2023', 2, NULL, NULL, NULL, '<p>dadasdadasd</p>', NULL, NULL, '<p>dasdas</p>', '<p>dsadasd</p>', NULL, NULL),
(22, 7, '30/5/2023', 1, 'Belum ada Anamnesis (S) &amp; Pemeriksaan Fisik (O)', 'Belum ada Diagnosis (A)', 'Belum ada Terapi (P)', '<p>dsadasdas</p>', 'Belum ada ICD X', 0, '<p>dsadadas</p>', '<p>dsadasd</p>', 'tolak', 'terima');

-- --------------------------------------------------------

--
-- Table structure for table `resep_obat`
--

CREATE TABLE `resep_obat` (
  `id` int(11) NOT NULL,
  `id_rekap_medis` int(11) NOT NULL,
  `resep` longtext NOT NULL,
  `status` enum('request','selesai') NOT NULL,
  `tgl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resep_obat`
--

INSERT INTO `resep_obat` (`id`, `id_rekap_medis`, `resep`, `status`, `tgl`) VALUES
(1, 10, '<p>Obat 1234</p>', 'selesai', '17/5/2023'),
(2, 9, '<p>Obat Paracetamol</p>', 'selesai', '17/5/2023'),
(3, 7, '<p>Hello 123</p><p><br></p>', 'request', '17/5/2023');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `rolename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `rolename`) VALUES
(1, 'admin'),
(2, 'staf'),
(3, 'dokter'),
(4, 'perawat'),
(5, 'apoteker'),
(6, 'pasien'),
(7, 'auditor');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id`, `nama`) VALUES
(1, 'Ruang 1'),
(2, 'Ruang 2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_role`, `email`, `password`, `full_name`, `no_hp`) VALUES
(1, 6, 'david.thompson@example.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL),
(2, 6, 'emma.johnson@example.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL),
(3, 6, 'voidcode@poliupg.ac.id', '25d55ad283aa400af464c76d713c07ad', NULL, NULL),
(4, 6, 'adnan@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Muhammad Adnan Surya Azis', '082345779012'),
(5, 6, 'anonyrmoust@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL),
(6, 1, 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL),
(7, 2, 'staf@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dasdasdasd', '3221312312'),
(8, 3, 'dokter@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Dr. Paijo', '081919191919'),
(9, 4, 'perawat@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Rungkad', '12345678'),
(10, 5, 'apoteker@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'My Name is Apoteker', '088888888888'),
(11, 7, 'auditor@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'auditor123', '0821389123291'),
(14, 2, 'testingemailstaf@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'My name is testing staf', '081943783411');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_access`
--
ALTER TABLE `page_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_medik`
--
ALTER TABLE `rekam_medik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekap_medis`
--
ALTER TABLE `rekap_medis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `page_access`
--
ALTER TABLE `page_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rekam_medik`
--
ALTER TABLE `rekam_medik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rekap_medis`
--
ALTER TABLE `rekap_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `resep_obat`
--
ALTER TABLE `resep_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
