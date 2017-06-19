-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 22 2017 г., 20:25
-- Версия сервера: 5.5.50
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `w15`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1486809442),
('admin', '2', 1486809442),
('author', '11', NULL),
('author', '12', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1486809442, 1486809442),
('adminRole', 2, 'Администратор', NULL, NULL, 1486809442, 1486809442),
('author', 1, NULL, NULL, NULL, 1486809442, 1486809442),
('authorRole', 2, 'Автор', NULL, NULL, 1486809442, 1486809442);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'adminRole'),
('author', 'authorRole');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `w15_news`
--

CREATE TABLE IF NOT EXISTS `w15_news` (
  `id` int(11) NOT NULL,
  `header` varchar(100) NOT NULL,
  `annotation` varchar(200) NOT NULL,
  `full_text` varchar(1024) NOT NULL,
  `ext_image` varchar(4) NOT NULL,
  `start_date` date NOT NULL,
  `finish_date` date NOT NULL,
  `state` tinyint(4) NOT NULL,
  `count_views` int(11) NOT NULL DEFAULT '0',
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `w15_news`
--

INSERT INTO `w15_news` (`id`, `header`, `annotation`, `full_text`, `ext_image`, `start_date`, `finish_date`, `state`, `count_views`, `id_author`) VALUES
(16, 'ВПИ — площадка Тотального диктанта', 'Тотальный диктант пройдет в Волжском политехническом институте.', '<p>Приглашаем принять участие в&nbsp;Тотальном диктанте&nbsp;&mdash; ежегодной образовательной акции, которая состоится 8&nbsp;апреля 2017 года в&nbsp;14:00 и&nbsp;впервые пройдет на&nbsp;площадке Волжского политехнического института. Всего на&nbsp;территории города Волжского работают две такие площадки&nbsp;&mdash; ВПИ и&nbsp;МЭИ.</p>\r\n\r\n<p>Для участия необходимо зарегистрироваться на&nbsp;официальном сайте&nbsp;<a href="http://www.totaldict.ru/" style="color: rgb(54, 71, 221);">totaldict.ru</a>. Регистрация будет открыта с&nbsp;29&nbsp;марта.</p>\r\n\r\n<p>Материал подготовлен с&nbsp;использованием информации сайта&nbsp;<a href="http://www.totaldict.ru/" style="color: rgb(54, 71, 221);">totaldict.ru</a></p>\r\n', 'jpg', '2017-03-22', '2017-04-09', 1, 1, 11),
(17, 'Тайна природы женщины', 'ВПИ участвует в проекте Молодежной администрации города «Нравственный эфир»', '<p>В&nbsp;рамках проекта Молодежной администрации города &laquo;Нравственный эфир&raquo; состоялась очередная встреча представителей организации &laquo;Общее дело&raquo; со&nbsp;студентами Волжского политехнического института. Совсем недавно ребята разбирались с&nbsp;темой нравственного развития мужчин, а&nbsp;вчера пытались понять, в&nbsp;чем заключен смысл жизни настоящей женщины и&nbsp;какова ее&nbsp;природа. Разобраться с&nbsp;этими вопросами помог профессиональный документальный фильм федерального проекта &laquo;Общее дело&raquo; и&nbsp;волонтеры организации Алена Овсюченко и&nbsp;Сергей Поповичев.</p>\r\n\r\n<p>Ознакомиться с&nbsp;фильмом можно, перейдя по&nbsp;ссылке&nbsp;<a href="https://xn----9sbkcac6brh7h.xn--p1ai/19846/" style="color: rgb(54, 71, 221);">https://общее-дело.рф/19846/</a></p>\r\n', 'jpg', '2017-03-20', '2017-04-07', 0, 0, 11),
(18, 'Материальная помощь', 'Выплата материальной помощи будет произведена в апреле.', '<p>При назначении и&nbsp;выплате материальной помощи у&nbsp;студентов и&nbsp;администрации института возникает ряд вопросов, связанных с&nbsp;основаниями и&nbsp;подтверждающими их&nbsp;документами. С&nbsp;учетом того, что количество поданных заявлений в&nbsp;текущем году резко увеличилось, администрацией института принято решение о&nbsp;создании органа, ответственного за&nbsp;рассмотрение таких заявлений.</p>\r\n\r\n<p>Как стало известно пресс-центру ВПИ, на&nbsp;данный момент приказом директора создается комиссия по&nbsp;рассмотрению оснований для выплаты материальной помощи. В&nbsp;конце марта члены комиссии рассмотрят все поступившие заявления. При наличии необходимых документов и&nbsp;оснований выплата материальной помощи произойдет в&nbsp;апреле текущего года.</p>\r\n', 'jpg', '2017-03-20', '2017-04-18', 1, 4, 11),
(19, 'Практика по программированию встраиваемых систем автобусов', '17 марта студенты направлений «Информатика и вычислительная техника» и «Программная инженерия» посетили с экскурсией ООО «Волгабас Волжский».', '<p>Экскурсию проводил инженер-программист встраиваемых систем ООО&nbsp;&laquo;Волгабас Волжский&raquo; Билялов Мухамед Харисович.</p>\r\n\r\n<p>Информационные технологии&nbsp;&mdash; сама эта сфера и&nbsp;её&nbsp;специалисты на&nbsp;современном рынке труда пользуются огромнейшей популярностью. Инженер-программист встраиваемых систем (Embedded Software Engineer)&nbsp;&mdash; одна из&nbsp;самых востребованных профессий в&nbsp;данной сфере.</p>\r\n\r\n<p>По&nbsp;результатам экскурсии зав. каф. Рыбанов А. А. и&nbsp;инженер-программист встраиваемых систем ООО&nbsp;&laquo;Волгабас Волжский&raquo; Билялов М. Х. согласовали ряд тем выпускных квалификационных работ по&nbsp;направлениям &laquo;Информатика и&nbsp;вычислительная техника&raquo; и&nbsp;&laquo;Программная инженерия&raquo; на&nbsp;2017/2018 учебный год.</p>\r\n', 'jpg', '2017-03-14', '2017-03-28', 2, 0, 11),
(20, 'ВПИ посетил президент', 'Президент Волжской торгово-промышленной палаты провел лекцию для студентов института.', '<p>Открытая лекция президента Волжской торгово-промышленной палаты и&nbsp;депутата городской Думы Владимира Глухова стала центральным событием первого весеннего дня для преподавателей, бакалавров и&nbsp;магистрантов кафедры экономики и&nbsp;менеджмента ВПИ. Анализируя проблемы развития предпринимательской среды Волжского в&nbsp;условиях глобальной нестабильности, Владимир Николаевич заметил: &laquo;Я&nbsp;очень рад, что сегодня Россия, развиваясь, не&nbsp;забывает про молодёжь. На&nbsp;сегодняшний день в&nbsp;нашем городе порядка десяти тысяч предпринимателей. Каждый год появляется несколько сот новых предпринимателей&raquo;.</p>\r\n\r\n<p>Владимир Николаевич пояснил, как в&nbsp;Волжской торгово-промышленной палате оказывают поддержку самой активной и&nbsp;деловой части студенчества, самостоятельно делающей первые шаги в&nbsp;малом бизнесе, той молодежи, которая хочет заниматься предпринимательством или развивать уже своё имеющееся дело.</p>\r\n', 'jpg', '2017-03-03', '2017-03-15', 1, 0, 11),
(21, 'ВВТ и ВИП: три аргумента в пользу обучения на контрактной форме обучения', 'В пылу борьбы за бюджетные места подавляющее большинство абитуриентов совершенно забывают про то, что существует и контрактная форма обучения.', '<p>Студентами направления 09.03.04 &quot;Программная инженерия&quot; подготовлен видеоролик: Три аргумента в пользу обучения на контрактной форме обучения на направлениях &quot;Информатика и вычислительная техника&quot; и &quot;Программная инженерия&quot;.</p>\r\n\r\n<p>Сценарий видеоролика: зав. каф. ВИТ Рыбанов А.А.</p>\r\n\r\n<p>Монтаж: Матрохин Андрей (ВИП-408)</p>\r\n\r\n<p>Звуковое сопровождение: Сергиенко Валерия (ВИП-408).</p>\r\n', 'jpg', '2017-03-14', '2017-03-31', 0, 0, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `w15_users`
--

CREATE TABLE IF NOT EXISTS `w15_users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `is_admin` tinyint(4) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `access_token` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='Пользователи';

--
-- Дамп данных таблицы `w15_users`
--

INSERT INTO `w15_users` (`id`, `username`, `password`, `is_admin`, `auth_key`, `access_token`) VALUES
(1, 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 1, '', ''),
(2, 'admin2', 'c84258e9c39059a89ab77d846ddab909', 1, '', ''),
(11, 'author1', 'b312ba4ffd5245fa2a1ab819ec0d0347', 0, 'Ao0gYO1tnsT3NSLP5QHZdFP9Z5BsdC7K', ''),
(12, '123', '4297f44b13955235245b2497399d7a93', 0, 'KlKlQcMJnvVzs6h7pjqMw5CvlEmPIPwZ', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

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
-- Индексы таблицы `w15_news`
--
ALTER TABLE `w15_news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `w15_users`
--
ALTER TABLE `w15_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `w15_news`
--
ALTER TABLE `w15_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `w15_users`
--
ALTER TABLE `w15_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
