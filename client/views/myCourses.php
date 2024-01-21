<main class="main">
    <div class="container">
        <div class="main-layout">
            <div class="sidebar">
                <div class="sidebar-list">
                    <div class="sidebar-item add-blog">
                        <i class="fa-solid fa-plus"></i>
                        <a href="index.php?act=add-blog">Viết blog</a>
                    </div>
                    <div class="sidebar-item active">
                        <i class="fa-solid fa-house"></i>
                        <a href="index.php?act=home">Trang chủ</a>
                    </div>
                    <div class="sidebar-item">
                        <i class="fa-solid fa-road"></i>
                        <a href="index.php?act=learning-path">Lộ trình</a>
                    </div>
                    <div class="sidebar-item">
                        <i class="fa-solid fa-paste"></i>
                        <a href="index.php?act=blog">Bài viết</a>
                    </div>
                    <div class="sidebar-item">
                        <i class="fa-solid fa-ranking-star"></i>
                        <a href="index.php?act=rank">Xếp hạng</a>
                    </div>
                </div>
            </div>

            <div class="myCourse">
                <h2 class="myCourse-name">Khóa học của tôi</h2>
                <h2 class="myCourse-title">Bạn có thể xem các khóa học của bạn đã đăng ký ở đây</h2>

                <div class="lesson-list">
                    <?php
                              include_once ('../models/course.php');
                              $user_id = $_SESSION['user_id'];
                              $courses = getCourseListForUser($user_id);                  
                              foreach ($courses as $course) {                                
                              ?>
                    <a href="index.php?act=course&id=<?php echo $course['course_id']; ?>" class="lesson-item">
                        <div class="lesson-img">
                            <img src="<?php echo $course['image']; ?>" alt="" />
                        </div>
                        <h4 class="lesson-name"><?php echo $course['course_name']; ?></h4>
                        <div class="lesson-number">
                            <i class="fa-solid fa-users"></i>
                            <p><?php echo $course['total_register']; ?></p>
                        </div>
                        <div class="overlay">
                            <button class="learn-now-btn">Xem Khóa Học</button>
                        </div>
                    </a>
                    <?php
                              }
                              ?>
                </div>
            </div>
        </div>
    </div>
</main>
