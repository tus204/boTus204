    <div class="d-flex justify-content-left mt-5">
        <div class="border-right pr-3"></div>
        <button type="button" class="addQuestion btn btn-primary w-20 btn-add " id="addQuestion">Add Question</button>
    </div>
<?php 
    foreach ($questions as $question) :
?>    
    <form class="mt-4 d-flex flex-column gap-2" method="">
        <div class="question-list">
            <div class="question-item rounded-3">
            <div class="question-action d-flex align-items-center">
                <label for="question" class="me-2">Question:</label>
                <input name="questionText" type="text" id="question" class="form-control question-name" value="<?= $question['question_text'] ?>" readonly>
                <div class="question-edit ms-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; background-color: #007bff; color: #fff;">
                    <a href="?act=add-question&quiz_id=<?=$question['quiz_id']?>&question_id=<?= $question['question_id'] ?>"><i class="fas fa-pen"></i></a>
                </div>
                <div class="question-delete ms-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; background-color: #dc3545; color: #fff;">
                    <a href='?act=add-question&quiz_id<?=$question['quiz_id']?>&question_id=<?= $question['question_id'] ?>'><i class="fas fa-trash-alt"></i></a>
                </div>
            </div>
            <?php
                $answers = Quiz::getAllAnswersByQuestionId($question['question_id']);
                foreach ($answers as $answer) :
            ?>
            <div class="question-answer mt-2">
                <ul class="list-answer list-unstyled">
                    <div class="answer-group">
                        <li>
                            <input type='radio' name='correctAnswer_<?= $question['question_id'] ?>' value='<?= $answer['answer_id'] ?>'<?= Quiz::isCorrectAnswer($question['question_id'], $answer['answer_id']) ? ' checked' : '' ?> disabled><?= $answer['answer_text'] ?>        
                        </li>                        
                    </div>
                </ul>
            </div>  
            <?php endforeach; ?>      
        </div>
        </div>

    </form>
<?php endforeach;
    
?>

<div class="question-model">
    <div class="container mt-5">
        <form action="" class="question" method="POST" enctype="multipart/form-data" >
            <div class="form-question">
                <textarea name="questionText"  rows="4" type="text" placeholder="Type question here"></textarea>
                <input name="image" type="file">
            </div>
            <div class="list-answer">
                <div class="answer-item" style="background-color: #2c71ae;">
                    <div class="answer-top text-left">
                        <input type="radio" name="correctAnswer" value="answer1">
                    </div>
                    <div class="answer-input">
                        <textarea name="answer1" rows="4" type="text" placeholder="Type answer option here"></textarea>
                    </div>
                </div>
                <div class="answer-item" style="background-color: #2d9da6;">
                    <div class="answer-top text-left">
                        <input type="radio" name="correctAnswer" value="answer2">
                    </div>
                    <div class="answer-input">
                        <textarea name="answer2" rows="4" type="text" placeholder="Type answer option here"></textarea>
                    </div>
                </div>
                <div class="answer-item" style="background-color: #efa92a;">
                    <div class="answer-top text-left">
                        <input type="radio" name="correctAnswer" value="answer3">
                    </div>
                    <div class="answer-input">
                        <textarea name="answer3" rows="4" type="text" placeholder="Type answer option here"></textarea>
                    </div>
                </div>
                <div class="answer-item" style="background-color: #d5556e;">
                    <div class="answer-top text-left">
                        <input type="radio" name="correctAnswer" value="answer4">
                    </div>
                    <div class="answer-input">
                        <textarea name="answer4" rows="4" type="text" placeholder="Type answer option here"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group mt-2">
                <textarea name="correct-content" style="width: 100%;color: #333;padding: 10px;" type="text" rows="4" columns="16" placeholder="Corect Answer"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-4 btnSave" name="save">Save</button>
        </form>
    </div>
</div>

<!-- <script>
    document.getElementById('addQuestion').addEventListener('click', function() {
        var questionList = document.querySelector('.question-list');
        var questionItem = questionList.firstElementChild.cloneNode(true); // Sao chép form đầu tiên
        // Thêm sự kiện click cho nút xóa
        var deleteButton = questionItem.querySelector('.question-delete');
        deleteButton.addEventListener('click', function() {
            questionList.removeChild(questionItem); // Loại bỏ form khi ấn nút xóa
        });
        var inputs = questionItem.querySelectorAll('input');
        inputs.forEach(function(input) {
            input.value = ''; // Xóa giá trị của các trường input
        });
        questionList.appendChild(questionItem); // Thêm form mới vào .question-list
    });
</script>
-->
