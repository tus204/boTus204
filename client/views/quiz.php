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
                        <i class="fa-solid fa-ranking-star"></i>
                        <a href="index.php?act=rank">Xếp hạng</a>
                    </div>
                </div>
            </div>

            <section class="quiz">
                <h2 class="quiz-heading">Kiểm Tra Kiến Thức Lịch Sử</h2>
                <p class="quiz-des"><?= $quiz['quiz_name'] ?></p>
                <div style="display: flex; align-items: center; justify-content: space-between; width: 60%;">
                    <div class="quiz-info">
                        <!-- <p class="quiz-text">Thời gian: <span><?= date('i:s', strtotime($quiz['time'])); ?></span></p>    -->
                        <p class="quiz-text">Số câu hỏi: <span><?= $quiz['total_question']; ?></span></p>
                        <p class="quiz-text">Tổng điểm: <span><?= $quiz['point']; ?></span></p>
                    </div>
                    <!-- <div class="quiz-time" name="quizTime">Thời gian còn lại: <span><?= date('i:s', strtotime($quiz['time'])); ?></span></div>   -->
                </div>
                <?php foreach ($questions as $question) : ?>
                    <?php $userAnswer = quiz::getUserAnswer($userId, $quizId, $question['question_id']); ?>
                        <?php if ($userAnswer) : ?>
                            <section class="check-point">
                                <div class="question">Câu hỏi: <?= $question['question_text'] ?></div>
                                <?php
                                $answers = Quiz::getAllAnswersByQuestionId($question['question_id']);
                                foreach ($answers as $answer) :
                                    // $userAnswer = quiz::getUserAnswer($userId, $quizId, $question['question_id']);
                                    $isCorrectAnswer = Quiz::isCorrectAnswer($question['question_id'], $answer['answer_id']);
                                ?>
                                    <ul class="options <?= ($userAnswer['answer_id'] == $answer['answer_id'] && !$isCorrectAnswer) ? 'incorrect-answer' : '' ?> <?= ($isCorrectAnswer) ? 'correct-answer' : '' ?>">
                                        <li><input type='radio' name='correctAnswer_<?= $question['question_id'] ?>' value='<?= $answer['answer_id'] ?>' <?= Quiz::isCorrectAnswer($question['question_id'], $answer['answer_id']) ? ' checked' : '' ?> disabled><?= $answer['answer_text'] ?></li>
                                    </ul>
                                <?php endforeach; ?>
                            </section>
                        <?php else : ?>
                        <form action="" method="POST" id="quizForm">
                            <div class="question-list">
                                <div class="question-item">
                                    <div class="question">
                                        <input type="" name="question_id[<?= $question['question_id'] ?>]" value="<?= $question['question_id'] ?>">
                                        <p><?= $question['question_text'] ?></p>
                                    </div>
                                    <?php
                                    $answers = Quiz::getAllAnswersByQuestionId($question['question_id']);
                                    foreach ($answers as $answer) :
                                    ?>
                                        <ul class="options">
                                            <li><input type="radio" name="answer[<?= $answer['question_id'] ?>]" value="<?= $answer['answer_id'] ?>"><?= $answer['answer_text'] ?></li>
                                        </ul>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach ?>
                    <button type="submit" name="submit" class="quiz-btn">Nộp bài</button>
                        </form>
            </section>
        </div>
    </div>
</main>