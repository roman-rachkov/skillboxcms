-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 04 2020 г., 09:37
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `skilboxcms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `_lft` int(11) NOT NULL DEFAULT '0',
  `_rgt` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `moderated` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `_lft` int(11) NOT NULL DEFAULT '0',
  `_rgt` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `text`, `moderated`, `user_id`, `post_id`, `_lft`, `_rgt`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Первый комментарий. Отредактирован 2 раза', 1, 1, 3, 5, 8, NULL, '2020-11-29 22:39:54', '2020-12-03 22:57:11', NULL),
(2, 'второй комметарий', 0, 3, 3, 6, 7, 1, '2020-11-30 00:17:01', '2020-12-03 21:19:22', NULL),
(3, 'Офигенная статья', 1, 3, 3, 3, 4, NULL, '2020-11-30 01:25:29', '2020-12-03 21:19:27', NULL),
(4, 'Вот это поврот', 1, 1, 3, 1, 2, NULL, '2020-12-03 19:28:14', '2020-12-03 19:28:14', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `key` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `name`, `created_at`, `updated_at`) VALUES
(1, 'edit_articles', 'Редактирование статей', '2020-10-24 01:35:55', '2020-10-24 01:35:55'),
(2, 'create_articles', 'Создание статей', '2020-10-24 01:35:55', '2020-10-24 01:35:55'),
(3, 'create_comment', 'Написать комментарий', '2020-10-24 01:36:32', '2020-10-24 01:36:32'),
(4, 'edit_comment', 'Редактировать комментарий', '2020-10-24 01:36:32', '2020-10-24 01:36:32'),
(5, 'moderate_comments', 'Модерировать комментарий', '2020-10-24 01:38:10', '2020-10-24 01:38:10'),
(6, 'edit_settings', 'Настройка ЦМС', '2020-10-24 01:38:10', '2020-10-24 01:38:10'),
(7, 'VIEW_ADMIN', 'Доступ к админке', '2020-10-24 01:43:31', '2020-10-24 01:43:31'),
(8, 'delete_articles', 'Удалить статью', '2020-10-24 01:44:51', '2020-10-24 01:44:51'),
(9, 'delete_comment', 'Удалить комментарий', '2020-10-24 01:44:51', '2020-10-24 01:44:51'),
(10, 'edit_permissions', 'Редктирование прав', '2020-11-20 05:57:46', '2020-11-20 05:57:46'),
(11, 'edit_users', 'Редактирование пользователей', '2020-11-20 05:57:46', '2020-11-20 05:57:46'),
(12, 'edit_roles', 'Редактирование ролей', '2020-11-20 05:58:15', '2020-11-20 05:58:15');

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2020-10-24 01:47:30', '2020-10-24 01:47:30'),
(1, 3, '2020-10-24 01:49:13', '2020-10-24 01:49:13'),
(2, 2, '2020-10-24 01:47:30', '2020-10-24 01:47:30'),
(2, 3, '2020-10-24 01:48:46', '2020-10-24 01:48:46'),
(3, 1, '2020-10-24 01:47:07', '2020-10-24 01:47:07'),
(3, 2, '2020-10-24 01:47:41', '2020-10-24 01:47:41'),
(3, 3, '2020-10-24 01:48:46', '2020-10-24 01:48:46'),
(4, 3, '2020-10-24 01:49:13', '2020-10-24 01:49:13'),
(5, 2, '2020-10-24 01:48:06', '2020-10-24 01:48:06'),
(5, 3, '2020-10-24 01:49:26', '2020-10-24 01:49:26'),
(6, 3, '2020-10-24 01:49:26', '2020-10-24 01:49:26'),
(7, 3, '2020-10-24 01:49:36', '2020-10-24 01:49:36'),
(8, 2, '2020-10-24 01:48:06', '2020-10-24 01:48:06'),
(8, 3, '2020-10-24 01:49:02', '2020-10-24 01:49:02'),
(9, 2, '2020-10-24 01:47:41', '2020-10-24 01:47:41'),
(9, 3, '2020-10-24 01:49:02', '2020-10-24 01:49:02');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `type` enum('post','page') NOT NULL DEFAULT 'post',
  `img_src` varchar(255) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`, `type`, `img_src`, `published`, `created_at`, `updated_at`, `deleted_at`, `user_id`) VALUES
(1, 'test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur illum in magnam mollitia nisi praesentium reiciendis ut voluptatibus? Accusamus alias atque commodi consequuntur cum debitis eaque eius fugit hic illum incidunt inventore laboriosam libero maxime necessitatibus nemo nostrum numquam odio officia, officiis pariatur qui quos repellendus suscipit, tempora ullam unde voluptas! Accusamus commodi consequatur cumque eligendi enim eos et id magni maiores, maxime minus nihil nisi numquam officiis omnis, provident quae repudiandae ullam unde velit. Ab aliquam at aut autem culpa cum dignissimos enim illo, ipsum iure nisi, quod sit sunt. Ab ad architecto asperiores doloremque eos fuga, ipsa, ipsam non porro qui quos sapiente sit tempore voluptas voluptatem? Accusantium architecto consectetur corporis eius est excepturi in ipsum, magni nesciunt placeat quaerat quis quo quod sit, totam unde voluptate! Assumenda dolore doloremque error facilis mollitia nihil nisi quia quis veniam voluptas. Dolore dolorem harum neque voluptate! A aliquam amet aspernatur at blanditiis cumque ducimus, ea exercitationem inventore mollitia nemo odit pariatur perspiciatis quasi ratione sequi suscipit. Ad autem iusto quaerat quia quod reprehenderit sit. Accusantium aperiam architecto at debitis ea eos id incidunt, laborum laudantium nesciunt numquam optio pariatur quibusdam, quos sint velit vero voluptas voluptatibus. Ad animi assumenda blanditiis consectetur deserunt, distinctio doloribus eaque eligendi est ex, ipsa laudantium libero nemo nihil officiis quia quisquam ratione reiciendis sapiente, sint. Alias commodi deleniti, deserunt dolor earum et fugit, id libero magnam minus modi, nobis odio quaerat quibusdam quidem quisquam soluta. Alias, animi assumenda atque, aut blanditiis consequatur consequuntur cum deserunt, eaque eligendi esse exercitationem hic impedit iusto labore libero magnam necessitatibus nulla officiis omnis reiciendis rerum tempore unde velit vitae? Alias at consectetur culpa debitis doloribus eligendi enim eos eum excepturi expedita fugit illo ipsa iste magnam molestiae mollitia nam necessitatibus nihil provident quo ratione repellendus, rerum saepe sint soluta tempora unde voluptatum. Consectetur impedit in neque odio odit! A aperiam aspernatur assumenda ea fuga illo, impedit maiores nemo perferendis quis quod recusandae repellendus saepe temporibus tenetur ullam vitae. Ab animi asperiores aut corporis dolor exercitationem expedita, explicabo incidunt libero maxime nihil sint, vel voluptate? Aliquid amet aperiam corporis dolor, dolorum eius esse ex inventore iste magnam maxime minima nesciunt nostrum obcaecati omnis quaerat recusandae repudiandae, saepe sint totam vel voluptate voluptatibus? Blanditiis dolores doloribus, error est fuga ipsa magnam non numquam possimus, rem, rerum temporibus? Architecto dignissimos doloremque ducimus eaque et eum id impedit ipsam, numquam odit quia sunt unde vel veritatis voluptatibus. Accusamus aspernatur assumenda autem cum dolorum eligendi, modi molestias, nisi obcaecati provident, quia quis quod repellendus reprehenderit voluptate? Ab asperiores atque autem deserunt eveniet excepturi inventore necessitatibus nobis praesentium quam, quidem quis repellat repellendus suscipit veritatis voluptas voluptatem voluptatum! Adipisci aliquid animi cum magnam sapiente. Nobis.', 'post', '\\articles\\5fb61171c14cc.jpg', 1, '2020-11-18 01:39:34', '2020-11-18 23:32:17', NULL, 1),
(2, 'тестовая статья 2', 'Значимость этих проблем настолько очевидна, что консультация с широким активом позволяет выполнять важные задания по разработке направлений прогрессивного развития. Значимость этих проблем настолько очевидна, что реализация намеченных плановых заданий позволяет оценить значение модели развития.\r\n\r\nС другой стороны начало повседневной работы по формированию позиции позволяет оценить значение систем массового участия. Повседневная практика показывает, что начало повседневной работы по формированию позиции требуют от нас анализа существенных финансовых и административных условий.\r\n\r\nПовседневная практика показывает, что дальнейшее развитие различных форм деятельности позволяет оценить значение дальнейших направлений развития. Равным образом рамки и место обучения кадров способствует подготовки и реализации дальнейших направлений развития. Идейные соображения высшего порядка, а также начало повседневной работы по формированию позиции в значительной степени обуславливает создание направлений прогрессивного развития.', 'post', '\\articles\\5fb5fa99c0cc7.jpg', 1, '2020-11-18 21:54:49', '2020-11-24 21:51:14', NULL, 1),
(3, 'Простая статья', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni provident quo voluptatibus! Atque consectetur deleniti distinctio maxime optio recusandae reiciendis repudiandae similique suscipit tempore. Aut culpa delectus dolores doloribus et excepturi expedita impedit molestiae nesciunt quia, velit vitae. Adipisci alias atque autem blanditiis commodi dicta dolor eos eveniet ex fugit hic id illo in inventore ipsam labore magni, minima molestias nihil nisi, odio officiis pariatur repellat, saepe tempore ut voluptas? Asperiores autem consequuntur culpa cum deleniti dolores eaque eligendi eum hic saepe. Aliquam cumque dignissimos dolor enim est, excepturi id laboriosam libero minus molestiae nemo provident, rem sit tempora velit vero voluptatem? Debitis dolor doloribus ex facere illo minus nisi nobis quos rem ullam! A corporis cumque dicta, ducimus facilis fugiat ipsa, mollitia nemo odit officiis quos rerum sapiente vel veniam voluptatibus. A accusamus architecto dolore impedit molestias nobis nostrum. Aut est, quo! A atque cupiditate dignissimos dolorem eligendi, incidunt iure, labore officia omnis quam quas quasi quidem, quos repellat repellendus. Accusantium aliquam cumque hic, ipsam odio pariatur praesentium sed tempore vitae! Alias deserunt explicabo laborum non officia, perspiciatis quasi voluptatem. Consequatur delectus eius et modi mollitia pariatur qui! Adipisci doloribus dolorum explicabo hic impedit minima, nemo nobis provident veniam voluptatum! Amet, architecto corporis cumque dolore exercitationem ipsam iure maxime natus neque quia reiciendis sunt? Ducimus impedit itaque odio possimus recusandae rerum! Assumenda deserunt qui recusandae reiciendis tenetur! Amet aut consequatur consequuntur eaque eius, explicabo fuga fugit harum impedit ipsa iste itaque iusto, laborum modi necessitatibus neque nesciunt, nostrum perspiciatis ratione recusandae reiciendis rerum tempora temporibus tenetur veritatis? Itaque, magnam nemo pariatur perferendis recusandae voluptates. Atque consectetur consequatur, cumque impedit optio quibusdam sapiente. A ab accusamus ad adipisci aliquid aspernatur aut culpa dolore ea eius eum, excepturi fuga fugit hic incidunt ipsa maiores nam nesciunt nihil nisi odio, officia perspiciatis possimus sapiente sint totam voluptas voluptatum? Et impedit quas quos? Accusamus asperiores beatae consequatur cupiditate dolores, doloribus esse et expedita, ipsa ipsum iure labore laborum magnam maxime minus necessitatibus nemo obcaecati odit quis rem temporibus vel veritatis vero! A dolores harum tempore? Aliquid aperiam architecto asperiores assumenda consectetur dolore doloribus eius et expedita fugiat hic illum impedit inventore labore libero molestias necessitatibus nemo, neque nulla officia quaerat quos ratione rem saepe suscipit ut vel vero. Atque consequuntur iste nulla optio repellat ullam. Adipisci et nemo nisi voluptatum? Assumenda blanditiis distinctio dolorem et fugit ipsum, iste magni nesciunt nulla quam sequi similique, tempora. A animi cupiditate delectus enim eveniet molestias nulla quas similique velit vero. Consequuntur enim fugiat illum inventore necessitatibus neque nostrum placeat quaerat, quam reiciendis repellendus sint tenetur voluptatibus. Accusantium adipisci asperiores assumenda dolorem eligendi enim eos et, eveniet illum minima officiis perferendis rem sint vero voluptatum? Animi assumenda debitis dolor ea earum fugiat illum in inventore ipsa, iusto libero nisi, odio placeat praesentium rem sint, voluptas. Assumenda cupiditate illo nam unde. Adipisci beatae, cumque laboriosam nobis quaerat quas ut? Ab aliquam beatae cum, delectus, eveniet ex impedit iure laborum, neque nobis perferendis porro quae quibusdam tempora veritatis voluptatibus?', 'post', NULL, 1, '2020-11-19 16:51:25', '2020-11-19 16:51:25', NULL, 1),
(8, 'Статья для удаления', 'Большая статья об удалении', 'post', '\\articles\\5fbdec9894e58.png', 0, '2020-11-24 22:33:12', '2020-11-24 22:33:41', '2020-11-24 22:33:41', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `post_category`
--

CREATE TABLE `post_category` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `key` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `apdated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `key`, `created_at`, `apdated_at`) VALUES
(1, 'Пользователь', 'user', '2020-10-24 01:40:42', '2020-10-24 01:40:42'),
(2, 'Модератор', 'moderator', '2020-10-24 01:40:42', '2020-10-24 01:40:42'),
(3, 'Администратор', 'administrator', '2020-10-24 01:40:52', '2020-10-24 01:40:52');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `key`, `name`, `value`) VALUES
(1, 'result_per_page', 'Результатов на странице по умолчанию', '20');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `subscribed`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'admin@email.ru', 'admin', '$2y$10$hoCBqm7ieTCAqeuJbzscBOaIpgNE1n8v6xsqkOL4EQXIaSn8pKVC2', 1, NULL, '2020-10-23 22:33:31', '2020-11-19 19:21:34'),
(2, 'moderator@test.ru', 'SuperModerator', '$2y$10$YdWQM.NoUMXcb7I52KCER.I3EO/S6sGU7Zun9YJvH9R0xcKbrFNUG', 0, NULL, '2020-11-18 00:25:16', '2020-11-18 00:25:16'),
(3, 'user@test.ru', 'SimpleUser', '$2y$10$w4OYVyx5YFwVL8R9nUOEq.ezjIspD1H9n8yDNH.5Wkd/H1m283g3O', 0, NULL, '2020-11-19 19:06:16', '2020-11-19 20:52:57'),
(4, 'another@subscriber.ru', NULL, NULL, 1, NULL, '2020-11-19 19:09:39', '2020-11-19 19:09:39'),
(5, 'registered@subscriber.ru', 'registeredSubscriber', '$2y$10$JDzO7Fl00dSrQ986tpWqK.R0J18.ieMYqQHo9KAHBXkzSQKupGK0a', 1, NULL, '2020-11-19 19:10:22', '2020-11-19 19:34:16');

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 3, '2020-10-24 07:10:45', '2020-10-24 07:10:45'),
(2, 2, '2020-11-20 03:53:42', '2020-11-20 03:53:42'),
(3, 1, '2020-11-20 03:52:57', '2020-11-20 03:52:57'),
(4, 1, '2020-11-20 03:53:42', '2020-11-20 03:53:42');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categories_categories_idx` (`parent_id`,`_lft`,`_rgt`) USING BTREE;

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_comments` (`post_id`),
  ADD KEY `fk_comments_comments1_idx` (`parent_id`),
  ADD KEY `fk_comments_users1_idx` (`user_id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Индексы таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `fk_permissions_has_roles_roles1_idx` (`role_id`),
  ADD KEY `fk_permissions_has_roles_permissions1_idx` (`permission_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_user` (`user_id`) USING BTREE;

--
-- Индексы таблицы `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`post_id`,`category_id`),
  ADD KEY `fk_articles_has_categories_categories1_idx` (`category_id`),
  ADD KEY `fk_articles_has_categories_articles1_idx` (`post_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `fk_users_has_roles_roles1_idx` (`role_id`),
  ADD KEY `fk_users_has_roles_users1_idx` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `post_category`
--
ALTER TABLE `post_category`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_categories` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_comments` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_posts_comments` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `fk_permissions_has_roles_permissions1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permissions_has_roles_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `post_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `fk_articles_has_categories_articles1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_articles_has_categories_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `fk_users_has_roles_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_roles_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
