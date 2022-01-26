-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2022 at 02:29 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipit`
--

-- --------------------------------------------------------

--
-- Table structure for table `bmn_grup_keluhan`
--

CREATE TABLE `bmn_grup_keluhan` (
  `id_grup_keluhan` int(11) NOT NULL,
  `id_pelapor` int(9) NOT NULL,
  `nomor_laporan` varchar(20) NOT NULL,
  `tgl_laporan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmn_grup_keluhan`
--

INSERT INTO `bmn_grup_keluhan` (`id_grup_keluhan`, `id_pelapor`, `nomor_laporan`, `tgl_laporan`) VALUES
(63, 95, '2022/01/7/1', '2022-01-16 00:09:27'),
(64, 95, '2022/01/7/2', '2022-01-16 02:11:56'),
(65, 95, '2022/01/7/3', '2022-01-16 02:16:27'),
(66, 95, '2022/01/7/4', '2022-01-16 02:19:34'),
(67, 95, '2022/01/7/5', '2022-01-16 02:20:03'),
(68, 95, '2022/01/7/6', '2022-01-16 02:25:45'),
(69, 95, '2022/01/7/7', '2022-01-16 02:28:37'),
(70, 95, '2022/01/7/8', '2022-01-16 02:30:01'),
(71, 95, '2022/01/7/9', '2022-01-16 02:32:44'),
(72, 95, '2022/01/7/10', '2022-01-16 02:34:38'),
(73, 95, '2022/01/7/11', '2022-01-16 02:36:58'),
(74, 95, '2022/01/7/12', '2022-01-16 02:37:36'),
(75, 95, '2022/01/7/13', '2022-01-16 02:42:35'),
(76, 95, '2022/01/7/14', '2022-01-16 02:46:37'),
(77, 95, '2022/01/7/15', '2022-01-16 02:50:32'),
(78, 95, '2022/01/7/16', '2022-01-16 14:25:57'),
(79, 95, '2022/01/7/17', '2022-01-16 14:26:40'),
(80, 95, '2022/01/7/18', '2022-01-16 14:33:13'),
(81, 95, '2022/01/7/19', '2022-01-16 14:36:20'),
(82, 94, '2022/01/7/20', '2022-01-16 14:39:29'),
(83, 95, '2022/01/7/21', '2022-01-16 14:45:27'),
(84, 95, '2022/01/7/22', '2022-01-16 21:34:33'),
(85, 94, '2022/01/7/23', '2022-01-16 21:40:40'),
(86, 93, '2022/01/7/24', '2022-01-16 21:44:06'),
(87, 91, '2022/01/7/25', '2022-01-19 12:00:18'),
(88, 91, '2022/01/7/26', '2022-01-19 12:01:42'),
(89, 91, '2022/01/7/27', '2022-01-19 12:02:08'),
(90, 91, '2022/01/7/28', '2022-01-19 12:06:15'),
(91, 95, '2022/01/7/29', '2022-01-19 12:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `bmn_keluhan`
--

CREATE TABLE `bmn_keluhan` (
  `id_grup_keluhan` int(11) NOT NULL,
  `id_keluhan` int(11) NOT NULL,
  `unique_code` varchar(5) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `permintaan_lainnya` varchar(20) DEFAULT NULL,
  `id_type` int(3) DEFAULT NULL,
  `type_lainnya` varchar(30) DEFAULT NULL,
  `id_pemegang_bmn` int(9) NOT NULL,
  `masalah` text NOT NULL,
  `id_status` int(2) NOT NULL DEFAULT 2,
  `id_umum` int(9) DEFAULT NULL,
  `catatan_umum` text DEFAULT NULL,
  `id_ipds` int(9) DEFAULT NULL,
  `catatan_ipds` text DEFAULT NULL,
  `id_rekanan` int(3) DEFAULT NULL,
  `catatan_rekanan` text DEFAULT NULL,
  `tgl_approve_pj` datetime DEFAULT NULL,
  `tgl_approve_umum` datetime DEFAULT NULL,
  `tgl_proses_ipds` datetime DEFAULT NULL,
  `tgl_kirim_rekanan` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `tgl_diambil` datetime DEFAULT NULL,
  `biaya` bigint(20) DEFAULT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmn_keluhan`
--

INSERT INTO `bmn_keluhan` (`id_grup_keluhan`, `id_keluhan`, `unique_code`, `id_permintaan`, `permintaan_lainnya`, `id_type`, `type_lainnya`, `id_pemegang_bmn`, `masalah`, `id_status`, `id_umum`, `catatan_umum`, `id_ipds`, `catatan_ipds`, `id_rekanan`, `catatan_rekanan`, `tgl_approve_pj`, `tgl_approve_umum`, `tgl_proses_ipds`, `tgl_kirim_rekanan`, `tgl_selesai`, `tgl_diambil`, `biaya`, `is_show`) VALUES
(91, 1313, 'RPG10', 14, NULL, 5, NULL, 95, 'masalah 1', 9, 93, 'umum', NULL, NULL, NULL, NULL, '2022-01-19 12:27:48', NULL, NULL, NULL, '2022-01-19 12:29:36', '2022-01-19 12:32:10', 50000, 1),
(91, 1314, 'SRD5R', 42, NULL, 26, NULL, 95, 'masalah 2', 9, 93, 'umum', 92, 'ipds', 1, 'rekanan', '2022-01-19 12:28:20', '2022-01-19 12:29:51', '2022-01-19 12:31:20', '2022-01-19 12:31:33', '2022-01-19 12:31:48', '2022-01-19 12:32:15', 100000, 1),
(91, 1315, 'V9APZ', 41, NULL, 43, NULL, 95, 'masalah 3', 1, 93, 'umum', NULL, NULL, NULL, NULL, '2022-01-19 12:28:28', '2022-01-19 12:30:41', NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bmn_master_kategori_permintaan`
--

CREATE TABLE `bmn_master_kategori_permintaan` (
  `id_kategori_permintaan` int(3) NOT NULL,
  `nama_kategori_permintaan` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmn_master_kategori_permintaan`
--

INSERT INTO `bmn_master_kategori_permintaan` (`id_kategori_permintaan`, `nama_kategori_permintaan`) VALUES
(1, 'Kerusakan'),
(2, 'Jaringan'),
(3, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `bmn_master_merk`
--

CREATE TABLE `bmn_master_merk` (
  `id_merk` int(3) NOT NULL,
  `nama_merk` varchar(35) NOT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmn_master_merk`
--

INSERT INTO `bmn_master_merk` (`id_merk`, `nama_merk`, `is_show`) VALUES
(1, 'ACER', 1),
(2, 'ASUS', 1),
(3, 'AXWAY', 1),
(4, 'BUFFALO', 1),
(5, 'CANON', 1),
(6, 'DELL', 1),
(7, 'EPSON', 1),
(8, 'EXPANSION', 1),
(9, 'FUJI XEROX', 1),
(10, 'FUJITSU', 1),
(11, 'HP', 1),
(12, 'IBM', 1),
(13, 'INFOCUS 24', 1),
(14, 'LENOVO', 1),
(15, 'PANASONIC', 1),
(16, 'PLUSTEK', 1),
(17, 'RIVERBED', 1),
(18, 'SAMSUNG', 1),
(19, 'SEAGATE', 1),
(20, 'SPECTRA FLASH', 1),
(21, 'TANDBERG', 1),
(22, 'TOSHIBA', 1),
(23, 'TOSHIBA ', 1),
(24, 'TRENDNET', 1),
(25, 'WD', 1),
(99, '# Lainnya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bmn_master_permintaan`
--

CREATE TABLE `bmn_master_permintaan` (
  `id_permintaan` int(3) NOT NULL,
  `id_kategori_permintaan` int(3) NOT NULL,
  `nama_permintaan` varchar(255) NOT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmn_master_permintaan`
--

INSERT INTO `bmn_master_permintaan` (`id_permintaan`, `id_kategori_permintaan`, `nama_permintaan`, `is_show`) VALUES
(11, 1, 'Printer', 1),
(12, 1, 'UPS', 1),
(13, 1, 'PC', 1),
(14, 1, 'Laptop', 1),
(15, 1, 'Scanner', 1),
(16, 1, 'Switch', 1),
(17, 1, 'Viewer', 1),
(19, 1, '# Lainnya', 1),
(21, 2, 'Internet', 1),
(22, 2, 'LAN (Jaringan Lokal)', 1),
(23, 2, 'VPN', 1),
(29, 2, '# Lainnya', 1),
(31, 3, 'Aktivasi Windows', 1),
(32, 3, 'Aktivasi Office', 1),
(33, 3, 'Instalasi Aplikasi', 1),
(39, 3, '# Lainnya', 1),
(41, 1, 'Harddisk', 1),
(42, 1, 'Tablet', 1),
(43, 1, 'Smartphone', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bmn_master_rekanan`
--

CREATE TABLE `bmn_master_rekanan` (
  `id_rekanan` int(3) NOT NULL,
  `nama_rekanan` varchar(100) NOT NULL,
  `alamat_rekanan` text NOT NULL,
  `contact_person` varchar(35) NOT NULL,
  `no_contact_person` varchar(14) NOT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmn_master_rekanan`
--

INSERT INTO `bmn_master_rekanan` (`id_rekanan`, `nama_rekanan`, `alamat_rekanan`, `contact_person`, `no_contact_person`, `is_show`) VALUES
(1, 'Griyacom', 'Jl Teuku Umar', 'Griyacom', '081212121212', 1),
(3, 'Slara Komputer', 'Jalan Teratai No.8 Kedaton, Bandar Lampung', 'Slara Komputer', '082182226353', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bmn_master_ruangan`
--

CREATE TABLE `bmn_master_ruangan` (
  `kode_ruangan` int(3) NOT NULL,
  `nama_ruangan` varchar(35) NOT NULL,
  `pj_ruangan` int(9) NOT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmn_master_ruangan`
--

INSERT INTO `bmn_master_ruangan` (`kode_ruangan`, `nama_ruangan`, `pj_ruangan`, `is_show`) VALUES
(101, 'Lobby Utama', 86, 0),
(102, 'PST', 94, 1),
(104, 'Subbagian Perlengkapan', 19, 0),
(105, 'Subbagian Kepegawaian dan Hukum', 3, 1),
(106, 'Staff IPDS dan Pengolahan', 81, 1),
(107, 'Kabid IPDS', 78, 1),
(108, 'Gudang Perlengkapan (Bawah Tangga)', 86, 0),
(111, 'Subbagian Umum', 19, 1),
(112, 'Ruang Server', 85, 1),
(201, 'Subbagian Keuangan', 13, 1),
(202, 'Subbagian Bina Program', 9, 1),
(203, 'Kabag Tata Usaha', 2, 1),
(204, 'Staff Statistik Produksi', 54, 1),
(205, 'Kabid Statisitik Produksi', 44, 1),
(206, 'Staff Statistik Distribusi', 61, 1),
(207, 'Kabid Distribusi', 56, 1),
(208, 'Sekretaris Kepala BPS Prov. Lampung', 24, 1),
(209, 'Kepala BPS Provinsi Lampung', 90, 1),
(301, 'Video Conference', 1, 0),
(302, 'Staff Statistik Sosial', 34, 1),
(303, 'Kabid Statistik Sosial', 31, 1),
(304, 'Staff Nerwilis', 69, 1),
(305, 'Kabid Nerwilis', 66, 1),
(306, 'Gudang Perlengkapan', 1, 0),
(307, 'Subbagian PBJ', 8, 1),
(308, 'Aula', 1, 0),
(401, 'Gudang BPS Provinsi Lampung', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bmn_master_status`
--

CREATE TABLE `bmn_master_status` (
  `id_status` int(2) NOT NULL,
  `nama_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmn_master_status`
--

INSERT INTO `bmn_master_status` (`id_status`, `nama_status`) VALUES
(1, 'Permintaan ditolak'),
(2, 'Kirim form ke PJ Ruang'),
(3, 'Kirim form ke Umum'),
(4, 'Approve form ke IPDS'),
(5, 'Sedang diproses di IPDS'),
(6, 'Sedang diproses di rekanan'),
(7, 'Sudah selesai di IPDS'),
(8, 'Sudah selesai di Umum'),
(9, 'Sudah diterima oleh Pemegang BMN');

-- --------------------------------------------------------

--
-- Table structure for table `bmn_master_type`
--

CREATE TABLE `bmn_master_type` (
  `id_type` int(3) NOT NULL,
  `id_merk` int(3) NOT NULL,
  `id_permintaan` int(3) NOT NULL,
  `nama_type` varchar(35) NOT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmn_master_type`
--

INSERT INTO `bmn_master_type` (`id_type`, `id_merk`, `id_permintaan`, `nama_type`, `is_show`) VALUES
(1, 11, 11, '14S-CF0048TX - i5 8250U', 1),
(2, 3, 11, '47X0 Appliance', 1),
(3, 3, 11, '57X0 Appliance', 1),
(4, 2, 14, 'A455L', 1),
(5, 1, 14, 'Aspire', 1),
(6, 11, 11, 'Business Notebook 348 G4', 1),
(7, 21, 11, 'C20', 1),
(8, 5, 11, 'CanonScan Lide 700F', 1),
(9, 11, 11, 'Color Laserjet Managed MPP E77822dn', 1),
(10, 11, 11, 'Compaq / DX 2310', 1),
(11, 11, 11, 'Compaq Impresario V.3103', 1),
(12, 23, 11, 'Convio 3.0 Simple 500GB', 1),
(13, 11, 11, 'Design Jet T 610 (24inch)', 1),
(14, 10, 11, 'Desktop LTO -4', 1),
(15, 9, 11, 'DocuCentre SC2020', 1),
(16, 9, 11, 'DocuPrint C3055DX', 1),
(17, 9, 11, 'DocuPrint CP315dw', 1),
(18, 5, 11, 'DR-F120', 1),
(19, 4, 11, 'Drivestation HD WL4TSU2RI', 1),
(20, 7, 11, 'EB-X6', 1),
(21, 10, 11, 'fi-5950', 1),
(22, 10, 11, 'Fi6770', 1),
(23, 10, 11, 'Fi6800', 1),
(24, 10, 11, 'fi-7260', 1),
(25, 18, 42, 'Galaxy Tab A8\" LTE (P355)+Rugged Ca', 1),
(26, 18, 42, 'Galaxy Tab S4', 1),
(27, 4, 11, 'HD PXT1TU2', 1),
(28, 4, 11, 'HD-HS 500U2', 1),
(29, 13, 11, 'Infocus 24', 1),
(30, 7, 11, 'L1800', 1),
(31, 7, 11, 'L355', 1),
(32, 11, 11, 'LASER JET PRO M201DW', 1),
(33, 11, 11, 'LaserJet P2055D', 1),
(34, 11, 11, 'LaserJet P4515x', 1),
(35, 6, 11, 'LATITUDE 10', 1),
(36, 6, 11, 'Latitude D630', 1),
(37, 12, 11, 'Lenovo/Think Centre', 1),
(38, 5, 11, 'LIDE 220', 1),
(39, 10, 11, 'Lifebook T580', 1),
(40, 10, 11, 'M532', 1),
(41, 4, 11, 'Ministation HD-PXT500U2', 1),
(42, 16, 11, 'Mobileoffice AD450', 1),
(43, 25, 41, 'My Passport New 2TB', 1),
(44, 6, 11, 'Networking X1018', 1),
(45, 6, 11, 'Networking X1026', 1),
(46, 11, 11, 'Officejet K850 A4', 1),
(47, 6, 11, 'Optiplex 3010 DT', 1),
(48, 6, 11, 'OptiPlex 3020 Micro + Monitor Dell ', 1),
(49, 6, 11, 'Optiplex 3040 Micro', 1),
(50, 9, 11, 'Phaser 2428D', 1),
(51, 5, 11, 'PIXMA MP258', 1),
(52, 22, 11, 'Portege M900', 1),
(53, 22, 11, 'Portege M901', 1),
(54, 22, 11, 'Portege M902', 1),
(55, 6, 11, 'Power Edge M520 Server Node for VRT', 1),
(56, 6, 11, 'PowerConnect 2800(2824)', 1),
(57, 6, 11, 'PowerEdge VRTX Rack Chassis Tipe A', 1),
(58, 11, 11, 'Probook 440 G5 (1MJ83AV)', 1),
(59, 11, 11, 'ProDesk 400 G5 SFF', 1),
(60, 22, 11, 'Satelite M100-2111E', 1),
(61, 10, 11, 'ScanSnap SV600', 1),
(62, 10, 11, 'SH782', 1),
(63, 18, 11, 'Slim External DVD Writer', 1),
(64, 6, 11, 'SonicPoint Ace', 1),
(65, 6, 11, 'SonicWALL NSA 2600', 1),
(66, 11, 11, 'Spectre x360 Convertible 13 - AP005', 1),
(67, 17, 11, 'Steelhead 550M', 1),
(68, 14, 11, 'ThinkCentre M710t', 1),
(69, 14, 11, 'Thinkpad L412', 1),
(70, 15, 11, 'Toughbook S9', 1),
(71, 15, 11, 'UB-5820', 1),
(72, 12, 11, 'X3500', 1),
(73, 11, 11, 'Z4 G4 Workstation', 1),
(999, 99, 19, '# Lainnya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi_ipds`
--

CREATE TABLE `notifikasi_ipds` (
  `id` int(11) NOT NULL,
  `id_keluhan` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi_ipds`
--

INSERT INTO `notifikasi_ipds` (`id`, `id_keluhan`, `is_read`, `date_created`) VALUES
(17, 1314, 1, '2022-01-19 12:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi_pjruang`
--

CREATE TABLE `notifikasi_pjruang` (
  `id` int(11) NOT NULL,
  `id_keluhan` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi_pjruang`
--

INSERT INTO `notifikasi_pjruang` (`id`, `id_keluhan`, `is_read`, `date_created`) VALUES
(59, 1313, 1, '2022-01-19 12:23:14'),
(60, 1314, 1, '2022-01-19 12:23:14'),
(61, 1315, 1, '2022-01-19 12:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi_umum`
--

CREATE TABLE `notifikasi_umum` (
  `id` int(11) NOT NULL,
  `id_keluhan` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi_umum`
--

INSERT INTO `notifikasi_umum` (`id`, `id_keluhan`, `is_read`, `date_created`) VALUES
(46, 1313, 1, '2022-01-19 12:27:48'),
(47, 1314, 1, '2022-01-19 12:28:20'),
(48, 1315, 1, '2022-01-19 12:28:28'),
(49, 1314, 1, '2022-01-19 12:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi_user`
--

CREATE TABLE `notifikasi_user` (
  `id` int(11) NOT NULL,
  `id_keluhan` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi_user`
--

INSERT INTO `notifikasi_user` (`id`, `id_keluhan`, `is_read`, `date_created`) VALUES
(120, 1313, 0, '2022-01-19 12:27:48'),
(121, 1314, 0, '2022-01-19 12:28:20'),
(122, 1315, 0, '2022-01-19 12:28:28'),
(123, 1313, 0, '2022-01-19 12:29:36'),
(124, 1314, 0, '2022-01-19 12:29:51'),
(125, 1315, 0, '2022-01-19 12:30:41'),
(126, 1314, 0, '2022-01-19 12:31:20'),
(127, 1314, 0, '2022-01-19 12:31:33'),
(128, 1314, 0, '2022-01-19 12:31:48'),
(129, 1313, 0, '2022-01-19 12:32:10'),
(130, 1314, 0, '2022-01-19 12:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `role` int(1) NOT NULL,
  `ruang` int(3) NOT NULL,
  `pj_ruang` tinyint(1) NOT NULL DEFAULT 0,
  `is_show` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `ruang`, `pj_ruang`, `is_show`) VALUES
(1, 9, 209, 0, 0),
(2, 9, 203, 1, 1),
(3, 9, 105, 1, 1),
(4, 9, 105, 0, 1),
(5, 9, 105, 0, 1),
(6, 9, 105, 0, 1),
(7, 9, 105, 0, 1),
(8, 9, 307, 1, 1),
(9, 9, 202, 1, 1),
(10, 9, 202, 0, 1),
(11, 9, 202, 0, 1),
(12, 9, 202, 0, 1),
(13, 9, 201, 1, 1),
(14, 9, 201, 0, 1),
(15, 9, 201, 0, 1),
(16, 9, 201, 0, 1),
(17, 9, 201, 0, 1),
(18, 9, 201, 0, 1),
(19, 9, 111, 1, 1),
(20, 9, 111, 0, 1),
(21, 9, 111, 0, 1),
(22, 9, 111, 0, 1),
(23, 9, 111, 0, 1),
(24, 9, 208, 1, 1),
(25, 9, 111, 0, 1),
(26, 9, 111, 0, 1),
(27, 9, 111, 0, 1),
(28, 9, 111, 0, 1),
(29, 9, 111, 0, 1),
(30, 9, 105, 0, 0),
(31, 9, 303, 1, 1),
(32, 9, 302, 0, 1),
(33, 9, 302, 0, 1),
(34, 9, 302, 1, 1),
(35, 9, 302, 0, 1),
(36, 9, 302, 0, 1),
(37, 9, 302, 0, 1),
(38, 9, 302, 0, 1),
(39, 9, 302, 0, 1),
(40, 9, 302, 0, 1),
(41, 9, 302, 0, 1),
(42, 9, 302, 0, 1),
(43, 9, 302, 0, 0),
(44, 9, 205, 1, 1),
(45, 9, 204, 0, 1),
(46, 9, 206, 0, 1),
(47, 9, 204, 0, 1),
(48, 9, 204, 0, 1),
(49, 9, 204, 0, 1),
(50, 9, 204, 0, 1),
(51, 9, 204, 0, 1),
(52, 9, 204, 0, 1),
(53, 9, 204, 0, 1),
(54, 9, 204, 1, 1),
(55, 9, 204, 0, 1),
(56, 9, 207, 1, 1),
(57, 9, 206, 0, 1),
(58, 9, 206, 0, 1),
(59, 9, 206, 0, 1),
(60, 9, 206, 0, 1),
(61, 9, 206, 1, 1),
(62, 9, 206, 0, 1),
(63, 9, 206, 0, 1),
(64, 9, 206, 0, 1),
(65, 9, 206, 0, 0),
(66, 9, 305, 1, 1),
(67, 9, 304, 0, 1),
(68, 9, 304, 0, 1),
(69, 9, 304, 1, 1),
(70, 9, 304, 0, 0),
(71, 9, 304, 0, 1),
(72, 9, 304, 0, 1),
(73, 9, 304, 0, 1),
(74, 9, 304, 0, 1),
(75, 9, 304, 0, 1),
(76, 9, 304, 0, 1),
(77, 9, 304, 0, 1),
(78, 9, 107, 1, 1),
(79, 9, 106, 0, 1),
(80, 9, 102, 0, 1),
(81, 9, 106, 1, 1),
(82, 9, 106, 0, 1),
(83, 9, 106, 0, 1),
(84, 9, 106, 0, 1),
(85, 9, 112, 1, 1),
(86, 9, 106, 0, 1),
(87, 9, 106, 0, 0),
(88, 9, 106, 0, 0),
(89, 9, 106, 0, 1),
(90, 9, 209, 1, 1),
(91, 1, 102, 0, 1),
(92, 2, 102, 0, 1),
(93, 3, 102, 0, 1),
(94, 9, 102, 1, 1),
(95, 9, 102, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(1) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'IPDS'),
(3, 'Umum'),
(9, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bmn_grup_keluhan`
--
ALTER TABLE `bmn_grup_keluhan`
  ADD PRIMARY KEY (`id_grup_keluhan`),
  ADD UNIQUE KEY `nomor_laporan` (`nomor_laporan`),
  ADD KEY `bmn_grup_keluhan_ibfk_1` (`id_pelapor`);

--
-- Indexes for table `bmn_keluhan`
--
ALTER TABLE `bmn_keluhan`
  ADD PRIMARY KEY (`id_keluhan`),
  ADD UNIQUE KEY `unique_code` (`unique_code`),
  ADD KEY `id_grup_keluhan` (`id_grup_keluhan`),
  ADD KEY `id_permintaan` (`id_permintaan`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_pemegang_bmn` (`id_pemegang_bmn`),
  ADD KEY `id_umum` (`id_umum`),
  ADD KEY `id_ipds` (`id_ipds`),
  ADD KEY `id_rekanan` (`id_rekanan`);

--
-- Indexes for table `bmn_master_kategori_permintaan`
--
ALTER TABLE `bmn_master_kategori_permintaan`
  ADD PRIMARY KEY (`id_kategori_permintaan`);

--
-- Indexes for table `bmn_master_merk`
--
ALTER TABLE `bmn_master_merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `bmn_master_permintaan`
--
ALTER TABLE `bmn_master_permintaan`
  ADD PRIMARY KEY (`id_permintaan`) USING BTREE,
  ADD KEY `id_kategori_permintaan` (`id_kategori_permintaan`);

--
-- Indexes for table `bmn_master_rekanan`
--
ALTER TABLE `bmn_master_rekanan`
  ADD PRIMARY KEY (`id_rekanan`);

--
-- Indexes for table `bmn_master_ruangan`
--
ALTER TABLE `bmn_master_ruangan`
  ADD PRIMARY KEY (`kode_ruangan`),
  ADD KEY `bmn_master_ruangan_ibfk_1` (`pj_ruangan`);

--
-- Indexes for table `bmn_master_status`
--
ALTER TABLE `bmn_master_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `bmn_master_type`
--
ALTER TABLE `bmn_master_type`
  ADD PRIMARY KEY (`id_type`),
  ADD KEY `id_merk` (`id_merk`),
  ADD KEY `id_permintaan` (`id_permintaan`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `notifikasi_ipds`
--
ALTER TABLE `notifikasi_ipds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_keluhan` (`id_keluhan`);

--
-- Indexes for table `notifikasi_pjruang`
--
ALTER TABLE `notifikasi_pjruang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_keluhan` (`id_keluhan`);

--
-- Indexes for table `notifikasi_umum`
--
ALTER TABLE `notifikasi_umum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasi_umum_ibfk_1` (`id_keluhan`);

--
-- Indexes for table `notifikasi_user`
--
ALTER TABLE `notifikasi_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_keluhan` (`id_keluhan`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `users_ibfk_3` (`ruang`),
  ADD KEY `users_ibfk_2` (`role`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bmn_grup_keluhan`
--
ALTER TABLE `bmn_grup_keluhan`
  MODIFY `id_grup_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `bmn_keluhan`
--
ALTER TABLE `bmn_keluhan`
  MODIFY `id_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1316;

--
-- AUTO_INCREMENT for table `bmn_master_kategori_permintaan`
--
ALTER TABLE `bmn_master_kategori_permintaan`
  MODIFY `id_kategori_permintaan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bmn_master_merk`
--
ALTER TABLE `bmn_master_merk`
  MODIFY `id_merk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `bmn_master_permintaan`
--
ALTER TABLE `bmn_master_permintaan`
  MODIFY `id_permintaan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `bmn_master_rekanan`
--
ALTER TABLE `bmn_master_rekanan`
  MODIFY `id_rekanan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bmn_master_ruangan`
--
ALTER TABLE `bmn_master_ruangan`
  MODIFY `kode_ruangan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=904;

--
-- AUTO_INCREMENT for table `bmn_master_status`
--
ALTER TABLE `bmn_master_status`
  MODIFY `id_status` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bmn_master_type`
--
ALTER TABLE `bmn_master_type`
  MODIFY `id_type` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `notifikasi_ipds`
--
ALTER TABLE `notifikasi_ipds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notifikasi_pjruang`
--
ALTER TABLE `notifikasi_pjruang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `notifikasi_umum`
--
ALTER TABLE `notifikasi_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `notifikasi_user`
--
ALTER TABLE `notifikasi_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bmn_grup_keluhan`
--
ALTER TABLE `bmn_grup_keluhan`
  ADD CONSTRAINT `bmn_grup_keluhan_ibfk_1` FOREIGN KEY (`id_pelapor`) REFERENCES `users` (`id`);

--
-- Constraints for table `bmn_keluhan`
--
ALTER TABLE `bmn_keluhan`
  ADD CONSTRAINT `bmn_keluhan_ibfk_1` FOREIGN KEY (`id_grup_keluhan`) REFERENCES `bmn_grup_keluhan` (`id_grup_keluhan`),
  ADD CONSTRAINT `bmn_keluhan_ibfk_2` FOREIGN KEY (`id_permintaan`) REFERENCES `bmn_master_permintaan` (`id_permintaan`),
  ADD CONSTRAINT `bmn_keluhan_ibfk_3` FOREIGN KEY (`id_type`) REFERENCES `bmn_master_type` (`id_type`),
  ADD CONSTRAINT `bmn_keluhan_ibfk_4` FOREIGN KEY (`id_status`) REFERENCES `bmn_master_status` (`id_status`),
  ADD CONSTRAINT `bmn_keluhan_ibfk_5` FOREIGN KEY (`id_pemegang_bmn`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bmn_keluhan_ibfk_6` FOREIGN KEY (`id_umum`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bmn_keluhan_ibfk_7` FOREIGN KEY (`id_ipds`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bmn_keluhan_ibfk_8` FOREIGN KEY (`id_rekanan`) REFERENCES `bmn_master_rekanan` (`id_rekanan`);

--
-- Constraints for table `bmn_master_permintaan`
--
ALTER TABLE `bmn_master_permintaan`
  ADD CONSTRAINT `bmn_master_permintaan_ibfk_1` FOREIGN KEY (`id_kategori_permintaan`) REFERENCES `bmn_master_kategori_permintaan` (`id_kategori_permintaan`);

--
-- Constraints for table `bmn_master_ruangan`
--
ALTER TABLE `bmn_master_ruangan`
  ADD CONSTRAINT `bmn_master_ruangan_ibfk_1` FOREIGN KEY (`pj_ruangan`) REFERENCES `users` (`id`);

--
-- Constraints for table `bmn_master_type`
--
ALTER TABLE `bmn_master_type`
  ADD CONSTRAINT `bmn_master_type_ibfk_1` FOREIGN KEY (`id_merk`) REFERENCES `bmn_master_merk` (`id_merk`),
  ADD CONSTRAINT `bmn_master_type_ibfk_2` FOREIGN KEY (`id_permintaan`) REFERENCES `bmn_master_permintaan` (`id_permintaan`);

--
-- Constraints for table `notifikasi_ipds`
--
ALTER TABLE `notifikasi_ipds`
  ADD CONSTRAINT `notifikasi_ipds_ibfk_1` FOREIGN KEY (`id_keluhan`) REFERENCES `bmn_keluhan` (`id_keluhan`);

--
-- Constraints for table `notifikasi_pjruang`
--
ALTER TABLE `notifikasi_pjruang`
  ADD CONSTRAINT `notifikasi_pjruang_ibfk_1` FOREIGN KEY (`id_keluhan`) REFERENCES `bmn_keluhan` (`id_keluhan`);

--
-- Constraints for table `notifikasi_umum`
--
ALTER TABLE `notifikasi_umum`
  ADD CONSTRAINT `notifikasi_umum_ibfk_1` FOREIGN KEY (`id_keluhan`) REFERENCES `bmn_keluhan` (`id_keluhan`);

--
-- Constraints for table `notifikasi_user`
--
ALTER TABLE `notifikasi_user`
  ADD CONSTRAINT `notifikasi_user_ibfk_1` FOREIGN KEY (`id_keluhan`) REFERENCES `bmn_keluhan` (`id_keluhan`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `ckpt6832_pegawai`.`m_user` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role`) REFERENCES `users_role` (`id_role`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`ruang`) REFERENCES `bmn_master_ruangan` (`kode_ruangan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
