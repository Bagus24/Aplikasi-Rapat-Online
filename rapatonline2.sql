-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Agu 2020 pada 08.20
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rapatonline2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `is_super`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin', '$2y$10$8BpEH6IBZIQJryoII4eFgOdpFHvlEknWO/yILNSwizc/E6Wwzv5uq', 0, NULL, '2020-07-22 07:14:31', '2020-07-23 18:51:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembahasan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selesai` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_peserta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pimpinan` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(51, '2020_03_01_122351_create_peserta_table', 1),
(69, '2014_10_12_000000_create_users_table', 2),
(70, '2014_10_12_100000_create_password_resets_table', 2),
(71, '2019_08_19_000000_create_failed_jobs_table', 2),
(72, '2019_11_10_115030_create_admins_table', 2),
(73, '2020_03_01_134508_create_agenda_table', 2),
(74, '2020_03_01_165155_create_ruangan_table', 2),
(75, '2020_03_11_123844_create_pesertas_table', 2),
(76, '2020_03_17_141833_create_agenda_table', 3),
(77, '2020_03_18_070242_create_agenda_table', 4),
(78, '2020_03_25_134208_create_agenda_table', 5),
(79, '2020_05_03_164605_create_laporan_table', 6),
(80, '2020_05_12_043450_create_messages_table', 7),
(81, '2020_05_29_135955_create_notula_table', 8),
(82, '2020_06_01_143612_create_notula_table', 9),
(83, '2020_06_01_144454_create_agenda_table', 10),
(84, '2020_06_02_121302_create_agenda_table', 11),
(85, '2020_06_23_093639_create_pesertarapat_table', 12),
(86, '2020_07_04_025343_create_validasiagenda_table', 13),
(87, '2020_07_04_095823_create_validasiagenda_table', 14),
(88, '2020_07_07_132117_create_notifikasi_table', 15),
(89, '2020_07_13_150324_create_jenisrapat_table', 16),
(90, '2020_07_23_032943_create_coba_table', 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_peserta` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('baru','lama') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesertas`
--

CREATE TABLE `pesertas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nipy` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesertas`
--

INSERT INTO `pesertas` (`id`, `nipy`, `nama`, `status`, `jabatan`, `pendidikan`, `foto`, `created_at`, `updated_at`) VALUES
(3, '10.007.032', 'Ginanjar Wiro Sasmito, M.Kom', 'Dosen Tetap', 'Lektor', 'S1-Universitas Dian Nuswantoro / S2-Universitas Diponegoro', '1584536206.jpeg', '2020-03-13 21:44:03', '2020-07-06 13:37:20'),
(4, '04.014.178', 'Dairoh, M.Sc', 'Dosen Tetap', 'Asisten Ahli', 'S1-Universitas Jenderal Soedirman / S2-Universitas Gajah Mada', '1584161151.png', '2020-03-13 21:45:51', '2020-07-06 13:36:32'),
(5, '06.014.183', 'Dega Surono Wibowo, S.T., M.Kom', 'Dosen Tetap', 'Asisten Ahli', 'S1-Universitas Diponegoro / S2-Universitas Diponegoro', '1584161238.jpeg', '2020-03-13 21:47:18', '2020-07-06 13:36:57'),
(6, '08.015.222', 'Slamet Wiyono, S.Pd., M.Eng', 'Dosen Tetap', 'Asisten Ahli', 'S1-Universitas Negeri Semarang / S2- Universitas Gajah Mada', '1584161325.png', '2020-03-13 21:48:45', '2020-07-06 13:38:16'),
(7, '09.015.225', 'Dyah Apriliani, S.T., M.Kom', 'Dosen Tetap', 'Asisten Ahli', 'S1-Universitas Ahmad Dahlan / S2-Universitas Diponegoro', '1584161378.jpeg', '2020-03-13 21:49:38', '2020-07-06 13:37:13'),
(8, '09.016.307', 'Muhammad Fikri Hidayatullah, S.T., M.Kom', 'Dosen Tetap', 'Asisten Ahli', 'S1 - Universitas Ahmad Dahlan / S2 - Universitas Dian Nuswantoro', '1584161419.jpeg', '2020-03-13 21:50:19', '2020-07-06 13:37:43'),
(9, '03.017.328', 'M. Yoka Fathoni, M.Kom', 'Dosen Tetap', 'Tenaga Pengajar', 'S1-Univ. Muhammadiyah Bengkulu / S2-Universitas Diponegoro', '1584161486.jpeg', '2020-03-13 21:51:26', '2020-07-06 13:38:44'),
(10, '09.017.337', 'M. Nishom, M.Kom', 'Dosen Tetap', 'Asisten Ahli', 'S1 Universitas PGRI Ronggolawe / S2 Universitas Diponegoro', '1584161532.jpeg', '2020-03-13 21:52:12', '2020-07-06 13:37:36'),
(11, '02.018.364', 'Rona Nisa Sofia Amriza, S.Kom., M.T.I., ', 'Dosen Tetap', 'Tenaga Pengajar', 'S1-UIN Syarif Hidayatullah/S2-Univ Indonesia & National Taiwan University of Science and Technology', '1584161592.jpeg', '2020-03-13 21:53:12', '2020-07-06 13:37:59'),
(12, '06.014.184', 'Taufiq Abidin, S.Pd., M.Kom', 'Dosen Tetap', 'Asisten Ahli', 'S1-IKIP PGRI Semarang / S2-Univ. Dian Nuswantoro', '1584161629.jpeg', '2020-03-13 21:53:49', '2020-07-06 13:38:26'),
(13, '12.018.392', 'Sena Wijayanto, S.Pd., M.T', 'Dosen Tetap', 'Tenaga Pengajar', 'S1 UNNES / S2 ITB', '1584161666.jpeg', '2020-03-13 21:54:26', '2020-07-06 13:38:07'),
(14, '12.018.391', 'Nurul Renaningtias, S.T., M.Kom', 'Dosen Tetap', 'Tenaga Pengajar', 'S1 Univ. Bengkulu / S2 Univ. Diponegoro', '1584161715.jpeg', '2020-03-13 21:55:15', '2020-07-06 13:37:52'),
(15, '02.018.401', 'La Ode Mohamad Zulfiqar, S.T., M.Kom', 'Dosen Tetap', 'Tenaga Pengajar', 'S1 Associate Degree of Engineering Myongji College & UNISSULA / S2 Univ. Diponegoro', '1584161763.jpeg', '2020-03-13 21:56:04', '2020-07-06 13:37:31'),
(16, '02.020.438', 'Gusmira, S.Kom., M.Eng', 'Dosen Tetap', 'Tenaga Pengajar', 'S1-STMIK Atma Luhur / S2-Universitas Gadjah Mada', '1584161799.jpeg', '2020-03-13 21:56:39', '2020-07-06 13:37:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nipy` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nipy`, `nama`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, '10.007.032', 'Ginanjar Wiro Sasmito, M.Kom', 'ginanjar@gmail.com', NULL, '$2y$10$WTfKHfg5sNKWMCLjXQ9Jvuk76D/QG8veOQ9bRkn92EU0h2D30wgw.', NULL, '2020-03-13 21:37:20', '2020-08-01 06:35:13'),
(5, '04.014.178', 'Dairoh, M.Sc', 'dai@gmail.com', NULL, '$2y$10$8DpjkHwIf6wjF4Q8PjclZ.U', NULL, '2020-03-13 21:37:52', '2020-07-06 13:36:32'),
(6, '06.014.183', 'Dega Surono Wibowo, S.T., M.Kom', 'dega@gmail.com', NULL, '$2y$10$K94UHfhrkiGU.T2/o5zWa.Y', NULL, '2020-03-13 21:38:32', '2020-07-06 13:36:57'),
(7, '08.015.222', 'Slamet Wiyono, S.Pd., M.Eng', 'slamet@gmail.com', NULL, '$2y$10$ZLEEUZmJcs8JFFF1JOa2K.5', NULL, '2020-03-13 21:38:58', '2020-07-06 13:38:16'),
(8, '09.015.225', 'Dyah Apriliani, S.T., M.Kom', 'dyah@gmail.com', NULL, '$2y$10$VygftRZbiUBYPbUPnSFiMO/', NULL, '2020-03-13 21:39:18', '2020-07-06 13:37:13'),
(9, '09.016.307', 'Muhammad Fikri Hidayatullah, S.T., M.Kom', 'fikri@gmail.com', NULL, '$2y$10$oSf1hvs2T/9Gj2up9lMDr.C', NULL, '2020-03-13 21:39:35', '2020-07-06 13:37:43'),
(10, '03.017.328', 'M. Yoka Fathoni, M.Kom', 'yoka@gmail.com', NULL, '$2y$10$WHTV.D25ee1cLD/9tofQMe8', NULL, '2020-03-13 21:40:06', '2020-07-06 13:38:44'),
(11, '09.017.337', 'M. Nishom, M.Kom', 'nishom@gmail.com', NULL, '$2y$10$2tS7mu.rZXw1C0ThICgVO.p', NULL, '2020-03-13 21:40:43', '2020-07-06 13:37:36'),
(12, '02.018.364', 'Rona Nisa Sofia Amriza, S.Kom., M.T.I., ', 'rona@gmail.com', NULL, '$2y$10$pG8XumqXIDdm/vrP8/by9uq', NULL, '2020-03-13 21:41:05', '2020-07-28 10:45:56'),
(13, '06.014.184', 'Taufiq Abidin, S.Pd., M.Kom', 'taufiq@gmail.com', NULL, '$2y$10$/6FhLUoo..UZ6ziR3y6FL.n', NULL, '2020-03-13 21:41:17', '2020-07-06 13:38:27'),
(14, '12.018.392', 'Sena Wijayanto, S.Pd., M.T', 'sena@gmail.com', NULL, '$2y$10$xB3i2X.2BcyNma7DLinKRef', NULL, '2020-03-13 21:41:32', '2020-07-22 07:41:58'),
(15, '12.018.391', 'Nurul Renaningtias, S.T., M.Kom', 'nurul@gmail.com', NULL, '$2y$10$2UY5y0uc7k.wkBzHFaXIQOx', NULL, '2020-03-13 21:41:46', '2020-07-06 13:37:52'),
(16, '02.018.401', 'La Ode Mohamad Zulfiqar, S.T., M.Kom', 'laode@gmail.com', NULL, '$2y$10$2xULB7CXlzwhv12nhIqc3.R', NULL, '2020-03-13 21:42:00', '2020-07-06 13:37:31'),
(17, '02.020.438', 'Gusmira, S.Kom., M.Eng', 'gusmira@gmail.com', NULL, '$2y$10$.taiPCHbCAH2v6bWi16LVO8', NULL, '2020-03-13 21:42:14', '2020-07-06 13:37:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `validasiagenda`
--

CREATE TABLE `validasiagenda` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selesai` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`username`);

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pesertas`
--
ALTER TABLE `pesertas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `validasiagenda`
--
ALTER TABLE `validasiagenda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT untuk tabel `pesertas`
--
ALTER TABLE `pesertas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `validasiagenda`
--
ALTER TABLE `validasiagenda`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
