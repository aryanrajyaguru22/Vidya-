-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 06, 2023 at 06:38 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vidya`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(50) NOT NULL,
  `password` varchar(30) DEFAULT NULL COMMENT 'admin pass',
  `roal` varchar(10) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`, `roal`, `name`) VALUES
('rajyagurushashvatteacher@gmail.com', 'Shashvatraj200399', 'super', 'shashvat'),
('aryanrajyaguru22@gmail.com', '123', 'editor', 'aryan');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'works as primery key',
  `semail` varchar(50) NOT NULL COMMENT 'stores student email',
  `temail` varchar(50) NOT NULL COMMENT 'stores teacher email',
  `subject` varchar(10) NOT NULL COMMENT 'stores name of subject which request has been created',
  `price` int(30) NOT NULL COMMENT 'stores the priece of requests',
  `unread` int(1) NOT NULL DEFAULT '1' COMMENT 'works like a flage',
  `rejecte` int(2) NOT NULL DEFAULT '0' COMMENT 'if 0 request is not rejected',
  `request_count` int(11) NOT NULL DEFAULT '1' COMMENT 'no of request has re requested\r\n',
  `pay` int(2) NOT NULL DEFAULT '0' COMMENT 'stores status of payment',
  `stime` text NOT NULL COMMENT 'stores starting time of requests ',
  `etime` text NOT NULL COMMENT 'stores ending time of request',
  `refund` int(2) NOT NULL DEFAULT '0' COMMENT 'if teacher ask refund it be 1',
  `refund_status` int(2) NOT NULL DEFAULT '0',
  `student_rejetct_pay` int(2) NOT NULL DEFAULT '0' COMMENT 'if student reject a teacheron pay page ',
  `teacher_reject` int(2) NOT NULL DEFAULT '0' COMMENT 'if teacher rejects student',
  `student_reject` int(2) NOT NULL DEFAULT '0' COMMENT 'if student rejects teacher',
  `rating` float DEFAULT '0' COMMENT 'stores rating per request',
  `orders` varchar(80) NOT NULL DEFAULT '0',
  `pay_veri` int(2) NOT NULL DEFAULT '0' COMMENT 'if 1 payment is under verification',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `semail`, `temail`, `subject`, `price`, `unread`, `rejecte`, `request_count`, `pay`, `stime`, `etime`, `refund`, `refund_status`, `student_rejetct_pay`, `teacher_reject`, `student_reject`, `rating`, `orders`, `pay_veri`) VALUES
(23, 'rajyagurushashvat@gmail.com', 'pjviradiya@gmit.edu.in', 'php', 2550, 0, 0, 1, 1, '03:50', '22:51', 1, 0, 0, 0, 1, 5, '0', 0),
(24, 'rajyagurushashvat@gmail.com', 'pjviradiya@gmit.edu.in', 'php', 2550, 1, 1, 1, 0, '01:31', '22:31', 0, 0, 0, 0, 0, 0, '0', 0),
(25, 'rajyagurushashvat@gmail.com', 'arshita1@gmail.com', 'php', 2550, 0, 0, 1, 1, '09:59', '22:00', 0, 0, 0, 0, 0, 5, '0', 0),
(26, 'rajyagurushashvat@gmail.com', 'pjviradiya@gmit.edu.in', 'php', 2550, 0, 0, 1, 1, '02:05', '20:05', 1, 0, 0, 0, 1, 0, '0', 0),
(27, 'rajyagurushashvat@gmail.com', 'rajyagurushashvat@gmail.com', 'php', 2300, 0, 0, 1, 1, '02:22', '23:22', 1, 0, 0, 0, 1, 0, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `name` varchar(15) NOT NULL COMMENT 'stores name of roal',
  `rejected_requests` int(2) NOT NULL DEFAULT '0' COMMENT 'excess of this tab',
  `sub` int(2) NOT NULL DEFAULT '0',
  `add_admin` int(2) NOT NULL DEFAULT '0',
  `edit_admins` int(2) NOT NULL DEFAULT '0',
  `verification` int(2) NOT NULL DEFAULT '0',
  `payment_veri` int(2) NOT NULL DEFAULT '0',
  `ad_home` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`name`, `rejected_requests`, `sub`, `add_admin`, `edit_admins`, `verification`, `payment_veri`, `ad_home`) VALUES
('editor', 1, 1, 0, 0, 1, 1, 1),
('changer', 0, 1, 0, 0, 1, 1, 0),
('super', 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `name` varchar(30) NOT NULL COMMENT 'student Name ',
  `st_con` bigint(10) NOT NULL COMMENT 'Student Number ',
  `p_st_con` bigint(10) NOT NULL COMMENT 'Studennt Parents \r\n number ',
  `email` varchar(50) NOT NULL COMMENT 'Studnet / Parents Email',
  `std` varchar(8) DEFAULT NULL COMMENT 'Student Std',
  `gender` varchar(18) DEFAULT NULL COMMENT 'Student Gender ',
  `location` varchar(50) DEFAULT NULL COMMENT 'Student Location',
  `password` varchar(50) DEFAULT NULL COMMENT 'password',
  `age` int(2) DEFAULT NULL COMMENT 'Student age ',
  `teachers` varchar(1000) DEFAULT NULL COMMENT 'stores assign teachers to student',
  `profile` varchar(100) DEFAULT NULL COMMENT 'stores profile picture',
  PRIMARY KEY (`email`),
  UNIQUE KEY `st_con` (`st_con`),
  UNIQUE KEY `p_st_con` (`p_st_con`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`name`, `st_con`, `p_st_con`, `email`, `std`, `gender`, `location`, `password`, `age`, `teachers`, `profile`) VALUES
('bobdo', 6865468765, 8455498654, 'hb1589257@gmail.com', 'std2', 'female', '364240', '123', 19, 'prashant@gmail.com', ''),
('aryan', 9876543218, 6549861321, 'aryanrajyaguru22@gmail.com', 'ty', 'male', '364240', '123', 19, NULL, ''),
('abhi2', 942811323, 7600663667, 'abhi1@gmail.com', 'fy', 'female', '364240', 'abhi1', 18, 'prashant@gmail.com|charmijani@gmail.com|prashant@gmail.com', NULL),
('abhi', 1233453453, 1234123412, 'abhi@gmail.com', 'std12', 'male', '364240', '123', 17, NULL, NULL),
('shashvat Rajyaguru 22', 9879221521, 9429251900, 'rajyagurushashvat@gmail.com', 'fy', 'male', '364240', '1234', 17, 'charmijani@gmail.com|prashant@gmail.com|rajyagurushashvat9@outlook.com|rajyagurushashvat9@outlook.com', '63d54b3705bff1.06195275.jpg'),
('dhruv', 3215346823, 9876546873, 'me@dhruvgiri.in', 'sy', 'male', '364240', '123', 19, NULL, '63c7a1d2decf49.08102581.jpg'),
('shashvat Rajyaguru ', 1231231231, 2312312313, 'rajyagurushashvat1@gmail.com', NULL, NULL, NULL, '123', NULL, NULL, NULL),
('shashvat Rajyaguru ', 4564564567, 3462452345, 'rajyagurushashvat@gmail.comsdfsdfsd', NULL, NULL, NULL, '123', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `subjects` varchar(200) DEFAULT NULL COMMENT 'all subjects in a single string ',
  `price` varchar(100) DEFAULT NULL COMMENT 'stores all the pricies for every subject per email',
  `name` varchar(30) NOT NULL COMMENT 'name of teacher',
  `tc_con` bigint(12) NOT NULL COMMENT 'contect fo theacher',
  `email` varchar(50) NOT NULL,
  `bio` mediumtext COMMENT 'stores bio of teacher to display on student side',
  `gender` varchar(20) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `password` varchar(25) NOT NULL,
  `age` int(2) DEFAULT NULL,
  `s_time` text COMMENT 'starting time',
  `e_time` text COMMENT 'ending time',
  `students` varchar(10000) DEFAULT NULL COMMENT 'stores email of students ',
  `verification` int(2) NOT NULL DEFAULT '0' COMMENT 'stores verification status of teacher',
  `message` varchar(500) DEFAULT NULL COMMENT 'stores message for teacher',
  `documents` varchar(80) DEFAULT NULL COMMENT 'stores file''s names',
  `profile` varchar(80) DEFAULT NULL COMMENT 'stores the address of profile picture',
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`subjects`, `price`, `name`, `tc_con`, `email`, `bio`, `gender`, `location`, `password`, `age`, `s_time`, `e_time`, `students`, `verification`, `message`, `documents`, `profile`) VALUES
('CMTS|C++', '2500,2000', 'charmi jani', 9429777693, 'charmijani@gmail.com', 'Hey there i am charmi jani teaching CMTS from past 3 years and had a great experience in this fild\r\n            ', 'female', '364240', '123', 28, '16:00', '18:00', 'rajyagurushashvat@gmail.com|rajyagurushashvat@gmail.com|abhi1@gmail.com|rajyagurushashvat@gmail.com', 1, NULL, '0', '63d54871379a13.40766990.jpg'),
('.NET', '3000', 'prashansa choksi', 8141336361, 'prashansa@gmai.com', 'hay there i am teaching .net\r\n            ', 'female', '364240', 'prashansa123', 27, '09:00', '12:00', NULL, 1, NULL, '0', NULL),
('JAVA', '3500', 'pruthviraj parmar', 3216549879, 'pruthviraj@gmail.com', 'hey there i am teaching JAVA...\r\n            ', 'male', '364240', 'pruthviraj123', 38, '09:39', '12:39', NULL, 1, NULL, '0', NULL),
('C++|english', '2500,200', 'H M nimbark', 9876543215, 'hmnimbark@gmail.com', 'hey i am a teacher', 'male', '36424002', 'hm123', 38, '11:58', '15:58', NULL, 1, NULL, '0', NULL),
('PHP|DWPD|JAVA', '2500,3000,5000', 'Arshita Makwana', 123456789, 'arshita1@gmail.com', 'hey', 'female', '364240', 'arshita@123', 23, '10:10', '11:10', NULL, 1, NULL, '0', NULL),
('DBMS', '10000', 'foram Gosai ', 8238187961, 'foram123@gmail.com', 'hey', 'female', '364240', 'foram123', 29, '10:00', '17:30', NULL, 1, NULL, '0', NULL),
('CNS|MALP', '2000,3000', 'Prakruti Parmar ', 9726123254, 'prakruti@gmaail.com', 'Hey            ', 'female', '364240', 'prakruti@123', 26, '10:30', '12:30', NULL, 1, NULL, '0', NULL),
('JAVA|Python', '2500,3000', 'Vipul Bambhaniya', 1234567859, 'vipul@gmail.com', 'Hey            ', 'male', '364240', 'vipul123', 33, '14:35', '16:35', NULL, 1, NULL, '0', NULL),
('PHP|DWPD', '22,44', 'adidi', 3216548532, 'abcd@oook.com', '            sdfsdf', 'male', '364240', '123', 19, '17:12', '22:12', NULL, 1, '            sdfgdfg', '0', NULL),
('PHP|java', '2255,55', 'abc', 9849221521, 'rajyagurushashvat@gmail.com', '            ergddfgdfgdf', 'male', '364240', '123', 19, '18:23', '20:23', NULL, 1, '            gdgfdfgdfgdfgd', '0', NULL),
('PHP|java', '2500,3000', 'prashant', 9986548465, 'pjviradiya@gmit.edu.in', 'uauydgfhagasda', 'male', '364240', '123', 19, '11:52', '20:52', NULL, 1, 'ahbsfahsfhahkfjhdkjj          ', '0', NULL),
('PHP|java', '2500,2000', 'amit rathod', 9898988181, 'amitrathod4ever@gmail.com', 'jkhjkhljk', 'male', '364002', '123123', 25, '12:54', '16:54', NULL, 1, '            bg55gregfegregrrrg', '0', NULL),
('english', '200', 'aneri', 4979879879, 'rajyaguruaneri2005@gmail.com', '                sdlkfsdn', 'female', '364240', '123', 18, '14:00', '16:00', NULL, 1, 'ljdfvkjfvkdj                ', '0', NULL),
('PHP', '2500', 'abc', 9374659487, 'rajyagurushashvat9@outlook.com', '            kfhvdkfvh', 'male', '464240', '1234', 19, '16:53', '19:53', 'rajyagurushashvat@gmail.com|rajyagurushashvat@gmail.com', 1, 'sdjvjhdfjkvhd            ', '0', NULL),
('java|php', '2500,3000', 'shashvat', 1231231231, 'rajyagurushashva1t@gmail.com', '       sadfsdfs         ', '---select---', '364240', '123', 20, '17:34', '23:34', NULL, 1, '               asdfasdfasdfasdf ', '0', '63cd6ee3bcd0d5.98993166.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
