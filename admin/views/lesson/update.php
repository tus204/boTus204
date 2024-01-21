<?php
extract($lesson);
?>
<form class="mt-4 d-flex flex-column gap-2" id='add-post' aciton="index.php?act=add-post" method="POST" enctype="multipart/form-data">
    <br>
     <h2 class="text-center text-primary">Update New Lesson</h2>

     <div class="form-group">
          <label>Lesson Name</label>
          <input type="text" class="form-control"  placeholder="Enter lesson name" require id="lesson_name" name="lesson_name" value="<?=$lesson_name?>">
     </div>
     <div class="form-group">
          <label>Lesson Video</label>
          <input type="text" class="form-control"  placeholder="Enter lesson video" require id="video" name="video" value="<?=$video?>">
     </div>
     <div class="form-group">
          <label>Lesson Description</label>
          <textarea row="3" class="form-control" placeholder="Enter Lesson Description" require id="description" name="description" ><?=$description?></textarea>
     </div>
     <div class="d-flex justify-content-between"> 
          <button onclick="val_post()" type="submit" id="submit" class="btn btn-primary w-25 mt-4" name="update-lesson">Submit</button>
          <button type="reset" class="btn btn-warning text-white w-25 mt-4">Reset</button>
     </div>
</form>
<script src="validate.js"></script>