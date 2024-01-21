<table class="table mt-4">
<br>
     <br>
    <h2 class="text-center text-primary mt-3">Lesson List</h2>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Lesson Name</th>          
            <th scope="col">Video</th>
            <th scope="col">STT</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listLesson as $lesson) {
            extract($lesson);
           //   $loadList_ByID= "index.php?act=list-lesson-cat&id=".$lesson_id;
              $del = "index.php?act=delete-lesson&id=".$lesson_id;
              $del_by_id= $del." & index.php?act=list-lesson&lesson_cat_id=".$lesson_cat_id;
              $edit_lesson ="index.php?act=update-lesson&id=".$lesson_id;
              $edit_lesson_byId = $edit_lesson. "&index.php?act=list-lesson&lesson_cat_id=".$lesson_cat_id;
               ?>
          
        <tr>
            <th scope="row"><?=$lesson_id?></th>
            <td><?=$lesson_name?></td>            
            <td><?=$video?></td>
            <td><?=$stt?></td>
            <td>
               
                <a href="<?=$edit_lesson_byId?>"><button type="button" class="btn btn-warning">Edit</button></a>
                <a href="<?=$del_by_id?>"><button type="button" class="btn btn-danger"
                      onclick="return confirm('Quiz trong khóa học này cũng sẽ bị xóa, xác nhận xóa khóa học này ?')">Delete</button></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php
    $add_byID= "index.php?act=add-lesson&id=".$_GET['id'];
?>
<a href="<?=$add_byID?>" class="btn btn-primary">Add Lesson</a>
<?php    ?>