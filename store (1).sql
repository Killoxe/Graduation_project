-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 05 2018 г., 15:36
-- Версия сервера: 5.6.37
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `store`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accessories`
--

CREATE TABLE `accessories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `quantity` varchar(60) DEFAULT NULL,
  `id_view` bigint(20) DEFAULT NULL,
  `id_provider` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `accessories`
--

INSERT INTO `accessories` (`id`, `name`, `quantity`, `id_view`, `id_provider`) VALUES
(1, 'Петля для вкладных дверей', '10', 1, 2),
(2, 'Петля для наклонных дверей ', '12', 1, 1),
(3, 'Комплект для ящика с доводчиком', '20', 5, 1),
(4, 'Ручка мебельная', '15', 2, 3),
(5, 'Мебельный магнит', '13', 3, 4),
(6, 'Замок мебельный', '8', 3, 4),
(7, 'Ножка мебельная', '22', 6, 1),
(8, 'Угловая пластиковая ножка', '18', 6, 3),
(9, 'Нет', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `associate`
--

CREATE TABLE `associate` (
  `id` bigint(20) NOT NULL,
  `login` varchar(60) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `surname` varchar(60) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `patron` varchar(60) DEFAULT NULL,
  `phone` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `associate`
--

INSERT INTO `associate` (`id`, `login`, `pass`, `surname`, `name`, `patron`, `phone`) VALUES
(5, 'admin1', '5b1b68a9abf4d2cd155c81a9225fd158', 'Врушкин', 'Николай', 'Александрович', '89998523027'),
(7, 'admin3', '4297f44b13955235245b2497399d7a93', NULL, NULL, NULL, NULL),
(8, 'admin4', '96e79218965eb72c92a549dd5a330112', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) NOT NULL,
  `Id_goods` bigint(20) NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `quantity` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `Id_goods`, `id_customer`, `quantity`) VALUES
(1, 56, 17, '10');

-- --------------------------------------------------------

--
-- Структура таблицы `category_goods`
--

CREATE TABLE `category_goods` (
  `id` bigint(20) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_goods`
--

INSERT INTO `category_goods` (`id`, `name`) VALUES
(1, 'Табуреты'),
(2, 'Шкафы'),
(3, 'Барные стулья'),
(4, 'Буфеты'),
(5, 'Стеллажи'),
(6, 'Диваны'),
(8, 'Кресла'),
(9, 'Стулья'),
(10, 'Обеденные стулья'),
(11, 'Тумбы под TV'),
(12, 'Кофейные и журнальные столики'),
(13, 'Рабочие столы'),
(14, 'Туалетные столики (консоли)'),
(15, 'Комоды'),
(16, 'Тумбочки'),
(17, 'Барные столы'),
(18, 'Пуфы'),
(19, 'Обеденные столы');

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) NOT NULL,
  `e_mail` varchar(60) DEFAULT NULL,
  `pass` varchar(60) DEFAULT NULL,
  `surname` varchar(60) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `patron` varchar(60) DEFAULT NULL,
  `phone` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id`, `e_mail`, `pass`, `surname`, `name`, `patron`, `phone`) VALUES
(9, 'sss@s.s', '4297f44b13955235245b2497399d7a93', 'Иванов', 'Иван', 'Иванович', '77777777820'),
(15, 'rrr@f.f', '4297f44b13955235245b2497399d7a93', NULL, NULL, NULL, NULL),
(16, 'dasdad@asdas.asdad', '4297f44b13955235245b2497399d7a93', NULL, NULL, NULL, NULL),
(17, 'oooof@asda.asda', '4297f44b13955235245b2497399d7a93', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `delivery`
--

CREATE TABLE `delivery` (
  `id_order` bigint(20) NOT NULL,
  `id_assoc` bigint(20) NOT NULL,
  `date_deliv` date NOT NULL,
  `time_deliv` time NOT NULL,
  `value_deliv` varchar(60) NOT NULL,
  `status` varchar(60) NOT NULL,
  `view` varchar(60) NOT NULL,
  `street` varchar(60) NOT NULL,
  `house` varchar(60) NOT NULL,
  `housing` varchar(60) NOT NULL,
  `structure` varchar(60) NOT NULL,
  `apatrment` varchar(60) NOT NULL,
  `comet` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `disigner`
--

CREATE TABLE `disigner` (
  `id` bigint(20) NOT NULL,
  `surname` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `patron` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `disigner`
--

INSERT INTO `disigner` (`id`, `surname`, `name`, `patron`) VALUES
(1, 'Сипцов', 'Серегй', 'Александрович'),
(2, 'Ирискина', 'Юлия', 'Борисовна'),
(3, 'Иванов', 'Руслан', 'Игорович');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` bigint(20) NOT NULL,
  `id_category` bigint(20) DEFAULT NULL,
  `id_access` bigint(20) DEFAULT NULL,
  `id_disigner` bigint(20) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `value` decimal(8,0) DEFAULT NULL,
  `quantity` varchar(60) DEFAULT NULL,
  `characterr` text,
  `description` text,
  `color` varchar(20) DEFAULT NULL,
  `material` varchar(60) DEFAULT NULL,
  `img_goods` varchar(250) DEFAULT NULL,
  `model` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `id_category`, `id_access`, `id_disigner`, `name`, `value`, `quantity`, `characterr`, `description`, `color`, `material`, `img_goods`, `model`) VALUES
(56, 12, 9, 2, 'Кофейный стол HI', '22000', '13', 'Высота: 39 см\r\nШирина: 40 см\r\nДлина: 80 см\r\nТип материала каркаса: Акрил\r\nЦвет каркаса: Красный', 'Дизайнерский стильный журнальный акриловый столик HI от EMPHASIS.\r\n\r\nСтильный и модный хай-тек-дизайн кофейного стола HI приковывает к себе взгляды и приятен на вид. В зависимости от освещения он приобретает новые оттенки, которые делают интерьер ярким и неповторимым. Если вы ищете простой вариант освежить интерьер, то не обязательно хвататься за рамки и вазы — всегда можно обзавестись стильным дизайнерским кофейным столом HI.\r\n\r\nПо бокам оригинального кофейного стола Modern Acrylic У оригинального кофейного стола HI имеются сгибы в которых можно хранить журналы и газеты. Яркие неоновые цвета акрила делают столик и отличным вариантом для детской.', 'красный', 'пластик', '../diplom/goods/1.jpg', '../diplom/model/стол.html'),
(59, 19, 7, 1, 'Обеденный стол Beam', '130000', '8', 'Высота: 78 см, Ширина: 100 см\r\nДлина: 300 см\r\nЦвет ножек: Черный глянец\r\nЦвет столешницы: Коричневый\r\nМатериал столешницы: Массив вяза состаренный\r\nТип материала столешницы: Дерево\r\nТип материала ножек: Сталь', 'Дизайнерская длинный обеденный стол Beam на черных толстых металлических ножках и столешницей из состаренного массива вяза от Cosmo (Космо).\r\n\r\nИндустриальный стиль не теряет популярности уже многие годы. Грубые формы, необработанные поверхности, простые и недорогие материалы. Кроме своеобразной эстетической привлекательности стиль отличается практичностью и функциональностью.\r\n\r\nСтол Beam — отличный образчик индустриального стиля. Столешница изготовлена из натуральной древесины, декорированной под старину. Она патинирована натуральными цветами от бежевого до темно-коричневого с матовым покрытием. Сколы, трещины, вмятины, оставленные короедом ходы — все это составляющие эстетики индустриального стиля. Ножки, изготовленные в виде монолитной конструкции, представлены в двух вариантах: темно-сером и цвета гальванизированной стали. На торцах ножек установлены нескользящие насадки, помимо всего прочего защищающие пол от царапин.\r\n\r\nОригинальная стилизации под «фермерскую» обстановку, лофт, собственно индустриальный стиль — этот список далеко не исчерпывает возможности использования стола Beam. Необычный и колоритный, он добавит интерьеру самобытности и уюта.', 'черный', 'дерево', '../diplom/goods/21390-beam.jpeg', NULL),
(60, 8, 7, 3, 'Кресло Yoda красное', '72690', '5', 'Высота: 134 см\r\nВысота сиденья: 39 см\r\nШирина: 63 см, Глубина: 70 см\r\nЦвет спинки: Красный\r\nМатериал спинки: Ротанг, Нейлон\r\nЦвет сидения: Красный\r\nТип материала сидения: Сталь', 'Дизайнерское красное кресло Yoda (Йода) из ротанга в экостиле от Kenneth Cobonpue (Кеннет Кобонпу)\r\n\r\nЛюбимец голливудских звезд, дизайнер года 2014 по версии Maison & Objet, филиппинец Кеннет Кобонпу — гуру экологичных интерьеров, научивший европейцев ценить азиатский дизайн не меньше итальянского и познакомивший их с экзотикой и старинными ремеслами и материалами своей родины. Его ноу-хау — плетеная мебель из ротанга, столь популярная на Юго-Востоке, где из этой разновидности пальмы издавна делали мебель и предметы обихода. В Европу ротанг попал в XIX веке, а сегодня необычный экологичный материал вновь в моде на волне популярности движения органик и осознанного потребления.\r\n\r\nОригинальная мебель от Кеннета идеально подойдет для создания атмосферы пышных цветущих тропиков прямо в городской квартире или на даче, особенно легендарное кресло Yoda красное из стали, оплетенной ротангом. Оно было официально признано самым копируемым дизайнерским креслом в мире и выставлено в Музее Филадельфии. Кресло Yoda красное словно пучки экзотического растения солнечным летним днем моментально заряжает энергией и отличным настроением и, конечно, приковывает к себе все взгляды благодаря ярким оттенкам. Сидя в нем вы будете ощущать себя на мягком лугу среди цветов, а для ощущения полного комфорта положите в функциональное пространство между сиденьем и основанием подушку, плед или стопку любимых журналов.', 'красный', 'нейлон', '../diplom/goods/83329-krasnoe.jpeg', NULL),
(61, 9, 9, 2, 'Стул Wave', '45000', '4', 'Высота: 90 см\r\nШирина: 48 см\r\nДлина: 60 см\r\nТип материала каркаса: Акрил\r\nЦвет каркаса: Красный', 'dxfdf', 'голубой', 'пластик', '../diplom/goods/11.jpg', '../diplom/model/стул.html'),
(62, 5, 5, 1, 'Стеллаж', '32500', '5', 'ываыв', 'ыав', 'ываыа', '234', '../diplom/goods/id-62.jpg', '../diplom/model/id-62.html');

-- --------------------------------------------------------

--
-- Структура таблицы `goods_in_orders`
--

CREATE TABLE `goods_in_orders` (
  `id` bigint(20) NOT NULL,
  `id_goods` bigint(20) NOT NULL,
  `id_orders` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods_in_orders`
--

INSERT INTO `goods_in_orders` (`id`, `id_goods`, `id_orders`) VALUES
(1, 56, 1),
(2, 60, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `id_assoc` bigint(20) NOT NULL,
  `date_ord` date NOT NULL,
  `time_ord` time NOT NULL,
  `status_ord` varchar(20) NOT NULL,
  `value_ord` decimal(8,2) NOT NULL,
  `quantity` varchar(60) NOT NULL,
  `nomberCard` bigint(15) NOT NULL,
  `year` bigint(4) NOT NULL,
  `month` bigint(4) NOT NULL,
  `securCod` bigint(5) NOT NULL,
  `name` varchar(60) NOT NULL,
  `surname` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `id_customer`, `id_assoc`, `date_ord`, `time_ord`, `status_ord`, `value_ord`, `quantity`, `nomberCard`, `year`, `month`, `securCod`, `name`, `surname`) VALUES
(1, 9, 5, '2018-05-01', '03:20:15', 'в пути', '45.00', 'чсмчм', 45, 4, 5, 454, 'Николай', 'Врушкин'),
(2, 9, 7, '2018-06-01', '13:15:31', 'чсм', '45.00', '13', 4546, 4545, 454, 4545, 'ывыфвф', 'ыфвывф');

-- --------------------------------------------------------

--
-- Структура таблицы `provider`
--

CREATE TABLE `provider` (
  `id` bigint(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `e_mail` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `provider`
--

INSERT INTO `provider` (`id`, `name`, `phone`, `e_mail`) VALUES
(1, 'FGV', '89005120927', 'FGV@gmail.com'),
(2, 'Firmax', '89005151610', 'Firmax444@gmail.com'),
(3, 'Аметист', '84957447042', 'ametist@mail.ru'),
(4, 'МДМ-Комплект', '88005558050', 'MDM@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` bigint(20) NOT NULL,
  `id_goods` bigint(20) NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `review` varchar(300) NOT NULL,
  `rating` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `id_goods`, `id_customer`, `review`, `rating`) VALUES
(1, 56, 9, 'ываываыва', '5'),
(2, 60, 9, 'вапваппа', '5');

-- --------------------------------------------------------

--
-- Структура таблицы `view`
--

CREATE TABLE `view` (
  `id` bigint(20) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `view`
--

INSERT INTO `view` (`id`, `name`) VALUES
(1, 'Петли мебельные'),
(2, 'Ручки мебельные'),
(3, 'Замки мебельные'),
(5, 'Системы выдвижных ящиков'),
(6, 'Опоры');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_view` (`id_view`),
  ADD KEY `id_provider` (`id_provider`);

--
-- Индексы таблицы `associate`
--
ALTER TABLE `associate`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_goods`
--
ALTER TABLE `category_goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_assoc` (`id_assoc`);

--
-- Индексы таблицы `disigner`
--
ALTER TABLE `disigner`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`,`id_access`,`id_disigner`),
  ADD KEY `id_disigner` (`id_disigner`),
  ADD KEY `id_access` (`id_access`);

--
-- Индексы таблицы `goods_in_orders`
--
ALTER TABLE `goods_in_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_goods` (`id_goods`),
  ADD KEY `id_orders` (`id_orders`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_delivery` (`id_assoc`);

--
-- Индексы таблицы `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_goods` (`id_goods`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Индексы таблицы `view`
--
ALTER TABLE `view`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `associate`
--
ALTER TABLE `associate`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `category_goods`
--
ALTER TABLE `category_goods`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id_order` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `disigner`
--
ALTER TABLE `disigner`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT для таблицы `goods_in_orders`
--
ALTER TABLE `goods_in_orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `provider`
--
ALTER TABLE `provider`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `view`
--
ALTER TABLE `view`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accessories`
--
ALTER TABLE `accessories`
  ADD CONSTRAINT `accessories_ibfk_1` FOREIGN KEY (`id_view`) REFERENCES `view` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `accessories_ibfk_2` FOREIGN KEY (`id_provider`) REFERENCES `provider` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`id_assoc`) REFERENCES `associate` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_ibfk_1` FOREIGN KEY (`id_access`) REFERENCES `accessories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `goods_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category_goods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `goods_ibfk_3` FOREIGN KEY (`id_disigner`) REFERENCES `disigner` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `goods_in_orders`
--
ALTER TABLE `goods_in_orders`
  ADD CONSTRAINT `goods_in_orders_ibfk_1` FOREIGN KEY (`id_goods`) REFERENCES `goods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `goods_in_orders_ibfk_2` FOREIGN KEY (`id_orders`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_assoc`) REFERENCES `associate` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_goods`) REFERENCES `goods` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
