-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 08 2021 г., 11:55
-- Версия сервера: 10.1.28-MariaDB
-- Версия PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `loginform`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `regdate` varchar(100) NOT NULL,
  `updateDate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `username`, `password`, `role`, `status`, `regdate`, `updateDate`) VALUES
(6, 'Admin', 'admin@local.loc', 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin', 'active', '08.12.2021 09:47:43', '08.12.2021 15:36:20'),
(7, 'Adminbek', 'adminbek@local.loc', 'adminbek', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'user', 'active', '08.12.2021 09:50:59', '08.12.2021 15:44:12'),
(8, 'Adminjon', 'adminjon@email.ru', 'adminjon', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'user', 'ban', '08.12.2021 13:37:59', '08.12.2021 15:45:05'),
(9, 'Alibek', 'alibek@gmail.com', 'alibek', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', 'active', '08.12.2021 15:46:36', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
