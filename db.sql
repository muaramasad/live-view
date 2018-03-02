-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.19-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk cctv
USE `cctv_app_ver_1_0`;

-- membuang struktur untuk table cctv.areas
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `province_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `areas_division_id_index` (`division_id`),
  KEY `areas_province_id_index` (`province_id`),
  CONSTRAINT `areas_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`),
  CONSTRAINT `areas_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.areas: ~6 rows (lebih kurang)
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` (`id`, `area_name`, `division_id`, `created_at`, `updated_at`, `province_id`) VALUES
	(1, 'Area Barat', 1, '2018-01-22 08:32:47', '2018-01-24 06:04:36', 13),
	(2, 'Area Timur 1', 1, '2018-01-22 09:07:41', '2018-01-24 06:04:20', 16),
	(3, 'Area Timur 2', 1, '2018-01-22 09:36:16', '2018-01-24 06:05:09', 26),
	(4, 'Area Sumatera 1', 1, '2018-01-22 09:36:36', '2018-01-24 06:05:26', 9),
	(5, 'Area Sumatera 2', 1, '2018-01-24 06:05:49', '2018-01-24 06:05:49', 2),
	(6, 'Jawa Timur', 9, '2018-02-22 07:19:36', '2018-02-22 07:19:36', 16);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;

-- membuang struktur untuk table cctv.cams
CREATE TABLE IF NOT EXISTS `cams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cam_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cam_ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cam_file_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cam_cor_x` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cam_cor_y` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cams_site_id_index` (`site_id`),
  CONSTRAINT `cams_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.cams: ~26 rows (lebih kurang)
/*!40000 ALTER TABLE `cams` DISABLE KEYS */;
INSERT INTO `cams` (`id`, `cam_name`, `cam_ip_address`, `cam_file_path`, `cam_cor_x`, `cam_cor_y`, `site_id`, `created_at`, `updated_at`) VALUES
	(1, 'Kandang 1', '10.21.114.113', NULL, '-6.641529651910427', '107.53098202299498', 5, '2018-01-25 04:02:19', '2018-01-25 04:02:19'),
	(4, 'Pintu Gerbang Utama', '', NULL, '-6.4748870913124685', '107.88931725899965', 2, '2018-01-25 04:15:00', '2018-01-25 04:15:00'),
	(23, 'Gerbang Masuk dan Fumigasi', '10.21.113.111', NULL, '-6.627180169239517', '107.55596716853643', 1, '2018-02-21 04:27:08', '2018-02-21 07:05:46'),
	(24, 'Cardip 1 & Fumigasi 2', '10.21.113.112', NULL, '-6.6271828335263585', '107.55585988017583', 1, '2018-02-21 04:28:34', '2018-02-21 07:06:04'),
	(25, 'Pintu Masuk & Pengambilan Fumigasi 1', '10.21.113.113', NULL, '-6.627268090697466', '107.55582232924962', 1, '2018-02-21 04:31:59', '2018-02-21 07:06:21'),
	(26, 'Pintu Masuk Shower 1', '10.21.113.114', NULL, '-6.627481233560734', '107.55563457461858', 1, '2018-02-21 04:40:53', '2018-02-21 07:06:34'),
	(27, 'Pengambilan Fumigasi 2', '10.21.113.115', NULL, '-6.627193490673549', '107.55566139670873', 1, '2018-02-21 04:41:41', '2018-02-21 07:06:53'),
	(28, 'Pintu Keluar Shower 1', '10.21.113.116', NULL, '-6.627246776406077', '107.55557560792977', 1, '2018-02-21 04:43:18', '2018-02-21 07:07:07'),
	(29, 'Cardip 1 & Bak Celup 2', '10.21.113.117', NULL, '-6.627265426411084', '107.55542804452443', 1, '2018-02-21 05:57:31', '2018-02-21 07:07:19'),
	(30, 'Fumigasi 3 & Masuk Shower 2', '10.21.113.118', NULL, '-6.62784357621687', '107.55437393638158', 1, '2018-02-21 05:59:02', '2018-02-21 07:07:32'),
	(31, 'Cardip 2 & Bak Celup', '10.21.113.119', NULL, '-6.627832919083726', '107.55426664802098', 1, '2018-02-21 06:01:46', '2018-02-21 07:07:44'),
	(32, 'Gudang MT', '10.21.113.120', NULL, '-6.62784357621687', '107.55406816455388', 1, '2018-02-21 06:05:28', '2018-02-21 07:07:57'),
	(33, 'Cardip & Pengambilan Fumigasi 3', '10.21.113.121', NULL, '-6.62768904776373', '107.55426664802098', 1, '2018-02-21 06:06:29', '2018-02-21 07:08:10'),
	(34, 'Pintu Keluar Shower 2', '10.21.113.122', NULL, '-6.627630433510213', '107.55433102103734', 1, '2018-02-21 06:07:52', '2018-02-21 07:08:22'),
	(35, 'Gudang Serut', '10.21.113.123', NULL, '-6.6277849619817255', '107.55552728625798', 1, '2018-02-21 06:09:17', '2018-02-21 07:08:33'),
	(36, 'Fumigasi Telur', '10.21.113.124', NULL, '-6.62720414782051', '107.55429883452916', 1, '2018-02-21 06:10:04', '2018-02-21 07:08:45'),
	(37, 'Fumigasi Kandang & Pintu Masuk Shower Kandang', '10.21.113.125', NULL, '-6.627177504952675', '107.55423982593084', 1, '2018-02-21 06:10:43', '2018-02-21 07:08:56'),
	(38, 'Fumigasi Telur', '10.21.113.126', NULL, '-6.626836476117182', '107.55419154616857', 1, '2018-02-21 06:12:06', '2018-02-21 07:09:09'),
	(39, 'Pintu Masuk Shower Kandang & Fumigasi', '10.21.113.127', NULL, '-6.626761876027974', '107.55416472407842', 1, '2018-02-21 06:13:22', '2018-02-21 07:09:21'),
	(40, 'Fumigasi Telur', '10.21.113.128', NULL, '-6.6266819473484535', '107.55414863082433', 1, '2018-02-21 06:13:56', '2018-02-21 07:09:33'),
	(41, 'Fumigasi Telur', '10.21.113.129', NULL, '-6.626431504068725', '107.55410571548009', 1, '2018-02-21 06:14:50', '2018-02-21 07:09:52'),
	(42, 'Pintu Masuk Shower Kandang & Fumigasi', '10.21.113.130', NULL, '-6.626340918170275', '107.55407889338994', 1, '2018-02-21 06:15:44', '2018-02-21 07:10:04'),
	(43, 'Fumigasi Telur', '10.21.113.131', NULL, '-6.626276975173118', '107.55405743571782', 1, '2018-02-21 06:16:52', '2018-02-21 07:10:17'),
	(44, 'Fumigasi Telur', '10.21.113.132', NULL, '-6.625941274302016', '107.55397160502935', 1, '2018-02-21 06:20:55', '2018-02-21 07:10:31'),
	(45, 'Pintu Masuk Shower Kandang & Fumigasi', '10.21.113.133', NULL, '-6.625893317016065', '107.55395551177526', 1, '2018-02-21 06:21:19', '2018-02-21 07:10:42'),
	(46, 'Fumigasi Telur', '10.21.113.134', NULL, '-6.6258400311373205', '107.55393941852117', 1, '2018-02-21 06:21:44', '2018-02-21 07:10:53');
/*!40000 ALTER TABLE `cams` ENABLE KEYS */;

-- membuang struktur untuk table cctv.divisions
CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `division_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.divisions: ~6 rows (lebih kurang)
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` (`id`, `division_name`, `icon_path`, `created_at`, `updated_at`, `category`) VALUES
	(1, 'Breeding', 'public/thumbnails/zCSfc2pxWazQuZN2p3Di9HGVdweb1RgHs9dZQcb0.jpeg', '2018-01-22 08:25:24', '2018-02-22 06:51:45', 'poultry'),
	(2, 'Feed', 'public/thumbnails/JNktM8IPYDpAWOs1fkIjRfN3mAgWA93fNgjPzkUb.jpeg', '2018-02-02 03:03:25', '2018-02-22 06:52:49', 'poultry'),
	(3, 'Disease Prevention', 'public/thumbnails/y7235WRl2NDrI7TZ1vM74Ib0QaOfF1o0g4GqmzOd.jpeg', '2018-02-02 03:03:59', '2018-02-22 06:53:55', 'poultry'),
	(4, 'Processed Chicken', 'public/thumbnails/OIRWQ5JGacq6KTea8KgzR3fVLmMKXXU3pSycqb7V.jpeg', '2018-02-08 07:25:51', '2018-02-22 06:55:08', 'poultry'),
	(5, 'Commercial Live Broilers Bird', 'public/thumbnails/Atts5jkSHf74bkpiN19Tk2MM0AhH2mtV03SNLkud.jpeg', '2018-02-08 07:26:25', '2018-02-22 06:54:39', 'poultry'),
	(9, 'Dairy', 'public/thumbnails/jzeDJXV6uvqhY7Yov4n0KEQp8fCgAYuZN0xrMt2w.jpeg', '2018-02-22 07:06:44', '2018-02-22 07:09:01', 'beef cattle');
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;

-- membuang struktur untuk table cctv.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.migrations: ~14 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(27, '2014_10_12_000000_create_users_table', 1),
	(28, '2014_10_12_100000_create_password_resets_table', 1),
	(29, '2018_01_15_020525_create_table_areas', 1),
	(30, '2018_01_15_020731_create_table_divisions', 1),
	(31, '2018_01_15_020852_create_table_sites', 1),
	(32, '2018_01_15_022513_alter_table_add_foreign_areas_and_sites', 1),
	(33, '2018_01_15_041402_alter_table_add_division_id_on_sites_table', 1),
	(34, '2018_01_15_064629_alter_table_add_foreign_division_to_sites_table', 1),
	(35, '2018_01_22_042205_create_provinces_table', 1),
	(36, '2018_01_22_081948_alter_areas_table_add_province_id', 1),
	(38, '2018_01_24_030740_create_table_cams', 2),
	(39, '2018_02_08_084349_add_column_category_to_divisions', 3),
	(45, '2018_02_28_031244_laratrust_setup_tables', 4),
	(48, '2018_02_28_040452_create_user-division_user-area_user-site_table', 5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- membuang struktur untuk table cctv.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.password_resets: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- membuang struktur untuk table cctv.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.permissions: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'user-create', 'Create User', 'Create New User', '2018-02-28 08:51:02', '2018-02-28 09:16:54'),
	(2, 'user-update', 'Update User', 'Update  User Information', '2018-02-28 09:02:17', '2018-02-28 09:02:17'),
	(3, 'user-list', 'Display User Listing', 'List All Users', '2018-02-28 09:03:17', '2018-02-28 09:03:17'),
	(4, 'user-delete', 'Delete User', 'Delete User', '2018-02-28 09:03:50', '2018-02-28 09:03:50');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- membuang struktur untuk table cctv.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.permission_role: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- membuang struktur untuk table cctv.permission_user
CREATE TABLE IF NOT EXISTS `permission_user` (
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_id` int(10) unsigned DEFAULT NULL,
  UNIQUE KEY `permission_user_user_id_permission_id_user_type_team_id_unique` (`user_id`,`permission_id`,`user_type`,`team_id`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  KEY `permission_user_team_id_foreign` (`team_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_user_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.permission_user: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;

-- membuang struktur untuk table cctv.provinces
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `province_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_cor_x` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_cor_y` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_zoom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.provinces: ~34 rows (lebih kurang)
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
INSERT INTO `provinces` (`id`, `province_name`, `province_code`, `province_cor_x`, `province_cor_y`, `province_zoom`, `created_at`, `updated_at`) VALUES
	(1, 'Aceh', 'ID-AC', '4.0', '97.0', '8', NULL, NULL),
	(2, 'Sumatera Utara', 'ID-SU', '3.605763', '98.67438', '8', NULL, NULL),
	(3, 'Riau', 'ID-RI', '0.5005', '101.749', '8', NULL, NULL),
	(4, 'Kepulauan Riau', 'ID-KR', '0.61667', '106.98333', '8', NULL, NULL),
	(5, 'Sumatera Barat', 'ID-SB', '-1.0', '100.5', '8', NULL, NULL),
	(6, 'Jambi', 'ID-JA', '-3.7', '103.0', '8', NULL, NULL),
	(7, 'Bengkulu', 'ID-BE', '-3.7', '102.2', '8', NULL, NULL),
	(8, 'Sumatera Selatan', 'ID-SS', '-2.75', '103.83333', '8', NULL, NULL),
	(9, 'Lampung', 'ID-LA', '-5.0', '105.0', '8', NULL, NULL),
	(10, 'Bangka Belitung', 'ID-BB', '-2.66667', '106.66667', '8', NULL, NULL),
	(11, 'Banten', 'ID-BT', '-6.5', '106.25', '8', NULL, NULL),
	(12, 'DKI Jakarta', 'ID-JK', '-6.2182', '106.8584', '8', NULL, NULL),
	(13, 'Jawa Barat', 'ID-JB', '-6.921830', '107.63922', '9', NULL, NULL),
	(14, 'Jawa Tengah', 'ID-JT', '-7.5', '110.0', '8', NULL, NULL),
	(15, 'Yogyakarta', 'ID-YO', '-7.75', '110.5', '7', NULL, NULL),
	(16, 'Jawa Timur', 'ID-JI', '-7.7394', '112.5099', '8', NULL, NULL),
	(17, 'Kalimantan Barat', 'ID-KB', '0.0', '110.5', '7', NULL, NULL),
	(18, 'Kalimantan Tengah', 'ID-KT', '-2.0', '113.5', '7', NULL, NULL),
	(19, 'Kalimantan Selatan', 'ID-KS', '-2.5', '115.5', '8', NULL, NULL),
	(20, 'Kalimantan Timur', 'ID-KT', '0.5', '116.5', '7', NULL, NULL),
	(21, 'Kalimantan Utara', 'ID-KU', '3.35989', '116.53198', '7', NULL, NULL),
	(22, 'Bali', 'ID-BI', '-8.5', '115.0', '10', NULL, NULL),
	(23, 'Nusa Tenggara Barat', 'ID-BA', '-8.74', '117.5333', '9', NULL, NULL),
	(24, 'Nusa Tenggara Timur', 'ID-NT', '-8.65738', '121.07937', '8', NULL, NULL),
	(25, 'Sulawesi Barat', 'ID-SR', '-2.5', '119.3333', '8', NULL, NULL),
	(26, 'Sulawesi Selatan', 'ID-SN', '-5.15198', '119.4385', '7', NULL, NULL),
	(27, 'Sulawesi Tenggara', 'ID-SG', '-4.3935', '122.2149', '8', NULL, NULL),
	(28, 'Sulawesi Tengah', 'ID-ST', '-0.9166', '122.3538', '7', NULL, NULL),
	(29, 'Sulawesi Utara', 'ID-SA', '1.25', '124.83333', '7', NULL, NULL),
	(30, 'Gorontalo', 'ID-GO', '0.693', '122.4704', '8', NULL, NULL),
	(31, 'Maluku', 'ID-MA', '-3.23846', '130.14527', '7', NULL, NULL),
	(32, 'Maluku Utara', 'ID-MU', '-0.25', '127.5', '7', NULL, NULL),
	(33, 'Papua Barat', 'ID-PB', '-0.86531', '134.06118', '7', NULL, NULL),
	(34, 'Papua', 'ID-PA', '-4.75', '138.0', '6', NULL, NULL);
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;

-- membuang struktur untuk table cctv.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.roles: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Administrator', 'Full Control like a Boss', '2018-02-28 06:03:03', '2018-02-28 07:24:21'),
	(2, 'user', 'User', 'Control like a Kuproy', '2018-02-28 07:23:55', '2018-02-28 07:24:12'),
	(3, 'kuproy', 'Kuproy', 'Role for kuproy', '2018-03-01 09:38:30', '2018-03-01 09:38:30');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- membuang struktur untuk table cctv.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_id` int(10) unsigned DEFAULT NULL,
  UNIQUE KEY `role_user_user_id_role_id_user_type_team_id_unique` (`user_id`,`role_id`,`user_type`,`team_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_team_id_foreign` (`team_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.role_user: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- membuang struktur untuk table cctv.sites
CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cor_x` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cor_y` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `division_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sites_area_id_index` (`area_id`),
  KEY `sites_division_id_index` (`division_id`),
  CONSTRAINT `sites_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  CONSTRAINT `sites_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.sites: ~8 rows (lebih kurang)
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` (`id`, `site_name`, `cor_x`, `cor_y`, `url_1`, `url_2`, `area_id`, `created_at`, `updated_at`, `division_id`) VALUES
	(1, 'Wanayasa 4', '-6.626649975873017', '107.5537462994721', 'http://test.com', NULL, 1, '2018-01-22 08:37:19', '2018-01-24 05:52:50', 1),
	(2, 'Subang', '-6.4745886', '107.8886628', 'http://test.com', NULL, 1, '2018-01-22 09:08:27', '2018-01-25 04:15:44', 1),
	(3, 'Medan', '3.5944564439378066', '98.67094827246092', 'http://test.com', NULL, 5, '2018-01-22 09:37:13', '2018-01-25 04:16:01', 1),
	(4, 'Lampung', '-5.41317119405937', '105.26343179296873', 'http://test.com', NULL, 4, '2018-01-22 09:37:42', '2018-01-22 09:37:42', 1),
	(5, 'Wanayasa 2', '-6.640964839228921', '107.5315077359619', 'http://test.com', NULL, 1, '2018-01-24 06:00:04', '2018-01-24 06:00:04', 1),
	(6, 'Wanayasa 1', '-6.62744111194675', '107.5223238522949', 'http://test.com', NULL, 1, '2018-01-24 06:02:10', '2018-01-24 06:02:10', 1),
	(7, 'Wanayasa 3', '-6.639717986297367', '107.55811524938963', 'http://test.com', NULL, 1, '2018-01-24 06:03:02', '2018-01-24 06:03:02', 1),
	(8, 'Probolinggo', '-7.776142667051537', '113.20242715429686', NULL, NULL, 6, '2018-02-22 07:20:40', '2018-02-22 07:20:40', 9);
/*!40000 ALTER TABLE `sites` ENABLE KEYS */;

-- membuang struktur untuk table cctv.teams
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teams_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.teams: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;

-- membuang struktur untuk table cctv.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.users: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'admin@japfa.com', '$2y$10$hfkxtjzophFYq/dxBYcUi.4LTIYdnW49lI/oGdoO4i9PQQcTo9xFm', 'JsFOYRp5Hu2QIGAqLTbjv9udPaqKWe0gKkhJaRqk9a2pN5F1XCo3lWMolBnj', '2018-02-23 07:36:53', '2018-02-23 07:36:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- membuang struktur untuk table cctv.user_area
CREATE TABLE IF NOT EXISTS `user_area` (
  `user_id` int(10) unsigned NOT NULL,
  `area_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `user_area_user_id_area_id_unique` (`user_id`,`area_id`),
  KEY `user_area_area_id_foreign` (`area_id`),
  CONSTRAINT `user_area_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_area_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.user_area: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `user_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_area` ENABLE KEYS */;

-- membuang struktur untuk table cctv.user_division
CREATE TABLE IF NOT EXISTS `user_division` (
  `user_id` int(10) unsigned NOT NULL,
  `division_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `user_division_user_id_division_id_unique` (`user_id`,`division_id`),
  KEY `user_division_division_id_foreign` (`division_id`),
  CONSTRAINT `user_division_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_division_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.user_division: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `user_division` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_division` ENABLE KEYS */;

-- membuang struktur untuk table cctv.user_site
CREATE TABLE IF NOT EXISTS `user_site` (
  `user_id` int(10) unsigned NOT NULL,
  `site_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `user_site_user_id_site_id_unique` (`user_id`,`site_id`),
  KEY `user_site_site_id_foreign` (`site_id`),
  CONSTRAINT `user_site_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_site_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv.user_site: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `user_site` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_site` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
