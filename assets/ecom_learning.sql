-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2025 at 12:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `admin_id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(5) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `gender` varchar(14) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`admin_id`, `name`, `email`, `password`, `role_id`, `status`, `gender`, `phone`, `ip`, `added_on`, `updated_on`) VALUES
(13254, 'Raj Koshta', 'admin@gmail.com', '$2y$10$f.R628oVod12gqH90zQ6QuLdtqIE0upWz0EOK70YJiBCblalHw7lS', 1, 1, 'Male', '8982222371', NULL, NULL, NULL),
(13257, 'Shubh', 'shubh@gmail.com', '$2y$10$W2VwUpixREasqYct3dF4K.xYvBRcKNdikviRlqibqhln0JMe861rO', 2, 1, 'Male', '8523697527', '::1', '2025-11-19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id` int(11) NOT NULL,
  `bann_id` int(10) DEFAULT NULL,
  `bann_image` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_banner`
--

INSERT INTO `tbl_banner` (`id`, `bann_id`, `bann_image`, `title`, `description`, `status`, `added_on`, `updated_on`) VALUES
(1, 67850, 'slider-img-11.png', 'The best tablet Collection 2023', 'Exclusive offer', 1, '19 Nov, 2025', '19 Nov, 2025');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL,
  `cart_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_qty` int(10) DEFAULT NULL,
  `selling_price` int(10) DEFAULT NULL,
  `mrp` int(10) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `category_id` int(10) DEFAULT NULL,
  `category_name` varchar(20) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `phone` int(14) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inquiry`
--

CREATE TABLE `tbl_inquiry` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `message` blob DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `recipient_name` varchar(100) DEFAULT NULL,
  `recipient_email` varchar(100) DEFAULT NULL,
  `recipient_phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `delivery_charges` int(10) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `payment_mode` varchar(50) DEFAULT NULL,
  `delivery_date` varchar(30) DEFAULT NULL,
  `order_date` varchar(30) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `order_status` int(5) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_products`
--

CREATE TABLE `tbl_order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(10) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_main_image` varchar(255) DEFAULT NULL,
  `product_qty` int(10) DEFAULT NULL,
  `product_selling_price` int(10) DEFAULT NULL,
  `product_mrp` int(10) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `product_id` int(10) DEFAULT NULL,
  `category` int(10) DEFAULT NULL,
  `sub_category` int(10) DEFAULT NULL,
  `product_name` text DEFAULT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `highlights` text DEFAULT NULL,
  `description` blob DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `product_main_image` varchar(255) DEFAULT NULL,
  `gallary_image` varchar(255) DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `mrp` int(50) DEFAULT NULL,
  `selling_price` int(50) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `role_id` int(5) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`role_id`, `role_name`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Co-Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_access_controls`
--

CREATE TABLE `tbl_role_access_controls` (
  `id` int(11) NOT NULL,
  `admin_id` int(5) NOT NULL,
  `all_products_list` int(5) NOT NULL DEFAULT 0,
  `add_product` int(5) NOT NULL DEFAULT 0,
  `active_products` int(5) NOT NULL DEFAULT 0,
  `inactive_products` int(5) NOT NULL DEFAULT 0,
  `oos_products` int(5) NOT NULL DEFAULT 0,
  `all_category_list` int(5) NOT NULL DEFAULT 0,
  `add_category` int(5) NOT NULL DEFAULT 0,
  `active_category` int(5) NOT NULL DEFAULT 0,
  `inactive_category` int(5) NOT NULL DEFAULT 0,
  `all_orders_list` int(5) NOT NULL DEFAULT 0,
  `pending_orders` int(5) NOT NULL DEFAULT 0,
  `completed_orders` int(5) NOT NULL DEFAULT 0,
  `cancelled_orders` int(5) NOT NULL DEFAULT 0,
  `today_placed_orders` int(5) NOT NULL DEFAULT 0,
  `all_inquiry_list` int(5) NOT NULL DEFAULT 0,
  `open_inquiries` int(5) NOT NULL DEFAULT 0,
  `closed_inquiries` int(5) NOT NULL DEFAULT 0,
  `pincode` int(5) NOT NULL DEFAULT 0,
  `banner` int(5) NOT NULL DEFAULT 0,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_role_access_controls`
--

INSERT INTO `tbl_role_access_controls` (`id`, `admin_id`, `all_products_list`, `add_product`, `active_products`, `inactive_products`, `oos_products`, `all_category_list`, `add_category`, `active_category`, `inactive_category`, `all_orders_list`, `pending_orders`, `completed_orders`, `cancelled_orders`, `today_placed_orders`, `all_inquiry_list`, `open_inquiries`, `closed_inquiries`, `pincode`, `banner`, `added_on`, `updated_on`) VALUES
(2, 13257, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2025-11-19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `ip` varchar(40) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `wishlist_id` int(10) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` int(100) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_products`
--
ALTER TABLE `tbl_order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_role_access_controls`
--
ALTER TABLE `tbl_role_access_controls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13258;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order_products`
--
ALTER TABLE `tbl_order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_role_access_controls`
--
ALTER TABLE `tbl_role_access_controls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
