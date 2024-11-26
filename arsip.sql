-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 09:55 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda_kegiatans`
--

CREATE TABLE `agenda_kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tpk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `pola_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flyer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `materi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumentasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `panduan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pulsa` tinyint(1) DEFAULT NULL,
  `rekening` tinyint(1) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agenda_kegiatans`
--

INSERT INTO `agenda_kegiatans` (`id`, `nama_kegiatan`, `tpk`, `tanggal_mulai`, `tanggal_selesai`, `pola_kegiatan`, `flyer`, `materi`, `dokumentasi`, `panduan`, `jenis_kegiatan`, `kode_kegiatan`, `pulsa`, `rekening`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'Advokasi Pemberdayaan Sekolah Penggerak PSP Menjadi Penggerak Komunitas Belajar PSP-UPT1', 'BPMP Provinsi NTB', '2024-11-11', '2024-11-12', '32JP', 'Reviu_Konten_Program_Prioritas_Tahun_2024_(Header_Google_Classroom).jpg', '#', '#', '#', 'Workshop', '1231231231', 0, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `biodata`
-- (See below for the actual view)
--
CREATE TABLE `biodata` (
`id_anggota` bigint(20) unsigned
,`nama` varchar(255)
,`nip` bigint(20)
,`email` varchar(255)
,`jenis_kelamin` varchar(255)
,`tempat_lahir` varchar(255)
,`tanggal_lahir` date
,`nama_instansi` varchar(255)
,`jabatan` varchar(255)
,`pangkat_golongan` varchar(255)
,`pendidikan_terakhir` varchar(255)
,`no_hp` varchar(255)
,`provider` varchar(255)
,`agama` varchar(255)
,`kabupaten_kota` varchar(255)
,`nomor_rekening` varchar(255)
,`nama_bank` varchar(255)
,`tanda_tangan_path` varchar(255)
,`id_kegiatan` bigint(20) unsigned
,`nama_kegiatan` varchar(255)
,`tpk` varchar(255)
,`tanggal_mulai` date
,`tanggal_selesai` date
,`pola_kegiatan` varchar(255)
,`flyer` varchar(255)
,`materi` varchar(255)
,`dokumentasi` varchar(255)
,`panduan` varchar(255)
,`jenis_kegiatan` varchar(255)
,`kode_kegiatan` varchar(255)
,`id_user` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `bio_data`
--

CREATE TABLE `bio_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bio_data`
--

INSERT INTO `bio_data` (`id`, `id_user`, `id_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-11-14 22:01:04', '2024-11-14 22:01:04'),
(2, 3, 1, '2024-11-14 22:16:37', '2024-11-14 22:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `data_sertifikats`
--

CREATE TABLE `data_sertifikats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_biodata` int(11) NOT NULL,
  `nomor_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_ttd` date NOT NULL,
  `id_penanggungjawab` int(11) NOT NULL,
  `id_kepala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_datas`
--

CREATE TABLE `form_datas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten_kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_rekening` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanda_tangan_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_datas`
--

INSERT INTO `form_datas` (`id`, `nama`, `nip`, `email`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `nama_instansi`, `jabatan`, `pangkat_golongan`, `pendidikan_terakhir`, `no_hp`, `provider`, `agama`, `kabupaten_kota`, `nomor_rekening`, `nama_bank`, `tanda_tangan_path`, `created_at`, `updated_at`) VALUES
(1, 'wahyu ramdhaniasasa', 2342342342, 'wahyuramdhani.tssi@gmail.com', 'Laki-laki', 'Lombok Timur', '2024-11-13', 'asds', 'PPNPN', 'Juru Muda / Ia', 'SMA/SMK', '08786697725022', NULL, 'Islam', 'Kota Bima', NULL, NULL, 'signatures/signature_1731650464_6736e3a02f60b.png', '2024-11-14 22:01:04', '2024-11-14 22:01:04'),
(3, 'wahyu ramdhaniasasa', 2342342342, 'wahyuramdhani.tssi@gmail.com', 'Laki-laki', 'Lombok Timur', '2024-11-13', 'asds', 'PPNPN', 'Juru Muda / Ia', 'SMA/SMK', '08786697725022', NULL, 'Islam', 'Kota Bima', NULL, NULL, 'signatures/signature_1731651397_6736e7452ebfc.png', '2024-11-14 22:16:37', '2024-11-14 22:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_11_14_070941_create_sessions_table', 1),
(7, '2024_09_30_064859_create_form_data_table', 2),
(8, '2024_11_10_012208_create_agenda_kegiatans_table', 2),
(9, '2024_11_12_061154_create_bio_data_table', 2),
(10, '2024_11_12_062210_create_data_sertifikats_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Qg3BBmSMlYJBq1Q9c5Z34mZt5gErbhP6y0y9Wibw', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMURXVmYxWlZGV1MyWkxoZkNucVBVS3QzbVR3ekxPTkdiU0p5OG1EbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ob21lL2tlZ2lhdGFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyYSQxMiR5aGdSWWtTQWcxSU5GalBVZEY1eXZPQjI2TUcuLjJmNnRobUIwV2RocWpELk94NERWcG1paSI7fQ==', 1732609832);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'wahyu ramdhani', 'wahyuramdhani.ti@gmail.com', NULL, '$2a$12$yhgRYkSAg1INFjPUdF5yvOB26MG..2f6thmB0WdhqjD.Ox4DVpmii', NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 23:25:31', '2024-11-13 23:25:31');

-- --------------------------------------------------------

--
-- Structure for view `biodata`
--
DROP TABLE IF EXISTS `biodata`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `biodata`  AS SELECT `form_datas`.`id` AS `id_anggota`, `form_datas`.`nama` AS `nama`, `form_datas`.`nip` AS `nip`, `form_datas`.`email` AS `email`, `form_datas`.`jenis_kelamin` AS `jenis_kelamin`, `form_datas`.`tempat_lahir` AS `tempat_lahir`, `form_datas`.`tanggal_lahir` AS `tanggal_lahir`, `form_datas`.`nama_instansi` AS `nama_instansi`, `form_datas`.`jabatan` AS `jabatan`, `form_datas`.`pangkat_golongan` AS `pangkat_golongan`, `form_datas`.`pendidikan_terakhir` AS `pendidikan_terakhir`, `form_datas`.`no_hp` AS `no_hp`, `form_datas`.`provider` AS `provider`, `form_datas`.`agama` AS `agama`, `form_datas`.`kabupaten_kota` AS `kabupaten_kota`, `form_datas`.`nomor_rekening` AS `nomor_rekening`, `form_datas`.`nama_bank` AS `nama_bank`, `form_datas`.`tanda_tangan_path` AS `tanda_tangan_path`, `agenda_kegiatans`.`id` AS `id_kegiatan`, `agenda_kegiatans`.`nama_kegiatan` AS `nama_kegiatan`, `agenda_kegiatans`.`tpk` AS `tpk`, `agenda_kegiatans`.`tanggal_mulai` AS `tanggal_mulai`, `agenda_kegiatans`.`tanggal_selesai` AS `tanggal_selesai`, `agenda_kegiatans`.`pola_kegiatan` AS `pola_kegiatan`, `agenda_kegiatans`.`flyer` AS `flyer`, `agenda_kegiatans`.`materi` AS `materi`, `agenda_kegiatans`.`dokumentasi` AS `dokumentasi`, `agenda_kegiatans`.`panduan` AS `panduan`, `agenda_kegiatans`.`jenis_kegiatan` AS `jenis_kegiatan`, `agenda_kegiatans`.`kode_kegiatan` AS `kode_kegiatan`, `agenda_kegiatans`.`id_user` AS `id_user` FROM ((`form_datas` join `bio_data` on(`form_datas`.`id` = `bio_data`.`id_user`)) join `agenda_kegiatans` on(`agenda_kegiatans`.`id` = `bio_data`.`id_kegiatan`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda_kegiatans`
--
ALTER TABLE `agenda_kegiatans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agenda_kegiatans_kode_kegiatan_unique` (`kode_kegiatan`);

--
-- Indexes for table `bio_data`
--
ALTER TABLE `bio_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_sertifikats`
--
ALTER TABLE `data_sertifikats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `form_datas`
--
ALTER TABLE `form_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda_kegiatans`
--
ALTER TABLE `agenda_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bio_data`
--
ALTER TABLE `bio_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_sertifikats`
--
ALTER TABLE `data_sertifikats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_datas`
--
ALTER TABLE `form_datas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
