<form class="mt-5 d-flex flex-column gap-2" id="add-quiz" enctype="multipart/form-data" method="POST">
<br>
     <br>
    <h2 class="text-center text-primary">Add new quiz</h2>
    <div class="form-group">
        <label>Quiz Name</label>
        <input name="quizName" id="quizName" type="text" class="form-control" placeholder="Enter quiz name" require>
        <span class="error" id="quizName_error" style="color:red"></span>
    </div>

    <div class="form-group">
        <label>Quiz time</label>
        <input name="quizTime" id="quizTime" type="number" min="0" max="20" class="form-control" placeholder="Enter quiz time" require>
        <span class="error" id="quizTime_error" style="color:red"></span>
    </div>

    <div class="form-group">
        <label>Quiz image</label>
        <input name="quizImage" id="quizImage" type="file" class="form-control" require>
        <span class="error" id="quizImage_error" style="color:red"></span>
    </div>  
    
    <div class="form-group">
        <label>Course Name</label>
        <select class="form-control" name="course_id" id="course_id">
            <option value="">Select Course</option>
            <?php
                foreach ($course as $course) {
                    extract($course);
                    echo '<option value="' . $course_id . '">' . $course_name . '</option>';                    
                }
            ?>
        </select>        
    </div>

    <div class="form-group">
    <label>Lesson Category Name</label>
        <select class="form-control" name="lesson_cat_id" id="lesson_cat_id">
            <option value="">Select Lesson Category</option>
        </select>
    </div>

    <div class="form-group">
        <label>Quiz STT</label>
        <input name="quiz_stt" id="quiz_stt" type="text" class="form-control" value="" placeholder="Enter quiz name" require>
        <span class="error" id="" style="color:red"></span>
    </div>

    <div class="d-flex justify-content-between">
        <button onclick="val_quiz()" name="submit" type="submit" class="btn btn-primary w-25 mt-4">Submit</button>
        <button type="reset" class="btn btn-warning text-white w-25 mt-4">Reset</button>
    </div>
</form>
<script src="validate.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#course_id').on('change', function() {
            let course_id = this.value
            $.ajax({
                url: "./views/quiz/getCourseId.php",
                type: "POST",
                data: {
                    course_id: course_id
                },
                cache: false,
                success: function(result) {
                    $("#lesson_cat_id").html(result);
                    $("#quiz_stt").val('');
                }
            });
        });
    
        $('#lesson_cat_id').on('change', function() {
            let lesson_cat_id = this.value
            $.ajax({
                url: "./views/quiz/getLessonCate.php",
                type: "POST",
                data: {
                    lesson_cat_id: lesson_cat_id
                },
                cache: false,
                success: function(result) {
                    $("#quiz_stt").val(result);
                }
            });
        });
    })
</script>
