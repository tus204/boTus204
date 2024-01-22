<?php

namespace Views;

class HeaderUser {
    function headerUserRender() {
    ?>
        <?php
        $userName = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : '';
        $avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : '';
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
                integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
            <link rel="stylesheet" href="/quizASM/client/css/base.css">
            <link rel="stylesheet" href="/quizASM/client/css/login.css">
            <link rel="stylesheet" href="/quizASM/client/css/home.css">
            <link rel="stylesheet" href="/quizASM/client/css/course.css">
            <link rel="stylesheet" href="/quizASM/client/css/learn.css">
            <link rel="stylesheet" href="/quizASM/client/css/profile.css">
            <link rel="stylesheet" href="/quizASM/client/css/learningPath.css">
            <link rel="stylesheet" href="/quizASM/client/css/blog.css">
            <link rel="stylesheet" href="/quizASM/client/css/detailedBlog.css">
            <link rel="stylesheet" href="/quizASM/client/css/listQuiz.css">
            <link rel="stylesheet" href="/quizASM/client/css/rank.css">
            <title>VietNam History</title>
            <style>
                .error-message {
                    color: red;
                    margin-top: 10px;
                }
            </style>
        </head>

        <body>
        <header class="header">
            <div class="container">
                <div class="header-main">
                    <a href="index.php" class="header-logo" style="color:#333;">
                        <img src="https://fullstack.edu.vn/static/media/f8-icon.18cd71cfcfa33566a22b.png" alt="logo">
                        <p class="logo-text">Học lịch sử trực tuyến</p>
                    </a>
                    <div class="header-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Tìm kiếm khóa học">
                    </div>
                    <?php if (!empty($userName)): ?>
                        <div class="header-action">
                            <div class="user-profile">
                                <img src="<?php echo $avatar; ?>" alt="User Avatar" class="user-avatar">
                                <p><?php echo $userName; ?></p>
                                <div class="submenu">
                                    <ul>
                                    <?php if ($_SESSION['role'] === 'Admin'): ?>
                                        <li><a href="/VietNamHistory/admin/">Truy cập trang admin</a></li>
                                    <?php endif; ?>
                                        <li><a href="index.php?act=profile">Trang cá nhân</a></li>
                                        <li><a href="index.php?act=my-courses">Danh sách quiz đã làm</a></li>
                                        <li><a href="index.php?act=logout">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="header-action">
                            <a href="index.php?act=login" class="btn btn-white">Đăng nhập</a>
                            <a href="index.php?act=register" class="btn header-btn">Đăng ký</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </header>
    <?php }
}
?>