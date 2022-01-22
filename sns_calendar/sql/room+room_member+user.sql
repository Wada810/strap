-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-22 09:14:51
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
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `user_name`, `login_id`, `hashed_pass`, `salt`, `stretch`, `img_name`, `del_date`) VALUES
(1, 'ユーザー1', 'user1', 'sample', 'sample', 1000, 'sample', NULL),
(2, 'ユーザー2', 'user2', 'sample', 'sample', 1000, 'sample', NULL),
(3, 'ユーザー3', 'user3', 'sample', 'sample', 1000, 'sample', NULL),
(4, 'ユーザー4', 'user4', 'sample', 'sample', 1000, 'sample', NULL),
(5, 'ユーザー5', 'user5', 'sample', 'sample', 1000, 'sample', NULL),
(6, 'ユーザー6', 'user6', '6dbbd5f47d9436a965db9c3165c28f5d', '61ea874c5ab74', 5485, 'b3a3a30c86809f5ce5621989a3960cc2.jpg', NULL),
(7, 'ユーザー7', 'user7', 'c4f64d5bb72769c86e6b93b258f9725b', '61ea891fad7b8', 8079, '572.png', NULL),
(8, 'ユーザー7', 'user8', '57648a82d24da5bd340ff576d3f8cdb6', '61ea8c70b9c79', 3822, 'eyebg_center.jpg', NULL),
(9, 'ユーザー9', 'user9', '1b387fba1ac1ad44888512a38d4ab167', '61ea939698a69', 9600, '2_1.jpg', NULL),
(10, 'ユーザー10', 'user10', '20e6afdc8f78ddffae3a38f214ee6816', '61ea94a39f499', 4024, 'science1_2.jpg', NULL);

--
-- ダンプしたテーブルのインデックス
--

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
-- テーブルのAUTO_INCREMENT `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
