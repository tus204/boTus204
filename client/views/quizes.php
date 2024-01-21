<main class="main">
    <div class="container">
        <div class="main-layout">
            <div class="learn">
                <!-- check cái url -> get dữ liệu -> nếu mà nó có videos thì hiện video còn không có video hiện quzi -> toán tử 3 ngôi -->

                <div class="learn-left">
                    <?php foreach ($questions as $question) : ?>
                    <?php $userAnswer = quiz::getUserAnswer($userId, $quizId, $question['question_id']); ?>
                    <?php if ($userAnswer) : ?>
                    <div class="quiz-and-answer">
                        <div class="quiz-list-qa">
                            <div class="quiz-item-qa">
                                <h2 class="quiz-item-question"><?= $question['question_text'] ?></h2>
                                <?php
                                $answers = Quiz::getAllAnswersByQuestionId($question['question_id']);
                                foreach ($answers as $answer) :
                                    // $userAnswer = quiz::getUserAnswer($userId, $quizId, $question['question_id']);
                                    $isCorrectAnswer = Quiz::isCorrectAnswer($question['question_id'], $answer['answer_id']);
                                ?>
                                
                                    <div class="quiz-item-answer item-answer <?= ($userAnswer['answer_id'] == $answer['answer_id'] && !$isCorrectAnswer) ? 'item-answer error' : '' ?> <?= ($isCorrectAnswer) ? 'item-answer success' : '' ?>">
                                        <input type='radio' name='correctAnswer_<?= $question['question_id'] ?>' value='<?= $answer['answer_id'] ?>'
                                        <?= Quiz::isCorrectAnswer($question['question_id'], $answer['answer_id']) ? ' checked' : '' ?>
                                        disabled />
                                        <?= $answer['answer_text'] ?>
                                    </div>
                                <?php endforeach; ?>
                                <?php $correctAnswer = quiz::getCorrectAnswersByQuestionId($question['question_id'])?>
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
                                        $answers = Quiz::getAllAnswersByQuestionId($question['question_id']);
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

                <div class="learn-lesson">
                    <div id="course-tree">
                        <?php foreach ($lessonCats as $lessonCat) : ?>
                        <div class="course-learn course-learn-<?= $lessonCat['lesson_cat_id'] ?>" onclick="toggleCourse(<?= $lessonCat['lesson_cat_id'] ?>)">
                            <h3><?= $lessonCat['lesson_cat_name'] ?></h3>   
                            <div id="sub-courses-<?= $lessonCat['lesson_cat_id'] ?>" class="sub-courses"></div>
                        </div>
                        <?php endforeach; ?>
                        <?php foreach ($lessonCats as $lessonCat) : ?>
                        <script>
                            const subCourseData<?= $lessonCat['lesson_cat_id'] ?> = `
                            <?php
                            $lessonsAndQuizzes = getLessonsAndQuizesById($lessonCat['lesson_cat_id']);
                            foreach ($lessonsAndQuizzes as $lessonAndQuiz) :
                            ?>
                                <div class="sub-course">
                                    <h4><?= $lessonAndQuiz['name'] ?></h4>
                                    <div type="hidden"><?=$lessonAndQuiz['type']?></div>
                                </div>
                            <?php endforeach; ?>
                            `;
                        </script>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</main>
<!-- Bạn Tú gà VL luôn đấy cứ phá lung tung giờ lỗi tùm lum -->
<script>
    
    function toggleCourse(courseId) {
        const course = document.querySelector(`.course-learn-${courseId}`);
        const subCourses = course.querySelector('.sub-courses');

        course.classList.toggle('active');
        subCourses.classList.toggle('active');

        const hasData = subCourses.innerHTML.trim().length > 0;

        if (!hasData) {
            const subCourseData = getSubCourseData(courseId);
            appendSubCourseData(subCourses, subCourseData);
        }
    }

    function getSubCourseData(courseId) {
        <?php
        $lessonsAndQuizzes = getLessonsAndQuizesById(6);
        $subCourseData = [];
        foreach ($lessonsAndQuizzes as $lessonAndQuiz) {
            $subCourseData[] = [
                'name' => $lessonAndQuiz['name'],
                'id' => $lessonAndQuiz['id'],
                'type' => $lessonAndQuiz['type']
            ];
        }
        echo 'return ' . json_encode($subCourseData) . ';';
        ?>
    }

    function appendSubCourseData(container, data) {
        data.forEach(item => {
            const subCourse = document.createElement('div');
            subCourse.className = 'sub-course';

            const link = document.createElement('a');
            link.href = item.type === 'lesson' ? 'index.php?act=lesson&course_id=<?=$courseId?>&id=' + item.id : 'index.php?act=quiz&course_id=<?=$courseId?>&id=' + item.id;

            const heading = document.createElement('h4');
            heading.textContent = item.name;

            link.appendChild(heading);
            subCourse.appendChild(link);

            container.appendChild(subCourse);
        });
    }
</script>
