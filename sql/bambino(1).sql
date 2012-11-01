-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2012 at 07:16 AM
-- Server version: 5.5.24
-- PHP Version: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bambino`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `delivery_address` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `name`, `contact_number`, `contact_email`, `delivery_address`, `date`) VALUES
(3, 1, 'Sakura', 855556789, 'sakura@naruto.com', 'Wild Cherry Blossom\nLeaf Village\nNarutoVille', '2012-10-30 15:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `customers_orders`
--

CREATE TABLE IF NOT EXISTS `customers_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customers_orders`
--

INSERT INTO `customers_orders` (`id`, `user_id`, `customer_id`, `order_id`, `date`) VALUES
(1, 1, 1, 1, '2012-10-27 21:54:55'),
(2, 1, 2, 2, '2012-10-27 21:55:09'),
(3, 1, 2, 3, '2012-10-27 23:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `emails_config`
--

CREATE TABLE IF NOT EXISTS `emails_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reply_to` varchar(50) NOT NULL,
  `theme` int(11) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `emails_theme`
--

CREATE TABLE IF NOT EXISTS `emails_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `header_colour` varchar(10) NOT NULL,
  `font_size` int(11) NOT NULL,
  `font_family` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_order_id` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `site_order_id`, `user_id`, `status`, `date`) VALUES
(1, 'TR001', 1, 4, '2012-10-27 19:12:48'),
(2, 'TR002', 1, 1, '2012-10-27 19:16:26'),
(3, 'TR007', 1, 4, '2012-10-27 23:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE IF NOT EXISTS `orders_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_code` varchar(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost_price` float NOT NULL,
  `retail_price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `user_id`, `order_id`, `item_code`, `description`, `quantity`, `cost_price`, `retail_price`) VALUES
(1, 1, 1, 'test', 'desc', 1, 999.1, 9999.1),
(2, 1, 2, 'test', 'desc', 1, 999.1, 9999.1),
(3, 1, 3, 'ht007', 'Hitec secret', 1, 199.9, 299.9),
(4, 1, 3, 'ht009', 'Super secret agent party', 2, 899.9, 1999.9);

-- --------------------------------------------------------

--
-- Table structure for table `orders_notes`
--

CREATE TABLE IF NOT EXISTS `orders_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `note` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `orders_notes`
--

INSERT INTO `orders_notes` (`id`, `user_id`, `order_id`, `note`, `date`) VALUES
(1, 1, 1, 'This is a test for notes', '2012-10-27 19:12:48'),
(2, 1, 2, 'This is a test for notes', '2012-10-27 19:16:26'),
(3, 1, 3, 'Yo another test', '2012-10-27 23:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE IF NOT EXISTS `orders_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `orders_status`
--

INSERT INTO `orders_status` (`id`, `status`, `user_id`) VALUES
(1, 'Pending', 1),
(2, 'Ordered', 1),
(3, 'Received', 1),
(4, 'Sent', 1),
(5, 'Delivered', 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `user_id`, `name`, `contact_name`, `contact_email`, `date`) VALUES
(2, 1, 'Beacon', 'Day', 'beacon@day.con', '2012-10-30 18:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `description`, `email`, `password`, `date`) VALUES
(1, 'Trailrunner', 'Online shop', 'info@trailrunner.co.za', '20f6ac3f854879e54fca9fb6c64a3f1d', '2012-10-27 14:59:23');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
