

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

            <section class="blog">
                <h2 class="blog-heading">Bài viết nổi bật</h2>
                <p class="blog-title">Tổng hợp các bài viết chia sẻ kinh nghiệm tự học lịch sử và các khó khăn khi tìm hiểu lịch sử Việt Nam</p>
                <div class="blog-list">
                <?php 
                foreach ($Blogview as $blog) {
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
                    <a href="<?=$detail_blog?>" >
                    <div class="blog-item">
                        <div class="blog-info">
                            <img src="<?php echo $image_user ?>" alt="avatar" />
                            <p style="font-size: 15px;"><?=$full_name?></p>
                        </div>
                        <div class="blog-content">
                            <div class="">
                                <div class="blog-name"><?=$post_title?></div>
                                <div class="blog-desc" style="max-height: 50px; overflow: hidden; max-width: 900px;"><?=$post_content?></div>
                            </div>
                            <div class="blog-img">
                              <img src="<?php echo '../upload/'.$image ;?>" alt="avatar post" />
                            </div>
                        </div>
                        <div class="blog-more">
                              <div class="blog-category"><?=$category_name?></div>
                              <div class="blog-time"><?php
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
                              ?></div>
                        </div>
                        </a>
                    </div>    
             <?php   } ?>
                </div>
            </section>
        </div>
    </div>
</main>
