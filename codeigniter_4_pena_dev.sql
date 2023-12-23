-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Des 2023 pada 13.42
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeigniter_4_pena`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_arsip`
--

CREATE TABLE `tbl_arsip` (
  `id_arsip` int(11) NOT NULL,
  `id_kategori` smallint(6) DEFAULT NULL COMMENT 'dari tbl_kategori',
  `no_arsip` varchar(100) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `tgl_upload` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tgl_updated` datetime DEFAULT NULL COMMENT 'ketia di updated status = 2',
  `file_arsip` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT 'status upload 0, update 1, deleted 2',
  `id_dep` smallint(6) DEFAULT NULL COMMENT 'dari tbl_dep',
  `id_sub_dep` smallint(6) NOT NULL,
  `id_user` int(11) DEFAULT NULL COMMENT 'dari tbl_user',
  `tahun` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_arsip`
--

INSERT INTO `tbl_arsip` (`id_arsip`, `id_kategori`, `no_arsip`, `nama_file`, `deskripsi`, `tgl_surat`, `tgl_upload`, `tgl_updated`, `file_arsip`, `status`, `id_dep`, `id_sub_dep`, `id_user`, `tahun`) VALUES
(6, 5, '01/SDM.03.5-SR/1706/2023', 'Surat Pengantar daftar honorarium serta absensi kehadiran PPNPN Kab. Mukomuko bulan desember 2022', 'Surat Pengantar daftar honorarium serta absensi kehadiran PPNPN Kab. Mukomuko bulan desember 2022.\r\nTanggal masuk 4 Januari 2023', '2023-01-04', '2023-01-05 17:42:22', NULL, '1672914520_34f6473d02e1acba857f.pdf', 0, 3, 4, 1, 2023),
(13, 6, 'nota-dinas-28-12-2023', 'Penggantian Ban Kendaraan Dinas BD 1032 CY (servis velg spooring balancing)', 'Bukti penggantian ban, servis velg, spooring balancing pada tanggal 2 januari 2023. ttd gito', '2022-12-28', '2023-01-06 09:22:28', NULL, '1672971748_d74a6b85fac95536d7b9.pdf', 0, 3, 4, 1, 2023),
(14, 7, '823/HK.01-SD/17/2022', 'Tanda Terima Surat Eko Sugianto', 'Penyampaian Salinan dan Petikan Keputusan KPU', '2022-12-12', '2023-01-06 09:28:39', NULL, '1672972066_78dc7f78f92ef12f29ca.pdf', 0, 3, 4, 1, 2022),
(15, 4, '4/SDM.05.5/1701/2022', 'Laporan Bulanan PPNPN Bulan Desember 2022 KPU Kab. Bengkulu Selatan', 'Laporan bulanan ppnpn bulan desember 2022 berisi , disposisi, surat, daftar hadir, laporan bulanan', '2023-01-02', '2023-01-12 08:57:32', NULL, '1672994319_1acfcd4d6f6f35607416.pdf', 0, 3, 4, 1, 2022),
(16, 1, '3/SDM.03.6-SD/1701/2022', 'Penjatuhan hukuman disiplin pegawai di lingkungan Sekretariat KPU Kabupaten Bengkulu Selatan', 'Penjatuhan hukuman disiplin pegawai di lingkungan sekretariat KPU Kabupaten Bengkulu Selatan', '2023-01-02', '2023-01-06 15:42:12', NULL, '1672994532_f1c0e6b003363754ccb3.pdf', 0, 3, 4, 1, 2023),
(17, 8, '1/RT.02.3-ST/17/2023', 'Supervisi dan Monitoring Bengkulu Tengah', 'Supervisi dan monitoring ke bengkulu selatan dalam rangka terkait pembentukan badan adhoc PPS di Kabupaten Bengkulu Tengah 1 hari, BBM ada.', '2023-01-03', '2023-01-10 22:52:15', NULL, '1673256525_c8287ce30e3edb79f938.pdf', 0, 3, 4, 1, 2023),
(18, 8, '6/RT.02.1-ST/17/2023', 'Surat Tugas Perjalanan Dinas Ke Rejang Lebong 7-8 Januari 2023', 'Melaksanakan Supervisi dan monitoring terkait pembentukan badan adhov pps dan sosialisasi tahapan pemilu tahun 2024 di KPU kabupaten rejang lebong tanggal 7 - 8 januari 2023', '2023-01-06', '2023-01-10 22:52:17', NULL, '1673335563_7ff4bf2a76b6a0135064.pdf', 0, 3, 4, 1, 2023),
(20, 4, '18/SDM.01-SD/1771/2023', 'Laporan Presensi Kehadiran, hasil kinerja dan peniliaian sikap dan perilaku PPNPN di KPU Kota Bengkulu Bulan Desember Tahun 2022', 'Laporan Kinerja KPU Kota Bengkulu ini Bulan Desember tahun 2022.\r\nLaporan Presensi Kehadiran, hasil kinerja dan peniliaian sikap dan perilaku PPNPN di KPU Kota Bengkulu Bulan Desember Tahun 2022, \r\n- rekap kehadiran\r\n- rekap terlambat hadir\r\n-laporan detail harian\r\n- Laporan Kinerja', '2023-01-09', '2023-01-11 14:04:55', NULL, '1673420695_3ad5bb59775c7534353c.pdf', 0, 3, 4, 1, 2022),
(21, 4, '409/SDM.01-SD/1703/2022', 'Laporan Presensi Kehadiran, hasil kinerja dan peniliaian sikap dan perilaku PPNPN di KPU Bengkulu Utara Bulan Desember Tahun 2022', 'Laporan Presensi Kehadiran, hasil kinerja dan peniliaian sikap dan perilaku PPNPN di KPU Bengkulu Utara Bulan Desember Tahun 2022', '2022-12-31', '2023-01-11 14:09:59', NULL, '1673420999_27d0bbef7b32d6f8e6fe.pdf', 0, 3, 4, 1, 2022),
(22, 4, '18/SDM.02-SP/1707/2023', 'Laporan Presensi Kehadiran, hasil kinerja dan peniliaian sikap dan perilaku PPNPN di KPU Lebong Bulan Desember Tahun 2022', 'Laporan Presensi Kehadiran, hasil kinerja dan peniliaian sikap dan perilaku PPNPN di KPU Lebong Bulan Desember Tahun 2022', '2023-01-10', '2023-01-11 14:21:45', NULL, '1673421705_093ecc8c19af83250d41.pdf', 0, 3, 4, 1, 2022),
(24, 4, '943/TU.01.2/1708/2022', 'penyampaian laporan kinerja dan absensi ppnpn bulan desember 2022 kpu kabupaten kepahiang', 'Laporan Kinerja PPNPN KPU Kab. Kepahiang, Daftar gaji tidak ada sm gito\r\nlaporan dijilid dan sulit untuk di scan, sehingga difoto menjadi pdf', '2022-12-31', '2023-01-12 08:51:15', NULL, '1673488275_755cb9d3ebfa14ed8c1c.pdf', 0, 3, 4, 1, 2022),
(30, 7, '824/HK.01-SD/17/2022', 'Tanda Terima Surat Fahamsyah Penyampaian Salinan dan Petikan Keputusan', 'Tanda Terima Surat Fahamsyah Penyampaian Salinan dan Petikan Keputusan KPU', '2022-12-12', '2023-01-16 09:52:24', NULL, '1673837544_ac92e7e5a270a0c2de99.pdf', 0, 3, 4, 1, 2022),
(31, 4, '11/SDM.03.5-SR/1706/2023', 'penyampaian laporan Evaluasi PPNPN bulan desember 2022 kpu kabupaten Mukomuko', 'Laporan Kinerja PPNPN, surat pengantar, laporan evaluasi', '2023-01-15', '2023-01-17 11:49:08', NULL, '1673930686_a6c13f98c6dfbf788e0d.pdf', 0, 3, 4, 1, 2022),
(32, 8, '15/RT.02.1-ST/17/2023', 'Supervisi dan Monitoring Bengkulu Selatan Fasilitasi Masalah Hukum', '13/RT.02.1-ST/17/2023 Sekrretaris, Meaghito\r\n\r\nBu irna pergi sama Meaghito', '2023-01-16', '2023-01-27 08:59:00', NULL, '1674784740_9ee784268a5e6237aa7e.pdf', 0, 3, 4, 1, 2023),
(33, 6, 'BD-1032-CY-24-1-2023', 'Pergantian Ban Mobil dan Tambah Angin BD 1032 CY', 'Mobil ban belakang sebelah kiri pecah, tidak dapat ditambal sehingga ganti ban, ban yang diganti berasal dari ban yang ada digudang ban yang velg nya sudah hancur', '2023-01-15', '2023-01-27 09:02:04', NULL, '1674784924_f2916bb19824c38ccfab.pdf', 0, 3, 4, 1, 2023),
(34, 8, '136/RT.02.1-ST/17/2023', 'Supervisi dan Monitoring Pelaksanaan Program dan Anggaran Pemilu Tahun 2024 Ke KPU Kabupaten Seluma dan Bengkulu Selatan', 'SPPD Ketua (Alpin Samsen) dan SPPD  Sekretaris (Hamzah dan Meaghito)', '2023-08-18', '2023-10-30 10:30:10', NULL, '1698636071_832b6c03727311376577.pdf', 0, 3, 4, 1, 2023);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dep`
--

CREATE TABLE `tbl_dep` (
  `id_dep` smallint(6) NOT NULL,
  `nama_dep` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_dep`
--

INSERT INTO `tbl_dep` (`id_dep`, `nama_dep`) VALUES
(1, 'Keuangan, Umum dan Logistik'),
(2, 'Rendatin'),
(3, 'TPPPHHS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` smallint(6) NOT NULL,
  `nama_kategori` varchar(255) DEFAULT NULL COMMENT 'Nama Kategori misal seperti kategori surat masuk, atau kategori surat keluar',
  `id_kategori_sub` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`, `id_kategori_sub`) VALUES
(1, 'Surat Masuk', 1),
(2, 'Surat Keluar', 1),
(3, 'Surat Keterangan', 2),
(4, 'Laporan Kinerja PPNPN', 2),
(5, 'Surat Pengantar', 2),
(6, 'Nota Dinas', 2),
(7, 'Tanda Terima', 2),
(8, 'Perjalanan Dinas', 1),
(9, 'Perjalanan Dinas', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori_sub`
--

CREATE TABLE `tbl_kategori_sub` (
  `id` tinyint(4) NOT NULL,
  `nama_kategori_sub` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kategori_sub`
--

INSERT INTO `tbl_kategori_sub` (`id`, `nama_kategori_sub`) VALUES
(1, 'Ketua'),
(2, 'Sekretaris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_level`
--

CREATE TABLE `tbl_level` (
  `id_level` smallint(6) NOT NULL,
  `level_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_level`
--

INSERT INTO `tbl_level` (`id_level`, `level_name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sub_dep`
--

CREATE TABLE `tbl_sub_dep` (
  `id_sub_dep` smallint(6) NOT NULL,
  `id_dep` smallint(6) NOT NULL,
  `nama_sub_dep` set('Teknis Penyelenggaraan Pemilu','Partisipasi Hubungan Masyarakat','Hukum','Sumber Daya Manusia','Keuangan','Umum','Logistik','Perencanaan','Data','Informasi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_sub_dep`
--

INSERT INTO `tbl_sub_dep` (`id_sub_dep`, `id_dep`, `nama_sub_dep`) VALUES
(1, 3, 'Teknis Penyelenggaraan Pemilu'),
(2, 3, 'Partisipasi Hubungan Masyarakat'),
(3, 3, 'Hukum'),
(4, 3, 'Sumber Daya Manusia'),
(5, 2, 'Perencanaan'),
(6, 2, 'Data'),
(7, 2, 'Informasi'),
(8, 1, 'Keuangan'),
(9, 1, 'Umum'),
(10, 1, 'Logistik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(150) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'status login 1 aktif, 0 tidak aktif',
  `level` smallint(6) NOT NULL COMMENT 'level user login 1 admin, 2 user',
  `id_dep` smallint(6) NOT NULL COMMENT 'berasal dari tbl_dep',
  `id_sub_dep` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `avatar`, `email`, `username`, `password`, `created_at`, `status`, `level`, `id_dep`, `id_sub_dep`) VALUES
(1, 'Meaghito Rizki Gumilang Sakti', 'avatarku_160x160.png', 'admin@gmail.com', 'admin007', '$2y$10$JO8CkPixuofXQ8sZQMxFQud4WdP7df8rMW6fSDU0CmcgNHqjkK4a2', '2022-12-11 12:15:14', 1, 1, 3, 4),
(28, 'Fitrian Ansyori', '1672920332_e89fce3d512e6deb8a1e.png', 'fitrian@gmail.com', 'Fitrian An_1672920332', '$2y$10$mPZoL8EgaAf64D/Kys5YvOxMXuymjnBZtD4SRqYyD332ejtYrraD2', '2023-01-05 19:05:33', 1, 1, 3, 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_arsip`
--
ALTER TABLE `tbl_arsip`
  ADD PRIMARY KEY (`id_arsip`);

--
-- Indeks untuk tabel `tbl_dep`
--
ALTER TABLE `tbl_dep`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tbl_kategori_sub`
--
ALTER TABLE `tbl_kategori_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_level`
--
ALTER TABLE `tbl_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `tbl_sub_dep`
--
ALTER TABLE `tbl_sub_dep`
  ADD PRIMARY KEY (`id_sub_dep`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_arsip`
--
ALTER TABLE `tbl_arsip`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tbl_dep`
--
ALTER TABLE `tbl_dep`
  MODIFY `id_dep` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori_sub`
--
ALTER TABLE `tbl_kategori_sub`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_level`
--
ALTER TABLE `tbl_level`
  MODIFY `id_level` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_sub_dep`
--
ALTER TABLE `tbl_sub_dep`
  MODIFY `id_sub_dep` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
