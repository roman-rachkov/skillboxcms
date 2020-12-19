-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 19 2020 г., 10:05
-- Версия сервера: 5.7.29
-- Версия PHP: 7.3.17

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
(1, 'Первый комментарий. Отредактирован 2 раза', 1, 1, 3, 7, 10, NULL, '2020-11-29 22:39:54', '2020-12-17 17:01:56', NULL),
(2, 'второй комметарий', 0, 3, 3, 8, 9, 1, '2020-11-30 00:17:01', '2020-12-18 23:35:29', NULL),
(3, 'Офигенная статья', 1, 3, 3, 5, 6, NULL, '2020-11-30 01:25:29', '2020-12-17 17:01:56', NULL),
(4, 'Вот это поврот', 1, 1, 3, 3, 4, NULL, '2020-12-03 19:28:14', '2020-12-17 17:01:56', NULL),
(5, 'asdasdasd111', 1, 1, 33, 1, 2, NULL, '2020-12-17 17:01:56', '2020-12-18 18:26:48', NULL);

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
(11, 'edit_user', 'Редактирование пользователей', '2020-11-20 05:57:46', '2020-11-20 05:57:46'),
(13, 'create_page', 'Создать страницу', '2020-12-19 05:35:16', NULL),
(14, 'edit_page', 'Редактировать страницу', '2020-12-19 05:35:16', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(1, 3, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(2, 2, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(2, 3, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(3, 1, '2020-12-19 05:40:16', '2020-12-19 05:40:16'),
(3, 2, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(3, 3, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(4, 2, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(4, 3, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(5, 2, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(5, 3, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(6, 3, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(7, 2, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(7, 3, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(8, 2, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(8, 3, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(9, 2, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(9, 3, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(10, 3, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(11, 3, '2020-12-19 05:40:15', '2020-12-19 05:40:15'),
(13, 3, '2020-12-19 05:40:16', '2020-12-19 05:40:16'),
(14, 3, '2020-12-19 05:40:16', '2020-12-19 05:40:16');

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
(3, 'Простая статья', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni provident quo voluptatibus! Atque consectetur deleniti distinctio maxime optio recusandae reiciendis repudiandae similique suscipit tempore. Aut culpa delectus dolores doloribus et excepturi expedita impedit molestiae nesciunt quia, velit vitae. Adipisci alias atque autem blanditiis commodi dicta dolor eos eveniet ex fugit hic id illo in inventore ipsam labore magni, minima molestias nihil nisi, odio officiis pariatur repellat, saepe tempore ut voluptas? Asperiores autem consequuntur culpa cum deleniti dolores eaque eligendi eum hic saepe. Aliquam cumque dignissimos dolor enim est, excepturi id laboriosam libero minus molestiae nemo provident, rem sit tempora velit vero voluptatem? Debitis dolor doloribus ex facere illo minus nisi nobis quos rem ullam! A corporis cumque dicta, ducimus facilis fugiat ipsa, mollitia nemo odit officiis quos rerum sapiente vel veniam voluptatibus. A accusamus architecto dolore impedit molestias nobis nostrum. Aut est, quo! A atque cupiditate dignissimos dolorem eligendi, incidunt iure, labore officia omnis quam quas quasi quidem, quos repellat repellendus. Accusantium aliquam cumque hic, ipsam odio pariatur praesentium sed tempore vitae! Alias deserunt explicabo laborum non officia, perspiciatis quasi voluptatem. Consequatur delectus eius et modi mollitia pariatur qui! Adipisci doloribus dolorum explicabo hic impedit minima, nemo nobis provident veniam voluptatum! Amet, architecto corporis cumque dolore exercitationem ipsam iure maxime natus neque quia reiciendis sunt? Ducimus impedit itaque odio possimus recusandae rerum! Assumenda deserunt qui recusandae reiciendis tenetur! Amet aut consequatur consequuntur eaque eius, explicabo fuga fugit harum impedit ipsa iste itaque iusto, laborum modi necessitatibus neque nesciunt, nostrum perspiciatis ratione recusandae reiciendis rerum tempora temporibus tenetur veritatis? Itaque, magnam nemo pariatur perferendis recusandae voluptates. Atque consectetur consequatur, cumque impedit optio quibusdam sapiente. A ab accusamus ad adipisci aliquid aspernatur aut culpa dolore ea eius eum, excepturi fuga fugit hic incidunt ipsa maiores nam nesciunt nihil nisi odio, officia perspiciatis possimus sapiente sint totam voluptas voluptatum? Et impedit quas quos? Accusamus asperiores beatae consequatur cupiditate dolores, doloribus esse et expedita, ipsa ipsum iure labore laborum magnam maxime minus necessitatibus nemo obcaecati odit quis rem temporibus vel veritatis vero! A dolores harum tempore? Aliquid aperiam architecto asperiores assumenda consectetur dolore doloribus eius et expedita fugiat hic illum impedit inventore labore libero molestias necessitatibus nemo, neque nulla officia quaerat quos ratione rem saepe suscipit ut vel vero. Atque consequuntur iste nulla optio repellat ullam. Adipisci et nemo nisi voluptatum? Assumenda blanditiis distinctio dolorem et fugit ipsum, iste magni nesciunt nulla quam sequi similique, tempora. A animi cupiditate delectus enim eveniet molestias nulla quas similique velit vero. Consequuntur enim fugiat illum inventore necessitatibus neque nostrum placeat quaerat, quam reiciendis repellendus sint tenetur voluptatibus. Accusantium adipisci asperiores assumenda dolorem eligendi enim eos et, eveniet illum minima officiis perferendis rem sint vero voluptatum? Animi assumenda debitis dolor ea earum fugiat illum in inventore ipsa, iusto libero nisi, odio placeat praesentium rem sint, voluptas. Assumenda cupiditate illo nam unde. Adipisci beatae, cumque laboriosam nobis quaerat quas ut? Ab aliquam beatae cum, delectus, eveniet ex impedit iure laborum, neque nobis perferendis porro quae quibusdam tempora veritatis voluptatibus?', 'post', NULL, 1, '2020-11-19 16:51:25', '2020-12-15 18:59:03', NULL, 1),
(8, 'Статья для удаления', 'Большая статья об удалении', 'post', '\\articles\\5fbdec9894e58.png', 0, '2020-11-24 22:33:12', '2020-11-24 22:33:41', '2020-11-24 22:33:41', 1),
(9, 'Политика конфидициальности', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi distinctio, dolorum eius enim excepturi expedita facilis illo, impedit ipsam labore magni maxime nemo, neque porro quidem repellendus sequi tempora tenetur voluptatibus voluptatum? Aut, deleniti dolor id nesciunt qui ratione unde. Alias, aut autem dolor eius facilis illo in ipsa labore necessitatibus perspiciatis, quam quibusdam quo velit voluptas voluptatibus? Beatae cum doloribus id inventore quos recusandae sunt? Adipisci consequuntur delectus dolor nesciunt sunt? Aliquid ducimus eligendi eum iste minima sed sit veritatis! Accusantium aperiam commodi debitis dolor dolorem doloribus dolorum ducimus earum ex facere, illum inventore ipsum molestiae natus non odio perferendis perspiciatis quas qui recusandae saepe similique sit sunt vel voluptatibus. Architecto beatae cum enim eos expedita in iste magnam modi mollitia nemo nihil nostrum praesentium repudiandae rerum, sed suscipit vitae. Aperiam eius eveniet fugiat illum, mollitia odit quo tenetur unde voluptatibus! Dolorem facere illum iure odit officia quo reprehenderit veritatis! Aliquam animi cum cumque debitis dignissimos dolore doloremque earum excepturi impedit magnam maxime minus praesentium, qui repellendus rerum sed sunt unde voluptates? Atque blanditiis ducimus ex incidunt nihil, odio possimus voluptate voluptatum. Adipisci architecto cumque cupiditate deleniti dolores eaque excepturi facere facilis illo incidunt labore mollitia nihil optio quae quam quasi quibusdam ratione repellendus sed sequi, soluta tempore voluptatibus? Hic illum ipsa saepe sit. Ipsa, ut vel. Dolor dolorum earum, in iusto laborum laudantium maxime nam nulla, optio quas repellat rerum saepe similique sit suscipit tempora veniam. Asperiores assumenda atque commodi, deleniti doloremque, eos error, facilis harum incidunt iste magnam magni maxime nihil nisi nulla officiis quia ratione recusandae repellendus similique suscipit tempore temporibus totam unde veritatis voluptas voluptates voluptatum. Autem cupiditate, debitis dignissimos doloremque doloribus, dolorum error facilis, harum incidunt iste labore laboriosam minus necessitatibus obcaecati odit praesentium quos ratione tenetur? Ad adipisci atque, commodi cumque debitis dicta eveniet explicabo fugit, ipsam ipsum labore laboriosam magnam maiores modi nam nesciunt nostrum praesentium quam quia quod quos ratione reiciendis sed sunt ullam veniam voluptas! Alias aspernatur at atque autem consequuntur debitis, deserunt eaque earum enim esse eum eveniet, iusto laborum libero magni maxime molestiae nemo perspiciatis praesentium quae ratione sed soluta sunt tempore veritatis voluptas voluptates? Dolores eaque harum modi molestiae odit perferendis soluta tenetur ullam. A ab adipisci dicta dolorum ducimus eum, inventore minus nemo neque, nostrum quod quos repudiandae, sequi similique tempora temporibus vitae voluptatum. Architecto autem blanditiis culpa, delectus ducimus ipsum iusto minus, modi porro quibusdam sapiente sequi. Amet dignissimos id incidunt laudantium magnam optio repellat similique tempore tenetur ullam? Animi architecto at atque beatae consequuntur cum, delectus dolore doloremque eaque earum eligendi esse eveniet facere facilis fuga in inventore, itaque magni molestiae mollitia nam obcaecati odio officiis, placeat possimus praesentium provident quis quod quos sequi soluta sunt tenetur velit! Accusamus, adipisci alias aliquid animi architecto consequuntur delectus, dicta dignissimos ea excepturi explicabo fugit impedit labore magnam minus nemo optio porro provident quaerat quas quidem quo quos repellat saepe soluta tenetur voluptatem. Adipisci esse iusto, laboriosam magni minima minus neque non quam quo quos, sequi ut!', 'page', NULL, 1, '2020-12-15 00:59:01', '2020-12-15 19:57:48', NULL, 1),
(16, 'Новая статья о куче потеряного времени', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, corporis cupiditate deleniti et fuga impedit itaque libero natus necessitatibus. A asperiores aut beatae, cum eius error libero magni nam necessitatibus nemo nulla odio quibusdam quod, reiciendis reprehenderit velit veritatis? Alias aperiam dignissimos ipsum magnam necessitatibus vitae? Assumenda dolor est hic, impedit, maiores modi necessitatibus neque omnis quidem, quis suscipit vero. Ad autem consequuntur eius laboriosam nihil. Debitis delectus earum error et harum hic iure laboriosam minus mollitia nisi nostrum officia perferendis quaerat rem saepe ut, veniam vitae. Aspernatur cumque cupiditate debitis dolores fugiat iste quasi ratione repudiandae sed sunt. A ad cumque dolore eveniet exercitationem iste nihil quidem quis repellat? Asperiores assumenda deleniti dolore eligendi enim ex magnam maxime modi, quidem quos rerum sint tempore vel! Cum harum obcaecati odit ratione rerum totam vel, voluptatum. Asperiores consectetur deleniti ea et illo incidunt rerum tempore, vel. Alias amet autem blanditiis commodi illo ipsam labore repellendus suscipit unde? Alias atque blanditiis dicta dolore eaque fugiat laboriosam libero, natus officiis, perferendis quaerat, qui quod suscipit tempora voluptatibus. Inventore maxime quae quibusdam voluptatibus. Commodi distinctio eligendi, esse explicabo facilis fugiat iure laborum magni molestias nesciunt non odit officia officiis, quas, quod rem rerum sequi tempore vel voluptatum! Ab animi aperiam aspernatur, at consectetur corporis deserunt distinctio dolores ducimus error exercitationem inventore iure laborum libero magnam maxime molestiae officiis praesentium quisquam recusandae repudiandae rerum sequi sint, tempore tenetur unde velit veniam? A, ab accusantium aliquam cumque deserunt earum eius error est et ex facere facilis impedit ipsa iste itaque iure laudantium minima modi nam nisi numquam pariatur, perferendis possimus praesentium quidem quis quisquam ratione, reprehenderit similique sit ullam velit vitae voluptatibus! Amet quis, ullam. Aliquam architecto beatae culpa deleniti et fugit obcaecati sed tempore, voluptatibus? Amet aperiam, at aut dolorem doloribus error nulla praesentium recusandae. A adipisci architecto aut blanditiis, consectetur cum deserunt ea eius eveniet explicabo ipsa ipsam iste iusto laudantium libero magnam maiores maxime nesciunt nihil nobis placeat quaerat quis reiciendis rem saepe sapiente sed soluta veniam vitae voluptatibus. Debitis ex iste molestias necessitatibus optio perferendis quos, vero. Autem culpa cupiditate, eligendi illo maiores maxime mollitia nulla quae ullam voluptate. Accusamus autem iure iusto sint unde. Aliquam at debitis ea est, excepturi exercitationem fugiat id ipsam laboriosam modi nesciunt numquam odio quasi quis, quos tenetur vel! Accusamus fugiat minima mollitia nulla voluptas? Ad architecto at dolore dolorem facilis fuga illo ipsum modi nisi, officiis quae quasi qui, quis sequi similique unde voluptates. Animi atque, distinctio ducimus hic itaque natus porro praesentium quam, quis tenetur totam voluptatibus? Consequuntur cum debitis dignissimos facilis harum ipsum itaque minus possimus quis sunt suscipit tempora vel vero, voluptatibus, voluptatum? Accusamus consectetur ea eaque eius error est facilis hic incidunt maiores minima molestiae molestias neque nihil obcaecati officia quibusdam quisquam repellendus repudiandae sapiente sint, soluta tempore temporibus tenetur, ullam voluptate. Aliquam animi assumenda aut, blanditiis cum dicta dolores doloribus dolorum eius enim est excepturi exercitationem explicabo in, laboriosam magni maxime minima molestiae necessitatibus nostrum quasi rerum tempore vel voluptate voluptatem. A adipisci aspernatur commodi excepturi explicabo impedit inventore labore maiores, nisi tenetur! A adipisci alias animi aut blanditiis commodi cum cupiditate deleniti, dignissimos dolore earum eius exercitationem facilis laboriosam magni nam necessitatibus nemo optio perferendis, sapiente vel veniam voluptas voluptates. A ab alias aliquam aut, cum cumque dignissimos distinctio ea eaque eligendi enim esse eum impedit laudantium natus nisi numquam perferendis praesentium quam quidem quos repellat repudiandae similique soluta vel, veritatis, vitae. Dolor eos minima omnis optio possimus quidem quisquam saepe sequi similique. Asperiores assumenda at aut autem, cumque, deleniti earum excepturi ipsum laudantium molestiae molestias nihil nobis obcaecati officiis perferendis porro quaerat quam quo sed voluptatum. Alias culpa mollitia neque. Expedita maiores unde voluptates? Doloribus dolorum ipsam quis sed voluptates. Assumenda dolore et fugit harum maxime necessitatibus quae quam ut vel? Commodi consequuntur cupiditate dicta eius numquam quis quo sapiente! Atque autem blanditiis cum cupiditate, dignissimos distinctio dolorem dolores ducimus ea eaque et illum ipsa iste iure iusto minus nam nesciunt nisi odit perferendis placeat porro provident quisquam quo quod rem rerum ullam vitae voluptas voluptatem. Amet consequuntur eum facere itaque iure labore qui quis quod ratione voluptatibus! Autem cupiditate, impedit inventore laboriosam minus nulla quia quibusdam rem sequi voluptate. Accusamus corporis doloremque dolores eos inventore ipsa, minus similique? A assumenda commodi debitis dolores earum, fugiat labore laudantium minima nemo placeat provident quas quis quisquam saepe, sit ut veniam voluptate voluptates? Ad aspernatur cumque, eos est fuga, labore magnam, maxime minima nobis porro quisquam repellat sequi voluptates! A ad animi ea expedita hic in incidunt maxime nihil non omnis placeat reiciendis sapiente sint suscipit ullam ut, vitae voluptas voluptatem voluptatibus voluptatum! Deleniti et iure optio sapiente. A ad aliquam assumenda aut, blanditiis dolore esse exercitationem fuga hic, ipsa iure modi molestias, necessitatibus neque obcaecati officia perspiciatis quibusdam quidem quis repellat sequi sunt ut vel. Adipisci aliquam aliquid architecto delectus dignissimos dolore dolorum eum molestias mollitia, natus nihil odio, possimus praesentium quasi quisquam repellat repellendus rerum tenetur, veniam vero? Assumenda at autem eaque et, ex impedit ipsam libero quas voluptatibus voluptatum! Autem culpa enim iure maxime officiis suscipit tempore tenetur vero. Ab asperiores assumenda corporis dolorem dolorum impedit incidunt iusto nam necessitatibus officiis quas quis quod sed sequi sint sit unde, veritatis voluptatibus? Eligendi fuga modi numquam perspiciatis quam. A blanditiis consectetur consequatur culpa cumque debitis dicta doloribus ducimus, ea eaque eos expedita impedit laborum modi molestiae nihil nulla obcaecati, provident quae quibusdam recusandae rem sequi ullam vel voluptatem. Assumenda beatae consequatur, facilis nemo sequi tenetur! A ad amet animi asperiores assumenda atque beatae consequuntur corporis, cum cupiditate dolore doloremque ea eligendi eum expedita facilis fugit id itaque iure iusto laudantium libero magnam magni nemo officiis omnis qui quibusdam quidem repellat sapiente, sed ut vitae voluptate. Amet at dolor dolores facere molestiae odit, officia quia quibusdam sed veniam! Ab aperiam asperiores deserunt eaque est et expedita facilis impedit ipsum, iusto laborum magnam molestias nemo odio quam quas quasi qui quia quis reiciendis repudiandae tenetur ut. A ab accusantium at atque commodi consequuntur culpa cum cumque delectus deleniti deserunt esse expedita facere, iure labore laborum magni molestias mollitia nihil perspiciatis quas quia repudiandae, similique sint velit vitae voluptas. Amet deserunt ducimus esse exercitationem fugiat iure molestias mollitia nam provident temporibus? Doloribus ex impedit nostrum nulla sapiente sed suscipit tempore ullam velit. Dicta esse id illo nam neque nostrum odio pariatur sint tenetur voluptate. Ad, dolor libero quaerat quam quis quod recusandae vero. Amet assumenda at atque cum est explicabo hic impedit, ipsam ipsum libero, natus nisi numquam officiis perferendis placeat quis ratione reiciendis, ullam veritatis voluptates? Aspernatur assumenda delectus explicabo fugiat incidunt, molestiae nisi quos sed veritatis voluptate. Doloremque et rerum voluptatibus? Autem cum cupiditate, dolor doloribus eveniet fugit ipsa natus. A deleniti distinctio dolor doloremque ducimus eius eligendi enim et impedit, iusto neque placeat possimus praesentium quasi, qui quibusdam reiciendis repellat reprehenderit tenetur ullam vero vitae voluptates. Accusamus alias architecto blanditiis, consequuntur culpa cum cupiditate dolore dolores doloribus eaque eius eveniet expedita facere facilis fugiat, illo laudantium magni maiores minima, mollitia nam natus necessitatibus nisi odio officia pariatur quam quos ratione repellat soluta sunt unde vel voluptatum. Architecto debitis ducimus fugit, ipsam nesciunt obcaecati sed? Debitis iste laboriosam laudantium officiis quo saepe. Asperiores beatae est, ex ipsa laborum tempora voluptas? Alias aliquam architecto consequuntur culpa cupiditate dicta dignissimos dolore doloremque ea error exercitationem fugit illo impedit, labore laboriosam laborum laudantium magni modi neque odio odit officia omnis perferendis praesentium quam quos recusandae repudiandae tempora temporibus tenetur, veniam voluptate voluptates voluptatum. Ad adipisci aliquam architecto asperiores assumenda consequatur corporis dignissimos dolorem eaque eligendi facilis illo illum iste itaque iure laborum laudantium, molestias mollitia nam non nostrum omnis perspiciatis ratione sequi soluta temporibus totam unde vero voluptatibus voluptatum. A, accusamus ad adipisci assumenda deserunt ducimus eum id in magni officia possimus, quam quas, quibusdam quidem sit unde vero! Aliquid aut et magnam magni neque nobis totam. Ab, consequuntur expedita ipsum nihil nobis pariatur repellat veniam! Aperiam at atque beatae blanditiis consequuntur corporis cum dolor doloremque dolorum esse eveniet excepturi explicabo fuga, ipsum labore laudantium magnam minus omnis praesentium quas, quibusdam, quis repellendus sed vitae voluptates. A atque beatae debitis ducimus ex iste, iusto minus modi reiciendis rem sapiente sed voluptatem. Ab accusamus ad adipisci aliquam at cumque dolore et eum ex, exercitationem fuga hic, laborum maiores natus perferendis perspiciatis quasi quis reprehenderit rerum voluptatibus? Accusantium aut consequatur consequuntur cum cumque dolorem dolorum facere hic illo in inventore ipsa, iusto laboriosam magni molestiae nihil nobis nulla obcaecati officiis possimus quidem quos rem rerum sapiente sed similique sit sunt suscipit tenetur ullam vel veritatis voluptas voluptatum? Adipisci, animi aspernatur at commodi dignissimos doloribus eius fuga fugit incidunt laudantium modi numquam obcaecati odit perspiciatis porro praesentium quaerat quis sunt vero voluptatibus? Ad et facere labore magni mollitia reiciendis voluptatibus. A alias aliquam amet cum, cumque cupiditate dignissimos dolore doloribus dolorum ea id iure iusto, laudantium magnam odit officia omnis porro quae quas ratione sequi similique voluptas? Ab doloremque ducimus ipsum itaque natus nihil repellat!', 'post', NULL, 1, '2020-12-15 22:52:19', '2020-12-15 22:52:19', NULL, 1),
(32, 'И бла бла бла', 'Гребаные двоиточия в названиях файлов', 'post', NULL, 1, '2020-12-15 23:25:24', '2020-12-15 23:25:24', NULL, 1),
(33, 'adsdnfsndfj 111', 'asubhfjlsdifjnaslifbalshbgflasdhbfglhjdsfbglhdbsfglhbdsfghbdlfgshbdfhgbsdfjhgbldjhfbgjdhfbgjshbdfgjb', 'post', '\\articles\\5fdbf16be6a8a.png', 1, '2020-12-17 17:01:47', '2020-12-18 19:31:44', NULL, 1),
(34, 'тест', 'фавываыаываываыаыва1111', 'post', '\\articles\\5fdd675144e62.png', 1, '2020-12-18 19:37:05', '2020-12-18 19:37:22', NULL, 1),
(35, 'тест', 'йцуйцуйцуйцу', 'post', NULL, 1, '2020-12-18 19:45:36', '2020-12-18 19:45:36', NULL, 1),
(36, 'фывфывфыв', 'фывфывфыв', 'page', '\\pages\\5fdd69b512598.png', 1, '2020-12-18 19:47:17', '2020-12-18 19:47:17', NULL, 1);

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
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `key`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'result_per_page', 'Результатов на странице по умолчанию', '20', '2020-12-16 02:48:17', '2020-12-15 19:48:31'),
(2, 'privacy_policy', 'Политика конфидециальности', '/page/9', '2020-12-16 02:48:17', NULL);

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
  `about` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `subscribed`, `avatar`, `about`, `created_at`, `updated_at`) VALUES
(1, 'admin@email.ru', 'admin', '$2y$10$hoCBqm7ieTCAqeuJbzscBOaIpgNE1n8v6xsqkOL4EQXIaSn8pKVC2', 1, '\\avatars\\5fdd5948cbfb1.png', 'Большой и интересный текст об админе 111', '2020-10-23 22:33:31', '2020-12-18 19:01:40'),
(2, 'moderator@test.ru', 'SuperModerator', '$2y$10$YdWQM.NoUMXcb7I52KCER.I3EO/S6sGU7Zun9YJvH9R0xcKbrFNUG', 0, NULL, NULL, '2020-11-18 00:25:16', '2020-11-18 00:25:16'),
(3, 'user@test.ru', 'SimpleUser', '$2y$10$w4OYVyx5YFwVL8R9nUOEq.ezjIspD1H9n8yDNH.5Wkd/H1m283g3O', 0, NULL, '', '2020-11-19 19:06:16', '2020-12-18 19:01:59'),
(4, 'another@subscriber.ru', NULL, NULL, 1, NULL, NULL, '2020-11-19 19:09:39', '2020-11-19 19:09:39'),
(5, 'registered@subscriber.ru', 'registeredSubscriber', '$2y$10$JDzO7Fl00dSrQ986tpWqK.R0J18.ieMYqQHo9KAHBXkzSQKupGK0a', 1, NULL, NULL, '2020-11-19 19:10:22', '2020-11-19 19:34:16'),
(6, 'test@email.ru', 'testerttt', '$2y$10$X.7uPeiag3ZbHg3rogOuRu9QBS.QdZSMSoVKjIH/D3D.jLp8aCDwi', 1, NULL, NULL, '2020-12-17 17:17:01', '2020-12-17 17:17:12');

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
(4, 1, '2020-11-20 03:53:42', '2020-11-20 03:53:42'),
(5, 1, '2020-12-16 04:52:41', '2020-12-16 04:52:41'),
(6, 1, '2020-12-18 00:17:01', '2020-12-18 00:17:01');

--
-- Индексы сохранённых таблиц
--

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
  ADD KEY `fk_role_permission` (`role_id`);

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
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

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
  ADD CONSTRAINT `fk_permission_role` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_role_permission` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

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
