-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 09, 2011 at 02:50 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.5

SET FOREIGN_KEY_CHECKS=0;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

SET AUTOCOMMIT=0;
START TRANSACTION;

-- 
-- Database: `fifo`
-- 
DROP DATABASE IF EXISTS `fifo`;
CREATE DATABASE `fifo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fifo`;

-- --------------------------------------------------------

-- 
-- Table structure for table `processes`
-- 

DROP TABLE IF EXISTS `processes`;
CREATE TABLE IF NOT EXISTS `processes` (
  `processId` int(12) NOT NULL auto_increment,
  `process_name` varchar(10) NOT NULL default 'Unknown',
  `arrival_time` datetime default '0000-00-00 00:00:00',
  `cpu_burst_time` int(10) NOT NULL default '0',
  `status` varchar(20) NOT NULL default 'Unknown',
  `start_time` datetime default '0000-00-00 00:00:00',
  `end_time` datetime default '0000-00-00 00:00:00',
  `abort_rem_time` int(10) NOT NULL default '0',
  `arrage_order` int(10) NOT NULL default '0',
  `waiting_time` int(10) NOT NULL default '0',
  `turn_around_time` int(10) NOT NULL default '0',
  PRIMARY KEY  (`processId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `processes`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `statistics`
-- 

DROP TABLE IF EXISTS `statistics`;
CREATE TABLE IF NOT EXISTS `statistics` (
  `avgId` int(12) NOT NULL auto_increment,
  `no_processes` varchar(10) NOT NULL default 'Unknown',
  `avg_arrival_time` datetime default '0000-00-00 00:00:00',
  `avg_cpu_burst_time` int(10) NOT NULL default '0',
  `avg_status` varchar(20) NOT NULL default 'Unknown',
  `avg_start_time` datetime default '0000-00-00 00:00:00',
  `avg_end_time` datetime default '0000-00-00 00:00:00',
  `avg_waiting_time` int(10) NOT NULL default '0',
  `avg_turn_around_time` int(10) NOT NULL default '0',
  `avg_arrage_order` varchar(20) NOT NULL default 'arrage_order',
  PRIMARY KEY  (`avgId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `statistics`
-- 

INSERT INTO `statistics` (`avgId`, `no_processes`, `avg_arrival_time`, `avg_cpu_burst_time`, `avg_status`, `avg_start_time`, `avg_end_time`, `avg_waiting_time`, `avg_turn_around_time`, `avg_arrage_order`) VALUES 
(1, '7', '0000-00-00 00:00:00', 0, 'Unknown', '2011-09-07 02:40:49', '2011-09-07 02:41:41', 20, 26, 'arrage_order');

SET FOREIGN_KEY_CHECKS=1;

COMMIT;
