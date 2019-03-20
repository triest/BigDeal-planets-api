-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 19 2019 г., 21:05
-- Версия сервера: 5.6.41
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `planets_db`
--
CREATE DATABASE IF NOT EXISTS `planets_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `planets_db`;

-- --------------------------------------------------------

--
-- Структура таблицы `planets`
--

DROP TABLE IF EXISTS `planets`;
CREATE TABLE `planets` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `rotation_period` int(11) DEFAULT NULL,
  `orbital_period` int(11) DEFAULT NULL,
  `diameter` bigint(20) DEFAULT NULL,
  `climate` varchar(50) DEFAULT NULL,
  `gravity` varchar(50) DEFAULT NULL,
  `terrain` varchar(50) DEFAULT NULL,
  `surface_water` tinyint(4) DEFAULT NULL,
  `population` bigint(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `edited` datetime DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `planets`
--
ALTER TABLE `planets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `planets`
--
ALTER TABLE `planets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
