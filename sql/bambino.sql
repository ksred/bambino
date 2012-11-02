-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2012 at 03:25 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `name`, `contact_number`, `contact_email`, `delivery_address`, `date`) VALUES
(1, 1, 'FTFD', 123, 'ftfd@metal.com', 'For\nThe\nFallen\nDreams', '2012-11-02 11:47:27'),
(2, 1, 'Sakura', 12345678, 'saku@ra.com', 'Sakura\nCherry Blossom\nWorld', '2012-11-02 12:11:34');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customers_orders`
--

INSERT INTO `customers_orders` (`id`, `user_id`, `customer_id`, `order_id`, `date`) VALUES
(1, 1, 1, 8, '2012-11-02 11:51:18'),
(2, 1, 1, 9, '2012-11-02 11:52:48'),
(3, 1, 1, 10, '2012-11-02 11:53:09'),
(4, 1, 1, 12, '2012-11-02 11:53:21'),
(5, 1, 1, 13, '2012-11-02 11:53:27'),
(6, 1, 1, 15, '2012-11-02 11:54:38'),
(7, 1, 1, 16, '2012-11-02 12:00:22'),
(8, 1, 1, 1, '2012-11-02 12:03:22'),
(9, 1, 2, 2, '2012-11-02 12:11:56');

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
  `stock_id` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_id`, `stock_id`, `description`, `supplier_id`, `date`) VALUES
(1, 1, 'it001', 'First item yo', 2, '2012-11-02 12:02:51'),
(2, 1, 'it002', 'Yosh', 3, '2012-11-02 12:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `items_meta`
--

CREATE TABLE IF NOT EXISTS `items_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_id` varchar(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `orders_items_id` int(11) NOT NULL,
  `details` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `retail` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `items_meta`
--

INSERT INTO `items_meta` (`id`, `user_id`, `item_id`, `stock_id`, `order_id`, `orders_items_id`, `details`, `quantity`, `cost`, `retail`, `date`) VALUES
(1, 1, 1, 'it001', 1, 1, 'size L', 0, 0, 0, '2012-11-02 12:03:21'),
(2, 1, 2, 'it002', 1, 2, '(none)', 0, 0, 0, '2012-11-02 12:03:22'),
(3, 1, 1, 'it001', 2, 3, 'Size M', 0, 0, 0, '2012-11-02 12:11:56'),
(4, 1, 2, 'it002', 2, 4, '(none)', 0, 0, 0, '2012-11-02 12:11:56');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `site_order_id`, `user_id`, `status`, `date`) VALUES
(1, 'tr001', 1, 1, '2012-11-02 12:03:21'),
(2, 'tr002', 1, 2, '2012-11-02 12:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE IF NOT EXISTS `orders_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `user_id`, `order_id`, `item_id`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 2, 1),
(4, 1, 2, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `orders_notes`
--

INSERT INTO `orders_notes` (`id`, `user_id`, `order_id`, `note`, `date`) VALUES
(1, 1, 1, 'wanna be free', '2012-11-02 12:03:22'),
(2, 1, 2, 'tester heyo', '2012-11-02 12:11:56');

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
(2, 'Delivered', 1),
(3, 'Sent', 1),
(4, 'Received', 1),
(5, 'Cancelled', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `user_id`, `name`, `contact_name`, `contact_email`, `date`) VALUES
(2, 1, 'Beacon', 'Day', 'beacon@day.con', '2012-10-30 18:05:40'),
(3, 1, 'Last Night', 'A person', 'last@night.com', '2012-11-02 07:45:15');

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
