-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26 Jul 2018 pada 16.31
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
-- Struktur dari tabel `data_berita`
--

CREATE TABLE `data_berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `sumber` varchar(150) NOT NULL,
  `token` text NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `kemiripan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_berita`
--

INSERT INTO `data_berita` (`id_berita`, `judul`, `sumber`, `token`, `kategori`, `kemiripan`) VALUES
(1, 'cek', 'cek', 'pintar seleksi didik jenjang guru universitas sekolah dasar edukasi yayasan muda generasi workshop karakter motivasi kreatifitas ilmu akademis cerdas formal beasiswa sposor', 'Pendidikan', '0.08'),
(2, 'cek', 'cek', 'pintar seleksi didik jenjang guru universitas sekolah dasar edukasi yayasan muda generasi workshop karakter motivasi kreatifitas ilmu akademis cerdas formal beasiswa sposor', 'Pendidikan', '0.08');

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
(14, 'B1', 'kota pontianak - berita 1', '2018', 'berita', 'khitan obat gigi apotik klinik sakit wabah masker asuransi balai jasmani sehat jiwa data gizi hamil operasi mata polusi masal', 'khitan obat gigi apotik klinik sakit wabah masker asuransi balai jasmani sehat jiwa data gizi hamil operasi mata polusi masal', 'sosial'),
(15, 'B2', 'kota pontianak - berita 2', '2018', 'berita', 'pintar seleksi didik jenjang guru universitas sekolah tengah dasar edukasi yayasan muda generasi workshop karakter motivasi kreatifitas ilmu akademis cerdas formal beasiswa sposor', 'pintar seleksi didik jenjang guru universitas sekolah dasar edukasi yayasan muda generasi workshop karakter motivasi kreatifitas ilmu akademis cerdas formal beasiswa sposor', 'sosial'),
(16, 'Tanam Mangrove di Kepulauan Seribu', 'PT PLN DISJAYA', '2016', 'csr', 'Sebagai upaya dalam pelestarian kepulauan seribu, PLN hadir dikepulauan seribu dalam program tanam mangrove di 3 (tiga) pulau yakni Pulau Panggang, Pulau Harapan dan Pulau Untung Jawa untuk melindungi garis pantai dikepulauan seribu oleh proses abrasi air laut. Tanam Mangrove di Kepulauan Seribu', 'upaya lestari pulau ribu pln hadir pulau ribu program tanam mangrove 3 tiga pulau pulau panggang pulau harap pulau untung jawa lindung garis pantai pulau ribu proses abrasi air laut tanam mangrove pulau ribu', 'lingkungan'),
(17, 'Aksi Sekolah Sungai Ciliwung', 'PT PLN DISJAYA', '2017', 'csr', 'Kurangnya pemahaman yang terjadi di masyarakat untuk hidup bersih dan teratur, dimana masih adanya masyarakat yang kurang peduli dengan keberadaan sungai yang mengepung wilayah DKI Jakarta dengan masih membuang sampah sampah,limbah rumahtangga dan industri ke sungai. Hal tersebut menyebabkan kualitas sumber daya air menjadi buruk dan bisa pula menimbulkan banjir yang kerap terjadi diwilayah yang berdekatan dengan daerah aliran sungai khususnya sungai Ciliwung di sungai. Program ini bertujuan untuk mengedukasi masyarakat agar lebih bijak dalam memperlakukan sungai dan mengembalikan fungsi awal sungai. Aksi Sekolah Sungai Ciliwung', 'kurang paham masyarakat hidup bersih atur mana masyarakat peduli ada sungai kepung wilayah dki jakarta buang sampah sampah limbah rumahtangga industri sungai sebab kualitas sumber daya air buruk timbul banjir kerap wilayah dekat daerah alir sungai sungai ciliwung sungai program tuju edukasi masyarakat bijak laku sungai kembali fungsi sungai aksi sekolah sungai ciliwung', 'Pendidikan'),
(18, 'Bantuan Bencana Alam Banjir', 'PT PLN DISJAYA', '2018', 'csr', 'Sebagai aksi percepatan upaya tanggap darurat PLN Disjaya terhadap bencana alam dalam hal ini banjir yang melanda kota Jakarta, PLN Peduli hadir dimasyarakat dengan tujuan meringankan beban penderitaan korban bencana dengan memberikan bantuan yang sangat dibutuhkan oleh para korban bencana alam.', 'aksi cepat upaya tanggap darurat pln disjaya bencana alam banjir landa kota jakarta pln peduli hadir masyarakat tuju ringan beban derita korban bencana bantu butuh korban bencana alam', 'bencana_alam'),
(19, 'Bank Sampah Anyelir', 'PT PLN DISJAYA', '2015', 'csr', 'Sebagai upaya edukasi kepada masyarakat terhadap sampah dan manfaat sampah serta meningkatkan perekonomian masyarakat, PLN Disjaya menjalankan program pembinaan  Bank Sampah Anyelir sejak tahun 2015 sampai sekarang, dari tahun ke tahun jumlah nasabah terus meningkat dan pola pemikiran masyarakatpun sudah mulai berubah, dimana kebanyakan pengurus dan nasabah  adalah wanita yang memiliki jiwa sosial yang tinggi dilingkungannya.', 'upaya edukasi masyarakat sampah manfaat sampah tingkat ekonomi masyarakat pln disjaya jalan program bina bank sampah anyelir 2015 sekarang nasabah tingkat pola pikir masyarakat ubah mana banyak urus nasabah wanita milik jiwa sosial lingkung', 'ekonomi'),
(20, 'Kampung Binaan', 'PT PLN DISJAYA', '2017', 'csr', 'Cantolan liar yang sering dilakukan oleh masyarakat sering kali menimbulkan kerugian bukan hanya untuk perusahaan namun juga untuk masyarakat itu sendiri. Karena hal ini juga merupakan salah satu penyebab bencana kebakaran, tegangan drop dan hal-hal yang tidak diinginkan, untuk itu PLN Disjaya hadir di masyakarat untuk mengubah kebiasaan masyarakat agar lebih mengenal PLN dan menjadi sahabat PLN dalam program Kampung Binaan. Dimana dalam program ini PLN turun langsung untuk mengedukasi masyarakat agar dapat mengubah pola hidup masyarakat dengan beberapa kegiatan didalamnya seperti sosialisasi, kegiatan bank sampah, KWT (Kelompok Wanita Tani), UMKM, Kampung berkelir, kampung anak dll. Dengan berjalannya program ini Angga tunggakan dan cantolan di wilayah yang dihadiri PLN Peduli menurun dan wawasan masyarakat setempat semakin terbuka terhadap PLN. ', 'cantol liar masyarakat kali timbul rugi usaha masyarakat sendiri salah sebab bencana bakar tegang drop hal ingin pln disjaya hadir masyakarat ubah biasa masyarakat kenal pln sahabat pln program kampung bina mana program pln turun langsung edukasi masyarakat ubah pola hidup masyarakat giat dalam sosialisasi giat bank sampah kwt kelompok wanita tani umkm kampung kelir kampung anak dll jalan program angga tunggak cantol wilayah hadir pln peduli turun wawas masyarakat buka pln', 'sosial'),
(21, 'Pengawal Gadis (Gardu Distribusi)', 'PT PLN DISJAYA', '2016', 'csr', 'Kurangnya kepedulian masyarakat di sekitar gardu distribusi yang merupakan asset PLN, dan seringnya terjadi penyalahgunaan fungsi gardu distribusi sebagai tempat pembuangan sampah, tempat tinggal tunawisma serta sering hilangnya komponen dalam gardu membuat PLN menjalankan program Pengawal Gadis (Gardu Distribusi) agar dapat meminimalisir hal-hal tersebut melalui pendekatan ke masyarakat dan pemberian bantuan untuk fasilitas publik (seperti pos keamanan, sarana ibdah dan sarana pendidikan) didaerah sekitar gardu dan menjadikan masyarakat sebagai sahabat PLN untuk dapat mengawal keamanan asset PLN tersebut agar tidak terjadi hal-hal yang tidak inginkan yang dapat merugikan masyarakat maupun PLN.', 'kurang peduli masyarakat gardu distribusi asset pln penyalahgunaan fungsi gardu distribusi buang sampah tinggal tunawisma hilang komponen gardu pln jalan program awal gadis gardu distribusi meminimalisir hal dekat masyarakat beri bantu fasilitas publik seperti pos aman sarana ibdah sarana didik daerah gardu jadi masyarakat sahabat pln awal aman asset pln hal rugi masyarakat pln', 'publik_faisilitas'),
(29, '1', '1', '1', 'csr', 'Pada tahun 2015 Kementerian BUMN telah menginisiasi dan mengkoordinasikan Program Bedah Rumah Veteran dengan kegiatan Perbaikan Rumah Veteran di seluruh Provinsi Bedah 2015 dalam rangka Peringatan 70 tahun Indonesia Merdeka. Program Bedah 2015 diselenggarakan di 34 Provinsi dengan tema BUMN Hadir Untuk Negeri sebagai kontribusi BUMN dalam berperan serta memberikan penghormatan dan ucapan terima kasih kepada Veteran, yang sekaligus merupakan perwujudan nyata', '2015 menteri bumn inisiasi koordinasi program bedah rumah veteran giat baik rumah veteran provinsi bedah 2015 rangka ingat 70 indonesia merdeka program bedah 2015 selenggara 34 provinsi tema bumn hadir negeri kontribusi bumn peran hormat ucap terima kasih veteran wujud nyata', 'lingkungan');

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
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_training`
--
ALTER TABLE `data_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
