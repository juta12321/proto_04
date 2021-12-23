-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-12-23 02:25:32
-- サーバのバージョン： 10.4.22-MariaDB
-- PHP のバージョン: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacy_d01_10`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `proto_3_table`
--

CREATE TABLE `proto_3_table` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `score` varchar(5) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `proto_3_table`
--

INSERT INTO `proto_3_table` (`id`, `date`, `lat`, `lng`, `score`) VALUES
(12, '2021-12-01', '34.05240000', '131.82900000', '1'),
(13, '2021-12-15', '34.05260000', '131.82900000', '1'),
(14, '2021-12-15', '34.04960000', '131.83100100', '1'),
(15, '2021-12-15', '34.04940000', '131.83200000', '1'),
(16, '2021-12-15', '34.05020000', '131.83100000', '1'),
(17, '2021-12-15', '34.05080000', '131.83200000', '1'),
(18, '2021-12-15', '34.05110000', '131.83100000', '1'),
(20, '2021-12-15', '34.05110000', '131.83100000', '0'),
(22, '2021-12-15', '34.05280000', '131.83000000', '0'),
(23, '2021-12-15', '34.05280000', '131.83000000', '0'),
(24, '2021-12-15', '34.05270000', '131.83200000', '0'),
(25, '2021-12-15', '34.05220000', '131.83100000', '0'),
(26, '2021-12-15', '34.05210000', '131.83100000', '0'),
(27, '2021-12-15', '34.05160000', '131.83100000', '0'),
(28, '2021-12-15', '34.05120000', '131.83100000', '0'),
(29, '2021-12-15', '34.05070000', '131.83000000', '0'),
(30, '2021-12-15', '34.05050000', '131.83000000', '0'),
(31, '2021-12-15', '34.05030000', '131.83000000', '0'),
(32, '2021-12-15', '34.04960000', '131.83100000', '0'),
(33, '2021-12-15', '34.04990000', '131.83100000', '0'),
(34, '2021-12-15', '34.05040000', '131.83200000', '0'),
(35, '2021-12-15', '34.04970000', '131.83100000', '0'),
(36, '2021-12-15', '34.04860000', '131.83200000', '0'),
(37, '2021-12-15', '34.05170000', '131.82900000', '0'),
(38, '2021-12-15', '34.05170000', '131.82900000', '0'),
(39, '2021-12-15', '34.05170000', '131.82800000', '0');

-- --------------------------------------------------------

--
-- テーブルの構造 `todo_table`
--

CREATE TABLE `todo_table` (
  `id` int(11) NOT NULL,
  `todo` varchar(28) COLLATE utf8mb4_bin NOT NULL,
  `deadline` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `todo_table`
--

INSERT INTO `todo_table` (`id`, `todo`, `deadline`, `created_at`, `updated_at`) VALUES
(1, 'SQL練習', '2021-12-31', '2021-12-11 14:36:37', '2021-12-11 14:36:37'),
(5, 'tesu', '2021-12-10', '2021-12-11 15:11:32', '2021-12-11 15:11:32'),
(6, 'これはすごいねやっべぇぞ', '2021-12-23', '2021-12-11 15:11:50', '2021-12-18 15:03:33'),
(7, 'なるほど～', '2021-12-17', '2021-12-11 15:53:53', '2021-12-11 15:53:53'),
(8, 'test', '2021-12-18', '2021-12-18 13:42:24', '2021-12-18 13:42:24'),
(9, 'functions', '2022-01-01', '2021-12-18 13:47:30', '2021-12-18 13:47:30');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `proto_3_table`
--
ALTER TABLE `proto_3_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `todo_table`
--
ALTER TABLE `todo_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `proto_3_table`
--
ALTER TABLE `proto_3_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- テーブルの AUTO_INCREMENT `todo_table`
--
ALTER TABLE `todo_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
