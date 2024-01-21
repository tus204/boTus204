<?php
    include_once ('../../../models/pdo.php');
    include_once ('../../../models/lesson_cate.php');
    include_once ('../../../models/quiz.php');

    if (isset($_POST['lesson_cat_id'])) {
        $lesson_cat_id = $_POST['lesson_cat_id'];
        
        if (!empty($lesson_cat_id)) {
        $lessonStt = quiz::getQuizStt($lesson_cat_id);
        // if ($lessonStt > 0) {
        //     echo $lessonStt['max_stt']+2;
        // } else {
        //     echo $lessonStt['max_stt']+1;
        //     }
        // }
        echo $lessonStt['max_stt']+2;
        }
    } else {
        echo '';
    }
?>