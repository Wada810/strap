-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-22 21:28:20
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

--
-- テーブルのデータのダンプ `personal_schedule_template`
--

INSERT INTO `personal_schedule_template` (`id`, `user_id`, `title`, `explanation`, `start`, `end`, `repeat_every`, `repeat_frequency`, `end_repeat`, `category`, `created_at`) VALUES
(18, 11, 'IH', '授業', '10:00:00', '11:30:00', 'weeks', '1', '2022-02-17', 'HAL大阪', '2022-01-22'),
(19, 11, '修行', 'かめはめ波', '06:00:00', '07:00:00', 'days', '1', '2022-02-05', '', '2022-01-22');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `personal_schedule_template`
--
ALTER TABLE `personal_schedule_template`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `personal_schedule_template`
--
ALTER TABLE `personal_schedule_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
