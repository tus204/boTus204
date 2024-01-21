<table class="table mt-4">
<br>
     <br>
     <h2 class="text-center text-primary mt-3">List Lesson Category</h2>
     <thead>
     <tr>
          <th scope="col">#</th>   
          <th scope="col">Lesson Category Name</th>
          <th scope="col">Action</th>
     </tr>
     </thead>
     <tbody>
     <tr>
        <?php
       foreach ($listlessoncat as $lessoncat) {
        extract($lessoncat);
        $edit_lesson_cat ="index.php?act=update-lesson-cat&id=".$lesson_cat_id;
        $edit_lesson_cat_byId = $edit_lesson_cat. "&index.php?act=list-lesson-cat&course_id=".$course_id;
        $delete_lesson_cat ="index.php?act=delete-lesson-cat&id=".$lesson_cat_id;
        $delete_lesson_cat_del = $delete_lesson_cat."&index.php?act=list-lesson-cat&course_id=".$course_id;
        $add_lesson = "index.php?act=list-lesson&id=".$lesson_cat_id;
       ?>
              <tr> <td scope="row"><?=$lesson_cat_id?> </td>
              <td scope="row"><?=$lesson_cat_name?></td>
              <td>
              <a href="<?=$edit_lesson_cat_byId?>"><button type="button" class="btn btn-warning" name="edit-category">Edit</button></a>
              <a href="<?=$delete_lesson_cat_del?>"><button type="button" class="btn btn-danger" name="deletecate" onclick="return confirm('Nếu xóa thì các bảng liên quan cũng sẽ bị xóa. Bạn muốn xóa không ?')">Delete</button></a>
              <a href="<?=$add_lesson?>" class="btn btn-primary">Add Lesson</a>
          </td> </tr>

     <?php }?>
     </tbody>
</table>
<?php
foreach ($listcourse as $course) {
    extract($course);
    $addlesson_cat_byID = "index.php?act=add-lesson-cat&id=".$_GET['id'];
    ?>
<a href="<?=$addlesson_cat_byID?>" class="btn btn-primary">Add Lesson Category</a>
<?php
break;
}
?>