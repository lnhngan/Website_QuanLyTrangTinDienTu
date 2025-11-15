-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 13, 2025 lúc 03:13 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sport_news`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `summary` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `game_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `author_id`, `title`, `slug`, `summary`, `content`, `thumbnail`, `status`, `featured`, `views`, `published_at`, `game_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Việt Nam vs Thái Lan: Trận chung kết AFF Cup 2025', 'viet-nam-vs-thai-lan-chung-ket-aff-cup-2025', 'ĐT Việt Nam...sẽ đối đầu Thái Lan...', '<p>Trận đấu được chờ đợi nhất...</p>', 'thumbnails/ytbAmx9Ob9ZnWWoOC6ant2NSp20d32vkSZfTJMco.jpg', 'published', 0, 12500, '2025-11-13 14:07:40', NULL, '2025-11-04 11:50:14', '2025-11-13 07:07:40'),
(2, 1, 2, 'Man Utd thua sốc Lakers 1-2 trên sân nhà', 'man-utd-thua-soc-lakers', 'Trong trận giao hữu đặc biệt...', '<p>Một trận đấu kỳ lạ...</p>', 'thumbnails/J4E1z42T5UNn0rPSXtYG8Utq0XzXxslRsxRfS6AN.jpg', 'published', 0, 8900, '2025-11-13 14:08:00', NULL, '2025-11-04 11:50:14', '2025-11-13 07:08:00'),
(3, 2, 1, 'LeBron James lập triple-double, Lakers thắng đậm', 'lebron-triple-double-lakers', 'Ngôi sao 40 tuổi vẫn chứng minh...', '<p>LeBron tiếp tục...</p>', 'thumbnails/rMtUZ1hNc5scQCtzdTDVXXJfEBmqIcIe7xVhqmEv.jpg', 'published', 0, 6700, '2025-11-13 14:08:36', NULL, '2025-11-04 11:50:14', '2025-11-13 07:08:36'),
(4, 3, 2, 'Djokovic vô địch Paris Masters lần thứ 7', 'djokovic-vo-dich-paris-masters', 'Nole đánh bại Alcaraz...', '<p>Ở tuổi 38, Djokovic...</p>', 'thumbnails/NBlG50nJ77dD3A2HTgCf6k1ygQ8yngDhK83MeY7a.jpg', 'published', 0, 4500, '2025-11-13 14:09:01', NULL, '2025-11-04 11:50:14', '2025-11-13 07:09:01'),
(5, 1, 1, 'V-League 2025/26: Hà Nội FC dẫn đầu sau 5 vòng', 'v-league-2025-ha-noi-dan-dau', 'Hà Nội FC bất bại...', '<p>Thầy trò HLV Daiki Iwamasa...</p>', 'thumbnails/rDWDQ8t1R0DTMRczwvdOaNdmPs1UJHUiVjmX1RmL.jpg', 'published', 0, 3200, '2025-11-13 14:09:20', NULL, '2025-11-04 11:50:14', '2025-11-13 07:09:20'),
(6, 4, 2, 'Lâm Quang Lê vô địch Việt Nam Open 2025', 'lam-quang-le-vo-dich', 'Tay vợt số 1 Việt Nam...', '<p>Một chiến thắng...</p>', 'thumbnails/r4sAtMW0ieQ30OENDAyuEgUI4342CQZUeNLGT9Vt.jpg', 'published', 0, 0, '2025-11-13 14:09:38', NULL, '2025-11-04 11:50:14', '2025-11-13 07:09:38'),
(7, 1, 1, 'Ronaldo ghi hat-trick, Al Nassr vào chung kết', 'ronaldo-hat-trick', 'CR7 tiếp tục phong độ...', '<p>3 bàn thắng đẹp mắt...</p>', 'thumbnails/QkU1rqU4UQ3DyETSe1L35IRcZdeHloKrjFhRLJy0.jpg', 'published', 0, 15000, '2025-11-13 14:09:51', NULL, '2025-11-04 11:50:14', '2025-11-13 07:09:51'),
(8, 2, 2, 'VBA 2025: Saigon Heat bảo vệ ngôi vương', 'saigon-heat-vo-dich-vba', 'Heat đánh bại Hanoi Buffaloes...', '<p>Chung kết kịch tính...</p>', 'thumbnails/HSnUMiyyMNgCnTvkot7jhO5UoksVODFGprYbWgcN.jpg', 'published', 0, 5100, '2025-11-13 14:10:16', NULL, '2025-11-04 11:50:14', '2025-11-13 07:10:16'),
(9, 5, 1, 'Ánh Viên trở lại thi đấu sau 2 năm nghỉ sinh', 'anh-vien-tro-lai', 'Kình ngư số 1 Việt Nam...', '<p>Cảm xúc dâng trào...</p>', 'thumbnails/wdHUgBc26DyqkHYcV6egPhikTrJnGbp9d8pZxMO1.jpg', 'published', 0, 7800, '2025-11-13 14:10:36', NULL, '2025-11-04 11:50:14', '2025-11-13 07:10:36'),
(10, 1, 2, 'Park Hang-seo chính thức dẫn dắt ĐT Thái Lan', 'park-hang-seo-thai-lan', 'HLV Park trở lại Đông Nam Á...', '<p>Một cú sốc lớn...</p>', 'thumbnails/b48486mkgJ0CzWWpY5iS5RnTDOhxXRCImUy12sCi.jpg', 'published', 0, 21000, '2025-11-13 14:11:05', NULL, '2025-11-04 11:50:14', '2025-11-13 07:11:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `article_tags`
--

CREATE TABLE `article_tags` (
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `article_tags`
--

INSERT INTO `article_tags` (`article_id`, `tag_id`) VALUES
(1, 1),
(1, 4),
(1, 5),
(2, 3),
(2, 7),
(3, 8),
(4, 6),
(5, 5),
(7, 7),
(8, 8),
(9, 2),
(10, 1),
(10, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Bóng đá', 'bong-da', 'Tin tức bóng đá...', NULL, '2025-11-04 11:50:14', NULL),
(2, 'Bóng rổ', 'bong-ro', 'NBA, VBA...', NULL, '2025-11-04 11:50:14', NULL),
(3, 'Tennis', 'tennis', 'Grand Slam...', NULL, '2025-11-04 11:50:14', NULL),
(4, 'Cầu lông', 'cau-long', 'BWF...', NULL, '2025-11-04 11:50:14', NULL),
(5, 'Bơi lội', 'boi-loi', 'Olympic...', NULL, '2025-11-04 11:50:14', NULL),
(6, 'Bóng chuyền', 'bng-chuyn', NULL, NULL, '2025-11-13 07:11:46', NULL),
(7, 'Pickcleball', 'pickcleball', NULL, NULL, '2025-11-13 07:11:55', NULL),
(8, 'Thể Thao Điện Tử', 'th-thao-in-t', NULL, NULL, '2025-11-13 07:12:48', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `content` text NOT NULL,
  `status` enum('pending','approved','spam') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `user_id`, `name`, `email`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'Hy vọng Việt Nam vô địch lần này!', 'approved', '2025-11-04 11:50:14', '2025-11-04 11:50:14'),
(2, 1, NULL, 'Nguyễn Văn A', 'a@gmail.com', 'Thái Lan mạnh lắm, khó đấy!', 'approved', '2025-11-04 11:50:14', '2025-11-04 11:50:14'),
(3, 2, 2, NULL, NULL, 'Trận này vui thật!', 'approved', '2025-11-04 11:50:14', '2025-11-04 11:50:14'),
(4, 10, NULL, 'Hoàng E', 'e@gmail.com', 'Không ngờ thầy Park lại sang Thái Lan...', 'pending', '2025-11-04 11:50:14', '2025-11-04 11:50:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `games`
--

CREATE TABLE `games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_home` bigint(20) UNSIGNED NOT NULL,
  `team_away` bigint(20) UNSIGNED NOT NULL,
  `match_date` datetime NOT NULL,
  `venue` varchar(150) DEFAULT NULL,
  `score_home` int(11) DEFAULT NULL,
  `score_away` int(11) DEFAULT NULL,
  `status` enum('upcoming','ongoing','finished') NOT NULL DEFAULT 'upcoming',
  `created_at` timestamp NULL DEFAULT '2025-11-04 11:50:14'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `games`
--

INSERT INTO `games` (`id`, `team_home`, `team_away`, `match_date`, `venue`, `score_home`, `score_away`, `status`, `created_at`) VALUES
(1, 1, 2, '2025-11-10 19:00:00', 'Sân Mỹ Đình', NULL, NULL, 'upcoming', '2025-11-04 11:50:14'),
(2, 3, 4, '2025-11-05 03:30:00', 'Old Trafford', 2, 1, 'finished', '2025-11-04 11:50:14'),
(3, 1, 3, '2025-11-06 20:00:00', 'Sân Hàng Đẫy', 1, 1, 'ongoing', '2025-11-04 11:50:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `matches`
--

CREATE TABLE `matches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_home` bigint(20) UNSIGNED NOT NULL,
  `team_away` bigint(20) UNSIGNED NOT NULL,
  `match_date` datetime NOT NULL,
  `venue` varchar(150) DEFAULT NULL,
  `score_home` int(11) DEFAULT NULL,
  `score_away` int(11) DEFAULT NULL,
  `status` enum('upcoming','ongoing','finished') NOT NULL DEFAULT 'upcoming',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_11_04_155900_create_users_table', 1),
(2, '2025_11_04_155904_create_categories_table', 1),
(3, '2025_11_04_155905_create_articles_table', 1),
(4, '2025_11_04_155906_create_tags_table', 1),
(5, '2025_11_04_155911_create_article_tags_table', 1),
(6, '2025_11_04_155912_create_comments_table', 1),
(7, '2025_11_04_155912_create_teams_table', 1),
(8, '2025_11_04_155913_create_matches_table', 1),
(9, '2025_11_04_155913_create_photos_table', 1),
(10, '2025_11_04_155913_create_videos_table', 1),
(11, '2025_11_04_155914_create_settings_table', 1),
(12, '2025_11_04_174504_create_games_table', 1),
(13, '2025_11_06_174633_add_featured_to_articles_table', 2),
(14, '2025_11_08_172315_add_game_id_to_articles', 2),
(15, '2025_11_10_154230_add_timestamps_to_tags_table', 2),
(16, '2025_11_11_083348_add_featured_to_articles_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'site_name', 'Sport News VN'),
(2, 'site_description', 'Tin tức thể thao nhanh, chính xác...'),
(3, 'contact_email', 'contact@sportnews.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'AFF Cup', 'aff-cup', NULL, NULL),
(2, 'SEA Games', 'sea-games', NULL, NULL),
(3, 'Premier League', 'premier-league', NULL, NULL),
(4, 'HLV Park Hang-seo', 'park-hang-seo', NULL, NULL),
(5, 'V-League', 'v-league', NULL, NULL),
(6, 'Messi', 'messi', NULL, NULL),
(7, 'Ronaldo', 'ronaldo', NULL, NULL),
(8, 'NBA', 'nba', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `sport_type` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `teams`
--

INSERT INTO `teams` (`id`, `name`, `logo`, `sport_type`, `country`) VALUES
(1, 'Việt Nam', 'teams/vietnam.png', 'football', 'Việt Nam'),
(2, 'Thailand', 'teams/thailand.png', 'football', 'Thái Lan'),
(3, 'Man Utd', 'teams/manutd.png', 'football', 'Anh'),
(4, 'Lakers', 'teams/lakers.png', 'basketball', 'Mỹ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) UNSIGNED NOT NULL DEFAULT 3,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Sport', 'admin@sportnews.com', '2025-11-04 11:50:14', '$2y$12$txPPX1Juc7PXAq0lAUi/AuPRLAGhvqez1PnoxFpf6jbU15E08z2Zm', 1, 'avatars/admin.jpg', 'fgBozOy78PWQDL3e7yuufUv7HZOJkGZ9ggXTi6q0xrOw8jWFChQgHIVqNAKs', '2025-11-04 11:50:14', '2025-11-04 11:50:14'),
(2, 'Biên tập viên Minh', 'editor@sportnews.com', '2025-11-04 11:50:14', '$2y$12$txPPX1Juc7PXAq0lAUi/AuPRLAGhvqez1PnoxFpf6jbU15E08z2Zm', 2, 'avatars/editor.jpg', NULL, '2025-11-04 11:50:14', '2025-11-04 11:50:14'),
(3, 'Phạm Trường Vũ', 'vupham4019@gmail.com', NULL, '$2y$12$pmUWKlhOgHy3dxLeF09A4eCbHsFP2YiEDBAwmg.FjjacXCVXCpxya', 3, NULL, NULL, '2025-11-04 11:51:05', '2025-11-04 11:51:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_category_id_foreign` (`category_id`),
  ADD KEY `articles_author_id_foreign` (`author_id`),
  ADD KEY `articles_game_id_foreign` (`game_id`),
  ADD KEY `articles_featured_index` (`featured`);

--
-- Chỉ mục cho bảng `article_tags`
--
ALTER TABLE `article_tags`
  ADD PRIMARY KEY (`article_id`,`tag_id`),
  ADD KEY `article_tags_tag_id_foreign` (`tag_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_article_id_foreign` (`article_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `games_team_home_foreign` (`team_home`),
  ADD KEY `games_team_away_foreign` (`team_away`);

--
-- Chỉ mục cho bảng `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matches_team_home_foreign` (`team_home`),
  ADD KEY `matches_team_away_foreign` (`team_away`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_article_id_foreign` (`article_id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name_unique` (`name`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `idx_role` (`role`);

--
-- Chỉ mục cho bảng `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_article_id_foreign` (`article_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `matches`
--
ALTER TABLE `matches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `article_tags`
--
ALTER TABLE `article_tags`
  ADD CONSTRAINT `article_tags_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_team_away_foreign` FOREIGN KEY (`team_away`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `games_team_home_foreign` FOREIGN KEY (`team_home`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_team_away_foreign` FOREIGN KEY (`team_away`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matches_team_home_foreign` FOREIGN KEY (`team_home`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
