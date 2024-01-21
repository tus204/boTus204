<?php
function add_lesson_cat($lesson_category_name,$course_id){
    $sql = "INSERT INTO `lesson_cat`( `lesson_cat_name`, `course_id`) VALUES ('$lesson_category_name','$course_id')";
    pdo_execute($sql);
}
function Getall_lesson_cat(){
    $sql ="SELECT * FROM lesson_cat WHERE course_id=".$_GET['id'];
    $listlessoncat= pdo_query($sql);
    return $listlessoncat;
}
function delete_lesson_cat(){
    $sql= "DELETE FROM `lesson_cat` WHERE lesson_cat_id =".$_GET['id'];
    pdo_execute($sql);
}
// Hàm xóa lesson theo lesson category
function delete_lesson_byLC(){
    $sql= "DELETE FROM `lesson` WHERE lesson_cat_id =".$_GET['id'];
    pdo_execute($sql);
}
// Láy dữ liệu theo id
function Get_lesson_cat_byId(){
    $sql = "SELECT * FROM lesson_cat WHERE lesson_cat_id=".$_GET['id'];
    $lesson_cat = pdo_query_one($sql);
    return $lesson_cat;
}
function Get_lesson_cat_byIddel(){
    $sql = "SELECT 
    course_id
    FROM lesson_cat WHERE lesson_cat_id=".$_GET['id'];
    $lesson_cat_del = pdo_query_one($sql);
    return $lesson_cat_del;
}
function update_lesson_cat_byId($lesson_cat_name){
    $sql ="UPDATE `lesson_cat` SET `lesson_cat_name`='$lesson_cat_name' WHERE lesson_cat_id=".$_GET['id'];
    pdo_execute($sql);
}

function getAllLessonCat ($courseId) {
    $lessonCat = pdo_query("SELECT * FROM lesson_cat WHERE course_id = ?", $courseId);
    return $lessonCat;
}

function getLessonCategoryById ($lessonCatId) {
    $lessonCatDetail = pdo_query("SELECT * FROM lesson_cat WHERE lesson_cat_id = ?", $lessonCatId);
    return $lessonCatDetail;
}

function getAllLessonCate () {
    $lessonCat = pdo_query("SELECT * FROM lesson_cat");
    return $lessonCat;
}
?>