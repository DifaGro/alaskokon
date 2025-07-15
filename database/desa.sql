-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 05:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desa`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `judul_agenda` varchar(1024) DEFAULT NULL,
  `deskripsi_agenda` text DEFAULT NULL,
  `lokasi_agenda` varchar(1024) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `penanggung_jawab` varchar(1024) DEFAULT NULL,
  `warna` varchar(1024) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `id_desa`, `judul_agenda`, `deskripsi_agenda`, `lokasi_agenda`, `tanggal_mulai`, `tanggal_selesai`, `penanggung_jawab`, `warna`, `jam_mulai`) VALUES
(1, 1, 'Musyawarah Desa', 'Membahas:\r\n- Keamanan\r\n- Kebersihan', 'Balai Desa', '2025-07-08', NULL, 'Kepala Desa', '#198754', '18:00:00'),
(2, 1, 'Bakti Sosial', 'Pengobatan Gratis', 'Lapangan Desa', '2025-07-15', '2025-07-19', 'Ibu Bidan & Tim Karang Taruna', '#dc3545', '08:00:00'),
(3, 1, 'Lomba Kebersihan RT', 'Penilaian Kebersihan lingkungan antar RT', 'Seluruh Wilayah Desa', '2025-07-30', '2025-08-15', 'PKK & Ketua RT', '#0d6efd', '09:00:00'),
(4, 1, 'Pelatihan UMKM', 'Pelatihan pemasaran digital untuk UMKM desa', 'Balai Desa', '2025-07-20', NULL, 'Dinas Koperasi', '#FFC0CB', '13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `anggota_lembaga`
--

CREATE TABLE `anggota_lembaga` (
  `id_anggota_lembaga` int(11) NOT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `kontak` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota_lembaga`
--

INSERT INTO `anggota_lembaga` (`id_anggota_lembaga`, `id_lembaga`, `nama`, `jabatan`, `kontak`) VALUES
(1, 1, 'Ahmad Santoso', 'Ketua', '081234567890'),
(2, 2, 'Budi Hartono', 'Ketua', '082345678901'),
(3, 3, 'Citra Lestari', 'Ketua', '083456789012'),
(4, 4, 'Dedi Pratama', 'Ketua', '084567890123'),
(5, 1, 'Budi Santoso', 'Wakil Ketua', '081234567891'),
(6, 1, 'Siti Aminah', 'Sekretaris', '081234567892'),
(7, 1, 'Joko Widodo', 'Bendahara', '081234567893'),
(8, 2, 'Dewi Lestari', 'Wakil Ketua', '081234567894'),
(9, 2, 'Rahmat Hidayat', 'Sekretaris', '081234567895'),
(10, 2, 'Putri Andini', 'Bendahara', '081234567896'),
(11, 3, 'Hendra Gunawan', 'Wakil Ketua', '081234567897'),
(12, 3, 'Sari Melati', 'Sekretaris', '081234567898'),
(13, 3, 'Agus Salim', 'Anggota', '081234567899'),
(14, 4, 'Farah Diba', 'Wakil Ketua', '081234567800'),
(15, 4, 'Ridwan Kamil', 'Sekretaris', '081234567801'),
(16, 4, 'Lilis Suryani', 'Bendahara', '081234567802');

-- --------------------------------------------------------

--
-- Table structure for table `apbdes`
--

CREATE TABLE `apbdes` (
  `id_apbdes` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `tahun` year(4) NOT NULL,
  `jenis` enum('pendapatan','belanja','pembiayaan') NOT NULL,
  `anggaran` decimal(15,2) NOT NULL,
  `realisasi` decimal(15,2) DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `warna` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apbdes`
--

INSERT INTO `apbdes` (`id_apbdes`, `id_desa`, `tahun`, `jenis`, `anggaran`, `realisasi`, `keterangan`, `warna`) VALUES
(1, NULL, '2025', 'pendapatan', 2500000.00, 2000000.00, 'PAD', '#FF6384'),
(2, NULL, '2025', 'pendapatan', 1161215000.00, 1100000000.00, 'DD', '#36A2EB'),
(3, NULL, '2025', 'pendapatan', 52650000.00, 50000000.00, 'BHPR', '#FFCE56'),
(4, NULL, '2025', 'pendapatan', 444484000.00, 420000000.00, 'ADD', '#4BC0C0'),
(5, NULL, '2025', 'pendapatan', 575246.78, 500000.00, 'Lain-lain', '#9966FF'),
(6, NULL, '2025', 'belanja', 536965800.00, 500000000.00, 'Bidang Penyelenggaraan Pemerintah Desa', '#FF6384'),
(7, NULL, '2025', 'belanja', 1003740200.00, 900000000.00, 'Bidang Pelaksanaan Pembangunan Desa', '#36A2EB'),
(8, NULL, '2025', 'belanja', 43675246.78, 40000000.00, 'Bidang Pembinaan Kemasyarakatan Desa', '#FFCE56'),
(9, NULL, '2025', 'belanja', 30000000.00, 25000000.00, 'Bidang Pemberdayaan Masyarakat Desa', '#4BC0C0'),
(10, NULL, '2025', 'belanja', 126000000.00, 110000000.00, 'Bidang Penanggulangan Bencana', '#9966FF'),
(11, NULL, '2025', 'pembiayaan', 311200000.00, 300000000.00, 'Penerimaan Pembiayaan', '#36A2EB'),
(12, NULL, '2025', 'pembiayaan', 232243000.00, 200000000.00, 'Pengeluaran Pembiayaan', '#FF6384');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `judul_berita` varchar(1024) DEFAULT NULL,
  `tanggal_artikel` date DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `link` varchar(1024) DEFAULT NULL,
  `paragraf` text DEFAULT NULL,
  `jenis` enum('Berita','Pengumuman','Hasil Agenda') DEFAULT NULL,
  `author` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `id_desa`, `judul_berita`, `tanggal_artikel`, `views`, `link`, `paragraf`, `jenis`, `author`) VALUES
(1, 1, 'Desa Alas kokon Jadi Fokus Pembinaan Program Desa Cantik Tahun 2025', '2025-05-26', 5, 'https://katamadura.com/desa-alas-kokon-jadi-fokus-pembinaan-program-desa-cantik-tahun-2025/', 'Desa Alas kokon, Kecamatan Modung, Kabupaten Bangkalan, terpilih sebagai desa binaan dalam Program Desa Cantik (Desa Cinta Statistik) oleh Badan Pusat Statistik (BPS) Kabupaten Bangkalan tahun 2025.\r\n\r\nPemilihan ini didasarkan pada inisiatif proaktif dari pemerintah desa dalam menyambut pencanangan 100% Desa Cantik yang dilakukan pada 9 Oktober 2024 lalu.\r\n\r\nProgram Desa Cantik merupakan upaya BPS dalam meningkatkan literasi statistik di tingkat desa serta membangun sistem data yang kredibel dan berkualitas.\r\n\r\nMenurut Statistisi Terampil BPS Bangkalan, Alfin Niam Habibi, sejak diluncurkan pada tahun 2022 hingga 2024, program ini telah membina delapan desa secara intensif.\r\n\r\nUntuk tahun 2025, fokus pembinaan dipusatkan pada satu desa, yaitu Alaskokon, karena keseriusannya dalam menindaklanjuti program tersebut.', 'Berita', 'Petugas Desa'),
(2, 1, 'Musyawarah Desa Tahunan', '2024-09-17', 2, '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n', 'Hasil Agenda', 'Petugas Desa'),
(3, 1, 'Pengumuman Sehubungan Hari Libur Nasional & Cuti Bersama', '2025-01-25', 1, NULL, NULL, 'Pengumuman', 'Petugas Desa'),
(4, 1, 'PEMDes Alaskokon Gelar MUSDESUS Untuk Pembentukan Koperasi Merah Putih Alaskokon', '2025-05-25', 3, 'https://www.kompasiana.com/syaifulanam3203/6833148eed64155fb10304a2/pemdes-alaskokon-gelar-musdesus-untuk-pembentukan-koperasi-merah-putih-alaskokon', 'Pemerintah Desa Alaskokon kembali menunjukkan komitmennya dalam meningkatkan kesejahteraan masyarakat desa melalui penguatan ekonomi lokal. Pada hari Minggu 25/05/2025 bertempat di Balai Desa Alaskokon, digelar Musyawarah Desa Khusus (MUSDESUS) dengan agenda utama pembentukan Koperasi Merah Putih Alaskokon.\r\n\r\nAcara tersebut dihadiri oleh berbagai unsur masyarakat, jajaran MUSPIKA Modung, perangkat desa, BPD, tokoh masyarakat, tokoh pemuda, perwakilan UMKM, serta pendamping desa dan kecamatan. Suasana musyawarah berlangsung hangat dan partisipatif, mencerminkan semangat gotong royong dan tekad bersama dalam membangun kemandirian ekonomi desa.', 'Berita', 'Petugas Desa'),
(5, 1, 'Judul Berita 1', '2024-07-01', 10, 'https://link1.com', 'Paragraf berita 1', 'Berita', 'Admin'),
(6, 1, 'Judul Berita 2', '2024-07-02', 20, 'https://link2.com', 'Paragraf berita 2', 'Pengumuman', 'Admin'),
(7, 1, 'Judul Berita 3', '2024-07-03', 30, 'https://link3.com', 'Paragraf berita 3', 'Hasil Agenda', 'Admin'),
(8, 1, 'Judul Berita 4', '2024-07-04', 40, 'https://link4.com', 'Paragraf berita 4', 'Berita', 'Admin'),
(9, 1, 'Judul Berita 5', '2024-07-05', 50, 'https://link5.com', 'Paragraf berita 5', 'Pengumuman', 'Admin'),
(10, 1, 'Judul Berita 6', '2024-07-06', 60, 'https://link6.com', 'Paragraf berita 6', 'Hasil Agenda', 'Admin'),
(11, 1, 'Judul Berita 7', '2024-07-07', 70, 'https://link7.com', 'Paragraf berita 7', 'Berita', 'Admin'),
(12, 1, 'Judul Berita 8', '2024-07-08', 80, 'https://link8.com', 'Paragraf berita 8', 'Pengumuman', 'Admin'),
(13, 1, 'Judul Berita 9', '2024-07-09', 90, 'https://link9.com', 'Paragraf berita 9', 'Hasil Agenda', 'Admin'),
(14, 1, 'Judul Berita 10', '2024-07-10', 100, 'https://link10.com', 'Paragraf berita 10', 'Berita', 'Admin'),
(15, 1, 'Judul Berita 11', '2024-07-11', 110, 'https://link11.com', 'Paragraf berita 11', 'Pengumuman', 'Admin'),
(16, 1, 'Judul Berita 12', '2024-07-12', 120, 'https://link12.com', 'Paragraf berita 12', 'Hasil Agenda', 'Admin'),
(17, 1, 'Judul Berita 13', '2024-07-13', 130, 'https://link13.com', 'Paragraf berita 13', 'Berita', 'Admin'),
(18, 1, 'Judul Berita 14', '2024-07-14', 140, 'https://link14.com', 'Paragraf berita 14', 'Pengumuman', 'Admin'),
(19, 1, 'Judul Berita 15', '2024-07-15', 152, 'https://link15.com', 'Paragraf berita 15', 'Hasil Agenda', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE `desa` (
  `id_desa` int(11) NOT NULL,
  `nama_desa` varchar(1024) DEFAULT NULL,
  `kecamatan` varchar(1024) DEFAULT NULL,
  `kabupaten` varchar(1024) DEFAULT NULL,
  `provinsi` varchar(1024) DEFAULT NULL,
  `luas_wilayah` float DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `visi` varchar(1024) DEFAULT NULL,
  `foto_struktur` varchar(1024) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `sejarah` text DEFAULT NULL,
  `geojson_batasdesa` varchar(1024) DEFAULT NULL,
  `geojson_batasdusun` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`id_desa`, `nama_desa`, `kecamatan`, `kabupaten`, `provinsi`, `luas_wilayah`, `email`, `no_hp`, `visi`, `foto_struktur`, `latitude`, `longitude`, `sejarah`, `geojson_batasdesa`, `geojson_batasdusun`) VALUES
(1, 'Alas Kokon', 'Modung', 'Bangkalan', 'Jawa Timur', 70.7, 'alaskokon@gmail.com', '08787878', 'Terwujudnya Desa Alas Kokon yang Mandiri, Maju, dan Sejahtera Berbasis Kearifan Lokal dan Gotong Royong.', 'strukturdesa.png', -7.1235429, 112.9174911, '', 'Batas Desa Alas Kokon.geojson', 'Batas Dusun Alaskokon.geojson');

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `nama_dokumen` varchar(1024) DEFAULT NULL,
  `dokumen` varchar(1024) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `tipe` enum('Laporan','Produk Hukum') NOT NULL DEFAULT 'Laporan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id_dokumen`, `id_desa`, `nama_dokumen`, `dokumen`, `tanggal`, `tahun`, `tipe`) VALUES
(1, 1, 'Laporan Tes Tes', '22-149_Surya Eka Santoso_Jarkom2Demo3.pdf', '2025-07-02', '2025', 'Laporan'),
(2, 1, 'tes laporan gambar', 'ChatGPT Image 4 Mei 2025, 23.16.25.png', '2024-07-02', '2024', 'Laporan'),
(3, 1, 'tes dokumen docx', 'Kelompok 7 Kecerdasan Bisnis (revisiBOSSS).docx', NULL, '2024', 'Produk Hukum'),
(4, 1, 'Tes Produk Hukum PDF', '560-Article Text-2948-2-10-20250505.pdf', '2025-07-08', '2025', 'Produk Hukum');

--
-- Triggers `dokumen`
--
DELIMITER $$
CREATE TRIGGER `set_tanggal_tahun_otomatis` BEFORE INSERT ON `dokumen` FOR EACH ROW BEGIN
    -- Jika tanggal tidak diisi, isi dengan tanggal hari ini
    IF NEW.tanggal IS NULL THEN
        SET NEW.tanggal = CURRENT_DATE;
    END IF;

    -- Jika tahun tidak diisi, ambil dari tanggal
    IF NEW.tahun IS NULL THEN
        SET NEW.tahun = YEAR(NEW.tanggal);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `fasilitas` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `id_desa`, `fasilitas`) VALUES
(1, 1, 'Balai Desa'),
(2, 1, 'Posyandu'),
(3, 1, 'Sekolah Dasar'),
(4, 1, 'PAUD'),
(5, 1, 'Masjid'),
(6, 1, 'Lapangan Serba Guna');

-- --------------------------------------------------------

--
-- Table structure for table `gambar_artikel`
--

CREATE TABLE `gambar_artikel` (
  `id_gambar_artikel` int(11) NOT NULL,
  `id_artikel` int(11) DEFAULT NULL,
  `gambar` varchar(1024) DEFAULT NULL,
  `alt` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gambar_artikel`
--

INSERT INTO `gambar_artikel` (`id_gambar_artikel`, `id_artikel`, `gambar`, `alt`) VALUES
(1, 1, 'artikel.webp', 'Desa Alas kokon Jadi Fokus Pembinaan Program Desa Cantik Tahun 2025'),
(2, 2, 'carousel-1.jpg', 'Musyawarah Desa Tahunan'),
(3, 2, 'carousel-2.jpg', 'Musyawarah Desa Tahunan'),
(4, 3, 'pengumuman.png', 'Pengumuman'),
(5, 4, 'berita-1.jpg', 'berita-1'),
(6, 4, 'berita-2.jpg', 'berita-2'),
(7, 4, 'berita-3.jpg', 'berita-3'),
(8, 5, 'berita0.jpg', 'Gambar Judul Berita 1'),
(9, 6, 'berita0.jpg', 'Gambar Judul Berita 2'),
(10, 7, 'berita0.jpg', 'Gambar Judul Berita 3'),
(11, 8, 'berita0.jpg', 'Gambar Judul Berita 4'),
(12, 9, 'berita0.jpg', 'Gambar Judul Berita 5'),
(13, 10, 'berita0.jpg', 'Gambar Judul Berita 6'),
(14, 11, 'berita0.jpg', 'Gambar Judul Berita 7'),
(15, 12, 'berita0.jpg', 'Gambar Judul Berita 8'),
(16, 13, 'berita0.jpg', 'Gambar Judul Berita 9'),
(17, 14, 'berita0.jpg', 'Gambar Judul Berita 10'),
(18, 15, 'berita0.jpg', 'Gambar Judul Berita 11'),
(19, 16, 'berita0.jpg', 'Gambar Judul Berita 12'),
(20, 17, 'berita0.jpg', 'Gambar Judul Berita 13'),
(21, 18, 'berita0.jpg', 'Gambar Judul Berita 14'),
(22, 19, 'berita0.jpg', 'Gambar Judul Berita 15');

-- --------------------------------------------------------

--
-- Table structure for table `info_berjalan`
--

CREATE TABLE `info_berjalan` (
  `id_info` int(11) NOT NULL,
  `emoji` varchar(10) DEFAULT '',
  `isi_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info_berjalan`
--

INSERT INTO `info_berjalan` (`id_info`, `emoji`, `isi_info`) VALUES
(1, '📢', 'Selamat Datang di Website Resmi Desa Alas Kokon!'),
(2, '📆', 'Informasi APBDes 2025 Telah Dipublikasikan'),
(3, '💡', 'Layanan Desa Berbasis Digital Telah Berjalan'),
(4, '📌', 'Simak Berita Terbaru Kami Setiap Hari!');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_lembaga`
--

CREATE TABLE `jenis_lembaga` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(100) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `ikon` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_lembaga`
--

INSERT INTO `jenis_lembaga` (`id_jenis`, `nama_jenis`, `warna`, `ikon`, `keterangan`) VALUES
(1, 'BPD', 'success', 'fas fa-university', 'Badan Permusyawaratan Desa'),
(2, 'LKMD', 'info', 'fas fa-people-carry', 'Lembaga Ketahanan Masyarakat Desa'),
(3, 'PKK', 'warning', 'fas fa-child', 'Pemberdayaan Kesejahteraan Keluarga'),
(4, 'Karang Taruna', 'danger', 'fas fa-user-friends', 'Organisasi kepemudaan desa'),
(5, 'BUMDes', 'primary', 'fas fa-store', 'BUMDes adalah Badan Usaha Milik Desa yang bergerak di bidang usaha ekonomi untuk meningkatkan pendapatan desa.');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_umkm`
--

CREATE TABLE `jenis_umkm` (
  `id_jenis_umkm` int(11) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_umkm`
--

INSERT INTO `jenis_umkm` (`id_jenis_umkm`, `nama_jenis`, `deskripsi`) VALUES
(1, 'Kuliner', 'Usaha makanan & minuman khas desa.'),
(2, 'Kerajinan', 'Usaha kerajinan tangan tradisional.'),
(3, 'Jasa', 'Layanan jasa oleh warga desa.'),
(4, 'Pertanian', 'Produk pertanian dan olahannya.'),
(5, 'BUMDes', 'Badan Usaha Milik Desa untuk pemberdayaan ekonomi.');

-- --------------------------------------------------------

--
-- Table structure for table `lembaga_desa`
--

CREATE TABLE `lembaga_desa` (
  `id_lembaga` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `nama_lembaga` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_dibentuk` date DEFAULT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `id_anggota_lembaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lembaga_desa`
--

INSERT INTO `lembaga_desa` (`id_lembaga`, `id_desa`, `id_jenis`, `nama_lembaga`, `no_hp`, `email`, `alamat`, `deskripsi`, `tanggal_dibentuk`, `status`, `id_anggota_lembaga`) VALUES
(1, 1, 4, 'Karang Taruna Tunas Bangsa', '+6287840600892', 'karangtaruna@alaskokon.desa.id', 'Dusun Krajan RT 01 RW 01', 'Karang Taruna Tunas Bangsa adalah organisasi kepemudaan di Desa Alas Kokon yang berfokus pada kegiatan sosial, olahraga, dan pemberdayaan pemuda.', '2015-05-10', 'Aktif', 1),
(2, 1, 3, 'PKK Desa Alas Kokon', '+6282345678901', 'pkk@alaskokon.desa.id', 'Dusun Timur RT 03 RW 02', 'PKK Desa Alas Kokon bertugas menggerakkan keluarga di desa untuk kesejahteraan melalui 10 program pokok PKK.', '2010-03-15', 'Aktif', 2),
(3, 1, 5, 'BUMDes Maju Bersama', '+6283456789012', 'bumdes@alaskokon.desa.id', 'Dusun Barat RT 02 RW 04', 'BUMDes Maju Bersama bergerak di bidang usaha mikro dan layanan keuangan desa untuk meningkatkan pendapatan desa dan warganya.', '2018-07-20', 'Aktif', 3),
(4, 1, 1, 'Badan Permusyawaratan Desa', '081234567890', 'bpd.desa@example.com', 'Jl. Merdeka No. 1, Desa Contoh', 'BPD berfungsi sebagai lembaga yang mewakili aspirasi masyarakat dan mengawasi jalannya pemerintahan desa.', '2020-01-15', 'Aktif', 4);

-- --------------------------------------------------------

--
-- Table structure for table `log_unduh_dokumen`
--

CREATE TABLE `log_unduh_dokumen` (
  `id_log` int(11) NOT NULL,
  `id_warga` varchar(100) DEFAULT NULL,
  `id_dokumen` int(11) DEFAULT NULL,
  `waktu_unduh` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_unduh_dokumen`
--

INSERT INTO `log_unduh_dokumen` (`id_log`, `id_warga`, `id_dokumen`, `waktu_unduh`) VALUES
(1, 'tofan-10092013-gresik', 2, '2025-07-08 15:19:56'),
(2, 'tofan-10092013-gresik', 1, '2025-07-08 15:20:18'),
(3, 'tofan-10092013-gresik', 1, '2025-07-08 15:22:59'),
(4, 'tofan-10092013-gresik', 1, '2025-07-08 15:23:10'),
(5, 'tofan-10092013-gresik', 1, '2025-07-08 15:23:45'),
(6, 'tofan-10092013-gresik', 2, '2025-07-08 15:24:53'),
(7, 'tofan-10092013-gresik', 1, '2025-07-08 15:27:00'),
(8, 'tofan-10092013-gresik', 2, '2025-07-08 15:27:14'),
(9, 'tofan-10092013-gresik', 3, '2025-07-08 15:34:45'),
(10, 'tofan-10092013-gresik', 4, '2025-07-09 21:19:38'),
(11, 'tofan-10092013-gresik', 2, '2025-07-10 15:57:18'),
(12, 'tofan-10092013-gresik', 2, '2025-07-11 13:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `misi`
--

CREATE TABLE `misi` (
  `id_misi` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `isi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `misi`
--

INSERT INTO `misi` (`id_misi`, `id_desa`, `isi`) VALUES
(1, 1, 'Meningkatkan pelayanan publik yang cepat, tepat, dan transparan demi kesejahteraan masyarakat.'),
(2, 1, 'Mendorong pembangunan infrastruktur desa secara merata dan berkelanjutan.'),
(3, 1, 'Meningkatkan kualitas pendidikan dan kesehatan masyarakat desa.'),
(4, 1, 'Mengembangkan potensi ekonomi lokal, seperti pertanian, peternakan, dan UMKM.');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` varchar(255) NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `level`, `pin`) VALUES
('admin-alaskokon-35.26.16.2011', 'admin', '$2y$10$yDAAwOgJ8esYRpfqIXMRquTPdqsOVKwsXKC9Ndql6iPja0dq580sK'),
('kasikesejahteraan-alaskokon-35.26.16.2011', 'kasikesejahteraan', '$2y$10$/UZBiQKjr2vmiwh87MvgEOvuqtFutdOdCOAkYJLs2YaQgbt3WxeN6'),
('kasipelayanan-alaskokon-35.26.16.2011', 'kasipelayanan', '$2y$10$XwOv5H6HOqD3rfpK.K774OhLBoYcpk0pNesTyNdvrPvWx/uehlHTu'),
('kasipemerintahan-alaskokon-35.26.16.2011', 'kasipemerintahan', '$2y$10$ZVTQ6Us4rlpa4Pm/pL87xegkk.B/Hq1umtKXWEx8YWVihdmpoGch.'),
('kepaladesa-alaskokon-35.26.16.2011', 'kepaladesa', '$2y$10$UhXgY83PjlEvTs0DLKI.h.njkJP/Eeli4RikamLF0UfJRN8U.k0jq'),
('sekretarisdesa-alaskokon-35.26.16.2011', 'sekretarisdesa', '$2y$10$589rACHdpy1VpjNb.G4gzO9SL/BZQEKwge1UoRN0qUyKKh6M3tH9O');

-- --------------------------------------------------------

--
-- Table structure for table `statistik_pengunjung`
--

CREATE TABLE `statistik_pengunjung` (
  `id` int(11) NOT NULL,
  `id_desa` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statistik_pengunjung`
--

INSERT INTO `statistik_pengunjung` (`id`, `id_desa`, `tanggal`, `jumlah`) VALUES
(1, 1, '2025-07-07', 2),
(2, 1, '2025-07-08', 1),
(3, 1, '2025-07-09', 1),
(4, 1, '2025-07-10', 1),
(5, 1, '2025-07-11', 1),
(6, 1, '2025-07-13', 1),
(7, 1, '2025-07-14', 2);

-- --------------------------------------------------------

--
-- Table structure for table `struktur_desa`
--

CREATE TABLE `struktur_desa` (
  `id_struktur_desa` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_warga` varchar(100) DEFAULT NULL,
  `jabatan` varchar(1024) DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `struktur_desa`
--

INSERT INTO `struktur_desa` (`id_struktur_desa`, `id_desa`, `id_warga`, `jabatan`, `level`) VALUES
(1, 1, 'tofan-10092013-gresik', 'Kepala Desa', 1),
(2, 1, 'tofan-10092013-gresik', 'Sekretaris Desa', 2),
(3, 1, 'tofan-10092013-gresik', 'Kasi Pemerintahan', 3),
(4, 1, 'tofan-10092013-gresik', 'Kasi Pemerintahan', 3),
(5, 1, 'tofan-10092013-gresik', 'Kasi Pelayanan', 3),
(6, 1, 'tofan-10092013-gresik', 'Kepala Dusun 1', 5),
(7, 1, 'tofan-10092013-gresik', 'Kepala Dusun 2', 5),
(8, 1, 'tofan-10092013-gresik', 'Kepala Dusun 4', 5),
(9, 1, 'tofan-10092013-gresik', 'Kepala Dusun 3', 5),
(10, 1, 'tofan-10092013-gresik', 'Kaur Perencanaan', 4);

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id_umkm` int(11) NOT NULL,
  `id_desa` int(11) NOT NULL,
  `id_jenis_umkm` int(11) NOT NULL,
  `nama_umkm` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `link_instagram` varchar(255) DEFAULT NULL,
  `link_tiktok` varchar(255) DEFAULT NULL,
  `link_website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `umkm`
--

INSERT INTO `umkm` (`id_umkm`, `id_desa`, `id_jenis_umkm`, `nama_umkm`, `deskripsi`, `foto`, `alamat`, `no_hp`, `link_instagram`, `link_tiktok`, `link_website`) VALUES
(5, 1, 1, 'Sate Madura Pak Joko', 'Kuliner sate madura asli khas desa.', 'sate.jpg', 'Dusun Sumberagung', '+6281234567890', 'https://instagram.com/satemadura', 'https://tiktok.com/@satpakjoko', 'https://id.wikipedia.org/wiki/Sate'),
(6, 1, 2, 'Kerajinan Anyaman Ibu Tini', 'Membuat anyaman bambu & rotan.', 'anyaman.jpg', 'Dusun Krajan', '+6281234567891', NULL, 'https://www.tiktok.com/@bps_statistics?is_from_webapp=1&sender_device=pc', 'https://id.wikipedia.org/wiki/Anyaman'),
(7, 1, 3, 'Jasa Servis Elektronik Mas Budi', 'Layanan perbaikan elektronik desa.', 'servis.jpg', 'Dusun B', '+6281234567892', NULL, NULL, NULL),
(8, 1, 5, 'BUMDes Sumber Makmur', 'Badan Usaha Milik Desa yang mengelola air bersih & wisata.', 'bumdes.jpg', 'Dusun A', '+6281234567893', NULL, NULL, 'https://id.wikipedia.org/wiki/Badan_usaha_milik_desa'),
(9, 1, 1, 'UMKM Sate Ayam', 'Menjual sate ayam bumbu kacang.', 'sate.jpg', 'Jl. Raya No. 1', '081234567890', 'https://instagram.com/sateayam', 'https://tiktok.com/@sateayam', 'https://sateayam.id'),
(10, 1, 2, 'UMKM Batik Desa', 'Pengrajin batik khas daerah.', 'sate.jpg', 'Jl. Batik No. 2', '081234567891', 'https://instagram.com/batikdesa', '', ''),
(11, 1, 1, 'UMKM Sate Kambing', 'Sate kambing bumbu rempah.', 'sate.jpg', 'Jl. Kambing No. 3', '081234567892', '', '', ''),
(12, 1, 3, 'UMKM Anyaman Bambu', 'Kerajinan anyaman bambu.', 'sate.jpg', 'Jl. Bambu No. 4', '', '', '', ''),
(13, 1, 2, 'UMKM Kopi Desa', 'Kopi robusta asli desa.', 'sate.jpg', 'Jl. Kopi No. 5', '081234567893', 'https://instagram.com/kopidesa', '', 'https://kopidesa.id'),
(14, 1, 1, 'UMKM Sate Lilit', 'Sate lilit khas daerah.', 'sate.jpg', 'Jl. Sate No. 6', '081234567894', '', '', ''),
(15, 1, 3, 'UMKM Souvenir Kayu', 'Souvenir dan hiasan kayu.', 'sate.jpg', 'Jl. Kayu No. 7', '', '', '', ''),
(16, 1, 2, 'UMKM Batik Kreatif', 'Desain batik modern.', 'sate.jpg', 'Jl. Batik No. 8', '081234567895', 'https://instagram.com/batikkreatif', '', ''),
(17, 1, 1, 'UMKM Sate Sapi', 'Sate sapi bumbu manis.', 'sate.jpg', 'Jl. Sapi No. 9', '081234567896', '', '', ''),
(18, 1, 3, 'UMKM Meubel Desa', 'Mebel kayu jati desa.', 'sate.jpg', 'Jl. Meubel No. 10', '081234567897', '', '', 'https://meubeldesa.id'),
(19, 1, 1, 'Bakso Pak Edi', 'Bakso sapi legendaris dengan kuah kaldu gurih.', 'sate.jpg', 'Jl. Merpati No. 12', '6281234567890', 'https://instagram.com/bakso_pak_edi', NULL, NULL),
(20, 1, 1, 'Mie Ayam Bu Tinah', 'Mie ayam homemade dengan topping melimpah.', 'sate.jpg', 'Jl. Kenari No. 7', '6281234567891', 'https://instagram.com/mieayam_butinah', NULL, NULL),
(21, 1, 1, 'Soto Madura Haji Slamet', 'Soto Madura khas dengan daging empuk.', 'sate.jpg', 'Jl. Pahlawan No. 5', '6281234567892', 'https://instagram.com/soto_haji_slamet', NULL, NULL),
(22, 1, 1, 'Nasi Goreng Mawar', 'Nasi goreng kampung dengan sambal pedas.', 'sate.jpg', 'Jl. Anggrek No. 9', '6281234567893', 'https://instagram.com/nasigoreng_mawar', NULL, NULL),
(23, 1, 1, 'Ayam Bakar Pak Gendut', 'Ayam bakar rempah khas desa.', 'sate.jpg', 'Jl. Sawo No. 4', '6281234567894', 'https://instagram.com/ayambakar_pakgendut', NULL, NULL),
(24, 1, 1, 'Pecel Lele Mbak Sari', 'Pecel lele sambal bawang favorit.', 'sate.jpg', 'Jl. Melati No. 15', '6281234567895', 'https://instagram.com/pecellele_mbak_sari', NULL, NULL),
(25, 1, 1, 'Rawon Bu Harti', 'Rawon daging khas Jawa Timur.', 'sate.jpg', 'Jl. Dahlia No. 8', '6281234567896', 'https://instagram.com/rawon_bu_harti', NULL, NULL),
(26, 1, 1, 'Warung Sate Pak Broto', 'Sate kambing empuk bumbu kacang.', 'sate.jpg', 'Jl. Flamboyan No. 3', '6281234567897', 'https://instagram.com/sate_pak_broto', NULL, NULL),
(27, 1, 1, 'Gudeg Mbok Yem', 'Gudeg Jogja rasa otentik.', 'sate.jpg', 'Jl. Mangga No. 11', '6281234567898', 'https://instagram.com/gudeg_mbok_yem', NULL, NULL),
(28, 1, 1, 'Rujak Cingur Pak Dul', 'Rujak cingur segar bumbu petis.', 'sate.jpg', 'Jl. Rambutan No. 6', '6281234567899', 'https://instagram.com/rujak_pak_dul', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `id_warga` varchar(100) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `nama_warga` varchar(1024) DEFAULT NULL,
  `kk` varchar(20) DEFAULT NULL,
  `pin` varchar(1024) DEFAULT NULL,
  `tempat_lahir` varchar(1024) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `Agama` varchar(1024) DEFAULT NULL,
  `Alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `foto` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`id_warga`, `id_desa`, `nama_warga`, `kk`, `pin`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `Agama`, `Alamat`, `no_hp`, `foto`) VALUES
('aditya-14021996-sampang', NULL, 'Aditya Nugroho', '1234567890123473', NULL, 'Sampang', '1996-02-14', NULL, NULL, NULL, NULL, NULL),
('agus-01012010-pamekasan', NULL, 'Agus Salim', '1234567890123459', NULL, 'Pamekasan', '2010-01-01', NULL, NULL, NULL, NULL, NULL),
('agus-11111999-sumenep', NULL, 'Agus Wijaya', '1234567890123470', NULL, 'Sumenep', '1999-11-11', NULL, NULL, NULL, NULL, NULL),
('andi-03032008-gresik', NULL, 'Andi Prasetyo', '1234567890123461', NULL, 'Gresik', '2008-03-03', NULL, NULL, NULL, NULL, NULL),
('budi-15052011-sampang', NULL, 'Budi Santoso', '1234567890123458', NULL, 'Sampang', '2011-05-15', NULL, NULL, NULL, NULL, NULL),
('citra-20022007-bangkalan', NULL, 'Citra Dewi', '1234567890123462', NULL, 'Bangkalan', '2007-02-20', NULL, NULL, NULL, NULL, NULL),
('dedek-16041994-sumenep', NULL, 'Dedek Pratama', '1234567890123475', NULL, 'Sumenep', '1994-04-16', NULL, NULL, NULL, NULL, NULL),
('dwi-17122009-sumenep', NULL, 'Dwi Lestari', '1234567890123460', NULL, 'Sumenep', '2009-12-17', NULL, NULL, NULL, NULL, NULL),
('eko-04042006-sampang', NULL, 'Eko Yulianto', '1234567890123463', NULL, 'Sampang', '2006-04-04', NULL, NULL, NULL, NULL, NULL),
('farah-25052005-pamekasan', NULL, 'Farah Diba', '1234567890123464', NULL, 'Pamekasan', '2005-05-25', NULL, NULL, NULL, NULL, NULL),
('hendra-10102000-pamekasan', NULL, 'Hendra Gunawan', '1234567890123469', NULL, 'Pamekasan', '2000-10-10', NULL, NULL, NULL, NULL, NULL),
('lilis-12121998-gresik', NULL, 'Lilis Suryani', '1234567890123471', NULL, 'Gresik', '1998-12-12', NULL, NULL, NULL, NULL, NULL),
('mega-15031995-pamekasan', NULL, 'Mega Sari', '1234567890123474', NULL, 'Pamekasan', '1995-03-15', NULL, NULL, NULL, NULL, NULL),
('putri-07072003-gresik', NULL, 'Putri Andini', '1234567890123466', NULL, 'Gresik', '2003-07-07', NULL, NULL, NULL, NULL, NULL),
('rahmat-06062004-sumenep', NULL, 'Rahmat Hidayat', '1234567890123465', NULL, 'Sumenep', '2004-06-06', NULL, NULL, NULL, NULL, NULL),
('ridwan-08082002-bangkalan', NULL, 'Ridwan Kamil', '1234567890123467', NULL, 'Bangkalan', '2002-08-08', NULL, NULL, NULL, NULL, NULL),
('sari-09092001-sampang', NULL, 'Sari Melati', '1234567890123468', NULL, 'Sampang', '2001-09-09', NULL, NULL, NULL, NULL, NULL),
('siti-23072012-bangkalan', NULL, 'Siti Aminah', '1234567890123457', NULL, 'Bangkalan', '2012-07-23', NULL, NULL, NULL, NULL, NULL),
('tofan-10092013-gresik', 1, 'Tofan Adi Nugroho', NULL, '123456789', 'Gresik', '2013-09-10', NULL, 'Islam', NULL, NULL, 'tofan.jpg'),
('yuni-13011997-bangkalan', NULL, 'Yuni Rahmawati', '1234567890123472', NULL, 'Bangkalan', '1997-01-13', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indexes for table `anggota_lembaga`
--
ALTER TABLE `anggota_lembaga`
  ADD PRIMARY KEY (`id_anggota_lembaga`),
  ADD KEY `id_lembaga` (`id_lembaga`);

--
-- Indexes for table `apbdes`
--
ALTER TABLE `apbdes`
  ADD PRIMARY KEY (`id_apbdes`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indexes for table `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id_desa`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indexes for table `gambar_artikel`
--
ALTER TABLE `gambar_artikel`
  ADD PRIMARY KEY (`id_gambar_artikel`),
  ADD KEY `id_artikel` (`id_artikel`);

--
-- Indexes for table `info_berjalan`
--
ALTER TABLE `info_berjalan`
  ADD PRIMARY KEY (`id_info`);

--
-- Indexes for table `jenis_lembaga`
--
ALTER TABLE `jenis_lembaga`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `jenis_umkm`
--
ALTER TABLE `jenis_umkm`
  ADD PRIMARY KEY (`id_jenis_umkm`);

--
-- Indexes for table `lembaga_desa`
--
ALTER TABLE `lembaga_desa`
  ADD PRIMARY KEY (`id_lembaga`),
  ADD KEY `id_desa` (`id_desa`),
  ADD KEY `fk_jenis_lembaga` (`id_jenis`),
  ADD KEY `fk_ketua` (`id_anggota_lembaga`);

--
-- Indexes for table `log_unduh_dokumen`
--
ALTER TABLE `log_unduh_dokumen`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_warga` (`id_warga`),
  ADD KEY `id_dokumen` (`id_dokumen`);

--
-- Indexes for table `misi`
--
ALTER TABLE `misi`
  ADD PRIMARY KEY (`id_misi`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `statistik_pengunjung`
--
ALTER TABLE `statistik_pengunjung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indexes for table `struktur_desa`
--
ALTER TABLE `struktur_desa`
  ADD PRIMARY KEY (`id_struktur_desa`),
  ADD KEY `id_desa` (`id_desa`),
  ADD KEY `id_warga` (`id_warga`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id_umkm`),
  ADD KEY `id_desa` (`id_desa`),
  ADD KEY `id_jenis_umkm` (`id_jenis_umkm`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id_warga`),
  ADD KEY `id_desa` (`id_desa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `anggota_lembaga`
--
ALTER TABLE `anggota_lembaga`
  MODIFY `id_anggota_lembaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `apbdes`
--
ALTER TABLE `apbdes`
  MODIFY `id_apbdes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `desa`
--
ALTER TABLE `desa`
  MODIFY `id_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gambar_artikel`
--
ALTER TABLE `gambar_artikel`
  MODIFY `id_gambar_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `info_berjalan`
--
ALTER TABLE `info_berjalan`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis_lembaga`
--
ALTER TABLE `jenis_lembaga`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_umkm`
--
ALTER TABLE `jenis_umkm`
  MODIFY `id_jenis_umkm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lembaga_desa`
--
ALTER TABLE `lembaga_desa`
  MODIFY `id_lembaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `log_unduh_dokumen`
--
ALTER TABLE `log_unduh_dokumen`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `misi`
--
ALTER TABLE `misi`
  MODIFY `id_misi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statistik_pengunjung`
--
ALTER TABLE `statistik_pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `struktur_desa`
--
ALTER TABLE `struktur_desa`
  MODIFY `id_struktur_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id_umkm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`);

--
-- Constraints for table `anggota_lembaga`
--
ALTER TABLE `anggota_lembaga`
  ADD CONSTRAINT `anggota_lembaga_ibfk_1` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga_desa` (`id_lembaga`);

--
-- Constraints for table `apbdes`
--
ALTER TABLE `apbdes`
  ADD CONSTRAINT `apbdes_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`);

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE CASCADE;

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`);

--
-- Constraints for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD CONSTRAINT `fasilitas_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`);

--
-- Constraints for table `gambar_artikel`
--
ALTER TABLE `gambar_artikel`
  ADD CONSTRAINT `gambar_artikel_ibfk_1` FOREIGN KEY (`id_artikel`) REFERENCES `artikel` (`id_artikel`) ON DELETE CASCADE;

--
-- Constraints for table `lembaga_desa`
--
ALTER TABLE `lembaga_desa`
  ADD CONSTRAINT `fk_jenis_lembaga` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_lembaga` (`id_jenis`),
  ADD CONSTRAINT `fk_ketua` FOREIGN KEY (`id_anggota_lembaga`) REFERENCES `anggota_lembaga` (`id_anggota_lembaga`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `lembaga_desa_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`);

--
-- Constraints for table `log_unduh_dokumen`
--
ALTER TABLE `log_unduh_dokumen`
  ADD CONSTRAINT `log_unduh_dokumen_ibfk_1` FOREIGN KEY (`id_warga`) REFERENCES `warga` (`id_warga`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_unduh_dokumen_ibfk_2` FOREIGN KEY (`id_dokumen`) REFERENCES `dokumen` (`id_dokumen`) ON DELETE CASCADE;

--
-- Constraints for table `misi`
--
ALTER TABLE `misi`
  ADD CONSTRAINT `misi_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`);

--
-- Constraints for table `statistik_pengunjung`
--
ALTER TABLE `statistik_pengunjung`
  ADD CONSTRAINT `statistik_pengunjung_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE CASCADE;

--
-- Constraints for table `struktur_desa`
--
ALTER TABLE `struktur_desa`
  ADD CONSTRAINT `struktur_desa_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`),
  ADD CONSTRAINT `struktur_desa_ibfk_2` FOREIGN KEY (`id_warga`) REFERENCES `warga` (`id_warga`);

--
-- Constraints for table `umkm`
--
ALTER TABLE `umkm`
  ADD CONSTRAINT `umkm_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`),
  ADD CONSTRAINT `umkm_ibfk_2` FOREIGN KEY (`id_jenis_umkm`) REFERENCES `jenis_umkm` (`id_jenis_umkm`);

--
-- Constraints for table `warga`
--
ALTER TABLE `warga`
  ADD CONSTRAINT `warga_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
