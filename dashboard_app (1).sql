-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2025 at 08:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashboard_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidangs`
--

CREATE TABLE `bidangs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidangs`
--

INSERT INTO `bidangs` (`id`, `nama_bidang`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'egov', NULL, NULL, NULL, NULL),
(2, 'itik', NULL, NULL, NULL, NULL),
(3, 'statistik', NULL, NULL, NULL, NULL),
(4, 'persandian', NULL, NULL, NULL, NULL),
(5, 'pikp\r\n', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-dc44958e29ffba8b810d21377ae366b5', 'i:2;', 1764315835),
('laravel-cache-dc44958e29ffba8b810d21377ae366b5:timer', 'i:1764315835;', 1764315835),
('laravel-cache-f7c06ef0dba29cf908c98d0f775e77e8', 'i:1;', 1764211983),
('laravel-cache-f7c06ef0dba29cf908c98d0f775e77e8:timer', 'i:1764211983;', 1764211983);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_fields`
--

CREATE TABLE `form_fields` (
  `id` bigint UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `options` text COLLATE utf8mb4_unicode_ci,
  `placeholder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`id`, `label`, `name`, `type`, `options`, `placeholder`, `required`, `active`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nama Pelapor', 'nama_warga', 'text', NULL, 'Masukkan nama lengkap Anda', 1, 1, 1, '2025-10-29 21:30:23', '2025-10-29 21:54:20', NULL),
(2, 'Email (Opsional)', 'email', 'email', NULL, 'Masukkan alamat email Anda (jika ada)', 0, 1, 2, '2025-10-29 21:30:23', '2025-10-29 21:30:23', NULL),
(3, 'Nomor Telepon / WA', 'no_hp', 'text', NULL, 'Contoh: 08123456789', 1, 1, 4, '2025-10-29 21:30:23', '2025-11-09 23:48:04', NULL),
(5, 'Judul Pengaduan', 'judul_pengaduan', 'text', NULL, 'Tuliskan judul singkat pengaduan Anda', 1, 1, 6, '2025-10-29 21:30:23', '2025-11-19 19:49:53', NULL),
(6, 'Isi Laporan / Keluhan', 'isi_laporan', 'textarea', NULL, 'Jelaskan secara rinci pengaduan Anda', 1, 1, 7, '2025-10-29 21:30:23', '2025-11-19 19:50:00', NULL),
(7, 'Lampiran Bukti (Opsional)', 'lampiran', 'file', NULL, '', 0, 1, 8, '2025-10-29 21:30:23', '2025-11-23 23:23:51', NULL),
(8, 'Lokasi Kejadian', 'lokasi_kejadian', 'text', NULL, 'Contoh : Jalan Tuparev No. 45, Cirebon', 1, 1, 5, '2025-10-29 21:46:11', '2025-11-19 19:49:47', NULL),
(9, 'Kategori Masalah', 'kategori', 'select', '[\"E-Government\",\"Data & Statistik\",\"Infrastruktur Digital\",\"Informasi Publik\",\"Layanan Aplikasi\"]', NULL, 1, 1, 3, '2025-11-09 23:45:21', '2025-11-09 23:48:10', NULL),
(15, 'Contoh', 'contoh', 'text', NULL, 'contoh', 1, 1, 9, '2025-11-25 22:05:18', '2025-11-25 22:07:56', '2025-11-25 22:07:56'),
(16, 'contoh select', 'contoh_select', 'select', '[\"\"]', 'contoh select', 0, 1, 10, '2025-11-25 22:06:58', '2025-11-25 22:07:54', '2025-11-25 22:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_09_093511_add_two_factor_columns_to_users_table', 1),
(5, '2025_10_09_093554_create_personal_access_tokens_table', 1),
(6, '2025_10_09_094232_create_permission_tables', 1),
(7, '2025_10_09_110135_create_wargas_table', 1),
(8, '2025_10_10_013117_add_is_admin_to_users_table', 1),
(9, '2025_10_10_064641_create_pengaduans_table', 1),
(10, '2025_10_17_023524_create_bidangs_table', 1),
(11, '2025_10_17_034333_add_role_and_bidang_to_users_table', 1),
(14, '2025_10_18_202452_add_bidang_tujuan_to_pengaduans_table', 2),
(15, '2025_10_20_022736_add_balasan_to_pengaduans_table', 3),
(16, '2025_10_23_093515_update_pengaduans_table_for_dkis', 4),
(17, '2025_10_30_024649_create_form_fields_table', 5),
(18, '2025_10_30_041832_add_options_to_form_fields_table', 6),
(19, '2025_10_30_044836_add_lokasi_kejadian_to_pengaduans_table', 7),
(20, '2025_11_20_014447_add_soft_deletes_to_pengaduans_table', 8),
(21, '2025_11_20_022354_add_deleted_at_to_bidangs_table', 9),
(22, '2025_11_20_023144_add_soft_deletes_to_form_fields_table', 10),
(23, '2025_11_21_060206_add_softdeletes_to_users_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 10),
(4, 'App\\Models\\User', 22);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduans`
--

CREATE TABLE `pengaduans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_warga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_kejadian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bidang_tujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi_laporan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `balasan` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu',
  `tanggapan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggapan_admin` text COLLATE utf8mb4_unicode_ci,
  `tanggapan_bidang` text COLLATE utf8mb4_unicode_ci,
  `tanggal_disposisi` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaduans`
--

INSERT INTO `pengaduans` (`id`, `nama_warga`, `email`, `kategori`, `lokasi_kejadian`, `bidang_tujuan`, `isi_laporan`, `balasan`, `status`, `tanggapan`, `created_at`, `updated_at`, `lampiran`, `tanggapan_admin`, `tanggapan_bidang`, `tanggal_disposisi`, `tanggal_selesai`, `deleted_at`) VALUES
(19, 'Rifki ', 'rafirustandi12@gmail.com', 'Data & Statistik', NULL, 'statistik', 'statistik percobaan !!', 'kerjakan', 'Selesai', NULL, '2025-10-23 04:13:45', '2025-11-23 23:19:39', NULL, NULL, 'oke admin !', NULL, '2025-10-23 11:19:44', NULL),
(20, 'Bellen ', 'rafirustandi12@gmail.com', 'Keamanan Informasi & Persandian', NULL, 'persandian', 'Persandian Percobaan !!', NULL, 'Selesai', NULL, '2025-10-23 04:16:38', '2025-10-23 04:20:45', NULL, NULL, 'oke admin thanks u !!', NULL, '2025-10-23 11:20:42', NULL),
(21, 'shinsoohyun', 'rafirustandi12@gmail.com', 'Publikasi & Informasi Publik (PIKP)', NULL, 'pikp', 'PIKP Percobaan gesss!!!', NULL, 'Selesai', NULL, '2025-10-23 04:18:12', '2025-10-23 04:21:37', NULL, NULL, 'oke admin thank u dari Bidang PIKP !!', NULL, '2025-10-23 11:21:34', NULL),
(23, 'yanto smackdown', 'rafirustandi12@gmail.com', 'Layanan Jaringan', NULL, 'ITIK', 'eror koneksi server atau internet ini tolong ditindaklanjuti !!', 'woi itik benerin nih', 'Selesai', NULL, '2025-10-26 23:19:12', '2025-10-26 23:27:57', NULL, NULL, 'oke bwang siapppp!!', NULL, '2025-10-27 06:27:54', NULL),
(24, 'contoh bree', 'rafirustandi12@gmail.com', 'Layanan Data & Statistik', NULL, 'Statistik', 'contoh mase', 'contoh', 'Selesai', NULL, '2025-10-26 23:45:19', '2025-10-30 01:35:35', NULL, NULL, 'baik segera! terima kasih admin', NULL, '2025-10-30 08:35:20', NULL),
(25, 'midoriyu', 'rafirustandi12@gmail.com', 'E-Government', NULL, 'egov', 'contoh contoh contoh !!!', 'teruskan ke bidang e-goverment contoh!!!!', 'Selesai', NULL, '2025-10-29 21:57:20', '2025-10-31 00:06:14', NULL, NULL, 'siap', NULL, '2025-10-31 07:06:14', NULL),
(26, 'contoh itik', 'rafirustandi12@gmail.com', 'Infrastruktur Digital', NULL, 'itik', 'ITIK CONTOH', 'itik contoh kerjakan', 'Selesai', NULL, '2025-10-30 01:38:41', '2025-10-30 23:45:59', NULL, NULL, 'wokeee admin', NULL, '2025-10-31 06:45:59', NULL),
(27, 'darsono r', 'rafirustandi12@gmail.com', 'E-Government', NULL, 'egov', 'contoh erorrrrr!!!!!', 'bereskan contoh!!', 'Selesai', NULL, '2025-10-30 23:44:12', '2025-10-31 00:42:19', NULL, NULL, 'siap\n', NULL, '2025-10-31 07:06:08', NULL),
(28, 'cimot', 'rafirustandi12@gmail.com', 'E-Government', NULL, 'egov', 'erorrr dll', 'tolong selesaikan', 'Selesai', NULL, '2025-11-09 23:42:06', '2025-11-09 23:43:39', NULL, NULL, 'okeii aman', NULL, '2025-11-10 06:43:39', NULL),
(29, 'asep', 'rafirustandi12@gmail.com', 'E-Government', NULL, 'egov', 'erorrr contohh', 'kerjakan!', 'Selesai', NULL, '2025-11-10 00:39:36', '2025-11-10 01:27:26', NULL, NULL, 'oke siap!', NULL, '2025-11-10 08:20:15', NULL),
(30, 'All Mighty', 'junglestok66@gmail.com', 'Informasi Publik', NULL, 'pikp', 'bla bla bla bla bla bla', 'bereskan!', 'Selesai', NULL, '2025-11-16 20:34:10', '2025-11-16 20:45:46', NULL, NULL, 'oke baik terima kasih', NULL, '2025-11-17 03:45:46', NULL),
(31, 'agung', 'junglestok66@gmail.com', 'E-Government', NULL, 'egov', 'contoh!!!!!!!!!!!!!!', 'tolong tindak lanjuti!', 'Selesai', NULL, '2025-11-17 00:32:43', '2025-11-17 17:32:19', NULL, NULL, 'okei', NULL, '2025-11-17 08:41:19', NULL),
(32, 'hasan', 'junglestok66@gmail.com', 'Data & Statistik', NULL, 'statistik', 'Data Dan Statistik Contoh Kasus Eror', 'tolong tindak lanjuti untuk kasus pengaduan ini', 'Selesai', NULL, '2025-11-19 18:30:14', '2025-11-20 23:55:25', NULL, NULL, 'okei', NULL, '2025-11-21 06:55:25', NULL),
(33, 'rafi', 'rafirustandi12@gmail.com', 'E-Government', NULL, 'egov', 'contohhhh', 'okkkk', 'Selesai', NULL, '2025-11-23 23:14:31', '2025-11-23 23:31:54', NULL, NULL, 'baik admin', NULL, '2025-11-24 06:31:54', NULL),
(34, 'Budi', 'rafirustandi12@gmail.com', 'E-Government', NULL, 'egov', 'contohhhhhhhh', 'contoh ', 'Diteruskan ke Bidang', NULL, '2025-11-24 23:35:55', '2025-11-24 23:36:22', NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Basit', 'rafirustandi12@gmail.com', 'Data & Statistik', NULL, 'itik', 'Pengaduan Contoh', 'ok', 'Selesai', NULL, '2025-11-24 23:46:40', '2025-11-26 19:17:23', NULL, NULL, 'baik ', NULL, '2025-11-27 02:17:23', NULL),
(36, 'Raden Hassan Rafi', 'rafirustandi12@gmail.com', 'E-Government', NULL, 'egov', 'contoh laporan', 'contoh', 'Diteruskan ke Bidang', NULL, '2025-11-25 21:00:34', '2025-11-25 21:01:01', NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Raden Hasan ', 'rafirustandi12@gmail.com', 'E-Government', NULL, 'egov', 'Contoh Kasus', 'oke', 'Selesai', NULL, '2025-11-25 21:57:35', '2025-11-25 22:02:08', NULL, NULL, 'oke', NULL, '2025-11-26 05:02:08', NULL),
(38, 'example', 'rafirustandi12@gmail.com', 'Data & Statistik', NULL, 'itik', 'ini adalah contoh untuk test project aplikasi saya,contoh contoh contoh contoh contoh contoh', 'example', 'Selesai', NULL, '2025-11-26 19:06:55', '2025-11-26 19:16:05', NULL, NULL, 'okaiii', NULL, '2025-11-27 02:16:05', NULL),
(39, 'example two', 'rafirustandi12@gmail.com', 'Data & Statistik', NULL, 'itik', 'exampleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 'example', 'Selesai', NULL, '2025-11-26 19:21:30', '2025-11-26 19:24:29', NULL, NULL, 'siap', NULL, '2025-11-27 02:24:29', NULL),
(40, 'Exmple 3', 'rafirustandi12@gmail.com', 'Data & Statistik', NULL, 'itik', 'example 3', 'example', 'Selesai', NULL, '2025-11-26 19:36:52', '2025-11-26 19:39:38', NULL, NULL, 'Terima Kasih atas pengaduannya:\nsaya serta yang menangani pengaduan anda akan saya tindak lanjuti terima kasih', NULL, '2025-11-27 02:39:38', NULL),
(41, 'example 04', 'rafirustandi12@gmail.com', 'Data & Statistik', NULL, 'itik', 'Example Four', 'exampe 4', 'Selesai', NULL, '2025-11-26 19:46:50', '2025-11-26 19:53:48', NULL, NULL, 'wakata', NULL, '2025-11-27 02:53:48', NULL),
(42, 'example five', 'rafirustandi12@gmail.com', 'Data & Statistik', NULL, 'itik', 'example - five', 'kerjakan bidang', 'Selesai', NULL, '2025-11-26 19:51:00', '2025-11-26 19:53:16', NULL, NULL, 'wakata. Terima Kasih untuk example 05, saya berlaku yang menangani laporan pengaduan anda akan saya tindak lanjuti', NULL, '2025-11-27 02:53:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-10-18 06:01:21', '2025-10-18 06:01:21'),
(2, 'bidang', 'web', '2025-10-18 06:01:21', '2025-10-18 06:01:21'),
(3, 'warga', 'web', '2025-10-18 06:01:21', '2025-10-18 06:01:21'),
(4, 'user', 'web', '2025-10-18 06:01:24', '2025-10-18 06:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ECrJGdgVCCYhFKWemfWEBCtEUG8LTKsvouFMVNUV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDdoTXJHYUJZRkpDandVc3BBMThLNExjeHhvbGgwbU1md1E5VG9CbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9kYXNoYm9hcmQtYXBwLnRlc3Q6ODA4MC9sb2dpbiI7fX0=', 1764213673),
('mOk8x3RsQTfxwHKQr4kRxdoTCWlG54Jb7FqTm6Xg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2pvVm15OWo0bTloQmhpcjZ6N2dFZzZ0ZFZTMjJ5S3ZOdmcwNVBvOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9kYXNoYm9hcmQtYXBwLnRlc3Q6ODA4MC9sb2dpbiI7fX0=', 1764318080);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `bidang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `email_verified_at`, `password`, `role`, `bidang`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'admin@example.com', 0, NULL, '$2y$12$0A9I0J/simSXZ3YwMjgkRO0b09POLqib.arI/9iGFnvrK2C940B3G', 'admin', NULL, NULL, NULL, NULL, 'KYwyLOLFeQtfC3NLn1UmCHgzrWmRRBHyU64FFu1YJpyY8w3ONEJRkC2obezw', NULL, 'profile-photos/ryKZJqfT3ABhVDckj4jorpasdPGRMOyij5kOpnyz.jpg', '2025-10-18 06:01:21', '2025-11-25 00:54:40', NULL),
(4, 'ITIK 1', 'itik1@example.com', 0, NULL, '$2y$12$0ir1xDE9iMe8ur/2XLju/uvuu0PI/qV3D3RYJC/MsRy5aKAhhRj16', 'bidang', 'itik', NULL, NULL, NULL, '8MLJvnSy6JdFH2JvJnvb34uURtqjsDsGM0WBbyo4EpjY0RwNjOtuPvXSiIpR', NULL, NULL, '2025-10-18 06:01:22', '2025-11-17 00:58:29', NULL),
(6, 'Statistik 1', 'statistik1@example.com', 0, NULL, '$2y$12$IPF6SqcVit.wfZ3yonw8Her.s/AZqbbNWz.z9LQVElQw.4zwutfzu', 'bidang', 'statistik', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-18 06:01:23', '2025-11-16 20:44:24', NULL),
(8, 'Persandian 1', 'persandian1@example.com', 0, NULL, '$2y$12$ldT6X3hZV6D0wKPT6moHMOgiLfOM1SARTBy276jDj.uhoOHhZdlkO', 'bidang', 'persandian', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-18 06:01:23', '2025-11-16 23:29:45', NULL),
(10, 'PIKP 1', 'pikp1@example.com', 0, NULL, '$2y$12$PXNzM/NK9opWt3uUnIx23uBeby0mUudnjiaOyaaEctVKNv0UdpWpi', 'bidang', 'pikp', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-18 06:01:24', '2025-11-16 20:44:35', NULL),
(22, 'Warga Umum', 'user@example.com', 0, NULL, '$2y$12$lUgpqYY0/P2JF11lP2sG7.LHzA6OdIGhgOqdgx0h8s2WKgqxXsc7O', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-18 06:01:28', '2025-10-19 02:52:00', NULL),
(39, 'egov', 'egov@example.com', 0, NULL, '$2y$12$qme7mi64ukgGmeErgoTpKuxdDKXmgmKL.lBMaJamXk0BmTPUgzDFG', 'bidang', 'egov', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-30 19:59:56', '2025-10-30 19:59:56', NULL),
(42, 'rafi', 'rafi@example.go.id', 0, NULL, '$2y$12$znAfrKvqwnPGgMRAMO8P5e6e6/vVi0yawfYxvYyJ4GnTg5W4nRXG6', 'bidang', 'egov', NULL, NULL, NULL, 'a8Su9gqqpQfzpCHp0YSjMdrc0I3l1E6jjw8LekEt5hoesHnxeFf1ybzxxVif', NULL, NULL, '2025-11-10 01:18:32', '2025-11-10 01:18:59', NULL),
(44, 'graciemots', 'RadenHassan12@gmail.com', 0, NULL, '$2y$12$ORiNnkBlyVPkJ303Wk/k7e6FFj7HLpEahqIt4QkXyzujz5IoNPrZi', 'bidang', 'statistik', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 23:54:45', '2025-11-23 23:18:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wargas`
--

CREATE TABLE `wargas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidangs`
--
ALTER TABLE `bidangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bidangs_nama_bidang_unique` (`nama_bidang`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- Indexes for table `wargas`
--
ALTER TABLE `wargas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wargas_nik_unique` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidangs`
--
ALTER TABLE `bidangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_fields`
--
ALTER TABLE `form_fields`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pengaduans`
--
ALTER TABLE `pengaduans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `wargas`
--
ALTER TABLE `wargas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
