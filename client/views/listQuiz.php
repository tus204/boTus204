<main class="main">
    <div class="container">
        <div class="main-layout">
            <div class="sidebar">
                <div class="sidebar-list">
                    <div class="sidebar-item add-blog">
                        <i class="fa-solid fa-plus"></i>
                        <a href="index.php?act=add-blog">Viết Blog</a>
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
            
                <div class="list-quiz">
                    <h2 class="list-quiz-heading">Các bài tập liên quan đến bài vừa học</h2>
                    <?php foreach ($quizes as $quiz): ?>
                    <a href="index.php?act=quiz&quiz_id=<?= $quiz['quiz_id'] ?>">
                        <ul class="quiz-list">
                            <li class="quiz-item">
                                <h3>Tên bài kiểm tra: <?= $quiz['quiz_name'] ?></h3>
                                <!-- <p class="quiz-content">Thời gian: <?= $quiz['time'] ?></p> -->
                                <!-- <div class="quiz-content">Tổng số câu hỏi: <?= $quiz['total_questions'] ?></div> -->
                                <p class="quiz-author">Người tạo: 
                                    <?php 
                                        $user = getUserById($quiz['user_id']);
                                        echo $user['full_name']
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </a>
                    <?php endforeach; ?>
                </div>

        </div>
    </div>
</main>
