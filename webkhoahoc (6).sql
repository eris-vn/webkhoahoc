-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Dec 14, 2023 at 04:07 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webkhoahoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `content`, `correct`) VALUES
(1, 1, 'v-model', 1),
(2, 1, 'bind', 0),
(3, 1, 'data-binding', 0),
(4, 1, 'vue-bind', 0),
(5, 2, 'watch', 1),
(6, 2, 'observe', 0),
(7, 2, 'track', 0),
(8, 2, 'change', 0),
(9, 3, 'vue-transition', 1),
(10, 3, 'vue-animate', 0),
(11, 3, 'vue-effect', 0),
(12, 3, 'vue-transition-effect', 0);

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `received_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `name`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 'Giới thiệu', 4, '2023-12-14 03:32:49', NULL),
(2, 'Kiến thức', 4, '2023-12-14 03:34:12', NULL),
(3, 'Setup', 5, '2023-12-14 03:45:34', NULL),
(4, 'Kiến thức', 5, '2023-12-14 03:45:46', NULL),
(5, 'Giới thiệu', 6, '2023-12-14 03:52:01', NULL),
(6, 'Kiến thức', 6, '2023-12-14 03:52:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `discounted_price` int DEFAULT NULL,
  `thumbnails` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_preview` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `user_id`, `name`, `slug`, `short_description`, `description`, `price`, `discounted_price`, `thumbnails`, `video_preview`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 'Khoá học VueJS 3', 'khoa-hoc-vuejs-3', 'Khóa học Vue 3 dành cho người cơ bản này, chúng ta sẽ cùng nhau tìm hiểu kiến thức mới nhất của Vue.js từ bắt đầu cho đến khi sử dụng được nó để tạo ra những dự án cơ bản.', '<p><span class=\"yt-core-attributed-string--link-inherit-color\">Hề nh&ocirc; mọi người, trong kh&oacute;a học Vue 3 d&agrave;nh cho người cơ bản n&agrave;y, ch&uacute;ng ta sẽ c&ugrave;ng nhau t&igrave;m hiểu kiến thức mới nhất của Vue.js từ bắt đầu cho đến khi sử dụng được n&oacute; để tạo ra những dự &aacute;n cơ bản. Hy vọng kh&oacute;a n&agrave;y sẽ gi&uacute;p những bạn muốn bắt đầu học vue c&oacute; được c&aacute;i nh&igrave;n s&acirc;u hơn về vue.js kh&ocirc;ng chỉ đơn giản l&agrave; học m&agrave; c&ograve;n hiểu n&oacute; hoạt động thế n&agrave;o! C&ograve;n b&acirc;y giờ z&ocirc; z&ocirc; z&ocirc;!</span></p>', 150000, 180000, '/uploads/img/상품사진-44.png', 'https://www.youtube.com/watch?v=CHM75-NqOmk', 0, '2023-12-14 03:32:37', NULL),
(5, 1, 'Khóa học ReactJS', 'khoa-hoc-reactjs', 'Khóa học ReactJS là hành trình tuyệt vời giúp bạn chinh phục thế giới phát triển web. Từ việc làm quen với components, props, state đến Redux, khóa học mang lại kiến thức sâu sắc và trải nghiệm thực tế. Bạn sẽ xây dựng ứng dụng hiệu quả, từ đó trở thành nhà phát triển React chuyên nghiệp.', '<p>Kh&oacute;a học ReactJS l&agrave; h&agrave;nh tr&igrave;nh tuyệt vời gi&uacute;p bạn chinh phục thế giới ph&aacute;t triển web. Từ việc l&agrave;m quen với components, props, state đến Redux, kh&oacute;a học mang lại kiến thức s&acirc;u sắc v&agrave; trải nghiệm thực tế. Bạn sẽ x&acirc;y dựng ứng dụng hiệu quả, từ đ&oacute; trở th&agrave;nh nh&agrave; ph&aacute;t triển React chuy&ecirc;n nghiệp.</p>', 0, 0, '/uploads/img/images.png', 'https://www.youtube.com/watch?v=H51ky9lR9Lo', 0, '2023-12-14 03:45:18', NULL),
(6, 1, 'Khoá học Laravel 8', 'khoa-hoc-laravel-8', 'Khóa học Laravel là bước đi lý tưởng vào thế giới phát triển web PHP hiện đại. Với Laravel, bạn sẽ khám phá cách xây dựng ứng dụng mạnh mẽ, dễ bảo trì và linh hoạt.', '<p>Kh&oacute;a học Laravel l&agrave; bước đi l&yacute; tưởng v&agrave;o thế giới ph&aacute;t triển web PHP hiện đại. Với Laravel, bạn sẽ kh&aacute;m ph&aacute; c&aacute;ch x&acirc;y dựng ứng dụng mạnh mẽ, dễ bảo tr&igrave; v&agrave; linh hoạt.</p>', 200000, 250000, '/uploads/img/1684605470270.jpg', 'https://www.youtube.com/watch?v=sMXkSWFlV28', 0, '2023-12-14 03:51:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `instructor_id` bigint UNSIGNED NOT NULL,
  `enrolled_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_quiz`
--

CREATE TABLE `history_quiz` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `chapter_id` bigint UNSIGNED NOT NULL,
  `total_question` int NOT NULL,
  `incorrect` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `chapter_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview` tinyint(1) NOT NULL DEFAULT '1',
  `time` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `chapter_id`, `name`, `description`, `video_url`, `preview`, `time`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Giới thiệu hành trình, cùng những cập nhật mới của Vue 3', '<p>Hề nh&ocirc; mọi người, trong kh&oacute;a học Vue 3 d&agrave;nh cho người cơ bản n&agrave;y, ch&uacute;ng ta sẽ c&ugrave;ng nhau t&igrave;m hiểu kiến thức mới nhất của Vue.js từ bắt đầu cho đến khi sử dụng được n&oacute; để tạo ra những dự &aacute;n cơ bản. Hy vọng kh&oacute;a n&agrave;y sẽ gi&uacute;p những bạn muốn bắt đầu học vue c&oacute; được c&aacute;i nh&igrave;n s&acirc;u hơn về vue.js kh&ocirc;ng chỉ đơn giản l&agrave; học m&agrave; c&ograve;n hiểu n&oacute; hoạt động thế n&agrave;o! C&ograve;n b&acirc;y giờ z&ocirc; z&ocirc; z&ocirc;!</p>', 'https://www.youtube.com/watch?v=CHM75-NqOmk', 1, 22, '2023-12-14 03:33:33', NULL),
(2, 4, 1, 'Cùng tìm hiểu những kiến thức cơ bản - Phần 1', '<p>Hề nh&ocirc; mọi người, trong kh&oacute;a học Vue 3 d&agrave;nh cho người cơ bản n&agrave;y, ch&uacute;ng ta sẽ c&ugrave;ng nhau t&igrave;m hiểu kiến thức mới nhất của Vue.js từ bắt đầu cho đến khi sử dụng được n&oacute; để tạo ra những dự &aacute;n cơ bản. Hy vọng kh&oacute;a n&agrave;y sẽ gi&uacute;p những bạn muốn bắt đầu học vue c&oacute; được c&aacute;i nh&igrave;n s&acirc;u hơn về vue.js kh&ocirc;ng chỉ đơn giản l&agrave; học m&agrave; c&ograve;n hiểu n&oacute; hoạt động thế n&agrave;o! C&ograve;n b&acirc;y giờ z&ocirc; z&ocirc; z&ocirc;!</p>', 'https://www.youtube.com/watch?v=AjWBhjGhq-w', 1, 34, '2023-12-14 03:35:00', NULL),
(3, 4, 1, 'Cùng tìm hiểu những kiến thức cơ bản - Phần 2', '<p>Hề nh&ocirc; mọi người, trong kh&oacute;a học Vue 3 d&agrave;nh cho người cơ bản n&agrave;y, ch&uacute;ng ta sẽ c&ugrave;ng nhau t&igrave;m hiểu kiến thức mới nhất của Vue.js từ bắt đầu cho đến khi sử dụng được n&oacute; để tạo ra những dự &aacute;n cơ bản. Hy vọng kh&oacute;a n&agrave;y sẽ gi&uacute;p những bạn muốn bắt đầu học vue c&oacute; được c&aacute;i nh&igrave;n s&acirc;u hơn về vue.js kh&ocirc;ng chỉ đơn giản l&agrave; học m&agrave; c&ograve;n hiểu n&oacute; hoạt động thế n&agrave;o! C&ograve;n b&acirc;y giờ z&ocirc; z&ocirc; z&ocirc;!</p>', 'https://www.youtube.com/watch?v=uvKss7OSsRA', 1, 45, '2023-12-14 03:35:28', NULL),
(4, 4, 2, 'Vue Cli và làm quen với file \".vue\"', '<p>Hề nh&ocirc; mọi người, trong kh&oacute;a học Vue 3 d&agrave;nh cho người cơ bản n&agrave;y, ch&uacute;ng ta sẽ c&ugrave;ng nhau t&igrave;m hiểu kiến thức mới nhất của Vue.js từ bắt đầu cho đến khi sử dụng được n&oacute; để tạo ra những dự &aacute;n cơ bản. Hy vọng kh&oacute;a n&agrave;y sẽ gi&uacute;p những bạn muốn bắt đầu học vue c&oacute; được c&aacute;i nh&igrave;n s&acirc;u hơn về vue.js kh&ocirc;ng chỉ đơn giản l&agrave; học m&agrave; c&ograve;n hiểu n&oacute; hoạt động thế n&agrave;o! C&ograve;n b&acirc;y giờ z&ocirc; z&ocirc; z&ocirc;!</p>', 'https://www.youtube.com/watch?v=jClufqXd4c0', 0, 36, '2023-12-14 03:38:32', NULL),
(5, 4, 2, 'Đi sâu hơn vào component (kèm ví dụ)', '<p>Hề nh&ocirc; mọi người, trong kh&oacute;a học Vue 3 d&agrave;nh cho người cơ bản n&agrave;y, ch&uacute;ng ta sẽ c&ugrave;ng nhau t&igrave;m hiểu kiến thức mới nhất của Vue.js từ bắt đầu cho đến khi sử dụng được n&oacute; để tạo ra những dự &aacute;n cơ bản. Hy vọng kh&oacute;a n&agrave;y sẽ gi&uacute;p những bạn muốn bắt đầu học vue c&oacute; được c&aacute;i nh&igrave;n s&acirc;u hơn về vue.js kh&ocirc;ng chỉ đơn giản l&agrave; học m&agrave; c&ograve;n hiểu n&oacute; hoạt động thế n&agrave;o! C&ograve;n b&acirc;y giờ z&ocirc; z&ocirc; z&ocirc;!</p>', 'https://www.youtube.com/watch?v=bBiSjvPG7kA', 0, 42, '2023-12-14 03:39:05', NULL),
(6, 5, 3, 'Cài đặt extensions và settings quan trọng', '<p>Kh&oacute;a học ReactJS - B&agrave;i 1: C&agrave;i đặt extensions v&agrave; settings quan trọng</p>', 'https://www.youtube.com/watch?v=H51ky9lR9Lo', 1, 3, '2023-12-14 03:46:17', NULL),
(7, 5, 3, 'Cài đặt NodeJS và Git SCM', '<p>https://www.youtube.com/watch?v=TVFHLDJMS6U&amp;</p>', 'https://www.youtube.com/watch?v=TVFHLDJMS6U', 1, 2, '2023-12-14 03:47:23', NULL),
(8, 5, 4, 'Create react app', '<p>Kh&oacute;a học ReactJS - B&agrave;i 4: Create react app</p>', 'https://www.youtube.com/watch?v=oU8tJ0bkfbc', 0, 2, '2023-12-14 03:47:49', NULL),
(9, 5, 4, 'Components là gì?', '<p>Kh&oacute;a học ReactJS - B&agrave;i 6: Components l&agrave; g&igrave;?</p>', 'https://www.youtube.com/watch?v=3nKnGbtCXF4', 0, 6, '2023-12-14 03:49:16', NULL),
(10, 6, 5, 'Cài đặt Laravel 8.x - Chạy ứng dụng đầu tiên', '<div class=\"flex-1 overflow-hidden\">\n<div class=\"react-scroll-to-bottom--css-xkogf-79elbk h-full\">\n<div class=\"react-scroll-to-bottom--css-xkogf-1n7m0yu\">\n<div class=\"flex flex-col pb-9 text-sm\">\n<div class=\"w-full text-token-text-primary\" data-testid=\"conversation-turn-9\">\n<div class=\"px-4 py-2 justify-center text-base md:gap-6 m-auto\">\n<div class=\"flex flex-1 text-base mx-auto gap-3 md:px-5 lg:px-1 xl:px-5 md:max-w-3xl lg:max-w-[40rem] xl:max-w-[48rem] group final-completion\">\n<div class=\"relative flex w-full flex-col lg:w-[calc(100%-115px)] agent-turn\">\n<div class=\"flex-col gap-1 md:gap-3\">\n<div class=\"flex flex-grow flex-col max-w-full\">\n<div class=\"min-h-[20px] text-message flex flex-col items-start gap-3 whitespace-pre-wrap break-words [.text-message+&amp;]:mt-5 overflow-x-auto\" data-message-author-role=\"assistant\" data-message-id=\"f96ba812-8a0f-4b01-ae42-94989817d8c9\">\n<div class=\"markdown prose w-full break-words dark:prose-invert dark\">\n<p>Kh&oacute;a học Laravel l&agrave; bước đi l&yacute; tưởng v&agrave;o thế giới ph&aacute;t triển web PHP hiện đại. Với Laravel, bạn sẽ kh&aacute;m ph&aacute; c&aacute;ch x&acirc;y dựng ứng dụng mạnh mẽ, dễ bảo tr&igrave; v&agrave; linh hoạt.</p>\n</div>\n</div>\n</div>\n<div class=\"mt-1 flex justify-start gap-3 empty:hidden\">\n<div class=\"text-gray-400 flex self-end lg:self-center justify-center lg:justify-start mt-0 gap-1 visible\">&nbsp;</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>', 'https://www.youtube.com/watch?v=sMXkSWFlV28', 1, 21, '2023-12-14 03:52:25', NULL),
(11, 6, 6, 'Cấu trúc thư mục - Vòng đời Request trong Laravel', '<div class=\"flex-1 overflow-hidden\">\n<div class=\"react-scroll-to-bottom--css-xkogf-79elbk h-full\">\n<div class=\"react-scroll-to-bottom--css-xkogf-1n7m0yu\">\n<div class=\"flex flex-col pb-9 text-sm\">\n<div class=\"w-full text-token-text-primary\" data-testid=\"conversation-turn-9\">\n<div class=\"px-4 py-2 justify-center text-base md:gap-6 m-auto\">\n<div class=\"flex flex-1 text-base mx-auto gap-3 md:px-5 lg:px-1 xl:px-5 md:max-w-3xl lg:max-w-[40rem] xl:max-w-[48rem] group final-completion\">\n<div class=\"relative flex w-full flex-col lg:w-[calc(100%-115px)] agent-turn\">\n<div class=\"flex-col gap-1 md:gap-3\">\n<div class=\"flex flex-grow flex-col max-w-full\">\n<div class=\"min-h-[20px] text-message flex flex-col items-start gap-3 whitespace-pre-wrap break-words [.text-message+&amp;]:mt-5 overflow-x-auto\" data-message-author-role=\"assistant\" data-message-id=\"f96ba812-8a0f-4b01-ae42-94989817d8c9\">\n<div class=\"markdown prose w-full break-words dark:prose-invert dark\">\n<p>Kh&oacute;a học Laravel l&agrave; bước đi l&yacute; tưởng v&agrave;o thế giới ph&aacute;t triển web PHP hiện đại. Với Laravel, bạn sẽ kh&aacute;m ph&aacute; c&aacute;ch x&acirc;y dựng ứng dụng mạnh mẽ, dễ bảo tr&igrave; v&agrave; linh hoạt.</p>\n</div>\n</div>\n</div>\n<div class=\"mt-1 flex justify-start gap-3 empty:hidden\">\n<div class=\"text-gray-400 flex self-end lg:self-center justify-center lg:justify-start mt-0 gap-1 visible\"><button class=\"flex items-center gap-1.5 rounded-md p-1 pl-0 text-xs hover:text-gray-950 dark:text-gray-400 dark:hover:text-gray-200 disabled:dark:hover:text-gray-400 md:invisible md:group-hover:visible md:group-[.final-completion]:visible\"></button>\n<div class=\"flex gap-1\">&nbsp;</div>\n<div class=\"flex items-center gap-1.5 text-xs\">&nbsp;</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n</div>\n<div class=\"w-full pt-2 md:pt-0 dark:border-white/20 md:border-transparent md:dark:border-transparent md:w-[calc(100%-.5rem)]\"><form class=\"stretch mx-2 flex flex-row gap-3 last:mb-2 md:mx-4 md:last:mb-6 lg:mx-auto lg:max-w-2xl xl:max-w-3xl\">\n<div class=\"relative flex h-full flex-1 items-stretch md:flex-col\">\n<div class=\"flex w-full items-center\">&nbsp;</div>\n</div>\n</form></div>', 'https://www.youtube.com/watch?v=Cm0YBC8YNtw', 0, 26, '2023-12-14 03:52:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_11_13_214138_courses', 1),
(4, '2023_11_13_214916_chapters', 1),
(5, '2023_11_13_214929_lessons', 1),
(7, '2023_11_13_215858_comments', 1),
(8, '2023_11_14_104636_invoice', 1),
(11, '2023_11_13_215035_enrollments', 3),
(12, '2023_11_24_191012_invoice_details', 4),
(13, '2023_11_15_091821_user_lessons', 5),
(19, '2023_12_03_185219_answers', 9),
(22, '2023_12_02_110223_user_modify', 11),
(23, '2023_12_03_184456_questions', 12),
(25, '2023_12_03_213811_history_quiz', 13),
(27, '2023_11_21_101934_reviews', 14),
(28, '2023_12_13_182030_certificate', 15),
(29, '2023_12_02_110223_course_modify', 16),
(31, '2023_12_14_015940_action_tickets', 17),
(32, '2023_12_14_015813_verification_codes', 18);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `chapter_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `course_id`, `chapter_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 'Vue.js sử dụng cú pháp nào để liên kết dữ liệu giữa DOM và dữ liệu trong Vue instance?', '2023-12-14 03:36:53', NULL),
(2, 1, 4, 1, 'Trong Vue.js, để theo dõi sự thay đổi của một biến trong data, chúng ta sử dụng thuộc tính nào?', '2023-12-14 03:37:24', NULL),
(3, 1, 4, 1, 'Vue.js sử dụng thành phần nào để tạo các hiệu ứng chuyển động và animation?', '2023-12-14 03:37:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` longtext COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `avatar_url`, `name`, `email`, `phone_number`, `bio`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'https://i.imgur.com/glczlVu.png', 'Nguyên Văn Sơn', 'erisvn2440@gmail.com', '5425', 'Một trình viên fullstack', 'b40d5d79be49169db83e2996950249d7', '1', '0', '2023-11-20 20:04:00', NULL),
(2, 'https://i.imgur.com/glczlVu.png', 'Nguyên Văn B', 'erisvn1@gmail.com', '5425', 'fs', '4bee445128f3101d7be05911af855349', '1', '0', '2023-11-20 20:04:00', NULL),
(3, NULL, 'Nguyen Van Teo', 'abc@gmail.com', NULL, NULL, '778b138aecccbb24b2f4ed3f10917934', '0', '0', '2023-12-13 18:45:26', NULL),
(21, NULL, 'fdss', 'erisvn@mgd.fdsf', NULL, NULL, '7f71c4b149389525ca6b41c57a6d707c', '0', '0', '2023-12-13 21:59:45', NULL),
(22, NULL, 'fds', 'fsdf@gmail.com', NULL, NULL, 'd80e531ba7917c765177288ee1ea8c45', '0', '0', '2023-12-14 03:02:32', NULL),
(23, NULL, 'dfssfd', 'fsdfsfd@gmail.com', NULL, NULL, '7d70663568cac5af684503681e3a4d41', '0', '0', '2023-12-14 03:04:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_lessons`
--

CREATE TABLE `user_lessons` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `lesson_id` bigint UNSIGNED NOT NULL,
  `completed` tinyint(1) NOT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_lessons`
--

INSERT INTO `user_lessons` (`id`, `user_id`, `course_id`, `lesson_id`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 0, NULL, '2023-12-14 03:33:41', NULL),
(2, 1, 4, 2, 0, NULL, '2023-12-14 03:35:34', NULL),
(3, 1, 4, 3, 0, NULL, '2023-12-14 03:35:35', NULL),
(4, 1, 5, 6, 0, NULL, '2023-12-14 03:46:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verification_codes`
--

INSERT INTO `verification_codes` (`id`, `user_id`, `code`, `email`, `created_at`, `expires_at`) VALUES
(1, 1, 'cd2700ba2752aaa1f7a8f997c2d16cfe', 'erisvn2440@gmail.com', '2023-12-14 02:34:56', '2023-12-14 02:49:54'),
(2, 1, '7035c296be553a40fbd711fc9a481405', 'erisvn2440@gmail.com', '2023-12-14 02:36:43', '2023-12-14 02:51:42'),
(3, 1, '06c3bcf0f6cf19b86ab27c77782b4e26', 'erisvn2440@gmail.com', '2023-12-14 02:36:53', '2023-12-14 02:51:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificate_user_id_foreign` (`user_id`),
  ADD KEY `certificate_course_id_foreign` (`course_id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapters_course_id_foreign` (`course_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_course_id_foreign` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_user_id_foreign` (`user_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_user_id_foreign` (`user_id`),
  ADD KEY `enrollments_course_id_foreign` (`course_id`),
  ADD KEY `enrollments_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `history_quiz`
--
ALTER TABLE `history_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hisotry_quiz_user_id_foreign` (`user_id`),
  ADD KEY `hisotry_quiz_chapter_id_foreign` (`chapter_id`),
  ADD KEY `hisotry_quiz_course_id_foreign` (`course_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_user_id_foreign` (`user_id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_details_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_details_course_id_foreign` (`course_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_chapter_id_foreign` (`chapter_id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_course_id_foreign` (`course_id`),
  ADD KEY `questions_chapter_id_foreign` (`chapter_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_user_id_foreign` (`user_id`),
  ADD KEY `review_course_id_foreign` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_lessons`
--
ALTER TABLE `user_lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_lessons_course_id_foreign` (`course_id`),
  ADD KEY `user_lessons_user_id_foreign` (`user_id`),
  ADD KEY `user_lessons_lesson_id_foreign` (`lesson_id`);

--
-- Indexes for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verification_codes_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_quiz`
--
ALTER TABLE `history_quiz`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_lessons`
--
ALTER TABLE `user_lessons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `certificate_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `certificate_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollments_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `history_quiz`
--
ALTER TABLE `history_quiz`
  ADD CONSTRAINT `hisotry_quiz_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hisotry_quiz_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hisotry_quiz_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `review_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_lessons`
--
ALTER TABLE `user_lessons`
  ADD CONSTRAINT `user_lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_lessons_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_lessons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD CONSTRAINT `verification_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
