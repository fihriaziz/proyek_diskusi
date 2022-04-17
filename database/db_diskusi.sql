-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13 Jul 2018 pada 05.27
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_diskusi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`, `alamat`, `email`, `no_tlp`) VALUES
(1, 'admin', 'admin', 'Admin1', 'Cirebon', 'admin@gmail.com', '083456234777');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskusi`
--

CREATE TABLE `diskusi` (
  `id_diskusi` int(11) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `isi` varchar(200) NOT NULL,
  `tgl_post` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tambahan` varchar(1) NOT NULL DEFAULT 'T',
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `diskusi`
--

INSERT INTO `diskusi` (`id_diskusi`, `judul`, `isi`, `tgl_post`, `tambahan`, `id_user`) VALUES
(4, 'diskusi 2', 'dan yah begitulah', '2018-01-13 13:46:15', 'T', 1),
(8, 'Hi', 'Komen Please', '2018-01-21 08:53:45', 'T', 1),
(53, 'upload', 'upload file', '2018-01-29 09:26:46', 'Y', 1),
(54, 'upload', 'upload image', '2018-01-29 09:27:37', 'Y', 1),
(58, 'Diskusi Baru', 'Isi Diskusi Baru', '2018-07-09 21:39:30', 'T', 2),
(59, 'coba', 'coba', '2018-07-09 21:40:04', 'T', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dsn`
--

CREATE TABLE `dsn` (
  `id_dosen` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jk` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'kosong.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dsn`
--

INSERT INTO `dsn` (`id_dosen`, `id_user`, `nip`, `nama`, `jk`, `status`, `email`, `alamat`, `foto`) VALUES
(2, 5, '23525', 'Suryono', 'Laki-Laki', 'Dosen', 'suryo@gmail.com', 'Cirebon', 'kosong.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `file`
--

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `is_image` varchar(255) NOT NULL,
  `tgl_post` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_diskusi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `file`
--

INSERT INTO `file` (`id_file`, `nama_file`, `is_image`, `tgl_post`, `id_user`, `id_diskusi`) VALUES
(6, 'jawaban_quis_MPSTI2.txt', '0', '2018-01-29', 1, 53),
(7, 'cic2.jpg', '1', '2018-01-29', 1, 54);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `isi_komentar` varchar(200) NOT NULL,
  `tgl_komentar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_diskusi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `is_image` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `isi_komentar`, `tgl_komentar`, `id_diskusi`, `id_user`, `lampiran`, `is_image`) VALUES
(176, 'test', '2018-07-08 10:13:05', 54, 3, NULL, NULL),
(178, 'test lagi', '2018-07-08 10:21:12', 54, 2, NULL, NULL),
(179, 'coba', '2018-07-08 10:56:12', 54, 5, NULL, NULL),
(180, 'coba lagi', '2018-07-08 11:01:21', 54, 5, NULL, NULL),
(183, 'contoh komentar', '2018-07-10 08:20:38', 8, 2, '2.-Kebijakan-Pelayanan-Farmasi.doc', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mhs`
--

CREATE TABLE `mhs` (
  `id_mhs` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jk` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `prodi` varchar(20) NOT NULL,
  `semester` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'kosong.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mhs`
--

INSERT INTO `mhs` (`id_mhs`, `id_user`, `nim`, `nama`, `jk`, `status`, `prodi`, `semester`, `email`, `alamat`, `foto`) VALUES
(1, 1, '2015142018', 'Rian Maulana', 'Laki-Laki', 'Mahasiswa', 'TI', 6, 'rianmaulana121417@gmail.com', 'Ds. Padamatang, Kec Pasawahan Kab. Kuningan', 'foto_Rian_Maulana2.jpg'),
(2, 2, '2015142026', 'M. Fihri Aziz A.', 'Laki-Laki', 'Mahasiswa', 'TI', 6, 'FihriAziz@gmail.com', 'Cirebon', 'foto_M__Fihri_Aziz_A_3.jpg'),
(3, 3, '2015142011', 'M. Rifaldi', 'Laki-Laki', 'Mahasiswa', 'TI', 6, 'M.rifaldi@gmail.com', 'Cirebon Gunung', 'kosong.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_diskusi` int(11) NOT NULL,
  `id_komentar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_diskusi`, `id_komentar`, `id_user`, `status`) VALUES
(135, 54, 176, 1, 1),
(138, 54, 178, 1, 1),
(139, 54, 178, 3, 0),
(140, 54, 179, 1, 1),
(141, 54, 179, 2, 0),
(142, 54, 179, 3, 0),
(143, 54, 180, 1, 1),
(144, 54, 180, 2, 0),
(145, 54, 180, 3, 0),
(148, 8, 183, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reportdiskusi`
--

CREATE TABLE `reportdiskusi` (
  `id_report_d` int(11) NOT NULL,
  `id_diskusi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_report` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reportdiskusi`
--

INSERT INTO `reportdiskusi` (`id_report_d`, `id_diskusi`, `id_user`, `tgl_report`) VALUES
(5, 54, 3, '2018-07-04 21:12:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reportkomentar`
--

CREATE TABLE `reportkomentar` (
  `id_report_k` int(11) NOT NULL,
  `id_komentar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_report` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reportkomentar`
--

INSERT INTO `reportkomentar` (`id_report_k`, `id_komentar`, `id_user`, `tgl_report`) VALUES
(1, 178, 1, '2018-07-10 08:50:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, '2015142018', '2015142018'),
(2, '2015142026', '2015142026'),
(3, '2015142011', '2015142011'),
(5, '12345', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`id_diskusi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `dsn`
--
ALTER TABLE `dsn`
  ADD PRIMARY KEY (`id_dosen`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_diskusi` (`id_diskusi`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `komentar_ibfk_2` (`id_diskusi`);

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`id_mhs`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `reportdiskusi`
--
ALTER TABLE `reportdiskusi`
  ADD PRIMARY KEY (`id_report_d`);

--
-- Indexes for table `reportkomentar`
--
ALTER TABLE `reportkomentar`
  ADD PRIMARY KEY (`id_report_k`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `id_diskusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `dsn`
--
ALTER TABLE `dsn`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
--
-- AUTO_INCREMENT for table `mhs`
--
ALTER TABLE `mhs`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;
--
-- AUTO_INCREMENT for table `reportdiskusi`
--
ALTER TABLE `reportdiskusi`
  MODIFY `id_report_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `reportkomentar`
--
ALTER TABLE `reportkomentar`
  MODIFY `id_report_k` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `diskusi`
--
ALTER TABLE `diskusi`
  ADD CONSTRAINT `diskusi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `dsn`
--
ALTER TABLE `dsn`
  ADD CONSTRAINT `dsn_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `file_ibfk_2` FOREIGN KEY (`id_diskusi`) REFERENCES `diskusi` (`id_diskusi`);

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_diskusi`) REFERENCES `diskusi` (`id_diskusi`);

--
-- Ketidakleluasaan untuk tabel `mhs`
--
ALTER TABLE `mhs`
  ADD CONSTRAINT `mhs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
