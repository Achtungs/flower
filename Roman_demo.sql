-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Янв 26 2023 г., 13:24
-- Версия сервера: 10.6.11-MariaDB-1:10.6.11+maria~ubu2004
-- Версия PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Roman_demo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id_category`, `name_category`) VALUES
(1, 'цветы'),
(2, 'Упаковка');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `status` enum('новый','подтвержденный','отмененный') NOT NULL DEFAULT 'новый',
  `reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id_order`, `user_id`, `product_id`, `count`, `status`, `reason`) VALUES
(1, 7, 28, 4, 'новый', NULL),
(3, 7, 20, 2, 'новый', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id_tovar` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id_tovar`, `category_id`, `name`, `price`, `country`, `color`, `image`, `count`, `date`) VALUES
(20, 1, 'Ромашки', 400, 'Германия', 'Фиолетовые', '/web/productImage/z-lRQ4JXqNl4Yw5JXIahE3A1keHBGizkRSHDire5aqdJeL_3Zl.jpg', 8, '2023-01-25 07:33:35'),
(28, 1, 'Дельфиниум', 500, 'Амстердам', 'Фиолетовые', '/web/productImage/pB2XyaWnRQ1fVftD4xMvr3sTbLG_Ud6mJxxlWRFH9yav_pp728.jpg', 3, '2023-01-24 12:11:20'),
(29, 2, 'Опа', 100, 'Неважно', 'Черная', '/web/productImage/WdC4cIL8n0t8_B2dxEjEJd5baGeRCclSkF_sjCmcxhJrWAhgtR.jpg', 21, '2023-01-24 08:29:30'),
(30, 1, 'Васильки', 700, 'Астана', 'Разноцветные', '/web/productImage/dwfQgQ7OFuVmoT3ruPpFOZBmjx8H0z33hr81YZK6oJ4rDZu2l8.jpg', 88, '2023-01-26 08:05:49'),
(31, 1, 'Хризантема', 1500, 'Германия', 'Розовые', '/web/productImage/jI99fXkBeu_G1RSJtET_eMpIIwDF5Lxvy4iRkLrxNCnKn27Rv6.jpg', 18, '2023-01-26 08:06:58');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `agree` tinyint(4) DEFAULT 1,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `agree`, `admin`) VALUES
(6, 'админ', 'админович', 'админовски', 'admin', '2@mail.ru', 'admin44', 1, 1),
(7, 'Роман', 'Белов', 'Александрович', 'Axtung', 'holosage@mail.ru', '12345', 1, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `cart_ibfk_1` (`product_id`),
  ADD KEY `user_id` (`user_id`,`product_id`) USING BTREE;

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_tovar`),
  ADD KEY `product_id` (`category_id`) USING BTREE;

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id_tovar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id_tovar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id_tovar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
