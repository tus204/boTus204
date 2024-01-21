<?php
    include_once ('../../../models/pdo.php');
    include_once ('../../../models/lesson_cate.php');
    include_once ('../../../models/quiz.php');

    if (isset($_POST['lesson_cat_id'])) {
        $lesson_cat_id = $_POST['lesson_cat_id'];
        
        if (!empty($lesson_cat_id)) {
        $quizStt = quiz::getQuizStt($lesson_cat_id);
        echo $quizStt['max_stt']+2;
        }
    } else {
        echo '';
    }
?>