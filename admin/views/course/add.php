<form class="mt-4 d-flex flex-column gap-2" id="add-course" enctype="multipart/form-data" method="POST">
     <br>
     <h2 class="text-center text-primary">Add new course</h2>
     <div class="form-group">
          <label>Course Name</label>
          <input type="text" name="course_name" class="form-control"  id="course_name"placeholder="Enter course name" require>
          <span class="error" id="courseName_error" style="color:red"></span>
     </div>

     <div class="form-group">
          <label>Course Title</label>
          <input type="text" name="course_title" id="course_title" class="form-control"  placeholder="Enter course title" require>
          <span class="error" id="courseTitle_error" style="color:red"></span>
     </div>

     <div class="form-group">
          <label>Quiz Video (Link)</label>
          <input type="text" name="course_video" id="course_video" class="form-control" placeholder="Enter course video" require>
          <span class="error" id="video_error" style="color:red"></span>
     </div>

     <div class="form-group">
          <label>Course Content</label>

          <textarea type="text" name="course_content" id="editor" class="form-control" placeholder="Enter course content" require></textarea>
          <span class="error" id="courseContent_error" style="color:red"></span>
     </div>

     <div class="form-group">
          <label>Course Desc</label>
          <textarea type="text" name="course_desc" id="course_desc" class="form-control" placeholder="Enter desc" require></textarea>
          <span class="error" id="courseDesc_error" style="color:red"></span>
     </div>

     <div class="form-group">
          <label>Course Image</label>
          <input type="file" name="course_image" id="course_image" class="form-control" placeholder="Enter course image">
          <span class="error" id="image_error" style="color:red"></span>
     </div>

     </div>

     <div class="form-group">
          <label>Select Category</label>
               <select class="form-control" name="category_id">
                    <?php
                    foreach ($listcategory as $category) {
                              extract($category);
                              echo '<option value="'.$category_id.'">'.$category_name.'</option>';
                    }
                    ?>

               </select>
     </div>

     <div class="d-flex justify-content-between"> 
          <button onclick="val_course()" type="submit" name="submit" id="submit" class="btn btn-primary w-25 mt-4">Submit</button>
          <button type="reset" class="btn btn-warning text-white w-25 mt-4">Reset</button>
     </div>
</form>

<script src="validate.js"></script>

