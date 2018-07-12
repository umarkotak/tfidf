-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 Jul 2018 pada 19.20
-- Versi Server: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prediksicsr`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_training`
--

CREATE TABLE `data_training` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `sumber` varchar(50) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `dokumen` text NOT NULL,
  `token` text NOT NULL,
  `kategori` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_training`
--

INSERT INTO `data_training` (`id`, `judul`, `sumber`, `tahun`, `jenis`, `dokumen`, `token`, `kategori`) VALUES
(2, 'S1', 'qwe', '123', 'csr', 'pintar seleksi pendidikan jenjang perguruan tinggi universitas sekolah menengah atas dasar edukasi yayasan muda generasi workshop karakter motivasi kreatifitas ilmu akademis cerdas formal beasiswa sposor', 'pintar seleksi didik jenjang guru universitas sekolah tengah dasar edukasi yayasan muda generasi workshop karakter motivasi kreatifitas ilmu akademis cerdas formal beasiswa sposor', 'kategori');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_training`
--
ALTER TABLE `data_training`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_training`
--
ALTER TABLE `data_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
