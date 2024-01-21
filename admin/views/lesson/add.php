<form class="mt-4 d-flex flex-column gap-2" id='add-post' aciton="index.php?act=add-post" method="POST" enctype="multipart/form-data">
    <br>
     <h2 class="text-center text-primary">Add New Lesson</h2>

     <div class="form-group">
          <label>Lesson Name</label>
          <input type="text" class="form-control"  placeholder="Enter lesson name" require id="lesson_name" name="lesson_name">
          <span class="error" id="post_title_error" style="color:red"></span>
     </div>
     <div class="form-group">
          <label>Lesson Video</label>
          <input type="text" class="form-control"  placeholder="Enter lesson video" require id="video" name="video">
          <span class="error" id="post_title_error" style="color:red"></span>
     </div>


     <div class="form-group">
          <label>Lesson Description</label>
          <textarea row="3" class="form-control" placeholder="Enter Lesson Description" require id="editor" name="description"></textarea>
          <span class="error" id="post_title_error" style="color:red"></span>
     </div>

     <div class="form-group">
          <label>Lesson Category Name</label>
          <select class="form-control" name="lesson_cat_id" id="lesson_cat_id">
               <option value="">Select Lessson Category</option>
               <?php
                    foreach ($lessonCat as $cate) {
                         extract($cate);
                         echo '<option value="' . $lesson_cat_id . '">' . $lesson_cat_name . '</option>';                    
                    }
               ?>
          </select>        
     </div>

     <div class="form-group">
          <label>Lesson STT</label>
          <input type="text" class="form-control"  placeholder="Enter lesson video" value="" require id="lesson_stt" name="stt" >
          <span class="error" id="post_title_error" style="color:red"></span>
     </div>

     <div class="d-flex justify-content-between"> 
          <button onclick="val_post()" type="submit" id="submit" class="btn btn-primary w-25 mt-4" name="add-lesson">Submit</button>
          <button type="reset" class="btn btn-warning text-white w-25 mt-4">Reset</button>
     </div>
</form>
<script src="validate.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
     $(document).ready(function() {     
          $('#lesson_cat_id').on('change', function() {
               let lesson_cat_id = this.value
               $.ajax({
                    url: "./views/lesson/getStt.php",
                    type: "POST",
                    data: {
                         lesson_cat_id: lesson_cat_id
                    },
                    cache: false,
                    success: function(result) {
                         $("#lesson_stt").val(result);
                    }
               });
          });
     })
</script>
