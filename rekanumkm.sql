-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06 Mar 2017 pada 11.53
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekanumkm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_accountclassification`
--

CREATE TABLE `mst_accountclassification` (
  `accountclassification_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_accountclassification`
--

INSERT INTO `mst_accountclassification` (`accountclassification_id`, `name`, `description`, `create_at`) VALUES
(1, 'Neraca', '', '2017-02-15 03:40:04'),
(2, 'Laba-Rugi', '', '2017-02-15 03:40:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_accounttype`
--

CREATE TABLE `mst_accounttype` (
  `accounttype_id` int(11) NOT NULL,
  `accountclassification_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_accounttype`
--

INSERT INTO `mst_accounttype` (`accounttype_id`, `accountclassification_id`, `name`, `description`, `create_at`) VALUES
(1, 1, 'Aset', '', '2017-02-15 03:41:08'),
(2, 1, 'Liabilitas', '', '2017-02-15 03:41:08'),
(3, 1, 'Ekuitas', '', '2017-02-15 03:41:23'),
(4, 2, 'Pendapatan', '', '2017-02-15 03:42:03'),
(5, 2, 'Beban Pokok Penjualan', '', '2017-02-15 03:42:03'),
(6, 2, 'Beban-Beban', '', '2017-02-15 03:42:31'),
(7, 2, 'Lain-Lain', '', '2017-02-15 03:42:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_accounttypename`
--

CREATE TABLE `mst_accounttypename` (
  `accounttypename_id` int(11) NOT NULL,
  `accountclassification_id` int(11) NOT NULL,
  `accounttype_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_accounttypename`
--

INSERT INTO `mst_accounttypename` (`accounttypename_id`, `accountclassification_id`, `accounttype_id`, `name`, `deskripsi`, `create_at`) VALUES
(1, 1, 1, 'Aset Lancar', '', '2017-02-15 03:45:17'),
(2, 1, 1, 'Aset Tidak Lancar', '', '2017-02-15 03:45:17'),
(3, 1, 2, 'Kewajiban Lancar', '', '2017-02-15 03:46:05'),
(4, 1, 2, 'Kewajiban Jangka Panjang', '', '2017-02-15 03:46:05'),
(5, 2, 6, 'Beban Operasional', '', '2017-02-15 03:47:23'),
(6, 2, 6, 'Beban Pajak', '', '2017-02-15 03:47:23'),
(7, 2, 7, 'Pendapatann Luar Usaha', '', '2017-02-15 03:48:08'),
(8, 2, 7, 'Beban Di Luar Usaha', '', '2017-02-15 03:48:08'),
(9, 2, 7, 'Ikhtisar Laba/Rugi', '', '2017-02-15 03:48:27'),
(10, 2, 6, 'Beban Bunga Bank', '', '2017-02-16 13:31:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_journal`
--

CREATE TABLE `mst_journal` (
  `journal_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `journaltype_id` int(11) NOT NULL,
  `transactioncategory_id` int(11) NOT NULL,
  `subtransactioncategory_id` int(11) DEFAULT NULL,
  `paymentmethod_id` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `description` text NOT NULL,
  `journal_date` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_journal`
--

INSERT INTO `mst_journal` (`journal_id`, `store_id`, `journaltype_id`, `transactioncategory_id`, `subtransactioncategory_id`, `paymentmethod_id`, `nominal`, `description`, `journal_date`, `create_at`) VALUES
(3, 6, 1, 2, NULL, 2, 12312312, 'asdasdas', '17 February 2017', '2017-02-28 02:09:14'),
(5, 6, 2, 4, 2, 1, 1000000, 'Transaki Pengelusara', '15 March 2017', '2017-03-04 13:56:59'),
(6, 0, 2, 5, 15, 1, 12312312, 'tes ya', '11 March 2017', '2017-03-06 08:16:34'),
(7, 0, 2, 5, 15, 1, 12312312, 'tes ya', '11 March 2017', '2017-03-06 08:16:42'),
(8, 0, 2, 5, 15, 1, 12312312, 'tes yasadasd', '11 March 2017', '2017-03-06 08:17:46'),
(9, 0, 2, 4, 2, 2, 12312312, 'tes ya', '11 March 2017', '2017-03-06 08:17:58'),
(10, 0, 2, 4, 2, 2, 12312312, 'tes ya', '11 March 2017', '2017-03-06 08:18:15'),
(11, 6, 2, 5, 14, 1, 23123, 'asd', '10 March 2017', '2017-03-06 10:06:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_journaltype`
--

CREATE TABLE `mst_journaltype` (
  `journaltype_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_journaltype`
--

INSERT INTO `mst_journaltype` (`journaltype_id`, `name`, `create_at`) VALUES
(1, 'purchase', '2017-02-26 16:23:54'),
(2, 'cash payment', '2017-02-28 05:11:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_paymentmethod`
--

CREATE TABLE `mst_paymentmethod` (
  `paymentmethod_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_paymentmethod`
--

INSERT INTO `mst_paymentmethod` (`paymentmethod_id`, `name`, `create_at`) VALUES
(1, 'Tunai', '2017-02-24 07:18:21'),
(2, 'Transfer Bank', '2017-02-24 07:18:21'),
(3, 'Kredit', '2017-02-24 07:18:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_store`
--

CREATE TABLE `mst_store` (
  `store_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text,
  `picture` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` int(11) DEFAULT NULL,
  `delete_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_store`
--

INSERT INTO `mst_store` (`store_id`, `user_id`, `name`, `address`, `picture`, `create_at`, `update_at`, `delete_at`) VALUES
(5, 4, 'UD maju', 'margonda\r\n', '', '2017-02-12 07:45:35', NULL, NULL),
(6, 3, 'PT. Sejahtera Komputer', 'jl. xxx xxx nox xx ', '', '2017-02-14 06:17:17', NULL, NULL),
(7, 3, 'PT SEjahtera Umat', '123\r\n', '', '2017-03-06 10:26:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_subofaccounttypename1stlevel`
--

CREATE TABLE `mst_subofaccounttypename1stlevel` (
  `subofaccounttypename1stlevel_id` int(11) NOT NULL,
  `accountclassification_id` int(11) NOT NULL,
  `accounttype_id` int(11) NOT NULL,
  `accounttypename_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='3';

--
-- Dumping data untuk tabel `mst_subofaccounttypename1stlevel`
--

INSERT INTO `mst_subofaccounttypename1stlevel` (`subofaccounttypename1stlevel_id`, `accountclassification_id`, `accounttype_id`, `accounttypename_id`, `name`, `description`, `create_at`) VALUES
(1, 1, 1, 1, 'Kas Dan Bank', '', '2017-02-15 03:52:14'),
(2, 1, 1, 1, 'Piutang', '', '2017-02-15 03:52:14'),
(3, 1, 1, 1, 'Persediaan', '', '2017-02-15 04:00:46'),
(4, 1, 1, 1, 'Perlengkapan', '', '2017-02-15 04:00:46'),
(5, 1, 1, 1, 'Beban dibayar di muka\r\n', '', '2017-02-15 04:00:46'),
(6, 1, 1, 2, 'Tanah dan Bangunan', '', '2017-02-15 04:00:46'),
(7, 1, 1, 2, 'Peralatan', '', '2017-02-15 04:00:46'),
(8, 1, 1, 2, 'Kendaraan', '', '2017-02-15 04:00:46'),
(9, 1, 1, 2, 'Akumulasi Penyusutan', '', '2017-02-15 04:00:46'),
(10, 1, 2, 3, 'Hutang Bank Jangka Pendek', '', '2017-02-15 04:00:46'),
(11, 1, 2, 3, 'Hutang Usaha', '', '2017-02-15 04:00:46'),
(12, 1, 2, 3, 'Hutang Pajak', '', '2017-02-15 04:00:46'),
(13, 1, 2, 3, 'Biaya yang Masih harus dibayar', '', '2017-02-15 04:01:57'),
(14, 1, 2, 3, 'Hutang Jangka Pendek Lain-lain', '', '2017-02-15 04:01:57'),
(15, 1, 2, 4, 'Hutang Bank Jangka Panjang', '', '2017-02-15 04:03:55'),
(16, 1, 2, 4, 'Hutang Jangka Panjang Lain-lain', '', '2017-02-15 04:03:55'),
(17, 2, 6, 5, 'Beban Umum dan Administrasi\r\n', '', '2017-02-16 12:31:13'),
(18, 2, 6, 5, 'Beban Penjualan\r\n', '', '2017-02-16 12:31:13'),
(19, 2, 6, 5, 'Beban Pemasaran', '', '2017-02-16 12:37:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_subofaccounttypename2ndlevel`
--

CREATE TABLE `mst_subofaccounttypename2ndlevel` (
  `subofaccounttypename2ndlevel_id` int(11) NOT NULL,
  `accountclassification_id` int(11) NOT NULL,
  `accounttype_id` int(11) NOT NULL,
  `accounttypename_id` int(11) DEFAULT NULL,
  `subofaccounttypename1stlevel_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_subofaccounttypename2ndlevel`
--

INSERT INTO `mst_subofaccounttypename2ndlevel` (`subofaccounttypename2ndlevel_id`, `accountclassification_id`, `accounttype_id`, `accounttypename_id`, `subofaccounttypename1stlevel_id`, `name`, `description`, `create_at`) VALUES
(1, 1, 1, 1, 1, 'Kas', '', '2017-02-16 13:11:17'),
(2, 1, 1, 1, 1, 'Bank', '', '2017-02-16 13:11:17'),
(3, 1, 1, 1, 2, 'Piutang Usaha', '', '2017-02-16 13:11:17'),
(4, 1, 1, 1, 2, 'Piutang Lain-Lain', '', '2017-02-16 13:11:17'),
(5, 1, 1, 1, 3, 'Persediaan Barang Dagang', '', '2017-02-16 13:11:17'),
(6, 1, 1, 1, 4, 'Perlengkapan', '', '2017-02-16 13:11:17'),
(7, 1, 1, 1, 5, 'Sewa Dibayar Dimuka', '', '2017-02-16 13:11:17'),
(8, 1, 1, 1, 5, 'Pajak Dibayar Dimuka', '', '2017-02-16 13:11:17'),
(9, 1, 1, 1, 5, 'Biaya Dibayar Dimuka', '', '2017-02-16 13:11:17'),
(10, 1, 1, 2, 6, 'Tanah', '', '2017-02-16 13:11:17'),
(11, 1, 1, 2, 6, 'Bangunan Toko', '', '2017-02-16 13:11:17'),
(12, 1, 1, 2, 7, 'Peralatan Toko', '', '2017-02-16 13:11:17'),
(13, 1, 1, 2, 8, 'Kendaraan', '', '2017-02-16 13:11:17'),
(14, 1, 1, 2, 9, 'Akumulasi Penyusutan Bangunan Toko', '', '2017-02-16 13:11:17'),
(15, 1, 1, 2, 9, 'Akumulasi Penyusutan Peralatan Toko', '', '2017-02-16 13:11:17'),
(16, 1, 1, 2, 9, 'Akumulasi Penyusutan Kendaraan', '', '2017-02-16 13:11:17'),
(17, 1, 2, 3, 10, 'Utang Bank XXX', '', '2017-02-16 13:11:17'),
(18, 1, 2, 3, 11, 'Utang Usaha', '', '2017-02-16 13:11:17'),
(19, 1, 2, 3, 12, 'Hutang Pajak', '', '2017-02-16 13:11:17'),
(20, 1, 2, 3, 13, 'Hutang Gaji Karyawan\r\n', '', '2017-02-16 13:11:17'),
(21, 1, 2, 3, 13, 'Utang Bunga Pinjaman', '', '2017-02-16 13:11:17'),
(22, 1, 2, 3, 14, 'Hutang Jangka Pendek Lain-lain\r\n', '', '2017-02-16 13:11:17'),
(23, 1, 2, 4, 15, 'Hutang Jangka Panjang Bank XXX', '', '2017-02-16 13:11:17'),
(24, 1, 2, 4, 16, 'Hutang Jangka Panjang Lain-Lain', '', '2017-02-16 13:11:17'),
(25, 1, 3, NULL, NULL, 'Modal Pemilik', '', '2017-02-16 13:15:36'),
(26, 1, 3, NULL, NULL, 'Saldo Laba', '', '2017-02-16 13:15:36'),
(27, 1, 3, NULL, NULL, 'Penarikan Modal', '', '2017-02-16 13:16:15'),
(28, 2, 4, NULL, NULL, 'Pendapatan Penjualan', '', '2017-02-16 13:21:09'),
(29, 2, 4, NULL, NULL, 'Potongan Pejualan', '', '2017-02-16 13:21:09'),
(30, 2, 4, NULL, NULL, 'Retur Penjualan', '', '2017-02-16 13:21:09'),
(31, 2, 4, NULL, NULL, 'Pendapatan Komisi Penjualan', '', '2017-02-16 13:21:09'),
(32, 2, 5, NULL, NULL, 'Beban Pokok Penjualan', '', '2017-02-16 13:21:09'),
(33, 2, 5, NULL, NULL, 'Potongan Pembelian', '', '2017-02-16 13:21:56'),
(34, 2, 5, NULL, NULL, 'Retur Pembelian', '', '2017-02-16 13:21:56'),
(35, 2, 6, 5, 17, 'Beban Sewa Tempat Usaha', '', '2017-02-16 13:28:47'),
(36, 2, 6, 5, 17, 'Beban Gaji Kariawan', '', '2017-02-16 13:28:47'),
(37, 2, 6, 5, 17, 'Beban Kendaraan', '', '2017-02-16 13:28:47'),
(38, 2, 6, 5, 17, 'Beban Listrik', '', '2017-02-16 13:28:47'),
(39, 2, 6, 5, 17, 'Beban Telepon', '', '2017-02-16 13:28:47'),
(40, 2, 6, 5, 17, 'Beban air', '', '2017-02-16 13:28:47'),
(41, 2, 6, 5, 17, 'Beban Penyusutan Bangunan Toko', '', '2017-02-16 13:28:47'),
(42, 2, 6, 5, 17, 'Beban Penyusutan Peralatan Toko\r\n', '', '2017-02-16 13:28:47'),
(43, 2, 6, 5, 17, 'Beban Penyusutan Kendaraan\r\n', '', '2017-02-16 13:28:47'),
(44, 2, 6, 5, 18, 'Beban Pengiriman', '', '2017-02-16 13:28:47'),
(45, 2, 6, 5, 18, 'Beban Penjualan Lain-lain', '', '2017-02-16 13:30:24'),
(46, 2, 6, 5, 19, 'Beban Iklan', '', '2017-02-16 13:30:24'),
(47, 2, 6, 10, NULL, 'Beban Bunga Bank XXX', '', '2017-02-16 13:34:10'),
(48, 2, 6, 6, NULL, 'Beban Pajak', '', '2017-02-16 13:39:37'),
(49, 2, 7, 7, NULL, 'Pendapatan Bunga Bank\r\n', '', '2017-02-16 13:39:37'),
(50, 2, 7, 7, NULL, 'Pendapatan Sewa', '', '2017-02-16 13:39:37'),
(51, 2, 7, 8, NULL, 'Beban Administrasi Bank', '', '2017-02-16 13:39:37'),
(52, 2, 7, 9, NULL, 'Ikhtisar Laba Rugi', '', '2017-02-16 13:39:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_subtransactioncategory`
--

CREATE TABLE `mst_subtransactioncategory` (
  `subtransactioncategory_id` int(11) NOT NULL,
  `transactioncategory_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `paymentmethods` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_subtransactioncategory`
--

INSERT INTO `mst_subtransactioncategory` (`subtransactioncategory_id`, `transactioncategory_id`, `name`, `paymentmethods`, `create_at`) VALUES
(1, 4, 'Hutang Usaha', '[1,2]', '2017-02-28 05:26:31'),
(2, 4, 'Hutang Bank J.Pendek', '[1,2]', '2017-02-28 05:26:31'),
(12, 5, 'Sewa', '[1]', '2017-02-28 05:30:33'),
(13, 5, 'Gaji Karyawan', '[1]', '2017-02-28 05:30:33'),
(14, 5, 'Listrik ', '[1]', '2017-02-28 05:30:33'),
(15, 5, 'Telepon ', '[1]', '2017-02-28 05:30:33'),
(16, 5, 'Air', '[1]', '2017-02-28 05:30:33'),
(17, 5, 'Pengiriman Barang', '[1]', '2017-02-28 05:30:33'),
(18, 5, 'Pajak', '[2]', '2017-02-28 05:30:33'),
(19, 5, 'Bunga Pinjaman', '[1]', '2017-02-28 05:30:33'),
(20, 5, 'Administrasi Pajak', '[1]', '2017-02-28 05:30:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_transactioncategory`
--

CREATE TABLE `mst_transactioncategory` (
  `transactioncategory_id` int(11) NOT NULL,
  `journaltype_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_transactioncategory`
--

INSERT INTO `mst_transactioncategory` (`transactioncategory_id`, `journaltype_id`, `name`, `create_at`) VALUES
(1, 1, 'Barang Dagang', '2017-02-26 16:49:16'),
(2, 1, 'Perlengkapan', '2017-02-26 16:49:16'),
(3, 1, 'Peralatan', '2017-02-26 16:49:16'),
(4, 2, 'Pelunasan ', '2017-02-28 05:24:38'),
(5, 2, 'Pembayaran', '2017-02-28 05:24:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_user`
--

CREATE TABLE `mst_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text,
  `gender` char(1) NOT NULL,
  `birthdate` varchar(100) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `picture` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recover_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_user`
--

INSERT INTO `mst_user` (`user_id`, `username`, `email`, `first_name`, `last_name`, `address`, `gender`, `birthdate`, `phone_number`, `password`, `role`, `picture`, `create_at`, `update_at`, `delete_at`, `recover_at`) VALUES
(3, 'admin', 'admin@rekanumkm.com', 'Saufi', 'Rahman', 'Depok', 'M', '11 August 1994', '83874860263', 'asd', 2, 'public/assets/avatar_img/admin.jpg', '2017-02-07 13:59:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'andreasricardo', 'asdfgh@gmail.com', 'Andreas', 'R.', 'asd', 'M', '12 May 1995', '12312312', 'rekansukses123', 2, 'public/assets/avatar_img/andreasricardo.jpg', '2017-02-12 07:44:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_accountclassification`
--
ALTER TABLE `mst_accountclassification`
  ADD PRIMARY KEY (`accountclassification_id`);

--
-- Indexes for table `mst_accounttype`
--
ALTER TABLE `mst_accounttype`
  ADD PRIMARY KEY (`accounttype_id`),
  ADD KEY `accountclassification_id` (`accountclassification_id`);

--
-- Indexes for table `mst_accounttypename`
--
ALTER TABLE `mst_accounttypename`
  ADD PRIMARY KEY (`accounttypename_id`),
  ADD KEY `accountclassification_id` (`accountclassification_id`),
  ADD KEY `accounttype_id` (`accounttype_id`);

--
-- Indexes for table `mst_journal`
--
ALTER TABLE `mst_journal`
  ADD PRIMARY KEY (`journal_id`),
  ADD KEY `purchasetype_id` (`transactioncategory_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `paymentmethod_id` (`paymentmethod_id`),
  ADD KEY `jurnaltype_id` (`journaltype_id`),
  ADD KEY `subtransactioncategory_id` (`subtransactioncategory_id`);

--
-- Indexes for table `mst_journaltype`
--
ALTER TABLE `mst_journaltype`
  ADD PRIMARY KEY (`journaltype_id`),
  ADD KEY `journaltype_id` (`journaltype_id`);

--
-- Indexes for table `mst_paymentmethod`
--
ALTER TABLE `mst_paymentmethod`
  ADD PRIMARY KEY (`paymentmethod_id`);

--
-- Indexes for table `mst_store`
--
ALTER TABLE `mst_store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `mst_subofaccounttypename1stlevel`
--
ALTER TABLE `mst_subofaccounttypename1stlevel`
  ADD PRIMARY KEY (`subofaccounttypename1stlevel_id`),
  ADD KEY `accountclassification_id` (`accountclassification_id`),
  ADD KEY `accounttype_id` (`accounttype_id`),
  ADD KEY `accounttypename_id` (`accounttypename_id`);

--
-- Indexes for table `mst_subofaccounttypename2ndlevel`
--
ALTER TABLE `mst_subofaccounttypename2ndlevel`
  ADD PRIMARY KEY (`subofaccounttypename2ndlevel_id`),
  ADD KEY `accountclassification_id` (`accountclassification_id`),
  ADD KEY `accounttype_id` (`accounttype_id`),
  ADD KEY `accounttypename_id` (`accounttypename_id`),
  ADD KEY `subofaccounttypename1stlevel_id` (`subofaccounttypename1stlevel_id`);

--
-- Indexes for table `mst_subtransactioncategory`
--
ALTER TABLE `mst_subtransactioncategory`
  ADD PRIMARY KEY (`subtransactioncategory_id`),
  ADD KEY `transactioncategory_id` (`transactioncategory_id`);

--
-- Indexes for table `mst_transactioncategory`
--
ALTER TABLE `mst_transactioncategory`
  ADD PRIMARY KEY (`transactioncategory_id`),
  ADD KEY `journaltype_id` (`journaltype_id`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_accountclassification`
--
ALTER TABLE `mst_accountclassification`
  MODIFY `accountclassification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mst_accounttype`
--
ALTER TABLE `mst_accounttype`
  MODIFY `accounttype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mst_accounttypename`
--
ALTER TABLE `mst_accounttypename`
  MODIFY `accounttypename_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `mst_journal`
--
ALTER TABLE `mst_journal`
  MODIFY `journal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `mst_journaltype`
--
ALTER TABLE `mst_journaltype`
  MODIFY `journaltype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mst_paymentmethod`
--
ALTER TABLE `mst_paymentmethod`
  MODIFY `paymentmethod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mst_store`
--
ALTER TABLE `mst_store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mst_subofaccounttypename1stlevel`
--
ALTER TABLE `mst_subofaccounttypename1stlevel`
  MODIFY `subofaccounttypename1stlevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `mst_subofaccounttypename2ndlevel`
--
ALTER TABLE `mst_subofaccounttypename2ndlevel`
  MODIFY `subofaccounttypename2ndlevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `mst_subtransactioncategory`
--
ALTER TABLE `mst_subtransactioncategory`
  MODIFY `subtransactioncategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `mst_transactioncategory`
--
ALTER TABLE `mst_transactioncategory`
  MODIFY `transactioncategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `mst_accounttype`
--
ALTER TABLE `mst_accounttype`
  ADD CONSTRAINT `mst_accounttype_ibfk_1` FOREIGN KEY (`accountclassification_id`) REFERENCES `mst_accountclassification` (`accountclassification_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mst_accounttypename`
--
ALTER TABLE `mst_accounttypename`
  ADD CONSTRAINT `mst_accounttypename_ibfk_1` FOREIGN KEY (`accounttype_id`) REFERENCES `mst_accounttype` (`accounttype_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mst_accounttypename_ibfk_2` FOREIGN KEY (`accountclassification_id`) REFERENCES `mst_accountclassification` (`accountclassification_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mst_journal`
--
ALTER TABLE `mst_journal`
  ADD CONSTRAINT `mst_journal_ibfk_1` FOREIGN KEY (`journaltype_id`) REFERENCES `mst_journaltype` (`journaltype_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mst_subofaccounttypename1stlevel`
--
ALTER TABLE `mst_subofaccounttypename1stlevel`
  ADD CONSTRAINT `mst_subofaccounttypename1stlevel_ibfk_1` FOREIGN KEY (`accountclassification_id`) REFERENCES `mst_accountclassification` (`accountclassification_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mst_subofaccounttypename1stlevel_ibfk_2` FOREIGN KEY (`accounttype_id`) REFERENCES `mst_accounttype` (`accounttype_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mst_subofaccounttypename1stlevel_ibfk_3` FOREIGN KEY (`accounttypename_id`) REFERENCES `mst_accounttypename` (`accounttypename_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mst_subofaccounttypename2ndlevel`
--
ALTER TABLE `mst_subofaccounttypename2ndlevel`
  ADD CONSTRAINT `mst_subofaccounttypename2ndlevel_ibfk_1` FOREIGN KEY (`subofaccounttypename1stlevel_id`) REFERENCES `mst_subofaccounttypename1stlevel` (`subofaccounttypename1stlevel_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mst_subofaccounttypename2ndlevel_ibfk_2` FOREIGN KEY (`accounttypename_id`) REFERENCES `mst_accounttypename` (`accounttypename_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mst_subofaccounttypename2ndlevel_ibfk_3` FOREIGN KEY (`accounttype_id`) REFERENCES `mst_accounttype` (`accounttype_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `mst_subofaccounttypename2ndlevel_ibfk_4` FOREIGN KEY (`accountclassification_id`) REFERENCES `mst_accountclassification` (`accountclassification_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mst_subtransactioncategory`
--
ALTER TABLE `mst_subtransactioncategory`
  ADD CONSTRAINT `mst_subtransactioncategory_ibfk_1` FOREIGN KEY (`transactioncategory_id`) REFERENCES `mst_transactioncategory` (`transactioncategory_id`);

--
-- Ketidakleluasaan untuk tabel `mst_transactioncategory`
--
ALTER TABLE `mst_transactioncategory`
  ADD CONSTRAINT `mst_transactioncategory_ibfk_1` FOREIGN KEY (`journaltype_id`) REFERENCES `mst_journaltype` (`journaltype_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
