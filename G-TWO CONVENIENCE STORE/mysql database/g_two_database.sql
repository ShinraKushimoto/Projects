-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 08:10 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g_two_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_list`
--

CREATE TABLE `customer_list` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(50) DEFAULT NULL,
  `customer_email` varchar(50) DEFAULT NULL,
  `customer_address` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_list`
--

INSERT INTO `customer_list` (`customer_id`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Michael', '09098064199', 'michael@gmail.com', 'Carmen, Davao del Norte');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_item_list`
--

CREATE TABLE `delivery_item_list` (
  `delivery_prod_id` int(11) NOT NULL,
  `delivery_prod_sku` varchar(50) NOT NULL,
  `delivery_prod_desc` varchar(150) NOT NULL,
  `delivery_prod_cost` decimal(7,2) NOT NULL,
  `delivery_prod_unit` int(11) NOT NULL,
  `delivery_tot_cost` decimal(7,2) NOT NULL,
  `supplier_order_num` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_item_list`
--

INSERT INTO `delivery_item_list` (`delivery_prod_id`, `delivery_prod_sku`, `delivery_prod_desc`, `delivery_prod_cost`, `delivery_prod_unit`, `delivery_tot_cost`, `supplier_order_num`) VALUES
(1, 'P001', 'Instant noodles (Payless Beef 55g)', '25.00', 5, '125.00', '001'),
(4, 'P002', 'Canned sardines (Mega 155g)', '10.00', 10, '100.00', '001'),
(5, 'P003', 'Canned corned beef (Argentina 175g)', '10.00', 20, '200.00', '001');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `total` double NOT NULL,
  `date_purchase` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `customer`, `total`, `date_purchase`) VALUES
(1, 'Michael', 35, '2023-01-06 02:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_detail`
--

CREATE TABLE `purchase_detail` (
  `pdid` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_detail`
--

INSERT INTO `purchase_detail` (`pdid`, `purchase_id`, `prod_id`, `quantity`) VALUES
(1, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `store_prod_inventory`
--

CREATE TABLE `store_prod_inventory` (
  `prod_id` int(11) NOT NULL,
  `prod_sku` varchar(15) NOT NULL,
  `prod_desc` varchar(150) NOT NULL,
  `prod_status` varchar(15) NOT NULL,
  `prod_price` decimal(7,2) NOT NULL,
  `prod_quant` int(11) NOT NULL,
  `prod_total_amount` decimal(7,2) NOT NULL,
  `prod_date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prod_date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_prod_inventory`
--

INSERT INTO `store_prod_inventory` (`prod_id`, `prod_sku`, `prod_desc`, `prod_status`, `prod_price`, `prod_quant`, `prod_total_amount`, `prod_date_added`, `prod_date_updated`) VALUES
(1, 'P001', 'Instant noodles (Payless Beef 55g)', 'In Stock', '7.00', 1000, '7000.00', '2023-02-01 12:32:00', '2023-02-01 12:32:00'),
(2, 'P002', 'Canned sardines (Mega 155g)', 'In Stock', '20.00', 1000, '20000.00', '2023-02-01 12:32:00', '2023-02-01 12:32:00'),
(3, 'P003', 'Canned corned beef (Argentina 175g)', 'In Stock', '38.00', 1000, '38000.00', '2023-02-01 12:32:00', '2023-02-01 12:32:00'),
(4, 'P004', 'Canned meat loaf (Argentina 150g)', 'In Stock', '21.00', 1000, '21000.00', '2023-02-01 12:32:00', '2023-02-01 12:32:00'),
(5, 'P005', 'Canned sausage (CDO 70g)', 'In Stock', '23.00', 1000, '23000.00', '2023-02-01 12:32:00', '2023-02-01 12:32:00'),
(6, 'P006', 'Loaf bread', 'In Stock', '60.00', 1000, '60000.00', '2023-02-01 12:32:00', '2023-02-01 12:32:00'),
(7, 'P007', 'Canned tuna (Century 180g)', 'In Stock', '37.00', 1000, '37000.00', '2023-02-01 12:32:00', '2023-02-01 12:32:00'),
(8, 'P008', 'Canned pineapple (Dole 822g)', 'In Stock', '90.00', 1000, '90000.00', '2023-02-01 12:32:00', '2023-02-01 12:32:00'),
(9, 'P009', 'Eggs (free range large)', 'In Stock', '8.00', 1000, '8000.00', '2023-02-01 12:32:00', '2023-02-01 12:32:00'),
(10, 'P010', 'Instant coffee (Kopiko 10x27.5g)', 'In Stock', '70.00', 1000, '70000.00', '2023-02-01 12:32:00', '2023-02-01 12:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `store_users`
--

CREATE TABLE `store_users` (
  `user_id` int(11) NOT NULL,
  `user_num` varchar(50) NOT NULL,
  `username` varchar(150) NOT NULL,
  `user_pass` varchar(150) NOT NULL,
  `user_fname` varchar(150) NOT NULL,
  `user_lname` varchar(150) NOT NULL,
  `user_age` int(3) NOT NULL,
  `user_bdate` date NOT NULL,
  `user_address` varchar(250) NOT NULL,
  `user_position` varchar(20) NOT NULL,
  `user_shift` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_users`
--

INSERT INTO `store_users` (`user_id`, `user_num`, `username`, `user_pass`, `user_fname`, `user_lname`, `user_age`, `user_bdate`, `user_address`, `user_position`, `user_shift`) VALUES
(1, 'U001', 'michael', '12345', 'Michael', 'Belleza', 21, '2022-11-29', 'Carmen, Davao del Norte', 'Admin', NULL),
(2, 'U002', 'Jhimboy', '12345', 'Jhimboy', 'Bulay-og', 21, '2023-01-11', 'Panabo City', 'Manager', NULL),
(3, 'U003', 'Nathaniel', '12345', 'Nathaniel', 'Buala', 21, '2022-10-06', 'Carmen, Davao del Norte', 'Cashier', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(150) NOT NULL,
  `supplier_contact` varchar(50) NOT NULL,
  `supplier_email` varchar(150) NOT NULL,
  `supplier_address` varchar(150) NOT NULL,
  `supplier_del_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `supplier_del_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `supplier_del_status` varchar(100) NOT NULL,
  `supplier_order_num` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier_list`
--

INSERT INTO `supplier_list` (`supplier_id`, `supplier_name`, `supplier_contact`, `supplier_email`, `supplier_address`, `supplier_del_date`, `supplier_del_update`, `supplier_del_status`, `supplier_order_num`) VALUES
(1, 'Walmart', '666', 'Warlmart@gmail.com', 'USA', '2023-01-03 04:15:49', '2023-01-03 04:15:49', 'In-Transit', '001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_list`
--
ALTER TABLE `customer_list`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `delivery_item_list`
--
ALTER TABLE `delivery_item_list`
  ADD PRIMARY KEY (`delivery_prod_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD PRIMARY KEY (`pdid`);

--
-- Indexes for table `store_prod_inventory`
--
ALTER TABLE `store_prod_inventory`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `store_users`
--
ALTER TABLE `store_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_order_num` (`supplier_order_num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_list`
--
ALTER TABLE `customer_list`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_item_list`
--
ALTER TABLE `delivery_item_list`
  MODIFY `delivery_prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_detail`
--
ALTER TABLE `purchase_detail`
  MODIFY `pdid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store_prod_inventory`
--
ALTER TABLE `store_prod_inventory`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `store_users`
--
ALTER TABLE `store_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
