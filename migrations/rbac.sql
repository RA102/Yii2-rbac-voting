-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 20 2019 г., 13:36
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rbac`
--

-- --------------------------------------------------------

--
-- Структура таблицы `all_seeing_eye`
--

CREATE TABLE `all_seeing_eye` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry_time` int(11) NOT NULL,
  `output_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('accessAppoint', '1', 1574219575),
('accessAppoint', '2', 1573815670),
('accessGii', '1', 1574064687),
('accessManager', '1', 1571743268),
('accessMemeber', '1', 1571654046),
('accessResult', '1', 1571654049),
('accessResult', '4', 1574052272),
('accessVote', '1', 1571802381),
('Counting', '1', 1574054299),
('Counting', '4', 1573105027),
('Manager', '1', 1574054297),
('Manager', '2', 1573815322),
('User', '1', 1573125163),
('User', '10', 1575437805),
('User', '11', 1576811079),
('User', '12', 1576811087),
('User', '13', 1576811095),
('User', '14', 1576811108),
('User', '15', 1576811254),
('User', '16', 1576811262),
('User', '18', 1576811296),
('User', '19', 1576811290),
('User', '20', 1576811282),
('User', '8', 1575347897),
('User', '9', 1575437800);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/gii/*', 2, NULL, NULL, NULL, 1571652626, 1571652626),
('/member/*', 2, NULL, NULL, NULL, 1571653896, 1571653896),
('/result/*', 2, NULL, NULL, NULL, 1571653561, 1571653561),
('/type/*', 2, NULL, NULL, NULL, 1571653220, 1571653220),
('/voting/*', 2, NULL, NULL, NULL, 1573463067, 1573463067),
('/voting/default/*', 2, NULL, NULL, NULL, 1573463120, 1573463120),
('/voting/default/index', 2, NULL, NULL, NULL, 1574306735, 1574306735),
('/voting/member/*', 2, NULL, NULL, NULL, 1574052804, 1574052804),
('/voting/result/*', 2, NULL, NULL, NULL, 1573634129, 1573634129),
('accessAppoint', 2, 'Отправлять на защиту', NULL, NULL, 1571802541, 1571802541),
('accessGii', 2, NULL, NULL, NULL, 1571652675, 1571652675),
('accessManager', 2, NULL, NULL, NULL, 1571743219, 1571743219),
('accessMemeber', 2, NULL, NULL, NULL, 1571653915, 1571653915),
('accessResult', 2, 'Результат', NULL, NULL, 1571653653, 1573634314),
('accessType', 2, NULL, NULL, NULL, 1571653241, 1571653241),
('accessVote', 2, 'Голосовать', NULL, NULL, 1571802363, 1573634241),
('Counting', 1, 'Счетная комиссия', NULL, NULL, 1573104964, 1573641660),
('Manager', 1, 'кнопка Назначить', NULL, NULL, 1572425778, 1573104865),
('User', 1, 'Комиссия', NULL, NULL, 1572425818, 1573104819);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('accessAppoint', '/voting/member/*'),
('accessGii', '/gii/*'),
('accessManager', '/voting/member/*'),
('accessMemeber', '/member/*'),
('accessMemeber', '/voting/member/*'),
('accessResult', '/voting/result/*'),
('accessType', '/type/*'),
('accessVote', '/voting/member/*'),
('Counting', '/voting/default/*'),
('Counting', 'accessResult'),
('Manager', '/voting/default/*'),
('Manager', 'accessManager'),
('User', '/voting/default/*'),
('User', 'accessMemeber'),
('User', 'accessVote');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `specialty` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `active_member` int(11) NOT NULL DEFAULT 0,
  `status_student_id` int(11) NOT NULL DEFAULT 1,
  `data` date NOT NULL DEFAULT '0000-00-00',
  `number_queue` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `member`
--

INSERT INTO `member` (`id`, `name`, `faculty`, `department`, `code`, `specialty`, `theme`, `active_member`, `status_student_id`, `data`, `number_queue`) VALUES
(36, 'ФИО', 'Новый Факультет', 'Департамент 2', '4F67ER8990', 'Специальность', 'Тема Новая', 1, 3, '2019-12-20', 1),
(37, 'ABJ 2', 'asd;kmc', 'asd\'lm,czx', '565JKJn', 'asdas\';,c ', 'as;dklxmzcp;', 0, 1, '2019-12-20', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1571390455),
('m140506_102106_rbac_init', 1571393934),
('m140602_111327_create_menu_table', 1571393906),
('m160312_050000_create_user', 1571393907),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1571393935),
('m180523_151638_rbac_updates_indexes_without_prefix', 1571393935),
('m191018_091630_create_post', 1571390458);

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `desctiption` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `title`, `desctiption`, `user_id`) VALUES
(1, 'Заголовок', 'Какой-то  текст', NULL),
(2, 'Заголовок 2', 'Еще какой-то текст', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL DEFAULT 0,
  `type_id` int(11) NOT NULL DEFAULT 0,
  `status_student_id` int(11) NOT NULL DEFAULT 0,
  `active_result` int(11) NOT NULL DEFAULT 2,
  `time_voted` datetime DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `status_student`
--

CREATE TABLE `status_student` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status_student`
--

INSERT INTO `status_student` (`id`, `status`) VALUES
(1, 'не защищался'),
(2, 'на защите'),
(3, 'защищался'),
(4, 'защитился');

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Против'),
(2, 'Недействит.'),
(3, 'За');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'X7x9owJKqZ1PWGUNSkyhkBN_3Q0QGOCg', '$2y$13$pnkj4n37S/0RBk9cweatXeUYV1dsQXrJ8PY.Ly9YohHYoT81LOdZq', NULL, 'admin@admin.loc', 10, 1571652582, 1571652582),
(2, 'manager', 'vuNVMHvrVB0WKA7jq4f-AR1aGfurZykJ', '$2y$13$h.0dBs.Ta/gbQfHGzeEffeAm1YEo1xmQn4pnzQnWlyqQZcGjhli6m', NULL, 'manager@manager.loc', 10, 1571731830, 1571731830),
(4, 'counter', 'ApK7lKxRKzIjiXkCvkns4_QFVhkLYLUm', '$2y$13$oNReAsRQqgHNaYv1a.42f.Za2a2te0cX0BMXiYY2AR7Vr/Aj6g/zW', NULL, 'counter@counter.loc', 10, 1573016672, 1573016672),
(8, 'Иванов Иван Петрович', '3J86tGS7Lvyp7gxAL5aduSaQIl87CC0M', '$2y$13$BRcGQnQfIMGbvB./vIt38uxIPagcnBRWvfuKGib9V6XRKNfcbDA5m', NULL, 'local@mail.loc', 10, 1575347791, 1575347791),
(9, 'User 1', 'uiPcvbKPUvrxEzvNe8-Jq8x1n6w1ZT2T', '$2y$13$VvYFPMuN.tRp.yOw.T5M7O/mLMbgRdfsg3DQ0HWRwTU5rhD2A2eoq', NULL, 'user@mail.loc', 10, 1575437744, 1575437744),
(10, 'User 2', 'CuloyMxjFpi1leecH6XcRMBER2zuk229', '$2y$13$h6jq0rmDhxweAM3oiofhxugBMCPB7tie2xoCzVobZuocGbf19Ap8m', NULL, 'user2@mail.loc', 10, 1575437769, 1575437769),
(11, 'Брейдо Иосиф Вульфович', 'odjKJ3PskbNadpMjLlJHSUrtexPlZoOl', '$2y$13$OGj/OtvQdJFZ4i.vhMXQnO8sczcbwRdpZgw0cbtoKBc8fKsoAQr6u', NULL, 'temp@temp.loc', 10, 1576809525, 1576809525),
(12, 'Фешин Борис Николаевич', 'TJ__g3sJqaZeZrj_-wOUF3J3SHeXL1_h', '$2y$13$Y3a7DqOyvTvOk.rsuX2VSOk5ZDDyjHcRV/Y5U8Dy4yBJO1XHiHdQa', NULL, 'temp1@temp.loc', 10, 1576809639, 1576809639),
(13, 'Смагулова Каршига Канатовна', 'xVzX6SC251JBAKdnNDuL8MS3BGVRpoS3', '$2y$13$wPqJXAQZxj.RhWXw7mbqZO8N2w2/n3Agut1PDAdAxv62SF/MmBJVa', NULL, 'temp2@temp.loc', 10, 1576809677, 1576809677),
(14, 'Войткевич Софья Валентиновна', 'DCWsIZN2nn-Yar6DaMfUEnpVbOt0LT_X', '$2y$13$fK0d26pBxYGQ9oWgSaOYBuCrDQLNZJbda2G6kWEpclwZiumby5aGe', NULL, 'temp3@temp.loc', 10, 1576809711, 1576809711),
(15, 'Шоланов Корганбай Сагнаевич', '2TgLvDlv0Nmg8PIQ3VYJytiQxL7cqsFl', '$2y$13$yNjN5mOi2xj9ahHNxopyoOuF/9rH1kr3YzFpdFjMirUJdxx99G4uq', NULL, 'temp4@temp.loc', 10, 1576809748, 1576809748),
(16, 'Стажков Сергей Михайлович', '0Rv3obV1MjQUubj6iZy-XH6wiA3pVLpO', '$2y$13$cAkqc.N6QhuCCUhgqWczIuLOKwGQ1I4./wLYBijkjj/Z/5qOM4GCa', NULL, 'temp5@temp.loc', 10, 1576809795, 1576809795),
(17, 'Сивякова Галина Александровна', 'S_6EHr0PBsxsiV2SP-QXmpRvs-tHNDbo', '$2y$13$IIOIQGM/SNRonGkn1lqwZu0flFjobo09pYIRsAnDn4g4H05lhXDPG', NULL, 'temp6@temp.loc', 10, 1576809830, 1576809830),
(18, 'Утегулов Болатбек Бахитжанович', 'DOosaAyOeEV96lLX2j9fA2-nmabyGGah', '$2y$13$Z1d4A/W/Vfa209KKd3fvHuEW85sxf.hpHmS8zucM1RRTfnmllUOT6', NULL, 'temp7@temp.loc', 10, 1576809868, 1576809868),
(19, 'Бакенов Кайрат Асангалиевич', 'J27YSMknPFWm52yaOaRrhSk-B97HIZzv', '$2y$13$g6BbL8tOsjw59lcDan7kJueZ/qpCz7u9jrWPM.yqqxRx8hCejlXXe', NULL, 'temp8@temp.loc', 10, 1576809900, 1576809900),
(20, 'Ижикова Алена Дмитриевна', '3Ozes1YOetpsqcXeSlz5_j0I8lvBbvrj', '$2y$13$ir.Z4CUIBxCE0f.QqJgvA.2T5X6l0j7iozHTntJ5d/YMAVwrG2xai', NULL, 'temp9@temp.loc', 10, 1576809929, 1576809929);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `all_seeing_eye`
--
ALTER TABLE `all_seeing_eye`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Индексы таблицы `status_student`
--
ALTER TABLE `status_student`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `all_seeing_eye`
--
ALTER TABLE `all_seeing_eye`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=875;

--
-- AUTO_INCREMENT для таблицы `status_student`
--
ALTER TABLE `status_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
