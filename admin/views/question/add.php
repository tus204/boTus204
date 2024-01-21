<form class="mt-4 d-flex flex-column gap-2" method="POST">
    <div class="question-list">
        <div class="question-item ">
        <div class="question-action d-flex align-items-center">
            <label for="question" class="me-2">Question:</label>
            <input name="questionText" type="text" id="question" class="form-control question-name">
            <div class="question-edit ms-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; color: #fff;">
                <i class="fas fa-pen"></i>
            </div>
            <div class="question-delete ms-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; color: #fff;">
                <i class="fas fa-trash-alt"></i>
            </div>
        </div>
        <div class="question-answer mt-2">
            <ul class="list-answer list-unstyled">
                <div class="answer-group">
                    <li>
                        <label for="answer1">Answer 1:</label>
                        <input type="text" name="answer1" class="form-control question-name"> 
                        <input type="radio" name="correctAnswer" value="answer1">
                            
                    </li>
                    <li>
                        <label for="answer2">Answer 2:</label>
                        <input type="text" name="answer2" class="form-control question-name" >
                        <input type="radio" name="correctAnswer" value="answer2">
                    </li>
                </div>
                <div class="answer-group">
                    <li>
                        <label for="answer3">Answer 3:</label>
                        <input type="text" name="answer3" class="form-control question-name" >
                        <input type="radio" name="correctAnswer" value="answer3">
                    </li>
                    <li>
                        <label for="answer4">Answer 4:</label>
                        <input type="text" name="answer4" class="form-control question-name" >
                        <input type="radio" name="correctAnswer" value="answer4">
                    </li>                        
                </div>
                <div class="answer-group">
                    <label for="difficulty">Difficulty:</label>
                    <select name="difficulty" id="difficulty" class="form-select">
                        <option value="Easy">Easy</option>
                        <option value="Normal">Normal</option>
                        <option value="Hard">Hard</option>
                    </select>
                </div>
            </ul>
        </div>        
    </div>
    </div>

    <button type="button" class="addQuestion btn btn-primary w-25 mt-4 btn-add " id="addQuestion">Add Question</button>
    <div class="d-flex justify-content-between">
        <button name="save" type="submit" class="btn btn-primary w-25 mt-4">Submit</button>
    </div>
</form>



<div class="question-model">
    <div class="container mt-5">
        <form action="" class="question">
            <div class="form-question">
                <textarea name="questionText" rows="4" type="text" placeholder="Type question here"></textarea>
            </div>
            <div class="list-answer">
                <div class="answer-item" style="background-color: #2c71ae;">
                    <div class="answer-top text-left">
                        <input type="radio" />
                    </div>
                    <div class="answer-input">
                        <textarea rows="4" type="text" placeholder="Type answer option here"></textarea>
                    </div>
                </div>
                <div class="answer-item" style="background-color: #2d9da6;">
                    <div class="answer-top text-left">
                        <input type="radio" />
                    </div>
                    <div class="answer-input">
                        <textarea rows="4" type="text" placeholder="Type answer option here"></textarea>
                    </div>
                </div>
                <div class="answer-item" style="background-color: #efa92a;">
                    <div class="answer-top text-left">
                        <input type="radio" />
                    </div>
                    <div class="answer-input">
                        <textarea rows="4" type="text" placeholder="Type answer option here"></textarea>
                    </div>
                </div>
                <div class="answer-item" style="background-color: #d5556e;">
                    <div class="answer-top text-left">
                        <input type="radio" />
                    </div>
                    <div class="answer-input">
                        <textarea rows="4" type="text" placeholder="Type answer option here"></textarea>
                    </div>
                </div>
            </div>
           
            <button type="button" class="btn btn-primary mt-4 btnSave">Save</button>
        </form>
    </div>
</div>