<?php

    class quiz {
        // hàm lấy dữ liệu tất cả các quiz
        static public function getAllQuiz() {
            try {
                $conn = pdo_get_connection();
                $sql = "SELECT * FROM quiz";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $quiz = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $quiz;
            } catch (PDOException $e) {
                throw $e;
            } finally {
                unset($conn);
            }
        }

        // Hàm lấy stt quiz
        static public function getQuizStt($lessonCatId) {
            $quiz_stt = pdo_query_one("SELECT MAX(stt) AS max_stt from quiz WHERE lesson_cat_id = ?", $lessonCatId);
            return $quiz_stt;
        }

        // Hàm lấy toltal questions bằng quiz_id
        static public function getQuizById ($quizId) {
            $sql = "SELECT q.*,COUNT(qs.question_id) AS total_question 
            FROM quiz q
            JOIN questions qs ON q.quiz_id = qs.quiz_id
            WHERE q.quiz_id = ?
            GROUP BY q.quiz_id";
            $quiz = pdo_query_one($sql, $quizId);
            return $quiz;
        }
        
        // Hàm lấy list quiz bằng course_id
        static public function getListQuizByCourseId ($courseId) {
            $sql = "SELECT * FROM quiz WHERE course_id = ?";
            $quiz = pdo_query($sql, $courseId);
            return $quiz;
        }
        
        // hàm upload ảnh
        static public function uploadImage($newImage, $oldImagePath)
        {
            $target_dir = "../upload/";

            // Kiểm tra xem có ảnh mới được tải lên không
            if (!empty($newImage["name"])) {
                // Tạo đường dẫn mới cho ảnh
                $newImagePath = $target_dir . basename($newImage["name"]);

                // Di chuyển ảnh mới vào thư mục upload
                move_uploaded_file($newImage["tmp_name"], $newImagePath);

                return $newImagePath;
            } else {
                // Nếu không có ảnh mới, giữ nguyên đường dẫn ảnh cũ
                return $oldImagePath;
            }
        }

        // hàm thêm quiz
        static public function addQuiz($quizName, $quizTime, $image, $createdBy, $courseName, $lessonCatName, $quizStt) {
            try {               
                // Kiểm tra xem có ảnh mới được tải lên không và cập nhật ảnh
                $image_path = empty($image["name"]) ? null : quiz::uploadImage($image, null);

                // thêm quiz
                $sql = "INSERT INTO quiz (quiz_name, active, point, time, image, user_id, course_id, lesson_cat_id, stt) 
                    VALUES (?, '1', '10', SEC_TO_TIME(?*60), ?, ?, ?, ?,?)";
                $quiz = pdo_execute($sql, $quizName, $quizTime, $image_path, $createdBy, $courseName, $lessonCatName, $quizStt);
                // Trả về quizId để sử dụng khi thêm câu hỏi và đáp án
                return $quiz;

            } catch (PDOException $e) {
                // Xử lý lỗi nếu có
                echo "Error: " . $e->getMessage();
            }
        }

        // Hàm xóa quiz
        static public function delQuiz($quizId) {
            $sql = "DELETE FROM `quiz` WHERE `quiz_id`=?";
            pdo_execute($sql, $quizId);
        }

        // Hàm lấy tổng câu hỏi
        static public function getTotalQuestion($quizId) {
            $totalQuestion = pdo_query_one("SELECT COUNT(question_id) AS total_question FROM questions WHERE quiz_id = ?", $quizId);
            return $totalQuestion['total_question'];
        }

        // Hàm lấy câu hỏi
        static public function getAllQuestions() {
            $sql = pdo_query("SELECT * FROM questions");
            return $sql;
        }

        // Hàm lấy câu hỏi theo quizId
        static public function getQuestionByQuizId ($quizId) {
            $sql = "SELECT * FROM questions WHERE quiz_id = ?";
            $questions = pdo_query($sql, $quizId);
            return $questions;
        }

        // Hàm lấy đáp án
        static public function getAllAnswersByQuestionId($questionId) {
            $sql = "SELECT * FROM answers WHERE question_id = ?";
            $answers = pdo_query($sql, $questionId);
            return $answers;
        }

        // Hàm thêm câu hỏi
        public static function addQuestion($questionText, $quizId, $answers, $image) {
            try {
                $conn = pdo_get_connection();
                $conn->beginTransaction();

                $image_path = empty($image["name"]) ? null : quiz::uploadImage($image, null);
    
                // Thêm câu hỏi vào bảng questions
                $questionId = pdo_execute_last_result("INSERT INTO questions (question_text, quiz_id, point, image) VALUES (?, ?, 1,?)",
                    $questionText, $quizId, $image_path);
    
                // Thêm đáp án vào bảng answers
                foreach ($answers as $answerText) {
                    pdo_execute("INSERT INTO answers (answer_text, question_id) VALUES (?, ?)", $answerText, $questionId);                    
                }                
    
                $conn->commit();
                return $questionId;
            } catch (PDOException $e) {
                $conn->rollBack();
                throw $e;
            } finally {
                unset($conn);
            }
        }        

        // Hàm lấy answer_id
        static public function getAnswerIdByAnswerText($questionId, $answerText) {
            $sql = "SELECT answer_id FROM answers WHERE question_id =? AND answer_text = ?";
            $answerId = pdo_query_value($sql, $questionId, $answerText);
            return $answerId;
        }

        // Hàm thêm đáp án đúng
        static public function addCorrectAnswer($questionId, $correctAnswerId, $correctContent) {
            // thêm đáp án đúng
            pdo_execute("INSERT INTO correctanswers (question_id, answer_id, correct_content) VALUES (?, ?, ?)", $questionId, $correctAnswerId, $correctContent);
        }

        // Hàm check đáp án đúng
        static public function isCorrectAnswer($questionId, $answerId) {
            $sql = "SELECT * FROM correctanswers WHERE question_id = ? AND answer_id = ?";
            $correctAnswer = pdo_query_one($sql, $questionId, $answerId);
            return !empty($correctAnswer);
        }


        // Hàm lấy đáp án đúng từ db
        static public function getCorrectAnswersByQuestionId($questionId) {
            $sql = "SELECT * FROM correctanswers WHERE question_id = ?";
            $correctAnswers = pdo_query_one($sql, $questionId);
            return $correctAnswers;
        }    

        // Hàm lưu điểm
        static public function saveUserScore($userId, $quizId, $score) {            
            $sql = "INSERT INTO totalpoints (user_id, quiz_id, total_points) VALUES (?, ?, ?)";
            $totalpointId = pdo_execute_last_result($sql, $userId, $quizId, $score);
            return $totalpointId;
        }

        // Hàm cập nhật trạng thái làm bài
        static public function updateUserQuizStatus($userId, $quizId) {
            $sql = "UPDATE quiz SET status = 1 WHERE user_id = ? AND quiz_id = ?";
            pdo_execute($sql, $userId, $quizId);
        }

        // Ham lay ket qua khi user lam bai xong
        static public function getResultQuiz ($totalpointId) {
            $sql = "SELECT * FROM totalpoints WHERE totalpoint_id = ?";
            $result = pdo_query_one($sql, $totalpointId);            
            return $result;
        }

        // Hàm lưu đáp án người dùng
        static public function saveUserAnswer($userId, $questionId, $answerId, $quizId) {
            $sql = "INSERT INTO user_answers (user_id, question_id, answer_id, quiz_id) VALUES (?, ?, ?, ?)";
            pdo_execute($sql, $userId, $questionId, $answerId, $quizId);
        }

        // Hàm lấy đáp án người dùng
        static public function getUserAnswer($userId, $quizId, $questionId) {
            $sql = "SELECT * FROM user_answers WHERE user_id = ? AND quiz_id = ? AND question_id = ?";
            $userAnswer = pdo_query_one($sql, $userId, $quizId, $questionId);
            return $userAnswer ? $userAnswer : null;
        }

        // Hàm lấy trạng thái làm bài của người dùng
        static public function getUserQuizStatus($userId, $quizId) {
            $sql = "SELECT * FROM totalpoints WHERE user_id = ? AND quiz_id = ?";
            return pdo_query_one($sql, $userId, $quizId);
        }

        // Hàm xóa dữ liệu người dùng khi làm lại bài kiểm tra
        static public function deleteUserData($userId, $quizId) {
            // Xóa dữ liệu từ bảng 'user_answers'
            $sqlUserAnswers = "DELETE FROM user_answers WHERE user_id = ? AND quiz_id = ?";
            pdo_execute($sqlUserAnswers, $userId, $quizId);

            // Xóa dữ liệu từ bảng 'totalpoints'
            $sqlTotalPoints = "DELETE FROM totalpoints WHERE user_id = ? AND quiz_id = ?";
            pdo_execute($sqlTotalPoints, $userId, $quizId);
        }

        // Hàm update user_quiz 
        static public function saveUserQuiz ($userId, $quizId, $lessonCatId) {
            $user_quiz = pdo_execute("INSERT INTO user_quiz (user_id, quiz_id, status, lesson_cat_id) VALUES (?, ?, 1,?)", $userId, $quizId, $lessonCatId);
            return $user_quiz;
        }

    }

?>