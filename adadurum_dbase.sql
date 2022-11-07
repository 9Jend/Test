-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 07 2022 г., 22:08
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `adadurum_dbase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--

CREATE TABLE `company` (
  `id` bigint NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_inn` varchar(20) NOT NULL,
  `company_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_gendir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `company`
--

INSERT INTO `company` (`id`, `company_name`, `company_inn`, `company_information`, `company_gendir`, `company_address`, `company_phone`) VALUES
(29, 'Яндекс', '1234567890', '«Я́ндекс» — поисковая система, принадлежащая российской корпорации «Яндекс», основной продукт компании. Доля «Яндекс.Поиска» составляет 56 % на рынке Рунета и 7 % на рынке Турции.', 'Тигран Оганесович Худавердян', 'Москва, ул. Льва Толстого, 16', '+7 (495) 739-70-00'),
(30, 'Mail.ru', '1234567890', 'Почта@Mail.Ru — служба электронной почты, основная служба портала Mail.ru, принадлежащего компании VK. ', 'Борис Олегович Добродеев', 'Ленинградский пр-т., Москва, 125190', '+7 (999) 999-99-99'),
(31, 'ВКонтакте', '7842349892', '«ВКонта́кте» — российская социальная сеть со штаб-квартирой в Санкт-Петербурге. Сайт доступен на 86 языках; особенно популярен среди русскоязычных пользователей.', 'Борис Олегович Добродеев', 'Ленинградский проспект 39, стр. 79. Санкт-Петербург. 191186', '+7 (999) 999-99-99'),
(32, 'Google', '7704582421', 'Google — американская транснациональная корпорация в составе холдинга Alphabet, инвестирующая в интернет-поиск, облачные вычисления и рекламные технологии. Google поддерживает и разрабатывает ряд интернет-сервисов и продуктов и получает прибыль в первую очередь от рекламы через свою программу Ads.', 'Сундар Пичаи', 'Маунтин-Вью, Калифорния, США', '+7 (800) 500-91-20'),
(33, 'ВС РФ', '7704252261', 'Вооружённые силы Российской Федерации — государственная военная организация Российской Федерации, предназначенная для отражения агрессии, направленной против неё, для вооружённой защиты территориальной целостности и неприкосновенности её территории.', 'Сергей Кужугетович Шойгу', 'ул. Знаменка, 14/1, Москва', '+7 (495) 498-03-78');

-- --------------------------------------------------------

--
-- Структура таблицы `company_users_comments`
--

CREATE TABLE `company_users_comments` (
  `id` bigint NOT NULL,
  `company_users_notes_id` bigint NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `company_users_comments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `company_users_comments`
--

INSERT INTO `company_users_comments` (`id`, `company_users_notes_id`, `user_name`, `company_users_comments`, `created_at`) VALUES
(122, 29, 'Евгений', 'Я тут служил целый год, все понравилось, больше не хочу.', '2022-11-07 18:15:51'),
(123, 28, 'Евгений', 'Меня сюда не берут на работу((((((', '2022-11-07 18:16:27'),
(124, 28, 'Евгений', 'До сих пор не берут\r\n', '2022-11-07 18:16:41'),
(125, 28, 'Евгений', 'и даже сейчас не берут, а прошло 5 минут.', '2022-11-07 18:21:30'),
(126, 32, 'Кто-то', 'их такси мне нравится\r\n', '2022-11-07 18:29:09'),
(127, 35, 'Кто-то', 'Дуров верни стену', '2022-11-07 18:30:22'),
(130, 34, 'Кто-то', 'Какой то комментарий', '2022-11-07 18:43:47');

-- --------------------------------------------------------

--
-- Структура таблицы `company_users_notes`
--

CREATE TABLE `company_users_notes` (
  `id` bigint NOT NULL,
  `company_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `company_name_notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_inn_notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_inf_notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_gendir_notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address_notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone_notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `company_users_notes`
--

INSERT INTO `company_users_notes` (`id`, `company_id`, `user_id`, `company_name_notes`, `company_inn_notes`, `company_inf_notes`, `company_gendir_notes`, `company_address_notes`, `company_phone_notes`) VALUES
(28, 29, 13, 'заметка', 'еще заметка', 'тут не знаю что писать, но тоже заметка', 'Скоро будет другое, а точнее Голуб Евгений Борисович', NULL, NULL),
(29, 33, 13, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 30, 13, 'какая то заметка', '1', '2', NULL, '3', '4'),
(31, 31, 13, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 29, 17, '', '', '', 'что то', 'водитель такси живет не тут', 'у такси другой номер'),
(33, 33, 17, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 30, 17, 'Какая то заметка', NULL, 'Какая то заметка', NULL, 'Какая то заметка', NULL),
(35, 31, 17, NULL, NULL, NULL, 'Павел Валерьевич Дуров, а не этот.....', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
  `user_login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_birthday` date NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_login`, `user_name`, `user_birthday`, `user_password`, `created_at`) VALUES
(13, 'Evg@mail.ru', 'Евгений', '2001-12-07', '$2y$10$4UDEne4aPCNUradtfURV6O5YxUK3KlWk8ZuC2a/eElmLMUE2CDKUO', '2022-11-04 17:39:47'),
(17, 'Ktoto@qwe.zxc', 'Кто-то', '2022-11-07', '$2y$10$5D.MayspyLCj./jcMn5RgeKoLit/F0PvuMqPBFSVae9BM9cJvDJAO', '2022-11-07 18:27:50');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `company_users_comments`
--
ALTER TABLE `company_users_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_users_notes_id` (`company_users_notes_id`);

--
-- Индексы таблицы `company_users_notes`
--
ALTER TABLE `company_users_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_users_notes_ibfk_1` (`company_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_login` (`user_login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `company`
--
ALTER TABLE `company`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `company_users_comments`
--
ALTER TABLE `company_users_comments`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT для таблицы `company_users_notes`
--
ALTER TABLE `company_users_notes`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `company_users_comments`
--
ALTER TABLE `company_users_comments`
  ADD CONSTRAINT `company_users_comments_ibfk_1` FOREIGN KEY (`company_users_notes_id`) REFERENCES `company_users_notes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `company_users_notes`
--
ALTER TABLE `company_users_notes`
  ADD CONSTRAINT `company_users_notes_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `company_users_notes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
