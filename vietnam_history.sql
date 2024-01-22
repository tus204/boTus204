-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 22, 2024 lúc 08:49 AM
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
-- Cơ sở dữ liệu: `quiz_asm`
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
(191, 'sai', 49),
(192, 'sai', 49),
(193, 'dung', 49),
(194, 'sai', 49),
(195, 'sai', 50),
(196, 'sai', 50);

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
(5, 'Lớp 10'),
(6, 'Lớp 11');

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
(49, 193, 'nothing');

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
(49, 43, 'Biết trả lời không em ?', NULL, NULL),
(50, 43, 'Biết trả lời không em ?', NULL, NULL);

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
  `stt` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_name`, `active`, `point`, `time`, `image`, `user_id`, `stt`, `status`, `category_id`) VALUES
(42, 'quiz 1', 0, NULL, NULL, '/quizASM/upload/1.jpg', NULL, NULL, 1, 5),
(43, 'Quiz 2 - Khó lắm e ơi !', 0, NULL, NULL, '/quizASM/upload/7-1.jpg', NULL, NULL, 0, 5),
(44, 'Quiz 3 - Khó lắm e ơi !', 0, NULL, NULL, '/quizASM/upload/7-1.jpg', NULL, NULL, 0, 5),
(45, 'Quiz lớp 11 khó lắm e ơi !!!', 0, NULL, NULL, '/quizASM/upload/meme.jpg', NULL, NULL, 0, 6),
(46, 'Quiz lớp 11 khó lắm e ơi !!!', 0, NULL, NULL, '/quizASM/upload/meme.jpg', NULL, NULL, 0, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rank`
--

CREATE TABLE `rank` (
  `rank_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `totalpoint_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(11, 'Nguyen Quang Huy', 'huy@gmail.com', '$2y$10$HGm/csnWU8bLeMvKHYmopOv.WGgCM5azKqFMvflqZhT49tqPGZTmW', NULL, 'Client', NULL, NULL),
(12, 'Tú 2', 'anhtu@gmail.com', '$2y$10$MJAUngLCOBl5L7DE4ljbTOR6XErW06eTwqm4XnBDQdTPAmyR6yjJ6', NULL, 'Client', NULL, NULL);

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
-- Chỉ mục cho bảng `correctanswers`
--
ALTER TABLE `correctanswers`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `answer_id` (`answer_id`);

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
  ADD KEY `quiz_category` (`category_id`);

--
-- Chỉ mục cho bảng `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`rank_id`),
  ADD KEY `fk_rank_user` (`user_id`),
  ADD KEY `fk_rank_quiz` (`quiz_id`),
  ADD KEY `fk_rank_totalpoints` (`totalpoint_id`),
  ADD KEY `fk_rank_categories` (`category_id`);

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
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `rank`
--
ALTER TABLE `rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `totalpoints`
--
ALTER TABLE `totalpoints`
  MODIFY `totalpoint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
-- Các ràng buộc cho bảng `correctanswers`
--
ALTER TABLE `correctanswers`
  ADD CONSTRAINT `correctanswers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`),
  ADD CONSTRAINT `correctanswers_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`);

--
-- Các ràng buộc cho bảng `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`);

--
-- Các ràng buộc cho bảng `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `rank`
--
ALTER TABLE `rank`
  ADD CONSTRAINT `fk_rank_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `fk_rank_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`),
  ADD CONSTRAINT `fk_rank_totalpoints` FOREIGN KEY (`totalpoint_id`) REFERENCES `totalpoints` (`totalpoint_id`),
  ADD CONSTRAINT `fk_rank_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

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
-- Các ràng buộc cho bảng `user_quiz`
--
ALTER TABLE `user_quiz`
  ADD CONSTRAINT `fk_userQuiz_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`),
  ADD CONSTRAINT `fk_userQuiz_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
