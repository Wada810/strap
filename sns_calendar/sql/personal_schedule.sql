-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-22 21:28:27
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

--
-- テーブルのデータのダンプ `personal_schedule`
--

INSERT INTO `personal_schedule` (`id`, `user_id`, `template_id`, `title`, `explanation`, `start`, `end`, `category`) VALUES
(5, 11, 18, 'IH', '授業', '2022-01-22 10:00:00', '2022-01-22 11:30:00', 'HAL大阪'),
(6, 11, 18, 'IH', '授業', '2022-01-29 10:00:00', '2022-01-29 11:30:00', 'HAL大阪'),
(7, 11, 18, 'IH', '授業', '2022-02-05 10:00:00', '2022-02-05 11:30:00', 'HAL大阪'),
(8, 11, 18, 'IH', '授業', '2022-02-12 10:00:00', '2022-02-12 11:30:00', 'HAL大阪'),
(9, 11, 19, '修行', 'かめはめ波', '2022-01-22 06:00:00', '2022-01-22 07:00:00', ''),
(10, 11, 19, '修行', 'かめはめ波', '2022-01-23 06:00:00', '2022-01-23 07:00:00', ''),
(11, 11, 19, '修行', 'かめはめ波', '2022-01-24 06:00:00', '2022-01-24 07:00:00', ''),
(12, 11, 19, '修行', 'かめはめ波', '2022-01-25 06:00:00', '2022-01-25 07:00:00', ''),
(13, 11, 19, '修行', 'かめはめ波', '2022-01-26 06:00:00', '2022-01-26 07:00:00', ''),
(14, 11, 19, '修行', 'かめはめ波', '2022-01-27 06:00:00', '2022-01-27 07:00:00', ''),
(15, 11, 19, '修行', 'かめはめ波', '2022-01-28 06:00:00', '2022-01-28 07:00:00', ''),
(16, 11, 19, '修行', 'かめはめ波', '2022-01-29 06:00:00', '2022-01-29 07:00:00', ''),
(17, 11, 19, '修行', 'かめはめ波', '2022-01-30 06:00:00', '2022-01-30 07:00:00', ''),
(18, 11, 19, '修行', 'かめはめ波', '2022-01-31 06:00:00', '2022-01-31 07:00:00', ''),
(19, 11, 19, '修行', 'かめはめ波', '2022-02-01 06:00:00', '2022-02-01 07:00:00', ''),
(20, 11, 19, '修行', 'かめはめ波', '2022-02-02 06:00:00', '2022-02-02 07:00:00', ''),
(21, 11, 19, '修行', 'かめはめ波', '2022-02-03 06:00:00', '2022-02-03 07:00:00', ''),
(22, 11, 19, '修行', 'かめはめ波', '2022-02-04 06:00:00', '2022-02-04 07:00:00', '');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `personal_schedule`
--
ALTER TABLE `personal_schedule`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `personal_schedule`
--
ALTER TABLE `personal_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
