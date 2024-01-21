<?php

    include_once('pdo.php');
    pdo_get_connection();

    // Hàm lấy total quizes
    function getTotalQuizes() {
        $totalQuizes = pdo_query_one("SELECT COUNT(quiz_id) as total_quizes FROM quiz");
        return $totalQuizes;
    }

    // Hàm lấy total questions
    function getTotalQuestions() {
        $totalQuestions = pdo_query_one("SELECT COUNT(question_id) as total_questions FROM questions");
        return $totalQuestions;
    }

    // Hàm lấy total courses
    function getTotalCourses() {
        $totalCourses = pdo_query_one("SELECT COUNT(course_id) as total_courses FROM course");
        return $totalCourses;
    }

    // Hàm lấy total categories
    function getTotalCategories() {
        $totalCategories = pdo_query_one("SELECT COUNT(category_id) as total_categories FROM categories");
        return $totalCategories;
    }

    // Hàm lấy total posts
    function getTotalPosts() {
        $totalPosts = pdo_query_one("SELECT COUNT(post_id) as total_posts FROM posts");
        return $totalPosts;
    }

    // Hàm lấy total comments
    function getTotalComments() {
        $totalComments = pdo_query_one("SELECT COUNT(comment_id) as total_comments FROM comments");
        return $totalComments;
    }

    // Hàm lấy total users
    function getTotalUsers() {
        $totalUsers = pdo_query_one("SELECT COUNT(user_id) as total_users FROM users");
        return $totalUsers;
    }

?>