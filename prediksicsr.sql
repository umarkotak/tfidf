-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2018 at 03:24 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

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
-- Table structure for table `data_berita`
--

CREATE TABLE `data_berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `sumber` varchar(150) NOT NULL,
  `token` text NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_training`
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
-- Dumping data for table `data_training`
--

INSERT INTO `data_training` (`id`, `judul`, `sumber`, `tahun`, `jenis`, `dokumen`, `token`, `kategori`) VALUES
(7, 's2', 'pln', '2018', 'csr', 'khitan obat gigi apotik klinik sakit wabah masker asuransi balai jasmani sehat jiwa data gizi hamil operasi mata polusi masal', 'khitan obat gigi apotik klinik sakit wabah masker asuransi balai jasmani sehat jiwa data gizi hamil operasi mata polusi masal', 'bencana_alam'),
(8, 's1', 'pln', '2018', 'csr', 'pintar seleksi pendidikan jenjang perguruan tinggi universitas sekolah menengah atas dasar edukasi yayasan muda generasi workshop karakter motivasi kreatifitas ilmu akademis cerdas formal beasiswa sposor', 'pintar seleksi didik jenjang guru universitas sekolah tengah dasar edukasi yayasan muda generasi workshop karakter motivasi kreatifitas ilmu akademis cerdas formal beasiswa sposor', 'pendidikan'),
(9, 's3', 'pln', '2018', 'csr', 'masjid mulid nabi idul adha ibadah natal renovasi nyepi hindu islam katolik kristen protestan puasa sedekah', 'masjid mulid nabi idul adha ibadah natal renovasi nyepi hindu islam katolik kristen protestan puasa sedekah', 'pengetas_kemiskinan'),
(10, 's4', 'pln', '2018', 'csr', 'bakti sosial teknis pertanian bengkel taman tanah pembangkit listrik tenaga uap dam inisiasi baruga renovasi tanam transmisi turap saluran daya gardu unit', 'bakti sosial teknis tani bengkel taman tanah bangkit listrik tenaga uap dam inisiasi baruga renovasi tanam transmisi turap salur daya gardu unit', 'publik_faisilitas'),
(11, 's5', 'pln', '2018', 'csr', 'musibah yatim piatuh meninggal duka banjir bandang gempa tsunami laut udara pantai alam longsor kabut', 'musibah yatim piatuh tinggal duka banjir bandang gempa tsunami laut udara pantai alam longsor kabut', 'bencana_alam'),
(12, 's6', 'pln', '2018', 'csr', 'musyawarah ikatan pensiun bangun yatim piatu duafa terampil pelatihan jahit penyuluhan wirausaha kelestarian usaha industri kerajinan produksi pengembangan budaya tradisi koperasi ekonomi', 'musyawarah ikat pensiun bangun yatim piatu duafa terampil latih jahit suluh wirausaha lestari usaha industri rajin produksi kembang budaya tradisi koperasi ekonomi', 'sosial'),
(13, 's7', 'pln', '2018', 'csr', 'partisipasi tim bola voli run lari juara bowling gerak golf turnamen', 'partisipasi tim bola voli run lari juara bowling gerak golf turnamen', 'ekonomi'),
(14, 'B1', 'kota pontianak - berita 1', '2018', 'berita', 'khitan obat gigi apotik klinik sakit wabah masker asuransi balai jasmani sehat jiwa data gizi hamil operasi mata polusi masal', 'khitan obat gigi apotik klinik sakit wabah masker asuransi balai jasmani sehat jiwa data gizi hamil operasi mata polusi masal', 'sosial'),
(15, 'B2', 'kota pontianak - berita 2', '2018', 'berita', 'pintar seleksi didik jenjang guru universitas sekolah tengah dasar edukasi yayasan muda generasi workshop karakter motivasi kreatifitas ilmu akademis cerdas formal beasiswa sposor', 'pintar seleksi didik jenjang guru universitas sekolah dasar edukasi yayasan muda generasi workshop karakter motivasi kreatifitas ilmu akademis cerdas formal beasiswa sposor', 'sosial');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_berita`
--
ALTER TABLE `data_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `data_training`
--
ALTER TABLE `data_training`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_berita`
--
ALTER TABLE `data_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_training`
--
ALTER TABLE `data_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
