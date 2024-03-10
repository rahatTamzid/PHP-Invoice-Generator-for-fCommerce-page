-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 04:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoiceninja`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_number` varchar(20) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `customer_address` varchar(60) NOT NULL,
  `customer_phone` int(20) NOT NULL,
  `total_bill` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_number`, `customer_name`, `customer_address`, `customer_phone`, `total_bill`, `date`) VALUES
('INV-1709934842576', 'Rahat', 'zbv', 21554, 580, '2024-03-08'),
('INV-1709935019953', 'rahatttt', 'dfgsd', 21554, 280, '2024-03-08'),
('INV-1709935223345', 'test', 'sdfgh', 21554, 380, '2024-03-08'),
('INV-9324-6246', 'Rahat', 'dfgsdfg', 21554, 380, '2024-03-08'),
('INV-9324-3023', 'asrgf', 'asdgf', 21554, 460, '2024-03-08'),
('INV-9324-4800', 'Rahat', 'zsdfgsdfg', 21554, 460, '2024-03-08'),
('INV-9324-7218', 'Rahat', 'sdfghsdfh', 21554, 460, '2024-03-08'),
('INV-9324-3739', 'Rahat', 'sdfg', 21554, 360, '2024-03-08'),
('INV-9324-1992', 'Rahat', 'Taltola Dhaka 12307', 1521731871, 360, '2024-03-09'),
('INV-9324-6347', 'Rahat', 'Taltola', 1521731871, 760, '2024-03-09'),
('INV-9324-7965', 'rahaT', 'sdfghsh', 4848, 460, '2024-03-09'),
('INV-9324-7455', 'Rahat', 'sdfghdfg', 46454545, 800, '2024-03-09'),
('INV-9324-7285', 'Rahat', 'sdrhgsdfgh', 2147483647, 500, '2024-03-09'),
('INV-9324-1372', 'Rahat', 'sdfgsdfhg', 45451, 500, '2024-03-09'),
('INV-9324-1050', 'sdth', 'sdfh', 55, 460, '2024-03-09'),
('INV-9324-7222', 'Rahat', 'sdfh', 45564, 360, '2024-03-09'),
('INV-9324-9244', 'Rahat', 'Taltola', 1521731871, 760, '2024-03-09'),
('INV-9324-2032', 'Rahat', 'sdfhsdfgh', 45541, 1000, '2024-03-09'),
('INV-9324-1190', 'Rahat', 'Taltola', 1521731871, 660, '2024-03-09'),
('INV-9324-6842', 'Rahat', 'Taltola', 1521731871, 960, '2024-03-09'),
('INV-9324-2468', 'Rahat', 'Taltola', 1521731871, 1040, '2024-03-09'),
('INV-9324-8266', 'Emon', 'Kazipara', 1521731871, 1000, '2024-03-09'),
('INV-9324-6782', 'Emon Draft', 'UDDIPAN House no. 09, Road no - 01, Janata co- operative hou', 1671692340, 1040, '2024-03-09'),
('INV-10324-8415', 'Emon', 'sdfg', 41, 340, '2024-03-09'),
('INV-10324-2405', 'Rahgat', 'sdfg', 515454, 340, '2024-03-09'),
('INV-10324-2379', '', '', 0, 600, '2024-03-09'),
('INV-10324-2966', 'Emon', 'asdg', 15745265, 440, '2024-03-09'),
('INV-10324-8552', 'Rahat ', 'UDDIPAN House no. 09, Road no - 01, Janata co- operative hou', 1671692340, 1060, '2024-03-09'),
('INV-10324-6752', 'Rahat', '', 1671692340, 1000, '2024-03-09'),
('INV-10324-3309', 'Rahat', 'UDDIPAN House no. 09, Road no - 01, Janata co- operative hou', 48114, 1240, '2024-03-09'),
('INV-10324-3444', 'Rahat', 'UDDIPAN House no. 09, Road no - 01, Janata co- operative hou', 1521731871, 600, '2024-03-09'),
('INV-10324-2963', 'Rahat', '46547asdgsadfgsdfg', 8585, 260, '2024-03-09'),
('INV-10324-6855', 'sdhgsdh', 'sdfhsdfh', 4224, 260, '2024-03-09'),
('INV-10324-6610', 'sdfhg', '4141', 1, 460, '2024-03-09'),
('INV-10324-3403', 'Rassdfh', 'sdfhsdh', 444, 1540, '2024-03-09'),
('INV-10324-6436', 'sdg', 'sdfg', 5, 360, '2024-03-09'),
('INV-10324-3353', 'dghsdf', 'sdfhgsdfhg', 544545, 440, '2024-03-09'),
('INV-10324-5319', 'adfgsd', 'sdfg', 8114, 360, '2024-03-09'),
('INV-10324-2684', 'Rahat', 'sdfh', 15456, 340, '2024-03-09'),
('INV-10324-3576', 'Rahat', '45445', 4541, 90, '2024-03-09'),
('INV-10324-1466', '', '', 0, 230, '2024-03-09'),
('INV-10324-1624', '', '', 0, 330, '2024-03-09'),
('INV-10324-6785', '', '', 0, 330, '2024-03-09'),
('INV-10324-5833', 'Rahat', 'UDDIPAN House no. 09, Road no - 01, Janata co- operative hou', 1521731871, 400, '2024-03-09'),
('INV-10324-4772', 'Rahat', 'UDDIPAN House no. 09, Road no - 01, Janata co- operative hou', 2147483647, 400, '2024-03-09'),
('INV-10324-7433', 'fghgdsfh', 'sdfhgs', 645465, 270, '2024-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(5) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `product_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`) VALUES
(1, 'Koti - Pink', 200),
(3, 'Table Mini', 150),
(5, 'Mobile', 150);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shopid` int(5) NOT NULL,
  `shopname` varchar(20) NOT NULL,
  `shopaddress` varchar(30) NOT NULL,
  `shopnumber` int(15) NOT NULL,
  `currierid` int(15) NOT NULL,
  `shoplogo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shopid`, `shopname`, `shopaddress`, `shopnumber`, `currierid`, `shoplogo`) VALUES
(12, 'Rongdhunu Shopping', 'Mirpur,Kazipara,Dhaka 6666', 1743761636, 1058630, 'uploads/rongdhonu_logo.jpg'),
(13, 'Al-Qaf', 'Mirpur, Kazipara , Singapore', 1743761636, 23650, 'uploads/al-qaf_logo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shopid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shopid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
