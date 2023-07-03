-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 04:32 AM
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
  `password` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama_kk`, `nama`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `pekerjaan`, `agama`, `no_hp`, `umur`, `email`, `password`, `nik`) VALUES
(1, 'Laode Muhamad Fitrah Ramadhan', 'Laode', '28/11/2002', 'Aspol Toddopuli Blok A No.5', 'pria', 'Mahasiswa', 'islam', '081943783411', 21, 'anonyrmoust@gmail.com', '25d55ad283aa400af464c76d713c07ad', '3321110902070002'),
(2, 'Muhammad Adnan Surya Azis', 'Adnan', '1970-01-01', 'Jl. Toddopuli 1 Setapak 5 No.34, Kassi-Kassi, Kec. Rappocini, Kota Makassar, Sulawesi Selatan 90222', 'pria', 'Wirausaha', 'islam', '082345779012', 30, 'adnan@gmail.com', '25d55ad283aa400af464c76d713c07ad', '3321060902150009'),
(3, 'John Smith', 'Johnny', '1990-02-10', '123 Main Street, Anytown, USA', 'pria', 'Software Engineer', 'budha', '+1 (555) 123-4567', 33, 'voidcode@poliupg.ac.id', '25d55ad283aa400af464c76d713c07ad', '3305040901072053'),
(4, 'Emma Johnson', 'Em', '1985-03-15', '456 Elm Street, Cityville, USA', '', 'Marketing Manager', 'kristen', '+1 (555) 987-6543', 38, 'emma.johnson@example.com', '25d55ad283aa400af464c76d713c07ad', '3321062311110003'),
(5, 'David Thompson', 'Dave', '1992-11-22', '789 Oak Avenue, Townsville, USA', 'pria', 'Accountant', 'kristen', '+1 (555) 234-5678', 30, 'david.thompson@example.com', '25d55ad283aa400af464c76d713c07ad', '3321113011050018'),
(7, 'Testing nama KK', 'Testing nama panggilan', '2023-07-03', 'Testing alamat', 'pria', 'Testing pekerjaan', 'hindu', '081943783411', 77, 'testingpasien@gmail.com', '25d55ad283aa400af464c76d713c07ad', '1402022805100001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
