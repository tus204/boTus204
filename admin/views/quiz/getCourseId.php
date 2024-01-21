<?php
    include_once ('../../../models/pdo.php');
    include_once ('../../../models/lesson_cate.php');
    include_once ('../../../models/quiz.php');

    if (isset($_POST['course_id'])) {
        $course_id = $_POST['course_id'];
    
        // Fetch lesson categories based on the selected course_id
        $lesson_cat = getAllLessonCat($course_id);
    
        // Output lesson category options
        foreach ($lesson_cat as $cate) {
            extract($cate);
            echo '<option value="' . $lesson_cat_id . '">' . $lesson_cat_name . '</option>';
        }
    } else {
        // Handle the case when course_id is not set
        echo '<option value="">Select Course First</option>';
    }    
    
?>