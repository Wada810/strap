-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-23 14:41:35
-- サーバのバージョン： 10.4.14-MariaDB
-- PHP のバージョン: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `strap`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `block_template_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `state` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `block_template`
--

CREATE TABLE `block_template` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `repeat_every` varchar(255) NOT NULL,
  `repeat_frequency` int(11) DEFAULT NULL,
  `end_repeat` date DEFAULT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_block`
--

CREATE TABLE `personal_block` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `block_id` int(11) NOT NULL,
  `state` int(11) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_schedule`
--

CREATE TABLE `personal_schedule` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `explanation` varchar(3000) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_schedule_template`
--

CREATE TABLE `personal_schedule_template` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `explanation` varchar(3000) DEFAULT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `repeat_every` varchar(255) NOT NULL,
  `repeat_frequency` varchar(255) DEFAULT NULL,
  `end_repeat` date DEFAULT NULL,
  `category` varchar(150) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '      ',
  `img_name` varchar(255) NOT NULL,
  `del_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `room_member`
--

CREATE TABLE `room_member` (
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `login_id` varchar(255) NOT NULL,
  `hashed_pass` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `stretch` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `del_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `block_template`
--
ALTER TABLE `block_template`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `personal_block`
--
ALTER TABLE `personal_block`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `personal_schedule`
--
ALTER TABLE `personal_schedule`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `personal_schedule_template`
--
ALTER TABLE `personal_schedule_template`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `room_member`
--
ALTER TABLE `room_member`
  ADD PRIMARY KEY (`user_id`,`room_id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `block_template`
--
ALTER TABLE `block_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `personal_block`
--
ALTER TABLE `personal_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `personal_schedule`
--
ALTER TABLE `personal_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `personal_schedule_template`
--
ALTER TABLE `personal_schedule_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
