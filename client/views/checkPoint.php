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

            <section class="check-point">
                <div class="result" id="quizResult">Tổng điểm của bạn là <span><?= number_format(($result['total_points'] / $quiz['total_question']) * 10, 2)?> điểm</span></div>
                <!-- <div class="result"><span>Thời gian làm bài: <?= 'chưa biết' ?></span></div> -->
                <?php foreach ($questions as $question) : ?>   
                <div class="question">Câu hỏi: <?= $question['question_text'] ?></div>
                <?php
                    $answers = Quiz::getAllAnswersByQuestionId($question['question_id']);
                    foreach ($answers as $answer) :
                        $userAnswer = quiz::getUserAnswer($userId, $quizId, $question['question_id']);
                        $isCorrectAnswer = Quiz::isCorrectAnswer($question['question_id'], $answer['answer_id']);
                ?>
                <ul class="options <?= ($userAnswer['answer_id'] == $answer['answer_id'] && !$isCorrectAnswer) ? 'incorrect-answer' : '' ?> <?= ($isCorrectAnswer) ? 'correct-answer' : '' ?>">
                <li><input type='radio' name='correctAnswer_<?= $question['question_id'] ?>' value='<?= $answer['answer_id'] ?>'<?= Quiz::isCorrectAnswer($question['question_id'], $answer['answer_id']) ? ' checked' : '' ?> disabled><?= $answer['answer_text'] ?></li>    
                </ul>
                <?php endforeach; ?>  
                <?php endforeach; ?>

                <a href="?act=reset-quiz&quiz_id=<?= $_GET['quiz_id'] ?>&user_id=<?= $_SESSION['user_id']; ?>"><button class="quiz-btn" onclick="return confirm('Nếu bạn làm lại, tất cả kết quả sẽ bị xóa !')">Làm lại</button></a>
            </section>
        </div>
    </div>
</main>
