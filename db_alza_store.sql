-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Nov 2026 pada 10.41
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_alza_store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_keluar`
--

CREATE TABLE `detail_transaksi_keluar` (
  `id_detail_keluar` int(11) NOT NULL,
  `id_transaksi_keluar` int(11) NOT NULL,
  `id_varian` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_masuk`
--

CREATE TABLE `detail_transaksi_masuk` (
  `id_detail_masuk` int(11) NOT NULL,
  `id_transaksi_masuk` int(11) NOT NULL,
  `id_varian` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `biaya_produksi` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `peran` enum('owner','admin') NOT NULL,
  `waktu_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `nama_lengkap`, `peran`, `waktu_dibuat`) VALUES
(1, 'admin123', '$2y$10$EiT4RglNb6qZyRZQDedS6eT8OpiaW5EJ0bvBH.pfrzthBkZRVPGH2', 'Admin Operasional', 'admin', '2026-11-09 10:28:11'),
(2, 'owner123', '$2y$10$1aanaYmi8s6CuBHKE1nAvuLknIeCKAPYD4dP0Dfh/7a3aIjjho8ni', 'Pemilik UD Alza', 'owner', '2026-11-09 10:28:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjahit`
--

CREATE TABLE `penjahit` (
  `id_penjahit` int(11) NOT NULL,
  `nama_penjahit` varchar(100) NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status_aktif` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `waktu_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjahit`
--

INSERT INTO `penjahit` (`id_penjahit`, `nama_penjahit`, `no_telepon`, `alamat`, `status_aktif`, `waktu_dibuat`) VALUES
(1, 'Konveksi Bu Sari', '081234567890', 'Pekalongan Selatan', 'Aktif', '2026-11-09 10:28:11'),
(2, 'Penjahit Pak Budi', '089876543210', 'Pekalongan Barat', 'Aktif', '2026-11-09 10:28:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pergerakan_stok`
--

CREATE TABLE `pergerakan_stok` (
  `id_pergerakan` int(11) NOT NULL,
  `id_varian` int(11) NOT NULL,
  `tipe_pergerakan` enum('MASUK','KELUAR','PENYESUAIAN') NOT NULL,
  `id_transaksi_masuk` int(11) DEFAULT NULL,
  `id_transaksi_keluar` int(11) DEFAULT NULL,
  `id_retur` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `saldo_stok` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tanggal_pergerakan` datetime NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `waktu_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `tipe_lengan` varchar(50) DEFAULT NULL,
  `motif` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `waktu_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_barang`
--

CREATE TABLE `retur_barang` (
  `id_retur` int(11) NOT NULL,
  `nomor_retur` varchar(100) DEFAULT NULL,
  `id_transaksi_keluar` int(11) DEFAULT NULL,
  `id_varian` int(11) NOT NULL,
  `jumlah_retur` int(11) NOT NULL,
  `kategori_retur` enum('Salah Ukuran','Cacat Produksi','Salah Kirim','Gagal COD','Lainnya') NOT NULL,
  `tindak_lanjut` enum('Kembalikan ke Stok','Pisahkan (Barang Rusak)') NOT NULL,
  `alasan` text DEFAULT NULL,
  `tanggal_retur` datetime NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `waktu_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `saluran_penjualan`
--

CREATE TABLE `saluran_penjualan` (
  `id_saluran` int(11) NOT NULL,
  `nama_saluran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `saluran_penjualan`
--

INSERT INTO `saluran_penjualan` (`id_saluran`, `nama_saluran`) VALUES
(4, 'Lazada'),
(2, 'Shopee'),
(3, 'TikTok Shop'),
(1, 'Toko Offline');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_keluar`
--

CREATE TABLE `transaksi_keluar` (
  `id_transaksi_keluar` int(11) NOT NULL,
  `id_saluran` int(11) NOT NULL,
  `nomor_pesanan` varchar(100) DEFAULT NULL,
  `tanggal_keluar` datetime NOT NULL,
  `tujuan_pengiriman` varchar(100) DEFAULT NULL,
  `status_transaksi` varchar(50) DEFAULT 'Selesai',
  `keterangan` text DEFAULT NULL,
  `id_pengguna` int(11) NOT NULL,
  `waktu_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_masuk`
--

CREATE TABLE `transaksi_masuk` (
  `id_transaksi_masuk` int(11) NOT NULL,
  `nomor_referensi` varchar(100) DEFAULT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `id_penjahit` int(11) DEFAULT NULL,
  `status_transaksi` varchar(50) DEFAULT 'Selesai',
  `keterangan` text DEFAULT NULL,
  `id_pengguna` int(11) NOT NULL,
  `waktu_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `varian_produk`
--

CREATE TABLE `varian_produk` (
  `id_varian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kode_sku` varchar(50) NOT NULL,
  `warna` varchar(30) DEFAULT NULL,
  `ukuran` varchar(10) DEFAULT NULL,
  `harga_jual` decimal(12,2) NOT NULL,
  `waktu_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi_keluar`
--
ALTER TABLE `detail_transaksi_keluar`
  ADD PRIMARY KEY (`id_detail_keluar`),
  ADD KEY `id_transaksi_keluar` (`id_transaksi_keluar`),
  ADD KEY `id_varian` (`id_varian`);

--
-- Indeks untuk tabel `detail_transaksi_masuk`
--
ALTER TABLE `detail_transaksi_masuk`
  ADD PRIMARY KEY (`id_detail_masuk`),
  ADD KEY `id_transaksi_masuk` (`id_transaksi_masuk`),
  ADD KEY `id_varian` (`id_varian`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `penjahit`
--
ALTER TABLE `penjahit`
  ADD PRIMARY KEY (`id_penjahit`);

--
-- Indeks untuk tabel `pergerakan_stok`
--
ALTER TABLE `pergerakan_stok`
  ADD PRIMARY KEY (`id_pergerakan`),
  ADD KEY `id_varian` (`id_varian`),
  ADD KEY `id_transaksi_masuk` (`id_transaksi_masuk`),
  ADD KEY `id_transaksi_keluar` (`id_transaksi_keluar`),
  ADD KEY `id_retur` (`id_retur`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD PRIMARY KEY (`id_retur`),
  ADD UNIQUE KEY `nomor_retur` (`nomor_retur`),
  ADD KEY `id_transaksi_keluar` (`id_transaksi_keluar`),
  ADD KEY `id_varian` (`id_varian`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `saluran_penjualan`
--
ALTER TABLE `saluran_penjualan`
  ADD PRIMARY KEY (`id_saluran`),
  ADD UNIQUE KEY `nama_saluran` (`nama_saluran`);

--
-- Indeks untuk tabel `transaksi_keluar`
--
ALTER TABLE `transaksi_keluar`
  ADD PRIMARY KEY (`id_transaksi_keluar`),
  ADD UNIQUE KEY `nomor_pesanan` (`nomor_pesanan`),
  ADD KEY `id_saluran` (`id_saluran`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  ADD PRIMARY KEY (`id_transaksi_masuk`),
  ADD UNIQUE KEY `nomor_referensi` (`nomor_referensi`),
  ADD KEY `id_penjahit` (`id_penjahit`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `varian_produk`
--
ALTER TABLE `varian_produk`
  ADD PRIMARY KEY (`id_varian`),
  ADD UNIQUE KEY `kode_sku` (`kode_sku`),
  ADD KEY `id_produk` (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_keluar`
--
ALTER TABLE `detail_transaksi_keluar`
  MODIFY `id_detail_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi_masuk`
--
ALTER TABLE `detail_transaksi_masuk`
  MODIFY `id_detail_masuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penjahit`
--
ALTER TABLE `penjahit`
  MODIFY `id_penjahit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pergerakan_stok`
--
ALTER TABLE `pergerakan_stok`
  MODIFY `id_pergerakan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `retur_barang`
--
ALTER TABLE `retur_barang`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `saluran_penjualan`
--
ALTER TABLE `saluran_penjualan`
  MODIFY `id_saluran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi_keluar`
--
ALTER TABLE `transaksi_keluar`
  MODIFY `id_transaksi_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  MODIFY `id_transaksi_masuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `varian_produk`
--
ALTER TABLE `varian_produk`
  MODIFY `id_varian` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi_keluar`
--
ALTER TABLE `detail_transaksi_keluar`
  ADD CONSTRAINT `detail_transaksi_keluar_ibfk_1` FOREIGN KEY (`id_transaksi_keluar`) REFERENCES `transaksi_keluar` (`id_transaksi_keluar`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksi_keluar_ibfk_2` FOREIGN KEY (`id_varian`) REFERENCES `varian_produk` (`id_varian`);

--
-- Ketidakleluasaan untuk tabel `detail_transaksi_masuk`
--
ALTER TABLE `detail_transaksi_masuk`
  ADD CONSTRAINT `detail_transaksi_masuk_ibfk_1` FOREIGN KEY (`id_transaksi_masuk`) REFERENCES `transaksi_masuk` (`id_transaksi_masuk`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_transaksi_masuk_ibfk_2` FOREIGN KEY (`id_varian`) REFERENCES `varian_produk` (`id_varian`);

--
-- Ketidakleluasaan untuk tabel `pergerakan_stok`
--
ALTER TABLE `pergerakan_stok`
  ADD CONSTRAINT `pergerakan_stok_ibfk_1` FOREIGN KEY (`id_varian`) REFERENCES `varian_produk` (`id_varian`),
  ADD CONSTRAINT `pergerakan_stok_ibfk_2` FOREIGN KEY (`id_transaksi_masuk`) REFERENCES `transaksi_masuk` (`id_transaksi_masuk`) ON DELETE CASCADE,
  ADD CONSTRAINT `pergerakan_stok_ibfk_3` FOREIGN KEY (`id_transaksi_keluar`) REFERENCES `transaksi_keluar` (`id_transaksi_keluar`) ON DELETE CASCADE,
  ADD CONSTRAINT `pergerakan_stok_ibfk_4` FOREIGN KEY (`id_retur`) REFERENCES `retur_barang` (`id_retur`) ON DELETE CASCADE,
  ADD CONSTRAINT `pergerakan_stok_ibfk_5` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD CONSTRAINT `retur_barang_ibfk_1` FOREIGN KEY (`id_transaksi_keluar`) REFERENCES `transaksi_keluar` (`id_transaksi_keluar`) ON DELETE SET NULL,
  ADD CONSTRAINT `retur_barang_ibfk_2` FOREIGN KEY (`id_varian`) REFERENCES `varian_produk` (`id_varian`),
  ADD CONSTRAINT `retur_barang_ibfk_3` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `transaksi_keluar`
--
ALTER TABLE `transaksi_keluar`
  ADD CONSTRAINT `transaksi_keluar_ibfk_1` FOREIGN KEY (`id_saluran`) REFERENCES `saluran_penjualan` (`id_saluran`),
  ADD CONSTRAINT `transaksi_keluar_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  ADD CONSTRAINT `transaksi_masuk_ibfk_1` FOREIGN KEY (`id_penjahit`) REFERENCES `penjahit` (`id_penjahit`),
  ADD CONSTRAINT `transaksi_masuk_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `varian_produk`
--
ALTER TABLE `varian_produk`
  ADD CONSTRAINT `varian_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
