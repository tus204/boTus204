<?php

    $createdBy = $_SESSION['full_name'];

?>
<table class="table mt-4">
<br>
     <br>
    <h2 class="text-center text-primary mt-3">Quiz List</h2>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Quiz Name</th>
            <th scope="col">Quiz Time</th>
            <th scope="col">Quiz Image</th>
            <th scope="col">Total Questions</th>
            <th scope="col">Lesson Category</th>
            <th scope="col">Created by</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($quiz as $quiz) { ?>
        <tr>
            <th scope="row"><?php echo $quiz['quiz_id']; ?></th>
            <td><?php echo $quiz['quiz_name']; ?></td>
            <td><?php echo $quiz['time'] ?></td>
            <td><img src="<?php echo $quiz['image']; ?>" alt="" width="50px"></td>
            <td><?php 
                    $totalQuiz = quiz::getTotalQuestion($quiz['quiz_id']); 
                    echo $totalQuiz;
                ?>
            </td>
            <td><?php 
                    $course = getCourseListById($quiz['course_id']);
                    echo $course['course_name'] ?>
            </td>
            <td><?php 
                    $user = getUserById($quiz['user_id']);
                    echo $user['full_name'] ?></td>
            <td>
                <a href="?act=add-question&quiz_id=<?= $quiz['quiz_id'] ?>"><button type="button" class="btn btn-warning">Add Question</button></a>
                <button type="button" class="btn btn-warning">Edit</button>
                <a href="?act=delete-quiz&id=<?= $quiz['quiz_id'] ?>" class="btn btn-danger"
                    onclick="return confirm('Xác nhận xóa quiz này ?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<a href="index.php?act=add-quiz" class="btn btn-primary">Add Quiz</a>