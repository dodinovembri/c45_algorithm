-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Aug 29, 2019 at 09:07 AM
-- Server version: 10.3.13-MariaDB-1:10.3.13+maria~bionic
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fenty`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_nav_menu`
--

CREATE TABLE `app_nav_menu` (
  `nav_menu_id` int(11) NOT NULL,
  `nav_menu_name` varchar(128) NOT NULL,
  `nav_menu_location` varchar(128) NOT NULL,
  `nav_menu_sort` int(11) NOT NULL,
  `nav_menu_icon` varchar(128) NOT NULL,
  `nav_menu_module` varchar(64) NOT NULL,
  `nav_menu_link` varchar(128) NOT NULL,
  `nav_menu_parent_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_nav_menu`
--

INSERT INTO `app_nav_menu` (`nav_menu_id`, `nav_menu_name`, `nav_menu_location`, `nav_menu_sort`, `nav_menu_icon`, `nav_menu_module`, `nav_menu_link`, `nav_menu_parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'sidebar_admin_menu', 0, 'fa fa-dashboard', 'dashboard', 'dashboard', 0, '2018-10-02 20:36:32', '2018-10-02 20:36:32'),
(4, 'Pegawai', 'sidebar_admin_menu', 3, 'fa fa-users', 'users', '#', 0, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(13, 'Data Pegawai', 'sidebar_admin_menu', 0, 'fa fa-circle-o', 'users', 'users', 4, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(14, 'Tambah Pegawai', 'sidebar_admin_menu', 1, 'fa fa-circle-o', 'users', 'users/add', 4, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(15, 'Jabatan', 'sidebar_admin_menu', 1, 'fa fa-circle-o', 'users', 'users/groups', 4, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(16, 'Tambah Jabatan', 'sidebar_admin_menu', 1, 'fa fa-circle-o', 'users', 'users/groups/add', 4, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(17, 'Departure', 'sidebar_admin_menu', 0, 'fa fa-circle-o', 'departures', 'departures', 0, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(19, 'Arrival', 'sidebar_admin_menu', 0, 'fa fa-circle-o', 'arrivals', 'arrivals', 0, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(23, 'Impor Pegawai', 'sidebar_admin_menu', 0, 'fa fa-circle-o', 'users', 'users/import', 4, '2018-10-03 10:29:50', '2018-10-03 10:29:50'),
(24, 'Delay Check', 'sidebar_admin_menu', 0, 'fa fa-list', 'delay_check', 'delay_check', 0, '2018-10-02 20:36:32', '2018-10-02 20:36:32'),
(25, 'Laporan', 'sidebar_admin_menu', 0, 'fa fa-list', 'laporan', 'laporan', 0, '2018-10-02 20:36:32', '2018-10-02 20:36:32'),
(26, 'Data Penerbangan', 'sidebar_admin_menu', 0, 'fa fa-list', 'data', 'data', 0, '2018-10-02 20:36:32', '2018-10-02 20:36:32'),
(27, 'Laporan Terbanyak', 'sidebar_admin_menu', 3, 'fa fa-list', 'laporan_terbanyak', 'laporan_terbanyak', 0, '2018-10-03 10:29:50', '2018-10-03 10:29:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_nav_menu`
--
ALTER TABLE `app_nav_menu`
  ADD PRIMARY KEY (`nav_menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_nav_menu`
--
ALTER TABLE `app_nav_menu`
  MODIFY `nav_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
