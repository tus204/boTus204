<?php

    include_once('pdo.php');
    // Hàm lấy thông tin course 
    function getCourseList() {
        $sql = "SELECT c.course_id, c.desc, c.title, c.video, c.content, c.course_name, c.image, COUNT(uc.user_id) AS total_register
                        FROM course c
                        LEFT JOIN user_course uc ON c.course_id = uc.course_id
                        GROUP BY c.course_id";
        try {
            // Thực hiện truy vấn và lấy kết quả
            $courses = pdo_query($sql);
            return $courses;

        } catch (PDOException $e) {
            // Xử lý ngoại lệ nếu có lỗi khi thực hiện truy vấn
            echo "Lỗi: " . $e->getMessage();
        }   
    }

    // Hàm lấy thông tin course by id
    function getCourseListById($courseId) {
        $sql = "SELECT * FROM course WHERE course_id = ?";
        $courseDetail = pdo_query_one($sql, $courseId);
        return $courseDetail;
    }

    // Hàm lấy thông tin khóa học của người dùng đang đăng nhập
    function getCourseListForUser($userId) {
        $sql = "SELECT c.*, 
                (SELECT COUNT(user_id) FROM user_course WHERE course_id = c.course_id) AS total_register 
                FROM course c
                JOIN user_course uc ON c.course_id = uc.course_id
                WHERE uc.user_id = ? 
                GROUP BY c.course_id";
        $courses = pdo_query($sql, $userId);
        return $courses;
    }
    
    // Hàm check user đã đăng kí course chưa
    function checkUserCourse($userId, $courseId) {
        $sql = "SELECT * FROM user_course WHERE user_id = ? AND course_id = ?";
        $result = pdo_query_one($sql, $userId, $courseId);
        return $result ? true : false;
    }

    // Hàm lưu id user đăng kí vào db
    function saveUserCourse($userId, $courseId) {
        $sql = "INSERT INTO user_course (user_id, course_id) VALUES (?, ?)";
        $result = pdo_query($sql, $userId, $courseId);
        return $result;
    }

    // hàm upload ảnh
    function uploadImage($newImage, $oldImagePath)
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

    // Hàm thêm course
    function addCourse($courseName, $courseTitle, $courseVideo, $courseContent, $courseDesc, $category, $image) {
        try {               
            // Kiểm tra xem có ảnh mới được tải lên không và cập nhật ảnh
            $image_path = empty($image["name"]) ? null : uploadImage($image, null);

            // thêm quiz
            $sql = "INSERT INTO course (course_name, title, video, content, `desc`, category_id, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $result = pdo_query($sql, $courseName, $courseTitle, $courseVideo, $courseContent, $courseDesc, $category, $image_path);
            return $result;
        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            echo "Error: " . $e->getMessage();
        }
    }

    // Hàm lấy tổng số quizes
    function getTotalQuizesById($courseId) {
        $sql = "SELECT COUNT(quiz_id) as total_quizes FROM quiz WHERE course_id = ?";
        $totalQuizes = pdo_query_one($sql, $courseId);
        return $totalQuizes['total_quizes'];
    }

    // Hàm update course
    function updateCourse($courseId, $courseName, $courseTitle, $courseVideo, $courseContent, $courseDesc, $image) {
        try {
            // lấy thông từ course từ id
            $course = getCourseListById($courseId);

            // Kiểm tra xem có ảnh mới được tải lên không và cập nhật đường dẫn ảnh
            $image_path = empty($image["name"]) ? $course['image'] : uploadImage($image, $course['image']);

            // Cập nhật người dùng
            $sql_update = "UPDATE `course` SET `course_name`=?, `title`=?, `video`=?, `content`=?, `desc`=?, `image`=? WHERE `course_id`=?";
            pdo_execute($sql_update, $courseName, $courseTitle, $courseVideo, $courseContent, $courseDesc, $image_path, $courseId);
        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            echo "Error: " . $e->getMessage();
        }
    }

    // Hàm xóa course
    function delCourse($courseId) {
        $sql = "DELETE FROM `course` WHERE `course_id`=?";
        pdo_execute($sql, $courseId);
    }
    // Hàm xóa user_course
    function delUserCourse($courseId) {
        $sql = "DELETE FROM `user_course` WHERE `course_id`=?";
        pdo_execute($sql, $courseId);
    }

?>