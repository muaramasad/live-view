-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 5.6.29 - MySQL Community Server (GPL)
-- OS Server:                    Linux
-- HeidiSQL Versi:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk cctv_app_ver_1_0
CREATE DATABASE IF NOT EXISTS `cctv_app_ver_1_0` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `cctv_app_ver_1_0`;

-- membuang struktur untuk table cctv_app_ver_1_0.areas
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.areas: ~17 rows (lebih kurang)
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` (`id`, `area_name`, `division_id`, `created_at`, `updated_at`, `province_id`) VALUES
	(1, 'Area Barat', 1, '2018-01-22 08:32:47', '2018-01-24 06:04:36', 13),
	(2, 'Area Timur 1', 1, '2018-01-22 09:07:41', '2018-01-24 06:04:20', 16),
	(3, 'Area Timur 2', 1, '2018-01-22 09:36:16', '2018-01-24 06:05:09', 26),
	(4, 'Area Sumatera 1', 1, '2018-01-22 09:36:36', '2018-01-24 06:05:26', 9),
	(5, 'Area Sumatera 2', 1, '2018-01-24 06:05:49', '2018-01-24 06:05:49', 2),
	(7, 'Bekri', 10, '2018-03-06 07:09:40', '2018-03-06 07:09:40', 9),
	(8, 'Vaksindo', 11, '2018-03-06 07:13:08', '2018-03-06 08:00:07', 13),
	(9, 'JCI Sidoarjo', 2, '2018-03-06 08:51:40', '2018-03-06 09:25:44', 16),
	(11, 'JCI Cikande', 2, '2018-03-06 09:06:35', '2018-03-06 09:30:52', 11),
	(12, 'JCI Cikupa', 2, '2018-03-06 09:26:53', '2018-03-06 09:26:53', 12),
	(13, 'JCI Purwakarta', 2, '2018-03-06 09:27:35', '2018-03-06 09:27:35', 13),
	(14, 'JCI Cirebon', 2, '2018-03-06 09:28:09', '2018-03-06 09:28:09', 13),
	(15, 'Indojaya Medan', 2, '2018-03-06 09:31:50', '2018-03-06 09:31:50', 2),
	(16, 'JCI Padang', 2, '2018-03-06 09:34:46', '2018-03-06 09:34:46', 5),
	(17, 'JCI Lampung', 2, '2018-03-06 09:40:25', '2018-03-06 09:40:25', 9),
	(18, 'JCI Sragen', 2, '2018-03-06 09:41:52', '2018-03-06 09:41:52', 14),
	(19, 'JCI Grobogan', 2, '2018-03-06 09:42:51', '2018-03-06 09:42:51', 14);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.area_user
CREATE TABLE IF NOT EXISTS `area_user` (
  `user_id` int(10) unsigned NOT NULL,
  `area_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `user_area_user_id_area_id_unique` (`user_id`,`area_id`),
  KEY `user_area_area_id_foreign` (`area_id`),
  CONSTRAINT `user_area_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_area_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.area_user: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `area_user` DISABLE KEYS */;
INSERT INTO `area_user` (`user_id`, `area_id`, `created_at`, `updated_at`) VALUES
	(4, 1, '2018-03-19 04:34:08', '2018-03-19 04:34:08');
/*!40000 ALTER TABLE `area_user` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.cams
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
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.cams: ~73 rows (lebih kurang)
/*!40000 ALTER TABLE `cams` DISABLE KEYS */;
INSERT INTO `cams` (`id`, `cam_name`, `cam_ip_address`, `cam_file_path`, `cam_cor_x`, `cam_cor_y`, `site_id`, `created_at`, `updated_at`) VALUES
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
	(46, 'Fumigasi Telur', '10.21.113.134', NULL, '-6.6258400311373205', '107.55393941852117', 1, '2018-02-21 06:21:44', '2018-02-21 07:10:53'),
	(49, 'Gerbang Utama', '10.21.102.111', NULL, '-6.629007709292077', '107.52308559965513', 6, '2018-03-07 06:44:22', '2018-03-07 07:16:32'),
	(50, 'Cardip, Bak Celup & Shower Operator', '10.21.102.112', NULL, '-6.628837195536713', '107.52305073093794', 6, '2018-03-07 06:45:50', '2018-03-07 06:45:50'),
	(52, 'Masuk Shower 1 & Fumigasi 2', '10.21.102.114', NULL, '-6.628738617244998', '107.52306682419203', 6, '2018-03-07 06:50:04', '2018-03-07 06:50:04'),
	(53, 'Pintu Keluar Shower 1', '10.21.102.121', NULL, '-6.628687995952398', '107.52293807815931', 6, '2018-03-07 06:51:08', '2018-03-07 06:51:08'),
	(54, 'Keluar Fumigasi 2', '10.21.102.122', NULL, '-6.628602739026792', '107.52297562908552', 6, '2018-03-07 06:52:03', '2018-03-07 06:52:03'),
	(55, 'Pintu Masuk Shower 2', '10.21.102.123', NULL, '-6.628192439866166', '107.52314997267138', 6, '2018-03-07 06:55:40', '2018-03-07 06:55:40'),
	(56, 'Fumigasi 3', '10.21.102.124', NULL, '-6.6281631327702035', '107.52308559965513', 6, '2018-03-07 06:56:27', '2018-03-07 06:56:27'),
	(57, 'Gudang MT', '10.21.102.125', NULL, '-6.628370946685803', '107.52237481426619', 6, '2018-03-07 06:57:44', '2018-03-07 06:57:44'),
	(58, 'Gudang Serut', '10.21.102.126', NULL, '-6.628437553691503', '107.52186787676237', 6, '2018-03-07 06:58:36', '2018-03-07 06:58:36'),
	(59, 'Pintu Keluar Shower 2', '10.21.102.131', NULL, '-6.62786206886532', '107.52321434568785', 6, '2018-03-07 06:59:33', '2018-03-07 06:59:33'),
	(60, 'Keluar Fumigasi 3', '10.21.102.132', NULL, '-6.627968640180101', '107.52303195547483', 6, '2018-03-07 07:01:01', '2018-03-07 07:01:01'),
	(61, 'Fumigasi Telur & Pintu Masuk Kandang - Kandang 5&6', '10.21.102.133', NULL, '-6.628053897215348', '107.52271545481108', 6, '2018-03-07 07:01:45', '2018-03-07 07:17:32'),
	(62, 'Shower Masuk Kandang (Shower Kandang 5&6)', '10.21.102.134', NULL, '-6.627776811796906', '107.52275837015532', 6, '2018-03-07 07:02:20', '2018-03-07 07:21:06'),
	(63, 'Fumigasi Telur & Pintu Masuk Kandang (Kandang 3&4)', '10.21.102.135', NULL, '-6.627643597598007', '107.52277982782743', 6, '2018-03-07 07:03:19', '2018-03-07 07:19:52'),
	(64, 'Shower Masuk Kandang (Kandang 3&4)', '10.21.102.136', NULL, '-6.62741979766284', '107.52278519224546', 6, '2018-03-07 07:15:21', '2018-03-07 07:15:21'),
	(65, 'Fumigasi Telur & Pintu Masuk Kandang (Kandang 1&2)', '10.21.102.137', NULL, '-6.6272492833583465', '107.52280128549955', 6, '2018-03-07 07:16:01', '2018-03-07 07:16:01'),
	(66, 'Shower Masuk Kandang (Shower Kandang 1&2)', '10.21.102.138', NULL, '-6.626988183215324', '107.52282274317167', 6, '2018-03-07 07:17:06', '2018-03-07 07:17:06'),
	(67, 'Fumigasi Telur & Pintu Masuk Kandang (Kandang 7&8)', '10.21.102.139', NULL, '-6.626838983071538', '107.52284420084379', 6, '2018-03-07 07:18:24', '2018-03-07 07:18:24'),
	(68, 'Shower Masuk Kandang (Shower Kandang 7&8)', '10.21.102.140', NULL, '-6.626705768619301', '107.52287102293394', 6, '2018-03-07 07:19:01', '2018-03-07 07:19:01'),
	(69, 'Gerbang Masuk & Fumigasi 1', '10.21.116.111', NULL, '-6.64142041931976', '107.52983135532759', 5, '2018-03-08 01:57:09', '2018-03-08 01:57:09'),
	(70, 'Cardip & Bak Celup', '10.21.116.112', NULL, '-6.64119129722152', '107.53006202530287', 5, '2018-03-08 01:58:22', '2018-03-08 01:58:22'),
	(71, 'Masuk Fumigasi 2', '10.21.116.113', NULL, '-6.64142041931976', '107.5301210339012', 5, '2018-03-08 01:59:24', '2018-03-08 01:59:24'),
	(72, 'Pintu Keluar Shower 1 & Pintu Masuk Shower 2', '10.21.116.121', NULL, '-6.641329836177388', '107.53016394924543', 5, '2018-03-08 02:01:17', '2018-03-08 02:01:17'),
	(73, 'Keluar Fumigasi 2', '10.21.116.122', NULL, '-6.641521659282667', '107.5302470977249', 5, '2018-03-08 02:07:08', '2018-03-08 02:07:08'),
	(74, 'Cardip', '10.21.116.123', NULL, '-6.641100714036987', '107.53023905109785', 5, '2018-03-08 02:08:37', '2018-03-08 02:08:37'),
	(75, 'Gudang Serut', '10.21.116.124', NULL, '-6.64213176282866', '107.53112149786375', 5, '2018-03-08 02:09:41', '2018-03-08 02:09:41'),
	(76, 'Gudang MT', '10.21.116.125', NULL, '-6.64204650823015', '107.53153455805204', 5, '2018-03-08 02:10:22', '2018-03-08 02:10:22'),
	(77, 'Pintu Keluar Shower 2', '10.21.116.131', NULL, '-6.641220603542371', '107.5303731615486', 5, '2018-03-08 02:14:06', '2018-03-08 02:14:06'),
	(78, 'Masuk Fumigasi 3', '10.21.116.132', NULL, '-6.6414630466751', '107.5303731615486', 5, '2018-03-08 02:15:07', '2018-03-08 02:15:07'),
	(79, 'Fumigasi Barang & Pintu Masuk Shower', '10.21.116.133', NULL, '-6.64146571088468', '107.5308774168434', 5, '2018-03-08 02:15:55', '2018-03-08 02:15:55'),
	(80, 'Fumigasi Barang & Pintu Masuk Shower', '10.21.116.134', NULL, '-6.641385784590819', '107.53088546347044', 5, '2018-03-08 02:16:42', '2018-03-08 02:16:42'),
	(81, 'Pintu Masuk Shower Kandang', '10.21.116.135', NULL, '-6.641332500387706', '107.53086937021635', 5, '2018-03-08 02:17:18', '2018-03-08 02:17:18'),
	(82, 'Fumigasi Barang & Pintu Masuk Shower', '10.21.116.136', NULL, '-6.640730388491477', '107.53078353952787', 5, '2018-03-08 02:18:08', '2018-03-08 02:18:08'),
	(83, 'Pintu Masuk Shower Kandang', '10.21.116.137', NULL, '-6.640666447361892', '107.53077817510984', 5, '2018-03-08 02:18:47', '2018-03-08 02:18:47'),
	(84, 'Fumigasi Barang & Pintu Masuk Shower', '10.21.116.138', NULL, '-6.640602506223974', '107.53077817510984', 5, '2018-03-08 02:20:06', '2018-03-08 02:20:06'),
	(85, 'Gerbang Masuk & Fumigasi 1', '10.21.103.111', NULL, '-6.64135914248998', '107.55738032411955', 7, '2018-03-08 02:26:12', '2018-03-08 02:26:12'),
	(86, 'Bak Celup Kayu', '10.21.103.112', NULL, '-6.641468374799602', '107.55761904072187', 7, '2018-03-08 02:27:18', '2018-03-08 02:27:18'),
	(87, 'Cardip & Fumigasi 2', '10.21.103.113', NULL, '-6.641188633010452', '107.55737764191053', 7, '2018-03-08 02:28:38', '2018-03-08 02:28:38'),
	(88, 'Pintu Keluar Shower 1', '10.21.103.121', NULL, '-6.64123126038588', '107.55764318060301', 7, '2018-03-08 02:38:07', '2018-03-08 02:38:07'),
	(89, 'Gudang Makanan Ternak', '10.21.103.122', NULL, '-6.641140677208688', '107.55821985554121', 7, '2018-03-08 02:40:20', '2018-03-08 02:40:20'),
	(90, 'Cardip 2 & Fumigasi 3', '10.21.103.123', NULL, '-6.641159326687707', '107.55828422855757', 7, '2018-03-08 02:41:16', '2018-03-08 02:41:16'),
	(91, 'Gudang Serut', '10.21.103.132', NULL, '-6.640725060064328', '107.5585229451599', 7, '2018-03-08 03:01:52', '2018-03-08 03:01:52'),
	(92, 'Pintu Masuk Kandang & Fumigasi Kandang Camera 9', '10.21.103.133', NULL, '-6.640250829817024', '107.5587053353729', 7, '2018-03-08 03:02:39', '2018-03-08 03:09:49'),
	(93, 'Pintu Masuk Kandang & Fumigasi Kandang Camera 10', '10.21.103.134', NULL, '-6.639819226610492', '107.55868924211882', 7, '2018-03-08 03:05:46', '2018-03-08 03:10:09'),
	(94, 'Pintu Masuk Kandang & Fumigasi Kandang Camera 11', '10.21.103.135', NULL, '-6.639403608350202', '107.55869460653685', 7, '2018-03-08 03:12:29', '2018-03-08 03:12:29'),
	(95, 'Pintu Masuk Kandang & Fumigasi Kandang Camera 12', '10.21.103.136', NULL, '-6.638998646630826', '107.55869460653685', 7, '2018-03-08 03:13:16', '2018-03-08 03:13:16'),
	(96, 'Gerbang Utama', '10.21.102.113', NULL, '-6.628805224201016', '107.52294880699537', 6, '2018-03-09 10:44:19', '2018-03-09 10:44:19'),
	(97, 'Pintu Keluar Shower 2', '10.21.103.131', NULL, '-6.640938197105298', '107.55826545309446', 7, '2018-03-10 07:14:34', '2018-03-10 07:15:39');
/*!40000 ALTER TABLE `cams` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.divisions
CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `division_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.divisions: ~6 rows (lebih kurang)
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` (`id`, `division_name`, `icon_path`, `created_at`, `updated_at`, `category`) VALUES
	(1, 'Breeding', 'public/thumbnails/up01EwqKWG0mCPzj6O03r2WaBfZvwLgjx1ZN0cS5.jpeg', '2018-01-22 08:25:24', '2018-03-08 02:59:31', 'poultry'),
	(2, 'Feed', 'public/thumbnails/PJvqOu9DdKGoWmzAhOjGT6CT14E8qOvKw6SIhdht.jpeg', '2018-02-02 03:03:25', '2018-03-08 03:00:18', 'poultry'),
	(4, 'Processed Chicken', 'public/thumbnails/ZH9IHvtoqXP3ETsXovVOLsMuxMZD4pwo3BKqf1dp.jpeg', '2018-02-08 07:25:51', '2018-03-08 03:00:29', 'poultry'),
	(5, 'Commercial Live Broilers Bird', 'public/thumbnails/6XAutMKNpF3tDf2bR135S75IJQiDatXAO6BRn2fT.jpeg', '2018-02-08 07:26:25', '2018-03-08 03:00:02', 'poultry'),
	(10, 'Beef', 'public/thumbnails/8Wz2oX214OtGcXnElfRcQQXihF0KnkPCD00ijiO7.jpeg', '2018-03-06 07:05:27', '2018-03-06 07:05:27', 'beef cattle'),
	(11, 'SBU Animal Health', 'public/thumbnails/jCVu3AEF7kaG1wzL3tQn0akhKe5XzrspPrRTSD2F.jpeg', '2018-03-06 07:12:45', '2018-03-06 07:12:45', 'poultry');
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.division_user
CREATE TABLE IF NOT EXISTS `division_user` (
  `user_id` int(10) unsigned NOT NULL,
  `division_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `user_division_user_id_division_id_unique` (`user_id`,`division_id`),
  KEY `user_division_division_id_foreign` (`division_id`),
  CONSTRAINT `user_division_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_division_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.division_user: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `division_user` DISABLE KEYS */;
INSERT INTO `division_user` (`user_id`, `division_id`, `created_at`, `updated_at`) VALUES
	(4, 1, '2018-03-19 04:34:08', '2018-03-19 04:34:08');
/*!40000 ALTER TABLE `division_user` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.migrations: ~15 rows (lebih kurang)
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
	(48, '2018_02_28_040452_create_user-division_user-area_user-site_table', 5),
	(49, '2018_03_05_070547_change_user_division_name_to_division_user', 6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.password_resets: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.permissions: ~28 rows (lebih kurang)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'user.create', 'Create user', 'Create new user', '2018-02-28 08:51:02', '2018-03-05 03:40:04'),
	(2, 'user.edit', 'Update user', 'Update user information', '2018-02-28 09:02:17', '2018-03-05 03:40:21'),
	(3, 'user.index', 'Display user listing', 'List all users', '2018-02-28 09:03:17', '2018-03-05 03:40:37'),
	(4, 'user.destroy', 'Delete user', 'Delete user', '2018-02-28 09:03:50', '2018-03-05 03:40:55'),
	(5, 'division.create', 'Create division', 'Create new division', '2018-03-05 03:26:34', '2018-03-05 03:41:09'),
	(6, 'division.edit', 'Update division', 'Update division information', '2018-03-05 03:27:27', '2018-03-05 03:41:17'),
	(7, 'division.index', 'Display divisions listing', 'List all divisions', '2018-03-05 03:28:40', '2018-03-05 03:28:40'),
	(8, 'division.destroy', 'Delete division', 'Delete division', '2018-03-05 03:29:17', '2018-03-05 03:29:17'),
	(9, 'permission.create', 'Create permission', 'Create new permission', '2018-03-05 03:39:02', '2018-03-05 03:39:02'),
	(10, 'permission.edit', 'Edit permission', 'Edit permission information', '2018-03-05 03:47:29', '2018-03-05 03:47:29'),
	(11, 'permission.index', 'Display permission listing', 'List all permissions', '2018-03-05 03:48:28', '2018-03-05 03:48:28'),
	(12, 'permission.destroy', 'Delete permission', 'Delete permission', '2018-03-05 03:49:15', '2018-03-05 03:49:15'),
	(13, 'role.create', 'Create role', 'Create new role', '2018-03-05 03:51:21', '2018-03-05 03:51:21'),
	(14, 'role.edit', 'Update role', 'Update role information', '2018-03-05 03:51:49', '2018-03-05 03:51:49'),
	(15, 'role.index', 'Display role listing', 'List all roles', '2018-03-05 03:53:23', '2018-03-05 03:53:37'),
	(16, 'role.destroy', 'Delete role', 'Delete role', '2018-03-05 04:01:09', '2018-03-05 04:01:09'),
	(17, 'area.create', 'Create area', 'Create new area', '2018-03-05 04:03:38', '2018-03-05 04:03:38'),
	(18, 'area.edit', 'Edit area', 'Edit area information', '2018-03-05 04:04:22', '2018-03-05 04:04:22'),
	(19, 'area.index', 'Display area listing', 'List all areas', '2018-03-05 04:04:54', '2018-03-05 04:04:54'),
	(20, 'area.destroy', 'Delete area', 'Delete areas', '2018-03-05 04:05:33', '2018-03-05 04:05:33'),
	(21, 'site.create', 'Create site', 'Create new site', '2018-03-05 04:07:36', '2018-03-05 04:07:36'),
	(22, 'site.edit', 'Edit site', 'Edit site information', '2018-03-05 04:08:03', '2018-03-05 04:08:03'),
	(23, 'site.index', 'Display site listing', 'List all sites', '2018-03-05 04:08:39', '2018-03-05 04:08:39'),
	(24, 'site.destroy', 'Delete site', 'Delete site', '2018-03-05 04:09:03', '2018-03-05 04:09:03'),
	(25, 'cam.create', 'Create cctv', 'Create new cctv', '2018-03-05 04:23:01', '2018-03-05 04:23:01'),
	(26, 'cam.edit', 'Edit cctv', 'Edit cctv information', '2018-03-05 04:23:32', '2018-03-05 04:23:32'),
	(27, 'cam.listBySite', 'Display all cctv', 'Display cctv listing by site', '2018-03-05 04:24:28', '2018-03-05 04:24:28'),
	(28, 'cam.destroy', 'Delete cctv', 'Delete cctv', '2018-03-05 04:24:52', '2018-03-05 04:24:52');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.permission_role: ~47 rows (lebih kurang)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(5, 2),
	(6, 2),
	(7, 2),
	(8, 2),
	(17, 2),
	(18, 2),
	(19, 2),
	(20, 2),
	(21, 2),
	(22, 2),
	(23, 2),
	(24, 2),
	(25, 2),
	(26, 2),
	(27, 2),
	(28, 2),
	(19, 4),
	(23, 4),
	(27, 4);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.permission_user
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

-- Membuang data untuk tabel cctv_app_ver_1_0.permission_user: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.provinces
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

-- Membuang data untuk tabel cctv_app_ver_1_0.provinces: ~34 rows (lebih kurang)
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

-- membuang struktur untuk table cctv_app_ver_1_0.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.roles: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Administrator', 'Full Control like a Boss', '2018-02-28 06:03:03', '2018-02-28 07:24:21'),
	(2, 'user', 'User', 'Control like a Kuproy', '2018-02-28 07:23:55', '2018-02-28 07:24:12'),
	(4, 'user-breeding', 'User Breeding', NULL, '2018-03-19 04:33:24', '2018-03-19 04:33:24');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.role_user
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

-- Membuang data untuk tabel cctv_app_ver_1_0.role_user: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`, `team_id`) VALUES
	(4, 4, 'App\\User', NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.sites
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.sites: ~19 rows (lebih kurang)
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` (`id`, `site_name`, `cor_x`, `cor_y`, `url_1`, `url_2`, `area_id`, `created_at`, `updated_at`, `division_id`) VALUES
	(1, 'Wanayasa 4', '-6.626836476117182', '107.5537462994721', '192.168.106.144', NULL, 1, '2018-01-22 08:37:19', '2018-03-20 01:48:34', 1),
	(2, 'Subang', '-6.4745886', '107.8886628', 'http://test.com', NULL, 1, '2018-01-22 09:08:27', '2018-01-25 04:15:44', 1),
	(3, 'Medan', '3.5944564439378066', '98.67094827246092', 'http://test.com', NULL, 5, '2018-01-22 09:37:13', '2018-01-25 04:16:01', 1),
	(4, 'Lampung', '-5.419596968639404', '105.33759099024769', 'http://test.com', NULL, 4, '2018-01-22 09:37:42', '2018-03-20 04:02:01', 1),
	(5, 'Wanayasa 2', '-6.640964839228921', '107.5315077359619', 'http://test.com', NULL, 1, '2018-01-24 06:00:04', '2018-01-24 06:00:04', 1),
	(6, 'Wanayasa 1', '-6.627510383363116', '107.52230775904081', '10.21.102.70', NULL, 1, '2018-01-24 06:02:10', '2018-03-20 01:50:45', 1),
	(7, 'Wanayasa 3', '-6.640117618991192', '107.55798113893889', 'http://test.com', NULL, 1, '2018-01-24 06:03:02', '2018-03-20 01:58:32', 1),
	(9, 'Santori Bekri Lampung', '-5.055940568776971', '105.08087928836062', 'test', 'test', 7, '2018-03-06 07:11:09', '2018-03-06 07:11:09', 10),
	(10, 'Vaksindo Bogor', '-6.437854422759474', '106.92053718650823', 'test', 'test', 8, '2018-03-06 07:15:17', '2018-03-06 07:15:17', 11),
	(11, 'JCI Sidoarjo', '-7.416236', '112.725541', NULL, NULL, 9, '2018-03-06 08:52:36', '2018-03-06 08:52:36', 2),
	(12, 'Cikande', '-6.228022', '106.353740', NULL, NULL, 11, '2018-03-06 09:07:05', '2018-03-06 09:26:24', 2),
	(13, 'Cikupa', '-6.226360', '106.527187', NULL, NULL, 12, '2018-03-06 09:09:40', '2018-03-06 09:27:12', 2),
	(14, 'Purwakarta', '-6.499476', '107.535964', NULL, NULL, 13, '2018-03-06 09:11:37', '2018-03-06 09:27:47', 2),
	(15, 'Cirebon', '-6.740992', '108.579121', NULL, NULL, 14, '2018-03-06 09:12:59', '2018-03-06 09:28:22', 2),
	(16, 'Indojaya Medan', '3.526201', '98.756379', NULL, NULL, 15, '2018-03-06 09:33:28', '2018-03-06 09:33:28', 2),
	(17, 'JCI Padang', '-0.783987', '100.321253', NULL, NULL, 16, '2018-03-06 09:35:11', '2018-03-06 09:35:11', 2),
	(18, 'JCI Lampung', '-5.401243', '105.358572', NULL, NULL, 17, '2018-03-06 09:40:50', '2018-03-06 09:40:50', 2),
	(19, 'JCI Sragen', '-7.443054', '110.975764', NULL, NULL, 18, '2018-03-06 09:42:24', '2018-03-06 09:42:24', 2),
	(20, 'JCI Grobogan', '-7.033264', '110.723725', NULL, NULL, 19, '2018-03-06 09:44:10', '2018-03-06 09:44:10', 2);
/*!40000 ALTER TABLE `sites` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.site_user
CREATE TABLE IF NOT EXISTS `site_user` (
  `user_id` int(10) unsigned NOT NULL,
  `site_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `user_site_user_id_site_id_unique` (`user_id`,`site_id`),
  KEY `user_site_site_id_foreign` (`site_id`),
  CONSTRAINT `user_site_site_id_foreign` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_site_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.site_user: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `site_user` DISABLE KEYS */;
INSERT INTO `site_user` (`user_id`, `site_id`, `created_at`, `updated_at`) VALUES
	(4, 1, '2018-03-19 04:34:08', '2018-03-19 04:34:08'),
	(4, 5, '2018-03-19 04:34:08', '2018-03-19 04:34:08'),
	(4, 6, '2018-03-19 04:34:08', '2018-03-19 04:34:08'),
	(4, 7, '2018-03-19 04:34:08', '2018-03-19 04:34:08');
/*!40000 ALTER TABLE `site_user` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.teams
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

-- Membuang data untuk tabel cctv_app_ver_1_0.teams: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;

-- membuang struktur untuk table cctv_app_ver_1_0.users
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel cctv_app_ver_1_0.users: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'admin@japfa.com', '$2y$10$hfkxtjzophFYq/dxBYcUi.4LTIYdnW49lI/oGdoO4i9PQQcTo9xFm', 'kFnpwKMNk0r73rfibXcXcySJPKAjIA67uSbswXdolfjUv5anTSIDNkhS1Qhn', '2018-02-23 07:36:53', '2018-02-23 07:36:53'),
	(2, 'User', 'user@japfa.com', '$2y$10$Pp.Q35cDd1v4PsQqaznYyOOM/lbN36M6nj8I1DHGcMK2wSbZMLHK6', 'iIAJSMlC6GDua9mG1D8eYfh3AZ0nxE17I8xv3TONoKylWZSeQAgcyuTqxSR5', '2018-03-02 08:02:39', '2018-03-02 08:02:39'),
	(4, 'User Breeding', 'user-breeding@japfa.com', '$2y$10$rFggBA/fybSHYVOn6JmLB.MmfL5LTBMfPrgHAVhDtkbdpExWUI2fq', NULL, '2018-03-19 04:34:08', '2018-03-19 04:34:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
