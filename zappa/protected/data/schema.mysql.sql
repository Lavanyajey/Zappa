-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2010 at 01:13 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `latentflip_zappa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calls`
--

CREATE TABLE `tbl_calls` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_calls`
--

INSERT INTO `tbl_calls` VALUES(1, 'Wake up bitch! It''s 7:30!');
INSERT INTO `tbl_calls` VALUES(2, 'Wake up bitch! It''s 7:30!');
INSERT INTO `tbl_calls` VALUES(3, 'Wake up bitch! It''s 7:30!');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_queue`
--

CREATE TABLE `tbl_job_queue` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `call_id` int(10) NOT NULL,
  `phone` int(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `call_id_2` (`call_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_job_queue`
--

INSERT INTO `tbl_job_queue` VALUES(5, 3, 2147483647, '2010-10-30 13:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timezone`
--

CREATE TABLE `tbl_timezone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `php` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=76 ;

--
-- Dumping data for table `tbl_timezone`
--

INSERT INTO `tbl_timezone` VALUES(1, 'Etc/GMT+12', '(GMT-12:00) International Date Line West');
INSERT INTO `tbl_timezone` VALUES(2, 'Pacific/Apia', '(GMT-11:00) Midway Island, Samoa');
INSERT INTO `tbl_timezone` VALUES(3, 'Pacific/Honolulu', '(GMT-10:00) Hawaii');
INSERT INTO `tbl_timezone` VALUES(4, 'America/Anchorage', '(GMT-09:00) Alaska');
INSERT INTO `tbl_timezone` VALUES(5, 'America/Los_Angeles', '(GMT-08:00) Pacific Time (US & Canada); Tijuana');
INSERT INTO `tbl_timezone` VALUES(6, 'America/Phoenix', '(GMT-07:00) Arizona');
INSERT INTO `tbl_timezone` VALUES(7, 'America/Denver', '(GMT-07:00) Mountain Time (US & Canada)');
INSERT INTO `tbl_timezone` VALUES(8, 'America/Chihuahua', '(GMT-07:00) Chihuahua, La Paz, Mazatlan');
INSERT INTO `tbl_timezone` VALUES(9, 'America/Managua', '(GMT-06:00) Central America');
INSERT INTO `tbl_timezone` VALUES(10, 'America/Regina', '(GMT-06:00) Saskatchewan');
INSERT INTO `tbl_timezone` VALUES(11, 'America/Mexico_City', '(GMT-06:00) Guadalajara, Mexico City, Monterrey');
INSERT INTO `tbl_timezone` VALUES(12, 'America/Chicago', '(GMT-06:00) Central Time (US & Canada)');
INSERT INTO `tbl_timezone` VALUES(13, 'America/Indianapolis', '(GMT-05:00) Indiana (East)');
INSERT INTO `tbl_timezone` VALUES(14, 'America/Bogota', '(GMT-05:00) Bogota, Lima, Quito');
INSERT INTO `tbl_timezone` VALUES(15, 'America/New_York', '(GMT-05:00) Eastern Time (US & Canada)');
INSERT INTO `tbl_timezone` VALUES(16, 'America/Caracas', '(GMT-04:00) Caracas, La Paz');
INSERT INTO `tbl_timezone` VALUES(17, 'America/Santiago', '(GMT-04:00) Santiago');
INSERT INTO `tbl_timezone` VALUES(18, 'America/Halifax', '(GMT-04:00) Atlantic Time (Canada)');
INSERT INTO `tbl_timezone` VALUES(19, 'America/St_Johns', '(GMT-03:30) Newfoundland');
INSERT INTO `tbl_timezone` VALUES(20, 'America/Buenos_Aires', '(GMT-03:00) Buenos Aires, Georgetown');
INSERT INTO `tbl_timezone` VALUES(21, 'America/Godthab', '(GMT-03:00) Greenland');
INSERT INTO `tbl_timezone` VALUES(22, 'America/Sao_Paulo', '(GMT-03:00) Brasilia');
INSERT INTO `tbl_timezone` VALUES(23, 'America/Noronha', '(GMT-02:00) Mid-Atlantic');
INSERT INTO `tbl_timezone` VALUES(24, 'Atlantic/Cape_Verde', '(GMT-01:00) Cape Verde Is.');
INSERT INTO `tbl_timezone` VALUES(25, 'Atlantic/Azores', '(GMT-01:00) Azores');
INSERT INTO `tbl_timezone` VALUES(26, 'Africa/Casablanca', '(GMT) Casablanca, Monrovia');
INSERT INTO `tbl_timezone` VALUES(27, 'Europe/London', '(GMT) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London');
INSERT INTO `tbl_timezone` VALUES(28, 'Africa/Lagos', '(GMT+01:00) West Central Africa');
INSERT INTO `tbl_timezone` VALUES(29, 'Europe/Berlin', '(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna');
INSERT INTO `tbl_timezone` VALUES(30, 'Europe/Paris', '(GMT+01:00) Brussels, Copenhagen, Madrid, Paris');
INSERT INTO `tbl_timezone` VALUES(31, 'Europe/Sarajevo', '(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb');
INSERT INTO `tbl_timezone` VALUES(32, 'Europe/Belgrade', '(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague');
INSERT INTO `tbl_timezone` VALUES(33, 'Africa/Johannesburg', '(GMT+02:00) Harare, Pretoria');
INSERT INTO `tbl_timezone` VALUES(34, 'Asia/Jerusalem', '(GMT+02:00) Jerusalem');
INSERT INTO `tbl_timezone` VALUES(35, 'Europe/Istanbul', '(GMT+02:00) Athens, Istanbul, Minsk');
INSERT INTO `tbl_timezone` VALUES(36, 'Europe/Helsinki', '(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius');
INSERT INTO `tbl_timezone` VALUES(37, 'Africa/Cairo', '(GMT+02:00) Cairo');
INSERT INTO `tbl_timezone` VALUES(38, 'Europe/Bucharest', '(GMT+02:00) Bucharest');
INSERT INTO `tbl_timezone` VALUES(39, 'Africa/Nairobi', '(GMT+03:00) Nairobi');
INSERT INTO `tbl_timezone` VALUES(40, 'Asia/Riyadh', '(GMT+03:00) Kuwait, Riyadh');
INSERT INTO `tbl_timezone` VALUES(41, 'Europe/Moscow', '(GMT+03:00) Moscow, St. Petersburg, Volgograd');
INSERT INTO `tbl_timezone` VALUES(42, 'Asia/Baghdad', '(GMT+03:00) Baghdad');
INSERT INTO `tbl_timezone` VALUES(43, 'Asia/Tehran', '(GMT+03:30) Tehran');
INSERT INTO `tbl_timezone` VALUES(44, 'Asia/Muscat', '(GMT+04:00) Abu Dhabi, Muscat');
INSERT INTO `tbl_timezone` VALUES(45, 'Asia/Tbilisi', '(GMT+04:00) Baku, Tbilisi, Yerevan');
INSERT INTO `tbl_timezone` VALUES(46, 'Asia/Kabul', '(GMT+04:30) Kabul');
INSERT INTO `tbl_timezone` VALUES(47, 'Asia/Karachi', '(GMT+05:00) Islamabad, Karachi, Tashkent');
INSERT INTO `tbl_timezone` VALUES(48, 'Asia/Yekaterinburg', '(GMT+05:00) Ekaterinburg');
INSERT INTO `tbl_timezone` VALUES(49, 'Asia/Calcutta', '(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi');
INSERT INTO `tbl_timezone` VALUES(50, 'Asia/Katmandu', '(GMT+05:45) Kathmandu');
INSERT INTO `tbl_timezone` VALUES(51, 'Asia/Colombo', '(GMT+06:00) Sri Jayawardenepura');
INSERT INTO `tbl_timezone` VALUES(52, 'Asia/Dhaka', '(GMT+06:00) Astana, Dhaka');
INSERT INTO `tbl_timezone` VALUES(53, 'Asia/Novosibirsk', '(GMT+06:00) Almaty, Novosibirsk');
INSERT INTO `tbl_timezone` VALUES(54, 'Asia/Rangoon', '(GMT+06:30) Rangoon');
INSERT INTO `tbl_timezone` VALUES(55, 'Asia/Bangkok', '(GMT+07:00) Bangkok, Hanoi, Jakarta');
INSERT INTO `tbl_timezone` VALUES(56, 'Asia/Krasnoyarsk', '(GMT+07:00) Krasnoyarsk');
INSERT INTO `tbl_timezone` VALUES(57, 'Australia/Perth', '(GMT+08:00) Perth');
INSERT INTO `tbl_timezone` VALUES(58, 'Asia/Taipei', '(GMT+08:00) Taipei');
INSERT INTO `tbl_timezone` VALUES(59, 'Asia/Singapore', '(GMT+08:00) Kuala Lumpur, Singapore');
INSERT INTO `tbl_timezone` VALUES(60, 'Asia/Hong_Kong', '(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi');
INSERT INTO `tbl_timezone` VALUES(61, 'Asia/Irkutsk', '(GMT+08:00) Irkutsk, Ulaan Bataar');
INSERT INTO `tbl_timezone` VALUES(62, 'Asia/Tokyo', '(GMT+09:00) Osaka, Sapporo, Tokyo');
INSERT INTO `tbl_timezone` VALUES(63, 'Asia/Seoul', '(GMT+09:00) Seoul');
INSERT INTO `tbl_timezone` VALUES(64, 'Asia/Yakutsk', '(GMT+09:00) Yakutsk');
INSERT INTO `tbl_timezone` VALUES(65, 'Australia/Darwin', '(GMT+09:30) Darwin');
INSERT INTO `tbl_timezone` VALUES(66, 'Australia/Adelaide', '(GMT+09:30) Adelaide');
INSERT INTO `tbl_timezone` VALUES(67, 'Pacific/Guam', '(GMT+10:00) Guam, Port Moresby');
INSERT INTO `tbl_timezone` VALUES(68, 'Australia/Brisbane', '(GMT+10:00) Brisbane');
INSERT INTO `tbl_timezone` VALUES(69, 'Asia/Vladivostok', '(GMT+10:00) Vladivostok');
INSERT INTO `tbl_timezone` VALUES(70, 'Australia/Hobart', '(GMT+10:00) Hobart');
INSERT INTO `tbl_timezone` VALUES(71, 'Australia/Sydney', '(GMT+10:00) Canberra, Melbourne, Sydney');
INSERT INTO `tbl_timezone` VALUES(72, 'Asia/Magadan', '(GMT+11:00) Magadan, Solomon Is., New Caledonia');
INSERT INTO `tbl_timezone` VALUES(73, 'Pacific/Fiji', '(GMT+12:00) Fiji, Kamchatka, Marshall Is.');
INSERT INTO `tbl_timezone` VALUES(74, 'Pacific/Auckland', '(GMT+12:00) Auckland, Wellington');
INSERT INTO `tbl_timezone` VALUES(75, 'Pacific/Tongatapu', '(GMT+13:00) Nuku''alofa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `activationKey` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `timezone_id` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` VALUES(3, 'fe01ce2a7fbac8fafaed7c982a04e229', 'me@sebastianborggrewe.de', '7c4d84dff1b62d792a9181899bf51a0d', 1268354813, 1288440165, 0, 1, 27, 0);
