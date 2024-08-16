-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Agu 2024 pada 03.12
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `stok`) VALUES
(1, 'Roti Manis', 15000.00, 4),
(2, 'Susu Moo', 18000.00, 5),
(3, 'Yogurtina', 10000.00, 5),
(4, 'Spicy Tom', 8000.00, 4),
(6, 'Choco Crunch', 12000.00, 4),
(7, 'Vanilla Dream', 10000.00, 5),
(8, 'Mayo Magic', 15000.00, 1),
(9, 'Aqua Pure', 3000.00, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nama_pembeli` varchar(255) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `produk_nama` varchar(255) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `diskon` decimal(5,2) DEFAULT NULL,
  `nilai_diskon` decimal(10,2) DEFAULT NULL,
  `uang_dibayar` decimal(10,2) DEFAULT NULL,
  `kembalian` decimal(10,2) DEFAULT NULL,
  `status_pembayaran` enum('Belum Dibayar','Lunas') NOT NULL DEFAULT 'Belum Dibayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama_pembeli`, `produk_id`, `produk_nama`, `jumlah`, `total`, `diskon`, `nilai_diskon`, `uang_dibayar`, `kembalian`, `status_pembayaran`) VALUES
(1, 'clarissa', 1, 'Roti Manis', 2, 30000.00, 0.00, NULL, 30000.00, 0.00, 'Lunas'),
(13, 'siti', 7, 'Vanilla Dream', 5, 50000.00, 0.00, NULL, 50000.00, 0.00, 'Lunas'),
(15, 'sisi', 4, 'Spicy Tom', 2, 16000.00, 0.00, NULL, 18000.00, 2000.00, 'Lunas'),
(16, 'parno', 6, 'Choco Crunch', 5, 57000.00, 5.00, NULL, 57000.00, 0.00, 'Lunas'),
(17, 'ciamis', 3, 'Yogurtina', 1, 10000.00, 0.00, 0.00, 10000.00, 0.00, 'Lunas'),
(18, 'siap', 2, 'Susu Moo', 2, 35280.00, 2.00, 720.00, 36000.00, 720.00, 'Lunas'),
(19, 'cia cia', 8, 'Mayo Magic', 2, 27000.00, 10.00, 3000.00, 30000.00, 3000.00, 'Lunas'),
(20, 'ritsuki', 7, 'Vanilla Dream', 5, 47500.00, 5.00, 2500.00, 50000.00, 2500.00, 'Lunas'),
(21, 'nat', 3, 'Yogurtina', 4, 36000.00, 10.00, 4000.00, 40000.00, 4000.00, 'Lunas'),
(22, 'data', 9, 'Aqua Pure', 1, 3000.00, 0.00, 0.00, 3000.00, 0.00, 'Lunas'),
(23, 'tika', 6, 'Choco Crunch', 1, 11400.00, 5.00, 600.00, 15000.00, 3600.00, 'Lunas'),
(24, 'dodit', 9, 'Aqua Pure', 5, 15000.00, 0.00, 0.00, 15000.00, 0.00, 'Lunas'),
(26, 'sinta', 2, 'Susu Moo', 2, 36000.00, NULL, NULL, 36000.00, 0.00, 'Lunas'),
(27, 'zanuar', 4, 'Spicy Tom', 1, 8000.00, 2.00, 0.00, 8000.00, 8000.00, 'Lunas'),
(28, 'susanto', 9, 'Aqua Pure', 1, 3000.00, NULL, NULL, NULL, NULL, 'Belum Dibayar'),
(29, 'Petra', 8, 'Mayo Magic', 2, 30000.00, 2.00, 0.00, 30000.00, 30000.00, 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `produk_nama` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
