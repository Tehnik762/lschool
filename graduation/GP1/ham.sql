-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 30 2017 г., 18:04
-- Версия сервера: 5.5.53-log
-- Версия PHP: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ham`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `varinfo` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `varinfo`) VALUES
(1, 5, '{\"street\":\"1\",\"home\":\"\",\"part\":\"\",\"appt\":\"\",\"floor\":\"\",\"comment\":\"\",\"callback\":\"true\",\"payment\":\"true\",\"payment_card\":\"false\"}'),
(2, 5, '{\"street\":\"1\",\"home\":\"\",\"part\":\"\",\"appt\":\"\",\"floor\":\"\",\"comment\":\"\",\"callback\":\"true\",\"payment\":\"true\",\"payment_card\":\"false\"}'),
(3, 5, '{\"street\":\"1\",\"home\":\"\",\"part\":\"\",\"appt\":\"\",\"floor\":\"\",\"comment\":\"\",\"callback\":\"true\",\"payment\":\"true\",\"payment_card\":\"false\"}'),
(4, 5, '{\"street\":\"1\",\"home\":\"\",\"part\":\"\",\"appt\":\"\",\"floor\":\"\",\"comment\":\"\",\"callback\":\"true\",\"payment\":\"true\",\"payment_card\":\"false\"}'),
(5, 6, '{\"street\":\"1\",\"home\":\"\",\"part\":\"\",\"appt\":\"\",\"floor\":\"\",\"comment\":\"\",\"callback\":\"true\",\"payment\":\"true\",\"payment_card\":\"true\"}');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` text,
  `phone` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `phone`) VALUES
(1, 'john@doe.com', 'John Doe', '555 222 333'),
(2, 'elsa@doe.com', 'Elsa Doe', '555 2221 333'),
(3, 'yastroitel@gmail.com', 'Браславский. Антон', ''),
(4, 'test@test.ru', 'Василий', '+7 (111) 111 11 11'),
(5, 'ignat@yahoo.ru', 'Игнат', '+7 (111) 111 11 11'),
(6, 'polina@yahoo.ru', 'ПОлина', '+7 (111) 111 11 11');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
