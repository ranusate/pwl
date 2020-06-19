-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2020 at 02:20 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app-pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `image` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `barcode`, `nama`, `id_kategori`, `harga`, `stock`, `image`, `created`, `updated`, `is_active`) VALUES
(15, 'B001', 'Mie', 5, 3000, 28, NULL, '2020-05-20 01:46:09', '2020-05-19 21:30:10', 1),
(16, 'B002', 'Good Day', 3, 15000, 34, NULL, '2020-05-20 01:46:32', NULL, 1),
(17, 'B007', 'Fullo', 3, 2000, 10, 'barang-200519-a2c456197f.jpg', '2020-05-20 01:47:55', '2020-05-20 08:43:34', 1),
(19, 'B006', 'Buku', 2, 4000, 0, NULL, '2020-05-20 02:17:58', NULL, 1),
(20, 'add1221', 'Nana', 8, 1200, 0, NULL, '2020-05-25 00:01:07', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount_barang` int(11) DEFAULT '0',
  `total` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_tunda`
--

CREATE TABLE `cart_tunda` (
  `id_cart_tunda` int(11) NOT NULL,
  `harga_tunda` int(11) NOT NULL,
  `qty_tunda` int(11) NOT NULL,
  `discount_tunda` int(11) NOT NULL DEFAULT '0',
  `total_tunda` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_trans_tunda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_tunda`
--

INSERT INTO `cart_tunda` (`id_cart_tunda`, `harga_tunda`, `qty_tunda`, `discount_tunda`, `total_tunda`, `id_barang`, `id_trans_tunda`) VALUES
(1, 2000, 4, 0, 8000, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `no_tlpn` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `jk`, `no_tlpn`, `alamat`, `created`, `updated`) VALUES
(2, 'Nona', 'P', '77675675', 'Jl.Solo', '2020-05-09 16:02:15', '2020-05-11 02:33:42'),
(4, 'Eki', 'L', '09782642571317', 'Jl.solo km12', '2020-05-11 07:34:26', NULL),
(6, 'Endo', 'P', '98787968', 'Kendari', '2020-05-11 07:35:13', NULL),
(9, 'Nepi', 'L', '77675675', 'Jogja              ', '2020-05-11 22:15:20', '2020-05-11 17:15:50'),
(10, 'Vera', 'P', '77675675', 'jl.kedamaian', '2020-05-11 22:31:02', NULL),
(11, 'Joni', 'L', '09845437', 'jl ', '2020-05-20 06:41:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount_barang` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_penjualan`, `id_barang`, `harga`, `qty`, `discount_barang`, `total`) VALUES
(214, 176, 15, 3000, 20, 1000, 40000),
(215, 177, 16, 15000, 5, 0, 75000),
(216, 178, 19, 4000, 5, 100, 19500),
(217, 178, 15, 3000, 1, 0, 3000),
(218, 179, 15, 3000, 1, 1, 3000),
(219, 179, 16, 15000, 1, 1, 15000),
(220, 180, 19, 4000, 1, 0, 4000),
(221, 181, 19, 4000, 40, 0, 160000),
(222, 182, 19, 4000, 5, 0, 20000),
(223, 183, 17, 2000, 10, 0, 20000),
(224, 184, 17, 2000, 10, 0, 20000),
(225, 185, 17, 2000, 10, 0, 20000),
(226, 186, 19, 4000, 9, 0, 36000);

--
-- Triggers `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `stock_min` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN 
		UPDATE barang SET stock = stock - NEW.qty
        WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `created`, `updated`) VALUES
(1, 'Makananghu', '2020-05-09 07:05:32', 2020),
(2, 'ATK', '2020-05-09 09:29:57', NULL),
(3, 'Minuman', '2020-05-11 14:38:28', NULL),
(4, 'Snack', '2020-05-12 00:42:25', NULL),
(5, 'Sampo', '2020-05-12 00:42:53', NULL),
(7, 'Elektronik', '2020-05-16 03:34:51', NULL),
(8, 'uig', '2020-05-20 13:42:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `p_id` int(11) NOT NULL,
  `invoice` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `total_harga` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `final_harga` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `note` text,
  `date` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`p_id`, `invoice`, `id_customer`, `total_harga`, `discount`, `final_harga`, `cash`, `remaining`, `note`, `date`, `id_user`, `nomor`, `created`) VALUES
(176, 'TRX/2020/05/0001', 2, 40000, 10000, 30000, 60000, 30000, '', '2020-05-19', 1, 1, '2020-05-20 01:50:04'),
(177, 'TRX/2020/05/0002', 7, 75000, 20000, 55000, 60000, 5000, '', '2020-01-19', 1, 2, '2020-05-20 02:02:22'),
(178, 'TRX/2020/05/0002', NULL, 22500, 100, 22400, 30000, 7600, '', '2020-05-20', 1, 2, '2020-05-20 13:47:40'),
(179, 'TRX/2020/05/0003', NULL, 18000, 100, 17900, 397896, 379996, '', '2020-05-20', 1, 3, '2020-05-20 13:49:12'),
(180, 'TRX/2020/05/0004', 9, 4000, 0, 4000, 22223, 18223, '', '2020-03-22', 1, 4, '2020-05-23 03:22:46'),
(181, 'TRX/2020/05/0004', 4, 160000, 100, 159900, 1000000, 840100, '', '2020-08-24', 1, 4, '2020-05-24 23:59:16'),
(182, 'TRX/2020/05/0004', 6, 20000, 0, 20000, 89999, 69999, '', '2020-05-26', 1, 4, '2020-05-27 03:34:30'),
(183, 'TRX/2020/05/0005', 6, 20000, 0, 20000, 90000, 70000, '', '2020-09-26', 1, 5, '2020-05-27 04:05:56'),
(184, 'TRX/2020/05/0005', NULL, 20000, 0, 20000, 100000, 80000, '', '2020-05-26', 1, 5, '2020-05-27 04:06:45'),
(185, 'TRX/2020/05/0006', 9, 20000, 0, 20000, 90000, 70000, '', '2020-05-26', 1, 6, '2020-05-27 04:09:43'),
(186, 'TRX/2020/05/0007', 9, 36000, 0, 36000, 90000, 54000, '', '2020-05-26', 1, 7, '2020-05-27 04:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(100) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `id_barang`, `type`, `detail`, `supplier_id`, `qty`, `date`, `created`, `user_id`) VALUES
(39, 15, 'in', 'Tambah Stok', NULL, 100, '2020-05-19', '2020-05-20 01:48:35', 0),
(40, 15, 'out', 'Expired', NULL, 50, '2020-05-19', '2020-05-20 01:49:05', 0),
(41, 16, 'in', 'Tambah Stok', NULL, 55, '2020-05-19', '2020-05-20 01:51:36', 0),
(42, 16, 'out', 'Rusak', NULL, 15, '2020-05-19', '2020-05-20 02:29:19', 0),
(43, 19, 'in', 'Tambah Stok', NULL, 100, '2020-05-20', '2020-05-20 13:44:06', 0),
(44, 19, 'in', 'Rusak', NULL, 50, '2020-05-20', '2020-05-20 13:44:33', 0),
(45, 19, 'out', 'Rusak', NULL, 100, '2020-05-20', '2020-05-20 13:45:05', 0),
(46, 17, 'in', 'Expired', NULL, 10, '2020-05-21', '2020-05-21 23:31:54', 0),
(47, 17, 'in', 'Tambah Stok', NULL, 10, '2020-05-26', '2020-05-27 03:43:30', 0),
(48, 19, 'in', 'Tambah Stok', NULL, 3, '2020-05-26', '2020-05-27 03:45:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_tlpn` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `decripsi` text,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `no_tlpn`, `alamat`, `decripsi`, `created`, `updated`) VALUES
(2, 'Toko Makanan', '97967', 'Jakarta', 'Supplier Makanan', '2020-05-11 14:36:51', '2020-05-11 09:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_tunda`
--

CREATE TABLE `transaksi_tunda` (
  `id_trans_tunda` int(11) NOT NULL,
  `no_tunda` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `nomor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_tunda`
--

INSERT INTO `transaksi_tunda` (`id_trans_tunda`, `no_tunda`, `id_user`, `tgl_transaksi`, `nomor`) VALUES
(1, 'TRX/2020/05/0001', 1, '2020-05-27', 1),
(2, 'TRX/2020/05/0002', 1, '2020-05-27', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `alamat` text,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `alamat`, `level`) VALUES
(9, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Kenda', 'Jl.Benar', 1),
(10, 'kasir', '8691e4fc53b99da544ce86e22acba62d13352eff', 'Kon', 'jl.daki', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `email_user` varchar(100) DEFAULT NULL,
  `password_user` varchar(200) DEFAULT NULL,
  `role_user` enum('admin','kasir') DEFAULT NULL,
  `first_login` tinyint(4) DEFAULT '1',
  `is_active` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `email_user`, `password_user`, `role_user`, `first_login`, `is_active`) VALUES
(1, 'Admin', 'admin@mail.com', '$2y$10$Ll6cEJ2NeUWiVBGrJj6Bl.fORLmdrLioD/qZFJM28pSVcIGcVCNzW', 'admin', 0, 1),
(9, 'Kleng', 'mefato1053@box4mls.com', '$2y$10$7QDlnlnx2iJNFQ5CNPipPOoPL/OPMuQzP34hMXQM4GCkozj6OTAV2', 'kasir', 1, 1),
(11, 'Ranus', 'ranusate19@gmail.com', '$2y$10$jJ0Ubm7sRmyYRYiwphlGouAnEIfir7EPT9CZwbjz9KcbfiUHKxmcG', 'kasir', 1, 1),
(12, 'Kleng', 'burkaroknu@enayu.com', '$2y$10$drfKngeMuR83IijwrHiQ4epYVucCBTwoPRU7AAbcEsSokHHRO6bgC', 'kasir', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `barang_ibfk_1` (`id_kategori`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `cart_ibfk_2` (`id_user`);

--
-- Indexes for table `cart_tunda`
--
ALTER TABLE `cart_tunda`
  ADD PRIMARY KEY (`id_cart_tunda`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `cart_tunda_ibfk_2` (`id_trans_tunda`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_tunda`
--
ALTER TABLE `transaksi_tunda`
  ADD PRIMARY KEY (`id_trans_tunda`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cart_tunda`
--
ALTER TABLE `cart_tunda`
  MODIFY `id_cart_tunda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_tunda`
--
ALTER TABLE `transaksi_tunda`
  MODIFY `id_trans_tunda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_tunda`
--
ALTER TABLE `cart_tunda`
  ADD CONSTRAINT `cart_tunda_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `cart_tunda_ibfk_2` FOREIGN KEY (`id_trans_tunda`) REFERENCES `transaksi_tunda` (`id_trans_tunda`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
