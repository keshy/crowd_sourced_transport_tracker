-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2011 at 02:51 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rhokatl`
--
CREATE DATABASE `rhokatl` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rhokatl`;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `direction` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `direction`) VALUES
(19, '19', 2),
(26, '26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sightings`
--

CREATE TABLE IF NOT EXISTS `sightings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sightings`
--


-- --------------------------------------------------------

--
-- Table structure for table `stoplist`
--

CREATE TABLE IF NOT EXISTS `stoplist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `r_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `stoplist`
--

INSERT INTO `stoplist` (`id`, `r_id`, `s_id`, `order`, `time`) VALUES
(1, 19, 4, 1, 0),
(2, 19, 5, 2, 6),
(3, 19, 6, 3, 6),
(4, 19, 7, 4, 8),
(5, 19, 8, 5, 12),
(6, 26, 9, 1, 0),
(7, 26, 10, 2, 5),
(8, 26, 11, 3, 10),
(9, 26, 12, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `stops`
--

CREATE TABLE IF NOT EXISTS `stops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(6) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lat` varchar(10) DEFAULT NULL,
  `long` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `stops`
--

INSERT INTO `stops` (`id`, `symbol`, `name`, `lat`, `long`) VALUES
(4, 'CIND', 'Clairmont & North Decatur', '33.822', '-84.4300'),
(5, 'VAHo', 'VA Hospital', '33.7954', '-84.3203'),
(6, 'CILV', 'Clairmont & LaVista', '33.8205', '-84.3040'),
(7, 'ClBu', 'Clairmont & Buford', '33.8534', '-84.3119'),
(8, 'ChSE', 'Chamblee Station East Bus Bay', '33.8884', '-84.3040'),
(9, 'PeHe', 'Perry Heights', '33.796', '-84.447'),
(10, 'CaHi', 'Carver Hills', '33.7998', '-84.4605'),
(11, 'BaSt', 'Bankhead Station', '33.7722', '-84.4286'),
(12, 'NASt', 'North Ave Station', '33.7719', '-84.3874');
