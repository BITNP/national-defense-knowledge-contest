-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-04-27 20:27:48
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gfexam`
--

-- --------------------------------------------------------

--
-- 表的结构 `problems`
--

CREATE TABLE `problems` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `answer` int(11) NOT NULL,
  `choices` text COLLATE utf8_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `problems`
--

INSERT INTO `problems` (`id`, `type`, `description`, `answer`, `choices`) VALUES
(13, 1, '下列哪个教室不存在（良乡校区）', 2, '1-109||1-404||2A-505||2A-406'),
(12, 1, '“买bug送游戏”形容的是哪家公司', 1, '动视暴雪||育碧||腾讯||EA'),
(3, 0, '另一道判断题，本题答案为“正确”', 0, NULL),
(4, 0, '一道判断题，本题答案为“错误”', 1, NULL),
(5, 1, '一道选择题，答案是B', 2, '一个选项||二个选项||三个选项||四个选项'),
(6, 1, 'PHP的最新版本是', 2, 'PHP3||PHP5||PHP7||PHP9'),
(7, 1, '属于脚本语言的是', 2, 'C#||Java||Python||C++'),
(8, 0, 'Java语言与JavaScript语言基本没什么关系', 0, NULL),
(9, 1, '哪种语言最近正式成为受Android官方支持的开发语言？', 0, 'Kotlin||Swift||Python||PHP'),
(10, 1, 'MVC模式中的C指的是', 3, 'Command||Conquer||C/C++ Language||Controller'),
(11, 0, 'GTA系列游戏是动视暴雪的产品', 1, NULL),
(14, 1, '以下哪个是网协的部门', 2, '网络诊所||电脑维修部||电脑诊所||网协诊所'),
(15, 0, '电脑诊所的位置是311F', 1, NULL),
(16, 0, '网协技术部负责PS、AE、PR等技术', 1, NULL),
(17, 1, '请找茬', 2, '乒乒乒乒乒乒乒乒乒乒||乒乒乒乒乒乒乒乒乒乒||乒乒乒乒乓乒乒乒乒乒||乒乒乒乒乒乒乒乒乒乒'),
(18, 0, '网络部的四位部长来自两个不同的学院', 1, NULL),
(19, 0, '北京的四月是真的可以下雪的', 0, NULL),
(20, 1, 'π小数点后第10位是', 2, '3||4||5||6'),
(21, 1, '房山线信号最差的地铁站是', 0, '大葆台||广阳城||稻田||长阳');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `casid` text COLLATE utf8_bin,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `stuNum` text COLLATE utf8_bin NOT NULL,
  `school` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `end_time` timestamp NULL DEFAULT NULL,
  `problems` text COLLATE utf8_bin NOT NULL,
  `keyans` text COLLATE utf8_bin NOT NULL,
  `myans` text COLLATE utf8_bin,
  `score` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
