<?php

    // Hàm lấy lesson category từ course_id
    function getLessonCatById ($courseId) {
        $lessonCat = pdo_query("SELECT * FROM lesson_cat WHERE course_id = ?", $courseId);
        return $lessonCat;
    }

    // Hàm lấy lesson và quiz của lesson_cat
    function getLessonsAndQuizesById ($lessonCatId) {
        $lessonAndQuizes = pdo_query("SELECT 'lesson' AS type, lesson_id AS id, lesson_name AS name, stt, status
                                    FROM lesson
                                    WHERE lesson_cat_id = ?
                                    UNION
                                    SELECT 'quiz' AS type, quiz_id AS id, quiz_name AS name, stt, status
                                    FROM quiz
                                    WHERE lesson_cat_id = ?
                                    ORDER BY stt", $lessonCatId, $lessonCatId);
        return $lessonAndQuizes;
    }

    // Hàm lấy lesson
    function getLessonById ($lessonId) {
        $lessons = pdo_query_one("SELECT * FROM lesson WHERE lesson_id = ?", $lessonId);
        return $lessons;
    }

    function GetAll_lesson(){
        $sql= "SELECT * FROM lesson WHERE lesson_cat_id=".$_GET['id'];
        $list_Lesson = pdo_query($sql);
        return $list_Lesson;
    }
    function Add_lesson($lesson_cat_id,$lesson_name,$video,$desc,$stt){
        $sql="INSERT INTO `lesson`(`lesson_cat_id`, `lesson_name`, `video`, `description`, `stt`) VALUES ('$lesson_cat_id','$lesson_name','$video','$desc','$stt')";
        pdo_execute($sql);

    }
    function delete_lesson(){
        $sql = "DELETE FROM `lesson` WHERE lesson_id=".$_GET['id'];
        pdo_execute($sql);
    }
    function Get_lesson_byId(){
        $sql = "SELECT * FROM lesson WHERE lesson_id=".$_GET['id'];
        $lesson = pdo_query_one($sql);
        return $lesson;
    }
    // Hàm để update dữ liệu 
    function update_lesson($lesson_name,$video,$desc){
        $sql ="UPDATE `lesson` SET`lesson_name`='$lesson_name',`video`='$video',`description`='$desc' WHERE lesson_id=".$_GET['id'];
        pdo_execute($sql);
    }

    // Hàm lấy stt lesson
    function getSttLesson ($lesson_cat_id) {
        $stt = pdo_query_one("SELECT MAX(stt) AS max_stt FROM lesson WHERE lesson_cat_id = ?", $lesson_cat_id);
        return $stt;
    } 
?>