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
                        <a href="index.php?act=">Trang chủ</a>
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
            <div class="content">
                <section class="slide-show">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="../upload/anh1.png" alt="">
                            </div>
                            <!-- <div class="swiper-slide">
                                <img src="../upload/anh2.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="../upload/anh3.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="../upload/anh4.jpg" alt="">
                            </div> -->
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </section>

                <section class="lesson">
                    <h2 class="lesson-title">Danh sách khóa học</h2>
                    <div class="lesson-list">
                        <?php
                            include_once ('../models/course.php');
                            $courses = getCourseList();
                            foreach ($courses as $course) {                                
                        ?>
                        <a href="index.php?act=course&id=<?php echo $course['course_id']; ?>" class="lesson-item">
                            <div class="lesson-img">
                                <img src="<?php echo $course['image']; ?>" alt="">
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
                </section>

                <section class="post-home">
                    <h2 class="post-title">Bài viết nổi bật</h2>
                    <div class="post-list">
                        <?php 
                        foreach ($top9 as $blog ) {
                            extract($blog);
                            $detail_blog = "index.php?act=detail-blog&id=".$post_id;
                            $now = time();
                            $time = strtotime($post_time);
                            $ago = $now - $time;
                            // Tính toán các đơn vị thời gian từ số giây
                            $days = floor($ago / (60 * 60 * 24)); // Số ngày
                            $hours = floor(($ago % (60 * 60 * 24)) / (60 * 60)); // Số giờ
                            $minutes = floor(($ago % (60 * 60)) / 60); // Số phút
                            $remainingSeconds = $ago % 60; // Số giây
                        ?>
                        <a href="<?=$detail_blog?>" class="post-item">
                            <div class="post-img">
                                <img src="<?php echo '../upload/'.$image ?>" alt="">
                            </div>
                            <h4 class="post-name"></h4>
                            <div class="post-info">
                                <h4 class="user-name">Người tạo: <?=$full_name?></h4>
                                <p class="post-time">Thời gian:<?php
                              if($days >0){
                                echo $days." ngày trước";
                              }
                              elseif($hours>0){
                                echo $hours." giờ trước";
                              }
                              elseif($minutes > 0){
                                echo $minutes." phút trước";
                              }
                              else{
                                echo $remainingSeconds." giây trước";
                              }
                              ?></p>
                            </div>
                            <div class="overlay">
                                <button class="learn-now-btn" onclick="window.location.href='<?=$detail_blog?>'">Xem bài viết</button>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                </section>

            </div>
        </div>
    </div>
</main>