-- phpMyAdmin SQL Dump
-- version 3.3.7deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2010 at 07:21 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `latentflip_zappa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calls`
--

CREATE TABLE IF NOT EXISTS `tbl_calls` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(10) COLLATE utf8_unicode_ci,
  `news` boolean NOT NULL,
  `joke` boolean NOT NULL,
  `closing message` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Dumping data for table `tbl_calls`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_queue`
--

CREATE TABLE IF NOT EXISTS `tbl_job_queue` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `call_id` int(10) NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `call_id_2` (`call_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `tbl_job_queue`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_timezone`
--

CREATE TABLE IF NOT EXISTS `tbl_timezone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `php` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=76 ;

--
-- Dumping data for table `tbl_timezone`
--

INSERT INTO `tbl_timezone` (`id`, `php`, `label`) VALUES
(1, 'Etc/GMT+12', '(GMT-12:00) International Date Line West'),
(2, 'Pacific/Apia', '(GMT-11:00) Midway Island, Samoa'),
(3, 'Pacific/Honolulu', '(GMT-10:00) Hawaii'),
(4, 'America/Anchorage', '(GMT-09:00) Alaska'),
(5, 'America/Los_Angeles', '(GMT-08:00) Pacific Time (US & Canada); Tijuana'),
(6, 'America/Phoenix', '(GMT-07:00) Arizona'),
(7, 'America/Denver', '(GMT-07:00) Mountain Time (US & Canada)'),
(8, 'America/Chihuahua', '(GMT-07:00) Chihuahua, La Paz, Mazatlan'),
(9, 'America/Managua', '(GMT-06:00) Central America'),
(10, 'America/Regina', '(GMT-06:00) Saskatchewan'),
(11, 'America/Mexico_City', '(GMT-06:00) Guadalajara, Mexico City, Monterrey'),
(12, 'America/Chicago', '(GMT-06:00) Central Time (US & Canada)'),
(13, 'America/Indianapolis', '(GMT-05:00) Indiana (East)'),
(14, 'America/Bogota', '(GMT-05:00) Bogota, Lima, Quito'),
(15, 'America/New_York', '(GMT-05:00) Eastern Time (US & Canada)'),
(16, 'America/Caracas', '(GMT-04:00) Caracas, La Paz'),
(17, 'America/Santiago', '(GMT-04:00) Santiago'),
(18, 'America/Halifax', '(GMT-04:00) Atlantic Time (Canada)'),
(19, 'America/St_Johns', '(GMT-03:30) Newfoundland'),
(20, 'America/Buenos_Aires', '(GMT-03:00) Buenos Aires, Georgetown'),
(21, 'America/Godthab', '(GMT-03:00) Greenland'),
(22, 'America/Sao_Paulo', '(GMT-03:00) Brasilia'),
(23, 'America/Noronha', '(GMT-02:00) Mid-Atlantic'),
(24, 'Atlantic/Cape_Verde', '(GMT-01:00) Cape Verde Is.'),
(25, 'Atlantic/Azores', '(GMT-01:00) Azores'),
(26, 'Africa/Casablanca', '(GMT) Casablanca, Monrovia'),
(27, 'Europe/London', '(GMT) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London'),
(28, 'Africa/Lagos', '(GMT+01:00) West Central Africa'),
(29, 'Europe/Berlin', '(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna'),
(30, 'Europe/Paris', '(GMT+01:00) Brussels, Copenhagen, Madrid, Paris'),
(31, 'Europe/Sarajevo', '(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb'),
(32, 'Europe/Belgrade', '(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague'),
(33, 'Africa/Johannesburg', '(GMT+02:00) Harare, Pretoria'),
(34, 'Asia/Jerusalem', '(GMT+02:00) Jerusalem'),
(35, 'Europe/Istanbul', '(GMT+02:00) Athens, Istanbul, Minsk'),
(36, 'Europe/Helsinki', '(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius'),
(37, 'Africa/Cairo', '(GMT+02:00) Cairo'),
(38, 'Europe/Bucharest', '(GMT+02:00) Bucharest'),
(39, 'Africa/Nairobi', '(GMT+03:00) Nairobi'),
(40, 'Asia/Riyadh', '(GMT+03:00) Kuwait, Riyadh'),
(41, 'Europe/Moscow', '(GMT+03:00) Moscow, St. Petersburg, Volgograd'),
(42, 'Asia/Baghdad', '(GMT+03:00) Baghdad'),
(43, 'Asia/Tehran', '(GMT+03:30) Tehran'),
(44, 'Asia/Muscat', '(GMT+04:00) Abu Dhabi, Muscat'),
(45, 'Asia/Tbilisi', '(GMT+04:00) Baku, Tbilisi, Yerevan'),
(46, 'Asia/Kabul', '(GMT+04:30) Kabul'),
(47, 'Asia/Karachi', '(GMT+05:00) Islamabad, Karachi, Tashkent'),
(48, 'Asia/Yekaterinburg', '(GMT+05:00) Ekaterinburg'),
(49, 'Asia/Calcutta', '(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi'),
(50, 'Asia/Katmandu', '(GMT+05:45) Kathmandu'),
(51, 'Asia/Colombo', '(GMT+06:00) Sri Jayawardenepura'),
(52, 'Asia/Dhaka', '(GMT+06:00) Astana, Dhaka'),
(53, 'Asia/Novosibirsk', '(GMT+06:00) Almaty, Novosibirsk'),
(54, 'Asia/Rangoon', '(GMT+06:30) Rangoon'),
(55, 'Asia/Bangkok', '(GMT+07:00) Bangkok, Hanoi, Jakarta'),
(56, 'Asia/Krasnoyarsk', '(GMT+07:00) Krasnoyarsk'),
(57, 'Australia/Perth', '(GMT+08:00) Perth'),
(58, 'Asia/Taipei', '(GMT+08:00) Taipei'),
(59, 'Asia/Singapore', '(GMT+08:00) Kuala Lumpur, Singapore'),
(60, 'Asia/Hong_Kong', '(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi'),
(61, 'Asia/Irkutsk', '(GMT+08:00) Irkutsk, Ulaan Bataar'),
(62, 'Asia/Tokyo', '(GMT+09:00) Osaka, Sapporo, Tokyo'),
(63, 'Asia/Seoul', '(GMT+09:00) Seoul'),
(64, 'Asia/Yakutsk', '(GMT+09:00) Yakutsk'),
(65, 'Australia/Darwin', '(GMT+09:30) Darwin'),
(66, 'Australia/Adelaide', '(GMT+09:30) Adelaide'),
(67, 'Pacific/Guam', '(GMT+10:00) Guam, Port Moresby'),
(68, 'Australia/Brisbane', '(GMT+10:00) Brisbane'),
(69, 'Asia/Vladivostok', '(GMT+10:00) Vladivostok'),
(70, 'Australia/Hobart', '(GMT+10:00) Hobart'),
(71, 'Australia/Sydney', '(GMT+10:00) Canberra, Melbourne, Sydney'),
(72, 'Asia/Magadan', '(GMT+11:00) Magadan, Solomon Is., New Caledonia'),
(73, 'Pacific/Fiji', '(GMT+12:00) Fiji, Kamchatka, Marshall Is.'),
(74, 'Pacific/Auckland', '(GMT+12:00) Auckland, Wellington'),
(75, 'Pacific/Tongatapu', '(GMT+13:00) Nuku''alofa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `activationKey` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `timezone_id` int(11) NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `password`, `email`, `activationKey`, `createtime`, `lastvisit`, `superuser`, `status`, `timezone_id`, `phone`) VALUES
(3, 'fe01ce2a7fbac8fafaed7c982a04e229', 'me@sebastianborggrewe.de', '7c4d84dff1b62d792a9181899bf51a0d', 1268354813, 1288462725, 0, 1, 27, '0'),
(19, 'fe01ce2a7fbac8fafaed7c982a04e229', 'karolis.n@gmail.com', '7c4d84dff1b62d792a9181899bf51a0d', 1268354813, 1288460397, 0, 1, 27, '44783168100');
