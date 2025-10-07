-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2025 at 02:32 PM
-- Server version: 10.11.11-MariaDB-cll-lve
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u4715417_ksb_karir`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_quiz`
--

CREATE TABLE `access_quiz` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` enum('is_active','is_deactive') DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access_quiz`
--

INSERT INTO `access_quiz` (`id`, `kode`, `start`, `date`, `status`, `updated_at`) VALUES
(1, '1234', '2023-07-12 11:01:00', '2023-07-12 11:04:00', 'is_deactive', '2023-07-18 23:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2022_05_20_013001_create_kredit_table', 1),
(12, '2022_06_15_062843_create_debitur_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('abdul.taufiq1712@gmail.com', 'Ozz3T6wrm343jPOsSBKA4SWMTfcm6MY1QWimt0YJ9gyhqPWIltRI7pjzpgU1', '2025-04-15 10:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `permission_access_tokens`
--

CREATE TABLE `permission_access_tokens` (
  `id` int(10) NOT NULL,
  `date` date DEFAULT NULL,
  `status` enum('is_active','is_deactive') DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_access_tokens`
--

INSERT INTO `permission_access_tokens` (`id`, `date`, `status`, `updated_at`) VALUES
(1, '2030-01-01', 'is_active', '2025-06-03 16:45:09');

--
-- Triggers `permission_access_tokens`
--
DELIMITER $$
CREATE TRIGGER `access_tokens` BEFORE UPDATE ON `permission_access_tokens` FOR EACH ROW BEGIN
	IF CURDATE() <= new.date THEN
		SET new.status = 'is_active';
	ELSE
		SET new.status = 'is_deactive';
	END IF;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_loker`
--

CREATE TABLE `tb_loker` (
  `id_loker` int(10) NOT NULL,
  `posisi` varchar(255) DEFAULT NULL,
  `kualifikasi` varchar(5000) DEFAULT NULL,
  `tgl_berakhir` date DEFAULT NULL,
  `status` enum('Active','Non-active') DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_loker`
--

INSERT INTO `tb_loker` (`id_loker`, `posisi`, `kualifikasi`, `tgl_berakhir`, `status`, `gambar`, `created_at`, `updated_at`) VALUES
(61, 'Account Officer Kredit (Marketing)', '<h1>SPESIFIKASI</h1><ul><li>Pendidikan Minimal SMA/SMK,&nbsp;</li><li>Pengalaman Marketing Perbankan minimal 1 th diutamakan</li><li>Strategi pemasaran dan Selling Skill yang baik. (komunikasi &amp;negosiasi)</li><li>Melakukan proses penjualan produk kredit dan maintenance nasabah</li><li>Terbuka untuk Freshgraduate&nbsp;</li><li>Penempatan Seluruh Kantor Cabang&nbsp;</li></ul><h1>BENEFIT</h1><ul><li>Gaji Pokok</li><li>Tunjangan&nbsp;</li><li>Insentif</li><li>Fasilitas BPJS</li></ul><div><strong>JARINGAN KANTOR PT BPR KUSUMA SUMBING</strong></div><ul><li>Kantor Pusat Operasional Parakan</li><li>Kantor Cabang Temanggung</li><li>Kantor Cabang Wonosobo</li><li>Kantor Cabang Ambarawa</li><li>Kantor Cabang Semarang</li><li>Kantor Cabang Mranggen</li><li>Kantor Cabang Sukorejo</li><li>Kantor Cabang Weleri</li><li>Kantor Cabang Delanggu</li><li>Kantor Cabang Gombong</li><li>Kantor Cabang Sokaraja</li></ul>', '2025-12-31', 'Active', 'AO Kredit ALL.png', '2024-07-23 14:03:51', '2025-03-21 11:17:12'),
(71, 'KASI KOMERSIAL', '<h1><strong>Spesifikasi</strong></h1><div><br></div><ul><li>Pendidikan Minimal D3,&nbsp;</li><li>Memiliki pengalaman kerja minimal 2 (dua) tahun di industri perbankan</li><li>Menguasai strategi pemasaran , selling skill yang baik, termasuk keterampilan komunikasi dan negosiasi yang efektif.</li><li>Berpengalaman dalam penanganan kredit bermasalah, memiliki kemampuan analisa kredit yang kuat.</li><li>Memiliki integritas tinggi, jiwa kepemimpinan, serta keterampilan komunikasi interpersonal yang baik.</li><li>Bersedia untuk ditempatkan di seluruh kantor cabang PT BPR Kusuma Sumbing</li></ul><h1><strong>Benefit</strong></h1><ul><li>Gaji Pokok</li><li>Tunjangan&nbsp;</li><li>Insentif</li><li>Fasilitas BPJS</li></ul><div><br><strong>JARINGAN KANTOR PT BPR KUSUMA SUMBING</strong></div><ul><li>Kantor Pusat Operasional Parakan</li><li>Kantor Cabang Temanggung</li><li>Kantor Cabang Wonosobo</li><li>Kantor Cabang Ambarawa</li><li>Kantor Cabang Semarang</li><li>Kantor Cabang Mranggen</li><li>Kantor Cabang Sukorejo</li><li>Kantor Cabang Weleri</li><li>Kantor Cabang Delanggu</li><li>Kantor Cabang Gombong</li><li>Kantor Cabang Sokaraja</li></ul>', '2026-01-01', 'Active', 'Kasi Komersial All.png', '2024-10-09 15:41:43', '2025-06-03 16:24:04'),
(74, 'AUDIT INTERNAL', '<h1>SPESIFIKASI</h1><ul><li>Maksimal 40th,&nbsp;</li><li>Pendidikan minimal D3 ,&nbsp;</li><li>Pengalaman Internal Audit minimal 2 tahun,</li><li>Menguasai Teknik pelaksanaan audit, Penyusunan Program audit, dan Manajemen risiko</li><li>Berintegritas</li><li>Bersedia di tempatkan di Seluruh Kantor PT BPR Kusuma Sumbing</li></ul><h1>BENEFIT</h1><ul><li>Gaji Pokok</li><li>Tunjangan&nbsp;</li><li>Fasilitas BPJS</li></ul><div><strong>JARINGAN KANTOR PT BPR KUSUMA SUMBING</strong></div><ul><li>Kantor Pusat Operasional Parakan</li><li>Kantor Cabang Temanggung</li><li>Kantor Cabang Wonosobo</li><li>Kantor Cabang Ambarawa</li><li>Kantor Cabang Semarang</li><li>Kantor Cabang Mranggen</li><li>Kantor Cabang Sukorejo</li><li>Kantor Cabang Weleri</li><li>Kantor Cabang Delanggu</li><li>Kantor Cabang Gombong</li><li>Kantor Cabang Sokaraja</li></ul><div><br></div>', '2025-12-31', 'Active', 'WhatsApp Image 2025-03-14 at 12.19.23.jpeg', '2025-03-21 11:13:21', '2025-03-21 11:13:21'),
(75, 'Analis Kredit', '<h1>SPESIFIKASI</h1><ul><li>Pendidikan minimal D3</li><li>Pengalaman sebagai Analis Kredit minimal 2 th</li><li>Menguasai proses analisa kredit, kelayakan usaha (5+1 C) dan manajemen risiko kredit</li><li>Memiliki SIM C, diutamakan memiliki SIM A</li><li>Memiliki kemampuan analitis, motivatif dan berintegritas</li><li>Penempatan Seluruh Kantor Cabang&nbsp;</li></ul><h1>BENEFIT</h1><ul><li>Gaji Pokok</li><li>Tunjangan&nbsp;</li><li>Fasilitas BPJS</li></ul><div><strong>JARINGAN KANTOR PT BPR KUSUMA SUMBING</strong></div><ul><li>Kantor Pusat Operasional Parakan</li><li>Kantor Cabang Temanggung</li><li>Kantor Cabang Wonosobo</li><li>Kantor Cabang Ambarawa</li><li>Kantor Cabang Semarang</li><li>Kantor Cabang Mranggen</li><li>Kantor Cabang Sukorejo</li><li>Kantor Cabang Weleri</li><li>Kantor Cabang Delanggu</li><li>Kantor Cabang Gombong</li><li>Kantor Cabang Sokaraja</li></ul><div><br></div>', '2025-12-31', 'Active', 'ANALIS KREDIT AREA.png', '2025-05-28 12:07:30', '2025-05-28 12:07:30'),
(76, 'Pemimpin Cabang', '<h1><strong>Spesifikasi</strong></h1><ul><li>Pendidikan minimal S1,&nbsp;</li><li>Memiliki pengalaman minimal 3 tahun di industri perbankan, dengan pengalaman minimal 2 tahun sebagai pimpinan cabang atau posisi manajerial di BPR/bank.</li><li>Memahami produk dan layanan BPR&nbsp;</li><li>Mampu membaca dan menganalisis laporan keuangan serta laporan kredit.</li><li>Berintegritas Memiliki jiwa kepemimpinan dan keterampilan komunikasi yang baik.</li><li>Bersedia di tempatkan di Seluruh Kantor PT BPR Kusuma Sumbing</li></ul><h1><strong>BENEFIT</strong></h1><ul><li>Gaji Pokok</li><li>Tunjangan&nbsp;</li><li>Fasilitas BPJS</li><li>Insentif</li></ul><div><br><strong>JARINGAN KANTOR PT BPR KUSUMA SUMBING</strong></div><ul><li>Kantor Pusat Operasional Parakan</li><li>Kantor Cabang Temanggung</li><li>Kantor Cabang Wonosobo</li><li>Kantor Cabang Ambarawa</li><li>Kantor Cabang Semarang</li><li>Kantor Cabang Mranggen</li><li>Kantor Cabang Sukorejo</li><li>Kantor Cabang Weleri</li><li>Kantor Cabang Delanggu</li><li>Kantor Cabang Gombong</li><li>Kantor Cabang Sokaraja</li></ul>', '2026-01-01', 'Active', 'Pemimpin Cabang All.png', '2025-06-03 16:25:29', '2025-06-03 16:25:29'),
(77, 'Remedial/Penagihan', '<h1><strong>Spesifikasi</strong></h1><ul><li>Pendidikan Minimal D3</li><li>Pengalaman dibidang Penagihan minimal 1 tahun</li><li>Kemampuan Negosiasi, lelang dan teknik litigasi dan non litigasi</li><li>Komunikatif dan Persuasif</li><li>Penempatan seluruh kantor BPR Kusuma Sumbing</li></ul><h1><strong>BENEFIT</strong></h1><ul><li>Gaji Pokok</li><li>Tunjangan&nbsp;</li><li>Insentif</li><li>Fasilitas BPJS</li></ul><div><strong>JARINGAN KANTOR PT BPR KUSUMA SUMBING</strong></div><ul><li>Kantor Pusat Operasional Parakan</li><li>Kantor Cabang Temanggung</li><li>Kantor Cabang Wonosobo</li><li>Kantor Cabang Ambarawa</li><li>Kantor Cabang Semarang</li><li>Kantor Cabang Mranggen</li><li>Kantor Cabang Sukorejo</li><li>Kantor Cabang Weleri</li><li>Kantor Cabang Delanggu</li><li>Kantor Cabang Gombong</li><li>Kantor Cabang Sokaraja</li></ul>', '2026-01-01', 'Active', 'Remedial All.png', '2025-06-03 16:26:57', '2025-06-03 16:29:43'),
(78, 'PE Audit Internal', '<h1><strong>Spesifikasi</strong></h1><ul><li>Pendidikan minimal S1,&nbsp;</li><li>Pengalaman Internal Audit minimal 2 tahun,</li><li>Menguasai Teknik pelaksanaan audit, Penyusunan Program audit, dan Manajemen risiko</li><li>Integritas tinggi dan independen dalam bekerja.</li><li>Memiliki leadership dan manajemen tim yang baik</li><li>Bersedia di tempatkan di Seluruh Kantor PT BPR Kusuma Sumbing</li></ul><div><strong>Spesifikasi pendukung: Bersertifikasi PE Audit Internal<br></strong><br></div><h1><strong>BENEFIT</strong></h1><ul><li>Gaji Pokok</li><li>Tunjangan&nbsp;</li><li>Fasilitas BPJS</li></ul><div><strong>JARINGAN KANTOR PT BPR KUSUMA SUMBING</strong></div><ul><li>Kantor Pusat Operasional Parakan</li><li>Kantor Cabang Temanggung</li><li>Kantor Cabang Wonosobo</li><li>Kantor Cabang Ambarawa</li><li>Kantor Cabang Semarang</li><li>Kantor Cabang Mranggen</li><li>Kantor Cabang Sukorejo</li><li>Kantor Cabang Weleri</li><li>Kantor Cabang Delanggu</li><li>Kantor Cabang Gombong</li><li>Kantor Cabang Sokaraja</li></ul>', '2026-01-01', 'Active', 'PE Audit.png', '2025-06-03 16:29:15', '2025-06-03 16:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelamar`
--

CREATE TABLE `tb_pelamar` (
  `id_pelamar` int(10) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `domisili` varchar(255) DEFAULT NULL,
  `jns_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_telp` varchar(14) DEFAULT NULL,
  `no_wa` varchar(14) DEFAULT NULL,
  `posisi` varchar(255) DEFAULT NULL,
  `pendidikan` enum('SD','SMP/Sederajat','SMA/Sederajat','D1','D2','D3','Bachelor/S1','Master/S2','Doctor/S3') DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `berkas_pendukung` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pelamar`
--

INSERT INTO `tb_pelamar` (`id_pelamar`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `domisili`, `jns_kelamin`, `email`, `no_telp`, `no_wa`, `posisi`, `pendidikan`, `jurusan`, `berkas_pendukung`, `created_at`, `updated_at`) VALUES
(9, 'Ikhwan', 'Kendal', '1987-10-18', 'DKH. Karanganyar RT 01 RW 02 Desa. Tamangede Kec. Gemuh Kab. Kendal', 'DKH. Karanganyar RT 01 RW 02 Desa. Tamangede Kec. Gemuh Kab. Kendal', 'Laki-laki', 'kdlikhwan@gmail.com', '082220910111', '082220910111', 'Analis Kredit', 'Bachelor/S1', 'Pendidikan BHS Inggris', 'CV 2022.pdf', '2023-02-09 21:56:38', '2023-02-09 21:56:38'),
(12, 'DEDDY KURNIAWAN KRISTIANTO', 'TEMANGGUNG', '1983-03-18', 'JL. KRAKATAU II/22, RT.2/1, KEL. KARANGTEMPEL, KEC. SEMARANG TIMUR, KOTA. SEMARANG.', 'KASANAN, RT.2/1, KEL. KRANGGAN, KEC. KRANGGAN, KAB. TEMANGGUNG', 'Laki-laki', 'KURNIAWANEV@PROTONMAIL.COM', '085283999852', '085283999852', 'Account Officer (AO)/ Marketing Kredit', 'Bachelor/S1', 'EKONOMI', 'BPRKS.pdf', '2023-02-23 21:13:59', '2023-02-23 21:13:59'),
(13, 'BAGUS HARYO SUSENO', 'SEMARANG', '1990-12-07', 'MUSTOKOWENI III / 161 PLOMBOKAN SEMARANG', 'SATRIA UTARA H-209 PLOMBOKAN SEMARANG', 'Laki-laki', 'bagus.haryosuseno90@gmail.com', '081901417076', '081901417076', 'Internal Audit', 'Master/S2', 'MANAGEMENT SUMBER DAYA MANUSIA', 'PT BANK PERKREDITAN RAKYAT KUSUMA SUMBING.pdf', '2023-02-28 13:07:23', '2023-02-28 13:07:23'),
(14, 'DEDDY KURNIAWAN KRISTIANTO', 'TEMANGGUNG', '1983-03-18', 'JL. KRAKATAU II/22, RT.2/1, KEL. KARANGTEMPEL, KEC. SEMARANG TIMUR, KOTA. SEMARANG.', 'KASANAN, RT.3/4, KEL. KRANGGAN, KEC. KRANGGAN, KAB. TEMANGGUNG.', 'Laki-laki', 'KURNIAWANEV@PROTONMAIL.COM', '085742477017', '085283999852', 'Account Officer (AO)/ Marketing Kredit', 'Bachelor/S1', 'FAKULTAS EKONOMI - JURUSAN AKUNTANSI', 'CV 2023 bprks pdf.pdf', '2023-03-02 13:20:40', '2023-03-02 13:20:40'),
(16, 'Rohmatun Khasanah', 'Temanggung', '1998-09-23', 'Purwodadi rt 003 rw 006, Banjarsari Kandangan, Temanggung', 'Grumbul, Mojayan, Klaten Tengah', 'Perempuan', 'rahma23khasanah@gmail.com', '082136276827', '082136276827', 'TELLER/ KASIR', 'Bachelor/S1', 'Perbankan Syariah', 'Teller_ PT BPR Kusuma Sumbing.pdf', '2023-03-09 19:56:32', '2023-03-09 19:56:32'),
(17, 'Ridatul Miftiyah', 'Temanggung', '1994-12-27', 'Sayangan RT 2 RW 2 Ngadirejo, Temanggung', 'Sayangan RT 2 RW 2 Ngadirejo, Temanggung', 'Perempuan', 'ridatulmiftiyah@gmail.com', '081226178989', '081226178989', 'Internal Audit', 'Bachelor/S1', 'Manajemen', 'lamaran kerja_ridatul miftiyah_internal audit.pdf', '2023-03-24 11:53:07', '2023-03-24 11:53:07'),
(18, 'Ridatul Miftiyah', 'Temanggung', '1994-12-27', 'Sayangan RT 2 RW 2 Ngadirejo, Temanggung', 'Sayangan RT 2 RW 2 Ngadirejo, Temanggung', 'Perempuan', 'ridatulmiftiyah@gmail.com', '081226178989', '081226178989', 'Analis Kredit', 'Bachelor/S1', 'Manajemen', 'lamaran kerja_ridatul miftiyah_analis kredit.pdf', '2023-03-24 11:55:04', '2023-03-24 11:55:04'),
(19, 'MAHENDRA SUKRAHADYAN PRAKOSO', 'JAKARTA', '1980-09-18', 'JL BERINGIN BLOK B2 NO.117 RT 002 RW 005 PERUM BERKOH INDAH PURWOKERTO', 'JL BERINGIN BLOK B2 NO.117 RT 002 RW 005 PERUM BERKOH INDAH PURWOKERTO', 'Laki-laki', 'nata_de_koko@yahoo.com', '081327508818', '081327508818', 'Internal Audit', 'Bachelor/S1', 'ILMU KOMUNIKASI', 'LAMARAN, CV, KTP, FOTO, IJASAH, TRANSKRIP NILAI AN.MAHENDRA S P_INTERNAL AUDIT_SOKARAJA.pdf', '2023-03-30 11:47:53', '2023-03-30 11:47:53'),
(20, 'Hesdried Benedickta Ismanto', 'Pemalang', '1998-07-29', 'Jl. Lombok RT. 001 RW. 002, Desa Kaligelang, Taman, Pemalang 52361', 'Jl. Tambakaji RT 4 RW 11, Tambakaji, Kecamatan Ngaliyan, Kota Semarang 50185', 'Laki-laki', 'Hesdried998@gmail.com', '0895393342856', '0895393342856', 'STAFF ADMIN KREDIT & LEGAL', 'Bachelor/S1', 'Ilmu Hukum', 'Staf Admin Kredit&Legal_Hesdried Benedickta Ismanto.pdf', '2023-04-06 08:54:31', '2023-04-06 08:54:31'),
(21, 'Tri Adi Aryanto', 'Wonosobo', '1991-05-09', 'Jalan Kyai Muntang No 10 Wonosobo RT 3 RW 5', 'Jalan Kyai Muntang No 10 Wonosobo', 'Laki-laki', 'triadiaryanto91@gmail.com', '081328522491', '081328522491', 'Remedial/ Penagihan', 'D3', 'Akuntansi', 'Adi adi adi.pdf', '2023-04-07 17:58:34', '2023-04-07 17:58:34'),
(22, 'Tri Adi Aryanto', 'Wonosobo', '1991-05-09', 'Jalan Kyai Muntang No 10\r\nWonosobo', 'Jalan Kyai Muntang No 10 \r\nWonosobo', 'Laki-laki', 'triadiaryanto91@gmail.com', '081328522491', '081328522491', 'Remedial/ Penagihan', 'D3', 'Akuntansi', 'Adi adi adi.pdf', '2023-04-07 19:39:02', '2023-04-07 19:39:02'),
(24, 'LATIF ZEN ASHAR', 'KEBUMEN', '1995-06-24', 'GANG ANGGREK 1 NO 105 RT 002 RW 001 GOMBONG GOMBONG', 'GANG ANGGREK 1 NO 105 RT 002 RW 001 GOMBONG GOMBONG', 'Laki-laki', 'latiefzenashar@gmail.com', '082225936096', '082225936096', 'Account Officer (AO)/ Marketing Kredit', 'Bachelor/S1', 'Pendidikan Matematika', 'LATIF ZEN ASHAR.pdf', '2023-04-10 10:36:47', '2023-04-10 10:36:47'),
(25, 'Aisyah Dara Pamungkas', 'Jakarta', '2000-08-29', 'Jalan Belimbing No.26, Rt.011/001, Kec. Jagakarsa, Kel. Jagakarsa, Jakarta Selatan, DKI Jakarta', 'Jalan Watugunung I Gg II, No. 126, Krapyak, Semarang Barat, Kota Semarang', 'Perempuan', 'p.aisyahdara@gmail.com', '08980821023', '08980821023', 'STAFF ADMIN KREDIT & LEGAL', 'Bachelor/S1', 'Ilmu Hukum', 'STAFF LEGAL-AISYAH DARA PAMUNGKAS_11zon.pdf', '2023-04-18 11:57:10', '2023-04-18 11:57:10'),
(26, 'AGUSTIANI TARIYASARI', 'SEMARANG', '1992-08-19', 'JL. SRININDITO BARAT NO 7 SEMARANG', 'JL. SRININDITO BARAT NO 7 SEMARANG', 'Perempuan', 'agustiani.tariyasari@gmail.com', '085869811051', '085869811051', 'STAFF ADMIN TABUNGAN & DEPOSITO', 'Bachelor/S1', 'Kesehatan Masyarakat', 'BPR Kusuma Sumbing.pdf', '2023-05-16 00:04:49', '2023-05-16 00:04:49'),
(27, 'Devi Triyanti', '1999', '1999-12-28', 'Jl. Kemuning VIII RT 09 RW 21 Perumnas Bukit Sendangmulyo, Kecamatan Tembalang, Kota Semarang', 'Jl. Kemuning VIII RT 09 RW 21 Perumnas Bukit Sendangmulyo, Kecamatan Tembalang, Kota Semarang', 'Perempuan', 'devitriyantipmx3@gmail.com', '082334296830', '082334296830', 'STAFF ADMIN TABUNGAN & DEPOSITO', 'Bachelor/S1', 'Manajemen', 'CVku BPR Kusuma Sumbing.pdf', '2023-05-16 07:20:22', '2023-05-16 07:20:22'),
(28, 'Devi Triyanti', '1999', '1999-12-28', 'Jl. Kemuning VIII RT 09 RW 21 Perumnas Bukit sendangmulyo, Kecamatan Tembalang, Kota Semarang', 'Jl. Kemuning VIII RT 09 RW 21 Perumnas Bukit sendangmulyo, Kecamatan Tembalang, Kota Semarang', 'Perempuan', 'devitriyantipmx3@gmail.com', '082334296830', '082334296830', 'STAFF ADMIN TABUNGAN & DEPOSITO', 'Bachelor/S1', 'Manajemen', 'BPR Kusuma Sumbing.pdf', '2023-05-16 07:57:09', '2023-05-16 07:57:09'),
(29, 'RAHNI ARINI', 'KLATEN', '1993-10-31', 'SANTAN, RT20/RW07, MAYUNGAN, NGAWEN, KLATEN', 'SANTAN, RT20/RW07, MAYUNGAN, NGAWEN, KLATEN', 'Perempuan', 'rahniarini@gmail.com', '085743940067', '085743940067', 'STAFF ADMIN TABUNGAN & DEPOSITO', 'D3', 'EKONOMI DAN BISNIS', 'Staff Admin Tabungan dan Deposito.pdf', '2023-05-16 09:22:21', '2023-05-16 09:22:21'),
(30, 'Vemaniar Intan Oktaviana', 'Semarang', '1995-10-14', 'JL Menoreh Utara 2 no 2 sampangan Semarang', 'JL Menoreh Utara 2 no 2 sampangan Semarang', 'Perempuan', 'vemaniarintan@gmail.com', '087837472506', '087837472506', 'STAFF ADMIN KREDIT & LEGAL', 'Bachelor/S1', 'Hukum', 'Lamaran job intan BPR KUSUMA SUMBING.pdf', '2023-05-16 09:51:04', '2023-05-16 09:51:04'),
(31, 'Ade Irya Al Amin', 'Kendal', '1999-01-08', 'Cepit Kulon Rt 002/Rw 003 Pageruyung Kendal Jawa Tengah kode pos : 51361', 'Jl Sanggung Raya II No 21 Kontrakan Family Jatingaleh Candisari Kota Semarang kode pos 50254', 'Laki-laki', 'adeirya4545@gmail.com', '085888488984', '085888488984', 'STAFF ADMIN KREDIT & LEGAL', 'Bachelor/S1', 'Ilmu Hukum', 'surat lamaran BPR Kusuma Sumbang, Sertifikat UPA dan CV.pdf', '2023-05-19 16:06:37', '2023-05-19 16:06:37'),
(32, 'Dewi Anggi Santoso', 'Temanggung', '1999-04-11', 'Rejosari Selopampang RT 03 RW 03 SELOPAMPANG Temanggung Jawa Tengah', 'Temanggung', 'Perempuan', 'DEWIANGGI11.DA@GMAIL.COM', '08895410528', '08895410528', 'STAFF ADMIN TABUNGAN & DEPOSITO', 'Bachelor/S1', 'AKUNTANSI', '615593', '2023-05-20 07:49:20', '2023-05-20 07:49:20'),
(33, 'KEVIN MUHAMMAD BENNARIVO', 'Wonosobo', '1999-07-27', 'Satria Raya H-232 Semarang Utara', 'Satria Raya H-232 Semarang Utara', 'Laki-laki', 'kelvinmuhammad363@gmail.com', '0882006776030', '089674188466', 'STAFF ADMIN TABUNGAN & DEPOSITO', 'Bachelor/S1', 'Manajemen', 'Bprkusumasumbing.pdf', '2023-05-21 14:27:05', '2023-05-21 14:27:05'),
(34, 'Sabrina Alvionita Permatasari', 'Magelang', '1999-12-22', 'Dusun Permitan Rt 010 Rw 002 Desa Bondowoso Kecamatan Mertoyudan Kabupaten Magelang', 'Dusun Permitan Rt 010 Rw 002 Desa Bondowoso Kecamatan Mertoyudan Kabupaten Magelang', 'Perempuan', 'permatasari2212@gmail.com', '085842670900', '085842670900', 'STAFF ADMIN KREDIT & LEGAL', 'Bachelor/S1', 'Ilmu Hukum', 'Staff Admin Kredit & Legal _ Sabrina Alvionita Permatasari_ PT. BPR Kusuma Sumbing.pdf', '2023-05-21 22:59:50', '2023-05-21 22:59:50'),
(35, 'RENDIS ARFENDO', 'SEMARANG', '1997-11-06', 'Jl. Kebonharjo RT.01 RW.05 Kel. Tanjung Mas, Kec. Semarang Utara, Kota Semarang', 'Jl. Kebonharjo RT.01 RW.05 Kel. Tanjung Mas, Kec. Semarang Utara, Kota Semarang', 'Laki-laki', 'rendis_arfendo@yahoo.com', '0895321866954', '0895321866954', 'STAFF ADMIN TABUNGAN & DEPOSITO', 'Bachelor/S1', 'S1. Teknik Informatika', 'LAMARAN KERJA _ RENDIS ARFENDO _ STAFF ADMIN TABUNGAN - DEPOSITO.pdf', '2023-05-29 11:01:18', '2023-05-29 11:01:18'),
(36, 'Anastasia Anita Carolina Hadi', 'Semarang', '1996-05-06', 'Wonodri baru 1 no 6 RT 02 RW 02 Wonodri Semarang Selatan Semarang', 'Sda', 'Perempuan', 'anastasiaanita30@yahoo.com', '087824417238', '087824417238', 'STAFF ADMIN KREDIT & LEGAL', 'Bachelor/S1', 'Hukum', 'ANITA-STAFF LEGAL (1).pdf', '2023-05-29 20:18:28', '2023-05-29 20:18:28'),
(37, 'Nugraheny Nur Baruroh', 'Magelang', '1997-10-23', 'Salakan RT 02 RW 08, Girirejo, Tegalrejo, Magelang, Jawa Tengah', 'Salakan RT 02 RW 08, Girirejo, Tegalrejo, Magelang, Jawa Tengah (Bersedia di Semarang)', 'Perempuan', 'nugrahenynb@gmail.com', '08562695505', '08562695505', 'STAFF ADMIN TABUNGAN & DEPOSITO', 'Bachelor/S1', 'Manajemen', 'Lamaran Pekerjaan_Adm_Semarang_Nugraheny.pdf', '2023-05-30 14:07:55', '2023-05-30 14:07:55'),
(38, 'Dwi Fitriyaningrum', 'Batang', '2000-12-28', 'Dk Simbang Ds Margosono RT 06 RW 02', 'Dk Simbang Ds Margosono RT 06 RW 02', 'Perempuan', 'fitriyanidwi282@gmail.com', '081298776280', '081298776280', 'Account Officer (AO)/ Marketing Kredit', 'Bachelor/S1', 'Akuntansi', 'BPR Kusuma sumbing.pdf', '2023-07-04 16:14:49', '2023-07-04 16:14:49'),
(39, 'Dwi Fitriyaningrum', 'Batang', '2000-12-28', 'Dk Simbang Ds Margosono RT 06 RW 02 Kec Tersono Kab Batang', 'Dk Simbang Ds Margosono RT 06 RW 02 Kec Tersono Kab Batang', 'Perempuan', 'fitriyanidwi282@gmail.com', '081298776280', '081298776280', 'Account Officer (AO)/ Marketing Kredit', 'Bachelor/S1', 'Akuntansi', 'BPR Kusuma sumbing.pdf', '2023-07-04 16:18:40', '2023-07-04 16:18:40'),
(40, 'ANDI WAHYU SUSIAWAN', 'SALATIGA', '1981-07-05', 'KLAMPOK RT.03 RW.01 KECAMATAN GODONG KABUPATEN GROBOGAN', 'KLAMPOK RT.01 RW.01 KECAMATAN GODONG KABUPATEN GROBOGAN', 'Laki-laki', 'ANDI.SEMERU@YAHOO.COM', '085640829122', '085640829112', 'Account Officer (AO)/ Marketing Kredit', 'Bachelor/S1', 'ILMU HUKUM', 'Surat Lamaran PT Kusuma Sumbing.pdf', '2023-07-11 10:30:11', '2023-07-11 10:30:11'),
(41, 'KRESNA ANGGI SAKTI SAPUTRO', 'GROBOGAN', '1991-06-19', 'GEMOLONG, RT 003 / RW 003, GEMOLONG, SRAGEN', 'GEMOLONG, RT 003 / RW 003, GEMOLONG, SRAGEN', 'Laki-laki', 'KRESNAYANA27@GMAIL.COM', '085642329027', '085642329027', 'Remedial/ Penagihan', 'Bachelor/S1', 'Sistem Informasi', 'Kresna_Surat_Lamaran_PT BPR Kusuma Sumbing_Staf Remedial.pdf', '2023-08-03 12:41:02', '2023-08-03 12:41:02'),
(42, 'Geryhantoro Satrio Adi', 'Demak', '1990-11-18', 'Jl Flamboyan II E.15 RT.07/RW.05, Desa Katonsari, Kecamatan Demak, Kabupaten Demak', 'Jl Salam Asri I No.02 RT.02/RW.07, Desa Jogoloyo, Kecamatan Wonosalam, Kabupaten Demak', 'Laki-laki', 'geryhantoro@gmail.com', '085712488031', '085712488031', 'Account Officer (AO)/ Marketing Kredit', 'Bachelor/S1', 'Ekonomi-Akuntansi', 'AO_PT BPR KSB Mranggen.pdf', '2023-08-04 08:13:27', '2023-08-04 08:13:27'),
(43, 'VINCENTIUS HERBANGUN', 'WONOSOBO', '1989-09-27', 'SONTONAYAN KAPENCAR KERTEK WONOSOBO', 'CONDONG KEDAWUNG BANYUPUTIH BATANG', 'Laki-laki', 'VINCENTIUSHERBANGUN@GMAIL.COM', '082221041645', '082221041645', 'Remedial/ Penagihan', 'Bachelor/S1', 'PENDIDIKAN BAHASA DAN SASTRA INDONESIA', 'Lamaran Remedial Penempatan Weleri - BPR Kusuma Sumbing.pdf', '2023-08-04 11:14:42', '2023-08-04 11:14:42'),
(44, 'Kiki Sentia', 'Kudus', '1999-05-23', 'Ds. Kutuk Rt 04 rw 05 undaan kudus', 'Ds. Kutuk Rt 04 rw 05 undaan kudus', 'Perempuan', 'kikisentia23@gmail.com', '085602286656', '085602286656', 'Remedial/ Penagihan', 'Bachelor/S1', 'Manajemen', 'Kiki sentia_penagihan_BPR sumbing.pdf', '2023-08-07 18:06:37', '2023-08-07 18:06:37'),
(45, 'Muhammad Ageng Zam Fahira', 'Kendal', '1999-05-27', 'Getas kulon RT.3/RW.4 Getasblawong, pagerruyung, kendal', 'Glapansari tengah RT.4/RW.3 Glapansari, Parakan, Temanggung', 'Laki-laki', 'agengzamzamhir@gmail.com', '085861611705', '085861611705', 'Account Officer (AO) Kredit Cabang Temanggug', 'SMA/Sederajat', 'IPS', 'SLK_BPR[1].pdf', '2023-09-06 08:26:53', '2023-09-06 08:26:53'),
(46, 'Dian Supriyanto', 'Semarang', '1990-04-11', 'Jl. Penggaron kidul Rt. 1 Rw. 4 , kel. Penggaron kidul, kec. Pedurungan, Semarang', 'Jl. Penggaron Kidul Rt. 1 Rw. 4 , Kel. Penggaron kidul, kec. Pedurungan, Semarang', 'Laki-laki', 'diyansupp1990@gmail.com', '081567987473', '081567987473', 'Account Officer (AO)/ Marketing Kredit', 'SMA/Sederajat', 'IPS', 'DOC-20230926-WA0000..pdf', '2023-09-26 11:22:32', '2023-09-26 11:22:32'),
(47, 'Mohhamad Davin Aprileo Trimoko', 'Kendal', '1994-04-16', 'Kartikajaya Rt 006 Rw 002 Patebon Kendal', 'Lebo Rt 019 Rw 006 Bumiayu Weleri Kendal', 'Laki-laki', 'aprileodavin@gmail.com', '081901486574', '081901486574', 'Account Officer (AO)/ Marketing Kredit', 'SMA/Sederajat', 'Agribisnis Perikanan', 'Lamaran & CV Mohhamad Davin _compressed.pdf', '2023-10-15 08:16:39', '2023-10-15 08:16:39'),
(48, 'MOHHAMAD DAVIN APRILEO TRIMOKO', 'Kendal', '1994-04-16', 'Kartikajaya No.23 Rt 006 Rw 002 Patebon Kendal', 'Lebo Rt 019 Rw 002 Bumiayu Weleri Kendal', 'Laki-laki', 'aprileodavin@gmail.com', '081901486574', '081901486574', 'Account Officer (AO)/ Marketing Kredit', 'SMA/Sederajat', 'Agribisnis Perikanan', 'Lamaran & CV Mohhamad Davin _compressed.pdf', '2023-10-17 13:48:15', '2023-10-17 13:48:15'),
(49, 'Risdianto', 'Banyumas', '1985-02-28', 'Desa Ketenger Rt 02 Rw 03\r\nKec. Baturraden\r\nKab. Banyumas', 'Desa Ketenger Rt02 Rw 03\r\nKec. Baturraden\r\nKab. Banyumas', 'Laki-laki', 'baonk.gmtp064@gmail.com', '085647744443', '085647744443', 'Remedial/ Penagihan', 'D3', 'Teknik Mesin', 'CamScanner 23-10-2023 08.33.pdf', '2023-10-23 08:44:47', '2023-10-23 08:44:47'),
(50, 'Rohana Tri Astuti', 'Klaten', '1991-08-14', 'Jl. Sepakbola blok A3-5 waringinsari ngropoh, condongcatur, Depok,Sleman,DIY', 'Kalimangu, Tugu, Cawas, Klaten', 'Perempuan', 'rohana.triastuti91@gmail.com', '085878323031', '085878323031', 'Analis Kredit', 'Bachelor/S1', 'PENDIDIKAN  MATEMATIKA', 'Lamaran dan CV  Hanna PT. Bank Perkreditan Rakyat.pdf', '2023-10-26 15:08:37', '2023-10-26 15:08:37'),
(51, 'RISDIANTO', 'BANYUMAS', '1985-02-28', 'Desa Ketenger RT 02 RW 03\r\nKec. Baturraden\r\nKab. Banyumas', 'Desa Ketenger RT 02 RW 03\r\nKec. Baturraden\r\nKab. Banyumas', 'Laki-laki', 'baonk.gmtp064@gmail.com', '085647744443', '085647744443', 'Remedial/ Penagihan', 'D3', 'Teknik Mesin', 'CamScanner 23-10-2023 08.33.pdf', '2023-10-26 21:07:57', '2023-10-26 21:07:57'),
(52, 'FARHAN NAJIT HENDRIAN', 'Temanggung', '2003-12-25', 'PUTIHAN', 'Bansari', 'Laki-laki', 'farhanterate87@gmail.com', '085643091694', '082242630260', 'Account Officer (AO)/ Marketing Kredit', 'SMA/Sederajat', 'Agri bisnis tanaman pangan dan holtikultura', 'CV DATA DIRI FARHAN NAJIT HENDRIAN.pdf', '2023-10-30 08:23:27', '2023-10-30 08:23:27'),
(53, 'Yustinus Suryono', 'Magelang', '1971-04-19', 'Glagahsari UH IV.no 588 \r\nRt.23 Rw.05 Warungboto, Umbulharjo\r\nYogyakarta 55164', 'Glagahsari UH IV.no 588\r\nRt.23 Rw.05 Warungboto, Umbulharjo\r\nYogyakarta 55614', 'Laki-laki', 'suryono.yustinus@gmail.com', '081802777224', '081802777214', 'Analis Kredit', 'Bachelor/S1', 'Ekonomi Manajemen', 'CamScanner 03-11-2023 15.31.pdf', '2023-11-03 15:54:27', '2023-11-03 15:54:27'),
(54, 'Mohhamad Davin Aprileo Trimoko', 'Kendal', '1994-04-16', 'Kartikajaya No. 23 Rt 006 Rw 002 Patebon Kendal', 'Lebo Rt 019 Rw 006 Bumiayu Weleri Kendal', 'Laki-laki', 'aprileodavin@gmail.com', '081325007171', '081325007171', 'Account Officer (AO)/ Marketing Kredit', 'SMA/Sederajat', 'Agribisnis Perikanan', 'Lamaran & CV_Mohhamad Davin Aprileo Trimoko_compressed (1).pdf', '2023-11-05 10:06:15', '2023-11-05 10:06:15'),
(55, 'Kholisatul Azizah', 'Tegal', '1999-04-08', 'Jl. Banyuwangi 37A RT 06/01\r\nSumurpanggang, Kota Tegal', 'Jl. Banyuwangi 37A RT 06/01\r\nSumurpanggang, Kota Tegal', 'Perempuan', 'kholisatulazizah@gmail.com', '0895367311781', '0895367311781', 'Analis Kredit', 'Bachelor/S1', 'Manajemen', 'CV - Kholisatul Azizah.pdf', '2023-11-09 09:04:24', '2023-11-09 09:04:24'),
(56, 'ELGA ERWIN PERMAYUNIAN DIENG', 'MADIUN', '1987-06-15', 'DK BUDI MULIA RT 06 RW 08 PLANTARAN KEC. KALIWUNGU SELATAN KAB. KENDAL 51372', 'DK BUDI MULIA RT 06 RW 08 PLANTARAN KEC. KALIWUNGU SELATAN KAB. KENDAL 51372', 'Laki-laki', 'elgadieng@gmail.com', '081325560050', '081325560050', 'Analis Kredit', 'Bachelor/S1', 'KOMUNIKASI', 'CV dan Dokumen Elga Erwin.pdf', '2023-11-13 09:27:18', '2023-11-13 09:27:18'),
(57, 'dimas wicaksono', 'kudus', '1982-08-02', 'lingkungan karangwetan 02/01 manding temanggung 56224', 'lingkungan karangwetan 02/01 manding temanggung 56224', 'Laki-laki', 'wicaksono0208@gmail.com', '087839717705', '087839717705', 'Account Officer (AO) Kredit Cabang Temanggug', 'Bachelor/S1', 'ekonomi menejemen', 'Dimas Wicaksono (1).pdf', '2023-11-18 15:39:08', '2023-11-18 15:39:08'),
(58, 'Fitriana Lestari', 'Kab. Semarang', '2000-01-12', 'Jl. Lempuyang RT 05 RW 05 Bangunharjo Banyumanik Semarang', 'Jl. Lempuyang RT 05 RW 05 Bangunharjo Banyumanik Semarang', 'Perempuan', 'fitriana.lestari12@gmail.com', '085882698468', '085882698468', 'STAF ADMINISTRASI', 'Bachelor/S1', 'Hukum', 'Berkas Lamaran Fitriana Lestari.pdf', '2023-11-20 12:12:26', '2023-11-20 12:12:26'),
(59, 'ANNAS TRI CAHYO', 'KAB. SEMARANG', '1998-10-24', 'dusun krajan, rt.06/rw.01, desa kebondalem, kec. jambu, kab.semarang', 'dusun krajan, rt.06/rw.01, desa kebondalem, kec. jambu, kab.semarang', 'Laki-laki', 'annastricahyo@gmail.com', '0859159750024', '0859159750024', 'Analis Kredit', 'Bachelor/S1', 'ILMU HUKUM', 'Lamaran Pekerjaan_Annas Tri Cahyo.pdf', '2023-11-21 22:35:15', '2023-11-21 22:35:15'),
(60, 'Vanesa Agatha', 'Temanggung', '1997-08-27', 'Ngepoh 02/01, Badran, Kranggan, Temanggung', 'Ngepoh 02/01, Badran, Kranggan, Temanggung', 'Perempuan', 'vanesaagatha48@gmail.com', '0882006435595', '081329038078', 'STAF ADMINISTRASI', 'SMA/Sederajat', 'IPS', 'CV VANESA .pdf', '2023-12-02 22:03:41', '2023-12-02 22:03:41'),
(61, 'Dwi Fitriyaningrum', 'Batang', '2000-12-28', 'Dk Simbang Ds margosono RT 06 RW 02 kec tersono Kab Batang', 'Dk Simbang Ds margosono RT 06 RW 02 kec tersono Kab Batang', 'Perempuan', 'fitriyanidwi282@gmail.com', '081298776280', '081298776280', 'STAF ADMINISTRASI', 'Bachelor/S1', 'Akuntansi', 'Cv_Dwi Fitriyaningrum.pdf', '2023-12-05 20:55:11', '2023-12-05 20:55:11'),
(62, 'Vanesa Agatha', 'Temanggunh', '1997-08-27', 'Ngepoh 2/1, Badran, Kranggan, Temanggung', 'Ngepoh 2/1, Badran, Kranggan, Temanggung', 'Perempuan', 'vanesaagatha48@gmail.com', '0882006435595', '081329038078', 'STAF ADMINISTRASI', 'SMA/Sederajat', 'SMA-IPS', 'CV VANESA .pdf', '2023-12-11 16:55:06', '2023-12-11 16:55:06'),
(63, 'Andri Bagus Setiawan', 'Kudus', '1987-01-10', 'Desa Kemukus RT 001 RW 001 Kec Gombong Kab Kebumen', 'Perumahan Graha Mahardika II Gang Manggis No C94 Kelurahan Selang Kec Kebumen Kab Kebumen', 'Laki-laki', 'andriduhita1030@gmail.com', '082333904455', '082333904455', 'Internal Audit', 'Bachelor/S1', 'Pendidikan Matematika', 'CV Andri Bagus Setiawan.pdf', '2023-12-12 16:11:18', '2023-12-12 16:11:18'),
(64, 'Sekar Putri Widyajati', 'Temanggung', '1989-03-14', 'Perum Madureso Indah No 76 Rt 02 Rw 07 Temanggung', 'Perum Madureso Indah No 76 Rt 02 Rw 07 Temanggung', 'Perempuan', 'Sekarputryw@Gmail.com', '085640435248', '085640435248', 'STAF ADMINISTRASI', 'Bachelor/S1', 'Ekonomi Akutansi', 'sekar putri.pdf', '2023-12-31 22:56:03', '2023-12-31 22:56:03'),
(65, 'YETI SETIA NINGSIH', 'JEPARA', '1999-10-26', 'KRAJAN RT 005/RW 001, DESA KALIPUCANG WETAN, KECAMATAN WELAHAN, KABUPATEN JEPARA', 'KRAJAN RT 005/RW 001, DESA KALIPUCANG WETAN, KECAMATAN WELAHAN, KABUPATEN JEPARA', 'Perempuan', 'yetisetianingsih26@gmail.com', '089673561841', '089673561841', 'STAF ADMINISTRASI', 'Bachelor/S1', 'PENDIDIKAN EKONOMI ADMINISTRASI PERKANTORAN', 'Lamaran Kerja Yeti Setia Ningsih_Staff Administrasi.pdf', '2024-01-02 14:33:32', '2024-01-02 14:33:32'),
(66, 'YETI SETIA NINGSIH', 'JEPARA', '1999-10-26', 'KRAJAN RT 005/RW 001, DESA KALIPUCANG WETAN, KECAMATAN WELAHAN, KABUPATEN JEPARA', 'KRAJAN RT 005/RW 001, DESA KALIPUCANG WETAN, KECAMATAN WELAHAN, KABUPATEN JEPARA', 'Perempuan', 'yetisetianingsih26@gmail.com', '089673561841', '089673561841', 'STAF ADMINISTRASI', 'Bachelor/S1', 'PENDIDIKAN EKONOMI ADMINISTRASI PERKANTORAN', 'Lamaran Kerja Yeti Setia Ningsih_Staff Administrasi.pdf', '2024-01-02 14:37:56', '2024-01-02 14:37:56'),
(67, 'Dewi Saniyah', 'Surabaya', '1999-09-20', 'Jl. Dr. Wahidin Sudiro Husodo 7/11 RT 004/RW 003, Purutrejo, Purworejo, Kota Pasuruan', 'Jl. Dr. Wahidin Sudiro Husodo 7/11 RT 004/RW 003, Purutrejo, Purworejo, Kota Pasuruan', 'Perempuan', 'dewisaniyah@gmail.com', '085730312090', '085730312090', 'STAF ADMINISTRASI', 'D3', 'Akuntansi', 'Lamaran Pekerjaan_Dewi Saniyah_Staf Administrasi.pdf', '2024-01-02 15:54:50', '2024-01-02 15:54:50'),
(68, 'Fitriana Lestari', 'Kab. Semarang', '2000-01-12', 'jl. lempuyang RT 05 RW 05 Banyumanik Semarang', 'jl. lempuyang RT 05 RW 05 Banyumanik Semarang', 'Perempuan', 'fitriana.lestari12@gmail.com', '085882698468', '085882698468', 'STAF ADMINISTRASI', 'Bachelor/S1', 'Hukum', 'Berkas Lamaran Fitriana Lestari.pdf', '2024-01-04 15:00:06', '2024-01-04 15:00:06'),
(69, 'Mia Audina Dwi Agustian', 'Temanggung', '1996-08-30', 'Kenalan Rt 02 Rw 03, Kranggan, Temanggung, Jawa Tengah', 'Kenalan Rt 02 Rw 03, Kranggan, Temanggung, Jawa Tengah', 'Perempuan', 'mia.audina38.ma@gmail.com', '081269392271', '081269392217', 'STAF ADMINISTRASI', 'Bachelor/S1', 'Akuntansi', 'Berkas Mia Audina D.A S.Ak.pdf', '2024-01-09 13:04:49', '2024-01-09 13:04:49'),
(70, 'Bintang Akbar Maulana', 'Wonosobo', '1998-05-09', 'Diamond Cluster no 7 rt 05 rw 06 Pabuwaran Purwokerto Utara', 'Diamond Cluster no 7 rt 05 rw 06 Pabuwaran Purwokerto Utara', 'Laki-laki', 'bintangam50@gmail.com', '081217896765', '082242655957', 'Account Officer (AO)/ Marketing Kredit', 'Bachelor/S1', 'Managemen Transportasi Udara', 'Lamaran Kerja Bintang Akbar Maulana.pdf', '2024-01-15 13:04:32', '2024-01-15 13:04:32'),
(71, 'Theresia Hardiana Wulandari', 'Temanggung', '2000-12-18', 'Jl. Mujahidin no 46, Giyanti, Temanggung', 'Jl. Mujahidin no 46, Giyanti, Temanggung', 'Perempuan', 'theresiaadiana@gmail.com', '089512819257', '082138260456', 'STAF ADMINISTRASI', 'Bachelor/S1', 'Ekonomi', 'Theresia Hardiana_BPR Kusuma Sumbing.pdf', '2024-01-15 13:47:07', '2024-01-15 13:47:07'),
(72, 'DANIYANTI', 'BANTUL', '1991-07-31', 'KENTHENG RT004/RW002, DANUPAYAN, BULU, TEMANGGUNG, JAWA TENGAH', 'KENTHENG RT004/RW002, DANUPAYAN, BULU, TEMANGGUNG, JAWA TENGAH', 'Perempuan', 'dayantwibowo@gmail.com', '085328876851', '085328876851', 'STAF ADMINISTRASI', 'Bachelor/S1', 'ILMU EKONOMI', 'SURAT LAMARAN  PEKERJAAN_DANIYANTI - PT. BPR KUSUMA SUMBING...pdf', '2024-01-20 16:15:34', '2024-01-20 16:15:34'),
(73, 'DANIYANTI', 'BANTUL', '1991-07-31', 'KENTHENG RT004/RW002, DANUPAYAN, BULU, TEMANGGUNG', 'KENTHENG RT004/RW002, DANUPAYAN, BULU, TEMANGGUNG', 'Perempuan', 'dayantwibowo@gmail.com', '085328876851', '085328876851', 'STAF ADMINISTRASI', 'Bachelor/S1', 'ILMU EKONOMI', 'SURAT LAMARAN  PEKERJAAN_DANIYANTI - PT. BPR KUSUMA SUMBING...pdf', '2024-01-20 16:34:07', '2024-01-20 16:34:07'),
(74, 'Erna Kusmawati', 'Temanggung', '1998-12-12', 'Groboh RT 01 RW 08 Wadas Kandangan Temanggung', 'Groboh RT 01 RW 08 Wadas Kandangan Temanggung', 'Perempuan', 'ernakusmawatii03@gmail.com', '085600828792', '085600828792', 'STAF ADMINISTRASI', 'Bachelor/S1', 'Manajemen', 'CV ERNA KUSMAWATI_.pdf', '2024-01-30 19:14:22', '2024-01-30 19:14:22'),
(75, 'Erna kusmawati', 'Temanggung', '1998-12-12', 'Groboh RT 01 RW 08 Wadas Kandangan Temanggung', 'Groboh RT 01 RW 08 Wadas Kandangan Temanggung', 'Perempuan', 'ernakusmawatii03@gmail.com', '085600828792', '085600828792', 'STAF ADMINISTRASI', 'Bachelor/S1', 'Manajemen', 'CV ERNA KUSMAWATI_.pdf', '2024-01-30 19:16:55', '2024-01-30 19:16:55'),
(76, 'Indah Sekar Sari', 'Kudus', '2001-08-23', 'Glagahwaru Undaan Kudus', 'Glagahwaru Undaan Kudus', 'Perempuan', 'indahsekarsari001@gmail.com', '085600397294', '085600397294', 'STAF ADMINISTRASI', 'Bachelor/S1', 'Ekonomi Syariah', 'STAFF ADMIN KREDIT & LEGAL_INDAH SEKAR SARI.pdf', '2024-02-02 15:10:20', '2024-02-02 15:10:20'),
(77, 'Zaky Nur Rafi', 'Temanggung', '1997-08-06', 'Wonoboyo RT10/01, Des/Kel. Wonoboyo, Kab. Temanggung', 'Bongos, Jumo, Temanggung', 'Laki-laki', 'znr.zaky@gmail.com', '087777977752', '087777977752', 'ANALIS KREDIT KC TEMANGGUNG', 'Bachelor/S1', 'Ekonomi Pembangunan', 'Lamaran BPR Kusuma Sumbing.pdf', '2024-03-18 06:03:32', '2024-03-18 06:03:32'),
(78, 'SEKAR PUTRI WIDYAJATI', 'TEMANGGUNG', '1989-03-14', 'PERUM MADURESO INDAH NO 76  RT 02 RW 07 KELURAHAN MADURESO KABUPATEN TEMANGGUNG', 'PERUM MADURESO INDAH NO 76  RT 02 RW 07 KELURAHAN MADURESO KABUPATEN TEMANGGUNG', 'Perempuan', 'Sekarputryw@gmail.com', '085640435248', '085640435248', 'Account Officer/ Marketing Kredit KC Temanggung', 'Bachelor/S1', 'AKUNTANSI', 'sekar putri w.pdf', '2024-03-30 20:49:04', '2024-03-30 20:49:04'),
(79, 'Fika Ulfa Annif\'ah', 'Demak', '1997-02-23', 'Ds Kebonagung Rt 002/001 Kec Sumowono Kab semarang', 'Ds Kebonagung Rt 002/001 Kec Sumowono Kab Semarang', 'Perempuan', 'Fikaulfa23@gmail.com', '081329961001', '081329961001', 'ANALIS KREDIT KC TEMANGGUNG', 'Bachelor/S1', 'Akuntansi', 'FIKA ULFA ANNIF\'AH .pdf', '2024-04-03 12:01:09', '2024-04-03 12:01:09'),
(80, 'AMIN MIFTAKHUS SOLEH', 'TEMANGGUNG', '2000-10-26', 'DUSUN KRAJAN, RT.01/RW.03, DESA JAMBON, KECAMATAN GEMAWANG, KABUPATEN TEMANGGUNG', 'DUSUN KRAJAN, RT.01/RW.03, DESA JAMBON, KECAMATAN GEMAWANG, KABUPATEN TEMANGGUNG', 'Laki-laki', 'aminmiftakhus3@gmail.com', '085740315751', '085740315751', 'KASI KOMERSIAL', 'Bachelor/S1', 'EKONOMI SYARIAH', 'LAMARAN PEKERJAAN PT BPR KUSUMA SUMBING.pdf', '2024-04-14 21:01:32', '2024-04-14 21:01:32'),
(81, 'Martinus Pandu Winata', 'Kab Semarang', '1982-11-11', 'Tegalombo Rt 007/003 Blotongan Sidorejo Salatiga', 'Tegalombo Rt 007/003 Blotongan Sidorejo Salatiga', 'Laki-laki', 'pwinata876@gmail.com', '085640554796', '085640554796', 'KASI KOMERSIAL', 'Bachelor/S1', 'sistem informatika', 'Berkas lamaran kerja BPR Kusuma Sumbing.pdf', '2024-05-06 16:16:29', '2024-05-06 16:16:29'),
(82, 'Yoyok Anggoro', 'Temanggung', '1992-05-26', 'Dusun Mento Bawang RT 002 RW 001, Desa Mento, Kecamatan Candiroto, Kabupaten Temanggung', 'Dusun Mento Bawang RT 002 RW 001, Desa Mento, Kecamatan Candiroto, Kabupaten Temanggung', 'Laki-laki', 'yoke.ibrahimovic@gmail.com', '087837950481', '087837950481', 'ANALIS KREDIT KC TEMANGGUNG', 'Bachelor/S1', 'Manajemen', 'berkas lamaran.pdf', '2024-05-06 22:18:12', '2024-05-06 22:18:12'),
(83, 'Palupi Tyas Widhiyantoro,SE', 'Jepara', '1972-09-11', 'Kaliwiru VI/29 Candisari Semarang', 'Kaliwiru VI/29 Candisari Semarang', 'Laki-laki', 'tyaswidhiyantoro@gmail.com', '081228280973', '081228280973', 'KASI KOMERSIAL', 'Bachelor/S1', 'Ekonomi Manajemen Pemasaran', 'suratlamaranKusumasumbing.pdf', '2024-05-08 08:51:42', '2024-05-08 08:51:42'),
(84, 'Aldin Fitrah Firdaus', 'Tegal', '1993-03-28', 'Jl. Kapuas Gg. 4 No. 2 RT. 004 RW. 005, Kelurahan Panggung Kecamatan Tegal Timur, Kota Tegal, Provinsi Jawa Tengah, Kode Pos 52122', 'Jl. Raya Tunggu Raya Timur I, Kelurahan Meteseh Kecamatan Tembalang, Kota Semarang, Provinsi Jawa Tengah, Kode Pos 50271', 'Laki-laki', 'aldinfirdaus28@gmail.com', '081313101231', '081313101231', 'KASI KOMERSIAL', 'Bachelor/S1', 'Pendidikan Bahasa Inggris', 'CV_Aldin Fitrah Firdaus.pdf', '2024-05-10 13:04:33', '2024-05-10 13:04:33'),
(85, 'Rizal Adhi Nugroho', 'Semarang', '1985-09-23', 'Jl. Karonsih Selatan Raya 598 RT08 RW06 kelurahan Ngaliyan kecamatan Ngaliyan\r\nKota Semarang', 'Jl. Karonsih Selatan Raya 598 RT08 RW06 kelurahan Ngaliyan kecamatan Ngaliyan\r\nKota Semarang', 'Laki-laki', 'rizaladhi85@gmail.com', '089523808080', '089523808080', 'KASI KOMERSIAL', 'Bachelor/S1', 'Sistem Informasi', 'CV_Rizal_24_all_in-NEW.pdf', '2024-05-20 23:56:15', '2024-05-20 23:56:15'),
(86, 'Tutik hanifiyah', 'Kendal', '2001-02-10', 'Kabunan RT 01A/ RW 01, ngadiwarno, kec. Sukorejo, kab. Kendal', 'Kabunan RT 01A/ RW 01, ngadiwarno, kec. Sukorejo, kab. Kendal', 'Perempuan', 'tutikhanifiyah100201@gmail.com', '085803354895', '085803354895', 'Staf Administrasi Tabungan & Deposito KC Sukorejo', 'Bachelor/S1', 'Manajemen pendidikan', 'CV Tutik hanifiyah.pdf', '2024-05-31 19:13:54', '2024-05-31 19:13:54'),
(87, 'Bayu Dwi Jatmiko', 'Kendal', '1990-09-01', 'Perum griya praja Mukti blok H 24 RT 04 RW 07 Langenharjo kendal', 'Jl kemuning RT 05 RW 09 desa Krapyak kecamatan tahunan kab. Jepara', 'Laki-laki', 'bayudwijatmiko2111@gmail.com', '082133447211', '082133447211', 'ANALIS KREDIT KC TEMANGGUNG', 'Bachelor/S1', 'Pendidikan bahasa inggris', 'scan ijazah & transkrip nilai pdf.pdf', '2024-06-10 07:30:10', '2024-06-10 07:30:10'),
(88, 'Bayu Dwi Jatmiko', 'Kendal', '1990-09-01', 'Perum griya praja Mukti blok H 24 RT 04 RW 07 Langenharjo kendal', 'Jln kemuning RT 05 RW 09 Krapyak tahunan jepara', 'Laki-laki', 'bayudwijatmiko2111@gmail.com', '082133447211', '082133447211', 'KASI KOMERSIAL', 'Bachelor/S1', 'Pendidikan bahasa inggris', 'scan ijazah & transkrip nilai pdf.pdf', '2024-06-10 07:32:03', '2024-06-10 07:32:03'),
(89, 'Rifaa Salsabila', 'Cilacap', '2004-12-20', 'Jl.Bhayangkara no 22 rt01/rw04 karangmangu kroya cilacap', 'Jladri kidul rt04/rw06 buayan kebumen', 'Perempuan', 'rifasalsabila457@gmail.com', '081326141501', '081326141501', 'Account Officer(AO)/ Marketing Kredit', 'SMA/Sederajat', 'Ips', 'Pdf riffa.pdf', '2024-06-10 09:12:34', '2024-06-10 09:12:34'),
(90, 'Aris Hernindra', 'Rembang', '1977-04-15', 'JL. Pemuda gg 03 No.16 RT 01 RW 04 kel. Leteh Kec. Rembang Kab. Rembang JAWA TENGAH', 'JL. Pemuda gg 03 No.16 RT 01 RW 04 kel. Leteh Kec. Rembang Kab. Rembang JAWA TENGAH', 'Laki-laki', 'ariznindra@gmail.com', '081319598889', '081319598889', 'KASI KOMERSIAL', 'D3', 'Keuangan Perbankan', 'LamCVBPRkusuma-compressed.pdf', '2024-06-18 18:08:29', '2024-06-18 18:08:29'),
(91, 'Yoyok Anggoro', 'Temanggung', '1992-05-26', 'DUSUN MENTO BAWANG RT 002 RW 001', 'Dusun Mento Bawang, RT 002 RW 001, Desa Mento, Kecamatan Candiroto, 56257, Temanggung', 'Laki-laki', 'yoke.ibrahimovic@gmail.com', '087837950481', '087837950481', 'KASI KOMERSIAL', 'Bachelor/S1', 'Manajemen', 'Lamaran KSB merged.pdf', '2024-07-04 20:02:54', '2024-07-04 20:02:54'),
(92, 'Bayu Dwi jatmiko', 'Kendal', '1990-09-01', 'Perum griya praja Mukti blok H 24  Langenharjo Kendal RT 4 RW 7', 'Jln kemuning RT 5 RW 9 Krapyak tahunan jepara', 'Laki-laki', 'bayudwijatmiko2111@gmail.com', '082133447211', '082133447211', 'Account Officer(AO)/ Marketing Kredit KC Weleri', 'Bachelor/S1', 'Pendidikan bahasa inggris', 'scan ijazah & transkrip nilai pdf.pdf', '2024-07-10 21:55:43', '2024-07-10 21:55:43'),
(93, 'Febri Listiadi', 'Wonogiri', '1998-02-05', 'Citra indah bukit cempaka blok X 15 No.02, Sukamaju, Jonggol, Bogor,Jawa Barat', 'Jl bumi 1 Pondok sani putra Blok C.6 No.03, Pejuang, Medan Satria, Bekasi, Jawa Barat', 'Laki-laki', 'febrilistiadii05@gmail.com', '081297999602', '089693368602', 'Account Officer(AO)/ Marketing Kredit', 'SMA/Sederajat', '-', '03Prihal_Lamaran_Kerja.pdf', '2024-07-15 14:00:50', '2024-07-15 14:00:50'),
(94, 'Azis Prihatiyono', 'Temanggung', '1992-05-24', 'Dus. Jengkol 01/05, Kel. Dlimoyo, Kec. Ngadirejo, Kab. Temanggung', 'Dus. Jengkol 01/05, Kel. Dlimoyo, Kec. Ngadirejo, Kab. Temanggung', 'Laki-laki', 'azisnarti6969@gmail.com', '081903972120', '081903972120', 'Account Officer(AO)/ Marketing Kredit', 'SMA/Sederajat', 'Akuntansi', 'Dokumen.pdf', '2024-07-17 13:41:19', '2024-07-17 13:41:19'),
(95, 'Andre Nuary', 'Kabupaten Grobogan', '2000-01-21', 'Tegowanu Wetan RT 01 RW 01,Kec.Tegowanu,Kab. Grobogan', 'Tegowanu Wetan RT 01 RW 01,Kec.Tegowanu,Kab. Grobogan', 'Laki-laki', 'Andrenuary45@gmail.com', '081908661525', '081908661525', 'KASI KOMERSIAL', 'Bachelor/S1', 'Ilmu Hukum', 'Persyaratan Lamaran Kerja.pdf', '2024-07-19 14:55:54', '2024-07-19 14:55:54'),
(96, 'YOYOK ANGGORO', 'KABUPATEN TEMANGGUNG', '1992-05-26', 'DUSUN MENTO BAWANG RT 002 RW 001 DESA MENTO, KECAMATAN CANDIROTO 56257, KABUPATEN TEMANGGUNG', 'DUSUN MENTO BAWANG RT 002 RW 001 DESA MENTO, KECAMATAN CANDIROTO 56257, KABUPATEN TEMANGGUNG', 'Laki-laki', 'yoke.ibrahimovic@gmail.com', '087837950481', '087837950481', 'KASI KOMERSIAL', 'Bachelor/S1', 'MANAJEMEN', 'LAMARAN BPR KSB_merged (1).pdf', '2024-07-21 21:04:57', '2024-07-21 21:04:57'),
(97, 'Muhammad Syauqi Abdillah', 'Grobogan', '2000-03-04', 'Desa Jeketro, RT 03 / RW 03, Kecamatan Gubug, Kabupaten Grobogan, Jawa Tengah', 'Perum Argomulyo Mukti Timur, Kelurahan Tlogomulyo, Kecamatan Pedurungan, Kota Semarang', 'Laki-laki', 'syauqiabdillah45@gmail.com', '0895358621223', '0895358621223', 'KASI KOMERSIAL', 'D3', 'Keuangan Publik', 'Lamaran Kasi Komersial PT BPR Kusuma Sumbing.pdf', '2024-07-22 13:53:52', '2024-07-22 13:53:52'),
(98, 'Nur Aini Sumarno', 'Banyumas', '1998-03-25', 'Tamansari Rt 001 Rw 005 Kelurahan Kebumen Kecamatan Kebumen Kabupaten Kebumen', 'Desa Kemukus Rt 002 Rw 001 Kecamatan Gombong Kabupaten Kebumen', 'Perempuan', 'nurainisumarno0@gmail.com', '083863632285', '085742949811', 'Account Officer Kredit (Marketing) KC Gombong', 'SMA/Sederajat', 'Administrasi Perkantoran', 'LamaranPekerjaan.pdf', '2024-07-24 13:39:40', '2024-07-24 13:39:40'),
(99, 'Melania saputri', 'Bogor', '2003-03-06', 'Kp jambuluwuk rt 03 rw 01 desa bojong murni kecamatan ciawi kabupaten bogor', 'Kp jambuluwuk rt 03 rw 01 desa bojong murni kecamatan ciawi kabupaten bogor', 'Perempuan', 'melaniasptr7@gmail.com', '085713979198', '085713979198', 'Account Officer Kredit (Marketing) KC Gombong', 'SMA/Sederajat', 'Otomotif tata kelola perkantoran', 'IMG-20240724-WA0044.pdf', '2024-07-24 20:02:18', '2024-07-24 20:02:18'),
(100, 'Oktantra margiyandewa', 'Kebumen', '2000-10-16', 'Jl cemara gang kemuning no 22 kec kebumen kab kebumen', 'Jl cemara gang kemuning no 22 kec kebumen kab kebumen', 'Laki-laki', 'tantradewa8@gmail.com', '088291126472', '088223746881', 'Account Officer Kredit (Marketing) KC Gombong', 'SMA/Sederajat', 'Ototronik', 'Okta CV.pdf', '2024-07-25 10:15:16', '2024-07-25 10:15:16'),
(101, 'TANJUNG WIRIAWAN WIDIASTA', 'KLATEN', '1981-04-25', 'Jatiluhur RT 2 RW 4 Kel. Ngesrep Kec. Banyumanik Kota Semarang', 'Jatiluhur RT 2 RW 4 Kel. Ngesrep Kec. Banyumanik Kota Semarang', 'Laki-laki', 't_junx@yahoo.com', '082112331157', '082112331157', 'Analis Kredit Cabang Mranggen', 'Bachelor/S1', 'Psikologi', 'Lamaran_Analis Kredit_Tanjung Wiriawan W.pdf', '2024-07-26 19:29:35', '2024-07-26 19:29:35'),
(102, 'Bayu Dwi jatmiko', 'Kendal', '1990-09-01', 'Perum griya praja Mukti blok H no 24 RT 04 RW 07 Langenharjo Kendal', 'Jl kemuning raya RT 05 RW 09 Krapyak tahunan jepara', 'Laki-laki', 'bayudwijatmiko2111@gmail.com', '082133447211', '082133447211', 'Analis Kredit Cabang Mranggen', 'Bachelor/S1', 'Pendidikan bahasa inggris', 'DAFTAR RIWAYAT HIDUP TERBARU.pdf', '2024-07-30 08:57:33', '2024-07-30 08:57:33'),
(103, 'HARY RUSDIANTO', 'Kebumen', '2006-02-08', 'Dk.Margolunyu lor Rt 01 Rw 03 Desa Jatiluhur Kecamatan Rowokele Kabupaten Kebumen', 'Dk.Margolunyu lor Rt 01 Rw 03 Desa Jatiluhur Kecamatan Rowokele Kabupaten Kebumen', 'Laki-laki', 'harirusdianto7@gmail.com', '081911246409', '081911246409', 'Account Officer Kredit (Marketing) KC Gombong', 'SMA/Sederajat', 'Akuntansi dan Keuangan Lembaga', 'DOKUMEN LAMARAN PEKERJAAN HARY RUSDIANTO.pdf', '2024-08-01 21:54:54', '2024-08-01 21:54:54'),
(104, 'Meuthia Amalia', 'Pati', '2000-05-13', 'Sarirejo RT 10 RW 01, Kec. Pati, Kab. Pati', 'Jl. Kendeng IV, Gajahmungkur, Kota Semarang', 'Perempuan', 'meuthiamalia@gmail.com', '089612841468', '089612841468', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Akuntansi', 'CV_Meuthia Amalia_Account Officer (AO).pdf', '2024-08-03 23:04:37', '2024-08-03 23:04:37'),
(105, 'Elisa Salsabila Ningrum', 'Kendal', '2006-04-24', 'Getas Kulon 002/004 Getas Blawong, Pageruyung, Kendal.', 'Getas Kulon 002/004 Getas Blawong, Pageruyung, Kendal.', 'Perempuan', 'elisasalsabil256@gmail.com', '082314458839', '082223769590', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Akuntansi dan Keuangan Lembaga', 'Surat Lamaran Elisa Salsabila Ningrum.pdf', '2024-08-05 13:11:34', '2024-08-05 13:11:34'),
(106, 'FAKHRI EKA SATRIA', 'Kebumen', '1994-06-21', 'Jalan ampera no.9 Rt.02/01 Karanganyar-Kebumen', 'Jalan ampera no.9 Rt.02/01 Karanganyar-Kebumen', 'Laki-laki', 'fahri.satria6@gmail.com', '081334344121', '081334344121', 'Account Officer Kredit (Marketing) KC Gombong', 'Bachelor/S1', 'Pendidikan Guru Sekolah Dasar', 'Berkas BPR Kusuma Sumbing.pdf', '2024-08-06 21:33:57', '2024-08-06 21:33:57'),
(107, 'Ravika Putri Iana', 'Temanggung', '2003-01-14', 'Dusun Jagalan, RT 03/ RW 04, Desa Ngadirejo, Kecamatan Ngadirejo, Kabupaten Temanggung', 'Dusun Jagalan, RT 03/ RW 04, Desa Ngadirejo, Kecamatan Ngadirejo, Kabupaten Temanggung', 'Perempuan', 'ravikaputri86@gmail.com', '081943269644', '081943269644', 'Account Officer Kredit (Marketing)', 'D3', 'Agribisnis', 'Lamaran PT BPK Kusuma Sumbing.pdf', '2024-08-07 09:06:44', '2024-08-07 09:06:44'),
(108, 'Windi Tri Astuti', 'Purbalingga', '2005-05-17', 'Gunung Karang RT 02 RW 03, Kec. Bobotsari, kab. Purbalingga', 'Gunung Karang RT 02 RW 03, Kec. Bobotsari, kab. Purbalingga', 'Perempuan', 'winditriastuti5205@gmail.com', '081327514357', '081327514357', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'IPA', 'Windi Tri Astuti_Purbalingga.pdf', '2024-08-12 08:45:22', '2024-08-12 08:45:22'),
(109, 'Windi Tri Astuti', 'Purbalingga', '2005-05-17', 'Gunung Karang RT 02 RW 03, Kec. Bobotsari, kab. Purbalingga', 'Purbalingga', 'Perempuan', 'winditriastuti5205@gmail.com', '081327514357', '081327514357', 'Account Officer Kredit (Marketing) KC Gombong', 'SMA/Sederajat', 'IPA', 'PDFGallery_20240814_130846.pdf', '2024-08-14 13:15:28', '2024-08-14 13:15:29'),
(110, 'Sindi Fatika Sari', 'Grobogan', '2002-03-14', 'Ngerangan RT 14 06 Ngerangan Bayat', 'Ngerangan RT 14 06 Ngerangan Bayat', 'Perempuan', 'sindifatikasari368@gmail.com', '087742202824', '087742202824', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Ilmu pengetahuan sosial', 'Pdf 19-8-24.pdf', '2024-08-19 10:16:50', '2024-08-19 10:16:50'),
(111, 'Rifqi Adhi Priyogo', 'Jakarta', '2000-11-23', 'Karanggayam', 'Karanggayam RT001/002 Desa Karanggayam Kec Karanggayam Kab Kebumen', 'Laki-laki', 'radhip256@gmail.com', '082223933323', '082223933323', 'KASI KOMERSIAL CABANG GOMBONG', 'D3', 'Teknik Elektronika', 'CV New (1).pdf', '2024-08-21 20:10:38', '2024-08-21 20:10:38'),
(112, 'Ayu Indah Lestari', 'Kebumen', '2001-08-10', 'Dukuh Karangdadi Rt. 01/ Rw.03, Desa Bojongsari, Kec. Alian, Kab. Kebumen, Prov. Jawa Tengah', 'Dukuh Karangdadi Rt. 01/ Rw.03, Desa Bojongsari, Kec. Alian, Kab. Kebumen, Prov. Jawa Tengah', 'Perempuan', 'lestariayuindah274@gmail.com', '085649712550', '085649712550', 'KASI KOMERSIAL CABANG GOMBONG', 'Bachelor/S1', 'Manajemen', 'AYU INDAH LESTARI - KASI KOMERSIAL - PT BPR KUSUMA SUMBING GOMBONG - BERKAS LAMARAN.pdf', '2024-08-22 16:49:14', '2024-08-22 16:49:14'),
(113, 'Ikhda Choeru Tunisa', 'Kebumen', '2002-04-28', 'Desa Sidomulyo RT 03/ RW 02, Kecamatan Petanahan, Kabupaten Kebumen', 'Desa Sidomulyo RT 03/ RW 02, Kecamatan Petanahan, Kabupaten Kebumen', 'Perempuan', 'ikhdactsa2804@gmail.com', '085942134465', '085942134465', 'KASI KOMERSIAL CABANG GOMBONG', 'Bachelor/S1', 'Akuntansi', 'Ikhda Choeru Tunisa_BPR Kusuma Sumbing Gombong.pdf', '2024-08-23 15:51:46', '2024-08-23 15:51:46'),
(114, 'Bayu Dwi jatmiko', 'Kendal', '1990-09-01', 'Perum griya praja Mukti blok H no 24 RT 04 RW 07 Langenharjo Kendal', 'RT 05 RW 09 Krapyak tahunan jepara', 'Laki-laki', 'bayudwijatmiko2111@gmail.com', '082133447211', '082133447211', 'Analis Kredit Cabang Mranggen', 'Bachelor/S1', 'Pendidikan bahasa inggris', 'DAFTAR RIWAYAT HIDUP TERBARU.pdf', '2024-08-23 21:18:01', '2024-08-23 21:18:01'),
(115, 'Ramadhani karya wijaya', '- Select City-', '2024-12-04', 'Jl.raya prawoto babalan rt03/06 kec,mijen,kab demak', 'Jl.raya prawoto babalan rt03/06 kec,mijen,kab demak', 'Laki-laki', 'ramadhanikaryawijaya111@gmail.com', '088980168397', '088980168397', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'MANAJEMEN PEMASARAN', 'PDF BPR KUSUMA SUMBING.pdf', '2024-08-23 21:25:53', '2024-08-23 21:25:53'),
(116, 'Muhammad Ilham Akbar', 'Kab. Semarang', '2002-10-01', 'Nglerak RT01/RW09, Delik, Kec. Tuntang, Kab. Semarang, jawa tengah', 'Watububan RT01/RW02, Gedanganak, Kec. Ungaran Timur, Kab. Semarang, jawa Tengah', 'Laki-laki', 'wafagan58@gmail.com', '081288220200', '081288220200', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Pariwisata', 'Muhammad Ilham Akbar.pdf', '2024-08-24 07:43:47', '2024-08-24 07:43:47'),
(117, 'Yeni Yanuba Arifa', 'Demak', '2002-04-16', 'Dk. Babadan RT 01/05 Desa Sayung Kecamatan Sayung Kabupaten Demak Jawa Tengah', 'Dk. Babadan RT 01/05 Desa Sayung Kecamatan Sayung Kabupaten Demak Jawa Tengah', 'Perempuan', 'yeniyanubaarifa@gmail.com', '085926572648', '081393212768', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Rekayasa Perangkat Lunak', 'IMG_20240824_082717.pdf', '2024-08-24 08:32:12', '2024-08-24 08:32:12'),
(118, 'Dwi Ayunda Pratiwi', 'Magetan', '2004-08-27', 'Ds. Ngadiredjo RT. 01/RW.011, kel. Ringinputih, kec. Karangdowo, kab. Klaten', 'Jl. Pekunden Utara No. 540,kel. Miroto, kec. Semarang Tengah', 'Perempuan', 'ayundadwipratiwi2727@gmail.com', '081234935894', '081234935894', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Akuntansi', 'BPR Dwi Ayunda pratiwi.pdf', '2024-08-24 21:03:50', '2024-08-24 21:03:50'),
(119, 'AURELIA DIANE YUSTINA PUTRI', 'BREBES', '1994-06-24', 'JL. TELAGA RENJENG NO 5 RT 003/RW 004, KALIGANGSA WETAN - BREBES', 'JL. TELAGA RENJENG NO 5 RT 003/RW 004, KALIGANGSA WETAN - BREBES', 'Perempuan', 'aureliayustinput@gmail.com', '02836177239', '089509794009', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'MANAGEMEN', 'BERKAS LAMARAN PEKERJAAN BPR KUSUMA SUMBING AN AURELIA DIANE.pdf', '2024-08-28 21:21:27', '2024-08-28 21:21:27'),
(120, 'Mohamad Sakirin', 'Pemalang', '1992-06-19', 'RT 001/003 Desa Pegiringan\r\nKec. Bantarbolang, Kab. Pemalang', 'RT 001/003 Desa Pegiringan\r\nKec. Bantarbolang, Kab. Pemalang', 'Laki-laki', 'mohsakirin92@gmail.com', '085817193526', '085291559136', 'ACCOUNT OFFICER/MARKETING KREDIT KC AMBARAWA', 'SMA/Sederajat', 'Teknik Kendaraan Ringan Otomotif', 'bprkusumusumbing.pdf', '2024-08-31 08:36:28', '2024-08-31 08:36:28'),
(121, 'Mohammad Rifki Rismawan', 'Kebumen', '2024-03-20', 'Desa Kawedusan Rt01/RW 02 Kebumen', 'Kawedusan, Kebumen', 'Laki-laki', 'rifkirismawan11@gmail.com', '082220252196', '082141926083', 'KASI KOMERSIAL CABANG GOMBONG', 'Bachelor/S1', 'Manajemen', 'CV_Rifki Rismawan.pdf', '2024-09-04 08:03:01', '2024-09-04 08:03:01'),
(122, 'Maudzi nur azizah', 'Wonosobo', '2000-01-27', 'Gunung tawang rt 02 rw 01 selomero wonosobo', 'Gunung tawang selomerto wonosobo', 'Perempuan', 'maudynauraazizah@gmail.com', '089647491212', '089647491212', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Akuntansi', 'CURICULUM VITAE 2.pdf', '2024-09-10 20:31:11', '2024-09-10 20:31:11'),
(123, 'SASKIA PUTRI NUR AMELIA', 'WONOSOBO', '2003-03-24', 'Kp Campursari rt 3 rw 8 jaraksari Wonosobo', 'Kp Campursari rt 3 rw 8 jaraksari Wonosobo', 'Perempuan', 'Saskiaputrina@gmail.com', '08995009668', '08995009668', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'IPS', 'Berkas CV.pdf', '2024-09-11 08:41:52', '2024-09-11 08:41:52'),
(124, 'Rakhmawati', 'Wonosobo', '2000-12-30', 'Jlamprang Rt 01/Rw 01 Wonosobo, Kec. Wonosono, Kab. Wonosobo Jawa Tengah', 'Wonosobo', 'Perempuan', 'rahmawt667@gmail.com', '08993750705', '08993750705', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Manajemen', 'Surat Lamaran  Rakhmawati Terbaru.pdf', '2024-09-11 10:55:31', '2024-09-11 10:55:31'),
(125, 'YOGANTA RAKA MALIANDITRA', 'WONOSOBO', '1991-03-04', 'SIDOJOYO, RT 03 / RW 010, PAGERKUKUH, WONOSOBO, JAWA TENGAH', 'SIDOJOYO, RT 03 / RW 010, PAGERKUKUH, WONOSOBO, JAWA TENGAH', 'Laki-laki', 'yogantaraka04@gmail.com', '081337760266', '081337760866', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'IPS', 'LAMARAN BPR KUSUMA SUMBING AO pdf.pdf', '2024-09-13 09:17:21', '2024-09-13 09:17:21'),
(126, 'Yeni Yanuba arifa', 'Demak', '2002-04-16', 'Dk. Babadan rt 1/5 ds. Sayung kec. Sayung kab. Demak', 'Dk. Babadan rt 1/5 ds. Sayung kec. Sayung kab. Demak', 'Perempuan', 'yeniyanubaarifa@gmail.com', '081393212768', '081393212768', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Rpl', 'IMG_20240824_082717.pdf', '2024-09-16 13:47:22', '2024-09-16 13:47:22'),
(127, 'RADEN AYU CHIKITA ADELOLA SHELLY TORYANA', 'SEMARANG', '2004-01-23', 'BUKIT EMERALD ASRI A3 NO 93', 'CEPOKO, GUNUNGPATI', 'Perempuan', 'shellyradenayu@gmail.com', '0895623255030', '0895623255030', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'MIPA', 'dokumen.pdf', '2024-09-22 19:47:56', '2024-09-22 19:47:56'),
(128, 'RADEN AYU CHIKITA ADELOLA SHELLY TORYANA', 'SEMARANG', '2004-01-23', 'BUKIT EMERALD ASRI A3 NO 93', 'CEPOKO, GUNUNGPATI', 'Perempuan', 'adelolashelly@gmail.com', '0895623255030', '0895623255030', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'MIPA', 'dokumen.pdf', '2024-09-24 13:02:59', '2024-09-24 13:02:59'),
(129, 'RADEN AYU CHIKITA ADELOLA SHELLY TORYANA', 'SEMARANG', '2004-01-23', 'BUKIT EMERALD ASRI A3 NO 93', 'CEPOKO, GUNUNGPATI', 'Perempuan', 'adelolashelly@gmail.com', '0895623255030', '0895623255030', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'MIPA', 'dokumen.pdf', '2024-09-24 13:03:05', '2024-09-24 13:03:05'),
(130, 'sosiawan bangkit samodro', 'magelang', '1989-04-06', 'jalan uripsomoharjo 410 a rt 6 rw 5 kelurahan wates kota magelang', 'tembarak kidul temanggung', 'Laki-laki', 'sosiawanbangkit@gmail.com', '087812569975', '087812569975', 'KASI KOMERSIAL CABANG SOKARAJA', 'Bachelor/S1', 'fakultas ekonomi universitas jenderal soedirman', 'Surat Lamaran Sosiawan.pdf', '2024-09-27 23:29:26', '2024-09-27 23:29:26'),
(131, 'Desi rahmawati', 'Kendal', '2005-12-01', 'manggung sidodadi RT 01 RW 01 patean kendal', 'manggung sidodadi patean kendal', 'Perempuan', 'desirah49@gmail.com', '085643031754', '085643031754', 'REMEDIAL/PENAGIHAN KANTOR PARAKAN', 'SMA/Sederajat', 'perbankan syariah', 'CV Desi Rahmawati.pdf', '2024-10-03 11:53:37', '2024-10-03 11:53:37'),
(132, 'Styo budi triyanto', 'Temanggung', '1994-12-19', 'Jetis rt2 rw7 tepusen kaloran temanggung', 'Jetis rt2 rw7 tepusen kaloran temanggung', 'Laki-laki', 'styobuditriyanto48@gmail.com', '085647979073', '085647979073', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'SMA/Sederajat', 'Ekonomi', 'lamaran bpr kusuma sumbing.pdf', '2024-10-05 08:57:26', '2024-10-05 08:57:26'),
(133, 'Yoyok Anggoro', 'Temanggung', '1992-05-26', 'DUSUN MENTO BAWANG RT 002 RW 001 DESA MENTO, KECAMATAN CANDIROTO, TEMANGGUNG', 'DUSUN MENTO BAWANG RT 002 RW 001 DESA MENTO, KECAMATAN CANDIROTO, TEMANGGUNG', 'Laki-laki', 'yoke.ibrahimovic@gmail.com', '087837950481', '087837950481', 'REMEDIAL/PENAGIHAN KANTOR PARAKAN', 'Bachelor/S1', 'MANAJEMEN', 'LAMARAN KSB.pdf', '2024-10-05 19:30:26', '2024-10-05 19:30:26'),
(134, 'adrian hasfi yusuf', 'wonosobo', '2000-08-18', 'ketinggring rt03 / Rw 07 Kalianget Wonosobo, jawa tengah, indonesia', 'ketinggring rt03 / Rw 07 Kalianget Wonosobo, jawa tengah, indonesia', 'Laki-laki', 'adrianhasfiyusuf@gmail.com', '085931465525', '085931465525', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'ekonomi manejemen', 'Adrian hasfi yusuf_AO.pdf', '2024-10-07 09:06:24', '2024-10-07 09:06:24'),
(135, 'Rahayu Umi Alifah', 'Temanggung', '2006-09-17', 'Dusun Dari RT 03 RW 01 Desa Bansari Kecamatan Bulu Kabupaten Temanggung', 'Dusun Dari RT 03 RW 01 Desa Bansari Kecamatan Bulu Kabupaten Temanggung', 'Perempuan', 'umirahayutmg19@gmail.com', '085712207921', '085712207921', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'SMA/Sederajat', 'Akuntansi dan Keuanga Lembaga', 'Berkas Lamaran Rahayu Umi Alifah.pdf', '2024-10-09 09:23:36', '2024-10-09 09:23:36'),
(136, 'TIA RENI PITRI', 'JEMBATAN DUA', '2000-10-30', 'Desa Jembatan Dua,Kec Kaur Selatan,Kab Kaur,Prov Bengkulu', 'Jl link mujahidin,kel Giyanti,kec Temanggung,Kab Temanggung,Jawa Tengah', 'Perempuan', 'tiarenipitri@gmaulil.com', '082374142064', '082374142064', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'SMA/Sederajat', 'Ipa', 'TIA RENI PITRI New.pdf', '2024-10-15 16:04:22', '2024-10-15 16:04:22'),
(137, 'Fifian Rahmah Agustin', 'temanggung', '2006-08-20', 'dusun reban, desa Malangsari, Rw 01 rt 02 kec. bulu, Kab. Temanggung', 'bulu, temanggung', 'Perempuan', 'fifian258@gmail.com', '085878872', '085878872', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'SMA/Sederajat', 'Otomatisasi tata kelola perkantoran', 'berkas lamar kerja KSB Kusuma Sumbing (Fifian Rahmah Agustin).pdf', '2024-10-15 18:23:23', '2024-10-15 18:23:23');
INSERT INTO `tb_pelamar` (`id_pelamar`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `domisili`, `jns_kelamin`, `email`, `no_telp`, `no_wa`, `posisi`, `pendidikan`, `jurusan`, `berkas_pendukung`, `created_at`, `updated_at`) VALUES
(138, 'Naily Ambar Syafi\'ni', 'Jepara', '1997-03-02', 'Nalumsari RT 001 RW 005, Nalumsari, Jepara', 'Sambirejo, Gayamsari, Semarang', 'Perempuan', 'nailymanshur@gmail.com', '089630840322', '089630840322', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'IPA', 'lamaran _merged.pdf.crdownload', '2024-10-20 19:07:55', '2024-10-20 19:07:55'),
(139, 'Ninda Wahyu Kristanti', 'Temanggung', '2000-02-17', 'Domangan Rt 04 Rw 03 Tuksari Kledung Temanggung', '-', 'Perempuan', 'nindawahyukris17@gmail.com', '085866684841', '085866684841', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Ips', 'BPR KUSUMA SUMBING.pdf', '2024-10-21 11:20:23', '2024-10-21 11:20:23'),
(140, 'Andri dwi wijayanto', 'Temanggung', '2000-08-27', '001/001 Pringtali, Kemiri, Kaloran, Temanggung', '001/001 Pringtali, Kemiri, Kaloran, Temanggung', 'Laki-laki', 'andridwi177@gmail.com', '081225732632', '081225732632', 'REMEDIAL/PENAGIHAN KANTOR PARAKAN', 'Bachelor/S1', 'Ilmu hukum', 'Beras lamaran Kerja Andri.pdf', '2024-10-22 08:34:53', '2024-10-22 08:34:53'),
(141, 'arya irfan pratama', 'kebumen', '2004-11-03', 'karang tepung,RT 01 RW 06,lemah duwur, kec.kuwarasan, kab.kebumen', 'karang tepung,RT 01 RW 06,lemah duwur, kec.kuwarasan, kab.kebumen', 'Laki-laki', 'aryairfanpratama506@gmail.com', '081248237303', '081248237303', 'ACCOUNT OFFICER/MARKETING KREDIT KC GOMBONG', 'SMA/Sederajat', 'Tenkin Komputer Jaringan', 'ARYA IRFAN PRATAMA.pdf', '2024-10-24 10:49:21', '2024-10-24 10:49:21'),
(142, 'Esa Nurliana Saputri', 'Kebumen', '2000-01-28', 'Luwung Rt002/Rw001 , Desa Wonoharjo, Kecamatan Rowokele, Kabupaten Kebumen,Jawa Tengah', 'Luwung Rt002/Rw001 , Desa Wonoharjo, Kecamatan Rowokele, Kabupaten Kebumen,Jawa Tengah', 'Perempuan', 'esanurliana555@gmail.com', '081235560434', '081235560434', 'ACCOUNT OFFICER/MARKETING KREDIT KC GOMBONG', 'D1', 'Pramugari', 'CV Dan Surat Lamaran Esa Nurliana_compressed (1).pdf', '2024-10-25 12:11:23', '2024-10-25 12:11:23'),
(143, 'Thalia Ricky Carolina', 'Kebumen', '2000-04-22', 'Gg.mangga rt 06/rw 06 , Kedungampel , Wonokriyo , Gombong', 'Gg.mangga rt 06/rw 06 , Kedungampel , Wonokriyo , Gombong', 'Perempuan', 'carolinathalia132@gmail.com', '087870419285', '087870419285', 'KASI KOMERSIAL CABANG GOMBONG', 'Bachelor/S1', 'Manajemen', 'Lamaran kerja.pdf', '2024-10-27 10:39:35', '2024-10-27 10:39:35'),
(144, 'Dwi Fera Santika', 'Wonosobo', '2005-01-31', 'Banjarsari rt 08 rw 03, Banjar, kertek, Wonosobo', 'Banjarsari rt 08 rw 03, Banjar, kertek, Wonosobo', 'Perempuan', 'dwiferasantika824@gmail.com', '082133816676', '082133816676', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Akuntansi & keuangan lembaga', 'CV Lamaran Kerja Dwi Fera Santika.pdf', '2024-10-29 18:51:51', '2024-10-29 18:51:51'),
(145, 'Fahrudin Nur faizi', 'KAB. MAGELANG', '1997-06-05', 'Bangsren, krincing, secang, magelang', 'Bangsren, krincing, secang, magelang', 'Laki-laki', 'fahrudinnurfaizii@gmail.com', '081469862699', '081469862699', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'Bachelor/S1', 'Akuntansi', 'Berkas_Fahrudin.pdf', '2024-10-31 07:47:09', '2024-10-31 07:47:09'),
(146, 'Muhammad Azhar Fadhlurrohman', 'Magelang', '2002-08-27', 'Gedongan Kulon RT 5 RW 8 Bondowoso Mertoyudan Magelang Jawa Tengah', 'Gedongan Kulon RT 5 RW 8 Bondowoso Mertoyudan Magelang Jawa Tengah', 'Laki-laki', 'azharfdh@gmail.com', '085801899103', '085801899103', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'Bachelor/S1', 'Administrasi Bisnis Terapan', 'M. Azhar Fadhlurrohman.pdf', '2024-11-02 21:20:01', '2024-11-02 21:20:01'),
(147, 'APRILIA DARA DZARCELA', 'TEMANGGUNG', '2005-10-27', 'NGIJINGAN RT 03 RW 1 CANDIMULYO KEDU TEMANGGUNG', 'NGIJINGAN RT 06 RW 1 CANDIMULYO KEDU TEMANGGUNG', 'Perempuan', 'aprilliadara540@gmail.com', '0882008124656', '0882008124656', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'SMA/Sederajat', 'PEMASARAN', 'cv aprilia dara.pdf', '2024-11-02 21:53:47', '2024-11-02 21:53:47'),
(148, 'Ahmad Muhtar Nawawi', 'Kebumen', '1998-06-24', 'Desa Logede RT 002/001, Pejagoan, Kebumen', 'Desa Logede RT 002/001, Pejagoan, Kebumen', 'Laki-laki', 'muhtar.naw24@gmail.com', '085966311777', '085966311777', 'KASI KOMERSIAL CABANG GOMBONG', 'Bachelor/S1', 'Manajemen', 'PT BPR KSB.pdf', '2024-11-04 14:55:57', '2024-11-04 14:55:57'),
(149, 'Beny P', 'Temanggung', '2024-11-14', 'JL. DR. SUTOMO NO. 483', 'JL. DR. SUTOMO NO. 483', 'Laki-laki', 'bennyprasettyo98@gmail.com', '6289504464641', '6289504464641', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'Bachelor/S1', 'Sastra Jepang', 'BenyP_BPR Temanggung.pdf', '2024-11-04 21:22:05', '2024-11-04 21:22:05'),
(150, 'Ivana Erlinda Sari', 'Temanggung', '1998-02-16', 'Jl. Perintis Kemerdekaan RT 03/RW 06, Kel Jurang, Kec Temanggung, Kab Temanggung, Jawa Tengah 56222', 'Jl. Perintis Kemerdekaan RT 03/RW 06, Kel Jurang, Kec Temanggung, Kab Temanggung, Jawa Tengah 56222', 'Perempuan', 'ivanaerlindasari16@gmail.com', '08111261698', '08111261698', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'Bachelor/S1', 'Hukum', 'Berkas KS_Ivana Erlinda Sari.pdf', '2024-11-05 09:28:50', '2024-11-05 09:28:50'),
(151, 'Rasti Soviyani', 'Temanggung', '2005-05-16', 'Joho Utara RT 001 RE 002, Temanggung.', 'Joho Utara RT 001 RW 002, Temanggung.', 'Perempuan', 'rastisovi1234@gmail.com', '0882006475941', '0882006475941', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Otomatisasi Tata Keola Perkantoran', '99F76F2B-C8B1-4A37-9D62-32F043E1A7EF.pdf', '2024-11-06 10:47:30', '2024-11-06 10:47:30'),
(152, 'Delfia widyan saputri', 'Temanggung', '1999-06-21', 'Bolang rt 01 rw 02 klepu kranggan temanggung', 'Bolang rt 01 rw 02 klepu kranggan temanggung', 'Perempuan', 'delfiawidyan59@gmail.com', '087844187011', '087844187011', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'SMA/Sederajat', 'Ips', 'FILE LAMARAN.pdf', '2024-11-06 15:06:07', '2024-11-06 15:06:07'),
(153, 'Wawan prayogo', 'Temanggung', '1991-06-25', 'Lingkungan Krajan RT 1 RW 4, Tlogorejo, Temanggung', 'Tlogorejo, Temanggung', 'Laki-laki', 'prayogowawan03@gmail.com', '082130005003', '082130005003', 'REMEDIAL/PENAGIHAN KANTOR PARAKAN', 'Bachelor/S1', 'Akuntansi', 'lamaran pekerjaan.pdf', '2024-11-07 14:56:30', '2024-11-07 14:56:30'),
(154, 'SHARMILA DESTIYANTI', 'KENDAL', '2000-12-08', 'KRAJAN PENYANGKRINGAN RT 003 RW 005 KEC.WELERI KAB.KENDAL', 'KRAJAN PENYANGKRINGAN RT 003 RW 005 KEC.WELERI KAB.KENDAL', 'Perempuan', 'sharmiladesty@gmail.com', '081933880796', '081933880796', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'ADMINISTRASI PERKANTORAN', 'doc.lamaran kerja.pdf', '2024-11-08 11:09:26', '2024-11-08 11:09:26'),
(155, 'Muhammad Rizalalfaizal', 'Semarang', '1996-12-16', 'TMN TLOGOMULYO I 36 Rt 017/ Rw 007, Kelurahan Tlogomulyo, Kecamatan Pedurungan Semarang', 'TMN TLOGOMULYO I 36 Rt 017/ Rw 007, Kelurahan Tlogomulyo, Kecamatan Pedurungan Semarang', 'Laki-laki', 'rizalalfaizal@gmail.com', '082135246039', '082135246039', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Manajemen', 'Surat Lamaran Muhammad Rizalalfaizal.pdf', '2024-11-09 10:47:56', '2024-11-09 10:47:56'),
(156, 'Aulya nurul safrida', 'Temanggung', '2005-10-03', 'Tawangsari, Tembarak , Temanggung', 'Tawangsari, Tembarak,Temanggung', 'Perempuan', 'aulyaalinsaf@gmail.com', '081229452157', '081229452157', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'SMA/Sederajat', 'Agroindustri ( pengolahan hasil pertanian)', 'lamaran pekerjaan.pdf', '2024-11-09 11:52:51', '2024-11-09 11:52:51'),
(157, 'SYAHRIAR MUHAMMAD GARIN', 'TEMANGGUNG', '2004-12-26', 'Rt 04 Rw 03 Kedu Gang 3 Temanggung Jawa Tengah', 'Kedu, Temanggung', 'Laki-laki', 'garinsyahriar@gmail.com', '089688145010', '089688145010', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'SMA/Sederajat', 'Tata Boga', 'Garyne 1 Surat lamaran.pdf', '2024-11-12 01:33:16', '2024-11-12 01:33:16'),
(158, 'EFI SURYANTI', 'KEBUMEN', '1992-10-03', 'DESA KUWARU RT 001 RW 003 KECAMATAN KUWARASAN KABUPATEN KEBUMEN', 'DESA KUWARU RT 001 RW 003 KECAMATAN KUWARASAN KABUPATEN KEBUMEN', 'Perempuan', 'efisuryanti33367@gmail.com', '08991694520', '08991694520', 'KASI KOMERSIAL CABANG GOMBONG', 'Bachelor/S1', 'Pendidikan Fisika', 'LAMPIRAN LAMARAN.pdf', '2024-11-15 07:45:13', '2024-11-15 07:45:13'),
(159, 'EFI SURYANTI', 'KEBUMEN', '1992-10-03', 'DESA KUWARU RT 001 RW 003 KECAMATAN KUWARASAN KABUPATEN KEBUMEN', 'DESA KUWARU RT 001 RW 003 KECAMATAN KUWARASAN KABUPATEN KEBUMEN', 'Perempuan', 'efisuryanti409@gmail.com', '08991694520', '08991694520', 'ANALIS KREDIT AREA', 'Bachelor/S1', 'Pendidikan Fisika', 'LAMPIRAN BERKAS.pdf', '2024-11-15 09:33:42', '2024-11-15 09:33:42'),
(160, 'Afif Mustofa', 'Wonosobo', '1995-04-02', 'Kertek RT 007 RW 003 Desa Batursari Kecamatan Sapuran Kabupaten Wonosobo Prov. Jawa Tengah', 'Bendan RT 004 RW 003 Desa Kebonsari Kecamatan Wonoboyo Kabupaten Temanggung Prov. Jawa Tengah', 'Laki-laki', 'afifmustofa0204@gmail.com', '085291706443', '085291706443', 'ANALIS KREDIT AREA', 'Bachelor/S1', 'Manajemen', 'Lamaran BPR Kusuma Sumbing & Lampiran.pdf', '2024-11-18 07:32:17', '2024-11-18 07:32:17'),
(161, 'Afif Mustofa', 'Wonosobo', '1995-04-02', 'Kertek RT 007 RW 003 Desa Batursari Kecamatan Sapuran Kabupaten Wonosobo', 'Bendan RT 004 RW 003 Desa Kebonsari Kecamatan Wonoboyo Kabupaten Temanggung', 'Laki-laki', 'afifmustofa0204@gmail.com', '085291706443', '085291706443', 'ANALIS KREDIT AREA', 'Bachelor/S1', 'Manajemen', 'Lamaran BPR Kusuma Sumbing & Lampiran.pdf', '2024-11-18 07:35:48', '2024-11-18 07:35:48'),
(162, 'Ria Tika Susanti', 'Tamora', '2001-10-25', 'Malebo Barat rt 007/rw 003, kec. Kandangan, Kab. Temanggung', 'Jl. Karanggawang Lama No. 5, Kota Semarang', 'Perempuan', 'riatikasusanti7800@gmail.com', '08562999378', '08562999378', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'IPA', 'berkas lamaran.pdf', '2024-11-19 07:41:23', '2024-11-19 07:41:23'),
(163, 'SRI PUJI UTOMO ERWIN DARMAWAN', 'KABUPATEN SEMARANG', '1988-07-28', 'PERUM CINDELARAS RT 005 RW 008 KARANGTENGAH KECAMATAN TUNTANG KABUPATEN SEMARANG', 'PERUM CINDELARAS RT 005 RW 008 KARANGTENGAH KECAMATAN TUNTANG KABUPATEN SEMARANG', 'Laki-laki', 'erwindarmawan620@gmail.com', '081329999064', '081329999064', 'ACCOUNT OFFICER/MARKETING KREDIT KC AMBARAWA', 'D3', 'TEKNIK INFROMATIKA', 'CV ERWIN.pdf', '2024-11-19 20:47:05', '2024-11-19 20:47:05'),
(164, 'Yoyok Anggoro', 'Temanggung', '1992-05-26', 'DUSUN MENTO BAWANG RT 002 RW 001 DESA MENTO, KECAMATAN CANDIROTO, 56257 TEMANGGUNG, JAWA TENGAH', 'DUSUN MENTO BAWANG RT 002 RW 001 DESA MENTO, KECAMATAN CANDIROTO, 56257 TEMANGGUNG, JAWA TENGAH', 'Laki-laki', 'yoke.ibrahimovic@gmail.com', '087837950481', '087837950481', 'ANALIS KREDIT AREA', 'Bachelor/S1', 'Manajemen', 'LAMARAN (6)_merged.pdf', '2024-11-21 19:17:22', '2024-11-21 19:17:23'),
(165, 'WIDHIYANI', 'TEMANGGUNG', '1993-08-28', 'GANJURAN RT 04 RW 05', 'GANJURAN RT 04 RW 05', 'Perempuan', 'widhiyaniwidie@gmail.com', '085643650342', '085643650342', 'REMEDIAL/PENAGIHAN KANTOR PARAKAN', 'Bachelor/S1', 'Teknik Industri', 'lamaran widhiyani.pdf', '2024-11-22 18:14:07', '2024-11-22 18:14:07'),
(166, 'WIDHIYANI', 'TEMANGGUNG', '1993-08-28', 'GANJURAN RT 04 RW 05', 'GANJURAN RT 04 RW 05', 'Perempuan', 'widhiyaniwidie@gmail.com', '085643650342', '085643650342', 'ANALIS KREDIT AREA', 'Bachelor/S1', 'Teknik Industri', 'lamaran widhiyani.pdf', '2024-11-22 18:15:12', '2024-11-22 18:15:12'),
(167, 'Hani Pertiwi', 'Jakarta', '1994-08-29', 'Kajeran RT:04/ RW:05, Pendowo, Kranggan, Temanggung', 'Kajeran RT:04/RW:05, Pendowo, Kranggan, Temanggung', 'Perempuan', 'pertiwihani94@gmail.com', '085878171222', '085878171222', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Kimia', 'Hani Pertiwi.pdf', '2024-11-24 17:51:47', '2024-11-24 17:51:47'),
(168, 'Intan Shinta Wanti', 'Magelang', '1999-11-21', 'Kantor 001/001 Kelurahan Kaliabu, Kecamatan Salaman, Kabupaten Magelang', 'Kantor 001/001 Kelurahan Kaliabu, Kecamatan Salaman, Kabupaten Magelang', 'Perempuan', 'intanshinta33@gmail.com', '083115077121', '083115077121', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Akuntansi', 'Intan Shinta_Staff Operasional.pdf', '2024-11-25 07:54:08', '2024-11-25 07:54:08'),
(169, 'Sahrul Gunawan', 'Temanggung', '1997-08-29', 'Ds. Tretep Rt. 003 Rw. 001 Kec. Tretep Kab. Temanggung', 'Ds. Tretep Rt. 003 Rw. 001 Kec. Tretep Kab. Temanggung', 'Laki-laki', 'gunawansahrul513@gmail.com', '081390568829', '08895676705', 'ANALIS KREDIT AREA', 'Bachelor/S1', 'Manajemen', 'Sahrul gunawan.pdf', '2024-11-25 11:39:09', '2024-11-25 11:39:09'),
(170, 'Adhitya Pamungkas', 'Tegal', '2001-05-10', 'Desa Pagongan RT 3 RW 3 Kecamatan Dukuhturi Kabupaten Tegal', 'Desa Pagongan RT 3 RW 3 Kecamatan Dukuhturi Kabupaten Tegal', 'Laki-laki', 'adityapamoengkas@gmail.com', '0895703044737', '0895703044737', 'ANALIS KREDIT AREA', 'D3', 'Akuntansi', 'PT. BPR KSB.pdf', '2024-11-25 16:02:36', '2024-11-25 16:02:36'),
(171, 'SHINTIA LINDA HUTAMI', 'KABUPATEN DEMAK', '1996-05-28', 'PONDOK MAJAPAHIT 1. JL. PALAPA KENCANA 2 BLOK V NOMOR 6 RT 10 RW 04 MRANGGEN DEMAK 59567', 'PONDOK MAJAPAHIT 1. JL. PALAPA KENCANA 2 BLOK V NOMOR 6 RT 10 RW 04 MRANGGEN DEMAK 59567', 'Perempuan', 'shintia.hutami@gmail.com', '089636338045', '089636338045', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Analis Keuangan', 'SURAT LAMARAN PT BPR Kusuma Sumbing.pdf', '2024-11-25 20:46:23', '2024-11-25 20:46:23'),
(172, 'Rahmawati Puja Setiani', 'Pati', '2003-01-03', 'Ds. Sumbersari Rt 01 Rw 05', 'Ds. Sumbersari Rt 01 Rw 05', 'Perempuan', 'rahmapuja313@gmail.com', '081299706373', '085232331994', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Manajemen', 'CV DAN LAMARAN 2.pdf', '2024-11-25 21:35:28', '2024-11-25 21:35:28'),
(173, 'ENZELINA NAPITUPULU', 'TAMAN RAJA', '2000-11-23', 'JL. PEMATANG TEMBESU RT 03', 'JL. BEKASI TIMUR REGENCY', 'Perempuan', 'enzelinanapitupulu23@gmail.com', '083121863850', '083121863850', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'PENDIDIKAN BAHASA INGGRIS', 'FILE GABUNGAN.pdf', '2024-11-26 08:43:24', '2024-11-26 08:43:24'),
(174, 'Kerti bayuno', 'Banyumas', '1982-02-24', 'Semedo RT 02 RW 04 Kec.Pekuncen Kab.Banyumas Jawa Tengah', 'Beji RT 02 RW 13 Kedung Banteng Kab.Banyumas Jawa Tengah', 'Laki-laki', 'kerti.bayuno@yahoo.com', '08111012402', '08111012402', 'KASI KOMERSIAL CABANG SOKARAJA', 'D3', 'Teknik Mesin', 'CV KertiB.pdf', '2024-11-26 10:12:57', '2024-11-26 10:12:57'),
(175, 'Novita Tri Handayani', 'Temanggung', '1990-11-28', 'Karang Senen, RT 009 / RW 005, Traji, Parakan, Temanggung', 'Karang Senen, RT 009 / RW 005, Traji, Parakan, Temanggung', 'Perempuan', 'novita.trihandayani28@gmail.com', '085726757028', '085726757028', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Ekonomi Manajemen', 'Berkas Lamaran BPR KSB.pdf', '2024-11-26 13:16:46', '2024-11-26 13:16:46'),
(176, 'Dian Wahyu Rahmadani', 'Cilacap', '2000-12-17', 'Jl. Baruna Timur 4 Perum Tegal Asri RT 07 RW 16, Kelurahan Tegalkamulyan, Kecamatan Cilacap Selatan, Kab. Cilacap', 'Jl. Baruna Timur 4 Perum Tegal Asri RT 07 RW 16, Kelurahan Tegalkamulyan, Kecamatan Cilacap Selatan, Kab. Cilacap', 'Perempuan', 'dianwahyu7687@gmail.com', '081575582181', '081575582181', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Akuntansi', 'combinepdf (18).pdf', '2024-11-28 13:47:51', '2024-11-28 13:47:51'),
(177, 'AAN SETIYAWAN S.M', 'WONOSOBO', '1995-09-14', 'TIMBANG RT 005 RW 003 TIMBANG LEKSONO WONOSOBO JAWA TENGAH', 'TIMBANG RT 005 RW 003 TIMBANG LEKSONO WONOSOBO JAWA TENGAH', 'Laki-laki', 'aansetiyawan140995@gmail.com', '085641617616', '085641617616', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'management', 'CV_AAN SETIYAWAN S.M.pdf', '2024-11-28 16:35:39', '2024-11-28 16:35:39'),
(178, 'Avifah Nur Aini', 'Banyumas', '2002-08-18', 'Kasegeran RT 08 RW 01, Kec. Cilongok, Kab. Banyumas, Jawa Tengah 53162 Indonesia', 'Kasegeran RT 08 RW 01, Kec. Cilongok, Kab. Banyumas, Jawa Tengah 53162 Indonesia', 'Perempuan', 'avifahnuraini18@gmail.com', '081545416292', '081545416292', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Agribisnis', 'Surat lamaran PT BPR Kusuma Sumbing.pdf', '2024-11-29 10:11:37', '2024-11-29 10:11:37'),
(179, 'Tri Irawati', 'Semarang', '2000-06-23', 'Dk siwarak Rt 05/Rw 02 Kandri Kec. Gunungpati Kota Semarang', 'Dk siwarak Rt 05/Rw 02 Kandri Kec. Gunungpati Kota Semarang', 'Perempuan', 'triiirawati@gmail.com', '085876249196', '085876249196', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Ilmu Hukum', 'CV IRA.pdf', '2024-11-29 18:52:42', '2024-11-29 18:52:42'),
(180, 'Aji Pramono', 'Pati', '2001-01-17', 'Dkh. Gajah, Ds. Lahar RT 01/ RW 06, Kec. Tlogowungu, Kab. Pati 51961', 'Perumahan Cluster Dinar Indah, Blok 3 D No. 13, RT 08/ RW 26, Kelurahan Meteseh, Tembalang, Kota Semarang, Jawa Tengah 50271', 'Laki-laki', 'pramaji2020@gmail.com', '085226308544', '085226308544', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'S1 Akuntansi', 'Berkas Lamaran_Aji Pramono_Account Officer_BPR Kusuma Sumbing.pdf', '2024-12-02 13:20:47', '2024-12-02 13:20:47'),
(181, 'Aji Pramono', 'Pati', '2001-01-17', 'Dkh. Gajah, Ds. Lahar RT 01/ RW 06, Kec. Tlogowungu, Kab. Pati 59161', 'Perumahan Cluster Dinar Indah, Blok 3 D No. 13, RT 08/ RW 26, Kelurahan\r\nMeteseh, Tembalang, Kota Semarang, Jawa Tengah 50271', 'Laki-laki', 'pramaji2020@gmail.com', '085226308544', '085226308544', 'ACCOUNT OFFICER/MARKETING KREDIT KC AMBARAWA', 'Bachelor/S1', 'S1 Akuntansi', 'Lamaran Pekerjaan_Account Officer_Ambarawa.pdf', '2024-12-02 14:07:05', '2024-12-02 14:07:05'),
(182, 'Erry Tristanto', 'Merauke', '1977-08-05', 'Perum Jambu Sari Indah jln .Belimbing NO.19 Wedomartani Ngemplak SLeman Yogyakarta', 'PErum Aza Griya Jln. Rajawali IV blok C.6 Walitelon utara Temanggung Jawa Tengah', 'Laki-laki', 'errytristanto@gmail.com', '085229326060', '08122764114', 'KASI KOMERSIAL CABANG TEMANGGUNG', 'Bachelor/S1', 'Teknik SIpil', 'Lamaran Pekerjaan, cv, transkrip.pdf', '2024-12-02 15:49:17', '2024-12-02 15:49:17'),
(183, 'AFIF MUSTOFA', 'WONOSOBO', '1995-04-02', 'DUSUN KERTEK RT 007 RW 003 DESA BATURSARI KECAMATAN SAPURAN KABUPATEN WONOSOBO', 'DUSUN BENDAN RT 004 RW 003 DESA KEBONSARI KECAMATAN WONOBOYO KABUPATEN TEMANGGUNG', 'Laki-laki', 'afifmustofa0204@gmail.com', '085291706443', '085291706443', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'MANAJEMEN', 'LAMARAN BPR KUSUMA SUMBING NEW.pdf', '2024-12-03 16:24:41', '2024-12-03 16:24:41'),
(184, 'galuh kusuma hasari', 'sidoarjo', '1999-08-13', 'jl. bogenvil C-111 Perum GTCK, RT17/RW09', 'jl. bogenvil C-111 Perum GTCK, RT17/RW09', 'Perempuan', 'galuhkhapsari@gmail.com', '087857916738', '087857916738', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'hukum', 'Surat lamaran umum galuh(1).pdf', '2024-12-03 22:51:11', '2024-12-03 22:51:11'),
(185, 'Fani Wulandari', 'Temanggung', '2002-06-05', 'Boresan 1, Rt 4, Rw 1, Balesari, Bansari, Temanggung, Jawa Tengah', 'Boresan 1, Rt 4, Rw 1, Balesari, Bansari, Temanggung, Jawa Tengah', 'Perempuan', 'fani.wdr@gmail.com', '088238189464', '088238189464', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Ilmu Komunikasi', 'Fani Wulandari _Staf Operasional.pdf', '2024-12-05 06:58:13', '2024-12-05 06:58:13'),
(186, 'Syaputri Anggita Rahmawati', 'Kab.Semarang', '2004-01-07', 'Dusun.Karang Desa. Tukang Rt 03/ RW 04 Kec.Pabelan Kab. Semarang', 'Dusun.Karang Desa. Tukang Rt 03/ RW 04 Kec.Pabelan Kab. Semarang', 'Perempuan', 'syaputrianggita13@gmail.com', '081217273515', '081217273515', 'ACCOUNT OFFICER/MARKETING KREDIT KC AMBARAWA', 'D3', 'D3 Gizi', 'Account Officer _Syaputri Anggita Rahmawati.pdf', '2024-12-05 07:52:28', '2024-12-05 07:52:28'),
(187, 'Jabbar Maulana Ibadil Ma\'wa', 'Demak', '2000-05-13', 'Kangkung Karang RT01 RW06 Kecamatan Mranggen Kabupaten Demak', 'Kangkung Karang RT01 RW06 Kecamatan Mranggen Kabupaten Demak', 'Laki-laki', 'jabbarmaulana011@gmail.com', '085225369249', '085225369249', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Manajemen', 'Surat Lamaran Jabbar Maulana..pdf', '2024-12-05 15:35:38', '2024-12-05 15:35:38'),
(188, 'Furqon Praditya Wahyu', 'Klaten', '2000-08-29', 'Wangen, RT/RW 001/002, Wangen, Polanharjo, Klaten', 'Wangen, RT/RW 001/002, Wangen, Polanharjo, Klaten', 'Laki-laki', 'furqonwahyu.fw@gmail.com', '081274594839', '081274594839', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'MIPA', 'Lamaran Pekerjaan AO Delanggu.pdf', '2024-12-06 15:56:07', '2024-12-06 15:56:07'),
(189, 'noviansen putra aji', 'poncowati', '1987-10-05', 'perum madureso indah no 76 rt 002 rw 007 madureso temanggung', 'perum madureso indah no 76 rt 002 rw 007 madureso temanggung', 'Laki-laki', 'putraadjie@yahoo.com', '087895430465', '087895430465', 'ACCOUNT OFFICER/MARKETING KREDIT KC TEMANGGUNG', 'Master/S2', 'manajemen', 'ilovepdf_merged_compressed.pdf', '2024-12-08 14:37:51', '2024-12-08 14:37:51'),
(190, 'Noviansen Putra Aji', 'poncowati', '1987-10-05', 'Perum Madureso Indah no 76 Temanggung', 'Perum Madureso Indah No 76 Temanggung', 'Laki-laki', 'putraadjie@yahoo.com', '087895430465', '087895430465', 'ANALIS KREDIT AREA', 'Master/S2', 'Manajemen', 'ilovepdf_merged_compressed.pdf', '2024-12-08 14:47:46', '2024-12-08 14:47:46'),
(191, 'Kerti Bayuno', 'Banyumas', '1982-02-24', 'Semedo RT 02 RW 04 Pekuncen Banyumas Jawa Tengah', 'Beji RT 02 RW 13 Kedung Banteng Banyumas Jawa Tengah', 'Laki-laki', 'kerti.bayuno@yahoo.com', '0816909469', '081327988868', 'ANALIS KREDIT AREA', 'D3', 'Teknik Mesin', 'CVku 2024.pdf', '2024-12-09 09:57:54', '2024-12-09 09:57:54'),
(192, 'Charirotun Nasifah', 'Temanggung', '2000-04-24', 'Ngadisari RT/RW 02/03, Gondosuli, Bulu, Temanggung', 'Ngadisari RT/RW 02/03, Gondosuli, Bulu, Temanggung', 'Perempuan', 'charirnasyfa@gmail.com', '088229519867', '088229519867', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Akuntansi', 'Berkas Lamaran_CHARIROTUN N.pdf', '2024-12-09 17:07:21', '2024-12-09 17:07:21'),
(193, 'sosiawan bangkit samodro', 'magelang', '1989-04-06', 'jalan ripsomoharjo 410 a rt 6 rw5 magelang', 'desa tembarak kidul/kecamatan tembarak kabupaten temanggung', 'Laki-laki', 'sosiawanbangkit@gmail.com', '087812569975', '087812569975', 'REMEDIAL/PENAGIHAN KANTOR PARAKAN', 'Bachelor/S1', 'fakultas ekonomi jurusan ekon omi pembangunan', 'remedial.pdf', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(194, 'Retno asmi try ayuni', 'Kuningan', '2001-01-11', 'Muntung RT.02 Rw 01 kec. Candiroto TEMANGGUNG', 'Muntung RT.02 Rw 01 kec. Candiroto TEMANGGUNG', 'Perempuan', 'retnoazmi11@gmail.com', '08990724799', '08990724799', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Teknologi Pangan', 'combinepdf (1).pdf', '2024-12-12 19:42:23', '2024-12-12 19:42:23'),
(195, 'Retno asmi try ayuni', 'Kuninangan', '2001-01-11', 'Muntung Rt. 02 Rw 01 Kec. Candiroto TEMANGGUNG', 'Muntung Rt. 02 Rw 01 Kec. Candiroto TEMANGGUNG', 'Perempuan', 'retnoazmi11@gmail.com', '08990724799', '08990724799', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Teknologi Pangan', 'combinepdf (1).pdf', '2024-12-12 19:47:33', '2024-12-12 19:47:33'),
(196, 'Felix Rizqian', 'Banjarnegara', '1999-08-14', 'Desa Kemiri Rt 04/02, Kecamatan Sigaluh, Kabupaten Banjarnegara, Jawa Tengah', 'Desa Kemiri Rt 04/02, Kecamatan Sigaluh, Kabupaten Banjarnegara, Jawa Tengah', 'Laki-laki', 'rizqianfelix8@gmail.com', '0882003017776', '0882003017776', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'SMA/Sederajat', 'Manajemen', 'Felix Rizqian BPR Kusuma Sumbing.pdf', '2024-12-12 21:37:18', '2024-12-12 21:37:18'),
(197, 'Wirawan Widi Prakosa', 'Ketapang, Kalimantan Barat', '1998-11-22', 'Sambek No. 3 RT 1 RW 1 Wonosobo, Jawa Tengah 56312', 'Perum Limas Garden Blok C No. 6 RT 01 RW 08 Kelurahan Jlamprang , Wonosobo  Jawa Tengah 56319', 'Laki-laki', 'wirawanwidi1101@gmail.com', '085713430895', '085713430895', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Ekonomi', 'CV dan Kelengkapan.pdf', '2024-12-14 02:56:05', '2024-12-14 02:56:05'),
(198, 'Wirawan Widi Prakosa', 'Ketapang Kalimantan Barat', '1998-11-22', 'Sambek No. 3 RT 1 RW 1 Wonosobo, Jawa Tengah 56312', 'Perum Limas Garden Blok C No. 6 RT 01 RW 08 Kelurahan Jlamprang , Wonosobo  Jawa Tengah 56319', 'Laki-laki', 'wirawanwidi1101@gmail.com', '085713430895', '085713430895', 'ANALIS KREDIT AREA', 'Bachelor/S1', 'Ekonomi', 'CV dan Kelengkapan.pdf', '2024-12-14 02:57:11', '2024-12-14 02:57:11'),
(199, 'YUSUF WISNU NUGROHO', 'GROBOGAN', '2000-11-29', 'BRAMAN TIMUR 03/04 JAMBON GEMAWANG TEMANGGUNG', 'BRAMAN TIMUR 03/04 JAMBON GEMAWANG TEMANGGUNG', 'Laki-laki', 'YUSUFWISNU0@GMAIL.COM', '085157171106', '085157171106', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'HUKUM EKONOMI SYARIAH', 'Surat Lamaran Kerja bpr kusuma-digabungkan.pdf', '2024-12-14 20:30:29', '2024-12-14 20:30:29'),
(200, 'Handoko', 'Demak', '1993-11-09', 'Gili Rt 04 Rw 05 Margohayu Kecamatan Karangawen Kabupaten Demak', 'Gili Rt 04 Rw 05 Margohayu Kecamatan Karangawen Kabupaten Demak', 'Laki-laki', 'handokohand321@gmail.com', '085741585100', '0857415858100', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Ekonomi Manajemen', 'LAMARAN BPR SEMERU_compressed.pdf', '2024-12-15 19:54:50', '2024-12-15 19:54:50'),
(201, 'Wirawan Widi Prakosa', 'Ketapang', '1998-11-22', 'Sambek No. 3 RT 1 RW 1 Wonosobo, Jawa Tengah 56312', 'Perum Limas Garden Blok C No. 6 RT 01 RW 08 Kelurahan Jlamprang , Wonosobo  Jawa Tengah 56319', 'Laki-laki', 'wirawanwidi1101@gmail.com', '085713430895', '085713430895', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Ekonomi', 'Wirawan Widi Prakosa_Analis Kredit.pdf', '2024-12-16 11:56:45', '2024-12-16 11:56:45'),
(202, 'Wirawan Widi Prakosa', 'Ketapang', '1998-11-22', 'Sambek No. 3 RT 1 RW 1 Wonosobo, Jawa Tengah 56312', 'Perum Limas Garden Blok C No. 6 RT 01 RW 08 Kelurahan Jlamprang , Wonosobo  Jawa Tengah 56319', 'Laki-laki', 'wirawanwidi1101@gmail.com', '085713430895', '085713430895', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Ekonomi', 'Wirawan Widi Prakosa_Staff Operasional Parakan.pdf', '2024-12-16 11:58:36', '2024-12-16 11:58:36'),
(203, 'Kresno Akmal Hanif', 'Kabupaten Kudus', '2000-08-27', 'Peganjaran RT 06 RW 03 Kecamatan Bae, Kabupaten Kudus, Jawa Tengah', 'Jl. Raya Besito No.36 Peganjaran RT06/03 Kecamatan Bae, Kabupaten Kudus, Jawa Tengah.', 'Laki-laki', 'kresnohanif@gmail.com', '085331518973', '085331518973', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Teknik Informatika', 'Berkas Lamaran BPR Kusuma Sumbing.pdf', '2024-12-16 15:20:22', '2024-12-16 15:20:22'),
(204, 'M. Mada Gian Ananta', 'Kota Semarang', '2000-06-02', 'Jl. Singa Utara Dalam i No. 20 Kalicari, Pedurungan, Kota Semarang', 'Jl. Singa Utara Dalam i No. 20 Kalicari, Pedurungan, Kota Semarang', 'Laki-laki', 'madagian93@gmail.com', '082135344201', '082135344201', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Teknik Sipil', 'SURAT LAMAAN KERJA PT. BPR Kusuma Sumbing.pdf', '2024-12-16 18:55:40', '2024-12-16 18:55:40'),
(205, 'Lutfia Inda Rahmawati', 'Klaten', '2002-01-10', 'Ds. Cening, Kec. Singorojo, Kab. Kendal, Jawa Tengah, Indonesia.', 'Ds. Cening, Kec. Singorojo, Kab. Kendal, Jawa Tengah, Indonesia.', 'Perempuan', 'indalutfia7@gmail.com', '085855516606', '085855516606', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'S-1', 'Lamaran Pekerjaan_Administrasi(Lutfia).pdf', '2024-12-28 16:42:35', '2024-12-28 16:42:35'),
(206, 'Jefri Noviantoro', 'Temanggung', '1999-11-26', 'Dusun pringapus RT 02/10 Getas Kaloran Temanggung', 'Dusun pringapus RT 02/10 Getas Kaloran Temanggung', 'Laki-laki', 'jefrinoviantoro99@gmail.com', '087863431711', '087863431711', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Administrasi Bisnis', 'DOC-20250103-WA0000..pdf', '2025-01-03 01:08:21', '2025-01-03 01:08:21'),
(207, 'Jefri Noviantoro', 'Temanggung', '1999-11-26', 'Dusun pringapus RT 02/10 Getas Kaloran Temanggung', 'Dusun pringapus RT 02/10 Getas Kaloran Temanggung', 'Laki-laki', 'jefrinoviantoro99@gmail.com', '087863431711', '087863431711', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Administrasi Bisnis', 'DOC-20250103-WA0000..pdf', '2025-01-03 01:12:20', '2025-01-03 01:12:20'),
(208, 'EKO PUJI NURROHMAN', 'KEBUMEN', '1997-11-21', 'Desa karanggedang rt 4 rw 4 kecamatan sruweng kabupaten kebumen', 'Desa karanggedang rt 4 rw 4 kecamatan sruweng kabupaten kebumen', 'Laki-laki', 'ekopujin21@gmail.com', '0882007978552', '0882007978552', 'ACCOUNT OFFICER/MARKETING KREDIT KC GOMBONG', 'Bachelor/S1', 'MANAJEMEN', 'EKO PUJI N.pdf', '2025-01-07 04:56:50', '2025-01-07 04:56:50'),
(209, 'Bagus Bayu Utomo', 'Surabaya', '1996-05-20', 'Jl. Riyanto G Mawar II No. 25 A Kel. Sumampir, Kec.  Purwokerto Utara, Kab. Banyumas', 'Jl. Riyanto G Mawar II No. 25 A Kel. Sumampir, Kec.  Purwokerto Utara, Kab. Banyumas', 'Laki-laki', 'bayub21.bb@gmail.com', '085747193395', '085747193395', 'ACCOUNT OFFICER/MARKETING KREDIT KC SOKARAJA', 'Bachelor/S1', 'Teknik Sipil', 'Berkas Lamaran PT. BPR Kusuma Sumbing.pdf', '2025-01-07 12:56:50', '2025-01-07 12:56:50'),
(210, 'Ovy Aprillia Dinisa', 'Temanggung', '2001-04-11', 'Mangli RT 1 RW 1, Mutung, Kec. Candiroto, Kab. Temanggung', 'Mangli RT 1 RW 1, Mutung, Kec. Candiroto, Kab. Temanggung', 'Perempuan', 'ovydinisa11@gmail.com', '08988813445', '08988813445', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Ilmu Administrasi Negara', 'Lampiran Ovy Aprillia Dinisa.pdf', '2025-01-08 18:38:48', '2025-01-08 18:38:48'),
(211, 'Erry Tristanto', 'Merauke', '1977-08-05', 'Perum jambusari indahjln belumbing no.19 wedomartani ngemplak sleman yogyakarta', 'Pwrum Azagriya walitelon utara jln rajawali 4 no c6.walitelon utara temanggung', 'Laki-laki', 'errytristanto5877@gmail.com', '085229326060', '08122764114', 'KASI KOMERSIAL CABANG TEMANGGUNG', 'Bachelor/S1', 'Teknik sipul umun', 'BERKAS CV.pdf', '2025-01-13 15:20:54', '2025-01-13 15:20:54'),
(212, 'Muhammad Rinaldi', 'Aceh', '1993-10-07', 'Kauman 07/02 medari ngadirejo temanggung', 'Kauman 07/02 medari ngadirejo temanggung', 'Laki-laki', 'yunany182@gmail.com', '085727500848', '085727500848', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Multimedia', 'Image_to_PDF_13012025_174023.pdf', '2025-01-13 17:46:36', '2025-01-13 17:46:36'),
(213, 'Muhamad Ridwan', 'Jakarta', '1997-07-02', 'Gondangan, 003/004, Ngadirejo, Temanggung', 'Kp stasiun, 003/004, Wonosobo', 'Laki-laki', 'muhamadridwan2797@gmail.com', '085865897978', '085865897978', 'ANALIS KREDIT AREA', 'D3', 'Akademi Keperawatan', 'Laker Muhamad Ridwan-1.pdf', '2025-01-14 13:09:17', '2025-01-14 13:09:17'),
(214, 'SINDI FATIKA RAHMAWATI', 'TEMANGGUNG', '2000-06-07', 'Krajan RT 009/003, Jambon, Kec. Gemawang, Kab. Temanggung, Jawa Tengah', 'Krajan RT 009/003, Jambon, Kec. Gemawang, Kab. Temanggung, Jawa Tengah', 'Perempuan', 'sindifatikarahmawati@gmail.com', '085727138036', '085727138036', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'MANAJEMEN', 'STAF OPERASIONAL_SINDI FATIKA.pdf', '2025-01-14 14:29:53', '2025-01-14 14:29:53'),
(215, 'MUHAMMAD YUSUF', 'jepara', '2001-07-28', 'Desa pecangaan kulon rt01rw07, Kec pecangaan  Kab jepara , jawa tengah', 'Desa pecangaan kulon rt01rw07, Kec pecangaan  Kab jepara , jawa tengah', 'Laki-laki', 'muhammadyusuf2850@gmail.com', '082133678400', '082133678400', 'ANALIS KREDIT AREA', 'Bachelor/S1', 'teknik sipil', 'lamaran lengkap.pdf', '2025-01-16 11:36:22', '2025-01-16 11:36:22'),
(216, 'DILLA ZULFA NUR DZAKIYYAH', 'Kendal', '2001-03-06', 'Dusun Ngepal RT 004 RW 004, Desa Pucak Wangi, Kec. Pageruyung, Kab. Kendal', 'Desa Kuwaron, Kec. Gubug, Kab. Grobogan', 'Perempuan', 'dillazulfa17@gmail.com', '088224196051', '0882005085203', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Ilmu Hukum', 'FILE DILLA ZULFA.pdf', '2025-01-16 12:52:41', '2025-01-16 12:52:41'),
(217, 'Laelasari', 'Bogor', '2001-07-16', 'Kp cikiruh rt 02/03 desa petir kec dramga kab bogor', 'Bogor barat', 'Perempuan', 'laelasari162001@gmail.com', '0895348068737', '087884856076', 'ACCOUNT OFFICER/MARKETING KREDIT KC GOMBONG', 'SMA/Sederajat', 'Marketing', 'Berkas lamaran_ LAELASARI.pdf', '2025-01-19 23:41:15', '2025-01-19 23:41:15'),
(218, 'Laelasari', 'Bogor', '2001-07-16', 'Kp cikiruh rt 02/03 desa petir kec dramaga kab bogor barat', 'Kp cikiruh rt 02/03 desa petir kec dramga kab bogor', 'Perempuan', 'laelasari162001@gmail.com', '0895348068737', '087884856076', 'REMEDIAL/PENAGIHAN KANTOR PARAKAN', 'SMA/Sederajat', 'Marketing', 'Berkas lamaran_ LAELASARI.pdf', '2025-01-19 23:49:30', '2025-01-19 23:49:30'),
(219, 'Fadhilal Zakki Prastyo Utomo', 'Grobogan', '1996-11-22', 'Ds. Pranten 03/02', 'Ds. Pranten 03/02', 'Laki-laki', 'fadhilalzakki0842@gmail.com', '081215210304', '081215210304', 'ANALIS KREDIT AREA', 'Bachelor/S1', 'Ilmu Hukum', 'CV FADHILAL bpr kusuma sumbing.pdf', '2025-01-28 20:31:41', '2025-01-28 20:31:41'),
(220, 'Fadhilal Zakki Prastyo Utomo', 'Grobogan', '1996-11-22', 'Ds. Pranten 03/02', 'Ds. Pranten 03/02', 'Laki-laki', 'fadhilalzakki0842@gmail.com', '081215210304', '081215210304', 'KASI KOMERSIAL CABANG TEMANGGUNG', 'Bachelor/S1', 'Ilmu Hukum', 'CV FADHILAL bpr kusuma sumbing.pdf', '2025-01-28 20:33:15', '2025-01-28 20:33:15'),
(221, 'Farid Muhamad Faza', 'Temanggung', '2001-12-06', 'Seneng Pateken Wonoboyo Temanggung', 'Seneng Pateken Wonoboyo Temanggung', 'Laki-laki', 'faridmuhamadfaza@gmail.com', '088227605074', '088227605074', 'KASI KOMERSIAL CABANG TEMANGGUNG', 'Bachelor/S1', 'Hukum', 'ilovepdf_merged.pdf', '2025-02-06 09:10:57', '2025-02-06 09:10:57'),
(222, 'Meuthia Amalia', 'Pati', '2000-05-13', 'Sarirejo RT 10 RW 01, Kec Pati, Kab. Pati', 'Jl. Kunir, Kel. Banyumanik, Kec. Banyumanik, Kota Semarang', 'Perempuan', 'meuthiamalia@gmail.com', '089612841468', '089612841468', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Akuntansi', 'CV_Meuthia Amalia_Account Officer Kredit_BPR Kusuma Sumbing.pdf', '2025-02-12 22:15:03', '2025-02-12 22:15:03'),
(223, 'Jefri Noviantoro', 'Kab. Temanggung', '1999-11-26', 'Dusun Pringapus rt02 10 Getas kaloran Temanggung Jawa Tengah', 'Dusun Pringapus rt02 10 Getas kaloran Temanggung Jawa Tengah', 'Laki-laki', 'jefrinoviantoro99@gmail.com', '087863431711', '087863431711', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Administrasi Bisnis', 'DOC-20250103-WA0000..pdf', '2025-02-19 18:57:04', '2025-02-19 18:57:04'),
(224, 'Panggih Nugroho Wicaksono', 'Kendal', '1995-07-16', 'Sumber, 08/01, Kebumen, Sukorejo, Kendal', 'Sumber, 08/01, Kebumen, Sukorejo, Kendal', 'Laki-laki', 'panggihnw@gmail.com', '085950277477', '085950277477', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Pendidikan IPS', 'BPR KUSUMA SUMBING.pdf', '2025-02-21 09:56:27', '2025-02-21 09:56:27'),
(225, 'Rizqi Romadhoni', 'Semarang', '1991-04-15', 'Jl Amarta ll RT 003 RW 002 Cangkiran Mijen Semarang', 'Jl Amarta ll RT 003 RW 002 Cangkiran Mijen Semarang', 'Laki-laki', 'veekim518@gmail.com', '0895425423222', '0895425423222', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'IPS', '~temp_1740132187656-compressed.pdf', '2025-02-21 17:08:56', '2025-02-21 17:08:56'),
(226, 'Siswoyo', 'Blora', '1992-10-27', 'Padas indah 02/02 tambakan gubug grobogan', 'Padas indah 02/02 tambakan gubug grobogan', 'Laki-laki', 'kalissripah@gmail.com', '082322701216', '082322701216', 'ANALIS KREDIT AREA', 'Bachelor/S1', 'AKUNTANSI', 'BPR KSB.pdf', '2025-02-23 21:19:53', '2025-02-23 21:19:53'),
(227, 'SISWOYO', 'BLORA', '1992-10-27', 'Padas indah 02/02 tambakan gubug grobogan', 'Padas indah 02/02 tambakan gubug grobogan', 'Laki-laki', 'kalissripah@gmail.com', '082322701216', '082322701216', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'AKUNTANSI', 'AO_merged.pdf', '2025-02-23 21:38:36', '2025-02-23 21:38:36'),
(228, 'Ardian Danu Saputra', 'Kabupaten Semarang', '2002-05-02', 'Dusun Krajan RT 3 RW 1 Desa Barukan Kecamatan Tengaran Kabupaten Semarang', 'Dusun Krajan RT 4 RW 1 Desa kandangan Kecamatan Kandangan Kabupaten Temanggung', 'Laki-laki', 'ardiansaputra020502@gmail.com', '0859159927221', '0859159927221', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'Akuntansi', 'Ardian Danu Saputra_Berkas Lamaran.pdf', '2025-03-01 10:07:44', '2025-03-01 10:07:44'),
(229, 'Farid Muhamad Faza', 'Temanggung', '2001-12-06', 'Seneng rt 12 rw 04 pateken wonoboyo temanggung', 'Seneng rt 12 rw 04 pateken wonoboyo temanggung', 'Laki-laki', 'faridmuhamadfaza@gmail.com', '088227605074', '088227605074', 'REMEDIAL/PENAGIHAN KANTOR PARAKAN', 'Bachelor/S1', 'Hukum', '16295-30843-1-PB.pdf', '2025-03-08 23:34:40', '2025-03-08 23:34:40'),
(230, 'Uky Prihaning Hapsari', 'Temanggung', '1999-09-12', 'Cekelan RT:02/RW:04 Madureso Temanggung', 'Cekelan RT:02/RW:04 Madureso Temanggung', 'Perempuan', 'ukyhapsari34@gmail.com', '081325375418', '081325375418', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'SMA/Sederajat', 'IPS', 'Surat Lamaran Kerja_Uky Prihaning H_BPR.pdf', '2025-03-09 15:16:24', '2025-03-09 15:16:24'),
(231, 'NUGROHO AL AMIN', 'KENDAL', '1987-10-29', 'JL. BINTAN UTARA RT 001 RW 001 GEDANGANAK, UNGARAN TIMUR, KABUPATEN SEMARANG', 'PURI DELTA ASRI 5, JL. KEPODANG I BLOK B 34 RT 002 RW 014 LEYANGAN, UNGARAN TIMUR, KABUPATEN SEMARANG', 'Laki-laki', 'nugienugroho33@gmail.com', '081329362954', '081329362954', 'STAF OPERASIONAL KANTOR PUSAT PARAKAN', 'Bachelor/S1', 'MANAJEMEN', 'CV_SURAT LAMARAN NUGROHO 2024 FIX.pdf', '2025-03-12 11:40:05', '2025-03-12 11:40:05'),
(232, 'NUGROHO AL AMIN', 'KENDAL', '1987-10-29', 'JL. BINTAN UTARA RT 001 RW 001 GEDANGANAK, UNGARAN TIMUR, KABUPATEN SEMARANG', 'PURI DELTA ASRI 5, JL. KEPODANG I BLOK B34 RT 002 RW 014 LEYANGAN, UNGARAN TIMUR, KABUPATEN SEMARANG', 'Laki-laki', 'nugienugroho33@gmail.com', '081329362954', '081329362954', 'AUDIT INTERNAL', 'Bachelor/S1', 'MANAJEMEN', 'CV_SURAT LAMARAN NUGROHO 2024 FIX.pdf', '2025-03-24 15:18:06', '2025-03-24 15:18:06'),
(233, 'ARDITHO BUDI ATMAJA', 'SEMARANG', '0005-04-13', 'JAMBE MALANG 289', 'JAMBE MALANG 289', 'Laki-laki', 'ardithoatmaja13@gmail.com', '085945513637', '081779076176', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'tkr', 'cv dito new_compressed.pdf', '2025-04-09 07:54:50', '2025-04-09 07:54:50'),
(234, 'Arif Susanto', 'Demak', '1996-09-17', 'Pendilan RT 004 RW 006 Desa Kalisari Kecamatan Sayung Kabupaten Demak', 'Pendilan RT 004 RW 006 Desa Kalisari Kecamatan Sayung Kabupaten Demak', 'Laki-laki', 'arifsusanto1709@gmail.com', '0895353369237', '0895353369237', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Hukum', 'CV yes.pdf', '2025-04-09 08:56:17', '2025-04-09 08:56:17'),
(235, 'Yuliantifrizi', 'Bandung', '2006-01-12', 'Kampung Babakan mekar RT 03 rw 14 desa langosari kecamatan Pameungpeuk kab Bandung', 'Kampung Babakan mekar RT 03 rw 14 desa langosari kecamatan Pameungpeuk kab Bandung', 'Perempuan', 'yuliyantivrizi@gmail.com', '083180156708', '083180156708', 'ACCOUNT OFFICER/MARKETING KREDIT KC GOMBONG', 'SMA/Sederajat', 'IPS', 'lamar kerja yuliyantivrizi .pdf', '2025-04-09 09:06:22', '2025-04-09 09:06:22'),
(236, 'Aditya Galih Azi Pratama', 'Wonosobo', '1998-07-27', 'Jl lingkar utara madukoro bumireso wonosobo', 'Jl lingkar utara madukoro bumireso wonosobo', 'Laki-laki', 'adityabit08@gmail.com', '082324003745', '082324003745', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Tehnik Informatika', 'Aditya Galih_Account officer kusuma sumbing wonosobo.pdf', '2025-04-10 07:38:34', '2025-04-10 07:38:34'),
(237, 'Siska Kurniani', 'Temanggung', '2001-11-12', 'Dusun Gandikan RT 2 RW 1, Bojong, Tretep, Temanggung', 'Dusun Gandikan RT 2 RW 1, Bojong, Tretep, Temanggung', 'Perempuan', 'siskakurnia617@gmail.com', '085869633671', '085869633671', 'AUDIT INTERNAL', 'Bachelor/S1', 'Akuntansi', 'Siska Kurniani_CV dan Dokumen Pendukung.pdf', '2025-04-11 11:21:28', '2025-04-11 11:21:28'),
(238, 'Ajeng Giri Febriana', 'Indramayu', '2000-02-18', 'Jl. Bali Mintaragen Kec. Tegal Timur Kota Tegal', 'Jl. Bali Mintaragen Kec. Tegal Timur Kota Tegal', 'Perempuan', 'ajenggiri1823@gmail.com', '0882007053990', '0882008204877', 'KASI KOMERSIAL CABANG TEMANGGUNG', 'SMA/Sederajat', 'Multimedia', 'PT. BPR Kusuma Sumbing.pdf', '2025-04-11 18:50:14', '2025-04-11 18:50:14'),
(239, 'Ardian Danu Saputra', 'Kabupaten Semarang', '2002-05-02', 'Dusun Krajan RT 3 RW 1 Desa Barukan Kecamatan Tengaran Kabupaten Semarang', 'Dusun Krajan RT 3 RW 1 Desa Barukan Kecamatan Tengaran Kabupaten Semarang', 'Laki-laki', 'ardiansaputra020502@gmail.com', '0859159927221', '0859159927221', 'AUDIT INTERNAL', 'Bachelor/S1', 'Akuntansi', 'Ardian Danu Saputra_Berkas Lamaran BPR Kusuma Sumbing.pdf', '2025-04-12 09:31:59', '2025-04-12 09:31:59'),
(240, 'Iwan setiadi', 'Klaten', '1977-02-07', 'Grogol gatak RT 05 RW 05 \r\nDelanggu', 'Grogol gatak RT 05 RW 05 \r\nDelanggu', 'Laki-laki', 'iwangatak99@gmail.com', '085647080924', '085647080924', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Administrasi', 'IMG_20250413_132825-digabungkan.pdf', '2025-04-13 13:42:50', '2025-04-13 13:42:50'),
(241, 'Iwan setiadi', 'Klaten', '1977-02-07', 'Grogol gatak RT 05 RW 05 \r\nDelanggu', 'Grogol gatak RT 05 RW 05 \r\nDelanggu', 'Laki-laki', 'iwangatak99@gmail.com', '085647080924', '085647080924', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Administrasi', 'IMG_20250413_132825-digabungkan.pdf', '2025-04-13 13:45:34', '2025-04-13 13:45:34'),
(242, 'Iwan setiadi', 'Klaten', '1977-02-07', 'Grogol gatak RT 05 RW 05 \r\nDelanggu', 'Grogol gatak RT 05 RW 05 \r\nDelanggu', 'Laki-laki', 'iwangatak99@gmail.com', '085647080924', '085647080924', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Administrasi', 'IMG_20250413_132825-digabungkan.pdf', '2025-04-13 13:49:04', '2025-04-13 13:49:04'),
(243, 'Tania Ayudya Putri', 'Kendal', '2000-08-24', 'Ds.  Penaruban,  Rt 02/ Rw 06. Kec.  Weleri , Kab. Kendal', 'Perumahan Taman Sakura Jenarsari - Kendal', 'Perempuan', 'taniaayudyaputri876@gmail.com', '081239548024', '081239548024', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'IPS', 'BERKAS TANIA.pdf', '2025-04-16 12:10:17', '2025-04-16 12:10:17'),
(244, 'Riko Fernanda', 'Purbalingga', '1997-12-04', 'Bojanegara RT 6 RW 2, Kec. Padamara, Kab. Purbalingga', 'Bojanegara RT 6 RW 2, Kec. Padamara, Kab. Purbalingga', 'Laki-laki', 'rikofernanda89@gmail.com', '085173041217', '085173041217', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Ekonomi Syariah', 'Surat lamaran kerja Riko Fernanda.pdf', '2025-04-18 09:57:58', '2025-04-18 09:57:58'),
(245, 'Rikotal Top\'i', 'Kendal', '2001-01-06', 'Karangsari rt3 rw4 Kendal Jawa Tengah', 'Karangsari rt3 rw4 Kendal Jawa Tengah', 'Laki-laki', 'rikotopi664@gmail.com', '08990834930', '08990834930', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Akuntansi Syariah', 'Rikotal Top\'i (Kusuma Sumbing).pdf', '2025-04-22 00:41:56', '2025-04-22 00:41:56'),
(246, 'Farid Muhamad Faza', 'Temanggung', '2001-12-06', 'Seneng Pateken Wonoboyo Temanggung', 'Seneng Pateken Wonoboyo Temanggung', 'Laki-laki', 'faridmuhamadfaza@gmail.com', '088227605074', '088227605074', 'AUDIT INTERNAL', 'Bachelor/S1', 'Hukum', 'FARID MUHAMAD FAZA cv.pdf', '2025-04-22 13:12:18', '2025-04-22 13:12:18'),
(247, 'Siti Istiqomah', 'Kendal', '1993-11-08', 'Dsn Doplang 1 Pakis Bringin Kabupaten Semarang', 'Ds Banyutowo Kendal', 'Perempuan', 'istiqositi773@gmail.com', '08980245983', '08980245983', 'AUDIT INTERNAL', 'Bachelor/S1', 'Bahasa Inggris', 'cv kokom 2024.pdf', '2025-04-24 13:42:41', '2025-04-24 13:42:41'),
(248, 'Farid Muhamad Faza', 'Temanggung', '2001-12-06', 'Seneng Pateken Wonoboyo Temanggung', 'Seneng Pateken Wonoboyo Temanggung', 'Laki-laki', 'faridmuhamadfaza@gmail.com', '088227605074', '088227605074', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Hukum', 'FARID MUHAMAD FAZA cv.pdf', '2025-04-28 13:18:44', '2025-04-28 13:18:44'),
(249, 'Mutiara Aninda Hilmi', 'Pati', '2000-08-13', 'Dk Ndokeso 008/001 Ds Sidokerto Kec Pati Kab Pati Prov Jawa Tengah', 'Dk Ndokeso 008/001 Ds Sidokerto Kec Pati Kab Pati Prov Jawa Tengah', 'Perempuan', 'mutiarahilmi@gmail.com', '085729808221', '085729808221', 'ACCOUNT OFFICER/MARKETING KREDIT KC GOMBONG', 'Bachelor/S1', 'Ilmu Hukum', 'BERKAS MUTIARA ANINDA HILMI_compressed.pdf', '2025-04-30 23:47:28', '2025-04-30 23:47:28'),
(250, 'Prahoro Badai Mutiara', 'Tegal', '1976-01-07', 'Puri Utara 1 A No.40 Pekalongan', 'Puri Utara 1 A No.40 Pekalongan', 'Laki-laki', 'badaimutiara989@gmail.com', '081901293088', '081901293088', 'AUDIT INTERNAL', 'D3', 'Manjemen', 'CV_Badai Mutiara.pdf', '2025-05-03 09:17:50', '2025-05-03 09:17:50'),
(251, 'PANDU PANANDITO', 'KEBUMEN', '1995-10-02', 'Karanggayam Rt 001 rw 002 karanggayam, kebumen', 'Karanggayam Rt 001 Rw 002 Karanggayam, kebumen', 'Laki-laki', 'pandupanandito@gmail.com', '082236715413', '082236715413', 'ACCOUNT OFFICER/MARKETING KREDIT KC GOMBONG', 'Bachelor/S1', 'Ekonomi', 'BPR KSB (1).pdf', '2025-05-05 10:44:42', '2025-05-05 10:44:42'),
(252, 'Yuda Adestian', 'Kendal', '1992-12-27', 'Jl Soekarno Hatta 330 Kendal', 'Jl Soekarno Hatta 330 Kendal', 'Laki-laki', 'yudaadestian@gmail.com', '085727233414', '085727233414', 'AUDIT INTERNAL', 'Master/S2', 'Manajemen', 'All Certificate ( CV ijazah transkip ktp).pdf', '2025-05-06 20:26:04', '2025-05-06 20:26:04'),
(253, 'Lilis Supriatin', 'Pemalang', '2002-07-04', 'Desa Nyamplungsari RT 05 RW 03, Kec. Petarukan, Kab. Pemalang', 'Perumahan Graha Asri Blok H No 1, Cangkring Rejosari, Kec. Brangsong, Kab. Kendal', 'Perempuan', 'lilissupriatin472@gmail.com', '085603422904', '085603422904', 'Account Officer Kredit (Marketing)', 'Bachelor/S1', 'Manajemen', 'SURAT LAMARAN KERJA_LILIS SUPRIATIN_PT BANK PEREKONOMIAN RAKYAT.pdf', '2025-05-08 13:00:33', '2025-05-08 13:00:33'),
(254, 'Arnol Saputro', 'Jakarta', '1987-09-27', 'Jl. Tambora Selatan No.54 Mojosongo, Jebres, Surakarta.', 'Jl. Tambora Selatan No.54 Mojosongo, Jebres, Surakarta.', 'Laki-laki', 'yosafatsaputra@gmail.com', '081802547009', '081802547009', 'AUDIT INTERNAL', 'Bachelor/S1', 'Manajemen Bisnis', 'CV_Lengkap.pdf', '2025-05-09 14:53:10', '2025-05-09 14:53:10'),
(255, 'NUGROHO AL AMIN', 'KENDAL', '1987-10-29', 'JL. BINTAN UTARA RT 001 RW 001 GEDANGANAK, UNGARAN TIMUR, KAB. SEMARANG', 'PURI DELTA ASRI 5, JL. KEPODANG I BLOK B34 RT 002 RW 014 LEYANGAN, UNGARAN TIMUR, KAB. SEMARANG', 'Laki-laki', 'nugienugroho33@gmail.com', '081329362954', '081329362954', 'AUDIT INTERNAL', 'Bachelor/S1', 'MANAJEMEN', 'CV_SURAT LAMARAN NUGROHO 2024 FIX.pdf', '2025-05-14 13:57:15', '2025-05-14 13:57:15'),
(256, 'RUDI MISYANTO', 'KENDAL', '1994-11-24', 'CURUGSEWU 02/08 KECAMATAN PATEAN, KABUPATEN KENDAL', 'CURUGSEWU 02/08 KECAMATAN PATEAN, KABUPATEN KENDAL', 'Laki-laki', 'rudimisya@gmail.com', '083842594124', '083842594124', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'MULTIMEDIA', 'CV Rudi Misyanto.pdf', '2025-05-14 14:32:37', '2025-05-14 14:32:37'),
(257, 'Kuwat Nugroho', 'Wonogiri', '1989-11-21', 'Jl. Gayamsari Selatan RT 03/RW 03 Sendangguwo Tembalang Semarang', 'Jl. Gayamsari Selatan RT 03/RW 03 Sendangguwo Tembalang Semarang', 'Laki-laki', 'baihaqinugroho10@gmail.com', '08988730001', '08988730001', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'Mekanik Otomotif', 'Lamaran BPR Kusuma Sumbing .pdf', '2025-05-14 21:19:12', '2025-05-14 21:19:12'),
(258, 'Ririn Dwi Saputri', 'Kab. Semarang', '1997-08-25', 'Jl. Surowijoyo II pengilon RT 03 RW 013 Salatiga', 'Salatiga', 'Perempuan', 'ririnsaputri433@gmail.com', '085600420898', '085600420898', 'AUDIT INTERNAL', 'SMA/Sederajat', 'Akuntansi', 'CamScanner 17-04-2025 13.16_3.pdf', '2025-05-18 15:37:28', '2025-05-18 15:37:28'),
(259, 'Dzafin khoerurrozi', 'wonosobo', '1993-04-17', 'tegalsari rt/rw 01/01 garung wonosobo', 'tegalsari rt/rw 01/02 garung wonosobo', 'Laki-laki', 'dzafin1212@gmaip.com', '081232113427', '081232113427', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'ips', 'Dipindai_20250519-0603.pdf', '2025-05-19 06:22:56', '2025-05-19 06:22:56'),
(260, 'Risa Miftahul Latif', 'Jepara', '2000-02-27', 'Dukuh Sekoplok RT. 14 RW. 05 Desa Kaligarang Kec. Keling Kab. Jepara 59454', 'Dukuh Sekoplok RT. 14 RW. 05 Desa Kaligarang Kec. Keling Kab. Jepara 59454', 'Laki-laki', 'risamiftahull@gmail.com', '085879293073', '085879293073', 'Account Officer Kredit (Marketing)', 'SMA/Sederajat', 'IPA', 'Surat Lamaran Pekerjaan.pdf', '2025-05-21 07:50:43', '2025-05-21 07:50:43'),
(261, 'Sosiawan bangkit samodro', 'Magelang', '1989-04-06', 'Jalan uripsomoharjo 410 a rt 6 rw5 kelurahan wates kota magelang', 'Tembarak kidul kab temanggung', 'Laki-laki', 'sosiawanbangkit@gmail.com', '087812569975', '087812569975', 'REMEDIAL/PENAGIHAN KANTOR PARAKAN', 'Bachelor/S1', 'Ekonomi', 'remidial kusuma sumbing tgl 28.pdf', '2025-05-28 10:03:24', '2025-05-28 10:03:24'),
(262, 'Arina Manasikana Arafah', 'Semarang', '1999-03-26', 'Kembangarum RT 003 RW 002 Desa Kembangarum, Kec. Mranggen, Kab. Demak', 'Kembangarum RT 003 RW 002 Desa Kembangarum, Kec. Mranggen, Kab. Demak', 'Perempuan', 'arinamanasikanaarafah@gmail.com', '0895327894978', '0895327894978', 'AUDIT INTERNAL', 'Bachelor/S1', 'Ilmu Hukum', 'Resume PT BPR Kusuma Sumbing Arina.pdf', '2025-05-28 19:37:46', '2025-05-28 19:37:46'),
(263, 'ENIS TRIYANA', 'CILACAP', '1999-09-26', 'JL. JONGKENG RT 01 RW 05 PANISIHAN MAOS CILACAP', 'TEMBALANG, SEMARANG', 'Perempuan', 'enistriyana008@gmail.com', '083844339207', '083844339207', 'Analis Kredit', 'Bachelor/S1', 'STATISTIKA', 'CV Enis Triyana.pdf', '2025-06-04 11:15:52', '2025-06-04 11:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjadwalan`
--

CREATE TABLE `tb_penjadwalan` (
  `id_penjadwalan` int(10) NOT NULL,
  `id_pelamar` int(10) DEFAULT NULL,
  `id_loker` int(10) DEFAULT NULL,
  `tgl_test` date DEFAULT NULL,
  `jam` varchar(10) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `pic_telp` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `level`, `password`, `email_verified_at`, `remember_token`, `gambar`, `created_at`, `updated_at`) VALUES
(30, 'Abdul Taufiq', 'abdul.taufiq1712@gmail.com', 'Admin TSI', '$2y$10$8w.G1mwzNL0i/2H7j1tseOvEsw80YQsFJHuHPZnk5EpBoj6etrEFm', NULL, NULL, NULL, '2023-02-02 07:05:00', '2023-02-08 08:56:30'),
(31, 'Yogi Prastiyanta', 'ksbpusat.tsi@gmail.com', 'Admin TSI', '$2y$10$YmX90zpT4Zeykrs/kuJppeGkOhTPNkUY5XIOXSEPpGiu0x3EJxcU6', '2023-02-09 01:26:54', NULL, NULL, '2023-02-09 01:23:10', '2023-02-09 01:33:48'),
(33, 'Diah Hapsari', 'ksbpusat.personalia@gmail.com', 'Admin SDM', '$2y$10$U087gIVxKlAkdGLzdK4UVeFgriA/qs3O4jDKkKsHj8dat7gKz4FZe', NULL, NULL, NULL, '2023-02-09 02:46:53', '2023-11-15 07:58:00'),
(34, 'Prastiyani', 'ksbpusat.sdm@gmail.com', 'Admin SDM', '$2y$10$pgYGkHKNxD1wJSfVZlRETeFVER/M1Uzl3JrrmHxadZrjC/sDxSh/.', NULL, NULL, NULL, '2023-02-09 02:48:25', '2023-02-09 02:48:25'),
(35, 'Renard Fabian A', 'sikarir@gmail.com', 'Admin TSI', '$2a$10$nC3EKfkMGuMbQqZ3SINUPuX/b/MwRduiuEONRTfVjrarXgbddTJCK', NULL, NULL, NULL, '2025-04-15 10:10:19', '2025-04-15 10:10:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_quiz`
--
ALTER TABLE `access_quiz`
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
-- Indexes for table `permission_access_tokens`
--
ALTER TABLE `permission_access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_loker`
--
ALTER TABLE `tb_loker`
  ADD PRIMARY KEY (`id_loker`);

--
-- Indexes for table `tb_pelamar`
--
ALTER TABLE `tb_pelamar`
  ADD PRIMARY KEY (`id_pelamar`);

--
-- Indexes for table `tb_penjadwalan`
--
ALTER TABLE `tb_penjadwalan`
  ADD PRIMARY KEY (`id_penjadwalan`),
  ADD KEY `id_pelamar` (`id_pelamar`),
  ADD KEY `id_loker` (`id_loker`);

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
-- AUTO_INCREMENT for table `access_quiz`
--
ALTER TABLE `access_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permission_access_tokens`
--
ALTER TABLE `permission_access_tokens`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_loker`
--
ALTER TABLE `tb_loker`
  MODIFY `id_loker` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tb_pelamar`
--
ALTER TABLE `tb_pelamar`
  MODIFY `id_pelamar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `tb_penjadwalan`
--
ALTER TABLE `tb_penjadwalan`
  MODIFY `id_penjadwalan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_penjadwalan`
--
ALTER TABLE `tb_penjadwalan`
  ADD CONSTRAINT `tb_penjadwalan_ibfk_1` FOREIGN KEY (`id_pelamar`) REFERENCES `tb_pelamar` (`id_pelamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_penjadwalan_ibfk_2` FOREIGN KEY (`id_loker`) REFERENCES `tb_loker` (`id_loker`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
