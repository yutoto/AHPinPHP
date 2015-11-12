-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 15. Maret 2014 jam 19:16
-- Versi Server: 5.5.16
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ahppegawai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_kriteria`
--

CREATE TABLE IF NOT EXISTS `bobot_kriteria` (
  `id_kriteria` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `nama_kriteria` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `bobot` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`) VALUES
('1', 'Kedisiplinan', 0.25),
('2', 'Prestasi Kerja', 0.25),
('3', 'Pengalaman Kerja', 0.25),
('4', 'Perilaku', 0.25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `evaluasi`
--

CREATE TABLE IF NOT EXISTS `evaluasi` (
  `nip` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `id_kriteria` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `nilai` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `evaluasi`
--

INSERT INTO `evaluasi` (`nip`, `id_kriteria`, `nilai`) VALUES
('10102', '4', 80),
('10102', '3', 75),
('10102', '2', 70),
('10102', '1', 72),
('10103', '1', 71),
('10103', '2', 73),
('10103', '3', 86),
('10103', '4', 70),
('10104', '1', 70),
('10104', '2', 70),
('10104', '3', 80),
('10104', '4', 70),
('10105', '1', 90),
('10105', '2', 80),
('10105', '3', 80),
('10105', '4', 80);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_evaluasi`
--

CREATE TABLE IF NOT EXISTS `hasil_evaluasi` (
  `nip` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `total_nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `nip` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `nama_karyawan` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `jabatan` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `divisi` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `telp` varchar(30) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`nip`, `nama_karyawan`, `jabatan`, `divisi`, `alamat`, `telp`) VALUES
('10101', 'Karen Wijaya', 'Manajer', 'Marketing', 'Jl. Mawar No.8 Jakarta Barat', '0812888123'),
('10102', 'Karin Lidya', 'Staf', 'Marketing', 'Jl. Indah No.9 Jakarta Barat', '082190986752'),
('10103', 'Bob Anderson', 'Staf', 'Marketing', 'Jl. Angin No.10 Jakarta Barat', '085390981567'),
('10104', 'Steven Willem', 'Staf', 'Marketing', 'Jl. Maju No.2 Jakarta Barat', '085298761234'),
('10105', 'Andrea Sari', 'Staf', 'Marketing', 'Jl. Melati No.5 Jakarta Barat', '081390785645');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsistensi`
--

CREATE TABLE IF NOT EXISTS `konsistensi` (
  `cr` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `nama_kriteria` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`) VALUES
('1', 'Kedisiplinan'),
('2', 'Prestasi Kerja'),
('3', 'Pengalaman Kerja'),
('4', 'Perilaku');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matrik_kriteria`
--

CREATE TABLE IF NOT EXISTS `matrik_kriteria` (
  `indeks` int(5) NOT NULL AUTO_INCREMENT,
  `id_kriteria` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `id_bandingan` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`indeks`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=147 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `matrik_normalisasi_kriteria`
--

CREATE TABLE IF NOT EXISTS `matrik_normalisasi_kriteria` (
  `indeks` int(5) NOT NULL AUTO_INCREMENT,
  `id_kriteria` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `id_bandingan` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `nilai` float NOT NULL,
  PRIMARY KEY (`indeks`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=145 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `status` enum('admin','user') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('y','n') COLLATE latin1_general_ci NOT NULL,
  `urutan` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu`, `link`, `status`, `aktif`, `urutan`) VALUES
('Data Karyawan', '?modul=dtakary', 'admin', 'y', 1),
('Kriteria Penilaian', '?modul=kriteria', 'admin', 'y', 2),
('Bobot Kriteria', '?modul=bobot', 'admin', 'y', 3),
('Skor Penilaian', '?modul=evaluasi', 'admin', 'y', 4),
('Laporan Evaluasi Kinerja', '?modul=laporan', 'admin', 'y', 5),
('Profil', '?modul=profil', 'user', 'y', 1),
('Hasil Evaluasi', '?modul=hasil', 'user', 'y', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `nip` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `level` enum('admin','user') COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`nip`, `username`, `password`, `level`) VALUES
('10101', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('10102', 'karin', '97468f1980416a4376b44e701d25f24b', 'user'),
('10103', 'bob', '9f9d51bc70ef21ca5c14f307980a29d8', 'user'),
('10104', 'steven', '6ed61d4b80bb0f81937b32418e98adca', 'user'),
('10105', 'andrea', '1c42f9c1ca2f65441465b43cd9339d6c', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
