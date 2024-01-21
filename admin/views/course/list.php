<table class="table mt-4">
<br>
     <br>
    <h2 class="text-center text-primary mt-3">Course List</h2>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Course Name</th>          
            <th scope="col">Course Image</th>
            <th scope="col">Total quizes</th>
            <th scope="col">Total students</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($courses as $course) {
              $loadList_ByID= "index.php?act=list-lesson-cat&id=".$course['course_id'];
               ?>
          
        <tr>
            <th scope="row"><?php echo $course['course_id']; ?></th>
            <td><?php echo $course['course_name']; ?></td>            
            <td><img src="<?php echo $course['image']; ?>" alt="Ảnh course" width="100px"></td>
            <td><?php echo getTotalQuizesById($course['course_id']) ?></td>
            <td><?php echo $course['total_register']; ?></td>
            <td>
               
                <a href="?act=update-course&course_id=<?= $course['course_id'] ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                <a href="?act=delete-course&course_id=<?= $course['course_id'] ?>"><button type="button" class="btn btn-danger"
                      onclick="return confirm('Quiz trong khóa học này cũng sẽ bị xóa, xác nhận xóa khóa học này ?')">Delete</button></a>
                      <a href="<?=$loadList_ByID?>" class="btn btn-primary">Add Lesson Category</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<a href="index.php?act=add-course" class="btn btn-primary">Add Course</a>