<?php
namespace Views;

use Models\CategoryModel;
use Models\QuizModel;

class HomeUser {
    function homeUserRender() {
    ?>
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
                                    <img src="/quizASM/upload/anh1.png" alt="">
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
                    <?php
                        $categories = new CategoryModel();
                        $cate = $categories->loadAllCategories();
                        foreach ($cate as $category) : 
                    ?>                
                    <section class="lesson">
                        <h2 class="lesson-title">
                        Danh sách bài tập
                        </h2>                        
                        <div class="lesson-list">
                            <?php
                                $quizes = new QuizModel();
                                $quiz = $quizes->getListQuizByCategoryId($category['category_id']);
                                foreach ($quiz as $quiz) {                                
                            ?>
                            <a href="?act=quiz&id=<?php echo $quiz['quiz_id']; ?>" class="lesson-item">
                                <div class="lesson-img">
                                    <img src="<?php echo $quiz['image']; ?>" alt="">
                                </div>
                                <h4 class="lesson-name"><?php echo $quiz['quiz_name']; ?></h4>
                                <div class="lesson-number">
                                </div>
                                <div class="overlay">
                                    <button class="learn-now-btn">Start</button>
                                </div>
                            </a>
                            <?php
                                }
                            ?>
                        </div>                        
                    </section>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
    <?php }
}
?>