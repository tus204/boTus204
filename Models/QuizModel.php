<?php

namespace Models;

use Core\Database;
use \PDOException;
use \PDO;

class QuizModel extends Database {

    // Hàm lấy dữ liệu tất cả các quiz
    function getAllQuiz() {
        $sql = "SELECT * FROM quiz";
        return self::pdo_query($sql);
    }

    // Hàm lấy stt quiz
    function getQuizStt($lessonCatId) {
        $quizStt = self::pdo_query_one("SELECT MAX(stt) AS max_stt FROM quiz WHERE lesson_cat_id = ?", $lessonCatId);
        return $quizStt;
    }

    // Hàm lấy thông tin của quiz bằng quiz_id
    function getQuizById($quizId) {
        $sql = "SELECT q.*, COUNT(qs.question_id) AS total_question 
                FROM quiz q
                JOIN questions qs ON q.quiz_id = qs.quiz_id
                WHERE q.quiz_id = ?
                GROUP BY q.quiz_id";
        return self::pdo_query_one($sql, $quizId);
    }

    // Hàm lấy danh sách quiz bằng course_id
    function getListQuizByCategoryId($categoryId) {
        $sql = "SELECT * FROM quiz WHERE category_id = ?";
        return $this->pdo_query($sql, $categoryId);
    }

    // Hàm upload ảnh và trả về đường dẫn
    function uploadImage($newImage, $oldImagePath) {
        $targetDir = "../upload/";

        // Kiểm tra xem có ảnh mới được tải lên không
        if (!empty($newImage["name"])) {
            // Tạo đường dẫn mới cho ảnh
            $newImagePath = $targetDir . basename($newImage["name"]);

            // Di chuyển ảnh mới vào thư mục upload
            move_uploaded_file($newImage["tmp_name"], $newImagePath);

            return $newImagePath;
        } else {
            // Nếu không có ảnh mới, giữ nguyên đường dẫn ảnh cũ
            return $oldImagePath;
        }
    }

    // Hàm thêm quiz
    function addQuiz($quizName, $quizTime, $image, $createdBy, $courseName, $lessonCatName, $quizStt) {
        $imagePath = empty($image["name"]) ? null : self::uploadImage($image, null);

        $sql = "INSERT INTO quiz (quiz_name, active, point, time, image, user_id, course_id, lesson_cat_id, stt) 
                VALUES (?, '1', '10', SEC_TO_TIME(?*60), ?, ?, ?, ?, ?)";
        return self::pdo_execute_last_result($sql, $quizName, $quizTime, $imagePath, $createdBy, $courseName, $lessonCatName, $quizStt);
    }

    // Hàm xóa quiz
    function delQuiz($quizId) {
        $sql = "DELETE FROM `quiz` WHERE `quiz_id`=?";
        self::pdo_execute($sql, $quizId);
    }

    // Hàm lấy tổng số câu hỏi của quiz
    function getTotalQuestion($quizId) {
        $totalQuestion = self::pdo_query_one("SELECT COUNT(question_id) AS total_question FROM questions WHERE quiz_id = ?", $quizId);
        return $totalQuestion['total_question'];
    }

    // Hàm lấy toàn bộ câu hỏi
    function getAllQuestions() {
        $sql = self::pdo_query("SELECT * FROM questions");
        return $sql;
    }

    // Hàm lấy câu hỏi theo quizId
    function getQuestionByQuizId($quizId) {
        $sql = "SELECT * FROM questions WHERE quiz_id = ?";
        return self::pdo_query($sql, $quizId);
    }

    // Hàm lấy toàn bộ đáp án của một câu hỏi
    function getAllAnswersByQuestionId($questionId) {
        $sql = "SELECT * FROM answers WHERE question_id = ?";
        return self::pdo_query($sql, $questionId);
    }

    // Hàm thêm câu hỏi
    function addQuestion($questionText, $quizId, $answers, $image) {
        $imagePath = empty($image["name"]) ? null : self::uploadImage($image, null);

        try {
            // Thêm câu hỏi vào bảng questions
            $questionId = self::pdo_execute_last_result("INSERT INTO questions (question_text, quiz_id, point, image) VALUES (?, ?, 1, ?)",
                $questionText, $quizId, $imagePath);

            // Thêm đáp án vào bảng answers
            foreach ($answers as $answerText) {
                self::pdo_execute("INSERT INTO answers (answer_text, question_id) VALUES (?, ?)", $answerText, $questionId);
            }

            return $questionId;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    // Hàm lấy id của đáp án bằng cách sử dụng questionId và answerText
    function getAnswerIdByAnswerText($questionId, $answerText) {
        $sql = "SELECT answer_id FROM answers WHERE question_id = ? AND answer_text = ?";
        return self::pdo_query_value($sql, $questionId, $answerText);
    }

    // Hàm thêm đáp án đúng cho một câu hỏi
    function addCorrectAnswer($questionId, $correctAnswerId, $correctContent) {
        self::pdo_execute("INSERT INTO correctanswers (question_id, answer_id, correct_content) VALUES (?, ?, ?)", $questionId, $correctAnswerId, $correctContent);
    }

    // Hàm kiểm tra xem một đáp án có phải là đáp án đúng hay không
    function isCorrectAnswer($questionId, $answerId) {
        $sql = "SELECT * FROM correctanswers WHERE question_id = ? AND answer_id = ?";
        $correctAnswer = self::pdo_query_one($sql, $questionId, $answerId);
        return !empty($correctAnswer);
    }

    // Hàm lấy toàn bộ đáp án đúng của một câu hỏi
    function getCorrectAnswersByQuestionId($questionId) {
        $sql = "SELECT * FROM correctanswers WHERE question_id = ?";
        return self::pdo_query($sql, $questionId);
    }

    // Hàm lưu điểm của người dùng
    function saveUserScore($userId, $quizId, $score) {
        self::pdo_execute("INSERT INTO totalpoints (user_id, quiz_id, total_points) VALUES (?, ?, ?)", $userId, $quizId, $score);
    }

    // Hàm cập nhật trạng thái làm bài của người dùng
    function updateUserQuizStatus($userId, $quizId) {
        self::pdo_execute("UPDATE quiz SET status = 1 WHERE user_id = ? AND quiz_id = ?", $userId, $quizId);
    }

    // Hàm lấy kết quả của người dùng sau khi làm bài kiểm tra
    function getResultQuiz($totalpointId) {
        $sql = "SELECT * FROM totalpoints WHERE totalpoint_id = ?";
        return self::pdo_query_one($sql, $totalpointId);
    }

    // Hàm lưu đáp án của người dùng
    function saveUserAnswer($userId, $questionId, $answerId, $quizId) {
        self::pdo_execute("INSERT INTO user_answers (user_id, question_id, answer_id, quiz_id) VALUES (?, ?, ?, ?)", $userId, $questionId, $answerId, $quizId);
    }

    // Hàm lấy đáp án của người dùng
    function getUserAnswer($userId, $quizId, $questionId) {
        $sql = "SELECT * FROM user_answers WHERE user_id = ? AND quiz_id = ? AND question_id = ?";
        $userAnswer = $this->pdo_query($sql, $userId, $quizId, $questionId);
        return $userAnswer ? $userAnswer : null;
    }

    // Hàm lấy trạng thái làm bài của người dùng
    function getUserQuizStatus($userId, $quizId) {
        $sql = "SELECT * FROM totalpoints WHERE user_id = ? AND quiz_id = ?";
        return self::pdo_query_one($sql, $userId, $quizId);
    }

    // Hàm xóa dữ liệu người dùng khi làm lại bài kiểm tra
    function deleteUserData($userId, $quizId) {
        // Xóa dữ liệu từ bảng 'user_answers'
        self::pdo_execute("DELETE FROM user_answers WHERE user_id = ? AND quiz_id = ?", $userId, $quizId);

        // Xóa dữ liệu từ bảng 'totalpoints'
        self::pdo_execute("DELETE FROM totalpoints WHERE user_id = ? AND quiz_id = ?", $userId, $quizId);
    }

    // Hàm cập nhật trạng thái của user_quiz
    function saveUserQuiz($userId, $quizId, $lessonCatId) {
        self::pdo_execute("INSERT INTO user_quiz (user_id, quiz_id, status, lesson_cat_id) VALUES (?, ?, 1, ?)", $userId, $quizId, $lessonCatId);
    }
}

?>
