/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `applembur24` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `applembur24`;

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `mjabatan` (
  `kode_jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `mjabatan` DISABLE KEYS */;
INSERT INTO `mjabatan` (`kode_jabatan`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
	('1', 'Kepala UPBJJ', '2021-08-10 05:44:28', '2021-08-10 05:44:29'),
	('2', 'Manajer Registrasi dan Ujian', '2021-08-10 05:45:32', '2021-08-10 05:45:33'),
	('3', 'Manajer Bahan Ajar dan Bantuan Belajar', '2021-08-10 05:45:54', '2021-08-10 05:45:54'),
	('4', 'Manajer Keuangan dan Umum', '2021-08-10 05:46:29', '2021-08-10 05:46:29');
/*!40000 ALTER TABLE `mjabatan` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `mpegawai` (
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pegawai` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_upbjj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `mpegawai` DISABLE KEYS */;
/*!40000 ALTER TABLE `mpegawai` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `mupbjj` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_upbjj` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_upbjj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_4` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `mupbjj` DISABLE KEYS */;
INSERT INTO `mupbjj` (`id`, `kode_upbjj`, `nama_upbjj`, `alamat`, `no_telp`, `header_1`, `header_2`, `header_3`, `header_4`, `created_at`, `updated_at`) VALUES
	(25, '24', 'Bandung', 'Jl. Panyileukan Raya No. 1 A, Soekarno-Hatta, Bandung 40614', 'Telepon: (022) 7801791, 7801792, 87820554, Faksimi', 'UNIT PROGRAM BELAJAR JARAK JAUH (UPBJJ) BANDUNG', 'Jl. Panyileukan Raya No. 1 A, Soekarno-Hatta, Bandung 40614', 'Telepon: (022) 7801791, 7801792, 87820554, Faksimile: (022) 87820556,', 'E-mail: bandung@ecampus.ut.ac.id, Laman: www.bandung.ut.ac.id', '2021-07-25 16:00:09', '2021-08-02 13:22:43'),
	(26, '21', 'Jakarta', 'Jakarta', '021-1234567', NULL, NULL, NULL, NULL, '2021-08-02 13:30:05', '2021-08-02 13:30:05');
/*!40000 ALTER TABLE `mupbjj` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `m_group` (
  `id_group` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otoritas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `m_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_group` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `m_statusverifikasi` (
  `kode_verifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_verifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `m_statusverifikasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_statusverifikasi` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `t_lembur` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_upbjj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_surat_tugas_detail` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_kegiatan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `masuk` time NOT NULL,
  `pulang` time NOT NULL,
  `totaljam` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_validasi` char(1) CHARACTER SET latin1 DEFAULT '0',
  `catatan_atasan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_create` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_update` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `t_lembur` DISABLE KEYS */;
INSERT INTO `t_lembur` (`id`, `kode_upbjj`, `nip`, `id_surat_tugas_detail`, `uraian_kegiatan`, `satuan`, `volume`, `masuk`, `pulang`, `totaljam`, `status_validasi`, `catatan_atasan`, `user_create`, `user_update`, `created_at`, `updated_at`) VALUES
	(3, '24', '196508051989031001', '25', 'You may use the transaction method on the DB facade to run a set of operations within a database transaction. If an exception is thrown within the transaction Closure, the transaction will automatically be rolled back. If the Closure executes successfully, the transaction will automatically be committed. You don\'t need to worry about manually rolling back or committing while using the transaction method:', 'Mahasiswa', '500', '07:00:00', '14:00:00', '7 jam', '1', 'Oke', 'Agus Slamet Mulyana', NULL, '2021-07-30 14:34:11', '2021-07-30 14:40:29'),
	(5, '24', '199406242017TKT0708', '24', 'Harus diisi', 'Mahasiswa', '500', '07:00:00', '14:00:00', '7 jam', '1', 'Oke', 'Dwi Anto, S.Tr.T', NULL, '2021-07-30 15:13:57', '2021-08-02 11:19:07'),
	(10, '24', '199406242017TKT0708', '26', 'Harus diisi', 'Mahasiswa', '500', '07:00:00', '14:00:00', '7 jam', '0', NULL, 'Dwi Anto, S.Tr.T', NULL, '2021-08-02 12:41:30', '2021-08-02 12:41:30');
/*!40000 ALTER TABLE `t_lembur` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `t_pejabat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_upbjj` char(5) DEFAULT NULL,
  `nip` char(20) DEFAULT NULL,
  `kode_jabatan` char(20) DEFAULT NULL,
  `status` char(2) DEFAULT '1',
  `user_create` char(20) DEFAULT NULL,
  `user_update` char(20) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `t_pejabat` DISABLE KEYS */;
INSERT INTO `t_pejabat` (`id`, `kode_upbjj`, `nip`, `kode_jabatan`, `status`, `user_create`, `user_update`, `create_at`, `update_at`) VALUES
	(1, '24', '199406242017TKT0708', '1', '0', NULL, NULL, '2021-08-02 20:52:30', '2021-08-02 20:52:31'),
	(2, '24', '197304162003121001', '1', '1', NULL, NULL, '2021-08-09 19:34:29', '2021-08-09 19:34:30');
/*!40000 ALTER TABLE `t_pejabat` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `t_riwayat_pekerjaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` char(25) NOT NULL,
  `unit_kerja` longtext NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `nomor_sk` varchar(100) NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `user_create` varchar(100) DEFAULT NULL,
  `user_update` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nip` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `t_riwayat_pekerjaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_riwayat_pekerjaan` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `t_riwayat_pendidikan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` char(25) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `pendidikan` longtext NOT NULL,
  `tahun` varchar(25) NOT NULL,
  `efektif` varchar(20) NOT NULL DEFAULT 'Ya',
  `kabko` varchar(100) DEFAULT NULL,
  `user_create` varchar(100) DEFAULT NULL,
  `user_update` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nip` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `t_riwayat_pendidikan` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_riwayat_pendidikan` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `t_riwayat_pengembangan_sdm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` char(25) NOT NULL,
  `nama_kegiatan` longtext NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `pelatih` varchar(100) NOT NULL,
  `efektif` varchar(10) DEFAULT 'Ya',
  `kabko` varchar(50) NOT NULL,
  `file` varchar(150) DEFAULT NULL,
  `user_create` varchar(100) DEFAULT NULL,
  `user_update` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index 2` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `t_riwayat_pengembangan_sdm` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_riwayat_pengembangan_sdm` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `t_surat_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_upbjj` char(5) DEFAULT '0',
  `nomor_surat_tugas` varchar(50) DEFAULT NULL,
  `nama_kegiatan` varchar(150) DEFAULT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `status` char(1) DEFAULT '0',
  `penanda_tangan` char(50) DEFAULT NULL,
  `user_create` char(50) DEFAULT NULL,
  `user_update` char(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_surat_tugas` (`nomor_surat_tugas`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `t_surat_tugas` DISABLE KEYS */;
INSERT INTO `t_surat_tugas` (`id`, `kode_upbjj`, `nomor_surat_tugas`, `nama_kegiatan`, `tanggal_kegiatan`, `status`, `penanda_tangan`, `user_create`, `user_update`, `created_at`, `updated_at`) VALUES
	(11, '24', '10/UN31.UPBJJ15/KP/2021', 'Kegiatan Akreditas BAN PT', '2021-07-25', '1', '1979', 'Dwi Anto, S.Tr.T', NULL, '2021-07-25 15:39:35', '2021-07-29 13:32:15'),
	(12, '24', '11/UN31.UPBJJ15/KP/2021', 'Akreditasi BAN PT Program Studi Pendidikan Matematika', '2021-08-15', '0', '199406242017TKT0708', 'Admin UPBJJ 24', NULL, '2021-08-09 12:00:07', '2021-08-09 12:00:07');
/*!40000 ALTER TABLE `t_surat_tugas` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `t_surat_tugas_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_upbjj` char(5) DEFAULT '0',
  `nomor_surat_tugas` varchar(50) DEFAULT NULL,
  `nip` varchar(24) DEFAULT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `status` char(50) NOT NULL DEFAULT '0',
  `user_create` char(50) DEFAULT NULL,
  `user_update` char(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `t_surat_tugas_detail` DISABLE KEYS */;
INSERT INTO `t_surat_tugas_detail` (`id`, `kode_upbjj`, `nomor_surat_tugas`, `nip`, `tanggal_kegiatan`, `status`, `user_create`, `user_update`, `created_at`, `updated_at`) VALUES
	(18, '24', '10/UN31.UPBJJ15/KP/2021', '197304162003121002', '2021-07-25', '0', 'Dwi Anto, S.Tr.T', NULL, '2021-07-25 15:39:42', '2021-07-25 15:39:42'),
	(19, '24', '10/UN31.UPBJJ15/KP/2021', '196307081989031002', '2021-07-25', '0', 'Dwi Anto, S.Tr.T', NULL, '2021-07-25 15:39:45', '2021-07-25 15:39:45'),
	(20, '24', '10/UN31.UPBJJ15/KP/2021', '196404031986031005', '2021-07-25', '0', 'Dwi Anto, S.Tr.T', NULL, '2021-07-25 15:39:50', '2021-07-25 15:39:50'),
	(21, '24', '10/UN31.UPBJJ15/KP/2021', '196909102003122001', '2021-07-25', '0', 'Dwi Anto, S.Tr.T', NULL, '2021-07-25 15:40:59', '2021-07-25 15:40:59'),
	(22, '24', '10/UN31.UPBJJ15/KP/2021', '197304162003121002', '2021-07-26', '0', 'Dwi Anto, S.Tr.T', NULL, '2021-07-26 12:54:37', '2021-07-26 12:54:37'),
	(23, '24', '10/UN31.UPBJJ15/KP/2021', '196909102003122001', '2021-07-26', '0', 'Dwi Anto, S.Tr.T', NULL, '2021-07-26 12:56:26', '2021-07-26 12:56:26'),
	(24, '24', '10/UN31.UPBJJ15/KP/2021', '199406242017TKT0708', '2021-07-25', '1', 'Dwi Anto, S.Tr.T', NULL, '2021-07-26 14:13:53', '2021-07-30 15:13:57'),
	(25, '24', '10/UN31.UPBJJ15/KP/2021', '196508051989031001', '2021-07-26', '1', 'Dwi Anto, S.Tr.T', NULL, '2021-07-26 14:13:56', '2021-07-30 14:34:11'),
	(26, '24', '10/UN31.UPBJJ15/KP/2021', '199406242017TKT0708', '2021-07-26', '1', 'Dwi Anto, S.Tr.T', NULL, '2021-07-26 14:25:09', '2021-08-02 12:41:30'),
	(30, '24', '11/UN31.UPBJJ15/KP/2021', '199406242017TKT0708', '2021-08-15', '0', 'Admin UPBJJ 24', NULL, '2021-08-09 12:13:20', '2021-08-09 12:13:20'),
	(31, '24', '11/UN31.UPBJJ15/KP/2021', '196909102003122001', '2021-08-15', '0', 'Admin UPBJJ 24', NULL, '2021-08-09 12:13:33', '2021-08-09 12:13:33');
/*!40000 ALTER TABLE `t_surat_tugas_detail` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_atasan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` int(11) DEFAULT 7,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_upbjj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_nip_unique` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nip`, `name`, `nip_atasan`, `group`, `email`, `email_verified_at`, `password`, `kode_upbjj`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, '19912321', 'admin', '1231232132', 1, 'admin@gmail.com', NULL, '$2y$10$lm9tR8dzIEfDK3pqE7boq.f.lMTAx/2McKjXFCbT91h03BE3o3CM6', '00', 'fcIiUl1qpu2mZhdQ4oQqZQO6wIjIuaeES5NPGfSNcIyvlFoczko8jbvvhPym', '2021-07-24 14:44:22', '2021-07-24 14:44:22'),
	(2, '199406242017TKT0708', 'Dwi Anto, S.Tr.T', '197304162003121001', 1, 'antok@ecampus.ut.ac.id', NULL, '$2y$10$4DqkZA/8opBTYN8XUVnUJ.ngU6.a3AholT2A7OTeyKNPHq7WOnLuS', '24', 'VoqRFU70cIzDFhPOiap9DV4GOYNZdkjrmXc6yZCdneFPsPX2DzUMgIM54cma', '2021-07-25 16:01:12', '2021-07-25 16:01:12'),
	(3, '196508051989031001', 'Agus Slamet Mulyana', '197304162003121001', 7, 'agus-sm@ecampus.ut.ac.id', NULL, '$2y$10$UNTQPzOBwQRHwyg8U6P1LuwXtmy.jMQ5x1Teqh6MmrtT34dOZf2rC', '24', 'x8rAXRVhKTE38tBWLtBIyFufvjcbG7Urln8fgYPZp2h0ZwcBXYk8t6wpdxSS', '2021-07-25 20:42:21', '2021-08-02 14:24:50'),
	(4, '197304162003121002', 'Ahmad Nuraji, A.Md.', '197710022005012001', 7, 'ahmad-nuraji@ecampus.ut.ac.id', NULL, '$2y$10$bgYbMBfqUPUYcjVOlVbpF.u16Qns/elrm1Z.LqHBNQBb1vfztDzRK', '24', NULL, '2021-07-25 20:42:53', '2021-07-25 20:42:53'),
	(5, '196307081989031002', 'Andi Mastono, S.H.', '197710022005012001', 7, 'andi-mastono@ecampus.ut.ac.id', NULL, '$2y$10$27zmKzyH6Tn4hNhU1WpKlu5i6vEWCBG2XUDPtmDzMxY4V833o5.Ue', '24', NULL, '2021-07-25 20:43:41', '2021-07-25 20:43:41'),
	(6, '196404031986031005', 'Dadang Junaedi', '197611202005012001', 7, 'dadang-junaedi@ecampus.ut.ac.id', NULL, '$2y$10$OQ3vmV5sFqf.ryB2PzfWU.AkEOEPZFwbJCrskPwtUnJjhg6H3X826', '24', NULL, '2021-07-25 20:44:09', '2021-07-25 20:44:09'),
	(7, '196909102003122001', 'Dewi Priamsari, S.E.', '197611202005012001', 7, 'dewi-priamsari@ecampus.ut.ac.id', NULL, '$2y$10$XEhOde9cDc80t5Rvs2gBweTo5blb0dxeziehWbgHBO.y9WjflWXxO', '24', NULL, '2021-07-25 20:44:41', '2021-07-25 20:44:41'),
	(8, '195802011981031004', 'Drs. Didi Permana, M.Pd.', '197710022005012001', 7, 'didi-permana@ecampus.ut.ac.id', NULL, '$2y$10$t6x8eDhPM8vKUWfQYKSVZemTBy9dtNiI6W1ptE6SYXxiAOh4yKMz.', '24', NULL, '2021-07-25 20:45:11', '2021-07-25 20:45:11'),
	(9, '195901261986032002', 'Dra. Dina Thaib, M.Ed.', '197611202005012001', 7, 'dinathaib@ecampus.ut.ac.id', NULL, '$2y$10$Dh6jZiw.JvQBiMzAIFd5UeJWoG1BcC3gp14jtSQIFNWIqRTX9XWhy', '24', NULL, '2021-07-25 20:46:06', '2021-07-25 20:46:06'),
	(10, '195508161980031003', 'Drs. Dudung Abdullah, M.Pd.', '197710022005012001', 7, 'dudung-abdullah@ecampus.ut.ac.id', NULL, '$2y$10$y3QdEUzqWxIs29VooMEP3.4TLI.rNHkK6l23Ja.VoqDUmKWwBW7Zu', '24', NULL, '2021-07-25 20:46:40', '2021-07-25 20:46:40'),
	(13, '24000000000001', 'Admin UPBJJ 24', '199406242017TKT0708', 2, 'upbjj24@ecampus.ut.ac.id', NULL, '$2y$10$9ZIY7bIbEB8yYWEwtjBGAeORJe0Zr/1Qc0lPFfdDPnx/KgYT.4fy.', '24', 'ME8JNvuqu1tKzUcfojd0TkgkHs5ouoC3ZULQbRhF1XBGxZcABnsSIWJgec74', '2021-08-09 11:58:47', '2021-08-09 11:58:47'),
	(14, '197304162003121001', 'Merry Monica, S.Tp', '199406242017TKT0708', 4, 'merry-monica@ecampus.ut.ac.id', NULL, '$2y$10$5paDmAD4BoMKUIEYHIMWKOEBIGZ8M/sXxTNI4fgZymKclFc/eYRD2', '24', '1fTG55yyAA18elnRw4fh6nQh7aoW8cB7nqD7Nkt6s6OFN478nDvKw48crzD4', '2021-08-09 12:33:50', '2021-08-09 12:33:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
