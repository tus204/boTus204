<?php

namespace Views;

use Models\QuizModel;

class QuizView {
    function quizRender() {
?>
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
    <div class="learn-left">
        <?php
        $quiz_id = $_GET['id'];
        $userId = $_SESSION['user_id'];
        $quiz = new QuizModel();
        $questions = $quiz->getQuestionByQuizId($quiz_id);
        foreach ($questions as $question) : 
        ?>
        <?php $userAnswer = $quiz->getUserAnswer($userId, $quiz_id, $question['question_id']); ?>
        <?php if ($userAnswer) : ?>
        <div class="quiz-and-answer">
            <div class="quiz-list-qa">
                <div class="quiz-item-qa">
                    <h2 class="quiz-item-question"><?= $question['question_text'] ?></h2>
                    <?php
                    $answers = $quiz->getAllAnswersByQuestionId($question['question_id']);
                    foreach ($answers as $answer) :
                        // $userAnswer = quiz::getUserAnswer($userId, $quizId, $question['question_id']);
                        $isCorrectAnswer = $quiz->isCorrectAnswer($question['question_id'], $answer['answer_id']);
                    ?>
                    
                        <div class="quiz-item-answer item-answer <?= ($userAnswer['answer_id'] == $answer['answer_id'] && !$isCorrectAnswer) ? 'item-answer error' : '' ?> <?= ($isCorrectAnswer) ? 'item-answer success' : '' ?>">
                            <input type='radio' name='correctAnswer_<?= $question['question_id'] ?>' value='<?= $answer['answer_id'] ?>'
                            <?= $quiz->isCorrectAnswer($question['question_id'], $answer['answer_id']) ? ' checked' : '' ?>
                            disabled />
                            <?= $answer['answer_text'] ?>
                        </div>
                    <?php endforeach; ?>
                    <?php $correctAnswer = $quiz->getCorrectAnswersByQuestionId($question['question_id'])?>
                        <div class="correctanswer success">
                            <span>Đáp án đúng:</span>
                            <div class="corrent-content"></div>
                                <?=$correctAnswer['correct_content'];?>
                            </div>
                        </div>
                </div>
            </div>
        <?php else : ?>
        <form action="" method="POST" id="quizForm">
            <div class="quiz-and-answer">
                <div class="quiz-list-qa">
                    <div class="quiz-item-qa">
                        <input type="hidden" name="question_id[<?= $question['question_id'] ?>]" value="<?= $question['question_id'] ?>" />
                        <h2 class="quiz-item-question"><?= $question['question_text'] ?></h2>
                        <img src="<?=$question['image']?>">
                        <?php
                            $answers = $quiz->getAllAnswersByQuestionId($question['question_id']);
                            foreach ($answers as $answer) :
                            ?>
                        <div class="quiz-item-answer">
                            <div class="item-answer-1">
                                <input type="radio" name="answer[<?= $answer['question_id'] ?>]" value="<?= $answer['answer_id'] ?>" id="answer<?= $answer['answer_id'] ?>">
                                <label class="item-answer" for="answer<?= $answer['answer_id'] ?>">
                                    <?= $answer['answer_text'] ?>
                                </label>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach ?>
            <button type="submit" name="submit" class="quiz-btn">Nộp bài</button>
        </form>
    </div>
    <?php }
}
?>


