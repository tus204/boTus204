-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 21, 2024 lúc 08:11 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vietnam_history`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `answer_text` text NOT NULL,
  `question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `answers`
--

INSERT INTO `answers` (`answer_id`, `answer_text`, `question_id`) VALUES
(155, 'A. Chiến tranh thế giới thứ nhất kết thúc.', 40),
(156, 'B. Pháp bị thiệt hại nặng nề trong chiến tranh.', 40),
(157, 'C. Cách mạng tháng Mười Nga thành công 1917.', 40),
(158, 'D. Các nước thắng trận họp Hội nghị Vécsai và Oasinhtơn.', 40),
(159, 'A. Phát triển giáo dục.', 41),
(160, 'B. Khai thác thuộc địa lần thứ hai.', 41),
(161, 'C. Cải lương hương chính.', 41),
(162, 'D. Khai thác thuộc địa lần thứ nhất.', 41),
(163, 'A. Chính phủ Pháp.', 42),
(164, 'B. Tư sản mại bản.', 42),
(165, 'C. Ngân hàng Đông Dương.', 42),
(166, 'D. Toàn quyền Đông Dương.', 42),
(167, 'A. Công nhân.', 43),
(168, 'B. Nông dân.', 43),
(169, 'C. Tiểu tư sản.', 43),
(170, 'D. Tư sản dân tộc.', 43),
(171, 'A. Địa chủ, tư sản.', 44),
(172, 'B. Tư sản, tiểu tư sản.', 44),
(173, 'C. Tiểu tư sản, công nhân.', 44),
(174, 'D. Nông dân, công nhân.', 44),
(187, 'k,jmhngbfvc', 48),
(188, 'zcxvb nm', 48),
(189, '\r\n\';lkjhngbvc', 48),
(190, 'nbnvc', 48);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(5, 'Lớp 10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_text` text NOT NULL,
  `comment_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `correctanswers`
--

CREATE TABLE `correctanswers` (
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `correct_content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `correctanswers`
--

INSERT INTO `correctanswers` (`question_id`, `answer_id`, `correct_content`) VALUES
(40, 157, NULL),
(41, 160, NULL),
(42, 165, NULL),
(43, 168, NULL),
(44, 172, NULL),
(48, 188, 'bố đéo hiểu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `course`
--

INSERT INTO `course` (`course_id`, `desc`, `course_name`, `title`, `content`, `video`, `image`, `category_id`) VALUES
(32, 'TÓM TẮT PHONG TRÀO DÂN TỘC DÂN CHỦ Ở VIỆT NAM TỪ NĂM 1919 ĐẾN NĂM 1930', 'Chương 1: Việt Nam từ 1919 đến 1930', 'TÓM TẮT PHONG TRÀO DÂN TỘC DÂN CHỦ Ở VIỆT NAM TỪ NĂM 1919 ĐẾN NĂM 1930', '<p>– Trình bày được những nét chính của tình hình thế giới sau chiến tranh thế giới thứ nhất có ảnh hưởng tới Việt Nam (các nước tư bản thắng trận họp tại Véc-xai phân chia lại thế giới; bước phát triển mới của phong trào cộng sản và công nhân quốc tế).</p><p>– Trình bày được Nội dung Chương trình khai thác thuộc địa lần thứ  hai của thực dân Pháp ở Đông Dương, cùng với các chính sách về chính trị, văn hóa và giáo dục.</p><p>– Tóm tắt được sự biến đổi về mặt kinh tế và xã hội Việt Nam; phân tích được địa vị kinh tế, thái độ chính trị và khả năng cách mạng của mỗi giai cấp, tầng lớp trong xã hội Việt Nam thời thuộc địa; rút ra được mâu thuẫn chủ yếu trong xã hội Việt Nam lúc đó.</p><p>– Trình bày được điều kiện lịch sử và các hoạt động tiêu biểu của phong trào yêu nước: Hoạt động của người Việt Nam yêu nước ở nước ngoài (Trung Quốc và Pháp), những hoạt động của tư sản và tiểu tư sản, phong trào đấu tranh của công nhân.</p><p>– Nêu được những hoạt động và phân tích vai trò của Nguyễn Ái Quốc đối với cách mạng Việt Nam.</p><p>– Trình bày được sự ra đời, hoạt động và vai trò của các tổ chức cách mạng: Hội Việt Nam Cách mạng Thanh niên, Tân Việt Cách mạng đảng, Việt Nam Quốc dân đảng.</p><p>– Phân tích được nguyên nhân thất bại và ý nghĩa lịch sử của khởi nghĩa Yên Bái.</p><p>– Trình bày được sự phát triển của phong trào công nhân sau Chiến tranh thế giới thứ nhất</p><p>– Trình bày được nguyên nhân và sự xuất hiện của ba tổ chức cộng sản năm 1929.</p><p>– Trình bày được hoàn cảnh lịch sử và nội dung Hội nghị thành lập Đảng Cộng sản Việt Nam. Phân tích được ý nghĩa sự ra đời của Đảng.</p><p>– Phân tích được nội dung Cương lĩnh chính trị đầu tiên của Đảng, đặc biệt làm rõ tính đúng đắn và sáng tạo của Cương lĩnh.</p><p>– .Phân tích được vai trò của Nguyễn Ái Quốc đối với cách mạng Việt Nam từ sau Chiến tranh thế giới thứ nhất đến đầu năm 1930.</p><p>– Phân biệt được các khái niệm: lý luận cách mạng giải phóng dân tộc; cách mạng tư sản dân quyền, cách mạng thổ địa (trong Cương lĩnh chính trị đầu tiên của Đảng, Luận cương lĩnh chính trị tháng 10-1930); tự phát, tự giác (trong phong trào công nhân), lực lượng, động lực cách mạng.</p>', 'BI-2ZsxZaHE', '../upload/1.jpg', 5),
(34, 'ccc', 'Chương 2', 'tieu de', '<p>-a</p><p>-c</p>', 'vbnnn', '../upload/anh1.jpg', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lesson`
--

CREATE TABLE `lesson` (
  `lesson_id` int(11) NOT NULL,
  `lesson_cat_id` int(11) NOT NULL,
  `lesson_name` varchar(255) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `stt` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lesson`
--

INSERT INTO `lesson` (`lesson_id`, `lesson_cat_id`, `lesson_name`, `video`, `description`, `status`, `stt`) VALUES
(8, 6, '1. Những chuyển biến mới về kinh tế, chính trị, xã hội ở Việt Nam sau chiến tranh thế giới thứ nhất.', 'l4T1XHPSGLw', '<ol><li>Chính sách khai thác thuộc địa lần thứ hai của thực dân Pháp</li><li>Chính sách chính trị, văn hoá, giáo dục của thực dân Pháp</li><li>Những chuyển biến mới về kinh tế và giai cấp xã hội ở Việt Nam</li></ol>', 0, 1),
(9, 6, '2. Phong trào dân tộc dân chủ ở Việt Nam từ 1919 đến 1925.', 'KlYUOybzB4w', '<ol><li>Hoạt động của Phan Bội Châu, Phan Châu Trinh và một số người Việt Nam ở nước ngoài.</li><li>Hoạt động của tư sản, tiểu tư sản và công nhân Việt Nam.</li><li>Hoạt động yêu nước của Nguyễn Ái Quốc.</li></ol>', 0, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lesson_cat`
--

CREATE TABLE `lesson_cat` (
  `lesson_cat_id` int(11) NOT NULL,
  `lesson_cat_name` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lesson_cat`
--

INSERT INTO `lesson_cat` (`lesson_cat_id`, `lesson_cat_name`, `course_id`) VALUES
(6, 'Bài 1: Phong chào dân tộc dân chủ ở Việt Nam từ năm 1919 đến 1930', 32),
(7, 'Bài 2: Phong chào dân tộc ở Việt Nam từ năm 1925 đến năm 1930', 32),
(8, 'Bài 1', 34);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_time` datetime NOT NULL,
  `view` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `question_text` text NOT NULL,
  `point` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`question_id`, `quiz_id`, `question_text`, `point`, `image`) VALUES
(40, 40, 'Câu 1. Sự kiện nào dưới đây có ảnh hưởng tích cực đến phong trào cách mạng Việt Nam những năm 1919-1925?', 1, NULL),
(41, 40, 'Câu 2. Trong những năm 1919-1929, Pháp đã thực hiện chính sách chủ yếu nào dưới đây ở Việt Nam?', 1, NULL),
(42, 40, 'Câu 3. Cơ quan nào dưới đây của Pháp nắm quyền chỉ huy nền kinh tế Đông Dương?', 1, NULL),
(43, 40, 'Câu 4. Sau Chiến tranh thế giới thứ nhất, giai cấp nào là lực lượng đông đảo nhất của cách mạng Việt Nam?', 1, NULL),
(44, 40, 'Câu 6. Chương trình khai thác thuộc địa lần thứ hai của thực dân Pháp đã dẫn tới sự xuất hiện của những giai cấp nào dưới đây?', 1, NULL),
(48, 40, '\'\r\n;lkjhg', 1, '../upload/1.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `point` int(11) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_cat_id` int(11) NOT NULL,
  `stt` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_name`, `active`, `point`, `time`, `image`, `user_id`, `course_id`, `lesson_cat_id`, `stt`, `status`) VALUES
(40, 'Bài tập 1', 1, 10, '00:10:00', '../upload/photo-6-15562650321071954349801-crop-1556265358985449018081.jpg', 8, 32, 6, 3, 1),
(41, 'Bài tập 2', 1, 10, '00:01:00', '../upload/7-1.jpg', 8, 32, 7, 3, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `test`
--

CREATE TABLE `test` (
  `status` tinyint(4) DEFAULT NULL,
  `VMC` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `test`
--

INSERT INTO `test` (`status`, `VMC`) VALUES
(1, 'ádsd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `totalpoints`
--

CREATE TABLE `totalpoints` (
  `totalpoint_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `total_points` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `totalpoints`
--

INSERT INTO `totalpoints` (`totalpoint_id`, `status`, `total_points`, `quiz_id`, `user_id`) VALUES
(195, 0, 4, 40, 8),
(196, 0, 1, 40, 8),
(197, 0, 1, 40, 8),
(198, 0, 4, 40, 8),
(199, 0, 2, 40, 8),
(200, 0, 1, 40, 8),
(201, 0, 2, 40, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` int(15) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'Client',
  `image` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `mobile`, `role`, `image`, `gender`) VALUES
(8, 'bố Tú', 'botu@gmail.com', '$2y$10$F7yILoZTH/vrQrzK/EaX6ONC.Q3ml.Gq/k2TGLKPAs015yd5rWiCC', 974566306, 'Admin', '../upload/4a4c29807499a1a8085e9bde536a570a.jpg', 'Nam'),
(9, 'bố Tú 2', 'botu2@gmail.com', '$2y$10$oF9KCpKe/C9c62x6rtL5C.MzakGvLyTNoQDPWjl78EqKzGV/hD5ii', 88888888, 'Admin', '../upload/meme.jpg', 'Nữ'),
(10, 'anh tu', 'cccc@cc.com', '$2y$10$3vUj2Qk7pq9FTYo.T.ku8uB9O.tkQshiDUmekK7hvPobT8.91BGoS', NULL, 'Client', NULL, NULL),
(11, 'Nguyen Quang Huy', 'huy@gmail.com', '$2y$10$HGm/csnWU8bLeMvKHYmopOv.WGgCM5azKqFMvflqZhT49tqPGZTmW', NULL, 'Client', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_answers`
--

CREATE TABLE `user_answers` (
  `user_answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_answers`
--

INSERT INTO `user_answers` (`user_answer_id`, `user_id`, `question_id`, `answer_id`, `quiz_id`) VALUES
(134, 8, 40, 155, 40),
(135, 8, 41, 159, 40),
(136, 8, 42, 163, 40),
(137, 8, 43, 168, 40),
(138, 8, 44, 171, 40),
(139, 8, 48, 187, 40),
(140, 11, 40, 155, 40),
(141, 11, 41, 160, 40),
(142, 11, 42, 163, 40),
(143, 11, 43, 167, 40),
(144, 11, 44, 172, 40),
(145, 11, 48, 190, 40);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_course`
--

CREATE TABLE `user_course` (
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_course`
--

INSERT INTO `user_course` (`course_id`, `user_id`) VALUES
(32, 8),
(32, 11),
(34, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_lesson`
--

CREATE TABLE `user_lesson` (
  `lesson_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_lesson`
--

INSERT INTO `user_lesson` (`lesson_id`, `user_id`, `status`) VALUES
(8, 8, 1),
(9, 8, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_quiz`
--

CREATE TABLE `user_quiz` (
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `correctanswers`
--
ALTER TABLE `correctanswers`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `answer_id` (`answer_id`);

--
-- Chỉ mục cho bảng `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `fk_course_category_id` (`category_id`);

--
-- Chỉ mục cho bảng `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `fk_lesson_lesson_cat_id` (`lesson_cat_id`);

--
-- Chỉ mục cho bảng `lesson_cat`
--
ALTER TABLE `lesson_cat`
  ADD PRIMARY KEY (`lesson_cat_id`),
  ADD KEY `fk_lesson_cat_course_id` (`course_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `FK_Posts_Category` (`category_id`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Chỉ mục cho bảng `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `quiz_ibfk_4` (`lesson_cat_id`);

--
-- Chỉ mục cho bảng `totalpoints`
--
ALTER TABLE `totalpoints`
  ADD PRIMARY KEY (`totalpoint_id`),
  ADD KEY `FK_Quiz_Totalpoints` (`quiz_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`user_answer_id`),
  ADD KEY `fk_userAnswer_user_id` (`user_id`),
  ADD KEY `fk_userAnswer_question_id` (`question_id`),
  ADD KEY `fk_userAnswer_answer_id` (`answer_id`),
  ADD KEY `correctanswers_quiz_id` (`quiz_id`);

--
-- Chỉ mục cho bảng `user_course`
--
ALTER TABLE `user_course`
  ADD PRIMARY KEY (`user_id`,`course_id`),
  ADD KEY `fk_course_id` (`course_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Chỉ mục cho bảng `user_lesson`
--
ALTER TABLE `user_lesson`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `fk_userLesson_2` (`user_id`);

--
-- Chỉ mục cho bảng `user_quiz`
--
ALTER TABLE `user_quiz`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `fk_userQuiz_2` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `lesson`
--
ALTER TABLE `lesson`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `lesson_cat`
--
ALTER TABLE `lesson_cat`
  MODIFY `lesson_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `totalpoints`
--
ALTER TABLE `totalpoints`
  MODIFY `totalpoint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `user_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Các ràng buộc cho bảng `correctanswers`
--
ALTER TABLE `correctanswers`
  ADD CONSTRAINT `correctanswers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`),
  ADD CONSTRAINT `correctanswers_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`);

--
-- Các ràng buộc cho bảng `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_course_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Các ràng buộc cho bảng `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `fk_lesson_lesson_cat_id` FOREIGN KEY (`lesson_cat_id`) REFERENCES `lesson_cat` (`lesson_cat_id`);

--
-- Các ràng buộc cho bảng `lesson_cat`
--
ALTER TABLE `lesson_cat`
  ADD CONSTRAINT `fk_lesson_cat_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_Posts_Category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`);

--
-- Các ràng buộc cho bảng `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `quiz_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `quiz_ibfk_4` FOREIGN KEY (`lesson_cat_id`) REFERENCES `lesson_cat` (`lesson_cat_id`);

--
-- Các ràng buộc cho bảng `totalpoints`
--
ALTER TABLE `totalpoints`
  ADD CONSTRAINT `FK_Quiz_Totalpoints` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`),
  ADD CONSTRAINT `totalpoints_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `correctanswers_quiz_id` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`),
  ADD CONSTRAINT `fk_userAnswer_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`),
  ADD CONSTRAINT `fk_userAnswer_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`),
  ADD CONSTRAINT `fk_userAnswer_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `fk_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `user_lesson`
--
ALTER TABLE `user_lesson`
  ADD CONSTRAINT `fk_userLesson_1` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`lesson_id`),
  ADD CONSTRAINT `fk_userLesson_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `user_quiz`
--
ALTER TABLE `user_quiz`
  ADD CONSTRAINT `fk_userQuiz_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`),
  ADD CONSTRAINT `fk_userQuiz_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
