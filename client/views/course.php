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

            <section class="course">
                <div class="course-content">
                    <h2 class="course-name"><?= $courseDetail['course_name']; ?></h2>
                    <p class="course-desc"><?= $courseDetail['desc']; ?></p>
                    <h4 class="course-title"><?= $courseDetail['title']; ?></h4>
                    <ul class="course-info">
                        <?= $courseDetail['content']; ?>
                    </ul>
                </div>
                <div class="course-state">
                    <iframe class="course-video" src="https://www.youtube.com/embed/<?= $courseDetail['video']; ?>" frameborder="0" allowfullscreen></iframe>
                    <h5>Miễn phí</h5>
                    <a href="index.php?act=learn&course_id=<?= $courseDetail['course_id']; ?>" class="btn course-btn">Đăng kí học</a>
                </div>
            </section>
        </div>
    </div>
</main>
