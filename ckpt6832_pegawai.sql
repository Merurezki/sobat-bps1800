-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2021 at 04:08 PM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ckpt6832_pegawai`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `daftar_pegawai_lengkap`
-- (See below for the actual view)
--
CREATE TABLE `daftar_pegawai_lengkap` (
`id` int(4)
,`nama` varchar(255)
,`nip_lama` varchar(10)
,`nip_baru` varchar(25)
,`golongan` varchar(10)
,`pangkat` varchar(20)
,`jabatan_struktural_tambahan` varchar(225)
,`jabatan_fungsional` varchar(225)
,`jenjang_fungsional` varchar(51)
,`sub_fungsi` varchar(100)
,`fungsi` varchar(100)
,`satker` varchar(80)
,`status_pegawai` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `m_fungsi`
--

CREATE TABLE `m_fungsi` (
  `id` int(1) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_fungsi`
--

INSERT INTO `m_fungsi` (`id`, `nama`, `alias`, `status`) VALUES
(0, 'Tidak Ada', 'NONE', 1),
(1, 'Kepala', 'KEPALA', 1),
(2, 'Bagian Umum', 'UMUM', 1),
(3, 'Fungsi Statistik Sosial', 'SOSIAL', 1),
(4, 'Fungsi Statistik Produksi', 'PRODUKSI', 1),
(5, 'Fungsi Statistik Distribusi', 'DISTRIBUSI', 1),
(6, 'Fungsi Neraca Wilayah dan Analisis Statistik', 'NERWILIS', 1),
(7, 'Fungsi Integrasi Pengolahan dan Diseminasi Statistik', 'IPDS', 1),
(8, 'Koordinator Statistik Kecamatan', 'KSK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_fungsional`
--

CREATE TABLE `m_fungsional` (
  `id` int(3) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `alias` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_fungsional`
--

INSERT INTO `m_fungsional` (`id`, `nama`, `alias`) VALUES
(0, 'Tidak Ada', 'NONE'),
(1, 'Fungsional Umum', 'UMUM'),
(2, 'Statistisi', 'STATISTISI'),
(3, 'Pranata Komputer', 'PRAKOM'),
(4, 'Analis Anggaran', 'ANGGARAN'),
(5, 'Arsiparis', 'ARSIPARIS'),
(6, 'Analis SDM Aparatur', 'ANALIS_SDM'),
(7, 'Assesor SDM Aparatur', 'ASSESOR_SDM'),
(8, 'Analis Pengelola Keuangan APBN', 'ANALIS_KEUANGAN'),
(9, 'Pranata Keuangan APBN', 'PRANATA_KEUANGAN'),
(10, 'Pengelola Pengadaan Barang/Jasa', 'PENGADAAN');

-- --------------------------------------------------------

--
-- Table structure for table `m_golongan_pangkat`
--

CREATE TABLE `m_golongan_pangkat` (
  `id` int(2) NOT NULL,
  `golongan` varchar(10) NOT NULL,
  `pangkat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_golongan_pangkat`
--

INSERT INTO `m_golongan_pangkat` (`id`, `golongan`, `pangkat`) VALUES
(1, 'I/a', 'Juru Muda'),
(2, 'I/b', 'Juru Muda Tk. I'),
(3, 'I/c', 'Juru'),
(4, 'I/d', 'Juru TK. I'),
(5, 'II/a', 'Pengatur Muda'),
(6, 'II/b', 'Pengatur Muda TK. I'),
(7, 'II/c', 'Pengatur'),
(8, 'II/d', 'Pengatur Tk. I'),
(9, 'III/a', 'Penata Muda'),
(10, 'III/b', 'Penata Muda Tk. I'),
(11, 'III/c', 'Penata'),
(12, 'III/d', 'Penata Tk. I'),
(13, 'IV/a', 'Pembina'),
(14, 'IV/b', 'Pembina Tk. I'),
(15, 'IV/c', 'Pembina Utama Muda'),
(16, 'IV/d', 'Pembina Utama Madya'),
(17, 'IV/e', 'Pembina Utama');

-- --------------------------------------------------------

--
-- Table structure for table `m_group_wilayah`
--

CREATE TABLE `m_group_wilayah` (
  `id` int(1) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_group_wilayah`
--

INSERT INTO `m_group_wilayah` (`id`, `nama`) VALUES
(1, 'Provinsi'),
(2, 'Kabupaten/Kota');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenjang_fungsional`
--

CREATE TABLE `m_jenjang_fungsional` (
  `id` int(2) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `id_kategori_fungsional` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jenjang_fungsional`
--

INSERT INTO `m_jenjang_fungsional` (`id`, `nama`, `id_kategori_fungsional`) VALUES
(0, 'Tidak Ada', 0),
(1, 'Pemula', 1),
(2, 'Terampil', 1),
(3, 'Mahir', 1),
(4, 'Penyelia', 1),
(5, 'Pelaksana Pemula', 1),
(6, 'Pelaksana', 1),
(7, 'Pelaksana Lanjutan', 1),
(8, 'Penyelia', 1),
(9, 'Pertama', 2),
(10, 'Muda', 2),
(11, 'Madya', 2),
(12, 'Utama', 2);

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori_fungsional`
--

CREATE TABLE `m_kategori_fungsional` (
  `id` int(1) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alias` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kategori_fungsional`
--

INSERT INTO `m_kategori_fungsional` (`id`, `nama`, `alias`) VALUES
(0, 'Tidak Ada', 'NONE'),
(1, 'Keterampilan', 'Terampil'),
(2, 'Keahlian', 'Ahli');

-- --------------------------------------------------------

--
-- Table structure for table `m_pegawai`
--

CREATE TABLE `m_pegawai` (
  `id` int(4) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip_baru` varchar(25) NOT NULL,
  `nip_lama` varchar(10) NOT NULL,
  `email_bps` varchar(100) NOT NULL,
  `id_golongan_pangkat` int(2) DEFAULT NULL,
  `id_sub_fungsi` int(2) DEFAULT NULL,
  `id_struktural` int(2) DEFAULT NULL,
  `id_fungsional` int(3) DEFAULT NULL,
  `id_jenjang_fungsional` int(2) DEFAULT NULL,
  `id_wilayah` int(4) DEFAULT NULL,
  `id_status_pegawai` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pegawai`
--

INSERT INTO `m_pegawai` (`id`, `nama`, `nip_baru`, `nip_lama`, `email_bps`, `id_golongan_pangkat`, `id_sub_fungsi`, `id_struktural`, `id_fungsional`, `id_jenjang_fungsional`, `id_wilayah`, `id_status_pegawai`) VALUES
(1, 'Ir. Faizal Anwar, M.T', '19650319 198802 1 001', '340011822', 'faizal.anwar@bps.go.id', 16, 3, 1, 0, 0, 1800, 7),
(2, 'Agung Erianto Juliandono, SST.', '19800729 200212 1 002', '340016495', 'agunge@bps.go.id', 12, 5, 2, 0, 0, 1800, 1),
(3, 'Atik Heriyandani, S.E.', '19671225 199403 2 001', '340014977', 'atikh@bps.go.id', 12, 13, 5, 6, 10, 1800, 1),
(4, 'Yuniarsih, S.E.', '19670612 199003 2 005', '340012451', 'yuniarsih@bps.go.id', 12, 13, 6, 1, 0, 1800, 1),
(5, 'Firna Novi Anggoro, S.H, M.H.', '19861123 201101 1 007', '340054784', 'firna@bps.go.id', 11, 13, 7, 6, 10, 1800, 1),
(6, 'Anggia Wulandari Harahap, S.Psi.', '19850324 201101 2 014', '340055674', 'anggiaw@bps.go.id', 11, 13, 7, 7, 10, 1800, 1),
(7, 'Nur Hendra Sunaryo, A.Md.', '19880921 201101 1 006', '340054797', 'hendra.sunaryo@bps.go.id', 9, 13, 6, 1, 0, 1800, 1),
(8, 'Muhammad Ridwan, SST.', '19781223 200012 1 004', '340016118', 'mridu@bps.go.id', 12, 15, 5, 10, 10, 1800, 1),
(9, 'Moviyanti, SST., M.Si.', '19820213 200412 2 001', '340017315', 'moviyanti@bps.go.id', 13, 11, 5, 4, 10, 1800, 1),
(10, 'Viamanda Izzania Putri, SST.', '19960105 201701 2 001', '340057823', 'viamanda.putri@bps.go.id', 10, 11, 6, 1, 0, 1800, 1),
(11, 'Soleh, A.Md.', '19830605 200604 1 002', '340018349', 'soleh@bps.go.id', 10, 11, 6, 1, 0, 1800, 1),
(12, 'Yudi Purwanto', '19761019 199803 1 001', '340015571', 'yudi.purwanto@bps.go.id', 10, 11, 6, 1, 0, 1800, 1),
(13, 'Nurjanah, S.Si, M.T', '19741204 199712 2 001', '340015494', 'nurjanah@bps.go.id', 13, 14, 7, 8, 10, 1800, 1),
(14, 'Sutikno, S.E.', '19641221 199102 1 002', '340012732', 'sutikno2@bps.go.id', 12, 14, 6, 1, 0, 1800, 1),
(15, 'Aatina Izzati Penta Harnowati, S.E., Ms.Ak', '19810517 200604 2 003', '340018428', 'aatina@bps.go.id', 10, 14, 6, 1, 0, 1800, 1),
(16, 'Arip Purwanto, A.Md.', '19850425 200902 1 005', '340051053', 'arip.poerwanto@bps.go.id', 9, 14, 7, 9, 3, 1800, 1),
(17, 'Singgih Adiwijaya, S.E.', '19860530 200911 1 001', '340053031', 'singgih.adiwijaya@bps.go.id', 10, 14, 6, 1, 0, 1800, 1),
(18, 'Maya Puspa Hati, A.Md.', '19820525 200901 2 005', '340052195', 'maya.hati@bps.go.id', 8, 14, 6, 1, 0, 1800, 1),
(19, 'Ir. Dhani Sukaryanti, M.M.', '19661218 199403 2 001', '340014908', 'dhanidede@bps.go.id', 13, 12, 5, 5, 10, 1800, 1),
(20, 'Supian, S.E.', '19680408 199101 1 002', '340012637', 'supian@bps.go.id', 12, 12, 6, 1, 0, 1800, 1),
(21, 'Eka Yusda, S.E.', '19750608 200912 2 001', '739999999', 'eka.yusda@bps.go.id', 11, 12, 6, 1, 0, 1800, 1),
(22, 'Santi Novitasari, S.E.', '19760327 199803 2 001', '340015570', 'santi.novitasari@bps.go.id', 11, 12, 6, 1, 0, 1800, 1),
(23, 'Prabudi Dharma, A.Md.', '19821012 201101 1 012', '340054800', 'prabudi.dharma@bps.go.id', 9, 12, 6, 1, 0, 1800, 1),
(24, 'Fransiska Suryani, A.Md.', '19880428 201101 2 012', '340054786', 'siskafran@bps.go.id', 9, 12, 6, 1, 0, 1800, 1),
(25, 'Risma Arisandi, A.Md.', '19870314 201003 2 001', '340053599', 'risma.arisandi@bps.go.id', 8, 12, 7, 2, 6, 1800, 1),
(26, 'Wikki Wildana', '19811101 200502 1 001', '340017536', 'wikki@bps.go.id', 8, 12, 6, 1, 0, 1800, 1),
(27, 'Desyana Khotiah', '19841227 200701 2 001', '340019460', 'desykhoti@bps.go.id', 8, 12, 6, 1, 0, 1800, 1),
(28, 'Heru Wijayanto', '19821008 200901 1 007', '340052117', 'heru.wijayanto@bps.go.id', 6, 12, 6, 1, 0, 1800, 1),
(29, 'Herman', '19770208 200701 1 020', '340019734', 'herman8@bps.go.id', 5, 12, 6, 1, 0, 1800, 1),
(30, 'Luxmaning Hutaki Widiastari, S.Psi.', '19870816 201101 2 017', '340054794', 'luxmaning@bps.go.id', 11, 13, 7, 0, 0, 1800, 2),
(31, 'Mas\'ud Rifai, SST.', '19771216 199912 1 001', '340015952', 'mas_ud@bps.go.id', 13, 6, 4, 2, 11, 1800, 1),
(32, 'Febiyana Qomariyah, SST. M.M.', '19830224 200412 2 002', '340017329', 'febiyana.qomariah@bps.go.id', 13, 16, 7, 2, 11, 1800, 1),
(33, 'Henny Surya Indraswari, SST.M.Si.', '19780626 200012 2 002', '340016258', 'hennys@bps.go.id', 13, 16, 5, 2, 10, 1800, 1),
(34, 'Yosep, SST.', '19760914 199901 1 001', '340015737', 'yosep@bps.go.id', 12, 16, 7, 2, 10, 1800, 1),
(35, 'Desliyani Tri Wandita, SST.', '19891202 201211 2 001', '340055754', 'desli@bps.go.id', 11, 16, 7, 2, 10, 1800, 1),
(36, 'M.E.Ivan Sihaloho, A.Md.', '19880519 200902 1 001', '340051214', 'ivan_sharon@bps.go.id', 9, 16, 7, 2, 7, 1800, 1),
(37, 'Irvan Patuan Marsahala Simamora, SST.', '19930501 201602 1 001', '340057430', 'irvan.simamora@bps.go.id', 10, 16, 7, 2, 9, 1800, 1),
(38, 'Ir. Sudarti', '19640912 199401 2 001', '340013841', 'sudarti2@bps.go.id', 12, 17, 5, 2, 10, 1800, 1),
(39, 'Radika Trianda, S.E.', '19851110 200604 1 003', '340018397', 'radika@bps.go.id', 10, 17, 7, 2, 9, 1800, 1),
(40, 'Nurdiansyah, SST.', '19860706 200902 1 003', '340050191', 'nurdi@bps.go.id', 12, 17, 7, 2, 10, 1800, 1),
(41, 'Gita Yudianingsih, S.Si.', '19710726 199903 2 002', '340015810', 'gitayudia@bps.go.id', 12, 18, 5, 2, 10, 1800, 1),
(42, 'K. Nurika Damayanti, Sst, M.Stat.', '19840116 200701 2 006', '340019178', 'nurika@bps.go.id', 12, 18, 7, 2, 10, 1800, 1),
(43, 'Budi Setiawan, SST., M.Si.', '19810423 200212 1 003', '340016435', 'boedhee@bps.go.id', 13, 6, 7, 0, 0, 1800, 7),
(44, 'Ir. Dwiyana Suharyati, M.M.', '19650411 199401 2 001', '340013848', 'dwiyana@bps.go.id', 14, 7, 4, 2, 11, 1800, 1),
(45, 'Dhyantanu Harsa, SST., M.M.', '19760215 199803 1 001', '340015573', 'dhyan@bps.go.id', 13, 19, 5, 2, 11, 1800, 1),
(46, 'Muhammad Ilham Salam, SST., M.Stat.', '19760625 199901 1 001', '340015752', 'm.salam@bps.go.id', 13, 24, 5, 2, 11, 1800, 1),
(47, 'Mertha Pessela, Sp, M.M.', '19760306 200604 2 001', '340018385', 'merthap@bps.go.id', 10, 19, 7, 2, 9, 1800, 1),
(48, 'Maya Narang Ali, SST., M.Si.', '19831202 200701 2 004', '340019183', 'narang.maya@bps.go.id', 12, 19, 7, 2, 10, 1800, 1),
(49, 'Ir. Wagiman Purwoko', '19670127 199203 1 001', '340013284', 'wagiman@bps.go.id', 13, 19, 6, 1, 0, 1800, 1),
(50, 'Hesti Ayuningtyas, SST.', '19930111 201602 2 001', '340057414', 'hestiayu@bps.go.id', 10, 19, 7, 2, 9, 1800, 1),
(51, 'Ir. Sri Rezkie Desmawati, M.E.', '19691221 199401 2 001', '340013846', 'srezki@bps.go.id', 13, 20, 5, 2, 10, 1800, 1),
(52, 'Hardianty, S.Si.', '19850117 200902 2 008', '340051152', 'hardianty@bps.go.id', 11, 20, 7, 2, 10, 1800, 1),
(53, 'Zulfiana Nurul Lathifah, S.Si.', '19940103 201903 2 001', '340059205', 'zulfiana.nurul@bps.go.id', 9, 20, 7, 2, 9, 1800, 1),
(54, 'John Knedi, S.Si, M.M.', '19680817 199103 1 010', '340012939', 'knedi@bps.go.id', 13, 21, 5, 2, 10, 1800, 1),
(55, 'Rochayatini, S.E.', '19830626 200604 2 026', '340018528', 'rochayatini@bps.go.id', 10, 21, 7, 2, 7, 1800, 1),
(56, 'Riduan, M.Si.', '19631102 198702 1 001', '340011683', 'riduan@bps.go.id', 14, 8, 4, 2, 11, 1800, 1),
(57, 'Ema Christiena B Wati, SST.', '19640123 198802 2 001', '340011809', 'ema@bps.go.id', 12, 22, 5, 2, 10, 1800, 1),
(58, 'Bayu Juniardi, S.E.', '19770607 200312 1 005', '340017168', 'bayuj@bps.go.id', 10, 22, 7, 2, 10, 1800, 1),
(59, 'Andrawina Susanto, S.Si.', '19860830 200902 2 009', '340051034', 'andrawina@bps.go.id', 11, 23, 5, 2, 10, 1800, 1),
(60, 'Teta Puti Sugesti, SST.', '19921110 201602 2 001', '340057614', 'teta.puti@bps.go.id', 10, 23, 7, 2, 9, 1800, 1),
(61, 'Arief Rahmanda Al-Mursyid, SST.', '19940324 201701 1 001', '340057926', 'arief.almursyid@bps.go.id', 10, 24, 7, 2, 9, 1800, 1),
(62, 'Tri Apriliya, S.E.', '19810427 200502 2 002', '340017775', 'tri.apriliya@bps.go.id', 9, 22, 7, 2, 7, 1800, 1),
(63, 'Nur Indah, S.E.', '19700603 199202 2 001', '340013041', 'nurindah@bps.go.id', 12, 24, 7, 2, 10, 1800, 1),
(64, 'Muhammad Shalih, S.Stat.', '19960829 201903 1 001', '340059201', 'm.shalih@bps.go.id', 9, 24, 7, 2, 9, 1800, 1),
(65, 'Annisa Nur Islami Warrohmah, SST.', '19920121 201412 2 001', '340056992', 'no.email@bps.go.id', 10, 22, 7, 0, 0, 1800, 6),
(66, 'Ir. Nurul Andriana', '19681109 199303 2 001', '340013629', 'andriananurul@bps.go.id', 13, 9, 4, 2, 11, 1800, 1),
(67, 'Drisnaf Swastyardi, S.Si., M.S.E., M.A.', '19731201 199512 1 001', '340015135', 'drisnaf@bps.go.id', 13, 25, 5, 2, 11, 1800, 1),
(68, 'Mega Astuti, SST.', '19770912 200012 2 001', '340016135', 'mega.astuti@bps.go.id', 12, 25, 7, 2, 10, 1800, 1),
(69, 'Sumapto', '19640427 198603 1 006', '340011341', 'zumapto@bps.go.id', 10, 25, 6, 1, 0, 1800, 1),
(70, 'Muhammad Sabiel Adi Prakasa, SST.', '19940914 201701 1 001', '340057701', 'sabiel.prakasa@bps.go.id', 9, 25, 6, 0, 0, 1800, 2),
(71, 'Nanto Dwi Cahyo, S.Tr.Stat.', '19961129 201912 1 001', '340059666', 'nanto.dwi@bps.go.id', 9, 25, 7, 2, 9, 1800, 1),
(72, 'Tribuana Kartika Sari, S.Si., M.S.E.', '19781116 199912 2 001', '340016005', 'tribuana_k@bps.go.id', 13, 26, 5, 2, 10, 1800, 1),
(73, 'Yeni Agustiawati, SST.', '19830815 200602 2 001', '340017860', 'yenia@bps.go.id', 11, 26, 7, 2, 10, 1800, 1),
(74, 'Clara Tridiana, Sst, M.S.E.', '19840921 200801 2 001', '340020079', 'clara_tridiana@bps.go.id', 12, 26, 7, 2, 10, 1800, 1),
(75, 'Gun Gun Nugraha, S.Si, M.S.E', '19810312 200902 1 005', '340051147', 'gun.nugraha@bps.go.id', 11, 27, 5, 2, 10, 1800, 1),
(76, 'Jafri', '19680508 199101 1 001', '340012700', 'jeff@bps.go.id', 10, 27, 6, 1, 0, 1800, 1),
(77, 'Wike Yulia, SST.', '19840724 200701 2 002', '340019160', 'wike_yulia@bps.go.id', 12, 27, 7, 2, 10, 1800, 1),
(78, 'Sudiyanto, S.Si., M.M.', '19710121 199312 1 002', '340013742', 'sudiyant@bps.go.id', 14, 10, 4, 3, 11, 1800, 1),
(79, 'Dewi Wahyuningsih, SST., M.Si.', '19790223 200012 2 001', '340016231', 'dewi@bps.go.id', 13, 30, 5, 2, 10, 1800, 1),
(80, 'Erika Haryulistiani Saksono, S.E.', '19850713 201101 1 009', '340054782', 'erika.hs@bps.go.id', 10, 30, 7, 2, 9, 1800, 1),
(81, 'Jua Mahardhika, SST., M.M.', '19791209 200212 1 001', '340016487', 'jua@bps.go.id', 13, 29, 5, 2, 11, 1800, 1),
(82, 'Bayu Prasetyo, Sst, M.Si.', '19861012 200902 1 002', '340050041', 'adabayu@bps.go.id', 12, 29, 7, 2, 10, 1800, 1),
(83, 'Emmayati, S.Si.', '19760425 199901 2 001', '340015735', 'emma@bps.go.id', 12, 29, 7, 2, 10, 1800, 1),
(84, 'Mudjono, B.St.', '19720410 199512 1 001', '340015134', 'mudjono@bps.go.id', 11, 29, 6, 1, 0, 1800, 1),
(85, 'Poniran', '19720709 199401 1 001', '340013870', 'poniran@bps.go.id', 10, 28, 6, 1, 0, 1800, 1),
(86, 'Mukhlis, SST.', '19950118 201701 1 001', '340057702', 'm.mukhlis@bps.go.id', 9, 28, 7, 2, 9, 1800, 1),
(87, 'Arifin Jafar, SST.', '19880117 201012 1 004', '340054279', 'arifinjafar@bps.go.id', 11, 28, 7, 0, 0, 1800, 2),
(88, 'Ratna Kusuma Ningrum, S.Si.', '19870129 201101 2 009', '340054405', 'rkningrum@bps.go.id', 10, 29, 7, 0, 9, 1800, 2),
(89, 'Eko Teguh Widodo, SST., M.Sc.', '19890310 201311 1 001', '340056266', 'ekoteguh@bps.go.id', 10, 28, 7, 3, 9, 1800, 1),
(90, 'Endang Retno Sri Subiyandani, S.Si, M.M.', '19641023 198802 2 001', '340011813', 'ersri@bps.go.id', 16, 3, 1, 0, 0, 1800, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_status_pegawai`
--

CREATE TABLE `m_status_pegawai` (
  `id` int(2) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alias` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_status_pegawai`
--

INSERT INTO `m_status_pegawai` (`id`, `nama`, `alias`) VALUES
(0, 'Tidak Aktif', 'NON_AKTIF'),
(1, 'Aktif', 'AKTIF'),
(2, 'Tugas Belajar', 'TB'),
(3, 'Cuti Melahirkan', 'CUTI_LAHIR'),
(4, 'Cuti Besar', 'CUTI_BESAR'),
(5, 'Cuti Tahunan', 'CUTI_TAHUNAN'),
(6, 'Cuti Luar Tanggungan Negara', 'CLTN'),
(7, 'Mutasi', 'MUTASI');

-- --------------------------------------------------------

--
-- Table structure for table `m_struktural`
--

CREATE TABLE `m_struktural` (
  `id` int(2) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `alias` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_struktural`
--

INSERT INTO `m_struktural` (`id`, `nama`, `alias`) VALUES
(1, 'Kepala BPS', 'KaBPS'),
(2, 'Kepala Bagian', 'Kabag'),
(3, 'Kepala Subbagian', 'Kasubbag'),
(4, 'Koordinator Fungsi', 'KF'),
(5, 'Subkoordinator Fungsi', 'SKF'),
(6, 'Pelaksana', 'Pelaksana'),
(7, 'Tidak Ada', 'NONE');

-- --------------------------------------------------------

--
-- Table structure for table `m_sub_fungsi`
--

CREATE TABLE `m_sub_fungsi` (
  `id` int(2) NOT NULL,
  `id_fungsi` int(1) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `id_group_wilayah` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_sub_fungsi`
--

INSERT INTO `m_sub_fungsi` (`id`, `id_fungsi`, `nama`, `alias`, `id_group_wilayah`) VALUES
(1, 0, 'Tidak Ada', 'NONE', 1),
(2, 0, 'Tidak Ada', 'NONE', 2),
(3, 1, 'Tidak Ada', 'NONE_KEPALA', 1),
(4, 1, 'Tidak Ada', 'NONE_KEPALA_KABKOTA', 2),
(5, 2, 'Tidak Ada', 'NONE_KABAG', 1),
(6, 3, 'Tidak Ada', 'NONE_KF_SOS', 1),
(7, 4, 'Tidak Ada', 'NONE_KF_PROD', 1),
(8, 5, 'Tidak Ada', 'NONE_KF_DIST', 1),
(9, 6, 'Tidak Ada', 'NONE_KF_NERWILIS', 1),
(10, 7, 'Tidak Ada', 'NONE_KF_IPDS', 1),
(11, 2, 'Perencanaan', 'PERENCANAAN', 1),
(12, 2, 'Umum', 'UMUM', 1),
(13, 2, 'Sumber Daya Manusia dan Hukum', 'SDM_HUKUM', 1),
(14, 2, 'Keuangan', 'KEUANGAN', 1),
(15, 2, 'Satuan Pelaksana Pengadaan Barang/Jasa', 'BARJAS', 1),
(16, 3, 'Statistik Kependudukan', 'SOSDUK', 1),
(17, 3, 'Statistik Kesejahteraan Rakyat', 'KESRA', 1),
(18, 3, 'Statistik Ketahanan Sosial', 'HANSOS', 1),
(19, 4, 'Statistik Pertanian', 'PERTANIAN', 1),
(20, 4, 'Statistik Industri', 'INDUSTRI', 1),
(21, 4, 'Statistik Pertambangan, Energi, dan Konstruksi', 'PEK', 1),
(22, 5, 'Statistik Harga Konsumen dan Harga Perdagangan Besar', 'HK_HPB', 1),
(23, 5, 'Statistik Keuangan dan Harga Produsen', 'KEU_HP', 1),
(24, 5, 'Statistik Niaga dan Jasa', 'NINJA', 1),
(25, 6, 'Neraca Produksi', 'PRODUKSI', 1),
(26, 6, 'Neraca Konsumsi', 'KONSUMSI', 1),
(27, 6, 'Analisis Statistik Lintas Sektor', 'ASLS', 1),
(28, 7, 'Integrasi Pengolahan Data', 'IPD', 1),
(29, 7, 'Jaringan dan Rujukan Statistik', 'JRS', 1),
(30, 7, 'Diseminasi dan Layanan Statistik', 'DLS', 1),
(31, 2, 'Subbagian Umum', 'SUBBAG_UMUM', 2),
(32, 3, 'Statistik Sosial', 'STAT_SOS', 2),
(33, 4, 'Statistik Produksi', 'STAT_PROD', 2),
(34, 5, 'Statistik Distribusi', 'STAT_DIST', 2),
(35, 6, 'Neraca Wilayah dan Analisis Statistik', 'NERWILIS', 2),
(36, 7, 'Integrasi Pengolahan dan Diseminasi Statistik', 'IPDS', 2),
(37, 8, 'Koordinator Statistik Kecamatan', 'KSK', 2);

-- --------------------------------------------------------

--
-- Table structure for table `m_tipe_wilayah`
--

CREATE TABLE `m_tipe_wilayah` (
  `id` int(1) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_tipe_wilayah`
--

INSERT INTO `m_tipe_wilayah` (`id`, `nama`) VALUES
(1, 'Provinsi'),
(2, 'Kabupaten'),
(3, 'Kota');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id` int(4) NOT NULL,
  `id_pegawai` int(4) DEFAULT NULL,
  `id_user_level` int(2) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id`, `id_pegawai`, `id_user_level`, `username`, `password_hash`, `status`) VALUES
(1, 1, 4, 'faizal.anwar', '340011822', 7),
(2, 2, 4, 'agunge', '340016495', 1),
(3, 3, 2, 'atikh', '340014977', 1),
(4, 4, 6, 'yuniarsih', '340012451', 1),
(5, 5, 6, 'firna', '340054784', 1),
(6, 6, 6, 'anggiaw', '340055674', 1),
(7, 7, 6, 'hendra.sunaryo', '340054797', 1),
(8, 8, 6, 'mridu', '340016118', 1),
(9, 9, 6, 'moviyanti', '340017315', 1),
(10, 10, 6, 'viamanda.putri', '340057823', 1),
(11, 11, 6, 'soleh', '340018349', 1),
(12, 12, 6, 'yudi.purwanto', '340015571', 1),
(13, 13, 6, 'nurjanah', '340015494', 1),
(14, 14, 6, 'sutikno2', '340012732', 1),
(15, 15, 6, 'aatina', '340018428', 1),
(16, 16, 6, 'arip.poerwanto', '340051053', 1),
(17, 17, 6, 'singgih.adiwijaya', '340053031', 1),
(18, 18, 6, 'maya.hati', '340052195', 1),
(19, 19, 6, 'dhanidede', '340014908', 1),
(20, 20, 6, 'supian', '340012637', 1),
(21, 21, 6, 'eka.yusda', '739999999', 1),
(22, 22, 6, 'santi.novitasari', '340015570', 1),
(23, 23, 6, 'prabudi.dharma', '340054800', 1),
(24, 24, 6, 'siskafran', '340054786', 1),
(25, 25, 6, 'risma.arisandi', '340053599', 1),
(26, 26, 6, 'wikki', '340017536', 1),
(27, 27, 6, 'desykhoti', '340019460', 1),
(28, 28, 6, 'heru.wijayanto', '340052117', 1),
(29, 29, 6, 'herman8', '340019734', 1),
(30, 30, 6, 'luxmaning', '340054794', 2),
(31, 31, 4, 'mas_ud', '340015952', 1),
(32, 32, 6, 'febiyana.qomariah', '340017329', 1),
(33, 33, 6, 'hennys', '340016258', 1),
(34, 34, 6, 'yosep', '340015737', 1),
(35, 35, 6, 'desli', '340055754', 1),
(36, 36, 6, 'ivan_sharon', '340051214', 1),
(37, 37, 6, 'irvan.simamora', '340057430', 1),
(38, 38, 6, 'sudarti2', '340013841', 1),
(39, 39, 6, 'radika', '340018397', 1),
(40, 40, 6, 'nurdi', '340050191', 1),
(41, 41, 6, 'gitayudia', '340015810', 1),
(42, 42, 6, 'nurika', '340019178', 1),
(43, 43, 6, 'boedhee', '340016435', 7),
(44, 44, 4, 'dwiyana', '340013848', 1),
(45, 45, 6, 'dhyan', '340015573', 1),
(46, 46, 6, 'm.salam', '340015752', 1),
(47, 47, 6, 'merthap', '340018385', 1),
(48, 48, 6, 'narang.maya', '340019183', 1),
(49, 49, 6, 'wagiman', '340013284', 1),
(50, 50, 6, 'hestiayu', '340057414', 1),
(51, 51, 6, 'srezki', '340013846', 1),
(52, 52, 6, 'hardianty', '340051152', 1),
(53, 53, 6, 'zulfiana.nurul', '340059205', 1),
(54, 54, 6, 'knedi', '340012939', 1),
(55, 55, 6, 'rochayatini', '340018528', 1),
(56, 56, 4, 'riduan', '340011683', 1),
(57, 57, 6, 'ema', '340011809', 1),
(58, 58, 6, 'bayuj', '340017168', 1),
(59, 59, 6, 'andrawina', '340051034', 1),
(60, 60, 6, 'teta.puti', '340057614', 1),
(61, 61, 6, 'arief.almursyid', '340057926', 1),
(62, 62, 6, 'tri.apriliya', '340017775', 1),
(63, 63, 6, 'nurindah', '340013041', 1),
(64, 64, 6, 'm.shalih', '340059201', 1),
(65, 65, 6, 'no.email', '340056992', 6),
(66, 66, 4, 'andriananurul', '340013629', 1),
(67, 67, 6, 'drisnaf', '340015135', 1),
(68, 68, 6, 'mega.astuti', '340016135', 1),
(69, 69, 6, 'zumapto', '340011341', 1),
(70, 70, 6, 'sabiel.prakasa', '340057701', 2),
(71, 71, 6, 'nanto.dwi', '340059666', 1),
(72, 72, 6, 'tribuana_k', '340016005', 1),
(73, 73, 6, 'yenia', '340017860', 1),
(74, 74, 6, 'clara_tridiana', '340020079', 1),
(75, 75, 6, 'gun.nugraha', '340051147', 1),
(76, 76, 6, 'jeff', '340012700', 1),
(77, 77, 6, 'wike_yulia', '340019160', 1),
(78, 78, 4, 'sudiyant', '340013742', 1),
(79, 79, 6, 'dewi', '340016231', 1),
(80, 80, 6, 'erika.hs', '340054782', 1),
(81, 81, 2, 'jua', '340016487', 1),
(82, 82, 6, 'adabayu', ' 340050041', 1),
(83, 83, 6, 'emma', '340015735', 1),
(84, 84, 6, 'mudjono', '340015134', 1),
(85, 85, 6, 'poniran', '340013870', 1),
(86, 86, 1, 'm.mukhlis', '340057702', 1),
(87, 87, 1, 'arifinjafar', '340054279', 2),
(88, 88, 6, 'rkningrum', '340054405', 2),
(89, 89, 1, 'ekoteguh', '340056266', 1),
(90, 90, 4, 'ersri', '340011813', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_user_level`
--

CREATE TABLE `m_user_level` (
  `id` int(2) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_user_level`
--

INSERT INTO `m_user_level` (`id`, `nama`, `status`) VALUES
(1, 'Super Administrator', 1),
(2, 'Administrator Provinsi', 1),
(3, 'Administrator Kabupaten/Kota', 1),
(4, 'Supervisor Provinsi', 1),
(5, 'Supervisor Kabupaten/Kota', 1),
(6, 'User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_wilayah`
--

CREATE TABLE `m_wilayah` (
  `id` int(4) NOT NULL,
  `id_group_wilayah` int(1) DEFAULT NULL,
  `id_tipe_wilayah` int(1) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `ibukota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_wilayah`
--

INSERT INTO `m_wilayah` (`id`, `id_group_wilayah`, `id_tipe_wilayah`, `nama`, `ibukota`) VALUES
(1800, 1, 1, 'Lampung', 'Bandar Lampung'),
(1801, 2, 2, 'Lampung Barat', 'Liwa'),
(1802, 2, 2, 'Tanggamus', 'Kota Agung'),
(1803, 2, 2, 'Lampung Selatan', 'Kalianda'),
(1804, 2, 2, 'Lampung Timur', 'Sukadana'),
(1805, 2, 2, 'Lampung Tengah', 'Gunung Sugih'),
(1806, 2, 2, 'Lampung Utara', 'Kotabumi'),
(1807, 2, 2, 'Way Kanan', 'Blambangan Umpu'),
(1808, 2, 2, 'Tulang Bawang', 'Menggala'),
(1809, 2, 2, 'Pesawaran', 'Gedong Tataan'),
(1810, 2, 2, 'Pringsewu', 'Pringsewu'),
(1811, 2, 2, 'Mesuji', 'Wiralaga Mulya'),
(1812, 2, 2, 'Tulang Bawang Barat', 'Panaragan'),
(1813, 2, 2, 'Pesisir Barat', 'Krui'),
(1871, 2, 3, 'Bandar Lampung', 'Bandar Lampung'),
(1872, 2, 3, 'Metro', 'Metro');

-- --------------------------------------------------------

--
-- Structure for view `daftar_pegawai_lengkap`
--
DROP TABLE IF EXISTS `daftar_pegawai_lengkap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ckpt6832`@`localhost` SQL SECURITY DEFINER VIEW `daftar_pegawai_lengkap`  AS SELECT `mp`.`id` AS `id`, `mp`.`nama` AS `nama`, `mp`.`nip_lama` AS `nip_lama`, `mp`.`nip_baru` AS `nip_baru`, `mgp`.`golongan` AS `golongan`, `mgp`.`pangkat` AS `pangkat`, if(`ms`.`nama` = 'Tidak Ada','',`ms`.`nama`) AS `jabatan_struktural_tambahan`, if(`mf`.`nama` = 'Tidak Ada','',`mf`.`nama`) AS `jabatan_fungsional`, if(`t1`.`kategori` = 'Tidak Ada' or `t1`.`jenjang` = 'Tidak Ada','',concat(if(`t1`.`kategori` = 'Terampil','',concat(`t1`.`kategori`,' ')),`t1`.`jenjang`)) AS `jenjang_fungsional`, if(`t2`.`sub_fungsi` = 'Tidak Ada','',`t2`.`sub_fungsi`) AS `sub_fungsi`, if(`t2`.`fungsi` = 'Tidak Ada','',`t2`.`fungsi`) AS `fungsi`, `t3`.`satker` AS `satker`, `msp`.`nama` AS `status_pegawai` FROM ((((((((select `mjf`.`id` AS `id`,`mkf`.`alias` AS `kategori`,`mjf`.`nama` AS `jenjang` from (`m_jenjang_fungsional` `mjf` join `m_kategori_fungsional` `mkf`) where `mjf`.`id_kategori_fungsional` = `mkf`.`id` order by `mjf`.`id`) `t1` join (select `msf`.`id` AS `id`,`msf`.`id_fungsi` AS `id_fungsi`,`msf`.`nama` AS `sub_fungsi`,`mf`.`nama` AS `fungsi` from (`m_sub_fungsi` `msf` join `m_fungsi` `mf`) where `msf`.`id_fungsi` = `mf`.`id` order by `msf`.`id`) `t2`) join (select `mw`.`id` AS `id`,concat('BPS ',`mtw`.`nama`,' ',`mw`.`nama`) AS `satker` from (`m_wilayah` `mw` join `m_tipe_wilayah` `mtw`) where `mw`.`id_tipe_wilayah` = `mtw`.`id` order by `mw`.`id`) `t3`) join `m_pegawai` `mp`) join `m_struktural` `ms`) join `m_fungsional` `mf`) join `m_golongan_pangkat` `mgp`) join `m_status_pegawai` `msp`) WHERE `mp`.`id_struktural` = `ms`.`id` AND `mp`.`id_fungsional` = `mf`.`id` AND `mp`.`id_golongan_pangkat` = `mgp`.`id` AND `mp`.`id_jenjang_fungsional` = `t1`.`id` AND `mp`.`id_sub_fungsi` = `t2`.`id` AND `mp`.`id_wilayah` = `t3`.`id` AND `mp`.`id_status_pegawai` = `msp`.`id` AND `mp`.`id_status_pegawai` not in (0,7) ORDER BY `t2`.`id_fungsi` ASC, `mp`.`id_sub_fungsi` ASC, `mp`.`id_struktural` ASC, `mp`.`nama` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_fungsi`
--
ALTER TABLE `m_fungsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_fungsional`
--
ALTER TABLE `m_fungsional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_golongan_pangkat`
--
ALTER TABLE `m_golongan_pangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_group_wilayah`
--
ALTER TABLE `m_group_wilayah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jenjang_fungsional`
--
ALTER TABLE `m_jenjang_fungsional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_m_kategori_fungsional_m_jenjang_fungsional` (`id_kategori_fungsional`);

--
-- Indexes for table `m_kategori_fungsional`
--
ALTER TABLE `m_kategori_fungsional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_pegawai`
--
ALTER TABLE `m_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_m_golongan_pangkat_m_pegawai` (`id_golongan_pangkat`),
  ADD KEY `fk_m_sub_fungsi_m_pegawai` (`id_sub_fungsi`),
  ADD KEY `fk_m_struktural_m_pegawai` (`id_struktural`),
  ADD KEY `fk_m_fungsional_m_pegawai` (`id_fungsional`),
  ADD KEY `fk_m_jenjang_fungsional_m_pegawai` (`id_jenjang_fungsional`),
  ADD KEY `fk_m_wilayah_m_pegawai` (`id_wilayah`),
  ADD KEY `fk_m_status_pegawai_m_pegawai` (`id_status_pegawai`);

--
-- Indexes for table `m_status_pegawai`
--
ALTER TABLE `m_status_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_struktural`
--
ALTER TABLE `m_struktural`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_sub_fungsi`
--
ALTER TABLE `m_sub_fungsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_m_fungsi_m_sub_fungsi` (`id_fungsi`),
  ADD KEY `fk_m_group_wilayah_m_sub_fungsi` (`id_group_wilayah`);

--
-- Indexes for table `m_tipe_wilayah`
--
ALTER TABLE `m_tipe_wilayah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_m_user_level_m_user` (`id_user_level`),
  ADD KEY `fk_m_pegawai_m_user` (`id_pegawai`);

--
-- Indexes for table `m_user_level`
--
ALTER TABLE `m_user_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_wilayah`
--
ALTER TABLE `m_wilayah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_m_tipe_wilayah_m_wilayah` (`id_tipe_wilayah`),
  ADD KEY `fk_m_group_wilayah_m_wilayah` (`id_group_wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_golongan_pangkat`
--
ALTER TABLE `m_golongan_pangkat`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `m_group_wilayah`
--
ALTER TABLE `m_group_wilayah`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_pegawai`
--
ALTER TABLE `m_pegawai`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `m_struktural`
--
ALTER TABLE `m_struktural`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_sub_fungsi`
--
ALTER TABLE `m_sub_fungsi`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `m_tipe_wilayah`
--
ALTER TABLE `m_tipe_wilayah`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `m_user_level`
--
ALTER TABLE `m_user_level`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_jenjang_fungsional`
--
ALTER TABLE `m_jenjang_fungsional`
  ADD CONSTRAINT `fk_m_kategori_fungsional_m_jenjang_fungsional` FOREIGN KEY (`id_kategori_fungsional`) REFERENCES `m_kategori_fungsional` (`id`);

--
-- Constraints for table `m_pegawai`
--
ALTER TABLE `m_pegawai`
  ADD CONSTRAINT `fk_m_fungsional_m_pegawai` FOREIGN KEY (`id_fungsional`) REFERENCES `m_fungsional` (`id`),
  ADD CONSTRAINT `fk_m_golongan_pangkat_m_pegawai` FOREIGN KEY (`id_golongan_pangkat`) REFERENCES `m_golongan_pangkat` (`id`),
  ADD CONSTRAINT `fk_m_jenjang_fungsional_m_pegawai` FOREIGN KEY (`id_jenjang_fungsional`) REFERENCES `m_jenjang_fungsional` (`id`),
  ADD CONSTRAINT `fk_m_status_pegawai_m_pegawai` FOREIGN KEY (`id_status_pegawai`) REFERENCES `m_status_pegawai` (`id`),
  ADD CONSTRAINT `fk_m_struktural_m_pegawai` FOREIGN KEY (`id_struktural`) REFERENCES `m_struktural` (`id`),
  ADD CONSTRAINT `fk_m_sub_fungsi_m_pegawai` FOREIGN KEY (`id_sub_fungsi`) REFERENCES `m_sub_fungsi` (`id`),
  ADD CONSTRAINT `fk_m_wilayah_m_pegawai` FOREIGN KEY (`id_wilayah`) REFERENCES `m_wilayah` (`id`);

--
-- Constraints for table `m_sub_fungsi`
--
ALTER TABLE `m_sub_fungsi`
  ADD CONSTRAINT `fk_m_fungsi_m_sub_fungsi` FOREIGN KEY (`id_fungsi`) REFERENCES `m_fungsi` (`id`),
  ADD CONSTRAINT `fk_m_group_wilayah_m_sub_fungsi` FOREIGN KEY (`id_group_wilayah`) REFERENCES `m_group_wilayah` (`id`);

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `fk_m_pegawai_m_user` FOREIGN KEY (`id_pegawai`) REFERENCES `m_pegawai` (`id`),
  ADD CONSTRAINT `fk_m_user_level_m_user` FOREIGN KEY (`id_user_level`) REFERENCES `m_user_level` (`id`);

--
-- Constraints for table `m_wilayah`
--
ALTER TABLE `m_wilayah`
  ADD CONSTRAINT `fk_m_group_wilayah_m_wilayah` FOREIGN KEY (`id_group_wilayah`) REFERENCES `m_group_wilayah` (`id`),
  ADD CONSTRAINT `fk_m_tipe_wilayah_m_wilayah` FOREIGN KEY (`id_tipe_wilayah`) REFERENCES `m_tipe_wilayah` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
