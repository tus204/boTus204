<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./css/base.css">
    <title>VietNam History</title>
</head>

<body>
<header class="header header-learn">
    <div class="container">
        <div class="header-main">
            <a href="index.php?act" class="header-logo" style="color:#333;">
                <img src="https://fullstack.edu.vn/static/media/f8-icon.18cd71cfcfa33566a22b.png" alt="logo">
                <?php
                    $courseId = $_GET['course_id']; 
                    $course = getCourseListById($courseId); 
                ?>
                <p class="learn-text"><?=$course['course_name']?></p>
            </a>

            <div class="header-progress">
              <!-- <span>0/12 bài học</span> -->
            </div>
        </div>
    </div>
</header>

